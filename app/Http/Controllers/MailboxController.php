<?php

namespace App\Http\Controllers;

use App\Models\EmailDomain;
use App\Models\PublicMailbox;
use App\Services\MailboxService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

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

        return response()
            ->view('inboxoro.index', compact('mailbox', 'domains', 'inbox'))
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
}