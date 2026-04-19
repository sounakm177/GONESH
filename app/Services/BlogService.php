<?php

namespace App\Services;

use App\Models\BlogCategory;
use App\Models\BlogPost;
use App\Models\BlogTag;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;

class BlogService
{
    // ── Cache TTLs ───────────────────────────────────────────────
    private const TTL_CATEGORIES = 3600;   // 1 hour
    private const TTL_TRENDING   = 1800;   // 30 minutes
    private const TTL_TAGS       = 3600;

    // ── Posts per page ───────────────────────────────────────────
    private const PER_PAGE = 7;

    // ─────────────────────────────────────────────────────────────
    //  LISTING
    // ─────────────────────────────────────────────────────────────

    /**
     * Paginated blog listing — supports search, category, tag filters.
     *
     * @param  array{search?: string, category?: string, tag?: string, page?: int}  $filters
     */
    public function listing(array $filters = []): LengthAwarePaginator
    {
        $query = BlogPost::query()
            ->published()
            ->with(['category', 'tags'])
            ->select([
                'id', 'blog_category_id', 'title', 'slug', 'excerpt',
                'featured_image', 'featured_image_alt',
                'author_name', 'read_time_minutes', 'view_count',
                'is_featured', 'published_at',
            ]);

        // Search
        if (! empty($filters['search'])) {
            $query->search($filters['search']);
        }

        // Category filter
        if (! empty($filters['category'])) {
            $query->inCategory($filters['category']);
        }

        // Tag filter
        if (! empty($filters['tag'])) {
            $query->withTag($filters['tag']);
        }

        // Featured posts float to top on the first page only
        $query->orderByDesc('is_featured')
              ->orderByDesc('published_at');

        return $query->paginate(self::PER_PAGE)
                     ->withQueryString();
    }

    // ─────────────────────────────────────────────────────────────
    //  SINGLE POST
    // ─────────────────────────────────────────────────────────────

    /**
     * Load a single published post with all relations.
     * Throws ModelNotFoundException if not found or not published.
     */
    public function findPublished(string $slug): BlogPost
    {
        return BlogPost::with(['category', 'tags'])
            ->published()
            ->where('slug', $slug)
            ->firstOrFail();
    }

    /**
     * Related posts: same category, excluding current, latest 3.
     */
    public function related(BlogPost $post, int $limit = 3): Collection
    {
        return BlogPost::query()
            ->published()
            ->where('blog_category_id', $post->blog_category_id)
            ->where('id', '!=', $post->id)
            ->with('category')
            ->select([
                'id', 'blog_category_id', 'title', 'slug', 'excerpt',
                'featured_image', 'featured_image_alt',
                'read_time_minutes', 'published_at',
            ])
            ->orderByDesc('published_at')
            ->limit($limit)
            ->get();
    }

    // ─────────────────────────────────────────────────────────────
    //  SIDEBAR DATA
    // ─────────────────────────────────────────────────────────────

    /**
     * Trending posts — highest view counts — cached.
     */
    public function trending(int $limit = 5): Collection
    {
        return Cache::remember(
            "blog:trending:{$limit}",
            self::TTL_TRENDING,
            fn () => BlogPost::query()
                ->published()
                ->with('category')
                ->select([
                    'id', 'blog_category_id', 'title', 'slug',
                    'read_time_minutes', 'published_at', 'view_count',
                ])
                ->orderByDesc('view_count')
                ->orderByDesc('published_at')
                ->limit($limit)
                ->get()
        );
    }

    /**
     * All categories with published post counts — cached.
     */
    public function categoriesWithCount(): Collection
    {
        return Cache::remember(
            'blog:categories',
            self::TTL_CATEGORIES,
            fn () => BlogCategory::query()
                ->withCount(['posts' => fn ($q) => $q->published()])
                ->orderBy('sort_order')
                ->get()
        );
    }

    /**
     * All tags — cached.
     */
    public function allTags(): Collection
    {
        return Cache::remember(
            'blog:tags',
            self::TTL_TAGS,
            fn () => BlogTag::orderBy('name')->get()
        );
    }

    // ─────────────────────────────────────────────────────────────
    //  AUTO TABLE OF CONTENTS
    // ─────────────────────────────────────────────────────────────

    /**
     * Parse H2/H3 headings from body HTML and return a structured TOC array.
     *
     * Each item: ['level' => 2|3, 'id' => 'string', 'text' => 'string']
     *
     * @return array<int, array{level: int, id: string, text: string}>
     */
    public function buildToc(string $bodyHtml): array
{
    if (empty($bodyHtml)) {
        return [];
    }

    $toc = [];

    preg_match_all(
        '/<h([23])([^>]*)>(.*?)<\/h[23]>/is',
        $bodyHtml,
        $matches,
        PREG_SET_ORDER
    );

    foreach ($matches as $match) {
        $level = (int) $match[1];
        $attrs = $match[2];
        $raw   = strip_tags($match[3]);
        $text  = html_entity_decode(trim($raw), ENT_QUOTES, 'UTF-8');

        // ✅ Extract ID from HTML (DO NOT REGENERATE)
        preg_match('/id=["\']([^"\']+)["\']/', $attrs, $idMatch);
        $id = $idMatch[1] ?? \Illuminate\Support\Str::slug($text);

        $toc[] = compact('level', 'id', 'text');
    }

    return $toc;
}

    /**
     * Inject id="" attributes onto h2/h3 tags in the body HTML
     * so TOC anchor links work correctly.
     *
     * Returns the modified HTML with ids injected.
     */
    public function injectHeadingIds(string $bodyHtml): string
    {
        if (empty($bodyHtml)) {
            return $bodyHtml;
        }

        $usedIds = [];

        return preg_replace_callback(
            '/<h([23])([^>]*)>(.*?)<\/h[23]>/is',
            function (array $m) use (&$usedIds) {
                $level   = $m[1];
                $attrs   = $m[2];
                $content = $m[3];
                $raw     = strip_tags($content);
                $text    = html_entity_decode(trim($raw), ENT_QUOTES, 'UTF-8');

                // Skip if already has an id attribute
                if (preg_match('/\bid=["\']/', $attrs)) {
                    return $m[0];
                }

                $id = \Illuminate\Support\Str::slug($text);

                if (isset($usedIds[$id])) {
                    $usedIds[$id]++;
                    $id .= '-' . $usedIds[$id];
                } else {
                    $usedIds[$id] = 1;
                }

                return "<h{$level}{$attrs} id=\"{$id}\">{$content}</h{$level}>";
            },
            $bodyHtml
        );
    }

    // ─────────────────────────────────────────────────────────────
    //  CACHE BUSTING
    // ─────────────────────────────────────────────────────────────

    /**
     * Clear all blog-related caches. Call this after seeding or admin saves.
     */
    public function clearCaches(): void
    {
        Cache::forget('blog:categories');
        Cache::forget('blog:tags');

        // Forget all trending variants
        foreach ([3, 5, 10] as $n) {
            Cache::forget("blog:trending:{$n}");
        }
    }
}