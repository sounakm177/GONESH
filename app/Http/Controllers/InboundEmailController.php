<?php

namespace App\Http\Controllers;

use App\Events\NewEmailReceived;
use App\Models\PublicEmailAttachment;
use App\Models\PublicMailbox;
use App\Models\PublicEmail;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

/**
 * Receives inbound email webhooks from your mail server.
 *
 * Compatible with:
 *  - Postal (open-source)
 *  - Mailgun inbound routes
 *  - Haraka + custom webhook plugin
 *  - Any SMTP relay that POSTs parsed email as JSON
 *
 * Secured via a shared secret header: X-Webhook-Secret
 */
class InboundEmailController extends Controller
{
    /**
     * POST /inbound/email
     *
     * Expected payload (JSON):
     * {
     *   "to":           "silent.fox1234@inboxoro.com",
     *   "from":         "\"GitHub\" <noreply@github.com>",
     *   "subject":      "Your PR was merged",
     *   "body_html":    "<p>...</p>",     // optional
     *   "body_text":    "...",            // optional
     *   "attachments":  [                 // optional
     *     { "filename": "report.pdf", "content_type": "application/pdf", "size": 12345, "content": "<base64>" }
     *   ]
     * }
     */
    public function receive(Request $request): Response
    {
        // ── Security: verify shared webhook secret ────────────────────
        $secret = config('inboxoro.webhook_secret');
        if ($secret && $request->header('X-Webhook-Secret') !== $secret) {
            Log::warning('InboundEmail: invalid webhook secret from ' . $request->ip());
            return response('Unauthorized', 401);
        }

        $data = $request->json()->all();

        if (empty($data['to'])) {
            return response('Missing recipient', 422);
        }

        $toEmail  = strtolower(trim($data['to']));
        $mailbox  = PublicMailbox::active()
            ->where('email', $toEmail)
            ->first();

        if (! $mailbox) {
            // Silently accept — mail server expects 200 to avoid retries
            return response('OK', 200);
        }

        try {
            $body        = $data['body_html'] ?? $data['body_text'] ?? '';
            $contentType = isset($data['body_html']) ? 'text/html' : 'text/plain';

            $email = PublicEmail::create([
                'mailbox_id'   => $mailbox->id,
                'sender'       => $data['from'] ?? 'unknown@unknown.com',
                'subject'      => substr($data['subject'] ?? '(no subject)', 0, 500),
                'body'         => $body,
                'content_type' => $contentType,
                'is_read'      => false,
                'received_at'  => now(),
            ]);

            // ── Store attachments ─────────────────────────────────────
            foreach (($data['attachments'] ?? []) as $att) {
                $this->storeAttachment($email->id, $att);
            }

            // ── Broadcast via Reverb ──────────────────────────────────
            NewEmailReceived::dispatch($email, $mailbox);

        } catch (\Throwable $e) {
            Log::error('InboundEmail: failed to store email: ' . $e->getMessage(), [
                'to' => $toEmail,
            ]);
            // Still return 200 to prevent mail server retry storm
        }

        return response('OK', 200);
    }

    // private function storeAttachment(int $emailId, array $att): void
    // {
    //     if (empty($att['content'])) return;

    //     $content  = base64_decode($att['content']);
    //     $filename = preg_replace('/[^a-zA-Z0-9._\-]/', '_', $att['filename'] ?? 'attachment');
    //     $path     = "attachments/{$emailId}/{$filename}";

    //     Storage::put($path, $content);

    //     PublicEmailAttachment::create([
    //         'email_id'  => $emailId,
    //         'file_name' => $filename,
    //         'file_path' => $path,
    //         'file_size' => strlen($content),
    //         'mime_type' => $att['content_type'] ?? 'application/octet-stream',
    //     ]);
    // }

    private function decodeBody($content, $encoding)
    {
        return match (strtolower($encoding)) {
            'base64' => base64_decode($content),
            'quoted-printable' => quoted_printable_decode($content),
            default => $content,
        };
    }

    private function storeAttachment(int $emailId, array $att): void
    {
        if (empty($att['content'])) return;

        $content = $this->decodeBody($att['content'], $att['encoding'] ?? 'base64');

        // filename fix
        $originalName = $att['filename'] ?? 'attachment';
        $cleanName = preg_replace('/[^a-zA-Z0-9._\-]/', '_', $originalName);

        $parts = explode('.', $cleanName);
        if (count($parts) > 2) {
            $ext = array_pop($parts);
            $name = implode('_', $parts);
            $cleanName = $name . '.' . $ext;
        }

        $filename = $cleanName;
        $path = "attachments/{$emailId}/{$filename}";

        Storage::put($path, $content);

        $mime = $att['content_type'] ?? null;
        if (!$mime || $mime === 'application/octet-stream') {
            $mime = finfo_buffer(finfo_open(FILEINFO_MIME_TYPE), $content);
        }

        PublicEmailAttachment::create([
            'email_id'  => $emailId,
            'file_name' => $filename,
            'file_path' => $path,
            'file_size' => strlen($content),
            'mime_type' => $mime,
        ]);
    }
}