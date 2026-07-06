<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AliasLog extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'alias_id',
        'email_id',
        'sender_email',
        'subject',
        'body',
        'status',
        'created_at',
    ];

    protected $casts = [
        'created_at' => 'datetime',
    ];

    public function alias(): BelongsTo
    {
        return $this->belongsTo(Alias::class);
    }

    public function email(): BelongsTo
    {
        return $this->belongsTo(Email::class);
    }
}
