<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class SeoPage extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug', 'title', 'meta_description', 'h1', 
        'intro_text', 'faq', 'template', 'is_active',
        'is_brand',
        'category'
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

     // ✅ Short title (for cards / UI)
    public function getShortTitleAttribute($value)
    {
        if (!empty($value)) {
            return $value; // manual override
        }

        if (!empty($this->h1)) {
            return Str::limit(strip_tags($this->h1), 60);
        }

        return Str::limit($this->title, 60);
    }

    // ✅ Menu title (for lists / links)
    public function getMenuTitleAttribute()
    {
        // Manual override (if you add column)
        if (!empty($this->attributes['short_title'])) {
            return $this->attributes['short_title'];
        }

        $text = str_replace('-', ' ', $this->slug);
        $text = Str::title($text);

        // Fix uppercase words
        $replacements = [
            'Otp' => 'OTP',
            'Api' => 'API',
            'Qa'  => 'QA',
            'Id'  => 'ID',
            'Usa' => 'USA',
            'Uk'  => 'UK',
        ];

        return str_replace(array_keys($replacements), array_values($replacements), $text);
    }
  
}
