<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlogPost;
use App\Services\BlogService;
use Illuminate\View\View;

class BlogController extends Controller
{
    public function __construct(
        private readonly BlogService $blog
    ) {}
 
    // ─────────────────────────────────────────────────────────────
    //  GET /blog
    // ─────────────────────────────────────────────────────────────
 
    /**
     * Blog listing page.
     *
     * Supports query params:
     *   ?search=keyword
     *   ?category=privacy
     *   ?tag=disposable-email
     *   ?page=2
     */
    public function index(Request $request): View
    {
        $filters = $request->only(['search', 'category', 'tag']);
 
        $posts      = $this->blog->listing($filters);
        $categories = $this->blog->categoriesWithCount();
        $trending   = $this->blog->trending(5);
        $tags       = $this->blog->allTags();
 
        // Active category object (for showing category name in heading)
        $activeCategory = null;
        if (! empty($filters['category'])) {
            $activeCategory = $categories->firstWhere('slug', $filters['category']);
        }

        $schema = [
            "@context" => "https://schema.org",
            "@graph" => [

                [
                    "@type" => "Organization",
                    "name" => "Inboxoro",
                    "url" => url('/'),
                    "logo" => [
                        "@type" => "ImageObject",
                        "url" => asset('images/logo.png'),
                        "width" => 512,
                        "height" => 512
                    ]
                ],

                [
                    "@type" => "WebSite",
                    "name" => "Inboxoro",
                    "url" => url('/'),
                    "inLanguage" => "en"
                ],

                [
                    "@type" => "CollectionPage",
                    "name" => "Inboxoro Blog",
                    "url" => url()->current(),
                    "description" => "Guides on temporary email, OTP verification, spam protection, and online privacy.",
                    "isPartOf" => [
                        "@type" => "WebSite",
                        "url" => url('/')
                    ]
                ],

                [
                    "@type" => "Blog",
                    "name" => "Inboxoro Blog",
                    "url" => url('/blog'),
                    "publisher" => [
                        "@type" => "Organization",
                        "name" => "Inboxoro"
                    ]
                ]

            ]
        ];
 
        return view('inboxoro.blog.index', compact(
            'posts',
            'categories',
            'trending',
            'tags',
            'filters',
            'activeCategory',
            'schema'
        ));
    }
 
    // ─────────────────────────────────────────────────────────────
    //  GET /blog/{slug}
    // ─────────────────────────────────────────────────────────────
 
    /**
     * Single blog post page.
     */
    public function show(string $slug)
    {
        $post = $this->blog->findPublished($slug);
 
        // Increment views (fire-and-forget, doesn't block the response)
        $post->incrementViews();
 
        // Inject heading ids and build TOC from body HTML
        $bodyHtml = $this->blog->injectHeadingIds($post->body);
        $toc      = $this->blog->buildToc($bodyHtml);
 
        $related    = $this->blog->related($post);
        $categories = $this->blog->categoriesWithCount();
        $trending   = $this->blog->trending(3);
    
        $schema = [
            "@context" => "https://schema.org",
            "@graph" => [

                [
                    "@type" => "Organization",
                    "name" => "Inboxoro",
                    "url" => url('/'),
                    "logo" => [
                        "@type" => "ImageObject",
                        "url" => asset('images/logo.png'),
                        "width" => 512,
                        "height" => 512
                    ]
                ],

                [
                    "@type" => "WebPage",
                    "@id" => url('/blog/' . $post->slug),
                    "url" => url('/blog/' . $post->slug),
                    "name" => $post->title,
                    "isPartOf" => [
                        "@type" => "WebSite",
                        "url" => url('/')
                    ]
                ],

                [
                    "@type" => "BlogPosting",
                    "mainEntityOfPage" => [
                        "@type" => "WebPage",
                        "@id" => url('/blog/' . $post->slug)
                    ],

                    "headline" => $post->title,
                    "description" => $post->excerpt,

                    "image" => [
                        "@type" => "ImageObject",
                        "url" => $post->featured_image
                            ? asset('images/blog/' . $post->featured_image)
                            : asset('images/default.jpg')
                    ],

                    "author" => [
                        "@type" => "Organization",
                        "name" => $post->author_name ?? "Inboxoro Team"
                    ],

                    "publisher" => [
                        "@type" => "Organization",
                        "name" => "Inboxoro",
                        "logo" => [
                            "@type" => "ImageObject",
                            "url" => asset('images/logo.svg'),
                            "width" => 512,
                            "height" => 512
                        ]
                    ],

                    "articleSection" => $post->category->name ?? "Blog",

                    "keywords" => implode(", ", $post->tags->pluck('name')->toArray()),

                    "inLanguage" => "en",

                    "timeRequired" => "PT{$post->read_time_minutes}M",

                    "datePublished" => $post->published_at
                        ? \Carbon\Carbon::parse($post->published_at)->toIso8601String()
                        : null,

                    "dateModified" => $post->updated_at
                        ? \Carbon\Carbon::parse($post->updated_at)->toIso8601String()
                        : null
                ]

            ]
        ];

        return view('inboxoro.blog.show', compact(
            'post',
            'bodyHtml',
            'toc',
            'related',
            'categories',
            'trending',
            'schema'
        ));
    }
 
    // ─────────────────────────────────────────────────────────────
    //  GET /blog/category/{slug}   (convenience redirect)
    // ─────────────────────────────────────────────────────────────
 
    /**
     * Redirect /blog/category/privacy  →  /blog?category=privacy
     * Keeps clean SEO URLs without duplicating the listing view.
     */
    public function category(string $slug)
    {
        return redirect()->route('blog.index', ['category' => $slug]);
    }
 
    // ─────────────────────────────────────────────────────────────
    //  GET /blog/tag/{slug}         (convenience redirect)
    // ─────────────────────────────────────────────────────────────
 
    public function tag(string $slug)
    {
        return redirect()->route('blog.index', ['tag' => $slug]);
    }
}
