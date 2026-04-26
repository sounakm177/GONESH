<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>DROPIT — Dashboard</title>
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
   TOPBAR
════════════════════════════════════════════════ */
.topbar {
  height:          56px;
  min-height:      56px;
  background:      var(--SURF);
  border-bottom:   1px solid var(--BD);
  display:         flex;
  align-items:     center;
  padding:         0 16px;
  gap:             12px;
  z-index:         200;
  flex-shrink:     0;
}

/* hamburger / toggle — visible on mobile, repurposed as collapse toggle on desktop */
.sb-toggle {
  width:           36px;
  height:          36px;
  display:         flex;
  align-items:     center;
  justify-content: center;
  border-radius:   8px;
  color:           var(--MU);
  transition:      background .15s, color .15s;
  flex-shrink:     0;
}
.sb-toggle:hover { background: var(--BD2); color: var(--INK); }

.topbar-logo {
  font-family:    var(--DISP);
  font-size:      1.45rem;
  color:          var(--INK);
  letter-spacing: .04em;
  flex-shrink:    0;
  line-height:    1;
}
.topbar-logo .acc { color: var(--Y); }

/* search */
.topbar-search {
  flex:        1;
  max-width:   360px;
  display:     flex;
  align-items: center;
  gap:         8px;
  background:  var(--BG);
  border:      1px solid var(--BD);
  border-radius: 8px;
  padding:     0 12px;
  height:      36px;
}
.topbar-search input {
  flex:        1;
  border:      none;
  outline:     none;
  background:  transparent;
  font-family: var(--BODY);
  font-size:   .84rem;
  color:       var(--INK);
}
.topbar-search input::placeholder { color: var(--MU2); }
.topbar-search svg { color: var(--MU2); }

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
  color:           var(--MU);
  position:        relative;
  transition:      background .15s, color .15s;
}
.tb-icon:hover { background: var(--BD2); color: var(--INK); }

