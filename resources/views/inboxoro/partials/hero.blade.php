<div class="hero-strip">
  <div style="display:flex;align-items:center;gap:16px;flex-wrap:wrap;">
    <div class="h-tag">Instant · Private · Free</div>
    <div>
      <h1 class="hero-copy-title">
        <!-- Disposable <span class="gold">Temp Email</span> — No signup, no spam. -->
        Free <span class="gold">Temporary Email</span> – Instant Disposable Inbox for OTP & Verification
      </h1>
      <div class="hero-copy-sub">
        Generate a temporary email instantly. Receive OTPs and verification emails without exposing your real inbox.
      </div>
    </div>
  </div>

  <div style="display:flex;align-items:center;gap:10px;">
    <div class="hero-stats">
      <!-- <div class="h-stat">
        <div class="h-stat-n">12M+</div>
        <div class="h-stat-l">Emails Today</div>
      </div> -->

      <div class="h-stat">
        <div class="h-stat-n">&lt;1s</div>
        <div class="h-stat-l">Setup Time</div>
      </div>

      <!-- <div class="h-stat">
        <div class="h-stat-n">Instant</div>
        <div class="h-stat-l">Email</div>
      </div> -->

      <div class="h-stat">
        <div class="h-stat-n">0 Logs</div>
        <div class="h-stat-l">No Tracking</div>
      </div>

      <div class="h-stat">
        <div class="h-stat-n">10 Min</div>
        <div class="h-stat-l">Auto Delete</div>
      </div>

      <div class="h-stat">
        <div class="h-stat-n">{{ $domains->count() }}</div>
        <div class="h-stat-l">Domains</div>
      </div>
    </div>
  </div>
</div>

<!-- <div class="hero-strip">
  <div style="display:flex;align-items:center;gap:16px;flex-wrap:wrap;">
    <div class="h-tag">Instant · Anonymous · Free</div>
    <div>
      <div class="hero-copy-title">
        Disposable <span class="gold">Temp Email</span> — No signup, no trace, no spam.
      </div>
      <div class="hero-copy-sub">
        Generate a burner address in one click. Receive OTPs, verification links &amp;
        sign-up codes — then vanish without a trace.
      </div>
    </div>
  </div>

  <div style="display:flex;align-items:center;gap:10px;">
    <div class="hero-stats">
      <div class="h-stat">
        <div class="h-stat-n">12M+</div>
        <div class="h-stat-l">Emails Today</div>
      </div>
      <div class="h-stat">
        <div class="h-stat-n">0 Logs</div>
        <div class="h-stat-l">Zero Tracking</div>
      </div>
      <div class="h-stat">
        <div class="h-stat-n">10 Min</div>
        <div class="h-stat-l">Auto Expiry</div>
      </div>
      <div class="h-stat">
        <div class="h-stat-n">{{ $domains->count() }}</div>
        <div class="h-stat-l">Domains</div>
      </div>
    </div> -->

    <!-- <button class="hero-more-btn" id="more-btn" onclick="toggleHero()">
      About
      <svg width="11" height="11" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
        <path stroke-linecap="round" d="M19 9l-7 7-7-7"/>
      </svg>
    </button> -->
  <!-- </div>
</div> -->

{{-- ── Expandable full hero (hidden by default) ── --}}
<!-- <div class="hero-detail" id="hero-detail">
  <div class="hero-detail-inner">

    <div class="hd-big" style="color:#fff;">
      <span class="out">TEMP</span><br>
      <span class="gold">EMAIL</span><br>
      MACHINE
    </div>

    <div>
      <p class="hd-desc" style="margin-bottom:16px;">
        inboxOro gives you a real, working disposable email address that self-destructs.
        Use it to sign up for anything without exposing your real inbox to spam, trackers,
        or data leaks.
      </p>
      <p class="hd-desc">
        Built for developers, privacy advocates, and anyone who's tired of inbox clutter.
        No registration required — just generate and go.
      </p>
    </div>

    <div class="hd-feats">
      @php
        $feats = [
          ['icon' => '<path stroke-linecap="round" d="M13 10V3L4 14h7v7l9-11h-7z"/>',       'label' => 'Instant',      'desc' => 'new address under 50ms'],
          ['icon' => '<path stroke-linecap="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>', 'label' => 'Zero trace',   'desc' => 'no IP logs, no tracking'],
          ['icon' => '<circle cx="12" cy="12" r="10"/><path stroke-linecap="round" d="M12 8v4l3 3"/>',                                                                'label' => 'Auto-destruct','desc' => 'expires in 10 minutes'],
          ['icon' => '<path stroke-linecap="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>',   'label' => 'Full inbox',   'desc' => 'read, download, forward'],
          ['icon' => '<path stroke-linecap="round" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/>',                                                                      'label' => 'API access',   'desc' => 'integrate in your apps'],
        ];
      @endphp

      @foreach($feats as $f)
        <div class="hd-feat">
          <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
            {!! $f['icon'] !!}
          </svg>
          <span><b>{{ $f['label'] }}</b> — {{ $f['desc'] }}</span>
        </div>
      @endforeach
    </div>

  </div>
</div> -->