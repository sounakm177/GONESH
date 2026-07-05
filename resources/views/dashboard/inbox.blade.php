@extends('layouts.authLayout')

@section('title', 'InboxOro — Inbox')

@push('styles')
<style>

/* ══════════════════════════════════════════════
   INBOX PAGE EXTRAS
══════════════════════════════════════════════ */

/* ── Full-height inbox shell for this dedicated page ── */
.inbox-page-wrap {
  display:        flex;
  flex-direction: column;
  height:         100%;
  overflow:       hidden;
  border: 1px solid var(--BD);
  border-radius: 8px;
}

/* ── Active address bar (top strip) ── */
.addr-strip {
  display:         flex;
  align-items:     center;
  gap:             10px;
  padding: 30px 16px 12px 16px;
  background:      var(--SURF);
  border-bottom:   1px solid var(--BD);
  flex-shrink:     0;
  flex-wrap:       wrap;
}

.addr-strip-email {
  display:       flex;
  align-items:   center;
  gap:           10px;
  flex:          1;
  min-width:     0;
  background:    var(--BG);
  border:        1px solid var(--BD);
  border-radius: 9px;
  padding:       9px 14px;
}

.addr-strip-txt {
  font-family:   var(--MONO);
  font-size:     clamp(.7rem, 2.5vw, .9rem);
  font-weight:   700;
  color:         var(--INK);
  flex:          1;
  min-width:     0;
  overflow:      hidden;
  text-overflow: ellipsis;
  white-space:   nowrap;
  letter-spacing:-.01em;
}

.addr-strip-live {
  display:    flex;
  align-items:center;
  gap:        5px;
  font-family:var(--MONO);
  font-size:  .6rem;
  font-weight:700;
  color:      var(--GREEN);
  letter-spacing:.05em;
  flex-shrink:0;
}
.addr-live-dot {
  width:6px; height:6px;
  background:var(--GREEN);
  border-radius:50%;
  animation:pulse-green 2s ease-in-out infinite;
}
@keyframes pulse-green {
  0%,100%{box-shadow:0 0 0 0 rgba(16,185,129,.4)}
  50%{box-shadow:0 0 0 4px rgba(16,185,129,0)}
}

