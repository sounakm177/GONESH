@extends('inboxoro.partials.public-layout')

@section('title', $seo_page->title)
@section('meta_description', $seo_page->meta_description)

@section('content')
  {{-- Toast, Nav, Hero, Generator, Inbox, Features, Sidebar, Footer same as before --}}
  @include('inboxoro.partials.nav')
  @include('inboxoro.partials.hero', ['domains' => $domains])

  <div class="page-wrap">
    <div class="left-col">
      @include('inboxoro.partials.domain-tabs', ['domains' => $domains])
      @include('inboxoro.partials.generator', ['mailbox' => $mailbox])
      @include('inboxoro.partials.inbox', ['inbox' => $inbox])

      {{-- Ad + Features --}}
      <div class="ad-slot rv" style="height:96px;margin-top:28px;">...</div>
     

        <div class="feat-strip rv">

        <div class="feat-item">
            <div class="feat-ic">
            <svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" d="M13 10V3L4 14h7v7l9-11h-7z"/>
            </svg>
            </div>
            <div class="feat-t">Instant Email</div>
            <div class="feat-d">Generate a temporary email instantly. No signup required.</div>
        </div>

        <div class="feat-item">
            <div class="feat-ic">
            <svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
            </svg>
            </div>
            <div class="feat-t">Private & Secure</div>
            <div class="feat-d">No tracking. Emails are automatically removed.</div>
        </div>

        <div class="feat-item">
            <div class="feat-ic">
            <svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <circle cx="12" cy="12" r="10"/>
                <path stroke-linecap="round" d="M12 8v4l3 3"/>
            </svg>
            </div>
            <div class="feat-t">Auto Delete</div>
            <div class="feat-d">Emails are deleted after 10 minutes.</div>
        </div>

        </div>



    
      {{-- Dynamic Content from Database --}}
      <div class="seo-content" style="margin-top:48px;">

         <div style="border:2px solid var(--INK);background:#fff;padding:32px 28px;margin-bottom:32px;">
            <h2 style="font-family:'Bebas Neue',sans-serif; font-size:1.65rem; letter-spacing:.03em; margin-bottom:14px; color:var(--INK); font-weight:600;">
            {{ $seo_page->h1 ?? $seo_page->title }}
            </h2>
            <p style="font-size:1.02rem; line-height:1.75; color:#374151; max-width:760px;">
             {!! $seo_page->intro_text !!}
            </p>
        </div>

        {{-- Dynamic FAQ if exists --}}
        {{-- Dynamic FAQ --}}
        @php
            $faqList = is_array($seo_page->faq) ? $seo_page->faq : (json_decode($seo_page->faq, true) ?? []);
        @endphp

        @if(count($faqList) > 0)
        <div style="border:2px solid var(--INK);background:#fff;padding:32px 28px;">
            <h2 style="font-family:'Bebas Neue',sans-serif; font-size:1.65rem; letter-spacing:.03em; margin-bottom:24px; color:var(--INK); font-weight:600;">
            Frequently Asked Questions
            </h2>


            <div style="display:grid; gap:28px;">
                @foreach($faqList as $item)
                <div>
                    <h3 style="font-family:'Bebas Neue',sans-serif; font-size:1.28rem; letter-spacing:.01em; margin-bottom:8px; color:var(--INK); font-weight:500;">
                    {{ $item['question'] ?? 'Question' }}
                    </h3>
                    <p style="color:#4B5563; line-height:1.7;">{{ $item['answer'] ?? '' }}</p>
                </div>
                @endforeach
            </div>
        </div>
        @endif
      </div>
    </div>

    @include('inboxoro.partials.sidebar')
  </div>

  @include('inboxoro.partials.footer')
@endsection