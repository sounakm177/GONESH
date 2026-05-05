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

        $data['popular'] = SeoPage::where('category', $page->category)->inRandomOrder()->limit(12)->get();
 
        $data['seo_page'] = $page;
        
        $schema =$schema = [
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
                    "description" => "Free temporary email generator to receive OTPs, avoid spam, and protect your privacy.",
                    "inLanguage" => "en",
                    "publisher" => [
                        "@type" => "Organization",
                        "name" => "Inboxoro"
                    ]
                ],
                [
                    "@type" => "WebPage",
                    "name" => $page->title ?? config('app.name'),
                    "url" => url()->current(),
                    "description" => $page->meta_description ?? '',
                    "inLanguage" => "en",
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
                    "description" => "Disposable email generator for receiving OTPs and avoiding spam.",
                    "offers" => [
                        "@type" => "Offer",
                        "price" => "0",
                        "priceCurrency" => "USD"
                    ]
                ],
            ]
        ];

        $faq = json_decode($page->faq);
        if (!empty($faq)) {

            $faqSchema = [
                "@type" => "FAQPage",
                "mainEntity" => []
            ];

            foreach ($faq as $f) {
                $faqSchema["mainEntity"][] = [
                    "@type" => "Question",
                    "name" => $f->question ?? '',
                    "acceptedAnswer" => [
                        "@type" => "Answer",
                        "text" => $f->answer ?? ''
                    ]
                ];
            }

            $schema['@graph'][] = $faqSchema;
        }

        $data['schema'] = $schema;
        
        return view('inboxoro.seo-template', $data);
    }

    //  public function show($slug, Request $request)
    // {
    //     $page = SeoPage::where('slug', $slug)
    //                    ->where('is_active', true)
    //                    ->firstOrFail();

    //     $data = $this->getCommonData($request);
    //     $data['seo_page'] = $page;

    //     $schema =$schema = [
    //         "@context" => "https://schema.org",
    //         "@graph" => [
    //             [
    //                 "@type" => "Organization",
    //                 "name" => "Inboxoro",
    //                 "url" => url('/'),
    //                 "logo" => [
    //                     "@type" => "ImageObject",
    //                     "url" => asset('images/logo.svg')
    //                 ]
    //             ],
    //             [
    //                 "@type" => "WebSite",
    //                 "name" => "Inboxoro",
    //                 "url" => url('/'),
    //                 "description" => "Free temporary email generator to receive OTPs, avoid spam, and protect your privacy.",
    //                 "inLanguage" => "en",
    //                 "publisher" => [
    //                     "@type" => "Organization",
    //                     "name" => "Inboxoro"
    //                 ]
    //             ],
    //             [
    //                 "@type" => "WebPage",
    //                 "name" => $page->title ?? config('app.name'),
    //                 "url" => url()->current(),
    //                 "description" => $page->meta_description ?? '',
    //                 "inLanguage" => "en",
    //                 "isPartOf" => [
    //                     "@type" => "WebSite",
    //                     "url" => url('/')
    //                 ]
    //             ],
    //             [
    //                 "@type" => "SoftwareApplication",
    //                 "name" => "Inboxoro Temporary Email",
    //                 "applicationCategory" => "UtilitiesApplication",
    //                 "operatingSystem" => "Web",
    //                 "url" => url('/'),
    //                 "description" => "Disposable email generator for receiving OTPs and avoiding spam.",
    //                 "offers" => [
    //                     "@type" => "Offer",
    //                     "price" => "0",
    //                     "priceCurrency" => "USD"
    //                 ]
    //             ],
    //         ]
    //     ];

    //     $faq = json_decode($page->faq);
    //     if (!empty($faq)) {

    //         $faqSchema = [
    //             "@type" => "FAQPage",
    //             "mainEntity" => []
    //         ];

    //         foreach ($faq as $f) {
    //             $faqSchema["mainEntity"][] = [
    //                 "@type" => "Question",
    //                 "name" => $f->question ?? '',
    //                 "acceptedAnswer" => [
    //                     "@type" => "Answer",
    //                     "text" => $f->answer ?? ''
    //                 ]
    //             ];
    //         }

    //         $schema['@graph'][] = $faqSchema;
    //     }
        
    //     return view('inboxoro.seo-template', compact('data','schema'));
    // }
}
