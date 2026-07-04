<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'avatar',
        'google_id',
        'github_id',
        'provider',
        'stripe_customer_id',
        'status',
        'last_login_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_secret',
        'two_factor_recovery_codes',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'last_login_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function profile(): HasOne
    {
        return $this->hasOne(UserProfile::class);
    }

    public function userMetric(): HasOne
    {
        return $this->hasOne(UserMetric::class);
    }

    public function userDomains(): HasMany
    {
        return $this->hasMany(UserDomain::class);
    }

    public function createdDomains(): HasMany
    {
        return $this->hasMany(EmailDomain::class, 'created_by_user_id');
    }

    public function isActive(): bool
    {
        return $this->status === 'active';
    }

    public function isBanned(): bool
    {
        return $this->status === 'banned';
    }

    public function isInactive(): bool
    {
        return $this->status === 'inactive';
    }

    public function markEmailAsVerified(): bool
    {
        return $this->forceFill([
            'email_verified_at' => $this->freshTimestamp(),
        ])->save();
    }

    public function hasLinkedProvider(string $provider): bool
    {
        return $this->provider === $provider
            || ($provider === 'google' && $this->google_id)
            || ($provider === 'github' && $this->github_id);
    }
}
