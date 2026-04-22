<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PublicMailbox extends Model
{
    protected $fillable = ['email', 'domain', 'session_id', 'expires_at', 'paused_at', 'is_paused'];

    protected $casts = [
        'expires_at' => 'datetime',
        'paused_at' => 'datetime',
        'is_paused' => 'boolean',
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
    // public function isExpired(): bool
    // {
    //     return $this->expires_at->isPast();
    // }

    // public function secondsRemaining(): int
    // {
    //     return max(0, now()->diffInSeconds($this->expires_at, false));
    // }

    public function unreadCount(): int
    {
        return $this->emails()->where('is_read', false)->count();
    }

    public function maxExpiry(): \Carbon\Carbon
    {
        return $this->created_at->copy()->addMinutes(30);
    }
 
    /**
     * Seconds left on the timer right now.
     * Respects paused state: when paused, time is frozen at the
     * moment of pause rather than continuing to tick.
     */
    public function secondsRemaining(): int
    {
       $reference = ($this->is_paused && $this->paused_at)
        ? $this->paused_at
        : now();

        return max(0, (int) $reference->diffInSeconds($this->expires_at, false));
    }
 
    /**
     * True when the mailbox has already expired.
     */
    public function isExpired(): bool
    {
        return $this->secondsRemaining() === 0 && ! $this->is_paused;
    }
    
    /**
     * How many seconds of extension are still allowed before
     * hitting the 30-minute ceiling.
     */
    public function secondsExtendable(): int
    {
        $secs = (int) now()->diffInSeconds($this->maxExpiry(), false);
        return max(0, $secs);
    }
}