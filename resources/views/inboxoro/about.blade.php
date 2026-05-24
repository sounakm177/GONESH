<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>About InboxOro – Free Temporary Email & Disposable Inbox Service</title>

    <meta name="description" content="Learn about InboxOro, a free temporary email service for OTPs, spam protection, and privacy with auto-expiring inboxes.">

    <link rel="canonical" href="{{ url()->current() }}">

    <meta name="robots" content="index, follow">

    <meta property="og:title" content="About InboxOro – Temporary Email & Disposable Inbox Service">
    <meta property="og:description" content="InboxOro provides instant temporary email addresses to receive OTPs, avoid spam, and protect your real inbox.">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="About InboxOro – Temporary Email Service">
    <meta name="twitter:description" content="Protect your inbox with InboxOro disposable email service. Instant, private, and auto-deleting inbox.">

    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('images/favicon-32.png')}}">
    <link rel="icon" type="image/png" sizes="64x64" href="{{asset('images/favicon-64.png')}}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="{{ asset('css/inboxoro.css') }}">
    <link rel="stylesheet" href="{{ asset('css/about.css') }}">
    <link rel="preload" as="style" 
          href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Outfit:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;500;700&display=swap" 
          onload="this.onload=null;this.rel='stylesheet'">
    <noscript>
        <link rel="stylesheet" 
              href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Outfit:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;500;700&display=swap">
    </noscript>

    <script type="application/ld+json">
        {!! isset($schema) ? json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) : '{}' !!}
    </script>
</head>
<body>

<!-- NAV -->
<header>
  @include('inboxoro.partials.nav')
</header>

<!-- HERO -->
<section class="about-hero" aria-labelledby="about-heading">
  <div class="hero-inner">
    <div class="hero-tag">Our Story</div>
    <h1 id="about-heading">
      <span class="out">EMAIL</span><br>
      <span class="gold">PRIVACY</span><br>
      SIMPLIFIED
    </h1>
    <p class="hero-desc">
      InboxOro is a <strong style="color:#fff;">temporary email service</strong> built for people who value their privacy.
      Generate a <strong style="color:#fff;">disposable email address</strong> instantly — no account, no commitment, no trace.
      Your <strong style="color:#fff;">temporary inbox</strong> auto-expires, keeping your real address out of reach.
    </p>
    <div class="hero-chips">
      <span class="hero-chip">Temporary Email Generator</span>
      <span class="hero-chip">Disposable Inbox</span>
      <span class="hero-chip">Email Privacy Tool</span>
      <span class="hero-chip">No Signup</span>
    </div>
  </div>
</section>

