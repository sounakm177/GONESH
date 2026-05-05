<div class="right-col">
  <div class="sidebar-sticky">

    {{-- ── Stat card ── --}}
    <div class="sidebar-stat">
      <div class="stat-n">No Signup</div>
      <div class="stat-d">Use instantly — no registration needed</div>
    </div>

    {{-- ── SEO BLOCK 1: Popular Pages (replaces Ad 300×250) ── --}}
    {{-- Ad 300×250 --}}
    {{-- <div class="ad-slot" style="height:274px;">
      <div class="ad-lbl">Advertisement</div>
      <div class="ad-sz">300 × 250</div>
      <div class="ad-nt">Ad will appear here</div>
    </div> --}}

    <div class="seo-links-card">

      <div class="seo-card-header">
        <span class="seo-card-label">Popular Pages</span>
      </div>

      <ul class="seo-link-list">


        @foreach($popular as $page)

        <li>
          <a href="{{url($page->slug)}}" title="{{ $page->h1 }}" aria-label="{{ $page->h1 }}">
            <svg width="11" height="11" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="2.5">
              <path stroke-linecap="round" stroke-linejoin="round"
                    d="M9 5l7 7-7 7"/>
            </svg>
            {{ $page->menu_title}}
          </a>
        </li>
        @endforeach
      </ul>

      <div class="seo-card-tip">
        <div class="seo-tip-label">
          <svg width="12" height="12" fill="none" viewBox="0 0 24 24"
               stroke="currentColor" stroke-width="2.5">
            <path stroke-linecap="round"
                  d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707
                     M21 12h-1M4 12H3m3.343-5.657l-.707-.707
                     m2.828 9.9a5 5 0 117.072 0l-.548.547
                     A3.374 3.374 0 0012 18.469V19a2 2 0 11-4 0v-.531
                     c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
          </svg>
          Privacy Tip
        </div>
        <p>Use a fresh email for every signup — keep spam away from your real inbox forever.</p>
      </div>

    </div>{{-- /seo-links-card --}}


    {{-- ── Pro tip card ── --}}
    <div class="pro-card">
      <div class="pro-t">💡 Tip</div>
      <div class="pro-d">
        Use a different email for each signup to avoid spam and protect your real inbox.
      </div>
      <a href="#" class="pro-link" onclick="generateNew(); return false;">
        Generate New Email →
      </a>
    </div>

    {{-- ── SEO BLOCK 2: What is Temp Email (replaces Ad 300×600) ── --}}
    {{-- Ad 300×600 --}}
    {{-- <div class="ad-slot rv" style="height:320px;">
      <div class="ad-lbl">Advertisement</div>
      <div class="ad-sz">300 × 600</div>
      <div class="ad-nt">Ad will appear here</div>
    </div> --}}

    <div class="seo-guide-card rv">

      <div class="seo-card-header">
        <span class="seo-card-label">Quick Guide</span>
      </div>

      <div class="seo-guide-body">

        <div class="seo-guide-block">
          <div class="seo-guide-title">What is Temporary Email?</div>
          <p>A temporary email is a disposable address that lets you receive OTPs and verification emails without ever exposing your real inbox to spam or trackers.</p>
          <a href="/temporary-email" class="seo-guide-link">Learn More →</a>
        </div>

        <div class="seo-guide-divider"></div>

        <div class="seo-guide-block">
          <div class="seo-guide-title">How It Works</div>
          <ol class="seo-how-list">
            <li>
              <span class="seo-step-num">01</span>
              Generate a burner address instantly
            </li>
            <li>
              <span class="seo-step-num">02</span>
              Use it to sign up anywhere
            </li>
            <li>
              <span class="seo-step-num">03</span>
              Receive OTP or verification email
            </li>
            <li>
              <span class="seo-step-num">04</span>
              Address auto-deletes in 10 min
            </li>
          </ol>
        </div>

        <div class="seo-guide-divider"></div>

        <div class="seo-guide-block">
          <div class="seo-guide-title">Why Use InboxOro?</div>
          <ul class="seo-why-list">
            <li>
              <span class="seo-check">✓</span>
              No registration required
            </li>
            <li>
              <span class="seo-check">✓</span>
              Instant — ready in &lt;1 second
            </li>
            <li>
              <span class="seo-check">✓</span>
              100% free, no hidden fees
            </li>
            <li>
              <span class="seo-check">✓</span>
              Zero IP logs or tracking
            </li>
            <li>
              <span class="seo-check">✓</span>
              Auto-deletes after 10 minutes
            </li>
          </ul>
        </div>

        <div class="seo-guide-divider"></div>

        <div class="seo-guide-block">
          <div class="seo-guide-title">Common Use Cases</div>
          <ul class="seo-why-list">
            <li><span class="seo-bullet"></span>Receiving OTPs for sign-ups</li>
            <li><span class="seo-bullet"></span>Avoiding newsletter spam</li>
            <li><span class="seo-bullet"></span>Developer &amp; QA email testing</li>
            <li><span class="seo-bullet"></span>One-time registrations</li>
          </ul>
        </div>

      </div>{{-- /seo-guide-body --}}

    </div>{{-- /seo-guide-card --}}

  </div>{{-- /sidebar-sticky --}}
</div>{{-- /right-col --}}