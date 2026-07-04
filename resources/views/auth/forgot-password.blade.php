<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>InboxOro — Reset Password</title>
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
.bp-stats{display:flex;gap:20px;flex-wrap:wrap;margin-bottom:36px;}
.bp-stat{border:1px solid rgba(255,255,255,.1);border-radius:10px;padding:14px 18px;}
.bp-stat-n{font-family:'Bebas Neue',sans-serif;font-size:1.7rem;color:#FACC15;line-height:1;}
.bp-stat-l{font-size:.7rem;color:#6B7280;margin-top:2px;}
.bp-pills{display:flex;flex-wrap:wrap;gap:8px;}
.bp-pill{display:flex;align-items:center;gap:6px;background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.1);border-radius:8px;padding:7px 12px;font-size:.74rem;color:#9CA3AF;}
.bp-pill svg{color:#FACC15;}

.form-panel{display:flex;flex-direction:column;justify-content:center;align-items:center;padding:40px 20px 56px;background:#fff;}
.form-wrap{width:100%;max-width:400px;}
.form-eyebrow{font-family:'JetBrains Mono',monospace;font-size:.6rem;font-weight:700;letter-spacing:.12em;text-transform:uppercase;color:#6B7280;margin-bottom:8px;display:flex;align-items:center;gap:8px;}
.form-eyebrow::before{content:'';width:18px;height:2px;background:#FACC15;display:inline-block;border-radius:1px;}
.form-title{font-family:'Bebas Neue',sans-serif;font-size:2.2rem;letter-spacing:.03em;color:#111827;line-height:1;margin-bottom:6px;}
.form-sub{font-size:.84rem;color:#6B7280;margin-bottom:28px;}
.form-sub a{color:#3B82F6;font-weight:600;}
.form-sub a:hover{text-decoration:underline;}

.field{margin-bottom:16px;}
.field-label{display:block;font-family:'JetBrains Mono',monospace;font-size:.62rem;font-weight:700;letter-spacing:.08em;text-transform:uppercase;color:#6B7280;margin-bottom:6px;}
.field-wrap{position:relative;}
.field-input{width:100%;padding:11px 14px;border:1px solid #E5E7EB;border-radius:8px;background:#fff;font-family:'Outfit',sans-serif;font-size:16px;color:#111827;outline:none;transition:border-color .15s,box-shadow .15s;}
.field-input::placeholder{color:#9CA3AF;}
.field-input:focus{border-color:#FACC15;box-shadow:0 0 0 3px rgba(250,204,21,.15);}
.field-input.is-invalid{border-color:#EF4444;box-shadow:0 0 0 3px rgba(239,68,68,.1);}
.field-err{font-size:.68rem;color:#EF4444;font-family:'JetBrains Mono',monospace;font-weight:600;margin-top:4px;display:none;}
.field-err.show{display:block;}

.session-status{display:flex;align-items:center;gap:8px;padding:10px 14px;background:#F0FDF4;border:1px solid #BBF7D0;border-radius:8px;font-size:.78rem;color:#166534;margin-bottom:20px;}

.btn-submit{width:100%;padding:13px;background:#111827;color:#fff;font-size:.9rem;font-weight:700;border-radius:8px;letter-spacing:.02em;transition:box-shadow .15s,transform .1s;position:relative;overflow:hidden;cursor:pointer;}
.btn-submit::before{content:'';position:absolute;top:0;left:0;right:0;height:2px;background:#FACC15;}
.btn-submit:hover{box-shadow:0 4px 16px rgba(17,24,39,.25);transform:translateY(-1px);}
.btn-submit:active{transform:translateY(0);box-shadow:none;}
.legal{margin-top:18px;text-align:center;font-size:.72rem;color:#9CA3AF;line-height:1.5;}
.legal a{color:#3B82F6;font-weight:500;}

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
  <div class="brand-panel">
    <div class="blob blob-y"></div>
    <div class="blob blob-b"></div>
    <div class="bp-eyebrow">Secure Access</div>
    <h1 class="bp-h1"><span class="out">FORGOT</span><br><span class="y">YOUR</span><br>PASSWORD?</h1>
    <p class="bp-desc">No worries. Enter your email and we will send you a reset link to get back into your account.</p>
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
      <div class="form-eyebrow">Password Reset</div>
      <div class="form-title">RESET PASSWORD</div>
      <p class="form-sub">Remember it? <a href="{{ route('login') }}">Sign in →</a></p>

      @if (session('status'))
        <div class="session-status">
          <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="#166534" stroke-width="2.5"><path stroke-linecap="round" d="M5 13l4 4L19 7"/></svg>
          {{ session('status') }}
        </div>
      @endif

      <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="field">
          <label class="field-label" for="email">Email Address</label>
          <div class="field-wrap">
            <input class="field-input @error('email') is-invalid @enderror" id="email" type="email" name="email" value="{{ old('email') }}" placeholder="you@example.com" autocomplete="email" autofocus />
          </div>
          @error('email')
            <div class="field-err show">{{ $message }}</div>
          @enderror
        </div>

        <button class="btn-submit" type="submit">
          Send Reset Link
        </button>
      </form>

      <div class="legal">By signing in you agree to our <a href="/privacy-policy">Privacy Policy</a> and <a href="/terms">Terms of Service</a>.</div>
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

</body>
</html>
