<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('seo_pages', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();                    // e.g., 'temporary-email', '10-minute-mail'
            $table->string('title');
            $table->text('meta_description');
            $table->string('h1')->nullable();
            $table->text('intro_text')->nullable();
            $table->json('faq')->nullable();                     // Store FAQ as JSON array
            $table->string('template')->default('default');      // 'default' or future templates
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seo_pages');
    }
};
