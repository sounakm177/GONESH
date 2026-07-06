<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CustomDomain extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'domain',
        'verification_status',
        'mx_verified',
        'spf_verified',
        'dkim_verified',
        'txt_verified',
        'dkim_value',
        'spf_value',
        'mx_records',
        'txt_value',
        'is_active',
        'is_selected',
        'verified_at',
    ];

    protected $casts = [
        'mx_verified' => 'boolean',
        'spf_verified' => 'boolean',
        'dkim_verified' => 'boolean',
        'txt_verified' => 'boolean',
        'is_active' => 'boolean',
        'is_selected' => 'boolean',
        'verified_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function scopeVerified($query)
    {
        return $query->where('verification_status', 'verified');
    }

    public function scopePending($query)
    {
        return $query->where('verification_status', 'pending');
    }

    public function scopeFailed($query)
    {
        return $query->where('verification_status', 'failed');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function isVerified(): bool
    {
        return $this->verification_status === 'verified';
    }

    public function isPending(): bool
    {
        return $this->verification_status === 'pending';
    }

    public function isFailed(): bool
    {
        return $this->verification_status === 'failed';
    }
}
