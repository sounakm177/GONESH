<nav class="nav-bar">
  <a href="/" class="nav-logo">
    <img src="{{asset('/images/logo.png')}}" alt="InboxOro Temporary Email" class="logo-img"
         onerror="this.style.display='none';this.nextElementSibling.style.display='flex'"/>
    <span class="nav-logo-text" style="display:none;">Inbox<span class="y">Oro</span></span>
    <span class="badge">FREE</span>
  </a>

  <!-- Hamburger — mobile only -->
  <button class="nav-ham" id="nav-ham" aria-label="Open menu" aria-expanded="false">
    <svg class="ham-icon" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
      <path stroke-linecap="round" d="M4 6h16M4 12h16M4 18h16"/>
    </svg>
    <svg class="close-icon" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="display:none;">
      <path stroke-linecap="round" d="M6 18L18 6M6 6l12 12"/>
    </svg>
  </button>

  <!-- Nav links -->
  <div class="nav-links" id="nav-links">

    <a href="/temporary-email" class="nav-link">
      <span class="nav-link-icon">
        <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
          <path stroke-linecap="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
        </svg>
      </span>
      <span class="nav-link-label">Home</span>
    </a>

    <a href="/blog" class="nav-link">
      <span class="nav-link-icon">
        <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
          <path stroke-linecap="round" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
        </svg>
      </span>
      <span class="nav-link-label">Blog</span>
    </a>

    <!-- <a href="/api" class="nav-link">
      <span class="nav-link-icon">
        <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
          <path stroke-linecap="round" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/>
        </svg>
      </span>
      <span class="nav-link-label">API</span>
    </a> -->

    <a href="/about" class="nav-link">
      <span class="nav-link-icon">
        <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
          <path stroke-linecap="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
      </span>
      <span class="nav-link-label">About</span>
    </a>

    <a href="/contact" class="nav-link">
      <span class="nav-link-icon">
        <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
          <path stroke-linecap="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
        </svg>
      </span>
      <span class="nav-link-label">Contact</span>
    </a>

    <!-- Sign In CTA -->
    <!-- <a href="/login" class="nav-cta" style="color:#000000">
      <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
        <path stroke-linecap="round" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
      </svg>
      Sign In
    </a> -->

  </div>
</nav>

<!-- Backdrop -->
<div class="nav-backdrop" id="nav-backdrop"></div>