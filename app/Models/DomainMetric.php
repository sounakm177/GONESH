<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DomainMetric extends Model
{
    use HasFactory;

    protected $fillable = [
        'email_domain_id',
        'total_users',
        'total_addresses',
        'total_received_emails',
        'current_daily_emails',
        'active_addresses',
        'delivery_rate',
        'bounce_rate',
        'reputation_score',
        'average_receive_time_ms',
    ];

    protected $casts = [
        'total_users' => 'integer',
        'total_addresses' => 'integer',
        'total_received_emails' => 'integer',
        'current_daily_emails' => 'integer',
        'active_addresses' => 'integer',
        'delivery_rate' => 'float',
        'bounce_rate' => 'float',
        'reputation_score' => 'integer',
        'average_receive_time_ms' => 'integer',
    ];

    public function emailDomain(): BelongsTo
    {
        return $this->belongsTo(EmailDomain::class);
    }
}