.addr-copy-btn {
  display:         flex;
  align-items:     center;
  gap:             5px;
  background:      var(--Y);
  color:           var(--INK);
  font-size:       .74rem;
  font-weight:     700;
  padding:         8px 14px;
  border-radius:   8px;
  flex-shrink:     0;
  white-space:     nowrap;
  transition:      background .15s, transform .1s;
}
.addr-copy-btn:hover {background:#EAB800; transform:translateY(-1px);}
.addr-copy-btn.ok    {background:var(--GREEN); color:#fff;}

.addr-new-btn {
  display:     flex;
  align-items: center;
  gap:         5px;
  background:  var(--SURF);
  color:       var(--MU);
  font-size:   .74rem;
  font-weight: 600;
  padding:     8px 12px;
  border-radius:8px;
  border:      1px solid var(--BD);
  flex-shrink: 0;
  white-space: nowrap;
  transition:  background .12s, color .12s;
}
.addr-new-btn:hover {background:var(--BD2); color:var(--INK);}

/* Timer strip */
.timer-strip {
  display:         flex;
  align-items:     center;
  gap:             8px;
  padding:         6px 16px 8px;
  background:      var(--SURF);
  border-bottom:   1px solid var(--BD);
  flex-shrink:     0;
}
.timer-strip-lbl {
  font-family:var(--MONO); font-size:.6rem; font-weight:700;
  letter-spacing:.06em; text-transform:uppercase; color:var(--MU);
  white-space:nowrap;
}
.timer-strip-track {
  flex:1; height:4px; background:var(--BD2);
  border-radius:2px; overflow:hidden;
}
.timer-strip-fill {
  height:100%; background:var(--Y); border-radius:2px;
  transition: width .9s linear;
}
.timer-strip-num {
  font-family:var(--MONO); font-size:.72rem; font-weight:700;
  color:var(--INK); white-space:nowrap; min-width:38px; text-align:right;
}
.timer-strip-btns {
  display:flex; gap:4px; flex-shrink:0;
}
.timer-ctrl-btn {
  display:flex; align-items:center; gap:4px;
  font-family:var(--MONO); font-size:.6rem; font-weight:700;
  letter-spacing:.05em;
  padding:4px 9px; border-radius:6px;
  border:1px solid var(--BD);
  background:var(--SURF); color:var(--INK);
  white-space:nowrap; cursor:pointer;
  transition:background .12s, border-color .12s, color .12s;
}
.timer-ctrl-btn:hover {background:var(--INK); border-color:var(--INK); color:var(--Y);}

/* Domain tabs strip */
.domain-strip {
  display:         flex;
  align-items:     center;
  padding:         0 0;
  background:      var(--SURF);
  border-bottom:   1px solid var(--BD);
  overflow-x:      auto;
  scrollbar-width: none;
  flex-shrink:     0;
}
.domain-strip::-webkit-scrollbar {display:none;}

.domain-tab {
  font-family:    var(--MONO);
  font-size:      .62rem;
  font-weight:    600;
  padding:        9px 14px;
  color:          var(--MU);
  white-space:    nowrap;
  flex-shrink:    0;
  cursor:         pointer;
  border-bottom:  2px solid transparent;
  transition:     color .12s, border-color .12s, background .12s;
  background:     none;
  border-top:none; border-left:none; border-right:none;
  letter-spacing:.04em;
}
.domain-tab:hover  {color:var(--INK); background:var(--BD2);}
.domain-tab.active {color:var(--INK); border-bottom-color:var(--Y); font-weight:700;}

/* ── Main 3-panel layout ── */
.inbox-3col {
  display:  flex;
  flex:     1;
  overflow: hidden;
  min-height: 0;
  position: relative;
}

/* Left: email list */
.inbox-list-col {
  width:          300px;
  min-width:      300px;
  border-right:   1px solid var(--BD);
  display:        flex;
  flex-direction: column;
  overflow:       hidden;
  flex-shrink:    0;
  background:     var(--SURF);
}

/* List toolbar */
.list-toolbar {
  display:         flex;
  align-items:     center;
  justify-content: space-between;
  padding:         10px 14px;
  border-bottom:   1px solid var(--BD);
  flex-shrink:     0;
  gap:             8px;
}
.list-toolbar-title {
  font-size:   .82rem;
  font-weight: 700;
  color:       var(--INK);
  display:     flex;
  align-items: center;
  gap:         6px;
}
.unread-badge {
  background:   var(--INK);
  color:        var(--Y);
  font-family:  var(--MONO);
  font-size:    .52rem;
  font-weight:  800;
  padding:      2px 6px;
  border-radius:10px;
}
.list-toolbar-actions {display:flex; gap:4px;}
.list-act-btn {
  width:28px; height:28px;
  display:flex; align-items:center; justify-content:center;
  border-radius:7px; border:1px solid var(--BD);
  background:var(--SURF); color:var(--MU);
  cursor:pointer; transition:background .12s, color .12s, border-color .12s;
}
.list-act-btn:hover {background:var(--BD2); color:var(--INK); border-color:#D1D5DB;}
.list-act-btn.del:hover {background:rgba(239,68,68,.08); color:var(--RED); border-color:rgba(239,68,68,.3);}

/* List search */
.list-search {
  display:flex; align-items:center; gap:8px;
  padding:8px 14px;
  border-bottom:1px solid var(--BD);
  background:#FAFAFA;
  flex-shrink:0;
}
.list-search input {
  border:none; outline:none; background:transparent;
  font-family:var(--BODY); font-size:.84rem; color:var(--INK); flex:1;
  font-size:16px;
}
.list-search input::placeholder {color:var(--MU2);}

/* Email list scroll */
.email-scroll {
  flex:1; overflow-y:auto; overflow-x:hidden;
}
.email-scroll::-webkit-scrollbar {width:4px;}
.email-scroll::-webkit-scrollbar-thumb {background:var(--BD); border-radius:2px;}

/* List tab bar (All / Unread / Starred) */
.list-tabs {
  display:flex; border-bottom:1px solid var(--BD);
  padding:0 8px; gap:2px; flex-shrink:0;
  background:var(--SURF);
}
.list-tab {
  font-family:var(--MONO); font-size:.6rem; font-weight:700;
  letter-spacing:.06em; text-transform:uppercase;
  padding:7px 10px; color:var(--MU);
  border-bottom:2px solid transparent; margin-bottom:-1px;
  cursor:pointer; background:none;
  border-top:none; border-left:none; border-right:none;
  transition:color .12s, border-color .12s;
}
.list-tab:hover {color:var(--INK);}
.list-tab.active {color:var(--INK); border-bottom-color:var(--Y);}

/* List footer count */
.list-footer {
  padding:7px 14px;
  border-top:1px solid var(--BD);
  background:#FAFAFA;
  font-family:var(--MONO); font-size:.6rem; color:var(--MU);
  display:flex; align-items:center; gap:5px;
  flex-shrink:0;
}

/* Middle: detail panel */
.inbox-detail-col {
  flex:1; display:flex; flex-direction:column;
  overflow:hidden; background:var(--SURF); min-width:0;
}

/* Right: info sidebar (desktop ≥1100px) */
.inbox-info-col {
  display:none;
  width:220px; min-width:220px;
  border-left:1px solid var(--BD);
  background:var(--SURF);
  flex-direction:column;
  overflow-y:auto;
  padding:16px;
  gap:16px;
}
.info-section {margin-bottom:18px;}
.info-section-title {
  font-family:var(--MONO); font-size:.58rem; font-weight:700;
  letter-spacing:.1em; text-transform:uppercase; color:var(--MU2);
  margin-bottom:10px;
}
.info-stat {
  display:flex; align-items:center; justify-content:space-between;
  padding:6px 0; border-bottom:1px solid var(--BD2);
  font-size:.78rem;
}
.info-stat:last-child {border-bottom:none;}
.info-stat-lbl {color:var(--MU);}
.info-stat-val {font-weight:600; color:var(--INK);}

/* Empty detail state */
.detail-empty-state {
  flex:1; display:flex; flex-direction:column;
  align-items:center; justify-content:center;
  gap:14px; color:var(--MU2); padding:40px 20px; text-align:center;
}
.detail-empty-icon {
  width:56px; height:56px;
  background:var(--BD2); border-radius:14px;
  display:flex; align-items:center; justify-content:center;
  color:var(--MU2);
}
.detail-empty-title {font-size:.9rem; font-weight:600; color:var(--MU);}
.detail-empty-sub   {font-size:.76rem; max-width:200px; line-height:1.5; color:var(--MU2);}

/* Email row refinements */
.erow {
  display:flex; align-items:flex-start;
  gap:10px; padding:12px 14px;
  border-bottom:1px solid var(--BD2);
  cursor:pointer; position:relative;
  transition:background .1s;
  -webkit-tap-highlight-color:transparent;
}
.erow:last-child   {border-bottom:none;}
.erow:hover        {background:#FFFBEB;}
.erow.selected     {background:#FEF9C3; border-left:3px solid var(--Y);}
.erow.unread       {background:#FFFDE7;}
.erow.unread .e-sender  {font-weight:700;}
.erow.unread .e-subject {font-weight:600; color:var(--INK);}

.erow-left {display:flex; flex-direction:column; align-items:center; gap:5px; flex-shrink:0; padding-top:2px;}
.erow-avatar {
  width:34px; height:34px; border-radius:50%;
  display:flex; align-items:center; justify-content:center;
  font-family:var(--DISP); font-size:1rem; color:#fff;
  flex-shrink:0; border:2px solid var(--INK);
}
.udot-sm {width:6px;height:6px;background:var(--Y);border-radius:50%;border:1.5px solid var(--INK);flex-shrink:0;}
.rdot-sm {width:6px;height:6px;flex-shrink:0;}
.erow-body {flex:1; min-width:0;}
.erow-top-row {display:flex;align-items:baseline;justify-content:space-between;gap:4px;margin-bottom:2px;}
.e-sender  {font-size:.8rem;color:var(--INK);white-space:nowrap;overflow:hidden;text-overflow:ellipsis;max-width:140px;}
.e-time    {font-family:var(--MONO);font-size:.6rem;color:var(--MU2);flex-shrink:0;}
.e-subject {font-size:.78rem;color:var(--INK);white-space:nowrap;overflow:hidden;text-overflow:ellipsis;font-weight:500;margin-bottom:2px;}
.e-preview {font-size:.72rem;color:var(--MU2);white-space:nowrap;overflow:hidden;text-overflow:ellipsis;}

/* Detail view */
.detail-toolbar {
  display:flex; align-items:center; justify-content:space-between;
  padding:10px 16px; border-bottom:1px solid var(--BD);
  background:#FAFAFA; flex-shrink:0; gap:8px; flex-wrap:wrap;
}
.detail-toolbar-left {display:flex;align-items:center;gap:6px;flex-wrap:wrap;}
.dtl-btn {
  display:inline-flex; align-items:center; gap:5px;
  font-size:.74rem; font-weight:600; color:var(--INK);
  background:var(--SURF); border:1px solid var(--BD);
  padding:6px 12px; border-radius:7px; cursor:pointer;
  transition:background .12s, color .12s;
  white-space:nowrap;
}
.dtl-btn:hover        {background:var(--BD2); color:var(--INK);}
.dtl-btn.danger:hover {background:rgba(239,68,68,.08); color:var(--RED); border-color:rgba(239,68,68,.3);}

.detail-header {
  padding:16px 20px 14px;
  border-bottom:1px solid var(--BD);
  flex-shrink:0;
}
.detail-subject {
  font-family:var(--DISP); font-size:1.4rem; letter-spacing:.03em;
  color:var(--INK); margin-bottom:12px; line-height:1;
}
.detail-meta-row {display:flex;align-items:center;gap:12px;flex-wrap:wrap;}
.detail-avatar {
  width:38px; height:38px; border-radius:50%;
  display:flex; align-items:center; justify-content:center;
  font-family:var(--DISP); font-size:1.1rem; color:#fff;
  border:2px solid var(--INK); flex-shrink:0;
}
.detail-meta-info {flex:1;min-width:0;}
.detail-from-name  {font-size:.86rem;font-weight:700;color:var(--INK);}
.detail-from-email {font-size:.74rem;color:var(--MU);font-family:var(--MONO);overflow:hidden;text-overflow:ellipsis;white-space:nowrap;}
.detail-to-line    {font-size:.72rem;color:var(--MU);margin-top:2px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;}
.detail-timestamp  {font-family:var(--MONO);font-size:.68rem;color:var(--MU2);white-space:nowrap;flex-shrink:0;}

.detail-body {
  flex:1; overflow-y:auto; overflow-x:hidden;
  padding:20px; font-size:.88rem; line-height:1.75; color:#374151;
  overscroll-behavior:auto; -webkit-overflow-scrolling:touch;
}
.detail-body::-webkit-scrollbar {width:4px;}
.detail-body::-webkit-scrollbar-thumb {background:var(--BD); border-radius:2px;}
.detail-body p {margin-bottom:14px;}
.otp-box {
  display:inline-block; font-family:var(--MONO);
  font-size:clamp(1.4rem,5vw,2rem); font-weight:700;
  letter-spacing:.15em; color:var(--INK); background:var(--Y);
  padding:12px 22px; border:2px solid var(--INK);
  box-shadow:4px 4px 0 var(--INK); margin:14px 0;
}

/* No mail state */
.no-mail {
  display:flex; flex-direction:column; align-items:center;
  justify-content:center; padding:40px 20px; gap:10px;
}
.no-mail svg {opacity:.5;}
.no-mail p   {font-size:.8rem;color:var(--MU2);margin:0;}

/* Quick reply bar */
.quick-reply {
  padding:12px 16px;
  border-top:1px solid var(--BD);
  background:var(--SURF);
  display:flex; align-items:center; gap:8px;
  flex-shrink:0;
}
.quick-reply-note {
  font-size:.74rem; color:var(--MU2);
  font-family:var(--MONO);
}

/* Toast */
#toast {
  position:fixed; bottom:20px; right:16px;
  background:var(--INK); color:#fff;
  font-family:var(--MONO); font-size:.74rem; font-weight:600;
  padding:10px 16px; border-radius:8px;
  box-shadow:0 4px 20px rgba(0,0,0,.2);
  z-index:999; display:flex; align-items:center; gap:7px;
  transform:translateY(70px); opacity:0;
  transition:transform .3s cubic-bezier(.34,1.56,.64,1), opacity .25s;
}
#toast.show {transform:translateY(0); opacity:1;}
#toast .toast-dot {width:7px;height:7px;background:var(--GREEN);border-radius:50%;}

/* Mobile back bar */
.mob-back-bar {
  display:none;
  align-items:center; gap:8px;
  padding:10px 16px;
  background:var(--Y); border-bottom:1px solid var(--INK);
  font-family:var(--MONO); font-size:.7rem; font-weight:700;
  letter-spacing:.08em; text-transform:uppercase;
  color:var(--INK); cursor:pointer; flex-shrink:0;
  transition:background .12s;
}
.mob-back-bar:hover {background:#EAB800;}

/* Mobile: full-screen transitions */
@media (max-width: 899px) {
  .inbox-list-col  { width:100%; min-width:0; }
  .inbox-detail-col {
    display:none;
    position:absolute; inset:0; z-index:10;
    background:var(--SURF);
  }
  .mob-back-bar { display:flex; }

  .inbox-3col.mob-detail .inbox-list-col  { display:none; }
  .inbox-3col.mob-detail .inbox-detail-col {
    display:flex; animation:slide-in-right .2s cubic-bezier(.4,0,.2,1) both;
  }
  @keyframes slide-in-right {
    from{transform:translateX(24px);opacity:0;}
    to{transform:translateX(0);opacity:1;}
  }
}

@media (min-width: 900px) {
  .inbox-list-col { width:320px; min-width:280px; }
  .mob-back-bar   { display:none !important; }
}

@media (min-width: 1100px) {
  .inbox-info-col { display:flex; }
}

@media (min-width: 1100px) {
    .main {
        padding: 32px 25px 32px 25px;
    }
}


@media (max-width: 899px) {
  /* The layout locks html/body with overflow:hidden.
     On mobile we need normal scroll so the inbox-page-wrap
     can grow taller than the viewport when the list is long. */
  html, body { overflow: auto !important; }

  /* main already gets overflow-y:auto from the layout; that's fine
     on desktop. On mobile we let the native page scroll take over
     so momentum scrolling / pull-to-refresh work. */
  .main { overflow: visible !important; }

  /* inbox-page-wrap: let it grow to fit content instead of being
     pinned to the viewport height */
  .inbox-page-wrap {
    height: auto !important;
    min-height: calc(100dvh - 56px); /* 56px = topbar */
  }

  /* The 3-col area should NOT be flex:1 (which collapses to 0 when
     the parent has no fixed height). Give it an explicit min-height
     so the list is always readable. */
  .inbox-3col {
    flex: none !important;
    min-height: 480px;
    height: auto !important;
  }

  /* The email list scroll area: let it grow naturally on mobile */
  .email-scroll { overflow-y: visible !important; flex: none !important; }

  /* The detail column goes full-screen on mobile (position:absolute)
     so it's already independent — no change needed there. */
}

/* 2. Desktop fix: ensure the full viewport height is used so the
      3-col inbox fills the space without an extra scrollbar. */
@media (min-width: 900px) {
  /* Remove the extra bottom padding from .main so the inbox
     can reach all the way to the bottom of the viewport. */
  .main.inbox-main-override {
    padding-bottom: 0 !important;
    overflow: hidden !important; /* keep the inner panels scrollable */
    display: flex;
    flex-direction: column;
  }

  /* inbox-page-wrap fills whatever .main gives it */
  .inbox-page-wrap {
    flex: 1;
    min-height: 0;    /* required in a flex child to allow shrinking */
    height: 100%;
    overflow: hidden;
  }

  /* 3-col fills the wrap */
  .inbox-3col {
    flex: 1;
    min-height: 0;
    overflow: hidden;
  }

  /* The email list column: the scrollable area should be flex:1
     so it fills its column and clips at the bottom */
  .inbox-list-col {
    height: 100%;
    overflow: hidden;
  }
  .email-scroll {
    flex: 1;
    overflow-y: auto;
    min-height: 0;
  }

  /* The detail column needs to fill the middle and scroll the body */
  .inbox-detail-col {
    height: 100%;
    overflow: hidden;
  }
}

/* 3. Email body height — the single most common cause of the body
      appearing "too small". The chain must be:
        .inbox-detail-col (flex column, height 100%)
          └─ #detail-content (flex column, flex:1, min-height:0)
               └─ .detail-body (flex:1, overflow-y:auto, min-height:0) */
#detail-content {
  display: flex;
  flex-direction: column;
  flex: 1;
  min-height: 0;   /* ← this is the key — without it flex:1 won't shrink */
  overflow: hidden;
}

.detail-body {
  flex: 1;
  min-height: 0;   /* ← same here */
  overflow-y: auto;
  overflow-x: hidden;
  padding: 20px;
  font-size: .88rem;
  line-height: 1.75;
  color: #374151;
  -webkit-overflow-scrolling: touch;
  overscroll-behavior: contain;
}
.detail-body::-webkit-scrollbar       { width: 4px; }
.detail-body::-webkit-scrollbar-thumb { background: var(--BD); border-radius: 2px; }

/* 4. Right info sidebar should also scroll independently */
.inbox-info-col {
  overflow-y: auto;
  height: 100%;
}
.inbox-info-col::-webkit-scrollbar       { width: 3px; }
.inbox-info-col::-webkit-scrollbar-thumb { background: var(--BD); border-radius: 2px; }

/* 5. The timer bar: remove the CSS animation shorthand that fights
      with the JS-driven width updates. Use transition instead. */
.timer-strip-fill {
  height: 100%;
  background: var(--Y);
  border-radius: 2px;
  width: 68%;                    /* JS overwrites this every second */
  transition: width .9s linear;  /* smooth, JS-compatible */
  animation: none !important;    /* disable the CSS shrink animation */
}

/* 6. Prevent the inbox-page-wrap border from causing a double
      scrollbar on very small heights */
.inbox-page-wrap {
  box-sizing: border-box;
}

/* ═══ INBOX TABS STRIP ═══ */
.inbox-strip {
  display:         flex;
  align-items:     center;
  padding:         4px 12px;
  background:      var(--SURF);
  border-bottom:   1px solid var(--BD);
  overflow-x:      auto;
  scrollbar-width: none;
  flex-shrink:     0;
  gap:             4px;
}
.inbox-strip::-webkit-scrollbar {display:none;}
.inbox-tab {
  display:         inline-flex;
  align-items:     center;
  gap:             6px;
  font-family:     var(--MONO);
  font-size:       .66rem;
  font-weight:     600;
  padding:         5px 12px;
  border-radius:   6px;
  background:      var(--SURF);
  color:           var(--MU);
  white-space:     nowrap;
  cursor:          pointer;
  transition:      background .12s, color .12s, border-color .12s;
  flex-shrink:     0;
  max-width:       180px;
}
.inbox-tab:hover  {color: var(--INK); border-color: #D1D5DB; }
.inbox-tab .inbox-tab-addr {
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
}
.inbox-tab .inbox-tab-close {
  display: inline-flex; align-items: center; justify-content: center;
  width: 16px; height: 16px; border-radius: 50%;
   color: var(--MU);
  flex-shrink: 0; cursor: pointer;
  transition: background .12s;
  border: none; padding: 0; font-size: 10px; line-height: 1;
}
.inbox-tab .inbox-tab-close:hover { background: var(--RED); color: #fff; }
.inbox-tab.active .inbox-tab-close { background: rgba(255,255,255,.15); color: var(--Y); }
.inbox-tab.active .inbox-tab-close:hover { background: var(--RED); color: #fff; }
.inbox-add-btn {
  display: inline-flex; align-items: center; justify-content: center;
  width: 26px; height: 26px; border-radius: 6px;
  border: 1px dashed var(--MU2);
  background: var(--SURF); color: var(--MU2);
  cursor: pointer; flex-shrink: 0; font-size: 14px; line-height: 1;
  transition: background .12s, color .12s, border-color .12s;
}
.inbox-add-btn:hover { background: var(--BD2); color: var(--INK); border-color: var(--MU); }
.inbox-tab-dot {
  width: 5px; height: 5px; border-radius: 50%; flex-shrink: 0;
  background: var(--GREEN);
}

/* ── Mobile responsive refinements ── */
@media (max-width: 480px) {
  .addr-strip { padding: 12px 8px 6px; gap: 4px; }
  .addr-strip-email { padding: 6px 8px; }
  .addr-copy-btn, .addr-new-btn { font-size: .66rem; padding: 5px 8px; }
  .addr-strip .page-title { font-size: .8rem; }
  .timer-strip { padding: 4px 8px; flex-wrap: wrap; gap: 4px; }
  .timer-strip-btns { width: 100%; justify-content: flex-end; margin-top: 2px; }
  .timer-ctrl-btn { font-size: .55rem; padding: 3px 7px; }
  .inbox-tab { font-size: .56rem; padding: 4px 8px; max-width: 120px; }
  .inbox-add-btn { width: 22px; height: 22px; font-size: 12px; }
  .list-toolbar { padding: 8px 10px; }
  .list-toolbar-title { font-size: .76rem; }
  .list-search { padding: 6px 10px; }
  .list-tab { font-size: .55rem; padding: 6px 7px; }
  .email-scroll .erow { padding: 10px; gap: 8px; }
  .e-sender { font-size: .74rem; max-width: 100px; }
  .e-subject { font-size: .72rem; }
  .e-preview { font-size: .66rem; }
  .detail-subject { font-size: 1.1rem; }
  .detail-header { padding: 12px 14px 10px; }
  .detail-body { padding: 14px; font-size: .82rem; }
  .detail-toolbar { padding: 8px 10px; }
  .dtl-btn { font-size: .68rem; padding: 5px 8px; }
  .inbox-info-col { display: none !important; }
  .list-footer { font-size: .55rem; padding: 5px 10px; }
}

@media (max-width: 899px) {
  .addr-strip .addr-new-btn { display: none; }
  .addr-strip .btn-primary.yellow { display: flex; }
}

@media (min-width: 900px) {
  .addr-strip .addr-new-btn { display: flex; }
  .addr-strip .btn-primary.yellow { display: none; }
}
</style>

<!-- overflow-y: auto !important; -->
@endpush

@section('content')
    <!-- Page header -->
   

    <div class="inbox-page-wrap shadow-xl">
      
      <!-- ── Active address bar ── -->
        <div class="addr-strip">
          <div class="page-title">INBOX</div>
          <div class="addr-strip-email">
          <div class="addr-strip-live">
            <div class="addr-live-dot"></div>
            LIVE
          </div>
          <div class="addr-strip-txt" id="edisplay">ghost.wolf2847@dropit.io</div>
        </div>
        <button class="addr-copy-btn" id="cbtn" onclick="copyEmailInbox()">
          <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
            <rect x="9" y="9" width="13" height="13" rx="2"/>
            <path stroke-linecap="round" d="M5 15H4a2 2 0 01-2-2V4a2 2 0 012-2h9a2 2 0 012 2v1"/>
          </svg>
          Copy
        </button>
        <button class="addr-new-btn" onclick="genNewInbox()">
          <svg id="new-spin" width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
            <path stroke-linecap="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
          </svg>
          New
        </button>
        <button class="btn-primary yellow" onclick="genNewInbox()" style="white-space:nowrap;font-size:.76rem;padding:8px 14px;border-radius:8px;">
          <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M12 4v16m8-8H4"/></svg>
          Generate New
        </button>
      </div>

      <!-- ── Inbox tabs ── -->
      <div class="inbox-strip" id="inbox-strip"></div>

      <!-- ── Timer strip ── -->
      <div class="timer-strip">
        <span class="timer-strip-lbl">Expires in</span>
        <div class="timer-strip-track">
          <div class="timer-strip-fill" id="tbar" style="width:68%;"></div>
        </div>
        <span class="timer-strip-num" id="tnum">08:12</span>
        <div class="timer-strip-btns">
          <button class="timer-ctrl-btn" onclick="extendTimer()" title="Add 10 minutes">
            <svg width="11" height="11" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M12 4v16m8-8H4"/></svg>
            +10m
          </button>
        </div>
      </div>

      <!-- ── 3-column inbox ── -->
      <div class="inbox-3col" id="inbox-3col">

        <!-- LEFT: list -->
        <div class="inbox-list-col">
          <div class="list-toolbar">
            <div class="list-toolbar-title">
              Messages
              <span class="unread-badge" id="ucnt">3</span>
            </div>
            <div class="list-toolbar-actions">
              <button class="list-act-btn" title="Mark all read" onclick="markAllReadInbox()">
                <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M5 13l4 4L19 7"/></svg>
              </button>
              <button class="list-act-btn" title="Refresh" onclick="refreshInboxList()">
                <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
              </button>
              <button class="list-act-btn del" title="Delete all" onclick="deleteAllInbox()">
                <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><polyline points="3 6 5 6 21 6"/><path stroke-linecap="round" d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6"/></svg>
              </button>
            </div>
          </div>

          <div class="list-search">
            <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><path stroke-linecap="round" d="M21 21l-4.35-4.35"/></svg>
            <input type="text" placeholder="Search messages…" oninput="debounceSearchInbox(this.value)"/>
          </div>

          <div class="list-tabs">
            <button class="list-tab active" onclick="switchTab(this,'all')">All</button>
            <button class="list-tab" onclick="switchTab(this,'unread')">Unread</button>
            <button class="list-tab" onclick="switchTab(this,'starred')">Starred</button>
          </div>

          <div class="email-scroll" id="email-list">
            <!-- email rows rendered by JS -->
          </div>

          <div class="list-footer" id="list-count">
            <svg width="9" height="9" fill="var(--GREEN)" viewBox="0 0 10 10"><circle cx="5" cy="5" r="5"/></svg>
            5 messages · 3 unread
          </div>
        </div>

        <!-- MIDDLE: detail -->
        <div class="inbox-detail-col" id="inbox-detail-col">

          <div class="mob-back-bar" onclick="closeMailDetail()">
            <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
              <path stroke-linecap="round" d="M15 19l-7-7 7-7"/>
            </svg>
            Back to inbox
          </div>

          <!-- Empty state -->
          <div class="detail-empty-state" id="detail-empty">
            <div class="detail-empty-icon">
              <svg width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
              </svg>
            </div>
            <div class="detail-empty-title">No message selected</div>
            <div class="detail-empty-sub">Click on a message in the list to read it here</div>
          </div>

          <!-- Detail content (injected by JS) -->
          <div id="detail-content" style="display:none;flex-direction:column;flex:1;overflow:hidden;">

            <div class="detail-toolbar">
              <div class="detail-toolbar-left">
                <button class="dtl-btn" onclick="markUnreadCurrent()">
                  <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8"/></svg>
                  Mark Unread
                </button>
                <button class="dtl-btn">
                  <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M3 10h18M3 14h18"/></svg>
                  View Raw
                </button>
                <button class="dtl-btn">
                  <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                  Print
                </button>
              </div>
              <button class="dtl-btn danger" onclick="deleteCurrentMail()">
                <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><polyline points="3 6 5 6 21 6"/><path stroke-linecap="round" d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6m5 0V4a1 1 0 011-1h2a1 1 0 011 1v2"/></svg>
                Delete
              </button>
            </div>

            <div class="detail-header">
              <div class="detail-subject" id="d-subject">Verify your Google account</div>
              <div class="detail-meta-row">
                <div class="detail-avatar" id="d-avatar" style="background:#4285F4;">G</div>
                <div class="detail-meta-info">
                  <div class="detail-from-name" id="d-name">Google</div>
                  <div class="detail-from-email" id="d-email">&lt;noreply@accounts.google.com&gt;</div>
                  <div class="detail-to-line">To: <span style="font-family:var(--MONO);" id="d-to">ghost.wolf2847@dropit.io</span></div>
                </div>
                <div class="detail-timestamp" id="d-time">2 min ago</div>
              </div>
            </div>

            <div class="detail-body" id="d-body">
              <p>Hi there,</p>
              <p>We received a request to verify the email address associated with your Google Account.</p>
              <p>Your verification code is:</p>
              <div class="otp-box">847 291</div>
              <p>This code expires in <strong>10 minutes</strong>. Do not share it with anyone — Google will never ask for this code.</p>
              <hr style="border:none;border-top:1px solid var(--BD);margin:20px 0;"/>
              <p style="font-size:.76rem;color:var(--MU2);">If you didn't request this, you can safely ignore this email. Your account remains secure.</p>
              <p style="font-size:.76rem;color:var(--MU2);">Google LLC, 1600 Amphitheatre Parkway, Mountain View, CA 94043</p>
            </div>

            <div class="quick-reply">
              <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="color:var(--MU2);flex-shrink:0;"><path stroke-linecap="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
              <span class="quick-reply-note">Replies are not supported — this is a read-only inbox</span>
            </div>

          </div>
        </div>

        <!-- RIGHT: info sidebar -->
        <div class="inbox-info-col" id="inbox-info-col">
          <div class="info-section">
            <div class="info-section-title">Sender Info</div>
            <div class="info-stat"><span class="info-stat-lbl">From</span><span class="info-stat-val" style="font-size:.76rem;">Google</span></div>
            <div class="info-stat"><span class="info-stat-lbl">Domain</span><span class="info-stat-val" style="font-family:var(--MONO);font-size:.72rem;">google.com</span></div>
            <div class="info-stat"><span class="info-stat-lbl">Received</span><span class="info-stat-val" style="font-size:.76rem;">2m ago</span></div>
          </div>
          <div class="info-section">
            <div class="info-section-title">Inbox Stats</div>
            <div class="info-stat"><span class="info-stat-lbl">Total</span><span class="info-stat-val">5</span></div>
            <div class="info-stat"><span class="info-stat-lbl">Unread</span><span class="info-stat-val" style="color:var(--Y);">3</span></div>
            <div class="info-stat"><span class="info-stat-lbl">Address</span><span class="info-stat-val" style="font-family:var(--MONO);font-size:.68rem;word-break:break-all;">ghost.wolf2847</span></div>
            <div class="info-stat"><span class="info-stat-lbl">Domain</span><span class="info-stat-val" style="font-family:var(--MONO);font-size:.72rem;">dropit.io</span></div>
          </div>
          <div class="info-section">
            <div class="info-section-title">Quick Actions</div>
            <button class="btn-ghost" style="width:100%;margin-bottom:6px;justify-content:center;font-size:.76rem;" onclick="copyEmailInbox()">
              <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><rect x="9" y="9" width="13" height="13" rx="2"/><path stroke-linecap="round" d="M5 15H4a2 2 0 01-2-2V4a2 2 0 012-2h9a2 2 0 012 2v1"/></svg>
              Copy Address
            </button>
            <button class="btn-ghost" style="width:100%;justify-content:center;font-size:.76rem;" onclick="genNewInbox()">
              <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
              New Address
            </button>
          </div>
        </div>

      </div><!-- /inbox-3col -->
    </div><!-- /inbox-page-wrap -->

    <!-- ═══ CONFIRM ACTION MODAL ═══ -->
    <div class="modal-overlay" id="confirm-modal" style="z-index:900;">
      <div class="modal-box" style="max-width:360px;">
        <div class="modal-hd">
          <div class="modal-title">Confirm</div>
        </div>
        <div class="modal-body" style="padding:20px;gap:0;">
          <p id="confirm-msg" style="font-size:.88rem;color:var(--INK);line-height:1.5;"></p>
        </div>
        <div class="modal-ft">
          <button class="btn-ghost" onclick="closeConfirmModal()" style="padding:10px 20px;font-size:.8rem;">Cancel</button>
          <button class="btn-primary" id="confirm-yes-btn" onclick="confirmActionYes()" style="padding:10px 20px;font-size:.8rem;background:var(--RED);color:#fff;">Confirm</button>
        </div>
      </div>
    </div>

    <!-- ═══ EXPIRES IN MODAL ═══ -->
    <div class="modal-overlay" id="expires-modal" style="z-index:800;">
      <div class="modal-box" style="max-width:380px;">
        <div class="modal-hd">
          <div class="modal-title">Set Expiration</div>
          <button class="modal-close" onclick="cancelExpiresModal()">
            <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M18 6L6 18M6 6l12 12"/></svg>
          </button>
        </div>
        <div class="modal-body">
          <p style="font-size:.82rem;color:var(--MU);line-height:1.5;">
            Choose how long this address should stay active.
          </p>
          <div id="expires-options" style="display:flex;flex-direction:column;gap:8px;margin-top:4px;"></div>
        </div>
        <div class="modal-ft">
          <button class="btn-primary yellow" id="expires-confirm-btn" onclick="confirmExpiresSelection()" style="width:100%;justify-content:center;padding:12px;">
            Confirm
          </button>
        </div>
      </div>
    </div>
@endsection

@push('scripts')
<script>
/* ══════════════════════════════════════════════════
   INBOX PAGE LOGIC — MULTI-INBOX
══════════════════════════════════════════════════ */

@php
    $_sub = auth()->user()?->subscriptions()->active()->first();
    $_plan = $_sub?->plan;
    $isProInbox = $_plan && $_plan->slug === 'pro';
@endphp

const IS_PRO      = @json($isProInbox);
const DOMAINS     = ['dropit.io','burnbox.dev','zaptmp.net','voidmail.cc','mailsink.app'];
const ADJ         = ['silent','ghost','turbo','vapor','swift','lunar','neon','flux'];
const NOU         = ['fox','wolf','tide','bolt','hawk','mint','storm','byte'];
const EXPIRES_OPT = [
  { label: '60 Minutes',  value: 3600,  pro: false },
  { label: '12 Hours',    value: 43200, pro: false },
  { label: '24 Hours',    value: 86400, pro: false },
  { label: 'Unlimited',   value: -1,    pro: true  },
];
const SAMPLE_EMAILS = [
  { id:1, sender:'Google',   email:'noreply@accounts.google.com', avatar:'G', color:'#4285F4', time:'2 min ago',  subject:'Verify your Google account',     body:'<p>Hi there,</p><p>We received a request to verify your Google Account email address.</p><p>Your verification code is:</p><div class="otp-box">847 291</div><p>This code expires in <strong>10 minutes</strong>. Do not share it with anyone.</p><hr style="border:none;border-top:1px solid var(--BD);margin:20px 0;"/><p style="font-size:.76rem;color:var(--MU2);">Google LLC, 1600 Amphitheatre Parkway, Mountain View, CA 94043</p>', unread:true  },
  { id:2, sender:'Shopify',  email:'noreply@shopify.com',         avatar:'S', color:'#7C3AED', time:'14 min ago', subject:'Your OTP code is 382910',          body:'<p>Hi,</p><p>Use the following OTP to complete your Shopify sign-in:</p><div class="otp-box">382 910</div><p>This code is valid for 15 minutes. If you did not request this, please ignore this email.</p>', unread:true  },
  { id:3, sender:'Notion',   email:'hello@mail.notion.so',        avatar:'N', color:'#10B981', time:'38 min ago', subject:'Confirm your Notion email',        body:'<p>Hey there,</p><p>Thanks for signing up for Notion. Please confirm your email address to get started.</p><a href="#" style="display:inline-block;background:#000;color:#fff;padding:10px 22px;border-radius:6px;font-size:.84rem;font-weight:600;margin:14px 0;text-decoration:none;">Confirm Email →</a><p style="font-size:.76rem;color:var(--MU2);">This link expires in 24 hours. If you didn\'t sign up, you can safely ignore this.</p>', unread:true  },
  { id:4, sender:'Twitter',  email:'info@twitter.com',            avatar:'T', color:'#1DA1F2', time:'1 hr ago',   subject:'New login to your Twitter account', body:'<p>Hi,</p><p>We noticed a new sign-in to your Twitter account from:</p><p><strong>Chrome on macOS</strong> · IP 192.168.1.1 · United States</p><p>If this was you, no action is needed. If not, please secure your account immediately.</p><a href="#" style="color:#1DA1F2;">Review account activity →</a>', unread:false },
  { id:5, sender:'Amazon',   email:'auto-confirm@amazon.com',     avatar:'A', color:'#F59E0B', time:'2 hrs ago',  subject:'Your order has been confirmed',     body:'<p>Hello,</p><p>Thank you for your order! Your order <strong>#112-8827741-1234567</strong> has been confirmed and is being prepared for shipment.</p><p>Estimated delivery: <strong>June 22–24, 2026</strong></p><a href="#" style="color:#F59E0B;">Track your order →</a>', unread:false },
];

/* ── State ── */
let inboxes = [];
let activeInboxId = null;
let inboxIdCounter = 0;
let timerInt = null;
let searchDelayInbox = null;
let pendingGenCallback = null;
let selectedExpiresValue = null;
let pendingConfirmCallback = null;

/* ── Helpers ── */
function padInbox(n) { return String(n).padStart(2, '0'); }
function randAddr() {
  const dom = DOMAINS[Math.floor(Math.random() * DOMAINS.length)];
  const adj = ADJ[Math.floor(Math.random() * ADJ.length)];
  const nou = NOU[Math.floor(Math.random() * NOU.length)];
  const num = Math.floor(Math.random() * 9000 + 1000);
  return adj + '.' + nou + num + '@' + dom;
}
function getInbox(id) { return inboxes.find(function(i){ return i.id === id; }); }
function activeInbox() { return getInbox(activeInboxId); }

/* ── Create default inbox on first load ── */
function createDefaultInbox() {
  var addr = randAddr();
  var ib = {
    id: ++inboxIdCounter,
    address: addr,
    timerSecs: 3600,
    timerMaxSecs: 3600,
    domain: addr.split('@')[1],
    emails: JSON.parse(JSON.stringify(SAMPLE_EMAILS)),
    currentMailId: 1,
  };
  inboxes.push(ib);
  return ib;
}

/* ── Inbox tabs rendering ── */
function renderInboxTabs() {
  var strip = document.getElementById('inbox-strip');
  strip.innerHTML = inboxes.map(function(ib) {
    var active = ib.id === activeInboxId ? ' active' : '';
    var label = ib.address.length > 22 ? ib.address.slice(0, 19) + '…' : ib.address;
    return '<div class="inbox-tab' + active + '" onclick="switchInbox(' + ib.id + ')">' +
      '<span class="inbox-tab-dot"></span>' +
      '<span class="inbox-tab-addr" title="' + ib.address + '">' + label + '</span>' +
      '<button class="inbox-tab-close" onclick="event.stopPropagation();deleteInbox(' + ib.id + ')" title="Delete inbox">✕</button>' +
    '</div>';
  }).join('') +
  '<button class="inbox-add-btn" onclick="genNewInbox()" title="New inbox">+</button>';
}

/* ── Switch inbox ── */
function switchInbox(id) {
  activeInboxId = id;
  renderInboxTabs();
  renderActiveInbox();
}

/* ── Render the active inbox data into the UI ── */
function renderActiveInbox() {
  var ib = activeInbox();
  if (!ib) return;

  document.getElementById('edisplay').textContent = ib.address;
  updateTimerUI();
  renderEmailList();
  renderEmailDetail();
}

/* ── Create inbox ── */
function createInbox(expiresSecs) {
  var addr = randAddr();
  var dom = addr.split('@')[1];
  var ib = {
    id: ++inboxIdCounter,
    address: addr,
    timerSecs: expiresSecs > 0 ? expiresSecs : 999999,
    timerMaxSecs: expiresSecs > 0 ? expiresSecs : 999999,
    domain: dom,
    emails: JSON.parse(JSON.stringify(SAMPLE_EMAILS)),
    currentMailId: 1,
  };
  inboxes.push(ib);
  activeInboxId = ib.id;
  renderInboxTabs();
  renderActiveInbox();
  ensureTimer();
  toast('Inbox created');
}

/* ── Delete inbox ── */
function deleteInbox(id) {
  if (inboxes.length <= 1) { toast('Cannot delete the last inbox'); return; }
  showConfirmModal('Delete this inbox and all its messages?', function() {
    var idx = -1;
    inboxes.forEach(function(ib, i){ if (ib.id === id) idx = i; });
    if (idx === -1) return;
    inboxes.splice(idx, 1);
    if (activeInboxId === id) {
      var next = inboxes[Math.min(idx, inboxes.length - 1)];
      activeInboxId = next ? next.id : null;
    }
    renderInboxTabs();
    renderActiveInbox();
    toast('Inbox deleted');
  }, 'Delete');
}

/* ── Timer ── */
function ensureTimer() {
  if (timerInt) return;
  timerInt = setInterval(function() {
    inboxes.forEach(function(ib) {
      if (ib.timerSecs > 0) ib.timerSecs--;
    });
    if (activeInbox()) updateTimerUI();
  }, 1000);
}

function updateTimerUI() {
  var ib = activeInbox();
  if (!ib) return;
  var h = Math.floor(ib.timerSecs / 3600);
  var m = padInbox(Math.floor((ib.timerSecs % 3600) / 60));
  var s = padInbox(ib.timerSecs % 60);
  document.getElementById('tnum').textContent = h > 0 ? h + ':' + m + ':' + s : m + ':' + s;
  var pct = ib.timerMaxSecs > 0 ? Math.min(100, (ib.timerSecs / ib.timerMaxSecs) * 100) : 0;
  document.getElementById('tbar').style.width = pct + '%';
  document.getElementById('tbar').style.background = ib.timerSecs < 120 ? 'var(--RED)' : 'var(--Y)';
}

function extendTimer() {
  var ib = activeInbox();
  if (!ib) return;
  ib.timerSecs += 600;
  if (ib.timerSecs > ib.timerMaxSecs) ib.timerMaxSecs = ib.timerSecs;
  updateTimerUI();
  toast('Added 10 minutes');
}

/* ── Email list ── */
function renderEmailList() {
  var ib = activeInbox();
  if (!ib) return;
  var scroll = document.getElementById('email-list');
  var cnt = document.getElementById('list-count');
  var badge = document.getElementById('ucnt');
  var unread = ib.emails.filter(function(e){ return e.unread; }).length;

  scroll.innerHTML = ib.emails.map(function(em) {
    var sel = em.id === ib.currentMailId ? ' selected' : '';
    var unr = em.unread ? ' unread' : '';
    var dot = em.unread
      ? '<div class="udot-sm"></div>'
      : '<div class="rdot-sm"></div>';
    return '<div class="erow' + unr + sel + '" data-id="' + em.id + '" onclick="openMailDetail(' + em.id + ')">' +
      '<div class="erow-left">' +
        '<div class="erow-avatar" style="background:' + em.color + ';">' + em.avatar + '</div>' +
        dot +
      '</div>' +
      '<div class="erow-body">' +
        '<div class="erow-top-row">' +
          '<span class="e-sender">' + em.sender + '</span>' +
          '<span class="e-time">' + em.time + '</span>' +
        '</div>' +
        '<div class="e-subject">' + em.subject + '</div>' +
        '<div class="e-preview">' + (em.body.replace(/<[^>]*>/g,'').slice(0,60)) + '…</div>' +
      '</div>' +
    '</div>';
  }).join('');
  cnt.innerHTML = '<svg width="9" height="9" fill="var(--GREEN)" viewBox="0 0 10 10"><circle cx="5" cy="5" r="5"/></svg> ' + ib.emails.length + ' messages' + (unread ? ' · ' + unread + ' unread' : '');
  badge.textContent = unread > 0 ? unread : '';
}

function renderEmailDetail() {
  var ib = activeInbox();
  if (!ib) return;
  var em = ib.emails.find(function(e){ return e.id === ib.currentMailId; });
  if (!em) {
    document.getElementById('detail-empty').style.display = 'flex';
    document.getElementById('detail-content').style.display = 'none';
    return;
  }
  document.getElementById('detail-empty').style.display = 'none';
  document.getElementById('detail-content').style.display = 'flex';
  var f;
  (f = document.getElementById('d-subject')) && (f.textContent = em.subject);
  (f = document.getElementById('d-avatar'))  && (f.textContent = em.avatar);
  if (f = document.getElementById('d-avatar')) f.style.background = em.color;
  (f = document.getElementById('d-name'))    && (f.textContent = em.sender);
  (f = document.getElementById('d-email'))   && (f.innerHTML = '&lt;' + em.email + '&gt;');
  (f = document.getElementById('d-to'))      && (f.textContent = ib.address);
  (f = document.getElementById('d-time'))    && (f.textContent = em.time);
  (f = document.getElementById('d-body'))    && (f.innerHTML = em.body);
}

/* ── Generate new inbox (via expires modal) ── */
function genNewInbox() {
  showExpiresModal(function(expiresSecs) {
    createInbox(expiresSecs);
  });
}

/* ── Expires In modal ── */
function showExpiresModal(callback) {
  pendingGenCallback = callback;
  var list = document.getElementById('expires-options');
  list.innerHTML = EXPIRES_OPT.map(function(o) {
    var enabled = IS_PRO || !o.pro;
    return '<div class="domain-option expires-opt" onclick="' + (enabled ? "pickExpiresOpt(this," + o.value + ")" : "") + '" style="' + (enabled ? '' : 'cursor:not-allowed;opacity:.5;') + '" data-value="' + o.value + '">' +
      '<div style="flex:1;display:flex;align-items:center;justify-content:space-between;">' +
        '<span class="domain-option-name">' + o.label + '</span>' +
        (o.pro && !IS_PRO ? '<span style="font-family:var(--MONO);font-size:.58rem;font-weight:700;padding:2px 7px;border-radius:5px;background:rgba(124,58,237,.12);color:#7C3AED;">Pro</span>' : '') +
      '</div>' +
      '<div class="domain-check"></div>' +
    '</div>';
  }).join('');
  selectedExpiresValue = null;
  document.getElementById('expires-confirm-btn').disabled = true;
  document.getElementById('expires-confirm-btn').style.opacity = '.5';
  document.getElementById('expires-modal').classList.add('open');
}

function pickExpiresOpt(el, val) {
  document.querySelectorAll('.expires-opt').forEach(function(o) { o.classList.remove('selected'); });
  el.classList.add('selected');
  selectedExpiresValue = val;
  var btn = document.getElementById('expires-confirm-btn');
  btn.disabled = false;
  btn.style.opacity = '1';
}

function confirmExpiresSelection() {
  if (selectedExpiresValue === null) return;
  document.getElementById('expires-modal').classList.remove('open');
  if (pendingGenCallback) {
    pendingGenCallback(selectedExpiresValue);
    pendingGenCallback = null;
  }
}

function cancelExpiresModal() {
  document.getElementById('expires-modal').classList.remove('open');
  pendingGenCallback = null;
}

/* ── Confirm action modal ── */
function showConfirmModal(msg, callback, btnLabel) {
  pendingConfirmCallback = callback;
  document.getElementById('confirm-msg').textContent = msg;
  document.getElementById('confirm-yes-btn').textContent = btnLabel || 'Confirm';
  document.getElementById('confirm-modal').classList.add('open');
}

function closeConfirmModal() {
  document.getElementById('confirm-modal').classList.remove('open');
  pendingConfirmCallback = null;
}

function confirmActionYes() {
  document.getElementById('confirm-modal').classList.remove('open');
  if (pendingConfirmCallback) {
    var cb = pendingConfirmCallback;
    pendingConfirmCallback = null;
    cb();
  }
}

/* ── Copy ── */
function copyEmailInbox() {
  var txt = document.getElementById('edisplay').textContent;
  navigator.clipboard.writeText(txt).catch(function(){});
  var btn = document.getElementById('cbtn');
  btn.classList.add('ok'); btn.innerHTML = '✓ Copied';
  toast('Email address copied!');
  setTimeout(function() { btn.classList.remove('ok'); btn.innerHTML = '<svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><rect x=\\"9\\" y=\\"9\\" width=\\"13\\" height=\\"13\\" rx=\\"2\\"/><path stroke-linecap=\\"round\\" d=\\"M5 15H4a2 2 0 01-2-2V4a2 2 0 012-2h9a2 2 0 012 2v1\\"/></svg> Copy'; }, 2200);
}

/* ── Open mail detail ── */
function openMailDetail(id) {
  var ib = activeInbox();
  if (!ib) return;
  ib.currentMailId = id;
  var em = ib.emails.find(function(e){ return e.id === id; });
  if (!em) return;

  em.unread = false;
  renderEmailList();
  renderEmailDetail();

  document.getElementById('inbox-3col').classList.add('mob-detail');
}

function closeMailDetail() {
  document.getElementById('inbox-3col').classList.remove('mob-detail');
}

function deleteCurrentMail() {
  var ib = activeInbox();
  if (!ib) return;
  showConfirmModal('Delete this message?', function() {
    ib.emails = ib.emails.filter(function(e){ return e.id !== ib.currentMailId; });
    document.getElementById('detail-empty').style.display = 'flex';
    document.getElementById('detail-content').style.display = 'none';
    document.getElementById('inbox-3col').classList.remove('mob-detail');
    renderEmailList();
    toast('Message deleted');
  });
}

function markUnreadCurrent() {
  var ib = activeInbox();
  if (!ib) return;
  var em = ib.emails.find(function(e){ return e.id === ib.currentMailId; });
  if (!em) return;
  em.unread = true;
  renderEmailList();
  toast('Marked as unread');
}

function markAllReadInbox() {
  var ib = activeInbox();
  if (!ib) return;
  showConfirmModal('Mark all messages as read?', function() {
    ib.emails.forEach(function(e){ e.unread = false; });
    renderEmailList();
    toast('All messages marked as read');
  }, 'Mark Read');
}

function deleteAllInbox() {
  var ib = activeInbox();
  if (!ib) return;
  showConfirmModal('Delete all messages?', function() {
    ib.emails = [];
    document.getElementById('detail-empty').style.display = 'flex';
    document.getElementById('detail-content').style.display = 'none';
    renderEmailList();
    toast('All messages deleted');
  });
}

function refreshInboxList() {
  toast('Inbox refreshed');
}

function switchTab(btn, tab) {
  document.querySelectorAll('.list-tab').forEach(function(b){ b.classList.remove('active'); });
  btn.classList.add('active');
}

function debounceSearchInbox(val) {
  clearTimeout(searchDelayInbox);
  searchDelayInbox = setTimeout(function() {
    var rows = document.querySelectorAll('.erow');
    rows.forEach(function(r) {
      var txt = r.textContent.toLowerCase();
      r.style.display = txt.includes(val.toLowerCase()) ? '' : 'none';
    });
  }, 300);
}

/* ── Init ── */
var first = createDefaultInbox();
activeInboxId = first.id;
renderInboxTabs();
renderActiveInbox();
ensureTimer();
if (window.innerWidth >= 900) openMailDetail(1);
</script>
@endpush
