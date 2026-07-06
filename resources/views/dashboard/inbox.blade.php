@extends('layouts.authLayout')

@section('title', 'InboxOro — Inbox')

@push('styles')
<style>

/* ══════════════════════════════════════════════
   INBOX PAGE — Modern Gmail/Outlook Design
   ══════════════════════════════════════════════ */

/* ── Full-height inbox shell ── */
.inbox-page-wrap {
  display:        flex;
  flex-direction: column;
  overflow:       hidden;
  border: 1px solid var(--BD);
  border-radius: 12px;
  box-shadow: 0 1px 3px rgba(0,0,0,.04), 0 4px 16px rgba(0,0,0,.06);
}

/* ── Address bar (sticky top) ── */
.addr-strip {
  display:         flex;
  align-items:     center;
  gap:             10px;
  padding: 16px 16px 10px 16px;
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

/* ── Timer strip ── */
.timer-strip {
  display:         flex;
  align-items:     center;
  gap:             8px;
  padding:         5px 16px 7px;
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
.timer-extend-wrap { position:relative; display:flex; align-items:center; }
.timer-extend-btn {
  display:inline-flex; align-items:center; gap:4px;
  font-family:var(--MONO); font-size:.58rem; font-weight:700;
  letter-spacing:.04em; padding:3px 8px; border-radius:5px;
  border:1px solid var(--BD); background:var(--SURF); color:var(--MU);
  white-space:nowrap; cursor:pointer; margin-left:4px;
  transition:background .12s, border-color .12s, color .12s;
}
.timer-extend-btn:hover { background:var(--INK); border-color:var(--INK); color:var(--Y); }
.timer-extend-btn svg { flex-shrink:0; }

.extend-popover {
  display:none; position:absolute; top:calc(100% + 6px); right:0;
  width:260px; background:#fff; border-radius:10px;
  box-shadow:0 8px 30px rgba(0,0,0,.14),0 2px 8px rgba(0,0,0,.06);
  border:1px solid #e8eaed; z-index:500; overflow:hidden;
  animation:pop-fade .15s ease both;
}
.extend-popover.open { display:block; }
@keyframes pop-fade { from{opacity:0;transform:translateY(-4px)} to{opacity:1;transform:translateY(0)} }

.extend-pop-hd {
  display:flex; align-items:center; justify-content:space-between;
  padding:12px 14px 8px; border-bottom:1px solid var(--BD);
}
.extend-pop-hd span { font-size:.74rem; font-weight:700; color:var(--INK); }
.extend-pop-close {
  background:none; border:none; font-size:1.1rem; color:var(--MU);
  cursor:pointer; line-height:1; padding:0 2px;
}
.extend-pop-close:hover { color:var(--INK); }

.extend-pop-body { padding:10px 14px 14px; }
.extend-pop-label {
  font-size:.6rem; font-weight:700; text-transform:uppercase;
  letter-spacing:.06em; color:var(--MU2); margin-bottom:5px;
}
.extend-pop-select {
  width:100%; padding:8px 10px; border:1px solid var(--BD);
  border-radius:6px; background:var(--BG); color:var(--INK);
  font-family:var(--MONO); font-size:.72rem; font-weight:600;
  appearance:auto; cursor:pointer; margin-bottom:10px;
}
.extend-pop-select:focus { outline:none; border-color:var(--Y); }
.extend-pop-btn {
  width:100%; display:flex; align-items:center; justify-content:center;
  gap:6px; padding:9px 0; border:none; border-radius:7px;
  font-family:var(--MONO); font-size:.7rem; font-weight:700;
  letter-spacing:.04em; cursor:pointer; transition:opacity .15s;
}
.extend-pop-btn.primary { background:var(--Y); color:#000; }
.extend-pop-btn.primary:hover { opacity:.85; }
.extend-pop-btn:disabled { opacity:.4; cursor:default; }

.extend-pop-msg {
  font-size:.66rem; color:var(--MU); line-height:1.5;
  padding:8px 10px; border-radius:6px; background:#fef3cd;
  margin-top:8px; display:none;
}
.extend-pop-msg.show { display:block; }
.extend-pop-msg strong { color:#92400e; }

.extend-pop-success {
  display:none; padding:14px; text-align:center;
}
.extend-pop-success.show { display:block; }
.extend-pop-success .check {
  display:inline-flex; align-items:center; justify-content:center;
  width:36px; height:36px; border-radius:50%;
  background:#d1fae5; margin-bottom:8px;
}
.extend-pop-success .check svg { color:#16a34a; }
.extend-pop-success .msg { font-size:.76rem; font-weight:600; color:var(--INK); margin-bottom:4px; }
.extend-pop-success .sub { font-size:.66rem; color:var(--MU); }

/* ── Inbox tabs strip ── */
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

/* ── 3-column layout ── */
.inbox-3col {
  display:  flex;
  flex:     1;
  overflow: hidden;
  min-height: 0;
  position: relative;
}

/* ── Left: email list sidebar ── */
.inbox-list-col {
  width:          320px;
  min-width:      280px;
  border-right:   1px solid var(--BD);
  display:        flex;
  flex-direction: column;
  overflow:       hidden;
  flex-shrink:    0;
  background:     var(--SURF);
  transition:     width .2s ease, min-width .2s ease, opacity .2s ease;
}

/* Collapsed sidebar */
.inbox-3col.list-collapsed .inbox-list-col {
  width: 0 !important;
  min-width: 0 !important;
  opacity: 0;
  overflow: hidden;
  border-right: none;
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

/* Hamburger toggle */
.list-toggle-btn {
  width:28px; height:28px;
  display:flex; align-items:center; justify-content:center;
  border-radius:7px;
  background:var(--SURF); color:var(--MU);
  cursor:pointer; transition:background .12s, color .12s;
  flex-shrink:0;
}
.list-toggle-btn:hover {background:var(--BD2); color:var(--INK);}

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

/* Scrollbar style (desktop) */
.email-scroll::-webkit-scrollbar {
  width: 6px;
}
.email-scroll::-webkit-scrollbar-track {
  background: transparent;
}
.email-scroll::-webkit-scrollbar-thumb {
  background: var(--MU2);
  border-radius: 3px;
}
.email-scroll::-webkit-scrollbar-thumb:hover {
  background: var(--MU);
}
.email-scroll {
  scrollbar-width: thin;
  scrollbar-color: var(--MU2) transparent;
}

/* List tabs (All / Unread / Starred) */
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

/* ── Email rows ── */
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

/* ── Right: email detail panel ── */
.inbox-detail-col {
  flex:1; display:flex; flex-direction:column;
  overflow:hidden; background:var(--SURF); min-width:0;
}

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

/* ── Detail toolbar ── */
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

/* ── Detail header (subject + sender info) ── */
.detail-header {
  padding:16px 20px 12px;
  border-bottom:1px solid var(--BD);
  flex-shrink:0;
}
.detail-subject {
  font-family:var(--DISP); font-size:1.3rem; letter-spacing:.03em;
  color:var(--INK); margin-bottom:10px; line-height:1.2;
}
.detail-meta-row {display:flex;align-items:center;gap:12px;flex-wrap:wrap;}
.detail-avatar {
  width:36px; height:36px; border-radius:50%;
  display:flex; align-items:center; justify-content:center;
  font-family:var(--DISP); font-size:1rem; color:#fff;
  border:2px solid var(--INK); flex-shrink:0;
}
.detail-meta-info {flex:1;min-width:0;}
.detail-from-name  {font-size:.85rem;font-weight:700;color:var(--INK);}
.detail-from-email {font-size:.73rem;color:var(--MU);font-family:var(--MONO);overflow:hidden;text-overflow:ellipsis;white-space:nowrap;}
.detail-to-line    {font-size:.71rem;color:var(--MU);margin-top:2px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;}
.detail-timestamp  {font-family:var(--MONO);font-size:.68rem;color:var(--MU2);white-space:nowrap;flex-shrink:0;}

/* ── Collapsible sender details panel ── */
.sender-details-toggle {
  display:inline-flex; align-items:center; gap:4px;
  font-family:var(--MONO); font-size:.6rem; font-weight:700;
  letter-spacing:.06em; text-transform:uppercase;
  color:var(--MU2); cursor:pointer;
  padding:4px 0; margin-top:6px;
  transition:color .12s;
  border:none; background:none;
}
.sender-details-toggle:hover {color:var(--MU);}
.sender-details-toggle svg {transition:transform .2s; width:12px; height:12px;}
.sender-details-toggle.open svg {transform:rotate(90deg);}

.sender-details {
  display:none;
  margin-top:6px;
  padding:10px 14px;
  background:#FAFAFA;
  border:1px solid var(--BD);
  border-radius:8px;
  font-size:.76rem;
  line-height:1.6;
  gap:4px;
}
.sender-details.open {display:block;}
.sd-row {
  display:flex; align-items:center;
  padding:3px 0;
  gap:8px;
}
.sd-label {
  font-family:var(--MONO); font-size:.6rem; font-weight:700;
  letter-spacing:.06em; text-transform:uppercase;
  color:var(--MU2); min-width:70px; flex-shrink:0;
}
.sd-value {
  color:var(--INK); overflow:hidden; text-overflow:ellipsis;
}
.sd-value.mono {
  font-family:var(--MONO); font-size:.7rem;
}
.sd-stats {
  display:flex; gap:16px; margin-top:4px; padding-top:6px;
  border-top:1px solid var(--BD);
}
.sd-stat {
  display:flex; flex-direction:column; align-items:center; gap:0px;
}
.sd-stat-num {
  font-family:var(--MONO); font-size:.85rem; font-weight:700; color:var(--INK);
}
.sd-stat-lbl {
  font-family:var(--MONO); font-size:.52rem; font-weight:700;
  letter-spacing:.06em; text-transform:uppercase; color:var(--MU2);
}

/* ── Email viewer (centered wrapper) ── */
.email-viewer {
  display: flex;
  justify-content: center;
  flex: 1;
  overflow: auto;
  padding: 24px;
}

.email-viewer::-webkit-scrollbar {
  width: 6px;
}
.email-viewer::-webkit-scrollbar-track {
  background: transparent;
}
.email-viewer::-webkit-scrollbar-thumb {
  background: var(--MU2);
  border-radius: 3px;
}
.email-viewer::-webkit-scrollbar-thumb:hover {
  background: var(--MU);
}
.email-viewer {
  scrollbar-width: thin;
  scrollbar-color: var(--MU2) transparent;
}

.email-content {
  width: 100%;
  max-width: 700px;
  min-height: 100%;
}

/* ── Email body ── */
.detail-body {
  font-size: .88rem;
  line-height: 1.75;
  color: #374151;
}
.detail-body p {margin-bottom:14px;}
.detail-body .email-iframe { width:100%; height:100%; border:none; display:block; min-height:400px; }
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
  padding:10px 16px;
  border-top:1px solid var(--BD);
  background:var(--SURF);
  display:flex; align-items:center; gap:8px;
  flex-shrink:0;
}
.quick-reply-note {
  font-size:.73rem; color:var(--MU2);
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

/* ── Mobile back bar ── */
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

/* ── Fullscreen mode (hide site chrome only) ── */
body.inbox-fs .topbar {display:none !important;}
body.inbox-fs .sidebar {display:none !important;}
body.inbox-fs .main {
  padding:0 !important;
  overflow:hidden !important;
}
body.inbox-fs .inbox-page-wrap {
  border:none !important;
  border-radius:0 !important;
  box-shadow:none !important;
}
body.inbox-fs .quick-reply {
  display:none !important;
}


/* ── Animations ── */
@keyframes slide-in-right {
  from{transform:translateX(24px);opacity:0;}
  to{transform:translateX(0);opacity:1;}
}

/* ══════════════════════════════════════════════
   RESPONSIVE
   ══════════════════════════════════════════════ */

/* ── Desktop ── */
@media (min-width: 900px) {
  .main:has(.inbox-page-wrap) {
    padding-bottom: 0 !important;
    overflow: hidden !important;
    display: flex;
    flex-direction: column;
  }

  .inbox-page-wrap {
    flex: 1;
    min-height: 0;
    height: 100%;
    overflow: hidden;
  }

  .inbox-3col {
    flex: 1;
    min-height: 0;
    overflow: hidden;
  }

  .inbox-list-col {
    height: 100%;
    width: 320px;
    min-width: 280px;
    overflow: hidden;
  }

  .inbox-detail-col {
    height: 100%;
    overflow: hidden;
  }

  .email-scroll {
    flex: 1;
    overflow-y: auto;
    min-height: 0;
  }

  .mob-back-bar { display:none !important; }
}

/* ── Tablet ── */
@media (min-width: 768px) and (max-width: 1199px) {
  .inbox-list-col { width: 260px; min-width: 260px; }
}

/* ── Mobile ── */
@media (max-width: 899px) {
  html, body { overflow: auto !important; }

  .main { overflow: visible !important; }

  .inbox-page-wrap {
    height: auto !important;
    min-height: calc(100dvh - 56px);
    overflow: visible !important;
    border-radius: 0;
    border-left: none;
    border-right: none;
    box-shadow: none;
  }

  .inbox-3col {
    flex: none !important;
    min-height: 480px;
    height: auto !important;
  }

  .inbox-list-col { width: 100%; min-width: 0; }
  .email-scroll { overflow-y: visible !important; flex: none !important; }

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

  /* Hide hamburger on mobile — list is full-width, overlay detail */
  .inbox-list-col .list-toggle-btn { display:none; }
  .detail-toolbar-left [onclick*="toggleInboxList"] { display:none; }

  .email-viewer { padding: 14px; }
  .detail-subject { font-size: 1.1rem; }
  .detail-header { padding: 12px 14px 10px; }
  .detail-toolbar { padding: 8px 10px; }
  .dtl-btn { font-size: .68rem; padding: 5px 8px; }

  .addr-strip .addr-new-btn { display: none; }
  .addr-strip .btn-primary.yellow { display: flex; }

  .extend-popover { right:auto; left:0; width:240px; }
}

@media (max-width: 480px) {
  .extend-popover { width:220px; }
}

@media (min-width: 900px) {
  .addr-strip .addr-new-btn { display: flex; }
  .addr-strip .btn-primary.yellow { display: none; }
}

@media (max-width: 480px) {
  .addr-strip { padding: 12px 8px 6px; gap: 4px; }
  .addr-strip-email { padding: 6px 8px; }
  .addr-copy-btn, .addr-new-btn { font-size: .66rem; padding: 5px 8px; }
  .addr-strip .page-title { font-size: .8rem; }
  .timer-strip { padding: 4px 8px; flex-wrap: wrap; gap: 4px; }
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
  .list-footer { font-size: .55rem; padding: 5px 10px; }
}

/* ── Inbox page wrap box-sizing fix ── */
.inbox-page-wrap { box-sizing: border-box; }

</style>
@endpush

@section('content')

    <div class="inbox-page-wrap shadow-xl">

      <!-- ── Address bar ── -->
      <div class="addr-strip">
        <div class="page-title">INBOX</div>
        <div class="addr-strip-email">
          <div class="addr-strip-live">
            <div class="addr-live-dot"></div>
            LIVE
          </div>
          <div class="addr-strip-txt" id="edisplay"></div>
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
        <div class="timer-extend-wrap">
          <button class="timer-extend-btn" onclick="toggleExtendPopover()" title="Extend expiration">
            <svg width="11" height="11" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M12 4v16m8-8H4"/></svg>
            + Extend
          </button>
          <div class="extend-popover" id="extend-popover">
            <div class="extend-pop-hd">
              <span>Extend Expiration</span>
              <button class="extend-pop-close" onclick="closeExtendPopover()">&times;</button>
            </div>
            <div class="extend-pop-body" id="extend-pop-body">
              <div class="extend-pop-label">Select Time</div>
              <select class="extend-pop-select" id="extend-select"></select>
              <button class="extend-pop-btn primary" id="extend-action-btn" onclick="extendInbox()">
                <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M12 4v16m8-8H4"/></svg>
                Extend Time
              </button>
              <div class="extend-pop-msg" id="extend-pop-msg"></div>
            </div>
            <div class="extend-pop-success" id="extend-pop-success">
              <div class="check"><svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M5 13l4 4L19 7"/></svg></div>
              <div class="msg">Expiration extended successfully!</div>
              <div class="sub" id="extend-success-sub">Today, 4:30 PM</div>
            </div>
          </div>
        </div>
      </div>

      <!-- ── 2-column inbox (email list + viewer) ── -->
      <div class="inbox-3col" id="inbox-3col">

        <!-- LEFT: email list -->
        <div class="inbox-list-col" id="inbox-list-col">
          <div class="list-toolbar">
            <div class="list-toolbar-title">
              <button class="list-toggle-btn" onclick="toggleInboxList()" title="Toggle inbox list">
                <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M4 6h16M4 12h16M4 18h16"/></svg>
              </button>
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

        <!-- RIGHT: email viewer -->
        <div class="inbox-detail-col" id="inbox-detail-col">

          <div class="mob-back-bar" onclick="closeMailDetail()">
            <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
              <path stroke-linecap="round" d="M15 19l-7-7 7-7"/>
            </svg>
            Back
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

          <!-- Detail content -->
          <div id="detail-content" style="display:none;flex-direction:column;flex:1;overflow:hidden;">

            <!-- Toolbar -->
            <div class="detail-toolbar">
              <div class="detail-toolbar-left">
                <button class="dtl-btn" onclick="toggleInboxList()" title="Toggle inbox list">
                  <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M4 6h16M4 12h16M4 18h16"/></svg>
                </button>
                <button class="dtl-btn" onclick="markUnreadCurrent()">
                  <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8"/></svg>
                  Mark Unread
                </button>
                <button class="dtl-btn" onclick="viewRawEmail()">
                  <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M3 10h18M3 14h18"/></svg>
                  View Raw
                </button>
                <button class="dtl-btn" onclick="printEmail()">
                  <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                  Print
                </button>
              </div>
              <div class="detail-toolbar-left">
                <button class="dtl-btn" onclick="toggleFullscreen()" id="fs-btn" title="Fullscreen">
                  <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M8 3H5a2 2 0 00-2 2v3m18 0V5a2 2 0 00-2-2h-3m0 18h3a2 2 0 002-2v-3M3 16v3a2 2 0 002 2h3"/></svg>
                </button>
                <button class="dtl-btn danger" onclick="deleteCurrentMail()">
                  <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><polyline points="3 6 5 6 21 6"/><path stroke-linecap="round" d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6m5 0V4a1 1 0 011-1h2a1 1 0 011 1v2"/></svg>
                  Delete
                </button>
              </div>
            </div>

            <!-- Header -->
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

              <!-- Collapsible sender details -->
              <button class="sender-details-toggle" onclick="toggleSenderDetails()" id="sd-toggle">
                <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M9 5l7 7-7 7"/></svg>
                Details
              </button>
              <div class="sender-details" id="sender-details">
                <div class="sd-row">
                  <span class="sd-label">From</span>
                  <span class="sd-value" id="sd-from">—</span>
                </div>
                <div class="sd-row">
                  <span class="sd-label">Domain</span>
                  <span class="sd-value mono" id="sd-domain">—</span>
                </div>
                <div class="sd-row">
                  <span class="sd-label">Received</span>
                  <span class="sd-value" id="sd-received">—</span>
                </div>
                <div class="sd-row">
                  <span class="sd-label">Address</span>
                  <span class="sd-value mono" id="sd-address">—</span>
                </div>
                <div class="sd-row">
                  <span class="sd-label">Addr Domain</span>
                  <span class="sd-value mono" id="sd-addr-domain">—</span>
                </div>
                <div class="sd-stats">
                  <div class="sd-stat">
                    <span class="sd-stat-num" id="sd-total">0</span>
                    <span class="sd-stat-lbl">Total</span>
                  </div>
                  <div class="sd-stat">
                    <span class="sd-stat-num" id="sd-unread">0</span>
                    <span class="sd-stat-lbl">Unread</span>
                  </div>
                </div>
              </div>
            </div>

            <!-- Email viewer (centered) -->
            <div class="email-viewer" id="email-viewer">
              <div class="email-content">
                <!-- Email body -->
                <div class="detail-body" id="d-body"></div>
              </div>
            </div>

            <!-- Quick reply -->
            <div class="quick-reply">
              <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="color:var(--MU2);flex-shrink:0;"><path stroke-linecap="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
              <span class="quick-reply-note">Replies are not supported — this is a read-only inbox</span>
            </div>

          </div><!-- /detail-content -->
        </div><!-- /inbox-detail-col -->

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

    <!-- ═══ SELECT DOMAIN MODAL ═══ -->
    <div class="modal-overlay" id="domain-modal" style="z-index:850;">
      <div class="modal-box" style="max-width:380px;">
        <div class="modal-hd">
          <div class="modal-title">Select Domain</div>
          <button class="modal-close" onclick="cancelDomainModal()">
            <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M18 6L6 18M6 6l12 12"/></svg>
          </button>
        </div>
        <div class="modal-body">
          <p style="font-size:.82rem;color:var(--MU);line-height:1.5;">
            Choose a domain for your new temporary address.
          </p>
          <div id="domain-options" style="display:flex;flex-direction:column;gap:8px;margin-top:4px;max-height:260px;overflow-y:auto;padding-right:4px;"></div>
        </div>
        <div class="modal-ft">
          <button class="btn-primary yellow" id="domain-confirm-btn" onclick="confirmDomainSelection()" style="width:100%;justify-content:center;padding:12px;">
            Next
          </button>
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

    <!-- ═══ VIEW RAW MODAL ═══ -->
    <div class="modal-overlay" id="raw-modal" style="z-index:800;">
      <div class="modal-box" style="max-width:700px;width:90%;">
        <div class="modal-hd">
          <div class="modal-title">Raw Email Source</div>
          <button class="modal-close" onclick="closeRawModal()">
            <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M18 6L6 18M6 6l12 12"/></svg>
          </button>
        </div>
        <div class="modal-body">
          <pre id="raw-content" style="font-family:var(--MONO);font-size:.72rem;line-height:1.6;white-space:pre-wrap;word-break:break-all;background:#1a1a2e;color:#e2e8f0;padding:16px;border-radius:8px;max-height:60vh;overflow-y:auto;margin:0;"></pre>
        </div>
        <div class="modal-ft">
          <button class="btn-primary yellow" onclick="closeRawModal()" style="padding:10px 20px;font-size:.8rem;">Close</button>
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

const CSRF_TOKEN   = @json(csrf_token());
let IS_PRO         = @json($isProInbox);
const EMAIL_PER_PAGE = 10;
const EXPIRES_OPT = [
  { label: '30 Minutes',  value: 1800,  pro: false },
  { label: '12 Hours',    value: 43200, pro: false },
  { label: '24 Hours',    value: 86400, pro: false },
  { label: 'Unlimited',   value: -1,    pro: true  },
];

/* ── State ── */
let inboxes = [];
let activeInboxId = null;
let timerInt = null;
let searchDelayInbox = null;
let pendingGenCallback = null;
let selectedExpiresValue = null;
let pendingConfirmCallback = null;
let selectedDomain = null;
let pendingDomainCallback = null;
let currentFilter = 'all';
let currentSearch = '';
let currentRawUrl = '';
let emailPage = 1;
let emailHasMore = false;
let emailLoading = false;
const VS_BUFFER = 10;
let vsItemHeight = 64;

/* ── Helpers ── */
function padInbox(n) { return String(n).padStart(2, '0'); }
function getInbox(id) { return inboxes.find(function(i){ return i.id === id; }); }
function activeInbox() { return getInbox(activeInboxId); }
function updateSidebarCount() {
  var el = document.getElementById('sidebar-inbox-count');
  if (el) el.textContent = inboxes.length;
}

function toast(msg) {
  var el = document.getElementById('toast');
  if (!el) return;
  el.innerHTML = '<span class="toast-dot"></span>' + msg;
  el.classList.add('show');
  clearTimeout(el._t);
  el._t = setTimeout(function() { el.classList.remove('show'); }, 2800);
}

/* ── Toggle inbox list (collapsible sidebar) ── */
function toggleInboxList() {
  document.getElementById('inbox-3col').classList.toggle('list-collapsed');
}

/* ── Toggle fullscreen (hide site chrome only) ── */
function toggleFullscreen() {
  var isFs = document.body.classList.toggle('inbox-fs');
  var btn = document.getElementById('fs-btn');
  if (!btn) return;
  btn.innerHTML = isFs
    ? '<svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M6 18L18 6M6 6l12 12"/></svg>'
    : '<svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M8 3H5a2 2 0 00-2 2v3m18 0V5a2 2 0 00-2-2h-3m0 18h3a2 2 0 002-2v-3M3 16v3a2 2 0 002 2h3"/></svg>';
  btn.title = isFs ? 'Exit fullscreen' : 'Fullscreen';
}

/* ── Toggle sender details panel ── */
function toggleSenderDetails() {
  var panel = document.getElementById('sender-details');
  var toggle = document.getElementById('sd-toggle');
  if (!panel || !toggle) return;
  panel.classList.toggle('open');
  toggle.classList.toggle('open');
}

/* ── Load inboxes from API ── */
function loadInboxes(callback) {
  fetch('/inboxes').then(function(r){ return r.json(); }).then(function(data) {
    inboxes = data.inboxes || [];
    IS_PRO = data.is_pro;
    updateSidebarCount();
    if (callback) callback(data);
  })['catch'](function() {
    toast('Failed to load inboxes');
    if (callback) callback({ inboxes: [] });
  });
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
      '<button class="inbox-tab-close" onclick="event.stopPropagation();deleteInbox(' + ib.id + ')" title="Delete inbox">&#10005;</button>' +
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
  renderSenderInfo(null, ib);
  vsReset(ib.id);
  loadEmails();
}

/* ── Create inbox via API ── */
function createInbox(domainId, expiresSecs) {
  fetch('/inboxes', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': CSRF_TOKEN },
    body: JSON.stringify({ email_domain_id: domainId, expires_in: expiresSecs })
  }).then(function(r){ return r.json(); }).then(function(data) {
    if (data.error) { toast(data.error); return; }
    var ib = data.inbox;
    inboxes.push(ib);
    activeInboxId = ib.id;
    renderInboxTabs();
    renderActiveInbox();
    ensureTimer();
    updateSidebarCount();
    toast('Inbox created');
  })['catch'](function() { toast('Failed to create inbox'); });
}

/* ── Delete inbox ── */
function deleteInbox(id) {
  if (inboxes.length <= 1) { toast('Cannot delete the last inbox'); return; }
  showConfirmModal('Delete this inbox and all its messages?', function() {
    fetch('/inboxes/' + id, {
      method: 'DELETE',
      headers: { 'X-CSRF-TOKEN': CSRF_TOKEN }
    }).then(function(r){ return r.json(); }).then(function(data) {
      if (data.error) { toast(data.error); return; }
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
      updateSidebarCount();
      toast('Inbox deleted');
    })['catch'](function() { toast('Failed to delete inbox'); });
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
  var isUnlimited = ib.timerSecs >= 999999;
  if (isUnlimited) {
    document.getElementById('tnum').textContent = '∞';
    document.getElementById('tbar').style.width = '100%';
    document.getElementById('tbar').style.background = 'var(--BD2)';
  } else {
    var h = Math.floor(ib.timerSecs / 3600);
    var m = padInbox(Math.floor((ib.timerSecs % 3600) / 60));
    var s = padInbox(ib.timerSecs % 60);
    document.getElementById('tnum').textContent = h > 0 ? h + ':' + m + ':' + s : m + ':' + s;
    var pct = ib.timerMaxSecs > 0 ? Math.min(100, (ib.timerSecs / ib.timerMaxSecs) * 100) : 0;
    document.getElementById('tbar').style.width = pct + '%';
    document.getElementById('tbar').style.background = ib.timerSecs < 120 ? 'var(--RED)' : 'var(--Y)';
  }
  var btn = document.querySelector('.timer-extend-btn');
  if (btn) btn.style.display = isUnlimited ? 'none' : '';
}

/* ── Extend popover ── */
function toggleExtendPopover() {
  var pop = document.getElementById('extend-popover');
  var open = pop.classList.contains('open');
  closeExtendPopover();
  if (!open) {
    document.getElementById('extend-pop-success').classList.remove('show');
    document.getElementById('extend-pop-body').style.display = 'block';
    populateExtendOptions();
    pop.classList.add('open');
  }
}
function closeExtendPopover() {
  document.getElementById('extend-popover').classList.remove('open');
}

function populateExtendOptions() {
  var ib = activeInbox();
  if (!ib) return;
  var select = document.getElementById('extend-select');
  select.innerHTML = '';

  var freeOpts = [
    { label: '+10 Minutes', value: 600 },
    { label: '+30 Minutes', value: 1800 },
    { label: '+1 Hour',     value: 3600 },
    { label: '+6 Hours',    value: 21600 },
  ];
  var proOpts = [
    { label: '+12 Hours',   value: 43200, pro: true },
    { label: '+1 Day',      value: 86400, pro: true },
    { label: '+7 Days',     value: 604800, pro: true },
    { label: '+30 Days',    value: 2592000, pro: true },
    { label: 'Unlimited',   value: -1, pro: true },
  ];
  var allOpts = freeOpts.concat(proOpts);

  var msgEl = document.getElementById('extend-pop-msg');
  var btn = document.getElementById('extend-action-btn');
  msgEl.classList.remove('show');
  btn.disabled = false;

  var maxReached = false;
  var atMaxMsg = '';
  var now = Math.floor(Date.now() / 1000);

  allOpts.forEach(function(o) {
    var opt = document.createElement('option');
    opt.value = o.value;
    var isProLocked = o.pro && !IS_PRO;
    if (isProLocked) {
      opt.disabled = true;
      opt.textContent = o.label + '  —  Pro';
    } else {
      opt.textContent = o.label;
    }
    select.appendChild(opt);
  });

  var createdRaw = ib.created_at_raw;
  if (!createdRaw && ib.timerMaxSecs > 0 && ib.timerSecs >= 0) {
    createdRaw = new Date((now - ib.timerMaxSecs) * 1000).toISOString();
  }

  if (!IS_PRO && createdRaw) {
    var createdTime = new Date(createdRaw).getTime();
    var maxEnd = createdTime + 24 * 3600 * 1000;
    var remainingMs = maxEnd - Date.now();
    if (remainingMs <= 0) {
      maxReached = true;
      atMaxMsg = 'Maximum expiration time reached for your plan.<br><strong>Upgrade to Pro</strong> for longer durations.';
    }
  }

  if (maxReached) {
    btn.disabled = true;
    msgEl.innerHTML = atMaxMsg;
    msgEl.classList.add('show');
  }
}

function extendInbox() {
  var ib = activeInbox();
  if (!ib) return;
  var select = document.getElementById('extend-select');
  var duration = parseInt(select.value);
  if (!duration) return;

  var btn = document.getElementById('extend-action-btn');
  btn.disabled = true;
  btn.textContent = 'Extending…';

  fetch('/inboxes/' + ib.id + '/extend', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': CSRF_TOKEN },
    body: JSON.stringify({ duration: duration })
  }).then(function(r){ return r.json(); }).then(function(data) {
    btn.disabled = false;
    btn.innerHTML = '<svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M12 4v16m8-8H4"/></svg> Extend Time';
    if (data.error) {
      toast(data.error);
      return;
    }
    ib.timerSecs = data.timerSecs;
    ib.timerMaxSecs = data.timerMaxSecs;
    updateTimerUI();
    document.getElementById('extend-pop-body').style.display = 'none';
    document.getElementById('extend-success-sub').textContent = 'New Expiration: ' + (data.formatted_expires || '');
    document.getElementById('extend-pop-success').classList.add('show');
    setTimeout(closeExtendPopover, 2500);
  })['catch'](function() {
    btn.disabled = false;
    btn.innerHTML = '<svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M12 4v16m8-8H4"/></svg> Extend Time';
    toast('Failed to extend expiration');
  });
}

// Close extend popover on outside click
document.addEventListener('click', function(e) {
  var wrap = document.querySelector('.timer-extend-wrap');
  if (wrap && !wrap.contains(e.target)) {
    closeExtendPopover();
  }
});

/* ── Load emails from API (paginated) ── */
function loadEmails(keep) {
  var ib = activeInbox();
  if (!ib) return;
  if (!keep) { emailPage = 1; emailHasMore = false; }
  if (emailLoading) return;
  emailLoading = true;
  var params = '?filter=' + currentFilter + '&page=' + emailPage + '&per_page=' + EMAIL_PER_PAGE;
  if (currentSearch) params += '&search=' + encodeURIComponent(currentSearch);
  fetch('/inboxes/' + ib.id + '/emails' + params).then(function(r){ return r.json(); }).then(function(data) {
    emailLoading = false;
    emailHasMore = data.has_more || false;
    if (keep) {
      ib.emails = (ib.emails || []).concat(data.emails || []);
    } else {
      ib.emails = data.emails || [];
      ib._vsScroll = 0;
    }
    ib.unreadCount = data.unread || 0;
    ib.totalEmails = data.total || 0;
    renderEmailList();
    if (!keep || !ib.currentMailId) {
      renderEmailDetail();
      renderSenderInfo(ib.emails.find(function(e){ return e.id === ib.currentMailId; }) || null, ib);
    }
  })['catch'](function() {
    emailLoading = false;
    toast('Failed to load emails');
  });
}

/* ── Load more emails (next page) ── */
function loadMoreEmails() {
  if (emailLoading || !emailHasMore) return;
  emailPage++;
  loadEmails(true);
}

/* ── Virtual-scrolled email list ── */
function renderEmailList() {
  var ib = activeInbox();
  if (!ib) return;
  var scroll = document.getElementById('email-list');
  var cnt = document.getElementById('list-count');
  var badge = document.getElementById('ucnt');
  var unread = ib.unreadCount || 0;
  var total = ib.emails.length;

  cnt.innerHTML = '<svg width="9" height="9" fill="var(--GREEN)" viewBox="0 0 10 10"><circle cx="5" cy="5" r="5"/></svg> ' + total + ' messages' + (unread ? ' · ' + unread + ' unread' : '');
  badge.textContent = unread > 0 ? unread : '';

  if (total === 0) {
    scroll.innerHTML = '<div class="no-mail"><svg width="32" height="32" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg><p>No messages yet</p></div>';
    scroll._vsInit = false;
    scroll._vsEst = null;
    scroll._vsFirst = -1;
    scroll._vsLast = -1;
    return;
  }

  ib._vsTotal = total;

  if (!scroll._vsEst) {
    var probe = document.createElement('div');
    probe.className = 'erow';
    probe.style.position = 'absolute'; probe.style.visibility = 'hidden'; probe.style.width = '100%';
    probe.innerHTML = '<div class="erow-left"><div class="erow-avatar" style="background:#000;">X</div><div class="rdot-sm"></div></div><div class="erow-body"><div class="erow-top-row"><span class="e-sender">X</span><span class="e-time">X</span></div><div class="e-subject">X</div><div class="e-preview">X</div></div>';
    scroll.appendChild(probe);
    vsItemHeight = probe.offsetHeight || 64;
    scroll.removeChild(probe);
    scroll._vsEst = vsItemHeight;
  }

  // Build virtual-scroll structure on first render
  if (!scroll._vsInit) {
    scroll.style.setProperty('overflow-y', 'auto', 'important');
    scroll.style.position = 'relative';
    scroll.innerHTML = '<div class="vs-spacer-top"></div><div class="vs-rows"></div><div class="vs-spacer-bot"></div>';
    scroll.addEventListener('scroll', vsScrollHandler);
    scroll._vsInit = true;
  }

  scroll._vsIbId = ib.id;
  vsOnScroll(ib);
}

function vsScrollHandler() {
  var scroll = document.getElementById('email-list');
  if (!scroll || !scroll._vsIbId) return;
  var ib = getInbox(scroll._vsIbId);
  if (!ib) return;
  vsRenderVisible(scroll, ib);
  // Infinite scroll: trigger load more near bottom
  if (scroll.scrollTop + scroll.clientHeight >= scroll.scrollHeight - 200) {
    if (getInbox(scroll._vsIbId)) loadMoreEmails();
  }
}

function vsOnScroll(ib) {
  var scroll = document.getElementById('email-list');
  if (!scroll) return;
  scroll._vsIbId = ib.id;
  vsRenderVisible(scroll, ib);
}

function vsRenderVisible(scroll, ib) {
  var st = scroll.scrollTop;
  var ch = scroll.clientHeight;
  var total = ib._vsTotal || ib.emails.length;
  if (total === 0) return;
  var rowH = vsItemHeight || 64;

  var first = Math.max(0, Math.floor(st / rowH) - VS_BUFFER);
  var last = Math.min(total, Math.ceil((st + ch) / rowH) + VS_BUFFER);
  var topPad = first * rowH;
  var botPad = (total - last) * rowH;

  var topEl = scroll.querySelector('.vs-spacer-top');
  var rowsEl = scroll.querySelector('.vs-rows');
  var botEl = scroll.querySelector('.vs-spacer-bot');
  if (!topEl || !rowsEl || !botEl) return;
  topEl.style.height = topPad + 'px';
  botEl.style.height = botPad + 'px';

  if (scroll._vsFirst === first && scroll._vsLast === last) return;
  scroll._vsFirst = first;
  scroll._vsLast = last;

  var frag = document.createDocumentFragment();
  for (var i = first; i < last; i++) {
    var em = ib.emails[i];
    if (!em) continue;
    var sel = em.id === ib.currentMailId ? ' selected' : '';
    var unr = em.unread ? ' unread' : '';
    var dot = em.unread
      ? '<div class="udot-sm"></div>'
      : '<div class="rdot-sm"></div>';
    var div = document.createElement('div');
    div.className = 'erow' + unr + sel;
    div.setAttribute('data-id', em.id);
    div.onclick = function(id) { return function() { openMailDetail(id); }; }(em.id);
    div.innerHTML =
      '<div class="erow-left">' +
        '<div class="erow-avatar" style="background:' + em.color + ';">' + em.avatar + '</div>' +
        dot +
      '</div>' +
      '<div class="erow-body">' +
        '<div class="erow-top-row">' +
          '<span class="e-sender">' + escapeHtml(em.sender) + '</span>' +
          '<span class="e-time">' + em.time + '</span>' +
        '</div>' +
        '<div class="e-subject">' + escapeHtml(em.subject) + '</div>' +
        '<div class="e-preview">' + escapeHtml((em.body || '').replace(/<[^>]*>/g,'').slice(0,60)) + '…</div>' +
      '</div>';
    frag.appendChild(div);
  }
  rowsEl.innerHTML = '';
  rowsEl.appendChild(frag);
}

function vsReset(id) {
  var scroll = document.getElementById('email-list');
  if (scroll) {
    scroll._vsInit = false;
    scroll._vsEst = null;
    scroll._vsFirst = -1;
    scroll._vsLast = -1;
    scroll._vsIbId = null;
    if (scroll.scrollTo) scroll.scrollTo(0, 0);
  }
  var ib = id ? getInbox(id) : activeInbox();
  if (ib) ib._vsScroll = 0;
}

function escapeHtml(str) {
  if (!str) return '';
  var d = document.createElement('div');
  d.appendChild(document.createTextNode(str));
  return d.innerHTML;
}

/* ── Render email detail ── */
function renderEmailDetail() {
  var ib = activeInbox();
  if (!ib) return;
  var em = ib.emails.find(function(e){ return e.id === ib.currentMailId; });
  if (!em) {
    document.getElementById('detail-empty').style.display = 'flex';
    document.getElementById('detail-content').style.display = 'none';
    renderSenderInfo(null, ib);
    return;
  }
  document.getElementById('detail-empty').style.display = 'none';
  document.getElementById('detail-content').style.display = 'flex';

  // Scroll email viewer to top on new email
  var viewer = document.getElementById('email-viewer');
  if (viewer) viewer.scrollTop = 0;

  var f;
  (f = document.getElementById('d-subject')) && (f.textContent = em.subject);
  (f = document.getElementById('d-avatar'))  && (f.textContent = em.avatar);
  if (f = document.getElementById('d-avatar')) f.style.background = em.color;
  (f = document.getElementById('d-name'))    && (f.textContent = em.sender);
  (f = document.getElementById('d-email'))   && (f.innerHTML = '&lt;' + em.email + '&gt;');
  (f = document.getElementById('d-to'))      && (f.textContent = ib.address);
  (f = document.getElementById('d-time'))    && (f.textContent = em.time);

  renderEmailBody(em);
  renderSenderInfo(em, ib);
}

function renderEmailBody(em) {
  var container = document.getElementById('d-body');
  if (!container) return;

  currentRawUrl = '/inboxes/' + activeInbox().id + '/emails/' + em.id + '/raw';

  if (em.body && em.body.indexOf('<') === 0) {
    var escapedBody = escapeAttr(em.body);
    container.innerHTML =
      '<iframe class="email-iframe" srcdoc="' + escapedBody + '" sandbox="allow-same-origin" style="width:100%;min-height:400px;border:none;"></iframe>';
  } else if (em.body) {
    container.innerHTML = em.body;
  } else {
    container.innerHTML = '<p style="color:var(--MU2);">(no content)</p>';
  }


}

function escapeAttr(str) {
  return str.replace(/&/g,'&amp;').replace(/"/g,'&quot;').replace(/'/g,'&#39;').replace(/</g,'&lt;').replace(/>/g,'&gt;');
}

function renderSenderInfo(em, ib) {
  if (!ib) return;

  // New collapsible panel elements
  var sd_from   = document.getElementById('sd-from');
  var sd_domain = document.getElementById('sd-domain');
  var sd_received = document.getElementById('sd-received');
  var sd_address  = document.getElementById('sd-address');
  var sd_addr_domain = document.getElementById('sd-addr-domain');
  var sd_total   = document.getElementById('sd-total');
  var sd_unread  = document.getElementById('sd-unread');

  if (sd_from) sd_from.textContent = (em && em.sender) || '—';
  if (sd_domain) {
    var parts = ((em && em.email) || '').split('@');
    sd_domain.textContent = parts.length > 1 ? parts[1] : '—';
  }
  if (sd_received) sd_received.textContent = (em && em.time) || '—';
  if (sd_total) sd_total.textContent = (ib.emails && ib.emails.length) || 0;
  if (sd_unread) sd_unread.textContent = ib.unreadCount || 0;
  if (sd_address) sd_address.textContent = ib.address ? ib.address.split('@')[0] : '—';
  if (sd_addr_domain) sd_addr_domain.textContent = ib.domain || '—';
}

/* ── Generate new inbox (domain → expires modals) ── */
function genNewInbox() {
  showDomainModal(function(domainId) {
    showExpiresModal(function(expiresSecs) {
      createInbox(domainId, expiresSecs);
    });
  });
}

/* ── Domain selection modal ── */
function showDomainModal(callback) {
  pendingDomainCallback = callback;
  var list = document.getElementById('domain-options');
  list.innerHTML = '<div style="text-align:center;padding:12px;color:var(--MU2);font-size:.82rem;">Loading domains...</div>';
  selectedDomain = null;
  var btn = document.getElementById('domain-confirm-btn');
  btn.disabled = true;
  btn.style.opacity = '.5';
  document.getElementById('domain-modal').classList.add('open');

  fetch('/inboxes/domains').then(function(r){ return r.json(); }).then(function(data) {
    list.innerHTML = (data.domains || []).map(function(d) {
      return '<div class="domain-option" onclick="pickDomainOpt(this,' + d.id + ')" data-domain-id="' + d.id + '" data-domain-name="' + d.name + '">' +
        '<span class="domain-option-name" style="font-size:.82rem;">@' + d.name + '</span>' +
        '<div class="domain-check"></div>' +
      '</div>';
    }).join('');
  })['catch'](function() {
    list.innerHTML = '<div style="text-align:center;padding:12px;color:var(--RED);font-size:.82rem;">Failed to load domains</div>';
  });
}

function pickDomainOpt(el, id) {
  document.querySelectorAll('#domain-options .domain-option').forEach(function(o) { o.classList.remove('selected'); });
  el.classList.add('selected');
  selectedDomain = id;
  var btn = document.getElementById('domain-confirm-btn');
  btn.disabled = false;
  btn.style.opacity = '1';
}

function confirmDomainSelection() {
  if (!selectedDomain) return;
  document.getElementById('domain-modal').classList.remove('open');
  if (pendingDomainCallback) {
    var cb = pendingDomainCallback;
    pendingDomainCallback = null;
    cb(selectedDomain);
  }
}

function cancelDomainModal() {
  document.getElementById('domain-modal').classList.remove('open');
  pendingDomainCallback = null;
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
  navigator.clipboard.writeText(txt)['catch'](function(){});
  var btn = document.getElementById('cbtn');
  btn.classList.add('ok'); btn.innerHTML = '&#10003; Copied';
  toast('Email address copied!');
  setTimeout(function() { btn.classList.remove('ok'); btn.innerHTML = '<svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><rect x="9" y="9" width="13" height="13" rx="2"/><path stroke-linecap="round" d="M5 15H4a2 2 0 01-2-2V4a2 2 0 012-2h9a2 2 0 012 2v1"/></svg> Copy'; }, 2200);
}

/* ── Open mail detail ── */
function openMailDetail(id) {
  var ib = activeInbox();
  if (!ib) return;
  ib.currentMailId = id;

  fetch('/inboxes/' + ib.id + '/emails/' + id).then(function(r){ return r.json(); }).then(function(data) {
    var em = data.email;
    if (!em) return;
    var local = ib.emails.find(function(e){ return e.id === em.id; });
    if (local) {
      local.unread = false;
      local.body = em.html_body || (em.text_body ? '<pre>' + escapeHtml(em.text_body) + '</pre>' : '');
    }
    renderEmailList();
    renderEmailDetail();
    document.getElementById('inbox-3col').classList.add('mob-detail');
  })['catch'](function() {
    var em = ib.emails.find(function(e){ return e.id === id; });
    if (!em) return;
    em.unread = false;
    renderEmailList();
    renderEmailDetail();
    document.getElementById('inbox-3col').classList.add('mob-detail');
  });
}

function closeMailDetail() {
  document.getElementById('inbox-3col').classList.remove('mob-detail');
}

function deleteCurrentMail() {
  var ib = activeInbox();
  if (!ib || !ib.currentMailId) return;
  showConfirmModal('Delete this message?', function() {
    fetch('/inboxes/' + ib.id + '/emails/' + ib.currentMailId, {
      method: 'DELETE',
      headers: { 'X-CSRF-TOKEN': CSRF_TOKEN }
    }).then(function(r){ return r.json(); }).then(function(data) {
      if (data.error) { toast(data.error); return; }
      ib.emails = ib.emails.filter(function(e){ return e.id !== ib.currentMailId; });
      ib.currentMailId = null;
      document.getElementById('detail-empty').style.display = 'flex';
      document.getElementById('detail-content').style.display = 'none';
      document.getElementById('inbox-3col').classList.remove('mob-detail');
      renderEmailList();
      renderSenderInfo(null, ib);
      toast('Message deleted');
    })['catch'](function() { toast('Failed to delete message'); });
  });
}

function markUnreadCurrent() {
  var ib = activeInbox();
  if (!ib || !ib.currentMailId) return;
  fetch('/inboxes/' + ib.id + '/emails/' + ib.currentMailId + '/unread', {
    method: 'PATCH',
    headers: { 'X-CSRF-TOKEN': CSRF_TOKEN }
  }).then(function(r){ return r.json(); }).then(function(data) {
    if (data.error) { toast(data.error); return; }
    var em = ib.emails.find(function(e){ return e.id === ib.currentMailId; });
    if (em) em.unread = true;
    renderEmailList();
    renderSenderInfo(null, ib);
    toast('Marked as unread');
  })['catch'](function() { toast('Failed to mark as unread'); });
}

function markAllReadInbox() {
  var ib = activeInbox();
  if (!ib) return;
  showConfirmModal('Mark all messages as read?', function() {
    fetch('/inboxes/' + ib.id + '/emails/mark-all-read', {
      method: 'POST',
      headers: { 'X-CSRF-TOKEN': CSRF_TOKEN }
    }).then(function(r){ return r.json(); }).then(function(data) {
      if (data.error) { toast(data.error); return; }
      ib.emails.forEach(function(e){ e.unread = false; });
      ib.unreadCount = 0;
      renderEmailList();
      renderSenderInfo(null, ib);
      toast('All messages marked as read');
    })['catch'](function() { toast('Failed to mark all as read'); });
  }, 'Mark Read');
}

function deleteAllInbox() {
  var ib = activeInbox();
  if (!ib) return;
  showConfirmModal('Delete all messages?', function() {
    fetch('/inboxes/' + ib.id + '/emails', {
      method: 'DELETE',
      headers: { 'X-CSRF-TOKEN': CSRF_TOKEN }
    }).then(function(r){ return r.json(); }).then(function(data) {
      if (data.error) { toast(data.error); return; }
      ib.emails = [];
      ib.currentMailId = null;
      ib.unreadCount = 0;
      document.getElementById('detail-empty').style.display = 'flex';
      document.getElementById('detail-content').style.display = 'none';
      renderEmailList();
      renderSenderInfo(null, ib);
      toast('All messages deleted');
    })['catch'](function() { toast('Failed to delete all messages'); });
  });
}

function refreshInboxList() {
  loadEmails();
  toast('Inbox refreshed');
}

function switchTab(btn, tab) {
  document.querySelectorAll('.list-tab').forEach(function(b){ b.classList.remove('active'); });
  btn.classList.add('active');
  currentFilter = tab;
  loadEmails();
}

function debounceSearchInbox(val) {
  clearTimeout(searchDelayInbox);
  searchDelayInbox = setTimeout(function() {
    currentSearch = val;
    loadEmails();
  }, 300);
}

/* ── View Raw ── */
function viewRawEmail() {
  if (!currentRawUrl) { toast('No email selected'); return; }
  fetch(currentRawUrl).then(function(r){ return r.json(); }).then(function(data) {
    document.getElementById('raw-content').textContent = data.raw || '(no raw content)';
    document.getElementById('raw-modal').classList.add('open');
  })['catch'](function() { toast('Failed to load raw content'); });
}

function closeRawModal() {
  document.getElementById('raw-modal').classList.remove('open');
}

function printEmail() {
  if (!currentRawUrl) { toast('No email selected'); return; }
  var w = window.open('', '_blank');
  if (!w) { toast('Please allow popups for printing'); return; }
  w.document.write('<html><head><title>Print Email</title></head><body>');
  var iframe = document.querySelector('.email-iframe');
  if (iframe) {
    w.document.write(iframe.getAttribute('srcdoc') || '(no content)');
  } else {
    var body = document.getElementById('d-body');
    if (body) w.document.write(body.innerHTML);
  }
  w.document.write('</body></html>');
  w.document.close();
  w.focus();
  setTimeout(function() { w.print(); }, 300);
}

/* ── ESC: exit fullscreen or close modals ── */
document.addEventListener('keydown', function(e) {
  if (e.key === 'Escape') {
    if (document.body.classList.contains('inbox-fs')) {
      toggleFullscreen(); return;
    }
    var modals = ['confirm-modal','domain-modal','expires-modal','raw-modal'];
    for (var i = 0; i < modals.length; i++) {
      var el = document.getElementById(modals[i]);
      if (el && el.classList.contains('open')) { el.classList.remove('open'); }
    }
    pendingDomainCallback = null;
    pendingGenCallback = null;
    pendingConfirmCallback = null;
  }
});

/* ── Init ── */
loadInboxes(function(data) {
  if (inboxes.length === 0) {
    genNewInbox();
  } else {
    activeInboxId = inboxes[0].id;
    renderInboxTabs();
    renderActiveInbox();
    ensureTimer();
  }
});
</script>
@endpush
