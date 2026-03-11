<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>DROPIT — Sign In</title>
<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Outfit:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;500;700&display=swap" rel="stylesheet"/>
<style>
:root{--Y:#FACC15;--B:#2563EB;--INK:#1F2937;--BG:#F8FAFC;--BD:#E5E7EB;--MU:#6B7280;}
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0;}
body{background:var(--BG);font-family:'Outfit',sans-serif;color:var(--INK);min-height:100vh;display:flex;flex-direction:column;cursor:none;overflow-x:hidden;}

/* CURSOR */
#cur{width:10px;height:10px;background:var(--Y);border-radius:50%;position:fixed;top:0;left:0;pointer-events:none;z-index:9999;transform:translate(-50%,-50%);transition:width .2s,height .2s,opacity .2s;}
#cur.big{width:30px;height:30px;background:rgba(250,204,21,.25);}

/* BG PATTERN */
.bg-grid{position:fixed;inset:0;background-image:radial-gradient(circle,#D1D5DB 1px,transparent 1px);background-size:26px 26px;opacity:.5;pointer-events:none;z-index:0;}
.bg-blob-y{position:fixed;width:500px;height:500px;background:radial-gradient(circle,rgba(250,204,21,.14) 0,transparent 70%);border-radius:50%;top:-100px;left:-100px;pointer-events:none;z-index:0;}
.bg-blob-b{position:fixed;width:400px;height:400px;background:radial-gradient(circle,rgba(37,99,235,.08) 0,transparent 70%);border-radius:50%;bottom:-80px;right:-80px;pointer-events:none;z-index:0;}

/* NAV */
nav{position:sticky;top:0;z-index:100;background:var(--INK);display:flex;align-items:center;justify-content:space-between;padding:0 40px;height:54px;border-bottom:3px solid var(--Y);}
.nav-logo{font-family:'Bebas Neue',sans-serif;font-size:1.75rem;color:var(--Y);letter-spacing:.05em;text-decoration:none;cursor:none;}
.nav-logo span{color:#fff;}
.nav-right{display:flex;align-items:center;gap:20px;}
.nav-right a{font-size:.78rem;font-weight:600;letter-spacing:.1em;text-transform:uppercase;color:#9CA3AF;text-decoration:none;transition:color .2s;}
.nav-right a:hover{color:var(--Y);}
.nav-right .nav-pill{background:var(--Y);color:var(--INK);padding:7px 16px;font-size:.74rem;font-weight:700;letter-spacing:.08em;text-transform:uppercase;cursor:none;border:none;transition:background .15s;}
.nav-right .nav-pill:hover{background:#fff;}

/* LAYOUT */
.page{flex:1;display:grid;grid-template-columns:1fr 1fr;position:relative;z-index:1;}

/* LEFT PANEL — brand */
.brand-panel{background:var(--INK);display:flex;flex-direction:column;justify-content:center;padding:60px 64px;position:relative;overflow:hidden;}
.brand-panel::before{content:'';position:absolute;top:0;right:0;width:3px;height:100%;background:var(--Y);}
/* decorative lines */
.brand-panel::after{content:'';position:absolute;bottom:0;left:0;right:0;height:3px;background:var(--Y);}
.bp-tag{display:inline-flex;align-items:center;gap:8px;background:rgba(250,204,21,.12);border:1px solid rgba(250,204,21,.3);color:var(--Y);font-family:'JetBrains Mono',monospace;font-size:.68rem;font-weight:700;letter-spacing:.12em;text-transform:uppercase;padding:5px 12px;margin-bottom:28px;width:fit-content;}
.bp-tag::before{content:'';width:6px;height:6px;background:var(--Y);border-radius:50%;animation:blink 1.2s step-end infinite;}
@keyframes blink{0%,100%{opacity:1}50%{opacity:0}}
.bp-h1{font-family:'Bebas Neue',sans-serif;font-size:clamp(3rem,5vw,5.5rem);line-height:.88;letter-spacing:.01em;color:#fff;margin-bottom:24px;}
.bp-h1 .yel{color:var(--Y);}
.bp-h1 .out{-webkit-text-stroke:2px rgba(255,255,255,.3);color:transparent;}
.bp-desc{font-size:.9rem;color:#9CA3AF;line-height:1.7;max-width:340px;margin-bottom:40px;}

/* stat row */
.stat-row{display:flex;gap:28px;flex-wrap:wrap;}
.stat-box{border:1px solid rgba(255,255,255,.1);padding:14px 18px;min-width:100px;}
.stat-box-n{font-family:'Bebas Neue',sans-serif;font-size:1.8rem;color:var(--Y);line-height:1;}
.stat-box-l{font-size:.7rem;color:#6B7280;font-weight:500;margin-top:2px;}

/* decorative email icon row */
.bp-icons{display:flex;gap:12px;margin-top:36px;flex-wrap:wrap;}
.bp-icon-pill{display:flex;align-items:center;gap:6px;background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.1);padding:8px 14px;font-size:.72rem;color:#9CA3AF;}
.bp-icon-pill svg{flex-shrink:0;}

/* RIGHT PANEL — form */
.form-panel{display:flex;flex-direction:column;justify-content:center;align-items:center;padding:60px 48px;background:var(--BG);}
.form-wrap{width:100%;max-width:420px;}

.form-heading{font-family:'Bebas Neue',sans-serif;font-size:2.8rem;letter-spacing:.03em;color:var(--INK);line-height:1;margin-bottom:4px;}
.form-sub{font-size:.85rem;color:var(--MU);margin-bottom:36px;font-weight:400;}
.form-sub a{color:var(--B);font-weight:600;text-decoration:none;}
.form-sub a:hover{text-decoration:underline;}

/* field */
.field{margin-bottom:20px;}
.field-label{display:block;font-family:'JetBrains Mono',monospace;font-size:.66rem;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--MU);margin-bottom:7px;}
.field-wrap{position:relative;}
.field-input{
  width:100%;padding:13px 16px;padding-right:44px;
  border:2px solid var(--INK);
  background:#fff;
  font-family:'Outfit',sans-serif;font-size:.9rem;color:var(--INK);
  outline:none;
  transition:border-color .15s,box-shadow .15s;
  cursor:text;
}
.field-input::placeholder{color:#C0C0C0;}
.field-input:focus{border-color:var(--Y);box-shadow:4px 4px 0 var(--Y);}
.field-input.error{border-color:#dc2626;box-shadow:4px 4px 0 #fca5a5;}
.field-icon{position:absolute;right:13px;top:50%;transform:translateY(-50%);color:#C0C0C0;pointer-events:none;}
.field-toggle{position:absolute;right:13px;top:50%;transform:translateY(-50%);color:#C0C0C0;cursor:none;background:none;border:none;padding:2px;}
.field-toggle:hover{color:var(--INK);}
.field-error{display:none;font-size:.72rem;color:#dc2626;font-family:'JetBrains Mono',monospace;margin-top:5px;font-weight:600;}
.field-error.show{display:block;}

/* checkbox */
.check-row{display:flex;align-items:center;gap:10px;margin-bottom:24px;}
.check-row input[type=checkbox]{width:16px;height:16px;border:2px solid var(--INK);appearance:none;background:#fff;cursor:none;position:relative;flex-shrink:0;}
.check-row input[type=checkbox]:checked{background:var(--Y);}
.check-row input[type=checkbox]:checked::after{content:'✓';position:absolute;font-size:.7rem;font-weight:900;color:var(--INK);top:50%;left:50%;transform:translate(-50%,-50%);}
.check-row label{font-size:.8rem;color:var(--MU);cursor:none;}
.check-row label a{color:var(--B);font-weight:600;text-decoration:none;}
.check-row label a:hover{text-decoration:underline;}

/* submit */
.btn-submit{
  width:100%;padding:15px;
  background:var(--Y);color:var(--INK);
  font-family:'Bebas Neue',sans-serif;
  font-size:1.25rem;letter-spacing:.08em;
  border:2px solid var(--INK);cursor:none;
  box-shadow:4px 4px 0 var(--INK);
  transition:transform .1s,box-shadow .1s,background .15s;
  position:relative;overflow:hidden;
}
.btn-submit:hover{transform:translate(-2px,-2px);box-shadow:6px 6px 0 var(--INK);}
.btn-submit:active{transform:translate(1px,1px);box-shadow:2px 2px 0 var(--INK);}
.btn-submit.loading{background:#E5E7EB;pointer-events:none;}

/* divider */
.or-line{display:flex;align-items:center;gap:12px;margin:22px 0;color:#C0C0C0;font-family:'JetBrains Mono',monospace;font-size:.65rem;font-weight:700;letter-spacing:.1em;}
.or-line::before,.or-line::after{content:'';flex:1;height:1px;background:var(--BD);}

/* social btns */
.social-row{display:grid;grid-template-columns:1fr 1fr;gap:10px;margin-bottom:24px;}
.btn-social{
  display:flex;align-items:center;justify-content:center;gap:8px;
  padding:11px 14px;
  border:2px solid var(--INK);
  background:#fff;
  font-size:.8rem;font-weight:600;color:var(--INK);
  cursor:none;
  transition:background .12s,box-shadow .12s,transform .1s;
  box-shadow:2px 2px 0 var(--INK);
}
.btn-social:hover{background:#FFFBEB;box-shadow:4px 4px 0 var(--INK);transform:translate(-1px,-1px);}

/* forgot */
.forgot-row{display:flex;justify-content:flex-end;margin-top:-14px;margin-bottom:22px;}
.forgot-row a{font-size:.75rem;color:var(--B);font-weight:600;text-decoration:none;}
.forgot-row a:hover{text-decoration:underline;}

/* footer */
footer{background:var(--INK);padding:16px 40px;display:flex;align-items:center;justify-content:space-between;border-top:2px solid var(--Y);position:relative;z-index:1;}
.foot-logo{font-family:'Bebas Neue',sans-serif;font-size:1.1rem;color:var(--Y);}
.foot-logo span{color:#fff;}
.foot-links{display:flex;gap:20px;}
.foot-links a{font-size:.7rem;color:#6B7280;text-decoration:none;}
.foot-links a:hover{color:var(--Y);}

/* success overlay */
.success-overlay{display:none;position:fixed;inset:0;background:var(--INK);z-index:200;flex-direction:column;align-items:center;justify-content:center;gap:16px;}
.success-overlay.show{display:flex;}
.success-check{width:80px;height:80px;border:3px solid var(--Y);display:flex;align-items:center;justify-content:center;animation:popIn .4s cubic-bezier(.34,1.56,.64,1);}
@keyframes popIn{from{transform:scale(0);opacity:0}to{transform:scale(1);opacity:1}}
.success-msg{font-family:'Bebas Neue',sans-serif;font-size:2rem;color:#fff;letter-spacing:.05em;}
.success-sub{font-size:.85rem;color:#9CA3AF;}

/* toast */
#toast{position:fixed;bottom:24px;right:28px;background:var(--INK);color:var(--Y);font-family:'JetBrains Mono',monospace;font-size:.74rem;font-weight:700;letter-spacing:.05em;padding:10px 16px;border:2px solid var(--Y);box-shadow:3px 3px 0 var(--Y);z-index:300;transform:translateY(60px);opacity:0;transition:transform .35s cubic-bezier(.34,1.56,.64,1),opacity .3s;display:flex;align-items:center;gap:7px;}
#toast.show{transform:translateY(0);opacity:1;}

@media(max-width:768px){
  .page{grid-template-columns:1fr;}
  .brand-panel{display:none;}
  .form-panel{padding:40px 24px;}
  nav{padding:0 20px;}
  footer{padding:14px 20px;flex-direction:column;gap:10px;text-align:center;}
}
</style>
</head>
<body>
<div id="cur"></div>
<div class="bg-grid"></div>
<div class="bg-blob-y"></div>
<div class="bg-blob-b"></div>

<div id="toast"><svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" d="M5 13l4 4L19 7"/></svg><span id="toast-msg">Done</span></div>

<div class="success-overlay" id="success">
  <div class="success-check"><svg width="36" height="36" fill="none" viewBox="0 0 24 24" stroke="#FACC15" stroke-width="2.5"><path stroke-linecap="round" d="M5 13l4 4L19 7"/></svg></div>
  <div class="success-msg">SIGNED IN</div>
  <div class="success-sub">Redirecting to dashboard…</div>
</div>

<!-- NAV -->
<nav>
  <a class="nav-logo" href="login.html">DROP<span>IT</span></a>
  <div class="nav-right">
    <a href="#">How it works</a>
    <a href="#">API</a>
    <a href="register.html"><button class="nav-pill">Create Account</button></a>
  </div>
</nav>

<div class="page">

  <!-- BRAND PANEL -->
  <div class="brand-panel">
    <div class="bp-tag">Secure Access</div>
    <h1 class="bp-h1">
      <span class="out">SIGN</span><br>
      <span class="yel">INTO</span><br>
      YOUR<br>VAULT
    </h1>
    <p class="bp-desc">Access your dashboard, manage burner addresses, view full email history, and control your privacy settings — all in one place.</p>

    <div class="stat-row">
      <div class="stat-box">
        <div class="stat-box-n">12M+</div>
        <div class="stat-box-l">Emails generated</div>
      </div>
      <div class="stat-box">
        <div class="stat-box-n">99.9%</div>
        <div class="stat-box-l">Uptime SLA</div>
      </div>
      <div class="stat-box">
        <div class="stat-box-n">0 Logs</div>
        <div class="stat-box-l">Zero data stored</div>
      </div>
    </div>

    <div class="bp-icons">
      <div class="bp-icon-pill">
        <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="#FACC15" stroke-width="2"><path stroke-linecap="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
        End-to-end encrypted
      </div>
      <div class="bp-icon-pill">
        <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="#FACC15" stroke-width="2"><path stroke-linecap="round" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
        Instant access
      </div>
      <div class="bp-icon-pill">
        <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="#FACC15" stroke-width="2"><circle cx="12" cy="12" r="10"/><path stroke-linecap="round" d="M12 8v4l3 3"/></svg>
        Auto-expiry control
      </div>
    </div>
  </div>

  <!-- FORM PANEL -->
  <div class="form-panel">
    <div class="form-wrap">
      <div class="form-heading">SIGN IN</div>
      <p class="form-sub">No account? <a href="register.html">Create one free →</a></p>

      <!-- Social -->
      <div class="social-row">
        <button class="btn-social" onclick="socialLogin('Google')">
          <svg width="16" height="16" viewBox="0 0 24 24"><path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/><path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/><path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/><path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/></svg>
          Google
        </button>
        <button class="btn-social" onclick="socialLogin('GitHub')">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="var(--INK)"><path d="M12 0C5.37 0 0 5.37 0 12c0 5.31 3.435 9.795 8.205 11.385.6.105.825-.255.825-.57 0-.285-.015-1.23-.015-2.235-3.015.555-3.795-.735-4.035-1.41-.135-.345-.72-1.41-1.23-1.695-.42-.225-1.02-.78-.015-.795.945-.015 1.62.87 1.845 1.23 1.08 1.815 2.805 1.305 3.495.99.105-.78.42-1.305.765-1.605-2.67-.3-5.46-1.335-5.46-5.925 0-1.305.465-2.385 1.23-3.225-.12-.3-.54-1.53.12-3.18 0 0 1.005-.315 3.3 1.23.96-.27 1.98-.405 3-.405s2.04.135 3 .405c2.295-1.56 3.3-1.23 3.3-1.23.66 1.65.24 2.88.12 3.18.765.84 1.23 1.905 1.23 3.225 0 4.605-2.805 5.625-5.475 5.925.435.375.81 1.095.81 2.22 0 1.605-.015 2.895-.015 3.3 0 .315.225.69.825.57A12.02 12.02 0 0024 12c0-6.63-5.37-12-12-12z"/></svg>
          GitHub
        </button>
      </div>

      <div class="or-line">OR CONTINUE WITH EMAIL</div>

      <!-- Email field -->
      <div class="field">
        <label class="field-label" for="email">Email Address</label>
        <div class="field-wrap">
          <input class="field-input" id="email" type="email" placeholder="you@example.com" autocomplete="email"/>
          <div class="field-icon"><svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg></div>
        </div>
        <div class="field-error" id="email-err">Please enter a valid email address.</div>
      </div>

      <!-- Password field -->
      <div class="field">
        <label class="field-label" for="password">Password</label>
        <div class="field-wrap">
          <input class="field-input" id="password" type="password" placeholder="Enter your password" autocomplete="current-password"/>
          <button class="field-toggle" onclick="togglePw('password','eye1')" type="button">
            <svg id="eye1" width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
          </button>
        </div>
        <div class="field-error" id="pw-err">Password is required.</div>
      </div>

      <!-- Forgot + Remember -->
      <div class="forgot-row"><a href="#">Forgot password?</a></div>
      <div class="check-row">
        <input type="checkbox" id="remember"/>
        <label for="remember">Remember me for 30 days</label>
      </div>

      <button class="btn-submit" id="login-btn" onclick="handleLogin()">
        <span id="btn-txt">SIGN IN TO DROPIT</span>
      </button>

      <div style="margin-top:20px;text-align:center;font-size:.75rem;color:var(--MU);">
        By signing in you agree to our <a href="#" style="color:var(--B);font-weight:600;">Terms</a> and <a href="#" style="color:var(--B);font-weight:600;">Privacy Policy</a>.
      </div>
    </div>
  </div>

</div>

<footer>
  <div class="foot-logo">DROP<span>IT</span></div>
  <div class="foot-links">
    <a href="#">Privacy</a><a href="#">Terms</a><a href="#">API</a><a href="#">Status</a>
  </div>
</footer>

<script>
// Cursor
const cur=document.getElementById('cur');
document.addEventListener('mousemove',e=>{cur.style.left=e.clientX+'px';cur.style.top=e.clientY+'px';});
document.querySelectorAll('a,button,input,label').forEach(el=>{
  el.addEventListener('mouseenter',()=>cur.classList.add('big'));
  el.addEventListener('mouseleave',()=>cur.classList.remove('big'));
});

function togglePw(id,iconId){
  const inp=document.getElementById(id);
  inp.type=inp.type==='password'?'text':'password';
}

function socialLogin(provider){
  toast(`Connecting with ${provider}…`);
  setTimeout(()=>{window.location.href='dashboard.html';},1200);
}

function toast(msg){
  document.getElementById('toast-msg').textContent=msg;
  const t=document.getElementById('toast');
  t.classList.add('show');
  setTimeout(()=>t.classList.remove('show'),2400);
}

function handleLogin(){
  const email=document.getElementById('email').value.trim();
  const pw=document.getElementById('password').value.trim();
  let valid=true;

  // validate
  if(!email||!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)){
    document.getElementById('email').classList.add('error');
    document.getElementById('email-err').classList.add('show');
    valid=false;
  } else {
    document.getElementById('email').classList.remove('error');
    document.getElementById('email-err').classList.remove('show');
  }
  if(!pw){
    document.getElementById('password').classList.add('error');
    document.getElementById('pw-err').classList.add('show');
    valid=false;
  } else {
    document.getElementById('password').classList.remove('error');
    document.getElementById('pw-err').classList.remove('show');
  }
  if(!valid) return;

  // loading state
  const btn=document.getElementById('login-btn');
  btn.classList.add('loading');
  document.getElementById('btn-txt').textContent='SIGNING IN…';

  setTimeout(()=>{
    document.getElementById('success').classList.add('show');
    setTimeout(()=>window.location.href='dashboard.html',1400);
  },1000);
}

// Enter key
document.addEventListener('keydown',e=>{if(e.key==='Enter') handleLogin();});
</script>
</body>
</html>