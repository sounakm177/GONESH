@extends('layouts.authLayout')

@section('title', 'InboxOro — Alias Details')

@push('styles')
<style>

/* ══════════════════════════════════════════════
   ALIAS DETAIL PAGE — Premium SaaS Design
   ══════════════════════════════════════════════ */

/* ── Back link ── */
.back-link {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  font-family: var(--MONO);
  font-size: .7rem;
  font-weight: 700;
  letter-spacing: .06em;
  text-transform: uppercase;
  color: var(--MU);
  padding: 6px 0;
  margin-bottom: 8px;
  transition: color .12s;
}
.back-link:hover { color: var(--INK); }

/* ── Alias header card ── */
.alias-header {
  background: var(--SURF);
  border: 1px solid var(--BD);
  border-radius: 12px;
  padding: 20px 24px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 16px;
  flex-wrap: wrap;
  margin-bottom: 20px;
  box-shadow: 0 1px 3px rgba(0,0,0,.04);
}
.alias-header-left {
  display: flex;
  align-items: center;
  gap: 14px;
  min-width: 0;
}
.alias-header-avatar {
  width: 44px; height: 44px;
  border-radius: 12px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-family: var(--DISP);
  font-size: 1.2rem;
  color: #fff;
  flex-shrink: 0;
}
.alias-header-info { min-width: 0; }
.alias-header-addr {
  font-family: var(--MONO);
  font-size: 1.05rem;
  font-weight: 700;
  color: var(--INK);
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}
.alias-header-label {
  font-size: .78rem;
  color: var(--MU);
  margin-top: 2px;
}
.alias-header-right {
  display: flex;
  align-items: center;
  gap: 8px;
  flex-wrap: wrap;
  flex-shrink: 0;
}

