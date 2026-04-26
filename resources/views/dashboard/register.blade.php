<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>DROPIT — Create Account</title>
<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Outfit:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;500;700&display=swap" rel="stylesheet"/>
<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">

<style>
/* ── Register-specific ─────────────────────────────────────── */
body { display:flex; flex-direction:column; min-height:100vh; cursor:none; }

.page {
  flex:                  1;
  display:               grid;
  grid-template-columns: 1fr;
  position:              relative;
  z-index:               1;
}

/* Form panel */
.form-panel {
  display:         flex;
  flex-direction:  column;
  align-items:     center;
  padding:         36px 16px 48px;
  background:      var(--BG);
}
.form-wrap { width: 100%; max-width: 460px; }

.form-eyebrow {
  display:        flex;
  align-items:    center;
  gap:            7px;
  font-family:    var(--MONO);
  font-size:      .58rem;
  font-weight:    700;
  letter-spacing: .14em;
  text-transform: uppercase;
  color:          var(--MU);
  margin-bottom:  10px;
}
.form-eyebrow::before {
  content:       '';
  width:         20px;
  height:        2px;
  background:    var(--Y);
  display:       inline-block;
}

.form-heading {
  font-family:    var(--DISP);
  font-size:      2.6rem;
  letter-spacing: .03em;
  color:          var(--INK);
  line-height:    1;
  margin-bottom:  4px;
}
.form-sub { font-size: .84rem; color: var(--MU); margin-bottom: 26px; }
.form-sub a { color: var(--B); font-weight: 600; }
.form-sub a:hover { text-decoration: underline; }

/* Two-col name row */
.field-row {
  display:               grid;
  grid-template-columns: 1fr 1fr;
  gap:                   12px;
}

/* Brand panel — hidden on mobile */
.brand-panel { display: none; }

/* ── Tablet ≥ 640px ── */
@media (min-width: 640px) {
  .form-panel { padding: 48px 32px 56px; }
}

/* ── Desktop ≥ 960px — two column ── */
@media (min-width: 960px) {
  .page { grid-template-columns: 1fr 420px; }

  .brand-panel {
    display:    flex;
    order:      2; /* brand right */
  }
  .brand-panel.accent-left::before { left: 0; }

  .form-panel { order: 1; border-right: 2px solid var(--BD); }
}
</style>
</head>
<body>
<div id="cur"></div>
<div class="bg-grid"></div>
<div class="bg-blob-y"></div>
<div class="bg-blob-b"></div>

<div class="success-overlay" id="success">
  <div class="success-check">
    <svg width="30" height="30" fill="none" viewBox="0 0 24 24" stroke="#FACC15" stroke-width="2.5"><path stroke-linecap="round" d="M5 13l4 4L19 7"/></svg>
  </div>
  <div class="success-msg">ACCOUNT CREATED</div>
  <div class="success-sub">Taking you to your dashboard…</div>
</div>

<div id="toast">
  <svg width="11" height="11" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" d="M5 13l4 4L19 7"/></svg>
  <span id="toast-msg">Done</span>
</div>

<!-- NAV -->
<nav class="top-nav">
  <a class="nav-logo" href="login.html">DROP<span class="white">IT</span></a>
  <div class="nav-right">
    <a class="nav-link" href="#">Pricing</a>
    <a class="nav-link" href="#">API</a>
    <a class="nav-pill" href="login.html">Sign In →</a>
  </div>
</nav>

