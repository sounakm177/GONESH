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

/* ── Header search & filters ── */
.page-toolbar {
  display: flex; align-items: center; gap: 10px; flex-wrap: wrap;
}
.domain-search-wrap {
  position: relative; min-width: 180px; flex: 1; max-width: 300px;
}
.domain-search-wrap input {
  width: 100%; padding: 7px 10px 7px 30px;
  border: 1px solid var(--BD); border-radius: 8px;
  background: var(--BG); color: var(--INK);
  font-family: var(--BODY); font-size: .78rem;
  transition: border-color .15s;
}
.domain-search-wrap input:focus { outline:none; border-color:var(--Y); }
.domain-search-wrap svg {
  position:absolute; left:9px; top:50%; transform:translateY(-50%);
  color:var(--MU2); pointer-events:none;
}
.domain-filter-select {
  padding:7px 10px; border:1px solid var(--BD); border-radius:8px;
  background:var(--SURF); color:var(--INK);
  font-family:var(--BODY); font-size:.76rem; cursor:pointer;
}
.domain-filter-select:focus { outline:none; border-color:var(--Y); }

/* ── Filter chips ── */
.filter-chips {
  display: flex; gap: 6px; flex-wrap: wrap; margin-bottom: 16px;
}
.filter-chip {
  display: inline-flex; align-items: center; gap: 4px;
  font-family: var(--MONO); font-size: .6rem; font-weight: 700;
  padding: 5px 11px; border-radius: 20px;
  border: 1px solid var(--BD); background: var(--SURF);
  color: var(--MU); cursor: pointer;
  transition: all .12s; user-select: none;
}
.filter-chip:hover { border-color: var(--MU2); color: var(--INK); }
.filter-chip.active { background: var(--INK); color: #fff; border-color: var(--INK); }
.filter-chip.active svg { color: var(--Y); }

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

.cd-meta {
  display: flex; gap: 16px; flex-wrap: wrap; margin-bottom: 12px;
}
.cd-meta-item { font-size: .72rem; color: rgba(255,255,255,.5); }
.cd-meta-item strong { color: rgba(255,255,255,.8); font-weight: 600; }

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

.cd-actions-row {
  display: flex; gap: 8px; flex-wrap: wrap; justify-content: flex-end;
}
.cd-act-btn {
  display: inline-flex; align-items: center; gap: 5px;
  padding: 7px 12px; border-radius: 8px;
  font-family: var(--MONO); font-size: .66rem; font-weight: 700;
  border: 1px solid rgba(255,255,255,.15);
  background: rgba(255,255,255,.07); color: rgba(255,255,255,.8);
  cursor: pointer; transition: background .12s;
}
.cd-act-btn:hover { background: rgba(255,255,255,.12); }
.cd-act-btn svg { flex-shrink:0; }

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
  gap: 12px;
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

/* ── Feature badges ── */
.dc-features {
  display: flex; gap: 5px; flex-wrap: wrap;
}
.dc-feat {
  display: inline-flex; align-items: center; gap: 3px;
  font-family: var(--MONO);
  font-size: .55rem; font-weight: 700;
  padding: 3px 7px;
  border-radius: 5px;
}
.dc-feat.on  { background: rgba(16,185,129,.1); color: var(--GREEN); }
.dc-feat.off { background: var(--BD2); color: var(--MU2); }
.domain-card.premium .dc-feat.on  { background: rgba(16,185,129,.15); }
.domain-card.premium .dc-feat.off { background: rgba(255,255,255,.05); color: rgba(255,255,255,.25); }

/* ── Acceptance stars ── */
.dc-acceptance {
  display: flex; align-items: center; gap: 4px;
}
.dc-star { width: 13px; height: 13px; color: #F59E0B; }
.dc-star.off { color: var(--BD2); }
.dc-acceptance-lbl {
  font-family: var(--MONO); font-size: .58rem; font-weight: 700;
  color: var(--MU); margin-left: 4px;
}

/* ── Best For tags ── */
.dc-bestfor {
  display: flex; gap: 4px; flex-wrap: wrap;
}
.dc-bestfor-tag {
  font-size: .6rem; font-weight: 600;
  padding: 2px 8px; border-radius: 4px;
  background: rgba(59,130,246,.08); color: var(--B);
}
.domain-card.premium .dc-bestfor-tag { background: rgba(59,130,246,.15); color: #93C5FD; }
.dc-restriction {
  font-size: .64rem; color: var(--MU2); padding: 4px 0;
}
.domain-card.premium .dc-restriction { color: rgba(255,255,255,.35); }

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

/* ── Empty state ── */
.empty-state {
  display: none; flex-direction: column; align-items: center;
  justify-content: center; padding: 48px 20px; text-align: center;
  grid-column: 1 / -1;
}
.empty-state.show { display: flex; }
.empty-state-icon {
  width: 48px; height: 48px; border-radius: 12px;
  background: var(--BD2); display: flex; align-items: center;
  justify-content: center; color: var(--MU2); margin-bottom: 12px;
}
.empty-state-title { font-size: 1rem; font-weight: 700; color: var(--INK); margin-bottom: 4px; }
.empty-state-sub { font-size: .8rem; color: var(--MU); margin-bottom: 16px; }
.empty-state-btn {
  padding: 8px 18px; border-radius: 8px; border: 1px solid var(--BD);
  background: var(--SURF); color: var(--INK); font-weight: 600;
  cursor: pointer; font-size: .78rem;
}
.empty-state-btn:hover { background: var(--BD2); }

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

/* ── Drawer ── */
.drawer-overlay {
  position: fixed; inset:0; background:rgba(0,0,0,.35);
  z-index:950; display:none; animation:fade-in .15s ease both;
}
.drawer-overlay.open { display:block; }
@keyframes fade-in { from{opacity:0} to{opacity:1} }

.drawer {
  position:fixed; top:0; right:0; bottom:0; width:400px; max-width:92vw;
  background:var(--SURF); z-index:960; transform:translateX(100%);
  transition:transform .25s cubic-bezier(.4,0,.2,1);
  display:flex; flex-direction:column; overflow:hidden;
  box-shadow:-4px 0 24px rgba(0,0,0,.1);
}
.drawer.open { transform:translateX(0); }

.drawer-hd {
  display:flex; align-items:center; justify-content:space-between;
  padding:16px 20px; border-bottom:1px solid var(--BD); flex-shrink:0;
}
.drawer-hd-title { font-family:var(--DISP); font-size:1rem; color:var(--INK); }
.drawer-close {
  background:none; border:none; font-size:1.3rem; color:var(--MU);
  cursor:pointer; line-height:1; padding:0 4px;
}
.drawer-close:hover { color:var(--INK); }

.drawer-body {
  flex:1; overflow-y:auto; padding:20px;
}

.dr-section { margin-bottom:20px; }
.dr-label {
  font-family:var(--MONO); font-size:.58rem; font-weight:700;
  letter-spacing:.08em; text-transform:uppercase; color:var(--MU2);
  margin-bottom:6px;
}
.dr-name {
  font-family:var(--MONO); font-size:1.1rem; font-weight:700; color:var(--INK);
}
.dr-desc { font-size:.8rem; color:var(--MU); line-height:1.6; }

.dr-badge-row { display:flex; gap:6px; flex-wrap:wrap; }
.dr-badge {
  display:inline-flex; align-items:center; gap:4px;
  font-family:var(--MONO); font-size:.58rem; font-weight:700;
  padding:4px 10px; border-radius:6px;
}
.dr-badge.on { background:rgba(16,185,129,.1); color:var(--GREEN); }
.dr-badge.off { background:var(--BD2); color:var(--MU2); }

.dr-bestfor {
  display:flex; gap:6px; flex-wrap:wrap;
}
.dr-bestfor-tag {
  font-size:.72rem; font-weight:600; padding:4px 10px;
  border-radius:6px; background:rgba(59,130,246,.08); color:var(--B);
}

.dr-stars { display:flex; gap:3px; align-items:center; }
.dr-stars svg { width:18px; height:18px; color:#F59E0B; }
.dr-stars svg.off { color:var(--BD2); }
.dr-stars-lbl { font-size:.78rem; color:var(--MU); margin-left:6px; font-weight:600; }

.dr-restriction {
  font-size:.74rem; color:var(--MU2); padding:8px 10px;
  background:var(--BG); border-radius:6px; line-height:1.5;
}

.drawer-ft {
  padding:14px 20px; border-top:1px solid var(--BD);
  display:flex; gap:8px; flex-shrink:0;
}
.drawer-ft .dc-btn { width:auto; flex:1; }

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

/* ══════════════════════════════════════════
   CUSTOM DOMAINS (PRO)
═══════════════════════════════════════════ */

.cd-section {
  margin-bottom: 28px;
}

.cd-header {
  display: flex; align-items: center; justify-content: space-between;
  margin-bottom: 14px; gap: 10px; flex-wrap: wrap;
}

.cd-header-left {
  display: flex; align-items: center; gap: 10px;
}

.cd-header-title {
  font-family: var(--DISP);
  font-size: 1.15rem;
  letter-spacing: .04em;
  color: var(--INK);
  display: flex; align-items: center; gap: 8px;
}

.cd-pro-badge {
  font-family: var(--MONO);
  font-size: .52rem; font-weight: 800;
  letter-spacing: .06em;
  padding: 2px 7px;
  border-radius: 5px;
  background: linear-gradient(135deg, #7C3AED, #6D28D9);
  color: #fff;
  text-transform: uppercase;
}

.cd-add-btn {
  display: inline-flex; align-items: center; gap: 6px;
  padding: 8px 14px; border-radius: 8px;
  font-family: var(--MONO); font-size: .7rem; font-weight: 700;
  background: var(--INK); color: #fff; border: none;
  cursor: pointer; transition: background .12s;
}
.cd-add-btn:hover { background: var(--INK2); }
.cd-add-btn:disabled {
  background: var(--BD2); color: var(--MU2); cursor: not-allowed;
}

/* ── Custom domain stat row ── */
.cd-stats-row {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 10px;
  margin-bottom: 16px;
}
@media (min-width: 640px) { .cd-stats-row { grid-template-columns: repeat(3, 1fr); } }

.cd-stat {
  background: var(--SURF);
  border: 1px solid var(--BD);
  border-radius: 10px;
  padding: 12px 14px;
  transition: box-shadow .2s;
}
.cd-stat:hover { box-shadow: 0 2px 10px rgba(0,0,0,.05); }

.cd-stat-val {
  font-family: var(--DISP); font-size: 1.4rem;
  color: var(--INK); line-height: 1;
}
.cd-stat-lbl { font-size: .68rem; color: var(--MU); font-weight: 500; margin-top: 2px; }

/* ── Custom domain filter chips ── */
.cd-filter-chips {
  display: flex; gap: 5px; flex-wrap: wrap; margin-bottom: 14px;
}
.cd-filter-chip {
  display: inline-flex; align-items: center; gap: 4px;
  font-family: var(--MONO); font-size: .56rem; font-weight: 700;
  padding: 4px 10px; border-radius: 16px;
  border: 1px solid var(--BD); background: var(--SURF);
  color: var(--MU); cursor: pointer;
  transition: all .12s; user-select: none;
}
.cd-filter-chip:hover { border-color: var(--MU2); color: var(--INK); }
.cd-filter-chip.active { background: var(--INK); color: #fff; border-color: var(--INK); }

/* ── Custom domain cards grid ── */
.cd-grid {
  display: grid;
  grid-template-columns: 1fr;
  gap: 12px;
  margin-bottom: 8px;
}
@media (min-width: 580px) { .cd-grid { grid-template-columns: repeat(2, 1fr); } }
@media (min-width: 900px) { .cd-grid { grid-template-columns: repeat(3, 1fr); } }

/* ── Custom domain card ── */
.cd-card {
  background: var(--SURF);
  border: 1.5px solid var(--BD);
  border-radius: 12px;
  padding: 16px;
  display: flex;
  flex-direction: column;
  gap: 10px;
  position: relative;
  transition: border-color .2s, box-shadow .2s;
}
.cd-card:hover { border-color: #D1D5DB; box-shadow: 0 4px 14px rgba(0,0,0,.06); }
.cd-card.selected { border-color: var(--Y); box-shadow: 0 0 0 1px var(--Y), 0 4px 16px rgba(250,204,21,.12); }
.cd-card.verified { border-left: 3px solid var(--GREEN); }
.cd-card.pending { border-left: 3px solid #F59E0B; }
.cd-card.failed { border-left: 3px solid #EF4444; }

.cdc-top {
  display: flex; align-items: flex-start; justify-content: space-between; gap: 8px;
}
.cdc-name {
  font-family: var(--MONO); font-size: .82rem; font-weight: 700;
  color: var(--INK); word-break: break-all;
}
.cdc-domain-icon {
  width: 30px; height: 30px; min-width: 30px;
  border-radius: 8px; background: rgba(59,130,246,.1);
  color: var(--B); display: flex; align-items: center;
  justify-content: center; flex-shrink: 0;
}

.cdc-selected-badge {
  display: inline-flex; align-items: center; gap: 3px;
  font-family: var(--MONO); font-size: .52rem; font-weight: 700;
  padding: 2px 7px; border-radius: 4px;
  background: rgba(250,204,21,.15); color: #92400E;
}

/* ── Status badge ── */
.cdc-status {
  display: inline-flex; align-items: center; gap: 5px;
  font-family: var(--MONO); font-size: .56rem; font-weight: 700;
  padding: 3px 9px; border-radius: 12px;
}
.cdc-status.verified { background: rgba(16,185,129,.1); color: var(--GREEN); }
.cdc-status.pending  { background: rgba(245,158,11,.1);  color: #B45309; }
.cdc-status.failed   { background: rgba(239,68,68,.1);   color: #DC2626; }

.cdc-status-dot {
  width: 5px; height: 5px; border-radius: 50%;
}
.cdc-status.verified .cdc-status-dot { background: var(--GREEN); }
.cdc-status.pending .cdc-status-dot  { background: #F59E0B; animation: pulse-dot 1.5s ease-in-out infinite; }
.cdc-status.failed .cdc-status-dot   { background: #EF4444; }

@keyframes pulse-dot {
  0%,100% { opacity: 1; }
  50%     { opacity: .3; }
}

.cdc-meta {
  display: flex; gap: 6px; flex-wrap: wrap; font-size: .66rem; color: var(--MU);
}
.cdc-meta span { display: inline-flex; align-items: center; gap: 3px; }

/* ── DNS summary rows ── */
.cdc-dns {
  display: grid; grid-template-columns: repeat(2, 1fr); gap: 4px;
}
.cdc-dns-item {
  display: flex; align-items: center; gap: 4px;
  font-family: var(--MONO); font-size: .55rem; font-weight: 600;
  padding: 3px 6px; border-radius: 4px;
}
.cdc-dns-item.verified { color: var(--GREEN); }
.cdc-dns-item.pending  { color: #F59E0B; }
.cdc-dns-item.failed   { color: #DC2626; }

.cdc-dns-icon { width: 11px; height: 11px; flex-shrink: 0; }

/* ── Actions row ── */
.cdc-actions {
  display: flex; gap: 5px; flex-wrap: wrap; margin-top: auto;
}
.cdc-act {
  display: inline-flex; align-items: center; gap: 4px;
  padding: 5px 9px; border-radius: 6px;
  font-family: var(--MONO); font-size: .56rem; font-weight: 700;
  border: 1px solid var(--BD); background: var(--SURF);
  color: var(--MU); cursor: pointer;
  transition: background .12s, color .12s;
}
.cdc-act:hover { background: var(--BD2); color: var(--INK); }
.cdc-act.primary { background: var(--INK); color: #fff; border-color: var(--INK); }
.cdc-act.primary:hover { background: var(--INK2); }
.cdc-act.danger { color: #DC2626; border-color: rgba(239,68,68,.2); }
.cdc-act.danger:hover { background: rgba(239,68,68,.08); }
.cdc-act:disabled { opacity: .5; cursor: not-allowed; }

/* ── Empty state for custom domains ── */
.cd-empty {
  display: none; flex-direction: column; align-items: center;
  padding: 32px 16px; text-align: center; grid-column: 1 / -1;
}
.cd-empty.show { display: flex; }
.cd-empty-icon {
  width: 40px; height: 40px; border-radius: 10px;
  background: var(--BD2); display: flex; align-items: center;
  justify-content: center; color: var(--MU2); margin-bottom: 10px;
}
.cd-empty-title { font-size: .9rem; font-weight: 700; color: var(--INK); margin-bottom: 2px; }
.cd-empty-sub { font-size: .74rem; color: var(--MU); margin-bottom: 12px; }

/* ══════════════════════════════════════════
   ADD CUSTOM DOMAIN MODAL
═══════════════════════════════════════════ */

.modal-overlay {
  position: fixed; inset: 0; background: rgba(0,0,0,.45);
  z-index: 980; display: none; animation: fade-in .12s ease both;
}
.modal-overlay.open { display: block; }

.modal {
  position: fixed; top: 50%; left: 50%; transform: translate(-50%,-50%) scale(.95);
  width: 520px; max-width: 94vw; max-height: 90vh;
  background: var(--SURF); border-radius: 14px;
  z-index: 990; display: none; flex-direction: column;
  box-shadow: 0 8px 32px rgba(0,0,0,.15);
  transition: transform .2s cubic-bezier(.34,1.56,.64,1), opacity .15s;
  opacity: 0;
}
.modal.open { display: flex; transform: translate(-50%,-50%) scale(1); opacity: 1; }

.modal-hd {
  display: flex; align-items: center; justify-content: space-between;
  padding: 16px 20px; border-bottom: 1px solid var(--BD); flex-shrink: 0;
}
.modal-hd-title {
  font-family: var(--DISP); font-size: 1rem; color: var(--INK);
  display: flex; align-items: center; gap: 8px;
}
.modal-close {
  background: none; border: none; font-size: 1.4rem; color: var(--MU);
  cursor: pointer; line-height: 1; padding: 0 4px;
}
.modal-close:hover { color: var(--INK); }

.modal-body {
  flex: 1; overflow-y: auto; padding: 20px;
}

.modal-ft {
  padding: 14px 20px; border-top: 1px solid var(--BD);
  display: flex; gap: 8px; justify-content: flex-end; flex-shrink: 0;
}
.modal-ft .btn {
  padding: 8px 18px; border-radius: 8px;
  font-family: var(--MONO); font-size: .72rem; font-weight: 700;
  border: none; cursor: pointer; transition: background .12s;
}
.modal-ft .btn-primary { background: var(--INK); color: #fff; }
.modal-ft .btn-primary:hover { background: var(--INK2); }
.modal-ft .btn-secondary { background: var(--BD2); color: var(--INK); }
.modal-ft .btn-secondary:hover { background: #D1D5DB; }

/* ── Domain input ── */
.modal-input-wrap { margin-bottom: 16px; }
.modal-input-wrap label {
  display: block; font-family: var(--MONO); font-size: .62rem;
  font-weight: 700; color: var(--MU); margin-bottom: 5px;
  letter-spacing: .04em; text-transform: uppercase;
}
.modal-input {
  width: 100%; padding: 10px 12px; border: 1.5px solid var(--BD);
  border-radius: 8px; background: var(--BG); color: var(--INK);
  font-family: var(--MONO); font-size: .8rem;
  transition: border-color .15s; box-sizing: border-box;
}
.modal-input:focus { outline: none; border-color: var(--Y); }
.modal-input-error {
  border-color: #EF4444 !important;
}
.modal-hint {
  font-size: .68rem; color: var(--MU2); margin-top: 4px;
}
.modal-error {
  color: #DC2626; font-size: .72rem; font-weight: 600;
  margin-bottom: 8px; display: none;
}

/* ── DNS Wizard ── */
.dns-wizard { display: flex; flex-direction: column; gap: 12px; }

.dns-welcome {
  text-align: center; padding: 12px 0;
}
.dns-welcome-icon {
  width: 44px; height: 44px; border-radius: 12px;
  background: rgba(59,130,246,.1); color: var(--B);
  display: flex; align-items: center; justify-content: center;
  margin: 0 auto 10px;
}
.dns-welcome-title { font-size: .9rem; font-weight: 700; color: var(--INK); margin-bottom: 4px; }
.dns-welcome-sub { font-size: .74rem; color: var(--MU); line-height: 1.5; }

.dns-record-group { border: 1px solid var(--BD); border-radius: 10px; overflow: hidden; }
.dns-record-hd {
  display: flex; align-items: center; justify-content: space-between;
  padding: 10px 14px; background: var(--BG); border-bottom: 1px solid var(--BD);
}
.dns-record-type {
  font-family: var(--MONO); font-size: .6rem; font-weight: 800;
  letter-spacing: .06em; text-transform: uppercase;
  padding: 2px 7px; border-radius: 4px;
}
.dns-record-type.mx  { background: rgba(59,130,246,.1); color: var(--B); }
.dns-record-type.spf { background: rgba(16,185,129,.1); color: var(--GREEN); }
.dns-record-type.dkim { background: rgba(124,58,237,.1); color: #7C3AED; }
.dns-record-type.txt { background: rgba(250,204,21,.12); color: #92400E; }

.dns-record-status {
  display: flex; align-items: center; gap: 4px;
  font-family: var(--MONO); font-size: .56rem; font-weight: 700;
}
.dns-record-status.verified { color: var(--GREEN); }
.dns-record-status.pending { color: #F59E0B; }
.dns-record-status.failed { color: #DC2626; }

.dns-record-body { padding: 10px 14px; }
.dns-record-label {
  font-family: var(--MONO); font-size: .54rem; font-weight: 700;
  color: var(--MU2); letter-spacing: .04em; text-transform: uppercase;
  margin-bottom: 4px;
}
.dns-record-value {
  font-family: var(--MONO); font-size: .68rem; color: var(--INK);
  background: var(--SURF); padding: 6px 10px; border-radius: 6px;
  border: 1px solid var(--BD); word-break: break-all; line-height: 1.5;
  max-height: 60px; overflow-y: auto;
}
.dns-record-copy {
  margin-top: 4px; font-family: var(--MONO); font-size: .6rem; font-weight: 700;
  color: var(--B); cursor: pointer; background: none; border: none;
  padding: 0; display: inline-flex; align-items: center; gap: 3px;
}
.dns-record-copy:hover { text-decoration: underline; }

.dns-verify-btn {
  display: inline-flex; align-items: center; gap: 6px;
  padding: 8px 18px; border-radius: 8px;
  font-family: var(--MONO); font-size: .72rem; font-weight: 700;
  background: var(--INK); color: #fff; border: none;
  cursor: pointer; transition: background .12s;
  margin-top: 6px;
}
.dns-verify-btn:hover { background: var(--INK2); }
.dns-verify-btn:disabled { opacity: .5; cursor: not-allowed; }
.dns-verify-btn.verifying {
  position: relative; pointer-events: none;
}
.dns-verify-btn.verifying::after {
  content: ''; width: 12px; height: 12px;
  border: 2px solid transparent;
  border-top-color: #fff; border-radius: 50%;
  animation: spin .6s linear infinite;
  display: inline-block;
}
@keyframes spin { to { transform: rotate(360deg); } }

.dns-all-verified {
  display: none; align-items: center; gap: 8px;
  padding: 10px 14px; background: rgba(16,185,129,.08);
  border: 1px solid rgba(16,185,129,.2); border-radius: 8px;
  color: var(--GREEN); font-weight: 700; font-size: .78rem;
}
.dns-all-verified.show { display: flex; }

/* ── Verify spinner inside modal buttons ── */
.spinner {
  display: inline-block; width: 14px; height: 14px;
  border: 2px solid rgba(255,255,255,.3);
  border-top-color: #fff; border-radius: 50%;
  animation: spin .5s linear infinite;
}

/* ── Mobile responsive for custom domains ── */
@media (max-width: 640px) {
  .cd-header { flex-direction: column; align-items: stretch; }
  .cd-add-btn { justify-content: center; }
  .cdc-actions { flex-direction: column; }
  .cdc-act { justify-content: center; }
  .cdc-dns { grid-template-columns: 1fr; }
}

/* ── Mobile responsive ── */
@media (max-width: 640px) {
  .page-toolbar { flex-direction: column; align-items: stretch; }
  .domain-search-wrap { max-width: 100%; }
  .filter-chips { overflow-x: auto; flex-wrap: nowrap; padding-bottom: 4px; }
  .filter-chip { flex-shrink: 0; }
  .cd-actions { width: 100%; align-items: stretch; }
  .cd-actions-row { justify-content: stretch; }
  .cd-act-btn { flex: 1; justify-content: center; }
  .current-domain-card { flex-direction: column; }
}
</style>
@endpush

@section('content')

<!-- ── Page Header ── -->
<div class="page-hd">
  <div>
    <div class="page-title">Domains</div>
    <div class="page-subtitle">Choose the best domain for your temporary email or alias.</div>
  </div>
  <div class="page-toolbar">
    <div class="domain-search-wrap">
      <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><circle cx="11" cy="11" r="8"/><path stroke-linecap="round" d="M21 21l-4.35-4.35"/></svg>
      <input type="text" id="domain-search" placeholder="Search domains, features…" oninput="filterDomains()" aria-label="Search domains">
    </div>
    <select class="domain-filter-select" id="domain-filter" onchange="filterDomains()" aria-label="Filter by type">
      <option value="all">All</option>
      <option value="free">Free</option>
      <option value="premium">Premium</option>
      <option value="otp">OTP Support</option>
      <option value="alias">Alias Support</option>
      <option value="popular">Recommended</option>
      <option value="new">Recently Added</option>
    </select>
    <button class="btn-ghost" onclick="refreshPage()" aria-label="Refresh domains">
      <svg id="refresh-ic" width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
        <path stroke-linecap="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
      </svg>
      Refresh
    </button>
  </div>
</div>

<!-- ── Filter chips ── -->
<div class="filter-chips" id="filter-chips">
  <span class="filter-chip active" data-filter="all" tabindex="0" role="button" onclick="setChipFilter('all',this)">All</span>
  <span class="filter-chip" data-filter="free" tabindex="0" role="button" onclick="setChipFilter('free',this)">Free</span>
  <span class="filter-chip" data-filter="premium" tabindex="0" role="button" onclick="setChipFilter('premium',this)">Premium</span>
  <span class="filter-chip" data-filter="alias" tabindex="0" role="button" onclick="setChipFilter('alias',this)">Alias</span>
  <span class="filter-chip" data-filter="otp" tabindex="0" role="button" onclick="setChipFilter('otp',this)">OTP</span>
  <span class="filter-chip" data-filter="attachments" tabindex="0" role="button" onclick="setChipFilter('attachments',this)">Attachments</span>
  <span class="filter-chip" data-filter="popular" tabindex="0" role="button" onclick="setChipFilter('popular',this)">Recommended</span>
  <span class="filter-chip" data-filter="new" tabindex="0" role="button" onclick="setChipFilter('new',this)">New</span>
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
    <div class="stat-c-val" id="stat-total">0</div>
    <div class="stat-c-lbl">Total Domains</div>
    <div class="stat-c-sub" id="stat-total-sub" style="color:var(--MU2);">All available domains</div>
  </div>

  <div class="stat-c">
    <div class="stat-c-top">
      <div class="stat-c-icon sci-g">
        <svg width="17" height="17" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
          <path stroke-linecap="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
      </div>
    </div>
    <div class="stat-c-val" id="stat-free">0</div>
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
    <div class="stat-c-val" id="stat-premium">0</div>
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
    <div class="stat-c-val" id="stat-active-domain" style="font-size:1.1rem;font-family:var(--MONO);">—</div>
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
  <span class="section-hd-meta" id="cd-meta-info">Selected since today</span>
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
    <div class="cd-name" id="current-domain-name">@<span>—</span></div>

    <div class="cd-meta">
      <span class="cd-meta-item"><strong id="cd-plan">Free</strong> plan</span>
      <span class="cd-meta-item">Selected <strong id="cd-since">today</strong></span>
    </div>

    <div class="cd-features" id="cd-features">
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
        Fast Delivery
      </div>
    </div>
  </div>

  <div class="cd-actions">
    <div class="cd-status">
      <div class="cd-pulse"></div>
      Status: Active
    </div>
    <div class="cd-actions-row">
      <button class="cd-act-btn" onclick="copyCurrentDomain()" aria-label="Copy domain">
        <svg width="11" height="11" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><rect x="9" y="9" width="13" height="13" rx="2"/><path stroke-linecap="round" d="M5 15H4a2 2 0 01-2-2V4a2 2 0 012-2h9a2 2 0 012 2v1"/></svg>
        Copy
      </button>
      <button class="cd-act-btn" onclick="scrollToDomains()" aria-label="Change domain">
        <svg width="11" height="11" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/></svg>
        Change Domain
      </button>
    </div>
  </div>
</div>

<!-- ══════════════════════════════════════════
     CUSTOM DOMAINS (PRO FEATURE)
═══════════════════════════════════════════ -->
<div class="cd-section" id="custom-domains-section">

  <div class="cd-header">
    <div class="cd-header-left">
      <div class="cd-header-title">
        <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
          <path stroke-linecap="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
        </svg>
        Custom Domains
      </div>
      <span class="cd-pro-badge">PRO</span>
    </div>
    <div style="display:flex;align-items:center;gap:8px;flex-wrap:wrap;">
      <div class="domain-search-wrap" style="min-width:140px;max-width:200px;flex:none;">
        <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><circle cx="11" cy="11" r="8"/><path stroke-linecap="round" d="M21 21l-4.35-4.35"/></svg>
        <input type="text" id="cd-search" placeholder="Search custom domains…" oninput="filterCustomDomains()" aria-label="Search custom domains" style="font-size:.7rem;padding:6px 8px 6px 26px;">
      </div>
      <button class="cd-add-btn" id="cd-add-btn" onclick="openAddCustomDomain()" aria-label="Add custom domain">
        <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M12 4v16m8-8H4"/></svg>
        Add Custom Domain
      </button>
    </div>
  </div>

  <!-- ── Custom Domain Stats ── -->
  <div class="cd-stats-row">
    <div class="cd-stat">
      <div class="cd-stat-val" id="cd-stat-total">0</div>
      <div class="cd-stat-lbl">Custom Domains</div>
    </div>
    <div class="cd-stat">
      <div class="cd-stat-val" id="cd-stat-verified" style="color:var(--GREEN);">0</div>
      <div class="cd-stat-lbl">Verified</div>
    </div>
    <div class="cd-stat">
      <div class="cd-stat-val" id="cd-stat-pending" style="color:#F59E0B;">0</div>
      <div class="cd-stat-lbl">Pending</div>
    </div>
  </div>

  <!-- ── Custom Domain filter chips ── -->
  <div class="cd-filter-chips" id="cd-filter-chips">
    <span class="cd-filter-chip active" data-cd-filter="all" tabindex="0" role="button" onclick="setCdChipFilter('all',this)">All</span>
    <span class="cd-filter-chip" data-cd-filter="verified" tabindex="0" role="button" onclick="setCdChipFilter('verified',this)">
      <span style="width:5px;height:5px;background:var(--GREEN);border-radius:50%;display:inline-block;"></span>
      Verified
    </span>
    <span class="cd-filter-chip" data-cd-filter="pending" tabindex="0" role="button" onclick="setCdChipFilter('pending',this)">
      <span style="width:5px;height:5px;background:#F59E0B;border-radius:50%;display:inline-block;"></span>
      Pending
    </span>
    <span class="cd-filter-chip" data-cd-filter="failed" tabindex="0" role="button" onclick="setCdChipFilter('failed',this)">
      <span style="width:5px;height:5px;background:#EF4444;border-radius:50%;display:inline-block;"></span>
      Failed
    </span>
  </div>

  <!-- ── Custom domain cards grid ── -->
  <div class="cd-grid" id="cd-grid">
    <!-- Cards injected by JS -->
    <div class="cd-empty" id="cd-empty">
      <div class="cd-empty-icon">
        <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
          <path stroke-linecap="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
        </svg>
      </div>
      <div class="cd-empty-title">No custom domains yet</div>
      <div class="cd-empty-sub" id="cd-empty-msg">Add your own domain to use it with InboxOro.</div>
    </div>
  </div>

  <!-- Pro upgrade prompt for free users instead of "Add Custom Domain" -->
  <div id="cd-pro-prompt" style="display:none;text-align:center;padding:16px 0;">
    <button class="cd-add-btn" onclick="showUpgrade()" style="background:linear-gradient(135deg,#7C3AED,#6D28D9);">
      <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M12 4v16m8-8H4"/></svg>
      Upgrade to Pro for Custom Domains
    </button>
  </div>

</div>

<!-- ── Add / Edit Custom Domain Modal ── -->
<div class="modal-overlay" id="cd-modal-overlay" onclick="closeCdModal()"></div>
<div class="modal" id="cd-modal">
  <div class="modal-hd">
    <span class="modal-hd-title" id="cd-modal-title">
      <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
      Add Custom Domain
    </span>
    <button class="modal-close" onclick="closeCdModal()">&times;</button>
  </div>
  <div class="modal-body" id="cd-modal-body">
    <div id="cd-modal-error" class="modal-error"></div>

    <!-- Step 1: Domain Input -->
    <div id="cd-step-input">
      <div class="modal-input-wrap">
        <label for="cd-domain-input">Domain Name</label>
        <input type="text" class="modal-input" id="cd-domain-input" placeholder="e.g. mydomain.com" autocomplete="off" spellcheck="false">
        <div class="modal-hint">Enter the domain you want to use for receiving emails. You must own this domain.</div>
      </div>
    </div>

    <!-- Step 2: DNS Wizard (shown after domain is added) -->
    <div id="cd-step-dns" style="display:none;">
      <div class="dns-wizard">
        <div class="dns-welcome">
          <div class="dns-welcome-icon">
            <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
          </div>
          <div class="dns-welcome-title">Verify Your Domain</div>
          <div class="dns-welcome-sub">Add the following DNS records to your domain provider. Once added, click "Verify DNS" to confirm.</div>
        </div>

        <div id="dns-records-container">
          <!-- Injected by JS -->
        </div>

        <div style="text-align:center;">
          <button class="dns-verify-btn" id="dns-verify-btn" onclick="verifyDnsRecords()">
            <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            Verify DNS Records
          </button>
        </div>

        <div class="dns-all-verified" id="dns-all-verified">
          <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
          All DNS records verified! Your domain is ready to use.
        </div>

        <div id="cd-dns-domain-id" style="display:none;"></div>
      </div>
    </div>
  </div>
  <div class="modal-ft" id="cd-modal-ft">
    <button class="btn btn-secondary" onclick="closeCdModal()">Cancel</button>
    <button class="btn btn-primary" id="cd-modal-submit" onclick="submitCustomDomain()">
      <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
      Add Domain
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
  <div class="empty-state" id="empty-state">
    <div class="empty-state-icon">
      <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><path stroke-linecap="round" d="M21 21l-4.35-4.35"/></svg>
    </div>
    <div class="empty-state-title">No domains found</div>
    <div class="empty-state-sub" id="empty-state-msg">Try adjusting your search or filters.</div>
    <button class="empty-state-btn" onclick="clearFilters()">Clear Filters</button>
  </div>
</div>

<!-- ── Drawer ── -->
<div class="drawer-overlay" id="drawer-overlay" onclick="closeDrawer()"></div>
<div class="drawer" id="drawer">
  <div class="drawer-hd">
    <span class="drawer-hd-title" id="drawer-title">Domain Details</span>
    <button class="drawer-close" onclick="closeDrawer()">&times;</button>
  </div>
  <div class="drawer-body" id="drawer-body">
    <div class="dr-section">
      <div class="dr-label">Domain</div>
      <div class="dr-name" id="dr-name">—</div>
    </div>
    <div class="dr-section">
      <div class="dr-label">Description</div>
      <div class="dr-desc" id="dr-desc">—</div>
    </div>
    <div class="dr-section">
      <div class="dr-label">Status</div>
      <div class="dr-badge-row" id="dr-status"></div>
    </div>
    <div class="dr-section">
      <div class="dr-label">Supported Features</div>
      <div class="dr-badge-row" id="dr-features"></div>
    </div>
    <div class="dr-section">
      <div class="dr-label">Best For</div>
      <div class="dr-bestfor" id="dr-bestfor"></div>
    </div>
    <div class="dr-section">
      <div class="dr-label">Acceptance Rating</div>
      <div class="dr-stars" id="dr-stars"></div>
    </div>
    <div class="dr-section" id="dr-restriction-section" style="display:none;">
      <div class="dr-label">Restrictions</div>
      <div class="dr-restriction" id="dr-restriction"></div>
    </div>
  </div>
  <div class="drawer-ft" id="drawer-ft"></div>
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
    desc: 'Reliable domain accepted by most websites.',
    features: { email: true, alias: true, otp: true, attachments: true, autoDelete: true, fastDelivery: true },
    bestFor: ['Social Media', 'Newsletters', 'Verification'],
    acceptance: 5, restrictions: '',
    selected: true, popular: true,
  },
  {
    id: 'burnbox.dev', name: 'burnbox.dev', type: 'free',
    desc: 'Developer-friendly domain. Great for testing workflows and CI/CD.',
    features: { email: true, alias: true, otp: true, attachments: true, autoDelete: true, fastDelivery: true },
    bestFor: ['Testing', 'Development', 'CI/CD'],
    acceptance: 4, restrictions: '',
    selected: false,
  },
  {
    id: 'zaptmp.net', name: 'zaptmp.net', type: 'free',
    desc: 'Lightweight domain with fast delivery speeds and broad acceptance.',
    features: { email: true, alias: false, otp: true, attachments: false, autoDelete: true, fastDelivery: true },
    bestFor: ['Quick Signups', 'OTP Codes', 'Social Media'],
    acceptance: 4, restrictions: '',
    selected: false,
  },
  {
    id: 'voidmail.cc', name: 'voidmail.cc', type: 'free',
    desc: 'Privacy-focused domain with minimal logging.',
    features: { email: true, alias: true, otp: false, attachments: false, autoDelete: true, fastDelivery: true },
    bestFor: ['Privacy', 'One-off Use', 'Aliases'],
    acceptance: 3, restrictions: 'Some banking websites may reject this domain.',
    selected: false,
  },
  {
    id: 'mailsink.app', name: 'mailsink.app', type: 'free', popular: true,
    desc: 'Popular all-purpose inbox. Accepted by most services.',
    features: { email: true, alias: true, otp: true, attachments: true, autoDelete: true, fastDelivery: true },
    bestFor: ['Social Media', 'Shopping', 'AI Tools'],
    acceptance: 5, restrictions: '',
    selected: false,
  },
  /* ── PREMIUM ── */
  {
    id: 'secureinbox.io', name: 'secureinbox.io', type: 'premium',
    desc: 'High-reputation secure domain that bypasses strict filters.',
    features: { email: true, alias: true, otp: true, attachments: true, autoDelete: true, fastDelivery: true },
    bestFor: ['Banking', 'Finance', 'Business'],
    acceptance: 5, restrictions: '',
    selected: false,
  },
  {
    id: 'privmail.net', name: 'privmail.net', type: 'premium',
    desc: 'Zero-log privacy domain with encrypted email delivery.',
    features: { email: true, alias: true, otp: true, attachments: true, autoDelete: true, fastDelivery: true },
    bestFor: ['Privacy', 'Legal', 'Sensitive Accounts'],
    acceptance: 5, restrictions: '',
    selected: false,
  },
  {
    id: 'flashbox.dev', name: 'flashbox.dev', type: 'premium', exclusive: true,
    desc: 'Exclusive domain with sub-second delivery and rare prefix.',
    features: { email: true, alias: true, otp: true, attachments: true, autoDelete: true, fastDelivery: true },
    bestFor: ['Development', 'APIs', 'Automation'],
    acceptance: 5, restrictions: '',
    selected: false,
  },
  {
    id: 'shieldmail.org', name: 'shieldmail.org', type: 'premium',
    desc: 'Trusted .org domain accepted everywhere with high deliverability.',
    features: { email: true, alias: true, otp: true, attachments: true, autoDelete: true, fastDelivery: true },
    bestFor: ['Enterprise', 'Government', 'Professional Use'],
    acceptance: 5, restrictions: '',
    selected: false,
  },
];

const IS_PRO = false;
let activeDomain = 'dropit.io';
let currentFilter = 'all';

/* ── Render domain cards ── */
function renderDomains() {
  const grid = document.getElementById('domain-grid');
  const empty = document.getElementById('empty-state');
  const searchVal = (document.getElementById('domain-search').value || '').toLowerCase();
  const filterVal = currentFilter;

  const filtered = DOMAINS_DATA.filter(function(d) {
    if (filterVal === 'free' && d.type !== 'free') return false;
    if (filterVal === 'premium' && d.type !== 'premium') return false;
    if (filterVal === 'otp' && !d.features.otp) return false;
    if (filterVal === 'alias' && !d.features.alias) return false;
    if (filterVal === 'popular' && !d.popular) return false;
    if (filterVal === 'attachments' && !d.features.attachments) return false;
    if (searchVal) {
      var match = d.name.includes(searchVal) || d.desc.toLowerCase().includes(searchVal);
      d.bestFor.forEach(function(b) { if (b.toLowerCase().includes(searchVal)) match = true; });
      return match;
    }
    return true;
  });

  empty.classList.remove('show');

  if (!filtered.length) {
    grid.innerHTML = '';
    grid.appendChild(empty);
    empty.classList.add('show');
    document.getElementById('empty-state-msg').textContent =
      searchVal ? 'No domains match "' + searchVal + '".' : 'No domains match this filter.';
    updateStats();
    return;
  }

  updateStats();

  grid.innerHTML = filtered.map(function(d) {
    var isSelected = d.id === activeDomain;
    var isPremium = d.type === 'premium';

    var cardClass = 'domain-card';
    if (isPremium) cardClass += ' premium';
    if (isSelected) cardClass += ' selected';

    var btnHtml;
    if (isPremium && !IS_PRO) {
      btnHtml = '<button class="dc-btn upgrade" onclick="showUpgrade()">' +
        '<svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">' +
        '<path stroke-linecap="round" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg> Upgrade to Select</button>';
    } else if (isSelected) {
      btnHtml = '<button class="dc-btn selected" disabled>' +
        '<svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">' +
        '<path stroke-linecap="round" d="M5 13l4 4L19 7"/></svg> Selected</button>';
    } else {
      btnHtml = '<button class="dc-btn select" onclick="event.stopPropagation();selectDomain(\'' + d.id + '\')">' +
        '<svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">' +
        '<path stroke-linecap="round" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg> Select Domain</button>';
    }

    var lockHtml = isPremium ? '<div class="dc-lock"><svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg></div>' : '';

    var typeBadge = d.exclusive
      ? '<span class="dc-type popular">✦ Exclusive</span>'
      : d.popular
        ? '<span class="dc-type popular">🔥 Popular</span>'
        : '<span class="dc-type ' + d.type + '">' + (d.type === 'premium' ? '⭐ Premium' : '✓ Free') + '</span>';

    var iconStyle = isPremium ? 'premium' : isSelected ? 'selected-ic' : 'free';

    var featHtml = '';
    ['email','alias','otp','attachments','autoDelete'].forEach(function(k) {
      featHtml += '<span class="dc-feat ' + (d.features[k] ? 'on' : 'off') + '">' +
        '<svg width="9" height="9" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">' +
        (d.features[k]
          ? '<path stroke-linecap="round" d="M5 13l4 4L19 7"/>'
          : '<path stroke-linecap="round" d="M6 18L18 6M6 6l12 12"/>') +
        '</svg>' +
        k.charAt(0).toUpperCase() + k.slice(1) +
      '</span>';
    });

    var starHtml = '';
    for (var s = 1; s <= 5; s++) {
      starHtml += '<svg class="dc-star' + (s > d.acceptance ? ' off' : '') + '" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>';
    }
    var accLbl = d.acceptance === 5 ? 'Excellent' : d.acceptance === 4 ? 'Good' : 'Average';

    var bestForHtml = d.bestFor.map(function(b) {
      return '<span class="dc-bestfor-tag">' + b + '</span>';
    }).join('');

    var restrictionHtml = d.restrictions
      ? '<div class="dc-restriction">' + d.restrictions + '</div>'
      : '';

    var onClick = isPremium && !IS_PRO
      ? 'showUpgrade()'
      : 'openDrawer(\'' + d.id + '\')';

    return '<div class="' + cardClass + '" onclick="' + onClick + '">' +
      lockHtml +
      '<div class="dc-top">' +
        '<div class="dc-icon ' + iconStyle + '">' +
          (isSelected
            ? '<svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M5 13l4 4L19 7"/></svg>'
            : '<svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path stroke-linecap="round" d="M2 12h20M12 2a15.3 15.3 0 010 20M12 2a15.3 15.3 0 000 20"/></svg>') +
        '</div>' +
        typeBadge +
      '</div>' +
      '<div><div class="dc-name">@' + d.name + '</div><div class="dc-desc">' + d.desc + '</div></div>' +
      '<div class="dc-features">' + featHtml + '</div>' +
      '<div class="dc-acceptance">' + starHtml + '<span class="dc-acceptance-lbl">' + accLbl + '</span></div>' +
      (bestForHtml ? '<div class="dc-bestfor">' + bestForHtml + '</div>' : '') +
      restrictionHtml +
      btnHtml +
    '</div>';
  }).join('');
}

/* ── Update stat counters ── */
function updateStats() {
  var total = DOMAINS_DATA.length;
  var freeCount = 0;
  var premiumCount = 0;
  DOMAINS_DATA.forEach(function(d) {
    if (d.type === 'free') freeCount++;
    else premiumCount++;
  });
  document.getElementById('stat-total').textContent = total;
  document.getElementById('stat-total-sub').textContent = freeCount + ' free &middot; ' + premiumCount + ' premium';
  document.getElementById('stat-free').textContent = freeCount;
  document.getElementById('stat-premium').textContent = premiumCount;
  document.getElementById('stat-active-domain').textContent = activeDomain;
  document.getElementById('current-domain-name').innerHTML = '@<span>' + activeDomain + '</span>';
}

/* ── Select domain ── */
function selectDomain(id) {
  var d = DOMAINS_DATA.find(function(x) { return x.id === id; });
  if (!d || (d.type === 'premium' && !IS_PRO)) return;
  activeDomain = id;
  renderDomains();
  showToast('Domain switched to @' + id);
}

/* ── Copy current domain ── */
function copyCurrentDomain() {
  var el = document.createElement('textarea');
  el.value = activeDomain;
  el.style.position = 'fixed'; el.style.opacity = '0';
  document.body.appendChild(el);
  el.select();
  try { document.execCommand('copy'); showToast('Copied @' + activeDomain); } catch(e) { showToast('Failed to copy'); }
  document.body.removeChild(el);
}

/* ── Drawer ── */
function openDrawer(id) {
  var d = DOMAINS_DATA.find(function(x) { return x.id === id; });
  if (!d) return;
  document.getElementById('drawer-title').textContent = '@' + d.name;
  document.getElementById('dr-name').textContent = d.name;
  document.getElementById('dr-desc').textContent = d.desc;

  var typeIcon = d.type === 'premium' ? '⭐ Premium' : '✓ Free';
  var typeClass = d.type === 'premium' ? 'dr-badge on' : 'dr-badge on';
  document.getElementById('dr-status').innerHTML =
    '<span class="' + typeClass + '">' + typeIcon + '</span>';

  var featHtml = '';
  ['email','alias','otp','attachments','autoDelete','fastDelivery'].forEach(function(k) {
    featHtml += '<span class="dr-badge ' + (d.features[k] ? 'on' : 'off') + '">' +
      (d.features[k] ? '✓' : '✗') + ' ' + k.charAt(0).toUpperCase() + k.slice(1) +
    '</span>';
  });
  document.getElementById('dr-features').innerHTML = featHtml;

  document.getElementById('dr-bestfor').innerHTML = d.bestFor.map(function(b) {
    return '<span class="dr-bestfor-tag">' + b + '</span>';
  }).join('');

  var starHtml = '';
  for (var s = 1; s <= 5; s++) {
    starHtml += '<svg class="' + (s > d.acceptance ? 'off' : '') + '" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>';
  }
  var accLbl = d.acceptance === 5 ? 'Excellent' : d.acceptance === 4 ? 'Good' : d.acceptance === 3 ? 'Average' : 'Low';
  document.getElementById('dr-stars').innerHTML = starHtml + '<span class="dr-stars-lbl">' + accLbl + '</span>';

  var resSec = document.getElementById('dr-restriction-section');
  if (d.restrictions) {
    resSec.style.display = 'block';
    document.getElementById('dr-restriction').textContent = d.restrictions;
  } else {
    resSec.style.display = 'none';
  }

  var ft = document.getElementById('drawer-ft');
  if (d.type === 'premium' && !IS_PRO) {
    ft.innerHTML = '<button class="dc-btn upgrade" onclick="closeDrawer();showUpgrade()">' +
      '<svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">' +
      '<path stroke-linecap="round" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg> Upgrade to Select</button>';
  } else if (d.id === activeDomain) {
    ft.innerHTML = '<button class="dc-btn selected" disabled>' +
      '<svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">' +
      '<path stroke-linecap="round" d="M5 13l4 4L19 7"/></svg> Selected</button>' +
      '<button class="dc-btn select" onclick="copyDomainDrawer(\'' + d.id + '\')">' +
      '<svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><rect x="9" y="9" width="13" height="13" rx="2"/><path stroke-linecap="round" d="M5 15H4a2 2 0 01-2-2V4a2 2 0 012-2h9a2 2 0 012 2v1"/></svg> Copy</button>';
  } else {
    ft.innerHTML = '<button class="dc-btn select" onclick="closeDrawer();selectDomain(\'' + d.id + '\')">' +
      '<svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">' +
      '<path stroke-linecap="round" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg> Select Domain</button>' +
      '<button class="dc-btn select" style="background:var(--BD2);color:var(--INK);" onclick="copyDomainDrawer(\'' + d.id + '\')">' +
      '<svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><rect x="9" y="9" width="13" height="13" rx="2"/><path stroke-linecap="round" d="M5 15H4a2 2 0 01-2-2V4a2 2 0 012-2h9a2 2 0 012 2v1"/></svg> Copy</button>';
  }

  document.getElementById('drawer-overlay').classList.add('open');
  document.getElementById('drawer').classList.add('open');
}

function copyDomainDrawer(id) {
  var el = document.createElement('textarea');
  el.value = id;
  el.style.position = 'fixed'; el.style.opacity = '0';
  document.body.appendChild(el);
  el.select();
  try { document.execCommand('copy'); showToast('Copied @' + id); } catch(e) {}
  document.body.removeChild(el);
}

function closeDrawer() {
  document.getElementById('drawer-overlay').classList.remove('open');
  document.getElementById('drawer').classList.remove('open');
}

/* ── Search & Filter ── */
function filterDomains() {
  renderDomains();
}

function setChipFilter(filter, el) {
  currentFilter = filter;
  document.querySelectorAll('.filter-chip').forEach(function(c) { c.classList.remove('active'); });
  el.classList.add('active');
  document.getElementById('domain-filter').value = filter;
  renderDomains();
}

function clearFilters() {
  document.getElementById('domain-search').value = '';
  document.getElementById('domain-filter').value = 'all';
  document.querySelectorAll('.filter-chip').forEach(function(c) { c.classList.remove('active'); });
  document.querySelector('.filter-chip[data-filter="all"]').classList.add('active');
  currentFilter = 'all';
  renderDomains();
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
  setTimeout(function() {
    document.querySelector('.upgrade-card').style.outline = '';
    document.querySelector('.upgrade-card').style.outlineOffset = '';
  }, 2000);
  showToast('Upgrade to Pro to unlock premium domains ✦');
}

/* ── Refresh ── */
function refreshPage() {
  var ic = document.getElementById('refresh-ic');
  ic.style.transition = 'transform .5s'; ic.style.transform = 'rotate(360deg)';
  setTimeout(function() { ic.style.transition = 'none'; ic.style.transform = ''; }, 520);
  renderDomains();
  loadCustomDomains();
  showToast('Domains refreshed!');
}

/* ══════════════════════════════════════════════
   CUSTOM DOMAINS (PRO FEATURE)
══════════════════════════════════════════════ */

let customDomains = [];
let cdDomainId = null;
let cdCurrentFilter = 'all';

/* ── Load custom domains from API ── */
function loadCustomDomains() {
  fetch('/custom-domains')
    .then(function(r) { return r.json(); })
    .then(function(res) {
      customDomains = res.domains || [];
      renderCustomDomains(customDomains);
      updateCustomDomainStats();
      checkProStatus();
    })
    .catch(function(err) {
      console.error('Failed to load custom domains:', err);
    });
}

/* ── Check Pro status and show/hide buttons ── */
function checkProStatus() {
  var addBtn = document.getElementById('cd-add-btn');
  var proPrompt = document.getElementById('cd-pro-prompt');
  if (IS_PRO) {
    addBtn.style.display = '';
    proPrompt.style.display = 'none';
  } else {
    addBtn.style.display = 'none';
    proPrompt.style.display = '';
  }
}

/* ── Render custom domain cards ── */
function renderCustomDomains(list) {
  var grid = document.getElementById('cd-grid');
  var empty = document.getElementById('cd-empty');
  var searchVal = (document.getElementById('cd-search').value || '').toLowerCase();
  var filterVal = cdCurrentFilter;

  var filtered = list.filter(function(d) {
    if (filterVal === 'verified' && d.verification_status !== 'verified') return false;
    if (filterVal === 'pending' && d.verification_status !== 'pending') return false;
    if (filterVal === 'failed' && d.verification_status !== 'failed') return false;
    if (searchVal) {
      return d.domain.toLowerCase().includes(searchVal);
    }
    return true;
  });

  empty.classList.remove('show');

  if (!filtered.length) {
    grid.innerHTML = '';
    grid.appendChild(empty);
    empty.classList.add('show');
    document.getElementById('cd-empty-msg').textContent =
      searchVal ? 'No custom domains match "' + searchVal + '".'
        : list.length === 0 ? 'Add your own domain to use it with InboxOro.'
        : 'No domains match this filter.';
    return;
  }

  grid.innerHTML = filtered.map(function(d) {
    var isSelected = d.is_selected;
    var isVerified = d.verification_status === 'verified';

    var cardClass = 'cd-card';
    cardClass += ' ' + d.verification_status;
    if (isSelected) cardClass += ' selected';

    var statusDotClass = 'cdc-status ' + d.verification_status;
    var statusDot = '<div class="' + statusDotClass + '">' +
      '<div class="cdc-status-dot"></div>' +
      d.verification_status.charAt(0).toUpperCase() + d.verification_status.slice(1) +
      '</div>';

    var selectedBadge = isSelected
      ? '<span class="cdc-selected-badge"><svg width="9" height="9" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" d="M5 13l4 4L19 7"/></svg>Active</span>'
      : '';

    var dnsSummary = '';
    ['mx', 'spf', 'dkim', 'txt'].forEach(function(k) {
      var kv = k + '_verified';
      var ok = d[kv];
      dnsSummary += '<span class="cdc-dns-item ' + (ok ? 'verified' : 'pending') + '">' +
        '<svg class="cdc-dns-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">' +
        (ok
          ? '<path stroke-linecap="round" d="M5 13l4 4L19 7"/>'
          : '<path stroke-linecap="round" d="M6 18L18 6M6 6l12 12"/>') +
        '</svg>' +
        k.toUpperCase() +
        '</span>';
    });

    var actions = '';

    if (isVerified && !isSelected) {
      actions += '<button class="cdc-act primary" onclick="selectCustomDomain(' + d.id + ')">' +
        '<svg width="10" height="10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg> Select</button>';
    }

    actions += '<button class="cdc-act" onclick="openVerifyDns(' + d.id + ')">' +
      '<svg width="10" height="10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg> Verify</button>';

    actions += '<button class="cdc-act" onclick="refreshCustomDomain(' + d.id + ')">' +
      '<svg width="10" height="10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg> Refresh</button>';

    actions += '<button class="cdc-act danger" onclick="deleteCustomDomain(' + d.id + ')">' +
      '<svg width="10" height="10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg> Delete</button>';

    var timeAgo = d.created_at || '';

    return '<div class="' + cardClass + '">' +
      '<div class="cdc-top">' +
        '<div class="cdc-domain-icon">' +
          '<svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path stroke-linecap="round" d="M2 12h20M12 2a15.3 15.3 0 010 20M12 2a15.3 15.3 0 000 20"/></svg>' +
        '</div>' +
        '<div style="flex:1;min-width:0;">' +
          '<div class="cdc-name">' + d.domain + '</div>' +
          '<div class="cdc-meta"><span>Added ' + timeAgo + '</span></div>' +
        '</div>' +
        '<div style="display:flex;flex-direction:column;align-items:flex-end;gap:4px;">' +
          selectedBadge +
          statusDot +
        '</div>' +
      '</div>' +
      '<div class="cdc-dns">' + dnsSummary + '</div>' +
      '<div class="cdc-actions">' + actions + '</div>' +
      '</div>';
  }).join('');
}

/* ── Update custom domain stats ── */
function updateCustomDomainStats() {
  var total = customDomains.length;
  var verified = customDomains.filter(function(d) { return d.verification_status === 'verified'; }).length;
  var pending = customDomains.filter(function(d) { return d.verification_status === 'pending'; }).length;

  document.getElementById('cd-stat-total').textContent = total;
  document.getElementById('cd-stat-verified').textContent = verified;
  document.getElementById('cd-stat-pending').textContent = pending;
}

/* ── Filter custom domains ── */
function filterCustomDomains() {
  renderCustomDomains(customDomains);
}

function setCdChipFilter(filter, el) {
  cdCurrentFilter = filter;
  document.querySelectorAll('.cd-filter-chip').forEach(function(c) { c.classList.remove('active'); });
  el.classList.add('active');
  renderCustomDomains(customDomains);
}

/* ── Open Add Custom Domain modal ── */
function openAddCustomDomain() {
  document.getElementById('cd-modal-title').innerHTML = '' +
    '<svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>' +
    ' Add Custom Domain';
  document.getElementById('cd-step-input').style.display = '';
  document.getElementById('cd-step-dns').style.display = 'none';
  document.getElementById('cd-modal-submit').style.display = '';
  document.getElementById('cd-modal-submit').innerHTML = '' +
    '<svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg> Add Domain';
  document.getElementById('cd-modal-submit').onclick = submitCustomDomain;
  document.getElementById('cd-domain-input').value = '';
  document.getElementById('cd-domain-input').classList.remove('modal-input-error');
  document.getElementById('cd-modal-error').style.display = 'none';
  cdDomainId = null;

  openCdModal();
}

/* ── Open DNS verification from card ── */
function openVerifyDns(id) {
  var d = customDomains.find(function(x) { return x.id === id; });
  if (!d) return;

  document.getElementById('cd-modal-title').innerHTML = '' +
    '<svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>' +
    ' Verify DNS — ' + d.domain;

  document.getElementById('cd-step-input').style.display = 'none';
  document.getElementById('cd-step-dns').style.display = '';
  document.getElementById('cd-modal-submit').style.display = 'none';

  cdDomainId = id;
  loadDnsRecords(id);
  openCdModal();
}

/* ══════════════════════════════════════════════
   DNS VERIFICATION WIZARD
══════════════════════════════════════════════ */

function loadDnsRecords(id) {
  fetch('/custom-domains/' + id)
    .then(function(r) { return r.json(); })
    .then(function(res) {
      renderDnsRecords(res.domain, res.dns_records);
    })
    .catch(function(err) {
      console.error('Failed to load DNS records:', err);
    });
}

function renderDnsRecords(domain, records) {
  var container = document.getElementById('dns-records-container');
  document.getElementById('cd-dns-domain-id').textContent = domain.id;
  cdDomainId = domain.id;

  var groups = [];

  var types = [
    { key: 'mx', label: 'MX Record', typeClass: 'mx', value: records.mx || 'Set MX record', desc: 'Route email to InboxOro\'s mail servers.' },
    { key: 'spf', label: 'SPF Record', typeClass: 'spf', value: records.spf || 'v=spf1 include:mail.inboxoro.app ~all', desc: 'Authorize InboxOro to send emails on your behalf.' },
    { key: 'dkim', label: 'DKIM Record', typeClass: 'dkim', value: records.dkim || 'v=DKIM1; k=rsa; p=...', desc: 'Cryptographically sign outgoing emails for authenticity.' },
    { key: 'txt', label: 'DMARC Record', typeClass: 'txt', value: records.txt || 'v=DMARC1; p=quarantine; rua=mailto:dmarc@inboxoro.app', desc: 'Set DMARC policy for email authentication.' },
  ];

  types.forEach(function(t) {
    var kv = t.key + '_verified';
    var verified = domain[kv];
    var statusClass = verified ? 'verified' : 'pending';
    var statusText = verified ? 'Verified' : 'Pending';
    var iconHtml = verified
      ? '<svg width="11" height="11" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M5 13l4 4L19 7"/></svg>'
      : '<svg width="11" height="11" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/></svg>';

    groups.push(
      '<div class="dns-record-group">' +
        '<div class="dns-record-hd">' +
          '<span class="dns-record-type ' + t.typeClass + '">' + t.label + '</span>' +
          '<span class="dns-record-status ' + statusClass + '">' +
            iconHtml +
            statusText +
          '</span>' +
        '</div>' +
        '<div class="dns-record-body">' +
          '<div class="dns-record-label">Description</div>' +
          '<div style="font-size:.7rem;color:var(--MU);margin-bottom:8px;line-height:1.5;">' + t.desc + '</div>' +
          '<div class="dns-record-label">Required Value</div>' +
          '<div class="dns-record-value" id="dns-val-' + t.key + '">' + t.value + '</div>' +
          '<button class="dns-record-copy" onclick="copyDnsValue(\'' + t.key + '\')">' +
            '<svg width="10" height="10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><rect x="9" y="9" width="13" height="13" rx="2"/><path stroke-linecap="round" d="M5 15H4a2 2 0 01-2-2V4a2 2 0 012-2h9a2 2 0 012 2v1"/></svg> Copy' +
          '</button>' +
        '</div>' +
      '</div>'
    );
  });

  container.innerHTML = groups.join('');

  var allVerified = domain.mx_verified && domain.spf_verified && domain.dkim_verified && domain.txt_verified;
  document.getElementById('dns-all-verified').classList.toggle('show', allVerified);
  document.getElementById('dns-verify-btn').style.display = allVerified ? 'none' : '';
}

function copyDnsValue(key) {
  var el = document.createElement('textarea');
  el.value = document.getElementById('dns-val-' + key).textContent;
  el.style.position = 'fixed'; el.style.opacity = '0';
  document.body.appendChild(el);
  el.select();
  try { document.execCommand('copy'); showToast('DNS value copied!'); } catch(e) {}
  document.body.removeChild(el);
}

/* ── Verify DNS Records ── */
function verifyDnsRecords() {
  if (!cdDomainId) return;

  var btn = document.getElementById('dns-verify-btn');
  btn.disabled = true;
  btn.classList.add('verifying');
  btn.innerHTML = 'Verifying...';

  fetch('/custom-domains/' + cdDomainId + '/verify', { method: 'POST', headers: { 'X-CSRF-TOKEN': CSRF_TOKEN } })
    .then(function(r) { return r.json(); })
    .then(function(res) {
      if (res.domain) {
        var idx = customDomains.findIndex(function(d) { return d.id === cdDomainId; });
        if (idx !== -1) customDomains[idx] = res.domain;
        renderCustomDomains(customDomains);
        updateCustomDomainStats();
        renderDnsRecords(res.domain, res.dns_check || {});
        if (res.domain.verification_status === 'verified') {
          showToast('Domain verified successfully!');
        } else if (res.domain.verification_status === 'failed') {
          showToast('DNS verification failed. Check your records and try again.');
        } else {
          showToast('Some records verified. Continue setting up remaining DNS records.');
        }
      }
    })
    .catch(function(err) {
      showToast('Verification failed. Please try again.');
    })
    .finally(function() {
      btn.disabled = false;
      btn.classList.remove('verifying');
      btn.innerHTML = '<svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg> Verify DNS Records';
    });
}

/* ── Submit new custom domain ── */
function submitCustomDomain() {
  var input = document.getElementById('cd-domain-input');
  var domain = input.value.trim().toLowerCase();
  var errorEl = document.getElementById('cd-modal-error');

  if (!domain) {
    input.classList.add('modal-input-error');
    errorEl.textContent = 'Please enter a domain name.';
    errorEl.style.display = 'block';
    return;
  }

  if (!/^([a-z0-9]([a-z0-9-]*[a-z0-9])?\.)+[a-z]{2,}$/i.test(domain)) {
    input.classList.add('modal-input-error');
    errorEl.textContent = 'Please enter a valid domain name (e.g. mydomain.com).';
    errorEl.style.display = 'block';
    return;
  }

  input.classList.remove('modal-input-error');
  errorEl.style.display = 'none';

  var btn = document.getElementById('cd-modal-submit');
  btn.disabled = true;
  btn.innerHTML = '<span class="spinner"></span> Adding...';

  fetch('/custom-domains', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': CSRF_TOKEN },
    body: JSON.stringify({ domain: domain }),
  })
    .then(function(r) { return r.json().then(function(d) { return { status: r.status, data: d }; }); })
    .then(function(res) {
      if (res.status === 201 || res.status === 200) {
        customDomains.push(res.data.domain);
        renderCustomDomains(customDomains);
        updateCustomDomainStats();

        if (res.data.dns_records) {
          cdDomainId = res.data.domain.id;
          document.getElementById('cd-modal-title').innerHTML = '' +
            '<svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>' +
            ' Verify DNS — ' + domain;
          document.getElementById('cd-step-input').style.display = 'none';
          document.getElementById('cd-step-dns').style.display = '';
          document.getElementById('cd-modal-submit').style.display = 'none';
          renderDnsRecords(res.data.domain, res.data.dns_records);
        }

        showToast('Custom domain added! Set up DNS to start using it.');
      } else if (res.status === 422) {
        input.classList.add('modal-input-error');
        errorEl.textContent = res.data.error || 'Validation failed.';
        errorEl.style.display = 'block';
      } else {
        errorEl.textContent = res.data.error || 'An error occurred.';
        errorEl.style.display = 'block';
      }
    })
    .catch(function(err) {
      errorEl.textContent = 'Network error. Please try again.';
      errorEl.style.display = 'block';
    })
    .finally(function() {
      btn.disabled = false;
      btn.innerHTML = '<svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg> Add Domain';
    });
}

/* ── Select custom domain as active ── */
function selectCustomDomain(id) {
  if (!IS_PRO) return;

  fetch('/custom-domains/' + id + '/select', {
    method: 'POST',
    headers: { 'X-CSRF-TOKEN': CSRF_TOKEN },
  })
    .then(function(r) { return r.json(); })
    .then(function(res) {
      if (res.domain) {
        customDomains.forEach(function(d) { d.is_selected = d.id === id; });
        renderCustomDomains(customDomains);
        showToast('Active domain switched to ' + res.domain.domain);
      }
    })
    .catch(function(err) {
      showToast('Failed to select domain.');
    });
}

/* ── Refresh custom domain status ── */
function refreshCustomDomain(id) {
  fetch('/custom-domains/' + id + '/refresh', {
    method: 'POST',
    headers: { 'X-CSRF-TOKEN': CSRF_TOKEN },
  })
    .then(function(r) { return r.json(); })
    .then(function(res) {
      if (res.domain) {
        var idx = customDomains.findIndex(function(d) { return d.id === id; });
        if (idx !== -1) customDomains[idx] = res.domain;
        renderCustomDomains(customDomains);
        updateCustomDomainStats();
        showToast('Domain status refreshed!');
      }
    })
    .catch(function(err) {
      showToast('Failed to refresh.');
    });
}

/* ── Delete custom domain ── */
function deleteCustomDomain(id) {
  var d = customDomains.find(function(x) { return x.id === id; });
  if (!d) return;
  var name = d.domain;

  showConfirm('Delete "' + name + '"? This action cannot be undone.', function() {
    fetch('/custom-domains/' + id, {
      method: 'DELETE',
      headers: { 'X-CSRF-TOKEN': CSRF_TOKEN },
    })
      .then(function(r) { return r.json(); })
      .then(function(res) {
        if (res.success) {
          customDomains = customDomains.filter(function(d) { return d.id !== id; });
          renderCustomDomains(customDomains);
          updateCustomDomainStats();
          showToast('Deleted @' + name);
        }
      })
      .catch(function(err) {
        showToast('Failed to delete.');
      });
  });
}

/* ── Modal helpers ── */
function openCdModal() {
  document.getElementById('cd-modal-overlay').classList.add('open');
  document.getElementById('cd-modal').classList.add('open');
}

function closeCdModal() {
  document.getElementById('cd-modal-overlay').classList.remove('open');
  document.getElementById('cd-modal').classList.remove('open');
  cdDomainId = null;
}

/* ── Toast ── */
function showToast(msg) {
  var t = document.getElementById('toast');
  t.querySelector('span').textContent = msg;
  t.classList.add('show');
  setTimeout(function() { t.classList.remove('show'); }, 2600);
}

/* ── CSRF Token & Confirm modal (shared) ── */
const CSRF_TOKEN = @json(csrf_token());

/* ── Confirm modal ── */
function showConfirm(msg, cb) {
  var overlay = document.getElementById('confirm-overlay');
  if (!overlay) {
    overlay = document.createElement('div');
    overlay.id = 'confirm-overlay';
    overlay.innerHTML =
      '<div class="confirm-backdrop" onclick="closeConfirm()"></div>' +
      '<div class="confirm-box">' +
        '<div class="confirm-msg" id="confirm-msg"></div>' +
        '<div class="confirm-actions">' +
          '<button class="btn-ghost" onclick="closeConfirm()">Cancel</button>' +
          '<button class="btn-danger" id="confirm-yes" onclick="confirmYes()">Confirm</button>' +
        '</div>' +
      '</div>';
    document.body.appendChild(overlay);
    var style = document.createElement('style');
    style.id = 'confirm-style';
    style.textContent =
      '#confirm-overlay { position:fixed; inset:0; z-index:999; display:none; align-items:center; justify-content:center; }' +
      '#confirm-overlay.open { display:flex; }' +
      '.confirm-backdrop { position:absolute; inset:0; background:rgba(0,0,0,.35); }' +
      '.confirm-box { position:relative; background:var(--SURF); border-radius:12px; padding:20px 24px; max-width:380px; width:90vw; box-shadow:0 8px 32px rgba(0,0,0,.15); }' +
      '.confirm-msg { font-size:.82rem; color:var(--INK); margin-bottom:16px; line-height:1.5; }' +
      '.confirm-actions { display:flex; gap:8px; justify-content:flex-end; }' +
      '.confirm-actions button { padding:7px 16px; border-radius:7px; font-family:var(--MONO); font-size:.68rem; font-weight:700; border:none; cursor:pointer; }' +
      '.btn-ghost { background:var(--BD2); color:var(--INK); } .btn-ghost:hover { background:#D1D5DB; }' +
      '.btn-danger { background:#DC2626; color:#fff; } .btn-danger:hover { background:#B91C1C; }';
    document.head.appendChild(style);
  }
  document.getElementById('confirm-msg').textContent = msg;
  overlay.classList.add('open');
  window._confirmCb = cb;
}

function closeConfirm() {
  var overlay = document.getElementById('confirm-overlay');
  if (overlay) overlay.classList.remove('open');
  window._confirmCb = null;
}

function confirmYes() {
  var cb = window._confirmCb;
  closeConfirm();
  if (cb) cb();
}

/* ── Keyboard: close drawer/modal on Escape ── */
document.addEventListener('keydown', function(e) {
  if (e.key === 'Escape') { closeDrawer(); closeCdModal(); }
});

/* ── Boot ── */
renderDomains();
loadCustomDomains();
</script>
@endpush