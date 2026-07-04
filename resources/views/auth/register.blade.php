<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>InboxOro — Create Account</title>
<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Outfit:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;500;700&display=swap" rel="stylesheet"/>
<style>
:root{--Y:#FACC15;--B:#3B82F6;--INK:#111827;--BG:#F9FAFB;--SURF:#FFFFFF;--BD:#E5E7EB;--BD2:#F3F4F6;--MU:#6B7280;--MU2:#9CA3AF;--GREEN:#10B981;--RED:#EF4444;}
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0;}
html{scroll-behavior:smooth;}
body{font-family:'Outfit',sans-serif;color:#111827;background:#F9FAFB;min-height:100vh;display:flex;flex-direction:column;overflow-x:clip;}
a{text-decoration:none;color:inherit;}
button{font-family:'Outfit',sans-serif;cursor:pointer;border:none;background:none;}

.topbar{height:56px;background:#111827;border-bottom:1px solid rgba(255,255,255,.08);display:flex;align-items:center;justify-content:space-between;padding:0 20px;flex-shrink:0;overflow-x:auto;}
.topbar-logo{display:flex;align-items:center;gap:8px;flex-shrink:0;}
.topbar-logo-img{height:30px;width:auto;display:block;}
.logo-text{font-family:'Bebas Neue',sans-serif;font-size:1.3rem;color:#fff;letter-spacing:.04em;white-space:nowrap;}
.logo-text .y{color:#FACC15;}
.topbar-right{display:flex;align-items:center;gap:6px;flex-shrink:0;}
.top-link{font-size:.75rem;font-weight:500;color:#9CA3AF;transition:color .15s;white-space:nowrap;padding:4px 6px;}
.top-link:hover{color:#fff;}
.top-btn{background:#FACC15;color:#111827;font-size:.75rem;font-weight:700;padding:6px 14px;border-radius:7px;transition:background .15s,transform .1s;white-space:nowrap;}
.top-btn:hover{background:#EAB800;transform:translateY(-1px);}

.page{flex:1;display:grid;grid-template-columns:1fr;}

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

.bp-feat-list{display:flex;flex-direction:column;gap:12px;}
.bp-feat{display:flex;align-items:flex-start;gap:12px;padding:12px;border:1px solid rgba(255,255,255,.07);border-radius:8px;transition:background .15s;}
.bp-feat:hover{background:rgba(255,255,255,.04);}
.bp-feat-icon{width:30px;height:30px;background:rgba(250,204,21,.12);border:1px solid rgba(250,204,21,.2);border-radius:7px;display:flex;align-items:center;justify-content:center;flex-shrink:0;}
.bp-feat-t{font-family:'Bebas Neue',sans-serif;font-size:.9rem;letter-spacing:.03em;color:#fff;margin-bottom:1px;}
.bp-feat-d{font-size:.7rem;color:#6B7280;line-height:1.4;}

.trust-row{display:flex;align-items:center;gap:8px;margin-top:24px;padding-top:16px;border-top:1px solid rgba(255,255,255,.07);}
.trust-row span{font-size:.7rem;color:#6B7280;}
.trust-avs{display:flex;}
.t-av{width:24px;height:24px;border-radius:50%;border:2px solid #111827;margin-right:-7px;display:flex;align-items:center;justify-content:center;font-family:'Bebas Neue',sans-serif;font-size:.7rem;color:#fff;}

.form-panel{display:flex;flex-direction:column;justify-content:center;align-items:center;padding:40px 20px 56px;background:#fff;}
.form-wrap{width:100%;max-width:400px;}
.form-eyebrow{font-family:'JetBrains Mono',monospace;font-size:.6rem;font-weight:700;letter-spacing:.12em;text-transform:uppercase;color:#6B7280;margin-bottom:8px;display:flex;align-items:center;gap:8px;}
.form-eyebrow::before{content:'';width:18px;height:2px;background:#FACC15;display:inline-block;border-radius:1px;}
.form-title{font-family:'Bebas Neue',sans-serif;font-size:2.2rem;letter-spacing:.03em;color:#111827;line-height:1;margin-bottom:6px;}
.form-sub{font-size:.84rem;color:#6B7280;margin-bottom:28px;}
.form-sub a{color:#3B82F6;font-weight:600;}
.form-sub a:hover{text-decoration:underline;}

.social-row{display:grid;grid-template-columns:1fr 1fr;gap:10px;margin-bottom:20px;}
.btn-social{display:flex;align-items:center;justify-content:center;gap:8px;padding:10px 14px;border:1px solid #E5E7EB;border-radius:8px;background:#fff;font-size:.82rem;font-weight:500;color:#111827;transition:background .12s,border-color .12s;text-decoration:none;}
.btn-social:hover{background:#F3F4F6;border-color:#D1D5DB;}

.or-row{display:flex;align-items:center;gap:12px;margin:20px 0;color:#9CA3AF;font-size:.74rem;font-family:'JetBrains Mono',monospace;font-weight:600;letter-spacing:.06em;}
.or-row::before,.or-row::after{content:'';flex:1;height:1px;background:#E5E7EB;}

.field{margin-bottom:16px;}
.field-label{display:block;font-family:'JetBrains Mono',monospace;font-size:.62rem;font-weight:700;letter-spacing:.08em;text-transform:uppercase;color:#6B7280;margin-bottom:6px;}
.field-wrap{position:relative;}
.field-input{width:100%;padding:11px 40px 11px 14px;border:1px solid #E5E7EB;border-radius:8px;background:#fff;font-family:'Outfit',sans-serif;font-size:16px;color:#111827;outline:none;transition:border-color .15s,box-shadow .15s;}
.field-input::placeholder{color:#9CA3AF;}
.field-input:focus{border-color:#FACC15;box-shadow:0 0 0 3px rgba(250,204,21,.15);}
.field-input.is-invalid{border-color:#EF4444;box-shadow:0 0 0 3px rgba(239,68,68,.1);}
.field-icon{position:absolute;right:12px;top:50%;transform:translateY(-50%);color:#9CA3AF;pointer-events:none;display:flex;}
.field-toggle{position:absolute;right:12px;top:50%;transform:translateY(-50%);color:#9CA3AF;display:flex;padding:4px;transition:color .15s;cursor:pointer;background:none;border:none;}
.field-toggle:hover{color:#111827;}
.field-err{font-size:.68rem;color:#EF4444;font-family:'JetBrains Mono',monospace;font-weight:600;margin-top:4px;display:none;}
.field-err.show{display:block;}

.pw-strength{margin-top:6px;}
.pw-bar{display:flex;gap:4px;margin-bottom:3px;}
.pw-seg{height:3px;flex:1;background:#E5E7EB;border-radius:2px;transition:background .3s;}
.pw-lbl{font-size:.66rem;font-family:'JetBrains Mono',monospace;color:#9CA3AF;font-weight:600;}

.check-row{display:flex;align-items:flex-start;gap:10px;margin-bottom:20px;}
.check-row input[type=checkbox]{width:17px;height:17px;border:1.5px solid #E5E7EB;border-radius:5px;appearance:none;background:#fff;position:relative;cursor:pointer;transition:background .12s,border-color .12s;flex-shrink:0;margin-top:2px;}
.check-row input[type=checkbox]:checked{background:#FACC15;border-color:#FACC15;}
.check-row input[type=checkbox]:checked::after{content:'✓';position:absolute;font-size:.65rem;font-weight:900;color:#111827;top:50%;left:50%;transform:translate(-50%,-50%);}
.check-row label{font-size:.78rem;color:#6B7280;line-height:1.5;cursor:pointer;}
.check-row label a{color:#3B82F6;font-weight:500;}
.check-row label a:hover{text-decoration:underline;}

.btn-submit{width:100%;padding:13px;background:#111827;color:#fff;font-size:.9rem;font-weight:700;border-radius:8px;letter-spacing:.02em;transition:box-shadow .15s,transform .1s;position:relative;overflow:hidden;cursor:pointer;}
.btn-submit::before{content:'';position:absolute;top:0;left:0;right:0;height:2px;background:#FACC15;}
.btn-submit:hover{box-shadow:0 4px 16px rgba(17,24,39,.25);transform:translateY(-1px);}
.btn-submit:active{transform:translateY(0);box-shadow:none;}
.btn-submit.loading{background:#E5E7EB;color:#6B7280;pointer-events:none;}

.page-footer{background:#111827;border-top:1px solid rgba(255,255,255,.08);padding:14px 20px;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:10px;}
.foot-logo-img{height:22px;width:auto;display:block;}
.foot-logo-text{font-family:'Bebas Neue',sans-serif;font-size:1rem;color:#FACC15;}
.foot-logo-text span{color:#fff;}
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

<div class="topbar">
  <a href="/" class="topbar-logo">
    <img src="{{asset('/images/logo.png')}}" alt="InboxOro" class="topbar-logo-img"
         onerror="this.style.display='none';this.nextElementSibling.style.display='block'"/>
    <span class="logo-text" style="display:none;">Inbox<span class="y">Oro</span></span>
  </a>
  <div class="topbar-right">
    <a class="top-link" href="/">Home</a>
    <a class="top-link" href="/blog">Blog</a>
    <a class="top-link" href="/api">API</a>
    <a class="top-link" href="/about">About</a>
    <a class="top-link" href="/contact">Contact</a>
    <a class="top-btn" href="{{ route('login') }}">Sign In →</a>
  </div>
</div>

<div class="page">
  <div class="form-panel">
    <div class="form-wrap">
      <div class="form-eyebrow">New Account</div>
      <div class="form-title">CREATE ACCOUNT</div>
      <p class="form-sub">Already have one? <a href="{{ route('login') }}">Sign in →</a></p>

      <div class="social-row">
        <a class="btn-social" href="{{ route('auth.redirect', 'google') }}">
          <svg width="16" height="16" viewBox="0 0 24 24"><path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/><path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/><path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/><path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/></svg>Google
        </a>
        <a class="btn-social" href="{{ route('auth.redirect', 'github') }}">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="#111827"><path d="M12 0C5.37 0 0 5.37 0 12c0 5.31 3.435 9.795 8.205 11.385.6.105.825-.255.825-.57 0-.285-.015-1.23-.015-2.235-3.015.555-3.795-.735-4.035-1.41-.135-.345-.72-1.41-1.23-1.695-.42-.225-1.02-.78-.015-.795.945-.015 1.62.87 1.845 1.23 1.08 1.815 2.805 1.305 3.495.99.105-.78.42-1.305.765-1.605-2.67-.3-5.46-1.335-5.46-5.925 0-1.305.465-2.385 1.23-3.225-.12-.3-.54-1.53.12-3.18 0 0 1.005-.315 3.3 1.23.96-.27 1.98-.405 3-.405s2.04.135 3 .405c2.295-1.56 3.3-1.23 3.3-1.23.66 1.65.24 2.88.12 3.18.765.84 1.23 1.905 1.23 3.225 0 4.605-2.805 5.625-5.475 5.925.435.375.81 1.095.81 2.22 0 1.605-.015 2.895-.015 3.3 0 .315.225.69.825.57A12.02 12.02 0 0024 12c0-6.63-5.37-12-12-12z"/></svg>GitHub
        </a>
      </div>

      <div class="or-row">OR FILL IN YOUR DETAILS</div>

      <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="field">
          <label class="field-label" for="name">Name</label>
          <div class="field-wrap">
            <input class="field-input @error('name') is-invalid @enderror" id="name" type="text" name="name" value="{{ old('name') }}" placeholder="John Doe" autocomplete="name" autofocus />
          </div>
          @error('name')
            <div class="field-err show">{{ $message }}</div>
          @enderror
        </div>

        <div class="field">
          <label class="field-label" for="email">Email Address</label>
          <div class="field-wrap">
            <input class="field-input @error('email') is-invalid @enderror" id="email" type="email" name="email" value="{{ old('email') }}" placeholder="you@example.com" autocomplete="username" />
            <div class="field-icon"><svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg></div>
          </div>
          @error('email')
            <div class="field-err show">{{ $message }}</div>
          @enderror
        </div>

        <div class="field">
          <label class="field-label" for="password">Password</label>
          <div class="field-wrap">
            <input class="field-input @error('password') is-invalid @enderror" id="password" type="password" name="password" placeholder="Min. 8 characters" autocomplete="new-password" oninput="checkStrength(this.value)" />
            <button class="field-toggle" type="button" onclick="togglePw('password')" aria-label="Toggle password visibility">
              <svg class="eye-icon" width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
              <svg class="eye-off-icon" width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="display:none"><path stroke-linecap="round" d="M17.94 17.94A10.07 10.07 0 0112 20c-7 0-11-8-11-8a18.45 18.45 0 015.06-5.94M9.9 4.24A9.12 9.12 0 0112 4c7 0 11 8 11 8a18.5 18.5 0 01-2.16 3.19m-6.72-1.07a3 3 0 11-4.24-4.24"/><path stroke-linecap="round" d="M1 1l22 22"/></svg>
            </button>
          </div>
          @error('password')
            <div class="field-err show">{{ $message }}</div>
          @enderror
          <div class="pw-strength">
            <div class="pw-bar">
              <div class="pw-seg" id="s1"></div>
              <div class="pw-seg" id="s2"></div>
              <div class="pw-seg" id="s3"></div>
              <div class="pw-seg" id="s4"></div>
            </div>
            <div id="pw-lbl" class="pw-lbl">Enter a password</div>
          </div>
        </div>

        <div class="field">
          <label class="field-label" for="password_confirmation">Confirm Password</label>
          <div class="field-wrap">
            <input class="field-input @error('password_confirmation') is-invalid @enderror" id="password_confirmation" type="password" name="password_confirmation" placeholder="Re-enter password" autocomplete="new-password" oninput="checkMatch()" />
            <button class="field-toggle" type="button" onclick="togglePw('password_confirmation')" aria-label="Toggle password visibility">
              <svg class="eye-icon" width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
              <svg class="eye-off-icon" width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="display:none"><path stroke-linecap="round" d="M17.94 17.94A10.07 10.07 0 0112 20c-7 0-11-8-11-8a18.45 18.45 0 015.06-5.94M9.9 4.24A9.12 9.12 0 0112 4c7 0 11 8 11 8a18.5 18.5 0 01-2.16 3.19m-6.72-1.07a3 3 0 11-4.24-4.24"/><path stroke-linecap="round" d="M1 1l22 22"/></svg>
            </button>
          </div>
          @error('password_confirmation')
            <div class="field-err show">{{ $message }}</div>
          @enderror
        </div>

        <div class="check-row">
          <input type="checkbox" id="terms" name="terms" required />
          <label for="terms">I agree to the <a href="/terms">Terms of Service</a> and <a href="/privacy-policy">Privacy Policy</a>. I understand emails are temporary and auto-deleted.</label>
        </div>

        <button class="btn-submit" id="reg-btn" type="submit">
          <span id="btn-txt">Create My Account</span>
        </button>
      </form>
    </div>
  </div>

  <div class="brand-panel">
    <div class="blob blob-y"></div>
    <div class="blob blob-b"></div>
    <div class="bp-eyebrow">Join 500K+ Users</div>
    <h1 class="bp-h1"><span class="out">YOUR</span><br><span class="y">PRIVACY</span><br>STARTS<br>HERE</h1>
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
</div>

<footer class="page-footer">
  <a href="/">
    <img src="{{asset('/images/logo.png')}}" alt="InboxOro" class="foot-logo-img"
         onerror="this.style.display='none';this.nextElementSibling.style.display='block'"/>
    <span class="foot-logo-text" style="display:none;">Inbox<span>Oro</span></span>
  </a>
  <div class="foot-links">
    <a href="/">Home</a>
    <a href="/blog">Blog</a>
    <a href="/api">API</a>
    <a href="/about">About</a>
    <a href="/contact">Contact</a>
    <a href="/privacy-policy">Privacy</a>
    <a href="/terms">Terms</a>
  </div>
</footer>

<script>
function togglePw(id) {
  const inp = document.getElementById(id);
  const btn = inp.parentElement.querySelector('.field-toggle');
  const eye = btn.querySelector('.eye-icon');
  const eyeOff = btn.querySelector('.eye-off-icon');
  const isHidden = inp.type === 'password';
  inp.type = isHidden ? 'text' : 'password';
  eye.style.display = isHidden ? 'none' : '';
  eyeOff.style.display = isHidden ? '' : 'none';
}

function checkStrength(pw) {
  let s = 0;
  if (pw.length >= 8) s++;
  if (/[A-Z]/.test(pw)) s++;
  if (/[0-9]/.test(pw)) s++;
  if (/[^A-Za-z0-9]/.test(pw)) s++;
  const colors = ['', '#dc2626', '#f59e0b', '#22c55e', '#22c55e'];
  const labels = ['Enter a password', 'Too weak', 'Could be stronger', 'Almost there!', 'Strong \u2713'];
  ['s1','s2','s3','s4'].forEach((id, i) => {
    document.getElementById(id).style.background = i < s ? colors[s] : '#E5E7EB';
  });
  const l = document.getElementById('pw-lbl');
  l.textContent = labels[s] || labels[0];
  l.style.color = colors[s] || '#9CA3AF';
}

function checkMatch() {
  const pw = document.getElementById('password').value;
  const c = document.getElementById('password_confirmation');
  if (c.value && c.value !== pw) {
    c.classList.add('is-invalid');
  } else {
    c.classList.remove('is-invalid');
  }
}
</script>
</body>
</html>
