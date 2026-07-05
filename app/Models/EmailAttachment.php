<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EmailAttachment extends Model
{
    use HasFactory;

    protected $fillable = [
        'email_id',
        'file_name',
        'mime_type',
        'size',
        'storage_path',
    ];

    protected $casts = [
        'size' => 'integer',
    ];

    public function email(): BelongsTo
    {
        return $this->belongsTo(Email::class);
    }
}
