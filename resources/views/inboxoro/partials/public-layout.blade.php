
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- SEO Title & Description - Optimized for high search volume -->
    <title>Free Temporary Email | inboxOro — Instant 10-Min Disposable Email Generator</title>
    <meta name="description" content="Generate free temporary email addresses instantly. Receive OTPs, verification links for Discord, Instagram, Facebook, Gmail & more. No signup, no tracking, auto-deletes in 10 minutes. Private & secure disposable mail.">

    <link rel="canonical" href="https://inboxoro.com/">
    <meta name="robots" content="index, follow">

    <!-- Open Graph Tags (for better social sharing) -->
    <meta property="og:title" content="Free Temporary Email | inboxOro — 10 Min Disposable Email">
    <meta property="og:description" content="Instant disposable email generator. No signup. Receive emails in seconds and auto-delete in 10 minutes. Perfect for verifications.">
    <meta property="og:image" content="{{ asset('images/og-image.jpg') }}">
    <meta property="og:url" content="https://inboxoro.com/">
    <meta property="og:type" content="website">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Free Temporary Email | inboxOro">
    <meta name="twitter:description" content="Instant 10-minute disposable email. No signup required.">

    <!-- Favicons -->
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('images/favicon-32.png')}}">
    <link rel="icon" type="image/png" sizes="64x64" href="{{asset('images/favicon-64.png')}}">

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

    @vite(['resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/inboxoro.css') }}">
    <link rel="stylesheet" href="{{ asset('css/inboxoro-mobile-patch.css') }}">
    <link rel="stylesheet" href="{{ asset('css/inboxoro-detail-fix.css') }}">
    <script src="{{ asset('js/inboxoro-mobile.js') }}" defer></script>
    @stack('styles')
</head>
<body>
    
  @yield('content')

 
  @include('inboxoro.partials.js-bootstrap', ['mailbox' => $mailbox])
  <script src="{{ asset('js/inboxoro.js') }}" defer></script>

  {{-- Extra page JS --}}
  @stack('scripts')
</body>
</html>