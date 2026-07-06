<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Email;
use App\Models\EmailDomain;
use App\Models\UserDomain;
use DomainException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InboxController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $user = $request->user();

        $addresses = Address::where('user_id', $user->id)
            ->where('type', 'inbox')
            ->with(['emailDomain:id,name', 'emails' => function ($q) {
                $q->latest('received_at')->limit(50);
            }])
            ->latest()
            ->get();

        $data = $addresses->map(function (Address $addr) {
            $emails = $addr->emails->map(function (Email $email) {
                return [
                    'id' => $email->id,
                    'sender' => $email->from_name ?: explode('@', $email->from_email)[0],
                    'email' => $email->from_email,
                    'avatar' => strtoupper(substr($email->from_name ?: $email->from_email, 0, 1)),
                    'color' => $this->avatarColor($email->from_email),
                    'time' => $email->received_at?->diffForHumans() ?? 'just now',
                    'subject' => $email->subject ?? '(no subject)',
                    'body' => $email->html_body ?: ($email->text_body ? '<pre>' . e($email->text_body) . '</pre>' : ''),
                    'unread' => !$email->is_read,
                    'starred' => $email->is_starred,
                ];
            });

            $totalCount = $addr->emails()->count();
            $unreadCount = $addr->emails()->where('is_read', false)->count();

            return [
                'id' => $addr->id,
                'address' => $addr->email,
                'domain' => $addr->emailDomain?->name ?? 'unknown',
                'timerSecs' => $addr->expires_at ? max(0, $addr->expires_at->getTimestamp() - now()->getTimestamp()) : 999999,
                'timerMaxSecs' => $addr->expires_at ? max(0, $addr->expires_at->getTimestamp() - $addr->created_at->getTimestamp()) : 999999,
                'emails' => $emails,
                'totalEmails' => $totalCount,
                'unreadCount' => $unreadCount,
                'currentMailId' => $emails->first()?->id ?? null,
                'created_at_raw' => $addr->created_at->toISOString(),
            ];
        });

        $subscription = $user->subscriptions()->active()->first();
        $plan = $subscription?->plan;
        $maxAddresses = $plan ? $plan->max_addresses : 1;

        return response()->json([
            'inboxes' => $data,
            'max_addresses' => $maxAddresses,
            'is_pro' => $plan && $plan->slug === 'pro',
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $user = $request->user();

        $validated = $request->validate([
            'email_domain_id' => 'required|exists:email_domains,id',
            'expires_in' => 'required|integer|min:60',
        ]);

        $subscription = $user->subscriptions()->active()->first();
        $plan = $subscription?->plan;
        $isPro = $plan && $plan->slug === 'pro';
        $maxAddresses = $plan ? $plan->max_addresses : 1;

        $currentCount = Address::where('user_id', $user->id)
            ->where('type', 'inbox')
            ->count();

        if ($maxAddresses !== -1 && $currentCount >= $maxAddresses) {
            return response()->json([
                'error' => "Your plan allows up to {$maxAddresses} inbox(es). Please upgrade to create more.",
            ], 403);
        }

        $userDomain = UserDomain::where('user_id', $user->id)
            ->where('email_domain_id', $validated['email_domain_id'])
            ->first();

        if (!$userDomain) {
            return response()->json(['error' => 'You do not have access to this domain.'], 403);
        }

        $domain = EmailDomain::findOrFail($validated['email_domain_id']);

        if (!$isPro && $domain->type !== 'free') {
            return response()->json(['error' => 'Your plan does not support this domain.'], 403);
        }

        $localPart = $this->generateLocalPart();
        $email = $localPart . '@' . $domain->name;

        $attempts = 0;
        while (Address::where('email', $email)->exists() && $attempts < 20) {
            $localPart = $this->generateLocalPart();
            $email = $localPart . '@' . $domain->name;
            $attempts++;
        }

        if ($attempts >= 20) {
            return response()->json(['error' => 'Could not generate a unique email. Try again.'], 500);
        }

        $expiresAt = $validated['expires_in'] > 0
            ? now()->addSeconds($validated['expires_in'])
            : null;

        $address = DB::transaction(function () use ($user, $domain, $localPart, $email, $expiresAt) {
            return Address::create([
                'user_id' => $user->id,
                'email_domain_id' => $domain->id,
                'local_part' => $localPart,
                'email' => $email,
                'type' => 'inbox',
                'expires_at' => $expiresAt,
                'is_active' => true,
            ]);
        });

        return response()->json([
            'inbox' => [
                'id' => $address->id,
                'address' => $address->email,
                'domain' => $domain->name,
                'timerSecs' => $expiresAt ? max(0, $expiresAt->getTimestamp() - now()->getTimestamp()) : 999999,
                'timerMaxSecs' => $expiresAt ? max(0, $expiresAt->getTimestamp() - $address->created_at->getTimestamp()) : 999999,
                'emails' => [],
                'totalEmails' => 0,
                'unreadCount' => 0,
                'currentMailId' => null,
                'created_at_raw' => $address->created_at->toISOString(),
            ],
        ], 201);
    }

    public function destroy(Request $request, Address $address): JsonResponse
    {
        $user = $request->user();

        if ($address->user_id !== $user->id) {
            return response()->json(['error' => 'Unauthorized.'], 403);
        }

        $count = Address::where('user_id', $user->id)
            ->where('type', 'inbox')
            ->count();

        if ($count <= 1) {
            return response()->json(['error' => 'Cannot delete the last inbox.'], 422);
        }

        $address->delete();

        return response()->json(['success' => true]);
    }

    public function domains(Request $request): JsonResponse
    {
        $user = $request->user();

        $userDomains = UserDomain::where('user_id', $user->id)
            ->where('status', 'active')
            ->with('emailDomain:id,name,type,display_name')
            ->get();

        $subscription = $user->subscriptions()->active()->first();
        $plan = $subscription?->plan;
        $isPro = $plan && $plan->slug === 'pro';

        $data = $userDomains->map(function (UserDomain $ud) use ($isPro) {
            $domain = $ud->emailDomain;
            return [
                'id' => $domain->id,
                'name' => $domain->name,
                'display_name' => $domain->display_name ?? $domain->name,
                'type' => $domain->type,
                'can_select' => $isPro || $domain->type === 'free',
            ];
        });

        return response()->json(['domains' => $data]);
    }

    public function extend(Request $request, Address $address): JsonResponse
    {
        $user = $request->user();

        if ($address->user_id !== $user->id) {
            return response()->json(['error' => 'Unauthorized.'], 403);
        }

        if ($address->expires_at === null) {
            return response()->json(['error' => 'This inbox never expires.'], 422);
        }

        $validated = $request->validate([
            'duration' => 'required|integer|min:60',
        ]);

        $duration = (int) $validated['duration'];

        $subscription = $user->subscriptions()->active()->first();
        $plan = $subscription?->plan;
        $isPro = $plan && $plan->slug === 'pro';

        $freeDurations = [600, 1800, 3600, 21600];
        $proDurations = [600, 1800, 3600, 21600, 43200, 86400, 604800, 2592000];

        $allowed = $isPro ? $proDurations : $freeDurations;

        if (!in_array($duration, $allowed, true)) {
            return response()->json(['error' => 'Invalid duration selected.'], 422);
        }

        $createdAt = $address->created_at;
        $currentExpiresAt = $address->expires_at;

        $maxExpiresAt = $isPro ? null : (clone $createdAt)->addHours(24);

        $baseTime = $currentExpiresAt && $currentExpiresAt->isFuture() ? clone $currentExpiresAt : now();
        $newExpiresAt = (clone $baseTime)->addSeconds($duration);

        if ($maxExpiresAt && $newExpiresAt->gt($maxExpiresAt)) {
            if ($currentExpiresAt && $currentExpiresAt->gte($maxExpiresAt)) {
                return response()->json([
                    'error' => 'Maximum expiration time reached for your plan. Upgrade to Pro for longer durations.',
                ], 422);
            }
            $newExpiresAt = clone $maxExpiresAt;
        }

        $address->expires_at = $newExpiresAt;
        $address->save();

        $timerSecs = max(0, $newExpiresAt->getTimestamp() - now()->getTimestamp());
        $timerMaxSecs = max(0, $newExpiresAt->getTimestamp() - $createdAt->getTimestamp());

        return response()->json([
            'success' => true,
            'expires_at' => $newExpiresAt->toDateTimeString(),
            'timerSecs' => $timerSecs,
            'timerMaxSecs' => $timerMaxSecs,
            'formatted_expires' => $newExpiresAt->format('g:i A') . ' · ' . $newExpiresAt->format('M j, Y'),
        ]);
    }

    private function generateLocalPart(): string
    {
        $adjectives = ['silent', 'ghost', 'turbo', 'vapor', 'swift', 'lunar', 'neon', 'flux'];
        $nouns = ['fox', 'wolf', 'tide', 'bolt', 'hawk', 'mint', 'storm', 'byte'];
        $adj = $adjectives[array_rand($adjectives)];
        $nou = $nouns[array_rand($nouns)];
        $num = random_int(1000, 9999);
        return "{$adj}.{$nou}{$num}";
    }

    private function avatarColor(string $email): string
    {
        $colors = ['#4285F4', '#7C3AED', '#10B981', '#F59E0B', '#EF4444', '#EC4899', '#14B8A6', '#F97316'];
        return $colors[crc32($email) % count($colors)];
    }
}
