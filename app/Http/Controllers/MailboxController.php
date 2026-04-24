<?php

namespace App\Http\Controllers;

use App\Models\EmailDomain;
use App\Models\PublicMailbox;
use App\Models\PublicEmailAttachment;
use App\Services\MailboxService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class MailboxController extends Controller
{
    public function __construct(
        private readonly MailboxService $mailboxService,
    ) {}

    public function index(Request $request)
    {
        $sessionId = $this->getSessionId($request);
        $mailbox   = $this->mailboxService->resolveForSession($sessionId);

        $domains = EmailDomain::cachedActive();
        
        $inbox = $this->mailboxService->getInbox($mailbox, perPage: 10);

        $schema = [
            "@context" => "https://schema.org",
            "@graph" => [

                [
                    "@type" => "Organization",
                    "name" => "Inboxoro",
                    "url" => url('/'),
                    "logo" => [
                        "@type" => "ImageObject",
                        "url" => asset('images/logo.png'),
                        "width" => 512,
                        "height" => 512
                    ]
                ],

                [
                    "@type" => "WebSite",
                    "name" => "Inboxoro",
                    "url" => url('/'),
                    "description" => "Free temporary email generator to receive OTPs, avoid spam, and protect your privacy. Instant disposable inbox with auto-deletion.",
                    "inLanguage" => "en",
                    "publisher" => [
                        "@type" => "Organization",
                        "name" => "Inboxoro"
                    ]
                ],

                [
                    "@type" => "WebPage",
                    "name" => "Free Temporary Email Generator",
                    "url" => url()->current(),
                    "description" => "Generate temporary email instantly. Receive OTPs and verification emails without exposing your real inbox.",
                    "isPartOf" => [
                        "@type" => "WebSite",
                        "url" => url('/')
                    ]
                ],

                [
                    "@type" => "SoftwareApplication",
                    "name" => "Inboxoro Temporary Email",
                    "applicationCategory" => "UtilitiesApplication",
                    "operatingSystem" => "Web",
                    "url" => url('/'),
                    "description" => "Disposable email generator for receiving OTPs, avoiding spam, and protecting email privacy.",
                    "offers" => [
                        "@type" => "Offer",
                        "price" => "0",
                        "priceCurrency" => "USD"
                    ]
                ]

            ]
        ];


        return response()
            ->view('inboxoro.index', compact('mailbox', 'domains', 'inbox','schema'))
            ->header('Cache-Control', 'no-store, no-cache, must-revalidate');
    }

  
    public function generate(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'domain' => ['nullable', 'string', 'max:100'],
        ]);

        $sessionId = $this->getSessionId($request);
        $mailbox   = $this->mailboxService->createMailbox($sessionId, $validated['domain'] ?? null);

        return response()->json([
            'email'      => $mailbox->email,
            'mailbox_id' => $mailbox->id,
            'expires_at' => $mailbox->expires_at->toISOString(),
            'expires_in' => $mailbox->secondsRemaining(),
        ])->withHeaders(['Cache-Control' => 'no-store']);
    }

 
    public function inbox(Request $request): JsonResponse
    {
        $mailbox = $this->resolveActiveMailbox($request);
        if (! $mailbox) {
            return response()->json(['error' => 'mailbox_expired'], 410);
        }

        $inbox = $this->mailboxService->getInbox(
            $mailbox,
            $request->query('search'),
            (int) $request->query('page', 1),
        );

        return response()->json($inbox)->withHeaders(['Cache-Control' => 'no-store']);
    }


    public function show(Request $request, int $id): JsonResponse
    {
        $mailbox = $this->resolveActiveMailbox($request);

        if (! $mailbox) {
            return response()->json(['error' => 'mailbox_expired'], 410);
        }

        $email = $this->mailboxService->openEmail($mailbox, $id);
        $senderName = $email->senderName();
        $avatar = avatar_data($senderName);

        return response()->json([
            'id'          => $email->id,
            'sender'      => $senderName,
            'sender_email'=> $email->senderEmail(),
            'subject'     => $email->subject,
            'body'        => $email->safeBody(),
            'content_type'=> $email->content_type,
            'received_at' => $email->received_at->toISOString(),
            'time_ago'    => $email->timeAgo(),
            'avatar_letter' => $avatar["letter"],
            'avatar_color'  => $avatar["color"],
            'attachments' => $email->attachments->map(fn ($a) => [
                'id'        => $a->id,
                'file_name' => $a->file_name,
                'size'      => $a->humanSize() ?? '',
                'extension' => $a->extension() ?? '',
                'icon_style'=> $a->iconStyle() ?? '',
                'download_url' => $a->downloadUrl() ?? '',
            ]),
            'unread_count' => $mailbox->fresh()->unreadCount(),
        ])->withHeaders(['Cache-Control' => 'no-store']);
    }

    public function destroy(Request $request, int $id): JsonResponse
    {
        $mailbox = $this->resolveActiveMailbox($request);
        if (! $mailbox) return response()->json(['ok' => false], 410);

        $ok = $this->mailboxService->deleteEmail($mailbox, $id);
        return response()->json(['ok' => $ok, 'unread_count' => $mailbox->fresh()->unreadCount()]);
    }

    public function markUnread(Request $request, int $id): JsonResponse
    {
        $mailbox = $this->resolveActiveMailbox($request);
        if (! $mailbox) return response()->json(['ok' => false], 410);

        $ok = $this->mailboxService->markUnread($mailbox, $id);
        return response()->json(['ok' => $ok, 'unread_count' => $mailbox->fresh()->unreadCount()]);
    }

    public function markAllRead(Request $request): JsonResponse
    {
        $mailbox = $this->resolveActiveMailbox($request);
        if (! $mailbox) return response()->json(['ok' => false], 410);

        $count = $this->mailboxService->markAllRead($mailbox);
        return response()->json(['ok' => true, 'updated' => $count]);
    }

    public function destroyAll(Request $request): JsonResponse
    {
        $mailbox = $this->resolveActiveMailbox($request);
        if (! $mailbox) return response()->json(['ok' => false], 410);

        $count = $this->mailboxService->deleteAll($mailbox);
        return response()->json(['ok' => true, 'deleted' => $count]);
    }

    private function getSessionId(Request $request): string
    {
        return hash('sha256', $request->session()->getId());
    }

    private function resolveActiveMailbox(Request $request): ?PublicMailbox
    {
        $sessionId = $this->getSessionId($request);

        return PublicMailbox::active()
            ->forSession($sessionId)
            ->latest()
            ->first();
    }

    public function attachmentDownload($attachmentId)
    {
        $attachment = PublicEmailAttachment::findOrFail($attachmentId);

        if (!Storage::disk('public')->exists($attachment->file_path)) {
            abort(404, 'File not found');
        }

        return Storage::disk('public')->download(
            $attachment->file_path,
            $attachment->file_name,
            [
                'Content-Type' => $attachment->mime_type ?? 'application/octet-stream',
            ]
        );
    }

    public function extend(PublicMailbox $mailbox): \Illuminate\Http\JsonResponse
    {
        $maxExpiry = $mailbox->maxExpiry();
    
        // Already at the ceiling?
        if ($mailbox->expires_at->gte($maxExpiry)) {
            return response()->json([
                'message'    => 'Maximum time reached',
                'at_max'     => true,
                'expires_at' => $mailbox->expires_at->toIso8601String(),
                'expires_in' => $mailbox->secondsRemaining(),
            ], 422);
        }
    
        $newExpiry = $mailbox->expires_at->copy()->addMinutes(10);
    
        // Clamp to ceiling
        $mailbox->expires_at = $newExpiry->gt($maxExpiry)
            ? $maxExpiry
            : $newExpiry;
    
        $mailbox->save();
    
        return response()->json([
            'message'    => '+10 minutes added',
            'at_max'     => $mailbox->expires_at->gte($maxExpiry),
            'expires_at' => $mailbox->expires_at->toIso8601String(),
            'expires_in' => $mailbox->secondsRemaining(),
        ]);
    }
    
    // public function pause(PublicMailbox $mailbox)
    // {
    //     if ($mailbox->isExpired()) {
    //         return response()->json(['message' => 'Mailbox has expired'], 410);
    //     }
    
    //     // Already paused — just return current state
    //     if ($mailbox->is_paused) {
    //         return response()->json([
    //             'is_paused'  => true,
    //             'expires_in' => $mailbox->secondsRemaining(),
    //             'paused_at'  => $mailbox->paused_at->toIso8601String(),
    //         ]);
    //     }
    
    //     $mailbox->is_paused = true;
    //     $mailbox->paused_at = now();
    //     $mailbox->save();


    //     dd([
    //         'before_save' => $mailbox->getOriginal('expires_at'),
    //         'current' => $mailbox->expires_at,
    //     ]);
       
    //     return response()->json([
    //         'message'    => 'Timer paused',
    //         'is_paused'  => true,
    //         'expires_in' => $mailbox->secondsRemaining(),
    //         'paused_at'  => $mailbox->paused_at->toIso8601String(),
    //     ]);
    // }

    public function pause(PublicMailbox $mailbox)
    {
        if ($mailbox->isExpired()) {
            return response()->json([
                'message' => 'Mailbox has expired'
            ], 410);
        }

        if ($mailbox->is_paused) {
            return response()->json([
                'is_paused'  => true,
                'expires_in' => $mailbox->secondsRemaining(),
                'paused_at'  => optional($mailbox->paused_at)?->toIso8601String(),
            ]);
        }

        $beforeExpiresAt = $mailbox->expires_at;

        $mailbox->update([
            'is_paused' => true,
            'paused_at' => now(),
        ]);

        $mailbox->refresh();

        return response()->json([
            'message'    => 'Timer paused',
            'is_paused'  => true,
            'expires_in' => $mailbox->secondsRemaining(),
            'paused_at'  => $mailbox->paused_at?->toIso8601String(),
            'debug' => [
                'before_expires_at' => $beforeExpiresAt,
                'after_expires_at'  => $mailbox->expires_at,
            ]
        ]);
    }
    
    // public function resume(PublicMailbox $mailbox): \Illuminate\Http\JsonResponse
    // {
    //     if ($mailbox->isExpired()) {
    //         return response()->json(['message' => 'Mailbox has expired'], 410);
    //     }
    
    //     // Not paused — just return current state
    //     if (! $mailbox->is_paused || ! $mailbox->paused_at) {
    //         return response()->json([
    //             'is_paused'  => false,
    //             'expires_in' => $mailbox->secondsRemaining(),
    //         ]);
    //     }
    
    //     $maxExpiry     = $mailbox->maxExpiry();
    //     $pausedSeconds = now()->diffInSeconds($mailbox->paused_at);
    
    //     // Shift expires_at forward by however long we were paused
    //     $newExpiry = $mailbox->expires_at->copy()->addSeconds($pausedSeconds);
    
    //     $mailbox->expires_at = $newExpiry->gt($maxExpiry)
    //         ? $maxExpiry
    //         : $newExpiry;
    
    //     $mailbox->is_paused = false;
    //     $mailbox->paused_at = null;
    //     $mailbox->save();
    
    //     return response()->json([
    //         'message'    => 'Timer resumed',
    //         'is_paused'  => false,
    //         'at_max'     => $mailbox->expires_at->gte($maxExpiry),
    //         'expires_at' => $mailbox->expires_at->toIso8601String(),
    //         'expires_in' => $mailbox->secondsRemaining(),
    //     ]);
    // }

    public function resume(PublicMailbox $mailbox): \Illuminate\Http\JsonResponse
    {
        if ($mailbox->isExpired()) {
            return response()->json(['message' => 'Mailbox has expired'], 410);
        }

        if (! $mailbox->is_paused || ! $mailbox->paused_at) {
            return response()->json([
                'is_paused'  => false,
                'expires_in' => $mailbox->secondsRemaining(),
            ]);
        }

        // ── THE FIX ─────────────────────────────────────────────────
        // When paused, expires_at is frozen — the remaining time is
        // (expires_at - paused_at). On resume we shift expires_at
        // forward by exactly that frozen-remaining amount so the
        // countdown picks up from the same number it showed when paused.
        //
        // Example:
        //   paused_at  = 09:04  (user clicked pause)
        //   expires_at = 09:10  (6 min left when paused)
        //   resumed    = 09:05  (1 min later)
        //   new expires_at = now + 6 min = 09:11  ✓  (still 6 min left)
        // ─────────────────────────────────────────────────────────────

        // Seconds that were remaining at the moment of pause (frozen value)
        $frozenRemaining = $mailbox->paused_at->diffInSeconds($mailbox->expires_at);

        // New expiry = now + those same remaining seconds
        $newExpiry = now()->addSeconds($frozenRemaining);

        // Still cap at the 30-min ceiling
        $maxExpiry           = $mailbox->maxExpiry();
        $mailbox->expires_at = $newExpiry->gt($maxExpiry) ? $maxExpiry : $newExpiry;

        $mailbox->is_paused = false;
        $mailbox->paused_at = null;
        $mailbox->save();

        return response()->json([
            'message'    => 'Timer resumed',
            'is_paused'  => false,
            'at_max'     => $mailbox->expires_at->gte($maxExpiry),
            'expires_at' => $mailbox->expires_at->toIso8601String(),
            'expires_in' => $mailbox->secondsRemaining(),
        ]);
    }
}