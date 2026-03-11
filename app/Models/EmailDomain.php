<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Cache;

class EmailDomain extends Model
{
    protected $fillable = ['domain', 'label', 'is_active', 'is_premium', 'sort_order'];

    protected $casts = [
        'is_active'  => 'boolean',
        'is_premium' => 'boolean',
    ];

    // ── Relationships ────────────────────────────────────────────────
    public function mailboxes()
    {
        return $this->hasMany(PublicMailbox::class, 'domain', 'domain');
    }

    // ── Scopes ───────────────────────────────────────────────────────
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopeFree(Builder $query): Builder
    {
        return $query->where('is_premium', false);
    }

    // ── Static helpers ───────────────────────────────────────────────

    /**
     * Cached active domain list — avoids a DB hit on every page load.
     * Cache busts automatically via cache tag 'email_domains'.
     */
    public static function cachedActive(): \Illuminate\Support\Collection
    {
        return Cache::tags(['email_domains'])->rememberForever(
            'active_domains',
            fn () => static::active()->orderBy('sort_order')->get(['id', 'domain', 'label', 'is_premium'])
        );
    }

    public static function bustCache(): void
    {
        Cache::tags(['email_domains'])->flush();
    }
}