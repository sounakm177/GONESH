<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>InboxOro — API Keys</title>
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
/* ── Stat cards grid ── */
.api-stats {
  display: grid;
  grid-template-columns: repeat(2,1fr);
  gap: 12px;
  margin-bottom: 24px;
}
@media(min-width:640px){ .api-stats{ grid-template-columns:repeat(4,1fr); } }

.api-stat {
  background: var(--SURF);
  border: 1px solid var(--BD);
  border-radius: 12px;
  padding: 16px 18px;
  position: relative;
  overflow: hidden;
  transition: box-shadow .2s, transform .15s;
}
.api-stat:hover { box-shadow: 0 4px 16px rgba(0,0,0,.07); transform: translateY(-1px); }
.api-stat::before {
  content:''; position:absolute; top:0; left:0; right:0; height:3px; border-radius:12px 12px 0 0;
}
.api-stat.y::before { background:var(--Y); }
.api-stat.g::before { background:var(--GREEN); }
.api-stat.b::before { background:var(--B); }
.api-stat.p::before { background:#7C3AED; }

.as-top { display:flex; align-items:flex-start; justify-content:space-between; margin-bottom:10px; }
.as-icon {
  width:36px; height:36px; border-radius:9px;
  display:flex; align-items:center; justify-content:center;
}
.as-icon.y { background:rgba(250,204,21,.15); color:#92400E; }
.as-icon.g { background:rgba(16,185,129,.12);  color:var(--GREEN); }
.as-icon.b { background:rgba(59,130,246,.12);  color:var(--B); }
.as-icon.p { background:rgba(124,58,237,.1);   color:#7C3AED; }

.as-badge {
  display:inline-flex; align-items:center; gap:3px;
  font-family:var(--MONO); font-size:.56rem; font-weight:700;
  padding:2px 8px; border-radius:20px;
}
.as-badge.up   { background:rgba(16,185,129,.1);  color:var(--GREEN); }
.as-badge.free { background:rgba(250,204,21,.12); color:#92400E; }

.as-val { font-family:var(--DISP); font-size:1.9rem; color:var(--INK); line-height:1; }
.as-lbl { font-size:.74rem; color:var(--MU); font-weight:500; margin-top:3px; }
.as-sub { font-size:.68rem; margin-top:4px; color:var(--MU2); }

/* ── Usage progress card ── */
.usage-card {
  background: var(--SURF);
  border: 1px solid var(--BD);
  border-radius: 12px;
  padding: 20px 22px;
  margin-bottom: 24px;
}
.usage-card-hd {
  display: flex; align-items: center; justify-content: space-between;
  margin-bottom: 14px; gap: 10px; flex-wrap: wrap;
}
.usage-title { font-weight:700; font-size:.9rem; color:var(--INK); }
.usage-fraction {
  font-family:var(--MONO); font-size:.76rem; font-weight:700; color:var(--INK);
}
.usage-track {
  height: 10px; background: var(--BD2);
  border-radius: 5px; overflow: hidden; margin-bottom: 10px;
  position: relative;
}
.usage-fill {
  height: 100%; border-radius: 5px;
  background: linear-gradient(90deg, var(--GREEN), #34D399);
  transition: width .8s cubic-bezier(.4,0,.2,1);
  position: relative;
}
.usage-fill::after {
  content:''; position:absolute; top:0; right:0; bottom:0; width:30px;
  background: linear-gradient(90deg, transparent, rgba(255,255,255,.3));
}
.usage-fill.warning { background: linear-gradient(90deg, var(--Y), #F59E0B); }
.usage-fill.danger  { background: linear-gradient(90deg, var(--RED), #F87171); }

.usage-labels {
  display:flex; align-items:center; justify-content:space-between;
  font-family:var(--MONO); font-size:.62rem; color:var(--MU2);
}
.usage-labels span { font-weight:700; }
.usage-labels .used    { color:var(--GREEN); }
.usage-labels .remain  { color:var(--MU); }

/* ── Section header ── */
.sec-hd {
  display:flex; align-items:center; justify-content:space-between;
  margin-bottom:14px; gap:10px; flex-wrap:wrap;
}
.sec-hd-title {
  font-family:var(--DISP); font-size:1.1rem; letter-spacing:.04em; color:var(--INK);
  display:flex; align-items:center; gap:8px;
}

/* ── Keys table panel ── */
.panel {
  background:var(--SURF); border:1px solid var(--BD);
  border-radius:12px; overflow:hidden; margin-bottom:20px;
}
.panel-hd {
  display:flex; align-items:center; justify-content:space-between;
  padding:14px 18px; border-bottom:1px solid var(--BD2); gap:10px; flex-wrap:wrap;
}
.panel-title { font-weight:700; font-size:.9rem; color:var(--INK); }
.panel-meta  { font-family:var(--MONO); font-size:.62rem; color:var(--MU); }

/* ── Keys table ── */
.keys-table { width:100%; border-collapse:collapse; }
.keys-table thead tr { border-bottom:1px solid var(--BD2); }
.keys-table thead th {
  padding:10px 16px; text-align:left;
  font-family:var(--MONO); font-size:.58rem; font-weight:700;
  letter-spacing:.1em; text-transform:uppercase; color:var(--MU2); white-space:nowrap;
}
.keys-table tbody tr {
  border-bottom:1px solid var(--BD2); transition:background .1s;
}
.keys-table tbody tr:last-child { border-bottom:none; }
.keys-table tbody tr:hover { background:var(--BD2); }
.keys-table tbody td { padding:13px 16px; vertical-align:middle; }

.key-name-cell { display:flex; align-items:center; gap:10px; }
.key-name-icon {
  width:32px; height:32px; border-radius:8px;
  background:var(--INK); color:var(--Y);
  display:flex; align-items:center; justify-content:center;
  flex-shrink:0; font-family:var(--MONO); font-size:.6rem; font-weight:800;
}
.key-name-txt { font-weight:600; font-size:.84rem; color:var(--INK); }
.key-name-sub { font-size:.7rem; color:var(--MU); margin-top:1px; }

.key-mono {
  font-family:var(--MONO); font-size:.74rem; color:var(--INK);
  background:var(--BD2); padding:4px 10px; border-radius:6px;
  letter-spacing:.04em; display:inline-flex; align-items:center; gap:6px;
  max-width:200px;
}
.key-reveal {
  font-size:.6rem; color:var(--MU2); cursor:pointer;
  border:none; background:none; padding:0; font-family:var(--MONO);
  text-decoration:underline; white-space:nowrap; flex-shrink:0;
}
.key-reveal:hover { color:var(--INK); }

.badge {
  display:inline-flex; align-items:center; gap:4px;
  font-family:var(--MONO); font-size:.58rem; font-weight:700;
  padding:3px 9px; border-radius:20px; white-space:nowrap;
}
.badge-active  { background:rgba(16,185,129,.1);  color:var(--GREEN); }
.badge-revoked { background:rgba(239,68,68,.08);  color:var(--RED); }
.badge .bdot   { width:5px; height:5px; border-radius:50%; background:currentColor; }

.date-cell { font-size:.78rem; color:var(--MU); white-space:nowrap; }
.date-today    { color:var(--GREEN); font-weight:600; }
.date-recently { color:var(--INK);  font-weight:500; }

.row-acts { display:flex; gap:5px; align-items:center; justify-content:flex-end; }
.act-btn {
  width:30px; height:30px; display:flex; align-items:center; justify-content:center;
  border-radius:7px; border:1px solid var(--BD); background:var(--SURF); color:var(--MU);
  cursor:pointer; transition:background .12s, color .12s, border-color .12s;
}
.act-btn.copy:hover { background:rgba(250,204,21,.1); color:var(--INK); border-color:rgba(250,204,21,.4); }
.act-btn.del:hover  { background:rgba(239,68,68,.08); color:var(--RED); border-color:rgba(239,68,68,.3); }

/* hide some cols on mobile */
.col-created, .col-last-used { display:none; }
@media(min-width:640px) { .col-created   { display:table-cell; } }
@media(min-width:860px) { .col-last-used { display:table-cell; } }

/* empty state */
.empty-state {
  display:none; flex-direction:column; align-items:center;
  justify-content:center; padding:52px 20px; gap:14px; text-align:center;
}
.empty-state.show { display:flex; }
.empty-icon {
  width:56px; height:56px; background:var(--BD2); border-radius:14px;
  display:flex; align-items:center; justify-content:center; color:var(--MU2);
}
.empty-title { font-family:var(--DISP); font-size:1.3rem; letter-spacing:.03em; color:var(--INK); }
.empty-sub   { font-size:.82rem; color:var(--MU); max-width:280px; line-height:1.6; }

/* ── Bottom grid (quickstart + limits + upgrade) ── */
.bottom-grid {
  display:grid;
  grid-template-columns:1fr;
  gap:16px;
}
@media(min-width:860px){ .bottom-grid{ grid-template-columns:1fr 1fr; } }
@media(min-width:1100px){ .bottom-grid{ grid-template-columns:2fr 1fr 1fr; } }

/* ── Quickstart card ── */
.quickstart-card {
  background:var(--INK); border-radius:12px; overflow:hidden;
}
.qs-hd {
  padding:16px 18px; border-bottom:1px solid rgba(255,255,255,.08);
  display:flex; align-items:center; gap:10px;
}
.qs-hd-icon {
  width:32px; height:32px; border-radius:8px;
  background:rgba(250,204,21,.12); color:var(--Y);
  display:flex; align-items:center; justify-content:center; flex-shrink:0;
}
.qs-hd-title { font-family:var(--DISP); font-size:1rem; letter-spacing:.04em; color:#fff; }
.qs-hd-sub   { font-size:.72rem; color:rgba(255,255,255,.4); margin-top:1px; }

.qs-body { padding:14px 18px; display:flex; flex-direction:column; gap:8px; }

.endpoint-row {
  display:flex; align-items:center; gap:8px;
  background:rgba(255,255,255,.05); border:1px solid rgba(255,255,255,.08);
  border-radius:8px; padding:9px 12px;
  transition:background .12s, border-color .12s;
}
.endpoint-row:hover { background:rgba(255,255,255,.09); border-color:rgba(255,255,255,.15); }

.ep-method {
  font-family:var(--MONO); font-size:.62rem; font-weight:800;
  padding:2px 8px; border-radius:5px; flex-shrink:0; letter-spacing:.04em;
}
.ep-method.get  { background:rgba(16,185,129,.15);  color:var(--GREEN); }
.ep-method.post { background:rgba(59,130,246,.15);  color:var(--B); }
.ep-method.del  { background:rgba(239,68,68,.12);   color:var(--RED); }

.ep-path {
  font-family:var(--MONO); font-size:.74rem; color:rgba(255,255,255,.8);
  flex:1; min-width:0; overflow:hidden; text-overflow:ellipsis; white-space:nowrap;
}
.ep-desc { font-size:.68rem; color:rgba(255,255,255,.35); margin-top:1px; }

.ep-copy {
  width:26px; height:26px; border-radius:6px; border:1px solid rgba(255,255,255,.12);
  background:transparent; color:rgba(255,255,255,.4); cursor:pointer;
  display:flex; align-items:center; justify-content:center;
  flex-shrink:0; transition:background .12s, color .12s;
}
.ep-copy:hover { background:rgba(255,255,255,.1); color:#fff; }

.qs-auth {
  margin-top:6px; background:rgba(255,255,255,.04);
  border:1px solid rgba(255,255,255,.06); border-radius:8px; padding:10px 12px;
}
.qs-auth-lbl {
  font-family:var(--MONO); font-size:.58rem; font-weight:700;
  letter-spacing:.1em; text-transform:uppercase; color:rgba(255,255,255,.3);
  margin-bottom:5px;
}
.qs-auth-code {
  font-family:var(--MONO); font-size:.74rem; color:rgba(255,255,255,.7); line-height:1.7;
}
.qs-auth-code .hl-key   { color:var(--Y); }
.qs-auth-code .hl-val   { color:#86EFAC; }
.qs-auth-code .hl-gray  { color:rgba(255,255,255,.3); }

.qs-footer {
  padding:12px 18px; border-top:1px solid rgba(255,255,255,.08);
  display:flex; gap:8px; flex-wrap:wrap;
}
.qs-doc-btn {
  display:inline-flex; align-items:center; gap:5px;
  font-family:var(--MONO); font-size:.66rem; font-weight:700; letter-spacing:.05em;
  padding:7px 14px; border-radius:7px; cursor:pointer;
  background:rgba(250,204,21,.12); color:var(--Y);
  border:1px solid rgba(250,204,21,.2); transition:background .15s;
  text-decoration:none;
}
.qs-doc-btn:hover { background:rgba(250,204,21,.2); text-decoration:none; }

/* ── Limits card ── */
.limits-card {
  background:var(--SURF); border:1px solid var(--BD); border-radius:12px;
  overflow:hidden;
}
.limits-hd {
  padding:14px 18px; border-bottom:1px solid var(--BD2);
  display:flex; align-items:center; gap:8px;
}
.limits-hd-icon {
  width:28px; height:28px; background:rgba(250,204,21,.12);
  border-radius:7px; display:flex; align-items:center; justify-content:center; color:var(--Y);
}
.limits-hd-title { font-weight:700; font-size:.88rem; color:var(--INK); }
.limits-hd-badge {
  margin-left:auto; font-family:var(--MONO); font-size:.56rem; font-weight:800;
  background:rgba(250,204,21,.12); color:#92400E; padding:2px 8px; border-radius:10px;
}
.limits-body { padding:14px 18px; }
.limit-row {
  display:flex; align-items:center; gap:10px; padding:8px 0;
  border-bottom:1px solid var(--BD2); font-size:.8rem;
}
.limit-row:last-child { border-bottom:none; }
.limit-icon {
  width:26px; height:26px; border-radius:7px; background:var(--BD2);
  display:flex; align-items:center; justify-content:center;
  color:var(--MU); flex-shrink:0;
}
.limit-txt  { flex:1; color:var(--INK); font-weight:500; }
.limit-val  { font-family:var(--MONO); font-size:.72rem; font-weight:700; color:var(--INK); white-space:nowrap; }

/* ── Upgrade card ── */
.upgrade-card {
  background:var(--INK); border-radius:12px;
  overflow:hidden; position:relative;
}
.upgrade-card::before {
  content:''; position:absolute; top:0; left:0; right:0; height:2px;
  background:linear-gradient(90deg,#7C3AED,var(--Y),#7C3AED);
  background-size:200% 100%; animation:shimmer 3s linear infinite;
}
@keyframes shimmer { 0%{background-position:200% 0} 100%{background-position:-200% 0} }

.ug-blob {
  position:absolute; border-radius:50%; pointer-events:none;
  width:200px; height:200px;
  background:radial-gradient(circle,rgba(124,58,237,.18) 0,transparent 70%);
  top:-60px; right:-60px;
}

.ug-hd {
  padding:16px 18px; border-bottom:1px solid rgba(255,255,255,.07);
  position:relative; z-index:1;
}
.ug-eyebrow {
  display:inline-flex; align-items:center; gap:5px;
  font-family:var(--MONO); font-size:.58rem; font-weight:700;
  letter-spacing:.1em; text-transform:uppercase;
  color:var(--Y); background:rgba(250,204,21,.1);
  border:1px solid rgba(250,204,21,.2);
  padding:3px 9px; border-radius:20px; margin-bottom:8px;
}
.ug-eyebrow::before { content:''; width:5px; height:5px; background:var(--Y); border-radius:50%; animation:blink 1.2s step-end infinite; }
@keyframes blink { 0%,100%{opacity:1} 50%{opacity:0} }
.ug-title { font-family:var(--DISP); font-size:1.15rem; letter-spacing:.04em; color:#fff; line-height:1; }
.ug-title span { color:var(--Y); }

.ug-body { padding:14px 18px; position:relative; z-index:1; }
.ug-benefit {
  display:flex; align-items:flex-start; gap:9px; padding:6px 0;
  font-size:.78rem; color:rgba(255,255,255,.7); line-height:1.45;
}
.ug-check {
  width:18px; height:18px; min-width:18px;
  background:rgba(16,185,129,.15); border-radius:50%;
  display:flex; align-items:center; justify-content:center; color:var(--GREEN); flex-shrink:0;
}

.ug-footer {
  padding:14px 18px; border-top:1px solid rgba(255,255,255,.07);
  position:relative; z-index:1;
}
.ug-cta {
  width:100%; padding:11px; border-radius:9px;
  background:linear-gradient(135deg,#7C3AED,#6D28D9); color:#fff;
  font-size:.84rem; font-weight:700; border:none; cursor:pointer;
  display:flex; align-items:center; justify-content:center; gap:7px;
  font-family:var(--BODY); transition:opacity .15s, transform .1s;
}
.ug-cta:hover { opacity:.9; transform:translateY(-1px); }

/* ════════════════════
   MODALS
════════════════════ */
.modal-overlay {
  position:fixed; inset:0; z-index:500;
  background:rgba(0,0,0,.5); backdrop-filter:blur(3px);
  display:none; align-items:center; justify-content:center; padding:16px;
}
.modal-overlay.open { display:flex; animation:fade-bg .18s ease both; }
@keyframes fade-bg { from{opacity:0} to{opacity:1} }

.modal-box {
  background:var(--SURF); border-radius:14px;
  border:1px solid var(--BD); width:100%; max-width:480px;
  box-shadow:0 20px 60px rgba(0,0,0,.18);
  animation:modal-up .22s cubic-bezier(.34,1.56,.64,1) both;
}
@keyframes modal-up { from{transform:translateY(10px) scale(.97);opacity:0} to{transform:none;opacity:1} }

.modal-hd {
  display:flex; align-items:center; justify-content:space-between;
  padding:18px 20px; border-bottom:1px solid var(--BD2);
}
.modal-title { font-family:var(--DISP); font-size:1.15rem; letter-spacing:.04em; color:var(--INK); }
.modal-close {
  width:32px; height:32px; display:flex; align-items:center; justify-content:center;
  border-radius:8px; border:1px solid var(--BD); background:transparent;
  color:var(--MU); cursor:pointer; transition:background .12s, color .12s;
}
.modal-close:hover { background:var(--BD2); color:var(--INK); }

.modal-body { padding:20px; display:flex; flex-direction:column; gap:14px; }
.modal-ft   { padding:14px 20px; border-top:1px solid var(--BD2); display:flex; gap:8px; justify-content:flex-end; }

.field { display:flex; flex-direction:column; gap:5px; }
.field label {
  font-family:var(--MONO); font-size:.6rem; font-weight:700;
  letter-spacing:.08em; text-transform:uppercase; color:var(--MU);
}
.field input, .field select {
  padding:10px 14px; border:1px solid var(--BD); border-radius:8px;
  font-family:var(--BODY); font-size:15px; color:var(--INK);
  background:var(--SURF); outline:none; transition:border-color .15s, box-shadow .15s;
}
.field input:focus, .field select:focus {
  border-color:var(--Y); box-shadow:0 0 0 3px rgba(250,204,21,.15);
}
.field input.err { border-color:var(--RED); box-shadow:0 0 0 3px rgba(239,68,68,.1); }
.field-err { font-size:.72rem; color:var(--RED); font-weight:500; display:none; }
.field-err.show { display:block; }

/* Permissions checkboxes */
.perms-grid {
  display:grid; grid-template-columns:1fr 1fr; gap:8px;
}
.perm-check {
  display:flex; align-items:center; gap:8px; padding:9px 12px;
  border:1px solid var(--BD); border-radius:8px; cursor:pointer;
  transition:border-color .12s, background .12s; user-select:none;
}
.perm-check:hover { border-color:#D1D5DB; background:var(--BD2); }
.perm-check.checked { border-color:rgba(250,204,21,.4); background:rgba(250,204,21,.06); }
.perm-check input { display:none; }
.perm-box {
  width:16px; height:16px; border-radius:4px;
  border:1.5px solid var(--BD); background:var(--SURF);
  display:flex; align-items:center; justify-content:center;
  flex-shrink:0; transition:background .12s, border-color .12s;
}
.perm-check.checked .perm-box { background:var(--Y); border-color:var(--Y); }
.perm-lbl { font-size:.78rem; font-weight:500; color:var(--INK); flex:1; }

/* Generated key display */
.gen-key-box {
  background:var(--INK); border-radius:10px; padding:16px 18px;
  display:flex; flex-direction:column; gap:10px;
}
.gkb-label {
  font-family:var(--MONO); font-size:.6rem; font-weight:700;
  letter-spacing:.1em; text-transform:uppercase; color:rgba(255,255,255,.4);
}
.gkb-key {
  font-family:var(--MONO); font-size:.8rem; font-weight:700;
  color:var(--Y); word-break:break-all; line-height:1.5;
}
.gkb-copy {
  display:flex; align-items:center; gap:6px;
  background:rgba(250,204,21,.1); color:var(--Y);
  border:1px solid rgba(250,204,21,.25);
  border-radius:7px; padding:8px 14px; cursor:pointer;
  font-family:var(--MONO); font-size:.68rem; font-weight:700;
  letter-spacing:.05em; transition:background .15s; align-self:flex-start;
}
.gkb-copy:hover { background:rgba(250,204,21,.2); }
.gkb-copy.ok { color:var(--GREEN); border-color:rgba(16,185,129,.3); background:rgba(16,185,129,.08); }

.warn-box {
  display:flex; align-items:flex-start; gap:10px;
  background:#FEF9C3; border:1px solid #FCD34D; border-left:4px solid #F59E0B;
  border-radius:8px; padding:12px 14px;
  font-size:.78rem; color:#78350F; line-height:1.55;
}
.warn-box svg { flex-shrink:0; color:#D97706; margin-top:1px; }

/* Delete confirm modal */
.delete-modal-icon {
  width:52px; height:52px; background:rgba(239,68,68,.1);
  border-radius:50%; display:flex; align-items:center;
  justify-content:center; color:var(--RED); margin:0 auto 12px;
}
.delete-modal-title { font-family:var(--DISP); font-size:1.2rem; letter-spacing:.03em; color:var(--INK); text-align:center; }
.delete-modal-sub   { font-size:.82rem; color:var(--MU); text-align:center; line-height:1.6; }
.delete-modal-key   { font-family:var(--MONO); font-size:.76rem; background:var(--BD2); padding:6px 12px; border-radius:6px; text-align:center; color:var(--INK); }

/* ── Toast ── */
#toast {
  position:fixed; bottom:20px; right:16px;
  background:var(--INK); color:#fff;
  font-family:var(--MONO); font-size:.74rem; font-weight:600;
  padding:10px 16px; border-radius:8px;
  box-shadow:0 4px 20px rgba(0,0,0,.2); z-index:999;
  display:flex; align-items:center; gap:7px;
  transform:translateY(70px); opacity:0;
  transition:transform .3s cubic-bezier(.34,1.56,.64,1), opacity .25s;
}
#toast.show { transform:translateY(0); opacity:1; }
.toast-dot { width:7px; height:7px; background:var(--GREEN); border-radius:50%; }
</style>
</head>
<body>

<div id="toast"><div class="toast-dot"></div><span id="toast-msg">Done</span></div>

<!-- ═══════════ CREATE MODAL ═══════════ -->
<div class="modal-overlay" id="create-modal">
  <div class="modal-box">
    <div class="modal-hd">
      <div class="modal-title" id="cm-title">Create API Key</div>
      <button class="modal-close" onclick="closeCreateModal()">
        <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M6 18L18 6M6 6l12 12"/></svg>
      </button>
    </div>

    <!-- Step 1: form -->
    <div id="cm-step1">
      <div class="modal-body">
        <div class="field">
          <label>Key Name <span style="color:var(--RED);">*</span></label>
          <input type="text" id="key-name" placeholder="e.g. Laravel App, Testing Script…" maxlength="60"/>
          <div class="field-err" id="key-name-err">Please enter a key name.</div>
        </div>

        <div class="field">
          <label>Permissions</label>
          <div class="perms-grid" id="perms-grid">
            <!-- injected by JS -->
          </div>
        </div>

        <div class="field">
          <label>Expires In <span style="color:var(--MU);font-weight:400;text-transform:none;letter-spacing:0;">(optional)</span></label>
          <select id="key-expiry">
            <option value="never">Never</option>
            <option value="30">30 days</option>
            <option value="90">90 days</option>
            <option value="365">1 year</option>
          </select>
        </div>
      </div>
      <div class="modal-ft">
        <button class="btn-ghost" onclick="closeCreateModal()">Cancel</button>
        <button class="btn-primary yellow" onclick="generateKey()">
          <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M12 4v16m8-8H4"/></svg>
          Generate API Key
        </button>
      </div>
    </div>

    <!-- Step 2: show generated key -->
    <div id="cm-step2" style="display:none;">
      <div class="modal-body">
        <div style="text-align:center;margin-bottom:4px;">
          <div style="width:52px;height:52px;background:rgba(16,185,129,.1);border-radius:50%;display:flex;align-items:center;justify-content:center;color:var(--GREEN);margin:0 auto 10px;">
            <svg width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M5 13l4 4L19 7"/></svg>
          </div>
          <div style="font-family:var(--DISP);font-size:1.15rem;letter-spacing:.03em;color:var(--INK);">API Key Created!</div>
          <div style="font-size:.8rem;color:var(--MU);margin-top:4px;">Copy this key now — it won't be shown again.</div>
        </div>

        <div class="gen-key-box">
          <div class="gkb-label">Your New API Key</div>
          <div class="gkb-key" id="generated-key-display"></div>
          <button class="gkb-copy" id="gkb-copy-btn" onclick="copyGeneratedKey()">
            <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><rect x="9" y="9" width="13" height="13" rx="2"/><path stroke-linecap="round" d="M5 15H4a2 2 0 01-2-2V4a2 2 0 012-2h9a2 2 0 012 2v1"/></svg>
            Copy Key
          </button>
        </div>

        <div class="warn-box">
          <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
          <div><strong>Security Warning:</strong> This key will only be shown once. Store it securely in your environment variables and never share it publicly.</div>
        </div>
      </div>
      <div class="modal-ft">
        <button class="btn-primary" onclick="finishCreate()" style="width:100%;justify-content:center;">
          Done — I've saved my key
        </button>
      </div>
    </div>
  </div>
</div>

<!-- ═══════════ DELETE MODAL ═══════════ -->
<div class="modal-overlay" id="delete-modal">
  <div class="modal-box">
    <div class="modal-hd">
      <div class="modal-title">Delete API Key</div>
      <button class="modal-close" onclick="closeDeleteModal()">
        <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M6 18L18 6M6 6l12 12"/></svg>
      </button>
    </div>
    <div class="modal-body">
      <div class="delete-modal-icon">
        <svg width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
          <polyline points="3 6 5 6 21 6"/>
          <path stroke-linecap="round" d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6m5 0V4a1 1 0 011-1h2a1 1 0 011 1v2"/>
        </svg>
      </div>
      <div class="delete-modal-title">Delete API Key</div>
      <div class="delete-modal-sub">Are you sure you want to delete <strong id="dm-key-name"></strong>? Any application using this key will immediately lose access.</div>
      <div class="delete-modal-key" id="dm-key-preview"></div>
      <div class="warn-box">
        <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
        This action is <strong>permanent</strong> and cannot be undone.
      </div>
    </div>
    <div class="modal-ft">
      <button class="btn-ghost" onclick="closeDeleteModal()">Cancel</button>
      <button class="btn-primary" style="background:var(--RED);" onclick="confirmDelete()">
        <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><polyline points="3 6 5 6 21 6"/><path stroke-linecap="round" d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6"/></svg>
        Delete Key
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

  <div class="main" id="main">

    <!-- ── Page header ── -->
    <div class="page-hd">
      <div>
        <div class="page-title">API Keys</div>
        <div class="page-subtitle">Manage API keys and monitor API usage.</div>
      </div>
      <div style="display:flex;gap:8px;align-items:center;">
        <button class="btn-ghost" onclick="refreshPage()">
          <svg id="refresh-ic" width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
          Refresh
        </button>
        <button class="btn-primary yellow" id="create-btn" onclick="openCreateModal()">
          <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M12 4v16m8-8H4"/></svg>
          Create API Key
        </button>
      </div>
    </div>

    <!-- ── Stat cards ── -->
    <div class="api-stats">
      <div class="api-stat y">
        <div class="as-top">
          <div class="as-icon y">
            <svg width="17" height="17" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
          </div>
          <span class="as-badge free">FREE</span>
        </div>
        <div class="as-val"><span id="stat-used">25</span><span style="font-family:var(--BODY);font-size:1rem;color:var(--MU);font-weight:400;"> / </span><span style="color:var(--MU);" id="stat-limit">100</span></div>
        <div class="as-lbl">API Requests Today</div>
        <div class="as-sub">Resets at midnight UTC</div>
      </div>
      <div class="api-stat g">
        <div class="as-top">
          <div class="as-icon g">
            <svg width="17" height="17" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/></svg>
          </div>
          <span class="as-badge up">↑ Active</span>
        </div>
        <div class="as-val" id="stat-active-keys">2</div>
        <div class="as-lbl">Active API Keys</div>
        <div class="as-sub" id="stat-keys-sub">1 more available</div>
      </div>
      <div class="api-stat b">
        <div class="as-top">
          <div class="as-icon b">
            <svg width="17" height="17" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path stroke-linecap="round" d="M12 8v4l3 3"/></svg>
          </div>
        </div>
        <div class="as-val" id="stat-remain">75</div>
        <div class="as-lbl">Remaining Requests</div>
        <div class="as-sub">Today's allowance</div>
      </div>
      <div class="api-stat p">
        <div class="as-top">
          <div class="as-icon p">
            <svg width="17" height="17" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>
          </div>
        </div>
        <div class="as-val" style="font-size:1.3rem;font-family:var(--BODY);font-weight:800;">Free</div>
        <div class="as-lbl">Current Plan</div>
        <div class="as-sub"><a href="#" style="color:#A78BFA;font-size:.68rem;font-weight:600;text-decoration:none;" onclick="scrollUpgrade()">Upgrade →</a></div>
      </div>
    </div>

    <!-- ── Usage progress ── -->
    <div class="usage-card">
      <div class="usage-card-hd">
        <div class="usage-title">API Usage Today</div>
        <div style="display:flex;align-items:center;gap:12px;flex-wrap:wrap;">
          <div class="usage-fraction"><span id="uc-used">25</span> / <span id="uc-limit">100</span> requests</div>
          <div style="font-family:var(--MONO);font-size:.64rem;color:var(--MU);">Resets in <span id="uc-reset" style="color:var(--INK);font-weight:700;">12h 34m</span></div>
        </div>
      </div>
      <div class="usage-track">
        <div class="usage-fill" id="usage-fill" style="width:25%;"></div>
      </div>
      <div class="usage-labels">
        <span class="used" id="uc-pct-lbl">25% used</span>
        <span class="remain" id="uc-remain-lbl">75 requests remaining</span>
      </div>
    </div>

    <!-- ── API Keys table ── -->
    <div class="sec-hd">
      <div class="sec-hd-title">
        <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/></svg>
        Active API Keys
      </div>
      <span style="font-family:var(--MONO);font-size:.62rem;color:var(--MU);" id="keys-count-lbl">2 of 3 keys used</span>
    </div>

    <div class="panel">
      <div class="panel-hd">
        <span class="panel-title">Your API Keys</span>
        <span class="panel-meta">Never share your keys publicly</span>
      </div>
      <div style="overflow-x:auto;">
        <table class="keys-table" id="keys-table">
          <thead>
            <tr>
              <th>Key Name</th>
              <th>API Key</th>
              <th class="col-created">Created</th>
              <th class="col-last-used">Last Used</th>
              <th>Status</th>
              <th style="text-align:right;padding-right:18px;">Actions</th>
            </tr>
          </thead>
          <tbody id="keys-tbody"></tbody>
        </table>
        <div class="empty-state" id="empty-state">
          <div class="empty-icon">
            <svg width="26" height="26" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/></svg>
          </div>
          <div class="empty-title">No API Keys</div>
          <div class="empty-sub">Create your first API key to start integrating InboxOro into your apps.</div>
          <button class="btn-primary yellow" style="margin-top:4px;" onclick="openCreateModal()">
            <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M12 4v16m8-8H4"/></svg>
            Create First Key
          </button>
        </div>
      </div>
    </div>

    <!-- ── Bottom grid ── -->
    <div class="bottom-grid">

      <!-- Quickstart -->
      <div class="quickstart-card">
        <div class="qs-hd">
          <div class="qs-hd-icon">
            <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
          </div>
          <div>
            <div class="qs-hd-title">Quick Start</div>
            <div class="qs-hd-sub">REST API endpoints — copy & use</div>
          </div>
        </div>
        <div class="qs-body">
          <div class="endpoint-row">
            <span class="ep-method get">GET</span>
            <div style="flex:1;min-width:0;">
              <div class="ep-path">/api/v1/inboxes</div>
              <div class="ep-desc">List all your mailboxes</div>
            </div>
            <button class="ep-copy" onclick="copyEndpoint('/api/v1/inboxes')" title="Copy">
              <svg width="11" height="11" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><rect x="9" y="9" width="13" height="13" rx="2"/><path stroke-linecap="round" d="M5 15H4a2 2 0 01-2-2V4a2 2 0 012-2h9a2 2 0 012 2v1"/></svg>
            </button>
          </div>
          <div class="endpoint-row">
            <span class="ep-method get">GET</span>
            <div style="flex:1;min-width:0;">
              <div class="ep-path">/api/v1/messages</div>
              <div class="ep-desc">Fetch inbox messages</div>
            </div>
            <button class="ep-copy" onclick="copyEndpoint('/api/v1/messages')" title="Copy">
              <svg width="11" height="11" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><rect x="9" y="9" width="13" height="13" rx="2"/><path stroke-linecap="round" d="M5 15H4a2 2 0 01-2-2V4a2 2 0 012-2h9a2 2 0 012 2v1"/></svg>
            </button>
          </div>
          <div class="endpoint-row">
            <span class="ep-method post">POST</span>
            <div style="flex:1;min-width:0;">
              <div class="ep-path">/api/v1/generate-email</div>
              <div class="ep-desc">Create a temp address</div>
            </div>
            <button class="ep-copy" onclick="copyEndpoint('/api/v1/generate-email')" title="Copy">
              <svg width="11" height="11" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><rect x="9" y="9" width="13" height="13" rx="2"/><path stroke-linecap="round" d="M5 15H4a2 2 0 01-2-2V4a2 2 0 012-2h9a2 2 0 012 2v1"/></svg>
            </button>
          </div>
          <div class="endpoint-row">
            <span class="ep-method del">DEL</span>
            <div style="flex:1;min-width:0;">
              <div class="ep-path">/api/v1/inboxes/:id</div>
              <div class="ep-desc">Delete a mailbox</div>
            </div>
            <button class="ep-copy" onclick="copyEndpoint('/api/v1/inboxes/:id')" title="Copy">
              <svg width="11" height="11" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><rect x="9" y="9" width="13" height="13" rx="2"/><path stroke-linecap="round" d="M5 15H4a2 2 0 01-2-2V4a2 2 0 012-2h9a2 2 0 012 2v1"/></svg>
            </button>
          </div>

          <div class="qs-auth">
            <div class="qs-auth-lbl">Authentication header</div>
            <div class="qs-auth-code">
              <span class="hl-gray">Authorization: </span><span class="hl-key">Bearer </span><span class="hl-val">sk_live_your_key_here</span>
            </div>
          </div>
        </div>
        <div class="qs-footer">
          <a href="#" class="qs-doc-btn">
            <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
            View Full Docs
          </a>
          <a href="#" class="qs-doc-btn" style="background:rgba(59,130,246,.1);color:var(--B);border-color:rgba(59,130,246,.2);">
            <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/></svg>
            Postman Collection
          </a>
        </div>
      </div>

      <!-- Limits -->
      <div class="limits-card">
        <div class="limits-hd">
          <div class="limits-hd-icon">
            <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>
          </div>
          <div class="limits-hd-title">Free Plan Limits</div>
          <div class="limits-hd-badge">FREE</div>
        </div>
        <div class="limits-body">
          <div class="limit-row">
            <div class="limit-icon"><svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg></div>
            <div class="limit-txt">API Requests / Day</div>
            <div class="limit-val">100</div>
          </div>
          <div class="limit-row">
            <div class="limit-icon"><svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/></svg></div>
            <div class="limit-txt">Max API Keys</div>
            <div class="limit-val">3</div>
          </div>
          <div class="limit-row">
            <div class="limit-icon"><svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path stroke-linecap="round" d="M12 8v4l3 3"/></svg></div>
            <div class="limit-txt">Rate Limit</div>
            <div class="limit-val">10 / min</div>
          </div>
          <div class="limit-row">
            <div class="limit-icon"><svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"/></svg></div>
            <div class="limit-txt">Support</div>
            <div class="limit-val">Community</div>
          </div>
          <div class="limit-row">
            <div class="limit-icon"><svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg></div>
            <div class="limit-txt">Webhooks</div>
            <div class="limit-val" style="color:var(--MU2);">—</div>
          </div>
        </div>
      </div>

      <!-- Upgrade -->
      <div class="upgrade-card" id="upgrade-section">
        <div class="ug-blob"></div>
        <div class="ug-hd">
          <div class="ug-eyebrow">Pro Plan</div>
          <div class="ug-title">Upgrade to <span>Pro</span></div>
        </div>
        <div class="ug-body">
          <div class="ug-benefit">
            <div class="ug-check"><svg width="10" height="10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M5 13l4 4L19 7"/></svg></div>
            50,000+ API requests / month
          </div>
          <div class="ug-benefit">
            <div class="ug-check"><svg width="10" height="10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M5 13l4 4L19 7"/></svg></div>
            Unlimited API keys
          </div>
          <div class="ug-benefit">
            <div class="ug-check"><svg width="10" height="10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M5 13l4 4L19 7"/></svg></div>
            Webhooks &amp; event push
          </div>
          <div class="ug-benefit">
            <div class="ug-check"><svg width="10" height="10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M5 13l4 4L19 7"/></svg></div>
            SMTP Sandbox access
          </div>
          <div class="ug-benefit">
            <div class="ug-check"><svg width="10" height="10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M5 13l4 4L19 7"/></svg></div>
            Priority support
          </div>
        </div>
        <div class="ug-footer">
          <button class="ug-cta">
            <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
            Upgrade to Pro
          </button>
          <div style="text-align:center;margin-top:8px;font-size:.68rem;color:rgba(255,255,255,.3);font-family:var(--MONO);">from $4/month · cancel anytime</div>
        </div>
      </div>

    </div><!-- /bottom-grid -->

  </div><!-- /main -->
</div><!-- /shell -->

<script>

/* ══════════════════════════════════════════════
   API KEYS PAGE
══════════════════════════════════════════════ */

const FREE_KEY_LIMIT = 3;
const DAILY_LIMIT    = 100;
const USED_TODAY     = 25;

const PERMS_DEFS = [
  { id:'read_inboxes',    label:'Read Inboxes' },
  { id:'read_messages',   label:'Read Messages' },
  { id:'generate_emails', label:'Generate Temp Emails' },
  { id:'manage_aliases',  label:'Manage Aliases' },
];

let API_KEYS = [
//   {
//     id:1, name:'Laravel Application', prefix:'sdf',
//     masked:'sdf',
//     full:'dslfksda',
//     created:'June 20, 2026', last_used:'Today', status:'active',
//     perms:['read_inboxes','read_messages','generate_emails'],
//   },
//   {
//     id:2, name:'Testing Project', prefix:'sk_test',
//     masked:'sk_test_••••••••••••••••7c2b',
//     full:'sk_test_7c2b8d3e4f5a6b7c8d9e0f1a2b3c4d5e',
//     created:'June 15, 2026', last_used:'Yesterday', status:'active',
//     perms:['read_inboxes','read_messages'],
//   },
];
let nextKeyId    = 3;
let deletingId   = null;
let revealedKeys = new Set();
let generatedKey = '';

/* ── Render table ── */
function renderKeys() {
  const tbody = document.getElementById('keys-tbody');
  const empty = document.getElementById('empty-state');
  const cnt   = document.getElementById('stat-active-keys');
  const sub   = document.getElementById('stat-keys-sub');
  const lbl   = document.getElementById('keys-count-lbl');
  const btn   = document.getElementById('create-btn');

  const active = API_KEYS.filter(k => k.status === 'active').length;
  cnt.textContent = active;
  sub.textContent = Math.max(0, FREE_KEY_LIMIT - active) + ' more available';
  lbl.textContent = active + ' of ' + FREE_KEY_LIMIT + ' keys used';
  btn.disabled    = active >= FREE_KEY_LIMIT;
  btn.title       = active >= FREE_KEY_LIMIT ? 'Upgrade to add more keys' : '';

  if (!API_KEYS.length) {
    tbody.innerHTML = '';
    empty.classList.add('show');
    return;
  }
  empty.classList.remove('show');

  tbody.innerHTML = API_KEYS.map(k => {
    const revealed = revealedKeys.has(k.id);
    const dispKey  = revealed ? k.full : k.masked;
    const lastCls  = k.last_used === 'Today' ? 'date-today' : k.last_used === 'Yesterday' ? 'date-recently' : '';

    return `<tr data-id="${k.id}">
      <td>
        <div class="key-name-cell">
          <div class="key-name-icon">${k.prefix === 'sk_live' ? 'LV' : 'TS'}</div>
          <div>
            <div class="key-name-txt">${k.name}</div>
            <div class="key-name-sub">${k.perms.length} permission${k.perms.length!==1?'s':''}</div>
          </div>
        </div>
      </td>
      <td>
        <div style="display:flex;align-items:center;gap:6px;flex-wrap:wrap;">
          <span class="key-mono">${dispKey}</span>
          <button class="key-reveal" onclick="toggleReveal(${k.id})">${revealed?'Hide':'Show'}</button>
        </div>
      </td>
      <td class="col-created date-cell">${k.created}</td>
      <td class="col-last-used date-cell ${lastCls}">${k.last_used}</td>
      <td><span class="badge badge-active"><span class="bdot"></span>Active</span></td>
      <td>
        <div class="row-acts">
          <button class="act-btn copy" title="Copy key" onclick="copyKey(${k.id})">
            <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><rect x="9" y="9" width="13" height="13" rx="2"/><path stroke-linecap="round" d="M5 15H4a2 2 0 01-2-2V4a2 2 0 012-2h9a2 2 0 012 2v1"/></svg>
          </button>
          <button class="act-btn del" title="Delete key" onclick="openDeleteModal(${k.id})">
            <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><polyline points="3 6 5 6 21 6"/><path stroke-linecap="round" d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6"/></svg>
          </button>
        </div>
      </td>
    </tr>`;
  }).join('');
}

function toggleReveal(id) {
  if (revealedKeys.has(id)) revealedKeys.delete(id);
  else revealedKeys.add(id);
  renderKeys();
}

function copyKey(id) {
  const k = API_KEYS.find(x => x.id === id);
  if (!k) return;
  navigator.clipboard.writeText(k.full).catch(() => {});
  showToast('API key copied!');
}

/* ── Create modal ── */
function buildPermsGrid() {
  const grid = document.getElementById('perms-grid');
  grid.innerHTML = PERMS_DEFS.map(p => `
    <label class="perm-check checked" id="perm-${p.id}" onclick="togglePerm(this,'${p.id}')">
      <input type="checkbox" checked/>
      <div class="perm-box">
        <svg width="9" height="9" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" d="M5 13l4 4L19 7"/></svg>
      </div>
      <span class="perm-lbl">${p.label}</span>
    </label>
  `).join('');
}

function togglePerm(el, id) {
  el.classList.toggle('checked');
  const box = el.querySelector('.perm-box');
  if (el.classList.contains('checked')) {
    box.innerHTML = '<svg width="9" height="9" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" d="M5 13l4 4L19 7"/></svg>';
  } else {
    box.innerHTML = '';
  }
}

function openCreateModal() {
  if (API_KEYS.length >= FREE_KEY_LIMIT) {
    showToast('Key limit reached — upgrade to Pro');
    scrollUpgrade(); return;
  }
  document.getElementById('key-name').value = '';
  document.getElementById('key-name-err').classList.remove('show');
  document.getElementById('key-name').classList.remove('err');
  document.getElementById('cm-step1').style.display = '';
  document.getElementById('cm-step2').style.display = 'none';
  buildPermsGrid();
  document.getElementById('create-modal').classList.add('open');
}

function closeCreateModal() {
  document.getElementById('create-modal').classList.remove('open');
}

function generateKey() {
  const name = document.getElementById('key-name').value.trim();
  if (!name) {
    document.getElementById('key-name').classList.add('err');
    document.getElementById('key-name-err').classList.add('show');
    return;
  }
  document.getElementById('key-name').classList.remove('err');
  document.getElementById('key-name-err').classList.remove('show');

  // Collect permissions
  const perms = PERMS_DEFS
    .filter(p => document.getElementById('perm-'+p.id)?.classList.contains('checked'))
    .map(p => p.id);

  // Generate fake key
  const chars  = 'abcdef0123456789';
  const rand32 = Array.from({length:32},()=>chars[Math.floor(Math.random()*chars.length)]).join('');
  const fullKey = 'sk_live_' + rand32;
  const masked  = 'sk_live_' + '••••••••••••••••' + rand32.slice(-4);

  generatedKey = fullKey;

  API_KEYS.push({
    id: nextKeyId++, name, prefix:'sk_live',
    masked, full: fullKey,
    created: new Date().toLocaleDateString('en-US',{month:'long',day:'numeric',year:'numeric'}),
    last_used: 'Never', status:'active', perms,
  });

  document.getElementById('generated-key-display').textContent = fullKey;
  const btn = document.getElementById('gkb-copy-btn');
  btn.classList.remove('ok');
  btn.innerHTML = '<svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><rect x="9" y="9" width="13" height="13" rx="2"/><path stroke-linecap="round" d="M5 15H4a2 2 0 01-2-2V4a2 2 0 012-2h9a2 2 0 012 2v1"/></svg> Copy Key';

  document.getElementById('cm-step1').style.display = 'none';
  document.getElementById('cm-step2').style.display = '';
  renderKeys();
}

function copyGeneratedKey() {
  navigator.clipboard.writeText(generatedKey).catch(()=>{});
  const btn = document.getElementById('gkb-copy-btn');
  btn.classList.add('ok');
  btn.innerHTML = '<svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M5 13l4 4L19 7"/></svg> Copied!';
  showToast('API key copied — store it safely!');
}

function finishCreate() {
  closeCreateModal();
  showToast('API key created successfully!');
}

/* ── Delete modal ── */
function openDeleteModal(id) {
  deletingId = id;
  const k = API_KEYS.find(x => x.id === id);
  if (!k) return;
  document.getElementById('dm-key-name').textContent    = '"' + k.name + '"';
  document.getElementById('dm-key-preview').textContent = k.masked;
  document.getElementById('delete-modal').classList.add('open');
}

function closeDeleteModal() {
  document.getElementById('delete-modal').classList.remove('open');
  deletingId = null;
}

function confirmDelete() {
  const row = document.querySelector(`tr[data-id="${deletingId}"]`);
  if (row) { row.style.opacity='0'; row.style.transform='translateX(8px)'; row.style.transition='all .2s'; }
  setTimeout(() => {
    API_KEYS = API_KEYS.filter(k => k.id !== deletingId);
    closeDeleteModal();
    renderKeys();
    showToast('API key deleted');
  }, 200);
}

/* ── Endpoint copy ── */
function copyEndpoint(ep) {
  const base = 'https://api.inboxoro.com';
  navigator.clipboard.writeText(base + ep).catch(()=>{});
  showToast('Copied: ' + base + ep);
}

/* ── Scroll to upgrade ── */
function scrollUpgrade() {
  document.getElementById('upgrade-section').scrollIntoView({behavior:'smooth',block:'center'});
}

/* ── Refresh ── */
function refreshPage() {
  const ic = document.getElementById('refresh-ic');
  ic.style.transition='transform .5s'; ic.style.transform='rotate(360deg)';
  setTimeout(()=>{ic.style.transition='none'; ic.style.transform='';},520);
  renderKeys(); showToast('Refreshed!');
}

/* ── Toast ── */
function showToast(msg) {
  const t = document.getElementById('toast');
  t.querySelector('span').textContent = msg;
  t.classList.add('show');
  setTimeout(()=>t.classList.remove('show'), 2600);
}

/* ── Keyboard ── */
document.addEventListener('keydown', e => {
  if (e.key==='Escape') { closeCreateModal(); closeDeleteModal(); }
});

/* ── Countdown timer for reset ── */
(function resetTimer() {
  const el = document.getElementById('uc-reset');
  if (!el) return;
  const now = new Date();
  const midnight = new Date(now);
  midnight.setUTCHours(24,0,0,0);
  function tick() {
    const diff = Math.max(0, Math.floor((midnight - new Date()) / 1000));
    const h = Math.floor(diff/3600), m = Math.floor((diff%3600)/60), s = diff%60;
    el.textContent = h+'h '+String(m).padStart(2,'0')+'m '+String(s).padStart(2,'0')+'s';
  }
  tick(); setInterval(tick, 1000);
})();

/* ── Sidebar ── */
const sidebar    = document.getElementById('sidebar');
const backdrop   = document.getElementById('sb-backdrop');
const toggleBtn  = document.getElementById('sb-toggle-btn');
const collapseBtn= document.getElementById('sb-collapse-btn');
let isCollapsed  = false;
const isMob      = () => window.innerWidth < 900;
if (toggleBtn)   toggleBtn.addEventListener('click',()=>{ if(isMob()){const o=sidebar.classList.toggle('mob-open');backdrop.classList.toggle('show',o);}else collapseSidebar(!isCollapsed); });
if (collapseBtn) collapseBtn.addEventListener('click',()=>collapseSidebar(!isCollapsed));
function collapseSidebar(c){isCollapsed=c;sidebar.classList.toggle('collapsed',c);document.body.classList.toggle('sb-collapsed',c);}
function closeMobileSb(){sidebar.classList.remove('mob-open');backdrop.classList.remove('show');}
window.addEventListener('resize',()=>{if(!isMob())closeMobileSb();});
function toggleUserDd(){document.getElementById('user-dd').classList.toggle('open');}
document.addEventListener('click',e=>{if(!e.target.closest('#tb-av'))document.getElementById('user-dd')?.classList.remove('open');});

/* ── Boot ── */
renderKeys();
</script>
</body>
</html>