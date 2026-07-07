<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\EmailDomain;
use App\Models\UserDomain;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DomainController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $user = $request->user();

        $subscription = $user->subscriptions()->active()->first();
        $plan = $subscription?->plan;
        $isPro = $plan && $plan->slug === 'pro';
        $maxAddresses = $plan ? $plan->max_addresses : 0;

        $selectedIds = $user->userDomains()->active()->pluck('email_domain_id')->toArray();

        $domains = EmailDomain::active()
            ->orderBy('priority')
            ->get()
            ->map(function (EmailDomain $domain) use ($selectedIds, $isPro) {
                return [
                    'id' => $domain->id,
                    'name' => $domain->name,
                    'display_name' => $domain->display_name ?? $domain->name,
                    'type' => $domain->type,
                    'type_label' => $domain->type === 'free' ? 'Free' : 'Premium',
                    'desc' => $domain->isPro() ? 'High-reputation premium domain.' : 'Reliable domain accepted by most websites.',
                    'features' => $domain->features ?? [
                        'email' => true, 'alias' => true, 'otp' => false,
                        'attachments' => false, 'autoDelete' => true, 'fastDelivery' => true,
                    ],
                    'acceptance' => $domain->acceptance ?: 4,
                    'best_for' => $domain->best_for ?? [],
                    'restrictions' => $domain->restrictions ?? '',
                    'popular' => $domain->popular ?? false,
                    'exclusive' => $domain->exclusive ?? false,
                    'is_selected' => in_array($domain->id, $selectedIds),
                    'can_select' => $isPro || $domain->type === 'free',
                ];
            });

        $selectedCount = count($selectedIds);

        return response()->json([
            'domains' => $domains,
            'selected_ids' => $selectedIds,
            'selected_count' => $selectedCount,
            'max_addresses' => $maxAddresses,
            'is_pro' => $isPro,
        ]);
    }

    public function toggle(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'domain_id' => 'required|exists:email_domains,id',
        ]);

        $user = $request->user();
        $domainId = $validated['domain_id'];

        $domain = EmailDomain::findOrFail($domainId);

        $subscription = $user->subscriptions()->active()->first();
        $plan = $subscription?->plan;
        $isPro = $plan && $plan->slug === 'pro';
        $maxAddresses = $plan ? $plan->max_addresses : 0;

        if (!$isPro && $domain->type !== 'free') {
            return response()->json(['error' => 'Your plan does not allow selecting this domain.'], 403);
        }

        $existing = $user->userDomains()->where('email_domain_id', $domainId)->first();

        if ($existing && $existing->status === 'active') {
            $inboxCount = Address::where('user_id', $user->id)
                ->where('email_domain_id', $domainId)
                ->where('type', 'inbox')
                ->count();

            if ($inboxCount > 0) {
                return response()->json([
                    'error' => 'Cannot deselect "' . $domain->name . '". You have ' . $inboxCount . ' inbox(es) using this domain. Delete them first.',
                ], 409);
            }

            $existing->update(['status' => 'inactive']);

            return response()->json([
                'selected' => false,
                'message' => 'Deselected @' . $domain->name,
            ]);
        }

        $currentActive = $user->userDomains()->active()->count();

        if ($maxAddresses !== -1 && $currentActive >= $maxAddresses) {
            return response()->json([
                'error' => 'Your plan allows up to ' . $maxAddresses . ' active domain(s).',
            ], 403);
        }

        if ($existing) {
            $existing->update(['status' => 'active']);
        } else {
            $user->userDomains()->create([
                'email_domain_id' => $domainId,
                'status' => 'active',
                'is_default' => $currentActive === 0,
            ]);
        }

        return response()->json([
            'selected' => true,
            'message' => 'Selected @' . $domain->name,
        ]);
    }
}
