@extends('layouts.authLayout')

@section('title', 'InboxOro — Settings')

@push('styles')
<style>
/* ════════════════════════════════════════
   SETTINGS PAGE
════════════════════════════════════════ */

/* ── Layout: nav tabs left + content right on desktop ── */
.settings-wrap {
  display: grid;
  grid-template-columns: 1fr;
  gap: 20px;
  align-items: start;
}
@media (min-width: 860px) {
  .settings-wrap { grid-template-columns: 220px 1fr; }
}

/* ── Side nav ── */
.settings-nav {
  background: var(--SURF);
  border: 1px solid var(--BD);
  border-radius: 12px;
  overflow: hidden;
  position: static;
}
@media (min-width: 860px) {
  .settings-nav {
    position: sticky;
    top: calc(56px + 20px);
  }
}
.settings-nav-title {
  padding: 12px 16px;
  font-family: var(--MONO);
  font-size: .58rem; font-weight: 700;
  letter-spacing: .12em; text-transform: uppercase;
  color: var(--MU2); border-bottom: 1px solid var(--BD2);
}
.settings-nav-item {
  display: flex; align-items: center; gap: 9px;
  padding: 10px 16px;
  font-size: .82rem; font-weight: 500; color: var(--MU);
  cursor: pointer; text-decoration: none;
  border-left: 3px solid transparent;
  transition: background .12s, color .12s, border-color .12s;
  background: none; border-top: none; border-right: none; border-bottom: none;
  width: 100%; text-align: left; font-family: var(--BODY);
  border-bottom: 1px solid var(--BD2);
}
@media (max-width: 859px) {
  .settings-nav {
    display: flex; overflow-x: auto; gap: 0;
    border-radius: 10px; -webkit-overflow-scrolling: touch;
    scrollbar-width: none;
  }
  .settings-nav::-webkit-scrollbar { display: none; }
  .settings-nav-title { display: none; }
  .settings-nav-item {
    flex: 0 0 auto; width: auto; white-space: nowrap;
    border-left: none; border-bottom: 2px solid transparent;
    padding: 10px 14px; font-size: .76rem;
  }
  .settings-nav-item.active { border-left-color: transparent; border-bottom-color: var(--Y); }
  .settings-nav-item.danger.active { border-left-color: transparent; border-bottom-color: var(--RED); }
}
.settings-nav-item:last-child { border-bottom: none; }
@media (max-width: 859px) { .settings-nav-item { border-bottom: 2px solid transparent; } }
.settings-nav-item:hover  { background: var(--BD2); color: var(--INK); }
.settings-nav-item.active { background: rgba(250,204,21,.06); color: var(--INK); border-left-color: var(--Y); font-weight: 600; }
.settings-nav-item.danger { color: var(--RED); }
.settings-nav-item.danger:hover { background: rgba(239,68,68,.06); }
.settings-nav-item.danger.active { border-left-color: var(--RED); background: rgba(239,68,68,.06); }
.nav-ic { display: flex; align-items: center; justify-content: center; width: 18px; flex-shrink: 0; }

/* ── Content area ── */
.settings-content { display: flex; flex-direction: column; gap: 20px; }