<div class="page">

  <!-- FORM PANEL -->
  <div class="form-panel">
    <div class="form-wrap">

      <div class="form-eyebrow">New Account</div>
      <div class="form-heading">CREATE ACCOUNT</div>
      <p class="form-sub">Already have one? <a href="login.html">Sign in →</a></p>

      <!-- Social auth -->
      <div class="social-row">
        <button class="btn-social" onclick="socialReg('Google')">
          <svg width="15" height="15" viewBox="0 0 24 24" aria-hidden="true">
            <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
            <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
            <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
            <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
          </svg>
          Google
        </button>
        <button class="btn-social" onclick="socialReg('GitHub')">
          <svg width="15" height="15" viewBox="0 0 24 24" fill="var(--INK)" aria-hidden="true">
            <path d="M12 0C5.37 0 0 5.37 0 12c0 5.31 3.435 9.795 8.205 11.385.6.105.825-.255.825-.57 0-.285-.015-1.23-.015-2.235-3.015.555-3.795-.735-4.035-1.41-.135-.345-.72-1.41-1.23-1.695-.42-.225-1.02-.78-.015-.795.945-.015 1.62.87 1.845 1.23 1.08 1.815 2.805 1.305 3.495.99.105-.78.42-1.305.765-1.605-2.67-.3-5.46-1.335-5.46-5.925 0-1.305.465-2.385 1.23-3.225-.12-.3-.54-1.53.12-3.18 0 0 1.005-.315 3.3 1.23.96-.27 1.98-.405 3-.405s2.04.135 3 .405c2.295-1.56 3.3-1.23 3.3-1.23.66 1.65.24 2.88.12 3.18.765.84 1.23 1.905 1.23 3.225 0 4.605-2.805 5.625-5.475 5.925.435.375.81 1.095.81 2.22 0 1.605-.015 2.895-.015 3.3 0 .315.225.69.825.57A12.02 12.02 0 0024 12c0-6.63-5.37-12-12-12z"/>
          </svg>
          GitHub
        </button>
      </div>

      <div class="or-line">OR FILL IN YOUR DETAILS</div>

      <!-- Name row -->
      <div class="field-row">
        <div class="field">
          <label class="field-label" for="fname">First Name</label>
          <div class="field-wrap">
            <input class="field-input" id="fname" type="text" placeholder="John" autocomplete="given-name"/>
            <div class="field-icon"><svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg></div>
          </div>
          <div class="field-error" id="fname-err">Required.</div>
        </div>
        <div class="field">
          <label class="field-label" for="lname">Last Name</label>
          <div class="field-wrap">
            <input class="field-input" id="lname" type="text" placeholder="Doe" autocomplete="family-name"/>
            <div class="field-icon"><svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg></div>
          </div>
          <div class="field-error" id="lname-err">Required.</div>
        </div>
      </div>

      <!-- Email -->
      <div class="field">
        <label class="field-label" for="email">Email Address</label>
        <div class="field-wrap">
          <input class="field-input" id="email" type="email" placeholder="you@example.com" autocomplete="email" oninput="validateEmailLive(this)"/>
          <div class="field-icon" id="email-icon">
            <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
          </div>
        </div>
        <div class="field-error" id="email-err">Please enter a valid email address.</div>
      </div>

      <!-- Password -->
      <div class="field">
        <label class="field-label" for="password">Password</label>
        <div class="field-wrap">
          <input class="field-input" id="password" type="password" placeholder="Min. 8 characters" autocomplete="new-password" oninput="checkStrength(this.value)"/>
          <button class="field-toggle" type="button" onclick="togglePw('password')" aria-label="Toggle password visibility">
            <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
          </button>
        </div>
        <div class="pw-strength">
          <div class="pw-bar">
            <div class="pw-seg" id="s1"></div>
            <div class="pw-seg" id="s2"></div>
            <div class="pw-seg" id="s3"></div>
            <div class="pw-seg" id="s4"></div>
          </div>
          <div class="pw-lbl" id="pw-lbl">Enter a password</div>
        </div>
        <div class="field-error" id="pw-err">Password must be at least 8 characters.</div>
      </div>

      <!-- Confirm -->
      <div class="field">
        <label class="field-label" for="confirm">Confirm Password</label>
        <div class="field-wrap">
          <input class="field-input" id="confirm" type="password" placeholder="Re-enter password" autocomplete="new-password" oninput="checkMatch()"/>
          <button class="field-toggle" type="button" onclick="togglePw('confirm')" aria-label="Toggle password visibility">
            <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
          </button>
        </div>
        <div class="field-error" id="confirm-err">Passwords do not match.</div>
      </div>

      <!-- Plan -->
      <div class="field" style="margin-bottom:18px;">
        <label class="field-label">Choose Plan</label>
        <div class="plan-row">
          <label class="plan-card selected" id="plan-free" onclick="selectPlan('free')">
            <input type="radio" name="plan" value="free" checked/>
            <div class="plan-name">FREE</div>
            <div class="plan-price">$0 / forever</div>
          </label>
          <label class="plan-card" id="plan-pro" onclick="selectPlan('pro')">
            <input type="radio" name="plan" value="pro"/>
            <div class="plan-badge">POPULAR</div>
            <div class="plan-name">PRO</div>
            <div class="plan-price">$4.99 / mo</div>
          </label>
        </div>
      </div>

      <!-- Terms -->
      <div class="check-row">
        <input type="checkbox" id="terms"/>
        <label for="terms">I agree to the <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a>. I understand emails are temporary and auto-deleted.</label>
      </div>

      <button class="btn-submit" id="reg-btn" onclick="handleRegister()">
        <span id="btn-txt">CREATE MY ACCOUNT</span>
      </button>

    </div>
  </div>

  <!-- BRAND PANEL (desktop only) -->
  <div class="brand-panel accent-left">
    <div class="bp-tag">Join 500K+ Users</div>
    <h1 class="bp-h1">
      <span class="out">YOUR</span><br>
      <span class="yel">PRIVACY</span><br>
      STARTS<br>HERE
    </h1>
    <p class="bp-desc">Free account. Unlimited burner addresses, full inbox history, custom domains, and API access.</p>

    <div class="bp-feat-list">
      <div class="bp-feat">
        <div class="bp-feat-icon"><svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="#FACC15" stroke-width="2"><path stroke-linecap="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg></div>
        <div>
          <div class="bp-feat-t">Unlimited Burner Addresses</div>
          <div class="bp-feat-d">Generate as many as you need, whenever you need them.</div>
        </div>
      </div>
      <div class="bp-feat">
        <div class="bp-feat-icon"><svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="#FACC15" stroke-width="2"><path stroke-linecap="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg></div>
        <div>
          <div class="bp-feat-t">Dashboard & History</div>
          <div class="bp-feat-d">Track all addresses, manage expiry, view full inbox.</div>
        </div>
      </div>
      <div class="bp-feat">
        <div class="bp-feat-icon"><svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="#FACC15" stroke-width="2"><path stroke-linecap="round" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/></svg></div>
        <div>
          <div class="bp-feat-t">API Access (Pro)</div>
          <div class="bp-feat-d">Integrate into your apps. Full REST API with webhooks.</div>
        </div>
      </div>
    </div>

    <div class="trust-row">
      <div class="trust-avs">
        <div class="t-av" style="background:#4285F4;">A</div>
        <div class="t-av" style="background:#22c55e;">M</div>
        <div class="t-av" style="background:#7c3aed;">S</div>
        <div class="t-av" style="background:#dc2626;">R</div>
        <div class="t-av" style="background:var(--Y);color:var(--INK);">K</div>
      </div>
      <span>500,000+ accounts created this month</span>
    </div>
  </div>

