@extends('layouts.authLayout')

@section('title', 'InboxOro — API Keys')

@push('styles')
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
@endpush

@section('content')

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

@endsection

@push('scripts')
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
  {
    id:1, name:'Laravel Application', prefix:'sk_text',
    masked:'ska_text_••••••••••••••••3f8a',
    full:'ska_text_3f8a9b2c1d4e5f6a7b8c9d0e1f2a3b4c',
    created:'June 20, 2026', last_used:'Today', status:'active',
    perms:['read_inboxes','read_messages','generate_emails'],
  },
  {
    id:2, name:'Testing Project', prefix:'sk_test',
    masked:'sk_test_••••••••••••••••7c2b',
    full:'sk_test_7c2b8d3e4f5a6b7c8d9e0f1a2b3c4d5e',
    created:'June 15, 2026', last_used:'Yesterday', status:'active',
    perms:['read_inboxes','read_messages'],
  },
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

/* ── Boot ── */
renderKeys();
</script>
@endpush
