<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SecurityLog extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'ip_address',
        'user_agent',
        'event_type',
        'email_address',
        'request_path',
    ];

    public static function record(string $eventType, ?string $email = null): void
    {
        static::create([
            'ip_address'    => request()->ip(),
            'user_agent'    => request()->userAgent(),
            'event_type'    => $eventType,
            'email_address' => $email,
            'request_path'  => request()->path(),
        ]);
    }
}
