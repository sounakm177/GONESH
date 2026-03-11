<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>SnapMail — Instant Temporary Email</title>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;500;600;700;800&family=DM+Mono:wght@300;400;500&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            brand: {
              yellow: '#FACC15',
              'yellow-dark': '#EAB308',
              'yellow-light': '#FEF9C3',
              blue: '#2563EB',
              'blue-light': '#EFF6FF',
              bg: '#F8FAFC',
              card: '#FFFFFF',
              text: '#1F2937',
              muted: '#6B7280',
              border: '#E5E7EB',
            }
          },
          fontFamily: {
            display: ['Syne', 'sans-serif'],
            mono: ['DM Mono', 'monospace'],
            body: ['DM Sans', 'sans-serif'],
          },
          animation: {
            'pulse-slow': 'pulse 3s ease-in-out infinite',
            'float': 'float 6s ease-in-out infinite',
            'shimmer': 'shimmer 2s infinite',
          },
          keyframes: {
            float: {
              '0%, 100%': { transform: 'translateY(0px)' },
              '50%': { transform: 'translateY(-8px)' },
            },
            shimmer: {
              '0%': { backgroundPosition: '-200% 0' },
              '100%': { backgroundPosition: '200% 0' },
            }
          }
        }
      }
    }
  </script>
  <style>
    * { box-sizing: border-box; }

    body {
      background-color: #F8FAFC;
      font-family: 'DM Sans', sans-serif;
      color: #1F2937;
      overflow-x: hidden;
    }

    /* Dot grid background */
    .dot-grid {
      background-image: radial-gradient(circle, #D1D5DB 1px, transparent 1px);
      background-size: 28px 28px;
    }

    /* Yellow glow blob */
    .yellow-blob {
      position: absolute;
      width: 520px;
      height: 520px;
      background: radial-gradient(circle, rgba(250, 204, 21, 0.22) 0%, transparent 70%);
      border-radius: 50%;
      pointer-events: none;
      filter: blur(1px);
    }

    .blue-blob {
      position: absolute;
      width: 380px;
      height: 380px;
      background: radial-gradient(circle, rgba(37, 99, 235, 0.10) 0%, transparent 70%);
      border-radius: 50%;
      pointer-events: none;
    }

    /* Email display box */
    .email-box {
      background: #FFFFFF;
      border: 2px solid #FACC15;
      border-radius: 16px;
      box-shadow: 0 0 0 6px rgba(250, 204, 21, 0.08), 0 20px 60px rgba(0,0,0,0.08);
      transition: box-shadow 0.3s ease;
    }

    .email-box:hover {
      box-shadow: 0 0 0 8px rgba(250, 204, 21, 0.14), 0 24px 72px rgba(0,0,0,0.1);
    }

    /* Copy button */
    .copy-btn {
      background: #FACC15;
      color: #1F2937;
      font-family: 'Syne', sans-serif;
      font-weight: 700;
      transition: all 0.2s ease;
      border: 2px solid transparent;
    }

    .copy-btn:hover {
      background: #EAB308;
      transform: translateY(-1px);
      box-shadow: 0 8px 24px rgba(250, 204, 21, 0.4);
    }

    .copy-btn:active {
      transform: translateY(0px);
    }

    /* Refresh button */
    .refresh-btn {
      background: transparent;
      color: #2563EB;
      font-family: 'DM Sans', sans-serif;
      font-weight: 500;
      border: 2px solid #2563EB;
      transition: all 0.2s ease;
    }

    .refresh-btn:hover {
      background: #EFF6FF;
      transform: translateY(-1px);
      box-shadow: 0 6px 20px rgba(37, 99, 235, 0.2);
    }

    /* Domain pill */
    .domain-pill {
      background: #F8FAFC;
      border: 1.5px solid #E5E7EB;
      border-radius: 100px;
      cursor: pointer;
      transition: all 0.2s ease;
      font-family: 'DM Mono', monospace;
      font-size: 0.8rem;
      color: #6B7280;
    }

    .domain-pill:hover {
      border-color: #FACC15;
      background: #FEF9C3;
      color: #1F2937;
    }

    .domain-pill.active {
      background: #FACC15;
      border-color: #FACC15;
      color: #1F2937;
      font-weight: 600;
    }

    /* Feature cards */
    .feature-card {
      background: #FFFFFF;
      border: 1.5px solid #E5E7EB;
      border-radius: 16px;
      transition: all 0.25s ease;
    }

    .feature-card:hover {
      border-color: #FACC15;
      transform: translateY(-3px);
      box-shadow: 0 12px 40px rgba(0,0,0,0.07);
    }

    /* Inbox preview */
    .inbox-preview {
      background: #FFFFFF;
      border: 1.5px solid #E5E7EB;
      border-radius: 16px;
      overflow: hidden;
    }

    .inbox-row {
      border-bottom: 1px solid #F3F4F6;
      transition: background 0.15s ease;
      cursor: pointer;
    }

    .inbox-row:hover {
      background: #FAFAFA;
    }

    .unread-dot {
      width: 8px;
      height: 8px;
      background: #FACC15;
      border-radius: 50%;
      flex-shrink: 0;
    }

    /* Timer bar */
    .timer-bar-track {
      background: #E5E7EB;
      border-radius: 100px;
      height: 4px;
      overflow: hidden;
    }

    .timer-bar-fill {
      height: 100%;
      background: linear-gradient(90deg, #FACC15, #EAB308);
      border-radius: 100px;
      animation: timerShrink 600s linear forwards;
    }

    @keyframes timerShrink {
      from { width: 100%; }
      to { width: 0%; }
    }

    /* Shimmer loading */
    .shimmer-text {
      background: linear-gradient(90deg, #F3F4F6 25%, #E5E7EB 50%, #F3F4F6 75%);
      background-size: 200% 100%;
      animation: shimmer 1.5s infinite;
      border-radius: 6px;
      color: transparent;
    }

    /* Badge */
    .badge-new {
      background: #FACC15;
      color: #1F2937;
      font-family: 'Syne', sans-serif;
      font-weight: 700;
      font-size: 0.65rem;
      letter-spacing: 0.08em;
      padding: 2px 8px;
      border-radius: 100px;
    }

    /* Nav */
    .nav-logo-dot {
      width: 10px;
      height: 10px;
      background: #FACC15;
      border-radius: 50%;
      display: inline-block;
      margin-left: 2px;
      animation: pulse-dot 2s ease-in-out infinite;
    }

    @keyframes pulse-dot {
      0%, 100% { box-shadow: 0 0 0 0 rgba(250, 204, 21, 0.5); }
      50% { box-shadow: 0 0 0 6px rgba(250, 204, 21, 0); }
    }

    /* Copied toast */
    .toast {
      position: fixed;
      bottom: 32px;
      left: 50%;
      transform: translateX(-50%) translateY(80px);
      background: #1F2937;
      color: white;
      font-family: 'DM Sans', sans-serif;
      font-size: 0.875rem;
      font-weight: 500;
      padding: 12px 24px;
      border-radius: 100px;
      z-index: 999;
      transition: transform 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .toast.show {
      transform: translateX(-50%) translateY(0);
    }

    /* Spin animation */
    @keyframes spin-once {
      from { transform: rotate(0deg); }
      to { transform: rotate(360deg); }
    }

    .spin-anim {
      animation: spin-once 0.5s ease;
    }

    /* Glow on email text */
    .email-glow {
      text-shadow: 0 0 20px rgba(250, 204, 21, 0.3);
    }

    /* Section fade in */
    .fade-up {
      opacity: 0;
      transform: translateY(20px);
    }
  </style>
</head>
<body class="dot-grid min-h-screen">

  <!-- Yellow + Blue blobs -->
  <div class="yellow-blob" style="top: -120px; left: -100px; animation: float 7s ease-in-out infinite;"></div>
  <div class="blue-blob" style="top: 200px; right: -80px; animation: float 9s ease-in-out infinite reverse;"></div>

  <!-- Toast Notification -->
  <div class="toast" id="toast">
    <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="#FACC15" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
    Copied to clipboard!
  </div>

  <!-- ─── NAVBAR ─── -->
  <nav class="sticky top-0 z-50 bg-white/80 backdrop-blur-md border-b border-brand-border">
    <div class="max-w-6xl mx-auto px-6 h-16 flex items-center justify-between">
      <div class="flex items-center gap-2">
        <div class="w-8 h-8 bg-brand-yellow rounded-lg flex items-center justify-center">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#1F2937" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
        </div>
        <span class="font-display font-800 text-lg text-brand-text" style="font-weight:800;">SnapMail<span class="nav-logo-dot"></span></span>
      </div>

      <div class="hidden md:flex items-center gap-8">
        <a href="#" class="text-sm font-medium text-brand-muted hover:text-brand-text transition-colors">Features</a>
        <a href="#" class="text-sm font-medium text-brand-muted hover:text-brand-text transition-colors">How it works</a>
        <a href="#" class="text-sm font-medium text-brand-muted hover:text-brand-text transition-colors">API</a>
        <a href="#" class="text-sm font-medium text-brand-blue hover:text-blue-700 transition-colors font-semibold">Sign up free →</a>
      </div>

      <button class="md:hidden text-brand-muted" onclick="toggleMobileMenu()">
        <svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/></svg>
      </button>
    </div>
  </nav>

  <!-- ─── HERO ─── -->
  <section class="max-w-6xl mx-auto px-6 pt-20 pb-16" id="hero">
    <div class="text-center mb-14">
      <!-- Badge -->
      <div class="inline-flex items-center gap-2 bg-white border border-brand-border rounded-full px-4 py-1.5 mb-7 shadow-sm fade-up" id="badge">
        <span class="badge-new">NEW</span>
        <span class="text-sm text-brand-muted font-body">10-minute self-destructing emails</span>
      </div>

      <h1 class="font-display text-5xl md:text-6xl lg:text-7xl font-extrabold text-brand-text leading-tight mb-5 fade-up" id="h1" style="letter-spacing:-0.03em;">
        Instant Disposable<br>
        <span class="relative inline-block">
          <span class="relative z-10">Email Address</span>
          <span class="absolute inset-x-0 bottom-1 h-4 bg-brand-yellow opacity-40 rounded-sm -z-0"></span>
        </span>
      </h1>

      <p class="text-lg text-brand-muted max-w-xl mx-auto font-body leading-relaxed fade-up" id="sub">
        Generate a random email in one click. No sign-up, no tracking, no fuss. Protect your real inbox from spam.
      </p>
    </div>

    <!-- ─── MAIN GENERATOR CARD ─── -->
    <div class="email-box max-w-2xl mx-auto p-8 fade-up" id="gen-card">

      <!-- Domain Selector -->
      <div class="mb-5">
        <p class="text-xs font-display font-semibold text-brand-muted uppercase tracking-widest mb-3">Choose Domain</p>
        <div class="flex flex-wrap gap-2" id="domain-pills">
          <!-- Pills injected via JS -->
        </div>
      </div>

      <!-- Divider -->
      <div class="border-t border-brand-border mb-6"></div>

      <!-- Generated Email Display -->
      <div class="mb-6">
        <p class="text-xs font-display font-semibold text-brand-muted uppercase tracking-widest mb-3">Your Temporary Email</p>

        <div class="flex items-center gap-3 bg-brand-bg rounded-xl px-5 py-4 border border-brand-border">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#FACC15" stroke-width="2.2" class="flex-shrink-0"><path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
          <span class="font-mono text-lg font-medium text-brand-text flex-1 truncate email-glow" id="email-display">generating...</span>
          <div class="w-2 h-2 bg-green-400 rounded-full animate-pulse flex-shrink-0" title="Active"></div>
        </div>

        <!-- Timer -->
        <div class="mt-3">
          <div class="flex items-center justify-between mb-1.5">
            <span class="text-xs text-brand-muted font-body flex items-center gap-1.5">
              <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path stroke-linecap="round" d="M12 6v6l4 2"/></svg>
              Expires in
            </span>
            <span class="text-xs font-mono font-medium text-brand-text" id="timer-text">10:00</span>
          </div>
          <div class="timer-bar-track">
            <div class="timer-bar-fill" id="timer-bar"></div>
          </div>
        </div>
      </div>

      <!-- Action Buttons -->
      <div class="flex gap-3">
        <button class="copy-btn flex-1 py-3.5 px-6 rounded-xl text-sm flex items-center justify-center gap-2.5" onclick="copyEmail()" id="copy-btn">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><rect x="9" y="9" width="13" height="13" rx="2"/><path stroke-linecap="round" d="M5 15H4a2 2 0 01-2-2V4a2 2 0 012-2h9a2 2 0 012 2v1"/></svg>
          Copy Email
        </button>
        <button class="refresh-btn py-3.5 px-6 rounded-xl text-sm flex items-center justify-center gap-2" onclick="generateEmail()" id="refresh-btn">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" id="refresh-icon"><path stroke-linecap="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
          New Email
        </button>
        <button class="py-3.5 px-4 rounded-xl text-sm border-2 border-brand-border text-brand-muted hover:border-brand-blue hover:text-brand-blue transition-all" title="QR Code" onclick="showQR()">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="3" height="3" rx="0.5"/><rect x="19" y="14" width="2" height="2" rx="0.5"/><rect x="14" y="19" width="2" height="2" rx="0.5"/></svg>
        </button>
      </div>

      <!-- Pro tip -->
      <p class="text-xs text-brand-muted text-center mt-4 font-body">
        💡 Emails auto-delete after 10 minutes &nbsp;·&nbsp; No registration needed
      </p>
    </div>
  </section>

  <!-- ─── INBOX PREVIEW ─── -->
  <section class="max-w-6xl mx-auto px-6 pb-20">
    <div class="inbox-preview fade-up" id="inbox-section">
      <!-- Inbox Header -->
      <div class="flex items-center justify-between px-6 py-4 border-b border-brand-border bg-brand-bg">
        <div class="flex items-center gap-3">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#FACC15" stroke-width="2.2"><path stroke-linecap="round" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/></svg>
          <span class="font-display font-bold text-brand-text text-sm">Inbox</span>
          <span class="bg-brand-yellow text-brand-text text-xs font-bold font-display px-2 py-0.5 rounded-full" id="unread-badge">3</span>
        </div>
        <div class="flex items-center gap-2">
          <div class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></div>
          <span class="text-xs text-brand-muted font-body">Live refresh</span>
        </div>
      </div>

      <!-- Inbox Rows -->
      <div id="inbox-rows">
        <!-- Row 1 - unread -->
        <div class="inbox-row flex items-center gap-4 px-6 py-4" onclick="openEmail(this)">
          <div class="unread-dot"></div>
          <div class="w-9 h-9 rounded-full bg-blue-50 flex items-center justify-center flex-shrink-0 text-sm font-bold text-brand-blue font-display">G</div>
          <div class="flex-1 min-w-0">
            <div class="flex items-center justify-between mb-0.5">
              <span class="font-display font-bold text-sm text-brand-text">Google</span>
              <span class="text-xs text-brand-muted font-mono">2m ago</span>
            </div>
            <p class="text-sm text-brand-muted truncate font-body">Verify your Google account — Click here to confirm your email address</p>
          </div>
        </div>

        <!-- Row 2 - unread -->
        <div class="inbox-row flex items-center gap-4 px-6 py-4" onclick="openEmail(this)">
          <div class="unread-dot"></div>
          <div class="w-9 h-9 rounded-full bg-yellow-50 flex items-center justify-center flex-shrink-0 text-sm font-bold text-yellow-600 font-display">S</div>
          <div class="flex-1 min-w-0">
            <div class="flex items-center justify-between mb-0.5">
              <span class="font-display font-bold text-sm text-brand-text">Shopify</span>
              <span class="text-xs text-brand-muted font-mono">5m ago</span>
            </div>
            <p class="text-sm text-brand-muted truncate font-body">Your OTP is 847291 — Use this code to complete sign in to your store</p>
          </div>
        </div>

        <!-- Row 3 - unread -->
        <div class="inbox-row flex items-center gap-4 px-6 py-4" onclick="openEmail(this)">
          <div class="unread-dot"></div>
          <div class="w-9 h-9 rounded-full bg-purple-50 flex items-center justify-center flex-shrink-0 text-sm font-bold text-purple-600 font-display">N</div>
          <div class="flex-1 min-w-0">
            <div class="flex items-center justify-between mb-0.5">
              <span class="font-display font-bold text-sm text-brand-text">Notion</span>
              <span class="text-xs text-brand-muted font-mono">8m ago</span>
            </div>
            <p class="text-sm text-brand-muted truncate font-body">Welcome to Notion! — Start building your workspace today</p>
          </div>
        </div>

        <!-- Row 4 - read -->
        <div class="inbox-row flex items-center gap-4 px-6 py-4 opacity-60" onclick="openEmail(this)">
          <div class="w-2 h-2 flex-shrink-0"></div>
          <div class="w-9 h-9 rounded-full bg-gray-100 flex items-center justify-center flex-shrink-0 text-sm font-semibold text-brand-muted font-display">T</div>
          <div class="flex-1 min-w-0">
            <div class="flex items-center justify-between mb-0.5">
              <span class="font-display font-semibold text-sm text-brand-text">Twitter</span>
              <span class="text-xs text-brand-muted font-mono">9m ago</span>
            </div>
            <p class="text-sm text-brand-muted truncate font-body">Confirm your Twitter email — You're almost there!</p>
          </div>
        </div>
      </div>

      <!-- Empty state hint -->
      <div class="px-6 py-3 bg-brand-bg border-t border-brand-border flex items-center justify-between">
        <span class="text-xs text-brand-muted font-body">Showing latest 4 emails · Messages auto-delete</span>
        <a href="#" class="text-xs text-brand-blue font-semibold font-body hover:underline">View all →</a>
      </div>
    </div>
  </section>

  <!-- ─── FEATURES ─── -->
  <section class="max-w-6xl mx-auto px-6 pb-24">
    <div class="text-center mb-12 fade-up" id="feat-header">
      <h2 class="font-display text-3xl md:text-4xl font-extrabold text-brand-text mb-3" style="letter-spacing:-0.02em;">Why SnapMail?</h2>
      <p class="text-brand-muted font-body max-w-md mx-auto">No fluff. Just the fastest, cleanest temp-mail on the planet.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-5 fade-up" id="feat-grid">
      <div class="feature-card p-7">
        <div class="w-12 h-12 bg-brand-yellow-light rounded-xl flex items-center justify-center mb-4">
          <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#EAB308" stroke-width="2.2"><path stroke-linecap="round" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
        </div>
        <h3 class="font-display font-bold text-lg text-brand-text mb-2">Instant Generation</h3>
        <p class="text-sm text-brand-muted font-body leading-relaxed">One click. One email. Ready in milliseconds. No waiting, no forms, no friction.</p>
      </div>

      <div class="feature-card p-7">
        <div class="w-12 h-12 bg-brand-blue-light rounded-xl flex items-center justify-center mb-4">
          <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#2563EB" stroke-width="2.2"><path stroke-linecap="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
        </div>
        <h3 class="font-display font-bold text-lg text-brand-text mb-2">100% Anonymous</h3>
        <p class="text-sm text-brand-muted font-body leading-relaxed">Zero logs. Zero tracking. Your real identity stays invisible — always.</p>
      </div>

      <div class="feature-card p-7">
        <div class="w-12 h-12 bg-green-50 rounded-xl flex items-center justify-center mb-4">
          <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#16a34a" stroke-width="2.2"><path stroke-linecap="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
        </div>
        <h3 class="font-display font-bold text-lg text-brand-text mb-2">Auto Self-Destruct</h3>
        <p class="text-sm text-brand-muted font-body leading-relaxed">Emails vanish after 10 minutes. No cleanup needed. No digital trail left behind.</p>
      </div>
    </div>
  </section>

  <!-- ─── FOOTER ─── -->
  <footer class="border-t border-brand-border bg-white">
    <div class="max-w-6xl mx-auto px-6 py-8 flex flex-col md:flex-row items-center justify-between gap-4">
      <div class="flex items-center gap-2">
        <div class="w-6 h-6 bg-brand-yellow rounded-md flex items-center justify-center">
          <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#1F2937" stroke-width="2.5"><path stroke-linecap="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
        </div>
        <span class="font-display font-bold text-sm text-brand-text">SnapMail</span>
        <span class="text-xs text-brand-muted">© 2025</span>
      </div>
      <div class="flex items-center gap-6 text-xs text-brand-muted font-body">
        <a href="#" class="hover:text-brand-text transition-colors">Privacy</a>
        <a href="#" class="hover:text-brand-text transition-colors">Terms</a>
        <a href="#" class="hover:text-brand-text transition-colors">API</a>
        <a href="#" class="hover:text-brand-text transition-colors">Status <span class="text-green-500 font-semibold">●</span></a>
      </div>
    </div>
  </footer>

  <script>
    // ─── DATA ───
    const domains = ['snapmail.io', 'tempbox.dev', 'mailflash.net', 'quickinbox.com', 'throwit.email'];
    const adjectives = ['swift', 'ninja', 'cosmic', 'pixel', 'turbo', 'neon', 'ultra', 'dark', 'hyper', 'echo', 'delta', 'solar', 'forge', 'stark', 'ember'];
    const nouns = ['fox', 'wolf', 'spark', 'tide', 'bolt', 'hawk', 'mint', 'oak', 'storm', 'byte', 'flux', 'nova', 'apex', 'dusk', 'dawn'];

    let currentDomain = domains[0];
    let currentEmail = '';
    let timerInterval = null;
    let secondsLeft = 600;

    // ─── INIT ───
    function init() {
      renderDomainPills();
      generateEmail();
      startTimer();
      animateIn();
    }

    // ─── DOMAIN PILLS ───
    function renderDomainPills() {
      const container = document.getElementById('domain-pills');
      container.innerHTML = '';
      domains.forEach((domain, i) => {
        const pill = document.createElement('button');
        pill.className = 'domain-pill px-3 py-1.5' + (i === 0 ? ' active' : '');
        pill.textContent = '@' + domain;
        pill.onclick = () => selectDomain(domain, pill);
        container.appendChild(pill);
      });
    }

    function selectDomain(domain, el) {
      currentDomain = domain;
      document.querySelectorAll('.domain-pill').forEach(p => p.classList.remove('active'));
      el.classList.add('active');
      generateEmail();
    }

    // ─── GENERATE ───
    function generateEmail() {
      const adj = adjectives[Math.floor(Math.random() * adjectives.length)];
      const noun = nouns[Math.floor(Math.random() * nouns.length)];
      const num = Math.floor(Math.random() * 900) + 100;
      currentEmail = `${adj}.${noun}${num}@${currentDomain}`;

      const display = document.getElementById('email-display');
      display.textContent = currentEmail;
      display.classList.add('shimmer-text');
      setTimeout(() => display.classList.remove('shimmer-text'), 600);

      // Reset timer
      secondsLeft = 600;
      const bar = document.getElementById('timer-bar');
      bar.style.animation = 'none';
      bar.offsetHeight; // reflow
      bar.style.animation = 'timerShrink 600s linear forwards';

      // Spin refresh icon
      const icon = document.getElementById('refresh-icon');
      icon.classList.remove('spin-anim');
      void icon.offsetWidth;
      icon.classList.add('spin-anim');
    }

    // ─── COPY ───
    function copyEmail() {
      if (!currentEmail) return;
      navigator.clipboard.writeText(currentEmail).catch(() => {});
      showToast();

      const btn = document.getElementById('copy-btn');
      btn.innerHTML = `<svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M5 13l4 4L19 7"/></svg> Copied!`;
      setTimeout(() => {
        btn.innerHTML = `<svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2"><rect x="9" y="9" width="13" height="13" rx="2"/><path stroke-linecap="round" d="M5 15H4a2 2 0 01-2-2V4a2 2 0 012-2h9a2 2 0 012 2v1"/></svg> Copy Email`;
      }, 2000);
    }

    // ─── TOAST ───
    function showToast() {
      const t = document.getElementById('toast');
      t.classList.add('show');
      setTimeout(() => t.classList.remove('show'), 2500);
    }

    // ─── TIMER ───
    function startTimer() {
      if (timerInterval) clearInterval(timerInterval);
      timerInterval = setInterval(() => {
        secondsLeft--;
        if (secondsLeft <= 0) {
          secondsLeft = 0;
          clearInterval(timerInterval);
        }
        const m = Math.floor(secondsLeft / 60).toString().padStart(2, '0');
        const s = (secondsLeft % 60).toString().padStart(2, '0');
        document.getElementById('timer-text').textContent = `${m}:${s}`;
      }, 1000);
    }

    // ─── QR PLACEHOLDER ───
    function showQR() {
      alert('QR Code for: ' + currentEmail + '\n\n(In production, this would show a scannable QR code.)');
    }

    // ─── INBOX ROW CLICK ───
    function openEmail(row) {
      const dot = row.querySelector('.unread-dot');
      if (dot) {
        dot.style.opacity = '0';
        row.classList.add('opacity-60');
        // Update badge
        const badge = document.getElementById('unread-badge');
        const count = parseInt(badge.textContent);
        if (count > 0) badge.textContent = count - 1;
        if (count - 1 === 0) badge.style.display = 'none';
      }
    }

    // ─── ANIMATE IN ───
    function animateIn() {
      const els = document.querySelectorAll('.fade-up');
      els.forEach((el, i) => {
        setTimeout(() => {
          el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
          el.style.opacity = '1';
          el.style.transform = 'translateY(0)';
        }, 100 + i * 120);
      });
    }

    // ─── MOBILE MENU ───
    function toggleMobileMenu() {
      // Placeholder
    }

    // ─── START ───
    window.addEventListener('load', init);
  </script>
</body>
</html>