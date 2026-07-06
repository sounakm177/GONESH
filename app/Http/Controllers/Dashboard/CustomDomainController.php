<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\CustomDomain;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class CustomDomainController extends Controller
{
    private function getPlanInfo($user): array
    {
        $subscription = $user->subscriptions()->active()->first();
        $plan = $subscription?->plan;
        return [
            'is_pro' => $plan && $plan->slug === 'pro',
            'max_domains' => $plan ? $plan->max_domains : 0,
            'plan' => $plan,
        ];
    }

    public function index(Request $request): JsonResponse
    {
        $user = $request->user();

        $domains = CustomDomain::where('user_id', $user->id)
            ->latest()
            ->get()
            ->map(function (CustomDomain $d) {
                return $this->formatDomain($d);
            });

        $planInfo = $this->getPlanInfo($user);

        $totalCustom = $domains->count();
        $verifiedCustom = $domains->filter(fn($d) => $d['verification_status'] === 'verified')->count();

        return response()->json([
            'domains' => $domains,
            'total' => $totalCustom,
            'verified' => $verifiedCustom,
            'max_domains' => $planInfo['max_domains'],
            'is_pro' => $planInfo['is_pro'],
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $user = $request->user();

        $planInfo = $this->getPlanInfo($user);

        $maxDomains = $planInfo['max_domains'];
        $currentCount = CustomDomain::where('user_id', $user->id)->count();

        if ($maxDomains !== -1 && $currentCount >= $maxDomains) {
            return response()->json([
                'error' => "Your plan allows up to {$maxDomains} custom domain(s).",
            ], 403);
        }

        $validated = $request->validate([
            'domain' => 'required|string|max:255|regex:/^([a-z0-9]([a-z0-9-]*[a-z0-9])?\.)+[a-z]{2,}$/i',
        ]);

        $domain = strtolower(trim($validated['domain']));

        $exists = CustomDomain::where('domain', $domain)->exists();
        if ($exists) {
            return response()->json(['error' => 'This domain has already been added.'], 422);
        }

        $records = $this->generateDnsRecords($domain);

        $customDomain = DB::transaction(function () use ($user, $domain, $records) {
            return CustomDomain::create([
                'user_id' => $user->id,
                'domain' => $domain,
                'verification_status' => 'pending',
                'mx_records' => $records['mx'],
                'spf_value' => $records['spf'],
                'dkim_value' => $records['dkim'],
                'txt_value' => $records['txt'],
            ]);
        });

        return response()->json([
            'domain' => $this->formatDomain($customDomain),
            'dns_records' => $records,
        ], 201);
    }

    public function show(Request $request, CustomDomain $customDomain): JsonResponse
    {
        $user = $request->user();

        if ($customDomain->user_id !== $user->id) {
            return response()->json(['error' => 'Unauthorized.'], 403);
        }

        return response()->json([
            'domain' => $this->formatDomain($customDomain),
            'dns_records' => [
                'mx' => $customDomain->mx_records,
                'spf' => $customDomain->spf_value,
                'dkim' => $customDomain->dkim_value,
                'txt' => $customDomain->txt_value,
            ],
        ]);
    }

    public function update(Request $request, CustomDomain $customDomain): JsonResponse
    {
        $user = $request->user();

        if ($customDomain->user_id !== $user->id) {
            return response()->json(['error' => 'Unauthorized.'], 403);
        }

        $validated = $request->validate([
            'domain' => 'sometimes|string|max:255|regex:/^([a-z0-9]([a-z0-9-]*[a-z0-9])?\.)+[a-z]{2,}$/i',
        ]);

        if (isset($validated['domain'])) {
            $newDomain = strtolower(trim($validated['domain']));
            $exists = CustomDomain::where('domain', $newDomain)
                ->where('id', '!=', $customDomain->id)
                ->exists();
            if ($exists) {
                return response()->json(['error' => 'This domain has already been added.'], 422);
            }
            $customDomain->domain = $newDomain;
            $customDomain->verification_status = 'pending';
            $records = $this->generateDnsRecords($newDomain);
            $customDomain->mx_records = $records['mx'];
            $customDomain->spf_value = $records['spf'];
            $customDomain->dkim_value = $records['dkim'];
            $customDomain->txt_value = $records['txt'];
        }

        $customDomain->save();

        return response()->json([
            'domain' => $this->formatDomain($customDomain),
        ]);
    }

    public function destroy(Request $request, CustomDomain $customDomain): JsonResponse
    {
        $user = $request->user();

        if ($customDomain->user_id !== $user->id) {
            return response()->json(['error' => 'Unauthorized.'], 403);
        }

        $customDomain->delete();

        return response()->json(['success' => true]);
    }

    public function verify(Request $request, CustomDomain $customDomain): JsonResponse
    {
        $user = $request->user();

        if ($customDomain->user_id !== $user->id) {
            return response()->json(['error' => 'Unauthorized.'], 403);
        }

        $results = $this->checkDnsRecords($customDomain->domain);

        $allVerified = $results['mx'] && $results['spf'] && $results['dkim'];
        $anyVerified = $results['mx'] || $results['spf'] || $results['dkim'];

        $customDomain->mx_verified = $results['mx'];
        $customDomain->spf_verified = $results['spf'];
        $customDomain->dkim_verified = $results['dkim'];
        $customDomain->txt_verified = $results['txt'];
        $customDomain->verification_status = $allVerified ? 'verified' : ($anyVerified ? 'pending' : 'failed');
        if ($allVerified) {
            $customDomain->verified_at = now();
        }
        $customDomain->save();

        return response()->json([
            'domain' => $this->formatDomain($customDomain),
            'dns_check' => $results,
        ]);
    }

    public function refreshStatus(Request $request, CustomDomain $customDomain): JsonResponse
    {
        return $this->verify($request, $customDomain);
    }

    public function select(Request $request, CustomDomain $customDomain): JsonResponse
    {
        $user = $request->user();

        if ($customDomain->user_id !== $user->id) {
            return response()->json(['error' => 'Unauthorized.'], 403);
        }

        if ($customDomain->verification_status !== 'verified') {
            return response()->json(['error' => 'Domain must be verified before it can be selected.'], 422);
        }

        DB::transaction(function () use ($user, $customDomain) {
            CustomDomain::where('user_id', $user->id)->update(['is_selected' => false]);
            $customDomain->is_selected = true;
            $customDomain->save();
        });

        return response()->json([
            'domain' => $this->formatDomain($customDomain),
        ]);
    }

    private function formatDomain(CustomDomain $d): array
    {
        return [
            'id' => $d->id,
            'domain' => $d->domain,
            'verification_status' => $d->verification_status,
            'mx_verified' => $d->mx_verified,
            'spf_verified' => $d->spf_verified,
            'dkim_verified' => $d->dkim_verified,
            'txt_verified' => $d->txt_verified,
            'is_active' => $d->is_active,
            'is_selected' => $d->is_selected,
            'verified_at' => $d->verified_at?->diffForHumans(),
            'verified_at_raw' => $d->verified_at?->toDateTimeString(),
            'created_at' => $d->created_at?->diffForHumans(),
            'created_at_raw' => $d->created_at?->toISOString(),
        ];
    }

    private function generateDnsRecords(string $domain): array
    {
        $dkimSelector = 'inboxoro';
        return [
            'mx' => "10 mail.{domain}",
            'spf' => "v=spf1 include:mail.inboxoro.app ~all",
            'dkim' => "v=DKIM1; k=rsa; p=MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQC..." . $dkimSelector . "._domainkey.{domain}",
            'txt' => "v=DMARC1; p=quarantine; rua=mailto:dmarc@inboxoro.app",
        ];
    }

    private function checkDnsRecords(string $domain): array
    {
        $results = ['mx' => false, 'spf' => false, 'dkim' => false, 'txt' => false];

        try {
            $mxRecords = dns_get_record($domain, DNS_MX);
            $results['mx'] = !empty($mxRecords);
        } catch (\Exception $e) {
            $results['mx'] = false;
        }

        try {
            $txtRecords = dns_get_record($domain, DNS_TXT);
            foreach ($txtRecords as $record) {
                $txt = $record['txt'] ?? '';
                if (stripos($txt, 'v=spf1') !== false) {
                    $results['spf'] = true;
                }
                if (stripos($txt, 'v=DKIM1') !== false || stripos($txt, 'dkim') !== false) {
                    $results['dkim'] = true;
                }
                if (stripos($txt, 'v=DMARC1') !== false) {
                    $results['txt'] = true;
                }
            }
        } catch (\Exception $e) {
            // DNS lookup failed
        }

        return $results;
    }
}
