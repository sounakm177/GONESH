<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Cache;

class EmailDomain extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'display_name',
        'type',
        'is_system',
        'created_by_user_id',
        'status',
        'mx_verified',
        'priority',
        'health_score',
        'blocked_score',
        'daily_received',
        'last_used_at',
        'features',
        'acceptance',
        'best_for',
        'restrictions',
        'popular',
        'exclusive',
    ];

    protected $casts = [
        'is_system' => 'boolean',
        'mx_verified' => 'boolean',
        'health_score' => 'integer',
        'blocked_score' => 'integer',
        'daily_received' => 'integer',
        'priority' => 'integer',
        'last_used_at' => 'datetime',
        'features' => 'array',
        'best_for' => 'array',
        'acceptance' => 'integer',
        'popular' => 'boolean',
        'exclusive' => 'boolean',
    ];

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by_user_id');
    }

    public function userDomains(): HasMany
    {
        return $this->hasMany(UserDomain::class);
    }

    public function domainMetric(): HasOne
    {
        return $this->hasOne(DomainMetric::class);
    }

    public function mailboxes(): HasMany
    {
        return $this->hasMany(PublicMailbox::class, 'domain', 'name');
    }

    public function addresses(): HasMany
    {
        return $this->hasMany(Address::class);
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('status', 'active');
    }

    public function scopeFree(Builder $query): Builder
    {
        return $query->where('type', 'free');
    }

    public function scopePro(Builder $query): Builder
    {
        return $query->where('type', 'pro');
    }

    public function scopeSystem(Builder $query): Builder
    {
        return $query->where('is_system', true);
    }

    public function scopeVerified(Builder $query): Builder
    {
        return $query->where('mx_verified', true);
    }

    public function scopeHealthy(Builder $query): Builder
    {
        return $query->where('health_score', '>=', 70);
    }

    public function scopeNotBlocked(Builder $query): Builder
    {
        return $query->where('blocked_score', '<', 80);
    }

    public static function cachedActive(): \Illuminate\Support\Collection
    {
        return Cache::tags(['email_domains'])->rememberForever(
            'active_domains',
            fn() => static::active()->orderBy('priority')->get(['id', 'name', 'display_name', 'type'])
        );
    }

    public static function bustCache(): void
    {
        Cache::tags(['email_domains'])->flush();
    }

    public function isFree(): bool
    {
        return $this->type === 'free';
    }

    public function isPro(): bool
    {
        return $this->type === 'pro';
    }

    public function isCustom(): bool
    {
        return $this->type === 'custom';
    }

    public function isActive(): bool
    {
        return $this->status === 'active';
    }

    public function isMaintenance(): bool
    {
        return $this->status === 'maintenance';
    }
}
