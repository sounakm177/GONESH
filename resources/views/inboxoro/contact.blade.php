<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- ✅ SEO Title -->
    <title>Contact InboxOro – Temporary Email Support & Help</title>

    <!-- ✅ Meta Description -->
    <meta name="description" content="Contact InboxOro for support, questions about temporary email, or privacy tools. Get help with disposable inbox usage, OTP issues, and general enquiries.">

    <!-- ✅ Canonical -->
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- ✅ Robots -->
    <meta name="robots" content="index, follow">

    <!-- ✅ Open Graph -->
    <meta property="og:title" content="Contact InboxOro – Temporary Email Support">
    <meta property="og:description" content="Need help with InboxOro temporary email service? Contact our support team for assistance and enquiries.">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">

    <!-- Optional (add when you have image) -->
    <!-- <meta property="og:image" content="{{ asset('images/og-image.png') }}"> -->

    <!-- ✅ Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Contact InboxOro – Support">
    <meta name="twitter:description" content="Get support for InboxOro disposable email service and privacy tools.">

    <!-- Optional -->
    <!-- <meta name="twitter:image" content="{{ asset('images/og-image.png') }}"> -->

    <!-- ✅ Favicons -->
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon-32.png') }}">
    <link rel="icon" type="image/png" sizes="64x64" href="{{ asset('images/favicon-64.png') }}">

    <!-- ✅ Fonts (optimized loading) -->
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
      --ERR:  #DC2626;
      --OK:   #16a34a;
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
      font-size:       .75rem;
      font-weight:     600;
      letter-spacing:  .1em;
      text-transform:  uppercase;
      color:           #9CA3AF;
      text-decoration: none;
      transition:      color .2s;
    }
    .nav-links a:hover, .nav-links a.active { color: var(--Y); }
    .nav-cta {
      background:      var(--Y);
      color:           var(--INK);
      font-size:       .72rem;
      font-weight:     700;
      letter-spacing:  .08em;
      text-transform:  uppercase;
      padding:         7px 14px;
      border:          none;
      cursor:          pointer;
      text-decoration: none;
      white-space:     nowrap;
      transition:      background .15s;
    }
    .nav-cta:hover { background: #fff; color: var(--INK); text-decoration: none; }

    /* ── HERO ── */
    .contact-hero {
      background:    var(--INK);
      border-bottom: 3px solid var(--Y);
      padding:       52px 20px 48px;
      position:      relative;
      overflow:      hidden;
    }
    .contact-hero::before {
      content:        'CONTACT';
      position:       absolute;
      right:          -20px;
      top:            50%;
      transform:      translateY(-50%);
      font-family:    var(--DISP);
      font-size:      clamp(4rem, 18vw, 12rem);
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

    .contact-hero h1 {
      font-family:    var(--DISP);
      font-size:      clamp(2.2rem, 7vw, 4.5rem);
      color:          #fff;
      letter-spacing: .03em;
      line-height:    .95;
      margin-bottom:  16px;
    }
    .contact-hero h1 .gold { color: var(--Y); }
    .hero-sub {
      font-size:   1rem;
      color:       #9CA3AF;
      max-width:   480px;
      line-height: 1.65;
    }

    /* ── PAGE LAYOUT ── */
    .page-body {
      max-width: 900px;
      margin:    0 auto;
      padding:   52px 20px 80px;
    }

    /* ── SECTION LABELS ── */
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
      font-size:      clamp(1.6rem, 4vw, 2.5rem);
      letter-spacing: .03em;
      color:          var(--INK);
      line-height:    1;
      margin-bottom:  24px;
    }
    .sec-title .gold { color: var(--Y); }

    .divider { border: none; border-top: 2px solid var(--BD); margin: 52px 0; }

    /* ── CONTACT GRID ── */
    .contact-grid {
      display:               grid;
      grid-template-columns: 1fr;
      gap:                   32px;
      align-items:           start;
    }

    /* ── CONTACT FORM ── */
    .form-card {
      border:     2px solid var(--INK);
      background: var(--CARD);
      box-shadow: 6px 6px 0 var(--INK);
      padding:    28px 24px;
    }
    .form-card-title {
      font-family:    var(--DISP);
      font-size:      1.4rem;
      letter-spacing: .04em;
      color:          var(--INK);
      margin-bottom:  20px;
      padding-bottom: 14px;
      border-bottom:  2px solid var(--BD);
    }

    .field-group {
      display:        flex;
      flex-direction: column;
      gap:            16px;
    }
    .field { display: flex; flex-direction: column; gap: 6px; }

    .field-row {
      display:               grid;
      grid-template-columns: 1fr;
      gap:                   16px;
    }

    label {
      font-family:    var(--MONO);
      font-size:      .62rem;
      font-weight:    700;
      letter-spacing: .08em;
      text-transform: uppercase;
      color:          var(--MU);
    }
    label .req { color: var(--ERR); margin-left: 2px; }

    input[type="text"],
    input[type="email"],
    select,
    textarea {
      width:       100%;
      padding:     11px 14px;
      border:      2px solid var(--BD);
      background:  #FAFAFA;
      font-family: var(--BODY);
      font-size:   .9rem;
      color:       var(--INK);
      outline:     none;
      transition:  border-color .15s, box-shadow .15s;
      appearance:  none;
      -webkit-appearance: none;
    }
    input:focus, select:focus, textarea:focus {
      border-color: var(--INK);
      box-shadow:   2px 2px 0 var(--INK);
      background:   #fff;
    }
    input.invalid, select.invalid, textarea.invalid {
      border-color: var(--ERR);
      box-shadow:   2px 2px 0 var(--ERR);
    }
    textarea { resize: vertical; min-height: 130px; }

    .field-error {
      font-family:  var(--MONO);
      font-size:    .62rem;
      color:        var(--ERR);
      display:      none;
      margin-top:   2px;
    }
    .field-error.show { display: block; }

    .form-submit {
      background:     var(--INK);
      color:          var(--Y);
      font-family:    var(--MONO);
      font-size:      .76rem;
      font-weight:    700;
      letter-spacing: .1em;
      text-transform: uppercase;
      padding:        13px 28px;
      border:         2px solid var(--INK);
      cursor:         pointer;
      width:          100%;
      box-shadow:     3px 3px 0 var(--Y);
      transition:     background .15s, color .15s, transform .1s, box-shadow .1s;
      margin-top:     8px;
    }
    .form-submit:hover  { background: var(--Y); color: var(--INK); }
    .form-submit:active { transform: translate(2px,2px); box-shadow: 1px 1px 0 var(--Y); }
    .form-submit:disabled { opacity: .5; cursor: not-allowed; }

    /* Success state */
    .form-success {
      display:         none;
      flex-direction:  column;
      align-items:     center;
      justify-content: center;
      gap:             12px;
      padding:         32px 0;
      text-align:      center;
    }
    .form-success.show { display: flex; }
    .success-icon {
      width:           52px;
      height:          52px;
      background:      var(--INK);
      border:          2px solid var(--Y);
      display:         flex;
      align-items:     center;
      justify-content: center;
    }
    .success-icon svg { color: var(--Y); }
    .success-title {
      font-family:    var(--DISP);
      font-size:      1.5rem;
      letter-spacing: .04em;
      color:          var(--INK);
    }
    .success-sub { font-size: .88rem; color: var(--MU); }

    /* ── CONTACT INFO CARD ── */
    .info-card {
      display:        flex;
      flex-direction: column;
      gap:            16px;
    }

    .email-box {
      border:     2px solid var(--INK);
      background: var(--INK);
      padding:    20px;
      box-shadow: 4px 4px 0 var(--Y);
    }
    .email-box-label {
      font-family:    var(--MONO);
      font-size:      .6rem;
      font-weight:    700;
      letter-spacing: .12em;
      text-transform: uppercase;
      color:          var(--Y);
      margin-bottom:  8px;
    }
    .email-box-addr {
      font-family:    var(--MONO);
      font-size:      .95rem;
      font-weight:    700;
      color:          #fff;
      word-break:     break-all;
    }
    .email-box-note {
      font-size:   .76rem;
      color:       #6B7280;
      margin-top:  6px;
      line-height: 1.5;
    }

    .response-card {
      border:   2px solid var(--BD);
      padding:  18px 20px;
      background: var(--CARD);
    }
    .response-card-title {
      font-family:    var(--MONO);
      font-size:      .6rem;
      font-weight:    700;
      letter-spacing: .1em;
      text-transform: uppercase;
      color:          var(--MU);
      margin-bottom:  8px;
    }
    .response-card p { font-size: .86rem; color: var(--MU); line-height: 1.6; }

    /* ── FAQ ── */
    .faq-list {
      display:        flex;
      flex-direction: column;
      gap:            0;
      border:         2px solid var(--INK);
      margin-top:     24px;
    }
    .faq-item {
      border-bottom: 2px solid var(--INK);
    }
    .faq-item:last-child { border-bottom: none; }

    .faq-q {
      display:         flex;
      align-items:     center;
      justify-content: space-between;
      gap:             12px;
      padding:         18px 20px;
      cursor:          pointer;
      font-family:     var(--DISP);
      font-size:       1rem;
      letter-spacing:  .03em;
      color:           var(--INK);
      user-select:     none;
      -webkit-user-select: none;
      transition:      background .12s;
      list-style:      none;
    }
    .faq-q:hover { background: #FFFBEB; }
    .faq-q::marker, .faq-q::-webkit-details-marker { display: none; }

    .faq-icon {
      width:       20px;
      height:      20px;
      flex-shrink: 0;
      border:      1.5px solid var(--BD);
      display:     flex;
      align-items: center;
      justify-content: center;
      font-family: var(--MONO);
      font-size:   .8rem;
      font-weight: 700;
      color:       var(--MU);
      transition:  background .12s, color .12s;
    }
    details[open] .faq-icon { background: var(--INK); color: var(--Y); border-color: var(--INK); }

    .faq-a {
      padding:       0 20px 18px;
      font-size:     .9rem;
      color:         var(--MU);
      line-height:   1.7;
      border-top:    1px solid var(--BD);
      padding-top:   14px;
    }

    /* ── LEGAL DISCLAIMER ── */
    .legal-block {
      background:  var(--INK);
      border:      2px solid var(--BD);
      padding:     24px;
      margin-top:  24px;
    }
    .legal-block-title {
      font-family:    var(--MONO);
      font-size:      .62rem;
      font-weight:    700;
      letter-spacing: .14em;
      text-transform: uppercase;
      color:          var(--Y);
      margin-bottom:  14px;
      display:        flex;
      align-items:    center;
      gap:            8px;
    }
    .legal-block-title::before {
      content:       '⚠';
      font-size:     .8rem;
    }
    .legal-block p {
      font-family:    var(--MONO);
      font-size:      .72rem;
      color:          #9CA3AF;
      line-height:    1.7;
      letter-spacing: .01em;
      margin-bottom:  10px;
    }
    .legal-block p:last-child { margin-bottom: 0; }

    /* ── SITE FOOTER ── */
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
      .field-row { grid-template-columns: 1fr 1fr; }
    }
    @media (min-width: 900px) {
      .nav          { padding: 0 40px; }
      .nav-links    { display: flex; }
      .nav-logo     { font-size: 1.65rem; }
      .contact-hero { padding: 72px 40px 60px; }
      .page-body    { padding: 64px 40px 100px; }
      .contact-grid { grid-template-columns: 1fr 320px; }
      /* .site-footer  { flex-direction: row; justify-content: space-between; padding: 26px 40px; text-align: left; }
      .foot-links   { justify-content: flex-start; } */
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
</header>



<!-- HERO -->
<section class="contact-hero" aria-labelledby="contact-heading">
  <div class="hero-inner">
    <div class="hero-tag">Get in Touch</div>
    <h1 id="contact-heading">
      <span style="-webkit-text-stroke:2px rgba(255,255,255,.2);color:transparent;">SAY</span><br>
      <span class="gold">HELLO</span>
    </h1>
    <p class="hero-sub">
      Have a question about our <strong style="color:#fff;">temporary email service</strong> or <strong style="color:#fff;">privacy email tool</strong>?
      We're happy to help. Fill out the form or email us directly.
    </p>
  </div>
</section>

<!-- PAGE BODY -->
<main class="page-body">

  <!-- CONTACT FORM + INFO -->
  <section aria-labelledby="form-heading" class="rv">
    <div class="contact-grid">

      <!-- FORM -->
      <div>
        <div class="sec-label">Send a Message</div>
        <h2 class="sec-title" id="form-heading">Contact <span class="gold">Form</span></h2>

        <div class="form-card">
          <div class="form-card-title">We'll respond within 1–2 business days</div>

          <!-- Success message (shown by JS on submit) -->
          <div class="form-success" id="form-success" role="status" aria-live="polite">
            <div class="success-icon">
              <svg width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" aria-hidden="true">
                <path stroke-linecap="round" d="M5 13l4 4L19 7"/>
              </svg>
            </div>
            <div class="success-title">Message Sent!</div>
            <p class="success-sub">Thank you for reaching out. We'll get back to you within 1–2 business days.</p>
          </div>

          <!-- Form -->
          <form id="contact-form" novalidate aria-label="Contact form">
            <div class="field-group">

              <div class="field-row">
                <div class="field">
                  <label for="name">Name <span class="req" aria-label="required">*</span></label>
                  <input
                    type="text"
                    id="name"
                    name="name"
                    autocomplete="name"
                    placeholder="Your name"
                    aria-required="true"
                    aria-describedby="name-error"
                  />
                  <span class="field-error" id="name-error" role="alert">Please enter your name.</span>
                </div>
                <div class="field">
                  <label for="email">Email <span class="req" aria-label="required">*</span></label>
                  <input
                    type="email"
                    id="email"
                    name="email"
                    autocomplete="email"
                    placeholder="your@email.com"
                    aria-required="true"
                    aria-describedby="email-error"
                  />
                  <span class="field-error" id="email-error" role="alert">Please enter a valid email address.</span>
                </div>
              </div>

              <div class="field">
                <label for="subject">Subject <span class="req" aria-label="required">*</span></label>
                <select id="subject" name="subject" aria-required="true" aria-describedby="subject-error">
                  <option value="" disabled selected>Select a topic…</option>
                  <option value="general">General Enquiry</option>
                  <option value="support">Temporary Email Support</option>
                  <option value="privacy">Privacy / Data Question</option>
                  <option value="api">Developer API Interest</option>
                  <option value="abuse">Report Abuse</option>
                  <option value="other">Other</option>
                </select>
                <span class="field-error" id="subject-error" role="alert">Please select a subject.</span>
              </div>

              <div class="field">
                <label for="message">Message <span class="req" aria-label="required">*</span></label>
                <textarea
                  id="message"
                  name="message"
                  placeholder="Describe your question or issue in detail…"
                  aria-required="true"
                  aria-describedby="message-error"
                ></textarea>
                <span class="field-error" id="message-error" role="alert">Please enter a message (min. 10 characters).</span>
              </div>

              <button type="submit" class="form-submit" id="form-submit">
                Send Message →
              </button>

            </div>
          </form>
        </div>
      </div>

      <!-- CONTACT INFO -->
      <div class="info-card">

        <div>
          <div class="sec-label">Direct Email</div>
          <div class="email-box">
            <div class="email-box-label">Support Address</div>
            <div class="email-box-addr">
              <a href="mailto:support@inboxoro.com" style="color:#fff;text-decoration:none;">support@inboxoro.com</a>
            </div>
            <p class="email-box-note">For temporary email support and privacy email tool questions.</p>
          </div>
        </div>

        <div class="response-card">
          <div class="response-card-title">Response Times</div>
          <p>General enquiries: <strong>1–2 business days</strong></p>
          <p style="margin-top:6px;">Abuse reports: prioritised and reviewed promptly.</p>
          <p style="margin-top:6px;">We do not offer phone support at this time.</p>
        </div>

        <div class="response-card">
          <div class="response-card-title">Before You Write</div>
          <p>
            Many common questions are answered in our
            <a href="/blog" style="color:var(--B);">blog guides</a> and the FAQ below.
            Check there first — you may find an instant answer.
          </p>
        </div>

      </div>
    </div>
  </section>

  <hr class="divider"/>

  <!-- FAQ -->
  <section aria-labelledby="faq-heading" class="rv">
    <div class="sec-label">Common Questions</div>
    <h2 class="sec-title" id="faq-heading">FAQ</h2>

    <div class="faq-list" role="list">

      <details class="faq-item" itemscope itemtype="https://schema.org/Question">
        <summary class="faq-q" itemprop="name">
          What is a temporary email address?
          <span class="faq-icon" aria-hidden="true">+</span>
        </summary>
        <div class="faq-a" itemscope itemtype="https://schema.org/Answer" itemprop="acceptedAnswer">
          <p itemprop="text">
            A <strong>temporary email address</strong> is a short-lived, disposable email that you can use for
            sign-ups, verifications, or any situation where you don't want to share your real address.
            It works like a regular email — you can receive messages — but it expires automatically after
            a set time period. InboxOro provides a <strong>disposable email generator</strong> that creates
            these addresses instantly, with no account required.
          </p>
        </div>
      </details>

      <details class="faq-item" itemscope itemtype="https://schema.org/Question">
        <summary class="faq-q" itemprop="name">
          How long are emails stored?
          <span class="faq-icon" aria-hidden="true">+</span>
        </summary>
        <div class="faq-a" itemscope itemtype="https://schema.org/Answer" itemprop="acceptedAnswer">
          <p itemprop="text">
            The <strong>temporary inbox</strong> and all its messages are automatically deleted after the
            address expires — typically within 10 minutes, though the timer can be extended up to a maximum
            of 30 minutes per session. Once deleted, the emails are permanently gone and cannot be recovered.
            This is by design: short retention is a core part of our <strong>email privacy tool</strong> approach.
          </p>
        </div>
      </details>

      <details class="faq-item" itemscope itemtype="https://schema.org/Question">
        <summary class="faq-q" itemprop="name">
          Is InboxOro free to use?
          <span class="faq-icon" aria-hidden="true">+</span>
        </summary>
        <div class="faq-a" itemscope itemtype="https://schema.org/Answer" itemprop="acceptedAnswer">
          <p itemprop="text">
            Yes. The core <strong>temporary email service</strong> — generating addresses and reading emails
            in the inbox — is free with no account required. We may introduce optional Pro features in the future,
            but basic disposable email generation will remain available at no cost.
          </p>
        </div>
      </details>

      <details class="faq-item" itemscope itemtype="https://schema.org/Question">
        <summary class="faq-q" itemprop="name">
          Is my data private when I use this service?
          <span class="faq-icon" aria-hidden="true">+</span>
        </summary>
        <div class="faq-a" itemscope itemtype="https://schema.org/Answer" itemprop="acceptedAnswer">
          <p itemprop="text">
            We do not require any personal information to use the service — no name, no real email, no account.
            Temporary inboxes and their messages are deleted automatically after expiry.
            However, temporary inboxes are accessible to anyone who knows the address, so
            <strong>do not use them to receive sensitive, financial, or personally identifiable information.</strong>
            Review our <a href="/privacy-policy">Privacy Policy</a> for full details on data handling.
          </p>
        </div>
      </details>

      <details class="faq-item" itemscope itemtype="https://schema.org/Question">
        <summary class="faq-q" itemprop="name">
          Can I use a temporary email for important accounts?
          <span class="faq-icon" aria-hidden="true">+</span>
        </summary>
        <div class="faq-a" itemscope itemtype="https://schema.org/Answer" itemprop="acceptedAnswer">
          <p itemprop="text">
            No. Temporary email addresses are not suitable for accounts you need long-term access to
            (banking, healthcare, government services, primary social accounts). Because the inbox
            expires and the address becomes inactive, you will lose the ability to recover passwords
            or receive important account updates. Use a permanent, secure email for anything you value.
          </p>
        </div>
      </details>

      <details class="faq-item" itemscope itemtype="https://schema.org/Question">
        <summary class="faq-q" itemprop="name">
          Is a developer API available?
          <span class="faq-icon" aria-hidden="true">+</span>
        </summary>
        <div class="faq-a" itemscope itemtype="https://schema.org/Answer" itemprop="acceptedAnswer">
          <p itemprop="text">
            A developer API for programmatic <strong>temporary email</strong> generation is currently under
            development. No release date is confirmed. If you have specific integration requirements or
            would like to be notified when it's available, please use the contact form above.
          </p>
        </div>
      </details>

    </div>
  </section>

  <hr class="divider"/>

  <!-- LEGAL DISCLAIMER -->
  <section aria-labelledby="legal-heading" class="rv">
    <div class="sec-label">Legal</div>
    <h2 class="sec-title" id="legal-heading">Disclaimer</h2>
    <div class="legal-block">
      <div class="legal-block-title">Important Notice</div>
      <p>
        InboxOro provides a temporary email and disposable inbox service intended for lawful purposes only —
        such as spam protection, email privacy management, and short-term email verification tasks.
      </p>
      <p>
        This service must not be used for illegal activities, fraud, harassment, phishing, or any activity
        that violates applicable laws or third-party terms of service. Users are solely responsible for
        how they use the service.
      </p>
      <p>
        Emails received in temporary inboxes are automatically and permanently deleted after the address expires.
        We do not accept responsibility for loss of access to services where a temporary email address was
        used as a primary contact.
      </p>
      <p>
        This is a privacy and testing utility. It does not guarantee anonymity and should not be relied
        upon as a security measure for sensitive communications. See our
        <a href="/privacy-policy" style="color:var(--Y);">Privacy Policy</a> and
        <a href="/terms" style="color:var(--Y);">Terms of Service</a> for the full legal framework.
      </p>
    </div>
  </section>

</main>

<!-- FOOTER -->
@include('inboxoro.partials.footer')

<script>
  /* ── Scroll reveal ── */
  const io = new IntersectionObserver(entries => {
    entries.forEach(e => { if (e.isIntersecting) { e.target.classList.add('in'); io.unobserve(e.target); } });
  }, { threshold: .06, rootMargin: '0px 0px -30px 0px' });
  document.querySelectorAll('.rv').forEach(el => io.observe(el));

  /* ── FAQ icon toggle ── */
  document.querySelectorAll('.faq-item').forEach(d => {
    d.addEventListener('toggle', () => {
      const icon = d.querySelector('.faq-icon');
      if (icon) icon.textContent = d.open ? '−' : '+';
    });
  });

  /* ── Contact form validation ── */
  const form    = document.getElementById('contact-form');
  const success = document.getElementById('form-success');
  const submit  = document.getElementById('form-submit');

  function getEl(id)   { return document.getElementById(id); }
  function getErr(id)  { return document.getElementById(id + '-error'); }

  function validate(id, rule) {
    const el  = getEl(id);
    const err = getErr(id);
    const ok  = rule(el.value.trim());
    el.classList.toggle('invalid', !ok);
    err.classList.toggle('show',   !ok);
    return ok;
  }

  /* Live validation — clear error once user fixes the field */
  ['name','email','subject','message'].forEach(id => {
    const el = getEl(id);
    if (! el) return;
    el.addEventListener('input',  () => { el.classList.remove('invalid'); getErr(id).classList.remove('show'); });
    el.addEventListener('change', () => { el.classList.remove('invalid'); getErr(id).classList.remove('show'); });
  });

  form.addEventListener('submit', e => {
    e.preventDefault();

    const isEmail = v => /^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/.test(v);

    const ok = [
      validate('name',    v => v.length >= 2),
      validate('email',   v => isEmail(v)),
      validate('subject', v => v !== ''),
      validate('message', v => v.length >= 10),
    ].every(Boolean);

    if (! ok) {
      /* Scroll to first invalid field */
      const first = form.querySelector('.invalid');
      if (first) first.scrollIntoView({ behavior: 'smooth', block: 'center' });
      return;
    }

    /* ── Simulate submission (replace with real fetch/axios call) ── */
    submit.disabled    = true;
    submit.textContent = 'Sending…';

    setTimeout(() => {
      form.style.display    = 'none';
      success.classList.add('show');
    }, 800);
  });
</script>

</body>
</html>