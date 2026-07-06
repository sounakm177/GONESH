<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Public\PublicMailboxController;
use App\Http\Controllers\Public\PublicEmailController;
use App\Http\Controllers\Public\SeoController;
use App\Http\Controllers\Public\BlogController;
use App\Http\Controllers\Public\ContactController;
use App\Http\Controllers\Public\PageController;

use App\Http\Controllers\Dashboard\AliasController;
use App\Http\Controllers\MailboxController;
use App\Events\NewEmailReceived;
use App\Models\PublicEmail;
use App\Models\PublicMailbox;
use Illuminate\Http\Request;
use App\Models\SeoPage;
use Carbon\Carbon;
use App\Models\BlogPost;


Route::middleware('auth')->name('dashboard.')->group(function () {
    Route::get('/dashboard',         fn() => view('dashboard.dash'))->name('overview');
    Route::get('/inbox',             fn() => view('dashboard.inbox'))->name('inbox');
    Route::get('/addresses',         fn() => view('dashboard.address'))->name('address');
    Route::get('/addresses/{id}',    fn($id) => view('dashboard.address-view', ['id' => $id]))->name('address.view');
    Route::get('/domains',           fn() => view('dashboard.domain'))->name('domain');
    Route::get('/api-keys',          fn() => view('dashboard.api'))->name('api');
    Route::get('/smtp',              fn() => view('dashboard.smtp'))->name('smtp');
    Route::get('/settings',          fn() => view('dashboard.setting'))->name('setting');

    Route::get('/domains/available', [\App\Http\Controllers\Dashboard\DomainSelectionController::class, 'available'])
        ->name('domains.available');
    Route::post('/domains/default', [\App\Http\Controllers\Dashboard\DomainSelectionController::class, 'store'])
        ->name('domains.default');

    Route::prefix('inboxes')->name('inboxes.')->group(function () {
        Route::get('/',                 [\App\Http\Controllers\Dashboard\InboxController::class, 'index'])->name('index');
        Route::post('/',                [\App\Http\Controllers\Dashboard\InboxController::class, 'store'])->name('store');
        Route::delete('{address}',      [\App\Http\Controllers\Dashboard\InboxController::class, 'destroy'])->name('destroy');
        Route::get('domains',           [\App\Http\Controllers\Dashboard\InboxController::class, 'domains'])->name('domains');
        Route::post('{address}/extend', [\App\Http\Controllers\Dashboard\InboxController::class, 'extend'])->name('extend');

        Route::prefix('{address}/emails')->name('emails.')->group(function () {
            Route::get('/',                             [\App\Http\Controllers\Dashboard\EmailController::class, 'index'])->name('index');
            Route::get('{email}',                       [\App\Http\Controllers\Dashboard\EmailController::class, 'show'])->name('show');
            Route::get('{email}/raw',                   [\App\Http\Controllers\Dashboard\EmailController::class, 'raw'])->name('raw');
            Route::patch('{email}/read',                [\App\Http\Controllers\Dashboard\EmailController::class, 'markRead'])->name('read');
            Route::patch('{email}/unread',              [\App\Http\Controllers\Dashboard\EmailController::class, 'markUnread'])->name('unread');
            Route::delete('/',                          [\App\Http\Controllers\Dashboard\EmailController::class, 'destroyAll'])->name('destroyAll');
            Route::delete('{email}',                    [\App\Http\Controllers\Dashboard\EmailController::class, 'destroy'])->name('destroy');
            Route::post('mark-all-read',                [\App\Http\Controllers\Dashboard\EmailController::class, 'markAllRead'])->name('markAllRead');
        });
    });

    Route::prefix('aliases')->name('aliases.')->group(function () {
        Route::get('/',                 [AliasController::class, 'index'])->name('index');
        Route::post('/',                [AliasController::class, 'store'])->name('store');
        Route::get('domains',           [AliasController::class, 'domains'])->name('domains');
        Route::get('{alias}',           [AliasController::class, 'show'])->name('show');
        Route::patch('{alias}',         [AliasController::class, 'update'])->name('update');
        Route::delete('{alias}',        [AliasController::class, 'destroy'])->name('destroy');
        Route::patch('{alias}/status',  [AliasController::class, 'toggleStatus'])->name('status');
        Route::patch('{alias}/favorite',[AliasController::class, 'toggleFavorite'])->name('favorite');
        Route::get('{alias}/logs',      [AliasController::class, 'logs'])->name('logs');
    });
});

// Route::get('/login', function(){
//     return view('dashboard.login');
// });

// Route::get('/register', function(){
//     return view('dashboard.register');
// });


Route::get('/', [MailboxController::class, 'index'])->name('home');
Route::get('/about',[PageController::class, 'about']);
// Route::get('/contact',[PageController::class, 'contact']);
Route::get('/privacy-policy',[PageController::class, 'privacy']);
Route::get('/terms',[PageController::class, 'terms']);


Route::get('/contact', [ContactController::class, 'index'])
     ->name('contact.index');
 
Route::post('/contact', [ContactController::class, 'store'])
     ->name('contact.store')
     ->middleware('throttle:5,1');
 
Route::patch('/admin/contact/{message}/status', [ContactController::class, 'updateStatus'])
     ->name('contact.updateStatus')
     ->middleware(['auth', 'admin']); 


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

// ── Auth routes (must come before catch-all) ──────────────────────────────────
require __DIR__.'/auth.php';

/* ── Social Login (Google, GitHub) ── */
Route::prefix('auth')->name('auth.')->group(function () {
    Route::get('{provider}/redirect', [\App\Http\Controllers\Auth\SocialiteController::class, 'redirect'])
        ->whereIn('provider', ['google', 'github'])
        ->middleware('guest')
        ->name('redirect');
    Route::get('{provider}/callback', [\App\Http\Controllers\Auth\SocialiteController::class, 'callback'])
        ->whereIn('provider', ['google', 'github'])
        ->name('callback');
});

Route::get('/{slug}', function ($slug) {
    $page = \App\Models\SeoPage::where('slug', $slug)->where('is_active', true)->first();
    if (! $page) {
        return redirect()->route('login');
    }
    return app(\App\Http\Controllers\Public\SeoController::class)->show($slug, request());
})->where('slug', '[a-z0-9-]+')->name('seo.page');

Route::fallback(function () {
    return redirect()->route('login');
});

// ── Mailbox AJAX (all require session) ───────────────────────────────────────
Route::middleware(['web', 'check.blocked', 'throttle:temp-mail'])->prefix('mailbox')->name('mailbox.')->group(function () {

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