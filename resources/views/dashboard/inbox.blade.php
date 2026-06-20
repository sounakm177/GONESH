<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>InboxOro — Inbox</title>
<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Outfit:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;500;700&display=swap" rel="stylesheet"/>

<style>
/* ════════════════════════════════════════════════
   TOKENS
════════════════════════════════════════════════ */
:root {
  --Y:       #FACC15;
  --B:       #3B82F6;
  --INK:     #111827;
  --INK2:    #1F2937;
  --BG:      #F9FAFB;
  --SURF:    #FFFFFF;
  --BD:      #E5E7EB;
  --BD2:     #F3F4F6;
  --MU:      #6B7280;
  --MU2:     #9CA3AF;
  --GREEN:   #10B981;
  --RED:     #EF4444;
  --MONO:    'JetBrains Mono', monospace;
  --DISP:    'Bebas Neue', sans-serif;
  --BODY:    'Outfit', sans-serif;

  /* sidebar widths */
  --SB-W:    240px;
  --SB-MINI: 60px;
}

/* ════════════════════════════════════════════════
   RESET
════════════════════════════════════════════════ */
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
html, body { height: 100%; overflow: hidden; }
body {
  font-family:  var(--BODY);
  color:        var(--INK);
  background:   var(--BG);
  display:      flex;
  flex-direction: column;
  -webkit-tap-highlight-color: transparent;
}
button { font-family: var(--BODY); cursor: pointer; border: none; background: none; }
a      { text-decoration: none; color: inherit; }
svg    { flex-shrink: 0; }

/* ════════════════════════════════════════════════
   TOPBAR — dark background so logo SVG is visible
════════════════════════════════════════════════ */
.topbar {
  height:          56px;
  min-height:      56px;
  background:      var(--INK);          /* dark — logo white text visible */
  border-bottom:   1px solid rgba(255,255,255,.08);
  display:         flex;
  align-items:     center;
  padding:         0 16px;
  gap:             12px;
  z-index:         200;
  flex-shrink:     0;
}

