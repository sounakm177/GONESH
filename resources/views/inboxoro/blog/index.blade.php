<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width,initial-scale=1.0"/>

  <title>Blog — inboxOro | Temporary Email, OTP & Privacy Guides</title>
  <meta name="description" content="Explore expert guides on temporary email, OTP receiving, spam protection, and digital privacy. Learn how to protect your inbox and use disposable emails effectively."/>
  <meta name="robots" content="index, follow">
  <meta name="author" content="inboxOro Team">

  <!-- Canonical -->
  <link rel="canonical" href="{{ url()->current() }}"/>

  <!-- Favicons -->
  <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon-32.png') }}">
  <link rel="icon" type="image/png" sizes="64x64" href="{{ asset('images/favicon-64.png') }}">

  <!-- Open Graph (Listing Page = Website type, NOT article) -->
  <meta property="og:type" content="website"/>
  <meta property="og:title" content="Blog — inboxOro | Temporary Email & Privacy Guides"/>
  <meta property="og:description" content="Explore expert guides on temporary email, OTP receiving, spam protection, and digital privacy."/>
  <meta property="og:url" content="{{ url()->current() }}"/>
  <meta property="og:image" content="{{ asset('images/blog-og.png') }}"/>

  <!-- Twitter -->
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="Blog — inboxOro | Temporary Email & Privacy Guides">
  <meta name="twitter:description" content="Explore expert guides on temporary email, OTP receiving, spam protection, and digital privacy.">
  <meta name="twitter:image" content="{{ asset('images/blog-og.png') }}">

  <!-- Keywords (light usage only) -->
  <meta name="keywords" content="temporary email, fake email, OTP online, disposable email, email privacy, spam protection, inbox guides">
  <link rel="stylesheet" href="{{ asset('css/blog.css') }}">
  
  <!-- Structured Data: Blog (Collection Page Style) -->
  <script type="application/ld+json">
    @json($schema)
    </script>
</head>
<body>

<div class="read-bar" id="readBar"></div>

{{-- NAV --}}
@include('inboxoro.blog.partials.nav', ['active' => 'blog'])

{{-- HERO --}}
<header class="blog-hero">
  <div class="hero-inner">
    <div class="hero-eyebrow">Knowledge Base</div>

    <h1>
      <span class="out">PRIVACY</span><br>
      <span class="gold">GUIDES</span><br>
      & EMAIL TIPS
    </h1>

    <p class="hero-sub">
      Expert guides on disposable email, spam protection, and protecting your digital identity.
    </p>

    <form class="hero-search" method="GET" action="{{ route('blog.index') }}">
      <input type="search" name="search" placeholder="Search articles…" value="{{ $filters['search'] ?? '' }}">
      <button type="submit">Search</button>
    </form>

    <div class="hero-stats-row">
      <div class="hero-stat">
        <div class="hero-stat-n">{{ $posts->total() }}</div>
        <div class="hero-stat-l">Articles</div>
      </div>

      <div class="hero-stat">
        <div class="hero-stat-n">{{ $categories->count() }}</div>
        <div class="hero-stat-l">Categories</div>
      </div>

      <div class="hero-stat">
        <div class="hero-stat-n">Live</div>
        <div class="hero-stat-l">Updated</div>
      </div>
    </div>
  </div>
</header>

{{-- CATEGORY --}}
<nav class="cat-strip">
  <div class="cat-inner">

    <a href="{{ route('blog.index') }}" class="cat-tab {{ empty($filters['category']) ? 'active' : '' }}">
      All
    </a>

    @foreach($categories as $cat)
      <a href="{{ route('blog.index', ['category' => $cat->slug]) }}"
         class="cat-tab {{ ($filters['category'] ?? '') === $cat->slug ? 'active' : '' }}">
        {{ $cat->name }}
        <span class="cat-count">{{ $cat->posts_count }}</span>
      </a>
    @endforeach

  </div>
</nav>

<main class="page-wrap">

  {{-- FEATURED --}}
  @php
    $featured = $posts->firstWhere('is_featured', true);
  @endphp

  @if($featured)
  <article>
    <div class="section-head"><span class="section-label">Featured</span></div>

    <a href="{{ route('blog.show', $featured->slug) }}" class="featured-post">
      <div class="featured-img">
        <img src="{{ $featured->featured_image_url }}" alt="{{ $featured->title }}">
        <span class="feat-badge">Must Read</span>
      </div>

      <div class="featured-body">
        <span class="post-cat">
          {{ $featured->category->name }} · {{ $featured->read_time_label }}
        </span>

        <h2 class="featured-title">{{ $featured->title }}</h2>

        <p class="featured-excerpt">{{ $featured->excerpt }}</p>

        <div class="post-meta">
          <div class="meta-i">{{ $featured->published_date }}</div>
          <div class="meta-i">{{ $featured->read_time_label }}</div>
          <!-- <div class="meta-i">{{ $featured->views ?? 0 }} views</div> -->
        </div>

        <span class="read-arrow">Read Article →</span>
      </div>
    </a>
  </article>
  @endif

  {{-- BLOG GRID --}}
  <div class="blog-grid">

    @foreach($posts as $post)
      @if(!($featured && $post->id === $featured->id))

      <a href="{{ route('blog.show', $post->slug) }}"
         class="blog-card"
         data-cat="{{ $post->category->slug }}">

        <div class="card-img">
          <img src="{{ $post->featured_image_url }}" alt="{{ $post->title }}">
        </div>

        <div class="card-body">
          <span class="post-cat">{{ $post->category->name }}</span>

          <h3 class="card-title">{{ $post->title }}</h3>

          <p class="card-excerpt">{{ $post->excerpt }}</p>

          <div class="card-foot">
            <div class="post-meta">
              <div class="meta-i">{{ $post->read_time_label }}</div>
              <div class="meta-i">{{ $post->published_date }}</div>
            </div>

            <span class="card-arrow">Read →</span>
          </div>
        </div>

      </a>

      @endif
    @endforeach

  </div>

  {{-- PAGINATION --}}
  <div class="pagination">
    {{ $posts->links() }}
  </div>

  {{-- SIDEBAR --}}
  <aside class="sidebar">

    {{-- TRENDING --}}
    <div class="sidebar-card">
      <div class="sidebar-card-head">Trending Now</div>

      <ul class="trending-list">
        @foreach($trending as $i => $t)
          <li>
            <a href="{{ route('blog.show', $t->slug) }}" class="trending-item">
              <span class="trend-num">{{ str_pad($i+1,2,'0',STR_PAD_LEFT) }}</span>

              <div class="trend-body">
                <div class="trend-title">{{ $t->title }}</div>
                <div class="trend-meta">{{ $t->read_time_label }}</div>
              </div>
            </a>
          </li>
        @endforeach
      </ul>
    </div>

    {{-- TAGS --}}
    <div class="sidebar-card">
      <div class="sidebar-card-head">Topics</div>

      <div class="cat-pill-list">
        @foreach($tags as $tag)
          <a href="{{ route('blog.index', ['tag' => $tag->slug]) }}" class="cat-pill">
            {{ $tag->name }}
          </a>
        @endforeach
      </div>
    </div>

  </aside>

</main>

@include('inboxoro.blog.partials.footer')

<script>
window.addEventListener('scroll',()=>{
  const d=document.documentElement;
  document.getElementById('readBar').style.width=(d.scrollTop/(d.scrollHeight-d.clientHeight)*100)+'%';
});
</script>

</body>
</html>