<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>inboxOro — Disposable Email</title>

  <link rel="icon" type="image/png" sizes="32x32" href="{{asset('images/favicon-32.png')}}">
  <link rel="icon" type="image/png" sizes="64x64" href="{{asset('images/favicon-64.png')}}">

  {{-- Fonts: async-loaded to avoid render-blocking --}}
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
  {{-- Inline critical CSS — eliminates render-blocking stylesheet --}}
  <link rel="stylesheet" href="{{ asset('css/inboxoro.css') }}">
  <link rel="stylesheet" href="{{ asset('css/inboxoro-mobile-patch.css') }}">
  <link rel="stylesheet" href="{{ asset('css/inboxoro-detail-fix.css') }}">  {{-- ADD THIS --}}

  <script src="{{ asset('js/inboxoro-mobile.js') }}" defer></script>


</head>
<body>

  <div id="toast">
    <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
      <path stroke-linecap="round" d="M5 13l4 4L19 7"/>
    </svg>
    COPIED
  </div>

  {{-- NAV --}}
  @include('inboxoro.partials.nav')

  {{-- HERO STRIP --}}
  @include('inboxoro.partials.hero', ['domains' => $domains])

  {{-- PAGE --}}
  <div class="page-wrap">

    {{-- LEFT COLUMN --}}
    <div class="left-col">

      {{-- Domain tabs --}}
      @include('inboxoro.partials.domain-tabs', ['domains' => $domains])

      {{-- Generator --}}
      @include('inboxoro.partials.generator', ['mailbox' => $mailbox])

      {{-- Inbox --}}
      @include('inboxoro.partials.inbox', ['inbox' => $inbox])

      {{-- Ad — Leaderboard 728×90 --}}
      <div class="ad-slot rv" style="height:96px;margin-top:28px;">
        <div class="ad-lbl">Advertisement</div>
        <div class="ad-sz">728 × 90</div>
        <div class="ad-nt">Ad will appear here</div>
      </div>

      {{-- Feature strip --}}
      @include('inboxoro.partials.features')

    </div>{{-- /left-col --}}

    {{-- RIGHT SIDEBAR --}}
    @include('inboxoro.partials.sidebar')

  </div>{{-- /page-wrap --}}

  {{-- FOOTER --}}
  @include('inboxoro.partials.footer')

  {{-- JS Bootstrap data (server → client, no extra HTTP round-trip) --}}
  @include('inboxoro.partials.js-bootstrap', ['mailbox' => $mailbox])

  {{-- Main JS --}}
  <script src="{{ asset('js/inboxoro.js') }}" defer></script>

</body>
</html>