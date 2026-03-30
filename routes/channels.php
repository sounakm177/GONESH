<?php
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('mailbox.{mailboxId}', function ($user, $mailboxId) {
    return true;
});