<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>InboxOro — Addresses</title>
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
.addr-stats {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 12px;
  margin-bottom: 20px;
}
@media (min-width:640px) { .addr-stats { grid-template-columns: repeat(4, 1fr); } }

.addr-stat-card {
  background:    var(--SURF);
  border:        1px solid var(--BD);
  border-radius: 12px;
  padding:       16px;
  position:      relative;
  overflow:      hidden;
  transition:    box-shadow .15s, transform .12s;
}
.addr-stat-card:hover { box-shadow: 0 4px 16px rgba(0,0,0,.06); transform: translateY(-1px); }
.addr-stat-card::before {
  content: '';
  position: absolute;
  top: 0; left: 0; right: 0;
  height: 3px;
  border-radius: 12px 12px 0 0;
}
.addr-stat-card.yellow::before { background: var(--Y); }
.addr-stat-card.green::before  { background: var(--GREEN); }
.addr-stat-card.blue::before   { background: var(--B); }
.addr-stat-card.red::before    { background: var(--RED); }

.asc-icon {
  width: 36px; height: 36px; border-radius: 9px;
  display: flex; align-items: center; justify-content: center;
  margin-bottom: 10px;
}
.asc-icon.yellow { background: rgba(250,204,21,.15); color: #92400E; }
.asc-icon.green  { background: rgba(16,185,129,.12);  color: var(--GREEN); }
.asc-icon.blue   { background: rgba(59,130,246,.12);  color: var(--B); }
.asc-icon.red    { background: rgba(239,68,68,.10);   color: var(--RED); }

.asc-val { font-family: var(--DISP); font-size: 2rem; color: var(--INK); line-height: 1; }
.asc-lbl { font-size: .74rem; color: var(--MU); font-weight: 500; margin-top: 3px; }
.asc-trend {
  display: inline-flex; align-items: center; gap: 3px;
  font-family: var(--MONO); font-size: .6rem; font-weight: 700;
  margin-top: 4px;
}
.asc-trend.up   { color: var(--GREEN); }
.asc-trend.down { color: var(--RED); }

/* ── Generate card ── */
.gen-card {
  background: var(--SURF);
  border: 1px solid var(--BD);
  border-radius: 12px;
  overflow: hidden;
  margin-bottom: 20px;
}
.gen-card-hd {
  display: flex; align-items: center; justify-content: space-between;
  padding: 14px 18px; border-bottom: 1px solid var(--BD2);
  flex-wrap: wrap; gap: 8px;
}
.gen-card-title { font-weight: 700; font-size: .9rem; color: var(--INK); }
.gen-card-body  { padding: 16px 18px; }

.gen-row {
  display: flex; align-items: center; gap: 10px;
  background: var(--BG); border: 1px solid var(--BD);
  border-radius: 10px; padding: 12px 14px; margin-bottom: 12px;
}
.gen-email-txt {
  font-family: var(--MONO); font-size: clamp(.72rem,2.5vw,.92rem);
  font-weight: 700; color: var(--INK); flex: 1; min-width: 0;
  overflow: hidden; text-overflow: ellipsis; white-space: nowrap;
}
.gen-copy-btn {
  background: var(--Y); color: var(--INK); font-size: .76rem;
  font-weight: 700; padding: 8px 16px; border-radius: 7px;
  flex-shrink: 0; white-space: nowrap;
  transition: background .15s, transform .1s;
}
.gen-copy-btn:hover { background: #EAB800; transform: translateY(-1px); }
.gen-copy-btn.ok    { background: var(--GREEN); color: #fff; }

.gen-new-btn {
  background: var(--SURF); color: var(--MU); font-size: .76rem;
  font-weight: 600; padding: 8px 12px; border-radius: 7px;
  border: 1px solid var(--BD); flex-shrink: 0;
  display: flex; align-items: center; gap: 5px;
  transition: background .12s, color .12s;
}
.gen-new-btn:hover { background: var(--BD2); color: var(--INK); }

/* ── Domain pill tabs ── */
.dom-tabs {
  display: flex; gap: 6px; flex-wrap: wrap; margin-bottom: 14px;
}
.dom-pill {
  font-family: var(--MONO); font-size: .65rem; font-weight: 600;
  padding: 6px 12px; border-radius: 20px;
  border: 1px solid var(--BD); background: var(--SURF); color: var(--MU);
  cursor: pointer; white-space: nowrap; flex-shrink: 0;
  transition: background .12s, color .12s, border-color .12s;
}
.dom-pill:hover  { background: var(--BD2); color: var(--INK); border-color: #D1D5DB; }
.dom-pill.active { background: var(--INK); color: var(--Y); border-color: var(--INK); }

/* Timer row */
.timer-row {
  display: flex; align-items: center; gap: 10px;
  flex-wrap: wrap;
}
.timer-lbl   { font-size: .72rem; color: var(--MU); white-space: nowrap; }
.timer-track { flex: 1; min-width: 80px; max-width: 180px; height: 4px; background: var(--BD2); border-radius: 2px; overflow: hidden; }
.timer-fill  { height: 100%; background: var(--Y); border-radius: 2px; transition: width .9s linear; }
.timer-count { font-family: var(--MONO); font-size: .72rem; font-weight: 700; color: var(--INK); white-space: nowrap; min-width: 38px; }
.timer-ctrl  {
  display: flex; align-items: center; gap: 4px;
  font-family: var(--MONO); font-size: .62rem; font-weight: 700;
  padding: 5px 10px; border-radius: 6px; border: 1px solid var(--BD);
  background: var(--SURF); color: var(--INK); cursor: pointer;
  transition: background .12s, border-color .12s, color .12s;
}
.timer-ctrl:hover { background: var(--INK); border-color: var(--INK); color: var(--Y); }

/* ── Toolbar / filter row ── */
.tbar {
  display: flex; align-items: center; gap: 10px;
  padding: 14px 18px; border-bottom: 1px solid var(--BD2);
  flex-wrap: wrap; gap: 8px;
}
.tbar-search {
  display: flex; align-items: center; gap: 8px;
  background: var(--BG); border: 1px solid var(--BD);
  border-radius: 8px; padding: 0 12px; height: 36px;
  flex: 1; min-width: 160px; max-width: 280px;
}
.tbar-search input {
  border: none; outline: none; background: transparent;
  font-family: var(--BODY); font-size: 15px; color: var(--INK); flex: 1;
}
.tbar-search input::placeholder { color: var(--MU2); }
.tbar-search svg { color: var(--MU2); flex-shrink: 0; }

.tbar-select {
  height: 36px; border: 1px solid var(--BD); border-radius: 8px;
  padding: 0 12px; font-family: var(--BODY); font-size: .8rem;
  color: var(--INK); background: var(--SURF); outline: none; cursor: pointer;
  transition: border-color .15s;
}
.tbar-select:focus { border-color: var(--Y); }

.tbar-right { margin-left: auto; display: flex; gap: 6px; align-items: center; }

/* ── Tab row ── */
.tab-row  { display: flex; border-bottom: 1px solid var(--BD2); padding: 0 10px; gap: 2px; flex-shrink: 0; }
.tab-btn  {
  font-family: var(--MONO); font-size: .6rem; font-weight: 700;
  letter-spacing: .06em; text-transform: uppercase;
  padding: 8px 12px; color: var(--MU);
  border-bottom: 2px solid transparent; margin-bottom: -1px;
  cursor: pointer; background: none;
  border-top: none; border-left: none; border-right: none;
  transition: color .15s, border-color .15s;
}
.tab-btn:hover  { color: var(--INK); }
.tab-btn.active { color: var(--INK); border-bottom-color: var(--Y); }
.tab-count {
  display: inline-flex; align-items: center; justify-content: center;
  background: var(--BD2); color: var(--MU); font-size: .52rem;
  font-weight: 800; padding: 1px 6px; border-radius: 10px;
  margin-left: 4px;
}
.tab-btn.active .tab-count { background: var(--INK); color: var(--Y); }

/* ── Address table ── */
.addr-table { width: 100%; border-collapse: collapse; }
.addr-table thead tr { border-bottom: 1px solid var(--BD2); }
.addr-table thead th {
  padding: 10px 16px; text-align: left;
  font-family: var(--MONO); font-size: .58rem; font-weight: 700;
  letter-spacing: .1em; text-transform: uppercase; color: var(--MU2);
  white-space: nowrap; cursor: pointer; user-select: none;
}
.addr-table thead th:hover { color: var(--INK); }
.addr-table thead th .sort-ic { display: inline; margin-left: 3px; opacity: .4; }
.addr-table thead th.asc  .sort-ic,
.addr-table thead th.desc .sort-ic { opacity: 1; color: var(--Y); }

.addr-table tbody tr {
  border-bottom: 1px solid var(--BD2);
  transition: background .1s;
}
.addr-table tbody tr:last-child { border-bottom: none; }
.addr-table tbody tr:hover      { background: var(--BD2); }

.addr-table tbody td { padding: 12px 16px; vertical-align: middle; }

.addr-email-cell {
  display: flex; align-items: center; gap: 10px; min-width: 0;
}
.addr-avatar {
  width: 30px; height: 30px; border-radius: 8px;
  background: var(--INK); color: var(--Y);
  display: flex; align-items: center; justify-content: center;
  font-family: var(--MONO); font-size: .62rem; font-weight: 800;
  flex-shrink: 0; letter-spacing: .04em;
}
.addr-email-txt {
  font-family: var(--MONO); font-size: .76rem; font-weight: 600;
  color: var(--INK); overflow: hidden; text-overflow: ellipsis;
  white-space: nowrap; max-width: 240px;
}
.addr-email-sub {
  font-size: .7rem; color: var(--MU); margin-top: 1px;
  white-space: nowrap;
}

/* Status badges */
.badge {
  display: inline-flex; align-items: center; gap: 4px;
  font-family: var(--MONO); font-size: .58rem; font-weight: 700;
  padding: 3px 9px; border-radius: 20px; white-space: nowrap;
}
.badge .bdot { width: 5px; height: 5px; border-radius: 50%; background: currentColor; }
.badge-active  { background: rgba(16,185,129,.1);  color: var(--GREEN); }
.badge-expired { background: var(--BD2);            color: var(--MU); }
.badge-paused  { background: rgba(245,158,11,.12);  color: #92400E; }

/* Expiry progress mini bar */
.expiry-bar {
  width: 80px; height: 4px; background: var(--BD2);
  border-radius: 2px; overflow: hidden; flex-shrink: 0;
}
.expiry-fill { height: 100%; border-radius: 2px; }

/* Message count pill */
.msg-count {
  display: inline-flex; align-items: center; justify-content: center;
  min-width: 26px; height: 20px; padding: 0 6px;
  background: var(--BD2); color: var(--INK);
  font-family: var(--MONO); font-size: .58rem; font-weight: 700;
  border-radius: 10px;
}
.msg-count.has { background: rgba(250,204,21,.15); color: var(--INK); }

/* Row action buttons */
.row-actions { display: flex; gap: 4px; align-items: center; }
.row-btn {
  width: 30px; height: 30px;
  display: flex; align-items: center; justify-content: center;
  border-radius: 7px; border: 1px solid var(--BD);
  background: var(--SURF); color: var(--MU);
  cursor: pointer; flex-shrink: 0;
  transition: background .12s, color .12s, border-color .12s;
}
.row-btn:hover            { background: var(--BD2); color: var(--INK); border-color: #D1D5DB; }
.row-btn.copy:hover       { background: rgba(250,204,21,.1); color: var(--INK); border-color: rgba(250,204,21,.4); }
.row-btn.view:hover       { background: rgba(59,130,246,.08); color: var(--B); border-color: rgba(59,130,246,.3); }
.row-btn.extend:hover     { background: rgba(16,185,129,.08); color: var(--GREEN); border-color: rgba(16,185,129,.3); }
.row-btn.del:hover        { background: rgba(239,68,68,.08);  color: var(--RED); border-color: rgba(239,68,68,.3); }

/* ── Bulk actions bar ── */
.bulk-bar {
  display: none; align-items: center; gap: 10px;
  padding: 10px 18px; background: rgba(250,204,21,.08);
  border-bottom: 1px solid rgba(250,204,21,.2);
  flex-wrap: wrap;
}
.bulk-bar.show { display: flex; }
.bulk-bar-txt { font-size: .82rem; font-weight: 600; color: var(--INK); flex: 1; }
.bulk-btn {
  display: flex; align-items: center; gap: 5px;
  font-size: .76rem; font-weight: 600; padding: 6px 12px;
  border-radius: 7px; border: 1px solid var(--BD);
  background: var(--SURF); color: var(--INK); cursor: pointer;
  transition: background .12s;
}
.bulk-btn:hover     { background: var(--BD2); }
.bulk-btn.del-btn   { color: var(--RED); border-color: rgba(239,68,68,.3); }
.bulk-btn.del-btn:hover { background: rgba(239,68,68,.08); }

/* ── Empty state ── */
.empty-state {
  display: flex; flex-direction: column; align-items: center;
  justify-content: center; padding: 60px 20px; gap: 14px;
  text-align: center;
}
.empty-icon {
  width: 60px; height: 60px; background: var(--BD2);
  border-radius: 14px; display: flex; align-items: center;
  justify-content: center; color: var(--MU2);
}
.empty-title { font-family: var(--DISP); font-size: 1.3rem; letter-spacing: .03em; color: var(--INK); }
.empty-sub   { font-size: .82rem; color: var(--MU); max-width: 280px; line-height: 1.6; }

/* ── Pagination ── */
.pagination {
  display: flex; align-items: center; justify-content: space-between;
  padding: 12px 18px; border-top: 1px solid var(--BD2); flex-wrap: wrap; gap: 8px;
}
.pg-info { font-family: var(--MONO); font-size: .62rem; color: var(--MU); }
.pg-btns { display: flex; gap: 4px; }
.pg-btn  {
  display: flex; align-items: center; justify-content: center;
  min-width: 32px; height: 32px; padding: 0 8px;
  border: 1px solid var(--BD); border-radius: 7px;
  background: var(--SURF); font-family: var(--MONO);
  font-size: .68rem; font-weight: 700; color: var(--MU);
  cursor: pointer; transition: background .12s, border-color .12s, color .12s;
}
.pg-btn:hover  { border-color: var(--INK); color: var(--INK); }
.pg-btn.active { background: var(--INK); border-color: var(--INK); color: var(--Y); }
.pg-btn:disabled { opacity: .35; cursor: not-allowed; }

/* ── Slide-in detail drawer (right) ── */
.addr-drawer {
  position: fixed; inset: 0; z-index: 400;
  display: none;
}
.addr-drawer.open { display: flex; }

.drawer-backdrop {
  position: absolute; inset: 0;
  background: rgba(0,0,0,.4);
  backdrop-filter: blur(2px);
}
.drawer-panel {
  position: absolute; top: 0; right: 0; bottom: 0;
  width: min(480px, 100vw);
  background: var(--SURF);
  border-left: 1px solid var(--BD);
  display: flex; flex-direction: column;
  box-shadow: -8px 0 32px rgba(0,0,0,.12);
  animation: slide-from-right .22s cubic-bezier(.4,0,.2,1) both;
}
@keyframes slide-from-right {
  from { transform: translateX(20px); opacity: 0; }
  to   { transform: translateX(0);    opacity: 1; }
}
.drawer-hd {
  display: flex; align-items: center; justify-content: space-between;
  padding: 16px 20px; border-bottom: 1px solid var(--BD); flex-shrink: 0;
}
.drawer-title { font-family: var(--DISP); font-size: 1.2rem; letter-spacing: .03em; color: var(--INK); }
.drawer-close {
  width: 32px; height: 32px; display: flex; align-items: center;
  justify-content: center; border-radius: 8px; border: 1px solid var(--BD);
  background: var(--SURF); color: var(--MU); cursor: pointer;
  transition: background .12s, color .12s;
}
.drawer-close:hover { background: var(--BD2); color: var(--INK); }

.drawer-body { flex: 1; overflow-y: auto; padding: 20px; }
.drawer-body::-webkit-scrollbar { width: 4px; }
.drawer-body::-webkit-scrollbar-thumb { background: var(--BD); border-radius: 2px; }

.drawer-section       { margin-bottom: 22px; }
.drawer-section-title {
  font-family: var(--MONO); font-size: .6rem; font-weight: 700;
  letter-spacing: .1em; text-transform: uppercase; color: var(--MU2);
  margin-bottom: 10px; display: flex; align-items: center; gap: 8px;
}
.drawer-section-title::after { content: ''; flex: 1; height: 1px; background: var(--BD); }

.drawer-field { margin-bottom: 14px; }
.drawer-field-lbl {
  font-family: var(--MONO); font-size: .6rem; font-weight: 700;
  letter-spacing: .08em; text-transform: uppercase; color: var(--MU);
  margin-bottom: 5px; display: block;
}
.drawer-field-val {
  font-size: .84rem; color: var(--INK); font-weight: 500;
}
.drawer-field-mono {
  font-family: var(--MONO); font-size: .78rem; color: var(--INK);
  background: var(--BD2); padding: 8px 12px; border-radius: 7px;
  word-break: break-all; display: flex; align-items: center;
  justify-content: space-between; gap: 8px;
}

.drawer-msg-row {
  display: flex; align-items: flex-start; gap: 10px;
  padding: 10px 0; border-bottom: 1px solid var(--BD2);
}
.drawer-msg-row:last-child { border-bottom: none; }
.drawer-msg-av {
  width: 30px; height: 30px; border-radius: 50%;
  display: flex; align-items: center; justify-content: center;
  font-family: var(--DISP); font-size: .9rem; color: #fff;
  flex-shrink: 0;
}
.drawer-msg-body { flex: 1; min-width: 0; }
.drawer-msg-sender  { font-size: .8rem; font-weight: 600; color: var(--INK); white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
.drawer-msg-subject { font-size: .74rem; color: var(--MU); white-space: nowrap; overflow: hidden; text-overflow: ellipsis; margin-top: 2px; }
.drawer-msg-time    { font-family: var(--MONO); font-size: .6rem; color: var(--MU2); flex-shrink: 0; }

.drawer-footer {
  padding: 14px 20px; border-top: 1px solid var(--BD);
  display: flex; gap: 8px; flex-shrink: 0; flex-wrap: wrap;
}

/* ── Generate modal ── */
.modal-overlay {
  position: fixed; inset: 0; z-index: 500;
  background: rgba(0,0,0,.5); backdrop-filter: blur(3px);
  display: none; align-items: center; justify-content: center;
  padding: 20px;
}
.modal-overlay.open { display: flex; animation: fade-in .2s ease both; }
@keyframes fade-in { from{opacity:0} to{opacity:1} }

.modal-box {
  background: var(--SURF); border-radius: 14px;
  border: 1px solid var(--BD); width: 100%; max-width: 460px;
  box-shadow: 0 20px 60px rgba(0,0,0,.2);
  overflow: hidden;
  animation: modal-in .22s cubic-bezier(.34,1.56,.64,1) both;
}
@keyframes modal-in { from{transform:scale(.95);opacity:0} to{transform:scale(1);opacity:1} }

.modal-hd {
  display: flex; align-items: center; justify-content: space-between;
  padding: 18px 20px; border-bottom: 1px solid var(--BD2);
}
.modal-title { font-family: var(--DISP); font-size: 1.2rem; letter-spacing: .03em; color: var(--INK); }
.modal-close {
  width: 32px; height: 32px; display: flex; align-items: center;
  justify-content: center; border-radius: 8px; border: 1px solid var(--BD);
  background: transparent; color: var(--MU); cursor: pointer;
  transition: background .12s, color .12s;
}
.modal-close:hover { background: var(--BD2); color: var(--INK); }

.modal-body { padding: 20px; }

.modal-field { margin-bottom: 16px; }
.modal-field label {
  display: block; font-family: var(--MONO); font-size: .62rem;
  font-weight: 700; letter-spacing: .08em; text-transform: uppercase;
  color: var(--MU); margin-bottom: 6px;
}
.modal-field select,
.modal-field input {
  width: 100%; padding: 10px 14px;
  border: 1px solid var(--BD); border-radius: 8px;
  font-family: var(--BODY); font-size: .84rem; color: var(--INK);
  background: var(--SURF); outline: none;
  transition: border-color .15s, box-shadow .15s;
}
.modal-field select:focus,
.modal-field input:focus {
  border-color: var(--Y); box-shadow: 0 0 0 3px rgba(250,204,21,.15);
}
.modal-preview {
  background: var(--BG); border: 1px solid var(--BD);
  border-radius: 8px; padding: 10px 14px; margin-top: 8px;
  font-family: var(--MONO); font-size: .78rem; color: var(--INK);
  font-weight: 600; display: flex; align-items: center; gap: 8px;
}
.modal-preview-dot { width: 6px; height: 6px; background: var(--GREEN); border-radius: 50%; animation: pulse-green 1.5s ease-in-out infinite; flex-shrink: 0; }
@keyframes pulse-green { 0%,100%{opacity:1;transform:scale(1)} 50%{opacity:.4;transform:scale(.7)} }

.modal-footer {
  padding: 14px 20px; border-top: 1px solid var(--BD2);
  display: flex; gap: 8px; justify-content: flex-end;
}

/* ── Toast ── */
#toast {
  position: fixed; bottom: 20px; right: 16px;
  background: var(--INK); color: #fff;
  font-family: var(--MONO); font-size: .74rem; font-weight: 600;
  padding: 10px 16px; border-radius: 8px;
  box-shadow: 0 4px 20px rgba(0,0,0,.2);
  z-index: 999; display: flex; align-items: center; gap: 7px;
  transform: translateY(70px); opacity: 0;
  transition: transform .3s cubic-bezier(.34,1.56,.64,1), opacity .25s;
}
#toast.show { transform: translateY(0); opacity: 1; }
.toast-dot { width: 7px; height: 7px; background: var(--GREEN); border-radius: 50%; }

/* ── Responsive ── */
.addr-table .col-domain,
.addr-table .col-created,
.addr-table .col-expiry  { display: none; }

@media (min-width: 640px)  { .addr-table .col-domain  { display: table-cell; } }
@media (min-width: 800px)  { .addr-table .col-created { display: table-cell; } }
@media (min-width: 1000px) { .addr-table .col-expiry  { display: table-cell; } }
</style>
</head>
<body>

<div id="toast"><div class="toast-dot"></div><span id="toast-msg">Done</span></div>

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

<!-- ═══ ADDRESS DRAWER ═══ -->
<div class="addr-drawer" id="addr-drawer">
  <div class="drawer-backdrop" onclick="closeDrawer()"></div>
  <div class="drawer-panel">
    <div class="drawer-hd">
      <div class="drawer-title" id="drawer-title">Address Details</div>
      <button class="drawer-close" onclick="closeDrawer()">
        <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M6 18L18 6M6 6l12 12"/></svg>
      </button>
    </div>
    <div class="drawer-body" id="drawer-body">
      <!-- populated by JS -->
    </div>
    <div class="drawer-footer" id="drawer-footer">
      <!-- populated by JS -->
    </div>
  </div>
</div>

<!-- ═══ GENERATE MODAL ═══ -->
<div class="modal-overlay" id="gen-modal">
  <div class="modal-box">
    <div class="modal-hd">
      <div class="modal-title">Generate New Address</div>
      <button class="modal-close" onclick="closeGenModal()">
        <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M6 18L18 6M6 6l12 12"/></svg>
      </button>
    </div>
    <div class="modal-body">
      <div class="modal-field">
        <label>Domain</label>
        <select id="modal-domain" onchange="updateModalPreview()">
          <option value="dropit.io">@dropit.io</option>
          <option value="burnbox.dev">@burnbox.dev</option>
          <option value="zaptmp.net">@zaptmp.net</option>
          <option value="voidmail.cc">@voidmail.cc</option>
          <option value="mailsink.app">@mailsink.app</option>
        </select>
      </div>
      <div class="modal-field">
        <label>Custom Prefix <span style="color:var(--MU);font-weight:400;text-transform:none;letter-spacing:0;">(optional — leave blank to auto-generate)</span></label>
        <input type="text" id="modal-prefix" placeholder="e.g. mytest2024" oninput="updateModalPreview()" maxlength="30"/>
      </div>
      <div class="modal-field">
        <label>Expiry Duration</label>
        <select id="modal-expiry">
          <option value="10">10 minutes</option>
          <option value="30" selected>30 minutes</option>
          <option value="60">1 hour</option>
          <option value="1440">24 hours (Pro)</option>
        </select>
      </div>
      <div>
        <label style="font-family:var(--MONO);font-size:.62rem;font-weight:700;letter-spacing:.08em;text-transform:uppercase;color:var(--MU);display:block;margin-bottom:6px;">Preview</label>
        <div class="modal-preview">
          <div class="modal-preview-dot"></div>
          <span id="modal-preview-txt">ghost.wolf2847@dropit.io</span>
        </div>
      </div>
    </div>
    <div class="modal-footer">
      <button class="btn-ghost" onclick="closeGenModal()">Cancel</button>
      <button class="btn-primary yellow" onclick="doGenerate()">
        <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M12 4v16m8-8H4"/></svg>
        Generate
      </button>
    </div>
  </div>
</div>

<div class="shell">
  <div class="sb-backdrop" id="sb-backdrop" onclick="closeMobileSb()"></div>

  <!-- SIDEBAR -->
   <!-- ════ SIDEBAR ════ -->
  <div class="sidebar" id="sidebar">

    <div class="sb-body" style="padding-top:16px;">

      <div class="sb-label">Main</div>

      <a class="sb-item active" href="{url('sounak')}" data-tip="Overview">
        <div class="sb-item-icon">
          <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7" rx="1.5"/><rect x="14" y="3" width="7" height="7" rx="1.5"/><rect x="3" y="14" width="7" height="7" rx="1.5"/><rect x="14" y="14" width="7" height="7" rx="1.5"/></svg>
        </div>
        <span class="sb-item-label">Overview</span>
      </a>

      <a class="sb-item" href="{url('inbox-sounak')}" data-tip="Inbox">
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

    <!-- ── Page header ── -->
    <div class="page-hd">
      <div>
        <div class="page-title">Addresses</div>
        <div class="page-subtitle" id="page-subtitle">47 total · 3 active · 1.2K spam blocked</div>
      </div>
      <div style="display:flex;gap:8px;align-items:center;flex-wrap:wrap;">
        <button class="btn-ghost" onclick="refreshPage()">
          <svg id="refresh-ic" width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
          Refresh
        </button>
        <button class="btn-primary yellow" onclick="openGenModal()">
          <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M12 4v16m8-8H4"/></svg>
          New Address
        </button>
      </div>
    </div>

    <!-- ── Stat cards ── -->
    <div class="addr-stats">
      <div class="addr-stat-card yellow">
        <div class="asc-icon yellow">
          <svg width="17" height="17" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/></svg>
        </div>
        <div class="asc-val" id="stat-total">47</div>
        <div class="asc-lbl">Total Addresses</div>
        <div class="asc-trend up">↑ 12% this week</div>
      </div>
      <div class="addr-stat-card green">
        <div class="asc-icon green">
          <svg width="17" height="17" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path stroke-linecap="round" d="M12 8v4l3 3"/></svg>
        </div>
        <div class="asc-val" id="stat-active">3</div>
        <div class="asc-lbl">Active Now</div>
        <div class="asc-trend up" style="display:flex;align-items:center;gap:4px;">
          <div style="width:6px;height:6px;background:var(--GREEN);border-radius:50%;animation:pulse-green 1.5s ease-in-out infinite;"></div>
          Live
        </div>
      </div>
      <div class="addr-stat-card blue">
        <div class="asc-icon blue">
          <svg width="17" height="17" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
        </div>
        <div class="asc-val">238</div>
        <div class="asc-lbl">Emails Received</div>
        <div class="asc-trend up">↑ 8% vs last week</div>
      </div>
      <div class="addr-stat-card red">
        <div class="asc-icon red">
          <svg width="17" height="17" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
        </div>
        <div class="asc-val">1.2K</div>
        <div class="asc-lbl">Spam Blocked</div>
        <div class="asc-trend up">↑ 34%</div>
      </div>
    </div>

    <!-- ── Quick generate strip ── -->
    <div class="gen-card">
      <div class="gen-card-hd">
        <div class="gen-card-title">Quick Generate</div>
        <div style="display:flex;align-items:center;gap:6px;">
          <div style="width:7px;height:7px;background:var(--GREEN);border-radius:50%;animation:pulse-green 2s ease-in-out infinite;"></div>
          <span style="font-family:var(--MONO);font-size:.62rem;font-weight:600;color:var(--GREEN);">LIVE</span>
        </div>
      </div>
      <div class="gen-card-body">
        <!-- Domain pills -->
        <div class="dom-tabs" id="dom-tabs"></div>
        <!-- Email row -->
        <div class="gen-row">
          <div class="gen-email-txt" id="gen-email">ghost.wolf2847@dropit.io</div>
          <button class="gen-copy-btn" id="gen-copy-btn" onclick="copyActiveAddr()">
            <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><rect x="9" y="9" width="13" height="13" rx="2"/><path stroke-linecap="round" d="M5 15H4a2 2 0 01-2-2V4a2 2 0 012-2h9a2 2 0 012 2v1"/></svg>
            Copy
          </button>
          <button class="gen-new-btn" id="gen-spin-btn" onclick="quickGenerate()">
            <svg id="gen-spin-ic" width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
            New
          </button>
        </div>
        <!-- Timer row -->
        <div class="timer-row">
          <span class="timer-lbl">Expires</span>
          <div class="timer-track"><div class="timer-fill" id="tbar" style="width:72%;"></div></div>
          <span class="timer-count" id="tnum">08:38</span>
          <button class="timer-ctrl" onclick="extendTimer()" id="btn-extend" title="+10 min">
            <svg width="10" height="10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M12 4v16m8-8H4"/></svg>
            +10m
          </button>
          <button class="timer-ctrl" id="btn-pause" onclick="togglePauseTimer()" title="Pause">
            <svg id="icon-pause" width="10" height="10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M10 9v6m4-6v6"/></svg>
            <svg id="icon-play" width="10" height="10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" style="display:none;"><path stroke-linecap="round" d="M5 3l14 9-14 9V3z"/></svg>
          </button>
          <span id="paused-badge" style="display:none;font-family:var(--MONO);font-size:.6rem;font-weight:700;color:var(--Y);">PAUSED</span>
        </div>
      </div>
    </div>

    <!-- ── Addresses table panel ── -->
    <div class="panel">

      <!-- Toolbar -->
      <div class="tbar">
        <div class="tbar-search">
          <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><path stroke-linecap="round" d="M21 21l-4.35-4.35"/></svg>
          <input type="text" id="search-input" placeholder="Search addresses…" oninput="filterTable()" />
        </div>
        <select class="tbar-select" id="status-filter" onchange="filterTable()">
          <option value="all">All Status</option>
          <option value="active">Active</option>
          <option value="expired">Expired</option>
          <option value="paused">Paused</option>
        </select>
        <select class="tbar-select" id="domain-filter" onchange="filterTable()">
          <option value="all">All Domains</option>
          <option>dropit.io</option>
          <option>burnbox.dev</option>
          <option>zaptmp.net</option>
          <option>voidmail.cc</option>
          <option>mailsink.app</option>
        </select>
        <div class="tbar-right">
          <span id="result-count" style="font-family:var(--MONO);font-size:.66rem;color:var(--MU);white-space:nowrap;"></span>
          <button class="btn-ghost" onclick="exportCSV()" style="font-size:.76rem;padding:7px 12px;">
            <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
            Export
          </button>
        </div>
      </div>

      <!-- Bulk action bar -->
      <div class="bulk-bar" id="bulk-bar">
        <span class="bulk-bar-txt"><span id="bulk-count">0</span> selected</span>
        <button class="bulk-btn" onclick="bulkCopy()">
          <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><rect x="9" y="9" width="13" height="13" rx="2"/><path stroke-linecap="round" d="M5 15H4a2 2 0 01-2-2V4a2 2 0 012-2h9a2 2 0 012 2v1"/></svg>
          Copy All
        </button>
        <button class="bulk-btn del-btn" onclick="bulkDelete()">
          <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><polyline points="3 6 5 6 21 6"/><path stroke-linecap="round" d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6"/></svg>
          Delete Selected
        </button>
        <button class="bulk-btn" onclick="clearSelection()" style="margin-left:auto;">
          Clear
        </button>
      </div>

      <!-- Tab row -->
      <div class="tab-row">
        <button class="tab-btn active" onclick="switchTab(this,'all')"   data-tab="all">All <span class="tab-count" id="tab-all-count">47</span></button>
        <button class="tab-btn" onclick="switchTab(this,'active')"       data-tab="active">Active <span class="tab-count" id="tab-active-count">3</span></button>
        <button class="tab-btn" onclick="switchTab(this,'expired')"      data-tab="expired">Expired <span class="tab-count" id="tab-expired-count">44</span></button>
      </div>

      <!-- Table -->
      <div style="overflow-x:auto;">
        <table class="addr-table" id="addr-table">
          <thead>
            <tr>
              <th style="width:36px;padding:10px 14px 10px 16px;">
                <input type="checkbox" id="select-all" onchange="toggleSelectAll(this)" style="cursor:pointer;width:15px;height:15px;accent-color:var(--Y);">
              </th>
              <th onclick="sortTable('email')" class="sortable" data-col="email">
                Email Address <span class="sort-ic">↕</span>
              </th>
              <th class="col-domain" onclick="sortTable('domain')" data-col="domain">
                Domain <span class="sort-ic">↕</span>
              </th>
              <th>Status</th>
              <th>Messages</th>
              <th class="col-expiry">Expires</th>
              <th class="col-created" onclick="sortTable('created')" data-col="created">
                Created <span class="sort-ic">↕</span>
              </th>
              <th style="text-align:right;padding-right:16px;">Actions</th>
            </tr>
          </thead>
          <tbody id="addr-tbody">
            <!-- Rows injected by JS -->
          </tbody>
        </table>
        <!-- Empty state -->
        <div class="empty-state" id="empty-state" style="display:none;">
          <div class="empty-icon">
            <svg width="26" height="26" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/></svg>
          </div>
          <div class="empty-title">No addresses found</div>
          <div class="empty-sub">Try adjusting your search or filters, or generate a new address.</div>
          <button class="btn-primary yellow" style="margin-top:4px;" onclick="openGenModal()">
            <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M12 4v16m8-8H4"/></svg>
            Generate New Address
          </button>
        </div>
      </div>

      <!-- Pagination -->
      <div class="pagination" id="pagination">
        <span class="pg-info" id="pg-info">Showing 1–10 of 47</span>
        <div class="pg-btns">
          <button class="pg-btn" id="pg-prev" onclick="changePage(-1)" disabled>← Prev</button>
          <button class="pg-btn active" id="pg-1">1</button>
          <button class="pg-btn" id="pg-2" onclick="goPage(2)">2</button>
          <button class="pg-btn" id="pg-3" onclick="goPage(3)">3</button>
          <button class="pg-btn" id="pg-4" onclick="goPage(4)">4</button>
          <button class="pg-btn" id="pg-5" onclick="goPage(5)">5</button>
          <button class="pg-btn" id="pg-next" onclick="changePage(1)">Next →</button>
        </div>
      </div>
    </div>

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
<script>
/* ══════════════════════════════════════════════════
   ADDRESS PAGE DATA & LOGIC
══════════════════════════════════════════════════ */

const DOMAINS = ['dropit.io','burnbox.dev','zaptmp.net','voidmail.cc','mailsink.app'];
const ADJ     = ['silent','ghost','turbo','vapor','swift','lunar','neon','flux','rogue','stealth','dark','quick'];
const NOU     = ['fox','wolf','tide','bolt','hawk','mint','storm','byte','nova','apex','blade','jet'];
const SENDERS = [
  {n:'Google',   c:'#4285F4', l:'G'},
  {n:'Shopify',  c:'#7C3AED', l:'S'},
  {n:'Notion',   c:'#10B981', l:'N'},
  {n:'Twitter',  c:'#1DA1F2', l:'T'},
  {n:'Amazon',   c:'#F59E0B', l:'A'},
  {n:'Discord',  c:'#5865F2', l:'D'},
  {n:'GitHub',   c:'#111827', l:'G'},
];

function rnd(arr) { return arr[Math.floor(Math.random() * arr.length)]; }
function padZ(n)  { return String(n).padStart(2,'0'); }
function fmtTime(minsAgo) {
  if (minsAgo < 60) return minsAgo + 'm ago';
  if (minsAgo < 1440) return Math.floor(minsAgo/60) + 'h ago';
  return Math.floor(minsAgo/1440) + 'd ago';
}

// Generate seed data
let ADDRESSES = [];
(function seedData() {
  const statuses = ['active','active','active','expired','expired','expired','expired','expired'];
  for (let i = 0; i < 47; i++) {
    const dom    = DOMAINS[i % DOMAINS.length];
    const prefix = rnd(ADJ) + '.' + rnd(NOU) + (Math.floor(Math.random()*9000)+1000);
    const status = i < 3 ? 'active' : (Math.random() > .1 ? 'expired' : 'active');
    const msgs   = Math.floor(Math.random() * 18);
    const created_ago = Math.floor(Math.random() * 14400); // up to 10 days in mins
    const secs_left   = status === 'active' ? Math.floor(Math.random() * 1800) + 60 : 0;
    const msgs_data   = [];
    for (let m = 0; m < Math.min(msgs, 4); m++) {
      const s = rnd(SENDERS);
      msgs_data.push({
        sender: s.n, color: s.c, letter: s.l,
        subject: ['Your OTP code','Welcome!','Verify your email','Order confirmed','Reset password'][m % 5],
        time: fmtTime(Math.floor(Math.random() * created_ago))
      });
    }
    ADDRESSES.push({
      id: i+1,
      email: prefix + '@' + dom,
      domain: dom,
      status,
      msgs,
      msgs_data,
      created_ago,
      secs_left,
      selected: false,
    });
  }
})();

/* ── current view state ── */
let currentTab    = 'all';
let searchVal     = '';
let domainFilter  = 'all';
let statusFilter  = 'all';
let currentPage   = 1;
const PER_PAGE    = 10;
let sortCol       = 'created';
let sortDir       = 'asc';
let timerSecs     = 518;
let timerInt      = null;
let timerPaused   = false;
let activeDomain  = 'dropit.io';

/* ── Filtering & rendering ── */
function getFiltered() {
  return ADDRESSES.filter(a => {
    const matchTab    = currentTab === 'all' || a.status === currentTab;
    const matchSearch = !searchVal || a.email.toLowerCase().includes(searchVal.toLowerCase());
    const matchDomain = domainFilter === 'all' || a.domain === domainFilter;
    const matchStatus = statusFilter === 'all' || a.status === statusFilter;
    return matchTab && matchSearch && matchDomain && matchStatus;
  }).sort((a, b) => {
    let va, vb;
    if (sortCol === 'email')   { va = a.email; vb = b.email; }
    if (sortCol === 'domain')  { va = a.domain; vb = b.domain; }
    if (sortCol === 'created') { va = a.created_ago; vb = b.created_ago; }
    if (va < vb) return sortDir === 'asc' ? -1 : 1;
    if (va > vb) return sortDir === 'asc' ? 1 : -1;
    return 0;
  });
}

function renderTable() {
  const filtered = getFiltered();
  const start    = (currentPage - 1) * PER_PAGE;
  const page     = filtered.slice(start, start + PER_PAGE);
  const tbody    = document.getElementById('addr-tbody');
  const empty    = document.getElementById('empty-state');

  // Tab counts
  document.getElementById('tab-all-count').textContent     = ADDRESSES.length;
  document.getElementById('tab-active-count').textContent  = ADDRESSES.filter(a=>a.status==='active').length;
  document.getElementById('tab-expired-count').textContent = ADDRESSES.filter(a=>a.status==='expired').length;
  document.getElementById('result-count').textContent      = filtered.length + ' result' + (filtered.length !== 1 ? 's' : '');

  if (!page.length) {
    tbody.innerHTML = '';
    empty.style.display = 'flex';
    document.getElementById('pagination').style.display = 'none';
    return;
  }
  empty.style.display = 'none';
  document.getElementById('pagination').style.display = 'flex';

  tbody.innerHTML = page.map(a => {
    const pct     = a.secs_left > 0 ? Math.min(100, (a.secs_left / 1800) * 100) : 0;
    const fillClr = pct > 40 ? 'var(--GREEN)' : pct > 15 ? 'var(--Y)' : 'var(--RED)';
    const badgeCls = a.status === 'active' ? 'badge-active' : a.status === 'paused' ? 'badge-paused' : 'badge-expired';
    const badgeLabel = a.status === 'active' ? '● Active' : a.status === 'paused' ? '⏸ Paused' : '○ Expired';
    const timeLeft = a.secs_left > 0
      ? padZ(Math.floor(a.secs_left/60)) + ':' + padZ(a.secs_left%60)
      : '—';
    const createdStr = fmtTime(a.created_ago);
    const domShort = a.domain.split('.')[0];

    return `
      <tr data-id="${a.id}" class="${a.selected ? 'selected-row' : ''}">
        <td style="padding:12px 14px 12px 16px;">
          <input type="checkbox" class="row-cb" data-id="${a.id}"
            ${a.selected ? 'checked' : ''}
            onchange="toggleRow(${a.id}, this)"
            style="cursor:pointer;width:15px;height:15px;accent-color:var(--Y);">
        </td>
        <td>
          <div class="addr-email-cell">
            <div class="addr-avatar">${domShort.substring(0,2).toUpperCase()}</div>
            <div>
              <div class="addr-email-txt">${a.email}</div>
              <div class="addr-email-sub">${a.msgs} msg${a.msgs !== 1 ? 's' : ''}${a.status === 'active' ? ' · Receiving' : ' · Closed'}</div>
            </div>
          </div>
        </td>
        <td class="col-domain" style="font-family:var(--MONO);font-size:.74rem;color:var(--MU);">@${a.domain}</td>
        <td><span class="badge ${badgeCls}">${badgeLabel}</span></td>
        <td>
          <span class="msg-count ${a.msgs > 0 ? 'has' : ''}">${a.msgs}</span>
        </td>
        <td class="col-expiry">
          ${a.status === 'active'
            ? `<div style="display:flex;align-items:center;gap:8px;">
                <div class="expiry-bar"><div class="expiry-fill" style="width:${pct}%;background:${fillClr};"></div></div>
                <span style="font-family:var(--MONO);font-size:.68rem;color:var(--INK);font-weight:600;">${timeLeft}</span>
               </div>`
            : `<span style="font-size:.76rem;color:var(--MU2);">Expired</span>`
          }
        </td>
        <td class="col-created" style="font-size:.76rem;color:var(--MU);">${createdStr}</td>
        <td>
          <div class="row-actions" style="justify-content:flex-end;padding-right:4px;">
            <button class="row-btn copy" title="Copy address" onclick="copyAddr(${a.id})">
              <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><rect x="9" y="9" width="13" height="13" rx="2"/><path stroke-linecap="round" d="M5 15H4a2 2 0 01-2-2V4a2 2 0 012-2h9a2 2 0 012 2v1"/></svg>
            </button>
            <button class="row-btn view" title="View details" onclick="openDrawer(${a.id})">
              <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
            </button>
            ${a.status === 'active'
              ? `<button class="row-btn extend" title="Extend +10m" onclick="extendAddress(${a.id})">
                   <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M12 4v16m8-8H4"/></svg>
                 </button>`
              : `<button class="row-btn" title="Re-activate" onclick="reactivateAddr(${a.id})">
                   <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                 </button>`
            }
            <button class="row-btn del" title="Delete" onclick="deleteAddr(${a.id})">
              <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><polyline points="3 6 5 6 21 6"/><path stroke-linecap="round" d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6"/></svg>
            </button>
          </div>
        </td>
      </tr>`;
  }).join('');

  // Pagination
  const total = filtered.length;
  const pages = Math.ceil(total / PER_PAGE);
  const s = start + 1, e = Math.min(start + PER_PAGE, total);
  document.getElementById('pg-info').textContent = `Showing ${s}–${e} of ${total}`;
  document.getElementById('pg-prev').disabled = currentPage <= 1;
  document.getElementById('pg-next').disabled = currentPage >= pages;

  // Update page buttons
  for (let i = 1; i <= 5; i++) {
    const btn = document.getElementById('pg-' + i);
    if (btn) {
      btn.textContent = i;
      btn.classList.toggle('active', i === currentPage);
      btn.style.display = i <= pages ? '' : 'none';
      btn.onclick = () => goPage(i);
    }
  }
}

function filterTable() {
  searchVal    = document.getElementById('search-input').value;
  domainFilter = document.getElementById('domain-filter').value;
  statusFilter = document.getElementById('status-filter').value;
  currentPage  = 1;
  renderTable();
}

function switchTab(btn, tab) {
  document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
  btn.classList.add('active');
  currentTab  = tab;
  currentPage = 1;
  renderTable();
}

function sortTable(col) {
  if (sortCol === col) sortDir = sortDir === 'asc' ? 'desc' : 'asc';
  else { sortCol = col; sortDir = 'asc'; }
  document.querySelectorAll('.addr-table th').forEach(th => {
    th.classList.remove('asc','desc');
    if (th.dataset.col === col) th.classList.add(sortDir);
  });
  renderTable();
}

function goPage(p) { currentPage = p; renderTable(); }
function changePage(d) { currentPage += d; renderTable(); }

/* ── Selection ── */
function toggleRow(id, cb) {
  const a = ADDRESSES.find(x => x.id === id);
  if (a) a.selected = cb.checked;
  updateBulkBar();
}

function toggleSelectAll(cb) {
  const filtered = getFiltered();
  const page     = filtered.slice((currentPage-1)*PER_PAGE, currentPage*PER_PAGE);
  page.forEach(a => a.selected = cb.checked);
  renderTable();
  updateBulkBar();
}

function updateBulkBar() {
  const sel   = ADDRESSES.filter(a => a.selected);
  const bar   = document.getElementById('bulk-bar');
  const count = document.getElementById('bulk-count');
  count.textContent = sel.length;
  bar.classList.toggle('show', sel.length > 0);
}

function clearSelection() {
  ADDRESSES.forEach(a => a.selected = false);
  document.getElementById('select-all').checked = false;
  renderTable(); updateBulkBar();
}

/* ── Row actions ── */
function copyAddr(id) {
  const a = ADDRESSES.find(x => x.id === id);
  if (!a) return;
  navigator.clipboard.writeText(a.email).catch(() => {});
  showToast('Copied: ' + a.email);
}

function deleteAddr(id) {
  const row = document.querySelector(`tr[data-id="${id}"]`);
  if (row) { row.style.opacity = '0'; row.style.transform = 'translateX(8px)'; row.style.transition = 'all .2s'; setTimeout(() => { ADDRESSES = ADDRESSES.filter(a => a.id !== id); renderTable(); }, 200); }
  showToast('Address deleted');
}

function reactivateAddr(id) {
  const a = ADDRESSES.find(x => x.id === id);
  if (!a) return;
  a.status    = 'active';
  a.secs_left = 600;
  renderTable();
  showToast('Address re-activated (+10 min)');
}

function extendAddress(id) {
  const a = ADDRESSES.find(x => x.id === id);
  if (!a) return;
  a.secs_left = Math.min(1800, a.secs_left + 600);
  renderTable();
  showToast('+10 minutes added');
}

/* ── Bulk actions ── */
function bulkDelete() {
  const sel = ADDRESSES.filter(a => a.selected).map(a => a.id);
  if (!confirm('Delete ' + sel.length + ' address(es)?')) return;
  ADDRESSES = ADDRESSES.filter(a => !a.selected);
  clearSelection();
  renderTable();
  showToast(sel.length + ' address(es) deleted');
}

function bulkCopy() {
  const sel = ADDRESSES.filter(a => a.selected).map(a => a.email).join('\\n');
  navigator.clipboard.writeText(sel).catch(() => {});
  showToast(ADDRESSES.filter(a => a.selected).length + ' addresses copied');
}

/* ── Detail Drawer ── */
function openDrawer(id) {
  const a = ADDRESSES.find(x => x.id === id);
  if (!a) return;

  const pct = a.secs_left > 0 ? Math.min(100, (a.secs_left / 1800) * 100) : 0;
  const fillClr = pct > 40 ? 'var(--GREEN)' : pct > 15 ? 'var(--Y)' : 'var(--RED)';
  const timeLeft = a.secs_left > 0 ? padZ(Math.floor(a.secs_left/60)) + ':' + padZ(a.secs_left%60) : 'Expired';
  const badgeCls = a.status === 'active' ? 'badge-active' : 'badge-expired';
  const badgeLabel = a.status === 'active' ? '● Active' : '○ Expired';

  document.getElementById('drawer-title').textContent = 'Address Details';
  document.getElementById('drawer-body').innerHTML = `
    <div class="drawer-section">
      <div class="drawer-section-title">Email Address</div>
      <div class="drawer-field-mono">
        <span style="flex:1;word-break:break-all;">${a.email}</span>
        <button onclick="navigator.clipboard.writeText('${a.email}').then(()=>showToast('Copied!'))"
          style="display:flex;align-items:center;justify-content:center;width:28px;height:28px;border:1px solid var(--BD);border-radius:6px;background:var(--SURF);color:var(--MU);cursor:pointer;flex-shrink:0;transition:background .12s;">
          <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><rect x="9" y="9" width="13" height="13" rx="2"/><path stroke-linecap="round" d="M5 15H4a2 2 0 01-2-2V4a2 2 0 012-2h9a2 2 0 012 2v1"/></svg>
        </button>
      </div>
    </div>

    <div class="drawer-section">
      <div class="drawer-section-title">Details</div>
      <div class="drawer-field">
        <span class="drawer-field-lbl">Status</span>
        <span class="badge ${badgeCls}">${badgeLabel}</span>
      </div>
      <div class="drawer-field">
        <span class="drawer-field-lbl">Domain</span>
        <span class="drawer-field-val" style="font-family:var(--MONO);">@${a.domain}</span>
      </div>
      <div class="drawer-field">
        <span class="drawer-field-lbl">Created</span>
        <span class="drawer-field-val">${fmtTime(a.created_ago)}</span>
      </div>
      <div class="drawer-field">
        <span class="drawer-field-lbl">Messages</span>
        <span class="drawer-field-val">${a.msgs} received</span>
      </div>
      ${a.status === 'active' ? `
      <div class="drawer-field">
        <span class="drawer-field-lbl">Time Remaining</span>
        <div style="display:flex;align-items:center;gap:10px;margin-top:4px;">
          <div class="expiry-bar" style="width:120px;height:6px;">
            <div class="expiry-fill" style="width:${pct}%;background:${fillClr};"></div>
          </div>
          <span style="font-family:var(--MONO);font-size:.78rem;font-weight:700;color:var(--INK);">${timeLeft}</span>
        </div>
      </div>` : ''}
    </div>

    ${a.msgs_data.length ? `
    <div class="drawer-section">
      <div class="drawer-section-title">Recent Messages (${a.msgs})</div>
      ${a.msgs_data.map(m => `
        <div class="drawer-msg-row">
          <div class="drawer-msg-av" style="background:${m.color};">${m.letter}</div>
          <div class="drawer-msg-body">
            <div class="drawer-msg-sender">${m.sender}</div>
            <div class="drawer-msg-subject">${m.subject}</div>
          </div>
          <div class="drawer-msg-time">${m.time}</div>
        </div>`).join('')}
    </div>` : `
    <div class="drawer-section">
      <div class="drawer-section-title">Messages</div>
      <div style="text-align:center;padding:20px;color:var(--MU2);font-size:.82rem;">No messages received yet</div>
    </div>`}
  `;

  document.getElementById('drawer-footer').innerHTML = `
    <button class="btn-ghost" onclick="copyAddr(${a.id});closeDrawer()">
      <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><rect x="9" y="9" width="13" height="13" rx="2"/><path stroke-linecap="round" d="M5 15H4a2 2 0 01-2-2V4a2 2 0 012-2h9a2 2 0 012 2v1"/></svg>
      Copy Address
    </button>
    ${a.status === 'active'
      ? `<button class="btn-ghost" onclick="extendAddress(${a.id});closeDrawer()">+10 min</button>
         <button class="btn-primary" style="background:var(--RED);" onclick="deleteAddr(${a.id});closeDrawer()">Delete</button>`
      : `<button class="btn-primary yellow" onclick="reactivateAddr(${a.id});closeDrawer()">Re-activate</button>
         <button class="btn-primary" style="background:var(--RED);" onclick="deleteAddr(${a.id});closeDrawer()">Delete</button>`
    }
  `;

  document.getElementById('addr-drawer').classList.add('open');
  document.body.style.overflow = 'hidden';
}

function closeDrawer() {
  document.getElementById('addr-drawer').classList.remove('open');
  document.body.style.overflow = '';
}

/* ── Generate modal ── */
function openGenModal() {
  updateModalPreview();
  document.getElementById('gen-modal').classList.add('open');
}
function closeGenModal() {
  document.getElementById('gen-modal').classList.remove('open');
}
function updateModalPreview() {
  const prefix = document.getElementById('modal-prefix').value.trim();
  const domain = document.getElementById('modal-domain').value;
  const auto   = rnd(ADJ) + '.' + rnd(NOU) + (Math.floor(Math.random()*9000)+1000);
  document.getElementById('modal-preview-txt').textContent = (prefix || auto) + '@' + domain;
}
function doGenerate() {
  const prefix = document.getElementById('modal-prefix').value.trim();
  const domain = document.getElementById('modal-domain').value;
  const expiry = parseInt(document.getElementById('modal-expiry').value);
  const auto   = rnd(ADJ) + '.' + rnd(NOU) + (Math.floor(Math.random()*9000)+1000);
  const email  = (prefix || auto) + '@' + domain;
  const newAddr = {
    id: ADDRESSES.length + 1,
    email, domain,
    status: 'active',
    msgs: 0, msgs_data: [],
    created_ago: 0,
    secs_left: expiry * 60,
    selected: false,
  };
  ADDRESSES.unshift(newAddr);
  closeGenModal();
  document.getElementById('gen-email').textContent = email;
  // Reset to first tab + page
  currentTab = 'all'; currentPage = 1;
  document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
  document.querySelector('.tab-btn[data-tab="all"]').classList.add('active');
  renderTable();
  showToast('New address generated!');
}

/* ── Quick generate in strip ── */
function quickGenerate() {
  const email = rnd(ADJ) + '.' + rnd(NOU) + (Math.floor(Math.random()*9000)+1000) + '@' + activeDomain;
  document.getElementById('gen-email').textContent = email;
  timerSecs = 600; updateTimerUI();
  const ic = document.getElementById('gen-spin-ic');
  ic.style.transition = 'transform .4s'; ic.style.transform = 'rotate(360deg)';
  setTimeout(() => { ic.style.transition = 'none'; ic.style.transform = ''; }, 420);
  showToast('New address generated');
}

function copyActiveAddr() {
  const txt = document.getElementById('gen-email').textContent;
  navigator.clipboard.writeText(txt).catch(() => {});
  const btn = document.getElementById('gen-copy-btn');
  btn.classList.add('ok'); btn.textContent = '✓ Copied';
  showToast('Address copied!');
  setTimeout(() => { btn.classList.remove('ok'); btn.innerHTML = '<svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><rect x="9" y="9" width="13" height="13" rx="2"/><path stroke-linecap="round" d="M5 15H4a2 2 0 01-2-2V4a2 2 0 012-2h9a2 2 0 012 2v1"/></svg> Copy'; }, 2200);
}

/* ── Domain pills ── */
(function renderDomPills() {
  const wrap = document.getElementById('dom-tabs');
  DOMAINS.forEach((d, i) => {
    const btn = document.createElement('button');
    btn.className = 'dom-pill' + (i === 0 ? ' active' : '');
    btn.textContent = '@' + d;
    btn.onclick = () => {
      document.querySelectorAll('.dom-pill').forEach(b => b.classList.remove('active'));
      btn.classList.add('active');
      activeDomain = d;
      quickGenerate();
    };
    wrap.appendChild(btn);
  });
})();

/* ── Timer ── */
function updateTimerUI() {
  const m = padZ(Math.floor(timerSecs/60)), s = padZ(timerSecs%60);
  document.getElementById('tnum').textContent = m + ':' + s;
  const pct = Math.min(100, (timerSecs / 1800) * 100);
  const bar = document.getElementById('tbar');
  bar.style.width = pct + '%';
  bar.style.background = timerSecs < 120 ? 'var(--RED)' : 'var(--Y)';
}

function startTimerAddr() {
  clearInterval(timerInt);
  timerInt = setInterval(() => {
    if (timerPaused) return;
    if (timerSecs > 0) timerSecs--;
    else { clearInterval(timerInt); return; }
    updateTimerUI();
    // Also tick active addresses
    ADDRESSES.filter(a => a.status === 'active').forEach(a => { if (a.secs_left > 0) a.secs_left--; });
  }, 1000);
}

function togglePauseTimer() {
  timerPaused = !timerPaused;
  document.getElementById('icon-pause').style.display = timerPaused ? 'none' : 'inline';
  document.getElementById('icon-play').style.display  = timerPaused ? 'inline' : 'none';
  const b = document.getElementById('paused-badge');
  if (b) b.style.display = timerPaused ? 'inline' : 'none';
  showToast(timerPaused ? 'Timer paused' : 'Timer resumed');
}

function extendTimer() {
  timerSecs = Math.min(1800, timerSecs + 600);
  const bar = document.getElementById('tbar');
  bar.style.background = 'var(--GREEN)';
  setTimeout(() => { bar.style.background = timerSecs < 120 ? 'var(--RED)' : 'var(--Y)'; }, 600);
  updateTimerUI();
  showToast('+10 minutes added');
}

/* ── Export ── */
function exportCSV() {
  const rows = [['Email','Domain','Status','Messages','Created']];
  ADDRESSES.forEach(a => rows.push([a.email, a.domain, a.status, a.msgs, fmtTime(a.created_ago)]));
  const csv  = rows.map(r => r.join(',')).join('\\n');
  const blob = new Blob([csv], {type:'text/csv'});
  const url  = URL.createObjectURL(blob);
  const a    = document.createElement('a'); a.href = url; a.download = 'addresses.csv'; a.click();
  URL.revokeObjectURL(url);
  showToast('CSV exported');
}

/* ── Refresh ── */
function refreshPage() {
  const ic = document.getElementById('refresh-ic');
  ic.style.transition = 'transform .5s'; ic.style.transform = 'rotate(360deg)';
  setTimeout(() => { ic.style.transition = 'none'; ic.style.transform = ''; }, 520);
  renderTable();
  showToast('Refreshed!');
}

/* ── Toast ── */
function showToast(msg) {
  const t = document.getElementById('toast');
  t.querySelector('span').textContent = msg;
  t.classList.add('show');
  setTimeout(() => t.classList.remove('show'), 2500);
}

/* ── Sidebar logic ── */
const sidebar    = document.getElementById('sidebar');
const backdrop   = document.getElementById('sb-backdrop');
const toggleBtn  = document.getElementById('sb-toggle-btn');
const collapseBtn= document.getElementById('sb-collapse-btn');
let isCollapsed  = false;
const isMob      = () => window.innerWidth < 900;

if (toggleBtn) toggleBtn.addEventListener('click', () => {
  if (isMob()) {
    const open = sidebar.classList.toggle('mob-open');
    backdrop.classList.toggle('show', open);
  } else { collapseSidebar(!isCollapsed); }
});
if (collapseBtn) collapseBtn.addEventListener('click', () => collapseSidebar(!isCollapsed));
function collapseSidebar(c) { isCollapsed = c; sidebar.classList.toggle('collapsed', c); document.body.classList.toggle('sb-collapsed', c); }
function closeMobileSb() { sidebar.classList.remove('mob-open'); backdrop.classList.remove('show'); }
window.addEventListener('resize', () => { if (!isMob()) closeMobileSb(); });

function toggleUserDd() { document.getElementById('user-dd').classList.toggle('open'); }
document.addEventListener('click', e => { if (!e.target.closest('#tb-av')) document.getElementById('user-dd')?.classList.remove('open'); });

/* ── Keyboard shortcuts ── */
document.addEventListener('keydown', e => {
  if (e.key === 'Escape') { closeDrawer(); closeGenModal(); }
  if (e.key === 'n' && !e.ctrlKey && !e.metaKey && document.activeElement.tagName !== 'INPUT') openGenModal();
});

/* ── Boot ── */
renderTable();
startTimerAddr();
</script>
</body>
</html>