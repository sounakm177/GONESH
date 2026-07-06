<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Alias;
use App\Models\AliasLog;
use App\Models\EmailDomain;
use App\Models\PublicMailbox;
use App\Models\UserDomain;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AliasController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $user = $request->user();

        $aliases = Alias::where('user_id', $user->id)
            ->with('emailDomain:id,name')
            ->latest()
            ->get();

        $data = $aliases->map(function (Alias $alias) {
            $domain = $alias->emailDomain?->name ?? 'unknown';
            return [
                'id' => $alias->id,
                'email' => $alias->email,
                'local_part' => $alias->local_part,
                'domain' => $domain,
                'forward_to' => $alias->forward_to,
                'description' => $alias->description,
                'is_enabled' => $alias->is_enabled,
                'is_favorite' => $alias->is_favorite,
                'total_received' => $alias->total_received,
                'total_forwarded' => $alias->total_forwarded,
                'last_received_at' => $alias->last_received_at?->diffForHumans(),
                'created_at' => $alias->created_at?->toDateString(),
                'color' => $this->avatarColor($alias->email),
                'avatar' => strtoupper(substr($alias->local_part, 0, 2)),
            ];
        });

        $subscription = $user->subscriptions()->active()->first();
        $plan = $subscription?->plan;
        $maxAliases = $plan ? $plan->max_aliases : 0;

        return response()->json([
            'aliases' => $data,
            'max_aliases' => $maxAliases,
            'is_pro' => $plan && $plan->slug === 'pro',
            'total' => $aliases->count(),
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $user = $request->user();

        $validated = $request->validate([
            'email_domain_id' => 'required|exists:email_domains,id',
            'local_part' => 'required|string|max:64|regex:/^[a-z0-9._-]+$/',
            'forward_to' => 'nullable|email|max:255',
            'description' => 'nullable|string|max:255',
        ]);

        $subscription = $user->subscriptions()->active()->first();
        $plan = $subscription?->plan;
        $maxAliases = $plan ? $plan->max_aliases : 0;

        if ($maxAliases !== -1) {
            $currentCount = Alias::where('user_id', $user->id)->count();
            if ($currentCount >= $maxAliases) {
                return response()->json([
                    'error' => "Your plan allows up to {$maxAliases} alias(es). Please upgrade to create more.",
                ], 403);
            }
        }

        $userDomain = UserDomain::where('user_id', $user->id)
            ->where('email_domain_id', $validated['email_domain_id'])
            ->where('status', 'active')
            ->first();

        if (!$userDomain) {
            return response()->json(['error' => 'You do not have access to this domain.'], 403);
        }

        $domain = EmailDomain::findOrFail($validated['email_domain_id']);

        if (!$plan || $plan->slug !== 'pro') {
            if ($domain->type !== 'free') {
                return response()->json(['error' => 'Your plan does not support this domain.'], 403);
            }
        }

        $localPart = $validated['local_part'];
        $email = $localPart . '@' . $domain->name;

        $existing = Alias::where('email', $email)->exists()
            || Address::where('email', $email)->exists()
            || PublicMailbox::where('email', $email)->exists();

        if ($existing) {
            return response()->json(['error' => 'This alias address is already taken.'], 422);
        }

        $alias = DB::transaction(function () use ($user, $domain, $localPart, $email, $validated) {
            return Alias::create([
                'user_id' => $user->id,
                'email_domain_id' => $domain->id,
                'local_part' => $localPart,
                'email' => $email,
                'forward_to' => $validated['forward_to'],
                'description' => $validated['description'],
                'is_enabled' => true,
            ]);
        });

        return response()->json([
            'alias' => [
                'id' => $alias->id,
                'email' => $alias->email,
                'local_part' => $alias->local_part,
                'domain' => $domain->name,
                'forward_to' => $alias->forward_to,
                'description' => $alias->description,
                'is_enabled' => $alias->is_enabled,
                'is_favorite' => $alias->is_favorite,
                'total_received' => 0,
                'total_forwarded' => 0,
                'last_received_at' => null,
                'created_at' => $alias->created_at?->toDateString(),
                'color' => $this->avatarColor($alias->email),
                'avatar' => strtoupper(substr($alias->local_part, 0, 2)),
                'logs' => [],
            ],
        ], 201);
    }

    public function show(Request $request, Alias $alias): JsonResponse
    {
        $user = $request->user();

        if ($alias->user_id !== $user->id) {
            return response()->json(['error' => 'Unauthorized.'], 403);
        }

        $alias->load('emailDomain:id,name');
        $logs = $alias->logs()->latest('created_at')->limit(50)->get();

        $domain = $alias->emailDomain?->name ?? 'unknown';

        return response()->json([
            'alias' => [
                'id' => $alias->id,
                'email' => $alias->email,
                'local_part' => $alias->local_part,
                'domain' => $domain,
                'forward_to' => $alias->forward_to,
                'description' => $alias->description,
                'is_enabled' => $alias->is_enabled,
                'is_favorite' => $alias->is_favorite,
                'total_received' => $alias->total_received,
                'total_forwarded' => $alias->total_forwarded,
                'last_received_at' => $alias->last_received_at?->diffForHumans(),
                'created_at' => $alias->created_at?->toDateString(),
                'updated_at' => $alias->updated_at?->diffForHumans(),
                'color' => $this->avatarColor($alias->email),
                'avatar' => strtoupper(substr($alias->local_part, 0, 2)),
                'logs' => $logs->map(function (AliasLog $log) {
                    return [
                        'id' => $log->id,
                        'sender_email' => $log->sender_email,
                        'subject' => $log->subject,
                        'status' => $log->status,
                        'created_at' => $log->created_at?->diffForHumans(),
                        'created_at_raw' => $log->created_at?->toDateTimeString(),
                    ];
                }),
            ],
        ]);
    }

    public function update(Request $request, Alias $alias): JsonResponse
    {
        $user = $request->user();

        if ($alias->user_id !== $user->id) {
            return response()->json(['error' => 'Unauthorized.'], 403);
        }

        $validated = $request->validate([
            'forward_to' => 'nullable|email|max:255',
            'description' => 'nullable|string|max:255',
            'is_enabled' => 'boolean',
            'is_favorite' => 'boolean',
        ]);

        $alias->update($validated);

        return response()->json([
            'success' => true,
            'alias' => [
                'id' => $alias->id,
                'forward_to' => $alias->forward_to,
                'description' => $alias->description,
                'is_enabled' => $alias->is_enabled,
                'is_favorite' => $alias->is_favorite,
            ],
        ]);
    }

    public function destroy(Request $request, Alias $alias): JsonResponse
    {
        $user = $request->user();

        if ($alias->user_id !== $user->id) {
            return response()->json(['error' => 'Unauthorized.'], 403);
        }

        $alias->delete();

        return response()->json(['success' => true]);
    }

    public function toggleStatus(Request $request, Alias $alias): JsonResponse
    {
        $user = $request->user();

        if ($alias->user_id !== $user->id) {
            return response()->json(['error' => 'Unauthorized.'], 403);
        }

        $alias->update(['is_enabled' => !$alias->is_enabled]);

        return response()->json([
            'success' => true,
            'is_enabled' => $alias->is_enabled,
        ]);
    }

    public function toggleFavorite(Request $request, Alias $alias): JsonResponse
    {
        $user = $request->user();

        if ($alias->user_id !== $user->id) {
            return response()->json(['error' => 'Unauthorized.'], 403);
        }

        $alias->update(['is_favorite' => !$alias->is_favorite]);

        return response()->json([
            'success' => true,
            'is_favorite' => $alias->is_favorite,
        ]);
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

    public function logs(Request $request, Alias $alias): JsonResponse
    {
        $user = $request->user();

        if ($alias->user_id !== $user->id) {
            return response()->json(['error' => 'Unauthorized.'], 403);
        }

        $query = $alias->logs()->latest('created_at');

        if ($status = $request->input('status')) {
            $query->where('status', $status);
        }

        $perPage = (int) $request->input('per_page', 20);
        $perPage = min(max($perPage, 1), 100);

        $logs = $query->paginate($perPage);

        return response()->json([
            'logs' => $logs->map(function (AliasLog $log) {
                return [
                    'id' => $log->id,
                    'sender_email' => $log->sender_email,
                    'subject' => $log->subject,
                    'status' => $log->status,
                    'created_at' => $log->created_at?->diffForHumans(),
                    'created_at_raw' => $log->created_at?->toDateTimeString(),
                ];
            }),
            'page' => $logs->currentPage(),
            'last_page' => $logs->lastPage(),
            'has_more' => $logs->currentPage() < $logs->lastPage(),
            'total' => $logs->total(),
        ]);
    }

    private function avatarColor(string $email): string
    {
        $colors = ['#4285F4', '#7C3AED', '#10B981', '#F59E0B', '#EF4444', '#EC4899', '#14B8A6', '#F97316'];
        return $colors[crc32($email) % count($colors)];
    }
}
