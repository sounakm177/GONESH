<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\MailboxService;
use App\Models\SeoPage;
use App\Models\EmailDomain;



class SeoController extends Controller
{

    public function __construct(
        private readonly MailboxService $mailboxService,
    ) {}

    private function getCommonData(Request $request)
    {
        $sessionId = $this->getSessionId($request);
        $mailbox   = $this->mailboxService->resolveForSession($sessionId);

        $domains = EmailDomain::cachedActive();

        $inbox = $this->mailboxService->getInbox($mailbox, perPage: 10);

        return compact('domains', 'mailbox', 'inbox');
    }

    private function getSessionId(Request $request): string
    {
        return hash('sha256', $request->session()->getId());
    }

    public function show($slug, Request $request)
    {
        $page = SeoPage::where('slug', $slug)
                       ->where('is_active', true)
                       ->firstOrFail();

        $data = $this->getCommonData($request);
        $data['seo_page'] = $page;

        
        return view('inboxoro.seo-template', $data);
    }
}