.notif-badge {
  position:      absolute;
  top:           6px;
  right:         6px;
  width:         7px;
  height:        7px;
  background:    var(--RED);
  border-radius: 50%;
  border:        2px solid var(--SURF);
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
   SIDEBAR
   Mobile: slides in as overlay (off-canvas)
   Desktop: inline, collapses to icon rail
════════════════════════════════════════════════ */
.sidebar {
  width:          var(--SB-W);
  min-width:      var(--SB-W);
  background:     var(--SURF);
  border-right:   1px solid var(--BD);
  display:        flex;
  flex-direction: column;
  overflow:       hidden;
  transition:     width .25s cubic-bezier(.4,0,.2,1),
                  min-width .25s cubic-bezier(.4,0,.2,1),
                  transform .25s cubic-bezier(.4,0,.2,1);
  flex-shrink:    0;
  z-index:        150;

  /* Mobile: off-canvas */
  position:   fixed;
  top:        56px;
  left:       0;
  bottom:     0;
  transform:  translateX(-100%);
}

/* open on mobile */
.sidebar.mob-open {
  transform: translateX(0);
  box-shadow: 4px 0 24px rgba(0,0,0,.12);
}

/* mobile overlay backdrop */
.sb-backdrop {
  display:    none;
  position:   fixed;
  inset:      0;
  background: rgba(0,0,0,.35);
  z-index:    140;
}
.sb-backdrop.show { display: block; }

/* collapsed state (desktop only) */
.sidebar.collapsed {
  width:     var(--SB-MINI);
  min-width: var(--SB-MINI);
}

/* ── Sidebar header ── */
.sb-header {
  height:          56px;
  min-height:      56px;
  display:         flex;
  align-items:     center;
  padding:         0 14px;
  border-bottom:   1px solid var(--BD2);
  gap:             10px;
  flex-shrink:     0;
}
.sb-brand {
  font-family:    var(--DISP);
  font-size:      1.3rem;
  color:          var(--INK);
  letter-spacing: .04em;
  white-space:    nowrap;
  overflow:       hidden;
  opacity:        1;
  transition:     opacity .2s;
}
.sb-brand .acc { color: var(--Y); }
.sidebar.collapsed .sb-brand { opacity: 0; width: 0; pointer-events: none; }

/* collapse toggle button (inside sidebar, desktop) */
.sb-collapse-btn {
  width:           28px;
  height:          28px;
  min-width:       28px;
  display:         none; /* shown at desktop */
  align-items:     center;
  justify-content: center;
  border-radius:   6px;
  color:           var(--MU);
  margin-left:     auto;
  transition:      background .15s, color .15s, transform .25s;
}
.sb-collapse-btn:hover { background: var(--BD2); color: var(--INK); }
.sidebar.collapsed .sb-collapse-btn { transform: rotate(180deg); }

/* ── Sidebar body ── */
.sb-body {
  flex:       1;
  overflow-y: auto;
  overflow-x: hidden;
  padding:    12px 0;
}
.sb-body::-webkit-scrollbar { width: 3px; }
.sb-body::-webkit-scrollbar-thumb { background: var(--BD); border-radius: 2px; }

/* section label */
.sb-label {
  font-family:    var(--MONO);
  font-size:      .56rem;
  font-weight:    700;
  letter-spacing: .12em;
  text-transform: uppercase;
  color:          var(--MU2);
  padding:        14px 18px 6px;
  white-space:    nowrap;
  overflow:       hidden;
  transition:     opacity .2s, height .2s;
  opacity:        1;
}
.sidebar.collapsed .sb-label { opacity: 0; height: 0; padding: 0; }

/* nav item */
.sb-item {
  display:       flex;
  align-items:   center;
  gap:           10px;
  padding:       9px 14px;
  margin:        1px 8px;
  border-radius: 8px;
  font-size:     .84rem;
  font-weight:   500;
  color:         var(--MU);
  transition:    background .12s, color .12s;
  white-space:   nowrap;
  overflow:      hidden;
  position:      relative;
}
.sb-item:hover { background: var(--BD2); color: var(--INK); }
.sb-item.active {
  background: rgba(250,204,21,.15);
  color:      var(--INK);
  font-weight: 600;
}
.sb-item.active .sb-item-icon { color: var(--INK2); }

.sb-item-icon {
  width:           20px;
  min-width:       20px;
  display:         flex;
  align-items:     center;
  justify-content: center;
  color:           var(--MU);
  transition:      color .12s;
}
.sb-item:hover .sb-item-icon { color: var(--INK); }

.sb-item-label {
  flex:       1;
  opacity:    1;
  transition: opacity .15s;
  overflow:   hidden;
}
.sidebar.collapsed .sb-item-label { opacity: 0; }

.sb-pill {
  background:     var(--INK);
  color:          var(--Y);
  font-family:    var(--MONO);
  font-size:      .52rem;
  font-weight:    800;
  padding:        2px 6px;
  border-radius:  4px;
  flex-shrink:    0;
  opacity:        1;
  transition:     opacity .15s;
}
.sidebar.collapsed .sb-pill { opacity: 0; }

/* collapsed tooltip on hover */
.sb-item[data-tip]:hover::after {
  content:      attr(data-tip);
  position:     absolute;
  left:         calc(var(--SB-MINI) + 4px);
  top:          50%;
  transform:    translateY(-50%);
  background:   var(--INK);
  color:        #fff;
  font-size:    .74rem;
  padding:      5px 10px;
  border-radius: 6px;
  white-space:  nowrap;
  pointer-events: none;
  display:      none; /* only show when collapsed */
}
.sidebar.collapsed .sb-item[data-tip]:hover::after { display: block; }

.sb-divider { height: 1px; background: var(--BD2); margin: 8px 16px; }

/* ── Sidebar footer ── */
.sb-footer {
  padding:         12px;
  border-top:      1px solid var(--BD2);
  flex-shrink:     0;
}
.sb-user {
  display:       flex;
  align-items:   center;
  gap:           10px;
  padding:       8px 6px;
  border-radius: 8px;
  cursor:        pointer;
  overflow:      hidden;
  transition:    background .12s;
}
.sb-user:hover { background: var(--BD2); }
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
}
.sb-user-info { overflow: hidden; opacity: 1; transition: opacity .15s; }
.sidebar.collapsed .sb-user-info { opacity: 0; }
.sb-user-name  { font-size: .8rem; font-weight: 700; color: var(--INK); white-space: nowrap; }
.sb-user-plan  { font-family: var(--MONO); font-size: .58rem; color: var(--MU); white-space: nowrap; }

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
  .main { padding: 32px 36px 64px; }
}











/* ═══════════════════════════════════════
   FIX: TRUE MERGED TOPBAR + SIDEBAR (GMAIL STYLE)
═══════════════════════════════════════ */
@media (min-width: 900px) {

  /* Sidebar should start from top */
  .sidebar {
    position: relative;
    top: 0;
    height: 100vh;
  }

  /* 🔴 REMOVE duplicate header effect */
  .sb-header {
    display: none; /* key fix */
  }

  /* Adjust sidebar body spacing */
  .sb-body {
    padding-top: 12px;
  }

  /* Keep only ONE header (topbar) */
  .topbar {
    position: sticky;
    top: 0;
    z-index: 300;
  }

  /* Keep hamburger (like Gmail) */
  .sb-toggle {
    display: flex;
  }

  /* REMOVE sidebar collapse button (duplicate UX) */
  .sb-collapse-btn {
    display: none !important;
  }

  /* Align everything clean */
  .shell {
    align-items: stretch;
  }

  /* Smooth visual connection */
  .sidebar {
    border-right: 1px solid var(--BD);
  }

  /* Fix spacing so content aligns like Gmail */
  .main {
    margin-left: 0;
  }
}

