@extends('inboxoro.partials.public-layout')

@section('title', $seo_page->title)
@section('meta_description', $seo_page->meta_description)


@section('schema')
  {!! isset($schema) ? json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) : '{}' !!}
@endsection

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
        <!-- <div class="ad-slot rv" style="height:96px;margin-top:28px;">...</div> -->
     
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
            <div class="dynamic-content" style="border:2px solid var(--INK);background:#fff;padding:32px 28px;margin-bottom:32px;">
                <h2 style="
                    font-family:'Inter', sans-serif;
                    font-size:1.65rem;
                    letter-spacing:.03em;
                    margin-bottom:14px;
                    color:var(--INK);
                    font-weight:600;
                ">
                {{ $seo_page->h1 ?? $seo_page->title }}
                </h2>

                <p style="font-family:'Inter', sans-serif; font-size:1.02rem; line-height:1.75; color:#374151; max-width:760px;">
                    {!! $seo_page->intro_text !!}
                </p>
            </div>

            <div style="border:2px solid var(--INK);background:#fff;padding:32px 28px;margin-bottom:32px;">
                <h2 style="
                    font-family:'Inter', sans-serif;
                    font-size:1.6rem;
                    font-weight:600;
                    margin-bottom:20px;
                    color:var(--INK);
                ">
                Why Use InboxOro?  
                </h2>

                <ul style="font-family:'Inter', sans-serif; list-style:none; padding:0; display:grid; gap:14px; font-size:1.02rem; color:#111;">

                    <!-- Speed -->
                    <li style="display:flex; align-items:flex-start; gap:12px;">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M13 2L3 14h7l-1 8 12-14h-7l1-6z"/>
                        </svg>
                        <span>Generate new email in <strong>&lt;1 second</strong> — no registration needed</span>
                    </li>

                    <!-- Real-time inbox -->
                    <li style="display:flex; align-items:flex-start; gap:12px;">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M21 12a9 9 0 1 1-3-6.7"/>
                        <path d="M21 3v6h-6"/>
                        </svg>
                        <span>Real-time inbox with live updates</span>
                    </li>

                    <!-- Auto delete -->
                    <li style="display:flex; align-items:flex-start; gap:12px;">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M3 6h18"/>
                        <path d="M8 6v14a2 2 0 0 0 2 2h4a2 2 0 0 0 2-2V6"/>
                        <path d="M10 11v6M14 11v6"/>
                        </svg>
                        <span>Automatic deletion after 10 minutes for maximum privacy</span>
                    </li>

                    <!-- Compatibility -->
                    <li style="display:flex; align-items:flex-start; gap:12px;">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10"/>
                        <path d="M2 12h20M12 2a15 15 0 0 1 0 20"/>
                        </svg>
                        <span>Works perfectly for Discord, Instagram, Facebook, Gmail verification &amp; more</span>
                    </li>

                    <!-- Privacy -->
                    <li style="display:flex; align-items:flex-start; gap:12px;">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                        </svg>
                        <span>Zero tracking. Zero logs. Your real inbox stays clean.</span>
                    </li>

                </ul>
            </div>

            {{-- FAQ --}}
            @php
                $faqList = is_array($seo_page->faq) ? $seo_page->faq : (json_decode($seo_page->faq, true) ?? []);
            @endphp

            @if(count($faqList) > 0)
                <div style="border:2px solid var(--INK);background:#fff;padding:32px 28px;margin-bottom:32px;">
                    
                    <h2 style="
                        font-family:'Inter', sans-serif;
                        font-size:1.6rem;
                        font-weight:600;
                        margin-bottom:20px;
                        color:var(--INK);
                    ">
                        Frequently Asked Questions
                    </h2>

                    <div style="display:grid; gap:24px;">
                        @foreach($faqList as $item)
                        <div>
                            <h3 style="
                                font-family:'Inter', sans-serif;
                                font-size:1.1rem;
                                font-weight:600;
                                margin-bottom:6px;
                                color:var(--INK);
                            ">
                                {{ $item['question'] ?? 'Question' }}
                            </h3>

                            <p style="
                                font-family:'Inter', sans-serif;
                                font-size:0.95rem;
                                color:#4B5563;
                                line-height:1.7;
                            ">
                                {{ $item['answer'] ?? '' }}
                            </p>
                        </div>
                        @endforeach
                    </div>

                </div>
            @endif

            <section aria-labelledby="legal-heading" class="rv">
                <!-- <div class="sec-label">Legal</div> -->
                <h2 class="sec-title" id="legal-heading">Disclaimer</h2>
                <div class="legal-block">
                    <div class="legal-block-title">Important Notice</div>
                    
                    <p>
                    InboxOro provides a temporary email and disposable inbox service for lawful use, including spam protection, email privacy, and short-term email verification.
                    </p>
                    
                    <p>
                    Users are solely responsible for how they use the service. It must not be used for illegal activities, fraud, harassment, phishing, or any activity that violates applicable laws.
                    </p>
                    
                    <p>
                    Emails received in temporary inboxes are automatically deleted after expiration. We are not responsible for any loss of access to accounts or services where a temporary email address was used.
                    </p>
                    

                     @if(in_array($seo_page->slug, [
                        'temp-mail-for-facebook',
                        'temp-mail-for-instagram',
                        'temp-mail-for-discord',
                        'temp-mail-for-twitter',
                        'temp-mail-for-linkedin',
                        'temp-mail-for-tiktok'
                    ]))
                        <p>
                            InboxOro is not affiliated with or endorsed by any third-party brands mentioned on this page. 
                            All trademarks belong to their respective owners.
                        </p>
                    @endif


                    <p>
                    This is a privacy and testing utility and does not guarantee anonymity. For more details, please review our
                    <a href="/privacy-policy" style="color:var(--Y);">Privacy Policy</a> and
                    <a href="/terms" style="color:var(--Y);">Terms of Service</a>.
                    </p>
                </div>
            </section>
        </div>
    </div>

    @include('inboxoro.partials.sidebar')
  </div>

  @include('inboxoro.partials.footer')
@endsection