/* Single toggle button — hamburger on mobile, collapse on desktop */
.sb-toggle {
  width:           36px;
  height:          36px;
  min-width:       36px;
  display:         flex;
  align-items:     center;
  justify-content: center;
  border-radius:   8px;
  color:           var(--MU2);
  transition:      background .15s, color .15s;
  flex-shrink:     0;
}
.sb-toggle:hover { background: rgba(255,255,255,.08); color: #fff; }

/* Logo image in topbar */
.topbar-logo {
  display:     flex;
  align-items: center;
  flex-shrink: 0;
  line-height: 1;
}
.topbar-logo img,
.logo-img {
  height:    32px;
  width:     auto;
  display:   block;
}

/* search */
.topbar-search {
  flex:          1;
  max-width:     360px;
  display:       flex;
  align-items:   center;
  gap:           8px;
  background:    rgba(255,255,255,.07);
  border:        1px solid rgba(255,255,255,.12);
  border-radius: 8px;
  padding:       0 12px;
  height:        36px;
}
.topbar-search input {
  flex:        1;
  border:      none;
  outline:     none;
  background:  transparent;
  font-family: var(--BODY);
  font-size:   .84rem;
  color:       #fff;
}
.topbar-search input::placeholder { color: #6B7280; }
.topbar-search svg { color: #6B7280; }

/* search hidden on very small mobile */
@media (max-width: 400px) { .topbar-search { display: none; } }

.topbar-right {
  margin-left: auto;
  display:     flex;
  align-items: center;
  gap:         6px;
}

.tb-icon {
  width:           36px;
  height:          36px;
  display:         flex;
  align-items:     center;
  justify-content: center;
  border-radius:   8px;
  color:           var(--MU2);
  position:        relative;
  transition:      background .15s, color .15s;
}
.tb-icon:hover { background: rgba(255,255,255,.08); color: #fff; }

.notif-badge {
  position:      absolute;
  top:           6px;
  right:         6px;
  width:         7px;
  height:        7px;
  background:    var(--RED);
  border-radius: 50%;
  border:        2px solid var(--INK);
}

.tb-avatar {
  width:           36px;
  height:          36px;
  background:      var(--Y);
  border-radius:   8px;
  display:         flex;
  align-items:     center;
  justify-content: center;
  font-family:     var(--DISP);
  font-size:       1rem;
  color:           var(--INK);
  font-weight:     700;
  flex-shrink:     0;
  cursor:          pointer;
  position:        relative;
}

/* user dropdown */
.user-dd {
  display:    none;
  position:   absolute;
  top:        calc(100% + 8px);
  right:      0;
  width:      200px;
  background: var(--SURF);
  border:     1px solid var(--BD);
  border-radius: 10px;
  box-shadow: 0 8px 24px rgba(0,0,0,.1);
  z-index:    300;
  overflow:   hidden;
}
.user-dd.open { display: block; animation: dd-in .15s ease both; }
@keyframes dd-in { from{opacity:0;transform:translateY(-6px)} to{opacity:1;transform:translateY(0)} }

.dd-user-info {
  padding:       14px 16px 10px;
  border-bottom: 1px solid var(--BD2);
}
.dd-user-name  { font-weight: 700; font-size: .85rem; color: var(--INK); }
.dd-user-email { font-size: .72rem; color: var(--MU); margin-top: 2px; font-family: var(--MONO); }

.dd-item {
  display:     flex;
  align-items: center;
  gap:         9px;
  padding:     9px 16px;
  font-size:   .82rem;
  color:       var(--INK);
  transition:  background .12s;
  cursor:      pointer;
}
.dd-item:hover { background: var(--BD2); }
.dd-item svg   { color: var(--MU); }
.dd-item.danger { color: var(--RED); }
.dd-item.danger svg { color: var(--RED); }
.dd-divider { height: 1px; background: var(--BD2); margin: 4px 0; }

/* ════════════════════════════════════════════════
   SHELL  (sidebar + main)
════════════════════════════════════════════════ */
.shell {
  flex:     1;
  display:  flex;
  overflow: hidden;
  position: relative;
}

/* ════════════════════════════════════════════════
   SIDEBAR — dark, matches topbar (#111827)
   Mobile: off-canvas overlay
   Desktop: inline, collapses to 60px icon rail
════════════════════════════════════════════════ */
.sidebar {
  width:          var(--SB-W);
  min-width:      var(--SB-W);
  background:     var(--INK);           /* dark — same as topbar */
  border-right:   1px solid rgba(255,255,255,.07);
  display:        flex;
  flex-direction: column;
  overflow:       hidden;
  transition:     width .25s cubic-bezier(.4,0,.2,1),
                  min-width .25s cubic-bezier(.4,0,.2,1),
                  transform .25s cubic-bezier(.4,0,.2,1);
  flex-shrink:    0;
  z-index:        150;

  /* Mobile: off-canvas */
  position:  fixed;
  top:       56px;
  left:      0;
  bottom:    0;
  transform: translateX(-100%);
}

.sidebar.mob-open {
  transform:  translateX(0);
  box-shadow: 6px 0 32px rgba(0,0,0,.35);
}

/* Mobile backdrop */
.sb-backdrop {
  display:    none;
  position:   fixed;
  inset:      0;
  background: rgba(0,0,0,.5);
  z-index:    140;
}
.sb-backdrop.show { display: block; }

/* Collapsed (desktop) */
.sidebar.collapsed {
  width:     var(--SB-MINI);
  min-width: var(--SB-MINI);
}

/* ── Collapse btn — lives in topbar, desktop only ── */
.sb-collapse-btn {
  width:      36px;
  height:     36px;
  min-width:  36px;
  display:    none;            /* revealed at ≥900px */
  align-items:     center;
  justify-content: center;
  border-radius:   8px;
  color:      rgba(255,255,255,.5);
  flex-shrink: 0;
  transition: background .15s, color .15s;
}
.sb-collapse-btn:hover { background: rgba(255,255,255,.1); color: #fff; }
.sb-collapse-btn svg   { transition: transform .25s cubic-bezier(.4,0,.2,1); }
body.sb-collapsed .sb-collapse-btn svg { transform: rotate(180deg); }

/* ── Sidebar body ── */
.sb-body {
  flex:       1;
  overflow-y: auto;
  overflow-x: hidden;
  padding:    8px 0 12px;
}
.sb-body::-webkit-scrollbar       { width: 3px; }
.sb-body::-webkit-scrollbar-thumb { background: rgba(255,255,255,.1); border-radius: 2px; }

/* Section label */
.sb-label {
  font-family:    var(--MONO);
  font-size:      .54rem;
  font-weight:    700;
  letter-spacing: .13em;
  text-transform: uppercase;
  color:          rgba(255,255,255,.25);
  padding:        16px 20px 6px;
  white-space:    nowrap;
  overflow:       hidden;
  transition:     opacity .2s, padding .2s;
  opacity:        1;
}
.sidebar.collapsed .sb-label { opacity: 0; padding-top: 0; padding-bottom: 0; height: 0; }

/* Nav item */
.sb-item {
  display:       flex;
  align-items:   center;
  gap:           10px;
  padding:       9px 12px;
  margin:        1px 8px;
  border-radius: 8px;
  font-size:     .84rem;
  font-weight:   500;
  color:         rgba(255,255,255,.55);
  transition:    background .12s, color .12s;
  white-space:   nowrap;
  overflow:      hidden;
  position:      relative;
  text-decoration: none;
}
.sb-item:hover {
  background: rgba(255,255,255,.07);
  color:      #fff;
}
.sb-item.active {
  background: rgba(250,204,21,.14);
  color:      var(--Y);
  font-weight: 600;
}
.sb-item.active .sb-item-icon { color: var(--Y); }

.sb-item-icon {
  width:      20px;
  min-width:  20px;
  display:    flex;
  align-items: center;
  justify-content: center;
  color:      rgba(255,255,255,.4);
  transition: color .12s;
  flex-shrink: 0;
}
.sb-item:hover .sb-item-icon  { color: rgba(255,255,255,.9); }

.sb-item-label {
  flex:       1;
  opacity:    1;
  transition: opacity .15s;
  overflow:   hidden;
}
.sidebar.collapsed .sb-item-label { opacity: 0; }

/* Notification pill */
.sb-pill {
  background:    var(--Y);
  color:         var(--INK);
  font-family:   var(--MONO);
  font-size:     .52rem;
  font-weight:   800;
  padding:       2px 7px;
  border-radius: 10px;
  flex-shrink:   0;
  opacity:       1;
  transition:    opacity .15s;
}
.sidebar.collapsed .sb-pill { opacity: 0; }

/* Tooltip when collapsed */
.sb-item[data-tip]:hover::after {
  content:        attr(data-tip);
  position:       absolute;
  left:           calc(var(--SB-MINI) + 6px);
  top:            50%;
  transform:      translateY(-50%);
  background:     var(--INK2);
  color:          #fff;
  font-size:      .76rem;
  font-weight:    500;
  padding:        6px 12px;
  border-radius:  8px;
  white-space:    nowrap;
  pointer-events: none;
  box-shadow:     0 4px 16px rgba(0,0,0,.25);
  display:        none;
  z-index:        999;
}
.sidebar.collapsed .sb-item[data-tip]:hover::after { display: block; }

/* Divider */
.sb-divider { height: 1px; background: rgba(255,255,255,.07); margin: 8px 16px; }

/* ── Sidebar footer ── */
.sb-footer {
  padding:    10px 12px 14px;
  border-top: 1px solid rgba(255,255,255,.07);
  flex-shrink: 0;
}
.sb-user {
  display:       flex;
  align-items:   center;
  gap:           10px;
  padding:       8px;
  border-radius: 8px;
  cursor:        pointer;
  overflow:      hidden;
  transition:    background .12s;
}
.sb-user:hover { background: rgba(255,255,255,.07); }

.sb-user-av {
  width:           32px;
  min-width:       32px;
  height:          32px;
  background:      var(--Y);
  border-radius:   8px;
  display:         flex;
  align-items:     center;
  justify-content: center;
  font-family:     var(--DISP);
  font-size:       .9rem;
  color:           var(--INK);
  font-weight:     700;
  flex-shrink:     0;
}
.sb-user-info  { overflow: hidden; opacity: 1; transition: opacity .15s; }
.sidebar.collapsed .sb-user-info { opacity: 0; }
.sb-user-name  { font-size: .8rem; font-weight: 700; color: #fff; white-space: nowrap; }
.sb-user-plan  { font-family: var(--MONO); font-size: .58rem; color: rgba(255,255,255,.4); white-space: nowrap; margin-top: 1px; }

/* ════════════════════════════════════════════════
   MAIN CONTENT
════════════════════════════════════════════════ */
.main {
  flex:        1;
  overflow-y:  auto;
  overflow-x:  hidden;
  padding:     24px 16px 48px;
  min-width:   0;
  /* On desktop, offset for sidebar */
  transition:  margin-left .25s cubic-bezier(.4,0,.2,1);
}
.main::-webkit-scrollbar { width: 4px; }
.main::-webkit-scrollbar-thumb { background: var(--BD); border-radius: 2px; }

/* page header */
.page-hd {
  display:         flex;
  align-items:     flex-start;
  justify-content: space-between;
  gap:             12px;
  flex-wrap:       wrap;
  margin-bottom:   22px;
}
.page-title    { font-family: var(--DISP); font-size: 1.7rem; letter-spacing: .03em; line-height: 1; color: var(--INK); }
.page-subtitle { font-family: var(--MONO); font-size: .62rem; color: var(--MU); margin-top: 4px; }

.btn-primary {
  display:       inline-flex;
  align-items:   center;
  gap:           6px;
  background:    var(--INK);
  color:         #fff;
  font-size:     .8rem;
  font-weight:   600;
  padding:       9px 16px;
  border-radius: 8px;
  border:        none;
  white-space:   nowrap;
  transition:    background .15s, transform .1s;
}
.btn-primary:hover  { background: var(--INK2); transform: translateY(-1px); }
.btn-primary:active { transform: translateY(0); }
.btn-primary.yellow { background: var(--Y); color: var(--INK); }
.btn-primary.yellow:hover { background: #EAB800; }

.btn-ghost {
  display:       inline-flex;
  align-items:   center;
  gap:           6px;
  background:    var(--SURF);
  color:         var(--INK);
  font-size:     .8rem;
  font-weight:   500;
  padding:       8px 14px;
  border-radius: 8px;
  border:        1px solid var(--BD);
  white-space:   nowrap;
  transition:    background .15s, border-color .15s;
}
.btn-ghost:hover { background: var(--BD2); border-color: #D1D5DB; }

/* ── Stat cards ── */
.stat-grid {
  display:               grid;
  grid-template-columns: repeat(2, 1fr);
  gap:                   12px;
  margin-bottom:         20px;
}

.stat-card {
  background:    var(--SURF);
  border:        1px solid var(--BD);
  border-radius: 12px;
  padding:       16px;
  position:      relative;
  overflow:      hidden;
  transition:    box-shadow .2s, transform .15s;
}
.stat-card:hover { box-shadow: 0 4px 16px rgba(0,0,0,.06); transform: translateY(-1px); }

.stat-card-top {
  display:         flex;
  align-items:     flex-start;
  justify-content: space-between;
  margin-bottom:   10px;
}
.stat-icon-wrap {
  width:           36px;
  height:          36px;
  border-radius:   9px;
  display:         flex;
  align-items:     center;
  justify-content: center;
}
.stat-icon-wrap.yellow { background: rgba(250,204,21,.18); color: #B45309; }
.stat-icon-wrap.blue   { background: rgba(59,130,246,.12);  color: var(--B); }
.stat-icon-wrap.green  { background: rgba(16,185,129,.12);  color: var(--GREEN); }
.stat-icon-wrap.red    { background: rgba(239,68,68,.10);   color: var(--RED); }

.stat-trend {
  display:       flex;
  align-items:   center;
  gap:           3px;
  font-family:   var(--MONO);
  font-size:     .6rem;
  font-weight:   700;
  padding:       3px 7px;
  border-radius: 20px;
}
.stat-trend.up   { background: rgba(16,185,129,.1);  color: var(--GREEN); }
.stat-trend.down { background: rgba(239,68,68,.1);   color: var(--RED); }

.stat-value { font-family: var(--DISP); font-size: 2rem; color: var(--INK); line-height: 1; margin-bottom: 3px; }
.stat-label { font-size: .76rem; color: var(--MU); font-weight: 500; }

/* ── Generator card ── */
.gen-card {
  background:    var(--SURF);
  border:        1px solid var(--BD);
  border-radius: 12px;
  overflow:      hidden;
  margin-bottom: 20px;
}
.gen-card-hd {
  display:         flex;
  align-items:     center;
  justify-content: space-between;
  padding:         14px 18px;
  border-bottom:   1px solid var(--BD2);
  flex-wrap:       wrap;
  gap:             8px;
}
.gen-card-title { font-weight: 700; font-size: .92rem; color: var(--INK); }
.live-tag {
  display:        inline-flex;
  align-items:    center;
  gap:            6px;
  font-family:    var(--MONO);
  font-size:      .6rem;
  font-weight:    700;
  color:          var(--GREEN);
  letter-spacing: .06em;
  background:     rgba(16,185,129,.08);
  padding:        3px 9px;
  border-radius:  20px;
}
.live-dot { width: 6px; height: 6px; background: var(--GREEN); border-radius: 50%; animation: pulse 2s ease-in-out infinite; }
@keyframes pulse { 0%,100%{box-shadow:0 0 0 0 rgba(16,185,129,.4)} 50%{box-shadow:0 0 0 4px rgba(16,185,129,0)} }

.gen-card-body { padding: 16px 18px; }

/* domain tabs */
.dom-tabs {
  display:             flex;
  gap:                 4px;
  overflow-x:          auto;
  scrollbar-width:     none;
  margin-bottom:       14px;
  padding-bottom:      2px;
}
.dom-tabs::-webkit-scrollbar { display: none; }
.dom-tab {
  font-family:    var(--MONO);
  font-size:      .66rem;
  font-weight:    600;
  padding:        5px 12px;
  border-radius:  6px;
  border:         1px solid var(--BD);
  background:     var(--SURF);
  color:          var(--MU);
  white-space:    nowrap;
  flex-shrink:    0;
  transition:     background .12s, color .12s, border-color .12s;
}
.dom-tab:hover  { background: var(--BD2); color: var(--INK); border-color: #D1D5DB; }
.dom-tab.active { background: var(--INK); color: var(--Y);  border-color: var(--INK); }

/* email display row */
.email-display {
  display:       flex;
  align-items:   center;
  gap:           10px;
  background:    var(--BG);
  border:        1px solid var(--BD);
  border-radius: 10px;
  padding:       12px 14px;
  margin-bottom: 12px;
}
.email-txt {
  font-family:   var(--MONO);
  font-size:     clamp(.72rem, 2.8vw, .96rem);
  font-weight:   700;
  color:         var(--INK);
  flex:          1;
  min-width:     0;
  overflow:      hidden;
  text-overflow: ellipsis;
  white-space:   nowrap;
  transition:    opacity .25s;
}
.email-txt.fade { opacity: .2; }

.copy-btn {
  background:    var(--Y);
  color:         var(--INK);
  font-size:     .76rem;
  font-weight:   700;
  padding:       8px 14px;
  border-radius: 7px;
  flex-shrink:   0;
  white-space:   nowrap;
  transition:    background .15s, transform .1s;
}
.copy-btn:hover  { background: #EAB800; transform: translateY(-1px); }
.copy-btn.done   { background: var(--GREEN); color: #fff; }

.new-btn {
  background:    var(--SURF);
  color:         var(--MU);
  font-size:     .76rem;
  padding:       8px 12px;
  border-radius: 7px;
  border:        1px solid var(--BD);
  flex-shrink:   0;
  display:       flex;
  align-items:   center;
  gap:           5px;
  transition:    background .12s, color .12s;
}
.new-btn:hover { background: var(--BD2); color: var(--INK); }

/* timer bar */
.timer-row { display: flex; align-items: center; gap: 10px; }
.timer-lbl { font-size: .72rem; color: var(--MU); white-space: nowrap; }
.timer-track { flex: 1; height: 4px; background: var(--BD); border-radius: 2px; overflow: hidden; }
.timer-fill  { height: 100%; background: var(--Y); border-radius: 2px; width: 100%; animation: shrink 600s linear forwards; }
@keyframes shrink { to { width: 0%; } }
.timer-count { font-family: var(--MONO); font-size: .7rem; font-weight: 700; color: var(--INK); white-space: nowrap; }

/* ── Bottom grid ── */
.bottom-grid {
  display:               grid;
  grid-template-columns: 1fr;
  gap:                   16px;
}

/* ── Panel card ── */
.panel {
  background:    var(--SURF);
  border:        1px solid var(--BD);
  border-radius: 12px;
  overflow:      hidden;
}
.panel-hd {
  display:         flex;
  align-items:     center;
  justify-content: space-between;
  padding:         13px 18px;
  border-bottom:   1px solid var(--BD2);
  gap:             8px;
  flex-wrap:       wrap;
}
.panel-title { font-weight: 700; font-size: .88rem; color: var(--INK); }
.panel-meta  { font-family: var(--MONO); font-size: .6rem; color: var(--MU); }

/* ── Tab row ── */
.tab-row { display: flex; border-bottom: 1px solid var(--BD2); padding: 0 10px; gap: 4px; }
.tab-btn {
  font-family:    var(--MONO);
  font-size:      .62rem;
  font-weight:    700;
  letter-spacing: .06em;
  text-transform: uppercase;
  padding:        8px 10px;
  color:          var(--MU);
  border-bottom:  2px solid transparent;
  margin-bottom:  -1px;
  transition:     color .15s, border-color .15s;
  white-space:    nowrap;
}
.tab-btn:hover  { color: var(--INK); }
.tab-btn.active { color: var(--INK); border-bottom-color: var(--Y); }

/* ── Address table ── */
.addr-row {
  display:     flex;
  align-items: center;
  gap:         10px;
  padding:     11px 18px;
  border-bottom: 1px solid var(--BD2);
  transition:  background .1s;
}
.addr-row:last-child { border-bottom: none; }
.addr-row:hover      { background: var(--BD2); }

.addr-email {
  font-family:   var(--MONO);
  font-size:     .72rem;
  font-weight:   600;
  color:         var(--INK);
  flex:          1;
  min-width:     0;
  overflow:      hidden;
  text-overflow: ellipsis;
  white-space:   nowrap;
}
.addr-badge {
  display:       inline-flex;
  align-items:   center;
  gap:           4px;
  font-family:   var(--MONO);
  font-size:     .58rem;
  font-weight:   700;
  padding:       3px 8px;
  border-radius: 20px;
  flex-shrink:   0;
  white-space:   nowrap;
}
.addr-badge.active  { background: rgba(16,185,129,.1);  color: var(--GREEN); }
.addr-badge.expired { background: var(--BD2); color: var(--MU); }

.addr-msgs {
  font-family:  var(--MONO);
  font-size:    .66rem;
  color:        var(--MU);
  white-space:  nowrap;
  flex-shrink:  0;
  display:      none; /* shown at ≥480px */
}
.addr-msgs b { color: var(--INK); }

.addr-actions { display: flex; gap: 4px; flex-shrink: 0; }
.icon-btn {
  width:         28px;
  height:        28px;
  display:       flex;
  align-items:   center;
  justify-content: center;
  border-radius: 6px;
  border:        1px solid var(--BD);
  background:    var(--SURF);
  color:         var(--MU);
  transition:    background .12s, color .12s, border-color .12s;
}
.icon-btn:hover        { background: var(--BD2); color: var(--INK); border-color: #D1D5DB; }
.icon-btn.del:hover    { background: rgba(239,68,68,.08); color: var(--RED); border-color: rgba(239,68,68,.3); }

/* ── Activity feed ── */
.activity-item {
  display:     flex;
  align-items: flex-start;
  gap:         12px;
  padding:     12px 18px;
  border-bottom: 1px solid var(--BD2);
  transition:  background .1s;
}
.activity-item:last-child { border-bottom: none; }
.activity-item:hover      { background: var(--BD2); }

.act-dot {
  width:         8px;
  height:        8px;
  border-radius: 50%;
  flex-shrink:   0;
  margin-top:    5px;
}
.act-dot.y { background: var(--Y); }
.act-dot.g { background: var(--GREEN); }
.act-dot.b { background: var(--B); }
.act-dot.r { background: var(--RED); }

.act-body { flex: 1; min-width: 0; }
.act-msg  { font-size: .8rem; color: var(--INK); line-height: 1.4; margin-bottom: 2px; overflow-wrap: break-word; }
.act-msg strong { font-weight: 700; }
.act-time { font-family: var(--MONO); font-size: .6rem; color: var(--MU2); }

/* ── Mini bar chart ── */
.chart-bars {
  display:     flex;
  align-items: flex-end;
  gap:         6px;
  height:      80px;
  padding:     12px 18px 0;
}
.bar-g   { display: flex; gap: 2px; align-items: flex-end; flex: 1; }
.bar     { flex: 1; border-radius: 3px 3px 0 0; min-height: 4px; transition: opacity .15s; }
.bar:hover { opacity: .75; }
.chart-labels {
  display:  flex;
  gap:      6px;
  padding:  6px 18px 12px;
}
.chart-lbl { flex: 1; text-align: center; font-family: var(--MONO); font-size: .54rem; color: var(--MU2); }

/* ════════════════════════════════════════════════
   TOAST
════════════════════════════════════════════════ */
#toast {
  position:       fixed;
  bottom:         20px;
  right:          16px;
  background:     var(--INK);
  color:          #fff;
  font-family:    var(--MONO);
  font-size:      .74rem;
  font-weight:    600;
  padding:        10px 16px;
  border-radius:  8px;
  box-shadow:     0 4px 20px rgba(0,0,0,.2);
  z-index:        999;
  display:        flex;
  align-items:    center;
  gap:            7px;
  transform:      translateY(70px);
  opacity:        0;
  transition:     transform .3s cubic-bezier(.34,1.56,.64,1), opacity .25s;
}
#toast.show { transform: translateY(0); opacity: 1; }
#toast .toast-dot { width: 7px; height: 7px; background: var(--GREEN); border-radius: 50%; }

/* ════════════════════════════════════════════════
   RESPONSIVE
════════════════════════════════════════════════ */
@media (min-width: 480px) {
  .addr-msgs { display: block; }
}

@media (min-width: 640px) {
  .main { padding: 28px 24px 56px; }
  .stat-grid { grid-template-columns: repeat(2, 1fr); gap: 14px; }
}

@media (min-width: 900px) {
  /* Sidebar becomes inline (not overlay) */
  .sidebar {
    position:  relative;
    top:       auto;
    left:      auto;
    bottom:    auto;
    transform: none !important;
    box-shadow: none !important;
  }
  .sb-collapse-btn { display: flex; }

  /* Desktop: topbar toggle acts as sidebar collapse toggle */
  .main { padding: 28px 28px 60px; }

  .stat-grid { grid-template-columns: repeat(4, 1fr); }

  .bottom-grid { grid-template-columns: 1fr 320px; }
}

@media (min-width: 1100px) {
  /* .main { padding: 32px 36px 64px; } */
}
</style>
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
</style>
</head>
<body>

<div id="toast"><div class="toast-dot"></div><span id="toast-msg">Copied!</span></div>

<!-- ════════════════════════════
     TOPBAR
════════════════════════════ -->
<div class="topbar">
  <!-- Toggle: hamburger on mobile, collapse on desktop -->
  <button class="sb-toggle" id="sb-toggle-btn" aria-label="Toggle sidebar">
    <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
      <path stroke-linecap="round" d="M4 6h16M4 12h16M4 18h16"/>
    </svg>
  </button>

  <div class="topbar-logo">
    <img src="/images/logo.svg" alt="InboxOro" class="logo-img"/>
  </div>
  <!-- Desktop-only collapse button — single control, no duplicate -->
  <!-- <button class="sb-collapse-btn" id="sb-collapse-btn" aria-label="Collapse sidebar">
    <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M15 19l-7-7 7-7"/></svg>
  </button> -->

  <div class="topbar-search">
    <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><path stroke-linecap="round" d="M21 21l-4.35-4.35"/></svg>
    <input type="text" placeholder="Search addresses, emails…"/>
  </div>

  <div class="topbar-right">
    <button class="tb-icon" aria-label="Notifications">
      <svg width="17" height="17" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
      <div class="notif-badge"></div>
    </button>

    <div style="position:relative;">
      <div class="tb-avatar" onclick="toggleUserDd()" id="tb-av">J
        <div class="user-dd" id="user-dd">
          <div class="dd-user-info">
            <div class="dd-user-name">John Doe</div>
            <div class="dd-user-email">john@example.com</div>
          </div>
          <div class="dd-item"><svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>Profile</div>
          <div class="dd-item"><svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><circle cx="12" cy="12" r="3"/></svg>Settings</div>
          <div class="dd-divider"></div>
          <div class="dd-item danger" onclick="location.href='login.html'"><svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>Sign Out</div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="shell">
  <div class="sb-backdrop" id="sb-backdrop" onclick="closeMobileSb()"></div>

   <!-- ════ SIDEBAR ════ -->
  <div class="sidebar" id="sidebar">

    <div class="sb-body" style="padding-top:16px;">

      <div class="sb-label">Main</div>

      <a class="sb-item active" href="#" data-tip="Overview">
        <div class="sb-item-icon">
          <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7" rx="1.5"/><rect x="14" y="3" width="7" height="7" rx="1.5"/><rect x="3" y="14" width="7" height="7" rx="1.5"/><rect x="14" y="14" width="7" height="7" rx="1.5"/></svg>
        </div>
        <span class="sb-item-label">Overview</span>
      </a>

      <a class="sb-item" href="{{url('inbox')}}" data-tip="Inbox">
        <div class="sb-item-icon">
          <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
        </div>
        <span class="sb-item-label">Inbox</span>
        <span class="sb-pill">3</span>
      </a>

      <a class="sb-item" href="#" data-tip="Addresses">
        <div class="sb-item-icon">
          <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/></svg>
        </div>
        <span class="sb-item-label">Addresses</span>
      </a>

      <a class="sb-item" href="#" data-tip="Domains">
        <div class="sb-item-icon">
          <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path stroke-linecap="round" d="M2 12h20M12 2a15.3 15.3 0 010 20M12 2a15.3 15.3 0 000 20"/></svg>
        </div>
        <span class="sb-item-label">Domains</span>
      </a>

      <div class="sb-divider"></div>
      <div class="sb-label">Account</div>

      <a class="sb-item" href="#" data-tip="Analytics">
        <div class="sb-item-icon">
          <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
        </div>
        <span class="sb-item-label">Analytics</span>
      </a>

      <a class="sb-item" href="#" data-tip="API Keys">
        <div class="sb-item-icon">
          <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/></svg>
        </div>
        <span class="sb-item-label">API Keys</span>
      </a>

      <a class="sb-item" href="#" data-tip="Settings">
        <div class="sb-item-icon">
          <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><circle cx="12" cy="12" r="3"/></svg>
        </div>
        <span class="sb-item-label">Settings</span>
      </a>

    </div><!-- /sb-body -->

    <!-- Sidebar footer: user -->
    <div class="sb-footer">
      <div class="sb-user">
        <div class="sb-user-av">J</div>
        <div class="sb-user-info">
          <div class="sb-user-name">John Doe</div>
          <div class="sb-user-plan">PRO Plan</div>
        </div>
      </div>
    </div>

  </div><!-- /sidebar -->

  <!-- MAIN -->
  <div class="main" id="main">

    <!-- Page header -->
   

    <div class="inbox-page-wrap shadow-xl">
      
      <!-- ── Active address bar ── -->
        <div class="addr-strip">
          <div>
              <div>
                <div class="page-title">INBOX</div>
              </div>
          </div>
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

      <!-- ── Domain tabs ── -->
      <div class="domain-strip" id="domain-strip">
        <button class="domain-tab active" onclick="switchDomain(this,'dropit.io')">@dropit.io</button>
        <button class="domain-tab" onclick="switchDomain(this,'burnbox.dev')">@burnbox.dev</button>
        <button class="domain-tab" onclick="switchDomain(this,'zaptmp.net')">@zaptmp.net</button>
        <button class="domain-tab" onclick="switchDomain(this,'voidmail.cc')">@voidmail.cc</button>
        <button class="domain-tab" onclick="switchDomain(this,'mailsink.app')">@mailsink.app</button>
      </div>

      <!-- ── Timer strip ── -->
      <div class="timer-strip">
        <span class="timer-strip-lbl">Expires in</span>
        <div class="timer-strip-track">
          <div class="timer-strip-fill" id="tbar" style="width:68%;"></div>
        </div>
        <span class="timer-strip-num" id="tnum">08:12</span>
        <div class="timer-strip-btns">
          <button class="timer-ctrl-btn" id="btn-extend" title="Add 10 minutes">
            <svg width="11" height="11" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M12 4v16m8-8H4"/></svg>
            +10m
          </button>
          <button class="timer-ctrl-btn" id="btn-pause" onclick="togglePauseInbox()" title="Pause timer">
            <svg id="icon-pause" width="11" height="11" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M10 9v6m4-6v6"/></svg>
            <svg id="icon-play" width="11" height="11" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" style="display:none;"><path stroke-linecap="round" d="M5 3l14 9-14 9V3z"/></svg>
            <span id="paused-badge" style="display:none;color:var(--Y);">PAUSED</span>
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
            <!-- Email rows rendered by JS or static demo -->
            <div class="erow unread selected" data-id="1" onclick="openMailDetail(1)">
              <div class="erow-left">
                <div class="erow-avatar" style="background:#4285F4;">G</div>
                <div class="udot-sm"></div>
              </div>
              <div class="erow-body">
                <div class="erow-top-row">
                  <span class="e-sender">Google</span>
                  <span class="e-time">2m ago</span>
                </div>
                <div class="e-subject">Verify your Google account</div>
                <div class="e-preview">Use OTP 847291 to confirm your sign-in…</div>
              </div>
            </div>

            <div class="erow unread" data-id="2" onclick="openMailDetail(2)">
              <div class="erow-left">
                <div class="erow-avatar" style="background:#7C3AED;">S</div>
                <div class="udot-sm"></div>
              </div>
              <div class="erow-body">
                <div class="erow-top-row">
                  <span class="e-sender">Shopify</span>
                  <span class="e-time">14m ago</span>
                </div>
                <div class="e-subject">Your OTP code is 382910</div>
                <div class="e-preview">Enter this code to complete your login…</div>
              </div>
            </div>

            <div class="erow unread" data-id="3" onclick="openMailDetail(3)">
              <div class="erow-left">
                <div class="erow-avatar" style="background:#10B981;">N</div>
                <div class="udot-sm"></div>
              </div>
              <div class="erow-body">
                <div class="erow-top-row">
                  <span class="e-sender">Notion</span>
                  <span class="e-time">38m ago</span>
                </div>
                <div class="e-subject">Confirm your Notion email</div>
                <div class="e-preview">Click the link below to confirm your email…</div>
              </div>
            </div>

            <div class="erow" data-id="4" onclick="openMailDetail(4)">
              <div class="erow-left">
                <div class="erow-avatar" style="background:#1DA1F2;">T</div>
                <div class="rdot-sm"></div>
              </div>
              <div class="erow-body">
                <div class="erow-top-row">
                  <span class="e-sender">Twitter</span>
                  <span class="e-time">1h ago</span>
                </div>
                <div class="e-subject">New login to your Twitter account</div>
                <div class="e-preview">A new device signed in from Chrome on…</div>
              </div>
            </div>

            <div class="erow" data-id="5" onclick="openMailDetail(5)">
              <div class="erow-left">
                <div class="erow-avatar" style="background:#F59E0B;">A</div>
                <div class="rdot-sm"></div>
              </div>
              <div class="erow-body">
                <div class="erow-top-row">
                  <span class="e-sender">Amazon</span>
                  <span class="e-time">2h ago</span>
                </div>
                <div class="e-subject">Your order has been confirmed</div>
                <div class="e-preview">Order #112-8827741 is confirmed and…</div>
              </div>
            </div>
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
  </div><!-- /main -->
</div><!-- /shell -->


<!-- //dashbaord js -->
<script>
/* ════════════════════════════
   SIDEBAR LOGIC
   - Mobile  : hamburger slides sidebar in as overlay
   - Desktop : collapse btn (topbar) collapses to icon rail
   - ONE button per action — no duplicates
════════════════════════════ */
const sidebar     = document.getElementById('sidebar');
const backdrop    = document.getElementById('sb-backdrop');
const toggleBtn   = document.getElementById('sb-toggle-btn');   // hamburger — mobile only
const collapseBtn = document.getElementById('sb-collapse-btn'); // chevron  — desktop only

let isMobile = () => window.innerWidth < 900;
let isCollapsed = false;

/* Hamburger: mobile overlay open/close */
toggleBtn.addEventListener('click', () => {
  if (isMobile()) {
    const open = sidebar.classList.toggle('mob-open');
    backdrop.classList.toggle('show', open);
  }else{
    collapseSidebar(!isCollapsed)
  }
});

/* Chevron: desktop collapse/expand */
// collapseBtn.addEventListener('click', () => collapseSidebar(!isCollapsed));

function collapseSidebar(collapse) {
  isCollapsed = collapse;
  sidebar.classList.toggle('collapsed', collapse);
  document.body.classList.toggle('sb-collapsed', collapse); // arrow flip via CSS
}

function closeMobileSb() {
  sidebar.classList.remove('mob-open');
  backdrop.classList.remove('show');
}

/* Close mobile sidebar when viewport widens */
window.addEventListener('resize', () => {
  if (!isMobile()) {
    sidebar.classList.remove('mob-open');
    backdrop.classList.remove('show');
  }
});

/* Close sidebar nav items on mobile after click */
document.querySelectorAll('.sb-item').forEach(item => {
  item.addEventListener('click', () => {
    if (isMobile()) closeMobileSb();
  });
});

/* ════════════════════════════
   USER DROPDOWN
════════════════════════════ */
function toggleUserDd() {
  document.getElementById('user-dd').classList.toggle('open');
}
document.addEventListener('click', e => {
  if (!e.target.closest('#tb-av')) {
    document.getElementById('user-dd').classList.remove('open');
  }
});

/* ════════════════════════════
   TOAST
════════════════════════════ */
function toast(msg) {
  document.getElementById('toast-msg').textContent = msg;
  const t = document.getElementById('toast');
  t.classList.add('show');
  setTimeout(() => t.classList.remove('show'), 2400);
}

/* ════════════════════════════
   GENERATOR
════════════════════════════ */
const DOMS = ['dropit.io', 'burnbox.dev', 'zaptmp.net', 'voidmail.cc', 'mailsink.app'];
const ADJ  = ['silent','ghost','turbo','vapor','swift','lunar','neon','flux','rogue','stealth'];
const NOU  = ['fox','wolf','tide','bolt','hawk','mint','storm','byte','nova','apex'];
let curDom = DOMS[0], curEmail = '', secs = 600, timerInt;

function renderDoms() {
  const c = document.getElementById('dom-tabs');
  DOMS.forEach((d, i) => {
    const b = document.createElement('button');
    b.className = 'dom-tab' + (i === 0 ? ' active' : '');
    b.textContent = '@' + d;
    b.onclick = () => {
      document.querySelectorAll('.dom-tab').forEach(x => x.classList.remove('active'));
      b.classList.add('active');
      curDom = d;
      generateNew();
    };
    c.appendChild(b);
  });
}

function generateNew() {
  const a = ADJ[Math.floor(Math.random() * ADJ.length)];
  const n = NOU[Math.floor(Math.random() * NOU.length)];
  const num = Math.floor(Math.random() * 9000) + 1000;
  curEmail = `${a}.${n}${num}@${curDom}`;
  const el = document.getElementById('gen-email');
  el.classList.add('fade');
  setTimeout(() => { el.textContent = curEmail; el.classList.remove('fade'); }, 220);
  /* restart timer bar */
  secs = 600;
  const bar = document.getElementById('tbar');
  bar.style.animation = 'none'; void bar.offsetWidth;
  bar.style.animation = 'shrink 600s linear forwards';
  /* spin icon */
  const ic = document.getElementById('spin-ic');
  ic.style.transition = 'transform .4s';
  ic.style.transform = 'rotate(360deg)';
  setTimeout(() => { ic.style.transition = 'none'; ic.style.transform = ''; }, 420);
}

function copyEmail() {
  if (!curEmail) return;
  navigator.clipboard.writeText(curEmail).catch(() => {});
  const btn = document.getElementById('copy-btn');
  btn.classList.add('done'); btn.textContent = 'Copied ✓';
  toast('Email address copied!');
  setTimeout(() => { btn.classList.remove('done'); btn.textContent = 'Copy'; }, 2200);
}

function startTimer() {
  clearInterval(timerInt);
  timerInt = setInterval(() => {
    if (secs > 0) secs--;
    const m = String(Math.floor(secs / 60)).padStart(2, '0');
    const s = String(secs % 60).padStart(2, '0');
    document.getElementById('tnum').textContent = `${m}:${s}`;
  }, 1000);
}

/* ════════════════════════════
   ADDRESSES
════════════════════════════ */
const ADDRS = [
  { email: 'ghost.wolf2847@dropit.io',       msgs: 7,  active: true  },
  { email: 'turbo.tide5512@burnbox.dev',     msgs: 2,  active: true  },
  { email: 'neon.apex3301@voidmail.cc',      msgs: 0,  active: true  },
  { email: 'silent.fox9341@dropit.io',       msgs: 14, active: false },
  { email: 'vapor.storm1192@zaptmp.net',     msgs: 3,  active: false },
  { email: 'lunar.byte4401@mailsink.app',    msgs: 1,  active: false },
];

function renderAddrs(filter = 'all') {
  const c = document.getElementById('addr-list');
  c.innerHTML = '';
  ADDRS
    .filter(a => filter === 'all' || (filter === 'active') === a.active)
    .forEach(a => {
      const row = document.createElement('div');
      row.className = 'addr-row';
      row.innerHTML = `
        <div class="addr-email">${a.email}</div>
        <div class="addr-msgs"><b>${a.msgs}</b> msgs</div>
        <span class="addr-badge ${a.active ? 'active' : 'expired'}">
          ${a.active ? '● Active' : '○ Expired'}
        </span>
        <div class="addr-actions">
          <button class="icon-btn" onclick="copyAddr('${a.email}')" title="Copy">
            <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><rect x="9" y="9" width="13" height="13" rx="2"/><path stroke-linecap="round" d="M5 15H4a2 2 0 01-2-2V4a2 2 0 012-2h9a2 2 0 012 2v1"/></svg>
          </button>
          <button class="icon-btn del" onclick="deleteAddr(this)" title="Delete">
            <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><polyline points="3 6 5 6 21 6"/><path stroke-linecap="round" d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6"/></svg>
          </button>
        </div>`;
      c.appendChild(row);
    });
}

function copyAddr(e) { navigator.clipboard.writeText(e).catch(() => {}); toast('Copied!'); }
function deleteAddr(btn) {
  const row = btn.closest('.addr-row');
  row.style.transition = 'opacity .25s, transform .25s';
  row.style.opacity = '0'; row.style.transform = 'translateX(12px)';
  setTimeout(() => row.remove(), 260);
  toast('Address deleted.');
}

function filterAddrs(el, f) {
  document.querySelectorAll('.tab-btn').forEach(t => t.classList.remove('active'));
  el.classList.add('active');
  renderAddrs(f);
}

/* ════════════════════════════
   CHART
════════════════════════════ */
const DAYS = ['Mon','Tue','Wed','Thu','Fri','Sat','Sun'];
const REC  = [18,32,14,45,28,52,39];
const READ = [12,24,10,38,20,44,31];

function renderChart() {
  const c = document.getElementById('chart');
  const x = document.getElementById('chart-x');
  const mx = Math.max(...REC);
  DAYS.forEach((d, i) => {
    const g = document.createElement('div'); g.className = 'bar-g';
    const b1 = document.createElement('div');
    b1.className = 'bar';
    b1.style.cssText = `height:${Math.round(REC[i]/mx*100)}%;background:var(--Y);`;
    b1.title = `${d}: ${REC[i]} received`;
    const b2 = document.createElement('div');
    b2.className = 'bar';
    b2.style.cssText = `height:${Math.round(READ[i]/mx*100)}%;background:var(--B);opacity:.7;`;
    b2.title = `${d}: ${READ[i]} read`;
    g.appendChild(b1); g.appendChild(b2); c.appendChild(g);
    const lbl = document.createElement('div'); lbl.className = 'chart-lbl'; lbl.textContent = d;
    x.appendChild(lbl);
  });
}

/* ════════════════════════════
   ACTIVITY
════════════════════════════ */
const ACTS = [
  { color:'y', msg:'New email from <strong>Google</strong> on ghost.wolf2847@dropit.io', time:'2 min ago' },
  { color:'g', msg:'Generated new address <strong>ghost.wolf2847@dropit.io</strong>',   time:'5 min ago' },
  { color:'y', msg:'OTP received from <strong>Shopify</strong> — code: 847291',          time:'12 min ago' },
  { color:'r', msg:'Address <strong>silent.fox9341@dropit.io</strong> expired',          time:'18 min ago' },
  { color:'b', msg:'Verification confirmed from <strong>Notion</strong>',                time:'35 min ago' },
  { color:'g', msg:'Generated <strong>turbo.tide5512@burnbox.dev</strong>',              time:'1 hr ago' },
];

function renderActivity() {
  const c = document.getElementById('activity');
  ACTS.forEach(a => {
    const item = document.createElement('div'); item.className = 'activity-item';
    item.innerHTML = `<div class="act-dot ${a.color}"></div><div class="act-body"><div class="act-msg">${a.msg}</div><div class="act-time">${a.time}</div></div>`;
    c.appendChild(item);
  });
}

/* ════════════════════════════
   REFRESH
════════════════════════════ */
function refreshPage() {
  const ic = document.getElementById('refresh-ic');
  ic.style.transition = 'transform .5s';
  ic.style.transform = 'rotate(360deg)';
  setTimeout(() => { ic.style.transition = 'none'; ic.style.transform = ''; }, 520);
  toast('Dashboard refreshed!');
}

/* ════════════════════════════
   INIT
════════════════════════════ */
renderDoms();
generateNew();
startTimer();
renderAddrs();
renderChart();
renderActivity();
</script>

<!-- //dashbaord js end -->

<script>
/* ══════════════════════════════════════════════════
   INBOX PAGE LOGIC
══════════════════════════════════════════════════ */

const EMAILS = [
  { id:1, sender:'Google',   email:'noreply@accounts.google.com', avatar:'G', color:'#4285F4', time:'2 min ago',  subject:'Verify your Google account',     body:'<p>Hi there,</p><p>We received a request to verify your Google Account email address.</p><p>Your verification code is:</p><div class="otp-box">847 291</div><p>This code expires in <strong>10 minutes</strong>. Do not share it with anyone.</p><hr style="border:none;border-top:1px solid var(--BD);margin:20px 0;"/><p style="font-size:.76rem;color:var(--MU2);">Google LLC, 1600 Amphitheatre Parkway, Mountain View, CA 94043</p>', unread:true  },
  { id:2, sender:'Shopify',  email:'noreply@shopify.com',         avatar:'S', color:'#7C3AED', time:'14 min ago', subject:'Your OTP code is 382910',          body:'<p>Hi,</p><p>Use the following OTP to complete your Shopify sign-in:</p><div class="otp-box">382 910</div><p>This code is valid for 15 minutes. If you did not request this, please ignore this email.</p>', unread:true  },
  { id:3, sender:'Notion',   email:'hello@mail.notion.so',        avatar:'N', color:'#10B981', time:'38 min ago', subject:'Confirm your Notion email',        body:'<p>Hey there,</p><p>Thanks for signing up for Notion. Please confirm your email address to get started.</p><a href="#" style="display:inline-block;background:#000;color:#fff;padding:10px 22px;border-radius:6px;font-size:.84rem;font-weight:600;margin:14px 0;text-decoration:none;">Confirm Email →</a><p style="font-size:.76rem;color:var(--MU2);">This link expires in 24 hours. If you didn\'t sign up, you can safely ignore this.</p>', unread:true  },
  { id:4, sender:'Twitter',  email:'info@twitter.com',            avatar:'T', color:'#1DA1F2', time:'1 hr ago',   subject:'New login to your Twitter account', body:'<p>Hi,</p><p>We noticed a new sign-in to your Twitter account from:</p><p><strong>Chrome on macOS</strong> · IP 192.168.1.1 · United States</p><p>If this was you, no action is needed. If not, please secure your account immediately.</p><a href="#" style="color:#1DA1F2;">Review account activity →</a>', unread:false },
  { id:5, sender:'Amazon',   email:'auto-confirm@amazon.com',     avatar:'A', color:'#F59E0B', time:'2 hrs ago',  subject:'Your order has been confirmed',     body:'<p>Hello,</p><p>Thank you for your order! Your order <strong>#112-8827741-1234567</strong> has been confirmed and is being prepared for shipment.</p><p>Estimated delivery: <strong>June 22–24, 2026</strong></p><a href="#" style="color:#F59E0B;">Track your order →</a>', unread:false },
];

let currentMailId = 1;
let timerSecs     = 492; // 8:12
let timerInt      = null;
let isPausedInbox = false;
let searchDelayInbox = null;

// ── Timer ──
function padInbox(n) { return String(n).padStart(2, '0'); }

function startTimerInbox() {
  clearInterval(timerInt);
  timerInt = setInterval(() => {
    if (isPausedInbox) return;
    if (timerSecs > 0) timerSecs--;
    else { clearInterval(timerInt); document.getElementById('edisplay').textContent = 'Address expired'; return; }
    updateTimerUI();
  }, 1000);
}

function updateTimerUI() {
  const m = padInbox(Math.floor(timerSecs / 60));
  const s = padInbox(timerSecs % 60);
  document.getElementById('tnum').textContent  = m + ':' + s;
  const pct = Math.min(100, (timerSecs / 600) * 100);
  document.getElementById('tbar').style.width  = pct + '%';
  // color warning
  document.getElementById('tbar').style.background = timerSecs < 120 ? 'var(--RED)' : 'var(--Y)';
}

function togglePauseInbox() {
  isPausedInbox = !isPausedInbox;
  document.getElementById('icon-pause').style.display = isPausedInbox ? 'none'   : 'inline';
  document.getElementById('icon-play').style.display  = isPausedInbox ? 'inline' : 'none';
  const badge = document.getElementById('paused-badge');
  if (badge) badge.style.display = isPausedInbox ? 'inline' : 'none';
  showToastInbox(isPausedInbox ? 'Timer paused' : 'Timer resumed');
}

// ── Generate new ──
function genNewInbox() {
  const DOMAINS = ['dropit.io','burnbox.dev','zaptmp.net','voidmail.cc','mailsink.app'];
  const ADJ     = ['silent','ghost','turbo','vapor','swift','lunar','neon','flux'];
  const NOU     = ['fox','wolf','tide','bolt','hawk','mint','storm','byte'];
  const dom = DOMAINS[0];
  const em  = ADJ[Math.floor(Math.random()*ADJ.length)] + '.' + NOU[Math.floor(Math.random()*NOU.length)] + Math.floor(Math.random()*9000+1000) + '@' + dom;
  const el  = document.getElementById('edisplay');
  el.style.opacity = '.3';
  setTimeout(() => { el.textContent = em; el.style.opacity = '1'; }, 220);
  timerSecs = 600; updateTimerUI();
  showToastInbox('New address generated');
  // Spin icon
  const ic = document.getElementById('new-spin');
  ic.style.transition = 'transform .4s'; ic.style.transform = 'rotate(360deg)';
  setTimeout(() => { ic.style.transition = 'none'; ic.style.transform = ''; }, 420);
}

// ── Domain switch ──
function switchDomain(btn, domain) {
  document.querySelectorAll('.domain-tab').forEach(b => b.classList.remove('active'));
  btn.classList.add('active');
  genNewInbox();
}

// ── Copy ──
function copyEmailInbox() {
  const txt = document.getElementById('edisplay').textContent;
  navigator.clipboard.writeText(txt).catch(() => {});
  const btn = document.getElementById('cbtn');
  btn.classList.add('ok'); btn.innerHTML = '✓ Copied';
  showToastInbox('Email address copied!');
  setTimeout(() => { btn.classList.remove('ok'); btn.innerHTML = '<svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><rect x=\\"9\\" y=\\"9\\" width=\\"13\\" height=\\"13\\" rx=\\"2\\"/><path stroke-linecap=\\"round\\" d=\\"M5 15H4a2 2 0 01-2-2V4a2 2 0 012-2h9a2 2 0 012 2v1\\"/></svg> Copy'; }, 2200);
}

// ── Open mail detail ──
function openMailDetail(id) {
  currentMailId = id;
  const em = EMAILS.find(e => e.id === id);
  if (!em) return;

  // Mark as read
  em.unread = false;
  const row = document.querySelector(`.erow[data-id="${id}"]`);
  if (row) {
    row.classList.remove('unread');
    const dot = row.querySelector('.udot-sm');
    if (dot) dot.className = 'rdot-sm';
  }

  // Select row
  document.querySelectorAll('.erow').forEach(r => r.classList.remove('selected'));
  if (row) row.classList.add('selected');

  // Populate detail
  document.getElementById('d-subject').textContent = em.subject;
  document.getElementById('d-avatar').textContent  = em.avatar;
  document.getElementById('d-avatar').style.background = em.color;
  document.getElementById('d-name').textContent    = em.sender;
  document.getElementById('d-email').innerHTML     = '&lt;' + em.email + '&gt;';
  document.getElementById('d-to').textContent      = document.getElementById('edisplay').textContent;
  document.getElementById('d-time').textContent    = em.time;
  document.getElementById('d-body').innerHTML      = em.body;

  // Show detail
  document.getElementById('detail-empty').style.display   = 'none';
  const dc = document.getElementById('detail-content');
  dc.style.display = 'flex';

  // Info col update
  document.querySelector('.inbox-info-col .info-stat:first-child .info-stat-val').textContent = em.sender;

  // Mobile: slide in
  document.getElementById('inbox-3col').classList.add('mob-detail');

  // Update unread badge
  const unread = EMAILS.filter(e => e.unread).length;
  const badge  = document.getElementById('ucnt');
  if (badge) badge.textContent = unread > 0 ? unread : '';
}

function closeMailDetail() {
  document.getElementById('inbox-3col').classList.remove('mob-detail');
}

function deleteCurrentMail() {
  const row = document.querySelector(`.erow[data-id="${currentMailId}"]`);
  if (row) { row.style.opacity = '0'; row.style.transform = 'translateX(12px)'; row.style.transition = 'all .25s'; setTimeout(() => row.remove(), 260); }
  document.getElementById('detail-empty').style.display = 'flex';
  document.getElementById('detail-content').style.display = 'none';
  document.getElementById('inbox-3col').classList.remove('mob-detail');
  showToastInbox('Message deleted');
}

function markUnreadCurrent() {
  const em  = EMAILS.find(e => e.id === currentMailId);
  if (!em) return;
  em.unread = true;
  const row = document.querySelector(`.erow[data-id="${currentMailId}"]`);
  if (row) {
    row.classList.add('unread');
    const dot = row.querySelector('.rdot-sm');
    if (dot) dot.className = 'udot-sm';
  }
  showToastInbox('Marked as unread');
}

function markAllReadInbox() {
  EMAILS.forEach(e => e.unread = false);
  document.querySelectorAll('.erow.unread').forEach(r => {
    r.classList.remove('unread');
    const dot = r.querySelector('.udot-sm'); if (dot) dot.className = 'rdot-sm';
  });
  document.getElementById('ucnt').textContent = '';
  showToastInbox('All messages marked as read');
}

function deleteAllInbox() {
  if (!confirm('Delete all messages?')) return;
  document.getElementById('email-list').innerHTML = '<div class="no-mail"><svg width="40" height="40" fill="none" viewBox="0 0 24 24" stroke="#FACC15" stroke-width="1"><path stroke-linecap=\\"round\\" d=\\"M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z\\"/></svg><p>No messages yet</p></div>';
  document.getElementById('detail-empty').style.display = 'flex';
  document.getElementById('detail-content').style.display = 'none';
  document.getElementById('ucnt').textContent = '';
  document.getElementById('inbox-3col').classList.remove('mob-detail');
  showToastInbox('All messages deleted');
}

function refreshInboxList() {
  showToastInbox('Inbox refreshed');
}

function switchTab(btn, tab) {
  document.querySelectorAll('.list-tab').forEach(b => b.classList.remove('active'));
  btn.classList.add('active');
}

function debounceSearchInbox(val) {
  clearTimeout(searchDelayInbox);
  searchDelayInbox = setTimeout(() => {
    const rows = document.querySelectorAll('.erow');
    rows.forEach(r => {
      const txt = r.textContent.toLowerCase();
      r.style.display = txt.includes(val.toLowerCase()) ? '' : 'none';
    });
  }, 300);
}

// ── Sidebar logic (reused from dashboard) ──
const sidebar     = document.getElementById('sidebar');
const backdrop    = document.getElementById('sb-backdrop');
const toggleBtn   = document.getElementById('sb-toggle-btn');
const collapseBtn = document.getElementById('sb-collapse-btn');

let mobSbOpen   = false;
let isCollapsed = false;
const isMob     = () => window.innerWidth < 900;

if (toggleBtn) toggleBtn.addEventListener('click', () => {
  if (isMob()) {
    mobSbOpen = !mobSbOpen;
    sidebar.classList.toggle('mob-open', mobSbOpen);
    backdrop.classList.toggle('show', mobSbOpen);
  } else { collapseSidebar(!isCollapsed); }
});
if (collapseBtn) collapseBtn.addEventListener('click', () => collapseSidebar(!isCollapsed));

function collapseSidebar(c) {
  isCollapsed = c;
  sidebar.classList.toggle('collapsed', c);
  document.body.classList.toggle('sb-collapsed', c);
}
function closeMobileSb() {
  sidebar.classList.remove('mob-open');
  backdrop.classList.remove('show');
  mobSbOpen = false;
}
window.addEventListener('resize', () => { if (!isMob()) closeMobileSb(); });

// ── Toast ──
function showToastInbox(msg) {
  const t = document.getElementById('toast');
  const s = t.querySelector('span'); if (s) s.textContent = msg;
  t.classList.add('show');
  setTimeout(() => t.classList.remove('show'), 2500);
}

// ── User dropdown ──
function toggleUserDd() {
  document.getElementById('user-dd').classList.toggle('open');
}
document.addEventListener('click', e => {
  if (!e.target.closest('#tb-av')) document.getElementById('user-dd').classList.remove('open');
});

// Boot timer
startTimerInbox();

// Open first email on desktop
if (window.innerWidth >= 900) openMailDetail(1);
</script>
</body>
</html>