/* ═══════════════════════════════════════
   TOPBAR REFINEMENT (DESKTOP ONLY)
═══════════════════════════════════════ */
@media (min-width: 900px) {

  .topbar {
    padding: 0 24px;
    gap: 16px;
  }

  /* Better logo spacing */
  .topbar-logo {
    margin-right: 8px;
  }

  /* Search centered + balanced */
  .topbar-search {
    max-width: 480px;
    height: 38px;
    border-radius: 10px;
  }

  /* Push search slightly to center visually */
  .topbar-search {
    margin-left: 12px;
  }

  /* Right side spacing */
  .topbar-right {
    gap: 10px;
  }

  /* Icons better touch + visual weight */
  .tb-icon {
    width: 38px;
    height: 38px;
    border-radius: 10px;
  }

  /* Avatar refinement */
  .tb-avatar {
    width: 38px;
    height: 38px;
    border-radius: 10px;
  }

  /* Subtle separation from content */
  .topbar {
    box-shadow: 0 1px 0 var(--BD);
  }

  /* Align with sidebar visually */
  .topbar {
    padding-left: 20px;
  }

  /* Optional: constrain content width feel (premium look) */
  .topbar > * {
    align-self: center;
  }
}
</style>
</head>
<body>

<div id="toast">
  <div class="toast-dot"></div>
  <span id="toast-msg">Copied!</span>
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
    <img src="{{asset('/images/logo.svg')}}" alt="Inboxoro Temporary Email Service" class="logo-img">
  </div>

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

<!-- ════════════════════════════
     SHELL
