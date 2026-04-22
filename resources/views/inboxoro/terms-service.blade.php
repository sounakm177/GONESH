<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- SEO Title -->
    <title>Terms of Service – InboxOro | Usage Rules, Privacy & Conditions</title>

    <!-- SEO Meta -->
    <meta name="description" content="Read the Terms of Service for InboxOro. Understand usage rules, limitations, privacy policy, and conditions for using our temporary email service.">

    <!-- Canonical -->
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Robots -->
    <meta name="robots" content="index, follow">

    <!-- Open Graph -->
    <meta property="og:title" content="Terms of Service – InboxOro">
    <meta property="og:description" content="Understand usage rules, privacy policy, and conditions for using InboxOro temporary email service.">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">
    <meta property="og:image" content="{{ asset('images/og-image.png') }}">
    <meta property="og:image:secure_url" content="{{ asset('images/og-image.png') }}">

    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Terms of Service – InboxOro">
    <meta name="twitter:description" content="Usage rules and conditions for InboxOro temporary email platform.">
    <meta name="twitter:image" content="{{ asset('images/og-image.png') }}">

    <!-- Favicons -->
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon-32.png') }}">
    <link rel="icon" type="image/png" sizes="64x64" href="{{ asset('images/favicon-64.png') }}">

    <!-- Theme Color -->
    <meta name="theme-color" content="#000000">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

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

    <style>
    /* ── Variables ─────────────────────────────────────────────── */
    :root {
      --Y:        #FACC15;
      --Y-dim:    rgba(250,204,21,.10);
      --Y-line:   rgba(250,204,21,.25);
      --B:        #2563EB;
      --INK:      #1F2937;
      --BG:       #F8FAFC;
      --CARD:     #ffffff;
      --BD:       #E5E7EB;
      --MU:       #6B7280;
      --DANGER:   #DC2626;
      --DANGER-D: rgba(220,38,38,.07);
      --MONO:     'JetBrains Mono', monospace;
      --DISPLAY:  'Bebas Neue', sans-serif;
      --BODY:     'Outfit', sans-serif;
    }
 
    /* ── Reset ─────────────────────────────────────────────────── */
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    html { scroll-behavior: smooth; }
    body {
      background: var(--BG);
      font-family: var(--BODY);
      color: var(--INK);
      line-height: 1.7;
      overflow-x: hidden;
    }
    a { color: var(--B); text-decoration: none; }
    a:hover { text-decoration: underline; }
 
    /* ── Reading progress bar ──────────────────────────────────── */
    .read-progress {
      position: fixed;
      top: 0; left: 0;
      height: 3px;
      background: var(--Y);
      width: 0%;
      z-index: 1000;
      transition: width .1s linear;
    }
 
    /* ── NAV ───────────────────────────────────────────────────── */
    .site-nav {
      position: sticky;
      top: 0;
      z-index: 100;
      background: var(--INK);
      border-bottom: 3px solid var(--Y);
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 0 40px;
      height: 54px;
    }
    .nav-logo {
      font-family: var(--DISPLAY);
      font-size: 1.7rem;
      color: var(--Y);
      letter-spacing: .04em;
      line-height: 1;
      text-decoration: none;
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
    .nav-back:hover { color: var(--Y); text-decoration: none; }
 
    /* ── HERO BAND ─────────────────────────────────────────────── */
    .hero-band {
      background: var(--INK);
      padding: 52px 40px 44px;
      position: relative;
      overflow: hidden;
      border-bottom: 3px solid var(--Y);
    }
    .hero-band::before {
      content: 'TERMS';
      position: absolute;
      right: -24px;
      top: 50%;
      transform: translateY(-50%);
      font-family: var(--DISPLAY);
      font-size: clamp(6rem, 15vw, 13rem);
      color: rgba(255,255,255,.03);
      letter-spacing: .04em;
      pointer-events: none;
      user-select: none;
      white-space: nowrap;
    }
    .hero-inner { max-width: 900px; margin: 0 auto; position: relative; z-index: 1; }
 
    .hero-tag {
      display: inline-flex;
      align-items: center;
      gap: 7px;
      background: var(--Y-dim);
      border: 1px solid var(--Y-line);
      color: var(--Y);
      font-family: var(--MONO);
      font-size: .65rem;
      font-weight: 700;
      letter-spacing: .12em;
      text-transform: uppercase;
      padding: 4px 12px;
      margin-bottom: 18px;
    }
    .hero-tag::before {
      content: '';
      width: 6px; height: 6px;
      background: var(--Y);
      border-radius: 50%;
      animation: blink 1.3s step-end infinite;
    }
    @keyframes blink { 0%,100%{opacity:1} 50%{opacity:0} }
 
    .hero-title {
      font-family: var(--DISPLAY);
      font-size: clamp(2.5rem, 6vw, 4.5rem);
      color: #fff;
      letter-spacing: .03em;
      line-height: .95;
      margin-bottom: 18px;
    }
    .hero-title .gold { color: var(--Y); }
 
    .hero-meta {
      display: flex;
      flex-wrap: wrap;
      gap: 20px;
      margin-top: 22px;
    }
    .hero-meta-item {
      display: flex;
      align-items: center;
      gap: 7px;
      font-family: var(--MONO);
      font-size: .68rem;
      color: #9CA3AF;
      letter-spacing: .06em;
    }
    .hero-meta-item svg { flex-shrink: 0; color: var(--Y); }
 
    /* ── AGE NOTICE BAND ───────────────────────────────────────── */
    .age-band {
      background: #FEF3C7;
      border-bottom: 2px solid #F59E0B;
      padding: 10px 40px;
      display: flex;
      align-items: center;
      gap: 10px;
    }
    .age-band svg { flex-shrink: 0; color: #92400E; }
    .age-band p {
      font-family: var(--MONO);
      font-size: .7rem;
      font-weight: 700;
      letter-spacing: .06em;
      color: #78350F;
      text-transform: uppercase;
    }
 
    /* ── TOC STRIP ─────────────────────────────────────────────── */
    .toc-strip {
      background: var(--CARD);
      border-bottom: 2px solid var(--BD);
      padding: 0 40px;
      overflow-x: auto;
      white-space: nowrap;
      scrollbar-width: none;
    }
    .toc-strip::-webkit-scrollbar { display: none; }
    .toc-inner {
      max-width: 900px;
      margin: 0 auto;
      display: flex;
      gap: 0;
    }
    .toc-link {
      display: inline-flex;
      align-items: center;
      gap: 5px;
      padding: 13px 14px;
      font-family: var(--MONO);
      font-size: .6rem;
      font-weight: 700;
      letter-spacing: .08em;
      text-transform: uppercase;
      color: var(--MU);
      text-decoration: none;
      border-bottom: 3px solid transparent;
      transition: color .15s, border-color .15s;
      white-space: nowrap;
    }
    .toc-link:hover { color: var(--INK); border-bottom-color: var(--Y); text-decoration: none; }
    .toc-link.active { color: var(--INK); border-bottom-color: var(--Y); }
    .toc-num {
      font-size: .54rem;
      background: var(--BD);
      color: var(--MU);
      padding: 1px 5px;
      font-weight: 800;
    }
 
    /* ── LAYOUT ────────────────────────────────────────────────── */
    .page-wrap {
      max-width: 900px;
      margin: 0 auto;
      padding: 52px 40px 80px;
      display: grid;
      grid-template-columns: 1fr 220px;
      gap: 48px;
      align-items: start;
    }
    .content-col { min-width: 0; }
 
    /* ── SIDEBAR TOC ───────────────────────────────────────────── */
    .sidebar-toc {
      position: sticky;
      top: 80px;
    }
    .sidebar-toc-title {
      font-family: var(--MONO);
      font-size: .6rem;
      font-weight: 700;
      letter-spacing: .14em;
      text-transform: uppercase;
      color: var(--MU);
      margin-bottom: 14px;
      padding-bottom: 10px;
      border-bottom: 2px solid var(--BD);
    }
    .sidebar-toc-list { list-style: none; }
    .sidebar-toc-list li { margin-bottom: 2px; }
    .sidebar-toc-list a {
      display: flex;
      align-items: center;
      gap: 8px;
      font-size: .77rem;
      color: var(--MU);
      text-decoration: none;
      padding: 5px 8px;
      border-left: 2px solid transparent;
      transition: color .15s, border-color .15s, background .15s;
      line-height: 1.35;
    }
    .sidebar-toc-list a:hover { color: var(--INK); border-left-color: var(--Y); background: var(--Y-dim); }
    .sidebar-toc-list a.active { color: var(--INK); border-left-color: var(--Y); background: var(--Y-dim); font-weight: 600; }
    .sidebar-toc-list .s-num {
      font-family: var(--MONO);
      font-size: .58rem;
      font-weight: 700;
      color: var(--Y);
      flex-shrink: 0;
      min-width: 20px;
    }
 
    /* ── SECTIONS ──────────────────────────────────────────────── */
    .tos-section {
      margin-bottom: 56px;
      scroll-margin-top: 90px;
      opacity: 0;
      transform: translateY(16px);
      transition: opacity .5s ease, transform .5s ease;
    }
    .tos-section.visible { opacity: 1; transform: translateY(0); }
 
    .section-header {
      display: flex;
      align-items: center;
      gap: 14px;
      margin-bottom: 20px;
      padding-bottom: 14px;
      border-bottom: 2px solid var(--BD);
    }
    .section-num {
      font-family: var(--DISPLAY);
      font-size: 1.4rem;
      color: var(--Y);
      line-height: 1;
      min-width: 34px;
    }
    .section-title {
      font-family: var(--DISPLAY);
      font-size: 1.5rem;
      letter-spacing: .04em;
      color: var(--INK);
      line-height: 1;
    }
 
    /* body text */
    .tos-section p {
      font-size: .95rem;
      color: var(--INK);
      margin-bottom: 14px;
      line-height: 1.75;
    }
    .tos-section p:last-child { margin-bottom: 0; }
 
    /* sub-headings */
    .tos-section h3 {
      font-family: var(--BODY);
      font-size: .8rem;
      font-weight: 700;
      letter-spacing: .08em;
      text-transform: uppercase;
      color: var(--MU);
      margin: 22px 0 10px;
    }
 
    /* bullet list */
    .tos-list {
      list-style: none;
      margin: 10px 0 16px;
      padding: 0;
      display: flex;
      flex-direction: column;
      gap: 8px;
    }
    .tos-list li {
      display: flex;
      align-items: flex-start;
      gap: 10px;
      font-size: .93rem;
      color: var(--INK);
      line-height: 1.65;
    }
    .tos-list li::before {
      content: '';
      width: 6px; height: 6px;
      background: var(--Y);
      border: 1.5px solid var(--INK);
      border-radius: 50%;
      flex-shrink: 0;
      margin-top: 8px;
    }
    .tos-list.danger li::before { background: var(--DANGER); border-color: var(--DANGER); }
    .tos-list.check li::before {
      content: '✓';
      background: none;
      border: none;
      color: #16a34a;
      font-size: .85rem;
      font-weight: 700;
      margin-top: 1px;
      width: auto; height: auto;
    }
 
    /* ── CALLOUTS ──────────────────────────────────────────────── */
    .callout-danger {
      background: var(--DANGER-D);
      border: 2px solid var(--DANGER);
      border-left-width: 6px;
      padding: 18px 22px;
      margin: 20px 0;
    }
    .callout-danger-title {
      display: flex;
      align-items: center;
      gap: 8px;
      font-family: var(--MONO);
      font-size: .7rem;
      font-weight: 700;
      letter-spacing: .1em;
      text-transform: uppercase;
      color: var(--DANGER);
      margin-bottom: 10px;
    }
    .callout-danger p {
      font-size: .88rem !important;
      color: #7F1D1D !important;
      margin-bottom: 8px !important;
    }
    .callout-danger p:last-child { margin-bottom: 0 !important; }
 
    .callout-warn {
      background: #FEF9C3;
      border: 1.5px solid #FCD34D;
      border-left: 5px solid #F59E0B;
      padding: 16px 20px;
      margin: 18px 0;
    }
    .callout-warn p {
      font-size: .88rem !important;
      color: #78350F !important;
      margin-bottom: 8px !important;
    }
    .callout-warn p:last-child { margin-bottom: 0 !important; }
 
    .callout-neutral {
      background: #F9FAFB;
      border: 1.5px solid var(--BD);
      border-left: 5px solid var(--INK);
      padding: 16px 20px;
      margin: 18px 0;
    }
    .callout-neutral p {
      font-size: .88rem !important;
      color: var(--MU) !important;
      margin-bottom: 8px !important;
    }
    .callout-neutral p:last-child { margin-bottom: 0 !important; }
 
    /* ── DISCLAIMER BLOCKS ─────────────────────────────────────── */
    .disclaimer-block {
      background: var(--INK);
      border: 2px solid var(--Y);
      padding: 22px 24px;
      margin: 20px 0;
    }
    .disclaimer-block p {
      font-family: var(--MONO);
      font-size: .78rem !important;
      color: #D1D5DB !important;
      line-height: 1.7 !important;
      letter-spacing: .01em;
      margin-bottom: 10px !important;
    }
    .disclaimer-block p:last-child { margin-bottom: 0 !important; }
    .disclaimer-block strong { color: var(--Y); }
 
    /* ── PROHIBITED TABLE ──────────────────────────────────────── */
    .prohibited-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 10px;
      margin: 16px 0;
    }
    .prohibited-card {
      border: 2px solid var(--DANGER);
      background: var(--DANGER-D);
      padding: 14px 16px;
    }
    .prohibited-card-icon {
      font-size: 1.1rem;
      margin-bottom: 6px;
    }
    .prohibited-card-name {
      font-family: var(--DISPLAY);
      font-size: 1rem;
      letter-spacing: .04em;
      color: var(--DANGER);
      margin-bottom: 4px;
    }
    .prohibited-card p {
      font-size: .78rem !important;
      color: #7F1D1D !important;
      margin-bottom: 0 !important;
      line-height: 1.5 !important;
    }
 
    /* ── CONTACT BOX ───────────────────────────────────────────── */
    .contact-box {
      border: 2px solid var(--INK);
      box-shadow: 6px 6px 0 var(--INK);
      padding: 28px 30px;
      background: var(--CARD);
      margin-top: 10px;
    }
    .contact-box-title {
      font-family: var(--DISPLAY);
      font-size: 1.4rem;
      letter-spacing: .04em;
      color: var(--INK);
      margin-bottom: 4px;
    }
    .contact-box-sub {
      font-size: .83rem;
      color: var(--MU);
      margin-bottom: 20px;
    }
    .contact-row {
      display: flex;
      align-items: center;
      gap: 12px;
      padding: 12px 0;
      border-top: 1px solid var(--BD);
    }
    .contact-row:first-of-type { border-top: none; }
    .contact-icon {
      width: 36px; height: 36px;
      background: var(--INK);
      display: flex;
      align-items: center;
      justify-content: center;
      flex-shrink: 0;
    }
    .contact-label {
      font-family: var(--MONO);
      font-size: .58rem;
      font-weight: 700;
      letter-spacing: .1em;
      text-transform: uppercase;
      color: var(--MU);
      margin-bottom: 2px;
    }
    .contact-value {
      font-size: .9rem;
      font-weight: 600;
      color: var(--INK);
    }
    .contact-value a { color: var(--B); font-weight: 700; }
 
    /* ── BADGE TAGS ────────────────────────────────────────────── */
    .tag {
      display: inline-block;
      font-family: var(--MONO);
      font-size: .6rem;
      font-weight: 700;
      letter-spacing: .07em;
      padding: 2px 8px;
      text-transform: uppercase;
      vertical-align: middle;
    }
    .tag-y   { background: #FEF9C3; color: #92400E; }
    .tag-r   { background: #FEE2E2; color: #991B1B; }
    .tag-g   { background: #D1FAE5; color: #065F46; }
    .tag-b   { background: #DBEAFE; color: #1E40AF; }
 
    /* ── BACK TO TOP ───────────────────────────────────────────── */
    .back-top {
      position: fixed;
      bottom: 28px; right: 28px;
      width: 44px; height: 44px;
      background: var(--INK);
      border: 2px solid var(--Y);
      box-shadow: 3px 3px 0 var(--Y);
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      opacity: 0;
      pointer-events: none;
      transition: opacity .25s, transform .15s, box-shadow .15s;
      z-index: 50;
    }
    .back-top.show { opacity: 1; pointer-events: auto; }
    .back-top:hover { transform: translate(-2px,-2px); box-shadow: 5px 5px 0 var(--Y); }
    .back-top svg { color: var(--Y); }
 
    /* ── FOOTER ────────────────────────────────────────────────── */
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
 
    /* ── RESPONSIVE ────────────────────────────────────────────── */
    @media (max-width: 820px) {
      .site-nav    { padding: 0 20px; }
      .hero-band   { padding: 36px 20px 32px; }
      .toc-strip   { padding: 0 20px; }
      .age-band    { padding: 10px 20px; }
      .page-wrap   { grid-template-columns: 1fr; padding: 32px 20px 60px; gap: 0; }
      .sidebar-toc { display: none; }
      .prohibited-grid { grid-template-columns: 1fr; }
      .site-footer { padding: 20px; flex-direction: column; gap: 12px; text-align: center; }
      .footer-links { justify-content: center; }
    }
 
    @media print {
      .site-nav, .toc-strip, .age-band, .read-progress, .back-top, .sidebar-toc { display: none; }
      .tos-section { opacity: 1 !important; transform: none !important; }
      .page-wrap { grid-template-columns: 1fr; }
      body { background: #fff; }
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
</head>
<body>

<div class="read-progress" id="readProgress"></div>

<button class="back-top" id="backTop" onclick="window.scrollTo({top:0,behavior:'smooth'})" aria-label="Back to top">
  <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
    <path stroke-linecap="round" stroke-linejoin="round" d="M5 15l7-7 7 7"/>
  </svg>
</button>

{{-- NAV --}}
@include('inboxoro.partials.nav')

<!-- ══ HERO ══════════════════════════════════════════════════════ -->
<header class="hero-band">
  <div class="hero-inner">
    <div class="hero-tag">Legal Document</div>
    <h1 class="hero-title">Terms of<br><span class="gold">Service</span></h1>
    <div class="hero-meta">
      <div class="hero-meta-item">
        <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
          <path stroke-linecap="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
        </svg>
        Effective: March 28, 2026
      </div>
      <div class="hero-meta-item">
        <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
          <path stroke-linecap="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
        </svg>
        Last Updated: March 28, 2026
      </div>
      <div class="hero-meta-item">
        <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
          <path stroke-linecap="round" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064"/>
        </svg>
        Applies to: inboxoro.com
      </div>
      <div class="hero-meta-item">
        <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
          <path stroke-linecap="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
        </svg>
        Governed by: India (Kolkata, West Bengal)
      </div>
    </div>
  </div>
</header>

<!-- ══ AGE WARNING ═══════════════════════════════════════════════ -->
<div class="age-band">
  <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
    <path stroke-linecap="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
  </svg>
  <p>You must be at least 13 years old to use InboxOro. By continuing, you confirm you meet this age requirement.</p>
</div>

<!-- ══ TOC STRIP ═════════════════════════════════════════════════ -->
<nav class="toc-strip" aria-label="Table of contents">
  <div class="toc-inner">
    <a class="toc-link" href="#t1"><span class="toc-num">01</span> Introduction</a>
    <a class="toc-link" href="#t2"><span class="toc-num">02</span> Acceptance</a>
    <a class="toc-link" href="#t3"><span class="toc-num">03</span> The Service</a>
    <a class="toc-link" href="#t4"><span class="toc-num">04</span> No Privacy</a>
    <a class="toc-link" href="#t5"><span class="toc-num">05</span> Acceptable Use</a>
    <a class="toc-link" href="#t6"><span class="toc-num">06</span> Prohibited</a>
    <a class="toc-link" href="#t7"><span class="toc-num">07</span> Availability</a>
    <a class="toc-link" href="#t8"><span class="toc-num">08</span> IP Rights</a>
    <a class="toc-link" href="#t9"><span class="toc-num">09</span> Third Parties</a>
    <a class="toc-link" href="#t10"><span class="toc-num">10</span> Warranties</a>
    <a class="toc-link" href="#t11"><span class="toc-num">11</span> Liability</a>
    <a class="toc-link" href="#t12"><span class="toc-num">12</span> Indemnification</a>
    <a class="toc-link" href="#t13"><span class="toc-num">13</span> Termination</a>
    <a class="toc-link" href="#t14"><span class="toc-num">14</span> Changes</a>
    <a class="toc-link" href="#t15"><span class="toc-num">15</span> Governing Law</a>
    <a class="toc-link" href="#t16"><span class="toc-num">16</span> Contact</a>
  </div>
</nav>

<!-- ══ MAIN ═════════════════════════════════════════════════════ -->
<main>
  <div class="page-wrap">

    <!-- ── Content column ── -->
    <div class="content-col">

      <!-- SECTION 1 -->
      <section class="tos-section" id="t1">
        <div class="section-header">
          <div class="section-num">01</div>
          <h2 class="section-title">Introduction</h2>
        </div>
        <p>Welcome to <strong>InboxOro</strong> ("we," "us," "our," or "the Company"), a free disposable temporary email service available at <a href="https://inboxoro.com" target="_blank" rel="noopener">https://inboxoro.com</a> ("the Website" or "the Service").</p>
        <p>These Terms of Service ("Terms") are a legally binding agreement between you ("User," "you," or "your") and InboxOro. They govern your access to and use of the Service, including all features, tools, content, and functionality provided through the Website.</p>
        <p>By using InboxOro in any way — visiting the site, generating a temporary address, or viewing emails — you agree to be bound by these Terms in full. <strong>If you do not agree, please stop using the Service immediately.</strong></p>
        <div class="callout-neutral">
          <p><strong>Plain summary:</strong> InboxOro lets you create temporary email addresses instantly, for free, with no registration. These Terms explain the rules. They are legally binding. Read them before you use the service.</p>
        </div>
      </section>

      <!-- SECTION 2 -->
      <section class="tos-section" id="t2">
        <div class="section-header">
          <div class="section-num">02</div>
          <h2 class="section-title">Acceptance of Terms</h2>
        </div>
        <p>Your access to and use of InboxOro constitutes your full and unconditional acceptance of these Terms, along with our <a href="/privacy">Privacy Policy</a>, which is incorporated herein by reference.</p>
        <h3>Eligibility</h3>
        <ul class="tos-list">
          <li>You must be <strong>at least 13 years of age</strong> to use this Service. If you are under 13, you are not permitted to access or use InboxOro under any circumstances.</li>
          <li>If you are between the ages of 13 and 18 (or the age of legal majority in your jurisdiction), you represent that you have reviewed these Terms with a parent or legal guardian who agrees on your behalf.</li>
          <li>By using the Service, you represent and warrant that you have the legal capacity to enter into a binding agreement.</li>
          <li>You agree to use the Service only in compliance with all applicable local, national, and international laws and regulations.</li>
        </ul>
        <div class="callout-warn">
          <p><strong>Age requirement:</strong> InboxOro does not knowingly collect information from or provide services to individuals under 13 years of age. If we become aware that a user under 13 has accessed the Service, we will take steps to restrict that access immediately.</p>
        </div>
      </section>

      <!-- SECTION 3 -->
      <section class="tos-section" id="t3">
        <div class="section-header">
          <div class="section-num">03</div>
          <h2 class="section-title">Description of Service</h2>
        </div>
        <p>InboxOro is a <strong>free, no-registration disposable email platform</strong>. The Service provides the following core functionality:</p>
        <ul class="tos-list check">
          <li>Instant generation of temporary, randomly assigned email addresses</li>
          <li>A web-based inbox interface to view emails received at that address</li>
          <li>Automatic, permanent deletion of all emails and inbox data after 30 to 60 minutes</li>
          <li>Multiple domain options for generating addresses</li>
          <li>Real-time or near-real-time delivery of incoming emails to the temporary inbox</li>
        </ul>
        <h3>Future Features</h3>
        <p>InboxOro may, at its sole discretion, introduce additional features in the future, such as email forwarding, address aliasing, registered accounts, or developer APIs. These features may be subject to separate terms, pricing, or eligibility requirements. This Terms of Service document will be updated accordingly.</p>
        <h3>Service is Free and Ad-Supported</h3>
        <p>InboxOro is provided free of charge. The Service is supported by advertising, including ads served through Google AdSense. By using the Service, you acknowledge and agree that advertisements may be displayed alongside the service interface. Advertisements are served by third-party providers such as Google AdSense, which may use cookies and similar technologies to display personalized or non-personalized ads, and the appearance of any ad does not constitute an endorsement by InboxOro.</p>
        <h3>No Registration Required</h3>
        <p>InboxOro does not currently require users to create accounts, provide personal information, or authenticate in any way to use the core service. This means we have no way to associate activity with a specific individual and no user accounts to delete or modify upon request.</p>
      </section>

      <!-- SECTION 4 -->
      <section class="tos-section" id="t4">
        <div class="section-header">
          <div class="section-num">04</div>
          <h2 class="section-title">No Privacy Guarantee</h2>
        </div>

        <div class="callout-danger">
          <div class="callout-danger-title">
            <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
              <path stroke-linecap="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
            </svg>
            Critical Warning — Inboxes Are Public
          </div>
          <p><strong>Temporary inboxes on InboxOro are publicly accessible and are not intended for private or sensitive communications.</strong> Any person who knows or guesses your temporary email address can access and read all emails in that inbox. There is no password, PIN, authentication, or access control of any kind protecting inbox contents.</p>
          <p>InboxOro <strong>does not guarantee the privacy, confidentiality, or security</strong> of any email content received through the Service. By using InboxOro, you accept full responsibility for what you choose to receive through a temporary inbox.</p>
        </div>

        <h3>What This Means for You</h3>
        <ul class="tos-list danger">
          <li>Do NOT use InboxOro to receive passwords, account recovery codes, banking details, financial statements, or any sensitive credentials</li>
          <li>Do NOT use InboxOro to receive medical records, legal documents, or personally identifiable information</li>
          <li>Do NOT use InboxOro for private or confidential communications of any kind</li>
          <li>Do NOT assume that any email received via InboxOro is visible only to you — it is accessible to anyone with the address</li>
        </ul>

        <h3>No Responsibility for Exposed Data</h3>
        <p>InboxOro shall not be held responsible for any loss, damage, harm, or consequence resulting from unauthorized access to, disclosure of, or interception of email content received through the Service. You use InboxOro <strong>entirely at your own risk</strong>.</p>

        <h3>Intended Use Cases</h3>
        <ul class="tos-list">
          <li>Receiving one-time passwords (OTPs) for sign-ups where privacy is not required</li>
          <li>Avoiding spam by using a disposable address for newsletters or trial registrations</li>
          <li>Developer and QA testing of email delivery pipelines</li>
          <li>Any use case where the content is non-sensitive and email expiry is acceptable</li>
        </ul>

        <div class="callout-warn">
          <p>InboxOro is a <strong>convenience tool</strong>, not a secure communication service. For private, encrypted email communications, please use a dedicated secure email provider.</p>
        </div>
      </section>

      <!-- SECTION 5 -->
      <section class="tos-section" id="t5">
        <div class="section-header">
          <div class="section-num">05</div>
          <h2 class="section-title">Acceptable Use Policy</h2>
        </div>
        <p>InboxOro is provided for lawful, legitimate, and non-abusive purposes only. By using the Service, you agree to the following:</p>

        <h3>You May Use InboxOro To:</h3>
        <ul class="tos-list check">
          <li>Generate temporary email addresses for personal convenience</li>
          <li>Receive non-sensitive verification or signup emails</li>
          <li>Test email delivery functionality during software development</li>
          <li>Avoid sharing your real email address with untrusted websites</li>
          <li>Any lawful purpose that does not harm others or violate these Terms</li>
        </ul>

        <h3>You Must NOT Use InboxOro To:</h3>
        <ul class="tos-list danger">
          <li>Send, distribute, or facilitate spam, unsolicited bulk emails, or phishing messages</li>
          <li>Engage in fraud, identity theft, scamming, or impersonation of any kind</li>
          <li>Create, distribute, or access illegal content of any nature</li>
          <li>Harass, threaten, intimidate, or harm any individual or organization</li>
          <li>Circumvent authentication or access controls of third-party services in a manner that violates their terms</li>
          <li>Register fake accounts or abuse free trial systems of other services in bulk</li>
          <li>Conduct any activity that violates applicable local, national, or international law</li>
          <li>Use automated bots, scripts, or programs to mass-generate addresses without prior written permission</li>
          <li>Attempt to interfere with, disrupt, or overload our infrastructure, servers, or network</li>
          <li>Engage in any activity that could expose InboxOro to legal liability</li>
        </ul>

        <p>InboxOro reserves the right to determine, at its sole discretion, whether any use constitutes a violation of this Acceptable Use Policy. Such determinations are final.</p>
      </section>

      <!-- SECTION 6 -->
      <section class="tos-section" id="t6">
        <div class="section-header">
          <div class="section-num">06</div>
          <h2 class="section-title">Prohibited Activities</h2>
        </div>
        <p>The following activities are strictly prohibited on or through InboxOro. Violation may result in immediate access termination, IP-level blocking, and/or referral to law enforcement:</p>

        <div class="prohibited-grid">
          <div class="prohibited-card">
            <div class="prohibited-card-icon">🚫</div>
            <div class="prohibited-card-name">Spam &amp; Phishing</div>
            <p>Using temporary addresses to send, receive, or facilitate unsolicited bulk emails, phishing campaigns, or deceptive communications.</p>
          </div>
          <div class="prohibited-card">
            <div class="prohibited-card-icon">⚠️</div>
            <div class="prohibited-card-name">Fraud &amp; Scams</div>
            <p>Using the service for financial fraud, advance-fee scams, identity theft, or any deceptive scheme targeting individuals or businesses.</p>
          </div>
          <div class="prohibited-card">
            <div class="prohibited-card-icon">🔞</div>
            <div class="prohibited-card-name">Illegal Content</div>
            <p>Transmitting, accessing, or distributing illegal content of any kind, including but not limited to child sexual abuse material (CSAM), terrorist content, or contraband.</p>
          </div>
          <div class="prohibited-card">
            <div class="prohibited-card-icon">🤖</div>
            <div class="prohibited-card-name">Automated Abuse</div>
            <p>Running bots, scrapers, or automated scripts to mass-generate addresses, flood our servers, or abuse third-party services via InboxOro.</p>
          </div>
          <div class="prohibited-card">
            <div class="prohibited-card-icon">💻</div>
            <div class="prohibited-card-name">System Attacks</div>
            <p>Attempting to hack, exploit, probe, scan, or perform any attack (DDoS, SQL injection, XSS, etc.) against InboxOro's infrastructure or third-party systems accessed via our service.</p>
          </div>
          <div class="prohibited-card">
            <div class="prohibited-card-icon">🎭</div>
            <div class="prohibited-card-name">Impersonation</div>
            <p>Impersonating any person, company, government authority, or InboxOro itself in communications originating from or facilitated by the Service.</p>
          </div>
        </div>

        <div class="callout-danger">
          <div class="callout-danger-title">
            <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
              <path stroke-linecap="round" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/>
            </svg>
            Consequences of Violation
          </div>
          <p>Users who violate these prohibitions may face <strong>immediate IP-level blocking</strong>, permanent restriction from the Service, and reporting of illegal activity to relevant law enforcement authorities in India and/or the user's home jurisdiction. InboxOro cooperates fully with lawful investigations.</p>
        </div>
      </section>

      <!-- SECTION 7 -->
      <section class="tos-section" id="t7">
        <div class="section-header">
          <div class="section-num">07</div>
          <h2 class="section-title">Service Availability</h2>
        </div>
        <p>InboxOro is provided on a best-effort basis. We make no guarantees about the availability, continuity, reliability, or performance of the Service.</p>
        
        <h3>No Uptime Guarantee</h3>
        <ul class="tos-list">
          <li>InboxOro does not guarantee 100% uptime or uninterrupted service access</li>
          <li>The Service may be temporarily unavailable due to maintenance, technical issues, infrastructure upgrades, or circumstances beyond our control</li>
          <li>We may suspend or discontinue the Service, in whole or in part, at any time without prior notice</li>
        </ul>

        <h3>No Responsibility for Delivery Failures</h3>
        <ul class="tos-list">
          <li>We do not guarantee that all emails sent to a temporary address will be received, displayed correctly, or delivered in a timely manner</li>
          <li>Emails may be delayed, filtered, lost, or rejected at any point during transmission</li>
          <li>InboxOro is not responsible for any loss or damage resulting from failure to receive expected emails</li>
        </ul>

        <h3>Data Loss on Expiry</h3>
        <p>All temporary inboxes and their email contents are <strong>permanently and irreversibly deleted</strong> after the expiry window (typically 30–60 minutes). We are not responsible for any data loss resulting from the expiry of a temporary inbox. Do not rely on InboxOro for the long-term storage of any important information.</p>

        <div class="callout-neutral">
          <p>InboxOro provides no Service Level Agreement (SLA) of any kind. The Service is offered "as-is" for convenience purposes only. Do not use it for mission-critical workflows that require guaranteed delivery or availability.

            We may retain limited server logs, including IP addresses and request metadata, for security, abuse prevention, and legal compliance purposes.
          </p>
        </div>
      </section>

      <!-- SECTION 8 -->
      <section class="tos-section" id="t8">
        <div class="section-header">
          <div class="section-num">08</div>
          <h2 class="section-title">Intellectual Property</h2>
        </div>

        <h3>Our Property</h3>
        <p>All intellectual property in and relating to InboxOro — including but not limited to the name "InboxOro," the Website design, source code, user interface, graphics, logos, trademarks, and service architecture — is the exclusive property of InboxOro and its owners. All rights are reserved.</p>
        <ul class="tos-list">
          <li>You may not copy, reproduce, distribute, or create derivative works of any part of the Service without our express written permission</li>
          <li>You may not use the InboxOro name, logo, or branding in any way that implies endorsement or affiliation without our prior written consent</li>
          <li>You may not reverse-engineer, decompile, or attempt to extract the source code of any part of the Service</li>
        </ul>

        <h3>Your Content</h3>
        <p>InboxOro does not claim ownership over emails received into temporary inboxes. However, by using the Service, you acknowledge that:</p>
        <ul class="tos-list">
          <li>Emails received in temporary inboxes are transiently stored on our infrastructure and are accessible to any person with the corresponding email address</li>
          <li>You have no proprietary rights over the temporary email address itself — it is system-generated and may be re-assigned after expiry</li>
          <li>We may access email content to the extent necessary to deliver the Service, prevent abuse, or comply with legal obligations</li>
        </ul>

        <h3>Limited License</h3>
        <p>Subject to these Terms, InboxOro grants you a limited, non-exclusive, non-transferable, revocable license to access and use the Service for personal, non-commercial purposes. This license does not permit resale, sublicensing, or commercial exploitation of the Service in any form.</p>
      </section>

      <!-- SECTION 9 -->
      <section class="tos-section" id="t9">
        <div class="section-header">
          <div class="section-num">09</div>
          <h2 class="section-title">Third-Party Services</h2>
        </div>
        <p>InboxOro integrates with and relies upon several third-party services to operate. By using InboxOro, you acknowledge that these services may process certain data about you in accordance with their own privacy policies and terms.</p>

        <h3>Google Analytics <span class="tag tag-b">Analytics</span></h3>
        <p>We use Google Analytics to measure and analyze how visitors interact with the Service. Google Analytics may collect your IP address, browser type, device type, and behavioral data via cookies. This data is anonymized and aggregated. You can opt out at <a href="https://tools.google.com/dlpage/gaoptout" target="_blank" rel="noopener">tools.google.com/dlpage/gaoptout</a>.</p>

        <h3>Google AdSense <span class="tag tag-y">Advertising</span></h3>
        <p>InboxOro displays advertisements served by Google AdSense. Google may use cookies and browsing data to serve personalized advertisements based on your prior visits to this and other websites. InboxOro does not control which ads are shown and receives no information about individual ad viewers from Google. Manage your ad preferences at <a href="https://adssettings.google.com" target="_blank" rel="noopener">adssettings.google.com</a>.</p>

        <h3>Email Infrastructure <span class="tag tag-g">Mail Delivery</span></h3>
        <p>InboxOro relies on third-party email receiving infrastructure (SMTP relay and processing services) to accept and route incoming emails to temporary inboxes. These providers operate under their own data processing terms and handle email content solely for the purpose of delivery.</p>

        <h3>Cloud Hosting <span class="tag tag-b">Infrastructure</span></h3>
        <p>Our servers and infrastructure are hosted on third-party cloud platforms. These providers may have access to server-level operational data under their own terms of service and data processing agreements.</p>

        <h3>Third-Party Links</h3>
        <p>The Service may contain links to third-party websites or services. InboxOro is not responsible for the content, privacy practices, or terms of any third-party site. Visiting third-party links is done entirely at your own risk.</p>

        <div class="callout-neutral">
          <p>InboxOro does not sell personal data to any third party. We share only the minimum data necessary to operate the Service. All third-party providers are contractually prohibited from using your data for independent commercial purposes.</p>
        </div>
      </section>

      <!-- SECTION 10 -->
      <section class="tos-section" id="t10">
        <div class="section-header">
          <div class="section-num">10</div>
          <h2 class="section-title">Disclaimer of Warranties</h2>
        </div>

        <div class="disclaimer-block">
          <p><strong>THE SERVICE IS PROVIDED "AS IS," "AS AVAILABLE," AND "WITH ALL FAULTS," WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED.</strong></p>
          <p>To the fullest extent permitted by applicable law, InboxOro expressly disclaims all warranties, whether express, implied, statutory, or otherwise, including but not limited to:</p>
          <p>— Any implied warranty of merchantability, fitness for a particular purpose, or non-infringement;<br>
             — Any warranty that the Service will be uninterrupted, error-free, virus-free, or secure;<br>
             — Any warranty that emails will be received, delivered, or retained for any period of time;<br>
             — Any warranty that the Service will meet your requirements or expectations;<br>
             — Any warranty regarding the accuracy, reliability, or completeness of any content displayed through the Service.</p>
          <p><strong>USE OF InboxOro IS ENTIRELY AT YOUR OWN RISK. YOU ASSUME FULL RESPONSIBILITY FOR ALL RISKS ASSOCIATED WITH ACCESS TO AND USE OF THE SERVICE.</strong></p>
        </div>

        <p>Some jurisdictions do not allow the exclusion of certain warranties. In such jurisdictions, the above exclusions apply only to the maximum extent permitted by law.</p>
      </section>

      <!-- SECTION 11 -->
      <section class="tos-section" id="t11">
        <div class="section-header">
          <div class="section-num">11</div>
          <h2 class="section-title">Limitation of Liability</h2>
        </div>

        <div class="disclaimer-block">
          <p><strong>TO THE MAXIMUM EXTENT PERMITTED BY APPLICABLE LAW, INBOXORO AND ITS OWNERS, OFFICERS, EMPLOYEES, AFFILIATES, AND SERVICE PROVIDERS SHALL NOT BE LIABLE FOR ANY:</strong></p>
          <p>— Indirect, incidental, special, consequential, or punitive damages;<br>
             — Loss of data, emails, business opportunities, profits, or goodwill;<br>
             — Damages arising from unauthorized access to or exposure of inbox content;<br>
             — Damages resulting from service downtime, errors, interruptions, or failures;<br>
             — Damages resulting from reliance on any information provided through the Service;<br>
             — Any other damages, regardless of the legal theory on which the claim is based.</p>
          <p><strong>To the maximum extent permitted by applicable law, InboxOro’s total liability shall be limited.</strong></p>
        </div>

        <p>This limitation of liability applies regardless of whether InboxOro was advised of the possibility of such damages, and regardless of whether any remedy fails of its essential purpose.</p>
        <p>Some jurisdictions do not permit the exclusion or limitation of certain damages. In such cases, the limitations above apply to the fullest extent permitted by law in your jurisdiction.</p>
      </section>

      <!-- SECTION 12 -->
      <section class="tos-section" id="t12">
        <div class="section-header">
          <div class="section-num">12</div>
          <h2 class="section-title">Indemnification</h2>
        </div>
        <p>You agree to <strong>defend, indemnify, and hold harmless</strong> InboxOro and its owners, officers, directors, employees, contractors, agents, and affiliates from and against any and all claims, damages, obligations, losses, liabilities, costs, and expenses (including reasonable legal fees) arising out of or related to:</p>
        <ul class="tos-list">
          <li>Your access to or use of the Service</li>
          <li>Your violation of any provision of these Terms</li>
          <li>Your violation of any applicable law, regulation, or third-party right (including intellectual property rights and privacy rights)</li>
          <li>Any content transmitted through or associated with your temporary inbox</li>
          <li>Any claim that your use of the Service caused damage to a third party</li>
        </ul>
        <p>This indemnification obligation will survive any termination or expiration of these Terms and your use of the Service.</p>
      </section>

      <!-- SECTION 13 -->
      <section class="tos-section" id="t13">
        <div class="section-header">
          <div class="section-num">13</div>
          <h2 class="section-title">Termination &amp; Access Restriction</h2>
        </div>
        <p>InboxOro reserves the right to restrict, suspend, or terminate your access to the Service at any time and for any reason, with or without notice, including but not limited to:</p>

        <ul class="tos-list">
          <li>Violation of any provision of these Terms or our Acceptable Use Policy</li>
          <li>Engaging in any of the Prohibited Activities listed in Section 6</li>
          <li>Suspected involvement in spam, phishing, fraud, or illegal activity</li>
          <li>Generating unusually high volumes of traffic or requests that strain our infrastructure</li>
          <li>Receipt of complaints from third parties or law enforcement about your use of the Service</li>
          <li>Any other reason that InboxOro determines, in its sole discretion, to be grounds for restriction</li>
        </ul>

        <h3>IP Blocking</h3>
        <p>InboxOro may implement <strong>IP-level blocks</strong> to restrict access from specific addresses, ranges, or networks associated with abuse, spam, or policy violations. IP blocks may be temporary or permanent and may affect other users sharing the same IP (e.g., through a VPN or shared network).</p>

        <h3>Effect of Termination</h3>
        <ul class="tos-list">
          <li>Upon termination, your access to the Service will immediately cease</li>
          <li>All temporary inboxes and associated email data will be permanently deleted (or will expire per normal schedule)</li>
          <li>Sections of these Terms that by their nature should survive termination will survive, including Sections 4, 10, 11, 12, and 15</li>
        </ul>

        <div class="callout-warn">
          <p>Because InboxOro requires no registration, we may not be able to provide advance notice of access restriction. Restrictions are based on network-level signals and are enforced automatically in many cases.</p>
        </div>
      </section>

      <!-- SECTION 14 -->
      <section class="tos-section" id="t14">
        <div class="section-header">
          <div class="section-num">14</div>
          <h2 class="section-title">Changes to These Terms</h2>
        </div>
        <p>InboxOro reserves the right to modify, update, or replace these Terms of Service at any time in its sole discretion. Changes may be made to reflect:</p>
        <ul class="tos-list">
          <li>Changes in applicable laws or regulations</li>
          <li>New features, services, or changes to existing functionality</li>
          <li>Security concerns or abuse patterns that require updated policies</li>
          <li>Business decisions or operational changes</li>
        </ul>

        <h3>Notification of Changes</h3>
        <ul class="tos-list">
          <li>When changes are made, we will update the <strong>Effective Date</strong> and <strong>Last Updated</strong> date at the top of this page</li>
          <li>For material changes, we may display a prominent notice on the Website homepage</li>
          <li>It is your responsibility to review these Terms periodically — we recommend checking this page whenever you use the Service after an extended absence</li>
        </ul>

        <p><strong>Your continued use of the Service after any changes to these Terms constitutes your acceptance of the revised Terms.</strong> If you do not agree to the updated Terms, you must stop using the Service immediately.</p>
        <p>Previous versions of these Terms are available upon request by contacting us at <a href="mailto:support@inboxoro.com">support@inboxoro.com</a>.</p>
      </section>

      <!-- SECTION 15 -->
      <section class="tos-section" id="t15">
        <div class="section-header">
          <div class="section-num">15</div>
          <h2 class="section-title">Governing Law &amp; Jurisdiction</h2>
        </div>
        <p>These Terms of Service shall be governed by and construed in accordance with the <strong>laws of India</strong>, without regard to its conflict of law provisions.</p>

        <h3>Jurisdiction</h3>
        <p>Any disputes arising out of or in connection with these Terms, the Service, or your use of InboxOro shall be subject to the <strong>exclusive jurisdiction of the courts located in Kolkata, West Bengal, India</strong>.</p>

        <h3>Dispute Resolution</h3>
        <ul class="tos-list">
          <li>Before initiating any formal legal proceedings, you agree to first attempt to resolve the dispute informally by contacting us at <a href="mailto:support@inboxorI.com">support@inboxorI.com</a></li>
          <li>We will make reasonable efforts to resolve any complaint or dispute within 30 calendar days of receiving written notice</li>
          <li>If informal resolution fails, disputes shall be resolved by competent courts in Kolkata, West Bengal, India</li>
        </ul>

        <h3>International Users</h3>
        <p>InboxOro is operated from India. If you access the Service from outside India, you do so at your own initiative and are solely responsible for ensuring compliance with the laws of your own jurisdiction. Use of the Service does not exempt you from local legal obligations.</p>

        <div class="callout-neutral">
          <p>If any provision of these Terms is found to be unenforceable or invalid under applicable law, that provision shall be modified to the minimum extent necessary to make it enforceable, and all other provisions shall remain in full force and effect.</p>
        </div>
      </section>

      <!-- SECTION 16 -->
      <section class="tos-section" id="t16">
        <div class="section-header">
          <div class="section-num">16</div>
          <h2 class="section-title">Contact Information</h2>
        </div>
        <p>If you have any questions, concerns, feedback, or legal inquiries regarding these Terms of Service, please contact us. We aim to respond to all queries within <strong>5 business days</strong>.</p>

        <div class="contact-box">
          <div class="contact-box-title">Reach InboxOro</div>
          <div class="contact-box-sub">We take all legal and policy inquiries seriously.</div>

          <div class="contact-row">
            <div class="contact-icon">
              <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="#FACC15" stroke-width="2">
                <path stroke-linecap="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
              </svg>
            </div>
            <div>
              <div class="contact-label">General &amp; Terms Inquiries</div>
              <div class="contact-value"><a href="mailto:support@I.com">support@inboxoro.com</a></div>
            </div>
          </div>

          <div class="contact-row">
            <div class="contact-icon">
              <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="#FACC15" stroke-width="2">
                <path stroke-linecap="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
              </svg>
            </div>
            <div>
              <div class="contact-label">Abuse Reports &amp; Violations</div>
              <div class="contact-value"><a href="mailto:support@inboxoro.com">support@inboxoro.com</a> — Subject: "Abuse Report"</div>
            </div>
          </div>

          <div class="contact-row">
            <div class="contact-icon">
              <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="#FACC15" stroke-width="2">
                <path stroke-linecap="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
              </svg>
            </div>
            <div>
              <div class="contact-label">Jurisdiction</div>
              <div class="contact-value">Kolkata, West Bengal, India</div>
            </div>
          </div>

          <div class="contact-row">
            <div class="contact-icon">
              <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="#FACC15" stroke-width="2">
                <path stroke-linecap="round" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064"/>
              </svg>
            </div>
            <div>
              <div class="contact-label">Website</div>
              <div class="contact-value"><a href="https://inboxoro.com" target="_blank" rel="noopener">https://inboxoro.com</a></div>
            </div>
          </div>
        </div>

        <p style="margin-top:20px; font-size:.85rem; color:var(--MU);">These Terms of Service were last updated on <strong>March 28, 2026</strong>. They constitute the entire agreement between you and InboxOro with respect to your use of the Service, superseding all prior agreements and understandings. These Terms are written in plain English for clarity and are not a substitute for qualified legal counsel.</p>
      </section>

    </div><!-- /content-col -->

    <!-- ── Sidebar TOC ── -->
    <aside class="sidebar-toc" aria-label="Section navigation">
      <div class="sidebar-toc-title">On This Page</div>
      <ul class="sidebar-toc-list">
        <li><a href="#t1"><span class="s-num">01</span> Introduction</a></li>
        <li><a href="#t2"><span class="s-num">02</span> Acceptance of Terms</a></li>
        <li><a href="#t3"><span class="s-num">03</span> Description of Service</a></li>
        <li><a href="#t4"><span class="s-num">04</span> No Privacy Guarantee</a></li>
        <li><a href="#t5"><span class="s-num">05</span> Acceptable Use</a></li>
        <li><a href="#t6"><span class="s-num">06</span> Prohibited Activities</a></li>
        <li><a href="#t7"><span class="s-num">07</span> Service Availability</a></li>
        <li><a href="#t8"><span class="s-num">08</span> Intellectual Property</a></li>
        <li><a href="#t9"><span class="s-num">09</span> Third-Party Services</a></li>
        <li><a href="#t10"><span class="s-num">10</span> Disclaimer of Warranties</a></li>
        <li><a href="#t11"><span class="s-num">11</span> Limitation of Liability</a></li>
        <li><a href="#t12"><span class="s-num">12</span> Indemnification</a></li>
        <li><a href="#t13"><span class="s-num">13</span> Termination</a></li>
        <li><a href="#t14"><span class="s-num">14</span> Changes to Terms</a></li>
        <li><a href="#t15"><span class="s-num">15</span> Governing Law</a></li>
        <li><a href="#t16"><span class="s-num">16</span> Contact</a></li>
      </ul>
    </aside>

  </div><!-- /page-wrap -->
</main>

<!-- ══ FOOTER ════════════════════════════════════════════════════ -->
@include('inboxoro.partials.footer')

<script>
  /* ── Reading progress bar ──────────────────────────────────── */
  const bar   = document.getElementById('readProgress');
  const btop  = document.getElementById('backTop');

  window.addEventListener('scroll', () => {
    const d   = document.documentElement;
    const pct = (d.scrollTop / (d.scrollHeight - d.clientHeight)) * 100;
    bar.style.width = pct + '%';
    btop.classList.toggle('show', d.scrollTop > 400);
  }, { passive: true });

  /* ── Scroll reveal ─────────────────────────────────────────── */
  const io = new IntersectionObserver(entries => {
    entries.forEach(e => {
      if (e.isIntersecting) { e.target.classList.add('visible'); io.unobserve(e.target); }
    });
  }, { threshold: 0.05, rootMargin: '0px 0px -40px 0px' });
  document.querySelectorAll('.tos-section').forEach(s => io.observe(s));

  /* ── Active section highlighting (sidebar + top TOC) ──────── */
  const sections   = document.querySelectorAll('.tos-section');
  const sideLinks  = document.querySelectorAll('.sidebar-toc-list a');
  const topLinks   = document.querySelectorAll('.toc-link');

  const sio = new IntersectionObserver(entries => {
    entries.forEach(e => {
      if (e.isIntersecting) {
        const id = '#' + e.target.id;
        sideLinks.forEach(l => l.classList.toggle('active', l.getAttribute('href') === id));
        topLinks.forEach(l => l.classList.toggle('active', l.getAttribute('href') === id));
      }
    });
  }, { threshold: 0.35 });
  sections.forEach(s => sio.observe(s));
</script>

</body>
</html>