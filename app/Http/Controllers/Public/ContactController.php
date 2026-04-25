<?php

namespace App\Http\Controllers\public;

use App\Http\Requests\StoreContactRequest;
use App\Http\Controllers\Controller;
use App\Mail\ContactConfirmationMail;
use App\Models\ContactMessage;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;
 
class ContactController extends Controller
{

    public function index(): View
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
 
    public function store(StoreContactRequest $request): JsonResponse|RedirectResponse
    {
        $contact = ContactMessage::create([
            'name'       => $request->validated('name'),
            'email'      => $request->validated('email'),
            'subject'    => $request->validated('subject'),
            'message'    => $request->validated('message'),
            'status'     => 'new',
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);
 
        try {
            // Mail::to($contact->email)
            //     ->queue(new ContactConfirmationMail($contact));
        } catch (\Throwable $e) {
            Log::warning('Contact confirmation mail failed', [
                'contact_id' => $contact->id,
                'error'      => $e->getMessage(),
            ]);
        }
 
        $adminEmail = config('mail.contact_admin', config('mail.from.address'));
        try {
            // Mail::to($adminEmail)
            //     ->queue(new \App\Mail\ContactAdminNotificationMail($contact));
        } catch (\Throwable $e) {
            Log::warning('Contact admin notification mail failed', [
                'contact_id' => $contact->id,
                'error'      => $e->getMessage(),
            ]);
        }
 
        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Your message has been received. We\'ll respond within 1–2 business days.',
            ], 201);
        }
 
        return redirect()
            ->route('contact.index')
            ->with('success', 'Your message has been sent. We\'ll be in touch soon.');
    }
 
    public function updateStatus(Request $request, ContactMessage $message): JsonResponse
    {
        $request->validate([
            'status' => ['required', 'string', 'in:' . implode(',', ContactMessage::STATUSES)],
        ]);
 
        $message->update(['status' => $request->status]);
 
        if ($request->status === 'replied') {
            $message->update(['replied_at' => now()]);
        }
 
        return response()->json([
            'message' => 'Status updated.',
            'status'  => $message->status,
        ]);
    }
}