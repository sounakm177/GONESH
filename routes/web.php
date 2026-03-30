<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Public\PublicMailboxController;
use App\Http\Controllers\Public\PublicEmailController;
// use App\Http\Controllers\AttachmentController;
use App\Http\Controllers\MailboxController;
use App\Events\NewEmailReceived;
use App\Models\PublicEmail;
use App\Models\PublicMailbox;
use Illuminate\Http\Request;

Route::get('/', [MailboxController::class, 'index'])->name('home');
Route::view('/privacy-policy', 'inboxoro.privacy-policy');
Route::view('/terms', 'inboxoro.terms-service');

// ── Mailbox AJAX (all require session) ───────────────────────────────────────
Route::middleware(['web', 'throttle:60,1'])->prefix('mailbox')->name('mailbox.')->group(function () {

    // Generate new address
    Route::post('generate',      [MailboxController::class, 'generate'])->name('generate');

    // Inbox list (polling fallback + initial load)
    Route::get('inbox',          [MailboxController::class, 'inbox'])->name('inbox');

    // Single email detail (marks as read)
    Route::get('email/{id}',     [MailboxController::class, 'show'])->name('email.show')
        ->whereNumber('id');

    // Delete single email
    Route::delete('email/{id}',  [MailboxController::class, 'destroy'])->name('email.destroy')
        ->whereNumber('id');

    // Mark single email unread
    Route::patch('email/{id}/unread', [MailboxController::class, 'markUnread'])->name('email.unread')
        ->whereNumber('id');

    // Mark all read
    Route::post('mark-all-read', [MailboxController::class, 'markAllRead'])->name('markAllRead');

    // Delete all emails
    Route::delete('all',         [MailboxController::class, 'destroyAll'])->name('destroyAll');
});

// ── Attachment download ───────────────────────────────────────────────────────
// Route::get('attachment/{attachment}/download', [AttachmentController::class, 'download'])
//     ->name('attachment.download')
//     ->whereNumber('attachment')
//     ->middleware(['web', 'throttle:30,1']);

/////

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

// require __DIR__.'/auth.php';


if (app()->environment('local')) {

    Route::get('/test/send-email', function (Request $request) {
        $sessionId = "5e19422701aef63964ed6690c3280174d615095384ddd405d834070ad5343770";

        $mailbox = PublicMailbox::latest()
            ->firstOrFail();

        $email = PublicEmail::create([
            'mailbox_id'   => $mailbox->id,
            'sender'       => '"GitHub" <noreply@github.com>',
            'subject'      => 'Test Email — OTP: ' . rand(100000, 999999),
            'body'         => '<p>Hello! Your OTP is: <span style="font-size:2rem;font-weight:bold;background:#FACC15;padding:8px 16px;">' . rand(100000, 999999) . '</span></p>',
            'content_type' => 'text/html',
            'is_read'      => false,
            'received_at'  => now(),
        ]);


        NewEmailReceived::dispatch($email, $mailbox);

        return response()->json([
            'ok'      => true,
            'to'      => $mailbox->email,
            'subject' => $email->subject,
        ]);
    });

    Route::get('/test/send-emails', function (Request $request) {
        // $sessionId = hash('sha256', $request->session()->getId());
        $mailbox   = PublicMailbox::latest()->firstOrFail();

        $senders = [
            '"Google" <no-reply@accounts.google.com>',
            '"Shopify" <otp@shopify.com>',
            '"GitHub" <noreply@github.com>',
            '"Stripe" <support@stripe.com>',
            '"Notion" <hello@notion.so>',
        ];
        $subjects = [
            'Verify your account — OTP: ' . rand(100000, 999999),
            'Your one-time password: '    . rand(100000, 999999),
            'Welcome! Confirm your email',
            'Your payout of $'            . rand(10, 500) . ' is on its way',
            'A file has been shared with you',
        ];

        $sent = [];
        for ($i = 0; $i < min(5, 10); $i++) {
            $email = PublicEmail::create([
                'mailbox_id'   => $mailbox->id,
                'sender'       => $senders[array_rand($senders)],
                'subject'      => $subjects[array_rand($subjects)],
                'body'         => '<p>Test email #' . ($i + 1) . '. Lorem ipsum content here.</p>',
                'content_type' => 'text/html',
                'is_read'      => false,
                'received_at'  => now()->subSeconds($i * 15),
            ]);
            NewEmailReceived::dispatch($email, $mailbox);
            $sent[] = $email->subject;
        }

        return response()->json([
            'ok'   => true,
            'to'   => $mailbox->email,
            'sent' => count($sent),
            'subjects' => $sent,
        ]);
    });

}



















// ───────────────────────────────────────────────────────────────────────────────
// routes/api.php  (place this block there, or add to web.php if you prefer)
// ───────────────────────────────────────────────────────────────────────────────
// Inbound webhook — excluded from CSRF, uses secret header auth instead
// Route::post('inbound/email', [InboundEmailController::class, 'receive'])
//     ->name('inbound.email')
//     ->middleware('throttle:200,1');
//
// Add to App\Http\Middleware\VerifyCsrfToken::$except:
//   'inbound/email'