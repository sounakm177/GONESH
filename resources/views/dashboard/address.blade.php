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
/* ══════════════════════════════════════════════
   ADDRESSES (ALIAS) PAGE
══════════════════════════════════════════════ */

/* ── Usage meter ── */
.usage-bar-wrap {
  height: 6px; background: var(--BD2); border-radius: 3px;
  overflow: hidden; flex: 1; min-width: 80px; max-width: 160px;
}
.usage-bar-fill {
  height: 100%; border-radius: 3px;
  transition: width .4s cubic-bezier(.4,0,.2,1);
}
.usage-bar-fill.ok      { background: var(--GREEN); }
.usage-bar-fill.warning { background: var(--Y); }
.usage-bar-fill.full    { background: var(--RED); }

/* ── Upgrade banner ── */
.upgrade-banner {
  background: var(--INK);
  border: 1px solid rgba(250,204,21,.25);
  border-radius: 12px;
  padding: 18px 20px;
  display: flex; align-items: center; gap: 16px;
  flex-wrap: wrap; margin-bottom: 20px;
  position: relative; overflow: hidden;
}
.upgrade-banner::before {
  content: '';
  position: absolute; top: 0; left: 0; right: 0; height: 2px;
  background: linear-gradient(90deg, var(--Y), #F59E0B, var(--Y));
  background-size: 200% 100%;
  animation: shimmer 2s linear infinite;
}
@keyframes shimmer { 0%{background-position:200% 0} 100%{background-position:-200% 0} }

.upgrade-icon {
  width: 44px; height: 44px; background: rgba(250,204,21,.12);
  border-radius: 10px; display: flex; align-items: center;
  justify-content: center; color: var(--Y); flex-shrink: 0;
}
.upgrade-body { flex: 1; min-width: 0; }
.upgrade-title { font-family: var(--DISP); font-size: 1rem; letter-spacing: .04em; color: #fff; margin-bottom: 3px; }
.upgrade-sub   { font-size: .78rem; color: rgba(255,255,255,.5); line-height: 1.5; }
.upgrade-cta {
  display: inline-flex; align-items: center; gap: 6px;
  background: var(--Y); color: var(--INK);
  font-size: .78rem; font-weight: 700; padding: 9px 18px;
  border-radius: 8px; white-space: nowrap; flex-shrink: 0;
  transition: background .15s, transform .1s;
  text-decoration: none;
}
.upgrade-cta:hover { background: #EAB800; transform: translateY(-1px); text-decoration: none; }

/* ── Stat cards row ── */
.stat-row {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 12px;
  margin-bottom: 20px;
}
@media (min-width: 640px) { .stat-row { grid-template-columns: repeat(4, 1fr); } }

.stat-c {
  background: var(--SURF); border: 1px solid var(--BD);
  border-radius: 12px; padding: 16px;
  transition: box-shadow .15s, transform .12s;
  position: relative; overflow: hidden;
}
.stat-c:hover { box-shadow: 0 4px 14px rgba(0,0,0,.07); transform: translateY(-1px); }
.stat-c-top { display: flex; align-items: flex-start; justify-content: space-between; margin-bottom: 10px; }
.stat-c-icon {
  width: 36px; height: 36px; border-radius: 9px;
  display: flex; align-items: center; justify-content: center;
}
.stat-c-icon.y { background: rgba(250,204,21,.15); color: #92400E; }
.stat-c-icon.g { background: rgba(16,185,129,.12);  color: var(--GREEN); }
.stat-c-icon.b { background: rgba(59,130,246,.12);  color: var(--B); }
.stat-c-icon.r { background: rgba(239,68,68,.10);  color: var(--RED); }
.stat-c-val { font-family: var(--DISP); font-size: 1.9rem; color: var(--INK); line-height: 1; }
.stat-c-lbl { font-size: .74rem; color: var(--MU); font-weight: 500; margin-top: 3px; }
.stat-c-note { font-size: .68rem; margin-top: 4px; }

/* ── Panel / card ── */
.panel {
  background: var(--SURF); border: 1px solid var(--BD);
  border-radius: 12px; overflow: hidden; margin-bottom: 20px;
}
.panel-hd {
  display: flex; align-items: center; justify-content: space-between;
  padding: 14px 18px; border-bottom: 1px solid var(--BD2);
  gap: 10px; flex-wrap: wrap;
}
.panel-title { font-weight: 700; font-size: .9rem; color: var(--INK); }
.panel-meta  { font-family: var(--MONO); font-size: .62rem; color: var(--MU); }

/* ── Toolbar ── */
.tbar {
  display: flex; align-items: center; gap: 8px;
  padding: 12px 18px; border-bottom: 1px solid var(--BD2);
  flex-wrap: wrap;
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
}
.tbar-select:focus { border-color: var(--Y); }
.tbar-ml { margin-left: auto; }

/* ── Table ── */
.alias-table { width: 100%; border-collapse: collapse; }
.alias-table thead tr { border-bottom: 1px solid var(--BD2); }
.alias-table thead th {
  padding: 10px 16px; text-align: left;
  font-family: var(--MONO); font-size: .58rem; font-weight: 700;
  letter-spacing: .1em; text-transform: uppercase; color: var(--MU2);
  white-space: nowrap;
}
.alias-table tbody tr {
  border-bottom: 1px solid var(--BD2); transition: background .1s;
}
.alias-table tbody tr:last-child { border-bottom: none; }
.alias-table tbody tr:hover { background: var(--BD2); }
.alias-table tbody td { padding: 13px 16px; vertical-align: middle; }

/* alias email cell */
.alias-cell { display: flex; align-items: center; gap: 10px; min-width: 0; }
.alias-avatar {
  width: 34px; height: 34px; border-radius: 9px;
  background: var(--INK); color: var(--Y);
  display: flex; align-items: center; justify-content: center;
  font-family: var(--MONO); font-size: .64rem; font-weight: 800;
  flex-shrink: 0; letter-spacing: .02em;
}
.alias-email {
  font-family: var(--MONO); font-size: .78rem; font-weight: 600;
  color: var(--INK); overflow: hidden; text-overflow: ellipsis;
  white-space: nowrap; max-width: 220px;
}
.alias-label {
  font-size: .7rem; color: var(--MU); margin-top: 2px; white-space: nowrap;
}

/* forward-to pill */
.forward-pill {
  display: inline-flex; align-items: center; gap: 5px;
  background: rgba(59,130,246,.08); color: var(--B);
  border: 1px solid rgba(59,130,246,.2);
  font-family: var(--MONO); font-size: .66rem; font-weight: 600;
  padding: 3px 10px; border-radius: 20px; white-space: nowrap;
  max-width: 200px; overflow: hidden; text-overflow: ellipsis;
}

/* status toggle pill */
.status-toggle {
  display: inline-flex; align-items: center; gap: 5px;
  font-family: var(--MONO); font-size: .6rem; font-weight: 700;
  padding: 4px 10px; border-radius: 20px; cursor: pointer;
  white-space: nowrap; transition: background .15s, color .15s;
  border: none; user-select: none;
}
.status-toggle.active  { background: rgba(16,185,129,.12);  color: var(--GREEN); }
.status-toggle.paused  { background: rgba(245,158,11,.12);   color: #92400E; }
.status-toggle .st-dot { width: 5px; height: 5px; border-radius: 50%; background: currentColor; }

/* row action buttons */
.row-acts { display: flex; gap: 4px; align-items: center; justify-content: flex-end; }
.act-btn {
  width: 30px; height: 30px; display: flex; align-items: center;
  justify-content: center; border-radius: 7px;
  border: 1px solid var(--BD); background: var(--SURF); color: var(--MU);
  cursor: pointer; transition: background .12s, color .12s, border-color .12s;
}
.act-btn:hover           { background: var(--BD2); color: var(--INK); border-color: #D1D5DB; }
.act-btn.copy:hover      { background: rgba(250,204,21,.1);  color: var(--INK);   border-color: rgba(250,204,21,.4); }
.act-btn.edit:hover      { background: rgba(59,130,246,.08); color: var(--B);     border-color: rgba(59,130,246,.3); }
.act-btn.del:hover       { background: rgba(239,68,68,.08);  color: var(--RED);   border-color: rgba(239,68,68,.3); }

/* ── Empty state ── */
.empty-state {
  display: none; flex-direction: column; align-items: center;
  justify-content: center; padding: 56px 20px; gap: 14px; text-align: center;
}
.empty-state.show { display: flex; }
.empty-icon {
  width: 58px; height: 58px; background: var(--BD2);
  border-radius: 14px; display: flex; align-items: center;
  justify-content: center; color: var(--MU2);
}
.empty-title { font-family: var(--DISP); font-size: 1.3rem; letter-spacing: .03em; color: var(--INK); }
.empty-sub   { font-size: .82rem; color: var(--MU); max-width: 280px; line-height: 1.6; }

/* ── Hidden on small screens ── */
.col-forward,
.col-received,
.col-last-used { display: none; }
@media (min-width: 640px)  { .col-forward  { display: table-cell; } }
@media (min-width: 860px)  { .col-received { display: table-cell; } }
@media (min-width: 1080px) { .col-last-used { display: table-cell; } }

/* ══════════════════════════════════════════════
   MODALS  (Create + Edit Alias)
══════════════════════════════════════════════ */
.modal-overlay {
  position: fixed; inset: 0; z-index: 500;
  background: rgba(0,0,0,.5); backdrop-filter: blur(3px);
  display: none; align-items: center; justify-content: center; padding: 20px;
}
.modal-overlay.open { display: flex; animation: fade-bg .2s ease both; }
@keyframes fade-bg { from{opacity:0} to{opacity:1} }

.modal-box {
  background: var(--SURF); border-radius: 14px;
  border: 1px solid var(--BD); width: 100%; max-width: 480px;
  box-shadow: 0 20px 60px rgba(0,0,0,.18);
  animation: modal-up .22s cubic-bezier(.34,1.56,.64,1) both;
}
@keyframes modal-up { from{transform:translateY(12px) scale(.97);opacity:0} to{transform:none;opacity:1} }

.modal-hd {
  display: flex; align-items: center; justify-content: space-between;
  padding: 18px 20px; border-bottom: 1px solid var(--BD2);
}
.modal-title {
  font-family: var(--DISP); font-size: 1.15rem;
  letter-spacing: .04em; color: var(--INK);
}
.modal-close {
  width: 32px; height: 32px; display: flex; align-items: center;
  justify-content: center; border-radius: 8px; border: 1px solid var(--BD);
  background: transparent; color: var(--MU); cursor: pointer;
  transition: background .12s, color .12s;
}
.modal-close:hover { background: var(--BD2); color: var(--INK); }

.modal-body { padding: 20px; display: flex; flex-direction: column; gap: 14px; }

.field { display: flex; flex-direction: column; gap: 5px; }
.field label {
  font-family: var(--MONO); font-size: .6rem; font-weight: 700;
  letter-spacing: .08em; text-transform: uppercase; color: var(--MU);
}
.field input,
.field select {
  padding: 10px 14px; border: 1px solid var(--BD); border-radius: 8px;
  font-family: var(--BODY); font-size: 16px; color: var(--INK);
  background: var(--SURF); outline: none;
  transition: border-color .15s, box-shadow .15s;
}
.field input:focus,
.field select:focus {
  border-color: var(--Y); box-shadow: 0 0 0 3px rgba(250,204,21,.15);
}
.field input.err  { border-color: var(--RED); box-shadow: 0 0 0 3px rgba(239,68,68,.1); }
.field-hint { font-size: .72rem; color: var(--MU2); line-height: 1.5; }
.field-err  { font-size: .72rem; color: var(--RED); font-weight: 500; display: none; }
.field-err.show { display: block; }

/* alias@domain combo */
.alias-input-row {
  display: flex; border: 1px solid var(--BD); border-radius: 8px;
  overflow: hidden; transition: border-color .15s, box-shadow .15s;
  background: var(--SURF);
}
.alias-input-row:focus-within {
  border-color: var(--Y); box-shadow: 0 0 0 3px rgba(250,204,21,.15);
}
.alias-input-row.err {
  border-color: var(--RED); box-shadow: 0 0 0 3px rgba(239,68,68,.1);
}
.alias-prefix {
  flex: 1; padding: 10px 14px; border: none; outline: none;
  font-family: var(--MONO); font-size: 15px; color: var(--INK);
  background: transparent;
}
.alias-at {
  display: flex; align-items: center;
  font-family: var(--MONO); font-size: .78rem; color: var(--MU2);
  padding: 0 6px; background: var(--BD2); border-left: 1px solid var(--BD);
  flex-shrink: 0;
}
.alias-domain-sel {
  border: none; outline: none; background: var(--BD2);
  font-family: var(--MONO); font-size: .76rem; color: var(--INK);
  padding: 0 12px 0 4px; cursor: pointer; height: 100%;
}

/* status toggle in modal */
.toggle-row {
  display: flex; align-items: center; justify-content: space-between;
  padding: 10px 14px; border: 1px solid var(--BD); border-radius: 8px;
}
.toggle-lbl { font-size: .84rem; font-weight: 500; color: var(--INK); }
.toggle-sub { font-size: .72rem; color: var(--MU); margin-top: 2px; }
.toggle-switch {
  width: 42px; height: 24px; border-radius: 12px;
  background: var(--BD); border: none; cursor: pointer; position: relative;
  flex-shrink: 0; transition: background .2s;
}
.toggle-switch.on { background: var(--GREEN); }
.toggle-switch::after {
  content: ''; position: absolute;
  width: 18px; height: 18px; border-radius: 50%; background: #fff;
  top: 3px; left: 3px; transition: left .2s;
  box-shadow: 0 1px 4px rgba(0,0,0,.2);
}
.toggle-switch.on::after { left: 21px; }

.modal-ft {
  padding: 14px 20px; border-top: 1px solid var(--BD2);
  display: flex; gap: 8px; justify-content: flex-end;
}

/* ── Toast ── */
#toast {
  position: fixed; bottom: 20px; right: 16px;
  background: var(--INK); color: #fff;
  font-family: var(--MONO); font-size: .74rem; font-weight: 600;
  padding: 10px 16px; border-radius: 8px;
  box-shadow: 0 4px 20px rgba(0,0,0,.2); z-index: 999;
  display: flex; align-items: center; gap: 7px;
  transform: translateY(70px); opacity: 0;
  transition: transform .3s cubic-bezier(.34,1.56,.64,1), opacity .25s;
}
#toast.show { transform: translateY(0); opacity: 1; }
.toast-dot { width: 7px; height: 7px; background: var(--GREEN); border-radius: 50%; }
</style>
</head>
<body>

<div id="toast"><div class="toast-dot"></div><span id="toast-msg">Done</span></div>

<!-- ══════════ CREATE / EDIT MODAL ══════════ -->
<div class="modal-overlay" id="alias-modal">
  <div class="modal-box">
    <div class="modal-hd">
      <div class="modal-title" id="modal-title">Create Alias</div>
      <button class="modal-close" onclick="closeModal()">
        <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
          <path stroke-linecap="round" d="M6 18L18 6M6 6l12 12"/>
        </svg>
      </button>
    </div>
    <div class="modal-body">

      <!-- Alias address -->
      <div class="field">
        <label>Alias Address</label>
        <div class="alias-input-row" id="alias-input-wrap">
          <input class="alias-prefix" id="alias-prefix" type="text"
            placeholder="myalias" maxlength="40" autocapitalize="none"
            oninput="validatePrefix(this)"/>
          <span class="alias-at">@</span>
          <select class="alias-domain-sel" id="alias-domain">
            <option>dropit.io</option>
            <option>burnbox.dev</option>
            <option>zaptmp.net</option>
            <option>voidmail.cc</option>
            <option>mailsink.app</option>
          </select>
        </div>
        <div class="field-err" id="prefix-err">Use 3–40 lowercase letters, numbers or hyphens.</div>
        <div class="field-hint">Leave blank to auto-generate a random prefix.</div>
      </div>

      <!-- Label / note -->
      <div class="field">
        <label>Label <span style="color:var(--MU);font-weight:400;text-transform:none;letter-spacing:0;">(optional)</span></label>
        <input type="text" id="alias-label-inp" placeholder="e.g. Shopping, Newsletter, Testing…" maxlength="60"/>
      </div>

      <!-- Forward-to -->
      <div class="field">
        <label>Forward To <span style="color:var(--MU);font-weight:400;text-transform:none;letter-spacing:0;">(optional)</span></label>
        <input type="email" id="alias-forward" placeholder="yourpersonal@gmail.com"
          oninput="validateForward(this)"/>
        <div class="field-err" id="forward-err">Please enter a valid email address.</div>
        <div class="field-hint">Emails received on this alias will also be forwarded here.</div>
      </div>

      <!-- Status toggle -->
      <div class="field">
        <label>Status</label>
        <div class="toggle-row">
          <div>
            <div class="toggle-lbl">Active</div>
            <div class="toggle-sub">Alias accepts incoming emails</div>
          </div>
          <button class="toggle-switch on" id="status-toggle" onclick="toggleStatus(this)" aria-label="Toggle status"></button>
        </div>
      </div>

    </div>
    <div class="modal-ft">
      <button class="btn-ghost" onclick="closeModal()">Cancel</button>
      <button class="btn-primary yellow" id="modal-save-btn" onclick="saveAlias()">
        <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
          <path stroke-linecap="round" d="M5 13l4 4L19 7"/>
        </svg>
        <span id="modal-save-lbl">Create Alias</span>
      </button>
    </div>
  </div>
</div>

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
        <div class="page-subtitle" id="page-sub">Manage your email aliases</div>
      </div>
      <div style="display:flex;gap:8px;align-items:center;flex-wrap:wrap;">
        <button class="btn-ghost" onclick="refreshPage()">
          <svg id="refresh-ic" width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
            <path stroke-linecap="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
          </svg>
          Refresh
        </button>
        <button class="btn-primary yellow" id="create-btn" onclick="openCreateModal()">
          <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
            <path stroke-linecap="round" d="M12 4v16m8-8H4"/>
          </svg>
          Create Alias
        </button>
      </div>
    </div>

    <!-- ── Upgrade banner (shown when limit reached) ── -->
    <div class="upgrade-banner" id="upgrade-banner" style="display:none;">
      <div class="upgrade-icon">
        <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
          <path stroke-linecap="round" d="M13 10V3L4 14h7v7l9-11h-7z"/>
        </svg>
      </div>
      <div class="upgrade-body">
        <div class="upgrade-title">ALIAS LIMIT REACHED — UPGRADE TO PRO</div>
        <div class="upgrade-sub">You've used all <strong id="banner-limit" style="color:var(--Y);">5</strong> free aliases. Upgrade to Pro for unlimited aliases, custom domains, and forwarding rules.</div>
      </div>
      <a href="#" class="upgrade-cta">
        <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
          <path stroke-linecap="round" d="M13 10V3L4 14h7v7l9-11h-7z"/>
        </svg>
        Upgrade Now
      </a>
    </div>

    <!-- ── Stat cards ── -->
    <div class="stat-row">

      <!-- Usage counter — key feature -->
      <div class="stat-c" style="grid-column:1/-1;" id="usage-card">
        <div style="display:flex;align-items:center;justify-content:space-between;gap:14px;flex-wrap:wrap;">
          <div style="display:flex;align-items:center;gap:14px;flex:1;min-width:0;">
            <div class="stat-c-icon y">
              <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
              </svg>
            </div>
            <div style="min-width:0;flex:1;">
              <div style="font-size:.74rem;color:var(--MU);font-weight:500;margin-bottom:4px;">Alias Usage</div>
              <div style="display:flex;align-items:center;gap:12px;flex-wrap:wrap;">
                <div style="font-family:var(--DISP);font-size:1.5rem;color:var(--INK);line-height:1;">
                  <span id="used-count">3</span>
                  <span style="font-family:var(--BODY);font-size:1rem;color:var(--MU);font-weight:400;"> / </span>
                  <span id="total-limit" style="color:var(--MU);">5</span>
                  <span style="font-family:var(--MONO);font-size:.7rem;color:var(--MU);font-weight:600;margin-left:4px;">Used</span>
                </div>
                <div class="usage-bar-wrap" id="usage-bar-wrap">
                  <div class="usage-bar-fill ok" id="usage-bar-fill" style="width:60%;"></div>
                </div>
                <span id="usage-pct-lbl" style="font-family:var(--MONO);font-size:.66rem;font-weight:700;color:var(--GREEN);white-space:nowrap;">60% used</span>
              </div>
            </div>
          </div>
          <div style="display:flex;gap:8px;flex-shrink:0;">
            <div style="text-align:center;padding:0 16px;">
              <div style="font-family:var(--DISP);font-size:1.4rem;color:var(--INK);" id="active-count">2</div>
              <div style="font-size:.7rem;color:var(--MU);">Active</div>
            </div>
            <div style="width:1px;background:var(--BD);"></div>
            <div style="text-align:center;padding:0 16px;">
              <div style="font-family:var(--DISP);font-size:1.4rem;color:var(--MU);" id="paused-count">1</div>
              <div style="font-size:.7rem;color:var(--MU);">Paused</div>
            </div>
            <div style="width:1px;background:var(--BD);"></div>
            <div style="text-align:center;padding:0 16px;">
              <div style="font-family:var(--DISP);font-size:1.4rem;color:var(--INK);" id="total-received">47</div>
              <div style="font-size:.7rem;color:var(--MU);">Emails In</div>
            </div>
          </div>
        </div>
      </div>

    </div>

    <!-- ── Alias table panel ── -->
    <div class="panel">
      <div class="panel-hd">
        <span class="panel-title">Your Aliases</span>
        <span class="panel-meta" id="panel-meta">3 aliases</span>
      </div>

      <!-- Toolbar -->
      <div class="tbar">
        <div class="tbar-search">
          <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <circle cx="11" cy="11" r="8"/>
            <path stroke-linecap="round" d="M21 21l-4.35-4.35"/>
          </svg>
          <input type="text" id="search-input" placeholder="Search aliases or labels…" oninput="filterAliases()"/>
        </div>
        <select class="tbar-select" id="status-filter" onchange="filterAliases()">
          <option value="all">All Status</option>
          <option value="active">Active</option>
          <option value="paused">Paused</option>
        </select>
        <select class="tbar-select" id="domain-filter" onchange="filterAliases()">
          <option value="all">All Domains</option>
          <option>dropit.io</option>
          <option>burnbox.dev</option>
          <option>zaptmp.net</option>
          <option>voidmail.cc</option>
          <option>mailsink.app</option>
        </select>
        <div class="tbar-ml">
          <button class="btn-ghost" onclick="exportCSV()" style="font-size:.76rem;padding:7px 12px;">
            <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
            Export CSV
          </button>
        </div>
      </div>

      <!-- Table -->
      <div style="overflow-x:auto;">
        <table class="alias-table" id="alias-table">
          <thead>
            <tr>
              <th>Alias Address</th>
              <th class="col-forward">Forwards To</th>
              <th>Status</th>
              <th class="col-received">Emails In</th>
              <th class="col-last-used">Last Used</th>
              <th style="text-align:right;padding-right:18px;">Actions</th>
            </tr>
          </thead>
          <tbody id="alias-tbody"></tbody>
        </table>
        <!-- Empty state -->
        <div class="empty-state" id="empty-state">
          <div class="empty-icon">
            <svg width="26" height="26" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
              <path stroke-linecap="round" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
            </svg>
          </div>
          <div class="empty-title">No aliases found</div>
          <div class="empty-sub">Try a different search or filter, or create your first alias.</div>
          <button class="btn-primary yellow" style="margin-top:4px;" onclick="openCreateModal()">
            <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
              <path stroke-linecap="round" d="M12 4v16m8-8H4"/>
            </svg>
            Create Alias
          </button>
        </div>
      </div>
    </div>

    <!-- ── How aliases work ── -->
    <div class="panel">
      <div class="panel-hd">
        <span class="panel-title">How Aliases Work</span>
      </div>
      <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(180px,1fr));gap:0;">
        <div style="padding:18px 20px;border-right:1px solid var(--BD2);">
          <div style="width:32px;height:32px;background:rgba(250,204,21,.12);border-radius:8px;display:flex;align-items:center;justify-content:center;color:var(--Y);margin-bottom:10px;">
            <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M12 4v16m8-8H4"/></svg>
          </div>
          <div style="font-weight:700;font-size:.84rem;color:var(--INK);margin-bottom:4px;">1. Create an alias</div>
          <div style="font-size:.76rem;color:var(--MU);line-height:1.55;">Pick a prefix and domain, optionally add a label and forward-to address.</div>
        </div>
        <div style="padding:18px 20px;border-right:1px solid var(--BD2);">
          <div style="width:32px;height:32px;background:rgba(59,130,246,.1);border-radius:8px;display:flex;align-items:center;justify-content:center;color:var(--B);margin-bottom:10px;">
            <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
          </div>
          <div style="font-weight:700;font-size:.84rem;color:var(--INK);margin-bottom:4px;">2. Use it anywhere</div>
          <div style="font-size:.76rem;color:var(--MU);line-height:1.55;">Share the alias instead of your real email — on sign-ups, newsletters, or contact forms.</div>
        </div>
        <div style="padding:18px 20px;border-right:1px solid var(--BD2);">
          <div style="width:32px;height:32px;background:rgba(16,185,129,.1);border-radius:8px;display:flex;align-items:center;justify-content:center;color:var(--GREEN);margin-bottom:10px;">
            <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
          </div>
          <div style="font-weight:700;font-size:.84rem;color:var(--INK);margin-bottom:4px;">3. Emails arrive here</div>
          <div style="font-size:.76rem;color:var(--MU);line-height:1.55;">All incoming mail lands in your InboxOro inbox — and optionally forwards to you.</div>
        </div>
        <div style="padding:18px 20px;">
          <div style="width:32px;height:32px;background:rgba(239,68,68,.08);border-radius:8px;display:flex;align-items:center;justify-content:center;color:var(--RED);margin-bottom:10px;">
            <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M10 9v6m4-6v6"/></svg>
          </div>
          <div style="font-weight:700;font-size:.84rem;color:var(--INK);margin-bottom:4px;">4. Pause or delete</div>
          <div style="font-size:.76rem;color:var(--MU);line-height:1.55;">Pause to stop receiving emails, or delete the alias entirely when you no longer need it.</div>
        </div>
      </div>
    </div>

  </div><!-- /main -->
</div><!-- /shell -->



<script>

/* ══════════════════════════════════════════════════
   ADDRESSES PAGE DATA & LOGIC
══════════════════════════════════════════════════ */

const FREE_LIMIT = 5;
const DOMAINS    = ['dropit.io','burnbox.dev','zaptmp.net','voidmail.cc','mailsink.app'];
const ADJ        = ['silent','ghost','turbo','vapor','swift','lunar','neon','flux','rogue','stealth'];
const NOU        = ['fox','wolf','tide','bolt','hawk','mint','storm','byte','nova','apex'];
const AVATARS    = ['#4285F4','#7C3AED','#10B981','#1DA1F2','#F59E0B','#EF4444','#6366F1','#14B8A6'];

function rndEl(arr) { return arr[Math.floor(Math.random() * arr.length)]; }
function autoPrefix() { return rndEl(ADJ) + '.' + rndEl(NOU) + (Math.floor(Math.random()*9000)+1000); }
function timeAgo(minsAgo) {
  if (!minsAgo) return 'Just now';
  if (minsAgo < 60)   return minsAgo + 'm ago';
  if (minsAgo < 1440) return Math.floor(minsAgo/60) + 'h ago';
  return Math.floor(minsAgo/1440) + 'd ago';
}

/* ── Seed data ── */
let ALIASES = [
  {
    id: 1,
    prefix: 'ghost.wolf2847',
    domain: 'dropit.io',
    label: 'Google sign-ups',
    forward: 'john@gmail.com',
    status: 'active',
    received: 14,
    last_used: 2,
    color: '#4285F4',
  },
  {
    id: 2,
    prefix: 'shopping-alias',
    domain: 'burnbox.dev',
    label: 'Online shopping',
    forward: 'john@gmail.com',
    status: 'active',
    received: 38,
    last_used: 60,
    color: '#7C3AED',
  },
  {
    id: 3,
    prefix: 'news.reader991',
    domain: 'zaptmp.net',
    label: 'Newsletters',
    forward: '',
    status: 'paused',
    received: 7,
    last_used: 2880,
    color: '#F59E0B',
  },
];
let nextId   = 4;
let editingId = null;

/* ── UI helpers ── */
function showToast(msg, type) {
  const t = document.getElementById('toast');
  const dot = t.querySelector('.toast-dot');
  dot.style.background = type === 'err' ? 'var(--RED)' : 'var(--GREEN)';
  t.querySelector('span').textContent = msg;
  t.classList.add('show');
  setTimeout(() => t.classList.remove('show'), 2600);
}

function updateStats() {
  const used   = ALIASES.length;
  const active = ALIASES.filter(a => a.status === 'active').length;
  const paused = ALIASES.filter(a => a.status === 'paused').length;
  const total  = ALIASES.reduce((s, a) => s + a.received, 0);
  const pct    = Math.round((used / FREE_LIMIT) * 100);

  document.getElementById('used-count').textContent    = used;
  document.getElementById('active-count').textContent  = active;
  document.getElementById('paused-count').textContent  = paused;
  document.getElementById('total-received').textContent = total;
  document.getElementById('page-sub').textContent      = used + ' alias' + (used !== 1 ? 'es' : '') + ' · ' + FREE_LIMIT + ' max (Free)';
  document.getElementById('panel-meta').textContent    = used + ' alias' + (used !== 1 ? 'es' : '');

  const fill = document.getElementById('usage-bar-fill');
  const pctLbl = document.getElementById('usage-pct-lbl');
  fill.style.width = pct + '%';
  fill.className = 'usage-bar-fill ' + (pct >= 100 ? 'full' : pct >= 80 ? 'warning' : 'ok');
  pctLbl.style.color = pct >= 100 ? 'var(--RED)' : pct >= 80 ? '#92400E' : 'var(--GREEN)';
  pctLbl.textContent = pct + '% used';

  // Upgrade banner
  const banner = document.getElementById('upgrade-banner');
  banner.style.display = used >= FREE_LIMIT ? 'flex' : 'none';
  document.getElementById('banner-limit').textContent = FREE_LIMIT;

  // Disable create button when at limit
  const btn = document.getElementById('create-btn');
  btn.disabled = used >= FREE_LIMIT;
  btn.title    = used >= FREE_LIMIT ? 'Upgrade to create more aliases' : '';
}

/* ── Table rendering ── */
function getVisible() {
  const search = document.getElementById('search-input').value.toLowerCase();
  const status = document.getElementById('status-filter').value;
  const domain = document.getElementById('domain-filter').value;
  return ALIASES.filter(a => {
    const matchSearch = !search || a.prefix.includes(search) || a.domain.includes(search) || (a.label||'').toLowerCase().includes(search);
    const matchStatus = status === 'all' || a.status === status;
    const matchDomain = domain === 'all' || a.domain === domain;
    return matchSearch && matchStatus && matchDomain;
  });
}

function renderTable() {
  const list  = getVisible();
  const tbody = document.getElementById('alias-tbody');
  const empty = document.getElementById('empty-state');

  updateStats();

  if (!list.length) {
    tbody.innerHTML = '';
    empty.classList.add('show');
    return;
  }
  empty.classList.remove('show');

  tbody.innerHTML = list.map(a => {
    const email  = a.prefix + '@' + a.domain;
    const initials = a.domain.substring(0,2).toUpperCase();
    const stCls  = a.status === 'active' ? 'active' : 'paused';
    const stLbl  = a.status === 'active' ? '● Active' : '⏸ Paused';
    return `
      <tr data-id="${a.id}">
        <td>
          <div class="alias-cell">
            <div class="alias-avatar" style="background:${a.color};">${initials}</div>
            <div style="min-width:0;">
              <div class="alias-email" title="${email}">${email}</div>
              ${a.label
                ? `<div class="alias-label">
                     <svg width="10" height="10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="display:inline;vertical-align:middle;color:var(--MU2);">
                       <path stroke-linecap="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A2 2 0 013 12V7a4 4 0 014-4z"/>
                     </svg>
                     ${a.label}
                   </div>`
                : '<div class="alias-label" style="color:var(--MU2);">No label</div>'
              }
            </div>
          </div>
        </td>
        <td class="col-forward">
          ${a.forward
            ? `<span class="forward-pill">
                 <svg width="10" height="10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                 ${a.forward}
               </span>`
            : `<span style="font-size:.76rem;color:var(--MU2);">No forwarding</span>`
          }
        </td>
        <td>
          <button class="status-toggle ${stCls}" onclick="toggleAliasStatus(${a.id})">
            <span class="st-dot"></span>
            ${stLbl}
          </button>
        </td>
        <td class="col-received">
          <span style="font-family:var(--MONO);font-size:.8rem;font-weight:600;color:var(--INK);">${a.received}</span>
        </td>
        <td class="col-last-used">
          <span style="font-size:.78rem;color:var(--MU);">${timeAgo(a.last_used)}</span>
        </td>
        <td>
          <div class="row-acts">
            <button class="act-btn copy" title="Copy alias" onclick="copyAlias(${a.id})">
              <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <rect x="9" y="9" width="13" height="13" rx="2"/>
                <path stroke-linecap="round" d="M5 15H4a2 2 0 01-2-2V4a2 2 0 012-2h9a2 2 0 012 2v1"/>
              </svg>
            </button>
            <button class="act-btn edit" title="Edit alias" onclick="openEditModal(${a.id})">
              <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
              </svg>
            </button>
            <button class="act-btn del" title="Delete alias" onclick="deleteAlias(${a.id})">
              <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <polyline points="3 6 5 6 21 6"/>
                <path stroke-linecap="round" d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6m5 0V4a1 1 0 011-1h2a1 1 0 011 1v2"/>
              </svg>
            </button>
          </div>
        </td>
      </tr>`;
  }).join('');
}

function filterAliases() { renderTable(); }

/* ── Row actions ── */
function copyAlias(id) {
  const a = ALIASES.find(x => x.id === id);
  if (!a) return;
  const email = a.prefix + '@' + a.domain;
  navigator.clipboard.writeText(email).catch(() => {});
  showToast('Copied: ' + email);
}

function toggleAliasStatus(id) {
  const a = ALIASES.find(x => x.id === id);
  if (!a) return;
  a.status = a.status === 'active' ? 'paused' : 'active';
  renderTable();
  showToast(a.status === 'active' ? 'Alias activated' : 'Alias paused');
}

function deleteAlias(id) {
  if (!confirm('Delete this alias? This cannot be undone.')) return;
  const row = document.querySelector(`tr[data-id="${id}"]`);
  if (row) {
    row.style.opacity = '0'; row.style.transform = 'translateX(8px)';
    row.style.transition = 'all .22s';
    setTimeout(() => {
      ALIASES = ALIASES.filter(a => a.id !== id);
      renderTable();
    }, 220);
  } else {
    ALIASES = ALIASES.filter(a => a.id !== id);
    renderTable();
  }
  showToast('Alias deleted');
}

/* ── Modal ── */
function resetModal() {
  document.getElementById('alias-prefix').value      = '';
  document.getElementById('alias-label-inp').value   = '';
  document.getElementById('alias-forward').value     = '';
  document.getElementById('alias-domain').value      = 'dropit.io';
  document.getElementById('alias-input-wrap').classList.remove('err');
  document.getElementById('prefix-err').classList.remove('show');
  document.getElementById('forward-err').classList.remove('show');
  const sw = document.getElementById('status-toggle');
  sw.classList.add('on'); sw._active = true;
}

function openCreateModal() {
  if (ALIASES.length >= FREE_LIMIT) {
    showToast('Alias limit reached — upgrade to Pro', 'err');
    return;
  }
  editingId = null;
  resetModal();
  document.getElementById('modal-title').textContent    = 'Create Alias';
  document.getElementById('modal-save-lbl').textContent = 'Create Alias';
  document.getElementById('alias-modal').classList.add('open');
}

function openEditModal(id) {
  const a = ALIASES.find(x => x.id === id);
  if (!a) return;
  editingId = id;
  resetModal();
  document.getElementById('alias-prefix').value    = a.prefix;
  document.getElementById('alias-label-inp').value = a.label || '';
  document.getElementById('alias-forward').value   = a.forward || '';
  document.getElementById('alias-domain').value    = a.domain;

  const sw = document.getElementById('status-toggle');
  sw._active = a.status === 'active';
  sw.classList.toggle('on', a.status === 'active');

  document.getElementById('modal-title').textContent    = 'Edit Alias';
  document.getElementById('modal-save-lbl').textContent = 'Save Changes';
  document.getElementById('alias-modal').classList.add('open');
}

function closeModal() {
  document.getElementById('alias-modal').classList.remove('open');
  editingId = null;
}

function toggleStatus(btn) {
  btn._active = !btn._active;
  btn.classList.toggle('on', btn._active);
}

function validatePrefix(inp) {
  const v = inp.value;
  const ok = !v || /^[a-z0-9][a-z0-9._-]{1,38}$/.test(v);
  document.getElementById('alias-input-wrap').classList.toggle('err', !ok && v.length > 0);
  document.getElementById('prefix-err').classList.toggle('show', !ok && v.length > 0);
  return ok || !v;
}

function validateForward(inp) {
  const v = inp.value;
  const ok = !v || /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(v);
  inp.classList.toggle('err', !ok && v.length > 0);
  document.getElementById('forward-err').classList.toggle('show', !ok && v.length > 0);
  return ok || !v;
}

function saveAlias() {
  const prefix  = document.getElementById('alias-prefix').value.trim();
  const domain  = document.getElementById('alias-domain').value;
  const label   = document.getElementById('alias-label-inp').value.trim();
  const forward = document.getElementById('alias-forward').value.trim();
  const sw      = document.getElementById('status-toggle');
  const active  = sw._active !== false;

  // Validate prefix
  const pfx = prefix || autoPrefix();
  if (prefix && !/^[a-z0-9][a-z0-9._-]{1,38}$/.test(prefix)) {
    document.getElementById('alias-input-wrap').classList.add('err');
    document.getElementById('prefix-err').classList.add('show');
    return;
  }
  if (!validateForward(document.getElementById('alias-forward'))) return;

  // Check duplicate
  const email = pfx + '@' + domain;
  const dup   = ALIASES.find(a => a.prefix === pfx && a.domain === domain && a.id !== editingId);
  if (dup) { showToast('That alias already exists', 'err'); return; }

  if (editingId) {
    // Edit
    const a = ALIASES.find(x => x.id === editingId);
    if (a) { a.prefix = pfx; a.domain = domain; a.label = label; a.forward = forward; a.status = active ? 'active' : 'paused'; }
    showToast('Alias updated: ' + email);
  } else {
    // Create
    if (ALIASES.length >= FREE_LIMIT) { showToast('Alias limit reached', 'err'); return; }
    ALIASES.push({
      id: nextId++,
      prefix: pfx, domain, label, forward,
      status: active ? 'active' : 'paused',
      received: 0, last_used: 0,
      color: rndEl(AVATARS),
    });
    showToast('Alias created: ' + email);
  }

  closeModal();
  renderTable();
}

/* ── Export ── */
function exportCSV() {
  const rows = [['Alias','Domain','Label','Forward To','Status','Emails Received','Last Used']];
  ALIASES.forEach(a => rows.push([
    a.prefix + '@' + a.domain, a.domain, a.label || '', a.forward || '',
    a.status, a.received, timeAgo(a.last_used)
  ]));
  const csv  = rows.map(r => r.map(c => '"' + String(c).replace(/"/g,'""') + '"').join(',')).join('\\n');
  const blob = new Blob([csv], {type:'text/csv'});
  const url  = URL.createObjectURL(blob);
  const el   = document.createElement('a'); el.href = url; el.download = 'aliases.csv'; el.click();
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

/* ── Keyboard ── */
document.addEventListener('keydown', e => {
  if (e.key === 'Escape') closeModal();
  if (e.key === 'n' && !e.ctrlKey && !e.metaKey && document.activeElement.tagName !== 'INPUT') openCreateModal();
});

/* ── Sidebar (dashboard pattern) ── */
const sidebar    = document.getElementById('sidebar');
const backdrop   = document.getElementById('sb-backdrop');
const toggleBtn  = document.getElementById('sb-toggle-btn');
const collapseBtn= document.getElementById('sb-collapse-btn');
let isCollapsed  = false;
const isMob      = () => window.innerWidth < 900;

if (toggleBtn) toggleBtn.addEventListener('click', () => {
  if (isMob()) { const open = sidebar.classList.toggle('mob-open'); backdrop.classList.toggle('show', open); }
  else collapseSidebar(!isCollapsed);
});
if (collapseBtn) collapseBtn.addEventListener('click', () => collapseSidebar(!isCollapsed));
function collapseSidebar(c) { isCollapsed = c; sidebar.classList.toggle('collapsed', c); document.body.classList.toggle('sb-collapsed', c); }
function closeMobileSb() { sidebar.classList.remove('mob-open'); backdrop.classList.remove('show'); }
window.addEventListener('resize', () => { if (!isMob()) closeMobileSb(); });
function toggleUserDd() { document.getElementById('user-dd').classList.toggle('open'); }
document.addEventListener('click', e => { if (!e.target.closest('#tb-av')) document.getElementById('user-dd')?.classList.remove('open'); });

/* ── Boot ── */
renderTable();
</script>
</body>
</html>