/* ── Setting card ── */
.scard {
  background: var(--SURF);
  border: 1px solid var(--BD);
  border-radius: 14px;
  overflow: hidden;
  scroll-margin-top: 90px;
}
.scard-hd {
  padding: 18px 22px;
  border-bottom: 1px solid var(--BD2);
  display: flex; align-items: flex-start; justify-content: space-between;
  gap: 10px; flex-wrap: wrap;
}
.scard-hd-left { display: flex; align-items: center; gap: 10px; }
.scard-hd-icon {
  width: 34px; height: 34px; border-radius: 9px;
  display: flex; align-items: center; justify-content: center;
  flex-shrink: 0;
}
.scard-hd-icon.y { background: rgba(250,204,21,.12); color: #92400E; }
.scard-hd-icon.g { background: rgba(16,185,129,.1);  color: var(--GREEN); }
.scard-hd-icon.b { background: rgba(59,130,246,.1);  color: var(--B); }
.scard-hd-icon.p { background: rgba(124,58,237,.1);  color: #7C3AED; }
.scard-hd-icon.r { background: rgba(239,68,68,.1);   color: var(--RED); }
.scard-hd-icon.gray { background: var(--BD2); color: var(--MU); }

.scard-title { font-weight: 700; font-size: .92rem; color: var(--INK); }
.scard-sub   { font-size: .74rem; color: var(--MU); margin-top: 2px; }

.scard-body { padding: 22px; }
.scard-footer {
  padding: 14px 22px;
  border-top: 1px solid var(--BD2);
  background: var(--BG);
  display: flex; align-items: center; justify-content: space-between;
  gap: 10px; flex-wrap: wrap;
}

/* ── Form fields ── */
.fields-grid {
  display: grid;
  grid-template-columns: 1fr;
  gap: 14px;
}
@media (min-width: 560px) { .fields-grid.two { grid-template-columns: 1fr 1fr; } }

.field { display: flex; flex-direction: column; gap: 5px; }
.field label {
  font-family: var(--MONO); font-size: .6rem; font-weight: 700;
  letter-spacing: .08em; text-transform: uppercase; color: var(--MU);
}
.field input, .field select {
  padding: 10px 14px; border: 1px solid var(--BD); border-radius: 9px;
  font-family: var(--BODY); font-size: 16px; color: var(--INK);
  background: var(--SURF); outline: none;
  transition: border-color .15s, box-shadow .15s;
}
.field input:focus, .field select:focus {
  border-color: var(--Y); box-shadow: 0 0 0 3px rgba(250,204,21,.15);
}
.field input.err   { border-color: var(--RED); box-shadow: 0 0 0 3px rgba(239,68,68,.1); }
.field input.ok    { border-color: var(--GREEN); }
.field-hint { font-size: .72rem; color: var(--MU2); margin-top: 1px; }
.field-err  { font-size: .72rem; color: var(--RED); font-weight: 500; display: none; }
.field-err.show { display: block; }

/* password eye toggle */
.pw-wrap { position: relative; }
.pw-wrap input { padding-right: 40px; }
.pw-eye {
  position: absolute; right: 12px; top: 50%; transform: translateY(-50%);
  background: none; border: none; cursor: pointer; color: var(--MU2);
  display: flex; transition: color .15s; padding: 2px;
}
.pw-eye:hover { color: var(--INK); }

/* password strength */
.pw-strength { margin-top: 6px; }
.pw-bars { display: flex; gap: 4px; margin-bottom: 4px; }
.pw-seg { flex: 1; height: 3px; border-radius: 2px; background: var(--BD); transition: background .3s; }
.pw-lbl { font-size: .7rem; font-weight: 500; }

/* ── Avatar ── */
.avatar-row {
  display: flex; align-items: center; gap: 16px;
  margin-bottom: 20px; padding-bottom: 20px;
  border-bottom: 1px solid var(--BD2);
}
.avatar-circle {
  width: 64px; height: 64px; border-radius: 50%;
  background: var(--Y); color: var(--INK);
  font-family: var(--DISP); font-size: 1.8rem; font-weight: 700;
  display: flex; align-items: center; justify-content: center;
  flex-shrink: 0; border: 3px solid var(--BD);
}
.avatar-info { flex: 1; min-width: 0; }
.avatar-name { font-weight: 700; font-size: .92rem; color: var(--INK); }
.avatar-email { font-size: .76rem; color: var(--MU); margin-top: 2px; font-family: var(--MONO); }
.avatar-change { font-size: .74rem; color: var(--B); cursor: pointer; margin-top: 4px; font-weight: 600; }
.avatar-change:hover { text-decoration: underline; }

/* ── Toggle switches ── */
.toggle-list { display: flex; flex-direction: column; gap: 0; }
.toggle-row {
  display: flex; align-items: center; justify-content: space-between;
  gap: 14px; padding: 14px 0;
  border-bottom: 1px solid var(--BD2);
}
.toggle-row:last-child { border-bottom: none; }
.toggle-left { flex: 1; min-width: 0; }
.toggle-lbl  { font-weight: 600; font-size: .85rem; color: var(--INK); }
.toggle-sub  { font-size: .74rem; color: var(--MU); margin-top: 2px; line-height: 1.4; }

.sw {
  width: 44px; height: 24px; border-radius: 12px;
  background: var(--BD); border: none; cursor: pointer;
  position: relative; flex-shrink: 0;
  transition: background .2s;
}
.sw.on { background: var(--GREEN); }
.sw::after {
  content: ''; position: absolute;
  width: 18px; height: 18px; border-radius: 50%;
  background: #fff; top: 3px; left: 3px;
  transition: left .2s;
  box-shadow: 0 1px 4px rgba(0,0,0,.2);
}
.sw.on::after { left: 23px; }

/* ── Domain card ── */
.current-domain-row {
  display: flex; align-items: center; justify-content: space-between;
  gap: 12px; padding: 14px 16px;
  background: var(--BG); border: 1px solid var(--BD);
  border-radius: 10px;
}
.domain-badge {
  font-family: var(--MONO); font-size: .84rem; font-weight: 700; color: var(--INK);
  display: flex; align-items: center; gap: 8px;
}
.domain-dot { width: 8px; height: 8px; background: var(--GREEN); border-radius: 50%; animation: pulse-d 2s ease-in-out infinite; }
@keyframes pulse-d { 0%,100%{box-shadow:0 0 0 0 rgba(16,185,129,.5)}50%{box-shadow:0 0 0 4px rgba(16,185,129,0)} }

/* ── API prefs ── */
.api-row {
  display: flex; align-items: center; justify-content: space-between;
  gap: 10px; padding: 10px 0; border-bottom: 1px solid var(--BD2);
}
.api-row:last-child { border-bottom: none; }
.api-row-lbl { font-size: .82rem; font-weight: 500; color: var(--INK); }
.api-row-val { font-family: var(--MONO); font-size: .78rem; font-weight: 700; color: var(--INK); }
.api-row-val.green { color: var(--GREEN); }

.usage-mini-track { width: 100px; height: 5px; background: var(--BD2); border-radius: 3px; overflow: hidden; }
.usage-mini-fill  { height: 100%; border-radius: 3px; background: var(--GREEN); }
.usage-mini-fill.warn { background: var(--Y); }
.usage-mini-fill.danger { background: var(--RED); }

/* ── Plan card ── */
.plan-header {
  display: flex; align-items: center; gap: 14px;
  padding: 16px 22px;
  background: var(--INK); border-bottom: 1px solid rgba(255,255,255,.08);
  position: relative; overflow: hidden;
}
.plan-header::before {
  content: ''; position: absolute; top: 0; left: 0; right: 0; height: 2px;
  background: linear-gradient(90deg, var(--Y), #F59E0B, var(--Y));
}
.plan-name { font-family: var(--DISP); font-size: 1.4rem; letter-spacing: .04em; color: #fff; }
.plan-name span { color: var(--Y); }
.plan-badge { font-family: var(--MONO); font-size: .58rem; font-weight: 800; padding: 3px 9px; border-radius: 10px; }
.plan-badge.free { background: rgba(250,204,21,.15); color: var(--Y); }
.plan-badge.pro  { background: rgba(124,58,237,.2);  color: #A78BFA; }
.plan-features { padding: 16px 22px; display: flex; flex-direction: column; gap: 0; }
.plan-feat-row {
  display: flex; align-items: center; gap: 10px; padding: 10px 0;
  border-bottom: 1px solid var(--BD2); font-size: .82rem;
}
.plan-feat-row:last-child { border-bottom: none; }
.pf-lbl { flex: 1; color: var(--INK); font-weight: 500; }
.pf-val { font-family: var(--MONO); font-size: .72rem; font-weight: 700; color: var(--INK); }
.pf-bar { width: 80px; height: 4px; background: var(--BD2); border-radius: 2px; overflow: hidden; }
.pf-fill { height: 100%; border-radius: 2px; }
.pf-fill.y { background: var(--Y); }
.pf-fill.g { background: var(--GREEN); }
.pf-fill.b { background: var(--B); }

/* ── Session card ── */
.session-row {
  display: flex; align-items: center; gap: 14px;
  padding: 14px 0; border-bottom: 1px solid var(--BD2);
}
.session-row:last-child { border-bottom: none; }
.session-device {
  width: 36px; height: 36px; background: var(--BD2); border-radius: 9px;
  display: flex; align-items: center; justify-content: center; color: var(--MU); flex-shrink: 0;
}
.session-body { flex: 1; min-width: 0; }
.session-name { font-weight: 600; font-size: .84rem; color: var(--INK); }
.session-meta { font-size: .72rem; color: var(--MU); margin-top: 2px; font-family: var(--MONO); }
.session-tag  { display: inline-flex; align-items: center; gap: 4px; font-family: var(--MONO); font-size: .56rem; font-weight: 700; padding: 2px 7px; border-radius: 10px; }
.session-tag.current { background: rgba(16,185,129,.1); color: var(--GREEN); }
.session-tag.other   { background: var(--BD2); color: var(--MU); }

/* ── Danger zone ── */
.danger-body { padding: 22px; display: flex; align-items: flex-start; justify-content: space-between; gap: 16px; flex-wrap: wrap; }
.danger-text .danger-title { font-weight: 700; font-size: .9rem; color: var(--RED); margin-bottom: 4px; }
.danger-text .danger-desc  { font-size: .8rem; color: var(--MU); line-height: 1.55; max-width: 380px; }

/* ── Save feedback ── */
@keyframes save-pulse { 0%{transform:scale(1)}50%{transform:scale(1.04)}100%{transform:scale(1)} }
.save-success { animation: save-pulse .3s ease; }

/* ── Status badge ── */
.status-ok { display: inline-flex; align-items: center; gap: 5px; font-family: var(--MONO); font-size: .64rem; font-weight: 700; background: rgba(16,185,129,.1); color: var(--GREEN); padding: 3px 10px; border-radius: 20px; }
.status-ok-dot { width: 5px; height: 5px; background: var(--GREEN); border-radius: 50%; }

/* ══════════════════════════════════════
   MODALS
══════════════════════════════════════ */
.modal-overlay {
  position: fixed; inset: 0; z-index: 500;
  background: rgba(0,0,0,.5); backdrop-filter: blur(3px);
  display: none; align-items: center; justify-content: center; padding: 16px;
}
.modal-overlay.open { display: flex; animation: fade-bg .18s ease both; }
@keyframes fade-bg { from{opacity:0}to{opacity:1} }

.modal-box {
  background: var(--SURF); border-radius: 14px; border: 1px solid var(--BD);
  width: 100%; max-width: 440px;
  box-shadow: 0 20px 60px rgba(0,0,0,.18);
  animation: modal-up .22s cubic-bezier(.34,1.56,.64,1) both;
}
@keyframes modal-up { from{transform:translateY(10px) scale(.97);opacity:0}to{transform:none;opacity:1} }

.modal-hd { display: flex; align-items: center; justify-content: space-between; padding: 16px 20px; border-bottom: 1px solid var(--BD2); }
.modal-title { font-family: var(--DISP); font-size: 1.1rem; letter-spacing: .04em; color: var(--INK); }
.modal-close { width: 32px; height: 32px; display: flex; align-items: center; justify-content: center; border-radius: 8px; border: 1px solid var(--BD); background: transparent; color: var(--MU); cursor: pointer; transition: background .12s, color .12s; }
.modal-close:hover { background: var(--BD2); color: var(--INK); }
.modal-body { padding: 20px; display: flex; flex-direction: column; gap: 14px; }
.modal-ft   { padding: 14px 20px; border-top: 1px solid var(--BD2); display: flex; gap: 8px; justify-content: flex-end; }

.warn-box {
  display: flex; align-items: flex-start; gap: 10px;
  background: #FEF2F2; border: 1px solid rgba(239,68,68,.2); border-left: 4px solid var(--RED);
  border-radius: 8px; padding: 12px 14px; font-size: .8rem; color: #7F1D1D; line-height: 1.55;
}
.warn-box svg { flex-shrink: 0; color: var(--RED); margin-top: 1px; }

/* domain selector modal */
.domain-option {
  display: flex; align-items: center; gap: 12px; padding: 11px 14px;
  border: 1.5px solid var(--BD); border-radius: 9px; cursor: pointer;
  transition: border-color .12s, background .12s;
}
.domain-option:hover { border-color: #D1D5DB; background: var(--BD2); }
.domain-option.selected { border-color: var(--Y); background: rgba(250,204,21,.06); }
.domain-option-name { font-family: var(--MONO); font-size: .82rem; font-weight: 700; color: var(--INK); flex: 1; }
.domain-check { width: 18px; height: 18px; border-radius: 50%; border: 2px solid var(--BD); display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
.domain-option.selected .domain-check { background: var(--Y); border-color: var(--Y); }

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

<!-- ════════ DELETE ACCOUNT MODAL ════════ -->
<div class="modal-overlay" id="delete-modal">
  <div class="modal-box">
    <div class="modal-hd">
      <div class="modal-title" style="color:var(--RED);">Delete Account</div>
      <button class="modal-close" onclick="closeDeleteModal()">
        <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M6 18L18 6M6 6l12 12"/></svg>
      </button>
    </div>
    <div class="modal-body">
      <div style="text-align:center;margin-bottom:4px;">
        <div style="width:56px;height:56px;background:rgba(239,68,68,.1);border-radius:50%;display:flex;align-items:center;justify-content:center;color:var(--RED);margin:0 auto 12px;">
          <svg width="26" height="26" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
        </div>
        <div style="font-family:var(--DISP);font-size:1.2rem;letter-spacing:.03em;color:var(--INK);">Are you absolutely sure?</div>
        <div style="font-size:.8rem;color:var(--MU);margin-top:4px;line-height:1.5;">This action is permanent and cannot be undone. All your data will be deleted immediately.</div>
      </div>
      <div class="warn-box">
        <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
        <div>Deleting your account will permanently remove all <strong>aliases</strong>, <strong>API keys</strong>, <strong>inbox history</strong>, and <strong>account settings</strong>. This cannot be recovered.</div>
      </div>
      <div class="field">
        <label>Type <strong>DELETE</strong> to confirm</label>
        <input type="text" id="delete-confirm-input" placeholder="DELETE" oninput="checkDeleteConfirm(this)"/>
        <div class="field-err" id="delete-confirm-err">Please type DELETE to confirm.</div>
      </div>
    </div>
    <div class="modal-ft">
      <button class="btn-ghost" onclick="closeDeleteModal()">Cancel</button>
      <button class="btn-primary" id="delete-confirm-btn" style="background:var(--RED);opacity:.5;cursor:not-allowed;" disabled onclick="confirmDelete()">
        <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><polyline points="3 6 5 6 21 6"/><path stroke-linecap="round" d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6m5 0V4a1 1 0 011-1h2a1 1 0 011 1v2"/></svg>
        Delete My Account
      </button>
    </div>
  </div>
</div>

<!-- ════════ CHANGE DOMAIN MODAL ════════ -->
<div class="modal-overlay" id="domain-modal">
  <div class="modal-box">
    <div class="modal-hd">
      <div class="modal-title">Change Default Domain</div>
      <button class="modal-close" onclick="closeDomainModal()">
        <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M6 18L18 6M6 6l12 12"/></svg>
      </button>
    </div>
    <div class="modal-body">
      <p style="font-size:.82rem;color:var(--MU);margin-bottom:2px;">New addresses will use this domain by default. You can always change it later.</p>
      <div id="domain-options" style="display:flex;flex-direction:column;gap:8px;"></div>
    </div>
    <div class="modal-ft">
      <button class="btn-ghost" onclick="closeDomainModal()">Cancel</button>
      <button class="btn-primary yellow" onclick="saveDomain()">
        <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M5 13l4 4L19 7"/></svg>
        Save Default Domain
      </button>
    </div>
  </div>
</div>

<!-- ════════ LOGOUT ALL MODAL ════════ -->
<div class="modal-overlay" id="logout-modal">
  <div class="modal-box">
    <div class="modal-hd">
      <div class="modal-title">Logout All Devices</div>
      <button class="modal-close" onclick="closeLogoutModal()">
        <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M6 18L18 6M6 6l12 12"/></svg>
      </button>
    </div>
    <div class="modal-body">
      <div style="text-align:center;margin-bottom:8px;">
        <div style="width:50px;height:50px;background:rgba(245,158,11,.1);border-radius:50%;display:flex;align-items:center;justify-content:center;color:#D97706;margin:0 auto 10px;">
          <svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
        </div>
        <div style="font-family:var(--DISP);font-size:1.1rem;letter-spacing:.03em;color:var(--INK);">Logout all other devices?</div>
        <div style="font-size:.8rem;color:var(--MU);margin-top:4px;">You'll stay logged in on this device. All other active sessions will be terminated immediately.</div>
      </div>
    </div>
    <div class="modal-ft">
      <button class="btn-ghost" onclick="closeLogoutModal()">Cancel</button>
      <button class="btn-primary" style="background:#F59E0B;" onclick="confirmLogout()">
        Logout All Other Devices
      </button>
    </div>
  </div>
</div>

<!-- ── Page header ── -->
<div class="page-hd" style="margin-bottom:20px;">
  <div>
    <div class="page-title">Settings</div>
    <div class="page-subtitle">Manage your account and preferences.</div>
  </div>
</div>

<div class="settings-wrap">

  <!-- ── Side navigation ── -->
  <div class="settings-nav">
    <div class="settings-nav-title">Navigation</div>
    <button class="settings-nav-item active" onclick="scrollToSection('sec-account',this)">
      <span class="nav-ic"><svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg></span>
      Account
    </button>
    <button class="settings-nav-item" onclick="scrollToSection('sec-security',this)">
      <span class="nav-ic"><svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg></span>
      Security
    </button>
    <button class="settings-nav-item" onclick="scrollToSection('sec-sessions',this)">
      <span class="nav-ic"><svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17H3a2 2 0 01-2-2V5a2 2 0 012-2h16a2 2 0 012 2v10a2 2 0 01-2 2h-2"/></svg></span>
      Sessions
    </button>
    <button class="settings-nav-item" onclick="scrollToSection('sec-email-prefs',this)">
      <span class="nav-ic"><svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg></span>
      Email Preferences
    </button>
    <button class="settings-nav-item" onclick="scrollToSection('sec-domain',this)">
      <span class="nav-ic"><svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path stroke-linecap="round" d="M2 12h20M12 2a15.3 15.3 0 010 20M12 2a15.3 15.3 0 000 20"/></svg></span>
      Default Domain
    </button>
    <button class="settings-nav-item" onclick="scrollToSection('sec-api',this)">
      <span class="nav-ic"><svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/></svg></span>
      API Preferences
    </button>
    <button class="settings-nav-item" onclick="scrollToSection('sec-plan',this)">
      <span class="nav-ic"><svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg></span>
      Plan
    </button>
    <button class="settings-nav-item danger" onclick="scrollToSection('sec-danger',this)">
      <span class="nav-ic"><svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg></span>
      Danger Zone
    </button>
  </div>

  <!-- ── Settings content ── -->
  <div class="settings-content">

    <!-- ①  ACCOUNT INFORMATION -->
    <div class="scard" id="sec-account">
      <div class="scard-hd">
        <div class="scard-hd-left">
          <div class="scard-hd-icon y">
            <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
          </div>
          <div>
            <div class="scard-title">Account Information</div>
            <div class="scard-sub">Update your name, email and username.</div>
          </div>
        </div>
      </div>
      <div class="scard-body">
        <!-- Avatar row -->
        <div class="avatar-row">
          <div class="avatar-circle" id="avatar-initials">JD</div>
          <div class="avatar-info">
            <div class="avatar-name" id="avatar-display-name">John Doe</div>
            <div class="avatar-email" id="avatar-display-email">john@example.com</div>
            <div class="avatar-change" onclick="document.getElementById('avatar-input').click()">Change photo</div>
            <input type="file" id="avatar-input" accept="image/png,image/jpeg,image/webp" style="display:none" onchange="changeAvatar(this)"/>
          </div>
        </div>
        <!-- Fields -->
        <div class="fields-grid two">
          <div class="field">
            <label>Full Name <span style="color:var(--RED);">*</span></label>
            <input type="text" id="field-name" value="John Doe" oninput="updateAvatar()"/>
            <div class="field-err" id="name-err">Name is required.</div>
          </div>
          <div class="field">
            <label>Username</label>
            <div style="display:flex;align-items:center;border:1px solid var(--BD);border-radius:9px;overflow:hidden;transition:border-color .15s, box-shadow .15s;" id="username-wrap">
              <span style="padding:10px 12px;background:var(--BD2);font-family:var(--MONO);font-size:.8rem;color:var(--MU);border-right:1px solid var(--BD);flex-shrink:0;">@</span>
              <input type="text" id="field-username" value="johndoe" style="border:none;outline:none;background:transparent;padding:10px 12px;font-family:var(--MONO);font-size:.84rem;color:var(--INK);flex:1;font-size:16px;" oninput="validateUsername(this)"/>
            </div>
            <div class="field-err" id="username-err">3–20 chars, letters/numbers/hyphens only.</div>
          </div>
          <div class="field" style="grid-column:1/-1;">
            <label>Email Address <span style="color:var(--RED);">*</span></label>
            <input type="email" id="field-email" value="john@example.com" oninput="validateEmail(this)"/>
            <div class="field-err" id="email-err">Please enter a valid email address.</div>
          </div>
        </div>
      </div>
      <div class="scard-footer">
        <div style="font-family:var(--MONO);font-size:.62rem;color:var(--MU2);" id="account-saved-lbl"></div>
        <div style="display:flex;gap:8px;">
          <button class="btn-ghost" onclick="resetAccount()">Discard</button>
          <button class="btn-primary yellow" onclick="saveAccount()">
            <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M5 13l4 4L19 7"/></svg>
            Save Changes
          </button>
        </div>
      </div>
    </div>

    <!-- ②  SECURITY -->
    <div class="scard" id="sec-security">
      <div class="scard-hd">
        <div class="scard-hd-left">
          <div class="scard-hd-icon g">
            <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
          </div>
          <div>
            <div class="scard-title">Security</div>
            <div class="scard-sub">Change your password to keep your account secure.</div>
          </div>
        </div>
      </div>
      <div class="scard-body">
        <div class="fields-grid">
          <div class="field">
            <label>Current Password</label>
            <div class="pw-wrap">
              <input type="password" id="pw-current" placeholder="Enter current password"/>
              <button class="pw-eye" type="button" onclick="togglePw('pw-current')">
                <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
              </button>
            </div>
            <div class="field-err" id="pw-current-err">Current password is required.</div>
          </div>
          <div class="field">
            <label>New Password</label>
            <div class="pw-wrap">
              <input type="password" id="pw-new" placeholder="Min. 8 characters" oninput="checkStrength(this.value)"/>
              <button class="pw-eye" type="button" onclick="togglePw('pw-new')">
                <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
              </button>
            </div>
            <div class="pw-strength">
              <div class="pw-bars">
                <div class="pw-seg" id="ps1"></div>
                <div class="pw-seg" id="ps2"></div>
                <div class="pw-seg" id="ps3"></div>
                <div class="pw-seg" id="ps4"></div>
              </div>
              <div class="pw-lbl" id="pw-lbl" style="color:var(--MU2);">Enter a password</div>
            </div>
            <div class="field-err" id="pw-new-err">Password must be at least 8 characters.</div>
          </div>
          <div class="field">
            <label>Confirm New Password</label>
            <div class="pw-wrap">
              <input type="password" id="pw-confirm" placeholder="Re-enter new password" oninput="checkMatch()"/>
              <button class="pw-eye" type="button" onclick="togglePw('pw-confirm')">
                <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
              </button>
            </div>
            <div class="field-err" id="pw-confirm-err">Passwords do not match.</div>
          </div>
        </div>
      </div>
      <div class="scard-footer">
        <div style="font-family:var(--MONO);font-size:.62rem;color:var(--MU2);" id="pw-saved-lbl"></div>
        <button class="btn-primary" onclick="changePassword()">
          <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
          Change Password
        </button>
      </div>
    </div>

    <!-- ③  SESSIONS -->
    <div class="scard" id="sec-sessions">
      <div class="scard-hd">
        <div class="scard-hd-left">
          <div class="scard-hd-icon b">
            <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17H3a2 2 0 01-2-2V5a2 2 0 012-2h16a2 2 0 012 2v10a2 2 0 01-2 2h-2"/></svg>
          </div>
          <div>
            <div class="scard-title">Session Management</div>
            <div class="scard-sub">View and manage your active login sessions.</div>
          </div>
        </div>
        <span class="status-ok"><span class="status-ok-dot"></span>3 Active</span>
      </div>
      <div class="scard-body" style="padding:14px 22px;">
        <div class="session-row">
          <div class="session-device"><svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><rect x="2" y="3" width="20" height="14" rx="2"/><path stroke-linecap="round" d="M8 21h8M12 17v4"/></svg></div>
          <div class="session-body">
            <div class="session-name">Chrome on macOS <span class="session-tag current">Current</span></div>
            <div class="session-meta">Bhātpāra, West Bengal, IN · Active now</div>
          </div>
        </div>
        <div class="session-row">
          <div class="session-device"><svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><rect x="5" y="2" width="14" height="20" rx="2"/><path stroke-linecap="round" d="M12 18h.01"/></svg></div>
          <div class="session-body">
            <div class="session-name">Safari on iPhone <span class="session-tag other">Other</span></div>
            <div class="session-meta">Kolkata, WB, IN · 2 hours ago</div>
          </div>
        </div>
        <div class="session-row">
          <div class="session-device"><svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><rect x="2" y="3" width="20" height="14" rx="2"/><path stroke-linecap="round" d="M8 21h8M12 17v4"/></svg></div>
          <div class="session-body">
            <div class="session-name">Firefox on Windows <span class="session-tag other">Other</span></div>
            <div class="session-meta">Delhi, IN · Yesterday, 11:42 PM</div>
          </div>
        </div>
      </div>
      <div class="scard-footer">
        <div style="font-size:.76rem;color:var(--MU);">2 other devices are logged in.</div>
        <button class="btn-ghost" style="color:var(--RED);border-color:rgba(239,68,68,.3);" onclick="openLogoutModal()">
          <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
          Logout All Other Devices
        </button>
      </div>
    </div>

    <!-- ④  EMAIL PREFERENCES -->
    <div class="scard" id="sec-email-prefs">
      <div class="scard-hd">
        <div class="scard-hd-left">
          <div class="scard-hd-icon y">
            <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
          </div>
          <div>
            <div class="scard-title">Email Preferences</div>
            <div class="scard-sub">Choose what emails you receive from InboxOro.</div>
          </div>
        </div>
      </div>
      <div class="scard-body" style="padding:6px 22px;">
        <div class="toggle-list">
          <div class="toggle-row">
            <div class="toggle-left">
              <div class="toggle-lbl">Product Updates</div>
              <div class="toggle-sub">New features, improvements and product announcements.</div>
            </div>
            <button class="sw on" id="sw-product" onclick="toggleSw(this,'sw-product')" aria-label="Toggle product updates"></button>
          </div>
          <div class="toggle-row">
            <div class="toggle-left">
              <div class="toggle-lbl">Security Notifications</div>
              <div class="toggle-sub">Alerts for new logins, password changes, and suspicious activity.</div>
            </div>
            <button class="sw on" id="sw-security" onclick="toggleSw(this,'sw-security')" aria-label="Toggle security notifications"></button>
          </div>
          <div class="toggle-row">
            <div class="toggle-left">
              <div class="toggle-lbl">Marketing Emails</div>
              <div class="toggle-sub">Tips, tutorials, and offers from InboxOro.</div>
            </div>
            <button class="sw" id="sw-marketing" onclick="toggleSw(this,'sw-marketing')" aria-label="Toggle marketing emails"></button>
          </div>
        </div>
      </div>
      <div class="scard-footer">
        <div style="font-family:var(--MONO);font-size:.62rem;color:var(--MU2);" id="prefs-saved-lbl"></div>
        <button class="btn-primary yellow" onclick="savePreferences()">
          <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M5 13l4 4L19 7"/></svg>
          Save Preferences
        </button>
      </div>
    </div>

    <!-- ⑤  DEFAULT DOMAIN -->
    <div class="scard" id="sec-domain">
      <div class="scard-hd">
        <div class="scard-hd-left">
          <div class="scard-hd-icon gray">
            <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path stroke-linecap="round" d="M2 12h20M12 2a15.3 15.3 0 010 20M12 2a15.3 15.3 0 000 20"/></svg>
          </div>
          <div>
            <div class="scard-title">Default Domain</div>
            <div class="scard-sub">New addresses will use this domain unless you choose otherwise.</div>
          </div>
        </div>
      </div>
      <div class="scard-body">
        <div class="current-domain-row">
          <div class="domain-badge">
            <div class="domain-dot"></div>
            <span style="font-size:.72rem;color:var(--MU2);">Default:</span>
            <span id="current-domain-display">@dropit.io</span>
          </div>
          <span class="status-ok"><span class="status-ok-dot"></span>Active</span>
        </div>
        <p style="font-size:.78rem;color:var(--MU);margin-top:10px;line-height:1.55;">This domain is used when generating new temporary email addresses. All 5 free domains support email receiving, OTP detection, and temporary use.</p>
      </div>
      <div class="scard-footer">
        <div style="font-family:var(--MONO);font-size:.62rem;color:var(--MU2);">5 domains available</div>
        <button class="btn-primary yellow" onclick="openDomainModal()">
          <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/></svg>
          Change Default Domain
        </button>
      </div>
    </div>

    <!-- ⑥  API PREFERENCES -->
    <div class="scard" id="sec-api">
      <div class="scard-hd">
        <div class="scard-hd-left">
          <div class="scard-hd-icon b">
            <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/></svg>
          </div>
          <div>
            <div class="scard-title">API Preferences</div>
            <div class="scard-sub">Monitor and manage your API access.</div>
          </div>
        </div>
      </div>
      <div class="scard-body" style="padding:10px 22px;">
        <div class="api-row">
          <div class="api-row-lbl">API Access Status</div>
          <span class="status-ok"><span class="status-ok-dot"></span>Enabled</span>
        </div>
        <div class="api-row">
          <div class="api-row-lbl">Active API Keys</div>
          <div class="api-row-val">2 of 3</div>
        </div>
        <div class="api-row">
          <div style="flex:1;">
            <div class="api-row-lbl">API Requests Today</div>
            <div style="display:flex;align-items:center;gap:8px;margin-top:4px;">
              <div class="usage-mini-track"><div class="usage-mini-fill" style="width:25%;"></div></div>
              <span style="font-family:var(--MONO);font-size:.7rem;color:var(--GREEN);font-weight:700;">25%</span>
            </div>
          </div>
          <div class="api-row-val">25 / 100</div>
        </div>
        <div class="api-row">
          <div class="api-row-lbl">Rate Limit</div>
          <div class="api-row-val">10 req / min</div>
        </div>
        <div class="api-row">
          <div class="api-row-lbl">Plan</div>
          <div class="api-row-val" style="color:#92400E;">Free</div>
        </div>
      </div>
      <div class="scard-footer">
        <div style="font-size:.76rem;color:var(--MU);">Resets daily at midnight UTC.</div>
        <a href="api-keys.html" class="btn-primary" style="text-decoration:none;display:inline-flex;align-items:center;gap:6px;">
          <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/></svg>
          Manage API Keys
        </a>
      </div>
    </div>

    <!-- ⑦  PLAN INFORMATION -->
    <div class="scard" id="sec-plan" style="overflow:hidden;">
      <div class="plan-header">
        <div>
          <div style="font-family:var(--MONO);font-size:.58rem;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:rgba(255,255,255,.4);margin-bottom:4px;">Current Plan</div>
          <div class="plan-name">INBOX<span>ORO</span></div>
        </div>
        <span class="plan-badge free">FREE PLAN</span>
      </div>
      <div class="plan-features">
        <div class="plan-feat-row">
          <span class="pf-lbl">Aliases Used</span>
          <div class="pf-bar"><div class="pf-fill y" style="width:60%;"></div></div>
          <span class="pf-val">3 / 5</span>
        </div>
        <div class="plan-feat-row">
          <span class="pf-lbl">API Requests Today</span>
          <div class="pf-bar"><div class="pf-fill g" style="width:25%;"></div></div>
          <span class="pf-val">25 / 100</span>
        </div>
        <div class="plan-feat-row">
          <span class="pf-lbl">Email History</span>
          <div class="pf-bar"><div class="pf-fill b" style="width:100%;"></div></div>
          <span class="pf-val">7 Days</span>
        </div>
        <div class="plan-feat-row">
          <span class="pf-lbl">API Keys</span>
          <div class="pf-bar"><div class="pf-fill y" style="width:67%;"></div></div>
          <span class="pf-val">2 / 3</span>
        </div>
        <div class="plan-feat-row">
          <span class="pf-lbl">Domains</span>
          <div class="pf-bar"><div class="pf-fill g" style="width:100%;"></div></div>
          <span class="pf-val">5 Free</span>
        </div>
      </div>
      <div class="scard-footer">
        <div style="font-size:.76rem;color:var(--MU);">Upgrade for unlimited aliases, 30-day history & more.</div>
        <button class="btn-primary" style="background:linear-gradient(135deg,#7C3AED,#6D28D9);" onclick="openUpgradeModal()">
          <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
          Upgrade to Pro
        </button>
      </div>
    </div>

    <!-- ⑧  DANGER ZONE -->
    <div class="scard" id="sec-danger" style="border-color:rgba(239,68,68,.25);">
      <div class="scard-hd" style="border-bottom-color:rgba(239,68,68,.15);background:rgba(239,68,68,.03);">
        <div class="scard-hd-left">
          <div class="scard-hd-icon r">
            <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
          </div>
          <div>
            <div class="scard-title" style="color:var(--RED);">Danger Zone</div>
            <div class="scard-sub">Irreversible actions. Proceed with caution.</div>
          </div>
        </div>
      </div>
      <div class="danger-body">
        <div class="danger-text">
          <div class="danger-title">Delete Account</div>
          <div class="danger-desc">Deleting your account will permanently remove all aliases, API keys, inbox history, SMTP sandbox data, and account settings. This action <strong>cannot be undone</strong> and your data cannot be recovered.</div>
        </div>
        <button class="btn-primary" style="background:var(--RED);flex-shrink:0;" onclick="openDeleteModal()">
          <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><polyline points="3 6 5 6 21 6"/><path stroke-linecap="round" d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6m5 0V4a1 1 0 011-1h2a1 1 0 011 1v2"/></svg>
          Delete Account
        </button>
      </div>
    </div>

  </div><!-- /settings-content -->
</div><!-- /settings-wrap -->

@endsection

@push('scripts')
<script>

/* ════════════════════════════════════════
   SETTINGS PAGE LOGIC
════════════════════════════════════════ */

let currentDomain = 'dropit.io';
const DOMAINS = ['dropit.io','burnbox.dev','zaptmp.net','voidmail.cc','mailsink.app'];

/* ── Side nav scroll ── */
window.scrollToSection = function(id, btn) {
  document.querySelectorAll('.settings-nav-item').forEach(function(b) { b.classList.remove('active'); });
  btn.classList.add('active');
  var el = document.getElementById(id);
  var main = document.querySelector('.main');
  if (el && main) {
    var top = el.getBoundingClientRect().top - main.getBoundingClientRect().top + main.scrollTop - 100;
    main.scrollTo({top: top, behavior: 'smooth'});
  }
};

/* Highlight active nav on scroll */
const sections = ['sec-account','sec-security','sec-sessions','sec-email-prefs','sec-domain','sec-api','sec-plan','sec-danger'];
(function() {
  var main = document.querySelector('.main');
  if (!main) return;
  main.addEventListener('scroll', function() {
    var scrollPos = main.scrollTop;
    var active = sections[0];
    var mainRect = main.getBoundingClientRect();
    sections.forEach(function(id) {
      var el = document.getElementById(id);
      if (el) {
        var top = el.getBoundingClientRect().top - mainRect.top;
        if (top < 120) active = id;
      }
    });
    var idx = sections.indexOf(active);
    document.querySelectorAll('.settings-nav-item').forEach(function(btn, i) {
      btn.classList.toggle('active', i === idx);
    });
  }, {passive:true});
})();

/* ── Account ── */
function updateAvatar() {
  var name = document.getElementById('field-name').value.trim();
  var parts = name.split(' ').filter(Boolean);
  var initials = parts.length >= 2 ? parts[0][0]+parts[parts.length-1][0] : (parts[0]||'?').substring(0,2);
  document.getElementById('avatar-initials').textContent = initials.toUpperCase();
  document.getElementById('avatar-display-name').textContent = name || 'Your Name';
}

function changeAvatar(inp) {
  var file = inp.files && inp.files[0];
  if (!file) return;
  if (file.size > 2 * 1024 * 1024) { showToast('Image must be under 2MB', 'err'); return; }
  var reader = new FileReader();
  reader.onload = function(e) {
    var circle = document.getElementById('avatar-initials');
    circle.textContent = '';
    circle.style.backgroundImage = 'url(' + e.target.result + ')';
    circle.style.backgroundSize = 'cover';
    circle.style.backgroundPosition = 'center';
    circle.style.backgroundRepeat = 'no-repeat';
    circle.style.border = '2px solid var(--BD)';
    circle.style.borderRadius = '50%';
    showToast('Photo updated!');
  };
  reader.readAsDataURL(file);
  inp.value = '';
}

function validateEmail(inp) {
  const ok = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(inp.value);
  inp.classList.toggle('err', inp.value && !ok);
  document.getElementById('email-err').classList.toggle('show', inp.value && !ok);
  if (ok) inp.classList.add('ok'); else inp.classList.remove('ok');
  return ok || !inp.value;
}

function validateUsername(inp) {
  const ok = /^[a-z0-9][a-z0-9_-]{2,19}$/.test(inp.value);
  const wrap = document.getElementById('username-wrap');
  wrap.style.borderColor = inp.value ? (ok ? 'var(--GREEN)' : 'var(--RED)') : 'var(--BD)';
  wrap.style.boxShadow   = inp.value ? (ok ? '0 0 0 3px rgba(16,185,129,.12)' : '0 0 0 3px rgba(239,68,68,.1)') : '';
  document.getElementById('username-err').classList.toggle('show', inp.value && !ok);
  return ok || !inp.value;
}

function saveAccount() {
  const name  = document.getElementById('field-name').value.trim();
  const email = document.getElementById('field-email').value.trim();
  let ok = true;
  if (!name) { document.getElementById('field-name').classList.add('err'); document.getElementById('name-err').classList.add('show'); ok=false; }
  else { document.getElementById('field-name').classList.remove('err'); document.getElementById('name-err').classList.remove('show'); }
  if (!validateEmail(document.getElementById('field-email'))) ok=false;
  if (!ok) return;
  document.getElementById('avatar-display-email').textContent = email;
  const lbl = document.getElementById('account-saved-lbl');
  lbl.textContent = '✓ Saved ' + new Date().toLocaleTimeString();
  showToast('Account information updated!');
}

function resetAccount() {
  document.getElementById('field-name').value    = 'John Doe';
  document.getElementById('field-email').value   = 'john@example.com';
  document.getElementById('field-username').value= 'johndoe';
  updateAvatar();
  const wrap=document.getElementById('username-wrap'); wrap.style.borderColor=''; wrap.style.boxShadow='';
  document.getElementById('name-err').classList.remove('show');
  document.getElementById('email-err').classList.remove('show');
  document.getElementById('username-err').classList.remove('show');
  showToast('Changes discarded');
}

/* ── Password ── */
function togglePw(id) {
  const el = document.getElementById(id);
  el.type = el.type === 'password' ? 'text' : 'password';
}

function checkStrength(pw) {
  let s=0;
  if(pw.length>=8)s++; if(/[A-Z]/.test(pw))s++; if(/[0-9]/.test(pw))s++; if(/[^A-Za-z0-9]/.test(pw))s++;
  const cols=['','#EF4444','#F59E0B','#10B981','#10B981'];
  const lbls=['Enter a password','Too weak','Fair','Good','Strong ✓'];
  ['ps1','ps2','ps3','ps4'].forEach((id,i) => { document.getElementById(id).style.background = i<s ? cols[s] : 'var(--BD)'; });
  const l=document.getElementById('pw-lbl'); l.textContent=lbls[s]||lbls[0]; l.style.color=cols[s]||'var(--MU2)';
}

function checkMatch() {
  const nw=document.getElementById('pw-new').value, cf=document.getElementById('pw-confirm');
  const ok=cf.value===nw;
  cf.classList.toggle('err',cf.value&&!ok);
  document.getElementById('pw-confirm-err').classList.toggle('show',cf.value&&!ok);
  if(ok&&cf.value) cf.classList.add('ok'); else cf.classList.remove('ok');
}

function changePassword() {
  const cur=document.getElementById('pw-current').value;
  const nw =document.getElementById('pw-new').value;
  const cf =document.getElementById('pw-confirm').value;
  let ok=true;
  if(!cur) { document.getElementById('pw-current').classList.add('err'); document.getElementById('pw-current-err').classList.add('show'); ok=false; }
  else { document.getElementById('pw-current').classList.remove('err'); document.getElementById('pw-current-err').classList.remove('show'); }
  if(nw.length<8) { document.getElementById('pw-new').classList.add('err'); document.getElementById('pw-new-err').classList.add('show'); ok=false; }
  else { document.getElementById('pw-new').classList.remove('err'); document.getElementById('pw-new-err').classList.remove('show'); }
  if(nw!==cf) { document.getElementById('pw-confirm').classList.add('err'); document.getElementById('pw-confirm-err').classList.add('show'); ok=false; }
  if(!ok) return;
  ['pw-current','pw-new','pw-confirm'].forEach(id => { document.getElementById(id).value=''; document.getElementById(id).classList.remove('err','ok'); });
  checkStrength('');
  document.getElementById('pw-saved-lbl').textContent='✓ Password changed '+new Date().toLocaleTimeString();
  showToast('Password changed successfully!');
}

/* ── Toggles ── */
function toggleSw(btn) {
  btn.classList.toggle('on');
}

function savePreferences() {
  document.getElementById('prefs-saved-lbl').textContent='✓ Saved '+new Date().toLocaleTimeString();
  showToast('Email preferences saved!');
}

/* ── Domain modal ── */
function openDomainModal() {
  const wrap = document.getElementById('domain-options');
  wrap.innerHTML = DOMAINS.map(d => `
    <div class="domain-option ${d===currentDomain?'selected':''}" onclick="selectDomainOpt(this,'${d}')">
      <div class="domain-badge" style="gap:6px;">
        <div class="domain-dot" style="${d===currentDomain?'':'background:var(--BD);animation:none;'}"></div>
        @${d}
      </div>
      <div class="domain-check">
        ${d===currentDomain?'<svg width="10" height="10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M5 13l4 4L19 7"/></svg>':''}
      </div>
    </div>
  `).join('');
  document.getElementById('domain-modal').classList.add('open');
}

let pendingDomain = null;
function selectDomainOpt(el, domain) {
  pendingDomain = domain;
  document.querySelectorAll('.domain-option').forEach(o => {
    const isThis = o === el;
    o.classList.toggle('selected', isThis);
    const dot = o.querySelector('.domain-dot');
    const chk = o.querySelector('.domain-check');
    if(dot) dot.style.cssText = isThis ? '' : 'background:var(--BD);animation:none;';
    if(chk) chk.innerHTML = isThis ? '<svg width="10" height="10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M5 13l4 4L19 7"/></svg>' : '';
  });
}

function saveDomain() {
  if (pendingDomain) {
    currentDomain = pendingDomain;
    document.getElementById('current-domain-display').textContent = '@' + currentDomain;
    showToast('Default domain set to @' + currentDomain);
  }
  closeDomainModal();
}

function closeDomainModal() { document.getElementById('domain-modal').classList.remove('open'); pendingDomain=null; }

/* ── Session modals ── */
function openLogoutModal()  { document.getElementById('logout-modal').classList.add('open'); }
function closeLogoutModal() { document.getElementById('logout-modal').classList.remove('open'); }
function confirmLogout() {
  closeLogoutModal();
  showToast('All other devices have been logged out.');
}

/* ── Delete account modal ── */
function openDeleteModal()  { document.getElementById('delete-modal').classList.add('open'); document.getElementById('delete-confirm-input').value=''; checkDeleteConfirm(document.getElementById('delete-confirm-input')); }
function closeDeleteModal() { document.getElementById('delete-modal').classList.remove('open'); }

function checkDeleteConfirm(inp) {
  const ok = inp.value.trim() === 'DELETE';
  const btn = document.getElementById('delete-confirm-btn');
  btn.disabled = !ok;
  btn.style.opacity = ok ? '1' : '.5';
  btn.style.cursor  = ok ? 'pointer' : 'not-allowed';
}

function confirmDelete() {
  closeDeleteModal();
  showToast('Account scheduled for deletion. You will receive a confirmation email.');
}

/* ── Toast ── */
function showToast(msg, type) {
  const t=document.getElementById('toast');
  const dot=t.querySelector('.toast-dot');
  dot.style.background = type==='err' ? 'var(--RED)' : 'var(--GREEN)';
  t.querySelector('span').textContent=msg;
  t.classList.add('show');
  setTimeout(()=>t.classList.remove('show'),2600);
}

/* ── Keyboard ── */
document.addEventListener('keydown', e => {
  if(e.key==='Escape') {
    closeDeleteModal(); closeDomainModal(); closeLogoutModal();
  }
});
</script>
@endpush
