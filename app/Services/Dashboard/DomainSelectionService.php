<?php

namespace App\Services\Dashboard;

use App\Models\EmailDomain;
use App\Models\User;
use App\Models\UserDomain;
use DomainException;
use Illuminate\Support\Collection;

class DomainSelectionService
{
    public function needsDomainSelection(User $user): bool
    {
        return !$user->userDomains()->exists();
    }

    public function getAvailableDomains(User $user): array
    {
        $subscription = $user->subscriptions()->active()->first();
        $plan = $subscription?->plan;
        $isPro = $plan && $plan->slug === 'pro';
        $maxDomains = $plan ? $plan->max_domains : 0;

        $domains = EmailDomain::active()
            ->orderBy('type')
            ->orderBy('name')
            ->get()
            ->map(function (EmailDomain $domain) use ($isPro) {
                return [
                    'id' => $domain->id,
                    'name' => $domain->name,
                    'display_name' => $domain->display_name ?? $domain->name,
                    'type' => $domain->type,
                    'plan_badge' => $domain->type === 'free' ? 'Free' : 'Pro',
                    'can_select' => $isPro || $domain->type === 'free',
                ];
            });

        return [
            'domains' => $domains,
            'max_domains' => $maxDomains,
            'total_selected' => $user->userDomains()->count(),
        ];
    }

    public function saveDomains(User $user, array $emailDomainIds): Collection
    {
        $subscription = $user->subscriptions()->active()->first();
        $plan = $subscription?->plan;
        $isPro = $plan && $plan->slug === 'pro';
        $maxDomains = $plan ? $plan->max_domains : 0;

        $currentCount = $user->userDomains()->count();

        if ($maxDomains !== -1 && ($currentCount + count($emailDomainIds)) > $maxDomains) {
            throw new DomainException("You can select up to {$maxDomains} domain(s).");
        }

        $domains = EmailDomain::whereIn('id', $emailDomainIds)->get();

        foreach ($domains as $domain) {
            if (!$isPro && $domain->type !== 'free') {
                throw new DomainException("Your plan does not allow selecting \"{$domain->name}\".");
            }
        }

        $isFirst = $currentCount === 0;

        $created = new Collection();
        foreach ($emailDomainIds as $i => $id) {
            $domain = $domains->firstWhere('id', $id);
            if (!$domain) continue;

            $userDomain = $user->userDomains()->firstOrCreate(
                ['email_domain_id' => $domain->id],
                [
                    'is_default' => $isFirst && $i === 0,
                    'status' => 'active',
                ]
            );

            $created->push($userDomain);
        }

        return $created;
    }
}
