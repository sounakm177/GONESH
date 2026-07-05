<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Services\Dashboard\DomainSelectionService;
use DomainException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DomainSelectionController extends Controller
{
    public function __construct(
        private readonly DomainSelectionService $domainSelectionService,
    ) {}

    public function available(Request $request): JsonResponse
    {
        $data = $this->domainSelectionService->getAvailableDomains($request->user());

        return response()->json($data);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'email_domain_ids' => 'required|array|min:1',
            'email_domain_ids.*' => 'required|exists:email_domains,id',
        ]);

        try {
            $this->domainSelectionService->saveDomains(
                $request->user(),
                $validated['email_domain_ids'],
            );

            return response()->json(['success' => true]);
        } catch (DomainException $e) {
            return response()->json(['error' => $e->getMessage()], 403);
        }
    }
}
