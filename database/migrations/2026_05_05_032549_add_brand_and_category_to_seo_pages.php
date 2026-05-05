<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('seo_pages', function (Blueprint $table) {
            // 1. Add columns
        Schema::table('seo_pages', function (Blueprint $table) {
            $table->boolean('is_brand')->default(false)->after('template');
            $table->string('category')->nullable()->after('is_brand');
        });

        // 2. Brand list (IMPORTANT for accuracy)
        $brands = [
            'youtube','github','paypal','amazon','instagram',
            'facebook','netflix','spotify','twitter','reddit',
            'discord','linkedin','telegram','snapchat',
            'pinterest','quora','ebay','zoom','slack',
            'dropbox','chatgpt','gmail','apple','payoneer',
            'upwork','openai','airbnb','uber','ola',
            'zomato','swiggy','flipkart','medium','stackoverflow',
            'codepen','figma','notion','canva','replit',
            'vercel','netlify'
        ];

        // 3. Update existing data
        DB::table('seo_pages')->orderBy('id')->chunk(100, function ($pages) use ($brands) {

            foreach ($pages as $page) {

                $slug = strtolower($page->slug);

                $isBrand = false;
                $category = 'general';

                // 🔥 BRAND DETECTION (priority)
                foreach ($brands as $brand) {
                    if (str_contains($slug, $brand)) {
                        $isBrand = true;
                        $category = 'brand';
                        break;
                    }
                }

                // 🔹 VERIFICATION
                if (!$isBrand && (
                    str_contains($slug, 'otp') ||
                    str_contains($slug, 'verification')
                )) {
                    $category = 'verification';
                }

                // 🔹 TESTING / DEV
                elseif (!$isBrand && (
                    str_contains($slug, 'test') ||
                    str_contains($slug, 'qa') ||
                    str_contains($slug, 'developer') ||
                    str_contains($slug, 'api')
                )) {
                    $category = 'testing';
                }

                // 🔹 COMPARISON
                elseif (!$isBrand && str_contains($slug, 'vs')) {
                    $category = 'comparison';
                }

                // 🔹 BEST
                elseif (!$isBrand && str_contains($slug, 'best')) {
                    $category = 'best';
                }

                // 🔹 GUIDE
                elseif (!$isBrand && str_contains($slug, 'how-to')) {
                    $category = 'guide';
                }

                // 🔹 GEO
                elseif (!$isBrand && (
                    str_contains($slug, 'india') ||
                    str_contains($slug, 'usa') ||
                    str_contains($slug, 'uk')
                )) {
                    $category = 'geo';
                }

                // 🔹 FEATURES
                elseif (!$isBrand && str_contains($slug, 'with-')) {
                    $category = 'features';
                }

                // 🔹 USE CASE (important)
                elseif (!$isBrand && str_contains($slug, 'for-')) {
                    $category = 'use-case';
                }

                // 🔹 UPDATE
                DB::table('seo_pages')
                    ->where('id', $page->id)
                    ->update([
                        'is_brand' => $isBrand,
                        'category' => $category
                    ]);
            }
        });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('seo_pages', function (Blueprint $table) {
            $table->dropColumn(['is_brand', 'category']);
        });
    }
};
