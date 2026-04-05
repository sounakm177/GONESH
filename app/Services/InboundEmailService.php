<?php

namespace App\Services;

use App\Events\NewEmailReceived;
use App\Models\PublicEmail;
use App\Models\PublicEmailAttachment;
use App\Models\PublicMailbox;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class InboundEmailService
{
    /**
     * Main entry point — called by the Postfix pipe script.
     * Parses raw RFC 2822 email, finds the matching mailbox,
     * stores email + attachments, fires Reverb broadcast.
     */
    public function processRawEmail(string $rawEmail): array
    {
        // ── Parse raw email ───────────────────────────────────────
        $parsed = $this->parseRawEmail($rawEmail);

        Log::channel('inbound')->info('Inbound email received', [
            'to'      => $parsed['to'],
            'from'    => $parsed['from'],
            'subject' => $parsed['subject'],
        ]);

        // ── Find matching active mailbox ──────────────────────────
        $toEmail = strtolower(trim($parsed['to']));
        $mailbox = PublicMailbox::active()
            ->where('email', $toEmail)
            ->first();

        if (! $mailbox) {
            Log::channel('inbound')->info("No active mailbox for: {$toEmail} — discarding");
            return ['to' => $toEmail, 'status' => 'no_mailbox'];
        }

        // ── Enforce per-mailbox email limit ───────────────────────
        $limit = config('inboxoro.max_emails_per_mailbox', 50);
        $count = $mailbox->emails()->count();
        if ($count >= $limit) {
            // Delete oldest to make room
            $mailbox->emails()
                ->orderBy('received_at')
                ->first()
                ?->delete();
        }

        // ── Store email ───────────────────────────────────────────
        $email = PublicEmail::create([
            'mailbox_id'   => $mailbox->id,
            'sender'       => $parsed['from'],
            'subject'      => substr($parsed['subject'], 0, 500),
            'body'         => $parsed['body'],
            'content_type' => $parsed['content_type'],
            'is_read'      => false,
            'received_at'  => now(),
        ]);

        // ── Store attachments ─────────────────────────────────────
        foreach ($parsed['attachments'] as $att) {
            $this->storeAttachment($email->id, $att);
        }

        // ── Broadcast via Reverb (ShouldBroadcastNow = immediate) ─
        NewEmailReceived::dispatch($email, $mailbox);

        return ['to' => $toEmail, 'status' => 'stored', 'email_id' => $email->id];
    }

    // ════════════════════════════════════════════════════════════════
    //  Raw Email Parser
    //  Handles: plain text, HTML, multipart/alternative,
    //           multipart/mixed (with attachments), base64, quoted-printable
    // ════════════════════════════════════════════════════════════════
    private function parseRawEmail(string $raw): array
    {
        // Split headers from body at first blank line
        $parts = preg_split('/\r?\n\r?\n/', $raw, 2);
        $headerBlock = $parts[0] ?? '';
        $bodyBlock   = $parts[1] ?? '';

        $headers = $this->parseHeaders($headerBlock);

        // ── Decode header values (handles =?UTF-8?...?= encoding) ─
        $subject     = $this->decodeHeader($headers['subject']     ?? '(no subject)');
        $from        = $this->decodeHeader($headers['from']        ?? 'unknown@unknown.com');
        $to          = $this->extractEmail($headers['to']          ?? '');
        $contentType = $headers['content-type']                    ?? 'text/plain';

        $result = [
            'from'         => $from,
            'to'           => $to,
            'subject'      => $subject,
            'body'         => '',
            'content_type' => 'text/plain',
            'attachments'  => [],
        ];

        // ── Route by content type ─────────────────────────────────
        if ($this->isMultipart($contentType)) {
            $boundary = $this->extractBoundary($contentType);
            if ($boundary) {
                $this->parseMultipart($bodyBlock, $boundary, $result);
            }
        } else {
            // Single-part email
            $encoding = $headers['content-transfer-encoding'] ?? '7bit';
            $result['body']         = $this->decodeBody($bodyBlock, $encoding);
            $result['content_type'] = $this->mimeBaseType($contentType);
        }

        return $result;
    }

    // ── Header parsing ────────────────────────────────────────────

    private function parseHeaders(string $headerBlock): array
    {
        // Unfold multi-line headers (RFC 2822: continuation lines start with whitespace)
        $unfolded = preg_replace('/\r?\n[ \t]+/', ' ', $headerBlock);
        $headers  = [];

        foreach (explode("\n", $unfolded) as $line) {
            if (strpos($line, ':') === false) continue;
            [$name, $value] = explode(':', $line, 2);
            $headers[strtolower(trim($name))] = trim($value);
        }

        return $headers;
    }

    private function decodeHeader(string $value): string
    {
        // Decode RFC 2047 encoded words: =?charset?encoding?text?=
        return mb_decode_mimeheader($value);
    }

    private function extractEmail(string $value): string
    {
        // Extract bare email from "Name <email@example.com>" or "email@example.com"
        if (preg_match('/<([^>]+)>/', $value, $m)) {
            return strtolower(trim($m[1]));
        }
        // Handle comma-separated multiple recipients — take first
        $parts = explode(',', $value);
        return strtolower(trim($parts[0]));
    }

    private function extractBoundary(string $contentType): ?string
    {
        if (preg_match('/boundary=(?:"([^"]+)"|([^\s;]+))/i', $contentType, $m)) {
            return $m[1] ?: $m[2];
        }
        return null;
    }

    private function isMultipart(string $contentType): bool
    {
        return stripos($contentType, 'multipart/') !== false;
    }

    private function mimeBaseType(string $contentType): string
    {
        // Strip parameters: "text/html; charset=utf-8" → "text/html"
        return strtolower(trim(explode(';', $contentType)[0]));
    }

    // ── Multipart parser ──────────────────────────────────────────

    private function parseMultipart(string $body, string $boundary, array &$result): void
    {
        // Split on boundary — RFC says boundary is prefixed with --
        $delimiter = '--' . $boundary;
        $parts     = explode($delimiter, $body);

        // First and last parts are preamble/epilogue — skip them
        array_shift($parts);
        array_pop($parts);

        foreach ($parts as $part) {
            // Remove leading CRLF
            $part = ltrim($part, "\r\n");

            // Split part headers from part body
            $split      = preg_split('/\r?\n\r?\n/', $part, 2);
            $partHeader = $split[0] ?? '';
            $partBody   = $split[1] ?? '';

            // Remove trailing boundary markers
            $partBody = rtrim($partBody, "\r\n-");

            $partHeaders  = $this->parseHeaders($partHeader);
            $partType     = $partHeaders['content-type']              ?? 'text/plain';
            $partEncoding = $partHeaders['content-transfer-encoding'] ?? '7bit';
            $disposition  = $partHeaders['content-disposition']       ?? '';
            $baseType     = $this->mimeBaseType($partType);

            // ── Nested multipart (e.g. multipart/alternative inside multipart/mixed)
            if ($this->isMultipart($partType)) {
                $innerBoundary = $this->extractBoundary($partType);
                if ($innerBoundary) {
                    $this->parseMultipart($partBody, $innerBoundary, $result);
                }
                continue;
            }

            // ── Attachment ────────────────────────────────────────
            if (stripos($disposition, 'attachment') !== false || stripos($disposition, 'inline') !== false) {
                $filename = $this->extractFilename($disposition, $partType);
                if ($filename) {
                    $result['attachments'][] = [
                        'filename'     => $filename,
                        'content_type' => $baseType,
                        'encoding'     => $partEncoding,
                        'content'      => $partBody,
                    ];
                    continue;
                }
            }

            // ── Body: prefer HTML over plain text ─────────────────
            $decoded = $this->decodeBody($partBody, $partEncoding);

            if ($baseType === 'text/html') {
                // HTML wins — always prefer it
                $result['body']         = $decoded;
                $result['content_type'] = 'text/html';
            } elseif ($baseType === 'text/plain' && empty($result['body'])) {
                // Only use plain text if we haven't found HTML yet
                $result['body']         = $decoded;
                $result['content_type'] = 'text/plain';
            }
        }
    }

    private function extractFilename(string $disposition, string $contentType): ?string
    {
        // Try Content-Disposition: attachment; filename="foo.pdf"
        if (preg_match('/filename\*?=(?:UTF-8\'\')?(?:"([^"]+)"|([^\s;]+))/i', $disposition, $m)) {
            return rawurldecode($m[1] ?: $m[2]);
        }
        // Try Content-Type: image/jpeg; name="photo.jpg"
        if (preg_match('/name=(?:"([^"]+)"|([^\s;]+))/i', $contentType, $m)) {
            return $m[1] ?: $m[2];
        }
        return null;
    }

    // ── Body decoding ─────────────────────────────────────────────

    private function decodeBody(string $body, string $encoding): string
    {
        return match (strtolower(trim($encoding))) {
            'base64'           => base64_decode(str_replace(["\r", "\n"], '', $body)),
            'quoted-printable' => quoted_printable_decode($body),
            default            => $body,   // 7bit, 8bit, binary
        };
    }

    // ── Attachment storage ────────────────────────────────────────

    private function storeAttachment(int $emailId, array $att): void
    {
        $maxSize = config('inboxoro.max_attachment_size', 10 * 1024 * 1024);

        $content  = $this->decodeBody($att['content'], $att['encoding']);
        $size     = strlen($content);

        if ($size > $maxSize) {
            Log::channel('inbound')->info("Attachment too large ({$size} bytes) — skipped: {$att['filename']}");
            return;
        }

        // Sanitise filename
        $filename = preg_replace('/[^a-zA-Z0-9._\-]/', '_', $att['filename']);
        $path     = "attachments/{$emailId}/{$filename}";

        Storage::put($path, $content);

        PublicEmailAttachment::create([
            'email_id'  => $emailId,
            'file_name' => $filename,
            'file_path' => $path,
            'file_size' => $size,
            'mime_type' => $att['content_type'],
        ]);
    }
}