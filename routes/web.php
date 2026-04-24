<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Public\PublicMailboxController;
use App\Http\Controllers\Public\PublicEmailController;
use App\Http\Controllers\Public\SeoController;
use App\Http\Controllers\Public\BlogController;
use App\Http\Controllers\Public\PageController;

use App\Http\Controllers\MailboxController;
use App\Events\NewEmailReceived;
use App\Models\PublicEmail;
use App\Models\PublicMailbox;
use Illuminate\Http\Request;
use App\Models\SeoPage;
use Carbon\Carbon;
use App\Models\BlogPost;


Route::get('/sounak', function(){
    return view('dashboard');
});

Route::get('/', [MailboxController::class, 'index'])->name('home');
Route::get('/about',[PageController::class, 'about']);
Route::get('/contact',[PageController::class, 'contact']);
Route::get('/privacy-policy',[PageController::class, 'privacy']);
Route::get('/terms',[PageController::class, 'terms']);



Route::prefix('blog')->name('blog.')->group(function () {
 
    // ── Listing  /blog ───────────────────────────────────────────
    Route::get('/', [BlogController::class, 'index'])
         ->name('index');
 
    // ── Category shortcut  /blog/category/privacy ────────────────
    Route::get('/category/{slug}', [BlogController::class, 'category'])
         ->name('category')
         ->where('slug', '[a-z0-9\-]+');
 
    // ── Tag shortcut  /blog/tag/spam-protection ──────────────────
    Route::get('/tag/{slug}', [BlogController::class, 'tag'])
         ->name('tag')
         ->where('slug', '[a-z0-9\-]+');
 
    // ── Single post  /blog/{slug} ─────────────────────────────────
    // Must be last — catches everything that doesn't match above
    Route::get('/{slug}', [BlogController::class, 'show'])
         ->name('show')
         ->where('slug', '[a-z0-9\-]+');
 
});

Route::get('/sitemap.xml', function () {

    $urls = [];

    $staticPages = [
        ['loc' => url('/'), 'priority' => '1.0'],
        ['loc' => url('/blog'), 'priority' => '0.9'],
        ['loc' => url('/privacy-policy'), 'priority' => '0.5'],
        ['loc' => url('/terms'), 'priority' => '0.5'],
        ['loc' => url('/about'), 'priority' => '0.5'],
        ['loc' => url('/contact'), 'priority' => '0.5'],
    ];

    foreach ($staticPages as $page) {
        $urls[] = $page;
    }

    $seoPages = SeoPage::where('is_active', true)->get();

    foreach ($seoPages as $page) {
        $urls[] = [
            'loc' => url('/' . $page->slug),
            'priority' => '0.9'
        ];
    }

    $xml = '<?xml version="1.0" encoding="UTF-8"?>';
    $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

    foreach ($urls as $url) {
        $xml .= '<url>';
        $xml .= '<loc>' . $url['loc'] . '</loc>';
        $xml .= '<lastmod>' . date('Y-m-d') . '</lastmod>';
        $xml .= '<changefreq>daily</changefreq>';
        $xml .= '<priority>' . $url['priority'] . '</priority>';
        $xml .= '</url>';
    }

    $xml .= '</urlset>';

    return response($xml, 200)->header('Content-Type', 'text/xml');
});

Route::get('/blog-sitemap.xml', function () {

    $urls = [];

    // Get only published blog posts
    $posts = BlogPost::published()
        ->orderBy('published_at', 'desc')
        ->get();

    foreach ($posts as $post) {
        $urls[] = [
            'loc' => url('/blog/' . $post->slug),
            'priority' => $post->is_featured ? '0.9' : '0.7',
            'lastmod' => optional($post->published_at)->toDateString() ?? date('Y-m-d')
        ];
    }

    $xml = '<?xml version="1.0" encoding="UTF-8"?>';
    $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

    foreach ($urls as $url) {
        $xml .= '<url>';
        $xml .= '<loc>' . $url['loc'] . '</loc>';
        $xml .= '<lastmod>' . $url['lastmod'] . '</lastmod>';
        $xml .= '<changefreq>weekly</changefreq>';
        $xml .= '<priority>' . $url['priority'] . '</priority>';
        $xml .= '</url>';
    }

    $xml .= '</urlset>';

    return response($xml, 200)
        ->header('Content-Type', 'text/xml');
});

Route::get('/{slug}', [SeoController::class, 'show'])
     ->where('slug', '[a-z0-9-]+') 
     ->name('seo.page');


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

    Route::post('/{mailbox}/extend', [MailboxController::class, 'extend'])->name('mailbox.extend');
    Route::post('/{mailbox}/pause',  [MailboxController::class, 'pause'])->name('mailbox.pause');
    Route::post('/{mailbox}/resume', [MailboxController::class, 'resume'])->name('mailbox.resume');
});

// ── Attachment download ───────────────────────────────────────────────────────
Route::get('attachment/{attachment}/download', [MailboxController::class, 'attachmentDownload'])
    ->name('attachment.download')
    ->whereNumber('attachment')
    ->middleware(['web', 'throttle:30,1']);

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
        $sessionId = "be1552d3795015b5e7e99b060064f5dac538af29479552dafb648bf56c1b7d45";

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