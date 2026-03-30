<div class="gen-block">

  <div class="gen-top">
    <span class="gen-label">Temporary Email</span>
    <div class="live-pill">
      <div class="live-dot"></div>
      ACTIVE
    </div>
  </div>

  <div class="email-row">
    <div class="email-txt" id="edisplay">{{ $mailbox->email }}</div>
    <button class="btn-copy" id="cbtn" onclick="copyEmail()">
      <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"
           style="display:inline;margin-right:5px;vertical-align:middle;">
        <rect x="9" y="9" width="13" height="13" rx="2"/>
        <path stroke-linecap="round" d="M5 15H4a2 2 0 01-2-2V4a2 2 0 012-2h9a2 2 0 012 2v1"/>
      </svg>
      Copy
    </button>
  </div>

  <div class="gen-foot">
    <div class="timer-wrap">
      <span class="timer-lbl">Expires</span>
      <div class="timer-track">
        {{-- Width driven by JS countdown; server seeds initial seconds --}}
        <div class="timer-fill" id="tbar" style="width:100%;transition:width 1s linear;"></div>
      </div>
      <span class="timer-num" id="tnum">{{ gmdate('i:s', $mailbox->secondsRemaining()) }}</span>
    </div>

    <button class="btn-new" id="btn-new-addr" onclick="generateNew()">
      <svg id="ric" width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
        <path stroke-linecap="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
      </svg>
      New Address
    </button>
  </div>

</div>