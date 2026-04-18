<?php

namespace Database\Seeders;

use App\Models\BlogCategory;
use Illuminate\Database\Seeder;

class BlogCategorySeeder extends Seeder
{
    // php artisan db:seed --class=BlogCategorySeeder

    public function run(): void
    {
        $categories = [
            ['name' => 'Privacy',    'slug' => 'privacy',    'color' => '#7C3AED', 'sort_order' => 1],
            ['name' => 'Email Tips', 'slug' => 'email-tips', 'color' => '#2563EB', 'sort_order' => 2],
            ['name' => 'Developer',  'slug' => 'developer',  'color' => '#059669', 'sort_order' => 3],
            ['name' => 'Security',   'slug' => 'security',   'color' => '#DC2626', 'sort_order' => 4],
            ['name' => 'Guides',     'slug' => 'guides',     'color' => '#D97706', 'sort_order' => 5],
            ['name' => 'News',       'slug' => 'news',       'color' => '#0891B2', 'sort_order' => 6],
        ];

        foreach ($categories as $cat) {
            BlogCategory::firstOrCreate(['slug' => $cat['slug']], $cat);
        }
    }
}