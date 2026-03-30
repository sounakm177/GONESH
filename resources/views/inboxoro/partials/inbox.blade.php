<div class="inbox-wrap">

  {{-- Section header --}}
  <div class="sec-header">
    <div style="display:flex;align-items:baseline;gap:12px;flex-wrap:wrap;">
      <span class="sec-title">
        Inbox&nbsp;
        <span style="color:var(--Y);font-size:1.1rem;" id="ucnt">
          {{ $inbox['unread'] > 0 ? '('.$inbox['unread'].')' : '' }}
        </span>
      </span>
      <span class="sec-meta"></span>
    </div>

    <div style="display:flex;gap:6px;">
      <button class="ib-toolbar-btn" onclick="refreshInbox()" title="Refresh">
        <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
          <path stroke-linecap="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
        </svg>
      </button>
      <button class="ib-toolbar-btn" onclick="markAllRead()" title="Mark all read">
        <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
          <path stroke-linecap="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
      </button>
      <button class="ib-toolbar-btn" onclick="deleteAllMsgs()" title="Delete all">
        <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
          <polyline points="3 6 5 6 21 6"/>
          <path stroke-linecap="round" d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6m5 0V4a1 1 0 011-1h2a1 1 0 011 1v2"/>
        </svg>
      </button>
    </div>
  </div>

  {{-- Inbox split shell: list | detail --}}
  <div class="inbox-shell">

    {{-- LIST PANEL --}}
    <div class="inbox-list-panel">

      <div class="inbox-search">
        <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="#9CA3AF" stroke-width="2.2">
          <circle cx="11" cy="11" r="8"/>
          <path stroke-linecap="round" d="M21 21l-4.35-4.35"/>
        </svg>
        <input id="search-inp" type="text" placeholder="Search messages..."
               oninput="debounceSearch(this.value)"/>
      </div>

      <div id="email-list">
        {{-- Server-rendered first batch (SSR for LCP speed) --}}
        @forelse($inbox['emails'] as $em)
          @include('inboxoro.partials.email-row', ['em' => $em])
        @empty
          <div class="no-mail">
            <svg width="40" height="40" fill="none" viewBox="0 0 24 24" stroke="#D1D5DB" stroke-width="1.2">
              <path stroke-linecap="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
            </svg>
            <p>No messages yet</p>
          </div>
        @endforelse
      </div>

      <div class="inbox-list-footer">
        <span id="list-count">
          {{ $inbox['total'] }} message{{ $inbox['total'] !== 1 ? 's' : '' }}
        </span>
        &nbsp;·&nbsp;expires&nbsp;
        <b id="itimer" style="color:var(--INK);">{{ gmdate('i:s', $mailbox->secondsRemaining()) }}</b>
      </div>

    </div>{{-- /inbox-list-panel --}}

    {{-- DETAIL PANEL --}}
    <div class="inbox-detail-panel">
      <div class="detail-empty" id="detail-empty">
        <svg width="48" height="48" fill="none" viewBox="0 0 24 24" stroke="#D1D5DB" stroke-width="1">
          <path stroke-linecap="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
        </svg>
        <p>Select a message to read</p>
      </div>
      <div class="detail-content" id="detail-content" style="display:none;"></div>
    </div>

  </div>{{-- /inbox-shell --}}
</div>{{-- /inbox-wrap --}}