<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PublicEmail extends Model
{
    public $timestamps = false;   // we use received_at only

    protected $fillable = [
        'mailbox_id', 'sender', 'subject', 'body', 'content_type', 'is_read', 'received_at',
    ];

    protected $casts = [
        'is_read'     => 'boolean',
        'received_at' => 'datetime',
    ];

    // ── Relationships ────────────────────────────────────────────────
    public function mailbox(): BelongsTo
    {
        return $this->belongsTo(PublicMailbox::class, 'mailbox_id');
    }

    public function attachments(): HasMany
    {
        return $this->hasMany(PublicEmailAttachment::class, 'email_id');
    }

    // ── Scopes ───────────────────────────────────────────────────────
    public function scopeUnread(Builder $query): Builder
    {
        return $query->where('is_read', false);
    }

    public function scopeSearch(Builder $query, string $term): Builder
    {
        return $query->whereFullText(['subject', 'sender'], $term);
    }

    // ── Helpers ──────────────────────────────────────────────────────

    /** Sender display name (extracted from "Name <email>" format). */
    public function senderName(): string
    {
        if (preg_match('/^(.+?)\s*<[^>]+>$/', $this->sender, $m)) {
            return trim($m[1], '"\'');
        }
        return $this->sender;
    }

    /** Sender email address only. */
    public function senderEmail(): string
    {
        if (preg_match('/<([^>]+)>/', $this->sender, $m)) {
            return $m[1];
        }
        return $this->sender;
    }

    /** First letter of sender for avatar. */
    public function avatarLetter(): string
    {
        return strtoupper(substr($this->senderName(), 0, 1)) ?: '?';
    }

    public function avatarColor(): string
    {
        $colours = ['#4285F4','#96BF48','#000000','#635BFF','#F24E1E','#24292e','#E11D48'];
        return $colours[crc32($this->sender) % count($colours)];
    }

    public function timeAgo(): string
    {
        return $this->received_at->diffForHumans(['short' => true, 'parts' => 1]);
    }

    public function safeBody(): string
    {
        return $this->body;
        // if ($this->content_type === 'text/plain') {
        //     return nl2br(e($this->body));
        // }
        // return strip_tags($this->body,
        //     '<p><br><a><strong><b><em><i><ul><ol><li><h1><h2><h3><h4><table><tr><td><th><span><div><hr>'
        // );
    }
}