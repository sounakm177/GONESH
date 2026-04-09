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

    private function storeAttachment(int $emailId, array $att): void
    {
        $maxSize = config('inboxoro.max_attachment_size', 10 * 1024 * 1024);
    
        // ── Decode content first ──────────────────────────────────────
        $content = $this->decodeBody($att['content'], $att['encoding'] ?? '7bit');
    
        // ── Use mb_strlen with 8bit for accurate binary byte count ───
        $size = mb_strlen($content, '8bit');
    
        if (empty($content) || $size === 0) {
            Log::channel('inbound')->warning("Empty attachment skipped: {$att['filename']}");
            return;
        }
    
        if ($size > $maxSize) {
            Log::channel('inbound')->info("Attachment too large ({$size} bytes) — skipped: {$att['filename']}");
            return;
        }
    
        // ── Sanitise filename ─────────────────────────────────────────
        $filename = preg_replace('/[^a-zA-Z0-9._\-]/', '_', $att['filename'] ?? 'attachment');
        $filename = ltrim($filename, '.'); // prevent hidden files like .htaccess
    
        // ── Build storage path ────────────────────────────────────────
        // Stored under storage/app/attachments/{emailId}/filename
        // NOT in public disk — served via AttachmentController with auth check
        $directory = "attachments/{$emailId}";
        $path      = "{$directory}/{$filename}";
    
        // ── Ensure directory exists manually (most reliable approach) ─
        $fullDirectory = storage_path("app/{$directory}");
    
        if (! is_dir($fullDirectory)) {
            $created = mkdir($fullDirectory, 0775, true);
    
            if (! $created && ! is_dir($fullDirectory)) {
                Log::channel('inbound')->error(
                    "Failed to create attachment directory: {$fullDirectory}",
                    ['email_id' => $emailId, 'filename' => $filename]
                );
                return;
            }
        }
    
        // ── Write file directly with file_put_contents (most reliable) 
        // Storage::put() can silently fail when www-data lacks permissions.
        // file_put_contents gives us the actual byte count written or false.
        $fullPath = storage_path("app/{$path}");
        $written  = file_put_contents($fullPath, $content);
    
        if ($written === false) {
            Log::channel('inbound')->error(
                "Failed to write attachment file: {$fullPath}",
                [
                    'email_id'  => $emailId,
                    'filename'  => $filename,
                    'size'      => $size,
                    'dir_exists'    => is_dir($fullDirectory),
                    'dir_writable'  => is_writable($fullDirectory),
                    'php_user'      => get_current_user(),
                    'process_user'  => posix_getpwuid(posix_geteuid())['name'] ?? 'unknown',
                ]
            );
            return;
        }
    
        if ($written !== $size) {
            Log::channel('inbound')->warning(
                "Partial write: expected {$size} bytes, wrote {$written} bytes — {$filename}"
            );
        }
    
        // ── Set correct file permissions ──────────────────────────────
        chmod($fullPath, 0664);
    
        // ── Insert DB record only after confirmed file write ──────────
        PublicEmailAttachment::create([
            'email_id'  => $emailId,
            'file_name' => $filename,
            'file_path' => $path,          // relative to storage/app/
            'file_size' => $written,
            'mime_type' => $att['content_type'] ?? 'application/octet-stream',
        ]);
    
        Log::channel('inbound')->info(
            "Attachment stored: {$path} ({$written} bytes)"
        );
    }
}