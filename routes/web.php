<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Public\PublicMailboxController;
use App\Http\Controllers\Public\PublicEmailController;
// use App\Http\Controllers\AttachmentController;
use App\Http\Controllers\MailboxController;

Route::get('/', [MailboxController::class, 'index'])->name('home');

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