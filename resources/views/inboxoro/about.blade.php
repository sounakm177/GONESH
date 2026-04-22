<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- ✅ SEO Title -->
    <title>About InboxOro – Free Temporary Email & Disposable Inbox Service</title>

    <!-- ✅ Meta Description -->
    <meta name="description" content="Learn about InboxOro, a free temporary email service for OTPs, spam protection, and privacy with auto-expiring inboxes.">

    <!-- ✅ Canonical -->
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- ✅ Robots -->
    <meta name="robots" content="index, follow">

    <!-- ✅ Open Graph -->
    <meta property="og:title" content="About InboxOro – Temporary Email & Disposable Inbox Service">
    <meta property="og:description" content="InboxOro provides instant temporary email addresses to receive OTPs, avoid spam, and protect your real inbox.">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">

    <!-- ✅ Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="About InboxOro – Temporary Email Service">
    <meta name="twitter:description" content="Protect your inbox with InboxOro disposable email service. Instant, private, and auto-deleting inbox.">

    <!-- ✅ Favicons -->
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('images/favicon-32.png')}}">
    <link rel="icon" type="image/png" sizes="64x64" href="{{asset('images/favicon-64.png')}}">

    <!-- ✅ Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preload" as="style" 
          href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Outfit:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;500;700&display=swap" 
          onload="this.onload=null;this.rel='stylesheet'">
    <noscript>
        <link rel="stylesheet" 
              href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Outfit:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;500;700&display=swap">
    </noscript>

  <style>
    :root {
      --Y:    #FACC15;
      --B:    #2563EB;
      --INK:  #1F2937;
      --BG:   #F8FAFC;
      --BD:   #E5E7EB;
      --MU:   #6B7280;
      --CARD: #ffffff;
      --MONO: 'JetBrains Mono', monospace;
      --DISP: 'Bebas Neue', sans-serif;
      --BODY: 'Outfit', sans-serif;
    }

    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    html { scroll-behavior: smooth; overflow-x: hidden; }
    body {
      background:  var(--BG);
      font-family: var(--BODY);
      color:       var(--INK);
      line-height: 1.7;
      overflow-x:  hidden;
    }
    a { color: var(--B); text-decoration: none; }
    a:hover { text-decoration: underline; }
    img { display: block; max-width: 100%; }

    /* ── NAV ── */
    .nav {
      position:        sticky;
      top:             0;
      z-index:         100;
      background:      var(--INK);
      border-bottom:   3px solid var(--Y);
      display:         flex;
      align-items:     center;
      justify-content: space-between;
      padding:         0 20px;
      height:          52px;
    }
    .nav-logo {
      font-family:    var(--DISP);
      font-size:      1.5rem;
      color:          var(--Y);
      letter-spacing: .04em;
      text-decoration: none;
    }
    .nav-logo span { color: #fff; }
    .nav-links { display: none; gap: 24px; align-items: center; }
    .nav-links a {
      font-size:      .75rem;
      font-weight:    600;
      letter-spacing: .1em;
      text-transform: uppercase;
      color:          #9CA3AF;
      text-decoration: none;
      transition:     color .2s;
    }
    .nav-links a:hover, .nav-links a.active { color: var(--Y); }
    .nav-cta {
      background:     var(--Y);
      color:          var(--INK);
      font-size:      .72rem;
      font-weight:    700;
      letter-spacing: .08em;
      text-transform: uppercase;
      padding:        7px 14px;
      border:         none;
      cursor:         pointer;
      text-decoration: none;
      white-space:    nowrap;
      transition:     background .15s;
    }
    .nav-cta:hover { background: #fff; color: var(--INK); text-decoration: none; }

    /* ── HERO ── */
    .about-hero {
      background:    var(--INK);
      border-bottom: 3px solid var(--Y);
      padding:       52px 20px 48px;
      position:      relative;
      overflow:      hidden;
    }
    .about-hero::before {
      content:        'ABOUT';
      position:       absolute;
      right:          -20px;
      top:            50%;
      transform:      translateY(-50%);
      font-family:    var(--DISP);
      font-size:      clamp(5rem, 20vw, 14rem);
      color:          rgba(255,255,255,.03);
      letter-spacing: .05em;
      pointer-events: none;
      user-select:    none;
      white-space:    nowrap;
    }
    .hero-inner {
      max-width: 800px;
      margin:    0 auto;
      position:  relative;
      z-index:   1;
    }
    .hero-tag {
      display:        inline-flex;
      align-items:    center;
      gap:            6px;
      background:     rgba(250,204,21,.1);
      border:         1px solid rgba(250,204,21,.25);
      color:          var(--Y);
      font-family:    var(--MONO);
      font-size:      .62rem;
      font-weight:    700;
      letter-spacing: .12em;
      text-transform: uppercase;
      padding:        4px 10px;
      margin-bottom:  18px;
    }
    .hero-tag::before {
      content:       '';
      width:         5px;
      height:        5px;
      background:    var(--Y);
      border-radius: 50%;
      animation:     blink 1.2s step-end infinite;
    }
    @keyframes blink { 0%,100%{opacity:1} 50%{opacity:0} }

    .about-hero h1 {
      font-family:    var(--DISP);
      font-size:      clamp(2.2rem, 7vw, 4.5rem);
      color:          #fff;
      letter-spacing: .03em;
      line-height:    .95;
      margin-bottom:  20px;
    }
    .about-hero h1 .gold { color: var(--Y); }
    .about-hero h1 .out  { -webkit-text-stroke: 2px rgba(255,255,255,.2); color: transparent; }

    .hero-desc {
      font-size:   1rem;
      color:       #9CA3AF;
      max-width:   560px;
      line-height: 1.7;
      margin-bottom: 28px;
    }
    .hero-chips {
      display:   flex;
      flex-wrap: wrap;
      gap:       8px;
    }
    .hero-chip {
      font-family:    var(--MONO);
      font-size:      .62rem;
      font-weight:    700;
      letter-spacing: .08em;
      text-transform: uppercase;
      padding:        5px 12px;
      background:     rgba(255,255,255,.05);
      border:         1px solid rgba(255,255,255,.1);
      color:          #D1D5DB;
    }

    /* ── PAGE BODY ── */
    .page-body {
      max-width: 900px;
      margin:    0 auto;
      padding:   52px 20px 80px;
    }

    /* ── SECTION HEADER ── */
    .sec-label {
      font-family:    var(--MONO);
      font-size:      .62rem;
      font-weight:    700;
      letter-spacing: .14em;
      text-transform: uppercase;
      color:          var(--Y);
      margin-bottom:  10px;
      display:        flex;
      align-items:    center;
      gap:            8px;
    }
    .sec-label::before {
      content:       '';
      width:         5px;
      height:        5px;
      background:    var(--Y);
      border-radius: 50%;
    }
    .sec-title {
      font-family:    var(--DISP);
      font-size:      clamp(1.8rem, 5vw, 3rem);
      letter-spacing: .03em;
      color:          var(--INK);
      line-height:    1;
      margin-bottom:  14px;
    }
    .sec-title .gold { color: var(--Y); }
    .sec-body {
      font-size:   .95rem;
      color:       var(--MU);
      line-height: 1.75;
      max-width:   640px;
    }

    /* ── DIVIDER ── */
    .divider {
      border:        none;
      border-top:    2px solid var(--BD);
      margin:        52px 0;
    }

    /* ── MISSION SECTION ── */
    .mission-grid {
      display:               grid;
      grid-template-columns: 1fr;
      gap:                   16px;
      margin-top:            28px;
    }
    .mission-card {
      border:     2px solid var(--INK);
      background: var(--CARD);
      padding:    24px;
      box-shadow: 4px 4px 0 var(--BD);
      transition: box-shadow .15s, transform .15s;
    }
    .mission-card:hover { box-shadow: 6px 6px 0 var(--INK); transform: translate(-2px,-2px); }
    .mission-icon {
      width:           40px;
      height:          40px;
      background:      var(--INK);
      display:         flex;
      align-items:     center;
      justify-content: center;
      margin-bottom:   14px;
    }
    .mission-icon svg { color: var(--Y); }
    .mission-h {
      font-family:    var(--DISP);
      font-size:      1.1rem;
      letter-spacing: .04em;
      color:          var(--INK);
      margin-bottom:  6px;
    }
    .mission-p { font-size: .88rem; color: var(--MU); line-height: 1.65; }

    /* ── FEATURES SECTION ── */
    .feat-grid {
      display:               grid;
      grid-template-columns: 1fr;
      gap:                   0;
      border:                2px solid var(--INK);
      margin-top:            28px;
    }
    .feat-row {
      display:       grid;
      grid-template-columns: 1fr;
      border-bottom: 2px solid var(--INK);
      transition:    background .15s;
    }
    .feat-row:last-child { border-bottom: none; }
    .feat-row:hover { background: #FFFBEB; }

    .feat-main {
      padding:     20px 24px;
      border-bottom: 1px solid var(--BD);
    }
    .feat-status {
      display:        inline-flex;
      align-items:    center;
      gap:            5px;
      font-family:    var(--MONO);
      font-size:      .55rem;
      font-weight:    700;
      letter-spacing: .1em;
      text-transform: uppercase;
      padding:        3px 8px;
      margin-bottom:  8px;
    }
    .feat-status.live {
      background: rgba(34,197,94,.1);
      color:      #16a34a;
      border:     1px solid rgba(34,197,94,.25);
    }
    .feat-status.live::before {
      content:       '';
      width:         5px;
      height:        5px;
      background:    #22c55e;
      border-radius: 50%;
      animation:     blink 1.2s step-end infinite;
    }
    .feat-status.soon {
      background: rgba(250,204,21,.1);
      color:      #92400E;
      border:     1px solid rgba(250,204,21,.25);
    }
    .feat-name {
      font-family:    var(--DISP);
      font-size:      1.15rem;
      letter-spacing: .04em;
      color:          var(--INK);
      margin-bottom:  6px;
    }
    .feat-desc { font-size: .86rem; color: var(--MU); line-height: 1.6; }

    /* ── HOW IT WORKS ── */
    .steps {
      display:        flex;
      flex-direction: column;
      gap:            0;
      margin-top:     28px;
    }
    .step {
      display:     flex;
      align-items: flex-start;
      gap:         20px;
      padding:     24px 0;
      border-bottom: 1px solid var(--BD);
      position:    relative;
    }
    .step:last-child { border-bottom: none; }
    .step-num {
      font-family:    var(--DISP);
      font-size:      3rem;
      color:          var(--Y);
      line-height:    1;
      min-width:      52px;
      flex-shrink:    0;
    }
    .step-body {}
    .step-title {
      font-family:    var(--DISP);
      font-size:      1.2rem;
      letter-spacing: .04em;
      color:          var(--INK);
      margin-bottom:  6px;
    }
    .step-desc { font-size: .88rem; color: var(--MU); line-height: 1.65; }
    .step-code {
      display:        inline-block;
      font-family:    var(--MONO);
      font-size:      .72rem;
      background:     var(--INK);
      color:          var(--Y);
      padding:        3px 8px;
      margin-top:     6px;
    }

    /* ── PRIVACY BLOCK ── */
    .privacy-block {
      background:  var(--INK);
      border:      2px solid var(--Y);
      box-shadow:  6px 6px 0 var(--Y);
      padding:     28px 24px;
      margin-top:  28px;
    }
    .privacy-block-title {
      font-family:    var(--DISP);
      font-size:      1.5rem;
      letter-spacing: .04em;
      color:          #fff;
      margin-bottom:  12px;
    }
    .privacy-block-title span { color: var(--Y); }
    .privacy-list {
      list-style: none;
      display:    flex;
      flex-direction: column;
      gap:        10px;
    }
    .privacy-list li {
      display:     flex;
      align-items: flex-start;
      gap:         10px;
      font-size:   .88rem;
      color:       #D1D5DB;
      line-height: 1.6;
    }
    .privacy-list li::before {
      content:       '✓';
      font-family:   var(--MONO);
      font-size:     .78rem;
      font-weight:   700;
      color:         #22c55e;
      flex-shrink:   0;
      margin-top:    2px;
    }
    .privacy-disclaimer {
      margin-top:  16px;
      padding-top: 14px;
      border-top:  1px solid rgba(250,204,21,.15);
      font-family: var(--MONO);
      font-size:   .65rem;
      color:       #6B7280;
      line-height: 1.6;
      letter-spacing: .02em;
    }

    /* ── DEV SECTION ── */
    .dev-block {
      border:     2px solid var(--BD);
      background: var(--CARD);
      padding:    24px;
      margin-top: 28px;
      display:    flex;
      align-items: flex-start;
      gap:        20px;
    }
    .dev-badge {
      font-family:    var(--MONO);
      font-size:      .55rem;
      font-weight:    700;
      letter-spacing: .1em;
      text-transform: uppercase;
      padding:        3px 8px;
      background:     rgba(37,99,235,.1);
      color:          var(--B);
      border:         1px solid rgba(37,99,235,.2);
      white-space:    nowrap;
      flex-shrink:    0;
      margin-top:     4px;
    }
    .dev-body {}
    .dev-title {
      font-family:    var(--DISP);
      font-size:      1.1rem;
      letter-spacing: .04em;
      color:          var(--INK);
      margin-bottom:  6px;
    }
    .dev-desc { font-size: .86rem; color: var(--MU); line-height: 1.6; }

    /* ── SEO FOOTER TEXT ── */
    .seo-footer-text {
      margin-top:  48px;
      padding-top: 32px;
      border-top:  2px solid var(--BD);
    }
    .seo-footer-text h2 {
      font-family:    var(--DISP);
      font-size:      1.3rem;
      letter-spacing: .04em;
      color:          var(--INK);
      margin-bottom:  12px;
    }
    .seo-footer-text p {
      font-size:   .88rem;
      color:       var(--MU);
      line-height: 1.75;
      margin-bottom: 10px;
    }
    .seo-footer-text p:last-child { margin-bottom: 0; }
    .seo-footer-text a { color: var(--B); }

    /* ── SITE FOOTER ── */
    /* ═════════════════════════════════════════════════════════════
   FOOTER  (mobile: stacked)
═════════════════════════════════════════════════════════════ */
footer {
  background:     var(--INK);
  padding:        20px 16px;
  display:        flex;
  flex-direction: column;
  align-items:    center;
  gap:            14px;
  text-align:     center;
  border-top:     3px solid var(--Y);
}

.foot-logo      { font-family: 'Bebas Neue', sans-serif; font-size: 1.3rem; color: var(--Y); letter-spacing: .03em; }
.foot-logo .oro { color: #fff; }
.foot-links     { display: flex; gap: 16px; flex-wrap: wrap; justify-content: center; }
.foot-links a   { font-size: .73rem; color: #6B7280; text-decoration: none; font-weight: 500; }
.foot-links a:hover { color: var(--Y); }
.foot-st { font-family: 'JetBrains Mono', monospace; font-size: .68rem; color:  #4B5563; display: flex; align-items: center; gap: 5px; }

@media (min-width: 900px) {
  /* Footer */
  footer {
    flex-direction: row;
    padding:        26px 40px;
    text-align:     left;
    display:         flex;
    align-items:     center;
    justify-content: space-between;
  }
  .foot-links { justify-content: flex-start; }
}

    /* ── REVEAL ── */
    .rv    { opacity: 0; transform: translateY(14px); transition: opacity .5s ease, transform .5s ease; }
    .rv.in { opacity: 1; transform: translateY(0); }

    /* ── RESPONSIVE ── */
    @media (min-width: 640px) {
      .mission-grid { grid-template-columns: repeat(3, 1fr); }
      .feat-main    { border-bottom: none; }
    }
    @media (min-width: 900px) {
      .nav         { padding: 0 40px; }
      .nav-links   { display: flex; }
      .nav-logo    { font-size: 1.65rem; }
      .about-hero  { padding: 72px 40px 60px; }
      .page-body   { padding: 64px 40px 100px; }
      /* .site-footer { flex-direction: row; justify-content: space-between; padding: 26px 40px; text-align: left; } */
      /* .foot-links  { justify-content: flex-start; } */
    }

     .nav-logo {
      font-family: var(--DISPLAY);
      font-size: 1.7rem;
      color: var(--Y);
      letter-spacing: .04em;
      line-height: 1;
    }
    .nav-logo span { color: #fff; }
    .nav-back {
      display: flex;
      align-items: center;
      gap: 6px;
      font-family: var(--MONO);
      font-size: .68rem;
      font-weight: 700;
      letter-spacing: .1em;
      text-transform: uppercase;
      color: #9CA3AF;
      text-decoration: none;
      transition: color .2s;
    }

    .logo-img {
      height: 32px;
      width: auto;
    }

    .nav-logo {
      display: flex;
      align-items: center;
      gap: 0px;
    }

    /* ═════════════════════════════════════════════════════════════
   NAV  (mobile base)
═════════════════════════════════════════════════════════════ */
nav {
  position:        sticky;
  top:             0;
  z-index:         100;
  background:      var(--INK);
  display:         flex;
  align-items:     center;
  justify-content: space-between;
  padding:         0 16px;
  height:          48px;
  border-bottom:   3px solid var(--Y);
}

.nav-logo {
  font-family:    'Bebas Neue', sans-serif;
  font-size:      1.45rem;
  color:          var(--Y);
  letter-spacing: .03em;
  line-height:    1;
  display:        flex;
  align-items:    center;
  gap:            2px;
}
.nav-logo .oro   { color: #fff; }
.nav-logo .badge {
  font-family:    'JetBrains Mono', monospace;
  font-size:      .5rem;
  font-weight:    700;
  background:     var(--Y);
  color:          var(--INK);
  padding:        2px 5px;
  letter-spacing: .08em;
  margin-left:    6px;
  align-self:     center;
}

.logo-img { height: 30px; width: auto; }

.nav-links { display: none; gap: 28px; align-items: center; }
.nav-links a {
  font-size:       .76rem;
  font-weight:     600;
  letter-spacing:  .1em;
  text-transform:  uppercase;
  color:           #9CA3AF;
  text-decoration: none;
  transition:      color .2s;
}
.nav-links a:hover { color: var(--Y); }

.nav-cta {
  background:     var(--Y);
  color:          var(--INK);
  font-size:      .7rem;
  font-weight:    700;
  letter-spacing: .08em;
  text-transform: uppercase;
  padding:        6px 12px;
  border:         none;
  cursor:         pointer;
  transition:     background .15s;
  white-space:    nowrap;
}
.nav-cta:hover { background: #fff; }

@media (min-width: 600px) {

  nav { padding: 0 24px; height: 52px; }
  .nav-logo { font-size: 1.55rem; }
}

@media (min-width: 900px) {

  /* ── Nav ── */
  nav { padding: 0 40px; height: 52px; }
  .nav-logo  { font-size: 1.65rem; }
  .nav-links { display: flex; }
  .nav-cta   { padding: 7px 16px; font-size: .74rem; }
}
  </style>

    <script type="application/ld+json">
        {!! isset($schema) ? json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) : '{}' !!}
    </script>
</head>
<body>

<!-- NAV -->
<header>
  {{-- NAV --}}
  @include('inboxoro.partials.nav')
  <!-- <nav class="nav" aria-label="Main navigation">
    <a href="/" class="nav-logo">inbox<span>Oro</span></a>
    <div class="nav-links">
      <a href="/">Home</a>
      <a href="/about" class="active">About</a>
      <a href="/blog">Blog</a>
      <a href="/contact">Contact</a>
    </div>
    <a href="/" class="nav-cta">Try Free →</a>
  </nav> -->
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

<!-- FOOTER -->
<!-- <footer class="site-footer">
  <div class="foot-logo">inbox<span>Oro</span></div>
  <div class="foot-links">
    <a href="/">Home</a>
    <a href="/about">About</a>
    <a href="/blog">Blog</a>
    <a href="/contact">Contact</a>
    <a href="/privacy">Privacy</a>
    <a href="/terms">Terms</a>
  </div>
  <div class="foot-copy">© {{ date('Y') }} inboxOro. All rights reserved.</div>
</footer> -->
@include('inboxoro.partials.footer')

<script>
  const io = new IntersectionObserver(entries => {
    entries.forEach(e => { if (e.isIntersecting) { e.target.classList.add('in'); io.unobserve(e.target); } });
  }, { threshold: .06, rootMargin: '0px 0px -30px 0px' });
  document.querySelectorAll('.rv').forEach(el => io.observe(el));
</script>

</body>
</html>