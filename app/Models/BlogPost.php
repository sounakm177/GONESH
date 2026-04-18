<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

class BlogPost extends Model
{
     protected $fillable = [
        'blog_category_id',
        'title',
        'slug',
        'excerpt',
        'body',
        'featured_image',
        'featured_image_alt',
        'author_name',
        'author_avatar',
        'meta_title',
        'meta_description',
        'og_image',
        'read_time_minutes',
        'view_count',
        'status',
        'is_featured',
        'published_at',
    ];
 
    // ── Casts ────────────────────────────────────────────────────
    protected $casts = [
        'published_at'       => 'datetime',
        'is_featured'        => 'boolean',
        'view_count'         => 'integer',
        'read_time_minutes'  => 'integer',
    ];
 
    // ── Relations ────────────────────────────────────────────────
 
    public function category(): BelongsTo
    {
        return $this->belongsTo(BlogCategory::class, 'blog_category_id');
    }
 
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(BlogTag::class, 'blog_post_tag');
    }
 
    // ── Query Scopes ─────────────────────────────────────────────
 
    /** Only published posts whose published_at is in the past */
    public function scopePublished(Builder $query): Builder
    {
        return $query
            ->where('status', 'published')
            ->where('published_at', '<=', now());
    }
 
    /** Filter by category slug */
    public function scopeInCategory(Builder $query, string $slug): Builder
    {
        return $query->whereHas('category', fn ($q) => $q->where('slug', $slug));
    }
 
    /** Filter by tag slug */
    public function scopeWithTag(Builder $query, string $slug): Builder
    {
        return $query->whereHas('tags', fn ($q) => $q->where('slug', $slug));
    }
 
    /** Simple full-text keyword search across title, excerpt, body */
    public function scopeSearch(Builder $query, string $term): Builder
    {
        $like = '%' . $term . '%';
 
        return $query->where(function (Builder $q) use ($like) {
            $q->where('title',   'like', $like)
              ->orWhere('excerpt', 'like', $like)
              ->orWhere('body',    'like', $like);
        });
    }
 
    /** Feature-flagged posts first */
    public function scopeFeaturedFirst(Builder $query): Builder
    {
        return $query->orderByDesc('is_featured');
    }
 
    // ── Accessors ────────────────────────────────────────────────
 
    /**
     * Full public URL to the featured image.
     * Falls back to null if no image is set.
     */
    public function getFeaturedImageUrlAttribute(): ?string
    {
        if (! $this->featured_image) {
            return null;
        }
 
        // If it's already an absolute URL (e.g. Unsplash seed), return as-is
        if (Str::startsWith($this->featured_image, ['http://', 'https://'])) {
            return $this->featured_image;
        }
 
        // Local path relative to public/images/blog/
        return asset('images/blog/' . ltrim($this->featured_image, '/'));
    }
 
    /**
     * OG image URL — og_image column overrides featured_image.
     */
    public function getOgImageUrlAttribute(): ?string
    {
        if ($this->og_image) {
            return Str::startsWith($this->og_image, ['http://', 'https://'])
                ? $this->og_image
                : asset('images/blog/' . ltrim($this->og_image, '/'));
        }
 
        return $this->featured_image_url;
    }
 
    /**
     * The effective <title> tag — meta_title overrides title.
     */
    public function getSeoTitleAttribute(): string
    {
        return $this->meta_title
            ?: $this->title . ' | inboxOro Blog';
    }
 
    /**
     * The effective meta description — meta_description overrides excerpt.
     */
    public function getSeoDescriptionAttribute(): string
    {
        return $this->meta_description ?: $this->excerpt;
    }
 
    /**
     * Author initials for avatar fallback (e.g. "inboxOro Team" → "IT").
     */
    public function getAuthorInitialsAttribute(): string
    {
        $words = explode(' ', $this->author_name);
 
        return strtoupper(
            collect($words)->take(2)->map(fn ($w) => $w[0] ?? '')->implode('')
        );
    }
 
    /**
     * Human-friendly published date string.
     */
    public function getPublishedDateAttribute(): string
    {
        return $this->published_at
            ? $this->published_at->format('M j, Y')
            : '—';
    }
 
    /**
     * ISO 8601 date for <time datetime="…">.
     */
    public function getPublishedDateIsoAttribute(): string
    {
        return $this->published_at
            ? $this->published_at->toIso8601String()
            : '';
    }
 
    /**
     * Estimated reading time label.
     */
    public function getReadTimeLabelAttribute(): string
    {
        return $this->read_time_minutes . ' min read';
    }
 
    // ── Helpers ──────────────────────────────────────────────────
 
    /**
     * Increment view count — called from the controller on each page view.
     * Uses an atomic DB increment to avoid race conditions.
     */
    public function incrementViews(): void
    {
        $this->increment('view_count');
    }
 
    /**
     * Auto-calculate read time from body HTML (≈ 200 words per minute).
     * Called in the seeder / admin save.
     */
    public static function estimateReadTime(string $bodyHtml): int
    {
        $text  = strip_tags($bodyHtml);
        $words = str_word_count($text);
 
        return (int) max(1, ceil($words / 200));
    }
 
    // ── Route model binding ──────────────────────────────────────
 
    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
