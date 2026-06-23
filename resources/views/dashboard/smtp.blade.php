@extends('layouts.authLayout')

@section('title', 'InboxOro — SMTP Sandbox')

@push('styles')
<style>
/* ══════════════════════════════════════════
   SMTP SANDBOX PAGE
══════════════════════════════════════════ */

/* ── Stat grid ── */
.stat-grid-4{display:grid;grid-template-columns:repeat(2,1fr);gap:12px;margin-bottom:24px;}
@media(min-width:640px){.stat-grid-4{grid-template-columns:repeat(4,1fr);}}

.sc{background:var(--SURF);border:1px solid var(--BD);border-radius:12px;padding:16px 18px;position:relative;overflow:hidden;transition:box-shadow .2s,transform .15s;}
.sc:hover{box-shadow:0 4px 16px rgba(0,0,0,.07);transform:translateY(-1px);}
.sc::before{content:'';position:absolute;top:0;left:0;right:0;height:3px;border-radius:12px 12px 0 0;}
.sc.y::before{background:var(--Y);}
.sc.g::before{background:var(--GREEN);}
.sc.b::before{background:var(--B);}
.sc.p::before{background:#7C3AED;}

.sc-top{display:flex;align-items:flex-start;justify-content:space-between;margin-bottom:10px;}
.sc-icon{width:36px;height:36px;border-radius:9px;display:flex;align-items:center;justify-content:center;}
.sc-icon.y{background:rgba(250,204,21,.15);color:#92400E;}
.sc-icon.g{background:rgba(16,185,129,.12);color:var(--GREEN);}
.sc-icon.b{background:rgba(59,130,246,.12);color:var(--B);}
.sc-icon.p{background:rgba(124,58,237,.1);color:#7C3AED;}
.sc-live{display:inline-flex;align-items:center;gap:5px;font-family:var(--MONO);font-size:.56rem;font-weight:700;color:var(--GREEN);}
.sc-live-dot{width:5px;height:5px;background:var(--GREEN);border-radius:50%;animation:pulse-dot 2s ease-in-out infinite;}
@keyframes pulse-dot{0%,100%{box-shadow:0 0 0 0 rgba(16,185,129,.5)}50%{box-shadow:0 0 0 4px rgba(16,185,129,0)}}
.sc-val{font-family:var(--DISP);font-size:1.9rem;color:var(--INK);line-height:1;}
.sc-lbl{font-size:.74rem;color:var(--MU);font-weight:500;margin-top:3px;}
.sc-sub{font-size:.68rem;color:var(--MU2);margin-top:4px;}

/* ── Panel ── */
.panel{background:var(--SURF);border:1px solid var(--BD);border-radius:12px;overflow:hidden;margin-bottom:20px;}
.panel-hd{display:flex;align-items:center;justify-content:space-between;padding:14px 18px;border-bottom:1px solid var(--BD2);gap:10px;flex-wrap:wrap;}
.panel-title{font-weight:700;font-size:.9rem;color:var(--INK);}
.panel-meta{font-family:var(--MONO);font-size:.62rem;color:var(--MU);}
.panel-body{padding:18px 20px;}

/* ── SMTP Credentials card ── */
.cred-grid{display:grid;grid-template-columns:1fr;gap:12px;}
@media(min-width:600px){.cred-grid{grid-template-columns:1fr 1fr;}}

.cred-row{display:flex;flex-direction:column;gap:5px;}
.cred-lbl{font-family:var(--MONO);font-size:.6rem;font-weight:700;letter-spacing:.08em;text-transform:uppercase;color:var(--MU2);}
.cred-val-wrap{display:flex;align-items:center;gap:6px;background:var(--BG);border:1px solid var(--BD);border-radius:8px;padding:9px 12px;}
.cred-val{font-family:var(--MONO);font-size:.82rem;font-weight:600;color:var(--INK);flex:1;min-width:0;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;}
.cred-copy{width:28px;height:28px;border-radius:6px;border:1px solid var(--BD);background:var(--SURF);color:var(--MU);display:flex;align-items:center;justify-content:center;cursor:pointer;flex-shrink:0;transition:background .12s,color .12s,border-color .12s;}
.cred-copy:hover{background:rgba(250,204,21,.1);color:var(--INK);border-color:rgba(250,204,21,.3);}
.cred-copy.ok{background:rgba(16,185,129,.1);color:var(--GREEN);border-color:rgba(16,185,129,.3);}

.cred-badge{display:inline-flex;align-items:center;gap:4px;font-family:var(--MONO);font-size:.6rem;font-weight:700;padding:2px 8px;border-radius:5px;}
.cred-badge.tls{background:rgba(59,130,246,.1);color:var(--B);}
.cred-badge.free{background:rgba(250,204,21,.12);color:#92400E;}

.cred-actions{display:flex;gap:8px;flex-wrap:wrap;padding-top:14px;border-top:1px solid var(--BD2);margin-top:6px;}

/* ── Code block ── */
.code-block{background:var(--INK);border-radius:10px;overflow:hidden;}
.code-hd{display:flex;align-items:center;justify-content:space-between;padding:10px 16px;border-bottom:1px solid rgba(255,255,255,.07);}
.code-lang{font-family:var(--MONO);font-size:.6rem;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:rgba(255,255,255,.35);}
.code-copy-btn{display:inline-flex;align-items:center;gap:5px;font-family:var(--MONO);font-size:.62rem;font-weight:700;padding:4px 10px;border-radius:6px;background:rgba(255,255,255,.07);color:rgba(255,255,255,.6);border:1px solid rgba(255,255,255,.1);cursor:pointer;transition:background .12s,color .12s;}
.code-copy-btn:hover{background:rgba(255,255,255,.14);color:#fff;}
.code-copy-btn.ok{color:var(--GREEN);border-color:rgba(16,185,129,.3);}
.code-body{padding:16px 18px;font-family:var(--MONO);font-size:.78rem;line-height:2;color:#9CA3AF;overflow-x:auto;}
.code-key{color:var(--Y);}
.code-eq{color:rgba(255,255,255,.25);}
.code-val{color:#86EFAC;}
.code-val.str{color:#FCA5A5;}

/* ── Captured emails table ── */
.smtp-table{width:100%;border-collapse:collapse;}
.smtp-table thead tr{border-bottom:1px solid var(--BD2);}
.smtp-table thead th{padding:10px 16px;text-align:left;font-family:var(--MONO);font-size:.58rem;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--MU2);white-space:nowrap;}
.smtp-table tbody tr{border-bottom:1px solid var(--BD2);transition:background .1s;}
.smtp-table tbody tr:last-child{border-bottom:none;}
.smtp-table tbody tr:hover{background:var(--BD2);}
.smtp-table tbody td{padding:12px 16px;vertical-align:middle;}

.email-from{font-family:var(--MONO);font-size:.74rem;font-weight:600;color:var(--INK);white-space:nowrap;overflow:hidden;text-overflow:ellipsis;max-width:180px;}
.email-to{font-family:var(--MONO);font-size:.72rem;color:var(--MU);white-space:nowrap;overflow:hidden;text-overflow:ellipsis;max-width:180px;}
.email-subject{font-size:.82rem;font-weight:500;color:var(--INK);white-space:nowrap;overflow:hidden;text-overflow:ellipsis;max-width:220px;}
.badge-captured{display:inline-flex;align-items:center;gap:4px;background:rgba(59,130,246,.1);color:var(--B);font-family:var(--MONO);font-size:.58rem;font-weight:700;padding:3px 9px;border-radius:20px;}
.badge-captured .bdot{width:5px;height:5px;border-radius:50%;background:currentColor;}
.time-cell{font-size:.76rem;color:var(--MU);white-space:nowrap;}

.row-acts{display:flex;gap:4px;justify-content:flex-end;}
.act-btn{width:30px;height:30px;display:flex;align-items:center;justify-content:center;border-radius:7px;border:1px solid var(--BD);background:var(--SURF);color:var(--MU);cursor:pointer;transition:background .12s,color .12s,border-color .12s;}
.act-btn.view:hover{background:rgba(59,130,246,.08);color:var(--B);border-color:rgba(59,130,246,.3);}
.act-btn.del:hover{background:rgba(239,68,68,.08);color:var(--RED);border-color:rgba(239,68,68,.3);}

.col-to,.col-time{display:none;}
@media(min-width:640px){.col-to{display:table-cell;}}
@media(min-width:860px){.col-time{display:table-cell;}}

/* empty state */
.empty-state{display:none;flex-direction:column;align-items:center;justify-content:center;padding:52px 20px;gap:12px;text-align:center;}
.empty-state.show{display:flex;}
.empty-icon{width:54px;height:54px;background:var(--BD2);border-radius:14px;display:flex;align-items:center;justify-content:center;color:var(--MU2);}
.empty-title{font-family:var(--DISP);font-size:1.2rem;letter-spacing:.03em;color:var(--INK);}
.empty-sub{font-size:.8rem;color:var(--MU);max-width:280px;line-height:1.6;}

/* ── Test email form ── */
.test-grid{display:grid;grid-template-columns:1fr;gap:12px;}
.field{display:flex;flex-direction:column;gap:5px;}
.field label{font-family:var(--MONO);font-size:.6rem;font-weight:700;letter-spacing:.08em;text-transform:uppercase;color:var(--MU);}
.field input,.field textarea{padding:10px 14px;border:1px solid var(--BD);border-radius:8px;font-family:var(--BODY);font-size:15px;color:var(--INK);background:var(--SURF);outline:none;transition:border-color .15s,box-shadow .15s;}
.field input:focus,.field textarea:focus{border-color:var(--Y);box-shadow:0 0 0 3px rgba(250,204,21,.15);}
.field textarea{resize:vertical;min-height:80px;}
.field-err{font-size:.72rem;color:var(--RED);font-weight:500;display:none;}
.field-err.show{display:block;}

/* ── Bottom 2-col ── */
.bot-grid{display:grid;grid-template-columns:1fr;gap:16px;margin-bottom:20px;}
@media(min-width:720px){.bot-grid{grid-template-columns:1fr 1fr;}}

/* ── Limits card ── */
.limits-card{background:var(--SURF);border:1px solid var(--BD);border-radius:12px;overflow:hidden;}
.limits-hd{padding:14px 18px;border-bottom:1px solid var(--BD2);display:flex;align-items:center;gap:8px;}
.limits-hd-icon{width:28px;height:28px;background:rgba(250,204,21,.12);border-radius:7px;display:flex;align-items:center;justify-content:center;color:var(--Y);}
.limits-hd-title{font-weight:700;font-size:.88rem;color:var(--INK);}
.limits-badge{margin-left:auto;font-family:var(--MONO);font-size:.56rem;font-weight:800;background:rgba(250,204,21,.12);color:#92400E;padding:2px 8px;border-radius:10px;}
.limits-body{padding:14px 18px;}
.limit-row{display:flex;align-items:center;gap:10px;padding:8px 0;border-bottom:1px solid var(--BD2);font-size:.8rem;}
.limit-row:last-child{border-bottom:none;}
.limit-ic{width:26px;height:26px;border-radius:7px;background:var(--BD2);display:flex;align-items:center;justify-content:center;color:var(--MU);flex-shrink:0;}
.limit-txt{flex:1;color:var(--INK);font-weight:500;}
.limit-val{font-family:var(--MONO);font-size:.72rem;font-weight:700;color:var(--INK);white-space:nowrap;}

/* ── Upgrade card ── */
.upgrade-card{background:var(--INK);border-radius:12px;overflow:hidden;position:relative;}
.upgrade-card::before{content:'';position:absolute;top:0;left:0;right:0;height:2px;background:linear-gradient(90deg,#7C3AED,var(--Y),#7C3AED);background-size:200% 100%;animation:shimmer 3s linear infinite;}
@keyframes shimmer{0%{background-position:200% 0}100%{background-position:-200% 0}}
.ug-blob{position:absolute;width:200px;height:200px;border-radius:50%;background:radial-gradient(circle,rgba(124,58,237,.18) 0,transparent 70%);top:-60px;right:-60px;pointer-events:none;}
.ug-hd{padding:16px 18px;border-bottom:1px solid rgba(255,255,255,.07);position:relative;z-index:1;}
.ug-eyebrow{display:inline-flex;align-items:center;gap:5px;font-family:var(--MONO);font-size:.56rem;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--Y);background:rgba(250,204,21,.1);border:1px solid rgba(250,204,21,.2);padding:3px 9px;border-radius:20px;margin-bottom:7px;}
.ug-eyebrow::before{content:'';width:5px;height:5px;background:var(--Y);border-radius:50%;animation:blink 1.2s step-end infinite;}
@keyframes blink{0%,100%{opacity:1}50%{opacity:0}}
.ug-title{font-family:var(--DISP);font-size:1.1rem;letter-spacing:.04em;color:#fff;line-height:1;}
.ug-title span{color:var(--Y);}
.ug-body{padding:14px 18px;position:relative;z-index:1;}
.ug-benefit{display:flex;align-items:flex-start;gap:8px;padding:5px 0;font-size:.78rem;color:rgba(255,255,255,.7);}
.ug-check{width:18px;height:18px;min-width:18px;background:rgba(16,185,129,.15);border-radius:50%;display:flex;align-items:center;justify-content:center;color:var(--GREEN);flex-shrink:0;}
.ug-footer{padding:14px 18px;border-top:1px solid rgba(255,255,255,.07);position:relative;z-index:1;}
.ug-cta{width:100%;padding:11px;border-radius:9px;background:linear-gradient(135deg,#7C3AED,#6D28D9);color:#fff;font-size:.84rem;font-weight:700;border:none;cursor:pointer;display:flex;align-items:center;justify-content:center;gap:7px;font-family:var(--BODY);transition:opacity .15s,transform .1s;}
.ug-cta:hover{opacity:.9;transform:translateY(-1px);}

/* ══════════════════════════════════
   MODALS
══════════════════════════════════ */
.modal-overlay{position:fixed;inset:0;z-index:500;background:rgba(0,0,0,.5);backdrop-filter:blur(3px);display:none;align-items:center;justify-content:center;padding:16px;}
.modal-overlay.open{display:flex;animation:fade-bg .18s ease both;}
@keyframes fade-bg{from{opacity:0}to{opacity:1}}

.modal-box{background:var(--SURF);border-radius:14px;border:1px solid var(--BD);width:100%;box-shadow:0 20px 60px rgba(0,0,0,.18);animation:modal-up .22s cubic-bezier(.34,1.56,.64,1) both;}
@keyframes modal-up{from{transform:translateY(10px) scale(.97);opacity:0}to{transform:none;opacity:1}}
.modal-box.sm{max-width:480px;}
.modal-box.lg{max-width:700px;}

.modal-hd{display:flex;align-items:center;justify-content:space-between;padding:16px 20px;border-bottom:1px solid var(--BD2);}
.modal-title{font-family:var(--DISP);font-size:1.1rem;letter-spacing:.04em;color:var(--INK);}
.modal-close{width:32px;height:32px;display:flex;align-items:center;justify-content:center;border-radius:8px;border:1px solid var(--BD);background:transparent;color:var(--MU);cursor:pointer;transition:background .12s,color .12s;}
.modal-close:hover{background:var(--BD2);color:var(--INK);}
.modal-body{padding:20px;}
.modal-ft{padding:14px 20px;border-top:1px solid var(--BD2);display:flex;gap:8px;justify-content:flex-end;flex-wrap:wrap;}

/* Email detail modal */
.detail-tabs{display:flex;gap:2px;padding:0 20px;border-bottom:1px solid var(--BD2);}
.dtab{font-family:var(--MONO);font-size:.62rem;font-weight:700;letter-spacing:.06em;text-transform:uppercase;padding:8px 12px;color:var(--MU);border-bottom:2px solid transparent;margin-bottom:-1px;cursor:pointer;background:none;border-top:none;border-left:none;border-right:none;transition:color .12s,border-color .12s;}
.dtab:hover{color:var(--INK);}
.dtab.active{color:var(--INK);border-bottom-color:var(--Y);}

.detail-pane{display:none;padding:16px 20px;}
.detail-pane.show{display:block;}

.detail-meta-row{display:flex;flex-direction:column;gap:8px;margin-bottom:14px;}
.dm-row{display:flex;gap:10px;align-items:baseline;font-size:.82rem;}
.dm-lbl{font-family:var(--MONO);font-size:.6rem;font-weight:700;letter-spacing:.08em;text-transform:uppercase;color:var(--MU2);min-width:70px;flex-shrink:0;}
.dm-val{color:var(--INK);font-weight:500;}

.html-preview{background:#fff;border:1px solid var(--BD);border-radius:8px;padding:16px;font-size:.84rem;line-height:1.7;color:#374151;max-height:300px;overflow-y:auto;}
.html-preview::-webkit-scrollbar{width:4px;}
.html-preview::-webkit-scrollbar-thumb{background:var(--BD);border-radius:2px;}

.plain-preview{background:var(--BG);border:1px solid var(--BD);border-radius:8px;padding:14px;font-family:var(--MONO);font-size:.76rem;line-height:1.8;color:var(--INK);max-height:240px;overflow-y:auto;white-space:pre-wrap;}

.headers-block{background:var(--INK);border-radius:8px;padding:14px 16px;font-family:var(--MONO);font-size:.72rem;line-height:1.9;max-height:240px;overflow-y:auto;}
.headers-block::-webkit-scrollbar{width:3px;}
.headers-block::-webkit-scrollbar-thumb{background:rgba(255,255,255,.15);border-radius:2px;}
.hdr-key{color:var(--Y);}
.hdr-val{color:#9CA3AF;}

/* Regen confirm */
.warn-box{display:flex;align-items:flex-start;gap:10px;background:#FEF9C3;border:1px solid #FCD34D;border-left:4px solid #F59E0B;border-radius:8px;padding:12px 14px;font-size:.78rem;color:#78350F;line-height:1.55;}
.warn-box svg{flex-shrink:0;color:#D97706;margin-top:1px;}

/* Test success */
.success-box{display:none;flex-direction:column;align-items:center;gap:10px;padding:20px;text-align:center;}
.success-box.show{display:flex;}
.sbox-icon{width:52px;height:52px;background:rgba(16,185,129,.1);border-radius:50%;display:flex;align-items:center;justify-content:center;color:var(--GREEN);}
.sbox-title{font-family:var(--DISP);font-size:1.1rem;letter-spacing:.03em;color:var(--INK);}
.sbox-sub{font-size:.8rem;color:var(--MU);}

/* ── Toast ── */
#toast{position:fixed;bottom:20px;right:16px;background:var(--INK);color:#fff;font-family:var(--MONO);font-size:.74rem;font-weight:600;padding:10px 16px;border-radius:8px;box-shadow:0 4px 20px rgba(0,0,0,.2);z-index:999;display:flex;align-items:center;gap:7px;transform:translateY(70px);opacity:0;transition:transform .3s cubic-bezier(.34,1.56,.64,1),opacity .25s;}
#toast.show{transform:translateY(0);opacity:1;}
.toast-dot{width:7px;height:7px;background:var(--GREEN);border-radius:50%;}
</style>
@endpush

@section('content')

<!-- ════════ EMAIL DETAIL MODAL ════════ -->
<div class="modal-overlay" id="detail-modal">
  <div class="modal-box lg">
    <div class="modal-hd">
      <div class="modal-title" id="dm-modal-title">Email Details</div>
      <button class="modal-close" onclick="closeDetailModal()">
        <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M6 18L18 6M6 6l12 12"/></svg>
      </button>
    </div>

    <!-- tab nav -->
    <div class="detail-tabs">
      <button class="dtab active" onclick="switchDetailTab(this,'preview')">HTML Preview</button>
      <button class="dtab" onclick="switchDetailTab(this,'text')">Plain Text</button>
      <button class="dtab" onclick="switchDetailTab(this,'headers')">Headers</button>
    </div>

    <!-- Meta always visible -->
    <div style="padding:14px 20px;border-bottom:1px solid var(--BD2);">
      <div class="detail-meta-row" id="dm-meta"></div>
    </div>

    <!-- Preview pane -->
    <div class="detail-pane show" id="pane-preview">
      <div class="html-preview" id="dm-html"></div>
    </div>
    <!-- Text pane -->
    <div class="detail-pane" id="pane-text">
      <pre class="plain-preview" id="dm-text"></pre>
    </div>
    <!-- Headers pane -->
    <div class="detail-pane" id="pane-headers">
      <div class="headers-block" id="dm-headers"></div>
    </div>

    <div class="modal-ft">
      <button class="btn-ghost" id="dm-copy-btn" onclick="copyDetailContent()">
        <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><rect x="9" y="9" width="13" height="13" rx="2"/><path stroke-linecap="round" d="M5 15H4a2 2 0 01-2-2V4a2 2 0 012-2h9a2 2 0 012 2v1"/></svg>
        Copy HTML
      </button>
      <button class="btn-primary yellow" onclick="closeDetailModal()">Close</button>
    </div>
  </div>
</div>

<!-- ════════ REGEN CREDENTIALS MODAL ════════ -->
<div class="modal-overlay" id="regen-modal">
  <div class="modal-box sm">
    <div class="modal-hd">
      <div class="modal-title">Regenerate Credentials</div>
      <button class="modal-close" onclick="closeRegenModal()">
        <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M6 18L18 6M6 6l12 12"/></svg>
      </button>
    </div>
    <div class="modal-body" style="display:flex;flex-direction:column;gap:14px;">
      <div style="text-align:center;">
        <div style="width:50px;height:50px;background:rgba(245,158,11,.1);border-radius:50%;display:flex;align-items:center;justify-content:center;color:#D97706;margin:0 auto 10px;">
          <svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
        </div>
        <div style="font-family:var(--DISP);font-size:1.1rem;letter-spacing:.03em;color:var(--INK);margin-bottom:4px;">Regenerate SMTP Credentials</div>
        <div style="font-size:.8rem;color:var(--MU);">New credentials will be generated. Your current credentials will stop working immediately.</div>
      </div>
      <div class="warn-box">
        <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
        Any app using the current SMTP credentials will need to be updated. This action cannot be undone.
      </div>
    </div>
    <div class="modal-ft">
      <button class="btn-ghost" onclick="closeRegenModal()">Cancel</button>
      <button class="btn-primary yellow" onclick="doRegen()">
        <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
        Yes, Regenerate
      </button>
    </div>
  </div>
</div>

<!-- ════════ GENERATE CREDENTIALS MODAL ════════ -->
<div class="modal-overlay" id="gen-cred-modal">
  <div class="modal-box sm">
    <div class="modal-hd">
      <div class="modal-title">Generate SMTP Credentials</div>
      <button class="modal-close" onclick="closeGenCredModal()">
        <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M6 18L18 6M6 6l12 12"/></svg>
      </button>
    </div>
    <div class="modal-body" style="display:flex;flex-direction:column;gap:14px;">
      <div style="text-align:center;">
        <div style="width:50px;height:50px;background:rgba(250,204,21,.12);border-radius:50%;display:flex;align-items:center;justify-content:center;color:#92400E;margin:0 auto 10px;">
          <svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2m-2-4h.01M17 16h.01"/></svg>
        </div>
        <div style="font-family:var(--DISP);font-size:1.1rem;letter-spacing:.03em;color:var(--INK);margin-bottom:4px;">New SMTP Sandbox</div>
        <div style="font-size:.8rem;color:var(--MU);">A set of SMTP credentials will be generated for your sandbox environment.</div>
      </div>
      <div class="field">
        <label>Sandbox Label <span style="color:var(--MU);font-weight:400;text-transform:none;letter-spacing:0;">(optional)</span></label>
        <input type="text" id="sandbox-label" placeholder="e.g. My Laravel App, Testing…" maxlength="40"/>
      </div>
    </div>
    <div class="modal-ft">
      <button class="btn-ghost" onclick="closeGenCredModal()">Cancel</button>
      <button class="btn-primary yellow" onclick="doGenCreds()">
        <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M12 4v16m8-8H4"/></svg>
        Generate Credentials
      </button>
    </div>
  </div>
</div>

<!-- ── Page header ── -->
<div class="page-hd">
  <div>
    <div class="page-title">SMTP Sandbox</div>
    <div class="page-subtitle">Test and debug emails safely without sending them to real users.</div>
  </div>
  <div style="display:flex;gap:8px;align-items:center;">
    <button class="btn-ghost" onclick="refreshPage()">
      <svg id="refresh-ic" width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
      Refresh
    </button>
    <button class="btn-primary yellow" onclick="openGenCredModal()">
      <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M12 4v16m8-8H4"/></svg>
      Generate SMTP Credentials
    </button>
  </div>
</div>

<!-- ── Stat cards ── -->
<div class="stat-grid-4">
  <div class="sc y">
    <div class="sc-top">
      <div class="sc-icon y"><svg width="17" height="17" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg></div>
    </div>
    <div class="sc-val" id="stat-captured">42</div>
    <div class="sc-lbl">Emails Captured Today</div>
    <div class="sc-sub">100 / day limit</div>
  </div>
  <div class="sc g">
    <div class="sc-top">
      <div class="sc-icon g"><svg width="17" height="17" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2m-2-4h.01M17 16h.01"/></svg></div>
      <div class="sc-live"><div class="sc-live-dot"></div>Live</div>
    </div>
    <div class="sc-val" id="stat-connections">12</div>
    <div class="sc-lbl">SMTP Connections</div>
    <div class="sc-sub">Today</div>
  </div>
  <div class="sc b">
    <div class="sc-top">
      <div class="sc-icon b"><svg width="17" height="17" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg></div>
    </div>
    <div class="sc-val">1</div>
    <div class="sc-lbl">Active Sandbox</div>
    <div class="sc-sub" style="color:var(--GREEN);">Running</div>
  </div>
  <div class="sc p">
    <div class="sc-top">
      <div class="sc-icon p"><svg width="17" height="17" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg></div>
    </div>
    <div class="sc-val" style="font-size:1.3rem;font-family:var(--BODY);font-weight:800;">Free</div>
    <div class="sc-lbl">Current Plan</div>
    <div class="sc-sub"><a href="#" style="color:#A78BFA;font-size:.68rem;font-weight:600;text-decoration:none;" onclick="scrollUpgrade()">Upgrade →</a></div>
  </div>
</div>

<!-- ── SMTP Credentials ── -->
<div class="panel">
  <div class="panel-hd">
    <div style="display:flex;align-items:center;gap:8px;">
      <div style="width:8px;height:8px;background:var(--GREEN);border-radius:50%;animation:pulse-dot 2s ease-in-out infinite;"></div>
      <span class="panel-title">SMTP Credentials</span>
    </div>
    <div style="display:flex;gap:6px;flex-wrap:wrap;">
      <span class="cred-badge tls">TLS Encrypted</span>
      <span class="cred-badge free">Free Plan</span>
    </div>
  </div>
  <div class="panel-body">
    <div class="cred-grid">
      <!-- Host -->
      <div class="cred-row">
        <div class="cred-lbl">SMTP Host</div>
        <div class="cred-val-wrap">
          <div class="cred-val">smtp.inboxoro.com</div>
          <button class="cred-copy" onclick="copyCredVal('smtp.inboxoro.com',this)" title="Copy">
            <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><rect x="9" y="9" width="13" height="13" rx="2"/><path stroke-linecap="round" d="M5 15H4a2 2 0 01-2-2V4a2 2 0 012-2h9a2 2 0 012 2v1"/></svg>
          </button>
        </div>
      </div>
      <!-- Port -->
      <div class="cred-row">
        <div class="cred-lbl">SMTP Port</div>
        <div class="cred-val-wrap">
          <div class="cred-val">587</div>
          <button class="cred-copy" onclick="copyCredVal('587',this)" title="Copy">
            <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><rect x="9" y="9" width="13" height="13" rx="2"/><path stroke-linecap="round" d="M5 15H4a2 2 0 01-2-2V4a2 2 0 012-2h9a2 2 0 012 2v1"/></svg>
          </button>
        </div>
      </div>
      <!-- Encryption -->
      <div class="cred-row">
        <div class="cred-lbl">Encryption</div>
        <div class="cred-val-wrap">
          <div class="cred-val" style="color:var(--B);">STARTTLS</div>
        </div>
      </div>
      <!-- Username -->
      <div class="cred-row">
        <div class="cred-lbl">Username</div>
        <div class="cred-val-wrap">
          <div class="cred-val" id="cred-username">sandbox_user</div>
          <button class="cred-copy" id="copy-user-btn" onclick="copyCredVal(document.getElementById('cred-username').textContent,this)" title="Copy">
            <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><rect x="9" y="9" width="13" height="13" rx="2"/><path stroke-linecap="round" d="M5 15H4a2 2 0 01-2-2V4a2 2 0 012-2h9a2 2 0 012 2v1"/></svg>
          </button>
        </div>
      </div>
      <!-- Password -->
      <div class="cred-row" style="grid-column:1/-1;">
        <div class="cred-lbl">Password</div>
        <div class="cred-val-wrap">
          <div class="cred-val" id="cred-password" data-real="smtp_pass_8f2k3j9x">••••••••••••••••</div>
          <button class="cred-copy" id="show-pw-btn" onclick="toggleShowPassword()" title="Show/hide">
            <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
          </button>
          <button class="cred-copy" onclick="copyCredVal(document.getElementById('cred-password').dataset.real,this)" title="Copy password">
            <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><rect x="9" y="9" width="13" height="13" rx="2"/><path stroke-linecap="round" d="M5 15H4a2 2 0 01-2-2V4a2 2 0 012-2h9a2 2 0 012 2v1"/></svg>
          </button>
        </div>
      </div>
    </div>
    <div class="cred-actions">
      <button class="btn-ghost" onclick="copyAllCreds()" style="font-size:.78rem;">
        <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><rect x="9" y="9" width="13" height="13" rx="2"/><path stroke-linecap="round" d="M5 15H4a2 2 0 01-2-2V4a2 2 0 012-2h9a2 2 0 012 2v1"/></svg>
        Copy All Credentials
      </button>
      <button class="btn-ghost" onclick="openRegenModal()" style="font-size:.78rem;">
        <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
        Regenerate Credentials
      </button>
    </div>
  </div>
</div>

<!-- ── Environment config ── -->
<div class="panel">
  <div class="panel-hd">
    <span class="panel-title">Environment Configuration</span>
    <div style="display:flex;gap:6px;">
      <button class="code-copy-btn" id="env-copy-btn" onclick="copyEnvConfig()">
        <svg width="11" height="11" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><rect x="9" y="9" width="13" height="13" rx="2"/><path stroke-linecap="round" d="M5 15H4a2 2 0 01-2-2V4a2 2 0 012-2h9a2 2 0 012 2v1"/></svg>
        Copy Config
      </button>
      <button class="code-copy-btn" onclick="downloadEnv()">
        <svg width="11" height="11" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
        Download .env
      </button>
    </div>
  </div>
  <div class="code-block" style="border-radius:0 0 12px 12px;">
    <div class="code-body" id="env-block">
<span class="code-key">MAIL_MAILER</span><span class="code-eq">=</span><span class="code-val">smtp</span>
<span class="code-key">MAIL_HOST</span><span class="code-eq">=</span><span class="code-val">smtp.inboxoro.com</span>
<span class="code-key">MAIL_PORT</span><span class="code-eq">=</span><span class="code-val">587</span>
<span class="code-key">MAIL_USERNAME</span><span class="code-eq">=</span><span class="code-val" id="env-user">sandbox_user</span>
<span class="code-key">MAIL_PASSWORD</span><span class="code-eq">=</span><span class="code-val str" id="env-pass">smtp_pass_8f2k3j9x</span>
<span class="code-key">MAIL_ENCRYPTION</span><span class="code-eq">=</span><span class="code-val">tls</span>
<span class="code-key">MAIL_FROM_ADDRESS</span><span class="code-eq">=</span><span class="code-val str">test@inboxoro.com</span>
<span class="code-key">MAIL_FROM_NAME</span><span class="code-eq">=</span><span class="code-val str">InboxOro</span>
    </div>
  </div>
</div>

<!-- ── Captured emails ── -->
<div class="panel">
  <div class="panel-hd">
    <span class="panel-title">Captured Emails</span>
    <div style="display:flex;align-items:center;gap:8px;">
      <span class="panel-meta" id="captured-count-lbl">6 emails · 7-day history</span>
      <button class="btn-ghost" onclick="clearAllEmails()" style="font-size:.74rem;padding:5px 10px;color:var(--RED);border-color:rgba(239,68,68,.3);">
        <svg width="11" height="11" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><polyline points="3 6 5 6 21 6"/><path stroke-linecap="round" d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6"/></svg>
        Clear All
      </button>
    </div>
  </div>
  <div style="overflow-x:auto;">
    <table class="smtp-table" id="smtp-table">
      <thead>
        <tr>
          <th>From</th>
          <th class="col-to">To</th>
          <th>Subject</th>
          <th>Status</th>
          <th class="col-time">Received</th>
          <th style="text-align:right;padding-right:18px;">Actions</th>
        </tr>
      </thead>
      <tbody id="smtp-tbody"></tbody>
    </table>
    <div class="empty-state" id="smtp-empty">
      <div class="empty-icon">
        <svg width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
      </div>
      <div class="empty-title">No Captured Emails</div>
      <div class="empty-sub">Point your SMTP settings to the sandbox. Emails will appear here as they arrive.</div>
    </div>
  </div>
</div>

<!-- ── Send Test Email ── -->
<div class="panel">
  <div class="panel-hd">
    <span class="panel-title">Send Test Email</span>
    <span class="panel-meta">Sends via the SMTP sandbox</span>
  </div>
  <div class="panel-body">
    <div id="test-form">
      <div class="test-grid">
        <div class="field">
          <label>To Email Address</label>
          <input type="email" id="test-to" placeholder="recipient@example.com"/>
          <div class="field-err" id="test-to-err">Please enter a valid email address.</div>
        </div>
        <div class="field">
          <label>Subject</label>
          <input type="text" id="test-subject" placeholder="Test email from InboxOro SMTP Sandbox" maxlength="100"/>
        </div>
        <div class="field" style="grid-column:1/-1;">
          <label>Message</label>
          <textarea id="test-message" rows="4" placeholder="Hello! This is a test email sent through the InboxOro SMTP Sandbox to verify that your mail configuration is working correctly."></textarea>
        </div>
      </div>
      <div style="display:flex;gap:8px;margin-top:14px;flex-wrap:wrap;">
        <button class="btn-primary yellow" onclick="sendTestEmail()">
          <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
          Send Test Email
        </button>
        <button class="btn-ghost" onclick="resetTestForm()">
          <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
          Reset
        </button>
      </div>
    </div>
    <div class="success-box" id="test-success">
      <div class="sbox-icon">
        <svg width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M5 13l4 4L19 7"/></svg>
      </div>
      <div class="sbox-title">Test Email Sent!</div>
      <div class="sbox-sub">Your email was captured by the sandbox. Check the table above to view it.</div>
      <button class="btn-primary yellow" style="margin-top:4px;" onclick="resetTestForm()">Send Another</button>
    </div>
  </div>
</div>

<!-- ── Bottom 2-col: Limits + Upgrade ── -->
<div class="bot-grid">

  <!-- Limits -->
  <div class="limits-card">
    <div class="limits-hd">
      <div class="limits-hd-icon"><svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg></div>
      <div class="limits-hd-title">Free Plan Limits</div>
      <div class="limits-badge">FREE</div>
    </div>
    <div class="limits-body">
      <div class="limit-row"><div class="limit-ic"><svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2m-2-4h.01M17 16h.01"/></svg></div><div class="limit-txt">SMTP Sandboxes</div><div class="limit-val">1</div></div>
      <div class="limit-row"><div class="limit-ic"><svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8"/></svg></div><div class="limit-txt">Captured Emails / Day</div><div class="limit-val">100</div></div>
      <div class="limit-row"><div class="limit-ic"><svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path stroke-linecap="round" d="M12 8v4l3 3"/></svg></div><div class="limit-txt">Email History</div><div class="limit-val">7 Days</div></div>
      <div class="limit-row"><div class="limit-ic"><svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg></div><div class="limit-txt">Support</div><div class="limit-val">Community</div></div>
      <div class="limit-row"><div class="limit-ic"><svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg></div><div class="limit-txt">Webhooks</div><div class="limit-val" style="color:var(--MU2);">—</div></div>
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
      <div class="ug-benefit"><div class="ug-check"><svg width="10" height="10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M5 13l4 4L19 7"/></svg></div>Unlimited SMTP Sandboxes</div>
      <div class="ug-benefit"><div class="ug-check"><svg width="10" height="10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M5 13l4 4L19 7"/></svg></div>Higher email capture limits</div>
      <div class="ug-benefit"><div class="ug-check"><svg width="10" height="10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M5 13l4 4L19 7"/></svg></div>Webhooks &amp; event push</div>
      <div class="ug-benefit"><div class="ug-check"><svg width="10" height="10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M5 13l4 4L19 7"/></svg></div>Team access &amp; sharing</div>
      <div class="ug-benefit"><div class="ug-check"><svg width="10" height="10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M5 13l4 4L19 7"/></svg></div>30-day email history</div>
      <div class="ug-benefit"><div class="ug-check"><svg width="10" height="10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M5 13l4 4L19 7"/></svg></div>Priority support</div>
    </div>
    <div class="ug-footer">
      <button class="ug-cta"><svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>Upgrade to Pro</button>
      <div style="text-align:center;margin-top:8px;font-size:.68rem;color:rgba(255,255,255,.3);font-family:var(--MONO);">from $4/month · cancel anytime</div>
    </div>
  </div>

</div>

@endsection

@push('scripts')
<script>

/* ════════════════════════════════════════
   SMTP SANDBOX PAGE LOGIC
════════════════════════════════════════ */

/* ── Seed data ── */
let EMAILS = [
  { id:1, from:'noreply@example.com', to:'sandbox@inboxoro.com', subject:'Verify Your Account', time:'2 min ago', mins:2,
     html:'<div style="font-family:Arial,sans-serif;padding:20px;"><h2 style="color:#111827;">Verify Your Account</h2><p>Hi there,</p><p>Click the button below to verify your email address and activate your account.</p><div style="text-align:center;margin:24px 0;"><a href="#" style="background:#FACC15;color:#111827;padding:12px 28px;border-radius:6px;font-weight:700;text-decoration:none;display:inline-block;">Verify Email</a></div><p style="color:#6B7280;font-size:12px;">If you didn\'t create an account, you can safely ignore this email.</p></div>',
     text:'Verify Your Account\\n\\nHi there,\\n\\nClick the link below to verify your email:\\nhttps://example.com/verify?token=abc123\\n\\nIf you did not create an account, ignore this email.',
     headers:{'Message-ID':'<abc123@example.com>','Date':'Mon, 22 Jun 2026 10:12:00 +0000','MIME-Version':'1.0','Content-Type':'text/html; charset=UTF-8','X-Mailer':'Laravel 11'},
  },
  { id:2, from:'billing@shopify.com', to:'sandbox@inboxoro.com', subject:'Your invoice is ready - #INV-20260622', time:'15 min ago', mins:15,
     html:'<div style="font-family:Arial,sans-serif;padding:20px;"><h2 style="color:#111827;">Invoice Ready</h2><p>Your invoice #INV-20260622 for $29.00 is ready.</p><table style="width:100%;border-collapse:collapse;margin:16px 0;"><tr style="background:#f3f4f6;"><th style="padding:8px;text-align:left;">Description</th><th style="padding:8px;text-align:right;">Amount</th></tr><tr><td style="padding:8px;border-bottom:1px solid #e5e7eb;">Pro Plan - Monthly</td><td style="padding:8px;text-align:right;border-bottom:1px solid #e5e7eb;">$29.00</td></tr></table></div>',
     text:'Invoice #INV-20260622\\nAmount: $29.00\\nDue: June 30, 2026\\n\\nPay at: https://billing.shopify.com/invoice/20260622',
     headers:{'Message-ID':'<inv001@shopify.com>','Date':'Mon, 22 Jun 2026 09:59:00 +0000','Content-Type':'text/html; charset=UTF-8'},
  },
  { id:3, from:'no-reply@github.com', to:'sandbox@inboxoro.com', subject:'[GitHub] Your personal access token has expired', time:'1h ago', mins:60,
     html:'<div style="font-family:Arial,sans-serif;padding:20px;"><h2 style="color:#dc2626;">Token Expired</h2><p>Your personal access token <strong>ghp_xxxx</strong> expired on June 22, 2026.</p><p>To continue using GitHub from the command line or API, generate a new token.</p><a href="#" style="color:#2563EB;">Generate new token →</a></div>',
     text:'Your GitHub personal access token ghp_xxxx expired on June 22, 2026.\\n\\nGenerate a new one at: https://github.com/settings/tokens',
     headers:{'Message-ID':'<gh001@github.com>','Date':'Mon, 22 Jun 2026 09:10:00 +0000','X-GitHub-Request-Id':'ABC123'},
  },
  { id:4, from:'notifications@slack.com', to:'sandbox@inboxoro.com', subject:'You have a new message from John', time:'2h ago', mins:120,
     html:'<div style="font-family:Arial,sans-serif;padding:20px;"><h2>New message in Slack</h2><p><strong>John Doe</strong> sent you a message in <strong>#general</strong>:</p><blockquote style="border-left:4px solid #e5e7eb;padding:8px 16px;color:#6B7280;">Hey, the deploy is ready for review!</blockquote></div>',
     text:'New message from John Doe in #general:\\n"Hey, the deploy is ready for review!"\\n\\nView in Slack: https://app.slack.com/...',
     headers:{'Message-ID':'<slack001@slack.com>','Date':'Mon, 22 Jun 2026 08:10:00 +0000'},
  },
  { id:5, from:'support@notion.so', to:'sandbox@inboxoro.com', subject:'Welcome to Notion Team Plan!', time:'3h ago', mins:180,
     html:'<div style="font-family:Arial,sans-serif;padding:20px;"><h2>Welcome to Notion!</h2><p>Your team workspace is ready. Get started by inviting your teammates.</p></div>',
     text:'Welcome to Notion Team Plan!\\n\\nYour workspace is ready at: https://notion.so/your-workspace',
     headers:{'Message-ID':'<notion001@notion.so>','Date':'Mon, 22 Jun 2026 07:00:00 +0000'},
  },
  { id:6, from:'noreply@stripe.com', to:'sandbox@inboxoro.com', subject:'Payment received: $99.00', time:'5h ago', mins:300,
     html:'<div style="font-family:Arial,sans-serif;padding:20px;"><h2 style="color:#10B981;">Payment Received</h2><p>We received your payment of <strong>$99.00</strong>. Thank you!</p></div>',
     text:'Payment received: $99.00\\nTransaction ID: ch_3abc123\\n\\nView receipt: https://dashboard.stripe.com/payments/ch_3abc123',
     headers:{'Message-ID':'<stripe001@stripe.com>','Date':'Mon, 22 Jun 2026 05:00:00 +0000','X-Stripe-Version':'2022-11-15'},
  },
  { id:1, from:'noreply@example.com', to:'sandbox@inboxoro.com', subject:'Verify Your Account', time:'2 min ago', mins:2,
     html:'<div style="font-family:Arial,sans-serif;padding:20px;"><h2 style="color:#111827;">Verify Your Account</h2><p>Hi there,</p><p>Click the button below to verify your email address and activate your account.</p><div style="text-align:center;margin:24px 0;"><a href="#" style="background:#FACC15;color:#111827;padding:12px 28px;border-radius:6px;font-weight:700;text-decoration:none;display:inline-block;">Verify Email</a></div><p style="color:#6B7280;font-size:12px;">If you didn\'t create an account, you can safely ignore this email.</p></div>',
     text:'Verify Your Account\\n\\nHi there,\\n\\nClick the link below to verify your email:\\nhttps://example.com/verify?token=abc123\\n\\nIf you did not create an account, ignore this email.',
     headers:{'Message-ID':'<abc123@example.com>','Date':'Mon, 22 Jun 2026 10:12:00 +0000','MIME-Version':'1.0','Content-Type':'text/html; charset=UTF-8','X-Mailer':'Laravel 11'},
  },
  { id:1, from:'noreply@example.com', to:'sandbox@inboxoro.com', subject:'Verify Your Account', time:'2 min ago', mins:2,
     html:'<div style="font-family:Arial,sans-serif;padding:20px;"><h2 style="color:#111827;">Verify Your Account</h2><p>Hi there,</p><p>Click the button below to verify your email address and activate your account.</p><div style="text-align:center;margin:24px 0;"><a href="#" style="background:#FACC15;color:#111827;padding:12px 28px;border-radius:6px;font-weight:700;text-decoration:none;display:inline-block;">Verify Email</a></div><p style="color:#6B7280;font-size:12px;">If you didn\'t create an account, you can safely ignore this email.</p></div>',
     text:'Verify Your Account\\n\\nHi there,\\n\\nClick the link below to verify your email:\\nhttps://example.com/verify?token=abc123\\n\\nIf you did not create an account, ignore this email.',
     headers:{'Message-ID':'<abc123@example.com>','Date':'Mon, 22 Jun 2026 10:12:00 +0000','MIME-Version':'1.0','Content-Type':'text/html; charset=UTF-8','X-Mailer':'Laravel 11'},
  },
  { id:1, from:'noreply@example.com', to:'sandbox@inboxoro.com', subject:'Verify Your Account', time:'2 min ago', mins:2,
     html:'<div style="font-family:Arial,sans-serif;padding:20px;"><h2 style="color:#111827;">Verify Your Account</h2><p>Hi there,</p><p>Click the button below to verify your email address and activate your account.</p><div style="text-align:center;margin:24px 0;"><a href="#" style="background:#FACC15;color:#111827;padding:12px 28px;border-radius:6px;font-weight:700;text-decoration:none;display:inline-block;">Verify Email</a></div><p style="color:#6B7280;font-size:12px;">If you didn\'t create an account, you can safely ignore this email.</p></div>',
     text:'Verify Your Account\\n\\nHi there,\\n\\nClick the link below to verify your email:\\nhttps://example.com/verify?token=abc123\\n\\nIf you did not create an account, ignore this email.',
     headers:{'Message-ID':'<abc123@example.com>','Date':'Mon, 22 Jun 2026 10:12:00 +0000','MIME-Version':'1.0','Content-Type':'text/html; charset=UTF-8','X-Mailer':'Laravel 11'},
  },
  { id:1, from:'noreply@example.com', to:'sandbox@inboxoro.com', subject:'Verify Your Account', time:'2 min ago', mins:2,
     html:'<div style="font-family:Arial,sans-serif;padding:20px;"><h2 style="color:#111827;">Verify Your Account</h2><p>Hi there,</p><p>Click the button below to verify your email address and activate your account.</p><div style="text-align:center;margin:24px 0;"><a href="#" style="background:#FACC15;color:#111827;padding:12px 28px;border-radius:6px;font-weight:700;text-decoration:none;display:inline-block;">Verify Email</a></div><p style="color:#6B7280;font-size:12px;">If you didn\'t create an account, you can safely ignore this email.</p></div>',
     text:'Verify Your Account\\n\\nHi there,\\n\\nClick the link below to verify your email:\\nhttps://example.com/verify?token=abc123\\n\\nIf you did not create an account, ignore this email.',
     headers:{'Message-ID':'<abc123@example.com>','Date':'Mon, 22 Jun 2026 10:12:00 +0000','MIME-Version':'1.0','Content-Type':'text/html; charset=UTF-8','X-Mailer':'Laravel 11'},
  },
  { id:1, from:'noreply@example.com', to:'sandbox@inboxoro.com', subject:'Verify Your Account', time:'2 min ago', mins:2,
     html:'<div style="font-family:Arial,sans-serif;padding:20px;"><h2 style="color:#111827;">Verify Your Account</h2><p>Hi there,</p><p>Click the button below to verify your email address and activate your account.</p><div style="text-align:center;margin:24px 0;"><a href="#" style="background:#FACC15;color:#111827;padding:12px 28px;border-radius:6px;font-weight:700;text-decoration:none;display:inline-block;">Verify Email</a></div><p style="color:#6B7280;font-size:12px;">If you didn\'t create an account, you can safely ignore this email.</p></div>',
     text:'Verify Your Account\\n\\nHi there,\\n\\nClick the link below to verify your email:\\nhttps://example.com/verify?token=abc123\\n\\nIf you did not create an account, ignore this email.',
     headers:{'Message-ID':'<abc123@example.com>','Date':'Mon, 22 Jun 2026 10:12:00 +0000','MIME-Version':'1.0','Content-Type':'text/html; charset=UTF-8','X-Mailer':'Laravel 11'},
  },
  { id:1, from:'noreply@example.com', to:'sandbox@inboxoro.com', subject:'Verify Your Account', time:'2 min ago', mins:2,
     html:'<div style="font-family:Arial,sans-serif;padding:20px;"><h2 style="color:#111827;">Verify Your Account</h2><p>Hi there,</p><p>Click the button below to verify your email address and activate your account.</p><div style="text-align:center;margin:24px 0;"><a href="#" style="background:#FACC15;color:#111827;padding:12px 28px;border-radius:6px;font-weight:700;text-decoration:none;display:inline-block;">Verify Email</a></div><p style="color:#6B7280;font-size:12px;">If you didn\'t create an account, you can safely ignore this email.</p></div>',
     text:'Verify Your Account\\n\\nHi there,\\n\\nClick the link below to verify your email:\\nhttps://example.com/verify?token=abc123\\n\\nIf you did not create an account, ignore this email.',
     headers:{'Message-ID':'<abc123@example.com>','Date':'Mon, 22 Jun 2026 10:12:00 +0000','MIME-Version':'1.0','Content-Type':'text/html; charset=UTF-8','X-Mailer':'Laravel 11'},
  },
];
let nextEmailId = 7;
let activeDetailTab = 'preview';
let viewingEmail = null;
let pwShown = false;

/* ── Render captured emails table ── */
function renderTable() {
  const tbody = document.getElementById('smtp-tbody');
  const empty = document.getElementById('smtp-empty');
  const lbl   = document.getElementById('captured-count-lbl');
  lbl.textContent = EMAILS.length + ' email' + (EMAILS.length!==1?'s':'') + ' · 7-day history';

  if (!EMAILS.length) { tbody.innerHTML=''; empty.classList.add('show'); return; }
  empty.classList.remove('show');

  tbody.innerHTML = EMAILS.map(e => `
    <tr data-id="${e.id}">
      <td><div class="email-from">${e.from}</div></td>
      <td class="col-to"><div class="email-to">${e.to}</div></td>
      <td><div class="email-subject">${e.subject}</div></td>
      <td><span class="badge-captured"><span class="bdot"></span>Captured</span></td>
      <td class="col-time time-cell">${e.time}</td>
      <td>
        <div class="row-acts">
          <button class="act-btn view" title="View email" onclick="viewEmail(${e.id})">
            <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
          </button>
          <button class="act-btn del" title="Delete" onclick="deleteEmail(${e.id})">
            <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><polyline points="3 6 5 6 21 6"/><path stroke-linecap="round" d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6"/></svg>
          </button>
        </div>
      </td>
    </tr>
  `).join('');
}

/* ── View email detail ── */
function viewEmail(id) {
  viewingEmail = EMAILS.find(e => e.id === id);
  if (!viewingEmail) return;

  document.getElementById('dm-modal-title').textContent = viewingEmail.subject;

  // meta
  document.getElementById('dm-meta').innerHTML = `
    <div class="dm-row"><span class="dm-lbl">From</span><span class="dm-val">${viewingEmail.from}</span></div>
    <div class="dm-row"><span class="dm-lbl">To</span><span class="dm-val">${viewingEmail.to}</span></div>
    <div class="dm-row"><span class="dm-lbl">Subject</span><span class="dm-val">${viewingEmail.subject}</span></div>
    <div class="dm-row"><span class="dm-lbl">Received</span><span class="dm-val">${viewingEmail.time}</span></div>
  `;

  // html
  document.getElementById('dm-html').innerHTML = viewingEmail.html;

  // text
  document.getElementById('dm-text').textContent = viewingEmail.text;

  // headers
  const hdrHtml = Object.entries(viewingEmail.headers)
    .map(([k,v]) => `<div><span class="hdr-key">${k}:</span> <span class="hdr-val">${v}</span></div>`)
    .join('');
  document.getElementById('dm-headers').innerHTML = hdrHtml;

  // reset tab
  switchDetailTab(document.querySelector('.dtab'), 'preview');
  document.getElementById('detail-modal').classList.add('open');
}

function switchDetailTab(btn, tab) {
  document.querySelectorAll('.dtab').forEach(b => b.classList.remove('active'));
  btn.classList.add('active');
  document.querySelectorAll('.detail-pane').forEach(p => p.classList.remove('show'));
  document.getElementById('pane-' + tab).classList.add('show');
  activeDetailTab = tab;
  const copyBtn = document.getElementById('dm-copy-btn');
  copyBtn.innerHTML = `<svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><rect x="9" y="9" width="13" height="13" rx="2"/><path stroke-linecap="round" d="M5 15H4a2 2 0 01-2-2V4a2 2 0 012-2h9a2 2 0 012 2v1"/></svg> Copy ${tab==='headers'?'Headers':tab==='text'?'Text':'HTML'}`;
}

function copyDetailContent() {
  if (!viewingEmail) return;
  const content = activeDetailTab==='html' || activeDetailTab==='preview' ? viewingEmail.html
    : activeDetailTab==='text' ? viewingEmail.text
    : Object.entries(viewingEmail.headers).map(([k,v])=>k+': '+v).join('\\n');
  navigator.clipboard.writeText(content).catch(()=>{});
  showToast('Copied!');
}

function closeDetailModal() {
  document.getElementById('detail-modal').classList.remove('open');
  viewingEmail = null;
}

function deleteEmail(id) {
  const row = document.querySelector(`tr[data-id="${id}"]`);
  if (row) { row.style.opacity='0'; row.style.transform='translateX(8px)'; row.style.transition='all .2s'; }
  setTimeout(() => { EMAILS=EMAILS.filter(e=>e.id!==id); renderTable(); }, 200);
  showToast('Email deleted');
}

function clearAllEmails() {
  if (!confirm('Clear all captured emails?')) return;
  EMAILS = [];
  renderTable();
  showToast('All emails cleared');
}

/* ── Credentials ── */
function copyCredVal(val, btn) {
  navigator.clipboard.writeText(val).catch(()=>{});
  showToast('Copied: ' + val.substring(0,20) + (val.length>20?'…':''));
  btn.classList.add('ok');
  setTimeout(()=>btn.classList.remove('ok'), 1800);
}

function toggleShowPassword() {
  const el = document.getElementById('cred-password');
  pwShown = !pwShown;
  el.textContent = pwShown ? el.dataset.real : '••••••••••••••••';
}

function copyAllCreds() {
  const pw = document.getElementById('cred-password').dataset.real;
  const un = document.getElementById('cred-username').textContent;
  const txt = `Host: smtp.inboxoro.com\\nPort: 587\\nEncryption: TLS\\nUsername: ${un}\\nPassword: ${pw}`;
  navigator.clipboard.writeText(txt).catch(()=>{});
  showToast('All credentials copied!');
}

/* ── Regen ── */
function openRegenModal() { document.getElementById('regen-modal').classList.add('open'); }
function closeRegenModal() { document.getElementById('regen-modal').classList.remove('open'); }
function doRegen() {
  const chars='abcdefghijklmnopqrstuvwxyz0123456789';
  const rnd = n=>Array.from({length:n},()=>chars[Math.floor(Math.random()*chars.length)]).join('');
  const newUser = 'sandbox_'+rnd(8);
  const newPass = 'smtp_pass_'+rnd(8);
  document.getElementById('cred-username').textContent = newUser;
  document.getElementById('cred-password').textContent = '••••••••••••••••';
  document.getElementById('cred-password').dataset.real = newPass;
  document.getElementById('env-user').textContent = newUser;
  document.getElementById('env-pass').textContent = newPass;
  pwShown = false;
  closeRegenModal();
  showToast('SMTP credentials regenerated!');
}

/* ── Generate Credentials Modal ── */
function openGenCredModal() { document.getElementById('gen-cred-modal').classList.add('open'); }
function closeGenCredModal() { document.getElementById('gen-cred-modal').classList.remove('open'); }
function doGenCreds() {
  const lbl = document.getElementById('sandbox-label').value.trim() || 'Default Sandbox';
  closeGenCredModal();
  showToast('SMTP sandbox "'+lbl+'" is ready!');
}

/* ── Env config ── */
function copyEnvConfig() {
  const pw = document.getElementById('cred-password').dataset.real;
  const un = document.getElementById('cred-username').textContent;
  const txt = `MAIL_MAILER=smtp\\nMAIL_HOST=smtp.inboxoro.com\\nMAIL_PORT=587\\nMAIL_USERNAME=${un}\\nMAIL_PASSWORD=${pw}\\nMAIL_ENCRYPTION=tls\\nMAIL_FROM_ADDRESS=test@inboxoro.com\\nMAIL_FROM_NAME=InboxOro`;
  navigator.clipboard.writeText(txt).catch(()=>{});
  const btn = document.getElementById('env-copy-btn');
  btn.classList.add('ok'); btn.innerHTML='<svg width="11" height="11" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M5 13l4 4L19 7"/></svg> Copied!';
  setTimeout(()=>{ btn.classList.remove('ok'); btn.innerHTML='<svg width="11" height="11" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><rect x="9" y="9" width="13" height="13" rx="2"/><path stroke-linecap="round" d="M5 15H4a2 2 0 01-2-2V4a2 2 0 012-2h9a2 2 0 012 2v1"/></svg> Copy Config'; },2000);
  showToast('.env config copied!');
}

function downloadEnv() {
  const pw = document.getElementById('cred-password').dataset.real;
  const un = document.getElementById('cred-username').textContent;
  const txt = `MAIL_MAILER=smtp\\nMAIL_HOST=smtp.inboxoro.com\\nMAIL_PORT=587\\nMAIL_USERNAME=${un}\\nMAIL_PASSWORD=${pw}\\nMAIL_ENCRYPTION=tls\\nMAIL_FROM_ADDRESS=test@inboxoro.com\\nMAIL_FROM_NAME=InboxOro`;
  const blob = new Blob([txt],{type:'text/plain'});
  const url  = URL.createObjectURL(blob);
  const a    = document.createElement('a'); a.href=url; a.download='.env.smtp.example'; a.click();
  URL.revokeObjectURL(url);
  showToast('.env file downloaded!');
}

/* ── Send test email ── */
function sendTestEmail() {
  const to  = document.getElementById('test-to').value.trim();
  const sub = document.getElementById('test-subject').value.trim() || 'Test email from InboxOro SMTP Sandbox';
  const msg = document.getElementById('test-message').value.trim() || 'Hello! This is a test email.';

  if (!to || !/^[^\\s@]+@[^\\s@]+\\.[^\\s@]+$/.test(to)) {
    document.getElementById('test-to').classList.add('err');
    document.getElementById('test-to-err').classList.add('show');
    return;
  }
  document.getElementById('test-to').classList.remove('err');
  document.getElementById('test-to-err').classList.remove('show');

  // Add to captured emails
  EMAILS.unshift({
    id: nextEmailId++, from: 'test@inboxoro.com', to,
    subject: sub, time: 'Just now', mins: 0,
    html: `<div style="font-family:Arial,sans-serif;padding:20px;"><h2>${sub}</h2><p>${msg}</p><p style="color:#6B7280;font-size:12px;margin-top:20px;">Sent via InboxOro SMTP Sandbox</p></div>`,
    text: sub + '\\n\\n' + msg,
    headers: {'Message-ID':'<test'+nextEmailId+'@inboxoro.com>','Date':new Date().toUTCString(),'X-InboxOro-Sandbox':'true'},
  });
  renderTable();
  document.getElementById('stat-captured').textContent = EMAILS.length;

  // show success
  document.getElementById('test-form').style.display='none';
  document.getElementById('test-success').classList.add('show');
  showToast('Test email captured in sandbox!');
}

function resetTestForm() {
  document.getElementById('test-to').value='';
  document.getElementById('test-subject').value='';
  document.getElementById('test-message').value='';
  document.getElementById('test-to').classList.remove('err');
  document.getElementById('test-to-err').classList.remove('show');
  document.getElementById('test-form').style.display='';
  document.getElementById('test-success').classList.remove('show');
}

/* ── Refresh ── */
function refreshPage() {
  const ic=document.getElementById('refresh-ic');
  ic.style.transition='transform .5s'; ic.style.transform='rotate(360deg)';
  setTimeout(()=>{ic.style.transition='none';ic.style.transform='';},520);
  renderTable(); showToast('Refreshed!');
}

/* ── Scroll upgrade ── */
function scrollUpgrade() {
  document.getElementById('upgrade-section').scrollIntoView({behavior:'smooth',block:'center'});
}

/* ── Toast ── */
function showToast(msg) {
  const t=document.getElementById('toast');
  t.querySelector('span').textContent=msg;
  t.classList.add('show');
  setTimeout(()=>t.classList.remove('show'),2600);
}

/* ── Keyboard ── */
document.addEventListener('keydown',e=>{
  if(e.key==='Escape'){ closeDetailModal(); closeRegenModal(); closeGenCredModal(); }
});

/* ── Boot ── */
renderTable();
</script>
@endpush
