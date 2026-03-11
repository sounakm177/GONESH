<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>DROPIT — Create Account</title>
<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Outfit:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;500;700&display=swap" rel="stylesheet"/>
<style>
:root{--Y:#FACC15;--B:#2563EB;--INK:#1F2937;--BG:#F8FAFC;--BD:#E5E7EB;--MU:#6B7280;}
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0;}
body{background:var(--BG);font-family:'Outfit',sans-serif;color:var(--INK);min-height:100vh;display:flex;flex-direction:column;cursor:none;overflow-x:hidden;}

#cur{width:10px;height:10px;background:var(--Y);border-radius:50%;position:fixed;top:0;left:0;pointer-events:none;z-index:9999;transform:translate(-50%,-50%);transition:width .2s,height .2s;}
#cur.big{width:30px;height:30px;background:rgba(250,204,21,.22);}

.bg-grid{position:fixed;inset:0;background-image:radial-gradient(circle,#D1D5DB 1px,transparent 1px);background-size:26px 26px;opacity:.45;pointer-events:none;z-index:0;}
.bg-blob-y{position:fixed;width:420px;height:420px;background:radial-gradient(circle,rgba(250,204,21,.13) 0,transparent 70%);border-radius:50%;top:-60px;right:-60px;pointer-events:none;z-index:0;}
.bg-blob-b{position:fixed;width:380px;height:380px;background:radial-gradient(circle,rgba(37,99,235,.08) 0,transparent 70%);border-radius:50%;bottom:-60px;left:-60px;pointer-events:none;z-index:0;}

nav{position:sticky;top:0;z-index:100;background:var(--INK);display:flex;align-items:center;justify-content:space-between;padding:0 40px;height:54px;border-bottom:3px solid var(--Y);}
.nav-logo{font-family:'Bebas Neue',sans-serif;font-size:1.75rem;color:var(--Y);letter-spacing:.05em;text-decoration:none;cursor:none;}
.nav-logo span{color:#fff;}
.nav-right{display:flex;align-items:center;gap:20px;}
.nav-right a{font-size:.78rem;font-weight:600;letter-spacing:.1em;text-transform:uppercase;color:#9CA3AF;text-decoration:none;transition:color .2s;cursor:none;}
.nav-right a:hover{color:var(--Y);}
.nav-pill{background:rgba(250,204,21,.15);color:var(--Y);padding:7px 16px;font-size:.74rem;font-weight:700;letter-spacing:.08em;text-transform:uppercase;cursor:none;border:1px solid rgba(250,204,21,.3);}

/* LAYOUT — reversed: form left, brand right */
.page{flex:1;display:grid;grid-template-columns:1fr 420px;position:relative;z-index:1;}

/* FORM PANEL (left) */
.form-panel{display:flex;flex-direction:column;justify-content:center;align-items:center;padding:48px;background:var(--BG);border-right:2px solid var(--BD);}
.form-wrap{width:100%;max-width:440px;}
.form-heading{font-family:'Bebas Neue',sans-serif;font-size:2.8rem;letter-spacing:.03em;color:var(--INK);line-height:1;margin-bottom:4px;}
.form-sub{font-size:.85rem;color:var(--MU);margin-bottom:30px;}
.form-sub a{color:var(--B);font-weight:600;text-decoration:none;}
.form-sub a:hover{text-decoration:underline;}

/* two-col fields */
.field-row{display:grid;grid-template-columns:1fr 1fr;gap:14px;}

.field{margin-bottom:16px;}
.field-label{display:block;font-family:'JetBrains Mono',monospace;font-size:.64rem;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--MU);margin-bottom:6px;}
.field-wrap{position:relative;}
.field-input{width:100%;padding:12px 16px;padding-right:42px;border:2px solid var(--INK);background:#fff;font-family:'Outfit',sans-serif;font-size:.88rem;color:var(--INK);outline:none;transition:border-color .15s,box-shadow .15s;cursor:text;}
.field-input::placeholder{color:#C0C0C0;}
.field-input:focus{border-color:var(--Y);box-shadow:4px 4px 0 var(--Y);}
.field-input.error{border-color:#dc2626;box-shadow:4px 4px 0 #fca5a5;}
.field-input.ok{border-color:#22c55e;box-shadow:4px 4px 0 rgba(34,197,94,.25);}
.field-icon{position:absolute;right:12px;top:50%;transform:translateY(-50%);color:#C0C0C0;pointer-events:none;}
.field-toggle{position:absolute;right:12px;top:50%;transform:translateY(-50%);color:#C0C0C0;cursor:none;background:none;border:none;}
.field-toggle:hover{color:var(--INK);}
.field-error{display:none;font-size:.7rem;color:#dc2626;font-family:'JetBrains Mono',monospace;margin-top:4px;font-weight:600;}
.field-error.show{display:block;}
.field-hint{font-size:.7rem;color:var(--MU);margin-top:4px;}

/* password strength */
.pw-strength{margin-top:6px;}
.pw-strength-bar{display:flex;gap:4px;margin-bottom:4px;}
.pw-seg{height:3px;flex:1;background:var(--BD);transition:background .3s;}
.pw-seg.weak{background:#dc2626;}
.pw-seg.fair{background:#f59e0b;}
.pw-seg.good{background:#22c55e;}
.pw-strength-label{font-size:.68rem;font-family:'JetBrains Mono',monospace;color:var(--MU);font-weight:600;}

/* plan selector */
.plan-row{display:grid;grid-template-columns:1fr 1fr;gap:10px;margin-bottom:18px;}
.plan-card{border:2px solid var(--INK);padding:14px 16px;cursor:none;transition:background .12s,box-shadow .12s;position:relative;}
.plan-card:hover{background:#FFFBEB;}
.plan-card.selected{background:var(--Y);box-shadow:4px 4px 0 var(--INK);}
.plan-card input[type=radio]{position:absolute;opacity:0;pointer-events:none;}
.plan-name{font-family:'Bebas Neue',sans-serif;font-size:1.1rem;letter-spacing:.04em;color:var(--INK);margin-bottom:2px;}
.plan-price{font-family:'JetBrains Mono',monospace;font-size:.72rem;color:var(--MU);font-weight:600;}
.plan-card.selected .plan-price{color:var(--INK);}
.plan-badge{position:absolute;top:-1px;right:-1px;background:var(--INK);color:var(--Y);font-family:'JetBrains Mono',monospace;font-size:.55rem;font-weight:700;letter-spacing:.08em;padding:3px 7px;}

/* terms */
.check-row{display:flex;align-items:flex-start;gap:10px;margin-bottom:20px;}
.check-row input[type=checkbox]{width:16px;height:16px;border:2px solid var(--INK);appearance:none;background:#fff;cursor:none;position:relative;flex-shrink:0;margin-top:2px;}
.check-row input[type=checkbox]:checked{background:var(--Y);}
.check-row input[type=checkbox]:checked::after{content:'✓';position:absolute;font-size:.68rem;font-weight:900;color:var(--INK);top:50%;left:50%;transform:translate(-50%,-50%);}
.check-row label{font-size:.78rem;color:var(--MU);line-height:1.5;cursor:none;}
.check-row label a{color:var(--B);font-weight:600;text-decoration:none;}
.check-row label a:hover{text-decoration:underline;}

.btn-submit{width:100%;padding:15px;background:var(--Y);color:var(--INK);font-family:'Bebas Neue',sans-serif;font-size:1.25rem;letter-spacing:.08em;border:2px solid var(--INK);cursor:none;box-shadow:4px 4px 0 var(--INK);transition:transform .1s,box-shadow .1s,background .15s;}
.btn-submit:hover{transform:translate(-2px,-2px);box-shadow:6px 6px 0 var(--INK);}
.btn-submit:active{transform:translate(1px,1px);box-shadow:2px 2px 0 var(--INK);}
.btn-submit.loading{background:#E5E7EB;pointer-events:none;}

.or-line{display:flex;align-items:center;gap:10px;margin:18px 0;color:#C0C0C0;font-family:'JetBrains Mono',monospace;font-size:.63rem;font-weight:700;letter-spacing:.1em;}
.or-line::before,.or-line::after{content:'';flex:1;height:1px;background:var(--BD);}

.social-row{display:grid;grid-template-columns:1fr 1fr;gap:10px;margin-bottom:20px;}
.btn-social{display:flex;align-items:center;justify-content:center;gap:7px;padding:10px;border:2px solid var(--INK);background:#fff;font-size:.78rem;font-weight:600;color:var(--INK);cursor:none;transition:background .12s,box-shadow .12s,transform .1s;box-shadow:2px 2px 0 var(--INK);}
.btn-social:hover{background:#FFFBEB;box-shadow:4px 4px 0 var(--INK);transform:translate(-1px,-1px);}

/* BRAND PANEL (right) */
.brand-panel{background:var(--INK);display:flex;flex-direction:column;justify-content:center;padding:60px 52px;position:relative;overflow:hidden;}
.brand-panel::before{content:'';position:absolute;top:0;left:0;width:3px;height:100%;background:var(--Y);}
.bp-tag{display:inline-flex;align-items:center;gap:8px;background:rgba(250,204,21,.12);border:1px solid rgba(250,204,21,.3);color:var(--Y);font-family:'JetBrains Mono',monospace;font-size:.68rem;font-weight:700;letter-spacing:.12em;text-transform:uppercase;padding:5px 12px;margin-bottom:24px;width:fit-content;}
.bp-tag::before{content:'';width:6px;height:6px;background:var(--Y);border-radius:50%;animation:blink 1.2s step-end infinite;}
@keyframes blink{0%,100%{opacity:1}50%{opacity:0}}
.bp-h1{font-family:'Bebas Neue',sans-serif;font-size:clamp(2.8rem,4vw,4.8rem);line-height:.9;color:#fff;margin-bottom:20px;}
.bp-h1 .yel{color:var(--Y);}
.bp-h1 .out{-webkit-text-stroke:2px rgba(255,255,255,.25);color:transparent;}
.bp-desc{font-size:.88rem;color:#9CA3AF;line-height:1.7;margin-bottom:32px;}

/* feature list */
.feat-list{display:flex;flex-direction:column;gap:14px;}
.feat-row{display:flex;align-items:flex-start;gap:12px;padding:14px;border:1px solid rgba(255,255,255,.07);transition:background .15s;}
.feat-row:hover{background:rgba(255,255,255,.04);}
.feat-row-icon{width:32px;height:32px;background:rgba(250,204,21,.12);border:1px solid rgba(250,204,21,.2);display:flex;align-items:center;justify-content:center;flex-shrink:0;}
.feat-row-body{}
.feat-row-t{font-family:'Bebas Neue',sans-serif;font-size:.95rem;letter-spacing:.04em;color:#fff;margin-bottom:2px;}
.feat-row-d{font-size:.72rem;color:#6B7280;line-height:1.5;}

.trust-row{display:flex;align-items:center;gap:8px;margin-top:28px;padding-top:20px;border-top:1px solid rgba(255,255,255,.07);}
.trust-row span{font-size:.72rem;color:#6B7280;}
.trust-avatars{display:flex;}
.t-av{width:26px;height:26px;border-radius:50%;border:2px solid var(--INK);margin-right:-8px;display:flex;align-items:center;justify-content:center;font-family:'Bebas Neue',sans-serif;font-size:.8rem;color:#fff;}

/* success overlay */
.success-overlay{display:none;position:fixed;inset:0;background:var(--INK);z-index:200;flex-direction:column;align-items:center;justify-content:center;gap:14px;}
.success-overlay.show{display:flex;}
.success-check{width:72px;height:72px;border:3px solid var(--Y);display:flex;align-items:center;justify-content:center;animation:popIn .4s cubic-bezier(.34,1.56,.64,1);}
@keyframes popIn{from{transform:scale(0);opacity:0}to{transform:scale(1);opacity:1}}
.success-msg{font-family:'Bebas Neue',sans-serif;font-size:2rem;color:#fff;letter-spacing:.05em;}
.success-sub{font-size:.82rem;color:#9CA3AF;}

footer{background:var(--INK);padding:14px 40px;display:flex;align-items:center;justify-content:space-between;border-top:2px solid var(--Y);position:relative;z-index:1;}
.foot-logo{font-family:'Bebas Neue',sans-serif;font-size:1.1rem;color:var(--Y);}
.foot-logo span{color:#fff;}
.foot-links{display:flex;gap:18px;}
.foot-links a{font-size:.7rem;color:#6B7280;text-decoration:none;}
.foot-links a:hover{color:var(--Y);}

@media(max-width:900px){
  .page{grid-template-columns:1fr;}
  .brand-panel{display:none;}
  .form-panel{padding:36px 20px;border-right:none;}
  nav{padding:0 20px;}
  footer{padding:12px 20px;flex-direction:column;gap:10px;}
  .field-row{grid-template-columns:1fr;}
}
</style>
</head>
<body>
<div id="cur"></div>
<div class="bg-grid"></div>
<div class="bg-blob-y"></div>
<div class="bg-blob-b"></div>

<div class="success-overlay" id="success">
  <div class="success-check"><svg width="32" height="32" fill="none" viewBox="0 0 24 24" stroke="#FACC15" stroke-width="2.5"><path stroke-linecap="round" d="M5 13l4 4L19 7"/></svg></div>
  <div class="success-msg">ACCOUNT CREATED</div>
  <div class="success-sub">Redirecting to your dashboard…</div>
</div>

<nav>
  <a class="nav-logo" href="login.html">DROP<span>IT</span></a>
  <div class="nav-right">
    <a href="#">Pricing</a>
    <a href="#">API</a>
    <span class="nav-pill">Already have an account? <a href="login.html" style="color:var(--Y);margin-left:4px;">Sign in →</a></span>
  </div>
</nav>

<div class="page">

  <!-- FORM PANEL -->
  <div class="form-panel">
    <div class="form-wrap">
      <div class="form-heading">CREATE ACCOUNT</div>
      <p class="form-sub">Already have one? <a href="login.html">Sign in →</a></p>

      <!-- Social -->
      <div class="social-row">
        <button class="btn-social" onclick="socialReg('Google')">
          <svg width="15" height="15" viewBox="0 0 24 24"><path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/><path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/><path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/><path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/></svg>
          Sign up with Google
        </button>
        <button class="btn-social" onclick="socialReg('GitHub')">
          <svg width="15" height="15" viewBox="0 0 24 24" fill="var(--INK)"><path d="M12 0C5.37 0 0 5.37 0 12c0 5.31 3.435 9.795 8.205 11.385.6.105.825-.255.825-.57 0-.285-.015-1.23-.015-2.235-3.015.555-3.795-.735-4.035-1.41-.135-.345-.72-1.41-1.23-1.695-.42-.225-1.02-.78-.015-.795.945-.015 1.62.87 1.845 1.23 1.08 1.815 2.805 1.305 3.495.99.105-.78.42-1.305.765-1.605-2.67-.3-5.46-1.335-5.46-5.925 0-1.305.465-2.385 1.23-3.225-.12-.3-.54-1.53.12-3.18 0 0 1.005-.315 3.3 1.23.96-.27 1.98-.405 3-.405s2.04.135 3 .405c2.295-1.56 3.3-1.23 3.3-1.23.66 1.65.24 2.88.12 3.18.765.84 1.23 1.905 1.23 3.225 0 4.605-2.805 5.625-5.475 5.925.435.375.81 1.095.81 2.22 0 1.605-.015 2.895-.015 3.3 0 .315.225.69.825.57A12.02 12.02 0 0024 12c0-6.63-5.37-12-12-12z"/></svg>
          Sign up with GitHub
        </button>
      </div>

      <div class="or-line">OR FILL IN YOUR DETAILS</div>

      <!-- Name row -->
      <div class="field-row">
        <div class="field">
          <label class="field-label" for="fname">First Name</label>
          <div class="field-wrap">
            <input class="field-input" id="fname" type="text" placeholder="John"/>
            <div class="field-icon"><svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg></div>
          </div>
          <div class="field-error" id="fname-err">Required.</div>
        </div>
        <div class="field">
          <label class="field-label" for="lname">Last Name</label>
          <div class="field-wrap">
            <input class="field-input" id="lname" type="text" placeholder="Doe"/>
            <div class="field-icon"><svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg></div>
          </div>
          <div class="field-error" id="lname-err">Required.</div>
        </div>
      </div>

      <!-- Email -->
      <div class="field">
        <label class="field-label" for="email">Email Address</label>
        <div class="field-wrap">
          <input class="field-input" id="email" type="email" placeholder="you@example.com" oninput="validateEmailLive(this)"/>
          <div class="field-icon" id="email-icon"><svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg></div>
        </div>
        <div class="field-error" id="email-err">Please enter a valid email address.</div>
      </div>

      <!-- Password -->
      <div class="field">
        <label class="field-label" for="password">Password</label>
        <div class="field-wrap">
          <input class="field-input" id="password" type="password" placeholder="Minimum 8 characters" oninput="checkStrength(this.value)"/>
          <button class="field-toggle" onclick="togglePw('password')" type="button">
            <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
          </button>
        </div>
        <div class="pw-strength">
          <div class="pw-strength-bar">
            <div class="pw-seg" id="s1"></div>
            <div class="pw-seg" id="s2"></div>
            <div class="pw-seg" id="s3"></div>
            <div class="pw-seg" id="s4"></div>
          </div>
          <div class="pw-strength-label" id="pw-lbl">Enter a password</div>
        </div>
        <div class="field-error" id="pw-err">Password must be at least 8 characters.</div>
      </div>

      <!-- Confirm Password -->
      <div class="field">
        <label class="field-label" for="confirm">Confirm Password</label>
        <div class="field-wrap">
          <input class="field-input" id="confirm" type="password" placeholder="Re-enter password" oninput="checkMatch()"/>
          <button class="field-toggle" onclick="togglePw('confirm')" type="button">
            <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
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
            <div class="plan-price">$4.99 / month</div>
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

  <!-- BRAND PANEL -->
  <div class="brand-panel">
    <div class="bp-tag">Join 500K+ Users</div>
    <h1 class="bp-h1">
      <span class="out">YOUR</span><br>
      <span class="yel">PRIVACY</span><br>
      STARTS<br>HERE
    </h1>
    <p class="bp-desc">Create your free account and get access to unlimited burner addresses, custom domains, full inbox history, and API access.</p>

    <div class="feat-list">
      <div class="feat-row">
        <div class="feat-row-icon"><svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="#FACC15" stroke-width="2"><path stroke-linecap="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg></div>
        <div class="feat-row-body">
          <div class="feat-row-t">Unlimited Burner Addresses</div>
          <div class="feat-row-d">Generate as many as you need, whenever you need them. No daily cap on free plan.</div>
        </div>
      </div>
      <div class="feat-row">
        <div class="feat-row-icon"><svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="#FACC15" stroke-width="2"><path stroke-linecap="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg></div>
        <div class="feat-row-body">
          <div class="feat-row-t">Dashboard & History</div>
          <div class="feat-row-d">Track all your addresses, see incoming mail, manage expiry — all from one clean dashboard.</div>
        </div>
      </div>
      <div class="feat-row">
        <div class="feat-row-icon"><svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="#FACC15" stroke-width="2"><path stroke-linecap="round" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/></svg></div>
        <div class="feat-row-body">
          <div class="feat-row-t">API Access (Pro)</div>
          <div class="feat-row-d">Integrate DROPIT into your apps and workflows. Full REST API with webhooks.</div>
        </div>
      </div>
    </div>

    <div class="trust-row">
      <div class="trust-avatars">
        <div class="t-av" style="background:#4285F4;">A</div>
        <div class="t-av" style="background:#22c55e;">M</div>
        <div class="t-av" style="background:#7c3aed;">S</div>
        <div class="t-av" style="background:#dc2626;">R</div>
        <div class="t-av" style="background:var(--Y);color:var(--INK);">K</div>
      </div>
      <span>500,000+ accounts created this month</span>
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
const cur=document.getElementById('cur');
document.addEventListener('mousemove',e=>{cur.style.left=e.clientX+'px';cur.style.top=e.clientY+'px';});
document.querySelectorAll('a,button,input,label').forEach(el=>{
  el.addEventListener('mouseenter',()=>cur.classList.add('big'));
  el.addEventListener('mouseleave',()=>cur.classList.remove('big'));
});

function togglePw(id){const i=document.getElementById(id);i.type=i.type==='password'?'text':'password';}

function validateEmailLive(inp){
  const valid=/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(inp.value);
  if(inp.value&&valid){inp.className='field-input ok';document.getElementById('email-err').classList.remove('show');}
  else if(inp.value&&!valid){inp.className='field-input error';document.getElementById('email-err').classList.add('show');}
  else{inp.className='field-input';document.getElementById('email-err').classList.remove('show');}
}

function checkStrength(pw){
  let score=0;
  if(pw.length>=8) score++;
  if(/[A-Z]/.test(pw)) score++;
  if(/[0-9]/.test(pw)) score++;
  if(/[^A-Za-z0-9]/.test(pw)) score++;
  const segs=['s1','s2','s3','s4'];
  const cls=['','weak','fair','good','good'];
  const lbl=['Enter a password','Too weak','Could be stronger','Almost there!','Strong password ✓'];
  const colors=['','#dc2626','#f59e0b','#22c55e','#22c55e'];
  segs.forEach((id,i)=>{
    const el=document.getElementById(id);
    el.style.background=i<score?colors[score]:''||'#E5E7EB';
  });
  const lbEl=document.getElementById('pw-lbl');
  lbEl.textContent=lbl[score]||lbl[0];
  lbEl.style.color=colors[score]||'#9CA3AF';
}

function checkMatch(){
  const pw=document.getElementById('password').value;
  const c=document.getElementById('confirm');
  if(c.value&&c.value!==pw){c.className='field-input error';document.getElementById('confirm-err').classList.add('show');}
  else{c.className=c.value?'field-input ok':'field-input';document.getElementById('confirm-err').classList.remove('show');}
}

function selectPlan(p){
  document.getElementById('plan-free').classList.toggle('selected',p==='free');
  document.getElementById('plan-pro').classList.toggle('selected',p==='pro');
}

function socialReg(provider){
  setTimeout(()=>{document.getElementById('success').classList.add('show');setTimeout(()=>window.location.href='dashboard.html',1400);},800);
}

function required(id,errId){
  const v=document.getElementById(id).value.trim();
  if(!v){document.getElementById(id).classList.add('error');document.getElementById(errId).classList.add('show');return false;}
  document.getElementById(id).classList.remove('error');document.getElementById(errId).classList.remove('show');return true;
}

function handleRegister(){
  let ok=true;
  if(!required('fname','fname-err')) ok=false;
  if(!required('lname','lname-err')) ok=false;
  const email=document.getElementById('email').value;
  if(!email||!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)){
    document.getElementById('email').className='field-input error';
    document.getElementById('email-err').classList.add('show');ok=false;
  }
  const pw=document.getElementById('password').value;
  if(pw.length<8){document.getElementById('password').classList.add('error');document.getElementById('pw-err').classList.add('show');ok=false;}
  else{document.getElementById('password').classList.remove('error');document.getElementById('pw-err').classList.remove('show');}
  if(document.getElementById('confirm').value!==pw){
    document.getElementById('confirm').classList.add('error');document.getElementById('confirm-err').classList.add('show');ok=false;
  }
  if(!document.getElementById('terms').checked){alert('Please accept the Terms of Service to continue.');ok=false;}
  if(!ok) return;

  const btn=document.getElementById('reg-btn');
  btn.classList.add('loading');
  document.getElementById('btn-txt').textContent='CREATING ACCOUNT…';
  setTimeout(()=>{
    document.getElementById('success').classList.add('show');
    setTimeout(()=>window.location.href='dashboard.html',1400);
  },1200);
}

document.addEventListener('keydown',e=>{if(e.key==='Enter') handleRegister();});
</script>
</body>
</html>