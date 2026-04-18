<?php

namespace Database\Seeders;

use App\Models\BlogTag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BlogTagSeeder extends Seeder
{
    // php artisan db:seed --class=BlogTagSeeder

    public function run(): void
    {
        $tags = [
            'Disposable Email',
            'Spam Protection',
            'Privacy',
            'Security',
            'Inbox Management',
            'GDPR',
            'Email Verification',
            'API',
            'Developer Tools',
            'Discord',
            'Reddit',
            'OTP',
            'Anonymous Email',
            'Temporary Email',
            'Data Breach',
        ];

        foreach ($tags as $name) {
            BlogTag::firstOrCreate(
                ['slug' => Str::slug($name)],
                ['name' => $name, 'slug' => Str::slug($name)]
            );
        }
    }
}