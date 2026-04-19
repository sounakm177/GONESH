@extends('inboxoro.partials.public-layout')

@section('title', 'Free Temporary Email | Instant Disposable Inbox – inboxOro')
@section('meta_description', 'Get a free temporary email instantly. Receive OTPs and verification emails with no signup, no spam, and automatic deletion for full privacy.')

@section('content')
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
      <!-- <div class="ad-slot rv" style="height:96px;margin-top:28px;">
        <div class="ad-lbl">Advertisement</div>
        <div class="ad-sz">728 × 90</div>
        <div class="ad-nt">Ad will appear here</div>
      </div> -->

      {{-- Feature strip --}}
      @include('inboxoro.partials.features')

    </div>{{-- /left-col --}}

    {{-- RIGHT SIDEBAR --}}
    @include('inboxoro.partials.sidebar')

  </div>{{-- /page-wrap --}}

  @include('inboxoro.partials.footer')
@endsection