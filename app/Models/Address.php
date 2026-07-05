<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'email_domain_id',
        'alias_id',
        'local_part',
        'email',
        'type',
        'expires_at',
        'is_active',
        'last_received_at',
    ];

    protected $casts = [
        'expires_at' => 'datetime',
        'is_active' => 'boolean',
        'last_received_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function emailDomain(): BelongsTo
    {
        return $this->belongsTo(EmailDomain::class);
    }

    public function alias(): BelongsTo
    {
        return $this->belongsTo(__CLASS__, 'alias_id');
    }

    public function aliases(): HasMany
    {
        return $this->hasMany(__CLASS__, 'alias_id');
    }

    public function emails(): HasMany
    {
        return $this->hasMany(Email::class);
    }
}
