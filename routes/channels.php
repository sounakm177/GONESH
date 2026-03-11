<?php
// routes/channels.php
// No authentication required for public mailbox channels.
// The channel name itself contains the mailbox ID — security is enforced
// at the controller layer by matching session_id to mailbox.session_id.

use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Public mailbox broadcast channel
|--------------------------------------------------------------------------
| Channel: mailbox.{mailboxId}
|
| We keep this public (no auth closure) because:
|  - The mailbox ID is a sequential integer — not secret, but short-lived.
|  - Emails contain no PII beyond what was voluntarily sent to a burner.
|  - Each mailbox expires in 10 minutes, limiting exposure.
|
| For a Pro tier with named addresses, switch to a private channel and
| authenticate against session_id here.
*/
Broadcast::channel('mailbox.{mailboxId}', function ($user, $mailboxId) {
    // Public channel — return true to allow subscription
    return true;
});