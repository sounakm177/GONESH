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

        // 1. Slug-based keywords
        $base = str_replace('-', ' ', $this->slug);

        $keywords[] = $base;
        $keywords[] = $base . ' free';
        $keywords[] = $base . ' online';
        $keywords[] = $base . ' temp mail';
        $keywords[] = $base . ' disposable email';

        // 2. Detect platform (for "temp-mail-for-youtube")
        if (Str::startsWith($this->slug, 'temp-mail-for-')) {
            $platform = str_replace('temp-mail-for-', '', $this->slug);
            $platform = str_replace('-', ' ', $platform);

            $keywords[] = "temp mail for $platform";
            $keywords[] = "$platform temp mail";
            $keywords[] = "$platform verification email";
            $keywords[] = "email for $platform signup";
        }

        // 3. Category-based keywords
        switch ($this->category) {
            case 'otp':
                $keywords = array_merge($keywords, [
                    'receive otp online',
                    'free otp email',
                    'email for verification code',
                    'temporary email for otp',
                ]);
                break;

            case 'testing':
                $keywords = array_merge($keywords, [
                    'email testing tool',
                    'fake email for testing',
                    'qa email testing',
                    'sandbox email tool',
                ]);
                break;

            case 'privacy':
                $keywords = array_merge($keywords, [
                    'anonymous email',
                    'private email address',
                    'hide email online',
                    'protect email privacy',
                ]);
                break;

            case 'spam':
                $keywords = array_merge($keywords, [
                    'avoid spam email',
                    'stop spam emails',
                    'spam protection email',
                ]);
                break;

            case 'comparison':
                $keywords = array_merge($keywords, [
                    'temp mail vs gmail',
                    'temporary email comparison',
                    'disposable email vs real email',
                ]);
                break;

            case 'guide':
                $keywords = array_merge($keywords, [
                    'how to use temp mail',
                    'temporary email guide',
                    'step by step email tutorial',
                ]);
                break;
        }

        // 4. Global keywords (always add)
        $keywords = array_merge($keywords, [
            'temporary email',
            'disposable email',
            'temp mail',
            '10 minute email',
            'free temp mail',
        ]);

        // Remove duplicates
        return implode(', ', array_unique($keywords));
    }
}
