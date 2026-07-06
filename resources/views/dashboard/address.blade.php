@extends('layouts.authLayout')

@section('title', 'InboxOro — Addresses')

@push('styles')
<style>
/* ══════════════════════════════════════════════
   ADDRESSES (ALIAS) PAGE
══════════════════════════════════════════════ */

/* ── Usage meter ── */
.usage-bar-wrap {
  height: 6px; background: var(--BD2); border-radius: 3px;
  overflow: hidden; flex: 1; min-width: 80px; max-width: 160px;
}
.usage-bar-fill {
  height: 100%; border-radius: 3px;
  transition: width .4s cubic-bezier(.4,0,.2,1);
}
.usage-bar-fill.ok      { background: var(--GREEN); }
.usage-bar-fill.warning { background: var(--Y); }
.usage-bar-fill.full    { background: var(--RED); }

/* ── Upgrade banner ── */
.upgrade-banner {
  background: var(--INK);
  border: 1px solid rgba(250,204,21,.25);
  border-radius: 12px;
  padding: 18px 20px;
  display: flex; align-items: center; gap: 16px;
  flex-wrap: wrap; margin-bottom: 20px;
  position: relative; overflow: hidden;
}
.upgrade-banner::before {
  content: '';
  position: absolute; top: 0; left: 0; right: 0; height: 2px;
  background: linear-gradient(90deg, var(--Y), #F59E0B, var(--Y));
  background-size: 200% 100%;
  animation: shimmer 2s linear infinite;
}
@keyframes shimmer { 0%{background-position:200% 0} 100%{background-position:-200% 0} }

.upgrade-icon {
  width: 44px; height: 44px; background: rgba(250,204,21,.12);
  border-radius: 10px; display: flex; align-items: center;
  justify-content: center; color: var(--Y); flex-shrink: 0;
}
.upgrade-body { flex: 1; min-width: 0; }
.upgrade-title { font-family: var(--DISP); font-size: 1rem; letter-spacing: .04em; color: #fff; margin-bottom: 3px; }
.upgrade-sub   { font-size: .78rem; color: rgba(255,255,255,.5); line-height: 1.5; }
.upgrade-cta {
  display: inline-flex; align-items: center; gap: 6px;
  background: var(--Y); color: var(--INK);
  font-size: .78rem; font-weight: 700; padding: 9px 18px;
  border-radius: 8px; white-space: nowrap; flex-shrink: 0;
  transition: background .15s, transform .1s;
  text-decoration: none;
}
.upgrade-cta:hover { background: #EAB800; transform: translateY(-1px); text-decoration: none; }

/* ── Stat cards row ── */
.stat-row {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 12px;
  margin-bottom: 20px;
}
@media (min-width: 640px) { .stat-row { grid-template-columns: repeat(4, 1fr); } }

.stat-c {
  background: var(--SURF); border: 1px solid var(--BD);
  border-radius: 12px; padding: 16px;
  transition: box-shadow .15s, transform .12s;
  position: relative; overflow: hidden;
}
.stat-c:hover { box-shadow: 0 4px 14px rgba(0,0,0,.07); transform: translateY(-1px); }
.stat-c-top { display: flex; align-items: flex-start; justify-content: space-between; margin-bottom: 10px; }
.stat-c-icon {
  width: 36px; height: 36px; border-radius: 9px;
  display: flex; align-items: center; justify-content: center;
}
.stat-c-icon.y { background: rgba(250,204,21,.15); color: #92400E; }
.stat-c-icon.g { background: rgba(16,185,129,.12);  color: var(--GREEN); }
.stat-c-icon.b { background: rgba(59,130,246,.12);  color: var(--B); }
.stat-c-icon.r { background: rgba(239,68,68,.10);  color: var(--RED); }
.stat-c-val { font-family: var(--DISP); font-size: 1.9rem; color: var(--INK); line-height: 1; }
.stat-c-lbl { font-size: .74rem; color: var(--MU); font-weight: 500; margin-top: 3px; }
.stat-c-note { font-size: .68rem; margin-top: 4px; }

/* ── Panel / card ── */
.panel {
  background: var(--SURF); border: 1px solid var(--BD);
  border-radius: 12px; overflow: hidden; margin-bottom: 20px;
}
.panel-hd {
  display: flex; align-items: center; justify-content: space-between;
  padding: 14px 18px; border-bottom: 1px solid var(--BD2);
  gap: 10px; flex-wrap: wrap;
}
.panel-title { font-weight: 700; font-size: .9rem; color: var(--INK); }
.panel-meta  { font-family: var(--MONO); font-size: .62rem; color: var(--MU); }

/* ── Toolbar ── */
.tbar {
  display: flex; align-items: center; gap: 8px;
  padding: 12px 18px; border-bottom: 1px solid var(--BD2);
  flex-wrap: wrap;
}
.tbar-search {
  display: flex; align-items: center; gap: 8px;
  background: var(--BG); border: 1px solid var(--BD);
  border-radius: 8px; padding: 0 12px; height: 36px;
  flex: 1; min-width: 160px; max-width: 280px;
}
.tbar-search input {
  border: none; outline: none; background: transparent;
  font-family: var(--BODY); font-size: 15px; color: var(--INK); flex: 1;
}
.tbar-search input::placeholder { color: var(--MU2); }
.tbar-search svg { color: var(--MU2); flex-shrink: 0; }
.tbar-select {
  height: 36px; border: 1px solid var(--BD); border-radius: 8px;
  padding: 0 12px; font-family: var(--BODY); font-size: .8rem;
  color: var(--INK); background: var(--SURF); outline: none; cursor: pointer;
}
.tbar-select:focus { border-color: var(--Y); }
.tbar-ml { margin-left: auto; }

/* ── Table ── */
.alias-table { width: 100%; border-collapse: collapse; }
.alias-table thead tr { border-bottom: 1px solid var(--BD2); }
.alias-table thead th {
  padding: 10px 16px; text-align: left;
  font-family: var(--MONO); font-size: .58rem; font-weight: 700;
  letter-spacing: .1em; text-transform: uppercase; color: var(--MU2);
  white-space: nowrap;
}
.alias-table tbody tr {
  border-bottom: 1px solid var(--BD2); transition: background .1s;
}
.alias-table tbody tr:last-child { border-bottom: none; }
.alias-table tbody tr:hover { background: var(--BD2); }
.alias-table tbody td { padding: 13px 16px; vertical-align: middle; }

/* alias email cell */
.alias-cell { display: flex; align-items: center; gap: 10px; min-width: 0; }
.alias-avatar {
  width: 34px; height: 34px; border-radius: 9px;
  background: var(--INK); color: var(--Y);
  display: flex; align-items: center; justify-content: center;
  font-family: var(--MONO); font-size: .64rem; font-weight: 800;
  flex-shrink: 0; letter-spacing: .02em;
}
.alias-email {
  font-family: var(--MONO); font-size: .78rem; font-weight: 600;
  color: var(--INK); overflow: hidden; text-overflow: ellipsis;
  white-space: nowrap; max-width: 220px;
}
.alias-label {
  font-size: .7rem; color: var(--MU); margin-top: 2px; white-space: nowrap;
}

/* forward-to pill */
.forward-pill {
  display: inline-flex; align-items: center; gap: 5px;
  background: rgba(59,130,246,.08); color: var(--B);
  border: 1px solid rgba(59,130,246,.2);
  font-family: var(--MONO); font-size: .66rem; font-weight: 600;
  padding: 3px 10px; border-radius: 20px; white-space: nowrap;
  max-width: 200px; overflow: hidden; text-overflow: ellipsis;
}

/* status toggle pill */
.status-toggle {
  display: inline-flex; align-items: center; gap: 5px;
  font-family: var(--MONO); font-size: .6rem; font-weight: 700;
  padding: 4px 10px; border-radius: 20px; cursor: pointer;
  white-space: nowrap; transition: background .15s, color .15s;
  border: none; user-select: none;
}
.status-toggle.active  { background: rgba(16,185,129,.12);  color: var(--GREEN); }
.status-toggle.paused  { background: rgba(245,158,11,.12);   color: #92400E; }
.status-toggle .st-dot { width: 5px; height: 5px; border-radius: 50%; background: currentColor; }

/* row action buttons */
.row-acts { display: flex; gap: 4px; align-items: center; justify-content: flex-end; }
.act-btn {
  width: 30px; height: 30px; display: flex; align-items: center;
  justify-content: center; border-radius: 7px;
  border: 1px solid var(--BD); background: var(--SURF); color: var(--MU);
  cursor: pointer; transition: background .12s, color .12s, border-color .12s;
}
.act-btn:hover           { background: var(--BD2); color: var(--INK); border-color: #D1D5DB; }
.act-btn.copy:hover      { background: rgba(250,204,21,.1);  color: var(--INK);   border-color: rgba(250,204,21,.4); }
.act-btn.edit:hover      { background: rgba(59,130,246,.08); color: var(--B);     border-color: rgba(59,130,246,.3); }
.act-btn.del:hover       { background: rgba(239,68,68,.08);  color: var(--RED);   border-color: rgba(239,68,68,.3); }

/* ── Empty state ── */
.empty-state {
  display: none; flex-direction: column; align-items: center;
  justify-content: center; padding: 56px 20px; gap: 14px; text-align: center;
}
.empty-state.show { display: flex; }
.empty-icon {
  width: 58px; height: 58px; background: var(--BD2);
  border-radius: 14px; display: flex; align-items: center;
  justify-content: center; color: var(--MU2);
}
.empty-title { font-family: var(--DISP); font-size: 1.3rem; letter-spacing: .03em; color: var(--INK); }
.empty-sub   { font-size: .82rem; color: var(--MU); max-width: 280px; line-height: 1.6; }

/* ── Hidden on small screens ── */
.col-forward,
.col-received,
.col-last-used { display: none; }
@media (min-width: 640px)  { .col-forward  { display: table-cell; } }
@media (min-width: 860px)  { .col-received { display: table-cell; } }
@media (min-width: 1080px) { .col-last-used { display: table-cell; } }

/* ══════════════════════════════════════════════
   MODALS  (Create + Edit Alias)
══════════════════════════════════════════════ */
.modal-overlay {
  position: fixed; inset: 0; z-index: 500;
  background: rgba(0,0,0,.5); backdrop-filter: blur(3px);
  display: none; align-items: center; justify-content: center; padding: 20px;
}
.modal-overlay.open { display: flex; animation: fade-bg .2s ease both; }
@keyframes fade-bg { from{opacity:0} to{opacity:1} }

.modal-box {
  background: var(--SURF); border-radius: 14px;
  border: 1px solid var(--BD); width: 100%; max-width: 480px;
  box-shadow: 0 20px 60px rgba(0,0,0,.18);
  animation: modal-up .22s cubic-bezier(.34,1.56,.64,1) both;
}
@keyframes modal-up { from{transform:translateY(12px) scale(.97);opacity:0} to{transform:none;opacity:1} }

.modal-hd {
  display: flex; align-items: center; justify-content: space-between;
  padding: 18px 20px; border-bottom: 1px solid var(--BD2);
}
.modal-title {
  font-family: var(--DISP); font-size: 1.15rem;
  letter-spacing: .04em; color: var(--INK);
}
.modal-close {
  width: 32px; height: 32px; display: flex; align-items: center;
  justify-content: center; border-radius: 8px; border: 1px solid var(--BD);
  background: transparent; color: var(--MU); cursor: pointer;
  transition: background .12s, color .12s;
}
.modal-close:hover { background: var(--BD2); color: var(--INK); }

.modal-body { padding: 20px; display: flex; flex-direction: column; gap: 14px; }

.field { display: flex; flex-direction: column; gap: 5px; }
.field label {
  font-family: var(--MONO); font-size: .6rem; font-weight: 700;
  letter-spacing: .08em; text-transform: uppercase; color: var(--MU);
}
.field input,
.field select {
  padding: 10px 14px; border: 1px solid var(--BD); border-radius: 8px;
  font-family: var(--BODY); font-size: 16px; color: var(--INK);
  background: var(--SURF); outline: none;
  transition: border-color .15s, box-shadow .15s;
}
.field input:focus,
.field select:focus {
  border-color: var(--Y); box-shadow: 0 0 0 3px rgba(250,204,21,.15);
}
.field input.err  { border-color: var(--RED); box-shadow: 0 0 0 3px rgba(239,68,68,.1); }
.field-hint { font-size: .72rem; color: var(--MU2); line-height: 1.5; }
.field-err  { font-size: .72rem; color: var(--RED); font-weight: 500; display: none; }
.field-err.show { display: block; }

/* alias@domain combo */
.alias-input-row {
  display: flex; border: 1px solid var(--BD); border-radius: 8px;
  overflow: hidden; transition: border-color .15s, box-shadow .15s;
  background: var(--SURF);
}
.alias-input-row:focus-within {
  border-color: var(--Y); box-shadow: 0 0 0 3px rgba(250,204,21,.15);
}
.alias-input-row.err {
  border-color: var(--RED); box-shadow: 0 0 0 3px rgba(239,68,68,.1);
}
.alias-prefix {
  flex: 1; padding: 10px 14px; border: none; outline: none;
  font-family: var(--MONO); font-size: 15px; color: var(--INK);
  background: transparent;
}
.alias-at {
  display: flex; align-items: center;
  font-family: var(--MONO); font-size: .78rem; color: var(--MU2);
  padding: 0 6px; background: var(--BD2); border-left: 1px solid var(--BD);
  flex-shrink: 0;
}
.alias-domain-sel {
  border: none; outline: none; background: var(--BD2);
  font-family: var(--MONO); font-size: .76rem; color: var(--INK);
  padding: 0 12px 0 4px; cursor: pointer; height: 100%;
}

/* status toggle in modal */
.toggle-row {
  display: flex; align-items: center; justify-content: space-between;
  padding: 10px 14px; border: 1px solid var(--BD); border-radius: 8px;
}
.toggle-lbl { font-size: .84rem; font-weight: 500; color: var(--INK); }
.toggle-sub { font-size: .72rem; color: var(--MU); margin-top: 2px; }
.toggle-switch {
  width: 42px; height: 24px; border-radius: 12px;
  background: var(--BD); border: none; cursor: pointer; position: relative;
  flex-shrink: 0; transition: background .2s;
}
.toggle-switch.on { background: var(--GREEN); }
.toggle-switch::after {
  content: ''; position: absolute;
  width: 18px; height: 18px; border-radius: 50%; background: #fff;
  top: 3px; left: 3px; transition: left .2s;
  box-shadow: 0 1px 4px rgba(0,0,0,.2);
}
.toggle-switch.on::after { left: 21px; }

.modal-ft {
  padding: 14px 20px; border-top: 1px solid var(--BD2);
  display: flex; gap: 8px; justify-content: flex-end;
}

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

<!-- ══════════ CREATE / EDIT MODAL ══════════ -->
<div class="modal-overlay" id="alias-modal">
  <div class="modal-box">
    <div class="modal-hd">
      <div class="modal-title" id="modal-title">Create Alias</div>
      <button class="modal-close" onclick="closeModal()">
        <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
          <path stroke-linecap="round" d="M6 18L18 6M6 6l12 12"/>
        </svg>
      </button>
    </div>
    <div class="modal-body">

      <!-- Alias address -->
      <div class="field">
        <label>Alias Address</label>
        <div class="alias-input-row" id="alias-input-wrap">
          <input class="alias-prefix" id="alias-prefix" type="text"
            placeholder="myalias" maxlength="40" autocapitalize="none"
            oninput="validatePrefix(this)"/>
          <span class="alias-at">@</span>
          <select class="alias-domain-sel" id="alias-domain">
            <option>dropit.io</option>
            <option>burnbox.dev</option>
            <option>zaptmp.net</option>
            <option>voidmail.cc</option>
            <option>mailsink.app</option>
          </select>
        </div>
        <div class="field-err" id="prefix-err">Use 3–40 lowercase letters, numbers or hyphens.</div>
        <div class="field-hint">Leave blank to auto-generate a random prefix.</div>
      </div>

      <!-- Label / note -->
      <div class="field">
        <label>Label <span style="color:var(--MU);font-weight:400;text-transform:none;letter-spacing:0;">(optional)</span></label>
        <input type="text" id="alias-label-inp" placeholder="e.g. Shopping, Newsletter, Testing…" maxlength="60"/>
      </div>

      <!-- Forward-to -->
      <div class="field">
        <label>Forward To <span style="color:var(--MU);font-weight:400;text-transform:none;letter-spacing:0;">(optional)</span></label>
        <input type="email" id="alias-forward" placeholder="yourpersonal@gmail.com"
          oninput="validateForward(this)"/>
        <div class="field-err" id="forward-err">Please enter a valid email address.</div>
        <div class="field-hint">Emails received on this alias will also be forwarded here.</div>
      </div>

      <!-- Status toggle -->
      <div class="field">
        <label>Status</label>
        <div class="toggle-row">
          <div>
            <div class="toggle-lbl">Active</div>
            <div class="toggle-sub">Alias accepts incoming emails</div>
          </div>
          <button class="toggle-switch on" id="status-toggle" onclick="toggleStatus(this)" aria-label="Toggle status"></button>
        </div>
      </div>

    </div>
    <div class="modal-ft">
      <button class="btn-ghost" onclick="closeModal()">Cancel</button>
      <button class="btn-primary yellow" id="modal-save-btn" onclick="saveAlias()">
        <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
          <path stroke-linecap="round" d="M5 13l4 4L19 7"/>
        </svg>
        <span id="modal-save-lbl">Create Alias</span>
      </button>
    </div>
  </div>
</div>

<!-- ── Page header ── -->
<div class="page-hd">
  <div>
    <div class="page-title">Addresses</div>
    <div class="page-subtitle" id="page-sub">Manage your email aliases</div>
  </div>
  <div style="display:flex;gap:8px;align-items:center;flex-wrap:wrap;">
    <button class="btn-ghost" onclick="refreshPage()">
      <svg id="refresh-ic" width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
        <path stroke-linecap="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
      </svg>
      Refresh
    </button>
    <button class="btn-primary yellow" id="create-btn" onclick="openCreateModal()">
      <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
        <path stroke-linecap="round" d="M12 4v16m8-8H4"/>
      </svg>
      Create Alias
    </button>
  </div>
</div>

<!-- ── Upgrade banner (shown when limit reached) ── -->
<div class="upgrade-banner" id="upgrade-banner" style="display:none;">
  <div class="upgrade-icon">
    <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
      <path stroke-linecap="round" d="M13 10V3L4 14h7v7l9-11h-7z"/>
    </svg>
  </div>
  <div class="upgrade-body">
    <div class="upgrade-title">ALIAS LIMIT REACHED — UPGRADE TO PRO</div>
    <div class="upgrade-sub">You've used all <strong id="banner-limit" style="color:var(--Y);">5</strong> free aliases. Upgrade to Pro for unlimited aliases, custom domains, and forwarding rules.</div>
  </div>
  <a href="#" class="upgrade-cta">
    <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
      <path stroke-linecap="round" d="M13 10V3L4 14h7v7l9-11h-7z"/>
    </svg>
    Upgrade Now
  </a>
</div>

<!-- ── Stat cards ── -->
<div class="stat-row">

  <!-- Usage counter — key feature -->
  <div class="stat-c" style="grid-column:1/-1;" id="usage-card">
    <div style="display:flex;align-items:center;justify-content:space-between;gap:14px;flex-wrap:wrap;">
      <div style="display:flex;align-items:center;gap:14px;flex:1;min-width:0;">
        <div class="stat-c-icon y">
          <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
          </svg>
        </div>
        <div style="min-width:0;flex:1;">
          <div style="font-size:.74rem;color:var(--MU);font-weight:500;margin-bottom:4px;">Alias Usage</div>
          <div style="display:flex;align-items:center;gap:12px;flex-wrap:wrap;">
            <div style="font-family:var(--DISP);font-size:1.5rem;color:var(--INK);line-height:1;">
              <span id="used-count">3</span>
              <span style="font-family:var(--BODY);font-size:1rem;color:var(--MU);font-weight:400;"> / </span>
              <span id="total-limit" style="color:var(--MU);">5</span>
              <span style="font-family:var(--MONO);font-size:.7rem;color:var(--MU);font-weight:600;margin-left:4px;">Used</span>
            </div>
            <div class="usage-bar-wrap" id="usage-bar-wrap">
              <div class="usage-bar-fill ok" id="usage-bar-fill" style="width:60%;"></div>
            </div>
            <span id="usage-pct-lbl" style="font-family:var(--MONO);font-size:.66rem;font-weight:700;color:var(--GREEN);white-space:nowrap;">60% used</span>
          </div>
        </div>
      </div>
      <div style="display:flex;gap:8px;flex-shrink:0;">
        <div style="text-align:center;padding:0 16px;">
          <div style="font-family:var(--DISP);font-size:1.4rem;color:var(--INK);" id="active-count">2</div>
          <div style="font-size:.7rem;color:var(--MU);">Active</div>
        </div>
        <div style="width:1px;background:var(--BD);"></div>
        <div style="text-align:center;padding:0 16px;">
          <div style="font-family:var(--DISP);font-size:1.4rem;color:var(--MU);" id="paused-count">1</div>
          <div style="font-size:.7rem;color:var(--MU);">Paused</div>
        </div>
        <div style="width:1px;background:var(--BD);"></div>
        <div style="text-align:center;padding:0 16px;">
          <div style="font-family:var(--DISP);font-size:1.4rem;color:var(--INK);" id="total-received">47</div>
          <div style="font-size:.7rem;color:var(--MU);">Emails In</div>
        </div>
      </div>
    </div>
  </div>

</div>

<!-- ── Alias table panel ── -->
<div class="panel">
  <div class="panel-hd">
    <span class="panel-title">Your Aliases</span>
    <span class="panel-meta" id="panel-meta">3 aliases</span>
  </div>

  <!-- Toolbar -->
  <div class="tbar">
    <div class="tbar-search">
      <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
        <circle cx="11" cy="11" r="8"/>
        <path stroke-linecap="round" d="M21 21l-4.35-4.35"/>
      </svg>
      <input type="text" id="search-input" placeholder="Search aliases or labels…" oninput="filterAliases()"/>
    </div>
    <select class="tbar-select" id="status-filter" onchange="filterAliases()">
      <option value="all">All Status</option>
      <option value="active">Active</option>
      <option value="paused">Paused</option>
    </select>
    <select class="tbar-select" id="domain-filter" onchange="filterAliases()">
      <option value="all">All Domains</option>
      <option>dropit.io</option>
      <option>burnbox.dev</option>
      <option>zaptmp.net</option>
      <option>voidmail.cc</option>
      <option>mailsink.app</option>
    </select>
    <div class="tbar-ml">
      <button class="btn-ghost" onclick="exportCSV()" style="font-size:.76rem;padding:7px 12px;">
        <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
          <path stroke-linecap="round" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
        </svg>
        Export CSV
      </button>
    </div>
  </div>

  <!-- Table -->
  <div style="overflow-x:auto;">
    <table class="alias-table" id="alias-table">
      <thead>
        <tr>
          <th>Alias Address</th>
          <th class="col-forward">Forwards To</th>
          <th>Status</th>
          <th class="col-received">Emails In</th>
          <th class="col-last-used">Last Used</th>
          <th style="text-align:right;padding-right:18px;">Actions</th>
        </tr>
      </thead>
      <tbody id="alias-tbody"></tbody>
    </table>
    <!-- Empty state -->
    <div class="empty-state" id="empty-state">
      <div class="empty-icon">
        <svg width="26" height="26" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
          <path stroke-linecap="round" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
        </svg>
      </div>
      <div class="empty-title">No aliases found</div>
      <div class="empty-sub">Try a different search or filter, or create your first alias.</div>
      <button class="btn-primary yellow" style="margin-top:4px;" onclick="openCreateModal()">
        <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
          <path stroke-linecap="round" d="M12 4v16m8-8H4"/>
        </svg>
        Create Alias
      </button>
    </div>
  </div>
</div>

<!-- ── How aliases work ── -->
<div class="panel">
  <div class="panel-hd">
    <span class="panel-title">How Aliases Work</span>
  </div>
  <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(180px,1fr));gap:0;">
    <div style="padding:18px 20px;border-right:1px solid var(--BD2);">
      <div style="width:32px;height:32px;background:rgba(250,204,21,.12);border-radius:8px;display:flex;align-items:center;justify-content:center;color:var(--Y);margin-bottom:10px;">
        <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M12 4v16m8-8H4"/></svg>
      </div>
      <div style="font-weight:700;font-size:.84rem;color:var(--INK);margin-bottom:4px;">1. Create an alias</div>
      <div style="font-size:.76rem;color:var(--MU);line-height:1.55;">Pick a prefix and domain, optionally add a label and forward-to address.</div>
    </div>
    <div style="padding:18px 20px;border-right:1px solid var(--BD2);">
      <div style="width:32px;height:32px;background:rgba(59,130,246,.1);border-radius:8px;display:flex;align-items:center;justify-content:center;color:var(--B);margin-bottom:10px;">
        <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
      </div>
      <div style="font-weight:700;font-size:.84rem;color:var(--INK);margin-bottom:4px;">2. Use it anywhere</div>
      <div style="font-size:.76rem;color:var(--MU);line-height:1.55;">Share the alias instead of your real email — on sign-ups, newsletters, or contact forms.</div>
    </div>
    <div style="padding:18px 20px;border-right:1px solid var(--BD2);">
      <div style="width:32px;height:32px;background:rgba(16,185,129,.1);border-radius:8px;display:flex;align-items:center;justify-content:center;color:var(--GREEN);margin-bottom:10px;">
        <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
      </div>
      <div style="font-weight:700;font-size:.84rem;color:var(--INK);margin-bottom:4px;">3. Emails arrive here</div>
      <div style="font-size:.76rem;color:var(--MU);line-height:1.55;">All incoming mail lands in your InboxOro inbox — and optionally forwards to you.</div>
    </div>
    <div style="padding:18px 20px;">
      <div style="width:32px;height:32px;background:rgba(239,68,68,.08);border-radius:8px;display:flex;align-items:center;justify-content:center;color:var(--RED);margin-bottom:10px;">
        <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M10 9v6m4-6v6"/></svg>
      </div>
      <div style="font-weight:700;font-size:.84rem;color:var(--INK);margin-bottom:4px;">4. Pause or delete</div>
      <div style="font-size:.76rem;color:var(--MU);line-height:1.55;">Pause to stop receiving emails, or delete the alias entirely when you no longer need it.</div>
    </div>
  </div>
</div>

@endsection

@php
    $_sub = auth()->user()?->subscriptions()->active()->first();
    $_plan = $_sub?->plan;
    $isProAlias = $_plan && $_plan->slug === 'pro';
@endphp

@push('scripts')
<script>

/* ══════════════════════════════════════════════════
   ALIASES PAGE — API-DRIVEN
══════════════════════════════════════════════════ */

const CSRF_TOKEN   = @json(csrf_token());
let IS_PRO         = @json($isProAlias);
let MAX_ALIASES    = 0;
let aliases        = [];
let editingId      = null;
let storedDomains  = [];

/* ── Toast ── */
function showToast(msg, type) {
  const t = document.getElementById('toast');
  if (!t) return;
  const dot = t.querySelector('.toast-dot');
  if (dot) dot.style.background = type === 'err' ? 'var(--RED)' : 'var(--GREEN)';
  const span = t.querySelector('span');
  if (span) span.textContent = msg;
  t.classList.add('show');
  clearTimeout(t._t);
  t._t = setTimeout(() => t.classList.remove('show'), 2600);
}

/* ── Confirm Modal ── */
let confirmCallback = null;

function showConfirm(msg, cb) {
  document.getElementById('confirm-msg').textContent = msg;
  confirmCallback = cb;
  document.getElementById('confirm-modal').classList.add('open');
}

function closeConfirm() {
  document.getElementById('confirm-modal').classList.remove('open');
  confirmCallback = null;
}

function confirmYes() {
  document.getElementById('confirm-modal').classList.remove('open');
  if (confirmCallback) { confirmCallback(); confirmCallback = null; }
}

/* ── Load aliases ── */
function loadAliases() {
  fetch('/aliases').then(function(r){ return r.json(); }).then(function(data) {
    aliases = data.aliases || [];
    MAX_ALIASES = data.max_aliases || 0;
    IS_PRO = data.is_pro || false;
    updateStats();
    renderTable();
  }).catch(function() {
    showToast('Failed to load aliases', 'err');
  });
}

/* ── Load domains for create/edit modal ── */
function loadDomains(callback) {
  if (storedDomains.length) { if (callback) callback(storedDomains); return; }
  fetch('/aliases/domains').then(function(r){ return r.json(); }).then(function(data) {
    storedDomains = data.domains || [];
    if (callback) callback(storedDomains);
  }).catch(function() {
    showToast('Failed to load domains', 'err');
  });
}

/* ── Stats ── */
function updateStats() {
  const used   = aliases.length;
  const active = aliases.filter(function(a){ return a.is_enabled; }).length;
  const paused = aliases.filter(function(a){ return !a.is_enabled; }).length;
  const total  = aliases.reduce(function(s, a){ return s + (a.total_received || 0); }, 0);
  const limit  = MAX_ALIASES > 0 ? MAX_ALIASES : (IS_PRO ? '∞' : MAX_ALIASES);
  const pct    = MAX_ALIASES > 0 ? Math.round((used / MAX_ALIASES) * 100) : Math.min(used * 10, 100);

  document.getElementById('used-count').textContent     = used;
  document.getElementById('active-count').textContent   = active;
  document.getElementById('paused-count').textContent   = paused;
  document.getElementById('total-received').textContent  = total;
  document.getElementById('total-limit').textContent     = limit;
  document.getElementById('page-sub').textContent        = used + ' alias' + (used !== 1 ? 'es' : '') + ' · ' + (IS_PRO ? 'Unlimited' : (MAX_ALIASES + ' max'));
  document.getElementById('panel-meta').textContent      = used + ' alias' + (used !== 1 ? 'es' : '');

  const fill   = document.getElementById('usage-bar-fill');
  const pctLbl = document.getElementById('usage-pct-lbl');
  fill.style.width = pct + '%';
  fill.className = 'usage-bar-fill ' + (pct >= 100 ? 'full' : pct >= 80 ? 'warning' : 'ok');
  pctLbl.style.color = pct >= 100 ? 'var(--RED)' : pct >= 80 ? '#92400E' : 'var(--GREEN)';
  pctLbl.textContent = pct + '% used';

  const atLimit = !IS_PRO && MAX_ALIASES > 0 && used >= MAX_ALIASES;
  document.getElementById('upgrade-banner').style.display = atLimit ? 'flex' : 'none';
  document.getElementById('banner-limit').textContent = MAX_ALIASES;
  document.getElementById('create-btn').disabled = atLimit;
  document.getElementById('create-btn').title     = atLimit ? 'Upgrade to create more aliases' : '';
}

/* ── Table rendering ── */
function getVisible() {
  const search = document.getElementById('search-input').value.toLowerCase();
  const status = document.getElementById('status-filter').value;
  const domain = document.getElementById('domain-filter').value;
  return aliases.filter(function(a) {
    const matchSearch = !search || a.email.toLowerCase().includes(search) || a.description.toLowerCase().includes(search) || (a.forward_to || '').toLowerCase().includes(search);
    const matchStatus = status === 'all' || (status === 'active' && a.is_enabled) || (status === 'paused' && !a.is_enabled);
    const matchDomain = domain === 'all' || a.domain === domain;
    return matchSearch && matchStatus && matchDomain;
  });
}

function renderTable() {
  updateStats();
  var list  = getVisible();
  var tbody = document.getElementById('alias-tbody');
  var empty = document.getElementById('empty-state');
  var domainFilter = document.getElementById('domain-filter');

  var currentDomains = {};
  aliases.forEach(function(a){ currentDomains[a.domain] = true; });
  var domainOpts = '<option value="all">All Domains</option>';
  Object.keys(currentDomains).sort().forEach(function(d){
    domainOpts += '<option value="' + d + '">' + d + '</option>';
  });
  domainFilter.innerHTML = domainOpts;

  if (!list.length) {
    tbody.innerHTML = '';
    empty.classList.add('show');
    return;
  }
  empty.classList.remove('show');

  tbody.innerHTML = list.map(function(a) {
    var stCls  = a.is_enabled ? 'active' : 'paused';
    var stLbl  = a.is_enabled ? '● Active' : '⏸ Paused';
    var desc   = a.description || '';
    var forward = a.forward_to || '';
    return '<tr data-id="' + a.id + '">' +
      '<td>' +
        '<div class="alias-cell">' +
          '<div class="alias-avatar" style="background:' + a.color + ';">' + a.avatar + '</div>' +
          '<div style="min-width:0;">' +
            '<div class="alias-email" title="' + a.email + '">' + a.email + '</div>' +
            (desc
              ? '<div class="alias-label"><svg width="10" height="10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="display:inline;vertical-align:middle;color:var(--MU2);"><path stroke-linecap="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A2 2 0 013 12V7a4 4 0 014-4z"/></svg> ' + desc + '</div>'
              : '<div class="alias-label" style="color:var(--MU2);">No label</div>'
            ) +
          '</div>' +
        '</div>' +
      '</td>' +
      '<td class="col-forward">' +
        (forward
          ? '<span class="forward-pill"><svg width="10" height="10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg> ' + forward + '</span>'
          : '<span style="font-size:.76rem;color:var(--MU2);">No forwarding</span>'
        ) +
      '</td>' +
      '<td><button class="status-toggle ' + stCls + '" onclick="toggleAliasStatus(' + a.id + ')"><span class="st-dot"></span> ' + stLbl + '</button></td>' +
      '<td class="col-received"><span style="font-family:var(--MONO);font-size:.8rem;font-weight:600;color:var(--INK);">' + (a.total_received || 0) + '</span></td>' +
      '<td class="col-last-used"><span style="font-size:.78rem;color:var(--MU);">' + (a.last_received_at || 'Never') + '</span></td>' +
      '<td>' +
        '<div class="row-acts">' +
          '<button class="act-btn view" title="View details" onclick="window.location=\'/addresses/' + a.id + '\'">' +
            '<svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>' +
          '</button>' +
          '<button class="act-btn copy" title="Copy alias" onclick="copyAlias(\'' + a.email + '\')">' +
            '<svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><rect x="9" y="9" width="13" height="13" rx="2"/><path stroke-linecap="round" d="M5 15H4a2 2 0 01-2-2V4a2 2 0 012-2h9a2 2 0 012 2v1"/></svg>' +
          '</button>' +
          '<button class="act-btn edit" title="Edit alias" onclick="openEditModal(' + a.id + ')">' +
            '<svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>' +
          '</button>' +
          '<button class="act-btn del" title="Delete alias" onclick="deleteAlias(' + a.id + ')">' +
            '<svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><polyline points="3 6 5 6 21 6"/><path stroke-linecap="round" d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6m5 0V4a1 1 0 011-1h2a1 1 0 011 1v2"/></svg>' +
          '</button>' +
        '</div>' +
      '</td>' +
    '</tr>';
  }).join('');
}

function filterAliases() { renderTable(); }

/* ── Row actions ── */
function copyAlias(email) {
  navigator.clipboard.writeText(email).catch(function(){});
  showToast('Copied: ' + email);
}

function toggleAliasStatus(id) {
  fetch('/aliases/' + id + '/status', {
    method: 'PATCH',
    headers: { 'X-CSRF-TOKEN': CSRF_TOKEN }
  }).then(function(r){ return r.json(); }).then(function(data) {
    if (data.error) { showToast(data.error, 'err'); return; }
    var a = aliases.find(function(x){ return x.id === id; });
    if (a) a.is_enabled = data.is_enabled;
    renderTable();
    showToast(data.is_enabled ? 'Alias activated' : 'Alias paused');
  }).catch(function() { showToast('Failed to toggle status', 'err'); });
}

function deleteAlias(id) {
  showConfirm('Delete this alias? This cannot be undone.', function() {
    fetch('/aliases/' + id, {
      method: 'DELETE',
      headers: { 'X-CSRF-TOKEN': CSRF_TOKEN }
    }).then(function(r){ return r.json(); }).then(function(data) {
      if (data.error) { showToast(data.error, 'err'); return; }
      aliases = aliases.filter(function(a){ return a.id !== id; });
      renderTable();
      showToast('Alias deleted');
    }).catch(function() { showToast('Failed to delete alias', 'err'); });
  });
}

/* ── Modal ── */
function resetModal() {
  document.getElementById('alias-prefix').value      = '';
  document.getElementById('alias-domain').innerHTML  = '';
  document.getElementById('alias-label-inp').value   = '';
  document.getElementById('alias-forward').value     = '';
  document.getElementById('alias-input-wrap').classList.remove('err');
  document.getElementById('prefix-err').classList.remove('show');
  document.getElementById('forward-err').classList.remove('show');
  var sw = document.getElementById('status-toggle');
  sw.classList.add('on'); sw._active = true;
}

function openCreateModal() {
  var atLimit = !IS_PRO && MAX_ALIASES > 0 && aliases.length >= MAX_ALIASES;
  if (atLimit) { showToast('Alias limit reached — upgrade to Pro', 'err'); return; }
  editingId = null;
  resetModal();
  document.getElementById('modal-title').textContent    = 'Create Alias';
  document.getElementById('modal-save-lbl').textContent = 'Create Alias';
  document.getElementById('alias-domain').disabled      = false;

  loadDomains(function(domains) {
    var sel = document.getElementById('alias-domain');
    sel.innerHTML = domains.map(function(d) {
      return '<option value="' + d.id + '" data-name="' + d.name + '">' + d.name + '</option>';
    }).join('');
  });

  document.getElementById('alias-modal').classList.add('open');
}

function openEditModal(id) {
  fetch('/aliases/' + id).then(function(r){ return r.json(); }).then(function(data) {
    var a = data.alias;
    if (!a) return;
    editingId = id;
    resetModal();
    document.getElementById('alias-prefix').value  = a.local_part;
    document.getElementById('alias-prefix').disabled = true;
    document.getElementById('alias-label-inp').value = a.description || '';
    document.getElementById('alias-forward').value   = a.forward_to || '';

    document.getElementById('modal-title').textContent    = 'Edit Alias';
    document.getElementById('modal-save-lbl').textContent = 'Save Changes';
    document.getElementById('alias-domain').disabled      = true;

    loadDomains(function(domains) {
      var sel = document.getElementById('alias-domain');
      sel.innerHTML = domains.map(function(d) {
        var selected = d.name === a.domain ? ' selected' : '';
        return '<option value="' + d.id + '" data-name="' + d.name + '"' + selected + '>' + d.name + '</option>';
      }).join('');
    });

    var sw = document.getElementById('status-toggle');
    sw._active = a.is_enabled;
    sw.classList.toggle('on', a.is_enabled);

    document.getElementById('alias-modal').classList.add('open');
  }).catch(function() { showToast('Failed to load alias', 'err'); });
}

function closeModal() {
  document.getElementById('alias-modal').classList.remove('open');
  editingId = null;
}

function toggleStatus(btn) {
  btn._active = !btn._active;
  btn.classList.toggle('on', btn._active);
}

function validatePrefix(inp) {
  var v = inp.value;
  var ok = !v || /^[a-z0-9][a-z0-9._-]{1,38}$/.test(v);
  document.getElementById('alias-input-wrap').classList.toggle('err', !ok && v.length > 0);
  document.getElementById('prefix-err').classList.toggle('show', !ok && v.length > 0);
  return ok || !v;
}

function validateForward(inp) {
  var v = inp.value;
  var ok = !v || /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(v);
  inp.classList.toggle('err', !ok && v.length > 0);
  document.getElementById('forward-err').classList.toggle('show', !ok && v.length > 0);
  return ok || !v;
}

function saveAlias() {
  var prefix  = document.getElementById('alias-prefix').value.trim();
  var domain  = document.getElementById('alias-domain');
  var domainId = domain.value;
  var domainName = domain.options[domain.selectedIndex].getAttribute('data-name');
  var label   = document.getElementById('alias-label-inp').value.trim();
  var forward = document.getElementById('alias-forward').value.trim();
  var sw      = document.getElementById('status-toggle');
  var active  = sw._active !== false;

  if (!prefix) { showToast('Please enter a prefix', 'err'); return; }
  if (!/^[a-z0-9][a-z0-9._-]{1,38}$/.test(prefix)) {
    document.getElementById('alias-input-wrap').classList.add('err');
    document.getElementById('prefix-err').classList.add('show');
    return;
  }
  if (forward && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(forward)) {
    document.getElementById('forward-err').classList.add('show');
    return;
  }

  if (editingId) {
    fetch('/aliases/' + editingId, {
      method: 'PATCH',
      headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': CSRF_TOKEN },
      body: JSON.stringify({ forward_to: forward, description: label, is_enabled: active })
    }).then(function(r){ return r.json(); }).then(function(data) {
      if (data.error) { showToast(data.error, 'err'); return; }
      var a = aliases.find(function(x){ return x.id === editingId; });
      if (a) { a.forward_to = forward; a.description = label; a.is_enabled = active; }
      closeModal();
      renderTable();
      showToast('Alias updated');
    }).catch(function() { showToast('Failed to update alias', 'err'); });
  } else {
    fetch('/aliases', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': CSRF_TOKEN },
      body: JSON.stringify({
        email_domain_id: domainId,
        local_part: prefix,
        forward_to: forward,
        description: label,
      })
    }).then(function(r){ return r.json(); }).then(function(data) {
      if (data.error) { showToast(data.error, 'err'); return; }
      aliases.push(data.alias);
      closeModal();
      renderTable();
      showToast('Alias created: ' + prefix + '@' + domainName);
    }).catch(function() { showToast('Failed to create alias', 'err'); });
  }
}

/* ── Export ── */
function exportCSV() {
  var rows = [['Alias','Description','Forward To','Status','Emails Received','Last Used']];
  aliases.forEach(function(a) {
    rows.push([a.email, a.description || '', a.forward_to || '', a.is_enabled ? 'Active' : 'Paused', a.total_received || 0, a.last_received_at || 'Never']);
  });
  var csv  = rows.map(function(r) { return r.map(function(c) { return '"' + String(c).replace(/"/g,'""') + '"'; }).join(','); }).join('\n');
  var blob = new Blob([csv], {type:'text/csv'});
  var url  = URL.createObjectURL(blob);
  var el   = document.createElement('a'); el.href = url; el.download = 'aliases.csv'; el.click();
  URL.revokeObjectURL(url);
  showToast('CSV exported');
}

/* ── Refresh ── */
function refreshPage() {
  var ic = document.getElementById('refresh-ic');
  ic.style.transition = 'transform .5s'; ic.style.transform = 'rotate(360deg)';
  setTimeout(function() { ic.style.transition = 'none'; ic.style.transform = ''; }, 520);
  loadAliases();
  showToast('Refreshed!');
}

/* ── Keyboard ── */
document.addEventListener('keydown', function(e) {
  if (e.key === 'Escape') { closeModal(); closeConfirm(); }
  if (e.key === 'n' && !e.ctrlKey && !e.metaKey && document.activeElement.tagName !== 'INPUT') openCreateModal();
});

/* ── Boot ── */
loadAliases();
</script>
@endpush
