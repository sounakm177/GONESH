@extends('layouts.authLayout')

@section('title', 'InboxOro — Domains')

@push('styles')
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
.domain-card:hover { border-color: #D1D5DB; box-shadow: 0 4px 16px rgba(0,0,0,.07); transform: translateY(-2px); }
.domain-card.selected { border-color: var(--Y); box-shadow: 0 0 0 1px var(--Y), 0 4px 16px rgba(250,204,21,.12); }
.domain-card.premium {
  background: linear-gradient(145deg, #1F2937, #111827);
  border-color: rgba(255,255,255,.08);
  color: #fff;
}
.domain-card.premium:hover { border-color: rgba(124,58,237,.4); box-shadow: 0 4px 20px rgba(124,58,237,.15); }

.dc-top {
  display: flex;
  align-items: center;
  justify-content: space-between;
}
.dc-icon {
  width: 36px; height: 36px; min-width: 36px;
  border-radius: 10px;
  display: flex; align-items: center; justify-content: center;
}
.dc-icon.free        { background: rgba(250,204,21,.15); color: #92400E; }
.dc-icon.selected-ic { background: var(--Y); color: var(--INK); }
.dc-icon.premium     { background: rgba(124,58,237,.2); color: #A78BFA; }

.dc-type {
  font-family: var(--MONO);
  font-size: .52rem; font-weight: 800;
  letter-spacing: .04em;
  text-transform: uppercase;
  padding: 3px 8px;
  border-radius: 6px;
}
.dc-type.free     { background: rgba(16,185,129,.1); color: var(--GREEN); }
.dc-type.premium  { background: rgba(124,58,237,.15); color: #A78BFA; }
.dc-type.popular  { background: rgba(250,204,21,.15); color: #92400E; }

.dc-name {
  font-family: var(--MONO);
  font-size: .9rem;
  font-weight: 700;
  color: var(--INK);
  margin-bottom: 4px;
}
.domain-card.premium .dc-name { color: #fff; }

.dc-desc {
  font-size: .76rem;
  color: var(--MU);
  line-height: 1.5;
}
.domain-card.premium .dc-desc { color: rgba(255,255,255,.5); }

.dc-features {
  display: flex; gap: 6px; flex-wrap: wrap;
}
.dc-feat {
  display: inline-flex; align-items: center; gap: 4px;
  font-family: var(--MONO);
  font-size: .56rem; font-weight: 700;
  padding: 3px 8px;
  border-radius: 6px;
}
.dc-feat.on  { background: rgba(16,185,129,.1); color: var(--GREEN); }
.dc-feat.off { background: var(--BD2); color: var(--MU2); }
.domain-card.premium .dc-feat.on  { background: rgba(16,185,129,.15); }
.domain-card.premium .dc-feat.off { background: rgba(255,255,255,.05); color: rgba(255,255,255,.25); }

.dc-stats {
  display: flex;
  border-top: 1px solid var(--BD2);
  padding-top: 12px;
  gap: 0;
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
@endpush

@section('content')

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

@endsection

@push('scripts')
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

/* ── Boot ── */
renderDomains();
</script>
@endpush
