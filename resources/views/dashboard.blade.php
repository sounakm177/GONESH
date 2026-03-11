<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>DROPIT — Dashboard</title>
<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Outfit:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;500;700&display=swap" rel="stylesheet"/>
<style>
:root{--Y:#FACC15;--B:#2563EB;--INK:#1F2937;--BG:#F8FAFC;--BD:#E5E7EB;--MU:#6B7280;--CARD:#fff;}
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0;}
html,body{height:100%;}
body{background:var(--BG);font-family:'Outfit',sans-serif;color:var(--INK);overflow:hidden;display:flex;flex-direction:column;}

/* ── TOPBAR ── */
.topbar{
  background:var(--INK);
  display:flex;align-items:center;justify-content:space-between;
  padding:0 28px;height:54px;
  border-bottom:3px solid var(--Y);
  flex-shrink:0;z-index:50;
}
.topbar-logo{font-family:'Bebas Neue',sans-serif;font-size:1.7rem;color:var(--Y);letter-spacing:.05em;text-decoration:none;}
.topbar-logo span{color:#fff;}
.topbar-center{display:flex;align-items:center;gap:6px;background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);padding:7px 16px;min-width:260px;}
.topbar-center svg{flex-shrink:0;color:#6B7280;}
.topbar-center input{background:transparent;border:none;outline:none;font-family:'Outfit',sans-serif;font-size:.82rem;color:#fff;width:100%;cursor:text;}
.topbar-center input::placeholder{color:#6B7280;}
.topbar-right{display:flex;align-items:center;gap:14px;}
.tb-icon-btn{width:34px;height:34px;display:flex;align-items:center;justify-content:center;border:1.5px solid rgba(255,255,255,.12);background:transparent;color:#9CA3AF;transition:background .12s,color .12s;position:relative;}
.tb-icon-btn:hover{background:rgba(255,255,255,.08);color:var(--Y);}
.tb-notif-dot{position:absolute;top:5px;right:5px;width:7px;height:7px;background:var(--Y);border-radius:50%;border:1.5px solid var(--INK);}
.tb-avatar{width:34px;height:34px;background:var(--Y);border:2px solid var(--INK);display:flex;align-items:center;justify-content:center;font-family:'Bebas Neue',sans-serif;font-size:1rem;color:var(--INK);flex-shrink:0;}
.tb-user{display:flex;align-items:center;gap:8px;padding:4px 10px;border:1px solid rgba(255,255,255,.1);transition:background .12s;}
.tb-user:hover{background:rgba(255,255,255,.06);}
.tb-user-name{font-size:.8rem;font-weight:600;color:#fff;}
.tb-user-plan{font-family:'JetBrains Mono',monospace;font-size:.58rem;color:var(--Y);font-weight:700;letter-spacing:.08em;}

/* ── SHELL ── */
.shell{display:flex;flex:1;overflow:hidden;}

/* ── SIDEBAR ── */
.sidebar{
  width:220px;flex-shrink:0;
  background:var(--INK);
  border-right:2px solid rgba(255,255,255,.07);
  display:flex;flex-direction:column;
  padding:20px 0;
  overflow-y:auto;
}
.sidebar::-webkit-scrollbar{width:3px;}
.sidebar::-webkit-scrollbar-thumb{background:rgba(255,255,255,.1);}

.sb-section{padding:0 16px;margin-bottom:6px;}
.sb-section-label{font-family:'JetBrains Mono',monospace;font-size:.58rem;font-weight:700;letter-spacing:.14em;text-transform:uppercase;color:#4B5563;padding:10px 4px 6px;}

.sb-item{
  display:flex;align-items:center;gap:10px;
  padding:9px 20px;
  font-size:.8rem;font-weight:500;
  color:#9CA3AF;text-decoration:none;
  transition:background .12s,color .12s;
  border-left:3px solid transparent;
  position:relative;
}
.sb-item:hover{background:rgba(255,255,255,.05);color:#fff;}
.sb-item.active{background:rgba(250,204,21,.1);color:var(--Y);border-left-color:var(--Y);font-weight:700;}
.sb-item svg{flex-shrink:0;}
.sb-badge{margin-left:auto;background:var(--Y);color:var(--INK);font-family:'JetBrains Mono',monospace;font-size:.56rem;font-weight:800;padding:2px 6px;border-radius:0;}

.sb-divider{border:none;border-top:1px solid rgba(255,255,255,.06);margin:10px 16px;}

/* bottom user card */
.sb-user-card{margin:auto 14px 0;border:1px solid rgba(255,255,255,.08);background:rgba(255,255,255,.03);padding:12px 14px;}
.sb-user-name{font-size:.8rem;font-weight:700;color:#fff;margin-bottom:1px;}
.sb-user-email{font-family:'JetBrains Mono',monospace;font-size:.62rem;color:#6B7280;word-break:break-all;}
.sb-upgrade{display:flex;align-items:center;gap:6px;margin-top:10px;background:var(--Y);color:var(--INK);font-size:.72rem;font-weight:700;font-family:'Bebas Neue',sans-serif;letter-spacing:.06em;padding:8px 12px;border:none;width:100%;justify-content:center;box-shadow:2px 2px 0 rgba(255,255,255,.2);transition:opacity .15s;}
.sb-upgrade:hover{opacity:.88;}

/* ── MAIN CONTENT ── */
.main{flex:1;overflow-y:auto;padding:28px 32px;display:flex;flex-direction:column;gap:24px;}
.main::-webkit-scrollbar{width:5px;}
.main::-webkit-scrollbar-thumb{background:#E5E7EB;border-radius:2px;}

/* page title row */
.page-title-row{display:flex;align-items:flex-end;justify-content:space-between;flex-wrap:wrap;gap:12px;}
.page-title{font-family:'Bebas Neue',sans-serif;font-size:2rem;letter-spacing:.04em;color:var(--INK);line-height:1;}
.page-title span{color:var(--Y);}
.page-sub{font-family:'JetBrains Mono',monospace;font-size:.67rem;color:var(--MU);margin-top:3px;}
.btn-primary{display:inline-flex;align-items:center;gap:7px;background:var(--Y);color:var(--INK);font-family:'Bebas Neue',sans-serif;font-size:1rem;letter-spacing:.06em;padding:10px 20px;border:2px solid var(--INK);box-shadow:3px 3px 0 var(--INK);transition:transform .1s,box-shadow .1s;}
.btn-primary:hover{transform:translate(-1px,-1px);box-shadow:5px 5px 0 var(--INK);}
.btn-primary:active{transform:translate(1px,1px);box-shadow:1px 1px 0 var(--INK);}
.btn-sec{display:inline-flex;align-items:center;gap:6px;background:#fff;color:var(--INK);font-size:.8rem;font-weight:600;padding:9px 16px;border:2px solid var(--INK);box-shadow:2px 2px 0 var(--INK);transition:transform .1s,box-shadow .1s,background .12s;}
.btn-sec:hover{background:#FFFBEB;transform:translate(-1px,-1px);box-shadow:4px 4px 0 var(--INK);}

/* ── STAT CARDS ── */
.stat-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:14px;}
.stat-card{background:var(--CARD);border:2px solid var(--INK);padding:18px 20px;position:relative;overflow:hidden;transition:box-shadow .15s,transform .12s;}
.stat-card:hover{transform:translateY(-2px);box-shadow:4px 4px 0 var(--INK);}
.stat-card-accent{position:absolute;top:0;left:0;width:4px;height:100%;background:var(--Y);}
.stat-card.blue .stat-card-accent{background:var(--B);}
.stat-card.green .stat-card-accent{background:#22c55e;}
.stat-card.red .stat-card-accent{background:#dc2626;}
.stat-card-label{font-family:'JetBrains Mono',monospace;font-size:.62rem;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--MU);margin-bottom:8px;}
.stat-card-value{font-family:'Bebas Neue',sans-serif;font-size:2.2rem;color:var(--INK);line-height:1;margin-bottom:4px;}
.stat-card-sub{font-size:.72rem;color:var(--MU);display:flex;align-items:center;gap:4px;}
.stat-card-sub .up{color:#22c55e;font-weight:700;}
.stat-card-sub .dn{color:#dc2626;font-weight:700;}
.stat-card-icon{position:absolute;bottom:14px;right:14px;color:#F3F4F6;}

/* ── QUICK GENERATE ── */
.gen-card{background:var(--CARD);border:2px solid var(--INK);}
.gen-card-header{display:flex;align-items:center;justify-content:space-between;padding:14px 20px;border-bottom:2px solid var(--INK);background:#FAFAFA;}
.gen-card-title{font-family:'Bebas Neue',sans-serif;font-size:1.1rem;letter-spacing:.04em;}
.live-pill{display:flex;align-items:center;gap:6px;font-family:'JetBrains Mono',monospace;font-size:.64rem;font-weight:700;color:#16a34a;letter-spacing:.06em;}
.live-dot{width:6px;height:6px;background:#22c55e;border-radius:50%;animation:pg 2s ease-in-out infinite;}
@keyframes pg{0%,100%{box-shadow:0 0 0 0 rgba(34,197,94,.5)}50%{box-shadow:0 0 0 4px rgba(34,197,94,0)}}
.gen-card-body{padding:20px;}
.gen-email-row{display:flex;align-items:center;gap:12px;background:#F8FAFC;border:2px solid var(--INK);padding:14px 18px;margin-bottom:14px;}
.gen-email-txt{font-family:'JetBrains Mono',monospace;font-size:1.1rem;font-weight:700;color:var(--INK);flex:1;min-width:0;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;}
.gen-email-txt.fading{opacity:.2;}
.gen-btns{display:flex;gap:10px;flex-wrap:wrap;}
.btn-copy{background:var(--Y);color:var(--INK);font-size:.8rem;font-weight:700;letter-spacing:.05em;padding:9px 20px;border:2px solid var(--INK);box-shadow:3px 3px 0 var(--INK);transition:transform .1s,box-shadow .1s;}
.btn-copy:hover{transform:translate(-1px,-1px);box-shadow:5px 5px 0 var(--INK);}
.btn-copy.ok{background:#22c55e;color:#fff;border-color:#16a34a;}
.timer-row{display:flex;align-items:center;gap:10px;margin-top:12px;}
.timer-track{flex:1;height:3px;background:var(--BD);}
.timer-fill{height:100%;background:var(--Y);width:100%;animation:shrink 600s linear forwards;}
@keyframes shrink{to{width:0;}}
.timer-txt{font-family:'JetBrains Mono',monospace;font-size:.7rem;font-weight:700;color:var(--INK);}
.timer-lbl{font-size:.68rem;color:var(--MU);}

/* ── TWO COL ── */
.two-col{display:grid;grid-template-columns:1fr 380px;gap:20px;}

/* ── ADDRESS TABLE ── */
.panel{background:var(--CARD);border:2px solid var(--INK);}
.panel-header{display:flex;align-items:center;justify-content:space-between;padding:12px 18px;border-bottom:2px solid var(--INK);background:#FAFAFA;}
.panel-title{font-family:'Bebas Neue',sans-serif;font-size:1.05rem;letter-spacing:.04em;}
.panel-meta{font-family:'JetBrains Mono',monospace;font-size:.6rem;color:var(--MU);}

.addr-table{width:100%;}
.addr-head{display:grid;grid-template-columns:1fr 80px 80px 100px 36px;padding:8px 16px;gap:10px;background:var(--INK);}
.addr-head span{font-family:'JetBrains Mono',monospace;font-size:.58rem;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:#9CA3AF;}
.addr-row{display:grid;grid-template-columns:1fr 80px 80px 100px 36px;padding:11px 16px;gap:10px;border-top:1px solid var(--BD);align-items:center;transition:background .1s;}
.addr-row:hover{background:#FFFBEB;}
.addr-email{font-family:'JetBrains Mono',monospace;font-size:.75rem;font-weight:600;color:var(--INK);white-space:nowrap;overflow:hidden;text-overflow:ellipsis;}
.addr-msgs{font-size:.75rem;color:var(--MU);text-align:center;}
.addr-msgs b{color:var(--INK);font-weight:700;}
.addr-status{display:inline-flex;align-items:center;gap:5px;font-size:.68rem;font-weight:700;font-family:'JetBrains Mono',monospace;padding:3px 8px;border:1.5px solid;}
.addr-status.active{color:#16a34a;border-color:#16a34a;background:#f0fdf4;}
.addr-status.expired{color:#6B7280;border-color:#E5E7EB;background:#F9FAFB;}
.addr-status.dot{width:6px;height:6px;border-radius:50%;}
.addr-expires{font-family:'JetBrains Mono',monospace;font-size:.68rem;color:var(--MU);}
.addr-action{display:flex;align-items:center;justify-content:center;}
.icon-btn{width:26px;height:26px;display:flex;align-items:center;justify-content:center;border:1.5px solid var(--BD);background:#fff;color:var(--MU);transition:border-color .12s,color .12s,background .12s;}
.icon-btn:hover{border-color:var(--INK);color:var(--INK);background:#FEF9C3;}
.icon-btn.danger:hover{border-color:#dc2626;color:#dc2626;background:#fee2e2;}

/* ── ACTIVITY FEED ── */
.activity-list{padding:14px 0;max-height:340px;overflow-y:auto;}
.activity-list::-webkit-scrollbar{width:3px;}
.activity-list::-webkit-scrollbar-thumb{background:#E5E7EB;}
.activity-item{display:flex;align-items:flex-start;gap:12px;padding:11px 16px;border-bottom:1px solid #F3F4F6;transition:background .1s;}
.activity-item:hover{background:#FFFBEB;}
.activity-item:last-child{border-bottom:none;}
.act-icon{width:32px;height:32px;display:flex;align-items:center;justify-content:center;flex-shrink:0;border:1.5px solid var(--BD);}
.act-icon.y{background:#FEF9C3;border-color:var(--Y);}
.act-icon.b{background:#EFF6FF;border-color:var(--B);}
.act-icon.g{background:#F0FDF4;border-color:#22c55e;}
.act-icon.r{background:#FEF2F2;border-color:#dc2626;}
.act-body{flex:1;min-width:0;}
.act-msg{font-size:.78rem;color:var(--INK);font-weight:500;line-height:1.4;margin-bottom:2px;}
.act-msg b{font-weight:700;}
.act-time{font-family:'JetBrains Mono',monospace;font-size:.62rem;color:#9CA3AF;}

/* ── CHART AREA ── */
.chart-wrap{padding:16px 18px 8px;}
.chart-label-row{display:flex;align-items:center;justify-content:space-between;margin-bottom:14px;}
.chart-legend{display:flex;gap:14px;}
.legend-item{display:flex;align-items:center;gap:5px;font-size:.7rem;color:var(--MU);}
.legend-dot{width:8px;height:8px;border-radius:50%;}
.simple-chart{display:flex;align-items:flex-end;gap:6px;height:80px;}
.bar-group{display:flex;gap:2px;align-items:flex-end;flex:1;}
.bar{flex:1;border-radius:0;transition:opacity .15s;}
.bar:hover{opacity:.8;}
.chart-x{display:flex;gap:6px;margin-top:6px;}
.chart-x-label{flex:1;text-align:center;font-family:'JetBrains Mono',monospace;font-size:.55rem;color:#C0C0C0;}

/* ── DOMAIN QUICK PICK ── */
.domain-pills{display:flex;flex-wrap:wrap;gap:6px;padding:14px 18px;}
.dom-pill{font-family:'JetBrains Mono',monospace;font-size:.7rem;font-weight:600;padding:5px 12px;border:1.5px solid var(--INK);background:#fff;transition:background .12s,color .12s;color:var(--MU);}
.dom-pill:hover{background:#FEF9C3;color:var(--INK);}
.dom-pill.active{background:var(--INK);color:var(--Y);}

/* ── TOAST ── */
#toast{position:fixed;bottom:22px;right:26px;background:var(--INK);color:var(--Y);font-family:'JetBrains Mono',monospace;font-size:.72rem;font-weight:700;letter-spacing:.05em;padding:10px 16px;border:2px solid var(--Y);box-shadow:3px 3px 0 var(--Y);z-index:999;transform:translateY(60px);opacity:0;transition:transform .35s cubic-bezier(.34,1.56,.64,1),opacity .3s;display:flex;align-items:center;gap:7px;}
#toast.show{transform:translateY(0);opacity:1;}

/* tabs */
.tab-row{display:flex;border-bottom:2px solid var(--INK);}
.tab{font-family:'JetBrains Mono',monospace;font-size:.7rem;font-weight:700;letter-spacing:.07em;text-transform:uppercase;padding:9px 16px;border-bottom:2px solid transparent;margin-bottom:-2px;color:var(--MU);transition:color .15s,border-color .15s;}
.tab:hover{color:var(--INK);}
.tab.active{color:var(--INK);border-bottom-color:var(--Y);}

/* notification dropdown */
.notif-dropdown{display:none;position:absolute;top:54px;right:0;width:300px;background:var(--CARD);border:2px solid var(--INK);box-shadow:4px 4px 0 var(--INK);z-index:200;}
.notif-dropdown.show{display:block;}
.notif-header{padding:11px 14px;border-bottom:2px solid var(--INK);font-family:'Bebas Neue',sans-serif;font-size:1rem;letter-spacing:.04em;background:#FAFAFA;}
.notif-item{display:flex;gap:10px;padding:12px 14px;border-bottom:1px solid #F3F4F6;transition:background .1s;}
.notif-item:hover{background:#FFFBEB;}
.notif-item.unread{background:#FFFDE7;}
.notif-dot{width:7px;height:7px;background:var(--Y);border-radius:50%;flex-shrink:0;margin-top:5px;}
.notif-body{flex:1;font-size:.77rem;color:var(--INK);line-height:1.4;}
.notif-time{font-family:'JetBrains Mono',monospace;font-size:.6rem;color:#9CA3AF;margin-top:2px;}
.notif-footer{padding:9px 14px;text-align:center;font-size:.74rem;color:var(--B);font-weight:600;}
.notif-footer:hover{background:#EFF6FF;}

/* user dropdown */
.user-dropdown{display:none;position:absolute;top:54px;right:0;width:200px;background:var(--CARD);border:2px solid var(--INK);box-shadow:4px 4px 0 var(--INK);z-index:200;}
.user-dropdown.show{display:block;}
.ud-item{display:flex;align-items:center;gap:8px;padding:10px 14px;font-size:.8rem;color:var(--INK);font-weight:500;border-bottom:1px solid #F3F4F6;transition:background .1s;}
.ud-item:hover{background:#FFFBEB;}
.ud-item:last-child{border-bottom:none;}
.ud-item.danger{color:#dc2626;}
.ud-item.danger:hover{background:#FEF2F2;}
</style>
</head>
<body>
<div id="cur"></div>
<div id="toast"><svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" d="M5 13l4 4L19 7"/></svg><span id="toast-msg">Copied!</span></div>

<!-- ── TOPBAR ── -->
<div class="topbar">
  <a class="topbar-logo" href="login.html">DROP<span>IT</span></a>
  <div class="topbar-center">
    <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><path stroke-linecap="round" d="M21 21l-4.35-4.35"/></svg>
    <input type="text" placeholder="Search addresses, messages…"/>
  </div>
  <div class="topbar-right" style="position:relative;">
    <!-- Notifications -->
    <div style="position:relative;">
      <button class="tb-icon-btn" onclick="toggleNotif()" id="notif-btn">
        <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
        <div class="tb-notif-dot" id="notif-dot"></div>
      </button>
      <div class="notif-dropdown" id="notif-dd">
        <div class="notif-header">Notifications <span style="color:var(--Y);">(3)</span></div>
        <div class="notif-item unread"><div class="notif-dot"></div><div><div class="notif-body">New email from <b>Google</b> on ghost.wolf2847@dropit.io</div><div class="notif-time">2 min ago</div></div></div>
        <div class="notif-item unread"><div class="notif-dot"></div><div><div class="notif-body">Address <b>silent.fox9341@dropit.io</b> expires in 2 minutes</div><div class="notif-time">7 min ago</div></div></div>
        <div class="notif-item unread"><div class="notif-dot"></div><div><div class="notif-body">OTP received from <b>Shopify</b></div><div class="notif-time">12 min ago</div></div></div>
        <div class="notif-item"><div class="notif-dot" style="opacity:0;"></div><div><div class="notif-body">Your Pro subscription renewed successfully</div><div class="notif-time">1 day ago</div></div></div>
        <div class="notif-footer" onclick="toggleNotif()">View all notifications</div>
      </div>
    </div>

    <!-- Settings -->
    <button class="tb-icon-btn" onclick="window.location.href='#'">
      <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><circle cx="12" cy="12" r="3"/></svg>
    </button>

    <!-- User -->
    <div style="position:relative;">
      <div class="tb-user" onclick="toggleUserDd()">
        <div class="tb-avatar">J</div>
        <div>
          <div class="tb-user-name">John Doe</div>
          <div class="tb-user-plan">PRO PLAN</div>
        </div>
        <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="#6B7280" stroke-width="2" style="margin-left:4px;"><path stroke-linecap="round" d="M19 9l-7 7-7-7"/></svg>
      </div>
      <div class="user-dropdown" id="user-dd">
        <div class="ud-item"><svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>Profile</div>
        <div class="ud-item"><svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>Billing</div>
        <div class="ud-item"><svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/></svg>API Keys</div>
        <div class="ud-item danger" onclick="window.location.href='login.html'"><svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>Sign Out</div>
      </div>
    </div>
  </div>
</div>

<!-- ── SHELL ── -->
<div class="shell">

  <!-- SIDEBAR -->
  <div class="sidebar">
    <div class="sb-section">
      <div class="sb-section-label">Main</div>
    </div>
    <a class="sb-item active" href="#">
      <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/></svg>
      Overview
    </a>
    <a class="sb-item" href="#">
      <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
      Inbox
      <span class="sb-badge">3</span>
    </a>
    <a class="sb-item" href="#">
      <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/></svg>
      Addresses
    </a>
    <a class="sb-item" href="#">
      <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"/></svg>
      Domains
    </a>

    <hr class="sb-divider"/>
    <div class="sb-section">
      <div class="sb-section-label">Account</div>
    </div>
    <a class="sb-item" href="#">
      <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
      Analytics
    </a>
    <a class="sb-item" href="#">
      <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/></svg>
      API Keys
    </a>
    <a class="sb-item" href="#">
      <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><circle cx="12" cy="12" r="3"/></svg>
      Settings
    </a>

    <hr class="sb-divider"/>

    <div class="sb-user-card">
      <div class="sb-user-name">John Doe</div>
      <div class="sb-user-email">johndoe@gmail.com</div>
      <button class="sb-upgrade">
        <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
        Upgrade Plan
      </button>
    </div>
  </div>

  <!-- MAIN -->
  <div class="main">

    <!-- Title -->
    <div class="page-title-row">
      <div>
        <div class="page-title">Overview <span>Dashboard</span></div>
        <div class="page-sub">// Monday, March 08, 2026 · Pro Plan Active</div>
      </div>
      <div style="display:flex;gap:10px;">
        <button class="btn-sec" onclick="refreshDash()">
          <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
          Refresh
        </button>
        <button class="btn-primary" onclick="generateNew()">
          <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M12 4v16m8-8H4"/></svg>
          New Address
        </button>
      </div>
    </div>

    <!-- Stats -->
    <div class="stat-grid">
      <div class="stat-card">
        <div class="stat-card-accent"></div>
        <div class="stat-card-label">Total Addresses</div>
        <div class="stat-card-value">47</div>
        <div class="stat-card-sub"><span class="up">↑ 12</span> this week</div>
        <div class="stat-card-icon"><svg width="36" height="36" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1"><path stroke-linecap="round" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/></svg></div>
      </div>
      <div class="stat-card blue">
        <div class="stat-card-accent"></div>
        <div class="stat-card-label">Emails Received</div>
        <div class="stat-card-value">238</div>
        <div class="stat-card-sub"><span class="up">↑ 34</span> this week</div>
        <div class="stat-card-icon"><svg width="36" height="36" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1"><path stroke-linecap="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg></div>
      </div>
      <div class="stat-card green">
        <div class="stat-card-accent"></div>
        <div class="stat-card-label">Active Now</div>
        <div class="stat-card-value" id="active-count">3</div>
        <div class="stat-card-sub"><span class="live-pill" style="font-size:.65rem;"><span class="live-dot"></span>Live</span></div>
        <div class="stat-card-icon"><svg width="36" height="36" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1"><circle cx="12" cy="12" r="10"/><path stroke-linecap="round" d="M12 8v4l3 3"/></svg></div>
      </div>
      <div class="stat-card red">
        <div class="stat-card-accent"></div>
        <div class="stat-card-label">Spam Blocked</div>
        <div class="stat-card-value">1.2K</div>
        <div class="stat-card-sub"><span class="up" style="color:#dc2626;">🛡</span> protected</div>
        <div class="stat-card-icon"><svg width="36" height="36" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1"><path stroke-linecap="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg></div>
      </div>
    </div>

    <!-- Quick Generate -->
    <div class="gen-card">
      <div class="gen-card-header">
        <span class="gen-card-title">Quick Generate</span>
        <div class="live-pill"><div class="live-dot"></div>ACTIVE</div>
      </div>
      <div class="gen-card-body">
        <div class="domain-pills" id="dom-pills"></div>
        <div class="gen-email-row">
          <div class="gen-email-txt" id="gen-email">--</div>
          <button class="btn-copy" id="copy-btn" onclick="copyEmail()">
            <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" style="display:inline;margin-right:5px;vertical-align:middle;"><rect x="9" y="9" width="13" height="13" rx="2"/><path stroke-linecap="round" d="M5 15H4a2 2 0 01-2-2V4a2 2 0 012-2h9a2 2 0 012 2v1"/></svg>Copy
          </button>
          <button class="btn-sec" style="padding:8px 14px;" onclick="generateNew()">
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

    <!-- Two col -->
    <div class="two-col">

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
        <div class="addr-table">
          <div class="addr-head">
            <span>Address</span><span style="text-align:center;">Msgs</span><span>Status</span><span>Expires</span><span></span>
          </div>
          <div id="addr-rows"></div>
        </div>
      </div>

      <!-- Activity + Chart -->
      <div style="display:flex;flex-direction:column;gap:14px;">

        <!-- Mini chart -->
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

        <!-- Activity feed -->
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
/* ── CURSOR ── */
const cur=document.getElementById('cur');
document.addEventListener('mousemove',e=>{cur.style.left=e.clientX+'px';cur.style.top=e.clientY+'px';});
document.addEventListener('click',()=>{},true);
function bc(on){on?cur.classList.add('big'):cur.classList.remove('big');}
document.querySelectorAll('a,button,input,.sb-item,.addr-row,.activity-item,.tab,.notif-item,.ud-item,.dom-pill,.tb-user').forEach(el=>{
  el.addEventListener('mouseenter',()=>bc(true));
  el.addEventListener('mouseleave',()=>bc(false));
});

/* ── TOAST ── */
function toast(msg){
  document.getElementById('toast-msg').textContent=msg;
  const t=document.getElementById('toast');t.classList.add('show');
  setTimeout(()=>t.classList.remove('show'),2300);
}

/* ── DROPDOWNS ── */
let notifOpen=false, userOpen=false;
function toggleNotif(){
  notifOpen=!notifOpen; userOpen=false;
  document.getElementById('notif-dd').classList.toggle('show',notifOpen);
  document.getElementById('user-dd').classList.remove('show');
  if(notifOpen) document.getElementById('notif-dot').style.display='none';
}
function toggleUserDd(){
  userOpen=!userOpen; notifOpen=false;
  document.getElementById('user-dd').classList.toggle('show',userOpen);
  document.getElementById('notif-dd').classList.remove('show');
}
document.addEventListener('click',e=>{
  if(!e.target.closest('#notif-btn')&&!e.target.closest('#notif-dd')){document.getElementById('notif-dd').classList.remove('show');notifOpen=false;}
  if(!e.target.closest('.tb-user')&&!e.target.closest('#user-dd')){document.getElementById('user-dd').classList.remove('show');userOpen=false;}
});

/* ── GENERATE ── */
const DOMAINS=['dropit.io','burnbox.dev','zaptmp.net','voidmail.cc','mailsink.app'];
const ADJ=['silent','ghost','turbo','vapor','swift','lunar','neon','flux','rogue','stealth'];
const NOUN=['fox','wolf','tide','bolt','hawk','mint','storm','byte','nova','apex'];
let curDomain=DOMAINS[0], curEmail='', secs=600, timerInt;

function renderDomPills(){
  const c=document.getElementById('dom-pills'); c.innerHTML='';
  DOMAINS.forEach((d,i)=>{
    const b=document.createElement('div');
    b.className='dom-pill'+(i===0?' active':'');
    b.textContent='@'+d;
    b.onmouseenter=()=>bc(true); b.onmouseleave=()=>bc(false);
    b.onclick=()=>{
      document.querySelectorAll('.dom-pill').forEach(x=>x.classList.remove('active'));
      b.classList.add('active'); curDomain=d; generateNew();
    };
    c.appendChild(b);
  });
}

function generateNew(){
  const a=ADJ[Math.floor(Math.random()*ADJ.length)];
  const n=NOUN[Math.floor(Math.random()*NOUN.length)];
  const num=Math.floor(Math.random()*9000)+1000;
  curEmail=`${a}.${n}${num}@${curDomain}`;
  const el=document.getElementById('gen-email');
  el.classList.add('fading');
  setTimeout(()=>{el.textContent=curEmail;el.classList.remove('fading');},240);
  secs=600;
  const bar=document.getElementById('tbar');
  bar.style.animation='none'; void bar.offsetWidth;
  bar.style.animation='shrink 600s linear forwards';
  const ic=document.getElementById('ric');
  ic.style.transition='transform .4s'; ic.style.transform='rotate(360deg)';
  setTimeout(()=>{ic.style.transition='none'; ic.style.transform='rotate(0)';},420);
}

function copyEmail(){
  if(!curEmail) return;
  navigator.clipboard.writeText(curEmail).catch(()=>{});
  const btn=document.getElementById('copy-btn');
  btn.classList.add('ok');
  btn.innerHTML='<svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3" style="display:inline;margin-right:5px;vertical-align:middle;"><path stroke-linecap="round" d="M5 13l4 4L19 7"/></svg>Done';
  toast('Email copied to clipboard!');
  setTimeout(()=>{
    btn.classList.remove('ok');
    btn.innerHTML='<svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" style="display:inline;margin-right:5px;vertical-align:middle;"><rect x="9" y="9" width="13" height="13" rx="2"/><path stroke-linecap="round" d="M5 15H4a2 2 0 01-2-2V4a2 2 0 012-2h9a2 2 0 012 2v1"/></svg>Copy';
  },2100);
}

function startTimer(){
  if(timerInt) clearInterval(timerInt);
  timerInt=setInterval(()=>{
    if(secs>0) secs--;
    const m=String(Math.floor(secs/60)).padStart(2,'0');
    const s=String(secs%60).padStart(2,'0');
    document.getElementById('tnum').textContent=`${m}:${s}`;
  },1000);
}

/* ── ADDRESSES ── */
const ADDRS=[
  {email:'ghost.wolf2847@dropit.io',msgs:7,status:'active',expires:'8m',color:'#22c55e'},
  {email:'turbo.tide5512@burnbox.dev',msgs:2,status:'active',expires:'4m',color:'#22c55e'},
  {email:'neon.apex3301@voidmail.cc',msgs:0,status:'active',expires:'1m',color:'#f59e0b'},
  {email:'silent.fox9341@dropit.io',msgs:14,status:'expired',expires:'Expired',color:'#9CA3AF'},
  {email:'vapor.storm1192@zaptmp.net',msgs:3,status:'expired',expires:'Expired',color:'#9CA3AF'},
  {email:'lunar.byte4401@mailsink.app',msgs:1,status:'expired',expires:'Expired',color:'#9CA3AF'},
];

function renderAddrs(){
  const c=document.getElementById('addr-rows'); c.innerHTML='';
  ADDRS.forEach(a=>{
    const row=document.createElement('div');
    row.className='addr-row';
    row.innerHTML=`
      <div class="addr-email">${a.email}</div>
      <div class="addr-msgs" style="text-align:center;"><b>${a.msgs}</b></div>
      <div>
        <span class="addr-status ${a.status}" style="color:${a.color};border-color:${a.color};background:${a.status==='active'?'rgba(34,197,94,.06)':'#F9FAFB'};">
          <span style="display:inline-block;width:5px;height:5px;border-radius:50%;background:${a.color};"></span>
          ${a.status}
        </span>
      </div>
      <div class="addr-expires">${a.expires}</div>
      <div class="addr-action" style="display:flex;gap:4px;">
        <button class="icon-btn" onclick="copyAddr('${a.email}')" title="Copy">
          <svg width="11" height="11" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><rect x="9" y="9" width="13" height="13" rx="2"/><path stroke-linecap="round" d="M5 15H4a2 2 0 01-2-2V4a2 2 0 012-2h9a2 2 0 012 2v1"/></svg>
        </button>
        <button class="icon-btn danger" onclick="deleteAddr(this)" title="Delete">
          <svg width="11" height="11" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><polyline points="3 6 5 6 21 6"/><path stroke-linecap="round" d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6"/></svg>
        </button>
      </div>`;
    c.appendChild(row);
  });
}

function copyAddr(email){
  navigator.clipboard.writeText(email).catch(()=>{});
  toast('Address copied!');
}
function deleteAddr(btn){
  const row=btn.closest('.addr-row');
  row.style.opacity='.3';row.style.transition='opacity .3s';
  setTimeout(()=>row.remove(),300);
  toast('Address deleted.');
}

/* ── TABS ── */
function switchTab(el,filter){
  document.querySelectorAll('.tab').forEach(t=>t.classList.remove('active'));
  el.classList.add('active');
  const rows=document.querySelectorAll('.addr-row');
  rows.forEach(r=>{
    const statusEl=r.querySelector('.addr-status');
    if(!statusEl) return;
    const isActive=statusEl.classList.contains('active');
    if(filter==='all') r.style.display='';
    else if(filter==='active') r.style.display=isActive?'':'none';
    else r.style.display=!isActive?'':'none';
  });
}

/* ── CHART ── */
const DAYS=['Mon','Tue','Wed','Thu','Fri','Sat','Sun'];
const REC=[18,32,14,45,28,52,39];
const READ=[12,24,10,38,20,44,31];
function renderChart(){
  const c=document.getElementById('chart');
  const x=document.getElementById('chart-x');
  c.innerHTML=''; x.innerHTML='';
  const maxV=Math.max(...REC);
  DAYS.forEach((d,i)=>{
    const g=document.createElement('div');
    g.className='bar-group';
    const b1=document.createElement('div');
    b1.className='bar';b1.style.height=(REC[i]/maxV*100)+'%';b1.style.background='#FACC15';b1.title=`${d}: ${REC[i]} received`;
    const b2=document.createElement('div');
    b2.className='bar';b2.style.height=(READ[i]/maxV*100)+'%';b2.style.background='#2563EB';b2.title=`${d}: ${READ[i]} read`;
    g.appendChild(b1);g.appendChild(b2);c.appendChild(g);
    const lbl=document.createElement('div');
    lbl.className='chart-x-label';lbl.textContent=d;x.appendChild(lbl);
  });
}

/* ── ACTIVITY ── */
const ACTS=[
  {icon:'y',svg:'<path stroke-linecap="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>',msg:'New email from <b>Google</b> on ghost.wolf2847@dropit.io',time:'2 min ago'},
  {icon:'g',svg:'<path stroke-linecap="round" d="M12 4v16m8-8H4"/>',msg:'Generated new address <b>ghost.wolf2847@dropit.io</b>',time:'5 min ago'},
  {icon:'y',svg:'<path stroke-linecap="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>',msg:'OTP received from <b>Shopify</b> — code: 847291',time:'12 min ago'},
  {icon:'r',svg:'<polyline points="3 6 5 6 21 6"/><path stroke-linecap="round" d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6"/>',msg:'Address <b>silent.fox9341@dropit.io</b> expired and was deleted',time:'18 min ago'},
  {icon:'b',svg:'<path stroke-linecap="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>',msg:'Verification email confirmed from <b>Notion</b>',time:'35 min ago'},
  {icon:'g',svg:'<path stroke-linecap="round" d="M12 4v16m8-8H4"/>',msg:'Generated new address <b>turbo.tide5512@burnbox.dev</b>',time:'1 hr ago'},
  {icon:'y',svg:'<path stroke-linecap="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>',msg:'3 new emails on <b>neon.apex3301@voidmail.cc</b>',time:'2 hr ago'},
];
function renderActivity(){
  const c=document.getElementById('activity-list'); c.innerHTML='';
  ACTS.forEach(a=>{
    const item=document.createElement('div');
    item.className='activity-item';
    item.innerHTML=`
      <div class="act-icon ${a.icon}"><svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="${{y:'#EAB308',b:'#2563EB',g:'#16a34a',r:'#dc2626'}[a.icon]}" stroke-width="2">${a.svg}</svg></div>
      <div class="act-body"><div class="act-msg">${a.msg}</div><div class="act-time">${a.time}</div></div>`;
    c.appendChild(item);
  });
}

/* ── REFRESH ── */
function refreshDash(){
  toast('Dashboard refreshed!');
  const main=document.querySelector('.main');
  main.style.opacity='.6';main.style.transition='opacity .25s';
  setTimeout(()=>{main.style.opacity='1';},400);
}

/* ── INIT ── */
renderDomPills();
generateNew();
startTimer();
renderAddrs();
renderChart();
renderActivity();
</script>
</body>
</html>