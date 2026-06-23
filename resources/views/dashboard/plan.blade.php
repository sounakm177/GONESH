<html lang="en">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width,initial-scale=1"/>
<title>InboxOro — Plan Modal Snippet</title>
<style>
:root {{
  --Y:#FACC15;--B:#3B82F6;--INK:#111827;--INK2:#1F2937;
  --BG:#F9FAFB;--SURF:#FFFFFF;--BD:#E5E7EB;--BD2:#F3F4F6;
  --MU:#6B7280;--MU2:#9CA3AF;--GREEN:#10B981;--RED:#EF4444;
  --MONO:'JetBrains Mono',monospace;--DISP:'Bebas Neue',sans-serif;--BODY:'Outfit',sans-serif;
}}
*,*::before,*::after{{box-sizing:border-box;margin:0;padding:0;}}
body{{font-family:var(--BODY);background:var(--BG);color:var(--INK);min-height:100vh;display:flex;align-items:center;justify-content:center;gap:12px;flex-wrap:wrap;padding:24px;}}
.demo-btn{{display:inline-flex;align-items:center;gap:6px;padding:11px 20px;border-radius:9px;font-size:.88rem;font-weight:700;cursor:pointer;border:none;font-family:var(--BODY);}}
.demo-btn.y{{background:var(--Y);color:var(--INK);}}
.demo-btn.dark{{background:var(--INK);color:#fff;}}
.demo-btn.ghost{{background:var(--SURF);color:var(--INK);border:1px solid var(--BD);}}
@keyframes spin{{to{{transform:rotate(360deg)}}}}
</style>
<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Outfit:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500;700&display=swap" rel="stylesheet"/>
</head>
<body>

<button class="demo-btn y" onclick="openPlanModal()">
  <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
  Upgrade to Pro
</button>

<button class="demo-btn dark" onclick="openPlanModal()">
  <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>
  View Plans
</button>

<button class="demo-btn ghost" onclick="openPlanModal()">Compare Plans</button>


<div id="plan-modal-overlay" style="
  position:fixed;inset:0;z-index:1000;
  background:rgba(0,0,0,.55);backdrop-filter:blur(4px);
  display:none;align-items:center;justify-content:center;padding:16px;
" onclick="handlePlanOverlayClick(event)">

  <div id="plan-modal-box" style="
    background:var(--SURF);border-radius:16px;border:1px solid var(--BD);
    width:100%;max-width:560px;box-shadow:0 24px 64px rgba(0,0,0,.2);
    overflow:hidden;animation:plan-modal-in .25s cubic-bezier(.34,1.56,.64,1) both;
  ">

    <!-- ── Top dark header ── -->
    <div style="
      background:var(--INK);padding:24px 26px;position:relative;overflow:hidden;
    ">
      <!-- decorative blobs -->
      <div style="position:absolute;width:260px;height:260px;border-radius:50%;background:radial-gradient(circle,rgba(250,204,21,.12) 0,transparent 70%);top:-100px;right:-60px;pointer-events:none;"></div>
      <div style="position:absolute;width:180px;height:180px;border-radius:50%;background:radial-gradient(circle,rgba(124,58,237,.1) 0,transparent 70%);bottom:-70px;left:-40px;pointer-events:none;"></div>
      <!-- shimmer top line -->
      <div style="position:absolute;top:0;left:0;right:0;height:2px;background:linear-gradient(90deg,#7C3AED,var(--Y),#7C3AED);background-size:200% 100%;animation:plan-shimmer 3s linear infinite;"></div>

      <div style="display:flex;align-items:flex-start;justify-content:space-between;gap:12px;position:relative;z-index:1;">
        <div>
          <div style="display:inline-flex;align-items:center;gap:5px;font-family:var(--MONO);font-size:.58rem;font-weight:700;letter-spacing:.12em;text-transform:uppercase;color:var(--Y);background:rgba(250,204,21,.1);border:1px solid rgba(250,204,21,.2);padding:3px 10px;border-radius:20px;margin-bottom:10px;">
            <span style="width:5px;height:5px;background:var(--Y);border-radius:50%;animation:plan-blink 1.2s step-end infinite;display:inline-block;"></span>
            Upgrade Available
          </div>
          <div style="font-family:var(--DISP);font-size:clamp(1.6rem,5vw,2.1rem);letter-spacing:.04em;color:#fff;line-height:1;margin-bottom:6px;">
            INBOX<span style="color:var(--Y);">ORO</span> PRO
          </div>
          <div style="font-size:.82rem;color:rgba(255,255,255,.5);line-height:1.5;max-width:360px;">
            Unlock the full power of InboxOro — unlimited aliases, premium domains, advanced API access, and priority support.
          </div>
        </div>
        <button onclick="closePlanModal()" style="
          width:32px;height:32px;min-width:32px;display:flex;align-items:center;justify-content:center;
          border-radius:8px;border:1px solid rgba(255,255,255,.15);background:rgba(255,255,255,.07);
          color:rgba(255,255,255,.6);cursor:pointer;transition:background .12s,color .12s;flex-shrink:0;
        " onmouseover="this.style.background='rgba(255,255,255,.14)';this.style.color='#fff'"
           onmouseout="this.style.background='rgba(255,255,255,.07)';this.style.color='rgba(255,255,255,.6)'">
          <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>
      </div>

      <!-- pricing pills -->
      <div style="display:flex;gap:10px;margin-top:16px;flex-wrap:wrap;position:relative;z-index:1;">
        <div id="plan-pill-monthly" onclick="selectPlanPill('monthly')" style="
          display:flex;align-items:center;gap:8px;padding:10px 14px;border-radius:10px;cursor:pointer;
          border:1.5px solid rgba(250,204,21,.3);background:rgba(250,204,21,.1);transition:all .15s;flex:1;min-width:130px;
        ">
          <div>
            <div style="font-family:var(--DISP);font-size:1.4rem;color:var(--Y);line-height:1;">$4<span style="font-family:var(--BODY);font-size:.72rem;color:rgba(255,255,255,.45);font-weight:400;">/mo</span></div>
            <div style="font-size:.7rem;color:rgba(255,255,255,.5);margin-top:2px;">Monthly plan</div>
          </div>
          <div id="plan-check-monthly" style="margin-left:auto;width:20px;height:20px;border-radius:50%;background:var(--Y);display:flex;align-items:center;justify-content:center;">
            <svg width="10" height="10" fill="none" viewBox="0 0 24 24" stroke="var(--INK)" stroke-width="3"><path stroke-linecap="round" d="M5 13l4 4L19 7"/></svg>
          </div>
        </div>
        <div id="plan-pill-annual" onclick="selectPlanPill('annual')" style="
          display:flex;align-items:center;gap:8px;padding:10px 14px;border-radius:10px;cursor:pointer;
          border:1.5px solid rgba(255,255,255,.1);background:rgba(255,255,255,.05);transition:all .15s;flex:1;min-width:130px;
          position:relative;overflow:hidden;
        ">
          <div style="position:absolute;top:6px;right:6px;font-family:var(--MONO);font-size:.5rem;font-weight:800;background:var(--GREEN);color:#fff;padding:2px 6px;border-radius:4px;">SAVE 25%</div>
          <div>
            <div style="font-family:var(--DISP);font-size:1.4rem;color:#fff;line-height:1;">$36<span style="font-family:var(--BODY);font-size:.72rem;color:rgba(255,255,255,.45);font-weight:400;">/yr</span></div>
            <div style="font-size:.7rem;color:rgba(255,255,255,.5);margin-top:2px;">Annual · $3/mo</div>
          </div>
          <div id="plan-check-annual" style="margin-left:auto;width:20px;height:20px;border-radius:50%;border:2px solid rgba(255,255,255,.2);display:flex;align-items:center;justify-content:center;">
          </div>
        </div>
      </div>
    </div>

    <!-- ── Features grid ── -->
    <div style="padding:22px 26px;">
      <div style="font-family:var(--MONO);font-size:.6rem;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--MU2);margin-bottom:14px;">Everything in Pro</div>
      <div style="display:grid;grid-template-columns:1fr 1fr;gap:10px;" id="plan-features-grid">

        <!-- feature items injected by JS -->

      </div>

      <!-- Compare: Free vs Pro -->
      <div style="margin-top:18px;background:var(--BG);border:1px solid var(--BD);border-radius:10px;overflow:hidden;">
        <div style="display:grid;grid-template-columns:1fr 80px 80px;border-bottom:1px solid var(--BD);">
          <div style="padding:8px 14px;font-family:var(--MONO);font-size:.58rem;font-weight:700;letter-spacing:.08em;text-transform:uppercase;color:var(--MU2);">Feature</div>
          <div style="padding:8px 0;text-align:center;font-family:var(--MONO);font-size:.58rem;font-weight:700;color:var(--MU2);">Free</div>
          <div style="padding:8px 0;text-align:center;font-family:var(--MONO);font-size:.58rem;font-weight:700;color:var(--Y);">Pro</div>
        </div>
        <div id="plan-compare-rows"><!-- injected by JS --></div>
      </div>
    </div>

    <!-- ── Footer CTA ── -->
    <div style="padding:0 26px 24px;">
      <button onclick="handleUpgrade()" id="plan-cta-btn" style="
        width:100%;padding:13px;border-radius:10px;
        background:linear-gradient(135deg,var(--Y),#F59E0B);
        color:var(--INK);font-size:.9rem;font-weight:700;
        border:none;cursor:pointer;
        display:flex;align-items:center;justify-content:center;gap:8px;
        font-family:var(--BODY);
        transition:opacity .15s,transform .1s,box-shadow .15s;
        box-shadow:0 4px 16px rgba(250,204,21,.35);
      "
      onmouseover="this.style.opacity='.9';this.style.transform='translateY(-1px)';this.style.boxShadow='0 8px 24px rgba(250,204,21,.4)'"
      onmouseout="this.style.opacity='1';this.style.transform='';this.style.boxShadow='0 4px 16px rgba(250,204,21,.35)'">
        <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
        <span id="plan-cta-label">Upgrade to Pro — $4/mo</span>
      </button>
      <div style="text-align:center;margin-top:10px;display:flex;align-items:center;justify-content:center;gap:16px;flex-wrap:wrap;">
        <span style="font-size:.72rem;color:var(--MU2);display:flex;align-items:center;gap:4px;">
          <svg width="11" height="11" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
          Secure checkout
        </span>
        <span style="font-size:.72rem;color:var(--MU2);display:flex;align-items:center;gap:4px;">
          <svg width="11" height="11" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
          Cancel anytime
        </span>
        <span style="font-size:.72rem;color:var(--MU2);display:flex;align-items:center;gap:4px;">
          <svg width="11" height="11" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"/></svg>
          Priority support
        </span>
      </div>
    </div>

  </div><!-- /modal-box -->
</div>

<!-- Demo toast -->
<div id="toast" style="position:fixed;bottom:20px;right:16px;background:var(--INK);color:#fff;font-family:var(--MONO);font-size:.74rem;font-weight:600;padding:10px 16px;border-radius:8px;box-shadow:0 4px 20px rgba(0,0,0,.2);z-index:999;display:flex;align-items:center;gap:7px;transform:translateY(70px);opacity:0;transition:transform .3s cubic-bezier(.34,1.56,.64,1),opacity .25s;">
  <div style="width:7px;height:7px;background:var(--GREEN);border-radius:50%;"></div>
  <span id="toast-msg">Done</span>
</div>
<script>
function toast(msg) {{
  const t=document.getElementById('toast');
  document.getElementById('toast-msg').textContent=msg;
  t.classList.add('show');
  setTimeout(()=>t.classList.remove('show'),2400);
}}
document.getElementById('toast').style.cssText += 'display:flex;';
</script>
<style>#toast.show{{transform:translateY(0)!important;opacity:1!important;}}</style>

</body>
</html>