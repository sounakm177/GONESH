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
    public function processRawEmail(string $rawEmail): array
    {
        $parsed = $this->parseRawEmail($rawEmail);

        Log::channel('inbound')->info('Inbound email received', [
            'to'      => $parsed['to'],
            'from'    => $parsed['from'],
            'subject' => $parsed['subject'],
        ]);

        $toEmail = strtolower(trim($parsed['to']));
        $mailbox = PublicMailbox::active()
            ->where('email', $toEmail)
            ->first();

        if (! $mailbox) {
            Log::channel('inbound')->info("No active mailbox for sounak: {$toEmail} — discarding");
            return ['to' => $toEmail, 'status' => 'no_mailbox'];
        }

        $limit = config('inboxoro.max_emails_per_mailbox', 50);
        $count = $mailbox->emails()->count();
        if ($count >= $limit) {
            $mailbox->emails()
                ->orderBy('received_at')
                ->first()
                ?->delete();
        }

        $email = PublicEmail::create([
            'mailbox_id'   => $mailbox->id,
            'sender'       => $parsed['from'],
            'subject'      => substr($parsed['subject'], 0, 500),
            'body'         => $parsed['body'],
            'content_type' => $parsed['content_type'],
            'is_read'      => false,
            'received_at'  => now(),
        ]);

        foreach ($parsed['attachments'] as $att) {
            $this->storeAttachment($email->id, $att);
        }

        NewEmailReceived::dispatch($email, $mailbox);

        return ['to' => $toEmail, 'status' => 'stored', 'email_id' => $email->id];
    }


    private function parseRawEmail(string $raw): array
    {
        $parts = preg_split('/\r?\n\r?\n/', $raw, 2);
        $headerBlock = $parts[0] ?? '';
        $bodyBlock   = $parts[1] ?? '';

        $headers = $this->parseHeaders($headerBlock);

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

        if ($this->isMultipart($contentType)) {
            $boundary = $this->extractBoundary($contentType);
            if ($boundary) {
                $this->parseMultipart($bodyBlock, $boundary, $result);
            }
        } else {
            $encoding = $headers['content-transfer-encoding'] ?? '7bit';
            $result['body']         = $this->decodeBody($bodyBlock, $encoding);
            $result['content_type'] = $this->mimeBaseType($contentType);
        }

        return $result;
    }


    private function parseHeaders(string $headerBlock): array
    {
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
        return mb_decode_mimeheader($value);
    }

    private function extractEmail(string $value): string
    {
        if (preg_match('/<([^>]+)>/', $value, $m)) {
            return strtolower(trim($m[1]));
        }
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
        return strtolower(trim(explode(';', $contentType)[0]));
    }


    private function parseMultipart(string $body, string $boundary, array &$result): void
    {
        $delimiter = '--' . $boundary;
        $parts     = explode($delimiter, $body);

        array_shift($parts);
        array_pop($parts);

        foreach ($parts as $part) {
            $part = ltrim($part, "\r\n");

            $split      = preg_split('/\r?\n\r?\n/', $part, 2);
            $partHeader = $split[0] ?? '';
            $partBody   = $split[1] ?? '';

            $partBody = rtrim($partBody, "\r\n-");

            $partHeaders  = $this->parseHeaders($partHeader);
            $partType     = $partHeaders['content-type']              ?? 'text/plain';
            $partEncoding = $partHeaders['content-transfer-encoding'] ?? '7bit';
            $disposition  = $partHeaders['content-disposition']       ?? '';
            $baseType     = $this->mimeBaseType($partType);

            if ($this->isMultipart($partType)) {
                $innerBoundary = $this->extractBoundary($partType);
                if ($innerBoundary) {
                    $this->parseMultipart($partBody, $innerBoundary, $result);
                }
                continue;
            }

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

            $decoded = $this->decodeBody($partBody, $partEncoding);

            if ($baseType === 'text/html') {
                $result['body']         = $decoded;
                $result['content_type'] = 'text/html';
            } elseif ($baseType === 'text/plain' && empty($result['body'])) {
                $result['body']         = $decoded;
                $result['content_type'] = 'text/plain';
            }
        }
    }

    private function extractFilename(string $disposition, string $contentType): ?string
    {
        if (preg_match('/filename\*?=(?:UTF-8\'\')?(?:"([^"]+)"|([^\s;]+))/i', $disposition, $m)) {
            return rawurldecode($m[1] ?: $m[2]);
        }
        if (preg_match('/name=(?:"([^"]+)"|([^\s;]+))/i', $contentType, $m)) {
            return $m[1] ?: $m[2];
        }
        return null;
    }


    private function decodeBody(string $body, string $encoding): string
    {
        return match (strtolower(trim($encoding))) {
            'base64'           => base64_decode(str_replace(["\r", "\n"], '', $body)),
            'quoted-printable' => quoted_printable_decode($body),
            default            => $body,   // 7bit, 8bit, binary
        };
    }


    private function storeAttachment(int $emailId, array $att): void
    {
        $maxSize = config('inboxoro.max_attachment_size', 10 * 1024 * 1024);

        $content  = $this->decodeBody($att['content'], $att['encoding']);
        $size     = strlen($content);

        if ($size > $maxSize) {
            Log::channel('inbound')->info("Attachment too large ({$size} bytes) — skipped: {$att['filename']}");
            return;
        }

        $filename = preg_replace('/[^a-zA-Z0-9._\-]/', '_', $att['filename']);
        $directory = storage_path("app/attachments/{$emailId}");

        if (!file_exists($directory)) {
            mkdir($directory, 0755, true);
        }

        $path = "{$directory}/{$filename}";
        file_put_contents($path, $content);

        PublicEmailAttachment::create([
            'email_id'  => $emailId,
            'file_name' => $filename,
            'file_path' => "attachments/{$emailId}/{$filename}", // relative path
            'file_size' => $size,
            'mime_type' => $att['content_type'],
        ]);
    }
}