/* ── Status badge ── */
.status-badge {
  display: inline-flex;
  align-items: center;
  gap: 5px;
  font-family: var(--MONO);
  font-size: .65rem;
  font-weight: 700;
  letter-spacing: .04em;
  padding: 5px 12px;
  border-radius: 20px;
  white-space: nowrap;
}
.status-badge.active {
  background: rgba(16,185,129,.1);
  color: var(--GREEN);
}
.status-badge.paused {
  background: rgba(245,158,11,.1);
  color: #D97706;
}
.status-badge.disabled {
  background: rgba(239,68,68,.1);
  color: var(--RED);
}
.status-badge .sb-dot {
  width: 6px; height: 6px;
  border-radius: 50%;
}
.status-badge.active .sb-dot { background: var(--GREEN); }
.status-badge.paused .sb-dot { background: #D97706; }
.status-badge.disabled .sb-dot { background: var(--RED); }

/* ── Action buttons ── */
.act-btn {
  display: inline-flex;
  align-items: center;
  gap: 5px;
  font-size: .74rem;
  font-weight: 600;
  color: var(--INK);
  background: var(--SURF);
  border: 1px solid var(--BD);
  padding: 7px 14px;
  border-radius: 8px;
  cursor: pointer;
  transition: background .12s, color .12s, border-color .12s;
  white-space: nowrap;
}
.act-btn:hover { background: var(--BD2); }
.act-btn.primary { background: var(--Y); border-color: var(--Y); }
.act-btn.primary:hover { background: #EAB800; }
.act-btn.danger { color: var(--RED); }
.act-btn.danger:hover { background: rgba(239,68,68,.08); border-color: rgba(239,68,68,.3); }

/* ── Stats grid ── */
.stats-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
  gap: 14px;
  margin-bottom: 20px;
}
.stat-card {
  background: var(--SURF);
  border: 1px solid var(--BD);
  border-radius: 12px;
  padding: 18px 20px;
  display: flex;
  align-items: flex-start;
  gap: 14px;
  box-shadow: 0 1px 2px rgba(0,0,0,.03);
  transition: box-shadow .15s, transform .1s;
}
.stat-card:hover {
  box-shadow: 0 4px 12px rgba(0,0,0,.06);
  transform: translateY(-1px);
}
.stat-icon {
  width: 40px; height: 40px;
  border-radius: 10px;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-shrink: 0;
}
.stat-icon.blue   { background: rgba(59,130,246,.1); color: var(--B); }
.stat-icon.green  { background: rgba(16,185,129,.1); color: var(--GREEN); }
.stat-icon.red    { background: rgba(239,68,68,.1); color: var(--RED); }
.stat-icon.yellow { background: rgba(250,204,21,.15); color: #D97706; }
.stat-body { min-width: 0; }
.stat-num {
  font-family: var(--DISP);
  font-size: 1.6rem;
  line-height: 1;
  color: var(--INK);
  letter-spacing: .02em;
}
.stat-lbl {
  font-size: .72rem;
  color: var(--MU);
  margin-top: 3px;
}
.stat-sub {
  font-size: .64rem;
  color: var(--MU2);
  margin-top: 1px;
}

/* ── Section panel ── */
.panel {
  background: var(--SURF);
  border: 1px solid var(--BD);
  border-radius: 12px;
  margin-bottom: 20px;
  box-shadow: 0 1px 2px rgba(0,0,0,.03);
}
.panel-hd {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 16px 20px;
  border-bottom: 1px solid var(--BD);
  gap: 12px;
  flex-wrap: wrap;
}
.panel-title {
  font-size: .9rem;
  font-weight: 700;
  color: var(--INK);
  display: flex;
  align-items: center;
  gap: 8px;
}
.panel-badge {
  font-family: var(--MONO);
  font-size: .58rem;
  font-weight: 700;
  padding: 2px 8px;
  border-radius: 10px;
  background: var(--BD2);
  color: var(--MU);
}
.panel-body { padding: 0; }

/* ── Info rows ── */
.info-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
  gap: 0;
  padding: 0;
}
.info-row {
  padding: 14px 20px;
  border-bottom: 1px solid var(--BD2);
  display: flex;
  flex-direction: column;
  gap: 3px;
}
.info-row:nth-last-child(-n+2) { border-bottom: none; }
.info-label {
  font-family: var(--MONO);
  font-size: .58rem;
  font-weight: 700;
  letter-spacing: .08em;
  text-transform: uppercase;
  color: var(--MU2);
}
.info-value {
  font-size: .84rem;
  color: var(--INK);
  word-break: break-all;
}
.info-value.mono { font-family: var(--MONO); font-size: .78rem; }

/* ── Table styles ── */
.tbar {
  display: flex;
  align-items: center;
  gap: 10px;
  padding: 12px 20px;
  border-bottom: 1px solid var(--BD);
  flex-wrap: wrap;
}
.tbar-search {
  display: flex;
  align-items: center;
  gap: 8px;
  flex: 1;
  min-width: 160px;
  background: var(--BG);
  border: 1px solid var(--BD);
  border-radius: 8px;
  padding: 7px 12px;
}
.tbar-search input {
  border: none; outline: none;
  background: transparent;
  font-family: var(--BODY);
  font-size: .82rem;
  color: var(--INK);
  flex: 1;
  min-width: 0;
}
.tbar-search input::placeholder { color: var(--MU2); }
.tbar-select {
  font-family: var(--BODY);
  font-size: .78rem;
  color: var(--INK);
  background: var(--SURF);
  border: 1px solid var(--BD);
  border-radius: 8px;
  padding: 7px 28px 7px 10px;
  cursor: pointer;
  -webkit-appearance: none;
  appearance: none;
  background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='10' fill='none' viewBox='0 0 24 24' stroke='%236B7280' stroke-width='2.5'%3E%3Cpath stroke-linecap='round' d='M6 9l6 6 6-6'/%3E%3C/svg%3E");
  background-repeat: no-repeat;
  background-position: right 8px center;
  min-width: 120px;
}
.fw-table {
  width: 100%;
  border-collapse: collapse;
  font-size: .8rem;
}
.fw-table th {
  font-family: var(--MONO);
  font-size: .58rem;
  font-weight: 700;
  letter-spacing: .08em;
  text-transform: uppercase;
  color: var(--MU2);
  text-align: left;
  padding: 10px 16px;
  border-bottom: 1px solid var(--BD);
  white-space: nowrap;
}
.fw-table td {
  padding: 12px 16px;
  border-bottom: 1px solid var(--BD2);
  color: var(--INK);
  vertical-align: middle;
}
.fw-table tr:last-child td { border-bottom: none; }
.fw-table tr:hover td { background: #FFFBEB; }
.fw-table .fw-cell-sender {
  max-width: 180px;
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
}
.fw-table .fw-cell-subject {
  max-width: 220px;
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
}

/* Status badges in table */
.del-badge {
  display: inline-flex;
  align-items: center;
  gap: 4px;
  font-family: var(--MONO);
  font-size: .6rem;
  font-weight: 700;
  padding: 3px 9px;
  border-radius: 12px;
  white-space: nowrap;
}
.del-badge.delivered { background: rgba(16,185,129,.1); color: var(--GREEN); }
.del-badge.pending   { background: rgba(245,158,11,.1); color: #D97706; }
.del-badge.failed    { background: rgba(239,68,68,.1); color: var(--RED); }
.del-badge .db-dot {
  width: 5px; height: 5px; border-radius: 50%;
}
.del-badge.delivered .db-dot { background: var(--GREEN); }
.del-badge.pending .db-dot   { background: #D97706; }
.del-badge.failed .db-dot    { background: var(--RED); }

/* Table action links */
.tbl-act {
  font-family: var(--MONO);
  font-size: .6rem;
  font-weight: 700;
  letter-spacing: .04em;
  color: var(--B);
  background: none;
  border: none;
  cursor: pointer;
  padding: 4px 8px;
  border-radius: 6px;
  transition: background .12s;
}
.tbl-act:hover { background: rgba(59,130,246,.08); }
.tbl-act.retry { color: var(--GREEN); }
.tbl-act.retry:hover { background: rgba(16,185,129,.08); }

/* ── Pagination ── */
.pagination {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 4px;
  padding: 14px 20px;
  border-top: 1px solid var(--BD);
}
.page-btn {
  width: 32px; height: 32px;
  display: flex; align-items: center; justify-content: center;
  border-radius: 8px;
  font-family: var(--MONO);
  font-size: .72rem;
  font-weight: 600;
  color: var(--MU);
  background: var(--SURF);
  border: 1px solid var(--BD);
  cursor: pointer;
  transition: background .12s, color .12s, border-color .12s;
}
.page-btn:hover { background: var(--BD2); color: var(--INK); }
.page-btn.active { background: var(--INK); color: var(--Y); border-color: var(--INK); }
.page-btn:disabled { opacity: .4; cursor: default; }

/* ── Recent emails list ── */
.email-list-compact { padding: 0; }
.email-item {
  display: flex;
  align-items: center;
  gap: 12px;
  padding: 12px 20px;
  border-bottom: 1px solid var(--BD2);
  cursor: pointer;
  transition: background .1s;
}
.email-item:last-child { border-bottom: none; }
.email-item:hover { background: #FFFBEB; }
.email-item-avatar {
  width: 32px; height: 32px;
  border-radius: 50%;
  display: flex; align-items: center; justify-content: center;
  font-family: var(--DISP); font-size: .85rem; color: #fff;
  flex-shrink: 0;
}
.email-item-body { flex: 1; min-width: 0; }
.email-item-top {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 8px;
  margin-bottom: 2px;
}
.email-item-sender {
  font-size: .8rem;
  font-weight: 600;
  color: var(--INK);
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}
.email-item-time {
  font-family: var(--MONO);
  font-size: .6rem;
  color: var(--MU2);
  flex-shrink: 0;
}
.email-item-subject {
  font-size: .76rem;
  color: var(--INK);
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
  margin-bottom: 1px;
}
.email-item-preview {
  font-size: .7rem;
  color: var(--MU2);
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}
.email-item-meta {
  display: flex;
  align-items: center;
  gap: 8px;
  flex-shrink: 0;
}
.att-badge {
  display: inline-flex;
  align-items: center;
  gap: 3px;
  font-size: .58rem;
  color: var(--MU2);
}
.otp-badge-sm {
  font-family: var(--MONO);
  font-size: .5rem;
  font-weight: 800;
  letter-spacing: .04em;
  padding: 2px 6px;
  border-radius: 4px;
  background: var(--Y);
  color: var(--INK);
}

/* ── Settings card ── */
.settings-list { padding: 4px 0; }
.setting-row {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 14px 20px;
  border-bottom: 1px solid var(--BD2);
  gap: 16px;
}
.setting-row:last-child { border-bottom: none; }
.setting-info { flex: 1; min-width: 0; }
.setting-label {
  font-size: .84rem;
  font-weight: 600;
  color: var(--INK);
}
.setting-desc {
  font-size: .72rem;
  color: var(--MU);
  margin-top: 2px;
}
.setting-input {
  font-family: var(--MONO);
  font-size: .78rem;
  color: var(--INK);
  background: var(--BG);
  border: 1px solid var(--BD);
  border-radius: 8px;
  padding: 7px 12px;
  width: 240px;
  max-width: 100%;
}
.setting-save {
  font-family: var(--MONO);
  font-size: .6rem;
  font-weight: 700;
  letter-spacing: .06em;
  text-transform: uppercase;
  padding: 7px 16px;
  border-radius: 8px;
  background: var(--INK);
  color: #fff;
  border: none;
  cursor: pointer;
  transition: background .12s;
}
.setting-save:hover { background: #000; }

/* ── Toggle switch ── */
.toggle {
  position: relative;
  width: 40px;
  height: 22px;
  flex-shrink: 0;
  cursor: pointer;
}
.toggle input {
  opacity: 0;
  width: 0;
  height: 0;
}
.toggle-slider {
  position: absolute;
  inset: 0;
  background: var(--BD);
  border-radius: 11px;
  transition: background .2s;
}
.toggle-slider::after {
  content: '';
  position: absolute;
  width: 18px; height: 18px;
  background: #fff;
  border-radius: 50%;
  top: 2px; left: 2px;
  transition: transform .2s;
  box-shadow: 0 1px 3px rgba(0,0,0,.15);
}
.toggle input:checked + .toggle-slider { background: var(--GREEN); }
.toggle input:checked + .toggle-slider::after { transform: translateX(18px); }

/* ── Activity timeline ── */
.timeline { padding: 12px 20px; }
.timeline-item {
  display: flex;
  gap: 14px;
  position: relative;
  padding-bottom: 20px;
}
.timeline-item:last-child { padding-bottom: 0; }
.timeline-dot {
  width: 10px; height: 10px;
  border-radius: 50%;
  flex-shrink: 0;
  margin-top: 4px;
  position: relative;
  z-index: 1;
}
.timeline-item:not(:last-child) .timeline-dot::after {
  content: '';
  position: absolute;
  top: 14px; left: 4px;
  width: 2px; height: calc(100% + 16px);
  background: var(--BD2);
}
.timeline-dot.green  { background: var(--GREEN); }
.timeline-dot.yellow { background: #D97706; }
.timeline-dot.blue   { background: var(--B); }
.timeline-dot.red    { background: var(--RED); }
.timeline-dot.gray   { background: var(--MU2); }
.timeline-body { flex: 1; min-width: 0; }
.timeline-event {
  font-size: .82rem;
  font-weight: 600;
  color: var(--INK);
}
.timeline-desc {
  font-size: .74rem;
  color: var(--MU);
  margin-top: 2px;
}
.timeline-time {
  font-family: var(--MONO);
  font-size: .6rem;
  color: var(--MU2);
  margin-top: 4px;
}

/* ── Security section ── */
.security-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
  gap: 0;
  padding: 12px 20px;
}
.sec-item {
  padding: 12px;
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 6px;
  text-align: center;
}
.sec-badge {
  display: inline-flex;
  align-items: center;
  gap: 5px;
  font-family: var(--MONO);
  font-size: .6rem;
  font-weight: 700;
  letter-spacing: .04em;
  padding: 4px 12px;
  border-radius: 20px;
}
.sec-badge.pass { background: rgba(16,185,129,.1); color: var(--GREEN); }
.sec-badge.fail { background: rgba(239,68,68,.1); color: var(--RED); }
.sec-badge.warn { background: rgba(245,158,11,.1); color: #D97706; }
.sec-label {
  font-size: .72rem;
  color: var(--MU);
}
.sec-value {
  font-size: .78rem;
  font-weight: 600;
  color: var(--INK);
}

/* ── Empty state ── */
.empty-state {
  display: none;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  padding: 40px 20px;
  gap: 10px;
  text-align: center;
}
.empty-state.show { display: flex; }
.empty-icon {
  width: 48px; height: 48px;
  background: var(--BD2);
  border-radius: 12px;
  display: flex;
  align-items: center;
  justify-content: center;
  color: var(--MU2);
}
.empty-title { font-size: .88rem; font-weight: 600; color: var(--INK); }
.empty-sub { font-size: .76rem; color: var(--MU2); max-width: 280px; line-height: 1.5; }

/* ── Mobile responsive ── */
@media (max-width: 768px) {
  .alias-header { padding: 16px; }
  .alias-header-left { width: 100%; }
  .alias-header-right { width: 100%; justify-content: flex-start; }
  .stats-grid { grid-template-columns: 1fr 1fr; gap: 10px; }
  .stat-card { padding: 14px; }
  .stat-num { font-size: 1.3rem; }
  .info-grid { grid-template-columns: 1fr; }
  .info-row:nth-last-child(-n+2) { border-bottom: 1px solid var(--BD2); }
  .info-row:last-child { border-bottom: none; }
  .fw-table { font-size: .72rem; }
  .fw-table th, .fw-table td { padding: 8px 10px; }
  .tbar { padding: 10px 14px; }
  .tbar-search { min-width: 120px; }
  .panel-hd { padding: 12px 14px; }
  .security-grid { grid-template-columns: 1fr 1fr; }
  .setting-row { flex-wrap: wrap; }
  .setting-input { width: 100%; }
  .email-item { padding: 10px 14px; }
  .timeline { padding: 10px 14px; }
  .pagination { flex-wrap: wrap; }
}

@media (max-width: 480px) {
  .stats-grid { grid-template-columns: 1fr; }
  .security-grid { grid-template-columns: 1fr; }
  .alias-header-addr { font-size: .88rem; }
}

/* ── Modal extras ── */
.modal-bd { padding: 20px; }
.modal-close {
  background: none; border: none; font-size: 1.4rem;
  color: var(--MU); cursor: pointer; padding: 0 4px;
  line-height: 1;
}
.modal-close:hover { color: var(--INK); }

</style>
@endpush

@section('content')

<!-- ── Back link ── -->
<a href="{{ route('dashboard.address') }}" class="back-link">
  <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M15 19l-7-7 7-7"/></svg>
  Back to Aliases
</a>

<!-- ── Alias header ── -->
<div class="alias-header" id="alias-header">
  <div class="alias-header-left">
    <div class="alias-header-avatar" id="ah-avatar" style="background:#6366F1;">--</div>
    <div class="alias-header-info">
      <div class="alias-header-addr" id="ah-addr">Loading…</div>
      <div class="alias-header-label" id="ah-label"></div>
    </div>
  </div>
  <div class="alias-header-right">
    <span class="status-badge active" id="ah-status">
      <span class="sb-dot"></span>
      Active
    </span>
    <button class="act-btn" onclick="copyAliasAddr()">
      <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><rect x="9" y="9" width="13" height="13" rx="2"/><path stroke-linecap="round" d="M5 15H4a2 2 0 01-2-2V4a2 2 0 012-2h9a2 2 0 012 2v1"/></svg>
      Copy
    </button>
    <button class="act-btn" onclick="editAlias()">
      <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
      Edit
    </button>
    <button class="act-btn" id="ah-pause-btn" onclick="toggleAliasPause()">⏸ Pause</button>
    <button class="act-btn danger" onclick="deleteAlias()">
      <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><polyline points="3 6 5 6 21 6"/><path stroke-linecap="round" d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6m5 0V4a1 1 0 011-1h2a1 1 0 011 1v2"/></svg>
      Delete
    </button>
  </div>
</div>

<!-- ── Stats cards ── -->
<div class="stats-grid" id="stats-grid">
  <div class="stat-card">
    <div class="stat-icon blue">
      <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
    </div>
    <div class="stat-body">
      <div class="stat-num" id="stat-received">0</div>
      <div class="stat-lbl">Emails Received</div>
      <div class="stat-sub">All time</div>
    </div>
  </div>
  <div class="stat-card">
    <div class="stat-icon green">
      <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
    </div>
    <div class="stat-body">
      <div class="stat-num" id="stat-forwarded">0</div>
      <div class="stat-lbl">Forwarded Successfully</div>
      <div class="stat-sub">All time</div>
    </div>
  </div>
  <div class="stat-card">
    <div class="stat-icon red">
      <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
    </div>
    <div class="stat-body">
      <div class="stat-num" id="stat-failed">0</div>
      <div class="stat-lbl">Forward Failures</div>
      <div class="stat-sub">All time</div>
    </div>
  </div>
  <div class="stat-card">
    <div class="stat-icon yellow">
      <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
    </div>
    <div class="stat-body">
      <div class="stat-num" id="stat-blocked">0</div>
      <div class="stat-lbl">Blocked</div>
      <div class="stat-sub">Protected</div>
    </div>
  </div>
</div>

<!-- ── Alias Information ── -->
<div class="panel">
  <div class="panel-hd">
    <span class="panel-title">
      <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
      Alias Information
    </span>
  </div>
  <div class="info-grid" id="info-grid">
    <div class="info-row">
      <span class="info-label">Alias Address</span>
      <span class="info-value mono" id="info-address">—</span>
    </div>
    <div class="info-row">
      <span class="info-label">Forwarding To</span>
      <span class="info-value mono" id="info-forward">—</span>
    </div>
    <div class="info-row">
      <span class="info-label">Domain</span>
      <span class="info-value mono" id="info-domain">—</span>
    </div>
    <div class="info-row">
      <span class="info-label">Description</span>
      <span class="info-value" id="info-desc">—</span>
    </div>
    <div class="info-row">
      <span class="info-label">Created</span>
      <span class="info-value" id="info-created">—</span>
    </div>
    <div class="info-row">
      <span class="info-label">Last Activity</span>
      <span class="info-value" id="info-last">—</span>
    </div>
    <div class="info-row">
      <span class="info-label">Total Received</span>
      <span class="info-value" id="info-total-received">0</span>
    </div>
    <div class="info-row">
      <span class="info-label">Total Forwarded</span>
      <span class="info-value" id="info-total-forwarded">0</span>
    </div>
  </div>
</div>

<!-- ── Forwarding History ── -->
<div class="panel" id="fw-panel">
  <div class="panel-hd">
    <span class="panel-title">
      <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
      Forwarding History
    </span>
    <span class="panel-badge" id="fw-count">0 events</span>
  </div>

  <div class="tbar">
    <div class="tbar-search">
      <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><path stroke-linecap="round" d="M21 21l-4.35-4.35"/></svg>
      <input type="text" id="fw-search" placeholder="Search history…" oninput="filterFwHistory()"/>
    </div>
    <select class="tbar-select" id="fw-status-filter" onchange="filterFwHistory()">
      <option value="all">All Status</option>
      <option value="received">Received</option>
      <option value="forwarded">Forwarded</option>
      <option value="blocked">Blocked</option>
    </select>
  </div>

  <div style="overflow-x:auto;" id="fw-table-wrap">
    <table class="fw-table" id="fw-table">
      <thead>
        <tr>
          <th>Date &amp; Time</th>
          <th>Sender</th>
          <th>Subject</th>
          <th>Status</th>
          <th style="text-align:right;">Action</th>
        </tr>
      </thead>
      <tbody id="fw-tbody"></tbody>
    </table>
    <div class="empty-state" id="fw-empty">
      <div class="empty-icon">
        <svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/></svg>
      </div>
      <div class="empty-title">No forwarding history</div>
      <div class="empty-sub">No emails have been processed yet for this alias.</div>
    </div>
  </div>

  <div class="pagination" id="fw-pagination"></div>
</div>

<!-- ── Edit Alias Modal ── -->
<div class="modal-overlay" id="edit-modal" style="display:none;">
  <div class="modal-box" style="max-width:480px;">
    <div class="modal-hd">
      <span class="modal-title">Edit Alias</span>
      <button class="modal-close" onclick="closeEditModal()">&times;</button>
    </div>
    <div class="modal-bd" style="padding:20px;">
      <div style="margin-bottom:14px;">
        <label style="font-size:.72rem;font-weight:600;color:var(--MU);display:block;margin-bottom:4px;">Forward To</label>
        <input type="email" id="edit-forward" class="setting-input" style="width:100%;">
      </div>
      <div style="margin-bottom:14px;">
        <label style="font-size:.72rem;font-weight:600;color:var(--MU);display:block;margin-bottom:4px;">Description</label>
        <input type="text" id="edit-desc" class="setting-input" style="width:100%;">
      </div>
      <div style="display:flex;gap:8px;justify-content:flex-end;margin-top:20px;">
        <button class="act-btn" onclick="closeEditModal()">Cancel</button>
        <button class="act-btn primary" onclick="saveEditAlias()">Save Changes</button>
      </div>
    </div>
  </div>
</div>

<!-- ── Confirm Modal ── -->
<div class="modal-overlay" id="confirm-modal" style="display:none;">
  <div class="modal-box" style="max-width:400px;">
    <div class="modal-bd" style="padding:24px;text-align:center;">
      <div style="font-size:.9rem;font-weight:600;color:var(--INK);margin-bottom:8px;" id="confirm-title">Confirm</div>
      <div style="font-size:.8rem;color:var(--MU);margin-bottom:20px;" id="confirm-msg">Are you sure?</div>
      <div style="display:flex;gap:8px;justify-content:center;">
        <button class="act-btn" onclick="closeConfirm()">Cancel</button>
        <button class="act-btn danger" id="confirm-yes-btn" onclick="confirmYes()">Confirm</button>
      </div>
    </div>
  </div>
</div>

<!-- ── View Detail Log Modal ── -->
<div class="modal-overlay" id="vdl-modal" style="display:none;">
  <div class="modal-box" style="max-width:420px;">
    <div class="modal-hd">
      <span class="modal-title">Forwarding Detail</span>
      <button class="modal-close" onclick="closeVdlModal()">&times;</button>
    </div>
    <div class="modal-bd" style="padding:20px;">
      <div style="margin-bottom:16px;">
        <div style="font-size:.6rem;font-weight:700;text-transform:uppercase;letter-spacing:.08em;color:var(--MU2);margin-bottom:4px;">Sender</div>
        <div style="font-size:.84rem;color:var(--INK);word-break:break-all;" id="vdl-sender">—</div>
      </div>
      <div style="margin-bottom:16px;">
        <div style="font-size:.6rem;font-weight:700;text-transform:uppercase;letter-spacing:.08em;color:var(--MU2);margin-bottom:4px;">Subject</div>
        <div style="font-size:.84rem;color:var(--INK);word-break:break-all;" id="vdl-subject">—</div>
      </div>
      <div style="margin-bottom:16px;">
        <div style="font-size:.6rem;font-weight:700;text-transform:uppercase;letter-spacing:.08em;color:var(--MU2);margin-bottom:4px;">Status</div>
        <span class="del-badge delivered" id="vdl-status-badge"><span class="db-dot"></span>Forwarded</span>
      </div>
      <div style="margin-bottom:16px;">
        <div style="font-size:.6rem;font-weight:700;text-transform:uppercase;letter-spacing:.08em;color:var(--MU2);margin-bottom:4px;">Time (relative)</div>
        <div style="font-size:.84rem;color:var(--INK);" id="vdl-time">—</div>
      </div>
      <div style="margin-bottom:16px;">
        <div style="font-size:.6rem;font-weight:700;text-transform:uppercase;letter-spacing:.08em;color:var(--MU2);margin-bottom:4px;">Time (exact)</div>
        <div style="font-size:.78rem;font-family:var(--MONO);color:var(--MU);" id="vdl-time-raw">—</div>
      </div>
      <div style="display:flex;gap:8px;justify-content:flex-end;margin-top:20px;">
        <button class="act-btn" onclick="closeVdlModal()">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- ── Alias Settings ── -->
<div class="panel">
  <div class="panel-hd">
    <span class="panel-title">
      <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.066 2.573c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.573 1.066c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.066-2.573c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
      Alias Settings
    </span>
  </div>
  <div class="settings-list">
    <div class="setting-row">
      <div class="setting-info">
        <div class="setting-label">Forwarding Enabled</div>
        <div class="setting-desc">Toggle email forwarding on/off for this alias</div>
      </div>
      <label class="toggle">
        <input type="checkbox" id="setting-forward" onchange="saveSetting('forward')">
        <div class="toggle-slider"></div>
      </label>
    </div>
  </div>
</div>

<!-- ── Activity Timeline ── -->
<div class="panel">
  <div class="panel-hd">
    <span class="panel-title">
      <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
      Activity Timeline
    </span>
  </div>
  <div class="timeline" id="timeline"></div>
  <div class="empty-state" id="tl-empty">
    <div class="empty-icon">
      <svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
    </div>
    <div class="empty-title">No activity yet</div>
    <div class="empty-sub">Activity for this alias will appear here.</div>
  </div>
</div>

@endsection

@push('scripts')
<script>
var CSRF = '{{ csrf_token() }}';
var ALIAS_ID = {{ $id }};
var ALIAS_DATA = null;

/* ── Helpers ── */
function showToast(msg) {
  var el = document.getElementById('toast');
  if (!el) return;
  el.innerHTML = '<span class="toast-dot"></span>' + msg;
  el.classList.add('show');
  clearTimeout(el._t);
  el._t = setTimeout(function() { el.classList.remove('show'); }, 2800);
}

function api(path, opts) {
  opts = opts || {};
  return fetch('/aliases/' + path, {
    method: opts.method || 'GET',
    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': CSRF, 'Accept': 'application/json' },
    body: opts.body ? JSON.stringify(opts.body) : undefined,
  }).then(function(r) { return r.json(); });
}

/* ── Confirm modal ── */
var _confirmCb = null;
function showConfirm(msg, cb) {
  document.getElementById('confirm-msg').textContent = msg;
  document.getElementById('confirm-modal').style.display = 'flex';
  _confirmCb = cb;
}
function closeConfirm() {
  document.getElementById('confirm-modal').style.display = 'none';
  _confirmCb = null;
}
function confirmYes() {
  var cb = _confirmCb;
  closeConfirm();
  if (cb) cb();
}

/* ── Edit modal ── */
function editAlias() {
  if (!ALIAS_DATA) return;
  document.getElementById('edit-forward').value = ALIAS_DATA.forward_to || '';
  document.getElementById('edit-desc').value = ALIAS_DATA.description || '';
  document.getElementById('edit-modal').style.display = 'flex';
}
function closeEditModal() {
  document.getElementById('edit-modal').style.display = 'none';
}
function saveEditAlias() {
  var forward = document.getElementById('edit-forward').value;
  var desc = document.getElementById('edit-desc').value;
  api(ALIAS_ID, { method: 'PATCH', body: { forward_to: forward, description: desc } }).then(function(data) {
    if (data.success) {
      showToast('Alias updated');
      closeEditModal();
      loadAlias();
    } else {
      showToast('Error: ' + (data.error || 'Unknown error'));
    }
  });
}

/* ── Load alias data ── */
function loadAlias() {
  api(ALIAS_ID).then(function(data) {
    if (data.error) { showToast(data.error); return; }
    ALIAS_DATA = data.alias;
    renderAlias();
    document.title = 'InboxOro — ' + data.alias.email;
  });
}

function renderAlias() {
  var a = ALIAS_DATA;
  document.getElementById('ah-addr').textContent = a.email;
  document.getElementById('ah-label').textContent = a.description || a.email;
  document.getElementById('ah-avatar').textContent = a.avatar;
  document.getElementById('ah-avatar').style.background = a.color;

  var st = document.getElementById('ah-status');
  var isActive = a.is_enabled;
  st.className = 'status-badge ' + (isActive ? 'active' : 'disabled');
  st.innerHTML = '<span class="sb-dot"></span> ' + (isActive ? 'Active' : 'Disabled');

  document.getElementById('ah-pause-btn').textContent = isActive ? '⏸ Pause' : '▶ Resume';

  document.getElementById('stat-received').textContent = a.total_received;
  document.getElementById('stat-forwarded').textContent = a.total_forwarded;
  document.getElementById('stat-failed').textContent = 0;
  document.getElementById('stat-blocked').textContent = 0;

  document.getElementById('info-address').textContent = a.email;
  document.getElementById('info-forward').textContent = a.forward_to || '(none)';
  document.getElementById('info-domain').textContent = a.domain;
  document.getElementById('info-desc').textContent = a.description || '(none)';
  document.getElementById('info-created').textContent = a.created_at;
  document.getElementById('info-last').textContent = a.last_received_at || '—';
  document.getElementById('info-total-received').textContent = a.total_received;
  document.getElementById('info-total-forwarded').textContent = a.total_forwarded;

  document.getElementById('setting-forward').checked = a.is_enabled;
}

/* ── Header actions ── */
function copyAliasAddr() {
  if (!ALIAS_DATA) return;
  navigator.clipboard.writeText(ALIAS_DATA.email).catch(function(){});
  showToast('Alias address copied!');
}

function toggleAliasPause() {
  if (!ALIAS_DATA) return;
  var nextState = ALIAS_DATA.is_enabled ? 'pause' : 'activate';
  showConfirm('Are you sure you want to ' + nextState + ' this alias?', function() {
    api(ALIAS_ID + '/status', { method: 'PATCH' }).then(function(data) {
      if (data.success) {
        ALIAS_DATA.is_enabled = data.is_enabled;
        renderAlias();
        showToast(data.is_enabled ? 'Alias activated' : 'Alias paused');
      } else {
        showToast('Error: ' + (data.error || 'Unknown error'));
      }
    });
  });
}

function deleteAlias() {
  showConfirm('Delete this alias? This cannot be undone.', function() {
    api(ALIAS_ID, { method: 'DELETE' }).then(function(data) {
      if (data.success) {
        showToast('Alias deleted');
        setTimeout(function() { window.location = '/addresses'; }, 800);
      } else {
        showToast('Error: ' + (data.error || 'Unknown error'));
      }
    });
  });
}

/* ── Forwarding History (from logs) ── */
var FW_LOGS = [];
var FW_FILTERED = [];
var fwPage = 1;
var FW_PER_PAGE = 10;
var FW_STATUS_FILTER = 'all';
var FW_SEARCH = '';

function loadLogs() {
  api(ALIAS_ID + '/logs').then(function(data) {
    if (data.logs) {
      FW_LOGS = data.logs;
      FW_FILTERED = data.logs;
      renderFwTable();
    }
  });
}

function filterFwHistory() {
  FW_SEARCH = document.getElementById('fw-search').value.toLowerCase();
  FW_STATUS_FILTER = document.getElementById('fw-status-filter').value;

  FW_FILTERED = FW_LOGS.filter(function(e) {
    if (FW_SEARCH && !e.sender_email.toLowerCase().includes(FW_SEARCH)) return false;
    if (FW_STATUS_FILTER !== 'all' && e.status !== FW_STATUS_FILTER) return false;
    return true;
  });

  fwPage = 1;
  renderFwTable();
}

function renderFwTable() {
  var tbody = document.getElementById('fw-tbody');
  var empty = document.getElementById('fw-empty');
  var pag = document.getElementById('fw-pagination');
  var count = document.getElementById('fw-count');

  count.textContent = FW_FILTERED.length + ' events';

  if (!FW_FILTERED.length) {
    tbody.innerHTML = '';
    empty.classList.add('show');
    pag.innerHTML = '';
    return;
  }
  empty.classList.remove('show');

  var totalPages = Math.ceil(FW_FILTERED.length / FW_PER_PAGE);
  var start = (fwPage - 1) * FW_PER_PAGE;
  var pageItems = FW_FILTERED.slice(start, start + FW_PER_PAGE);

  tbody.innerHTML = pageItems.map(function(e) {
    var badgeClass = e.status === 'forwarded' ? 'delivered' : e.status === 'blocked' ? 'failed' : 'pending';
    var badgeLbl = e.status.charAt(0).toUpperCase() + e.status.slice(1);
    var canRetry = e.status === 'blocked';
    var viewBtn = '<button class="tbl-act" onclick="viewEmailLog(' + e.id + ')">View</button>';
    var retryBtn = canRetry ? '<button class="tbl-act retry" onclick="retryForward(' + e.id + ')">Retry</button>' : '';
    return '<tr>' +
      '<td style="white-space:nowrap;font-family:var(--MONO);font-size:.68rem;color:var(--MU);">' + (e.created_at || '—') + '</td>' +
      '<td><div class="fw-cell-sender">' + (e.sender_email || '—') + '</div></td>' +
      '<td><div class="fw-cell-subject">' + (e.subject || '—') + '</div></td>' +
      '<td><span class="del-badge ' + badgeClass + '"><span class="db-dot"></span>' + badgeLbl + '</span></td>' +
      '<td style="text-align:right;white-space:nowrap;">' + viewBtn + retryBtn + '</td>' +
    '</tr>';
  }).join('');

  var pagHtml = '<button class="page-btn" onclick="fwGoPage(' + (fwPage - 1) + ')" ' + (fwPage <= 1 ? 'disabled' : '') + '>‹</button>';
  for (var i = 1; i <= totalPages; i++) {
    pagHtml += '<button class="page-btn' + (i === fwPage ? ' active' : '') + '" onclick="fwGoPage(' + i + ')">' + i + '</button>';
  }
  pagHtml += '<button class="page-btn" onclick="fwGoPage(' + (fwPage + 1) + ')" ' + (fwPage >= totalPages ? 'disabled' : '') + '>›</button>';
  pag.innerHTML = pagHtml;
}

function fwGoPage(p) {
  var totalPages = Math.ceil(FW_FILTERED.length / FW_PER_PAGE);
  if (p < 1 || p > totalPages) return;
  fwPage = p;
  renderFwTable();
}

function viewEmailLog(id) {
  var log = FW_LOGS.find(function(l) { return l.id === id; });
  if (!log) { showToast('Log entry not found'); return; }
  document.getElementById('vdl-sender').textContent = log.sender_email || '—';
  document.getElementById('vdl-subject').textContent = log.subject || '—';
  var badge = document.getElementById('vdl-status-badge');
  var cls = log.status === 'forwarded' ? 'delivered' : log.status === 'blocked' ? 'failed' : 'pending';
  badge.className = 'del-badge ' + cls;
  badge.innerHTML = '<span class="db-dot"></span>' + log.status.charAt(0).toUpperCase() + log.status.slice(1);
  document.getElementById('vdl-time').textContent = log.created_at || '—';
  document.getElementById('vdl-time-raw').textContent = log.created_at_raw || '—';
  document.getElementById('vdl-modal').style.display = 'flex';
}

function closeVdlModal() {
  document.getElementById('vdl-modal').style.display = 'none';
}

function retryForward(id) {
  var log = FW_LOGS.find(function(l) { return l.id === id; });
  var sender = log ? log.sender_email : 'unknown';
  showConfirm('Retry forwarding from ' + sender + '?', function() {
    showToast('Retrying forward from ' + sender);
  });
}

/* ── Activity Timeline ── */
function renderTimeline() {
  var tl = document.getElementById('timeline');
  var empty = document.getElementById('tl-empty');
  if (!FW_LOGS.length) {
    tl.innerHTML = '';
    empty.classList.add('show');
    return;
  }
  empty.classList.remove('show');
  tl.innerHTML = FW_LOGS.slice(0, 20).map(function(e) {
    var dot = e.status === 'forwarded' ? 'green' : e.status === 'blocked' ? 'red' : 'yellow';
    return '<div class="timeline-item">' +
      '<div class="timeline-dot ' + dot + '"></div>' +
      '<div class="timeline-body">' +
        '<div class="timeline-event">' + e.status.charAt(0).toUpperCase() + e.status.slice(1) + '</div>' +
        '<div class="timeline-desc">From: ' + (e.sender_email || '—') + '</div>' +
        '<div class="timeline-desc" style="font-size:.68rem;color:var(--MU2);">' + (e.subject || '') + '</div>' +
        '<div class="timeline-time">' + (e.created_at || '') + '</div>' +
      '</div>' +
    '</div>';
  }).join('');
}

/* ── Settings ── */
function saveSetting(id) {
  if (id === 'forward') {
    api(ALIAS_ID + '/status', { method: 'PATCH' }).then(function(data) {
      if (data.success) {
        ALIAS_DATA.is_enabled = data.is_enabled;
        showToast(data.is_enabled ? 'Forwarding enabled' : 'Forwarding disabled');
      }
    });
  }
}

/* ── Init ── */
loadAlias();
loadLogs();
setTimeout(renderTimeline, 500);

</script>
@endpush
