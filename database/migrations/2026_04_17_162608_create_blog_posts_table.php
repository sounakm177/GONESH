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
        Schema::create('blog_posts', function (Blueprint $table) {
               $table->id();
 
            // ── Relations ────────────────────────────────────────
            $table->foreignId('blog_category_id')
                  ->constrained('blog_categories')
                  ->restrictOnDelete();
 
            // ── Identity ─────────────────────────────────────────
            $table->string('title');
            $table->string('slug')->unique();
 
            // ── Content ──────────────────────────────────────────
            $table->string('excerpt', 320);          // shown in cards & meta description
            $table->longText('body');                 // raw HTML (from CMS or seeder)
 
            // ── Media ────────────────────────────────────────────
            // Path relative to public/images/blog/  e.g. "discord-temp-mail.jpg"
            // Null = no image, blade falls back to a placeholder
            $table->string('featured_image')->nullable();
            $table->string('featured_image_alt')->nullable();
 
            // ── Author ───────────────────────────────────────────
            $table->string('author_name')->default('inboxOro Team');
            $table->string('author_avatar')->nullable(); // path or null → initials fallback
 
            // ── SEO ──────────────────────────────────────────────
            $table->string('meta_title')->nullable();       // overrides title if set
            $table->string('meta_description', 320)->nullable(); // overrides excerpt if set
            $table->string('og_image')->nullable();         // overrides featured_image if set
 
            // ── Stats ────────────────────────────────────────────
            $table->unsignedSmallInteger('read_time_minutes')->default(5);
            $table->unsignedBigInteger('view_count')->default(0);
 
            // ── Status ───────────────────────────────────────────
            // draft | published | scheduled
            $table->enum('status', ['draft', 'published', 'scheduled'])->default('draft');
            $table->boolean('is_featured')->default(false); // pinned to top of listing
 
            // ── Timestamps ───────────────────────────────────────
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
 
            // ── Indexes ──────────────────────────────────────────
            $table->index(['status', 'published_at']);      // listing query
            $table->index(['is_featured', 'published_at']); // featured query
            $table->index('blog_category_id');
        });

        Schema::create('blog_tags', function (Blueprint $table) {
            $table->id();
            $table->string('name', 60)->unique();
            $table->string('slug', 60)->unique();
            $table->timestamps();
        });
 
        // ── Pivot ────────────────────────────────────────────────
        Schema::create('blog_post_tag', function (Blueprint $table) {
            $table->foreignId('blog_post_id')
                  ->constrained('blog_posts')
                  ->cascadeOnDelete();
 
            $table->foreignId('blog_tag_id')
                  ->constrained('blog_tags')
                  ->cascadeOnDelete();
 
            $table->primary(['blog_post_id', 'blog_tag_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blog_posts');
        Schema::dropIfExists('blog_post_tag');
        Schema::dropIfExists('blog_tags');
    }
};
