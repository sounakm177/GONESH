<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>DROPIT — Sign In</title>
<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Outfit:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;500;700&display=swap" rel="stylesheet"/>
@vite(['resources/css/login.css'])
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
    <p class="form-sub">No account? <a href="{{ route('register') }}">Create one free →</a></p>

    <!-- Social -->
    <div class="social-row">
      <button class="btn-social" onclick="socialLogin('Google')" type="button">
        <!-- SVG unchanged -->
        Google
      </button>

      <button class="btn-social" onclick="socialLogin('GitHub')" type="button">
        <!-- SVG unchanged -->
        GitHub
      </button>
    </div>

    <div class="or-line">OR CONTINUE WITH EMAIL</div>

    <form method="POST" action="{{ route('login') }}">
      @csrf

      <!-- Email field -->
      <div class="field">
        <label class="field-label" for="email">Email Address</label>
        <div class="field-wrap">
          <input 
            class="field-input"
            id="email"
            type="email"
            name="email"
            value="{{ old('email') }}"
            placeholder="you@example.com"
            autocomplete="username"
            required
            autofocus
          />
          <div class="field-icon">
            <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
            </svg>
          </div>
        </div>

        @error('email')
          <div class="field-error">{{ $message }}</div>
        @enderror
      </div>

      <!-- Password field -->
      <div class="field">
        <label class="field-label" for="password">Password</label>
        <div class="field-wrap">
          <input 
            class="field-input"
            id="password"
            type="password"
            name="password"
            placeholder="Enter your password"
            autocomplete="current-password"
            required
          />

          <button class="field-toggle" onclick="togglePw('password','eye1')" type="button">
            <svg id="eye1" width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
              <path stroke-linecap="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
            </svg>
          </button>
        </div>

        @error('password')
          <div class="field-error">{{ $message }}</div>
        @enderror
      </div>

      <!-- Forgot + Remember -->
      <div class="forgot-row">
        @if (Route::has('password.request'))
          <a href="{{ route('password.request') }}">Forgot password?</a>
        @endif
      </div>

      <div class="check-row">
        <input type="checkbox" id="remember" name="remember"/>
        <label for="remember">Remember me for 30 days</label>
      </div>

      <button class="btn-submit" id="login-btn" type="submit">
        <span id="btn-txt">SIGN IN TO DROPIT</span>
      </button>

    </form>

    <div style="margin-top:20px;text-align:center;font-size:.75rem;color:var(--MU);">
      By signing in you agree to our 
      <a href="#" style="color:var(--B);font-weight:600;">Terms</a> and 
      <a href="#" style="color:var(--B);font-weight:600;">Privacy Policy</a>.
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










