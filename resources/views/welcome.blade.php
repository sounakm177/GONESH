<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>inboxOro — Disposable Email</title>
<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Outfit:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;500;700&display=swap" rel="stylesheet"/>
<style>
:root{--Y:#FACC15;--B:#2563EB;--INK:#1F2937;--BG:#F8FAFC;--BD:#E5E7EB;--MU:#6B7280;}
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0;}
body{background:var(--BG);font-family:'Outfit',sans-serif;color:var(--INK);overflow-x:hidden;}

/* ── NAV ── */
nav{position:sticky;top:0;z-index:100;background:var(--INK);display:flex;align-items:center;justify-content:space-between;padding:0 40px;height:52px;border-bottom:3px solid var(--Y);}
.nav-logo{font-family:'Bebas Neue',sans-serif;font-size:1.65rem;color:var(--Y);letter-spacing:.03em;line-height:1;display:flex;align-items:center;gap:2px;}
.nav-logo .oro{color:#fff;}
.nav-logo .badge{font-family:'JetBrains Mono',monospace;font-size:.5rem;font-weight:700;background:var(--Y);color:var(--INK);padding:2px 5px;letter-spacing:.08em;margin-left:6px;align-self:center;}
.nav-links{display:flex;gap:28px;align-items:center;}
.nav-links a{font-size:.76rem;font-weight:600;letter-spacing:.1em;text-transform:uppercase;color:#9CA3AF;text-decoration:none;transition:color .2s;}
.nav-links a:hover{color:var(--Y);}
.nav-cta{background:var(--Y);color:var(--INK);font-size:.74rem;font-weight:700;letter-spacing:.08em;text-transform:uppercase;padding:7px 16px;border:none;transition:background .15s;}
.nav-cta:hover{background:#fff;}

/* ════════════════════════════════
   HERO — slim ticker strip, no vertical space waste
════════════════════════════════ */
.hero-strip{
  background:var(--INK);
  border-bottom:2px solid rgba(250,204,21,.15);
  padding:10px 40px;
  display:flex;
  align-items:center;
  justify-content:space-between;
  gap:16px;
  flex-wrap:wrap;
  position:relative;
  overflow:hidden;
}
/* subtle noise grain */
.hero-strip::after{content:'';position:absolute;inset:0;background:url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='0.04'/%3E%3C/svg%3E");pointer-events:none;opacity:.35;}

.hero-left{display:flex;align-items:center;gap:16px;flex-wrap:wrap;}

/* blinking live badge */
.h-tag{display:inline-flex;align-items:center;gap:6px;background:rgba(250,204,21,.1);border:1px solid rgba(250,204,21,.25);color:var(--Y);font-family:'JetBrains Mono',monospace;font-size:.62rem;font-weight:700;letter-spacing:.12em;text-transform:uppercase;padding:4px 10px;flex-shrink:0;}
.h-tag::before{content:'';width:5px;height:5px;background:var(--Y);border-radius:50%;animation:blink 1.2s step-end infinite;}
@keyframes blink{0%,100%{opacity:1}50%{opacity:0}}

.hero-copy{}
.hero-copy-title{font-family:'Bebas Neue',sans-serif;font-size:clamp(1.3rem,2.5vw,1.75rem);color:#fff;letter-spacing:.04em;line-height:1.05;}
.hero-copy-title .gold{color:var(--Y);}
.hero-copy-sub{font-size:.74rem;color:#6B7280;margin-top:2px;line-height:1.45;max-width:460px;}

/* pill stats */
.hero-stats{display:flex;align-items:center;gap:8px;flex-shrink:0;}
.h-stat{display:flex;flex-direction:column;align-items:center;padding:6px 14px;border:1px solid rgba(255,255,255,.07);background:rgba(255,255,255,.03);}
.h-stat-n{font-family:'Bebas Neue',sans-serif;font-size:1.2rem;color:var(--Y);line-height:1;}
.h-stat-l{font-family:'JetBrains Mono',monospace;font-size:.55rem;color:#6B7280;letter-spacing:.07em;margin-top:1px;}

/* expand toggle */
.hero-more-btn{display:inline-flex;align-items:center;gap:5px;font-family:'JetBrains Mono',monospace;font-size:.62rem;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--Y);background:transparent;border:1px solid rgba(250,204,21,.25);padding:5px 11px;transition:background .15s;flex-shrink:0;}
.hero-more-btn:hover{background:rgba(250,204,21,.1);}
.hero-more-btn svg{transition:transform .35s;}
.hero-more-btn.open svg{transform:rotate(180deg);}

/* ── expandable hero detail ── */
.hero-detail{
  background:var(--INK);
  border-bottom:3px solid var(--Y);
  overflow:hidden;
  max-height:0;
  transition:max-height .5s cubic-bezier(.4,0,.2,1);
}
.hero-detail.open{max-height:280px;}
.hero-detail-inner{
  display:grid;
  grid-template-columns:auto 1fr 1fr;
  gap:36px;
  padding:28px 40px 32px;
  align-items:start;
}
.hd-big{font-family:'Bebas Neue',sans-serif;font-size:clamp(3.5rem,6vw,5.5rem);line-height:.88;letter-spacing:.01em;}
.hd-big .gold{color:var(--Y);}
.hd-big .out{-webkit-text-stroke:2px rgba(255,255,255,.2);color:transparent;}
.hd-desc{color:#9CA3AF;font-size:.85rem;line-height:1.7;}
.hd-feats{display:flex;flex-direction:column;gap:9px;padding-top:4px;}
.hd-feat{display:flex;align-items:center;gap:9px;font-size:.78rem;color:#9CA3AF;}
.hd-feat svg{color:var(--Y);flex-shrink:0;}
.hd-feat b{color:#fff;font-weight:600;}

/* ── PAGE ── */
.page-wrap{display:grid;grid-template-columns:1fr 300px;max-width:1280px;margin:0 auto;padding:20px 40px 60px;}
.left-col{padding-right:48px;border-right:2px solid var(--BD);}
.right-col{padding-left:32px;display:flex;flex-direction:column;gap:20px;}
.sidebar-sticky{position:sticky;top:74px;display:flex;flex-direction:column;gap:20px;}

/* ── DOMAIN TABS ── */
.domain-tabs{display:flex;border:2px solid var(--INK);width:fit-content;overflow:hidden;flex-wrap:wrap;}
.dtab{font-family:'JetBrains Mono',monospace;font-size:.7rem;font-weight:500;padding:8px 14px;border:none;background:#fff;color:var(--MU);border-right:2px solid var(--INK);transition:background .15s,color .15s;white-space:nowrap;}
.dtab:last-child{border-right:none;}
.dtab:hover{background:#FEF9C3;color:var(--INK);}
.dtab.active{background:var(--INK);color:var(--Y);font-weight:700;}

/* ── GENERATOR ── */
.gen-block{border:2px solid var(--INK);background:#fff;margin-top:-2px;}
.gen-top{display:flex;align-items:center;justify-content:space-between;padding:16px 22px;border-bottom:2px solid var(--INK);background:#FAFAFA;}
.gen-label{font-family:'JetBrains Mono',monospace;font-size:.64rem;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--MU);}
.live-pill{display:flex;align-items:center;gap:6px;font-family:'JetBrains Mono',monospace;font-size:.64rem;font-weight:600;color:#16a34a;letter-spacing:.06em;}
.live-dot{width:7px;height:7px;background:#22c55e;border-radius:50%;animation:pg 2s ease-in-out infinite;}
@keyframes pg{0%,100%{box-shadow:0 0 0 0 rgba(34,197,94,.5)}50%{box-shadow:0 0 0 5px rgba(34,197,94,0)}}
.email-row{display:flex;align-items:center;gap:14px;padding:22px 22px;border-bottom:2px solid var(--INK);}
.email-txt{font-family:'JetBrains Mono',monospace;font-size:clamp(.9rem,2.1vw,1.22rem);font-weight:700;color:var(--INK);flex:1;min-width:0;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;transition:opacity .3s;letter-spacing:-.01em;}
.email-txt.fading{opacity:.15;}
.btn-copy{background:var(--Y);color:var(--INK);font-size:.8rem;font-weight:700;letter-spacing:.05em;padding:10px 22px;border:2px solid var(--INK);flex-shrink:0;transition:background .15s,transform .1s,box-shadow .15s;box-shadow:3px 3px 0 var(--INK);}
.btn-copy:hover{transform:translate(-2px,-2px);box-shadow:5px 5px 0 var(--INK);}
.btn-copy:active{transform:translate(1px,1px);box-shadow:1px 1px 0 var(--INK);}
.btn-copy.ok{background:#22c55e;color:#fff;border-color:#16a34a;}
.gen-foot{display:flex;align-items:center;justify-content:space-between;padding:11px 22px;}
.timer-wrap{display:flex;align-items:center;gap:9px;}
.timer-track{width:110px;height:3px;background:var(--BD);}
.timer-fill{height:100%;background:var(--Y);width:100%;animation:shrink 600s linear forwards;}
@keyframes shrink{to{width:0;}}
.timer-num{font-family:'JetBrains Mono',monospace;font-size:.72rem;font-weight:700;color:var(--INK);}
.timer-lbl{font-size:.7rem;color:var(--MU);}
.btn-new{display:flex;align-items:center;gap:6px;background:none;border:2px solid var(--INK);color:var(--INK);font-size:.76rem;font-weight:600;padding:7px 14px;transition:background .15s,color .15s;box-shadow:2px 2px 0 var(--INK);}
.btn-new:hover{background:var(--INK);color:var(--Y);}
.btn-new:hover svg{transform:rotate(180deg);}
.btn-new svg{transition:transform .4s;}

/* ══ INBOX ══ */
.inbox-wrap{margin-top:24px;}
.sec-header{display:flex;align-items:center;justify-content:space-between;margin-bottom:12px;gap:12px;}
.sec-title{font-family:'Bebas Neue',sans-serif;font-size:1.65rem;letter-spacing:.04em;}
.sec-meta{font-family:'JetBrains Mono',monospace;font-size:.65rem;color:var(--MU);}
.ib-toolbar-btn{display:inline-flex;align-items:center;justify-content:center;width:32px;height:32px;border:2px solid var(--INK);background:#fff;transition:background .12s,color .12s;color:var(--INK);box-shadow:2px 2px 0 var(--INK);}
.ib-toolbar-btn:hover{background:var(--INK);color:var(--Y);}
.ib-toolbar-btn:hover svg{stroke:var(--Y);}
.inbox-shell{display:flex;border:2px solid var(--INK);background:#fff;min-height:460px;max-height:520px;}
.inbox-list-panel{width:320px;flex-shrink:0;border-right:2px solid var(--INK);display:flex;flex-direction:column;overflow:hidden;}
.inbox-search{display:flex;align-items:center;gap:8px;padding:10px 14px;border-bottom:1px solid var(--BD);background:#FAFAFA;}
.inbox-search input{border:none;outline:none;background:transparent;font-family:'Outfit',sans-serif;font-size:.82rem;color:var(--INK);flex:1;cursor:text;}
.inbox-search input::placeholder{color:#C0C0C0;}
#email-list{flex:1;overflow-y:auto;overscroll-behavior:contain;}
#email-list::-webkit-scrollbar{width:4px;}
#email-list::-webkit-scrollbar-thumb{background:#E5E7EB;border-radius:2px;}
.erow{display:flex;align-items:flex-start;gap:10px;padding:13px 14px;border-bottom:1px solid #F3F4F6;transition:background .12s;position:relative;}
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
.dtl-btn{display:inline-flex;align-items:center;gap:5px;font-size:.75rem;font-weight:600;color:var(--INK);background:#fff;border:1.5px solid var(--INK);padding:5px 11px;transition:background .12s,color .12s;}
.dtl-btn:hover{background:var(--INK);color:var(--Y);}
.dtl-btn svg{flex-shrink:0;}
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
.detail-body .divider{border:none;border-top:1px solid var(--BD);margin:16px 0;}
.detail-body .email-footer-note{font-size:.72rem;color:#9CA3AF;line-height:1.5;}
.attach-section{padding:14px 20px;border-top:2px solid var(--INK);background:#FAFAFA;flex-shrink:0;}
.attach-title{font-family:'JetBrains Mono',monospace;font-size:.66rem;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--MU);margin-bottom:10px;}
.attach-grid{display:flex;flex-wrap:wrap;gap:10px;}
.attach-card{display:flex;align-items:center;gap:10px;border:2px solid var(--INK);background:#fff;padding:10px 14px;transition:background .12s,box-shadow .12s,transform .12s;box-shadow:2px 2px 0 var(--INK);min-width:180px;max-width:240px;}
.attach-card:hover{background:#FEF9C3;box-shadow:4px 4px 0 var(--INK);transform:translate(-1px,-1px);}
.attach-icon{width:36px;height:36px;border-radius:4px;display:flex;align-items:center;justify-content:center;flex-shrink:0;font-size:.55rem;font-weight:800;font-family:'JetBrains Mono',monospace;letter-spacing:.04em;}
.attach-info{flex:1;min-width:0;}
.attach-name{font-size:.78rem;font-weight:700;color:var(--INK);white-space:nowrap;overflow:hidden;text-overflow:ellipsis;}
.attach-size{font-size:.68rem;color:var(--MU);font-family:'JetBrains Mono',monospace;margin-top:1px;}
.attach-dl{flex-shrink:0;color:var(--B);}
.no-mail{display:flex;flex-direction:column;align-items:center;justify-content:center;padding:40px 20px;gap:10px;color:#D1D5DB;}
.no-mail p{font-size:.82rem;font-weight:500;color:var(--MU);}

/* ── FEATURES ── */
.feat-strip{display:grid;grid-template-columns:repeat(3,1fr);border:2px solid var(--INK);margin-top:32px;}
.feat-item{padding:20px;border-right:2px solid var(--INK);transition:background .15s;}
.feat-item:last-child{border-right:none;}
.feat-item:hover{background:var(--Y);}
.feat-ic{color:var(--B);margin-bottom:10px;}
.feat-item:hover .feat-ic{color:var(--INK);}
.feat-t{font-family:'Bebas Neue',sans-serif;font-size:1rem;letter-spacing:.04em;margin-bottom:5px;}
.feat-d{font-size:.76rem;color:var(--MU);line-height:1.5;}
.feat-item:hover .feat-d{color:var(--INK);}

/* ── AD SLOT ── */
.ad-slot{border:2px dashed #D1D5DB;background:#FAFAFA;display:flex;flex-direction:column;align-items:center;justify-content:center;gap:6px;text-align:center;position:relative;overflow:hidden;}
.ad-slot::before{content:'';position:absolute;inset:0;background:repeating-linear-gradient(-45deg,transparent,transparent 8px,rgba(0,0,0,.018) 8px,rgba(0,0,0,.018) 16px);}
.ad-lbl{font-family:'JetBrains Mono',monospace;font-size:.58rem;font-weight:700;letter-spacing:.14em;text-transform:uppercase;color:#9CA3AF;position:relative;z-index:1;}
.ad-sz{font-family:'Bebas Neue',sans-serif;font-size:1.25rem;color:#D1D5DB;letter-spacing:.05em;position:relative;z-index:1;}
.ad-nt{font-size:.66rem;color:#C0C0C0;font-weight:500;position:relative;z-index:1;}

/* ── SIDEBAR ── */
.sidebar-stat{border:2px solid var(--INK);padding:16px 18px;background:#fff;}
.stat-n{font-family:'Bebas Neue',sans-serif;font-size:2.2rem;color:var(--INK);line-height:1;}
.stat-n span{color:var(--Y);}
.stat-d{font-size:.72rem;color:var(--MU);font-weight:500;margin-top:3px;}
.pro-card{border:2px solid var(--INK);padding:18px 20px;background:#fff;}
.pro-t{font-family:'Bebas Neue',sans-serif;font-size:.95rem;letter-spacing:.05em;margin-bottom:8px;}
.pro-d{font-size:.73rem;color:var(--MU);line-height:1.55;}
.pro-link{font-family:'JetBrains Mono',monospace;font-size:.66rem;font-weight:700;color:var(--B);text-decoration:none;letter-spacing:.06em;display:inline-block;margin-top:12px;}
.pro-link:hover{text-decoration:underline;}

/* ── FOOTER ── */
footer{background:var(--INK);padding:26px 40px;display:flex;align-items:center;justify-content:space-between;border-top:3px solid var(--Y);}
.foot-logo{font-family:'Bebas Neue',sans-serif;font-size:1.4rem;color:var(--Y);letter-spacing:.03em;}
.foot-logo .oro{color:#fff;}
.foot-links{display:flex;gap:22px;}
.foot-links a{font-size:.73rem;color:#6B7280;text-decoration:none;font-weight:500;}
.foot-links a:hover{color:var(--Y);}
.foot-st{font-family:'JetBrains Mono',monospace;font-size:.68rem;color:#22c55e;display:flex;align-items:center;gap:5px;}

/* ── TOAST ── */
#toast{position:fixed;bottom:28px;right:32px;background:var(--INK);color:var(--Y);font-family:'JetBrains Mono',monospace;font-size:.76rem;font-weight:700;letter-spacing:.05em;padding:11px 18px;border:2px solid var(--Y);box-shadow:4px 4px 0 var(--Y);z-index:999;transform:translateY(70px);opacity:0;transition:transform .35s cubic-bezier(.34,1.56,.64,1),opacity .3s;display:flex;align-items:center;gap:8px;}
#toast.show{transform:translateY(0);opacity:1;}

/* ── REVEAL (only for below-fold) ── */
.rv{opacity:0;transform:translateY(12px);transition:opacity .55s ease,transform .55s ease;}
.rv.in{opacity:1;transform:translateY(0);}

/* ── RESPONSIVE ── */
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
<div id="cur"></div>
<div id="toast"><svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" d="M5 13l4 4L19 7"/></svg>COPIED</div>

<!-- ══ NAV ══ -->
<nav>
  <div class="nav-logo">inbox<span class="oro">Oro</span><span class="badge">FREE</span></div>
  <div class="nav-links">
    <a href="#">How it works</a>
    <a href="#">Domains</a>
    <a href="#">API</a>
    <button class="nav-cta">Get Pro</button>
  </div>
</nav>

<!-- ══ HERO STRIP — slim, always above fold ══ -->
<div class="hero-strip">
  <div class="hero-left">
    <div class="h-tag">Instant · Anonymous · Free</div>
    <div class="hero-copy">
      <div class="hero-copy-title">Disposable <span class="gold">Temp Email</span> — No signup, no trace, no spam.</div>
      <div class="hero-copy-sub">Generate a burner address in one click. Receive OTPs, verification links &amp; sign-up codes — then vanish without a trace.</div>
    </div>
  </div>
  <div style="display:flex;align-items:center;gap:10px;">
    <div class="hero-stats">
      <div class="h-stat"><div class="h-stat-n">12M+</div><div class="h-stat-l">Emails Today</div></div>
      <div class="h-stat"><div class="h-stat-n">0 Logs</div><div class="h-stat-l">Zero Tracking</div></div>
      <div class="h-stat"><div class="h-stat-n">10 Min</div><div class="h-stat-l">Auto Expiry</div></div>
      <div class="h-stat"><div class="h-stat-n">5</div><div class="h-stat-l">Domains</div></div>
    </div>
    <button class="hero-more-btn" id="more-btn" onclick="toggleHero()">
      About
      <svg width="11" height="11" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M19 9l-7 7-7-7"/></svg>
    </button>
  </div>
</div>

<!-- ══ EXPANDABLE HERO FULL ══ -->
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

<!-- ══ PAGE WRAP ══ -->
<div class="page-wrap">

  <!-- LEFT COLUMN -->
  <div class="left-col">

    <!-- Domain tabs — first thing user sees -->
    <div class="domain-tabs" id="dtabs"></div>

    <!-- Generator — immediately visible -->
    <div class="gen-block">
      <div class="gen-top">
        <span class="gen-label">// your burner address</span>
        <div class="live-pill"><div class="live-dot"></div>ACTIVE</div>
      </div>
      <div class="email-row">
        <div class="email-txt" id="edisplay">--</div>
        <button class="btn-copy" id="cbtn" onclick="copyEmail()">
          <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" style="display:inline;margin-right:5px;vertical-align:middle;"><rect x="9" y="9" width="13" height="13" rx="2"/><path stroke-linecap="round" d="M5 15H4a2 2 0 01-2-2V4a2 2 0 012-2h9a2 2 0 012 2v1"/></svg>Copy
        </button>
      </div>
      <div class="gen-foot">
        <div class="timer-wrap">
          <span class="timer-lbl">Expires</span>
          <div class="timer-track"><div class="timer-fill" id="tbar"></div></div>
          <span class="timer-num" id="tnum">10:00</span>
        </div>
        <button class="btn-new" onclick="generateEmail()">
          <svg id="ric" width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
          New Address
        </button>
      </div>
    </div>

    <!-- INBOX — immediately visible -->
    <div class="inbox-wrap">
      <div class="sec-header">
        <div style="display:flex;align-items:baseline;gap:12px;flex-wrap:wrap;">
          <span class="sec-title">Inbox&nbsp;<span style="color:var(--Y);font-size:1.1rem;" id="ucnt"></span></span>
          <span class="sec-meta">// live · auto-refresh 8s</span>
        </div>
        <div style="display:flex;gap:6px;">
          <button class="ib-toolbar-btn" onclick="refreshInbox()" title="Refresh inbox">
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
            <input id="search-inp" type="text" placeholder="Search messages..." oninput="filterEmails(this.value)"/>
          </div>
          <div id="email-list"></div>
          <div class="inbox-list-footer">
            <span id="list-count"></span>&nbsp;·&nbsp;
            auto-deletes in <b id="itimer" style="color:var(--INK);">10:00</b>
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

    <!-- AD leaderboard -->
    <div class="ad-slot rv" style="height:96px;margin-top:28px;">
      <div class="ad-lbl">Advertisement</div>
      <div class="ad-sz">728 × 90</div>
      <div class="ad-nt">Google AdSense — Leaderboard Banner</div>
    </div>

    <!-- Features -->
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

  </div><!-- /left-col -->

  <!-- RIGHT SIDEBAR -->
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

</div><!-- /page-wrap -->

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

<script>
/* ── DATA ── */
const EMAILS_DATA=[
  {id:1,unread:true,from:'Google Security',fromEmail:'no-reply@accounts.google.com',subject:'Verify your Google account — action required',preview:'We received a request to verify this email address for a Google Account...',time:'2m ago',fullTime:'Today, 11:43 AM',avatarColor:'#4285F4',avatarLetter:'G',attachments:[],body:`<p>Hi there,</p><p>We received a request to verify this email address for a Google Account. If you made this request, click the button below to verify your email.</p><p style="margin:20px 0;"><a class="verify-btn" href="#">Verify Email Address</a></p><p>This link will expire in <strong>24 hours</strong>. If you didn't request this, you can safely ignore this email.</p><hr class="divider"/><p class="email-footer-note">Google LLC, 1600 Amphitheatre Parkway, Mountain View, CA 94043</p>`},
  {id:2,unread:true,from:'Shopify',fromEmail:'otp@shopify.com',subject:'Your one-time password: 847291',preview:'Use this code to complete your sign-in. This OTP is valid for 5 minutes only...',time:'5m ago',fullTime:'Today, 11:40 AM',avatarColor:'#96BF48',avatarLetter:'S',attachments:[],body:`<p>Hi there,</p><p>Use the one-time password below to complete your Shopify sign-in. Valid for <strong>5 minutes</strong>.</p><p><span class="otp-box">847 291</span></p><p>If you didn't request this, please ignore.</p><hr class="divider"/><p class="email-footer-note">Shopify Inc. · 151 O'Connor St, Ottawa, ON</p>`},
  {id:3,unread:true,from:'Notion',fromEmail:'hello@notion.so',subject:'Welcome to Notion — your workspace is ready',preview:"You're all set! Start building your second brain with Notion...",time:'8m ago',fullTime:'Today, 11:37 AM',avatarColor:'#000000',avatarLetter:'N',attachments:[{name:'Getting_Started_Guide.pdf',size:'2.4 MB',type:'pdf',color:'#dc2626',bg:'#fee2e2'},{name:'Notion_Templates.zip',size:'8.1 MB',type:'zip',color:'#7c3aed',bg:'#ede9fe'}],body:`<p>Welcome aboard! 🎉</p><p>Your Notion workspace is ready.</p><p>📝 <strong>Create your first page</strong><br>📁 <strong>Explore 50+ templates</strong><br>🔗 <strong>Invite your team</strong></p><p style="margin:16px 0;"><a class="verify-btn" href="#">Open My Workspace</a></p><hr class="divider"/><p class="email-footer-note">Notion Labs, Inc. · 2300 Harrison St, San Francisco, CA 94110</p>`},
  {id:4,unread:false,from:'X (Twitter)',fromEmail:'info@twitter.com',subject:'Confirm your email address to continue',preview:'Please confirm your email address so we can keep your account secure...',time:'9m ago',fullTime:'Today, 11:36 AM',avatarColor:'#000000',avatarLetter:'X',attachments:[],body:`<p>Hi,</p><p>Please confirm your email address to keep your X account secure.</p><p style="margin:20px 0;"><a class="verify-btn" href="#">Confirm Email</a></p><p>This link expires in 48 hours.</p><hr class="divider"/><p class="email-footer-note">X Corp · 1355 Market St, San Francisco, CA 94103</p>`},
  {id:5,unread:false,from:'GitHub',fromEmail:'noreply@github.com',subject:'Your repository was successfully forked',preview:'dropit-app/awesome-project was forked from open-source/awesome-project...',time:'14m ago',fullTime:'Today, 11:31 AM',avatarColor:'#24292e',avatarLetter:'G',attachments:[{name:'fork_report.csv',size:'12 KB',type:'csv',color:'#16a34a',bg:'#dcfce7'}],body:`<p>Hi there,</p><p>Your fork was successfully created.</p><p><strong>Repository:</strong> inboxoro-app/awesome-project<br><strong>Forked from:</strong> open-source/awesome-project<br><strong>Visibility:</strong> Public</p><p style="margin:16px 0;"><a class="verify-btn" href="#">View Your Fork</a></p><hr class="divider"/><p class="email-footer-note">GitHub, Inc. · 88 Colin P Kelly Jr St, San Francisco, CA 94107</p>`},
  {id:6,unread:false,from:'Figma',fromEmail:'no-reply@figma.com',subject:'A file has been shared with you',preview:'Alex shared "Dashboard UI Kit v3" with you. Click to open in Figma...',time:'22m ago',fullTime:'Today, 11:23 AM',avatarColor:'#F24E1E',avatarLetter:'F',attachments:[{name:'Dashboard_UI_Kit.fig',size:'14.2 MB',type:'fig',color:'#F24E1E',bg:'#FEE2E2'}],body:`<p>Hi there,</p><p><strong>Alex Johnson</strong> shared a Figma file with you.</p><p>📐 <strong>Dashboard UI Kit v3</strong> — 48 components, 12 pages</p><p style="margin:16px 0;"><a class="verify-btn" href="#">Open in Figma</a></p><hr class="divider"/><p class="email-footer-note">Figma, Inc. · 760 Market St, San Francisco, CA 94102</p>`},
  {id:7,unread:false,from:'Stripe',fromEmail:'support@stripe.com',subject:'Your payout of $247.50 is on its way',preview:'A payout of $247.50 has been initiated to your bank account ending in 4242...',time:'41m ago',fullTime:'Today, 11:04 AM',avatarColor:'#635BFF',avatarLetter:'S',attachments:[{name:'payout_receipt.pdf',size:'88 KB',type:'pdf',color:'#dc2626',bg:'#fee2e2'}],body:`<p>Good news!</p><p>A payout of <strong>$247.50</strong> has been initiated to your bank account ending in <strong>4242</strong>. Expected in 2–3 business days.</p><p style="margin:16px 0;"><a class="verify-btn" href="#">View Payout Details</a></p><hr class="divider"/><p class="email-footer-note">Stripe, Inc. · 510 Townsend St, San Francisco, CA 94103</p>`}
];

/* ── STATE ── */
const DOMAINS=['inboxoro.com','burnbox.dev','zaptmp.net','voidmail.cc','mailsink.app'];
const ADJ=['silent','ghost','turbo','vapor','swift','lunar','neon','flux','rogue','stealth','onyx','blaze','mist','echo','zero'];
const NOUN=['fox','wolf','tide','bolt','hawk','mint','storm','byte','nova','apex','dusk','wren','pike','elk','moss'];
let domain=DOMAINS[0],email='',secs=600,timerInt;
let emails=JSON.parse(JSON.stringify(EMAILS_DATA));
let selectedId=null,filterQuery='';

/* ── CURSOR ── */
const cur=document.getElementById('cur');
document.addEventListener('mousemove',e=>{cur.style.left=e.clientX+'px';cur.style.top=e.clientY+'px';});
function bc(on){on?cur.classList.add('big'):cur.classList.remove('big');}

/* ── HERO EXPAND ── */
function toggleHero(){
  const d=document.getElementById('hero-detail');
  const b=document.getElementById('more-btn');
  d.classList.toggle('open');
  b.classList.toggle('open');
  b.querySelector('span').textContent=d.classList.contains('open')?'Close':'About';
}

/* ── DOMAINS ── */
function renderDomains(){
  const c=document.getElementById('dtabs');c.innerHTML='';
  DOMAINS.forEach((d,i)=>{
    const b=document.createElement('button');
    b.className='dtab'+(i===0?' active':'');
    b.textContent='@'+d;
    b.onmouseenter=()=>bc(true);b.onmouseleave=()=>bc(false);
    b.onclick=()=>{document.querySelectorAll('.dtab').forEach(x=>x.classList.remove('active'));b.classList.add('active');domain=d;generateEmail();};
    c.appendChild(b);
  });
}

/* ── GENERATE ── */
function generateEmail(){
  const a=ADJ[Math.floor(Math.random()*ADJ.length)];
  const n=NOUN[Math.floor(Math.random()*NOUN.length)];
  const num=Math.floor(Math.random()*9000)+1000;
  email=`${a}.${n}${num}@${domain}`;
  const el=document.getElementById('edisplay');
  el.classList.add('fading');
  setTimeout(()=>{el.textContent=email;el.classList.remove('fading');},260);
  secs=600;
  const bar=document.getElementById('tbar');
  bar.style.animation='none';void bar.offsetWidth;
  bar.style.animation='shrink 600s linear forwards';
  const ic=document.getElementById('ric');
  ic.style.transition='transform .45s ease';ic.style.transform='rotate(360deg)';
  setTimeout(()=>{ic.style.transition='none';ic.style.transform='rotate(0)';},460);
}

/* ── COPY ── */
function copyEmail(){
  if(!email)return;
  navigator.clipboard.writeText(email).catch(()=>{});
  const btn=document.getElementById('cbtn');
  btn.classList.add('ok');
  btn.innerHTML='<svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3" style="display:inline;margin-right:5px;vertical-align:middle;"><path stroke-linecap="round" d="M5 13l4 4L19 7"/></svg>Done';
  const t=document.getElementById('toast');t.classList.add('show');setTimeout(()=>t.classList.remove('show'),2500);
  setTimeout(()=>{btn.classList.remove('ok');btn.innerHTML='<svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" style="display:inline;margin-right:5px;vertical-align:middle;"><rect x="9" y="9" width="13" height="13" rx="2"/><path stroke-linecap="round" d="M5 15H4a2 2 0 01-2-2V4a2 2 0 012-2h9a2 2 0 012 2v1"/></svg>Copy';},2200);
}

/* ── TIMER ── */
function startTimer(){
  if(timerInt)clearInterval(timerInt);
  timerInt=setInterval(()=>{
    if(secs>0)secs--;
    const m=String(Math.floor(secs/60)).padStart(2,'0');
    const s=String(secs%60).padStart(2,'0');
    const str=`${m}:${s}`;
    document.getElementById('tnum').textContent=str;
    document.getElementById('itimer').textContent=str;
  },1000);
}

/* ── INBOX ── */
function getFiltered(){const q=filterQuery.toLowerCase().trim();if(!q)return emails;return emails.filter(e=>e.from.toLowerCase().includes(q)||e.subject.toLowerCase().includes(q)||e.preview.toLowerCase().includes(q)||e.fromEmail.toLowerCase().includes(q));}
function unreadCount(){return emails.filter(e=>e.unread).length;}
function updateUnreadBadge(){const u=unreadCount();document.getElementById('ucnt').textContent=u>0?`(${u})`:'';} 
function updateListCount(){const f=getFiltered();const u=f.filter(e=>e.unread).length;document.getElementById('list-count').textContent=`${f.length} message${f.length!==1?'s':''}`+(u>0?` · ${u} unread`:'');}
function getTypeIcon(t){const m={pdf:{label:'PDF',color:'#dc2626',bg:'#fee2e2'},zip:{label:'ZIP',color:'#7c3aed',bg:'#ede9fe'},csv:{label:'CSV',color:'#16a34a',bg:'#dcfce7'},png:{label:'PNG',color:'#2563EB',bg:'#dbeafe'},jpg:{label:'JPG',color:'#d97706',bg:'#fef3c7'},fig:{label:'FIG',color:'#F24E1E',bg:'#FEE2E2'}};return m[t]||{label:t.toUpperCase().slice(0,3),color:'#6B7280',bg:'#F3F4F6'};}

function renderList(){
  const list=document.getElementById('email-list');
  const filtered=getFiltered();
  list.innerHTML='';
  if(filtered.length===0){list.innerHTML=`<div class="no-mail"><svg width="40" height="40" fill="none" viewBox="0 0 24 24" stroke="#D1D5DB" stroke-width="1.2"><path stroke-linecap="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg><p>${filterQuery?'No results found':'No messages yet'}</p></div>`;updateListCount();updateUnreadBadge();return;}
  filtered.forEach(em=>{
    const row=document.createElement('div');
    row.className='erow'+(em.unread?' unread':'')+(em.id===selectedId?' selected':'');
    row.dataset.id=em.id;
    const hasA=em.attachments&&em.attachments.length>0;
    row.innerHTML=`<div class="erow-left"><div class="erow-avatar" style="background:${em.avatarColor};">${em.avatarLetter}</div><div class="${em.unread?'udot-sm':'rdot-sm'}"></div></div><div class="erow-body"><div class="erow-top-row"><span class="e-sender">${em.from}</span><span class="e-time">${em.time}</span></div><div class="e-subject">${em.subject}</div><div class="e-preview">${em.preview}</div>${hasA?`<div class="e-attach-badge"><svg width="11" height="11" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"/></svg>${em.attachments.length} attachment${em.attachments.length>1?'s':''}</div>`:''}</div>`;
    row.onclick=()=>openEmail(em.id);
    row.onmouseenter=()=>bc(true);row.onmouseleave=()=>bc(false);
    list.appendChild(row);
  });
  updateListCount();updateUnreadBadge();
}

function openEmail(id){
  const em=emails.find(e=>e.id===id);if(!em)return;
  em.unread=false;selectedId=id;
  document.querySelectorAll('.erow').forEach(r=>{r.classList.toggle('selected',parseInt(r.dataset.id)===id);if(parseInt(r.dataset.id)===id)r.classList.remove('unread');});
  const selRow=document.querySelector(`.erow[data-id="${id}"]`);
  if(selRow){const dot=selRow.querySelector('.udot-sm');if(dot)dot.className='rdot-sm';}
  updateUnreadBadge();updateListCount();
  document.getElementById('detail-empty').style.display='none';
  const dc=document.getElementById('detail-content');dc.style.display='flex';
  const aHTML=em.attachments&&em.attachments.length>0?`<div class="attach-section"><div class="attach-title"><svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="display:inline;vertical-align:middle;margin-right:4px;"><path stroke-linecap="round" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"/></svg>${em.attachments.length} Attachment${em.attachments.length>1?'s':''}</div><div class="attach-grid">${em.attachments.map(a=>{const ti=getTypeIcon(a.type);return`<div class="attach-card" onclick="downloadAttachment('${a.name}','${a.type}')"><div class="attach-icon" style="background:${a.bg||ti.bg};color:${a.color||ti.color};">${ti.label}</div><div class="attach-info"><div class="attach-name">${a.name}</div><div class="attach-size">${a.size}</div></div><div class="attach-dl"><svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2"><path stroke-linecap="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg></div></div>`;}).join('')}</div></div>`:'' ;
  dc.innerHTML=`<div class="detail-toolbar"><div class="detail-toolbar-left"><button class="dtl-btn" onclick="replyEmail(${id})"><svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"/></svg>Reply</button><button class="dtl-btn" onclick="forwardEmail(${id})"><svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M21 10H11a8 8 0 00-8 8v2m18-10l-6-6m6 6l-6 6"/></svg>Forward</button><button class="dtl-btn" onclick="markUnread(${id})"><svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>Mark Unread</button></div><button class="dtl-btn danger" onclick="deleteEmail(${id})"><svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><polyline points="3 6 5 6 21 6"/><path stroke-linecap="round" d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6m5 0V4a1 1 0 011-1h2a1 1 0 011 1v2"/></svg>Delete</button></div><div class="detail-header"><div class="detail-subject">${em.subject}</div><div class="detail-meta-row"><div class="detail-avatar" style="background:${em.avatarColor};">${em.avatarLetter}</div><div class="detail-meta-info"><div class="detail-from-name">${em.from}</div><div class="detail-from-email">&lt;${em.fromEmail}&gt;</div><div class="detail-to-line">To: <span style="font-family:'JetBrains Mono',monospace;">${email||'you@inboxoro.com'}</span></div></div><div class="detail-timestamp">${em.fullTime}</div></div></div><div class="detail-body">${em.body}</div>${aHTML}`;
  dc.querySelectorAll('button,.attach-card').forEach(el=>{el.onmouseenter=()=>bc(true);el.onmouseleave=()=>bc(false);});
}

function deleteEmail(id){emails=emails.filter(e=>e.id!==id);if(selectedId===id){selectedId=null;document.getElementById('detail-empty').style.display='flex';document.getElementById('detail-content').style.display='none';}renderList();}
function markUnread(id){const em=emails.find(e=>e.id===id);if(em){em.unread=true;renderList();}}
function replyEmail(id){const em=emails.find(e=>e.id===id);if(em)alert(`Reply to: ${em.fromEmail}`);}
function forwardEmail(id){const em=emails.find(e=>e.id===id);if(em)alert(`Forward: "${em.subject}"`);}
function markAllRead(){emails.forEach(e=>e.unread=false);renderList();if(selectedId)openEmail(selectedId);}
function deleteAllMsgs(){if(!confirm('Delete all messages?'))return;emails=[];selectedId=null;document.getElementById('detail-empty').style.display='flex';document.getElementById('detail-content').style.display='none';renderList();}
function refreshInbox(){const l=document.getElementById('email-list');l.style.opacity='.4';setTimeout(()=>{l.style.opacity='1';renderList();},600);}
function filterEmails(q){filterQuery=q;renderList();}
function downloadAttachment(name,type){const blob=new Blob([`inboxOro simulated attachment\nFile: ${name}\nType: ${type}`],{type:'text/plain'});const url=URL.createObjectURL(blob);const a=document.createElement('a');a.href=url;a.download=name;a.click();URL.revokeObjectURL(url);}

/* ── REVEAL ── */
function checkReveal(){document.querySelectorAll('.rv').forEach(el=>{if(el.getBoundingClientRect().top<window.innerHeight-50)el.classList.add('in');});}

/* ── INIT ── */
renderDomains();generateEmail();startTimer();renderList();
window.addEventListener('scroll',checkReveal);setTimeout(checkReveal,100);
setInterval(refreshInbox,8000);

/* cursor bind on interactive elements */
document.querySelectorAll('a,button,input').forEach(el=>{el.addEventListener('mouseenter',()=>bc(true));el.addEventListener('mouseleave',()=>bc(false));});
</script>
</body>
</html>