</div><!-- /page -->

<footer class="page-footer">
  <div class="foot-logo">DROP<span class="white">IT</span></div>
  <div class="foot-links">
    <a href="#">Privacy</a><a href="#">Terms</a><a href="#">API</a><a href="#">Status</a>
  </div>
</footer>

<script>
/* cursor */
const cur=document.getElementById('cur');
document.addEventListener('mousemove',e=>{cur.style.left=e.clientX+'px';cur.style.top=e.clientY+'px';});
document.querySelectorAll('a,button,input,label,.plan-card').forEach(el=>{
  el.addEventListener('mouseenter',()=>cur.classList.add('big'));
  el.addEventListener('mouseleave',()=>cur.classList.remove('big'));
});

/* helpers */
function toast(msg){
  document.getElementById('toast-msg').textContent=msg;
  const t=document.getElementById('toast');t.classList.add('show');
  setTimeout(()=>t.classList.remove('show'),2400);
}
function togglePw(id){const i=document.getElementById(id);i.type=i.type==='password'?'text':'password';}

function validateEmailLive(inp){
  const ok=/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(inp.value);
  inp.className='field-input'+(inp.value?(ok?' ok':' err'):'');
  document.getElementById('email-err').classList.toggle('show',inp.value&&!ok);
}

function checkStrength(pw){
  let s=0;
  if(pw.length>=8)s++;
  if(/[A-Z]/.test(pw))s++;
  if(/[0-9]/.test(pw))s++;
  if(/[^A-Za-z0-9]/.test(pw))s++;
  const cols=['','#dc2626','#f59e0b','#22c55e','#22c55e'];
  const lbls=['Enter a password','Too weak','Could be stronger','Almost there!','Strong ✓'];
  ['s1','s2','s3','s4'].forEach((id,i)=>{document.getElementById(id).style.background=i<s?cols[s]:'#E5E7EB';});
  const l=document.getElementById('pw-lbl');l.textContent=lbls[s]||lbls[0];l.style.color=cols[s]||'#9CA3AF';
}

function checkMatch(){
  const pw=document.getElementById('password').value;
  const c=document.getElementById('confirm');
  c.className='field-input'+(c.value?(c.value===pw?' ok':' err'):'');
  document.getElementById('confirm-err').classList.toggle('show',c.value&&c.value!==pw);
}

function selectPlan(p){
  document.getElementById('plan-free').classList.toggle('selected',p==='free');
  document.getElementById('plan-pro').classList.toggle('selected',p==='pro');
}

function req(id,errId){
  const v=document.getElementById(id).value.trim();
  if(!v){document.getElementById(id).className='field-input err';document.getElementById(errId).classList.add('show');return false;}
  document.getElementById(id).className='field-input';document.getElementById(errId).classList.remove('show');return true;
}

function handleRegister(){
  let ok=true;
  if(!req('fname','fname-err'))ok=false;
  if(!req('lname','lname-err'))ok=false;
  const em=document.getElementById('email');
  if(!em.value||!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(em.value)){em.className='field-input err';document.getElementById('email-err').classList.add('show');ok=false;}
  const pw=document.getElementById('password').value;
  if(pw.length<8){document.getElementById('password').className='field-input err';document.getElementById('pw-err').classList.add('show');ok=false;}
  else{document.getElementById('password').className='field-input';document.getElementById('pw-err').classList.remove('show');}
  if(document.getElementById('confirm').value!==pw){document.getElementById('confirm').className='field-input err';document.getElementById('confirm-err').classList.add('show');ok=false;}
  if(!document.getElementById('terms').checked){toast('Please accept the Terms to continue.');ok=false;}
  if(!ok)return;
  const btn=document.getElementById('reg-btn');btn.classList.add('loading');document.getElementById('btn-txt').textContent='CREATING ACCOUNT…';
  setTimeout(()=>{document.getElementById('success').classList.add('show');setTimeout(()=>window.location.href='dashboard.html',1400);},1200);
}

function socialReg(p){setTimeout(()=>{document.getElementById('success').classList.add('show');setTimeout(()=>window.location.href='dashboard.html',1400);},800);}
document.addEventListener('keydown',e=>{if(e.key==='Enter')handleRegister();});
</script>
</body>
</html>