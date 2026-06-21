<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>InboxOro — Domains</title>
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
/* ══════════════════════════════════════════
   DOMAINS PAGE
══════════════════════════════════════════ */

/* ── Stat cards ── */
.stat-row {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 12px;
  margin-bottom: 24px;
}
@media (min-width: 640px) { .stat-row { grid-template-columns: repeat(4, 1fr); } }

.stat-c {
  background: var(--SURF);
  border: 1px solid var(--BD);
  border-radius: 12px;
  padding: 16px 18px;
  position: relative;
  overflow: hidden;
  transition: box-shadow .2s, transform .15s;
}
.stat-c:hover { box-shadow: 0 4px 16px rgba(0,0,0,.07); transform: translateY(-1px); }
.stat-c-top {
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
  margin-bottom: 12px;
}
.stat-c-icon {
  width: 36px; height: 36px;
  border-radius: 9px;
  display: flex; align-items: center; justify-content: center;
}
.sci-y { background: rgba(250,204,21,.15); color: #92400E; }
.sci-g { background: rgba(16,185,129,.12);  color: var(--GREEN); }
.sci-b { background: rgba(59,130,246,.12);  color: var(--B); }
.sci-p { background: rgba(124,58,237,.1);   color: #7C3AED; }
.stat-c-val { font-family: var(--DISP); font-size: 2rem; color: var(--INK); line-height: 1; }
.stat-c-lbl { font-size: .74rem; color: var(--MU); font-weight: 500; margin-top: 3px; }
.stat-c-sub { font-size: .68rem; margin-top: 5px; }

/* ── Section title ── */
.section-hd {
  display: flex; align-items: center; justify-content: space-between;
  margin-bottom: 14px; gap: 10px; flex-wrap: wrap;
}
.section-hd-title {
  font-family: var(--DISP);
  font-size: 1.15rem;
  letter-spacing: .04em;
  color: var(--INK);
  display: flex; align-items: center; gap: 8px;
}
.section-hd-meta {
  font-family: var(--MONO);
  font-size: .62rem;
  color: var(--MU);
}

/* ── Current domain hero card ── */
.current-domain-card {
  background: var(--INK);
  border-radius: 14px;
  padding: 22px 24px;
  margin-bottom: 28px;
  position: relative;
  overflow: hidden;
  display: flex;
  align-items: flex-start;
  gap: 20px;
  flex-wrap: wrap;
}
.current-domain-card::before {
  content: '';
  position: absolute;
  top: 0; left: 0; right: 0;
  height: 3px;
  background: linear-gradient(90deg, var(--Y), #F59E0B 50%, var(--Y));
  background-size: 200% 100%;
  animation: shimmer 3s linear infinite;
}
@keyframes shimmer { 0%{background-position:200% 0} 100%{background-position:-200% 0} }

.cd-blob {
  position: absolute;
  border-radius: 50%;
  pointer-events: none;
}
.cd-blob-1 { width:260px; height:260px; background:radial-gradient(circle,rgba(250,204,21,.1) 0,transparent 70%); top:-80px; right:-60px; }
.cd-blob-2 { width:180px; height:180px; background:radial-gradient(circle,rgba(59,130,246,.07) 0,transparent 70%); bottom:-60px; left:0; }

.cd-icon {
  width: 50px; height: 50px; min-width: 50px;
  background: rgba(250,204,21,.12);
  border: 1px solid rgba(250,204,21,.2);
  border-radius: 12px;
  display: flex; align-items: center; justify-content: center;
  color: var(--Y);
  flex-shrink: 0;
}

.cd-body { flex: 1; min-width: 0; }
.cd-label {
  font-family: var(--MONO);
  font-size: .6rem; font-weight: 700;
  letter-spacing: .12em; text-transform: uppercase;
  color: rgba(250,204,21,.6);
  margin-bottom: 6px;
}
.cd-name {
  font-family: var(--DISP);
  font-size: clamp(1.4rem, 4vw, 2rem);
  letter-spacing: .04em;
  color: #fff;
  line-height: 1;
  margin-bottom: 12px;
}
.cd-name span { color: var(--Y); }

.cd-features {
  display: flex; gap: 8px; flex-wrap: wrap;
}
.cd-feat {
  display: inline-flex; align-items: center; gap: 5px;
  background: rgba(255,255,255,.07);
  border: 1px solid rgba(255,255,255,.1);
  border-radius: 20px;
  padding: 4px 12px;
  font-size: .72rem;
  color: rgba(255,255,255,.7);
}
.cd-feat svg { color: var(--Y); flex-shrink: 0; }
.cd-feat.active { background: rgba(16,185,129,.12); border-color: rgba(16,185,129,.25); color: rgba(255,255,255,.9); }
.cd-feat.active svg { color: var(--GREEN); }

.cd-actions {
  display: flex;
  flex-direction: column;
  align-items: flex-end;
  gap: 10px;
  flex-shrink: 0;
}

.cd-status {
  display: inline-flex; align-items: center; gap: 6px;
  background: rgba(16,185,129,.15);
  border: 1px solid rgba(16,185,129,.3);
  border-radius: 20px;
  padding: 4px 12px;
  font-family: var(--MONO);
  font-size: .62rem; font-weight: 700;
  color: var(--GREEN);
}
.cd-pulse {
  width: 6px; height: 6px;
  background: var(--GREEN);
  border-radius: 50%;
  animation: pulse-green 2s ease-in-out infinite;
}
@keyframes pulse-green {
  0%,100%{ box-shadow: 0 0 0 0 rgba(16,185,129,.5); }
  50%     { box-shadow: 0 0 0 4px rgba(16,185,129,0); }
}

/* ── Domain cards grid ── */
.domain-grid {
  display: grid;
  grid-template-columns: 1fr;
  gap: 14px;
  margin-bottom: 28px;
}
@media (min-width: 580px) { .domain-grid { grid-template-columns: repeat(2, 1fr); } }
@media (min-width: 900px) { .domain-grid { grid-template-columns: repeat(3, 1fr); } }

/* ── Domain card ── */
.domain-card {
  background: var(--SURF);
  border: 1.5px solid var(--BD);
  border-radius: 14px;
  padding: 20px;
  display: flex;
  flex-direction: column;
  gap: 14px;
  position: relative;
  overflow: hidden;
  transition: border-color .2s, box-shadow .2s, transform .15s;
  cursor: pointer;
}
.domain-card:hover {
  border-color: #D1D5DB;
  box-shadow: 0 6px 24px rgba(0,0,0,.08);
  transform: translateY(-2px);
}
/* Selected state */
.domain-card.selected {
  border-color: var(--Y);
  background: #FFFBEB;
  box-shadow: 0 0 0 3px rgba(250,204,21,.18), 0 8px 24px rgba(0,0,0,.08);
}
.domain-card.selected::before {
  content: '';
  position: absolute;
  top: 0; left: 0; right: 0;
  height: 3px;
  background: var(--Y);
  border-radius: 14px 14px 0 0;
}
/* Premium state */
.domain-card.premium {
  background: linear-gradient(135deg, #0F172A 0%, #1E1B4B 100%);
  border-color: rgba(124,58,237,.3);
}
.domain-card.premium:hover {
  border-color: rgba(124,58,237,.6);
  box-shadow: 0 6px 24px rgba(124,58,237,.15);
}
.domain-card.premium.selected {
  border-color: #7C3AED;
  background: linear-gradient(135deg, #0F172A 0%, #2E1065 100%);
  box-shadow: 0 0 0 3px rgba(124,58,237,.2), 0 8px 24px rgba(0,0,0,.2);
}

/* Card top row */
.dc-top {
  display: flex; align-items: flex-start; justify-content: space-between; gap: 8px;
}
.dc-icon {
  width: 40px; height: 40px;
  border-radius: 10px;
  display: flex; align-items: center; justify-content: center;
  flex-shrink: 0;
}
.dc-icon.free    { background: rgba(250,204,21,.12); color: #92400E; }
.dc-icon.premium { background: rgba(124,58,237,.2);  color: #A78BFA; }
.dc-icon.selected-ic { background: rgba(250,204,21,.2); color: var(--INK); }

/* Type badge */
.dc-type {
  display: inline-flex; align-items: center; gap: 4px;
  font-family: var(--MONO); font-size: .56rem; font-weight: 800;
  padding: 3px 9px; border-radius: 20px;
  letter-spacing: .06em; text-transform: uppercase;
  flex-shrink: 0;
}
.dc-type.free    { background: rgba(16,185,129,.1);  color: var(--GREEN); }
.dc-type.premium { background: rgba(124,58,237,.15); color: #A78BFA; }
.dc-type.popular { background: rgba(250,204,21,.15); color: #92400E; }

/* Domain name */
.dc-name {
  font-family: var(--MONO);
  font-size: clamp(.84rem, 2vw, 1rem);
  font-weight: 700;
  color: var(--INK);
  letter-spacing: -.01em;
  word-break: break-all;
}
.domain-card.premium .dc-name { color: #fff; }
.domain-card.selected .dc-name { color: var(--INK); }

.dc-desc {
  font-size: .74rem;
  color: var(--MU);
  line-height: 1.5;
  margin-top: 2px;
}
.domain-card.premium .dc-desc { color: rgba(255,255,255,.5); }

/* Feature pills */
.dc-features {
  display: flex; flex-wrap: wrap; gap: 6px;
}
.dc-feat {
  display: inline-flex; align-items: center; gap: 4px;
  font-size: .68rem; font-weight: 500;
  padding: 3px 9px; border-radius: 6px;
}
.dc-feat.on  {
  background: rgba(16,185,129,.08);
  color: #065F46; border: 1px solid rgba(16,185,129,.2);
}
.dc-feat.off {
  background: var(--BD2); color: var(--MU2);
  border: 1px solid var(--BD);
  text-decoration: line-through;
}
.domain-card.premium .dc-feat.on {
  background: rgba(167,139,250,.12);
  color: #A78BFA; border-color: rgba(167,139,250,.2);
}
.domain-card.premium .dc-feat.off {
  background: rgba(255,255,255,.05);
  color: rgba(255,255,255,.3); border-color: rgba(255,255,255,.08);
}

/* stats row inside card */
.dc-stats {
  display: flex; gap: 14px;
  padding-top: 12px;
  border-top: 1px solid var(--BD2);
}
.domain-card.premium .dc-stats { border-top-color: rgba(255,255,255,.08); }
.dc-stat-item { flex: 1; text-align: center; }
.dc-stat-val {
  font-family: var(--DISP); font-size: 1.1rem;
  color: var(--INK); line-height: 1;
}
.domain-card.premium .dc-stat-val { color: #fff; }
.dc-stat-lbl {
  font-size: .62rem; color: var(--MU2); margin-top: 2px;
}

/* Card action button */
.dc-btn {
  width: 100%;
  padding: 10px 16px;
  border-radius: 9px;
  font-size: .8rem; font-weight: 700;
  display: flex; align-items: center; justify-content: center;
  gap: 6px; cursor: pointer;
  transition: background .15s, transform .1s, box-shadow .15s;
  border: none; font-family: var(--BODY);
}
.dc-btn.select  {
  background: var(--INK); color: #fff;
}
.dc-btn.select:hover { background: var(--INK2); box-shadow: 0 4px 12px rgba(0,0,0,.15); transform: translateY(-1px); }
.dc-btn.selected {
  background: var(--Y); color: var(--INK);
  cursor: default;
}
.dc-btn.upgrade {
  background: linear-gradient(135deg, #7C3AED, #6D28D9);
  color: #fff;
}
.dc-btn.upgrade:hover { opacity: .9; box-shadow: 0 4px 16px rgba(124,58,237,.3); transform: translateY(-1px); }

/* Premium lock overlay */
.dc-lock {
  position: absolute; top: 14px; right: 14px;
  width: 28px; height: 28px;
  background: rgba(124,58,237,.2);
  border: 1px solid rgba(124,58,237,.3);
  border-radius: 8px;
  display: flex; align-items: center; justify-content: center;
  color: #A78BFA;
}

/* ── Upgrade card ── */
.upgrade-card {
  background: var(--INK);
  border-radius: 16px;
  padding: 28px 28px;
  display: grid;
  grid-template-columns: 1fr;
  gap: 24px;
  position: relative;
  overflow: hidden;
  margin-bottom: 8px;
}
@media (min-width: 720px) {
  .upgrade-card { grid-template-columns: 1fr 1fr; align-items: center; }
}
.upgrade-card::before {
  content: '';
  position: absolute; top:0; left:0; right:0; height:2px;
  background: linear-gradient(90deg, #7C3AED, var(--Y), #7C3AED);
  background-size: 200% 100%;
  animation: shimmer 3s linear infinite;
}
.uc-blob-1 { position:absolute; width:300px; height:300px; border-radius:50%; background:radial-gradient(circle,rgba(124,58,237,.15) 0,transparent 70%); top:-100px; right:-80px; pointer-events:none; }
.uc-blob-2 { position:absolute; width:200px; height:200px; border-radius:50%; background:radial-gradient(circle,rgba(250,204,21,.08) 0,transparent 70%); bottom:-60px; left:40px; pointer-events:none; }

.uc-eyebrow {
  display: inline-flex; align-items: center; gap: 6px;
  font-family: var(--MONO); font-size: .58rem; font-weight: 700;
  letter-spacing: .12em; text-transform: uppercase;
  color: var(--Y); background: rgba(250,204,21,.1);
  border: 1px solid rgba(250,204,21,.2);
  padding: 4px 10px; border-radius: 20px;
  margin-bottom: 12px; width: fit-content;
}
.uc-eyebrow::before { content:''; width:5px; height:5px; background:var(--Y); border-radius:50%; animation:blink 1.2s step-end infinite; }
@keyframes blink { 0%,100%{opacity:1} 50%{opacity:0} }

.uc-title {
  font-family: var(--DISP);
  font-size: clamp(1.5rem, 4vw, 2.2rem);
  color: #fff; letter-spacing: .04em; line-height: 1;
  margin-bottom: 8px;
}
.uc-title span { color: var(--Y); }

.uc-sub { font-size: .84rem; color: rgba(255,255,255,.5); line-height: 1.6; margin-bottom: 16px; }

.uc-benefits {
  display: flex; flex-direction: column; gap: 8px;
}
.uc-benefit {
  display: flex; align-items: center; gap: 10px;
  font-size: .82rem; color: rgba(255,255,255,.75);
}
.uc-check {
  width: 20px; height: 20px; min-width: 20px;
  background: rgba(16,185,129,.15);
  border-radius: 50%;
  display: flex; align-items: center; justify-content: center;
  color: var(--GREEN); flex-shrink: 0;
}

.uc-cta {
  display: inline-flex; align-items: center; gap: 8px;
  background: var(--Y); color: var(--INK);
  font-size: .9rem; font-weight: 700;
  padding: 13px 24px; border-radius: 10px;
  cursor: pointer; border: none; font-family: var(--BODY);
  transition: background .15s, transform .1s, box-shadow .15s;
  width: fit-content;
}
.uc-cta:hover { background: #EAB800; transform: translateY(-1px); box-shadow: 0 6px 20px rgba(250,204,21,.3); }

.uc-plans {
  display: flex; gap: 10px; margin-top: 12px; flex-wrap: wrap;
}
.uc-plan-badge {
  display: inline-flex; align-items: center; gap: 5px;
  background: rgba(255,255,255,.06);
  border: 1px solid rgba(255,255,255,.1);
  border-radius: 8px; padding: 6px 12px;
  font-size: .72rem; color: rgba(255,255,255,.6);
}
.uc-plan-badge .price { font-family: var(--DISP); font-size: 1rem; color: var(--Y); line-height: 1; }
.uc-plan-badge .period { font-size: .62rem; color: rgba(255,255,255,.4); }

/* ── Right side visual ── */
.uc-visual {
  display: flex; flex-direction: column; gap: 10px;
  position: relative; z-index: 1;
}
.uc-domain-pill {
  display: flex; align-items: center; gap: 10px;
  background: rgba(255,255,255,.06);
  border: 1px solid rgba(255,255,255,.1);
  border-radius: 10px; padding: 10px 14px;
  transition: border-color .15s, background .15s;
}
.uc-domain-pill:hover { background: rgba(255,255,255,.1); border-color: rgba(255,255,255,.2); }
.udp-icon {
  width: 32px; height: 32px; border-radius: 8px;
  display: flex; align-items: center; justify-content: center;
  flex-shrink: 0; font-size: .62rem; font-weight: 800;
  font-family: var(--MONO);
}
.udp-name { font-family: var(--MONO); font-size: .8rem; font-weight: 700; color: #fff; }
.udp-badge {
  margin-left: auto; font-family: var(--MONO); font-size: .54rem;
  font-weight: 800; padding: 2px 8px; border-radius: 10px;
}
.udp-badge.pro { background: rgba(124,58,237,.2); color: #A78BFA; }
.udp-badge.exclusive { background: rgba(250,204,21,.15); color: var(--Y); }

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

  <!-- ══════════ MAIN ══════════ -->
  <div class="main" id="main">

    <!-- ── Page Header ── -->
    <div class="page-hd">
      <div>
        <div class="page-title">Domains</div>
        <div class="page-subtitle">Manage and select domains for temporary emails and aliases.</div>
      </div>
      <button class="btn-ghost" onclick="refreshPage()">
        <svg id="refresh-ic" width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
          <path stroke-linecap="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
        </svg>
        Refresh
      </button>
    </div>

    <!-- ── Stat cards ── -->
    <div class="stat-row">

      <div class="stat-c">
        <div class="stat-c-top">
          <div class="stat-c-icon sci-y">
            <svg width="17" height="17" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
              <circle cx="12" cy="12" r="10"/>
              <path stroke-linecap="round" d="M2 12h20M12 2a15.3 15.3 0 010 20M12 2a15.3 15.3 0 000 20"/>
            </svg>
          </div>
        </div>
        <div class="stat-c-val" id="stat-total">9</div>
        <div class="stat-c-lbl">Total Domains</div>
        <div class="stat-c-sub" style="color:var(--MU2);">5 free · 4 premium</div>
      </div>

      <div class="stat-c">
        <div class="stat-c-top">
          <div class="stat-c-icon sci-g">
            <svg width="17" height="17" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
          </div>
        </div>
        <div class="stat-c-val">5</div>
        <div class="stat-c-lbl">Free Domains</div>
        <div class="stat-c-sub" style="color:var(--GREEN);">Available on all plans</div>
      </div>

      <div class="stat-c">
        <div class="stat-c-top">
          <div class="stat-c-icon sci-p">
            <svg width="17" height="17" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
            </svg>
          </div>
        </div>
        <div class="stat-c-val">4</div>
        <div class="stat-c-lbl">Premium Domains</div>
        <div class="stat-c-sub" style="color:#A78BFA;">Pro plan required</div>
      </div>

      <div class="stat-c" id="active-stat-card">
        <div class="stat-c-top">
          <div class="stat-c-icon sci-b">
            <svg width="17" height="17" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" d="M13 10V3L4 14h7v7l9-11h-7z"/>
            </svg>
          </div>
          <div style="display:flex;align-items:center;gap:4px;">
            <div style="width:6px;height:6px;background:var(--GREEN);border-radius:50%;animation:pulse-green 2s ease-in-out infinite;"></div>
            <span style="font-family:var(--MONO);font-size:.58rem;font-weight:700;color:var(--GREEN);">ACTIVE</span>
          </div>
        </div>
        <div class="stat-c-val" id="stat-active-domain" style="font-size:1.1rem;font-family:var(--MONO);">dropit.io</div>
        <div class="stat-c-lbl">Current Domain</div>
        <div class="stat-c-sub" style="color:var(--MU2);">In use right now</div>
      </div>

    </div>

    <!-- ── Current domain card ── -->
    <div class="section-hd">
      <div class="section-hd-title">
        <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
          <path stroke-linecap="round" d="M13 10V3L4 14h7v7l9-11h-7z"/>
        </svg>
        Current Active Domain
      </div>
    </div>

    <div class="current-domain-card">
      <div class="cd-blob cd-blob-1"></div>
      <div class="cd-blob cd-blob-2"></div>

      <div class="cd-icon">
        <svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
          <circle cx="12" cy="12" r="10"/>
          <path stroke-linecap="round" d="M2 12h20M12 2a15.3 15.3 0 010 20M12 2a15.3 15.3 0 000 20"/>
        </svg>
      </div>

      <div class="cd-body">
        <div class="cd-label">Active Domain</div>
        <div class="cd-name" id="current-domain-name">@<span>dropit.io</span></div>
        <div class="cd-features">
          <div class="cd-feat active">
            <svg width="11" height="11" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M5 13l4 4L19 7"/></svg>
            Temporary Email
          </div>
          <div class="cd-feat active">
            <svg width="11" height="11" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M5 13l4 4L19 7"/></svg>
            Alias Support
          </div>
          <div class="cd-feat active">
            <svg width="11" height="11" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M5 13l4 4L19 7"/></svg>
            OTP Detection
          </div>
          <div class="cd-feat active">
            <svg width="11" height="11" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M5 13l4 4L19 7"/></svg>
            Free Plan
          </div>
        </div>
      </div>

      <div class="cd-actions">
        <div class="cd-status">
          <div class="cd-pulse"></div>
          Status: Active
        </div>
        <button class="btn-ghost" style="background:rgba(255,255,255,.07);border-color:rgba(255,255,255,.15);color:rgba(255,255,255,.8);font-size:.78rem;" onclick="scrollToDomains()">
          <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/>
          </svg>
          Change Domain
        </button>
      </div>
    </div>

    <!-- ── Available domains ── -->
    <div class="section-hd" id="domains-section">
      <div class="section-hd-title">
        <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
          <circle cx="12" cy="12" r="10"/>
          <path stroke-linecap="round" d="M2 12h20M12 2a15.3 15.3 0 010 20M12 2a15.3 15.3 0 000 20"/>
        </svg>
        Available Domains
      </div>
      <div style="display:flex;align-items:center;gap:8px;">
        <div style="display:flex;align-items:center;gap:5px;font-size:.72rem;color:var(--MU);">
          <span style="width:8px;height:8px;background:var(--GREEN);border-radius:50%;display:inline-block;"></span>Free
        </div>
        <div style="display:flex;align-items:center;gap:5px;font-size:.72rem;color:var(--MU);">
          <span style="width:8px;height:8px;background:#A78BFA;border-radius:50%;display:inline-block;"></span>Premium
        </div>
      </div>
    </div>

    <div class="domain-grid" id="domain-grid">
      <!-- Cards injected by JS -->
    </div>

    <!-- ── Upgrade card ── -->
    <div class="upgrade-card">
      <div class="uc-blob-1"></div>
      <div class="uc-blob-2"></div>

      <div style="position:relative;z-index:1;">
        <div class="uc-eyebrow">Pro Plan</div>
        <div class="uc-title">Unlock <span>Premium</span> Domains</div>
        <div class="uc-sub">Get access to exclusive high-reputation domains, better inbox delivery rates, and custom domain support.</div>

        <div class="uc-benefits">
          <div class="uc-benefit">
            <div class="uc-check">
              <svg width="11" height="11" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M5 13l4 4L19 7"/></svg>
            </div>
            Exclusive premium domain names
          </div>
          <div class="uc-benefit">
            <div class="uc-check">
              <svg width="11" height="11" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M5 13l4 4L19 7"/></svg>
            </div>
            Better email reputation &amp; delivery
          </div>
          <div class="uc-benefit">
            <div class="uc-check">
              <svg width="11" height="11" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M5 13l4 4L19 7"/></svg>
            </div>
            Add your own custom domain
          </div>
          <div class="uc-benefit">
            <div class="uc-check">
              <svg width="11" height="11" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M5 13l4 4L19 7"/></svg>
            </div>
            Priority email delivery &amp; support
          </div>
        </div>

        <div style="margin-top:20px;display:flex;align-items:center;gap:14px;flex-wrap:wrap;">
          <button class="uc-cta">
            <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
              <path stroke-linecap="round" d="M13 10V3L4 14h7v7l9-11h-7z"/>
            </svg>
            Upgrade to Pro
          </button>
          <a href="#" style="font-family:var(--MONO);font-size:.68rem;font-weight:700;color:rgba(255,255,255,.4);text-decoration:none;letter-spacing:.06em;">
            View all plans →
          </a>
        </div>

        <div class="uc-plans">
          <div class="uc-plan-badge">
            <div>
              <div class="price">$4<span style="font-family:var(--BODY);font-size:.7rem;color:rgba(255,255,255,.5);">/mo</span></div>
              <div class="period">Pro Monthly</div>
            </div>
          </div>
          <div class="uc-plan-badge">
            <div>
              <div class="price">$36<span style="font-family:var(--BODY);font-size:.7rem;color:rgba(255,255,255,.5);">/yr</span></div>
              <div class="period">Pro Annual · Save 25%</div>
            </div>
          </div>
        </div>
      </div>

      <!-- Right side: premium domain previews -->
      <div class="uc-visual">
        <div style="font-family:var(--MONO);font-size:.6rem;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:rgba(255,255,255,.35);margin-bottom:4px;">Premium domains unlocked</div>
        <div class="uc-domain-pill">
          <div class="udp-icon" style="background:rgba(124,58,237,.2);color:#A78BFA;">📨</div>
          <div class="udp-name">@secureinbox.io</div>
          <span class="udp-badge pro">PRO</span>
        </div>
        <div class="uc-domain-pill">
          <div class="udp-icon" style="background:rgba(16,185,129,.15);color:var(--GREEN);">🔒</div>
          <div class="udp-name">@privmail.net</div>
          <span class="udp-badge pro">PRO</span>
        </div>
        <div class="uc-domain-pill">
          <div class="udp-icon" style="background:rgba(250,204,21,.12);color:#92400E;">⚡</div>
          <div class="udp-name">@flashbox.dev</div>
          <span class="udp-badge exclusive">EXCLUSIVE</span>
        </div>
        <div class="uc-domain-pill">
          <div class="udp-icon" style="background:rgba(59,130,246,.12);color:var(--B);">🛡️</div>
          <div class="udp-name">@shieldmail.org</div>
          <span class="udp-badge pro">PRO</span>
        </div>
        <div style="text-align:center;font-size:.72rem;color:rgba(255,255,255,.3);margin-top:4px;">+ more exclusive domains</div>
      </div>

    </div>

  </div><!-- /main -->
</div><!-- /shell -->

<script>

/* ══════════════════════════════════════════════
   DOMAINS PAGE
══════════════════════════════════════════════ */

const DOMAINS_DATA = [
  /* ── FREE ── */
  {
    id: 'dropit.io', name: 'dropit.io', type: 'free',
    desc: 'Our flagship domain. Reliable, fast, widely accepted.',
    features: { email: true, alias: true, otp: true },
    reliability: 99, emails: '2.4M+', reputation: 'High',
    selected: true,
  },
  {
    id: 'burnbox.dev', name: 'burnbox.dev', type: 'free',
    desc: 'Developer-friendly domain. Great for testing workflows.',
    features: { email: true, alias: true, otp: true },
    reliability: 98, emails: '1.1M+', reputation: 'High',
    selected: false,
  },
  {
    id: 'zaptmp.net', name: 'zaptmp.net', type: 'free',
    desc: 'Lightweight domain with fast delivery speeds.',
    features: { email: true, alias: false, otp: true },
    reliability: 97, emails: '880K+', reputation: 'Medium',
    selected: false,
  },
  {
    id: 'voidmail.cc', name: 'voidmail.cc', type: 'free',
    desc: 'Privacy-focused domain with minimal logging.',
    features: { email: true, alias: true, otp: false },
    reliability: 96, emails: '640K+', reputation: 'Medium',
    selected: false,
  },
  {
    id: 'mailsink.app', name: 'mailsink.app', type: 'free', popular: true,
    desc: 'Popular all-purpose inbox. Accepted by most services.',
    features: { email: true, alias: true, otp: true },
    reliability: 98, emails: '1.8M+', reputation: 'High',
    selected: false,
  },
  /* ── PREMIUM ── */
  {
    id: 'secureinbox.io', name: 'secureinbox.io', type: 'premium',
    desc: 'High-reputation secure domain. Bypasses strict filters.',
    features: { email: true, alias: true, otp: true },
    reliability: 99.9, emails: '5M+', reputation: 'Elite',
    selected: false,
  },
  {
    id: 'privmail.net', name: 'privmail.net', type: 'premium',
    desc: 'Zero-log privacy domain with encrypted delivery.',
    features: { email: true, alias: true, otp: true },
    reliability: 99.8, emails: '3.2M+', reputation: 'Elite',
    selected: false,
  },
  {
    id: 'flashbox.dev', name: 'flashbox.dev', type: 'premium', exclusive: true,
    desc: 'Exclusive domain with sub-second delivery. Rare prefix.',
    features: { email: true, alias: true, otp: true },
    reliability: 99.9, emails: '1.5M+', reputation: 'Elite',
    selected: false,
  },
  {
    id: 'shieldmail.org', name: 'shieldmail.org', type: 'premium',
    desc: 'Trusted .org domain. Accepted everywhere, high deliverability.',
    features: { email: true, alias: true, otp: true },
    reliability: 99.7, emails: '4.1M+', reputation: 'Elite',
    selected: false,
  },
];

let activeDomain = 'dropit.io';

/* ── Render domain cards ── */
function renderDomains() {
  const grid = document.getElementById('domain-grid');

  grid.innerHTML = DOMAINS_DATA.map(d => {
    const isSelected = d.id === activeDomain;
    const isPremium  = d.type === 'premium';

    const cardClass = [
      'domain-card',
      isPremium  ? 'premium'  : '',
      isSelected ? 'selected' : '',
    ].filter(Boolean).join(' ');

    const btnHtml = isPremium
      ? `<button class="dc-btn upgrade" onclick="showUpgrade()">
           <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
             <path stroke-linecap="round" d="M13 10V3L4 14h7v7l9-11h-7z"/>
           </svg>
           Upgrade to Unlock
         </button>`
      : isSelected
        ? `<button class="dc-btn selected" disabled>
             <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
               <path stroke-linecap="round" d="M5 13l4 4L19 7"/>
             </svg>
             Selected
           </button>`
        : `<button class="dc-btn select" onclick="selectDomain('${d.id}')">
             <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
               <path stroke-linecap="round" d="M13 10V3L4 14h7v7l9-11h-7z"/>
             </svg>
             Select Domain
           </button>`;

    const lockHtml = isPremium
      ? `<div class="dc-lock">
           <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
             <path stroke-linecap="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
           </svg>
         </div>` : '';

    const typeBadge = d.exclusive
      ? `<span class="dc-type popular">✦ Exclusive</span>`
      : d.popular
        ? `<span class="dc-type popular">🔥 Popular</span>`
        : `<span class="dc-type ${d.type}">${d.type === 'premium' ? '⭐ Premium' : '✓ Free'}</span>`;

    const iconStyle = isPremium
      ? 'premium' : isSelected ? 'selected-ic' : 'free';

    const featColor = isPremium ? '#A78BFA' : var_green();

    return `
      <div class="${cardClass}" onclick="${isPremium ? 'showUpgrade()' : isSelected ? '' : "selectDomain('"+d.id+"')"}">
        ${lockHtml}
        <div class="dc-top">
          <div class="dc-icon ${iconStyle}">
            ${isSelected
              ? `<svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M5 13l4 4L19 7"/></svg>`
              : `<svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path stroke-linecap="round" d="M2 12h20M12 2a15.3 15.3 0 010 20M12 2a15.3 15.3 0 000 20"/></svg>`
            }
          </div>
          ${typeBadge}
        </div>

        <div>
          <div class="dc-name">@${d.name}</div>
          <div class="dc-desc">${d.desc}</div>
        </div>

        <div class="dc-features">
          <span class="dc-feat ${d.features.email ? 'on' : 'off'}">
            <svg width="10" height="10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M5 13l4 4L19 7"/></svg>
            Email
          </span>
          <span class="dc-feat ${d.features.alias ? 'on' : 'off'}">
            <svg width="10" height="10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
              ${d.features.alias
                ? '<path stroke-linecap="round" d="M5 13l4 4L19 7"/>'
                : '<path stroke-linecap="round" d="M6 18L18 6M6 6l12 12"/>'
              }
            </svg>
            Alias
          </span>
          <span class="dc-feat ${d.features.otp ? 'on' : 'off'}">
            <svg width="10" height="10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
              ${d.features.otp
                ? '<path stroke-linecap="round" d="M5 13l4 4L19 7"/>'
                : '<path stroke-linecap="round" d="M6 18L18 6M6 6l12 12"/>'
              }
            </svg>
            OTP
          </span>
        </div>

        <div class="dc-stats">
          <div class="dc-stat-item">
            <div class="dc-stat-val">${d.reliability}%</div>
            <div class="dc-stat-lbl">Uptime</div>
          </div>
          <div class="dc-stat-item">
            <div class="dc-stat-val">${d.emails}</div>
            <div class="dc-stat-lbl">Emails</div>
          </div>
          <div class="dc-stat-item">
            <div class="dc-stat-val" style="font-size:.9rem;font-family:var(--BODY);font-weight:700;">${d.reputation}</div>
            <div class="dc-stat-lbl">Reputation</div>
          </div>
        </div>

        ${btnHtml}
      </div>`;
  }).join('');
}

function var_green() { return '#065F46'; }

/* ── Select domain ── */
function selectDomain(id) {
  const d = DOMAINS_DATA.find(x => x.id === id);
  if (!d || d.type === 'premium') return;

  activeDomain = id;

  // Update stats
  document.getElementById('stat-active-domain').textContent = id;

  // Update current domain card
  document.getElementById('current-domain-name').innerHTML =
    '@<span>' + id + '</span>';

  renderDomains();
  showToast('Domain switched to @' + id);
}

/* ── Scroll to domains list ── */
function scrollToDomains() {
  document.getElementById('domains-section').scrollIntoView({behavior:'smooth', block:'start'});
}

/* ── Upgrade prompt ── */
function showUpgrade() {
  document.querySelector('.upgrade-card').scrollIntoView({behavior:'smooth', block:'center'});
  document.querySelector('.upgrade-card').style.outline = '2px solid var(--Y)';
  document.querySelector('.upgrade-card').style.outlineOffset = '4px';
  setTimeout(() => {
    document.querySelector('.upgrade-card').style.outline = '';
    document.querySelector('.upgrade-card').style.outlineOffset = '';
  }, 2000);
  showToast('Upgrade to Pro to unlock premium domains ✦');
}

/* ── Refresh ── */
function refreshPage() {
  const ic = document.getElementById('refresh-ic');
  ic.style.transition = 'transform .5s'; ic.style.transform = 'rotate(360deg)';
  setTimeout(() => { ic.style.transition = 'none'; ic.style.transform = ''; }, 520);
  renderDomains();
  showToast('Domains refreshed!');
}

/* ── Toast ── */
function showToast(msg) {
  const t = document.getElementById('toast');
  t.querySelector('span').textContent = msg;
  t.classList.add('show');
  setTimeout(() => t.classList.remove('show'), 2600);
}

/* ── Sidebar ── */
const sidebar    = document.getElementById('sidebar');
const backdrop   = document.getElementById('sb-backdrop');
const toggleBtn  = document.getElementById('sb-toggle-btn');
const collapseBtn= document.getElementById('sb-collapse-btn');
let isCollapsed  = false;
const isMob      = () => window.innerWidth < 900;
if (toggleBtn)   toggleBtn.addEventListener('click', () => { if (isMob()) { const o = sidebar.classList.toggle('mob-open'); backdrop.classList.toggle('show', o); } else collapseSidebar(!isCollapsed); });
if (collapseBtn) collapseBtn.addEventListener('click', () => collapseSidebar(!isCollapsed));
function collapseSidebar(c) { isCollapsed=c; sidebar.classList.toggle('collapsed',c); document.body.classList.toggle('sb-collapsed',c); }
function closeMobileSb() { sidebar.classList.remove('mob-open'); backdrop.classList.remove('show'); }
window.addEventListener('resize', () => { if (!isMob()) closeMobileSb(); });
function toggleUserDd() { document.getElementById('user-dd').classList.toggle('open'); }
document.addEventListener('click', e => { if (!e.target.closest('#tb-av')) document.getElementById('user-dd')?.classList.remove('open'); });

/* ── Boot ── */
renderDomains();
</script>
</body>
</html>