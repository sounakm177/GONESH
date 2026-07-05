<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Email extends Model
{
    use HasFactory;

    protected $fillable = [
        'address_id',
        'source',
        'message_id',
        'from_name',
        'from_email',
        'to_email',
        'subject',
        'html_body',
        'text_body',
        'size',
        'has_attachments',
        'is_read',
        'is_spam',
        'is_starred',
        'received_at',
    ];

    protected $casts = [
        'size' => 'integer',
        'has_attachments' => 'boolean',
        'is_read' => 'boolean',
        'is_spam' => 'boolean',
        'is_starred' => 'boolean',
        'received_at' => 'datetime',
    ];

    public function address(): BelongsTo
    {
        return $this->belongsTo(Address::class);
    }

    public function headers(): HasMany
    {
        return $this->hasMany(EmailHeader::class, 'email_id');
    }

    public function attachments(): HasMany
    {
        return $this->hasMany(EmailAttachment::class, 'email_id');
    }
}
