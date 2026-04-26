<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>DROPIT — Dashboard</title>
<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Outfit:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;500;700&display=swap" rel="stylesheet"/>
<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">

<style>
/* ══════════════════════════════════════════════════
   Dashboard layout — mobile-first
══════════════════════════════════════════════════ */
html, body { height: 100%; }
body { display:flex; flex-direction:column; overflow:hidden; cursor:none; }

/* ── Topbar ── */
.topbar {
  background:      var(--INK);
  display:         flex;
  align-items:     center;
  justify-content: space-between;
  padding:         0 max(14px, env(safe-area-inset-left));
  height:          52px;
  border-bottom:   3px solid var(--Y);
  flex-shrink:     0;
  z-index:         50;
  gap:             10px;
}
.topbar-logo { font-family:var(--DISP); font-size:1.6rem; color:var(--Y); letter-spacing:.05em; text-decoration:none; flex-shrink:0; }
.topbar-logo .white { color:#fff; }

.topbar-search {
  flex:        1;
  max-width:   320px;
  display:     flex;
  align-items: center;
  gap:         7px;
  background:  rgba(255,255,255,.06);
  border:      1px solid rgba(255,255,255,.1);
  padding:     7px 12px;
  /* hidden on very small screens */
  display:     none;
}
.topbar-search input { background:transparent; border:none; outline:none; font-family:var(--BODY); font-size:14px; color:#fff; width:100%; }
.topbar-search input::placeholder { color:#6B7280; }
.topbar-search svg { flex-shrink:0; color:#6B7280; }

.topbar-right { display:flex; align-items:center; gap:8px; position:relative; }

.tb-icon-btn {
  width:            34px;
  height:           34px;
  display:          flex;
  align-items:      center;
  justify-content:  center;
  border:           1.5px solid rgba(255,255,255,.12);
  background:       transparent;
  color:            var(--MU2);
  position:         relative;
  transition:       background .12s, color .12s;
  flex-shrink:      0;
}
.tb-icon-btn:hover { background:rgba(255,255,255,.08); color:var(--Y); }

.tb-notif-dot { position:absolute; top:5px; right:5px; width:7px; height:7px; background:var(--Y); border-radius:50%; border:1.5px solid var(--INK); }

.tb-user {
  display:     flex;
  align-items: center;
  gap:         7px;
  padding:     4px 8px;
  border:      1px solid rgba(255,255,255,.1);
  transition:  background .12s;
  cursor:      pointer;
}
.tb-user:hover { background:rgba(255,255,255,.06); }
.tb-avatar {
  width:           32px;
  height:          32px;
  background:      var(--Y);
  border:          2px solid var(--INK2);
  display:         flex;
  align-items:     center;
  justify-content: center;
  font-family:     var(--DISP);
  font-size:       .95rem;
  color:           var(--INK);
  flex-shrink:     0;
}
.tb-user-name { font-size:.78rem; font-weight:600; color:#fff; display:none; }
.tb-user-plan { font-family:var(--MONO); font-size:.55rem; color:var(--Y); font-weight:700; letter-spacing:.08em; display:none; }

/* ── App shell ── */
.shell { display:flex; flex:1; overflow:hidden; }

/* ── Sidebar ── */
.sidebar {
  width:          56px; /* icon-only on mobile */
  flex-shrink:    0;
  background:     var(--INK);
  border-right:   2px solid rgba(255,255,255,.07);
  display:        flex;
  flex-direction: column;
  padding:        14px 0;
  overflow-y:     auto;
  overflow-x:     hidden;
  transition:     width .25s cubic-bezier(.4,0,.2,1);
}
.sidebar::-webkit-scrollbar { width:3px; }
.sidebar::-webkit-scrollbar-thumb { background:rgba(255,255,255,.1); }

.sb-section { padding:0 8px; margin-bottom:4px; overflow:hidden; }
.sb-section-label {
  font-family:    var(--MONO);
  font-size:      .56rem;
  font-weight:    700;
  letter-spacing: .14em;
  text-transform: uppercase;
  color:          #4B5563;
  padding:        10px 8px 6px;
  white-space:    nowrap;
  opacity:        0; /* shown when sidebar expands */
  transition:     opacity .15s;
}

.sb-item {
  display:        flex;
  align-items:    center;
  gap:            10px;
  padding:        10px 18px;
  font-size:      .8rem;
  font-weight:    500;
  color:          var(--MU2);
  text-decoration: none;
  border-left:    3px solid transparent;
  white-space:    nowrap;
  overflow:       hidden;
  transition:     background .12s, color .12s, border-color .12s;
  position:       relative;
}
.sb-item:hover  { background:rgba(255,255,255,.05); color:#fff; }
.sb-item.active { background:rgba(250,204,21,.1); color:var(--Y); border-left-color:var(--Y); font-weight:700; }
.sb-item svg    { flex-shrink:0; min-width:15px; }
.sb-item-label  { opacity:0; transition:opacity .15s; }

.sb-badge {
  margin-left:    auto;
  background:     var(--Y);
  color:          var(--INK);
  font-family:    var(--MONO);
  font-size:      .54rem;
  font-weight:    800;
  padding:        2px 5px;
  flex-shrink:    0;
  opacity:        0;
  transition:     opacity .15s;
}

.sb-divider { border:none; border-top:1px solid rgba(255,255,255,.06); margin:8px; }

.sb-user-card {
  margin:         auto 10px 0;
  border:         1px solid rgba(255,255,255,.08);
  background:     rgba(255,255,255,.03);
  padding:        10px 12px;
  overflow:       hidden;
}
.sb-user-name  { font-size:.78rem; font-weight:700; color:#fff; margin-bottom:1px; white-space:nowrap; opacity:0; transition:opacity .15s; }
.sb-user-email { font-family:var(--MONO); font-size:.6rem; color:#6B7280; white-space:nowrap; opacity:0; transition:opacity .15s; }
.sb-upgrade {
  display:         flex;
  align-items:     center;
  justify-content: center;
  gap:             5px;
  margin-top:      8px;
  background:      var(--Y);
  color:           var(--INK);
  font-family:     var(--DISP);
  font-size:       .85rem;
  letter-spacing:  .05em;
  padding:         7px 10px;
  border:          none;
  width:           100%;
  box-shadow:      2px 2px 0 rgba(255,255,255,.15);
  white-space:     nowrap;
  overflow:        hidden;
  opacity:         0;
  transition:      opacity .15s, background .15s;
}
.sb-upgrade:hover { background:#fff; }

/* ── Main content ── */
.main {
  flex:        1;
  overflow-y:  auto;
  padding:     16px 12px 40px;
  display:     flex;
  flex-direction: column;
  gap:         18px;
  min-width:   0;
}
.main::-webkit-scrollbar { width:4px; }
.main::-webkit-scrollbar-thumb { background:var(--BD); border-radius:2px; }

/* Page title */
.page-title-row { display:flex; align-items:flex-end; justify-content:space-between; flex-wrap:wrap; gap:10px; }
.page-title { font-family:var(--DISP); font-size:1.7rem; letter-spacing:.04em; color:var(--INK); line-height:1; }
.page-title span { color:var(--Y); }
.page-sub { font-family:var(--MONO); font-size:.62rem; color:var(--MU); margin-top:3px; }

.btn-primary {
  display:        inline-flex;
  align-items:    center;
  gap:            6px;
  background:     var(--Y);
  color:          var(--INK);
  font-family:    var(--DISP);
  font-size:      .95rem;
  letter-spacing: .06em;
  padding:        9px 16px;
  border:         2px solid var(--INK);
  box-shadow:     3px 3px 0 var(--INK);
  white-space:    nowrap;
  transition:     transform .1s, box-shadow .1s;
}
.btn-primary:hover  { transform:translate(-1px,-1px); box-shadow:5px 5px 0 var(--INK); }
.btn-primary:active { transform:translate(1px,1px);   box-shadow:1px 1px 0 var(--INK); }

.btn-sec {
  display:        inline-flex;
  align-items:    center;
  gap:            5px;
  background:     var(--SURF);
  color:          var(--INK);
  font-size:      .76rem;
  font-weight:    600;
  padding:        8px 14px;
  border:         2px solid var(--INK);
  box-shadow:     2px 2px 0 var(--INK);
  white-space:    nowrap;
  transition:     transform .1s, box-shadow .1s, background .12s;
}
.btn-sec:hover  { background:#FFFBEB; transform:translate(-1px,-1px); box-shadow:4px 4px 0 var(--INK); }
.btn-sec:active { transform:translate(1px,1px); box-shadow:1px 1px 0 var(--INK); }

/* Stat grid */
.stat-grid { display:grid; grid-template-columns:repeat(2,1fr); gap:10px; }

.stat-card {
  background: var(--SURF);
  border:     2px solid var(--INK);
  padding:    14px 16px;
  position:   relative;
  overflow:   hidden;
  transition: box-shadow .15s, transform .12s;
}
.stat-card:hover { transform:translateY(-2px); box-shadow:3px 3px 0 var(--INK); }
.stat-card-accent { position:absolute; top:0; left:0; width:3px; height:100%; background:var(--Y); }
.stat-card.blue  .stat-card-accent { background:var(--B); }
.stat-card.green .stat-card-accent { background:var(--SUCCESS); }
.stat-card.red   .stat-card-accent { background:var(--DANGER); }

.stat-label { font-family:var(--MONO); font-size:.56rem; font-weight:700; letter-spacing:.1em; text-transform:uppercase; color:var(--MU); margin-bottom:6px; }
.stat-value { font-family:var(--DISP); font-size:1.9rem; color:var(--INK); line-height:1; margin-bottom:3px; }
.stat-sub   { font-size:.68rem; color:var(--MU); display:flex; align-items:center; gap:4px; }
.stat-up    { color:var(--SUCCESS); font-weight:700; }
.stat-dn    { color:var(--DANGER);  font-weight:700; }
.stat-icon  { position:absolute; bottom:12px; right:12px; color:#F3F4F6; }

/* Generator card */
.gen-card { background:var(--SURF); border:2px solid var(--INK); }
.gen-card-header {
  display:         flex;
  align-items:     center;
  justify-content: space-between;
  padding:         12px 16px;
  border-bottom:   2px solid var(--INK);
  background:      #FAFAFA;
}
.gen-card-title { font-family:var(--DISP); font-size:1rem; letter-spacing:.04em; }

.live-pill { display:flex; align-items:center; gap:6px; font-family:var(--MONO); font-size:.6rem; font-weight:700; color:#16a34a; letter-spacing:.06em; }
.live-dot  { width:6px; height:6px; background:var(--SUCCESS); border-radius:50%; animation:pulse-ring 2s ease-in-out infinite; }

.gen-card-body { padding:16px; }

.dom-pills { display:flex; flex-wrap:wrap; gap:6px; margin-bottom:12px; }
.dom-pill {
  font-family:    var(--MONO);
  font-size:      .64rem;
  font-weight:    600;
  padding:        4px 10px;
  border:         1.5px solid var(--INK);
  background:     var(--SURF);
  color:          var(--MU);
  transition:     background .12s, color .12s;
  white-space:    nowrap;
}
.dom-pill:hover  { background:#FEF9C3; color:var(--INK); }
.dom-pill.active { background:var(--INK); color:var(--Y); }

.gen-email-row {
  display:       flex;
  align-items:   center;
  gap:           8px;
  background:    var(--BG);
  border:        2px solid var(--INK);
  padding:       12px 14px;
  margin-bottom: 12px;
  overflow:      hidden;
}
.gen-email-txt {
  font-family:   var(--MONO);
  font-size:     clamp(.7rem, 3.2vw, 1rem);
  font-weight:   700;
  color:         var(--INK);
  flex:          1;
  min-width:     0;
  overflow:      hidden;
  text-overflow: ellipsis;
  white-space:   nowrap;
  transition:    opacity .3s;
}
.gen-email-txt.fading { opacity: .15; }

.btn-copy {
  background:  var(--Y);
  color:       var(--INK);
  font-size:   .74rem;
  font-weight: 700;
  padding:     9px 14px;
  border:      2px solid var(--INK);
  box-shadow:  2px 2px 0 var(--INK);
  flex-shrink: 0;
  white-space: nowrap;
  transition:  background .12s, transform .1s, box-shadow .1s;
}
.btn-copy:hover  { transform:translate(-1px,-1px); box-shadow:4px 4px 0 var(--INK); }
.btn-copy.ok     { background:var(--SUCCESS); color:#fff; border-color:#16a34a; }

.timer-row { display:flex; align-items:center; gap:8px; }
.timer-lbl { font-size:.68rem; color:var(--MU); white-space:nowrap; }
.timer-track { flex:1; height:3px; background:var(--BD); }
.timer-fill  { height:100%; background:var(--Y); width:100%; animation:shrink 600s linear forwards; }
@keyframes shrink { to { width:0; } }
.timer-txt { font-family:var(--MONO); font-size:.7rem; font-weight:700; color:var(--INK); white-space:nowrap; }

/* Panel */
.panel { background:var(--SURF); border:2px solid var(--INK); }
.panel-header {
  display:         flex;
  align-items:     center;
  justify-content: space-between;
  padding:         10px 16px;
  border-bottom:   2px solid var(--INK);
  background:      #FAFAFA;
  flex-wrap:       wrap;
  gap:             6px;
}
.panel-title { font-family:var(--DISP); font-size:1rem; letter-spacing:.04em; }
.panel-meta  { font-family:var(--MONO); font-size:.58rem; color:var(--MU); }

/* Tabs */
.tab-row { display:flex; border-bottom:2px solid var(--INK); overflow-x:auto; }
.tab {
  font-family:    var(--MONO);
  font-size:      .66rem;
  font-weight:    700;
  letter-spacing: .07em;
  text-transform: uppercase;
  padding:        8px 14px;
  border-bottom:  2px solid transparent;
  margin-bottom:  -2px;
  color:          var(--MU);
  white-space:    nowrap;
  transition:     color .15s, border-color .15s;
}
.tab:hover  { color:var(--INK); }
.tab.active { color:var(--INK); border-bottom-color:var(--Y); }

/* Address table */
.addr-head {
  display:               grid;
  grid-template-columns: 1fr 56px 70px 30px;
  padding:               7px 14px;
  gap:                   8px;
  background:            var(--INK);
}
.addr-head span { font-family:var(--MONO); font-size:.54rem; font-weight:700; letter-spacing:.1em; text-transform:uppercase; color:var(--MU2); }

.addr-row {
  display:               grid;
  grid-template-columns: 1fr 56px 70px 30px;
  padding:               10px 14px;
  gap:                   8px;
  border-top:            1px solid var(--BD);
  align-items:           center;
  transition:            background .1s;
}
.addr-row:hover { background:#FFFBEB; }

.addr-email   { font-family:var(--MONO); font-size:.7rem; font-weight:600; color:var(--INK); white-space:nowrap; overflow:hidden; text-overflow:ellipsis; }
.addr-msgs    { font-size:.72rem; color:var(--MU); text-align:center; }
.addr-msgs b  { color:var(--INK); font-weight:700; }

.addr-status {
  display:     inline-flex;
  align-items: center;
  gap:         4px;
  font-size:   .62rem;
  font-weight: 700;
  font-family: var(--MONO);
  white-space: nowrap;
}

.addr-action { display:flex; gap:3px; justify-content:flex-end; }
.icon-btn {
  width:       24px;
  height:      24px;
  display:     flex;
  align-items: center;
  justify-content: center;
  border:      1.5px solid var(--BD);
  background:  var(--SURF);
  color:       var(--MU);
  transition:  border-color .12s, color .12s, background .12s;
}
.icon-btn:hover        { border-color:var(--INK); color:var(--INK); background:#FEF9C3; }
.icon-btn.danger:hover { border-color:var(--DANGER); color:var(--DANGER); background:#fee2e2; }

/* Activity */
.activity-list { padding:10px 0; max-height:280px; overflow-y:auto; }
.activity-list::-webkit-scrollbar { width:3px; }
.activity-list::-webkit-scrollbar-thumb { background:var(--BD); }

.activity-item {
  display:     flex;
  align-items: flex-start;
  gap:         10px;
  padding:     9px 14px;
  border-bottom: 1px solid #F3F4F6;
  transition:  background .1s;
}
.activity-item:hover       { background:#FFFBEB; }
.activity-item:last-child  { border-bottom:none; }

.act-icon { width:28px; height:28px; min-width:28px; display:flex; align-items:center; justify-content:center; border:1.5px solid var(--BD); }
.act-icon.y { background:#FEF9C3; border-color:var(--Y); }
.act-icon.b { background:#EFF6FF; border-color:var(--B); }
.act-icon.g { background:#F0FDF4; border-color:var(--SUCCESS); }
.act-icon.r { background:#FEF2F2; border-color:var(--DANGER); }

.act-body    { flex:1; min-width:0; }
.act-msg     { font-size:.76rem; color:var(--INK); font-weight:500; line-height:1.4; margin-bottom:2px; overflow-wrap:break-word; }
.act-msg b   { font-weight:700; }
.act-time    { font-family:var(--MONO); font-size:.6rem; color:var(--MU2); }

/* Chart */
.chart-wrap { padding:14px 16px 8px; }
.chart-legend { display:flex; gap:12px; }
.legend-item  { display:flex; align-items:center; gap:5px; font-size:.68rem; color:var(--MU); }
.legend-dot   { width:7px; height:7px; border-radius:50%; flex-shrink:0; }
.simple-chart { display:flex; align-items:flex-end; gap:5px; height:70px; }
.bar-group    { display:flex; gap:2px; align-items:flex-end; flex:1; }
.bar          { flex:1; transition:opacity .15s; }
.bar:hover    { opacity:.75; }
.chart-x      { display:flex; gap:5px; margin-top:5px; }
.chart-x-lbl  { flex:1; text-align:center; font-family:var(--MONO); font-size:.52rem; color:#C0C0C0; }

/* Dropdowns */
.dropdown {
  display:    none;
  position:   absolute;
  top:        calc(100% + 4px);
  right:      0;
  width:      240px;
  background: var(--SURF);
  border:     2px solid var(--INK);
  box-shadow: 4px 4px 0 var(--INK);
  z-index:    200;
}
.dropdown.show { display:block; animation:slide-up .2s ease both; }

.dd-header { padding:10px 14px; border-bottom:2px solid var(--INK); font-family:var(--DISP); font-size:.95rem; letter-spacing:.04em; background:#FAFAFA; }
.dd-item   {
  display:     flex;
  align-items: center;
  gap:         8px;
  padding:     9px 14px;
  font-size:   .78rem;
  color:       var(--INK);
  font-weight: 500;
  border-bottom: 1px solid #F3F4F6;
  transition:  background .1s;
  cursor:      pointer;
}
.dd-item:hover        { background:#FFFBEB; }
.dd-item:last-child   { border-bottom:none; }
.dd-item.danger       { color:var(--DANGER); }
.dd-item.danger:hover { background:#FEF2F2; }

.notif-dot { width:6px; height:6px; background:var(--Y); border-radius:50%; flex-shrink:0; margin-top:5px; }
.notif-body  { flex:1; font-size:.75rem; color:var(--INK); line-height:1.4; }
.notif-time  { font-family:var(--MONO); font-size:.58rem; color:var(--MU2); margin-top:2px; }
.notif-item  { display:flex; gap:10px; padding:11px 14px; border-bottom:1px solid #F3F4F6; transition:background .1s; }
.notif-item:hover { background:#FFFBEB; }
.notif-item.unread { background:#FFFDE7; }
.notif-footer { padding:8px 14px; text-align:center; font-size:.72rem; color:var(--B); font-weight:600; border-top:1px solid var(--BD); cursor:pointer; }
.notif-footer:hover { background:#EFF6FF; }

/* ══════════════════════════════════════════════════
   RESPONSIVE UPGRADES
══════════════════════════════════════════════════ */
@media (min-width: 480px) {
  .stat-grid { grid-template-columns:repeat(2,1fr); }
  .stat-value { font-size:2.1rem; }
}

@media (min-width: 600px) {
  .topbar { padding:0 20px; height:54px; }
  .topbar-search { display:flex; }
  .tb-user-name, .tb-user-plan { display:block; }
  .main { padding:20px 20px 48px; gap:20px; }
  .stat-grid { grid-template-columns:repeat(2,1fr); gap:12px; }
}

@media (min-width: 900px) {
  .topbar { padding:0 28px; }

  /* Sidebar expands to full width */
  .sidebar { width:210px; }
  .sb-section-label,
  .sb-item-label,
  .sb-badge,
  .sb-user-name,
  .sb-user-email,
  .sb-upgrade { opacity:1; }

  .main { padding:24px 28px 60px; gap:22px; }

  /* 4-column stat grid */
  .stat-grid { grid-template-columns:repeat(4,1fr); gap:14px; }

  /* Addresses table shows more columns */
  .addr-head,
  .addr-row {
    grid-template-columns: 1fr 60px 70px 90px 30px;
  }
  .addr-expires { font-family:var(--MONO); font-size:.66rem; color:var(--MU); }

  /* Side-by-side bottom panels */
  .bottom-cols { display:grid; grid-template-columns:1fr 340px; gap:18px; }
}

@media (min-width: 1200px) {
  .topbar { padding:0 32px; }
  .main   { padding:28px 36px 60px; }
}
</style>
</head>
<body>
<div id="cur"></div>
<div id="toast">
  <svg width="11" height="11" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" d="M5 13l4 4L19 7"/></svg>
  <span id="toast-msg">Copied!</span>
</div>

<!-- TOPBAR -->
<div class="topbar">
  <a class="topbar-logo" href="login.html">DROP<span class="white">IT</span></a>

  <div class="topbar-search">
    <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><path stroke-linecap="round" d="M21 21l-4.35-4.35"/></svg>
    <input type="text" placeholder="Search addresses, messages…"/>
  </div>

  <div class="topbar-right">
    <!-- Notifications -->
    <div style="position:relative;">
      <button class="tb-icon-btn" onclick="toggleDd('notif')" id="notif-btn" aria-label="Notifications">
        <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
        <div class="tb-notif-dot" id="notif-dot"></div>
      </button>
      <div class="dropdown" id="notif-dd" style="width:280px;">
        <div class="dd-header">Notifications <span style="color:var(--Y);">(3)</span></div>
        <div class="notif-item unread"><div class="notif-dot"></div><div><div class="notif-body">New email from <b>Google</b> on ghost.wolf2847@dropit.io</div><div class="notif-time">2 min ago</div></div></div>
        <div class="notif-item unread"><div class="notif-dot"></div><div><div class="notif-body">Address <b>silent.fox9341@dropit.io</b> expires in 2 min</div><div class="notif-time">7 min ago</div></div></div>
        <div class="notif-item unread"><div class="notif-dot"></div><div><div class="notif-body">OTP received from <b>Shopify</b></div><div class="notif-time">12 min ago</div></div></div>
        <div class="notif-footer" onclick="toggleDd('notif')">View all notifications</div>
      </div>
    </div>

    <!-- Settings -->
    <button class="tb-icon-btn" aria-label="Settings">
      <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><circle cx="12" cy="12" r="3"/></svg>
    </button>

    <!-- User -->
    <div style="position:relative;">
      <div class="tb-user" onclick="toggleDd('user')">
        <div class="tb-avatar">J</div>
        <div>
          <div class="tb-user-name">John Doe</div>
          <div class="tb-user-plan">PRO PLAN</div>
        </div>
        <svg width="11" height="11" fill="none" viewBox="0 0 24 24" stroke="#6B7280" stroke-width="2" style="margin-left:4px;flex-shrink:0;"><path stroke-linecap="round" d="M19 9l-7 7-7-7"/></svg>
      </div>
      <div class="dropdown" id="user-dd">
        <div class="dd-item"><svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>Profile</div>
        <div class="dd-item"><svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>Billing</div>
        <div class="dd-item"><svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/></svg>API Keys</div>
        <div class="dd-item danger" onclick="window.location.href='login.html'"><svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>Sign Out</div>
      </div>
    </div>
  </div>
</div>

<!-- SHELL -->
<div class="shell">

  <!-- SIDEBAR -->
  <div class="sidebar" id="sidebar">
    <div class="sb-section"><div class="sb-section-label">Main</div></div>

    <a class="sb-item active" href="#">
      <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/></svg>
      <span class="sb-item-label">Overview</span>
    </a>
    <a class="sb-item" href="#">
      <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
      <span class="sb-item-label">Inbox</span>
      <span class="sb-badge">3</span>
    </a>
    <a class="sb-item" href="#">
      <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/></svg>
      <span class="sb-item-label">Addresses</span>
    </a>
    <a class="sb-item" href="#">
      <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"/></svg>
      <span class="sb-item-label">Domains</span>
    </a>

    <hr class="sb-divider"/>
    <div class="sb-section"><div class="sb-section-label">Account</div></div>

    <a class="sb-item" href="#">
      <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
      <span class="sb-item-label">Analytics</span>
    </a>
    <a class="sb-item" href="#">
      <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/></svg>
      <span class="sb-item-label">API Keys</span>
    </a>
    <a class="sb-item" href="#">
      <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><circle cx="12" cy="12" r="3"/></svg>
      <span class="sb-item-label">Settings</span>
    </a>

    <hr class="sb-divider"/>

    <div class="sb-user-card">
      <div class="sb-user-name">John Doe</div>
      <div class="sb-user-email">johndoe@gmail.com</div>
      <button class="sb-upgrade">
        <svg width="11" height="11" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
        <span>Upgrade Plan</span>
      </button>
    </div>
  </div>

  <!-- MAIN -->
  <div class="main">

    <!-- Title -->
    <div class="page-title-row">
      <div>
        <div class="page-title">Overview <span>Dashboard</span></div>
        <div class="page-sub">// Monday Apr 26, 2026 · Pro Plan Active</div>
      </div>
      <div style="display:flex;gap:8px;flex-wrap:wrap;">
        <button class="btn-sec" onclick="refreshDash()">
          <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" id="ric2"><path stroke-linecap="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
          Refresh
        </button>
        <button class="btn-primary" onclick="generateNew()">
          <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M12 4v16m8-8H4"/></svg>
          New Address
        </button>
      </div>
    </div>

    <!-- Stats -->
    <div class="stat-grid">
      <div class="stat-card">
        <div class="stat-card-accent"></div>
        <div class="stat-label">Total Addresses</div>
        <div class="stat-value">47</div>
        <div class="stat-sub"><span class="stat-up">↑ 12</span> this week</div>
        <div class="stat-icon"><svg width="32" height="32" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1"><path stroke-linecap="round" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/></svg></div>
      </div>
      <div class="stat-card blue">
        <div class="stat-card-accent"></div>
        <div class="stat-label">Emails Received</div>
        <div class="stat-value">238</div>
        <div class="stat-sub"><span class="stat-up">↑ 34</span> this week</div>
        <div class="stat-icon"><svg width="32" height="32" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1"><path stroke-linecap="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg></div>
      </div>
      <div class="stat-card green">
        <div class="stat-card-accent"></div>
        <div class="stat-label">Active Now</div>
        <div class="stat-value">3</div>
        <div class="stat-sub"><div class="live-pill"><div class="live-dot"></div>Live</div></div>
        <div class="stat-icon"><svg width="32" height="32" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1"><circle cx="12" cy="12" r="10"/><path stroke-linecap="round" d="M12 8v4l3 3"/></svg></div>
      </div>
      <div class="stat-card red">
        <div class="stat-card-accent"></div>
        <div class="stat-label">Spam Blocked</div>
        <div class="stat-value">1.2K</div>
        <div class="stat-sub"><span style="color:var(--DANGER);">🛡</span> protected</div>
        <div class="stat-icon"><svg width="32" height="32" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1"><path stroke-linecap="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg></div>
      </div>
    </div>

    <!-- Generator -->
    <div class="gen-card">
      <div class="gen-card-header">
        <span class="gen-card-title">Quick Generate</span>
        <div class="live-pill"><div class="live-dot"></div>ACTIVE</div>
      </div>
      <div class="gen-card-body">
        <div class="dom-pills" id="dom-pills"></div>
        <div class="gen-email-row">
          <div class="gen-email-txt" id="gen-email">--</div>
          <button class="btn-copy" id="copy-btn" onclick="copyEmail()">Copy</button>
          <button class="btn-sec" style="padding:8px 12px;" onclick="generateNew()">
            <svg id="ric" width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
            New
          </button>
        </div>
        <div class="timer-row">
          <span class="timer-lbl">Expires in</span>
          <div class="timer-track"><div class="timer-fill" id="tbar"></div></div>
          <span class="timer-txt" id="tnum">10:00</span>
        </div>
      </div>
    </div>

    <!-- Bottom section: addresses + right panels -->
    <div class="bottom-cols">

      <!-- Addresses table -->
      <div class="panel">
        <div class="panel-header">
          <span class="panel-title">Your Addresses</span>
          <span class="panel-meta">// 47 total · 3 active</span>
        </div>
        <div class="tab-row">
          <div class="tab active" onclick="switchTab(this,'all')">All</div>
          <div class="tab" onclick="switchTab(this,'active')">Active</div>
          <div class="tab" onclick="switchTab(this,'expired')">Expired</div>
        </div>
        <div>
          <div class="addr-head">
            <span>Address</span><span style="text-align:center;">Msgs</span><span>Status</span><span></span>
          </div>
          <div id="addr-rows"></div>
        </div>
      </div>

      <!-- Right column: chart + activity -->
      <div style="display:flex;flex-direction:column;gap:14px;">

        <!-- Chart -->
        <div class="panel">
          <div class="panel-header">
            <span class="panel-title">Emails This Week</span>
            <div class="chart-legend">
              <div class="legend-item"><div class="legend-dot" style="background:var(--Y);"></div>Received</div>
              <div class="legend-item"><div class="legend-dot" style="background:var(--B);"></div>Read</div>
            </div>
          </div>
          <div class="chart-wrap">
            <div class="simple-chart" id="chart"></div>
            <div class="chart-x" id="chart-x"></div>
          </div>
        </div>

        <!-- Activity -->
        <div class="panel" style="flex:1;">
          <div class="panel-header">
            <span class="panel-title">Recent Activity</span>
            <span class="panel-meta">// last 24h</span>
          </div>
          <div class="activity-list" id="activity-list"></div>
        </div>

      </div>
    </div>

  </div><!-- /main -->
</div><!-- /shell -->

<script>
/* cursor */
const cur=document.getElementById('cur');
document.addEventListener('mousemove',e=>{cur.style.left=e.clientX+'px';cur.style.top=e.clientY+'px';});
function bc(on){on?cur.classList.add('big'):cur.classList.remove('big');}

/* toast */
function toast(msg){
  document.getElementById('toast-msg').textContent=msg;
  const t=document.getElementById('toast');t.classList.add('show');
  setTimeout(()=>t.classList.remove('show'),2400);
}

/* dropdowns */
const dds={notif:'notif-dd',user:'user-dd'};
function toggleDd(key){
  Object.entries(dds).forEach(([k,id])=>{
    const el=document.getElementById(id);
    if(k===key){el.classList.toggle('show');}
    else{el.classList.remove('show');}
  });
  if(key==='notif')document.getElementById('notif-dot').style.display='none';
}
document.addEventListener('click',e=>{
  if(!e.target.closest('#notif-btn')&&!e.target.closest('#notif-dd'))document.getElementById('notif-dd').classList.remove('show');
  if(!e.target.closest('.tb-user')&&!e.target.closest('#user-dd'))document.getElementById('user-dd').classList.remove('show');
});

/* generator */
const DOMS=['dropit.io','burnbox.dev','zaptmp.net','voidmail.cc','mailsink.app'];
const ADJ=['silent','ghost','turbo','vapor','swift','lunar','neon','flux','rogue','stealth'];
const NOU=['fox','wolf','tide','bolt','hawk','mint','storm','byte','nova','apex'];
let curDom=DOMS[0],curEmail='',secs=600,timerInt;

function renderDoms(){
  const c=document.getElementById('dom-pills');c.innerHTML='';
  DOMS.forEach((d,i)=>{
    const b=document.createElement('button');
    b.className='dom-pill'+(i===0?' active':'');
    b.textContent='@'+d;
    b.addEventListener('mouseenter',()=>bc(true));
    b.addEventListener('mouseleave',()=>bc(false));
    b.onclick=()=>{document.querySelectorAll('.dom-pill').forEach(x=>x.classList.remove('active'));b.classList.add('active');curDom=d;generateNew();};
    c.appendChild(b);
  });
}

function generateNew(){
  const a=ADJ[Math.floor(Math.random()*ADJ.length)];
  const n=NOU[Math.floor(Math.random()*NOU.length)];
  const num=Math.floor(Math.random()*9000)+1000;
  curEmail=`${a}.${n}${num}@${curDom}`;
  const el=document.getElementById('gen-email');
  el.classList.add('fading');
  setTimeout(()=>{el.textContent=curEmail;el.classList.remove('fading');},240);
  secs=600;
  const bar=document.getElementById('tbar');
  bar.style.animation='none';void bar.offsetWidth;bar.style.animation='shrink 600s linear forwards';
  const ic=document.getElementById('ric');
  ic.style.transition='transform .4s';ic.style.transform='rotate(360deg)';
  setTimeout(()=>{ic.style.transition='none';ic.style.transform='rotate(0)';},420);
}

function copyEmail(){
  if(!curEmail)return;
  navigator.clipboard.writeText(curEmail).catch(()=>{});
  const btn=document.getElementById('copy-btn');
  btn.classList.add('ok');btn.textContent='Done ✓';
  toast('Email copied!');
  setTimeout(()=>{btn.classList.remove('ok');btn.textContent='Copy';},2200);
}

function startTimer(){
  if(timerInt)clearInterval(timerInt);
  timerInt=setInterval(()=>{
    if(secs>0)secs--;
    const m=String(Math.floor(secs/60)).padStart(2,'0');
    const s=String(secs%60).padStart(2,'0');
    document.getElementById('tnum').textContent=`${m}:${s}`;
  },1000);
}

/* addresses */
const ADDRS=[
  {email:'ghost.wolf2847@dropit.io',msgs:7,active:true,col:'#22c55e'},
  {email:'turbo.tide5512@burnbox.dev',msgs:2,active:true,col:'#22c55e'},
  {email:'neon.apex3301@voidmail.cc',msgs:0,active:true,col:'#f59e0b'},
  {email:'silent.fox9341@dropit.io',msgs:14,active:false,col:'#9CA3AF'},
  {email:'vapor.storm1192@zaptmp.net',msgs:3,active:false,col:'#9CA3AF'},
  {email:'lunar.byte4401@mailsink.app',msgs:1,active:false,col:'#9CA3AF'},
];

function renderAddrs(){
  const c=document.getElementById('addr-rows');c.innerHTML='';
  ADDRS.forEach(a=>{
    const row=document.createElement('div');
    row.className='addr-row';
    row.dataset.active=a.active;
    row.innerHTML=`
      <div class="addr-email">${a.email}</div>
      <div class="addr-msgs" style="text-align:center;"><b>${a.msgs}</b></div>
      <div>
        <span class="addr-status" style="color:${a.col};">
          <svg width="5" height="5" style="display:inline;margin-right:3px;vertical-align:middle;" viewBox="0 0 10 10"><circle cx="5" cy="5" r="5" fill="${a.col}"/></svg>
          ${a.active?'active':'expired'}
        </span>
      </div>
      <div class="addr-action">
        <button class="icon-btn" onclick="copyAddr('${a.email}')" title="Copy">
          <svg width="10" height="10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><rect x="9" y="9" width="13" height="13" rx="2"/><path stroke-linecap="round" d="M5 15H4a2 2 0 01-2-2V4a2 2 0 012-2h9a2 2 0 012 2v1"/></svg>
        </button>
        <button class="icon-btn danger" onclick="deleteAddr(this)" title="Delete">
          <svg width="10" height="10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><polyline points="3 6 5 6 21 6"/><path stroke-linecap="round" d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6"/></svg>
        </button>
      </div>`;
    c.appendChild(row);
  });
  attachCursorToNew();
}

function copyAddr(e){navigator.clipboard.writeText(e).catch(()=>{});toast('Address copied!');}
function deleteAddr(btn){const r=btn.closest('.addr-row');r.style.opacity='.3';r.style.transition='opacity .3s';setTimeout(()=>r.remove(),300);toast('Address deleted.');}

function switchTab(el,f){
  document.querySelectorAll('.tab').forEach(t=>t.classList.remove('active'));el.classList.add('active');
  document.querySelectorAll('.addr-row').forEach(r=>{
    const isActive=r.dataset.active==='true';
    r.style.display=(f==='all'||((f==='active')===isActive))?'':'none';
  });
}

/* chart */
const DAYS=['Mon','Tue','Wed','Thu','Fri','Sat','Sun'];
const REC=[18,32,14,45,28,52,39];
const READ=[12,24,10,38,20,44,31];
function renderChart(){
  const c=document.getElementById('chart');const x=document.getElementById('chart-x');
  c.innerHTML='';x.innerHTML='';
  const mx=Math.max(...REC);
  DAYS.forEach((d,i)=>{
    const g=document.createElement('div');g.className='bar-group';
    const b1=document.createElement('div');b1.className='bar';b1.style.height=(REC[i]/mx*100)+'%';b1.style.background='#FACC15';b1.title=`${d}: ${REC[i]} received`;
    const b2=document.createElement('div');b2.className='bar';b2.style.height=(READ[i]/mx*100)+'%';b2.style.background='#2563EB';b2.title=`${d}: ${READ[i]} read`;
    g.appendChild(b1);g.appendChild(b2);c.appendChild(g);
    const l=document.createElement('div');l.className='chart-x-lbl';l.textContent=d;x.appendChild(l);
  });
}

/* activity */
const ACTS=[
  {icon:'y',col:'#EAB308',svg:'<path stroke-linecap="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>',msg:'New email from <b>Google</b> on ghost.wolf2847@dropit.io',time:'2 min ago'},
  {icon:'g',col:'#16a34a',svg:'<path stroke-linecap="round" d="M12 4v16m8-8H4"/>',msg:'Generated new address <b>ghost.wolf2847@dropit.io</b>',time:'5 min ago'},
  {icon:'y',col:'#EAB308',svg:'<path stroke-linecap="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>',msg:'OTP received from <b>Shopify</b> — code: 847291',time:'12 min ago'},
  {icon:'r',col:'#dc2626',svg:'<polyline points="3 6 5 6 21 6"/><path stroke-linecap="round" d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6"/>',msg:'Address <b>silent.fox9341@dropit.io</b> expired',time:'18 min ago'},
  {icon:'b',col:'#2563EB',svg:'<path stroke-linecap="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>',msg:'Verification confirmed from <b>Notion</b>',time:'35 min ago'},
  {icon:'g',col:'#16a34a',svg:'<path stroke-linecap="round" d="M12 4v16m8-8H4"/>',msg:'Generated <b>turbo.tide5512@burnbox.dev</b>',time:'1 hr ago'},
];
function renderActivity(){
  const c=document.getElementById('activity-list');c.innerHTML='';
  ACTS.forEach(a=>{
    const item=document.createElement('div');item.className='activity-item';
    item.innerHTML=`<div class="act-icon ${a.icon}"><svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="${a.col}" stroke-width="2">${a.svg}</svg></div><div class="act-body"><div class="act-msg">${a.msg}</div><div class="act-time">${a.time}</div></div>`;
    c.appendChild(item);
  });
}

function refreshDash(){
  toast('Dashboard refreshed!');
  const ic=document.getElementById('ric2');
  ic.style.transition='transform .5s';ic.style.transform='rotate(360deg)';
  setTimeout(()=>{ic.style.transition='none';ic.style.transform='rotate(0)';},520);
}

function attachCursorToNew(){
  document.querySelectorAll('.addr-row, .activity-item, .tab, .dom-pill, .icon-btn, .tb-icon-btn, .dd-item, .notif-item, .sb-item, .stat-card, .btn-primary, .btn-sec, .btn-copy').forEach(el=>{
    el.addEventListener('mouseenter',()=>bc(true));
    el.addEventListener('mouseleave',()=>bc(false));
  });
}

/* init */
renderDoms();
generateNew();
startTimer();
renderAddrs();
renderChart();
renderActivity();
attachCursorToNew();
</script>
</body>
</html>