<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>@yield('title', 'InboxOro — Dashboard')</title>
<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Outfit:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;500;700&display=swap" rel="stylesheet"/>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
<style>
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
  --SB-W:    240px;
  --SB-MINI: 60px;
}
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
.topbar {
  height:          56px;
  min-height:      56px;
  background:      var(--INK);
  border-bottom:   1px solid rgba(255,255,255,.08);
  display:         flex;
  align-items:     center;
  padding:         0 16px;
  gap:             12px;
  z-index:         200;
  flex-shrink:     0;
}
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
.topbar-search {
  flex:          1;
  max-width:     400px;
  display:       flex;
  align-items:   center;
  gap:           8px;
  background:    rgba(255,255,255,.04);
  border:        1px solid rgba(255,255,255,.07);
  border-radius: 20px;
  padding:       0 14px;
  height:        34px;
  cursor:        text;
  transition:    background .2s, border-color .2s, box-shadow .2s;
}
.topbar-search:hover {
  background:    rgba(255,255,255,.07);
  border-color:  rgba(255,255,255,.15);
}
.topbar-search:focus-within,
.topbar-search:active {
  background:    rgba(255,255,255,.08);
  border-color:  rgba(255,255,255,.2);
  box-shadow:    0 0 0 3px rgba(250,204,21,.08);
}
.topbar-search svg {
  color:       #6B7280;
  flex-shrink: 0;
}
.topbar-search input {
  flex:        1;
  border:      none;
  outline:     none;
  background:  transparent;
  font-family: var(--BODY);
  font-size:   .84rem;
  color:       #fff;
  cursor:      text;
}
.topbar-search input::placeholder { color: #5B6370; font-size: .8rem; }
.topbar-search .search-kbd {
  font-family: var(--MONO); font-size: .55rem; color: #5B6370;
  background: rgba(255,255,255,.06); border: 1px solid rgba(255,255,255,.08);
  padding: 2px 6px; border-radius: 4px; white-space: nowrap; flex-shrink: 0;
}
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
.tb-lang-btn {
  width: auto; gap: 5px; padding: 0 10px;
}
.tb-lang-btn:hover { color: var(--MU2); }
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
.user-dd {
  display:    none;
  position:   absolute;
  top:        calc(100% + 8px);
  right:      -8px;
  width:      230px;
  background: var(--SURF);
  border:     1px solid var(--BD);
  border-radius: 12px;
  box-shadow: 0 12px 32px rgba(0,0,0,.12);
  z-index:    300;
  overflow:   hidden;
}
.user-dd.open { display: block; animation: dd-in .15s ease both; }
@keyframes dd-in { from{opacity:0;transform:translateY(-6px)} to{opacity:1;transform:translateY(0)} }
.dd-profile {
  display: flex; align-items: center; gap: 10px;
  padding: 16px 16px 14px; border-bottom: 1px solid var(--BD2);
}
.dd-profile-av {
  width: 38px; height: 38px; min-width: 38px;
  background: var(--Y); border-radius: 10px;
  display: flex; align-items: center; justify-content: center;
  font-family: var(--DISP); font-size: 1.05rem; font-weight: 700; color: var(--INK);
}
.dd-profile-info { min-width: 0; }
.dd-profile-name { font-weight: 700; font-size: .86rem; color: var(--INK); }
.dd-profile-email { font-size: .72rem; color: var(--MU); font-family: var(--MONO); margin-top: 1px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
.dd-profile-plan {
  display: inline-flex; align-items: center; gap: 4px;
  margin-top: 4px; font-size: .58rem; font-weight: 700; font-family: var(--MONO);
  letter-spacing: .06em; text-transform: uppercase;
  color: var(--Y); background: rgba(250,204,21,.1);
  padding: 2px 8px; border-radius: 4px;
}
.dd-section { padding: 6px 0; }
.dd-section:not(:last-child) { border-bottom: 1px solid var(--BD2); }
.dd-item {
  display:     flex;
  align-items: center;
  gap:         9px;
  padding:     8px 16px;
  font-size:   .82rem;
  color:       var(--INK);
  transition:  background .12s;
  cursor:      pointer;
}
.dd-item:hover { background: var(--BD2); }
.dd-item svg   { color: var(--MU); flex-shrink: 0; }
.dd-item .dd-badge {
  margin-left: auto; font-size: .6rem; font-weight: 700; font-family: var(--MONO);
  background: var(--BD2); padding: 1px 7px; border-radius: 10px; color: var(--MU);
}
.dd-item.danger { color: var(--RED); }
.dd-item.danger svg { color: var(--RED); }
.shell {
  flex:     1;
  display:  flex;
  overflow: hidden;
  position: relative;
}
.sidebar {
  width:          var(--SB-W);
  min-width:      var(--SB-W);
  background:     var(--INK);
  border-right:   1px solid rgba(255,255,255,.07);
  display:        flex;
  flex-direction: column;
  overflow:       hidden;
  transition:     width .25s cubic-bezier(.4,0,.2,1), min-width .25s cubic-bezier(.4,0,.2,1), transform .25s cubic-bezier(.4,0,.2,1);
  flex-shrink:    0;
  z-index:        150;
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
.sb-backdrop {
  display:    none;
  position:   fixed;
  inset:      0;
  background: rgba(0,0,0,.5);
  z-index:    140;
}
.sb-backdrop.show { display: block; }
.sidebar.collapsed {
  width:     var(--SB-MINI);
  min-width: var(--SB-MINI);
}
.sb-collapse-btn {
  width:      36px;
  height:     36px;
  min-width:  36px;
  display:    none;
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
.sb-body {
  flex:       1;
  overflow-y: auto;
  overflow-x: hidden;
  padding:    8px 0 12px;
}
.sb-body::-webkit-scrollbar       { width: 3px; }
.sb-body::-webkit-scrollbar-thumb { background: rgba(255,255,255,.1); border-radius: 2px; }
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
.sb-divider { height: 1px; background: rgba(255,255,255,.07); margin: 8px 16px; }
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
.main {
  flex:        1;
  overflow-y:  auto;
  overflow-x:  hidden;
  padding:     24px 16px 48px;
  min-width:   0;
  transition:  margin-left .25s cubic-bezier(.4,0,.2,1);
}
.main::-webkit-scrollbar { width: 4px; }
.main::-webkit-scrollbar-thumb { background: var(--BD); border-radius: 2px; }
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
.timer-row { display: flex; align-items: center; gap: 10px; }
.timer-lbl { font-size: .72rem; color: var(--MU); white-space: nowrap; }
.timer-track { flex: 1; height: 4px; background: var(--BD); border-radius: 2px; overflow: hidden; }
.timer-fill  { height: 100%; background: var(--Y); border-radius: 2px; width: 100%; animation: shrink 600s linear forwards; }
@keyframes shrink { to { width: 0%; } }
.timer-count { font-family: var(--MONO); font-size: .7rem; font-weight: 700; color: var(--INK); white-space: nowrap; }
.bottom-grid {
  display:               grid;
  grid-template-columns: 1fr;
  gap:                   16px;
}
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
  display:      none;
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
@media (min-width: 480px) {
  .addr-msgs { display: block; }
}
@media (min-width: 640px) {
  .main { padding: 28px 24px 56px; }
  .stat-grid { grid-template-columns: repeat(2, 1fr); gap: 14px; }
}
@media (min-width: 900px) {
  .sidebar {
    position:  relative;
    top:       auto;
    left:      auto;
    bottom:    auto;
    transform: none !important;
    box-shadow: none !important;
  }
  .sb-collapse-btn { display: flex; }
  .main { padding: 28px 28px 60px; }
  .stat-grid { grid-template-columns: repeat(4, 1fr); }
  .bottom-grid { grid-template-columns: 1fr 320px; }
}
@media (min-width: 1100px) {
  .main { padding: 32px 36px 64px; }
}

/* ════════════════════════════════════════════════
   UPGRADE MODAL (4-step subscription flow)
════════════════════════════════════════════════ */
.upgrade-overlay {
  position: fixed; inset: 0; z-index: 600;
  background: rgba(0,0,0,.55); backdrop-filter: blur(4px);
  display: none; align-items: center; justify-content: center; padding: 16px;
}
.upgrade-overlay.open { display: flex; animation: fade-bg .18s ease both; }
.upgrade-modal {
  background: var(--SURF); border-radius: 16px; border: 1px solid var(--BD);
  width: 100%; max-width: 580px;
  box-shadow: 0 24px 64px rgba(0,0,0,.2);
  overflow: hidden;
  animation: modal-up .25s cubic-bezier(.34,1.56,.64,1) both;
  display: flex; flex-direction: column;
  max-height: 90vh;
}
.up-progress {
  display: flex; align-items: center; gap: 0;
  padding: 18px 26px 0; position: relative;
}
.up-progress-step {
  display: flex; align-items: center; gap: 8px;
  flex: 1; position: relative;
}
.up-progress-step:last-child { flex: 0; }
.up-progress-dot {
  width: 28px; height: 28px; min-width: 28px;
  border-radius: 50%;
  display: flex; align-items: center; justify-content: center;
  font-family: var(--MONO); font-size: .65rem; font-weight: 700;
  border: 2px solid var(--BD); color: var(--MU2);
  background: var(--SURF); transition: all .25s;
  position: relative; z-index: 2;
}
.up-progress-step.active .up-progress-dot { background: var(--Y); border-color: var(--Y); color: var(--INK); }
.up-progress-step.done .up-progress-dot { background: var(--GREEN); border-color: var(--GREEN); color: #fff; }
.up-progress-label {
  font-family: var(--MONO); font-size: .6rem; font-weight: 600;
  color: var(--MU2); white-space: nowrap; transition: color .25s;
}
.up-progress-step.active .up-progress-label { color: var(--INK); }
.up-progress-step.done .up-progress-label { color: var(--GREEN); }
.up-progress-line {
  flex: 1; height: 2px; background: var(--BD);
  margin: 0 8px; position: relative; z-index: 1;
}
.up-progress-step.done + .up-progress-step .up-progress-line,
.up-progress-step.active + .up-progress-step .up-progress-line { background: var(--GREEN); }
.up-step { display: none; }
.up-step.active { display: flex; flex-direction: column; }
.up-body { overflow-y: auto; padding: 20px 26px; }
.up-dark-hd {
  background: var(--INK); padding: 24px 26px;
  position: relative; overflow: hidden;
}
.up-dark-hd::before {
  content: ''; position: absolute; top: 0; left: 0; right: 0; height: 2px;
  background: linear-gradient(90deg, #7C3AED, var(--Y), #7C3AED);
  background-size: 200% 100%; animation: up-shimmer 3s linear infinite;
}
@keyframes up-shimmer { 0%{background-position:200% 0} 100%{background-position:-200% 0} }
.up-dark-blob {
  position: absolute; border-radius: 50%; pointer-events: none;
}
.up-dark-blob-1 { width:260px; height:260px; background:radial-gradient(circle,rgba(250,204,21,.12) 0,transparent 70%); top:-100px; right:-60px; }
.up-dark-blob-2 { width:180px; height:180px; background:radial-gradient(circle,rgba(124,58,237,.1) 0,transparent 70%); bottom:-70px; left:-40px; }
.up-dark-content { position: relative; z-index: 1; }
.up-pills { display: flex; gap: 10px; margin-top: 14px; flex-wrap: wrap; }
.up-pill {
  display: flex; align-items: center; gap: 8px;
  padding: 10px 14px; border-radius: 10px; cursor: pointer;
  border: 1.5px solid rgba(255,255,255,.1);
  background: rgba(255,255,255,.05); transition: all .15s;
  flex: 1; min-width: 130px; position: relative; overflow: hidden;
}
.up-pill:hover { border-color: rgba(250,204,21,.2); background: rgba(250,204,21,.07); }
.up-pill.selected { border-color: rgba(250,204,21,.3); background: rgba(250,204,21,.1); }
.up-pill-save {
  position: absolute; top: 6px; right: 6px;
  font-family: var(--MONO); font-size: .5rem; font-weight: 800;
  background: var(--GREEN); color: #fff; padding: 2px 6px; border-radius: 4px;
}
.up-pill-price { font-family: var(--DISP); font-size: 1.4rem; line-height: 1; }
.up-pill-price.mo { color: var(--Y); }
.up-pill-price.yr { color: #fff; }
.up-pill-sub { font-size: .7rem; color: rgba(255,255,255,.5); margin-top: 2px; }
.up-pill-sub b { color: rgba(255,255,255,.7); }
.up-pill-check {
  margin-left: auto; width: 20px; height: 20px; min-width: 20px;
  border-radius: 50%; display: flex; align-items: center; justify-content: center;
}
.up-pill .up-pill-check { border: 2px solid rgba(255,255,255,.2); }
.up-pill.selected .up-pill-check { background: var(--Y); border-color: var(--Y); }
.up-features {
  display: grid; grid-template-columns: 1fr 1fr; gap: 10px; margin-top: 18px;
}
.up-feature {
  display: flex; align-items: flex-start; gap: 8px;
  font-size: .78rem; color: var(--INK); line-height: 1.4;
}
.up-feature-icon {
  width: 18px; height: 18px; min-width: 18px; margin-top: 1px;
  border-radius: 50%; display: flex; align-items: center; justify-content: center;
  background: rgba(16,185,129,.1); color: var(--GREEN); flex-shrink: 0;
}
.up-compare { margin-top: 18px; background: var(--BG); border: 1px solid var(--BD); border-radius: 10px; overflow: hidden; }
.up-compare-hd { display: grid; grid-template-columns: 1fr 70px 70px; border-bottom: 1px solid var(--BD); }
.up-compare-hd > div { padding: 8px 12px; font-family: var(--MONO); font-size: .58rem; font-weight: 700; letter-spacing: .08em; text-transform: uppercase; color: var(--MU2); text-align: center; }
.up-compare-hd > div:first-child { text-align: left; }
.up-compare-row { display: grid; grid-template-columns: 1fr 70px 70px; border-bottom: 1px solid var(--BD2); }
.up-compare-row:last-child { border-bottom: none; }
.up-compare-row > div { padding: 7px 12px; font-size: .74rem; color: var(--INK); text-align: center; }
.up-compare-row > div:first-child { text-align: left; color: var(--MU); }
.up-compare-check { color: var(--GREEN); }
.up-compare-dash { color: var(--BD); }
.up-plan-badge {
  display: inline-flex; align-items: center; gap: 5px;
  font-family: var(--MONO); font-size: .58rem; font-weight: 700;
  letter-spacing: .12em; text-transform: uppercase;
  color: var(--Y); background: rgba(250,204,21,.1);
  border: 1px solid rgba(250,204,21,.2);
  padding: 3px 10px; border-radius: 20px; margin-bottom: 10px;
}
.up-plan-badge::before {
  content: ''; width: 5px; height: 5px;
  background: var(--Y); border-radius: 50%;
  animation: up-blink 1.2s step-end infinite; display: inline-block;
}
@keyframes up-blink { 0%,100%{opacity:1} 50%{opacity:0} }
.up-summary { display: flex; flex-direction: column; gap: 10px; }
.up-summary-row { display: flex; align-items: center; justify-content: space-between; padding: 6px 0; }
.up-summary-lbl { font-size: .8rem; color: var(--MU); }
.up-summary-val { font-family: var(--MONO); font-size: .82rem; font-weight: 600; color: var(--INK); }
.up-summary-total { border-top: 1px solid var(--BD); margin-top: 4px; padding-top: 12px; }
.up-summary-total .up-summary-lbl { font-weight: 700; color: var(--INK); }
.up-summary-total .up-summary-val { font-family: var(--DISP); font-size: 1.3rem; color: var(--INK); letter-spacing: .03em; }
.up-coupon { display: flex; gap: 8px; margin: 14px 0; }
.up-coupon input {
  flex: 1; padding: 9px 14px; border: 1px solid var(--BD);
  border-radius: 8px; font-family: var(--BODY); font-size: .82rem;
  color: var(--INK); background: var(--SURF); outline: none;
  transition: border-color .15s, box-shadow .15s;
}
.up-coupon input:focus { border-color: var(--Y); box-shadow: 0 0 0 3px rgba(250,204,21,.15); }
.up-coupon input::placeholder { color: var(--MU2); }
.up-coupon-msg { font-size: .72rem; font-weight: 600; margin-top: 4px; }
.up-coupon-msg.ok { color: var(--GREEN); }
.up-coupon-msg.err { color: var(--RED); }
.up-pay-tabs { display: flex; gap: 6px; margin-bottom: 18px; border-bottom: 1px solid var(--BD2); padding-bottom: 0; }
.up-pay-tab {
  display: flex; align-items: center; gap: 6px;
  padding: 10px 14px; font-family: var(--MONO); font-size: .62rem;
  font-weight: 700; letter-spacing: .06em; text-transform: uppercase;
  color: var(--MU); border-bottom: 2px solid transparent;
  margin-bottom: -1px; cursor: pointer; white-space: nowrap;
  transition: color .15s, border-color .15s;
}
.up-pay-tab:hover { color: var(--INK); }
.up-pay-tab.active { color: var(--INK); border-bottom-color: var(--Y); }
.up-pay-content { display: none; }
.up-pay-content.active { display: block; }
.up-upi-row { display: flex; gap: 8px; }
.up-upi-row input {
  flex: 1; padding: 11px 14px; border: 1px solid var(--BD);
  border-radius: 8px; font-family: var(--BODY); font-size: .88rem;
  color: var(--INK); background: var(--BG); outline: none;
  transition: border-color .15s, box-shadow .15s;
}
.up-upi-row input:focus { border-color: var(--Y); box-shadow: 0 0 0 3px rgba(250,204,21,.15); }
.up-upi-row input::placeholder { color: var(--MU2); }
.up-card-row { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; }
.up-card-row input {
  padding: 11px 14px; border: 1px solid var(--BD); border-radius: 8px;
  font-family: var(--BODY); font-size: .88rem; color: var(--INK);
  background: var(--BG); outline: none; width: 100%;
  transition: border-color .15s, box-shadow .15s;
}
.up-card-row input:focus { border-color: var(--Y); box-shadow: 0 0 0 3px rgba(250,204,21,.15); }
.up-card-row input::placeholder { color: var(--MU2); }
.up-bank-list { display: flex; flex-direction: column; gap: 6px; }
.up-bank-item {
  display: flex; align-items: center; gap: 10px;
  padding: 10px 14px; border: 1px solid var(--BD); border-radius: 8px;
  cursor: pointer; transition: all .12s;
}
.up-bank-item:hover { background: var(--BD2); border-color: #D1D5DB; }
.up-bank-item.selected { border-color: var(--Y); background: rgba(250,204,21,.06); }
.up-wallet-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 8px; }
.up-wallet-item {
  display: flex; align-items: center; gap: 8px;
  padding: 12px; border: 1px solid var(--BD); border-radius: 8px;
  cursor: pointer; transition: all .12s;
}
.up-wallet-item:hover { background: var(--BD2); border-color: #D1D5DB; }
.up-wallet-item.selected { border-color: var(--Y); background: rgba(250,204,21,.06); }
.up-secure {
  display: flex; align-items: center; justify-content: center;
  gap: 16px; flex-wrap: wrap; margin-top: 14px;
}
.up-secure span {
  display: flex; align-items: center; gap: 4px;
  font-size: .7rem; color: var(--MU2);
}
.up-success {
  display: flex; flex-direction: column; align-items: center;
  padding: 40px 26px; text-align: center;
}
.up-success-check {
  width: 64px; height: 64px; border-radius: 50%;
  background: rgba(16,185,129,.1); display: flex; align-items: center;
  justify-content: center; margin-bottom: 20px;
  animation: up-success-pop .4s cubic-bezier(.34,1.56,.64,1);
}
@keyframes up-success-pop { 0%{transform:scale(0)} 60%{transform:scale(1.15)} 100%{transform:scale(1)} }
.up-success-title { font-family: var(--DISP); font-size: 1.8rem; letter-spacing: .04em; color: var(--INK); margin-bottom: 6px; }
.up-success-sub { font-size: .84rem; color: var(--MU); margin-bottom: 24px; }
.up-success-details {
  background: var(--BG); border: 1px solid var(--BD);
  border-radius: 10px; padding: 16px 20px; width: 100%;
  max-width: 380px; text-align: left;
}
.up-success-row { display: flex; justify-content: space-between; padding: 6px 0; font-size: .78rem; }
.up-success-row .lbl { color: var(--MU); }
.up-success-row .val { font-weight: 600; color: var(--INK); font-family: var(--MONO); font-size: .72rem; }
.up-footer {
  padding: 14px 26px; border-top: 1px solid var(--BD2);
  display: flex; gap: 8px; justify-content: space-between; align-items: center;
}
.up-footer-left { display: flex; gap: 8px; }
.up-footer-right { display: flex; gap: 8px; }

/* ═══ LANGUAGE DROPDOWN ═══ */
.lang-dd {
  display: none; position: absolute; top: calc(100% + 8px); right: 0;
  width: 170px; background: var(--SURF); border: 1px solid var(--BD);
  border-radius: 10px; box-shadow: 0 8px 24px rgba(0,0,0,.1);
  z-index: 300; overflow: hidden;
}
.lang-dd.open { display: block; animation: dd-in .15s ease both; }
.lang-item {
  display: flex; align-items: center; gap: 8px;
  padding: 9px 14px; font-size: .82rem; color: var(--INK);
  cursor: pointer; transition: background .12s;
}
.lang-item:hover { background: var(--BD2); }
.lang-item .lang-flag { font-size: 1.05rem; line-height: 1; }
.lang-item .lang-check {
  margin-left: auto; width: 16px; height: 16px; border-radius: 50%;
  display: flex; align-items: center; justify-content: center;
  opacity: 0; transition: opacity .12s;
}
.lang-item.selected .lang-check { opacity: 1; }

/* ═══ NOTIFICATION DROPDOWN ═══ */
.notif-dd {
  display: none; position: absolute; top: calc(100% + 8px); right: 0;
  width: 320px; background: var(--SURF); border: 1px solid var(--BD);
  border-radius: 10px; box-shadow: 0 8px 24px rgba(0,0,0,.1);
  z-index: 300; overflow: hidden;
}
.notif-dd.open { display: block; animation: dd-in .15s ease both; }
.notif-hd {
  display: flex; align-items: center; justify-content: space-between;
  padding: 12px 16px; border-bottom: 1px solid var(--BD2);
  font-family: var(--MONO); font-size: .62rem; font-weight: 700;
  letter-spacing: .08em; text-transform: uppercase; color: var(--MU);
}
.notif-hd span { color: var(--INK); font-family: var(--BODY); font-size: .8rem; letter-spacing: 0; text-transform: none; font-weight: 700; }
.notif-list { max-height: 320px; overflow-y: auto; }
.notif-item {
  display: flex; gap: 10px; padding: 12px 16px;
  border-bottom: 1px solid var(--BD2); cursor: pointer;
  transition: background .12s; position: relative;
}
.notif-item:hover { background: var(--BD2); }
.notif-item.unread { background: rgba(250,204,21,.04); }
.notif-item:last-child { border-bottom: none; }
.notif-dot {
  width: 7px; height: 7px; min-width: 7px; margin-top: 5px;
  border-radius: 50%; background: var(--Y);
  opacity: 0; transition: opacity .12s;
}
.notif-item.unread .notif-dot { opacity: 1; }
.notif-icon {
  width: 32px; height: 32px; min-width: 32px; border-radius: 8px;
  display: flex; align-items: center; justify-content: center;
  background: var(--BD2); color: var(--MU);
}
.notif-item.unread .notif-icon { background: rgba(250,204,21,.12); color: var(--Y); }
.notif-content { flex: 1; min-width: 0; }
.notif-title { font-size: .8rem; font-weight: 600; color: var(--INK); }
.notif-item.unread .notif-title { color: var(--INK); }
.notif-desc { font-size: .72rem; color: var(--MU); margin-top: 1px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
.notif-time { font-size: .65rem; color: var(--MU2); margin-top: 4px; font-family: var(--MONO); }
.notif-footer {
  padding: 10px 16px; border-top: 1px solid var(--BD2);
  text-align: center; font-size: .75rem; font-weight: 600;
  color: var(--Y); cursor: pointer; transition: background .12s;
}
.notif-footer:hover { background: var(--BD2); }

/* ═══ SEARCH OVERLAY ═══ */
.search-overlay {
  position: fixed; inset: 0; z-index: 500;
  display: none; align-items: flex-start; justify-content: center;
  padding: 80px 16px;
}
.search-overlay.open { display: flex; }
.search-overlay-bg {
  position: absolute; inset: 0; background: rgba(0,0,0,.45);
  backdrop-filter: blur(4px);
}
.search-overlay-box {
  position: relative; width: 100%; max-width: 560px;
  background: var(--SURF); border: 1px solid var(--BD);
  border-radius: 14px; box-shadow: 0 16px 48px rgba(0,0,0,.25);
  overflow: hidden; animation: modal-up .2s cubic-bezier(.34,1.56,.64,1) both;
}
.search-overlay-input {
  display: flex; align-items: center; gap: 10px;
  padding: 14px 18px; border-bottom: 1px solid var(--BD2);
}
.search-overlay-input svg { color: var(--MU2); flex-shrink: 0; }
.search-overlay-input input {
  flex: 1; border: none; outline: none; background: transparent;
  font-family: var(--BODY); font-size: .95rem; color: var(--INK);
}
.search-overlay-input input::placeholder { color: var(--MU2); }
.search-overlay-input .search-esc {
  padding: 3px 8px; border: 1px solid var(--BD); border-radius: 5px;
  font-family: var(--MONO); font-size: .6rem; color: var(--MU2);
  background: var(--BD2); cursor: pointer;
}
.search-overlay-body { padding: 14px 18px; max-height: 360px; overflow-y: auto; }
.search-section { margin-bottom: 16px; }
.search-section:last-child { margin-bottom: 0; }
.search-section-label {
  font-family: var(--MONO); font-size: .6rem; font-weight: 700;
  letter-spacing: .08em; text-transform: uppercase; color: var(--MU);
  margin-bottom: 8px;
}
.search-chips { display: flex; flex-wrap: wrap; gap: 6px; }
.search-chip {
  display: inline-flex; align-items: center; gap: 5px;
  padding: 5px 11px; border-radius: 6px; border: 1px solid var(--BD);
  font-size: .78rem; color: var(--INK); cursor: pointer;
  transition: all .12s; background: var(--BG);
}
.search-chip:hover { border-color: var(--Y); background: rgba(250,204,21,.06); }
.search-chip svg { color: var(--MU2); }
.search-links { display: flex; flex-direction: column; gap: 4px; }
.search-link {
  display: flex; align-items: center; gap: 8px;
  padding: 7px 10px; border-radius: 6px; font-size: .8rem;
  color: var(--INK); cursor: pointer; transition: background .12s;
}
.search-link:hover { background: var(--BD2); }
.search-link svg { color: var(--MU); }
</style>
@stack('styles')
</head>
<body>

<div id="toast"><div class="toast-dot"></div><span id="toast-msg">Copied!</span></div>

<!-- ═══ UPGRADE MODAL ═══ -->
<div class="upgrade-overlay" id="up-modal">
<div class="upgrade-modal">
  <div class="up-progress">
    <div class="up-progress-step active" id="up-ps-1">
      <div class="up-progress-dot">1</div>
      <span class="up-progress-label">Plan</span>
    </div>
    <div class="up-progress-line"></div>
    <div class="up-progress-step" id="up-ps-2">
      <div class="up-progress-dot">2</div>
      <span class="up-progress-label">Checkout</span>
    </div>
    <div class="up-progress-line"></div>
    <div class="up-progress-step" id="up-ps-3">
      <div class="up-progress-dot">3</div>
      <span class="up-progress-label">Payment</span>
    </div>
    <div class="up-progress-line"></div>
    <div class="up-progress-step" id="up-ps-4">
      <div class="up-progress-dot">4</div>
      <span class="up-progress-label">Done</span>
    </div>
  </div>
  <!-- Step 1: Plan Selection -->
  <div class="up-step active" id="up-step-1">
    <div class="up-dark-hd">
      <div class="up-dark-blob up-dark-blob-1"></div>
      <div class="up-dark-blob up-dark-blob-2"></div>
      <div class="up-dark-content">
        <div class="up-plan-badge">Current: Free</div>
        <h2 style="font-family:var(--DISP);font-size:1.6rem;font-weight:700;letter-spacing:.04em;color:#fff;margin:0 0 2px">Upgrade Your Plan</h2>
        <p style="font-size:.82rem;color:rgba(255,255,255,.55);margin:0">Unlock premium features for your business</p>
      </div>
    </div>
    <div class="up-body">
      <div style="display:flex;align-items:center;gap:10px;margin-bottom:14px">
        <span style="font-family:var(--MONO);font-size:.6rem;font-weight:700;letter-spacing:.08em;text-transform:uppercase;color:var(--MU)">Billing</span>
        <div style="display:flex;background:var(--BD2);border-radius:8px;padding:2px;gap:2px" id="up-billing">
          <button class="up-bill-btn active" data-cycle="monthly" style="padding:6px 16px;border:none;border-radius:6px;font-family:var(--MONO);font-size:.62rem;font-weight:700;cursor:pointer;transition:all .15s;background:#fff;color:var(--INK);box-shadow:0 1px 3px rgba(0,0,0,.06)">Monthly</button>
          <button class="up-bill-btn" data-cycle="annual" style="padding:6px 16px;border:none;border-radius:6px;font-family:var(--MONO);font-size:.62rem;font-weight:700;cursor:pointer;transition:all .15s;background:transparent;color:var(--MU)">Annual</button>
        </div>
        <span class="up-pill-save" style="position:static;font-size:.58rem">Save 25%</span>
      </div>
      <div class="up-pills">
        <div class="up-pill selected" data-plan="free">
          <div>
            <div style="font-family:var(--MONO);font-size:.58rem;font-weight:700;letter-spacing:.08em;text-transform:uppercase;color:rgba(255,255,255,.5)">Free</div>
            <div style="display:flex;align-items:baseline;gap:4px;margin-top:2px">
              <span class="up-pill-price mo" style="color:rgba(255,255,255,.5)">$0</span>
              <span style="font-size:.7rem;color:rgba(255,255,255,.35)">/mo</span>
            </div>
            <div class="up-pill-sub">100 emails / mo</div>
          </div>
          <div class="up-pill-check" style="background:var(--GREEN);border-color:var(--GREEN)">
            <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="3"><path d="M5 13l4 4L19 7"/></svg>
          </div>
        </div>
        <div class="up-pill" data-plan="pro">
          <div>
            <div style="font-family:var(--MONO);font-size:.58rem;font-weight:700;letter-spacing:.08em;text-transform:uppercase;color:var(--Y)">Pro</div>
            <div style="display:flex;align-items:baseline;gap:4px;margin-top:2px">
              <span class="up-pill-price mo" id="up-pro-price">$4</span>
              <span style="font-size:.7rem;color:rgba(255,255,255,.5)"><span id="up-pro-period">/mo</span></span>
            </div>
            <div class="up-pill-sub"><span id="up-pro-emails">10,000</span> emails / mo</div>
          </div>
          <div class="up-pill-check">
            <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="3"><path d="M5 13l4 4L19 7"/></svg>
          </div>
        </div>
      </div>
      <div class="up-features">
        <div class="up-feature"><div class="up-feature-icon"><svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><path d="M5 13l4 4L19 7"/></svg></div>Unlimited addresses</div>
        <div class="up-feature"><div class="up-feature-icon"><svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><path d="M5 13l4 4L19 7"/></svg></div>Custom SMTP relays</div>
        <div class="up-feature"><div class="up-feature-icon"><svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><path d="M5 13l4 4L19 7"/></svg></div>API keys management</div>
        <div class="up-feature"><div class="up-feature-icon"><svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><path d="M5 13l4 4L19 7"/></svg></div>Domain tracking</div>
        <div class="up-feature"><div class="up-feature-icon"><svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><path d="M5 13l4 4L19 7"/></svg></div>Priority support</div>
        <div class="up-feature"><div class="up-feature-icon"><svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><path d="M5 13l4 4L19 7"/></svg></div>Analytics & reports</div>
      </div>
      <div class="up-compare">
        <div class="up-compare-hd"><div>Feature</div><div>Free</div><div>Pro</div></div>
        <div class="up-compare-row"><div>Email aliases</div><div class="up-compare-check">&#10003;</div><div class="up-compare-check">&#10003;</div></div>
        <div class="up-compare-row"><div>Custom domains</div><div class="up-compare-dash">&mdash;</div><div class="up-compare-check">&#10003;</div></div>
        <div class="up-compare-row"><div>Catch-all</div><div class="up-compare-dash">&mdash;</div><div class="up-compare-check">&#10003;</div></div>
        <div class="up-compare-row"><div>SMTP relay</div><div class="up-compare-dash">&mdash;</div><div class="up-compare-check">&#10003;</div></div>
        <div class="up-compare-row"><div>API access</div><div class="up-compare-dash">&mdash;</div><div class="up-compare-check">&#10003;</div></div>
        <div class="up-compare-row"><div>Priority support</div><div class="up-compare-dash">&mdash;</div><div class="up-compare-check">&#10003;</div></div>
      </div>
    </div>
    <div class="up-footer">
      <div class="up-footer-left"><button class="btn-ghost" onclick="closeUpgradeModal()">Cancel</button></div>
      <div class="up-footer-right"><button class="btn-primary yellow" onclick="nextUpgradeStep()">Continue to Checkout</button></div>
    </div>
  </div>
  <!-- Step 2: Checkout -->
  <div class="up-step" id="up-step-2">
    <div class="up-dark-hd">
      <div class="up-dark-blob up-dark-blob-1"></div>
      <div class="up-dark-blob up-dark-blob-2"></div>
      <div class="up-dark-content">
        <div class="up-plan-badge">Selected Plan</div>
        <h2 style="font-family:var(--DISP);font-size:1.6rem;font-weight:700;letter-spacing:.04em;color:#fff;margin:0 0 2px" id="up-checkout-plan">Pro <span id="up-checkout-cycle">Monthly</span></h2>
        <p style="font-size:.82rem;color:rgba(255,255,255,.55);margin:0">Review your order before payment</p>
      </div>
    </div>
    <div class="up-body">
      <div class="up-summary">
        <div class="up-summary-row"><span class="up-summary-lbl">Plan</span><span class="up-summary-val" id="up-summary-plan">Pro Monthly</span></div>
        <div class="up-summary-row"><span class="up-summary-lbl">Subtotal</span><span class="up-summary-val" id="up-summary-subtotal">$4.00</span></div>
        <div class="up-summary-row" id="up-discount-row" style="display:none"><span class="up-summary-lbl">Discount</span><span class="up-summary-val" style="color:var(--GREEN)" id="up-summary-discount">&minus;$0.00</span></div>
        <div class="up-summary-row up-summary-total"><span class="up-summary-lbl">Total</span><span class="up-summary-val" id="up-summary-total">$4.00</span></div>
      </div>
      <div style="margin-top:16px">
        <label style="font-family:var(--MONO);font-size:.6rem;font-weight:700;letter-spacing:.08em;text-transform:uppercase;color:var(--MU);display:block;margin-bottom:4px">Coupon Code</label>
        <div class="up-coupon">
          <input type="text" id="up-coupon-input" placeholder="Enter coupon code" onkeydown="if(event.key==='Enter')applyUpgradeCoupon()"/>
          <button class="btn-primary yellow" onclick="applyUpgradeCoupon()" style="padding:9px 18px;font-size:.75rem;white-space:nowrap">Apply</button>
        </div>
        <div class="up-coupon-msg" id="up-coupon-msg"></div>
      </div>
    </div>
    <div class="up-footer">
      <div class="up-footer-left"><button class="btn-ghost" onclick="prevUpgradeStep()">Back</button></div>
      <div class="up-footer-right"><button class="btn-primary yellow" onclick="nextUpgradeStep()">Continue to Payment</button></div>
    </div>
  </div>
  <!-- Step 3: Payment -->
  <div class="up-step" id="up-step-3">
    <div class="up-dark-hd">
      <div class="up-dark-blob up-dark-blob-1"></div>
      <div class="up-dark-blob up-dark-blob-2"></div>
      <div class="up-dark-content">
        <div class="up-plan-badge">Secure Checkout</div>
        <h2 style="font-family:var(--DISP);font-size:1.6rem;font-weight:700;letter-spacing:.04em;color:#fff;margin:0 0 2px">Payment Method</h2>
        <p style="font-size:.82rem;color:rgba(255,255,255,.55);margin:0">Choose how to pay <span id="up-pay-amount" style="color:var(--Y);font-weight:700">$4.00</span></p>
      </div>
    </div>
    <div class="up-body">
      <div class="up-pay-tabs">
        <div class="up-pay-tab active" data-method="upi" onclick="selectUpgradePayment('upi')"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="2" y="5" width="20" height="14" rx="3"/><path d="M12 10v4M9 12h6"/></svg>UPI</div>
        <div class="up-pay-tab" data-method="card" onclick="selectUpgradePayment('card')"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="2" y="5" width="20" height="14" rx="3"/><line x1="2" y1="10" x2="22" y2="10"/></svg>Card</div>
        <div class="up-pay-tab" data-method="netbanking" onclick="selectUpgradePayment('netbanking')"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M3 21h18M3 10h18M12 3L3 10v11h18V10L12 3z"/></svg>Net Banking</div>
        <div class="up-pay-tab" data-method="wallets" onclick="selectUpgradePayment('wallets')"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M20 12V8H6a2 2 0 010-4h12v4"/><path d="M4 6v12a2 2 0 002 2h14v-4"/><path d="M18 12a2 2 0 100 4h4v-4h-4z"/></svg>Wallets</div>
      </div>
      <div class="up-pay-content active" id="up-pay-upi">
        <label style="font-family:var(--MONO);font-size:.6rem;font-weight:700;letter-spacing:.08em;text-transform:uppercase;color:var(--MU);display:block;margin-bottom:6px">UPI ID</label>
        <div class="up-upi-row">
          <input type="text" id="up-upi-input" placeholder="username@upi"/>
          <button class="btn-primary yellow" onclick="submitUpgradePayment()" style="padding:11px 22px;font-size:.8rem;white-space:nowrap">Pay Now</button>
        </div>
        <div style="margin-top:8px;display:flex;gap:8px;flex-wrap:wrap" class="up-secure">
          <span><svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="var(--MU2)" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0110 0v4"/></svg> 256-bit SSL</span>
          <span><svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="var(--MU2)" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg> PCI Compliant</span>
          <span><svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="var(--MU2)" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg> Instant confirmation</span>
        </div>
      </div>
      <div class="up-pay-content" id="up-pay-card">
        <div style="display:flex;flex-direction:column;gap:10px">
          <input type="text" placeholder="Card Number" class="up-card-inp"/>
          <input type="text" placeholder="Cardholder Name" class="up-card-inp"/>
          <div class="up-card-row">
            <input type="text" placeholder="MM / YY">
            <input type="text" placeholder="CVV">
          </div>
          <button class="btn-primary yellow" onclick="submitUpgradePayment()" style="padding:11px 22px;font-size:.8rem;margin-top:4px">Pay Now</button>
        </div>
      </div>
      <div class="up-pay-content" id="up-pay-netbanking">
        <div class="up-bank-list">
          <div class="up-bank-item" onclick="document.querySelectorAll('.up-bank-item').forEach(e=>e.classList.remove('selected'));this.classList.add('selected')"><span style="font-weight:700;color:var(--INK)">SBI</span><span style="font-size:.75rem;color:var(--MU)">State Bank of India</span></div>
          <div class="up-bank-item" onclick="document.querySelectorAll('.up-bank-item').forEach(e=>e.classList.remove('selected'));this.classList.add('selected')"><span style="font-weight:700;color:var(--INK)">HDFC</span><span style="font-size:.75rem;color:var(--MU)">HDFC Bank</span></div>
          <div class="up-bank-item" onclick="document.querySelectorAll('.up-bank-item').forEach(e=>e.classList.remove('selected'));this.classList.add('selected')"><span style="font-weight:700;color:var(--INK)">ICICI</span><span style="font-size:.75rem;color:var(--MU)">ICICI Bank</span></div>
          <div class="up-bank-item" onclick="document.querySelectorAll('.up-bank-item').forEach(e=>e.classList.remove('selected'));this.classList.add('selected')"><span style="font-weight:700;color:var(--INK)">AXIS</span><span style="font-size:.75rem;color:var(--MU)">Axis Bank</span></div>
        </div>
        <button class="btn-primary yellow" onclick="submitUpgradePayment()" style="padding:11px 22px;font-size:.8rem;margin-top:10px">Pay Now</button>
      </div>
      <div class="up-pay-content" id="up-pay-wallets">
        <div class="up-wallet-grid">
          <div class="up-wallet-item" onclick="document.querySelectorAll('.up-wallet-item').forEach(e=>e.classList.remove('selected'));this.classList.add('selected')">Google Pay</div>
          <div class="up-wallet-item" onclick="document.querySelectorAll('.up-wallet-item').forEach(e=>e.classList.remove('selected'));this.classList.add('selected')">PhonePe</div>
          <div class="up-wallet-item" onclick="document.querySelectorAll('.up-wallet-item').forEach(e=>e.classList.remove('selected'));this.classList.add('selected')">Paytm</div>
          <div class="up-wallet-item" onclick="document.querySelectorAll('.up-wallet-item').forEach(e=>e.classList.remove('selected'));this.classList.add('selected')">Amazon Pay</div>
        </div>
        <button class="btn-primary yellow" onclick="submitUpgradePayment()" style="padding:11px 22px;font-size:.8rem;margin-top:10px">Pay Now</button>
      </div>
    </div>
    <div class="up-footer">
      <div class="up-footer-left"><button class="btn-ghost" onclick="prevUpgradeStep()">Back</button></div>
      <div class="up-footer-right"><span style="font-size:.7rem;color:var(--MU2);display:flex;align-items:center;gap:4px"><svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0110 0v4"/></svg> Secured</span></div>
    </div>
  </div>
  <!-- Step 4: Success -->
  <div class="up-step" id="up-step-4">
    <div class="up-success">
      <div class="up-success-check"><svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="var(--GREEN)" stroke-width="2.5"><path d="M5 13l4 4L19 7"/></svg></div>
      <h2 class="up-success-title">Payment Successful!</h2>
      <p class="up-success-sub">Your Pro plan has been activated</p>
      <div class="up-success-details">
        <div class="up-success-row"><span class="lbl">Plan</span><span class="val" id="up-success-plan">Pro Monthly</span></div>
        <div class="up-success-row"><span class="lbl">Amount paid</span><span class="val" id="up-success-amount">$4.00</span></div>
        <div class="up-success-row"><span class="lbl">Valid until</span><span class="val" id="up-success-until">Jul 22, 2026</span></div>
        <div class="up-success-row"><span class="lbl">Transaction ID</span><span class="val" id="up-success-txn">INX-ORO-783291</span></div>
      </div>
      <button class="btn-primary yellow" onclick="closeUpgradeModal()" style="margin-top:24px;padding:12px 36px;font-size:.88rem">Go to Dashboard</button>
    </div>
  </div>
</div>
</div>

<!-- ═══ SEARCH OVERLAY ═══ -->
<div class="search-overlay" id="search-overlay">
  <div class="search-overlay-bg" onclick="closeSearchPopup()"></div>
  <div class="search-overlay-box">
    <div class="search-overlay-input">
      <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><path stroke-linecap="round" d="M21 21l-4.35-4.35"/></svg>
      <input type="text" id="search-overlay-input" placeholder="Search addresses, emails, domains…" autocomplete="off"/>
      <button class="search-esc" onclick="closeSearchPopup()">ESC</button>
    </div>
    <div class="search-overlay-body">
      <div class="search-section">
        <div class="search-section-label">Recent</div>
        <div class="search-chips">
          <div class="search-chip"><svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg> contact@demo.com</div>
          <div class="search-chip"><svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg> mydomain.com</div>
          <div class="search-chip"><svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg> SMTP settings</div>
        </div>
      </div>
      <div class="search-section">
        <div class="search-section-label">Quick Links</div>
        <div class="search-links">
          <div class="search-link" onclick="window.location.href='{{ route('dashboard.inbox') }}';closeSearchPopup()"><svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg> Go to Inbox</div>
          <div class="search-link" onclick="window.location.href='{{ route('dashboard.address') }}';closeSearchPopup()"><svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/></svg> Manage Addresses</div>
          <div class="search-link" onclick="openUpgradeModal();closeSearchPopup()"><svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg> Upgrade to Pro</div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="topbar">
  <button class="sb-toggle" id="sb-toggle-btn" aria-label="Toggle sidebar">
    <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
      <path stroke-linecap="round" d="M4 6h16M4 12h16M4 18h16"/>
    </svg>
  </button>
  <div class="topbar-logo">
    <img src="/images/logo.svg" alt="InboxOro" class="logo-img"/>
  </div>
  <div class="topbar-search" onclick="openSearchPopup()">
    <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><path stroke-linecap="round" d="M21 21l-4.35-4.35"/></svg>
    <input type="text" placeholder="Search addresses, emails…" readonly/>
    <span class="search-kbd">Ctrl+K</span>
  </div>
  <div class="topbar-right">
    <!-- Language -->
    <div style="position:relative;">
      <button class="tb-icon tb-lang-btn" onclick="toggleLangDd()" id="tb-lang" aria-label="Language">
        <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path stroke-linecap="round" d="M2 12h20M12 2a15.3 15.3 0 010 20M12 2a15.3 15.3 0 000 20"/></svg>
        <span id="lang-label" style="font-size:.78rem;font-weight:600;color:var(--MU2);white-space:nowrap">EN</span>
        <svg width="10" height="10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="color:var(--MU2)"><path stroke-linecap="round" d="M19 9l-7 7-7-7"/></svg>
      </button>
      <div class="lang-dd" id="lang-dd">
        <div class="lang-item selected" onclick="selectLang(this,'en')"><span class="lang-flag">🇺🇸</span> English<span class="lang-check"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="var(--Y)" stroke-width="3"><path d="M5 13l4 4L19 7"/></svg></span></div>
        <div class="lang-item" onclick="selectLang(this,'es')"><span class="lang-flag">🇪🇸</span> Español<span class="lang-check"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="var(--Y)" stroke-width="3"><path d="M5 13l4 4L19 7"/></svg></span></div>
        <div class="lang-item" onclick="selectLang(this,'fr')"><span class="lang-flag">🇫🇷</span> Français<span class="lang-check"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="var(--Y)" stroke-width="3"><path d="M5 13l4 4L19 7"/></svg></span></div>
        <div class="lang-item" onclick="selectLang(this,'de')"><span class="lang-flag">🇩🇪</span> Deutsch<span class="lang-check"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="var(--Y)" stroke-width="3"><path d="M5 13l4 4L19 7"/></svg></span></div>
        <div class="lang-item" onclick="selectLang(this,'ja')"><span class="lang-flag">🇯🇵</span> 日本語<span class="lang-check"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="var(--Y)" stroke-width="3"><path d="M5 13l4 4L19 7"/></svg></span></div>
        <div class="lang-item" onclick="selectLang(this,'zh')"><span class="lang-flag">🇨🇳</span> 中文<span class="lang-check"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="var(--Y)" stroke-width="3"><path d="M5 13l4 4L19 7"/></svg></span></div>
      </div>
    </div>
    <!-- Notifications -->
    <div style="position:relative;">
      <button class="tb-icon" onclick="toggleNotifDd()" id="tb-notif" aria-label="Notifications">
        <svg width="17" height="17" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
        <div class="notif-badge" id="notif-badge"></div>
      </button>
      <div class="notif-dd" id="notif-dd">
        <div class="notif-hd"><span>Notifications</span> <span style="font-weight:400;color:var(--MU)">3 new</span></div>
        <div class="notif-list">
          <div class="notif-item unread">
            <div class="notif-dot"></div>
            <div class="notif-icon"><svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg></div>
            <div class="notif-content"><div class="notif-title">New email captured</div><div class="notif-desc">contact@demo.com — "Meeting tomorrow"</div><div class="notif-time">2 min ago</div></div>
          </div>
          <div class="notif-item unread">
            <div class="notif-dot"></div>
            <div class="notif-icon"><svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg></div>
            <div class="notif-content"><div class="notif-title">Domain verified</div><div class="notif-desc">mydomain.com has been verified successfully</div><div class="notif-time">1 hour ago</div></div>
          </div>
          <div class="notif-item unread">
            <div class="notif-dot"></div>
            <div class="notif-icon"><svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg></div>
            <div class="notif-content"><div class="notif-title">API key warning</div><div class="notif-desc">You've used 80% of your monthly API quota</div><div class="notif-time">3 hours ago</div></div>
          </div>
          <div class="notif-item">
            <div class="notif-dot"></div>
            <div class="notif-icon"><svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg></div>
            <div class="notif-content"><div class="notif-title">SMTP sandbox reset</div><div class="notif-desc">Your sandbox environment has been reset</div><div class="notif-time">Yesterday</div></div>
          </div>
        </div>
        <div class="notif-footer" onclick="markAllRead()">Mark all as read</div>
      </div>
    </div>
    <!-- Avatar -->
    <div style="position:relative;">
      <div class="tb-avatar" onclick="toggleUserDd()" id="tb-av">J
        <div class="user-dd" id="user-dd">
          <div class="dd-profile">
            <div class="dd-profile-av">J</div>
            <div class="dd-profile-info">
              <div class="dd-profile-name">John Doe</div>
              <div class="dd-profile-email">john@example.com</div>
              <div class="dd-profile-plan">Free Plan</div>
            </div>
          </div>
          <div class="dd-section">
            <div class="dd-item"><svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>My Profile</div>
            <div class="dd-item"><svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>Inbox<span class="dd-badge">3</span></div>
            <div class="dd-item" onclick="openUpgradeModal()"><svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>Upgrade to Pro</div>
          </div>
          <div class="dd-section">
            <div class="dd-item"><svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><circle cx="12" cy="12" r="3"/></svg>Settings</div>
            <div class="dd-item"><svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path stroke-linecap="round" d="M12 6v6l4 2"/></svg>Activity Log</div>
          </div>
          <div class="dd-section">
            <div class="dd-item danger" onclick="event.stopPropagation();document.getElementById('logout-form').submit();"><svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>Sign Out</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="shell">
  <div class="sb-backdrop" id="sb-backdrop" onclick="closeMobileSb()"></div>

  <div class="sidebar" id="sidebar">
    <div class="sb-body" style="padding-top:16px;">
      <div class="sb-label">Main</div>

      <a class="sb-item {{ request()->routeIs('dashboard.overview') ? 'active' : '' }}" href="{{ route('dashboard.overview') }}" data-tip="Overview">
        <div class="sb-item-icon">
          <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7" rx="1.5"/><rect x="14" y="3" width="7" height="7" rx="1.5"/><rect x="3" y="14" width="7" height="7" rx="1.5"/><rect x="14" y="14" width="7" height="7" rx="1.5"/></svg>
        </div>
        <span class="sb-item-label">Overview</span>
      </a>

      <a class="sb-item {{ request()->routeIs('dashboard.inbox') ? 'active' : '' }}" href="{{ route('dashboard.inbox') }}" data-tip="Inbox">
        <div class="sb-item-icon">
          <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
        </div>
        <span class="sb-item-label">Inbox</span>
        <span class="sb-pill">3</span>
      </a>

      <a class="sb-item {{ request()->routeIs('dashboard.address') ? 'active' : '' }}" href="{{ route('dashboard.address') }}" data-tip="Addresses">
        <div class="sb-item-icon">
          <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/></svg>
        </div>
        <span class="sb-item-label">Addresses</span>
      </a>

      <a class="sb-item {{ request()->routeIs('dashboard.domain') ? 'active' : '' }}" href="{{ route('dashboard.domain') }}" data-tip="Domains">
        <div class="sb-item-icon">
          <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path stroke-linecap="round" d="M2 12h20M12 2a15.3 15.3 0 010 20M12 2a15.3 15.3 0 000 20"/></svg>
        </div>
        <span class="sb-item-label">Domains</span>
      </a>

      <div class="sb-divider"></div>
      <div class="sb-label">Account</div>

      <a class="sb-item {{ request()->routeIs('dashboard.smtp') ? 'active' : '' }}" href="{{ route('dashboard.smtp') }}" data-tip="SMTP">
        <div class="sb-item-icon">
          <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
        </div>
        <span class="sb-item-label">SMTP Sandbox</span>
      </a>

      <a class="sb-item {{ request()->routeIs('dashboard.api') ? 'active' : '' }}" href="{{ route('dashboard.api') }}" data-tip="API Keys">
        <div class="sb-item-icon">
          <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/></svg>
        </div>
        <span class="sb-item-label">API Keys</span>
      </a>

      <a class="sb-item {{ request()->routeIs('dashboard.setting') ? 'active' : '' }}" href="{{ route('dashboard.setting') }}" data-tip="Settings">
        <div class="sb-item-icon">
          <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><circle cx="12" cy="12" r="3"/></svg>
        </div>
        <span class="sb-item-label">Settings</span>
      </a>

    </div>

    <div class="sb-footer">
      <div class="sb-user">
        <div class="sb-user-av">J</div>
        <div class="sb-user-info">
          <div class="sb-user-name">John Doe</div>
          <div class="sb-user-plan">PRO Plan</div>
        </div>
      </div>
    </div>
  </div>

  <div class="main" id="main">
    @yield('content')
  </div>
</div>



<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none">@csrf</form>

<script>
const sidebar     = document.getElementById('sidebar');
const backdrop    = document.getElementById('sb-backdrop');
const toggleBtn   = document.getElementById('sb-toggle-btn');
const collapseBtn = document.getElementById('sb-collapse-btn');

let isMobile = () => window.innerWidth < 900;
let isCollapsed = false;

toggleBtn.addEventListener('click', () => {
  if (isMobile()) {
    const open = sidebar.classList.toggle('mob-open');
    backdrop.classList.toggle('show', open);
  }else{
    collapseSidebar(!isCollapsed)
  }
});

function collapseSidebar(collapse) {
  isCollapsed = collapse;
  sidebar.classList.toggle('collapsed', collapse);
  document.body.classList.toggle('sb-collapsed', collapse);
}

function closeMobileSb() {
  sidebar.classList.remove('mob-open');
  backdrop.classList.remove('show');
}

window.addEventListener('resize', () => {
  if (!isMobile()) {
    sidebar.classList.remove('mob-open');
    backdrop.classList.remove('show');
  }
});

document.querySelectorAll('.sb-item').forEach(item => {
  item.addEventListener('click', () => {
    if (isMobile()) closeMobileSb();
  });
});

function toggleUserDd() {
  document.getElementById('user-dd').classList.toggle('open');
}
document.addEventListener('click', e => {
  if (!e.target.closest('#tb-av')) {
    document.getElementById('user-dd').classList.remove('open');
  }
});

function toast(msg) {
  document.getElementById('toast-msg').textContent = msg;
  const t = document.getElementById('toast');
  t.classList.add('show');
  setTimeout(() => t.classList.remove('show'), 2400);
}

/* ═══ FLASH ALERTS ═══ */
@if(session('success'))
document.addEventListener('DOMContentLoaded', function(){
  toast(@js(session('success')));
});
@endif

/* ═══ UPGRADE MODAL ═══ */
var upgradeStep = 1, upgradeBilling = 'monthly', upgradePlan = 'pro';
function openUpgradeModal() {
  upgradeStep = 1; upgradeBilling = 'monthly'; upgradePlan = 'pro';
  document.getElementById('up-modal').classList.add('open');
  document.body.style.overflow = 'hidden';
  renderUpgradeStep(1);
  /* reset billing pills */
  var btns = document.querySelectorAll('#up-billing .up-bill-btn');
  btns.forEach(function(b,i){
    b.classList.toggle('active', i===0);
    b.style.background = i===0 ? '#fff' : 'transparent';
    b.style.color = i===0 ? 'var(--INK)' : 'var(--MU)';
    b.style.boxShadow = i===0 ? '0 1px 3px rgba(0,0,0,.06)' : 'none';
  });
  setBilling('monthly');
  /* reset coupon */
  document.getElementById('up-coupon-input').value = '';
  document.getElementById('up-coupon-msg').textContent = '';
  document.getElementById('up-coupon-msg').className = 'up-coupon-msg';
  document.getElementById('up-discount-row').style.display = 'none';
  document.getElementById('up-summary-subtotal').textContent = '$4.00';
  document.getElementById('up-summary-total').textContent = '$4.00';
  document.getElementById('up-pay-amount').textContent = '$4.00';
}
function closeUpgradeModal() {
  document.getElementById('up-modal').classList.remove('open');
  document.body.style.overflow = '';
}
function nextUpgradeStep() { if (upgradeStep < 4) renderUpgradeStep(upgradeStep + 1); }
function prevUpgradeStep() { if (upgradeStep > 1) renderUpgradeStep(upgradeStep - 1); }
function renderUpgradeStep(n) {
  upgradeStep = n;
  document.querySelectorAll('.up-step').forEach(function(el,i){ el.classList.toggle('active', i+1===n); });
  [1,2,3,4].forEach(function(i){
    var ps = document.getElementById('up-ps-'+i);
    ps.classList.remove('active','done');
    if (i === n) ps.classList.add('active');
    else if (i < n) ps.classList.add('done');
  });
}
document.addEventListener('DOMContentLoaded', function(){
  var btns = document.querySelectorAll('#up-billing .up-bill-btn');
  btns.forEach(function(b){
    b.addEventListener('click', function(){
      btns.forEach(function(x){
        x.classList.remove('active');
        x.style.background = 'transparent';
        x.style.color = 'var(--MU)';
        x.style.boxShadow = 'none';
      });
      b.classList.add('active');
      b.style.background = '#fff';
      b.style.color = 'var(--INK)';
      b.style.boxShadow = '0 1px 3px rgba(0,0,0,.06)';
      setBilling(b.getAttribute('data-cycle'));
    });
  });
});
function setBilling(cycle) {
  upgradeBilling = cycle;
  var price = document.getElementById('up-pro-price');
  var period = document.getElementById('up-pro-period');
  var emails = document.getElementById('up-pro-emails');
  if (cycle === 'annual') { price.textContent = '$36'; period.textContent = '/yr'; emails.textContent = '120,000'; }
  else { price.textContent = '$4'; period.textContent = '/mo'; emails.textContent = '10,000'; }
}
function applyUpgradeCoupon() {
  var inp = document.getElementById('up-coupon-input');
  var msg = document.getElementById('up-coupon-msg');
  var code = inp.value.trim().toUpperCase();
  if (code === 'SAVE20') {
    msg.textContent = 'Coupon applied! 20% off';
    msg.className = 'up-coupon-msg ok';
    var base = (upgradeBilling === 'annual') ? 36 : 4;
    var discount = base * 0.20;
    var total = base - discount;
    document.getElementById('up-summary-discount').textContent = '\u2212$' + discount.toFixed(2);
    document.getElementById('up-summary-total').textContent = '$' + total.toFixed(2);
    document.getElementById('up-pay-amount').textContent = '$' + total.toFixed(2);
    document.getElementById('up-discount-row').style.display = 'flex';
  } else if (code) { msg.textContent = 'Invalid coupon code'; msg.className = 'up-coupon-msg err'; }
  else { msg.textContent = ''; msg.className = 'up-coupon-msg'; }
}
function selectUpgradePayment(method) {
  document.querySelectorAll('.up-pay-tab').forEach(function(t){ t.classList.remove('active'); });
  document.querySelector('.up-pay-tab[data-method="'+method+'"]').classList.add('active');
  document.querySelectorAll('.up-pay-content').forEach(function(p){ p.classList.remove('active'); });
  document.getElementById('up-pay-'+method).classList.add('active');
}
function submitUpgradePayment() {
  var planLabel = (upgradeBilling === 'annual') ? 'Pro Annual' : 'Pro Monthly';
  var amount = document.getElementById('up-summary-total').textContent || '$4.00';
  document.getElementById('up-success-plan').textContent = planLabel;
  document.getElementById('up-success-amount').textContent = amount;
  var d = new Date();
  d.setMonth(d.getMonth() + (upgradeBilling === 'annual' ? 12 : 1));
  document.getElementById('up-success-until').textContent = d.toLocaleDateString('en-US', { month:'short', day:'numeric', year:'numeric' });
  document.getElementById('up-success-txn').textContent = 'INX-ORO-' + Math.floor(100000 + Math.random()*900000);
  renderUpgradeStep(4);
}
/* upgrade overlay click */
document.addEventListener('DOMContentLoaded', function(){
  var ov = document.getElementById('up-modal');
  if (ov) ov.addEventListener('click', function(e){ if (e.target === ov) closeUpgradeModal(); });
});

/* ═══ LANGUAGE DROPDOWN ═══ */
function toggleLangDd() {
  closeNotifDd();
  document.getElementById('lang-dd').classList.toggle('open');
}
function selectLang(el, code) {
  document.querySelectorAll('.lang-item').forEach(function(i){ i.classList.remove('selected'); });
  el.classList.add('selected');
  document.getElementById('lang-dd').classList.remove('open');
  document.getElementById('lang-label').textContent = code.toUpperCase();
  toast('Language: ' + el.textContent.trim());
}

/* ═══ NOTIFICATION DROPDOWN ═══ */
function toggleNotifDd() {
  closeLangDd();
  document.getElementById('notif-dd').classList.toggle('open');
}
function closeNotifDd() { document.getElementById('notif-dd').classList.remove('open'); }
function closeLangDd() { document.getElementById('lang-dd').classList.remove('open'); }
function markAllRead() {
  document.querySelectorAll('.notif-item.unread').forEach(function(i){ i.classList.remove('unread'); });
  document.querySelector('.notif-hd span:last-child').textContent = '0 new';
  document.getElementById('notif-badge').style.display = 'none';
  toast('All notifications marked as read');
}

/* ═══ SEARCH OVERLAY ═══ */
function openSearchPopup() {
  document.getElementById('search-overlay').classList.add('open');
  setTimeout(function(){ document.getElementById('search-overlay-input').focus(); }, 100);
}
function closeSearchPopup() {
  document.getElementById('search-overlay').classList.remove('open');
}
/* Ctrl+K shortcut */
document.addEventListener('keydown', function(e) {
  if ((e.ctrlKey || e.metaKey) && e.key === 'k') { e.preventDefault(); openSearchPopup(); }
  if (e.key === 'Escape') { closeSearchPopup(); closeUpgradeModal(); }
});
/* search overlay bg click */
document.addEventListener('DOMContentLoaded', function(){
  var so = document.getElementById('search-overlay');
  if (so) so.addEventListener('click', function(e){ if (e.target === so) closeSearchPopup(); });
  /* make search bar clickable */
  var sb = document.querySelector('.topbar-search');
  if (sb) sb.addEventListener('click', function(e){ if (!e.target.closest('input')) openSearchPopup(); });
});

/* close dropdowns on outside click */
document.addEventListener('click', function(e) {
  if (!e.target.closest('#tb-lang') && !e.target.closest('#tb-lang *')) {
    document.getElementById('lang-dd').classList.remove('open');
  }
  if (!e.target.closest('#tb-notif') && !e.target.closest('#tb-notif *')) {
    document.getElementById('notif-dd').classList.remove('open');
  }
});
</script>
@stack('scripts')
</body>
</html>