<!-- PAGE BODY -->
<main class="page-body">

  <!-- MISSION -->
  <section aria-labelledby="mission-heading" class="rv">
    <div class="sec-label">Why We Built This</div>
    <h2 class="sec-title" id="mission-heading">Our <span class="gold">Mission</span></h2>
    <p class="sec-body">
      Every time you hand over your real email to access content, sign up for a trial, or verify an account —
      you risk spam, phishing, and data exposure. We built InboxOro to give you a frictionless
      <strong>email privacy tool</strong> that works in seconds and leaves no lasting trace.
    </p>
    <div class="mission-grid" style="margin-top:28px;">
      <div class="mission-card">
        <div class="mission-icon">
          <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
            <path stroke-linecap="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
          </svg>
        </div>
        <div class="mission-h">Stop Spam at the Source</div>
        <p class="mission-p">Never give your real address to services that don't need it. Disposable emails keep newsletters, promos, and phishing attempts away from your personal inbox.</p>
      </div>
      <div class="mission-card">
        <div class="mission-icon">
          <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
            <path stroke-linecap="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
          </svg>
        </div>
        <div class="mission-h">Protect Your Privacy</div>
        <p class="mission-p">Your real email is linked to your identity. A temporary email address creates distance between you and services that may share or sell your data.</p>
      </div>
      <div class="mission-card">
        <div class="mission-icon">
          <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
            <path stroke-linecap="round" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/>
          </svg>
        </div>
        <div class="mission-h">Built for Developers Too</div>
        <p class="mission-p">Testing email flows, account registrations, and verification systems is painful without throwaway addresses. InboxOro makes that workflow instant.</p>
      </div>
    </div>
  </section>

  <hr class="divider"/>

  <!-- FEATURES -->
  <section aria-labelledby="features-heading" class="rv">
    <div class="sec-label">What We Offer</div>
    <h2 class="sec-title" id="features-heading">Current <span class="gold">Features</span></h2>
    <p class="sec-body">Live tools available right now — no account required.</p>

    <div class="feat-grid" style="margin-top:28px;">

      <div class="feat-row">
        <div class="feat-main">
          <span class="feat-status live">Live</span>
          <div class="feat-name">Temporary Email Generator</div>
          <p class="feat-desc">
            Instantly generate a working <strong>disposable email address</strong> from one of our available domains.
            Choose your domain, copy the address, and use it anywhere. No signup, no personal data collected.
          </p>
        </div>
      </div>

      <div class="feat-row">
        <div class="feat-main">
          <span class="feat-status live">Live</span>
          <div class="feat-name">Real-Time Inbox Viewer</div>
          <p class="feat-desc">
            Receive emails in your <strong>temporary inbox</strong> and read them directly in the browser.
            Messages appear in real time via WebSocket connection. No forwarding, no delay.
          </p>
        </div>
      </div>

      <div class="feat-row">
        <div class="feat-main">
          <span class="feat-status live">Live</span>
          <div class="feat-name">Multiple Disposable Domains</div>
          <p class="feat-desc">
            Switch between several available email domains to improve deliverability.
            Some services block single-domain disposable emails — our domain variety helps get your verification through.
          </p>
        </div>
      </div>

      <div class="feat-row">
        <div class="feat-main">
          <span class="feat-status soon">Coming Soon</span>
          <div class="feat-name">Developer API</div>
          <p class="feat-desc">
            A programmatic API for generating and reading temporary inboxes is currently under development.
            Planned for integration into CI/CD pipelines, automated testing, and developer tooling.
            No release date confirmed yet.
          </p>
        </div>
      </div>

      <div class="feat-row">
        <div class="feat-main">
          <span class="feat-status soon">Coming Soon</span>
          <div class="feat-name">Custom Alias Support</div>
          <p class="feat-desc">
            Choose a custom local part for your temporary address (e.g. <code style="font-family:'JetBrains Mono',monospace;font-size:.8rem;">yourname@domain.com</code>).
            Under consideration — no confirmed timeline.
          </p>
        </div>
      </div>

    </div>
  </section>

  <hr class="divider"/>

  <!-- HOW IT WORKS -->
  <section aria-labelledby="how-heading" class="rv">
    <div class="sec-label">Simple by Design</div>
    <h2 class="sec-title" id="how-heading">How It <span class="gold">Works</span></h2>
    <p class="sec-body">Three steps. No account. No friction.</p>

    <div class="steps">
      <div class="step">
        <div class="step-num">01</div>
        <div class="step-body">
          <div class="step-title">Generate a Temporary Address</div>
          <p class="step-desc">
            Visit InboxOro and a <strong>disposable email address</strong> is generated instantly.
            Select a domain from the available options, or use the default. Copy the address with one click.
          </p>
          <span class="step-code">→ swift.wolf4521@inboxoro.com</span>
        </div>
      </div>
      <div class="step">
        <div class="step-num">02</div>
        <div class="step-body">
          <div class="step-title">Use It to Receive Emails</div>
          <p class="step-desc">
            Paste the address into any signup form, verification field, or email gate.
            Emails arrive in your <strong>temporary inbox</strong> in real time — OTPs, verification links, confirmation codes — all readable directly in the browser.
          </p>
        </div>
      </div>
      <div class="step">
        <div class="step-num">03</div>
        <div class="step-body">
          <div class="step-title">Inbox Auto-Expires</div>
          <p class="step-desc">
            After a set period, the inbox and all its messages are automatically deleted.
            The address becomes inactive. Any future emails sent to it go nowhere.
            Your real inbox stays clean.
          </p>
        </div>
      </div>
    </div>
  </section>

  <hr class="divider"/>

  <!-- PRIVACY NOTE -->
  <section aria-labelledby="privacy-heading" class="rv">
    <div class="sec-label">Data Handling</div>
    <h2 class="sec-title" id="privacy-heading">Privacy <span class="gold">Note</span></h2>
    <div class="privacy-block">
      <div class="privacy-block-title">What We Do <span>and Don't</span> Store</div>
      <ul class="privacy-list">
        <li>Temporary email addresses and their messages are auto-deleted after the inbox expires.</li>
        <li>We do not require account registration or collect personal identifying information to use the service.</li>
        <li>Temporary inboxes are accessible to anyone who has the address — do not use them for sensitive content.</li>
        <li>This service is intended for short-term, low-sensitivity email verification tasks only.</li>
        <li>We do not sell user data to third parties.</li>
      </ul>
      <p class="privacy-disclaimer">
        Note: While we take reasonable steps to limit data retention, no internet-based service can guarantee
        absolute privacy or security. Use this <strong>email privacy tool</strong> responsibly and within
        applicable laws. See our <a href="/privacy-policy" style="color:var(--Y);">Privacy Policy</a> for full details.
      </p>
    </div>
  </section>

  <hr class="divider"/>

  <!-- DEVELOPER SECTION -->
  <section aria-labelledby="dev-heading" class="rv">
    <div class="sec-label">For Developers</div>
    <h2 class="sec-title" id="dev-heading">API <span class="gold">Access</span></h2>
    <p class="sec-body">Building something that needs throwaway email addresses at scale?</p>
    <div class="dev-block" style="margin-top:28px;">
      <span class="dev-badge">In Development</span>
      <div class="dev-body">
        <div class="dev-title">Developer API — Coming Soon</div>
        <p class="dev-desc">
          A REST API for programmatic <strong>temporary email</strong> generation and inbox polling is currently
          under active development. Planned use cases include automated testing, CI/CD pipelines, QA workflows,
          and integration into developer tools. No release date is confirmed. If you're interested in early
          access or have specific requirements, <a href="/contact">reach out via the contact page</a>.
        </p>
      </div>
    </div>
  </section>

  <!-- SEO FOOTER TEXT -->
  <div class="seo-footer-text rv">
    <h2>About This Temporary Email Service</h2>
    <p>
      InboxOro is a <strong>temporary email service</strong> designed to give you instant access to a
      <strong>disposable email generator</strong> without requiring any personal information. Whether you
      need a quick address for a one-time signup, want to avoid newsletter spam, or are testing email
      verification flows as a developer — our <strong>temporary inbox</strong> service is built for that.
    </p>
    <p>
      As an <strong>email privacy tool</strong>, InboxOro focuses on simplicity: generate an address,
      use it, let it expire. No accounts. No subscriptions. No lasting data.
      Explore our <a href="/blog">blog</a> for guides on email privacy, spam protection, and disposable
      email best practices.
    </p>
  </div>

</main>

@include('inboxoro.partials.footer')

<script>
  const io = new IntersectionObserver(entries => {
    entries.forEach(e => { if (e.isIntersecting) { e.target.classList.add('in'); io.unobserve(e.target); } });
  }, { threshold: .06, rootMargin: '0px 0px -30px 0px' });
  document.querySelectorAll('.rv').forEach(el => io.observe(el));
</script>

</body>
</html>