════════════════════════════ -->
<div class="shell">

  <!-- Mobile backdrop -->
  <div class="sb-backdrop" id="sb-backdrop" onclick="closeMobileSb()"></div>

  <!-- ════ SIDEBAR ════ -->
  <div class="sidebar" id="sidebar">

    <div class="sb-header">
      <div class="sb-brand">DROP<span class="acc">IT</span></div>
      <!-- Desktop collapse button (inside sidebar) -->
      <button class="sb-collapse-btn" id="sb-collapse-btn" aria-label="Collapse sidebar">
        <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
          <path stroke-linecap="round" d="M15 19l-7-7 7-7"/>
        </svg>
      </button>
    </div>

    <div class="sb-body">

      <div class="sb-label">Main</div>

      <a class="sb-item active" href="#" data-tip="Overview">
        <div class="sb-item-icon">
          <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7" rx="1.5"/><rect x="14" y="3" width="7" height="7" rx="1.5"/><rect x="3" y="14" width="7" height="7" rx="1.5"/><rect x="14" y="14" width="7" height="7" rx="1.5"/></svg>
        </div>
        <span class="sb-item-label">Overview</span>
      </a>

      <a class="sb-item" href="#" data-tip="Inbox">
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

  <!-- ════ MAIN ════ -->
  <div class="main" id="main">

    <!-- Page header -->
    <div class="page-hd">
      <div>
        <div class="page-title">Dashboard</div>
        <div class="page-subtitle">Welcome back, John · Sunday Apr 26 2026</div>
      </div>
      <div style="display:flex;gap:8px;align-items:center;flex-wrap:wrap;">
        <button class="btn-ghost" onclick="refreshPage()">
          <svg id="refresh-ic" width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
          Refresh
        </button>
        <button class="btn-primary yellow" onclick="generateNew()">
          <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M12 4v16m8-8H4"/></svg>
          New Address
        </button>
      </div>
    </div>

    <!-- Stat cards -->
    <div class="stat-grid">

      <div class="stat-card">
        <div class="stat-card-top">
          <div class="stat-icon-wrap yellow">
            <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/></svg>
          </div>
          <div class="stat-trend up">↑ 12%</div>
        </div>
        <div class="stat-value">47</div>
        <div class="stat-label">Total Addresses</div>
      </div>

      <div class="stat-card">
        <div class="stat-card-top">
          <div class="stat-icon-wrap blue">
            <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
          </div>
          <div class="stat-trend up">↑ 8%</div>
        </div>
        <div class="stat-value">238</div>
        <div class="stat-label">Emails Received</div>
      </div>

      <div class="stat-card">
        <div class="stat-card-top">
          <div class="stat-icon-wrap green">
            <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path stroke-linecap="round" d="M12 8v4l3 3"/></svg>
          </div>
          <div class="live-tag"><div class="live-dot"></div>Live</div>
        </div>
        <div class="stat-value">3</div>
        <div class="stat-label">Active Now</div>
      </div>

      <div class="stat-card">
        <div class="stat-card-top">
          <div class="stat-icon-wrap red">
            <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
          </div>
          <div class="stat-trend down" style="background:rgba(239,68,68,.08);color:var(--RED);">↑ 34%</div>
        </div>
        <div class="stat-value">1.2K</div>
        <div class="stat-label">Spam Blocked</div>
      </div>

    </div><!-- /stat-grid -->

    <!-- Generator card -->
    <div class="gen-card">
      <div class="gen-card-hd">
        <div class="gen-card-title">Quick Generate</div>
        <div class="live-tag"><div class="live-dot"></div>Active</div>
      </div>
      <div class="gen-card-body">
        <div class="dom-tabs" id="dom-tabs"></div>
        <div class="email-display">
          <div class="email-txt" id="gen-email">Generating…</div>
          <button class="copy-btn" id="copy-btn" onclick="copyEmail()">Copy</button>
          <button class="new-btn" onclick="generateNew()">
            <svg id="spin-ic" width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
            New
          </button>
        </div>
        <div class="timer-row">
          <span class="timer-lbl">Expires</span>
          <div class="timer-track"><div class="timer-fill" id="tbar"></div></div>
          <span class="timer-count" id="tnum">10:00</span>
        </div>
      </div>
    </div>

    <!-- Bottom grid -->
    <div class="bottom-grid">

      <!-- Addresses table -->
      <div class="panel">
        <div class="panel-hd">
          <span class="panel-title">Your Addresses</span>
          <span class="panel-meta">47 total · 3 active</span>
        </div>
        <div class="tab-row">
          <button class="tab-btn active" onclick="filterAddrs(this,'all')">All</button>
          <button class="tab-btn" onclick="filterAddrs(this,'active')">Active</button>
          <button class="tab-btn" onclick="filterAddrs(this,'expired')">Expired</button>
        </div>
        <div id="addr-list"></div>
      </div>

      <!-- Right column -->
      <div style="display:flex;flex-direction:column;gap:16px;">

        <!-- Chart -->
        <div class="panel">
          <div class="panel-hd">
            <span class="panel-title">This Week</span>
            <div style="display:flex;gap:10px;">
              <span style="display:flex;align-items:center;gap:4px;font-size:.68rem;color:var(--MU);"><span style="display:inline-block;width:8px;height:8px;border-radius:50%;background:var(--Y);"></span>Received</span>
              <span style="display:flex;align-items:center;gap:4px;font-size:.68rem;color:var(--MU);"><span style="display:inline-block;width:8px;height:8px;border-radius:50%;background:var(--B);"></span>Read</span>
            </div>
          </div>
          <div class="chart-bars" id="chart"></div>
          <div class="chart-labels" id="chart-x"></div>
        </div>

        <!-- Activity -->
        <div class="panel" style="flex:1;">
          <div class="panel-hd">
            <span class="panel-title">Recent Activity</span>
            <span class="panel-meta">Last 24h</span>
          </div>
          <div id="activity"></div>
        </div>

      </div>
    </div>

  </div><!-- /main -->
</div><!-- /shell -->

<script>
/* ════════════════════════════
   SIDEBAR LOGIC
════════════════════════════ */
const sidebar   = document.getElementById('sidebar');
const backdrop  = document.getElementById('sb-backdrop');
const toggleBtn = document.getElementById('sb-toggle-btn');
const collapseBtn = document.getElementById('sb-collapse-btn');

let isMobile = () => window.innerWidth < 900;
let isCollapsed = false;

/* Top-bar toggle button — dual behaviour */
toggleBtn.addEventListener('click', () => {
  if (isMobile()) {
    /* Mobile: slide in/out overlay */
    const open = sidebar.classList.toggle('mob-open');
    backdrop.classList.toggle('show', open);
  } else {
    /* Desktop: collapse/expand inline */
    collapseSidebar(!isCollapsed);
  }
});

/* Collapse button inside sidebar (desktop) */
collapseBtn.addEventListener('click', () => collapseSidebar(!isCollapsed));

function collapseSidebar(collapse) {
  isCollapsed = collapse;
  sidebar.classList.toggle('collapsed', collapse);
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
</body>
</html>