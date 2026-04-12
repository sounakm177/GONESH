<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="description" content="Privacy Policy for inboxOro — disposable temporary email service. Learn how we handle your data." />
  <title>Privacy Policy — inboxOro</title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Outfit:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;600;700&display=swap" rel="stylesheet">

  <style>
    /* ── Variables ─────────────────────────────────────────────── */
    :root {
      --Y:       #FACC15;
      --Y-dim:   rgba(250,204,21,.12);
      --Y-line:  rgba(250,204,21,.25);
      --B:       #2563EB;
      --INK:     #1F2937;
      --BG:      #F8FAFC;
      --CARD:    #ffffff;
      --BD:      #E5E7EB;
      --MU:      #6B7280;
      --DANGER:  #DC2626;
      --DANGER-D:rgba(220,38,38,.08);
      --MONO:    'JetBrains Mono', monospace;
      --DISPLAY: 'Bebas Neue', sans-serif;
      --BODY:    'Outfit', sans-serif;
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
      content: 'PRIVACY';
      position: absolute;
      right: -20px;
      top: 50%;
      transform: translateY(-50%);
      font-family: var(--DISPLAY);
      font-size: clamp(6rem, 14vw, 12rem);
      color: rgba(255,255,255,.03);
      letter-spacing: .04em;
      pointer-events: none;
      user-select: none;
      white-space: nowrap;
    }
    .hero-inner { max-width: 860px; margin: 0 auto; position: relative; z-index: 1; }
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
      max-width: 860px;
      margin: 0 auto;
      display: flex;
      gap: 0;
    }
    .toc-link {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      padding: 14px 16px;
      font-family: var(--MONO);
      font-size: .62rem;
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
    .toc-num {
      font-size: .55rem;
      background: var(--BD);
      color: var(--MU);
      padding: 1px 5px;
      font-weight: 800;
    }

    /* ── MAIN LAYOUT ───────────────────────────────────────────── */
    .page-wrap {
      max-width: 860px;
      margin: 0 auto;
      padding: 52px 40px 80px;
    }

    /* ── SECTION ───────────────────────────────────────────────── */
    .policy-section {
      margin-bottom: 60px;
      scroll-margin-top: 80px;
      opacity: 0;
      transform: translateY(18px);
      transition: opacity .55s ease, transform .55s ease;
    }
    .policy-section.visible { opacity: 1; transform: translateY(0); }

    .section-header {
      display: flex;
      align-items: center;
      gap: 14px;
      margin-bottom: 22px;
      padding-bottom: 14px;
      border-bottom: 2px solid var(--BD);
    }
    .section-num {
      font-family: var(--DISPLAY);
      font-size: 1.5rem;
      color: var(--Y);
      line-height: 1;
      min-width: 36px;
    }
    .section-title {
      font-family: var(--DISPLAY);
      font-size: 1.55rem;
      letter-spacing: .04em;
      color: var(--INK);
      line-height: 1;
    }

    /* body text */
    .policy-section p {
      font-size: .95rem;
      color: var(--INK);
      margin-bottom: 14px;
      line-height: 1.75;
    }
    .policy-section p:last-child { margin-bottom: 0; }

    /* sub-headings */
    .policy-section h3 {
      font-family: var(--BODY);
      font-size: .82rem;
      font-weight: 700;
      letter-spacing: .07em;
      text-transform: uppercase;
      color: var(--MU);
      margin: 24px 0 10px;
    }

    /* bullet lists */
    .policy-list {
      list-style: none;
      margin: 10px 0 16px;
      padding: 0;
      display: flex;
      flex-direction: column;
      gap: 8px;
    }
    .policy-list li {
      display: flex;
      align-items: flex-start;
      gap: 10px;
      font-size: .93rem;
      color: var(--INK);
      line-height: 1.65;
    }
    .policy-list li::before {
      content: '';
      width: 6px;
      height: 6px;
      background: var(--Y);
      border: 1.5px solid var(--INK);
      border-radius: 50%;
      flex-shrink: 0;
      margin-top: 8px;
    }

    /* ── CALLOUT BOXES ─────────────────────────────────────────── */
    /* Warning (red) */
    .callout-danger {
      background: var(--DANGER-D);
      border: 2px solid var(--DANGER);
      border-left-width: 6px;
      padding: 18px 20px;
      margin: 20px 0;
    }
    .callout-danger-title {
      display: flex;
      align-items: center;
      gap: 8px;
      font-family: var(--MONO);
      font-size: .72rem;
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

    /* Info (yellow) */
    .callout-info {
      background: var(--Y-dim);
      border: 1.5px solid var(--Y-line);
      border-left: 5px solid var(--Y);
      padding: 16px 20px;
      margin: 18px 0;
    }
    .callout-info p {
      font-size: .88rem !important;
      color: #78350F !important;
      margin-bottom: 8px !important;
    }
    .callout-info p:last-child { margin-bottom: 0 !important; }

    /* Neutral (gray) */
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

    /* ── DATA TABLE ─────────────────────────────────────────────── */
    .data-table {
      width: 100%;
      border-collapse: collapse;
      margin: 16px 0;
      font-size: .87rem;
    }
    .data-table th {
      background: var(--INK);
      color: var(--Y);
      font-family: var(--MONO);
      font-size: .62rem;
      font-weight: 700;
      letter-spacing: .1em;
      text-transform: uppercase;
      padding: 10px 14px;
      text-align: left;
    }
    .data-table td {
      padding: 11px 14px;
      border-bottom: 1px solid var(--BD);
      color: var(--INK);
      vertical-align: top;
      line-height: 1.55;
    }
    .data-table tr:last-child td { border-bottom: none; }
    .data-table tr:nth-child(even) td { background: #FAFAFA; }
    .data-table .tag {
      display: inline-block;
      font-family: var(--MONO);
      font-size: .6rem;
      font-weight: 700;
      letter-spacing: .06em;
      padding: 2px 7px;
      text-transform: uppercase;
    }
    .tag-auto   { background: #DBEAFE; color: #1E40AF; }
    .tag-temp   { background: #D1FAE5; color: #065F46; }
    .tag-del    { background: #FEE2E2; color: #991B1B; }
    .tag-third  { background: #EDE9FE; color: #5B21B6; }

    /* ── COOKIE TYPE CARDS ─────────────────────────────────────── */
    .cookie-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 12px;
      margin: 16px 0;
    }
    .cookie-card {
      border: 2px solid var(--BD);
      padding: 16px 18px;
      background: var(--CARD);
      transition: border-color .15s, box-shadow .15s;
    }
    .cookie-card:hover { border-color: var(--INK); box-shadow: 4px 4px 0 var(--BD); }
    .cookie-card-label {
      font-family: var(--MONO);
      font-size: .62rem;
      font-weight: 700;
      letter-spacing: .1em;
      text-transform: uppercase;
      color: var(--MU);
      margin-bottom: 6px;
    }
    .cookie-card-name {
      font-family: var(--DISPLAY);
      font-size: 1.1rem;
      letter-spacing: .03em;
      color: var(--INK);
      margin-bottom: 6px;
    }
    .cookie-card p {
      font-size: .8rem !important;
      color: var(--MU) !important;
      line-height: 1.5 !important;
      margin-bottom: 0 !important;
    }
    .cookie-required {
      display: inline-block;
      font-family: var(--MONO);
      font-size: .55rem;
      font-weight: 700;
      letter-spacing: .08em;
      text-transform: uppercase;
      padding: 2px 7px;
      margin-top: 8px;
    }
    .req-yes { background: #FEF9C3; color: #92400E; }
    .req-opt { background: #F3F4F6; color: var(--MU); }

    /* ── THIRD PARTY CARDS ──────────────────────────────────────── */
    .tp-card {
      display: flex;
      align-items: flex-start;
      gap: 16px;
      border: 2px solid var(--BD);
      padding: 18px 20px;
      background: var(--CARD);
      margin-bottom: 12px;
      transition: border-color .15s;
    }
    .tp-card:hover { border-color: var(--INK); }
    .tp-icon {
      width: 40px;
      height: 40px;
      border: 2px solid var(--INK);
      display: flex;
      align-items: center;
      justify-content: center;
      font-family: var(--DISPLAY);
      font-size: 1rem;
      color: var(--INK);
      flex-shrink: 0;
      background: #F9FAFB;
    }
    .tp-body { flex: 1; min-width: 0; }
    .tp-name {
      font-weight: 700;
      font-size: .95rem;
      color: var(--INK);
      margin-bottom: 3px;
    }
    .tp-desc { font-size: .83rem !important; color: var(--MU) !important; margin-bottom: 8px !important; }
    .tp-link {
      font-family: var(--MONO);
      font-size: .65rem;
      font-weight: 700;
      letter-spacing: .06em;
      color: var(--B);
    }

    /* ── CONTACT BOX ───────────────────────────────────────────── */
    .contact-box {
      border: 2px solid var(--INK);
      box-shadow: 6px 6px 0 var(--INK);
      padding: 28px 32px;
      background: var(--CARD);
      margin-top: 10px;
    }
    .contact-box-title {
      font-family: var(--DISPLAY);
      font-size: 1.4rem;
      letter-spacing: .04em;
      color: var(--INK);
      margin-bottom: 6px;
    }
    .contact-box-sub {
      font-size: .85rem;
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
      width: 36px;
      height: 36px;
      background: var(--INK);
      display: flex;
      align-items: center;
      justify-content: center;
      flex-shrink: 0;
    }
    .contact-label {
      font-family: var(--MONO);
      font-size: .6rem;
      font-weight: 700;
      letter-spacing: .1em;
      text-transform: uppercase;
      color: var(--MU);
      margin-bottom: 1px;
    }
    .contact-value {
      font-size: .9rem;
      font-weight: 600;
      color: var(--INK);
    }
    .contact-value a { color: var(--B); font-weight: 700; }

    /* ── FOOTER ────────────────────────────────────────────────── */
    .site-footer {
      background: var(--INK);
      border-top: 3px solid var(--Y);
      padding: 24px 40px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      flex-wrap: wrap;
      gap: 12px;
    }
    .footer-logo {
      font-family: var(--DISPLAY);
      font-size: 1.3rem;
      color: var(--Y);
      letter-spacing: .03em;
    }
    .footer-logo span { color: #fff; }
    .footer-links {
      display: flex;
      gap: 20px;
      flex-wrap: wrap;
    }
    .footer-links a {
      font-size: .73rem;
      color: #6B7280;
      text-decoration: none;
      font-weight: 500;
    }
    .footer-links a:hover { color: var(--Y); }
    .footer-copy {
      font-family: var(--MONO);
      font-size: .62rem;
      color: #4B5563;
      letter-spacing: .04em;
    }

    /* ── PROGRESS BAR ──────────────────────────────────────────── */
    .read-progress {
      position: fixed;
      top: 0;
      left: 0;
      height: 3px;
      background: var(--Y);
      width: 0%;
      z-index: 999;
      transition: width .1s linear;
    }

    /* ── BACK TO TOP ───────────────────────────────────────────── */
    .back-top {
      position: fixed;
      bottom: 28px;
      right: 28px;
      width: 44px;
      height: 44px;
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

    /* ── RESPONSIVE ────────────────────────────────────────────── */
    @media (max-width: 768px) {
      .site-nav { padding: 0 20px; }
      .hero-band { padding: 36px 20px 32px; }
      .toc-strip { padding: 0 20px; }
      .page-wrap { padding: 36px 20px 60px; }
      .cookie-grid { grid-template-columns: 1fr; }
      .site-footer { padding: 20px; flex-direction: column; gap: 14px; text-align: center; }
      .footer-links { justify-content: center; }
      .contact-box { padding: 20px; }
    }

    /* ── PRINT ─────────────────────────────────────────────────── */
    @media print {
      .site-nav, .toc-strip, .read-progress, .back-top { display: none; }
      .policy-section { opacity: 1 !important; transform: none !important; }
      body { background: white; }
    }
  </style>
</head>
<body>

<!-- Reading progress bar -->
<div class="read-progress" id="readProgress"></div>

<!-- Back to top -->
<button class="back-top" id="backTop" onclick="window.scrollTo({top:0,behavior:'smooth'})" aria-label="Back to top">
  <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
    <path stroke-linecap="round" stroke-linejoin="round" d="M5 15l7-7 7 7"/>
  </svg>
</button>



<!-- ══ NAV ══════════════════════════════════════════════════════ -->
<nav class="site-nav">
  <a href="/" class="nav-logo">
    <img src="{{asset('/images/logo.svg')}}" alt="Inboxoro Logo" class="logo-img">
  </a>
  <a href="/" class="nav-back">
    <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
      <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
    </svg>
    Back to App
  </a>
</nav>

<!-- ══ HERO ══════════════════════════════════════════════════════ -->
<header class="hero-band">
  <div class="hero-inner">
    <div class="hero-tag">Legal Document</div>
    <h1 class="hero-title">
      Privacy<br><span class="gold">Policy</span>
    </h1>
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
    </div>
  </div>
</header>

<!-- ══ TOC STRIP ═════════════════════════════════════════════════ -->
<nav class="toc-strip" aria-label="Table of contents">
  <div class="toc-inner">
    <a class="toc-link" href="#s1"><span class="toc-num">01</span> Introduction</a>
    <a class="toc-link" href="#s2"><span class="toc-num">02</span> Data Collected</a>
    <a class="toc-link" href="#s3"><span class="toc-num">03</span> How We Use It</a>
    <a class="toc-link" href="#s4"><span class="toc-num">04</span> Inbox Disclaimer</a>
    <a class="toc-link" href="#s5"><span class="toc-num">05</span> Retention</a>
    <a class="toc-link" href="#s6"><span class="toc-num">06</span> Cookies</a>
    <a class="toc-link" href="#s7"><span class="toc-num">07</span> Third Parties</a>
    <a class="toc-link" href="#s8"><span class="toc-num">08</span> Security</a>
    <a class="toc-link" href="#s9"><span class="toc-num">09</span> Your Responsibility</a>
    <a class="toc-link" href="#s10"><span class="toc-num">10</span> Policy Changes</a>
    <a class="toc-link" href="#s11"><span class="toc-num">11</span> Your Rights</a>
    <a class="toc-link" href="#s12"><span class="toc-num">12</span> Contact</a>
    <a class="toc-link" href="#s13"><span class="toc-num">13</span> Liability</a>
  </div>
</nav>

<!-- ══ CONTENT ══════════════════════════════════════════════════ -->
<main class="page-wrap">

  <!-- ── SECTION 1: Introduction ── -->
  <section class="policy-section" id="s1">
    <div class="section-header">
      <div class="section-num">01</div>
      <h2 class="section-title">Introduction</h2>
    </div>

    <p>Welcome to <strong>inboxOro</strong> ("we," "us," or "our") — a free, disposable temporary email service available at <a href="https://inboxoro.com">inboxoro.com</a>. This Privacy Policy explains what information we collect, why we collect it, how we use it, and your rights in relation to that information.</p>

    <p>By accessing or using inboxOro, you agree to the practices described in this Privacy Policy. If you disagree with any part of this policy, please discontinue use of the service.</p>

    <div class="callout-info">
      <p><strong>Plain-language summary:</strong> inboxOro is a tool for generating disposable email addresses. We collect minimal data (like your IP address and browser info) to keep the service running and prevent abuse. We don't require registration, and we don't sell your data.
      Emails received in temporary inboxes are automatically deleted after a short period — however, they are <em>not</em> private.</p>
    </div>

    <p>This policy applies to all users of inboxOro, including visitors who use the temporary email generator without creating an account.</p>
  </section>

  <!-- ── SECTION 2: Information We Collect ── -->
  <section class="policy-section" id="s2">
    <div class="section-header">
      <div class="section-num">02</div>
      <h2 class="section-title">Information We Collect</h2>
    </div>

    <p>inboxOro is designed to be used without registration. As a result, we collect very limited personal information. Here is a breakdown of what we may collect and why:</p>

    <table class="data-table" aria-label="Data collection overview">
      <thead>
        <tr>
          <th>Data Type</th>
          <th>How Collected</th>
          <th>Purpose</th>
          <th>Category</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><strong>IP Address</strong></td>
          <td>Automatically via your browser</td>
          <td>Abuse prevention, rate limiting, server logs</td>
          <td><span class="tag tag-auto">Automatic</span></td>
        </tr>
        <tr>
          <td><strong>Browser Type &amp; Version</strong></td>
          <td>Automatically via HTTP headers</td>
          <td>Compatibility, analytics</td>
          <td><span class="tag tag-auto">Automatic</span></td>
        </tr>
        <tr>
          <td><strong>Device &amp; OS Info</strong></td>
          <td>Automatically via user-agent</td>
          <td>Analytics, responsive design improvements</td>
          <td><span class="tag tag-auto">Automatic</span></td>
        </tr>
        <tr>
          <td><strong>Pages Visited &amp; Actions</strong></td>
          <td>Google Analytics</td>
          <td>Usage patterns, feature improvement</td>
          <td><span class="tag tag-third">Third-party</span></td>
        </tr>
        <tr>
          <td><strong>Temporary Inbox Emails</strong></td>
          <td>Sent by third parties to your temp address</td>
          <td>Display in the inbox UI</td>
          <td><span class="tag tag-temp">Temporary</span></td>
        </tr>
        <tr>
          <td><strong>Referral / Source URL</strong></td>
          <td>Automatically via browser</td>
          <td>Marketing analytics</td>
          <td><span class="tag tag-auto">Automatic</span></td>
        </tr>
      </tbody>
    </table>

    <h3>What We Do Not Collect</h3>
    <ul class="policy-list">
      <li>Full legal names or physical addresses</li>
      <li>Payment or financial information (the service is free)</li>
      <li>Government-issued identification numbers</li>
      <li>Passwords or authentication credentials</li>
      <li>Sensitive personal data (health, biometric, racial or ethnic origin, etc.)</li>
    </ul>

    <div class="callout-neutral">
      <p>If we introduce registered accounts or API access in the future, we may collect additional information such as an email address or API key. This policy will be updated before any such change goes live.</p>
    </div>
  </section>

  <!-- ── SECTION 3: How We Use Information ── -->
  <section class="policy-section" id="s3">
    <div class="section-header">
      <div class="section-num">03</div>
      <h2 class="section-title">How We Use Information</h2>
    </div>

    <p>We use the information we collect for the following purposes only:</p>

    <h3>Service Operation</h3>
    <ul class="policy-list">
      <li>Generate and serve temporary email addresses to users</li>
      <li>Receive, display, and automatically delete emails in temporary inboxes</li>
      <li>Route emails to the correct temporary mailbox</li>
      <li>Maintain service uptime and infrastructure reliability</li>
    </ul>

    <h3>Abuse Prevention &amp; Security</h3>
    <ul class="policy-list">
      <li>Detect, block, and investigate spam, bot abuse, and fraudulent activity</li>
      <li>Apply rate limiting to prevent overuse or denial-of-service attempts</li>
      <li>Enforce our Terms of Service and Acceptable Use Policy</li>
      <li>Cooperate with law enforcement where legally required</li>
    </ul>

    <h3>Performance &amp; Improvement</h3>
    <ul class="policy-list">
      <li>Analyze aggregate traffic trends to improve service performance</li>
      <li>Understand which features are most valuable to users</li>
      <li>Diagnose and resolve technical bugs and performance bottlenecks</li>
    </ul>

    <h3>Advertising</h3>
    <ul class="policy-list">
      <li>Display ads via Google AdSense to support free access to the service</li>
      <li>Advertising partners may use cookies to serve personalized ads — see Section 7</li>
    </ul>

    <h3>Legal Basis for Processing (GDPR)</h3>
    <ul class="policy-list">
      <li>Legitimate interest — to operate, secure, and improve the service</li>
      <li>Consent — for cookies, analytics, and advertising where required</li>
      <li>Legal obligation — where we are required to comply with applicable laws</li>
    </ul>

    <p>We do <strong>not</strong> sell, rent, or trade your personal information to third parties for their marketing purposes.</p>
  </section>

  <!-- ── SECTION 4: Temporary Email Disclaimer ── -->
  <section class="policy-section" id="s4">
    <div class="section-header">
      <div class="section-num">04</div>
      <h2 class="section-title">Temporary Email Disclaimer</h2>
    </div>

    <div class="callout-danger">
      <div class="callout-danger-title">
        <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
          <path stroke-linecap="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
        </svg>
        Critical: Temporary Inboxes Are NOT Private
      </div>
      <p>Any email sent to an inboxOro temporary address can be read by <strong>anyone who knows that email address</strong>. There is no password, authentication, or access control protecting your temporary inbox.</p>
      <p><strong>Do not use inboxOro to receive:</strong> passwords, banking or financial information, medical records, legal documents, personal identification data, or any other sensitive or confidential information.</p>
      <p>inboxOro does not guarantee the privacy, confidentiality, or security of any content received in a temporary inbox.</p>
      <p><strong>By using this service, you explicitly acknowledge and accept that all temporary inboxes are public and accessible without authentication.</strong></p>
    </div>

    <h3>How Temporary Addresses Work</h3>
    <ul class="policy-list">
      <li>A unique temporary email address is generated for you instantly — no registration required</li>
      <li>Any email sent to that address appears in the shared public inbox interface</li>
      <li>Anyone who has or guesses the same address can view its contents</li>
      <li>The address and all associated emails are permanently deleted after the expiry period (typically 30–60 minutes)</li>
      <li>Expired inboxes and their contents cannot be recovered under any circumstances</li>
    </ul>

    <h3>Intended Use Cases</h3>
    <ul class="policy-list">
      <li>Receiving verification emails where permitted by the service provider</li>
      <li>Signing up for newsletters or services to avoid inbox clutter</li>
      <li>Verifying email for single-use or testing purposes</li>
      <li>Developer and QA testing of email delivery flows</li>
    </ul>

    <div class="callout-info">
      <p><strong>Remember:</strong> inboxOro is a convenience tool, not a secure communication channel. For private email communication, use an encrypted email provider.</p>
    </div>
  </section>

  <!-- ── SECTION 5: Data Retention ── -->
  <section class="policy-section" id="s5">
    <div class="section-header">
      <div class="section-num">05</div>
      <h2 class="section-title">Data Retention Policy</h2>
    </div>

    <p>We retain different types of data for different lengths of time, depending on purpose and legal obligations.</p>

    <table class="data-table" aria-label="Data retention periods">
      <thead>
        <tr>
          <th>Data Type</th>
          <th>Retention Period</th>
          <th>Deletion Method</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><strong>Temporary Inbox Emails</strong></td>
          <td><span class="tag tag-del">30–60 minutes</span></td>
          <td>Automatic, permanent, irreversible</td>
        </tr>
        <tr>
          <td><strong>Server Access Logs</strong> (IP, timestamps, HTTP codes)</td>
          <td>Up to 30 days</td>
          <td>Automatically deleted or anonymized</td>
        </tr>
        <tr>
          <td><strong>Analytics Data</strong> (Google Analytics)</td>
          <td>Up to 26 months</td>
          <td>Governed by Google's retention policy</td>
        </tr>
        <tr>
          <td><strong>Abuse / Security Incident Logs</strong></td>
          <td>Up to 90 days</td>
          <td>Manually reviewed and deleted</td>
        </tr>
        <tr>
          <td><strong>Legal Hold Data</strong></td>
          <td>As required by law</td>
          <td>Deleted when legal obligation ends</td>
        </tr>
      </tbody>
    </table>

    <p>Once the retention period expires, data is permanently and irreversibly deleted. We do not archive, sell, or transfer expired data to third parties.</p>

    <div class="callout-neutral">
      <p>Because inboxOro does not require user registration and stores no accounts, there is typically no user-specific data we can delete on request — it has already been deleted automatically. For any data retention questions, contact us at <a href="mailto:support@inboxoro.com">support@inboxoro.com</a>.</p>
    </div>
  </section>

  <!-- ── SECTION 6: Cookies ── -->
  <section class="policy-section" id="s6">
    <div class="section-header">
      <div class="section-num">06</div>
      <h2 class="section-title">Cookies Policy</h2>
    </div>

    <p>inboxOro and its third-party partners use cookies and similar tracking technologies (web beacons, pixel tags) to operate the service and deliver advertising. Here is a clear breakdown:</p>

    <div class="cookie-grid">
      <div class="cookie-card">
        <div class="cookie-card-label">Type 01</div>
        <div class="cookie-card-name">Strictly Necessary</div>
        <p>Session management, CSRF protection, and core service functionality. Cannot be disabled without breaking the service.</p>
        <span class="cookie-required req-yes">Required</span>
      </div>
      <div class="cookie-card">
        <div class="cookie-card-label">Type 02</div>
        <div class="cookie-card-name">Analytics Cookies</div>
        <p>Set by Google Analytics to track page views, session duration, and user flow. Data is aggregated and anonymized.</p>
        <span class="cookie-required req-opt">Optional</span>
      </div>
      <div class="cookie-card">
        <div class="cookie-card-label">Type 03</div>
        <div class="cookie-card-name">Advertising Cookies</div>
        <p>Set by Google AdSense to deliver and measure ads. May be used to show personalized ads based on your browsing history.</p>
        <span class="cookie-required req-opt">Optional</span>
      </div>
      <div class="cookie-card">
        <div class="cookie-card-label">Type 04</div>
        <div class="cookie-card-name">Preference Cookies</div>
        <p>May be used to remember your chosen domain, display settings, or other in-app preferences across sessions.</p>
        <span class="cookie-required req-opt">Optional</span>
      </div>
    </div>

    <h3>Managing Your Cookie Preferences</h3>
    <ul class="policy-list">
      <li>You can disable cookies through your browser's settings — note that disabling strictly necessary cookies may break core features</li>
      <li>To opt out of Google Analytics: <a href="https://tools.google.com/dlpage/gaoptout" target="_blank" rel="noopener">Google Analytics Opt-out Add-on</a></li>
      <li>To manage Google ad personalization: <a href="https://adssettings.google.com" target="_blank" rel="noopener">Google Ad Settings</a></li>
      <li>For broad opt-out of interest-based advertising: <a href="https://youronlinechoices.eu" target="_blank" rel="noopener">Your Online Choices (EU)</a> or <a href="https://optout.aboutads.info" target="_blank" rel="noopener">About Ads (US)</a></li>
    </ul>

    <h3>Do Not Track (DNT)</h3>
    <p>Our service does not currently respond to browser Do Not Track signals. We will revise this section if our practice changes.</p>
  </section>

  <!-- ── SECTION 7: Third-Party Services ── -->
  <section class="policy-section" id="s7">
    <div class="section-header">
      <div class="section-num">07</div>
      <h2 class="section-title">Third-Party Services</h2>
    </div>

    <p>We integrate with the following third-party services. Each has its own privacy policy governing how they handle data:</p>

    <div class="tp-card">
      <div class="tp-icon">GA</div>
      <div class="tp-body">
        <div class="tp-name">Google Analytics</div>
        <p class="tp-desc">We use Google Analytics to understand how visitors interact with inboxOro — including which pages are visited, how long sessions last, and where traffic originates. Google Analytics uses cookies to collect this information. Data is aggregated and does not identify individual users.</p>
        <a class="tp-link" href="https://policies.google.com/privacy" target="_blank" rel="noopener">Google Privacy Policy →</a>
        &nbsp;&nbsp;
        <a class="tp-link" href="https://tools.google.com/dlpage/gaoptout" target="_blank" rel="noopener">Opt Out →</a>
      </div>
    </div>

    <div class="tp-card">
      <div class="tp-icon">AS</div>
      <div class="tp-body">
        <div class="tp-name">Google AdSense</div>
        <p class="tp-desc">inboxOro displays advertisements powered by Google AdSense to keep the service free. AdSense may use cookies to show ads relevant to your interests based on prior visits to this and other websites. We do not have direct control over the specific ads shown by Google.</p>
        <a class="tp-link" href="https://policies.google.com/technologies/ads" target="_blank" rel="noopener">AdSense Privacy →</a>
        &nbsp;&nbsp;
        <a class="tp-link" href="https://adssettings.google.com" target="_blank" rel="noopener">Opt Out of Personalized Ads →</a>
      </div>
    </div>

    <div class="tp-card">
      <div class="tp-icon">MX</div>
      <div class="tp-body">
        <div class="tp-name">Email Infrastructure Providers</div>
        <p class="tp-desc">inboxOro relies on SMTP/mail relay infrastructure to receive emails sent to temporary addresses. These providers process email data solely to deliver messages to the correct temporary inbox. They are bound by data processing agreements and may not use your data for independent purposes.</p>
        <a class="tp-link" href="mailto:support@inboxoro.com">Request Provider Details →</a>
      </div>
    </div>

    <div class="tp-card">
      <div class="tp-icon">☁</div>
      <div class="tp-body">
        <div class="tp-name">Cloud Hosting &amp; Infrastructure</div>
        <p class="tp-desc">Our servers are hosted on third-party cloud platforms (such as AWS, Google Cloud Platform, or similar providers). These providers may have access to infrastructure-level data as part of operating our servers. All hosting providers are subject to appropriate data processing agreements.</p>
        <a class="tp-link" href="mailto:support@inboxoro.com">Request Hosting Details →</a>
      </div>
    </div>

    <p>We do not share personal information with any third parties beyond what is described above. We never sell data to data brokers or marketing companies.</p>
  </section>

  <!-- ── SECTION 8: Security ── -->
  <section class="policy-section" id="s8">
    <div class="section-header">
      <div class="section-num">08</div>
      <h2 class="section-title">Security</h2>
    </div>

    <p>We implement reasonable technical and organizational measures to protect the data we collect from unauthorized access, disclosure, alteration, or destruction:</p>

    <ul class="policy-list">
      <li><strong>HTTPS encryption</strong> — all data transmitted between your browser and our servers is encrypted via TLS/SSL</li>
      <li><strong>Automatic deletion</strong> — email content is permanently removed after a short window, reducing exposure risk</li>
      <li><strong>Access controls</strong> — server infrastructure is protected by firewalls, key-based authentication, and role-based access</li>
      <li><strong>Rate limiting</strong> — protects against brute-force attacks and abuse at the network level</li>
      <li><strong>Regular reviews</strong> — periodic security assessments and dependency updates</li>
    </ul>

    <div class="callout-danger">
      <div class="callout-danger-title">
        <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
          <path stroke-linecap="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
        </svg>
        No Inbox is Secure
      </div>
      <p>Despite our infrastructure security measures, <strong>the temporary inbox itself is inherently public</strong>. Any person who knows or can guess your temporary email address can view your inbox. No amount of technical security can protect a public inbox from authorized or unauthorized viewers.</p>
      <p>Never use inboxOro for sensitive communications. No electronic service can guarantee 100% security.</p>
    </div>

    <p>If you discover a security vulnerability in inboxOro, please report it responsibly to <a href="mailto:support@inboxoro.com">support@inboxoro.com</a>. We appreciate responsible disclosure.</p>
  </section>

  <!-- ── SECTION 9: User Responsibility ── -->
  <section class="policy-section" id="s9">
    <div class="section-header">
      <div class="section-num">09</div>
      <h2 class="section-title">Your Responsibility</h2>
    </div>

    <p>By using inboxOro, you accept personal responsibility for how you use the service. Your obligations include:</p>
    <p>This service is not intended for children under the age of 13. We do not knowingly collect personal data from children. If you believe a child has used this service, please contact us and we will take appropriate action.</p>
    
    <h3>Understanding the Public Nature of Inboxes</h3>
    <ul class="policy-list">
      <li>You acknowledge that temporary inboxes are publicly accessible to anyone with the address</li>
      <li>You will not use inboxOro to receive confidential, sensitive, or legally protected information</li>
      <li>You understand that inboxOro cannot recover expired inboxes or deleted emails</li>
    </ul>

    <h3>Acceptable Use</h3>
    <ul class="policy-list">
      <li>You will not use inboxOro to engage in spam, phishing, fraud, or harassment</li>
      <li>You will not use inboxOro to circumvent authentication systems in a manner that violates applicable laws</li>
      <li>You will not use inboxOro to receive or distribute illegal content of any kind</li>
      <li>You will not use inboxOro's API (if available) to overload, disrupt, or reverse-engineer our systems</li>
      <li>You will not use automated scripts to generate large numbers of addresses without prior permission</li>
    </ul>

    <h3>No Account Recovery</h3>
    <p>Because inboxOro requires no registration, we have no account data to recover. If your temporary address expires, all associated emails are permanently gone. We are not liable for any loss of data resulting from expiry or deletion.</p>

    <div class="callout-neutral">
      <p>Violations of our Acceptable Use Policy may result in temporary or permanent IP-level blocks from the service. Illegal activity will be reported to the appropriate authorities.</p>
    </div>
  </section>

  <!-- ── SECTION 10: Changes to Policy ── -->
  <section class="policy-section" id="s10">
    <div class="section-header">
      <div class="section-num">10</div>
      <h2 class="section-title">Changes to This Policy</h2>
    </div>

    <p>We may update this Privacy Policy from time to time to reflect changes in our practices, technology, legal requirements, or for other operational reasons. When we make changes:</p>

    <ul class="policy-list">
      <li>We will update the <strong>Effective Date</strong> and <strong>Last Updated</strong> date at the top of this page</li>
      <li>For material changes, we will display a prominent notice on our website homepage or within the service</li>
      <li>Continued use of inboxOro after any change constitutes your acceptance of the updated policy</li>
    </ul>

    <p>We encourage you to review this policy periodically. Previous versions are available upon request by emailing <a href="mailto:support@inboxoro.com">support@inboxoro.com</a>.</p>

    <div class="callout-info">
      <p>The most important principle guiding any future changes: we will never start selling your personal data, and we will always give advance notice before introducing any features that collect significantly more personal information than described here.</p>
    </div>
  </section>

  <!-- ── SECTION 11: Your Rights ── -->
  <section class="policy-section" id="s11">
    <div class="section-header">
      <div class="section-num">11</div>
      <h2 class="section-title">Your Rights</h2>
    </div>

    <p>Depending on your location, you may have the following rights regarding your data:</p>

    <ul class="policy-list">
      <li>Right to access — request a copy of your data</li>
      <li>Right to correction — request correction of inaccurate data</li>
      <li>Right to deletion — request deletion of your data</li>
      <li>Right to restrict processing</li>
      <li>Right to object to data processing</li>
    </ul>

    <p>Because inboxOro does not store user accounts and data is automatically deleted, most data cannot be retrieved after expiration.</p>
  </section>

  <!-- ── SECTION 12: Contact ── -->
  <section class="policy-section" id="s12">
    <div class="section-header">
      <div class="section-num">12</div>
      <h2 class="section-title">Contact Information</h2>
    </div>

    <p>If you have any questions, concerns, or requests related to this Privacy Policy or how we handle your data, please reach out. We aim to respond to all privacy inquiries within <strong>5 business days</strong> and formal data subject requests within <strong>30 calendar days</strong>.</p>
    <p>This Privacy Policy shall be governed by and interpreted in accordance with the laws of India. Any disputes arising shall be subject to the exclusive jurisdiction of courts located in Kolkata, West Bengal.</p>
    <p>If you wish to report abuse, spam, or illegal activity related to this service, please contact us immediately at <a href="mailto:support@inboxoro.com">support@inboxoro.com</a>.</p>

    <div class="contact-box">
      <div class="contact-box-title">Get in Touch</div>
      <div class="contact-box-sub">We take privacy concerns seriously and will respond promptly.</div>

      <div class="contact-row">
        <div class="contact-icon">
          <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="#FACC15" stroke-width="2">
            <path stroke-linecap="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
          </svg>
        </div>
        <div>
          <div class="contact-label">General &amp; Privacy Inquiries</div>
          <div class="contact-value"><a href="mailto:support@inboxoro.com">support@inboxoro.com</a></div>
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

      <div class="contact-row">
        <div class="contact-icon">
          <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="#FACC15" stroke-width="2">
            <path stroke-linecap="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
          </svg>
        </div>
        <div>
          <div class="contact-label">GDPR / Data Subject Requests</div>
          <div class="contact-value"><a href="mailto:support@inboxoro.com">support@inboxoro.com</a> — subject line: "Data Request"</div>
        </div>
      </div>
    </div>

    <p style="margin-top: 20px; font-size: .85rem; color: var(--MU);">
      This Privacy Policy was written in plain English intentionally. It is not a substitute for legal advice. If you are building a product on top of inboxOro's API or have complex compliance requirements, we recommend consulting a qualified legal professional.
    </p>
  </section>

  <!-- ── SECTION 13: Limitation of Liability ── -->
  <section class="policy-section" id="s13">
    <div class="section-header">
      <div class="section-num">13</div>
      <h2 class="section-title">Limitation of Liability</h2>
    </div>

    <p>To the maximum extent permitted by applicable law, inboxOro shall not be liable for any direct, indirect, incidental, consequential, or special damages arising out of or related to:</p>

    <ul class="policy-list">
      <li>Your use or inability to use the service</li>
      <li>Loss of emails due to automatic deletion or expiration</li>
      <li>Unauthorized access to temporary inboxes</li>
      <li>Any reliance on content received via temporary email addresses</li>
      <li>Service interruptions, downtime, or technical failures</li>
    </ul>

    <p>We do not warrant that the service will be uninterrupted, error-free, or completely secure.</p>

    <p>By using inboxOro, you acknowledge and agree that you use the service at your own risk.</p>
  </section>

</main>

<!-- ══ FOOTER ════════════════════════════════════════════════════ -->
<footer class="site-footer">
  <div class="nav-logo">
    <img src="{{asset('/images/logo.svg')}}" alt="Inboxoro Logo" class="logo-img">
  </div>
  <div class="footer-links">
    <a href="{{url('/')}}">Home</a>
    <a href="{{url('privacy-policy')}}">Privacy Policy</a>
    <a href="{{url('terms')}}">Terms</a>
    <a href="mailto:support@inboxoro.com">Contact</a>
  </div>
  <div class="footer-copy">© 2026 inboxOro. All rights reserved.</div>
</footer>

<script>
  // ── Read progress bar ──────────────────────────────────────────
  const progressBar = document.getElementById('readProgress');
  const backTop     = document.getElementById('backTop');

  window.addEventListener('scroll', () => {
    const doc    = document.documentElement;
    const scroll = doc.scrollTop || document.body.scrollTop;
    const height = doc.scrollHeight - doc.clientHeight;
    progressBar.style.width = (scroll / height * 100) + '%';
    backTop.classList.toggle('show', scroll > 400);
  }, { passive: true });

  // ── Scroll reveal ──────────────────────────────────────────────
  const sections = document.querySelectorAll('.policy-section');
  const observer = new IntersectionObserver((entries) => {
    entries.forEach(e => {
      if (e.isIntersecting) {
        e.target.classList.add('visible');
        observer.unobserve(e.target);
      }
    });
  }, { threshold: 0.06, rootMargin: '0px 0px -40px 0px' });

  sections.forEach(s => observer.observe(s));

  // ── TOC active state ───────────────────────────────────────────
  const tocLinks = document.querySelectorAll('.toc-link');

  const tocObserver = new IntersectionObserver((entries) => {
    entries.forEach(e => {
      if (e.isIntersecting) {
        const id   = e.target.id;
        tocLinks.forEach(l => {
          l.style.color = l.getAttribute('href') === `#${id}`
            ? 'var(--INK)'
            : '';
          l.style.borderBottomColor = l.getAttribute('href') === `#${id}`
            ? 'var(--Y)'
            : '';
        });
      }
    });
  }, { threshold: 0.4 });

  sections.forEach(s => tocObserver.observe(s));
</script>

</body>
</html>