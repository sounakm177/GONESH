<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SeoPage extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug', 'title', 'meta_description', 'h1', 
        'intro_text', 'faq', 'template', 'is_active'
    ];

    protected $casts = [
        'faq' => 'array',
    ];

    public function getFaqAttribute($value)
    {
        if (is_string($value)) {
            return json_decode($value, true) ?? [];
        }
        return $value ?? [];
    }
}
