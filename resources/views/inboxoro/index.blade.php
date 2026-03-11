{{-- resources/views/inboxoro/index.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<meta name="csrf-token" content="{{ csrf_token() }}">
{{-- Preload fonts for LCP boost --}}
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<title>inboxOro — Disposable Email</title>

{{-- Fonts: async-loaded to avoid render-blocking --}}
<link rel="preload" as="style" href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Outfit:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;500;700&display=swap" onload="this.onload=null;this.rel='stylesheet'">
<noscript><link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Outfit:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;500;700&display=swap"></noscript>

{{-- Inline critical CSS — eliminates render-blocking stylesheet --}}
<style>
:root{--Y:#FACC15;--B:#2563EB;--INK:#1F2937;--BG:#F8FAFC;--BD:#E5E7EB;--MU:#6B7280;}
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0;}
body{background:var(--BG);font-family:'Outfit',system-ui,sans-serif;color:var(--INK);overflow-x:hidden;}

/* ── NAV ── */
nav{position:sticky;top:0;z-index:100;background:var(--INK);display:flex;align-items:center;justify-content:space-between;padding:0 40px;height:52px;border-bottom:3px solid var(--Y);}
.nav-logo{font-family:'Bebas Neue',sans-serif;font-size:1.65rem;color:var(--Y);letter-spacing:.03em;line-height:1;display:flex;align-items:center;gap:2px;}
.nav-logo .oro{color:#fff;}
.nav-logo .badge{font-family:'JetBrains Mono',monospace;font-size:.5rem;font-weight:700;background:var(--Y);color:var(--INK);padding:2px 5px;letter-spacing:.08em;margin-left:6px;align-self:center;}
.nav-links{display:flex;gap:28px;align-items:center;}
.nav-links a{font-size:.76rem;font-weight:600;letter-spacing:.1em;text-transform:uppercase;color:#9CA3AF;text-decoration:none;transition:color .2s;}
.nav-links a:hover{color:var(--Y);}
.nav-cta{background:var(--Y);color:var(--INK);font-size:.74rem;font-weight:700;letter-spacing:.08em;text-transform:uppercase;padding:7px 16px;border:none;cursor:pointer;transition:background .15s;}
.nav-cta:hover{background:#fff;}

/* HERO STRIP */
.hero-strip{background:var(--INK);border-bottom:2px solid rgba(250,204,21,.15);padding:10px 40px;display:flex;align-items:center;justify-content:space-between;gap:16px;flex-wrap:wrap;position:relative;overflow:hidden;}
.h-tag{display:inline-flex;align-items:center;gap:6px;background:rgba(250,204,21,.1);border:1px solid rgba(250,204,21,.25);color:var(--Y);font-family:'JetBrains Mono',monospace;font-size:.62rem;font-weight:700;letter-spacing:.12em;text-transform:uppercase;padding:4px 10px;flex-shrink:0;}
.h-tag::before{content:'';width:5px;height:5px;background:var(--Y);border-radius:50%;animation:blink 1.2s step-end infinite;}
@keyframes blink{0%,100%{opacity:1}50%{opacity:0}}
.hero-copy-title{font-family:'Bebas Neue',sans-serif;font-size:clamp(1.3rem,2.5vw,1.75rem);color:#fff;letter-spacing:.04em;line-height:1.05;}
.hero-copy-title .gold{color:var(--Y);}
.hero-copy-sub{font-size:.74rem;color:#6B7280;margin-top:2px;line-height:1.45;max-width:460px;}
.hero-stats{display:flex;align-items:center;gap:8px;flex-shrink:0;}
.h-stat{display:flex;flex-direction:column;align-items:center;padding:6px 14px;border:1px solid rgba(255,255,255,.07);background:rgba(255,255,255,.03);}
.h-stat-n{font-family:'Bebas Neue',sans-serif;font-size:1.2rem;color:var(--Y);line-height:1;}
.h-stat-l{font-family:'JetBrains Mono',monospace;font-size:.55rem;color:#6B7280;letter-spacing:.07em;margin-top:1px;}
.hero-more-btn{display:inline-flex;align-items:center;gap:5px;font-family:'JetBrains Mono',monospace;font-size:.62rem;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--Y);background:transparent;border:1px solid rgba(250,204,21,.25);padding:5px 11px;cursor:pointer;transition:background .15s;flex-shrink:0;}
.hero-more-btn:hover{background:rgba(250,204,21,.1);}
.hero-more-btn.open svg{transform:rotate(180deg);}

/* HERO DETAIL EXPAND */
.hero-detail{background:var(--INK);border-bottom:3px solid var(--Y);overflow:hidden;max-height:0;transition:max-height .5s cubic-bezier(.4,0,.2,1);}
.hero-detail.open{max-height:280px;}
.hero-detail-inner{display:grid;grid-template-columns:auto 1fr 1fr;gap:36px;padding:28px 40px 32px;align-items:start;}
.hd-big{font-family:'Bebas Neue',sans-serif;font-size:clamp(3.5rem,6vw,5.5rem);line-height:.88;letter-spacing:.01em;}
.hd-big .gold{color:var(--Y);}
.hd-big .out{-webkit-text-stroke:2px rgba(255,255,255,.2);color:transparent;}
.hd-desc{color:#9CA3AF;font-size:.85rem;line-height:1.7;}
.hd-feats{display:flex;flex-direction:column;gap:9px;padding-top:4px;}
.hd-feat{display:flex;align-items:center;gap:9px;font-size:.78rem;color:#9CA3AF;}
.hd-feat svg{color:var(--Y);flex-shrink:0;}
.hd-feat b{color:#fff;font-weight:600;}

/* PAGE LAYOUT */
.page-wrap{display:grid;grid-template-columns:1fr 300px;max-width:1280px;margin:0 auto;padding:20px 40px 60px;}
.left-col{padding-right:48px;border-right:2px solid var(--BD);}
.right-col{padding-left:32px;display:flex;flex-direction:column;gap:20px;}
.sidebar-sticky{position:sticky;top:74px;display:flex;flex-direction:column;gap:20px;}

/* DOMAIN TABS */
.domain-tabs{display:flex;border:2px solid var(--INK);width:fit-content;overflow:hidden;flex-wrap:wrap;}
.dtab{font-family:'JetBrains Mono',monospace;font-size:.7rem;font-weight:500;padding:8px 14px;border:none;background:#fff;color:var(--MU);border-right:2px solid var(--INK);transition:background .15s,color .15s;white-space:nowrap;cursor:pointer;}
.dtab:last-child{border-right:none;}
.dtab:hover{background:#FEF9C3;color:var(--INK);}
.dtab.active{background:var(--INK);color:var(--Y);font-weight:700;}

/* GENERATOR */
.gen-block{border:2px solid var(--INK);background:#fff;margin-top:-2px;}
.gen-top{display:flex;align-items:center;justify-content:space-between;padding:16px 22px;border-bottom:2px solid var(--INK);background:#FAFAFA;}
.gen-label{font-family:'JetBrains Mono',monospace;font-size:.64rem;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--MU);}
.live-pill{display:flex;align-items:center;gap:6px;font-family:'JetBrains Mono',monospace;font-size:.64rem;font-weight:600;color:#16a34a;letter-spacing:.06em;}
.live-dot{width:7px;height:7px;background:#22c55e;border-radius:50%;animation:pg 2s ease-in-out infinite;}
@keyframes pg{0%,100%{box-shadow:0 0 0 0 rgba(34,197,94,.5)}50%{box-shadow:0 0 0 5px rgba(34,197,94,0)}}
.email-row{display:flex;align-items:center;gap:14px;padding:22px;border-bottom:2px solid var(--INK);}
.email-txt{font-family:'JetBrains Mono',monospace;font-size:clamp(.9rem,2.1vw,1.22rem);font-weight:700;color:var(--INK);flex:1;min-width:0;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;transition:opacity .3s;letter-spacing:-.01em;}
.email-txt.fading{opacity:.15;}
.btn-copy{background:var(--Y);color:var(--INK);font-size:.8rem;font-weight:700;letter-spacing:.05em;padding:10px 22px;border:2px solid var(--INK);flex-shrink:0;cursor:pointer;transition:background .15s,transform .1s,box-shadow .15s;box-shadow:3px 3px 0 var(--INK);}
.btn-copy:hover{transform:translate(-2px,-2px);box-shadow:5px 5px 0 var(--INK);}
.btn-copy:active{transform:translate(1px,1px);box-shadow:1px 1px 0 var(--INK);}
.btn-copy.ok{background:#22c55e;color:#fff;border-color:#16a34a;}
.gen-foot{display:flex;align-items:center;justify-content:space-between;padding:11px 22px;}
.timer-wrap{display:flex;align-items:center;gap:9px;}
.timer-track{width:110px;height:3px;background:var(--BD);}
.timer-fill{height:100%;background:var(--Y);}
.timer-num{font-family:'JetBrains Mono',monospace;font-size:.72rem;font-weight:700;color:var(--INK);}
.timer-lbl{font-size:.7rem;color:var(--MU);}
.btn-new{display:flex;align-items:center;gap:6px;background:none;border:2px solid var(--INK);color:var(--INK);font-size:.76rem;font-weight:600;padding:7px 14px;cursor:pointer;transition:background .15s,color .15s;box-shadow:2px 2px 0 var(--INK);}
.btn-new:hover{background:var(--INK);color:var(--Y);}
.btn-new:hover svg{transform:rotate(180deg);}
.btn-new svg{transition:transform .4s;}

/* INBOX */
.inbox-wrap{margin-top:24px;}
.sec-header{display:flex;align-items:center;justify-content:space-between;margin-bottom:12px;gap:12px;}
.sec-title{font-family:'Bebas Neue',sans-serif;font-size:1.65rem;letter-spacing:.04em;}
.sec-meta{font-family:'JetBrains Mono',monospace;font-size:.65rem;color:var(--MU);}
.ib-toolbar-btn{display:inline-flex;align-items:center;justify-content:center;width:32px;height:32px;border:2px solid var(--INK);background:#fff;cursor:pointer;transition:background .12s,color .12s;color:var(--INK);box-shadow:2px 2px 0 var(--INK);}
.ib-toolbar-btn:hover{background:var(--INK);color:var(--Y);}
.inbox-shell{display:flex;border:2px solid var(--INK);background:#fff;min-height:460px;max-height:520px;}
.inbox-list-panel{width:320px;flex-shrink:0;border-right:2px solid var(--INK);display:flex;flex-direction:column;overflow:hidden;}
.inbox-search{display:flex;align-items:center;gap:8px;padding:10px 14px;border-bottom:1px solid var(--BD);background:#FAFAFA;}
.inbox-search input{border:none;outline:none;background:transparent;font-family:'Outfit',sans-serif;font-size:.82rem;color:var(--INK);flex:1;}
.inbox-search input::placeholder{color:#C0C0C0;}
#email-list{flex:1;overflow-y:auto;overscroll-behavior:contain;}
#email-list::-webkit-scrollbar{width:4px;}
#email-list::-webkit-scrollbar-thumb{background:#E5E7EB;border-radius:2px;}
.erow{display:flex;align-items:flex-start;gap:10px;padding:13px 14px;border-bottom:1px solid #F3F4F6;transition:background .12s;position:relative;cursor:pointer;}
.erow:last-child{border-bottom:none;}
.erow:hover{background:#FFFBEB;}
.erow.selected{background:#FEF9C3;border-left:3px solid var(--Y);}
.erow.unread{background:#FFFDE7;}
.erow.unread .e-sender{font-weight:700;}
.erow.unread .e-subject{font-weight:600;color:var(--INK);}
.erow-left{display:flex;flex-direction:column;align-items:center;gap:6px;flex-shrink:0;padding-top:2px;}
.erow-avatar{width:32px;height:32px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-family:'Bebas Neue',sans-serif;font-size:1rem;color:#fff;flex-shrink:0;border:2px solid var(--INK);}
.udot-sm{width:7px;height:7px;background:var(--Y);border-radius:50%;border:1.5px solid var(--INK);flex-shrink:0;}
.rdot-sm{width:7px;height:7px;flex-shrink:0;}
.erow-body{flex:1;min-width:0;}
.erow-top-row{display:flex;align-items:baseline;justify-content:space-between;gap:4px;margin-bottom:2px;}
.e-sender{font-size:.8rem;color:var(--INK);white-space:nowrap;overflow:hidden;text-overflow:ellipsis;max-width:140px;}
.e-time{font-family:'JetBrains Mono',monospace;font-size:.62rem;color:var(--MU);flex-shrink:0;}
.e-subject{font-size:.78rem;color:var(--INK);white-space:nowrap;overflow:hidden;text-overflow:ellipsis;font-weight:500;margin-bottom:2px;}
.e-preview{font-size:.72rem;color:#9CA3AF;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;}
.e-attach-badge{display:inline-flex;align-items:center;gap:3px;font-size:.62rem;color:var(--MU);margin-top:3px;}
.inbox-list-footer{padding:8px 14px;border-top:2px solid var(--INK);background:#FAFAFA;font-family:'JetBrains Mono',monospace;font-size:.62rem;color:var(--MU);display:flex;gap:6px;align-items:center;flex-shrink:0;}
.inbox-detail-panel{flex:1;display:flex;flex-direction:column;overflow:hidden;}
.detail-empty{flex:1;display:flex;flex-direction:column;align-items:center;justify-content:center;gap:12px;color:#C0C0C0;}
.detail-empty p{font-size:.85rem;font-weight:500;color:#C0C0C0;}
.detail-content{flex:1;display:flex;flex-direction:column;overflow:hidden;}
.detail-toolbar{display:flex;align-items:center;justify-content:space-between;gap:8px;padding:10px 18px;border-bottom:2px solid var(--INK);background:#FAFAFA;flex-shrink:0;}
.detail-toolbar-left{display:flex;align-items:center;gap:6px;}
.dtl-btn{display:inline-flex;align-items:center;gap:5px;font-size:.75rem;font-weight:600;color:var(--INK);background:#fff;border:1.5px solid var(--INK);padding:5px 11px;cursor:pointer;transition:background .12s,color .12s;}
.dtl-btn:hover{background:var(--INK);color:var(--Y);}
.dtl-btn.danger:hover{background:#dc2626;border-color:#dc2626;color:#fff;}
.detail-header{padding:16px 20px 12px;border-bottom:1px solid var(--BD);flex-shrink:0;}
.detail-subject{font-family:'Bebas Neue',sans-serif;font-size:1.4rem;letter-spacing:.03em;color:var(--INK);margin-bottom:10px;line-height:1.1;}
.detail-meta-row{display:flex;align-items:center;gap:10px;flex-wrap:wrap;}
.detail-avatar{width:36px;height:36px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-family:'Bebas Neue',sans-serif;font-size:1.1rem;color:#fff;border:2px solid var(--INK);flex-shrink:0;}
.detail-meta-info{flex:1;min-width:0;}
.detail-from-name{font-size:.85rem;font-weight:700;color:var(--INK);}
.detail-from-email{font-size:.75rem;color:var(--MU);font-family:'JetBrains Mono',monospace;}
.detail-to-line{font-size:.72rem;color:var(--MU);margin-top:2px;}
.detail-timestamp{font-family:'JetBrains Mono',monospace;font-size:.68rem;color:var(--MU);white-space:nowrap;}
.detail-body{flex:1;overflow-y:auto;padding:20px;font-size:.875rem;line-height:1.75;color:#374151;overscroll-behavior:contain;}
.detail-body::-webkit-scrollbar{width:4px;}
.detail-body::-webkit-scrollbar-thumb{background:#E5E7EB;border-radius:2px;}
.detail-body p{margin-bottom:12px;}
.detail-body .otp-box{display:inline-block;font-family:'JetBrains Mono',monospace;font-size:2rem;font-weight:700;letter-spacing:.2em;color:var(--INK);background:var(--Y);padding:12px 24px;border:2px solid var(--INK);box-shadow:4px 4px 0 var(--INK);margin:12px 0;}
.detail-body .verify-btn{display:inline-block;background:var(--B);color:#fff;font-weight:700;font-size:.85rem;padding:10px 24px;border:2px solid var(--INK);text-decoration:none;margin:8px 0;box-shadow:3px 3px 0 var(--INK);}
.attach-section{padding:14px 20px;border-top:2px solid var(--INK);background:#FAFAFA;flex-shrink:0;}
.attach-title{font-family:'JetBrains Mono',monospace;font-size:.66rem;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--MU);margin-bottom:10px;}
.attach-grid{display:flex;flex-wrap:wrap;gap:10px;}
.attach-card{display:flex;align-items:center;gap:10px;border:2px solid var(--INK);background:#fff;padding:10px 14px;cursor:pointer;transition:background .12s,box-shadow .12s,transform .12s;box-shadow:2px 2px 0 var(--INK);min-width:180px;max-width:240px;}
.attach-card:hover{background:#FEF9C3;box-shadow:4px 4px 0 var(--INK);transform:translate(-1px,-1px);}
.attach-icon{width:36px;height:36px;border-radius:4px;display:flex;align-items:center;justify-content:center;flex-shrink:0;font-size:.55rem;font-weight:800;font-family:'JetBrains Mono',monospace;letter-spacing:.04em;}
.attach-info{flex:1;min-width:0;}
.attach-name{font-size:.78rem;font-weight:700;color:var(--INK);white-space:nowrap;overflow:hidden;text-overflow:ellipsis;}
.attach-size{font-size:.68rem;color:var(--MU);font-family:'JetBrains Mono',monospace;margin-top:1px;}
.no-mail{display:flex;flex-direction:column;align-items:center;justify-content:center;padding:40px 20px;gap:10px;color:#D1D5DB;}
.no-mail p{font-size:.82rem;font-weight:500;color:var(--MU);}
.feat-strip{display:grid;grid-template-columns:repeat(3,1fr);border:2px solid var(--INK);margin-top:32px;}
.feat-item{padding:20px;border-right:2px solid var(--INK);transition:background .15s;}
.feat-item:last-child{border-right:none;}
.feat-item:hover{background:var(--Y);}
.feat-ic{color:var(--B);margin-bottom:10px;}
.feat-item:hover .feat-ic{color:var(--INK);}
.feat-t{font-family:'Bebas Neue',sans-serif;font-size:1rem;letter-spacing:.04em;margin-bottom:5px;}
.feat-d{font-size:.76rem;color:var(--MU);line-height:1.5;}
.feat-item:hover .feat-d{color:var(--INK);}
.ad-slot{border:2px dashed #D1D5DB;background:#FAFAFA;display:flex;flex-direction:column;align-items:center;justify-content:center;gap:6px;text-align:center;}
.ad-lbl{font-family:'JetBrains Mono',monospace;font-size:.58rem;font-weight:700;letter-spacing:.14em;text-transform:uppercase;color:#9CA3AF;}
.ad-sz{font-family:'Bebas Neue',sans-serif;font-size:1.25rem;color:#D1D5DB;letter-spacing:.05em;}
.ad-nt{font-size:.66rem;color:#C0C0C0;font-weight:500;}
.sidebar-stat{border:2px solid var(--INK);padding:16px 18px;background:#fff;}
.stat-n{font-family:'Bebas Neue',sans-serif;font-size:2.2rem;color:var(--INK);line-height:1;}
.stat-n span{color:var(--Y);}
.stat-d{font-size:.72rem;color:var(--MU);font-weight:500;margin-top:3px;}
.pro-card{border:2px solid var(--INK);padding:18px 20px;background:#fff;}
.pro-t{font-family:'Bebas Neue',sans-serif;font-size:.95rem;letter-spacing:.05em;margin-bottom:8px;}
.pro-d{font-size:.73rem;color:var(--MU);line-height:1.55;}
.pro-link{font-family:'JetBrains Mono',monospace;font-size:.66rem;font-weight:700;color:var(--B);text-decoration:none;letter-spacing:.06em;display:inline-block;margin-top:12px;}
.pro-link:hover{text-decoration:underline;}
footer{background:var(--INK);padding:26px 40px;display:flex;align-items:center;justify-content:space-between;border-top:3px solid var(--Y);}
.foot-logo{font-family:'Bebas Neue',sans-serif;font-size:1.4rem;color:var(--Y);letter-spacing:.03em;}
.foot-logo .oro{color:#fff;}
.foot-links{display:flex;gap:22px;}
.foot-links a{font-size:.73rem;color:#6B7280;text-decoration:none;font-weight:500;}
.foot-links a:hover{color:var(--Y);}
.foot-st{font-family:'JetBrains Mono',monospace;font-size:.68rem;color:#22c55e;display:flex;align-items:center;gap:5px;}
#toast{position:fixed;bottom:28px;right:32px;background:var(--INK);color:var(--Y);font-family:'JetBrains Mono',monospace;font-size:.76rem;font-weight:700;letter-spacing:.05em;padding:11px 18px;border:2px solid var(--Y);box-shadow:4px 4px 0 var(--Y);z-index:999;transform:translateY(70px);opacity:0;transition:transform .35s cubic-bezier(.34,1.56,.64,1),opacity .3s;display:flex;align-items:center;gap:8px;}
#toast.show{transform:translateY(0);opacity:1;}
.rv{opacity:0;transform:translateY(12px);transition:opacity .55s ease,transform .55s ease;}
.rv.in{opacity:1;transform:translateY(0);}
@media(max-width:900px){
  .page-wrap{grid-template-columns:1fr;padding:16px 16px 40px;}
  .left-col{padding-right:0;border-right:none;}
  .right-col{padding-left:0;}
  .sidebar-sticky{position:static;flex-direction:row;flex-wrap:wrap;}
  nav{padding:0 16px;}
  .nav-links{display:none;}
  footer{flex-direction:column;gap:14px;text-align:center;padding:22px 16px;}
  .feat-strip{grid-template-columns:1fr;}
  .feat-item{border-right:none;border-bottom:2px solid var(--INK);}
  .feat-item:last-child{border-bottom:none;}
  .inbox-shell{flex-direction:column;max-height:none;}
  .inbox-list-panel{width:100%;border-right:none;border-bottom:2px solid var(--INK);max-height:260px;}
  .hero-strip{padding:10px 16px;}
  .hero-stats{display:none;}
  .hero-detail-inner{grid-template-columns:1fr;padding:20px 16px;}
  .hd-big{font-size:3rem;}
}
</style>
</head>
<body>

<div id="toast">
  <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" d="M5 13l4 4L19 7"/></svg>
  COPIED
</div>

{{-- ══ NAV ══ --}}
<nav>
  <div class="nav-logo">inbox<span class="oro">Oro</span><span class="badge">FREE</span></div>
  <div class="nav-links">
    <a href="#">How it works</a>
    <a href="#">Domains</a>
    <a href="#">API</a>
    <button class="nav-cta">Get Pro</button>
  </div>
</nav>

{{-- ══ HERO STRIP ══ --}}
<div class="hero-strip">
  <div style="display:flex;align-items:center;gap:16px;flex-wrap:wrap;">
    <div class="h-tag">Instant · Anonymous · Free</div>
    <div>
      <div class="hero-copy-title">Disposable <span class="gold">Temp Email</span> — No signup, no trace, no spam.</div>
      <div class="hero-copy-sub">Generate a burner address in one click. Receive OTPs, verification links &amp; sign-up codes — then vanish without a trace.</div>
    </div>
  </div>
  <div style="display:flex;align-items:center;gap:10px;">
    <div class="hero-stats">
      <div class="h-stat"><div class="h-stat-n">12M+</div><div class="h-stat-l">Emails Today</div></div>
      <div class="h-stat"><div class="h-stat-n">0 Logs</div><div class="h-stat-l">Zero Tracking</div></div>
      <div class="h-stat"><div class="h-stat-n">10 Min</div><div class="h-stat-l">Auto Expiry</div></div>
      <div class="h-stat"><div class="h-stat-n">{{ $domains->count() }}</div><div class="h-stat-l">Domains</div></div>
    </div>
    <button class="hero-more-btn" id="more-btn" onclick="toggleHero()">
      About
      <svg width="11" height="11" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M19 9l-7 7-7-7"/></svg>
    </button>
  </div>
</div>

{{-- ══ EXPANDABLE HERO ══ --}}
<div class="hero-detail" id="hero-detail">
  <div class="hero-detail-inner">
    <div class="hd-big" style="color:#fff;">
      <span class="out">TEMP</span><br>
      <span class="gold">EMAIL</span><br>
      MACHINE
    </div>
    <div>
      <p class="hd-desc" style="margin-bottom:16px;">inboxOro gives you a real, working disposable email address that self-destructs. Use it to sign up for anything without exposing your real inbox to spam, trackers, or data leaks.</p>
      <p class="hd-desc">Built for developers, privacy advocates, and anyone who's tired of inbox clutter. No registration required — just generate and go.</p>
    </div>
    <div class="hd-feats">
      <div class="hd-feat"><svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg><span><b>Instant</b> — new address under 50ms</span></div>
      <div class="hd-feat"><svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg><span><b>Zero trace</b> — no IP logs, no tracking</span></div>
      <div class="hd-feat"><svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><path stroke-linecap="round" d="M12 8v4l3 3"/></svg><span><b>Auto-destruct</b> — expires in 10 minutes</span></div>
      <div class="hd-feat"><svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg><span><b>Full inbox</b> — read, download, forward</span></div>
      <div class="hd-feat"><svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/></svg><span><b>API access</b> — integrate in your apps</span></div>
    </div>
  </div>
</div>

{{-- ══ PAGE WRAP ══ --}}
<div class="page-wrap">

  {{-- LEFT COLUMN --}}
  <div class="left-col">

    <div class="domain-tabs" id="dtabs">
      @foreach($domains as $i => $d)
        <button class="dtab {{ $i === 0 ? 'active' : '' }}"
                data-domain="{{ $d->domain }}"
                onclick="selectDomain(this, '{{ $d->domain }}')">
          {{ $d->domain }}{{ $d->is_premium ? ' ★' : '' }}
        </button>
      @endforeach
    </div>

    {{-- Generator --}}
    <div class="gen-block">
      <div class="gen-top">
        <span class="gen-label">// your burner address</span>
        <div class="live-pill"><div class="live-dot"></div>ACTIVE</div>
      </div>
      <div class="email-row">
        <div class="email-txt" id="edisplay">{{ $mailbox->email }}</div>
        <button class="btn-copy" id="cbtn" onclick="copyEmail()">
          <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" style="display:inline;margin-right:5px;vertical-align:middle;"><rect x="9" y="9" width="13" height="13" rx="2"/><path stroke-linecap="round" d="M5 15H4a2 2 0 01-2-2V4a2 2 0 012-2h9a2 2 0 012 2v1"/></svg>Copy
        </button>
      </div>
      <div class="gen-foot">
        <div class="timer-wrap">
          <span class="timer-lbl">Expires</span>
          <div class="timer-track">
            {{-- Width driven by JS countdown using server-provided seconds --}}
            <div class="timer-fill" id="tbar" style="width:100%;transition:width 1s linear;"></div>
          </div>
          <span class="timer-num" id="tnum">{{ gmdate('i:s', $mailbox->secondsRemaining()) }}</span>
        </div>
        <button class="btn-new" id="btn-new-addr" onclick="generateNew()">
          <svg id="ric" width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
          New Address
        </button>
      </div>
    </div>

    {{-- INBOX --}}
    <div class="inbox-wrap">
      <div class="sec-header">
        <div style="display:flex;align-items:baseline;gap:12px;flex-wrap:wrap;">
          <span class="sec-title">
            Inbox&nbsp;<span style="color:var(--Y);font-size:1.1rem;" id="ucnt">
              {{ $inbox['unread'] > 0 ? '('.$inbox['unread'].')' : '' }}
            </span>
          </span>
          <span class="sec-meta">// live · Reverb realtime</span>
        </div>
        <div style="display:flex;gap:6px;">
          <button class="ib-toolbar-btn" onclick="refreshInbox()" title="Refresh">
            <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
          </button>
          <button class="ib-toolbar-btn" onclick="markAllRead()" title="Mark all read">
            <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
          </button>
          <button class="ib-toolbar-btn" onclick="deleteAllMsgs()" title="Delete all">
            <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><polyline points="3 6 5 6 21 6"/><path stroke-linecap="round" d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6m5 0V4a1 1 0 011-1h2a1 1 0 011 1v2"/></svg>
          </button>
        </div>
      </div>

      <div class="inbox-shell">
        <div class="inbox-list-panel">
          <div class="inbox-search">
            <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="#9CA3AF" stroke-width="2.2"><circle cx="11" cy="11" r="8"/><path stroke-linecap="round" d="M21 21l-4.35-4.35"/></svg>
            <input id="search-inp" type="text" placeholder="Search messages..." oninput="debounceSearch(this.value)"/>
          </div>
          <div id="email-list">
            {{-- Server-rendered first batch (SSR for speed) --}}
            @forelse($inbox['emails'] as $em)
              @include('inboxoro.partials.email-row', ['em' => $em])
            @empty
              <div class="no-mail">
                <svg width="40" height="40" fill="none" viewBox="0 0 24 24" stroke="#D1D5DB" stroke-width="1.2"><path stroke-linecap="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                <p>No messages yet</p>
              </div>
            @endforelse
          </div>
          <div class="inbox-list-footer">
            <span id="list-count">{{ $inbox['total'] }} message{{ $inbox['total'] !== 1 ? 's' : '' }}</span>
            &nbsp;·&nbsp;expires&nbsp;<b id="itimer" style="color:var(--INK);">{{ gmdate('i:s', $mailbox->secondsRemaining()) }}</b>
          </div>
        </div>

        <div class="inbox-detail-panel">
          <div class="detail-empty" id="detail-empty">
            <svg width="48" height="48" fill="none" viewBox="0 0 24 24" stroke="#D1D5DB" stroke-width="1"><path stroke-linecap="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
            <p>Select a message to read</p>
          </div>
          <div class="detail-content" id="detail-content" style="display:none;"></div>
        </div>
      </div>
    </div>

    {{-- Ad leaderboard --}}
    <div class="ad-slot rv" style="height:96px;margin-top:28px;">
      <div class="ad-lbl">Advertisement</div>
      <div class="ad-sz">728 × 90</div>
      <div class="ad-nt">Google AdSense — Leaderboard Banner</div>
    </div>

    {{-- Features --}}
    <div class="feat-strip rv">
      <div class="feat-item">
        <div class="feat-ic"><svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg></div>
        <div class="feat-t">Instant Generate</div>
        <div class="feat-d">New burner in under 50ms. No account, no verification, no friction.</div>
      </div>
      <div class="feat-item">
        <div class="feat-ic"><svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg></div>
        <div class="feat-t">Zero Trace</div>
        <div class="feat-d">No IP logs. No tracking. Emails self-destruct. Your real inbox stays clean.</div>
      </div>
      <div class="feat-item">
        <div class="feat-ic"><svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path stroke-linecap="round" d="M12 8v4l3 3"/></svg></div>
        <div class="feat-t">10-Min Lifespan</div>
        <div class="feat-d">Addresses expire automatically. Extend free, or generate a fresh one.</div>
      </div>
    </div>

  </div>{{-- /left-col --}}

  {{-- RIGHT SIDEBAR --}}
  <div class="right-col">
    <div class="sidebar-sticky">
      <div class="sidebar-stat">
        <div class="stat-n">12<span>M+</span></div>
        <div class="stat-d">Emails generated today</div>
      </div>
      <div class="ad-slot" style="height:274px;">
        <div class="ad-lbl">Advertisement</div>
        <div class="ad-sz">300 × 250</div>
        <div class="ad-nt">Google AdSense<br>Medium Rectangle</div>
      </div>
      <div class="pro-card">
        <div class="pro-t">💡 Pro Tip</div>
        <div class="pro-d">Use a new address for every signup. Spam never reaches your real inbox again.</div>
        <a href="#" class="pro-link">GET PRO API →</a>
      </div>
      <div class="ad-slot rv" style="height:320px;">
        <div class="ad-lbl">Advertisement</div>
        <div class="ad-sz">300 × 600</div>
        <div class="ad-nt">Google AdSense<br>Half Page / Large</div>
      </div>
    </div>
  </div>

</div>{{-- /page-wrap --}}

<footer>
  <div class="foot-logo">inbox<span class="oro">Oro</span></div>
  <div class="foot-links">
    <a href="#">Privacy</a><a href="#">Terms</a><a href="#">Domains</a><a href="#">API</a><a href="#">Status</a>
  </div>
  <div class="foot-st">
    <div style="width:6px;height:6px;background:#22c55e;border-radius:50%;"></div>
    All systems operational
  </div>
</footer>

{{-- ══ SERVER-SIDE BOOTSTRAP DATA ══
     Inlined as JSON — avoids a second HTTP round-trip for JS initialization.
     Only non-sensitive metadata is exposed here.
--}}


<script>
const INBOX_ORO = Object.freeze({
  mailboxId:      {{ $mailbox->id }},
  email:          {{ json_encode($mailbox->email) }},
  expiresAt:      {{ json_encode($mailbox->expires_at->toISOString()) }},
  expiresIn:      {{ $mailbox->secondsRemaining() }},   // seconds
  csrfToken:      {{ json_encode(csrf_token()) }},
  routes: {
    generate:     {{ json_encode(route('mailbox.generate')) }},
    inbox:        {{ json_encode(route('mailbox.inbox')) }},
    emailBase:    {{ json_encode(url('/mailbox/email')) }},
    markAllRead:  {{ json_encode(route('mailbox.markAllRead')) }},
    destroyAll:   {{ json_encode(route('mailbox.destroyAll')) }},
  },
  reverb: {
    key:          {{ json_encode(config('broadcasting.connections.reverb.key')) }},
    host:         {{ json_encode(config('broadcasting.connections.reverb.options.host')) }},
    port:         {{ (int) config('broadcasting.connections.reverb.options.port') }},
    scheme:       {{ json_encode(config('broadcasting.connections.reverb.options.scheme', 'https')) }},
    channel:      "mailbox.{{ $mailbox->id }}",
  },
});
</script>

{{-- Pusher JS (Reverb uses Pusher protocol) — loaded async, non-blocking --}}
<script src="https://js.pusher.com/8.2.0/pusher.min.js" defer></script>
<script>
/* ═══════════════════════════════════════════════════════════════════
   inboxOro — Client JS
   All API calls use fetch() + CSRF token.
   Reverb (WebSocket) handles real-time; polling is fallback only.
═══════════════════════════════════════════════════════════════════ */

// ── State ─────────────────────────────────────────────────────────
let currentEmail  = INBOX_ORO.email;
let currentDomain = currentEmail.split('@')[1];
let selectedId    = null;
let searchTimer   = null;
let secsRemaining = INBOX_ORO.expiresIn;
let timerInterval = null;

// ── Helpers ───────────────────────────────────────────────────────
const $ = id => document.getElementById(id);

function api(url, opts = {}) {
  return fetch(url, {
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN':  INBOX_ORO.csrfToken,
      'Accept':        'application/json',
      ...opts.headers,
    },
    ...opts,
  });
}

function showToast(msg = 'COPIED') {
  const t = $('toast');
  t.querySelector('span') && (t.querySelector('span').textContent = msg);
  t.classList.add('show');
  setTimeout(() => t.classList.remove('show'), 2500);
}

// ── Hero expand ───────────────────────────────────────────────────
function toggleHero() {
  const d = $('hero-detail');
  const b = $('more-btn');
  d.classList.toggle('open');
  b.classList.toggle('open');
}

// ── Domain selection ──────────────────────────────────────────────
function selectDomain(btn, domain) {
  document.querySelectorAll('.dtab').forEach(b => b.classList.remove('active'));
  btn.classList.add('active');
  currentDomain = domain;
  generateNew(domain);
}

// ── Generate new address ──────────────────────────────────────────
async function generateNew(domain = null) {
    
  const $ = id => document.getElementById(id);

  const btn = $('btn-new-addr');
  btn.disabled = true;

  const el = $('edisplay');
  el.classList.add('fading');

  try {
    const res  = await api(INBOX_ORO.routes.generate, {
      method: 'POST',
      body:   JSON.stringify({ domain: domain || currentDomain }),
    });
    const data = await res.json();

    console.log(res);
    alert('dsk');
    currentEmail  = data.email;
    currentDomain = currentEmail.split('@')[1];

    setTimeout(() => {
      el.textContent = currentEmail;
      el.classList.remove('fading');
    }, 260);

    // Reset timer
    secsRemaining = data.expires_in;
    updateTimerDisplay();
    resetTimerBar(data.expires_in);

    // Reconnect Reverb to new mailbox channel
    reconnectReverb(data.mailbox_id);

    // Clear inbox
    $('email-list').innerHTML = '<div class="no-mail"><p>No messages yet</p></div>';
    $('detail-empty').style.display  = 'flex';
    $('detail-content').style.display = 'none';
    selectedId = null;
    $('ucnt').textContent = '';
    $('list-count').textContent = '0 messages';

    // Spin the refresh icon
    const ic = $('ric');
    ic.style.transform = 'rotate(360deg)';
    ic.style.transition = 'transform .45s ease';
    setTimeout(() => { ic.style.transition = 'none'; ic.style.transform = 'rotate(0)'; }, 460);

  } catch(e) {
    console.error('Generate failed:', e);
  } finally {
    btn.disabled = false;
  }
}

// ── Copy email ────────────────────────────────────────────────────
function copyEmail() {
  navigator.clipboard.writeText(currentEmail).catch(() => {});
  const btn = $('cbtn');
  btn.classList.add('ok');
  btn.innerHTML = '<svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3" style="display:inline;margin-right:5px;vertical-align:middle;"><path stroke-linecap="round" d="M5 13l4 4L19 7"/></svg>Done';
  showToast('COPIED');
  setTimeout(() => {
    btn.classList.remove('ok');
    btn.innerHTML = '<svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" style="display:inline;margin-right:5px;vertical-align:middle;"><rect x="9" y="9" width="13" height="13" rx="2"/><path stroke-linecap="round" d="M5 15H4a2 2 0 01-2-2V4a2 2 0 012-2h9a2 2 0 012 2v1"/></svg>Copy';
  }, 2200);
}

// ── Timer ─────────────────────────────────────────────────────────
function pad(n) { return String(n).padStart(2, '0'); }

function updateTimerDisplay() {
  const m = Math.floor(secsRemaining / 60);
  const s = secsRemaining % 60;
  const str = `${pad(m)}:${pad(s)}`;
  $('tnum').textContent  = str;
  $('itimer').textContent = str;
}

function resetTimerBar(totalSecs) {
  const bar = $('tbar');
  // Using JS-driven width instead of CSS animation — gives us precise server-sync
  bar.style.transition = 'none';
  bar.style.width = '100%';
  setTimeout(() => {
    bar.style.transition = `width ${totalSecs}s linear`;
    bar.style.width = '0%';
  }, 50);
}

function startTimer() {
  if (timerInterval) clearInterval(timerInterval);
  timerInterval = setInterval(() => {
    if (secsRemaining > 0) {
      secsRemaining--;
      updateTimerDisplay();
    } else {
      clearInterval(timerInterval);
      handleExpiry();
    }
  }, 1000);
}

function handleExpiry() {
  $('edisplay').textContent = 'Address expired';
  $('edisplay').style.opacity = '.4';
  showToast('ADDRESS EXPIRED');
}

// ── Inbox rendering ───────────────────────────────────────────────
function renderEmailRow(em) {
  const hasA = em.attachments_count > 0;
  const isUnread = !em.is_read;
  return `
    <div class="erow${isUnread ? ' unread' : ''}${em.id === selectedId ? ' selected' : ''}"
         data-id="${em.id}" onclick="openEmail(${em.id})">
      <div class="erow-left">
        <div class="erow-avatar" style="background:${em.avatar_color ?? '#4B5563'};">${em.avatar_letter ?? '?'}</div>
        <div class="${isUnread ? 'udot-sm' : 'rdot-sm'}"></div>
      </div>
      <div class="erow-body">
        <div class="erow-top-row">
          <span class="e-sender">${escHtml(em.sender)}</span>
          <span class="e-time">${escHtml(em.time_ago ?? em.received_at ?? '')}</span>
        </div>
        <div class="e-subject">${escHtml(em.subject)}</div>
        <div class="e-preview">${escHtml(em.preview ?? '')}</div>
        ${hasA ? `<div class="e-attach-badge"><svg width="11" height="11" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"/></svg>${em.attachments_count} attachment${em.attachments_count > 1 ? 's' : ''}</div>` : ''}
      </div>
    </div>`;
}

function escHtml(s) {
  return String(s).replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;');
}

function updateUnreadBadge(count) {
  $('ucnt').textContent = count > 0 ? `(${count})` : '';
}

// ── Open email ────────────────────────────────────────────────────
async function openEmail(id) {
  selectedId = id;
  // Highlight selected row
  document.querySelectorAll('.erow').forEach(r => {
    r.classList.toggle('selected', parseInt(r.dataset.id) === id);
    if (parseInt(r.dataset.id) === id) {
      r.classList.remove('unread');
      const dot = r.querySelector('.udot-sm');
      if (dot) dot.className = 'rdot-sm';
    }
  });

  $('detail-empty').style.display  = 'none';
  $('detail-content').style.display = 'flex';
  $('detail-content').innerHTML = '<div style="flex:1;display:flex;align-items:center;justify-content:center;color:#D1D5DB;">Loading…</div>';

  try {
    const res  = await api(`${INBOX_ORO.routes.emailBase}/${id}`);
    const em   = await res.json();

    updateUnreadBadge(em.unread_count);

    const attachHtml = em.attachments && em.attachments.length
      ? `<div class="attach-section">
           <div class="attach-title">
             <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="display:inline;vertical-align:middle;margin-right:4px;"><path stroke-linecap="round" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"/></svg>
             ${em.attachments.length} Attachment${em.attachments.length > 1 ? 's' : ''}
           </div>
           <div class="attach-grid">
             ${em.attachments.map(a => `
               <a class="attach-card" href="${a.download_url}" download="${escHtml(a.file_name)}">
                 <div class="attach-icon" style="background:${a.icon_style.bg};color:${a.icon_style.color};">${a.extension}</div>
                 <div class="attach-info">
                   <div class="attach-name">${escHtml(a.file_name)}</div>
                   <div class="attach-size">${escHtml(a.size)}</div>
                 </div>
                 <div class="attach-dl">
                   <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2"><path stroke-linecap="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                 </div>
               </a>`).join('')}
           </div>
         </div>`
      : '';

    $('detail-content').innerHTML = `
      <div class="detail-toolbar">
        <div class="detail-toolbar-left">
          <button class="dtl-btn" onclick="markUnreadAction(${em.id})">
            <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
            Mark Unread
          </button>
        </div>
        <button class="dtl-btn danger" onclick="deleteEmail(${em.id})">
          <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><polyline points="3 6 5 6 21 6"/><path stroke-linecap="round" d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6m5 0V4a1 1 0 011-1h2a1 1 0 011 1v2"/></svg>
          Delete
        </button>
      </div>
      <div class="detail-header">
        <div class="detail-subject">${escHtml(em.subject)}</div>
        <div class="detail-meta-row">
          <div class="detail-avatar" style="background:${em.avatar_color};">${em.avatar_letter}</div>
          <div class="detail-meta-info">
            <div class="detail-from-name">${escHtml(em.sender)}</div>
            <div class="detail-from-email">&lt;${escHtml(em.sender_email)}&gt;</div>
            <div class="detail-to-line">To: <span style="font-family:'JetBrains Mono',monospace;">${escHtml(currentEmail)}</span></div>
          </div>
          <div class="detail-timestamp">${escHtml(em.time_ago)}</div>
        </div>
      </div>
      <div class="detail-body">${em.body}</div>
      ${attachHtml}`;

  } catch (e) {
    console.error('Open email failed:', e);
    $('detail-content').innerHTML = '<div style="flex:1;display:flex;align-items:center;justify-content:center;color:#dc2626;">Failed to load email</div>';
  }
}

// ── Delete / actions ──────────────────────────────────────────────
async function deleteEmail(id) {
  await api(`${INBOX_ORO.routes.emailBase}/${id}`, { method: 'DELETE' });
  removeEmailRow(id);
  $('detail-empty').style.display   = 'flex';
  $('detail-content').style.display  = 'none';
  selectedId = null;
}

async function markUnreadAction(id) {
  const res  = await api(`${INBOX_ORO.routes.emailBase}/${id}/unread`, { method: 'PATCH' });
  const data = await res.json();
  updateUnreadBadge(data.unread_count);
  // Mark row as unread visually
  const row = document.querySelector(`.erow[data-id="${id}"]`);
  if (row) {
    row.classList.add('unread');
    const dot = row.querySelector('.rdot-sm');
    if (dot) dot.className = 'udot-sm';
  }
}

async function markAllRead() {
  await api(INBOX_ORO.routes.markAllRead, { method: 'POST' });
  document.querySelectorAll('.erow.unread').forEach(r => {
    r.classList.remove('unread');
    const dot = r.querySelector('.udot-sm');
    if (dot) dot.className = 'rdot-sm';
  });
  updateUnreadBadge(0);
}

async function deleteAllMsgs() {
  if (!confirm('Delete all messages?')) return;
  await api(INBOX_ORO.routes.destroyAll, { method: 'DELETE' });
  $('email-list').innerHTML = '<div class="no-mail"><p>No messages yet</p></div>';
  $('detail-empty').style.display   = 'flex';
  $('detail-content').style.display  = 'none';
  selectedId = null;
  updateUnreadBadge(0);
  $('list-count').textContent = '0 messages';
}

function removeEmailRow(id) {
  const row = document.querySelector(`.erow[data-id="${id}"]`);
  if (row) row.remove();
  const remaining = document.querySelectorAll('.erow').length;
  if (remaining === 0) {
    $('email-list').innerHTML = '<div class="no-mail"><p>No messages yet</p></div>';
  }
  $('list-count').textContent = `${remaining} message${remaining !== 1 ? 's' : ''}`;
}

// ── Refresh (polling fallback) ────────────────────────────────────
async function refreshInbox(search = '') {
  const list = $('email-list');
  list.style.opacity = '.4';
  try {
    const url = new URL(INBOX_ORO.routes.inbox);
    if (search) url.searchParams.set('search', search);
    const res  = await api(url.toString());
    if (res.status === 410) { handleExpiry(); return; }
    const data = await res.json();
    renderInboxList(data);
  } catch(e) {
    console.error('Refresh failed:', e);
  } finally {
    list.style.opacity = '1';
  }
}

function renderInboxList(data) {
  const list = $('email-list');
  if (!data.emails || data.emails.length === 0) {
    list.innerHTML = '<div class="no-mail"><p>No messages yet</p></div>';
  } else {
    list.innerHTML = data.emails.map(renderEmailRow).join('');
  }
  updateUnreadBadge(data.unread);
  $('list-count').textContent = `${data.total} message${data.total !== 1 ? 's' : ''}${data.unread > 0 ? ` · ${data.unread} unread` : ''}`;
}

// ── Search (debounced 400ms) ──────────────────────────────────────
function debounceSearch(val) {
  clearTimeout(searchTimer);
  searchTimer = setTimeout(() => refreshInbox(val), 400);
}

// ── Reverb (WebSocket real-time) ──────────────────────────────────
let pusher = null;
let channel = null;

function initReverb(channelName) {
  if (typeof Pusher === 'undefined') {
    // Pusher.js not yet loaded — retry once it's available
    setTimeout(() => initReverb(channelName), 500);
    return;
  }

  pusher = new Pusher(INBOX_ORO.reverb.key, {
    wsHost:           INBOX_ORO.reverb.host,
    wsPort:           INBOX_ORO.reverb.port,
    wssPort:          INBOX_ORO.reverb.port,
    forceTLS:         INBOX_ORO.reverb.scheme === 'https',
    enabledTransports: ['ws', 'wss'],
    disableStats:     true,
  });

  channel = pusher.subscribe(channelName);

  // ── New email event ───────────────────────────────────────────
  channel.bind('new.email', function(data) {
    // Prepend new row to list
    const list = $('email-list');
    const noMail = list.querySelector('.no-mail');
    if (noMail) noMail.remove();

    const tmp = document.createElement('div');
    tmp.innerHTML = renderEmailRow({
      id:               data.id,
      sender:           data.sender,
      subject:          data.subject,
      preview:          data.preview,
      is_read:          false,
      time_ago:         data.time_ago,
      received_at:      data.received_at,
      avatar_letter:    data.avatar_letter,
      avatar_color:     data.avatar_color,
      attachments_count: data.has_attachments ? 1 : 0,
    });
    list.prepend(tmp.firstElementChild);
    updateUnreadBadge(data.unread_count);

    // Bump counter
    const countEl = $('list-count');
    const current = parseInt(countEl.textContent) || 0;
    countEl.textContent = `${current + 1} messages`;
  });

  // ── Mailbox expired event ─────────────────────────────────────
  channel.bind('mailbox.expired', function() {
    handleExpiry();
    pusher.disconnect();
  });

  pusher.connection.bind('disconnected', () => {
    // Fallback to polling every 10s if WS drops
    setTimeout(() => refreshInbox(), 10000);
  });
}

function reconnectReverb(newMailboxId) {
  if (channel)  pusher.unsubscribe(channel.name);
  const newChannel = `mailbox.${newMailboxId}`;
  channel = pusher.subscribe(newChannel);
  // Re-bind events
  channel.bind('new.email', (data) => {
    // Same handler as above — delegate
    initReverb.__handlers && initReverb.__handlers.newEmail(data);
  });
}

// ── Reveal on scroll ──────────────────────────────────────────────
function checkReveal() {
  document.querySelectorAll('.rv').forEach(el => {
    if (el.getBoundingClientRect().top < window.innerHeight - 50) {
      el.classList.add('in');
    }
  });
}

// ── Boot ──────────────────────────────────────────────────────────
(function init() {
  // Start countdown timer (server-sync via INBOX_ORO.expiresIn)
  startTimer();
  resetTimerBar(INBOX_ORO.expiresIn);

  // Connect Reverb
  initReverb(INBOX_ORO.reverb.channel);

  // Scroll reveal
  window.addEventListener('scroll', checkReveal, { passive: true });
  setTimeout(checkReveal, 100);
})();
</script>


</body>
</html>