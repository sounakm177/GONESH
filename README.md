# inboxOro — Laravel Implementation Guide

## Architecture Overview

```
Browser (Blade SSR)
  │  FIRST LOAD: full HTML with pre-rendered inbox
  │
  ├─ WebSocket (Reverb/Pusher protocol)
  │    channel: mailbox.{id}
  │    events:  new.email | mailbox.expired
  │
  └─ AJAX (fetch + CSRF)
       POST /mailbox/generate
       GET  /mailbox/inbox
       GET  /mailbox/email/{id}
       DELETE /mailbox/email/{id}
       PATCH  /mailbox/email/{id}/unread
       POST   /mailbox/mark-all-read
       DELETE /mailbox/all
       GET    /attachment/{id}/download

Mail Server → POST /inbound/email (webhook)
              InboundEmailController → DB → NewEmailReceived event → Reverb → Browser
```

---

## File Map

```
app/
  Console/Kernel.php                    ← scheduler (prune every minute)
  Events/
    NewEmailReceived.php                ← Reverb broadcast event
    MailboxExpired.php                  ← expiry broadcast event
  Http/Controllers/
    MailboxController.php               ← main controller (index, generate, inbox, CRUD)
    AttachmentController.php            ← secure attachment download
    InboundEmailController.php          ← mail server webhook receiver
  Jobs/
    PruneExpiredMailboxes.php           ← scheduled cleanup job
  Models/
    EmailDomain.php                     ← domains with cache
    PublicMailbox.php                   ← mailbox model
    PublicEmail.php                     ← email model with helpers
    PublicEmailAttachment.php           ← attachment model
  Services/
    MailboxService.php                  ← all business logic

config/
  inboxoro.php                          ← app-specific config

database/migrations/
  ..._create_email_domains_table.php
  ..._create_public_mailboxes_table.php
  ..._create_public_emails_table.php
  ..._create_public_email_attachments_table.php
  EmailDomainSeeder.php                 ← move to database/seeders/

resources/views/inboxoro/
  index.blade.php                       ← main page (SSR + JS)
  partials/email-row.blade.php          ← reusable row partial

routes/
  web.php                               ← all routes
  channels.php                          ← Reverb channel auth
```

---

## Installation Steps

### 1. Install Reverb
```bash
composer require laravel/reverb
php artisan reverb:install
```

### 2. Run Migrations
```bash
php artisan migrate
php artisan db:seed --class=EmailDomainSeeder
```

### 3. Register Service Provider Bindings
In `AppServiceProvider::register()`:
```php
$this->app->singleton(\App\Services\MailboxService::class);
```

### 4. Register Inbound Webhook Route
In `routes/api.php`:
```php
Route::post('inbound/email', [\App\Http\Controllers\InboundEmailController::class, 'receive'])
    ->name('inbound.email');
```

In `app/Http/Middleware/VerifyCsrfToken.php`:
```php
protected $except = ['api/inbound/email'];
```

### 5. Add to `config/app.php` providers (if not auto-discovered):
```php
App\Providers\BroadcastServiceProvider::class,
```

### 6. Update `config/broadcasting.php`
Add the Reverb connection as shown in `.env.example`.

### 7. Copy `config/inboxoro.php` to your config/ directory

### 8. Start everything
```bash
# Terminal 1: Reverb WebSocket server
php artisan reverb:start

# Terminal 2: Queue worker (for broadcast jobs)  
php artisan queue:work redis --queue=default

# Terminal 3: Scheduler (or add to crontab)
php artisan schedule:work
```

For production, add to crontab:
```
* * * * * cd /path/to/project && php artisan schedule:run >> /dev/null 2>&1
```

---

## Performance Decisions

| Concern | Solution |
|---|---|
| First paint speed | Server-renders inbox HTML (SSR) — zero waiting for JS |
| Font loading | `preload` + async `onload` — fonts never block render |
| Domain list | Cached forever with Redis tags — 1 DB hit per deploy |
| Email search | MySQL FULLTEXT index on subject+sender — no LIKE scan |
| Session matching | SHA-256 hash of session ID stored in DB — no plaintext |
| Inbox preview | `LEFT(body, 120)` at DB level — no PHP string ops |
| Attachment count | `withCount('attachments')` — single JOIN, no N+1 |
| Expiry cleanup | Chunked 100/batch, `onOneServer()` — safe for clusters |
| Real-time | Reverb WebSocket — no polling in happy path |
| Polling fallback | Triggers on WS disconnect — 10s interval |
| CSRF | All AJAX includes token from inline JSON bootstrap |

---

## Mail Server Integration

### Option A: Postal (self-hosted, recommended)
1. Create a route in Postal for your domains
2. Set webhook URL: `https://yourdomain.com/api/inbound/email`
3. Set `X-Webhook-Secret` header in Postal route config

### Option B: Mailgun Inbound Routes
1. In Mailgun dashboard → Receiving → Create Route
2. Filter: `match_recipient(".*@inboxoro\.com")`
3. Action: `forward("https://yourdomain.com/api/inbound/email")`
4. Note: Mailgun sends multipart form, not JSON — adjust `InboundEmailController::receive()` accordingly

### Option C: Haraka MX Server
Run Haraka on the same server, configure `outbound/smtp_forward` plugin to POST to the webhook.

---

## Security Notes

- **Session binding**: Every mailbox is tied to a SHA-256 of the Laravel session ID
- **Attachment ownership**: Download route verifies session owns the mailbox before streaming
- **Webhook secret**: Inbound endpoint checks `X-Webhook-Secret` header
- **XSS**: Email bodies pass through `strip_tags()` whitelist; JS uses `escHtml()` for dynamic content
- **Rate limiting**: All routes use `throttle:60,1` middleware
- **No PII logged**: No IP addresses stored per the zero-trace promise


 netstat -ano | findstr :3306

 taskkill /PID 20740 /F