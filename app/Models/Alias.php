<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Alias extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'email_domain_id',
        'local_part',
        'email',
        'forward_to',
        'description',
        'is_enabled',
        'is_favorite',
        'total_received',
        'total_forwarded',
        'last_received_at',
    ];

    protected $casts = [
        'is_enabled' => 'boolean',
        'is_favorite' => 'boolean',
        'total_received' => 'integer',
        'total_forwarded' => 'integer',
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

    public function logs(): HasMany
    {
        return $this->hasMany(AliasLog::class);
    }
}
