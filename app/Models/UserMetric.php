<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserMetric extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'total_addresses',
        'total_aliases',
        'total_received_emails',
        'total_spam_blocked',
        'total_api_requests',
        'total_smtp_messages',
        'total_storage_bytes',
        'active_addresses',
    ];

    protected $casts = [
        'total_addresses' => 'integer',
        'total_aliases' => 'integer',
        'total_received_emails' => 'integer',
        'total_spam_blocked' => 'integer',
        'total_api_requests' => 'integer',
        'total_smtp_messages' => 'integer',
        'total_storage_bytes' => 'integer',
        'active_addresses' => 'integer',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function scopeWithHighUsage($query, int $threshold = 1000)
    {
        return $query->where('total_api_requests', '>=', $threshold);
    }
}
