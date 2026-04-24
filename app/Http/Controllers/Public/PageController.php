<?php

namespace App\Http\Controllers\public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function about()
    {
        $schema = [
            "@context" => "https://schema.org",
            "@graph" => [

                [
                    "@type" => "Organization",
                    "name" => "InboxOro",
                    "url" => url('/'),
                    "logo" => [
                        "@type" => "ImageObject",
                        "url" => asset('images/logo.svg'),
                        "width" => 512,
                        "height" => 512
                    ]
                ],

                [
                    "@type" => "WebPage",
                    "name" => "About InboxOro",
                    "url" => url()->current(),
                    "description" => "Learn about InboxOro temporary email service, how it works, and how it helps protect your privacy and reduce spam.",
                    "isPartOf" => [
                        "@type" => "WebSite",
                        "url" => url('/')
                    ]
                ]

            ]
        ];

        return view('inboxoro.about', compact('schema'));
    }

    public function contact()
    {
        $schema = [
            "@context" => "https://schema.org",
            "@graph" => [

                [
                    "@type" => "Organization",
                    "name" => "InboxOro",
                    "url" => url('/'),
                    "logo" => [
                        "@type" => "ImageObject",
                        "url" => asset('images/logo.png'),
                        "width" => 512,
                        "height" => 512
                    ],
                    "contactPoint" => [
                        [
                            "@type" => "ContactPoint",
                            "contactType" => "customer support",
                            "email" => "support@inboxoro.com",
                            "availableLanguage" => ["English"]
                        ]
                    ]
                ],

                [
                    "@type" => "ContactPage",
                    "name" => "Contact InboxOro",
                    "url" => url()->current(),
                    "description" => "Contact InboxOro for support, questions, or help with temporary email and privacy tools.",
                    "isPartOf" => [
                        "@type" => "WebSite",
                        "url" => url('/')
                    ]
                ]

            ]
        ];

        return view('inboxoro.contact', compact('schema'));
    }

    public function privacy()
    {
        $schema = [
            "@context" => "https://schema.org",
            "@graph" => [

                [
                    "@type" => "Organization",
                    "@id" => url('/') . "#organization",
                    "name" => "InboxOro",
                    "url" => url('/'),
                    "logo" => [
                        "@type" => "ImageObject",
                        "url" => asset('images/logo.png'),
                        "width" => 512,
                        "height" => 512
                    ],
                    "sameAs" => [],
                    "contactPoint" => [
                        [
                            "@type" => "ContactPoint",
                            "contactType" => "customer support",
                            "email" => "support@inboxoro.com",
                            "availableLanguage" => ["en"]
                        ]
                    ]
                ],

                [
                    "@type" => "WebSite",
                    "@id" => url('/') . "#website",
                    "url" => url('/'),
                    "name" => "InboxOro",
                    "publisher" => [
                        "@id" => url('/') . "#organization"
                    ]
                ],

                [
                    "@type" => "WebPage",
                    "@id" => url()->current() . "#webpage",
                    "url" => url()->current(),
                    "name" => "Privacy Policy – InboxOro",
                    "description" => "Learn how InboxOro handles temporary email data, privacy protection, email retention, and user security.",
                    "isPartOf" => [
                        "@id" => url('/') . "#website"
                    ],
                    "about" => [
                        "@id" => url('/') . "#organization"
                    ],
                    "inLanguage" => "en",
                    "dateModified" => now()->toAtomString()
                ]

            ]
        ];

        return view('inboxoro.privacy-policy', compact('schema'));
    }

    public function terms()
    {
        $schema = [
            "@context" => "https://schema.org",
            "@type" => "WebPage",
            "name" => "Terms of Service – InboxOro",
            "url" => url()->current(),
            "description" => "Terms of Service for InboxOro temporary email service.",
            "publisher" => [
                "@type" => "Organization",
                "name" => "InboxOro",
                "logo" => [
                    "@type" => "ImageObject",
                    "url" => asset("images/logo.png"),
                    "width" => 512,
                    "height" => 512
                ]
            ]
        ];

        return view('inboxoro.terms-service', compact('schema'));
    }

}
