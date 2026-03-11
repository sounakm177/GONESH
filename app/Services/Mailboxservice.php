<?php

namespace App\Services;

use App\Models\EmailDomain;
use App\Models\PublicEmail;
use App\Models\PublicMailbox;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class MailboxService
{
    private const TTL_MINUTES   = 10;
    private const LOCAL_ADJECTIVES = [
        'silent','ghost','turbo','vapor','swift','lunar','neon','flux',
        'rogue','stealth','onyx','blaze','mist','echo','zero','vivid',
        'solar','crisp','ultra','prime',
    ];
    private const LOCAL_NOUNS = [
        'fox','wolf','tide','bolt','hawk','mint','storm','byte',
        'nova','apex','dusk','wren','pike','elk','moss','reef',
        'claw','haze','gust','fern',
    ];

    // ── Public API ───────────────────────────────────────────────────

    /**
     * Find an existing active mailbox for the session or create a new one.
     * Uses a SELECT + pessimistic lock to avoid race conditions.
     */
    public function resolveForSession(string $sessionId, ?string $preferDomain = null): PublicMailbox
    {
        return DB::transaction(function () use ($sessionId, $preferDomain) {
            // 1. Try to find existing non-expired mailbox
            $mailbox = PublicMailbox::active()
                ->forSession($sessionId)
                ->lockForUpdate()
                ->first();

            if ($mailbox) {
                return $mailbox;
            }

            // 2. Create fresh one
            return $this->createMailbox($sessionId, $preferDomain);
        });
    }

    /**
     * Generate a brand-new mailbox (replaces the current one for the session).
     */
    public function createMailbox(string $sessionId, ?string $preferDomain = null): PublicMailbox
    {
        $domain = $this->resolveDomain($preferDomain);
        $email  = $this->generateUniqueEmail($domain->domain);

        return PublicMailbox::create([
            'email'      => $email,
            'domain'     => $domain->domain,
            'session_id' => $sessionId,
            'expires_at' => now()->addMinutes(self::TTL_MINUTES),
        ]);
    }

    /**
     * Paginated inbox retrieval — eager-loads attachment count.
     * Supports optional full-text search term.
     */
    public function getInbox(PublicMailbox $mailbox, ?string $search = null, int $page = 1, int $perPage = 30): array
    {
        $query = $mailbox->emails()
            ->select([
                'id', 'mailbox_id', 'sender', 'subject',
                'is_read', 'received_at', 'content_type',
                // Preview: first 120 chars of body at DB level — avoids PHP overhead
                DB::raw("LEFT(body, 120) AS preview"),
            ])
            ->withCount('attachments')
            ->orderByDesc('received_at');

        if ($search && strlen($search) >= 2) {
            $query->search($search);
        }

        $paginator = $query->paginate($perPage, ['*'], 'page', $page);

        return [
            'emails'       => $paginator->items(),
            'total'        => $paginator->total(),
            'unread'       => $mailbox->emails()->unread()->count(),
            'has_more'     => $paginator->hasMorePages(),
            'current_page' => $paginator->currentPage(),
            'last_page'    => $paginator->lastPage(),
        ];
    }

    /**
     * Full email detail with attachments.
     * Marks as read and returns email.
     */
    public function openEmail(PublicMailbox $mailbox, int $emailId): PublicEmail
    {
        $email = $mailbox->emails()
            ->with('attachments')
            ->findOrFail($emailId);

        if (! $email->is_read) {
            $email->update(['is_read' => true]);
        }

        return $email;
    }

    public function deleteEmail(PublicMailbox $mailbox, int $emailId): bool
    {
        return (bool) $mailbox->emails()->where('id', $emailId)->delete();
    }

    public function markAllRead(PublicMailbox $mailbox): int
    {
        return $mailbox->emails()->unread()->update(['is_read' => true]);
    }

    public function deleteAll(PublicMailbox $mailbox): int
    {
        return $mailbox->emails()->delete();
    }

    public function markUnread(PublicMailbox $mailbox, int $emailId): bool
    {
        return (bool) $mailbox->emails()->where('id', $emailId)->update(['is_read' => false]);
    }

    // ── Internals ────────────────────────────────────────────────────

    private function resolveDomain(?string $preferDomain): EmailDomain
    {
        if ($preferDomain) {
            $domain = EmailDomain::active()->where('domain', $preferDomain)->first();
            if ($domain) return $domain;
        }

        // Default: first active free domain
        return EmailDomain::active()->free()->orderBy('sort_order')->firstOrFail();
    }

    private function generateUniqueEmail(string $domain): string
    {
        $attempts = 0;

        do {
            $adj    = self::LOCAL_ADJECTIVES[array_rand(self::LOCAL_ADJECTIVES)];
            $noun   = self::LOCAL_NOUNS[array_rand(self::LOCAL_NOUNS)];
            $num    = random_int(1000, 9999);
            $local  = "{$adj}.{$noun}{$num}";
            $email  = "{$local}@{$domain}";
            $exists = PublicMailbox::where('email', $email)->exists();
            $attempts++;
        } while ($exists && $attempts < 20);

        if ($exists) {
            // Ultimate fallback: UUID prefix
            $email = Str::random(12) . "@{$domain}";
            Log::warning("MailboxService: collision fallback used for domain {$domain}");
        }

        return $email;
    }
}