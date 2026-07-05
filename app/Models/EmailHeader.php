<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EmailHeader extends Model
{
    use HasFactory;

    protected $fillable = [
        'email_id',
        'header_name',
        'header_value',
    ];

    public function email(): BelongsTo
    {
        return $this->belongsTo(Email::class);
    }
}
