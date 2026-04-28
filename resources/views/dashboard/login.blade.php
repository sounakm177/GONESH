<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>InboxOro — Sign In</title>
<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Outfit:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;500;700&display=swap" rel="stylesheet"/>
<style>
:root{--Y:#FACC15;--B:#3B82F6;--INK:#111827;--BG:#F9FAFB;--SURF:#FFFFFF;--BD:#E5E7EB;--BD2:#F3F4F6;--MU:#6B7280;--MU2:#9CA3AF;--GREEN:#10B981;--RED:#EF4444;}
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0;}
html{scroll-behavior:smooth;}
body{font-family:'Outfit',sans-serif;color:#111827;background:#F9FAFB;min-height:100vh;display:flex;flex-direction:column;overflow-x:clip;}
a{text-decoration:none;color:inherit;}
button{font-family:'Outfit',sans-serif;cursor:pointer;border:none;background:none;}
img{display:block;max-width:100%;}

/* TOPBAR */
.topbar{height:56px;background:#111827;border-bottom:1px solid rgba(255,255,255,.08);display:flex;align-items:center;justify-content:space-between;padding:0 20px;flex-shrink:0;}
.logo-img{height:32px;width:auto;}
.logo-text{font-family:'Bebas Neue',sans-serif;font-size:1.5rem;color:#fff;letter-spacing:.04em;}
.logo-text .y{color:#FACC15;}
.topbar-right{display:flex;align-items:center;gap:10px;}
.top-link{font-size:.8rem;font-weight:500;color:#9CA3AF;transition:color .15s;}
.top-link:hover{color:#fff;}
.top-btn{background:#FACC15;color:#111827;font-size:.78rem;font-weight:700;padding:7px 16px;border-radius:7px;transition:background .15s,transform .1s;white-space:nowrap;}
.top-btn:hover{background:#EAB800;transform:translateY(-1px);}

/* PAGE GRID */
.page{flex:1;display:grid;grid-template-columns:1fr;}

/* BRAND PANEL */
.brand-panel{display:none;background:#111827;flex-direction:column;justify-content:center;padding:60px 56px;position:relative;overflow:hidden;}
.brand-panel::after{content:'';position:absolute;top:0;right:0;bottom:0;width:1px;background:rgba(255,255,255,.08);}
.blob{position:absolute;border-radius:50%;pointer-events:none;}
.blob-y{width:360px;height:360px;background:radial-gradient(circle,rgba(250,204,21,.13) 0,transparent 70%);top:-80px;left:-80px;}
.blob-b{width:300px;height:300px;background:radial-gradient(circle,rgba(59,130,246,.08) 0,transparent 70%);bottom:-60px;right:-60px;}
.bp-eyebrow{display:inline-flex;align-items:center;gap:7px;font-family:'JetBrains Mono',monospace;font-size:.6rem;font-weight:700;letter-spacing:.12em;text-transform:uppercase;color:#FACC15;background:rgba(250,204,21,.1);border:1px solid rgba(250,204,21,.25);padding:4px 12px;border-radius:20px;margin-bottom:24px;width:fit-content;}
.bp-eyebrow::before{content:'';width:6px;height:6px;background:#FACC15;border-radius:50%;animation:blink 1.2s step-end infinite;}
@keyframes blink{0%,100%{opacity:1}50%{opacity:0}}
.bp-h1{font-family:'Bebas Neue',sans-serif;font-size:clamp(2.8rem,4vw,4.5rem);color:#fff;line-height:.92;letter-spacing:.02em;margin-bottom:18px;}
.bp-h1 .y{color:#FACC15;}
.bp-h1 .out{-webkit-text-stroke:2px rgba(255,255,255,.2);color:transparent;}
.bp-desc{font-size:.88rem;color:#9CA3AF;line-height:1.7;max-width:320px;margin-bottom:36px;}
.bp-stats{display:flex;gap:20px;flex-wrap:wrap;margin-bottom:36px;}
.bp-stat{border:1px solid rgba(255,255,255,.1);border-radius:10px;padding:14px 18px;}
.bp-stat-n{font-family:'Bebas Neue',sans-serif;font-size:1.7rem;color:#FACC15;line-height:1;}
.bp-stat-l{font-size:.7rem;color:#6B7280;margin-top:2px;}
.bp-pills{display:flex;flex-wrap:wrap;gap:8px;}
.bp-pill{display:flex;align-items:center;gap:6px;background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.1);border-radius:8px;padding:7px 12px;font-size:.74rem;color:#9CA3AF;}
.bp-pill svg{color:#FACC15;}

/* FORM PANEL */
.form-panel{display:flex;flex-direction:column;justify-content:center;align-items:center;padding:40px 20px 56px;background:#fff;}
.form-wrap{width:100%;max-width:400px;}
.form-eyebrow{font-family:'JetBrains Mono',monospace;font-size:.6rem;font-weight:700;letter-spacing:.12em;text-transform:uppercase;color:#6B7280;margin-bottom:8px;display:flex;align-items:center;gap:8px;}
.form-eyebrow::before{content:'';width:18px;height:2px;background:#FACC15;display:inline-block;border-radius:1px;}
.form-title{font-family:'Bebas Neue',sans-serif;font-size:2.2rem;letter-spacing:.03em;color:#111827;line-height:1;margin-bottom:6px;}
.form-sub{font-size:.84rem;color:#6B7280;margin-bottom:28px;}
.form-sub a{color:#3B82F6;font-weight:600;}
.form-sub a:hover{text-decoration:underline;}

/* SOCIAL */
.social-row{display:grid;grid-template-columns:1fr 1fr;gap:10px;margin-bottom:20px;}
.btn-social{display:flex;align-items:center;justify-content:center;gap:8px;padding:10px 14px;border:1px solid #E5E7EB;border-radius:8px;background:#fff;font-size:.82rem;font-weight:500;color:#111827;transition:background .12s,border-color .12s,box-shadow .12s;}
.btn-social:hover{background:#F3F4F6;border-color:#D1D5DB;box-shadow:0 2px 8px rgba(0,0,0,.06);}

/* OR */
.or-row{display:flex;align-items:center;gap:12px;margin:20px 0;color:#9CA3AF;font-size:.74rem;font-family:'JetBrains Mono',monospace;font-weight:600;letter-spacing:.06em;}
.or-row::before,.or-row::after{content:'';flex:1;height:1px;background:#E5E7EB;}

/* FIELDS */
.field{margin-bottom:16px;}
.field-label{display:block;font-family:'JetBrains Mono',monospace;font-size:.62rem;font-weight:700;letter-spacing:.08em;text-transform:uppercase;color:#6B7280;margin-bottom:6px;}
.field-wrap{position:relative;}
.field-input{width:100%;padding:11px 40px 11px 14px;border:1px solid #E5E7EB;border-radius:8px;background:#fff;font-family:'Outfit',sans-serif;font-size:16px;color:#111827;outline:none;transition:border-color .15s,box-shadow .15s;}
.field-input::placeholder{color:#9CA3AF;}
.field-input:focus{border-color:#FACC15;box-shadow:0 0 0 3px rgba(250,204,21,.15);}
.field-input.err{border-color:#EF4444;box-shadow:0 0 0 3px rgba(239,68,68,.1);}
.field-icon{position:absolute;right:12px;top:50%;transform:translateY(-50%);color:#9CA3AF;pointer-events:none;display:flex;}
.field-toggle{position:absolute;right:12px;top:50%;transform:translateY(-50%);color:#9CA3AF;display:flex;padding:2px;transition:color .15s;}
.field-toggle:hover{color:#111827;}
.field-err{display:none;font-size:.68rem;color:#EF4444;font-family:'JetBrains Mono',monospace;font-weight:600;margin-top:4px;}
.field-err.show{display:block;}

/* EXTRAS */
.extras-row{display:flex;align-items:center;justify-content:space-between;margin-bottom:20px;}
.check-row{display:flex;align-items:center;gap:8px;}
.check-row input[type=checkbox]{width:17px;height:17px;border:1.5px solid #E5E7EB;border-radius:5px;appearance:none;background:#fff;position:relative;cursor:pointer;transition:background .12s,border-color .12s;flex-shrink:0;}
.check-row input[type=checkbox]:checked{background:#FACC15;border-color:#FACC15;}
.check-row input[type=checkbox]:checked::after{content:'✓';position:absolute;font-size:.65rem;font-weight:900;color:#111827;top:50%;left:50%;transform:translate(-50%,-50%);}
.check-row label{font-size:.8rem;color:#6B7280;cursor:pointer;}
.forgot-link{font-size:.78rem;color:#3B82F6;font-weight:600;}
.forgot-link:hover{text-decoration:underline;}

/* SUBMIT */
.btn-submit{width:100%;padding:13px;background:#111827;color:#fff;font-size:.9rem;font-weight:700;border-radius:8px;letter-spacing:.02em;transition:box-shadow .15s,transform .1s;position:relative;overflow:hidden;}
.btn-submit::before{content:'';position:absolute;top:0;left:0;right:0;height:2px;background:#FACC15;}
.btn-submit:hover{box-shadow:0 4px 16px rgba(17,24,39,.25);transform:translateY(-1px);}
.btn-submit:active{transform:translateY(0);box-shadow:none;}
.btn-submit.loading{background:#E5E7EB;color:#6B7280;pointer-events:none;}
.legal{margin-top:18px;text-align:center;font-size:.72rem;color:#9CA3AF;line-height:1.5;}
.legal a{color:#3B82F6;font-weight:500;}

/* SUCCESS */
.success-overlay{display:none;position:fixed;inset:0;background:#111827;z-index:999;flex-direction:column;align-items:center;justify-content:center;gap:14px;}
.success-overlay.show{display:flex;animation:fade-in .3s ease both;}
@keyframes fade-in{from{opacity:0}to{opacity:1}}
.success-icon{width:64px;height:64px;background:rgba(250,204,21,.15);border-radius:50%;display:flex;align-items:center;justify-content:center;}
.success-title{font-family:'Bebas Neue',sans-serif;font-size:1.8rem;color:#fff;letter-spacing:.04em;}
.success-sub{font-size:.84rem;color:#6B7280;}

/* TOAST */
#toast{position:fixed;bottom:20px;right:16px;background:#111827;color:#fff;font-family:'JetBrains Mono',monospace;font-size:.74rem;font-weight:600;padding:10px 16px;border-radius:8px;box-shadow:0 4px 20px rgba(0,0,0,.2);z-index:998;display:flex;align-items:center;gap:7px;transform:translateY(70px);opacity:0;transition:transform .3s cubic-bezier(.34,1.56,.64,1),opacity .25s;}
#toast.show{transform:translateY(0);opacity:1;}
#toast .td{width:7px;height:7px;background:#10B981;border-radius:50%;}

/* FOOTER */
.page-footer{background:#111827;border-top:1px solid rgba(255,255,255,.08);padding:14px 20px;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:10px;}
.foot-logo{font-family:'Bebas Neue',sans-serif;font-size:1rem;color:#FACC15;}
.foot-logo span{color:#fff;}
.foot-links{display:flex;gap:14px;flex-wrap:wrap;}
.foot-links a{font-size:.72rem;color:#6B7280;transition:color .15s;}
.foot-links a:hover{color:#FACC15;}

@media(min-width:640px){.form-panel{padding:56px 40px;}}
@media(min-width:960px){
  .page{grid-template-columns:1fr 460px;}
  .brand-panel{display:flex;}
  .form-panel{border-left:1px solid #E5E7EB;}
}
</style>
</head>
<body>
<div id="toast"><div class="td"></div><span id="toast-msg">Done</span></div>
<div class="success-overlay" id="success">
  <div class="success-icon"><svg width="28" height="28" fill="none" viewBox="0 0 24 24" stroke="#FACC15" stroke-width="2.5"><path stroke-linecap="round" d="M5 13l4 4L19 7"/></svg></div>
  <div class="success-title">SIGNED IN</div>
  <div class="success-sub">Redirecting to your dashboard…</div>
</div>

<div class="topbar">
  <a href="/">
    <img src="/images/logo.svg" alt="InboxOro" class="logo-img" onerror="this.style.display='none';this.nextElementSibling.style.display='block'"/>
    <span class="logo-text" style="display:none;">Inbox<span class="y">Oro</span></span>
  </a>
  <div class="topbar-right">
    <a class="top-link" href="#">How it works</a>
    <a class="top-btn" href="register.html">Create Account →</a>
  </div>
</div>

<div class="page">
  <div class="brand-panel">
    <div class="blob blob-y"></div>
    <div class="blob blob-b"></div>
    <div class="bp-eyebrow">Secure Access</div>
    <h1 class="bp-h1"><span class="out">SIGN</span><br><span class="y">INTO</span><br>YOUR<br>VAULT</h1>
    <p class="bp-desc">Access your dashboard, manage burner addresses, view full email history, and control your privacy — all in one place.</p>
    <div class="bp-stats">
      <div class="bp-stat"><div class="bp-stat-n">12M+</div><div class="bp-stat-l">Emails generated</div></div>
      <div class="bp-stat"><div class="bp-stat-n">99.9%</div><div class="bp-stat-l">Uptime SLA</div></div>
      <div class="bp-stat"><div class="bp-stat-n">0 Logs</div><div class="bp-stat-l">Zero data stored</div></div>
    </div>
    <div class="bp-pills">
      <div class="bp-pill"><svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>End-to-end encrypted</div>
      <div class="bp-pill"><svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>Instant access</div>
      <div class="bp-pill"><svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path stroke-linecap="round" d="M12 8v4l3 3"/></svg>Auto-expiry control</div>
    </div>
  </div>

  <div class="form-panel">
    <div class="form-wrap">
      <div class="form-eyebrow">Welcome back</div>
      <div class="form-title">SIGN IN</div>
      <p class="form-sub">No account? <a href="register.html">Create one free →</a></p>
      <div class="social-row">
        <button class="btn-social" onclick="socialLogin('Google')">
          <svg width="16" height="16" viewBox="0 0 24 24"><path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/><path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/><path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/><path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/></svg>Google
        </button>
        <button class="btn-social" onclick="socialLogin('GitHub')">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="#111827"><path d="M12 0C5.37 0 0 5.37 0 12c0 5.31 3.435 9.795 8.205 11.385.6.105.825-.255.825-.57 0-.285-.015-1.23-.015-2.235-3.015.555-3.795-.735-4.035-1.41-.135-.345-.72-1.41-1.23-1.695-.42-.225-1.02-.78-.015-.795.945-.015 1.62.87 1.845 1.23 1.08 1.815 2.805 1.305 3.495.99.105-.78.42-1.305.765-1.605-2.67-.3-5.46-1.335-5.46-5.925 0-1.305.465-2.385 1.23-3.225-.12-.3-.54-1.53.12-3.18 0 0 1.005-.315 3.3 1.23.96-.27 1.98-.405 3-.405s2.04.135 3 .405c2.295-1.56 3.3-1.23 3.3-1.23.66 1.65.24 2.88.12 3.18.765.84 1.23 1.905 1.23 3.225 0 4.605-2.805 5.625-5.475 5.925.435.375.81 1.095.81 2.22 0 1.605-.015 2.895-.015 3.3 0 .315.225.69.825.57A12.02 12.02 0 0024 12c0-6.63-5.37-12-12-12z"/></svg>GitHub
        </button>
      </div>
      <div class="or-row">OR</div>
      <div class="field">
        <label class="field-label" for="email">Email Address</label>
        <div class="field-wrap">
          <input class="field-input" id="email" type="email" placeholder="you@example.com" autocomplete="email"/>
          <div class="field-icon"><svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg></div>
        </div>
        <div class="field-err" id="email-err">Please enter a valid email address.</div>
      </div>
      <div class="field">
        <label class="field-label" for="password">Password</label>
        <div class="field-wrap">
          <input class="field-input" id="password" type="password" placeholder="Enter your password" autocomplete="current-password"/>
          <button class="field-toggle" type="button" onclick="togglePw('password')"><svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg></button>
        </div>
        <div class="field-err" id="pw-err">Password is required.</div>
      </div>
      <div class="extras-row">
        <div class="check-row"><input type="checkbox" id="remember"/><label for="remember">Remember me</label></div>
        <a class="forgot-link" href="#">Forgot password?</a>
      </div>
      <button class="btn-submit" id="login-btn" onclick="handleLogin()"><span id="btn-txt">Sign In to InboxOro</span></button>
      <div class="legal">By signing in you agree to our <a href="#">Terms</a> and <a href="#">Privacy Policy</a>.</div>
    </div>
  </div>
</div>

<footer class="page-footer">
  <div class="foot-logo">Inbox<span>Oro</span></div>
  <div class="foot-links"><a href="#">Privacy</a><a href="#">Terms</a><a href="#">API</a><a href="#">Status</a></div>
</footer>

<script>
function showToast(msg){document.getElementById('toast-msg').textContent=msg;const t=document.getElementById('toast');t.classList.add('show');setTimeout(()=>t.classList.remove('show'),2400);}
function togglePw(id){const i=document.getElementById(id);i.type=i.type==='password'?'text':'password';}
function socialLogin(p){showToast('Connecting with '+p+'…');setTimeout(()=>{document.getElementById('success').classList.add('show');setTimeout(()=>window.location.href='dashboard.html',1400);},800);}
function handleLogin(){
  const em=document.getElementById('email').value.trim();
  const pw=document.getElementById('password').value.trim();
  let ok=true;
  if(!em||!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(em)){document.getElementById('email').classList.add('err');document.getElementById('email-err').classList.add('show');ok=false;}
  else{document.getElementById('email').classList.remove('err');document.getElementById('email-err').classList.remove('show');}
  if(!pw){document.getElementById('password').classList.add('err');document.getElementById('pw-err').classList.add('show');ok=false;}
  else{document.getElementById('password').classList.remove('err');document.getElementById('pw-err').classList.remove('show');}
  if(!ok)return;
  const btn=document.getElementById('login-btn');btn.classList.add('loading');document.getElementById('btn-txt').textContent='Signing in…';
  setTimeout(()=>{document.getElementById('success').classList.add('show');setTimeout(()=>window.location.href='dashboard.html',1400);},1000);
}
document.addEventListener('keydown',e=>{if(e.key==='Enter')handleLogin();});
</script>
</body>
</html>