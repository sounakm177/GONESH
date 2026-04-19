<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

  {{-- BASIC SEO --}}
  <title>{{ $post->title }} Blog</title>
  <meta name="description" content="{{ $post->excerpt }}">
  <meta name="robots" content="index, follow">
  <meta name="author" content="{{ $post->author_name ?? 'inboxOro Team' }}">

  {{-- CANONICAL --}}
  <link rel="canonical" href="{{ url('/blog/'.$post->slug) }}"/>

  <!-- Favicons -->
  <link rel="icon" type="image/png" sizes="32x32" href="{{asset('images/favicon-32.png')}}">
  <link rel="icon" type="image/png" sizes="64x64" href="{{asset('images/favicon-64.png')}}">

  {{-- OPEN GRAPH (FACEBOOK + LINKEDIN) --}}
  <meta property="og:type" content="article"/>
  <meta property="og:title" content="{{ $post->title }}"/>
  <meta property="og:description" content="{{ $post->excerpt }}"/>
  <meta property="og:url" content="{{ url('/blog/'.$post->slug) }}"/>
  <meta property="og:image" content="{{ $post->featured_image ? asset('storage/'.$post->featured_image) : asset('images/default.jpg') }}"/>

  {{-- ARTICLE META --}}
  <meta property="article:published_time" content="{{ optional($post->published_at)->toIso8601String() }}"/>
  <meta property="article:modified_time" content="{{ optional($post->updated_at)->toIso8601String() }}"/>
  <meta property="article:author" content="{{ $post->author_name ?? 'inboxOro Team' }}"/>
  <meta property="article:section" content="{{ $post->category->name ?? 'Blog' }}"/>

  {{-- TWITTER SEO --}}
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="{{ $post->title }}">
  <meta name="twitter:description" content="{{ $post->excerpt }}">
  <meta name="twitter:image" content="{{ $post->featured_image ? asset('storage/'.$post->featured_image) : asset('images/default.jpg') }}">

  {{-- KEYWORDS (optional but ok) --}}
  <meta name="keywords" content="{{ implode(',', $post->tags->pluck('name')->toArray()) }}">

  {{-- STRUCTURED DATA --}}
  <script type="application/ld+json">
    {!! json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
  </script>

  {{-- FONTS --}}
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Outfit:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;600;700&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="{{ asset('css/blog-view.css') }}">

  <script type="application/ld+json">
    @json($schema)
    </script>
</head>
<body>
<div id="read-progress" role="progressbar" aria-label="Reading progress" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>


{{-- NAV --}}
<header>
@include('inboxoro.blog.partials.nav')
</header>

<!-- BREADCRUMB -->
<nav class="breadcrumb" aria-label="Breadcrumb">
  <ol class="bc-inner" itemscope itemtype="https://schema.org/BreadcrumbList">

    {{-- Home --}}
    <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
      <a href="{{ url('/') }}" class="bc-item" itemprop="item">
        <span itemprop="name">Home</span>
      </a>
      <meta itemprop="position" content="1"/>
    </li>

    <span class="bc-sep" aria-hidden="true">›</span>

    {{-- Blog --}}
    <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
      <a href="{{ route('blog.index') }}" class="bc-item" itemprop="item">
        <span itemprop="name">Blog</span>
      </a>
      <meta itemprop="position" content="2"/>
    </li>

    {{-- Category (optional but recommended for SEO) --}}
    @if(!empty($post->category))
      <span class="bc-sep" aria-hidden="true">›</span>

      <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
        <a href="{{ route('blog.index', ['category' => $post->category->slug]) }}"
           class="bc-item"
           itemprop="item">
          <span itemprop="name">{{ $post->category->name }}</span>
        </a>
        <meta itemprop="position" content="3"/>
      </li>
    @endif

    <span class="bc-sep" aria-hidden="true">›</span>

    {{-- Current Post --}}
    <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
      <span class="bc-item bc-current" itemprop="name">
        {{ $post->title }}
      </span>
      <meta itemprop="position" content="{{ !empty($post->category) ? 4 : 3 }}"/>
    </li>

  </ol>
</nav>

<!-- POST HERO -->
<section class="post-hero" aria-labelledby="post-heading">
  <div class="hero-inner">

    {{-- CATEGORY --}}
    @if($post->category)
      <a href="{{ url('/blog?category=' . $post->category->slug) }}" class="post-cat-link">
        <svg width="10" height="10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" aria-hidden="true">
          <path stroke-linecap="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A2 2 0 013 12V7a4 4 0 014-4z"/>
        </svg>
        {{ $post->category->name }}
      </a>
    @endif

    {{-- TITLE --}}
    <h1 id="post-heading">
      {{ $post->title }}
    </h1>

    {{-- META --}}
    <div class="post-meta-row">

      {{-- DATE --}}
      <span class="meta-chip">
        <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
          <path stroke-linecap="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
        </svg>
        <time datetime="{{ $post->published_at }}">
          {{ \Carbon\Carbon::parse($post->published_at)->format('F d, Y') }}
        </time>
      </span>

      {{-- READ TIME --}}
      <span class="meta-chip">
        <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
          <circle cx="12" cy="12" r="10"/>
          <path stroke-linecap="round" d="M12 6v6l4 2"/>
        </svg>
        {{ $post->read_time ?? '5 min read' }}
      </span>

      {{-- AUTHOR --}}
      <span class="meta-chip">
        <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
          <path stroke-linecap="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
        </svg>
        {{ $post->author_name ?? 'inboxOro Team' }}
      </span>

      {{-- VIEWS --}}
      <span class="meta-chip">
        <!-- <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
          <path stroke-linecap="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
          <path stroke-linecap="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
        </svg> -->
        <!-- {{ number_format($post->views ?? 0) }} views -->
      </span>

    </div>
  </div>
</section>

<!-- HERO IMAGE -->
<div class="post-hero-img">
  <figure class="post-hero-img-inner">
    <img
      src="{{asset('images/blog/'.$post->featured_image)}}"
      alt="{{$post->featured_image_alt}}"
      loading="eager"
      fetchpriority="high"
      width="1200"
      height="525"
      decoding="async"
    />
  </figure>
</div>

<!-- CONTENT + SIDEBAR -->
<div class="post-layout">

  <!-- CONTENT COLUMN -->
  <div class="content-col">

    <!-- AUTHOR -->
    <div class="author-card rv" itemscope itemtype="https://schema.org/Person">
      <div class="author-avatar" aria-hidden="true">IO</div>
      <div class="author-info">
        <div class="author-name" itemprop="name">inboxOro Team</div>
        <div class="author-role">Privacy &amp; Email Security Experts · <a href="https://inboxoro.com" itemprop="url" style="color:var(--B);font-size:.6rem;">inboxoro.com</a></div>
      </div>
    </div>

    <!-- IN-CONTENT TOC (mobile) -->
    @if(!empty($toc) && isset($toc[0]))
    <div class="toc-box rv" aria-label="Table of contents">
        <div class="toc-title">Table of Contents</div>

        <ol class="toc-list">
            @foreach($toc as $index => $item)
            @if($item['level'] == 2) {{-- only H2 --}}
                <li>
                <a href="#{{ $item['id'] }}">
                    <span class="toc-num">
                    {{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}
                    </span>
                    {{ $item['text'] }}
                </a>
                </li>
            @endif
            @endforeach
        </ol>
    </div>
    @endif

    <!-- ARTICLE -->
    <article 
    class="post-content rv" 
    itemprop="articleBody" 
    itemscope 
    itemtype="https://schema.org/BlogPosting"
    >

    {!! $bodyHtml !!}

    </article>
    <!-- <article class="post-content rv" itemprop="articleBody" itemscope itemtype="https://schema.org/BlogPosting">

      <p>Every time you hand over your real email address to sign up for a website, you're making a trade: convenience in exchange for privacy. More often than not, that trade doesn't end well. Within weeks, you're drowning in promotional emails, newsletter chains you never requested, and — in worst cases — phishing attempts.</p>

      <p>The solution isn't better spam filters. It's never giving away your real email address in the first place. That's where <strong>disposable email addresses</strong> come in.</p>

      <div class="info-box">
        💡 <strong>Quick fact:</strong> The average professional receives 121 emails per day. According to Statista, 45.6% of all emails sent in 2023 were spam. That's over 160 billion spam emails every single day.
      </div>

      <h2 id="the-spam-problem">The Spam Problem Nobody Talks About</h2>

      <p>Most people think spam is an inconvenience they just have to live with. They dutifully click "unsubscribe," mark messages as junk, and hope for the best. But the problem runs much deeper.</p>

      <p>When you sign up for a service with your real email, you're at the mercy of that company's data practices. If they're acquired, if they suffer a breach, or if they simply decide to monetize their user list — your inbox is compromised. And once your email is in the wild, it's nearly impossible to take back.</p>

      <blockquote>
        <strong>"The best privacy is the kind you never have to fight for."</strong><br>
        The most effective strategy isn't cleaning up your inbox after the fact — it's never letting spam find you in the first place.
      </blockquote>

      <h2 id="how-disposable-email-works">How Disposable Email Actually Works</h2>

      <p>A <a href="/temporary-email">temporary email address</a> is a fully functional email address that you can generate instantly, use once (or a few times), and then discard. Here's the mechanics behind it:</p>

      <ol>
        <li>You visit a service like <a href="/">inboxOro</a> and instantly receive a random email address (e.g., <code>swift.wolf4521@inboxoro.com</code>).</li>
        <li>You use that address to sign up for whatever service requires it.</li>
        <li>The verification email or OTP arrives in the temporary inbox, which you check right there on the page.</li>
        <li>After a set period (typically 10–60 minutes), the inbox and all its contents are automatically and permanently deleted.</li>
      </ol>

      <p>The service you signed up for now has a dead email address. Any spam it tries to send in the future goes nowhere. Your real inbox remains completely clean.</p>

      <h2 id="real-world-use-cases">Real-World Use Cases</h2>

      <p>Disposable email addresses aren't just for avoiding newsletters. Here are the most effective ways people use them:</p>

      <h3>Free Trial Signups</h3>
      <p>SaaS companies often require email verification before granting access to free trials. Using a temp email means you get the trial without committing your real address to their marketing funnel.</p>

      <h3>One-Time Downloads</h3>
      <p>E-books, whitepapers, and templates typically require an email "gate." A disposable address gets you the content without the follow-up sequence.</p>

      <h3>Forum and Community Registrations</h3>
      <p>Forum email lists are frequently scraped and sold. Protecting your real identity with a temporary address is simply good operational security.</p>

      <ul>
        <li><a href="/temp-mail-for-discord">Discord account verification</a> — avoid linking your real email to gaming communities</li>
        <li>Reddit signups — keep your browsing persona separated from your identity</li>
        <li>Event registrations — conferences that sell attendee data won't get your real contact</li>
        <li>Developer testing — generate real verification emails in CI/CD pipelines without real accounts</li>
      </ul>

      <h2 id="choosing-the-right-service">Choosing the Right Service</h2>

      <p>Not all temporary email services are created equal. Here's what to look for:</p>

      <ul>
        <li><strong>No registration required</strong> — the best services are instant. If you have to sign up to get a temp email, that defeats the purpose.</li>
        <li><strong>Multiple domains</strong> — some services block single domains. Having options like <code>inboxoro.com</code>, <code>burnbox.dev</code>, and <code>zaptmp.net</code> improves deliverability.</li>
        <li><strong>Real-time inbox</strong> — you need to see emails arrive instantly. WebSocket or Reverb-based real-time delivery is significantly better than page-refresh polling.</li>
        <li><strong>Automatic deletion</strong> — data that's deleted can't be breached. Confirm that the service auto-deletes after a defined window.</li>
        <li><strong>API access</strong> — if you're a developer, <a href="/api">programmatic access</a> to temporary email generation is invaluable for testing workflows.</li>
      </ul>

      <h2 id="security-considerations">Security Considerations</h2>

      <p>Disposable email addresses improve privacy but come with important caveats you should understand:</p>

      <blockquote>
        ⚠️ <strong>Important:</strong> Temporary inboxes are typically <strong>public</strong>. Anyone who knows the email address can view its contents. Never use a disposable address to receive sensitive information — bank statements, medical records, or account recovery codes for important services.
      </blockquote>

      <p>For long-term accounts (banking, healthcare, work), always use your real, well-secured email address. Disposable emails are for throwaway registrations, not for replacing your primary address entirely.</p>

      <h2 id="conclusion">Conclusion</h2>

      <p>The spam problem is solved at the source, not at the filter. By adopting a simple habit — using a <a href="/">disposable email address</a> for every non-essential signup — you can permanently and dramatically reduce the volume of unwanted mail that reaches your real inbox.</p>

      <p>It takes less than three seconds to generate a temporary address on inboxOro. That's a negligible investment for a lifetime of inbox peace.</p>

    </article> -->

    <!-- TAGS -->
    @if($post->tags->isNotEmpty())
        <div class="post-tags rv" aria-label="Article tags">
            @foreach($post->tags as $tag)
                <a href="{{ url('/blog?tag=' . $tag->slug) }}" class="post-tag">
                {{ $tag->name }}
                </a>
            @endforeach
        </div>
    @endif

    <!-- SOCIAL SHARE -->
    <div class="share-bar rv" aria-label="Share article">
      <span class="share-label">Share:</span>
      <a href="https://twitter.com/intent/tweet?text=How+Disposable+Emails+Protect+Your+Inbox&url=https://inboxoro.com/blog/protect-email-from-spam"
         class="share-btn twitter"
         target="_blank" rel="noopener noreferrer"
         aria-label="Share on Twitter">
        <svg width="13" height="13" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-4.714-6.231-5.401 6.231H2.744l7.73-8.835L1.254 2.25H8.08l4.259 5.631zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
        Twitter
      </a>
      <a href="https://www.linkedin.com/shareArticle?url=https://inboxoro.com/blog/protect-email-from-spam&title=How+Disposable+Emails+Protect+Your+Inbox"
         class="share-btn linkedin"
         target="_blank" rel="noopener noreferrer"
         aria-label="Share on LinkedIn">
        <svg width="13" height="13" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M16 8a6 6 0 016 6v7h-4v-7a2 2 0 00-2-2 2 2 0 00-2 2v7h-4v-7a6 6 0 016-6zM2 9h4v12H2z"/><circle cx="4" cy="4" r="2"/></svg>
        LinkedIn
      </a>
      <button class="share-btn" onclick="copyLink()" aria-label="Copy article link">
        <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
        <span id="copy-label">Copy Link</span>
      </button>
    </div>

    <!-- TRY FREE CTA -->
    <div class="post-cta rv">
      <div class="cta-tag">✦ Free Tool</div>
      <h2 class="cta-title">Try <span>inboxOro</span> Free</h2>
      <p class="cta-sub">Generate a disposable email address instantly — no signup, no registration, no spam. Just click and use.</p>
      <a href="/" class="cta-btn">
        Generate Free Email
        <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><path stroke-linecap="round" d="M5 12h14M12 5l7 7-7 7"/></svg>
      </a>
    </div>

    <!-- RELATED POSTS -->
    <section class="related-section rv" aria-labelledby="related-heading">

    <h2 class="related-title" id="related-heading">Related Articles</h2>

    <div class="related-grid">

        @forelse($related as $item)
        <a href="{{ url('/blog/'.$item['slug']) }}" class="related-card">

            {{-- Thumbnail --}}
            <div class="related-thumb">
            <img 
                src="{{ !empty($item['featured_image']) 
                        ? asset('images/blog/'.$item['featured_image']) 
                        : 'https://via.placeholder.com/160x128?text=No+Image' }}"
                alt="{{ $item['featured_image_alt'] ?? $item['title'] }}"
                loading="lazy"
                width="160"
                height="128"
            />
            </div>

            {{-- Content --}}
            <div class="related-body">

            {{-- Category --}}
            <div class="related-cat">
                {{ $item['category']['name'] ?? 'General' }}
            </div>

            {{-- Title --}}
            <div class="related-h">
                {{ $item['title'] }}
            </div>

            {{-- Meta --}}
            <div class="related-meta">
                {{ $item['read_time_minutes'] ?? 2 }} min · 
                {{ \Carbon\Carbon::parse($item['published_at'])->format('M d, Y') }}
            </div>

            </div>

        </a>
        @empty
        <p>No related articles found.</p>
        @endforelse

    </div>

    </section>

  </div><!-- /content-col -->

  <!-- SIDEBAR -->
    <aside>
        <div class="sidebar-toc-sticky" aria-label="Table of contents">
            <div class="stoc-title">On This Page</div>
            <ol class="stoc-list">
            @foreach($toc as $index => $item)
                <li>
                <a href="#{{ $item['id'] }}">
                    <span class="stoc-num">
                    {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                    </span>
                    {{ $item['text'] }}
                </a>
                </li>
            @endforeach
            </ol>

            {{-- CTA BLOCK --}}
            <div style="margin-top:24px;background:var(--INK);border:2px solid var(--Y);padding:18px;">
            <div style="font-family:var(--DISP);font-size:1.2rem;color:#fff;margin-bottom:6px;">
                TRY IT NOW
            </div>

            <p style="font-size:.75rem;color:#9CA3AF;margin-bottom:12px;">
                Generate a free disposable email instantly.
            </p>

            <a href="{{ url('/') }}"
                style="display:flex;align-items:center;justify-content:center;gap:6px;background:var(--Y);color:var(--INK);font-family:var(--MONO);font-size:.65rem;font-weight:700;letter-spacing:.08em;text-transform:uppercase;padding:9px;text-decoration:none;transition:background .15s;">
                Generate Email →
            </a>
            </div>

        </div>
    </aside>

</div><!-- /post-layout -->

<!-- FOOTER
<footer class="site-footer">
  <a href="/" class="foot-logo">inbox<span>Oro</span></a>
  <div class="foot-links">
    <a href="/">Home</a>
    <a href="/blog">Blog</a>
    <a href="/privacy">Privacy</a>
    <a href="/terms">Terms</a>
    <a href="/api">API</a>
  </div>
  <div class="foot-copy">© 2026 inboxOro. All rights reserved.</div>
</footer> -->

@include('inboxoro.partials.footer')

 <script async src="https://www.googletagmanager.com/gtag/js?id=G-SMT1LQHYBS"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-SMT1LQHYBS');
  </script>


<script>
/* ── Read progress bar ── */
(function () {
  const bar = document.getElementById('read-progress');
  if (!bar) return;

  const updateProgress = () => {
    const d = document.documentElement;
    const scrollTop = d.scrollTop || document.body.scrollTop;
    const height = d.scrollHeight - d.clientHeight;

    if (height <= 0) return;

    const pct = (scrollTop / height) * 100;
    bar.style.width = Math.min(pct, 100) + '%';
    bar.setAttribute('aria-valuenow', Math.round(pct));
  };

  window.addEventListener('scroll', updateProgress, { passive: true });
})();


/* ── Scroll reveal ── */
(function () {
  const elements = document.querySelectorAll('.rv');
  if (!elements.length) return;

  const io = new IntersectionObserver((entries, observer) => {
    entries.forEach(e => {
      if (e.isIntersecting) {
        e.target.classList.add('in');
        observer.unobserve(e.target);
      }
    });
  }, {
    threshold: 0.06,
    rootMargin: '0px 0px -30px 0px'
  });

  elements.forEach(el => io.observe(el));
})();


/* ── TOC active link on scroll ── */
(function () {
  const headings = document.querySelectorAll('.post-content h2[id]');
  const tocLinks = document.querySelectorAll('.toc-list a, .stoc-list a');

  if (!headings.length || !tocLinks.length) return;

  const ioToc = new IntersectionObserver((entries) => {
    entries.forEach(e => {
      if (e.isIntersecting) {
        const id = '#' + e.target.id;

        tocLinks.forEach(link => {
          link.classList.toggle(
            'active',
            link.getAttribute('href') === id
          );
        });
      }
    });
  }, {
    rootMargin: '-30% 0px -60% 0px'
  });

  headings.forEach(h => ioToc.observe(h));
})();


/* ── Copy link ── */
function copyLink(url = window.location.href) {
  const label = document.getElementById('copy-label');

  if (navigator.clipboard) {
    navigator.clipboard.writeText(url)
      .then(() => {
        if (label) {
          label.textContent = 'Copied!';
          setTimeout(() => label.textContent = 'Copy Link', 2000);
        }
      })
      .catch(() => fallbackCopy(url));
  } else {
    fallbackCopy(url);
  }

  function fallbackCopy(text) {
    const textarea = document.createElement('textarea');
    textarea.value = text;
    document.body.appendChild(textarea);
    textarea.select();
    try { document.execCommand('copy'); } catch (e) {}
    document.body.removeChild(textarea);

    if (label) {
      label.textContent = 'Copied!';
      setTimeout(() => label.textContent = 'Copy Link', 2000);
    }
  }
}
</script>

</body>
</html>