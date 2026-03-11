<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PublicMailbox extends Model
{
    protected $fillable = ['email', 'domain', 'session_id', 'expires_at'];

    protected $casts = [
        'expires_at' => 'datetime',
    ];

    // ── Relationships ────────────────────────────────────────────────
    public function emails(): HasMany
    {
        return $this->hasMany(PublicEmail::class, 'mailbox_id');
    }

    public function domain(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(EmailDomain::class, 'domain', 'domain');
    }

    // ── Scopes ───────────────────────────────────────────────────────
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('expires_at', '>', now());
    }

    public function scopeForSession(Builder $query, string $sessionId): Builder
    {
        return $query->where('session_id', $sessionId);
    }

    public function scopeExpired(Builder $query): Builder
    {
        return $query->where('expires_at', '<=', now());
    }

    // ── Helpers ──────────────────────────────────────────────────────
    public function isExpired(): bool
    {
        return $this->expires_at->isPast();
    }

    public function secondsRemaining(): int
    {
        return max(0, now()->diffInSeconds($this->expires_at, false));
    }

    public function unreadCount(): int
    {
        return $this->emails()->where('is_read', false)->count();
    }
}