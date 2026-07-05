<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Plan extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'price',
        'billing_cycle',
        'max_addresses',
        'max_aliases',
        'max_domains',
        'max_api_requests_per_day',
        'max_smtp_sandboxes',
        'email_history_days',
        'is_active',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'max_addresses' => 'integer',
        'max_aliases' => 'integer',
        'max_domains' => 'integer',
        'max_api_requests_per_day' => 'integer',
        'max_smtp_sandboxes' => 'integer',
        'email_history_days' => 'integer',
        'is_active' => 'boolean',
    ];

    public function subscriptions(): HasMany
    {
        return $this->hasMany(Subscription::class);
    }
}
