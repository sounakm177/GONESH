<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Mailbox TTL (minutes)
    |--------------------------------------------------------------------------
    | How long a generated address lives before it is automatically pruned.
    | Default: 10 minutes.  Pro users can override this at the service layer.
    */
    'mailbox_ttl' => env('MAILBOX_TTL_MINUTES', 10),

    /*
    |--------------------------------------------------------------------------
    | Inbound Webhook Secret
    |--------------------------------------------------------------------------
    | Shared secret sent by your mail server in X-Webhook-Secret header.
    | Set in .env:  INBOUND_WEBHOOK_SECRET=your-secret-here
    */
    'webhook_secret' => env('INBOUND_WEBHOOK_SECRET'),

    /*
    |--------------------------------------------------------------------------
    | Max emails per mailbox
    |--------------------------------------------------------------------------
    | Prevents abuse: drops oldest email when limit is exceeded.
    */
    'max_emails_per_mailbox' => env('MAX_EMAILS_PER_MAILBOX', 50),

    /*
    |--------------------------------------------------------------------------
    | Max attachment size (bytes)
    |--------------------------------------------------------------------------
    | Attachments larger than this are silently discarded.
    | Default: 10 MB
    */
    'max_attachment_size' => env('MAX_ATTACHMENT_BYTES', 10 * 1024 * 1024),

    /*
    |--------------------------------------------------------------------------
    | Reverb / Broadcasting
    |--------------------------------------------------------------------------
    | Channel name format for per-mailbox real-time updates.
    | Used in Event::broadcastOn() and the blade JS.
    */
    'broadcast_channel_prefix' => 'mailbox.',

];