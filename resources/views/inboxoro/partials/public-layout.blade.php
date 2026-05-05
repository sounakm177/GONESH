<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'InboxOro')</title>

    <meta name="description" content="@yield('meta_description', 'Free temporary email service')">

    <link rel="canonical" href="@yield('canonical', url()->current())">

    <meta name="robots" content="@yield('robots', 'index, follow')">

    <meta name="keywords" content="
        @yield('keywords',
           'temporary email, disposable email, temp mail generator, free temporary email, 10 minute email, anonymous email service, receive email online, fake email generator, spam protection email, email without signup'
        )
    ">

    <!-- Open Graph -->
    <meta property="og:title" content="@yield('og_title', View::yieldContent('title'))">
    <meta property="og:description" content="@yield('og_description', View::yieldContent('meta_description'))">
    <meta property="og:url" content="@yield('og_url', url()->current())">
    <meta property="og:type" content="website">

    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('twitter_title', View::yieldContent('title'))">
    <meta name="twitter:description" content="@yield('twitter_description', View::yieldContent('meta_description'))">

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
    <link rel="stylesheet" href="{{ asset('css/newinbox.css') }}">
    <link rel="stylesheet" href="{{ asset('css/inboxoro.css') }}">
    <link rel="stylesheet" href="{{ asset('css/timer.css') }}">
    @stack('styles')

    <script type="application/ld+json">
      @yield('schema')
    </script>
</head>
<body>
    
  @yield('content')

 

  <!-- Google tag (gtag.js) -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-SMT1LQHYBS"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-SMT1LQHYBS');
  </script>

  @include('inboxoro.partials.js-bootstrap', ['mailbox' => $mailbox])
  <script src="{{ asset('js/inboxoro.js') }}" defer></script>
  <script src="{{ asset('js/inboxoro-mobile.js') }}" defer></script>
  <script src="{{ asset('js/timer.js') }}" defer></script>
  {{-- Extra page JS --}}
  @stack('scripts')
</body>
</html>