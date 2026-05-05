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

    public function getKeywordsAttribute()
    {
        $keywords = [];

        // 1. Base keyword
        $base = str_replace('-', ' ', $this->slug);

        $keywords[] = $base;
        $keywords[] = "$base free";
        $keywords[] = "$base online";

        // 2. Platform-based (ONLY if relevant)
        if (Str::startsWith($this->slug, 'temp-mail-for-')) {
            $platform = str_replace('temp-mail-for-', '', $this->slug);
            $platform = str_replace('-', ' ', $platform);

            $keywords[] = "temp mail for $platform";
            $keywords[] = "$platform verification email";
        }

        // 3. Category-based (LIMITED + INTENT FOCUSED)
        switch ($this->category) {
            case 'otp':
                $keywords = array_merge($keywords, [
                    'receive otp online',
                    'temporary email for otp',
                ]);
                break;

            case 'testing':
                $keywords = array_merge($keywords, [
                    'email testing tool',
                    'fake email for testing',
                ]);
                break;

            case 'privacy':
                $keywords = array_merge($keywords, [
                    'anonymous email',
                    'protect email privacy',
                ]);
                break;

            case 'spam':
                $keywords = array_merge($keywords, [
                    'avoid spam email',
                    'stop spam emails',
                ]);
                break;

            case 'comparison':
                $keywords = array_merge($keywords, [
                    'temp mail vs gmail',
                    'temporary email comparison',
                ]);
                break;

            case 'guide':
                $keywords = array_merge($keywords, [
                    'temporary email guide',
                    'how to use temp mail',
                ]);
                break;
        }

        // 4. Global keywords (CORE ONLY)
        $keywords = array_merge($keywords, [
            'temporary email',
            'temp mail',
            'disposable email',
            '10 minute email',
        ]);

        // 5. Clean + limit
        $keywords = array_unique($keywords);

        return implode(', ', array_slice($keywords, 0, 12));
    }
}
