@extends('layouts.authLayout')

@section('title', 'InboxOro — Dashboard')

@section('content')
<!-- Page header -->
<div class="page-hd">
  <div>
    <div class="page-title">Dashboard</div>
    <div class="page-subtitle">Welcome back, John · Sunday Apr 26 2026</div>
  </div>
  <div style="display:flex;gap:8px;align-items:center;flex-wrap:wrap;">
    <button class="btn-ghost" onclick="refreshPage()">
      <svg id="refresh-ic" width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
      Refresh
    </button>
    <button class="btn-primary yellow" onclick="generateNew()">
      <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M12 4v16m8-8H4"/></svg>
      New Address
    </button>
  </div>
</div>

<!-- Stat cards -->
<div class="stat-grid">
  <div class="stat-card">
    <div class="stat-card-top">
      <div class="stat-icon-wrap yellow">
        <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/></svg>
      </div>
      <div class="stat-trend up">↑ 12%</div>
    </div>
    <div class="stat-value">47</div>
    <div class="stat-label">Total Addresses</div>
  </div>
  <div class="stat-card">
    <div class="stat-card-top">
      <div class="stat-icon-wrap blue">
        <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
      </div>
      <div class="stat-trend up">↑ 8%</div>
    </div>
    <div class="stat-value">238</div>
    <div class="stat-label">Emails Received</div>
  </div>
  <div class="stat-card">
    <div class="stat-card-top">
      <div class="stat-icon-wrap green">
        <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path stroke-linecap="round" d="M12 8v4l3 3"/></svg>
      </div>
      <div class="live-tag"><div class="live-dot"></div>Live</div>
    </div>
    <div class="stat-value">3</div>
    <div class="stat-label">Active Now</div>
  </div>
  <div class="stat-card">
    <div class="stat-card-top">
      <div class="stat-icon-wrap red">
        <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
      </div>
      <div class="stat-trend down" style="background:rgba(239,68,68,.08);color:var(--RED);">↑ 34%</div>
    </div>
    <div class="stat-value">1.2K</div>
    <div class="stat-label">Spam Blocked</div>
  </div>
</div>

<!-- Generator card -->
<div class="gen-card">
  <div class="gen-card-hd">
    <div class="gen-card-title">Quick Generate</div>
    <div class="live-tag"><div class="live-dot"></div>Active</div>
  </div>
  <div class="gen-card-body">
    <div class="dom-tabs" id="dom-tabs"></div>
    <div class="email-display">
      <div class="email-txt" id="gen-email">Generating…</div>
      <button class="copy-btn" id="copy-btn" onclick="copyEmail()">Copy</button>
      <button class="new-btn" onclick="generateNew()">
        <svg id="spin-ic" width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
        New
      </button>
    </div>
    <div class="timer-row">
      <span class="timer-lbl">Expires</span>
      <div class="timer-track"><div class="timer-fill" id="tbar"></div></div>
      <span class="timer-count" id="tnum">10:00</span>
    </div>
  </div>
</div>

<!-- Bottom grid -->
<div class="bottom-grid">
  <div class="panel">
    <div class="panel-hd">
      <span class="panel-title">Your Addresses</span>
      <span class="panel-meta">47 total · 3 active</span>
    </div>
    <div class="tab-row">
      <button class="tab-btn active" onclick="filterAddrs(this,'all')">All</button>
      <button class="tab-btn" onclick="filterAddrs(this,'active')">Active</button>
      <button class="tab-btn" onclick="filterAddrs(this,'expired')">Expired</button>
    </div>
    <div id="addr-list"></div>
  </div>

  <div style="display:flex;flex-direction:column;gap:16px;">
    <div class="panel">
      <div class="panel-hd">
        <span class="panel-title">This Week</span>
        <div style="display:flex;gap:10px;">
          <span style="display:flex;align-items:center;gap:4px;font-size:.68rem;color:var(--MU);"><span style="display:inline-block;width:8px;height:8px;border-radius:50%;background:var(--Y);"></span>Received</span>
          <span style="display:flex;align-items:center;gap:4px;font-size:.68rem;color:var(--MU);"><span style="display:inline-block;width:8px;height:8px;border-radius:50%;background:var(--B);"></span>Read</span>
        </div>
      </div>
      <div class="chart-bars" id="chart"></div>
      <div class="chart-labels" id="chart-x"></div>
    </div>

    <div class="panel" style="flex:1;">
      <div class="panel-hd">
        <span class="panel-title">Recent Activity</span>
        <span class="panel-meta">Last 24h</span>
      </div>
      <div id="activity"></div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
/* ════════════════════════════
   GENERATOR
════════════════════════════ */
const DOMS = ['dropit.io', 'burnbox.dev', 'zaptmp.net', 'voidmail.cc', 'mailsink.app'];
const ADJ  = ['silent','ghost','turbo','vapor','swift','lunar','neon','flux','rogue','stealth'];
const NOU  = ['fox','wolf','tide','bolt','hawk','mint','storm','byte','nova','apex'];
let curDom = DOMS[0], curEmail = '', secs = 600, timerInt;

function renderDoms() {
  const c = document.getElementById('dom-tabs');
  DOMS.forEach((d, i) => {
    const b = document.createElement('button');
    b.className = 'dom-tab' + (i === 0 ? ' active' : '');
    b.textContent = '@' + d;
    b.onclick = () => {
      document.querySelectorAll('.dom-tab').forEach(x => x.classList.remove('active'));
      b.classList.add('active');
      curDom = d;
      generateNew();
    };
    c.appendChild(b);
  });
}

function generateNew() {
  const a = ADJ[Math.floor(Math.random() * ADJ.length)];
  const n = NOU[Math.floor(Math.random() * NOU.length)];
  const num = Math.floor(Math.random() * 9000) + 1000;
  curEmail = `${a}.${n}${num}@${curDom}`;
  const el = document.getElementById('gen-email');
  el.classList.add('fade');
  setTimeout(() => { el.textContent = curEmail; el.classList.remove('fade'); }, 220);
  secs = 600;
  const bar = document.getElementById('tbar');
  bar.style.animation = 'none'; void bar.offsetWidth;
  bar.style.animation = 'shrink 600s linear forwards';
  const ic = document.getElementById('spin-ic');
  ic.style.transition = 'transform .4s';
  ic.style.transform = 'rotate(360deg)';
  setTimeout(() => { ic.style.transition = 'none'; ic.style.transform = ''; }, 420);
}

function copyEmail() {
  if (!curEmail) return;
  navigator.clipboard.writeText(curEmail).catch(() => {});
  const btn = document.getElementById('copy-btn');
  btn.classList.add('done'); btn.textContent = 'Copied ✓';
  toast('Email address copied!');
  setTimeout(() => { btn.classList.remove('done'); btn.textContent = 'Copy'; }, 2200);
}

function startTimer() {
  clearInterval(timerInt);
  timerInt = setInterval(() => {
    if (secs > 0) secs--;
    const m = String(Math.floor(secs / 60)).padStart(2, '0');
    const s = String(secs % 60).padStart(2, '0');
    document.getElementById('tnum').textContent = `${m}:${s}`;
  }, 1000);
}

const ADDRS = [
  { email: 'ghost.wolf2847@dropit.io',       msgs: 7,  active: true  },
  { email: 'turbo.tide5512@burnbox.dev',     msgs: 2,  active: true  },
  { email: 'neon.apex3301@voidmail.cc',      msgs: 0,  active: true  },
  { email: 'silent.fox9341@dropit.io',       msgs: 14, active: false },
  { email: 'vapor.storm1192@zaptmp.net',     msgs: 3,  active: false },
  { email: 'lunar.byte4401@mailsink.app',    msgs: 1,  active: false },
];

function renderAddrs(filter = 'all') {
  const c = document.getElementById('addr-list');
  c.innerHTML = '';
  ADDRS
    .filter(a => filter === 'all' || (filter === 'active') === a.active)
    .forEach(a => {
      const row = document.createElement('div');
      row.className = 'addr-row';
      row.innerHTML = `
        <div class="addr-email">${a.email}</div>
        <div class="addr-msgs"><b>${a.msgs}</b> msgs</div>
        <span class="addr-badge ${a.active ? 'active' : 'expired'}">
          ${a.active ? '● Active' : '○ Expired'}
        </span>
        <div class="addr-actions">
          <button class="icon-btn" onclick="copyAddr('${a.email}')" title="Copy">
            <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><rect x="9" y="9" width="13" height="13" rx="2"/><path stroke-linecap="round" d="M5 15H4a2 2 0 01-2-2V4a2 2 0 012-2h9a2 2 0 012 2v1"/></svg>
          </button>
          <button class="icon-btn del" onclick="deleteAddr(this)" title="Delete">
            <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><polyline points="3 6 5 6 21 6"/><path stroke-linecap="round" d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6"/></svg>
          </button>
        </div>`;
      c.appendChild(row);
    });
}

function copyAddr(e) { navigator.clipboard.writeText(e).catch(() => {}); toast('Copied!'); }
function deleteAddr(btn) {
  const row = btn.closest('.addr-row');
  row.style.transition = 'opacity .25s, transform .25s';
  row.style.opacity = '0'; row.style.transform = 'translateX(12px)';
  setTimeout(() => row.remove(), 260);
  toast('Address deleted.');
}

function filterAddrs(el, f) {
  document.querySelectorAll('.tab-btn').forEach(t => t.classList.remove('active'));
  el.classList.add('active');
  renderAddrs(f);
}

const DAYS = ['Mon','Tue','Wed','Thu','Fri','Sat','Sun'];
const REC  = [18,32,14,45,28,52,39];
const READ = [12,24,10,38,20,44,31];

function renderChart() {
  const c = document.getElementById('chart');
  const x = document.getElementById('chart-x');
  const mx = Math.max(...REC);
  DAYS.forEach((d, i) => {
    const g = document.createElement('div'); g.className = 'bar-g';
    const b1 = document.createElement('div');
    b1.className = 'bar';
    b1.style.cssText = `height:${Math.round(REC[i]/mx*100)}%;background:var(--Y);`;
    b1.title = `${d}: ${REC[i]} received`;
    const b2 = document.createElement('div');
    b2.className = 'bar';
    b2.style.cssText = `height:${Math.round(READ[i]/mx*100)}%;background:var(--B);opacity:.7;`;
    b2.title = `${d}: ${READ[i]} read`;
    g.appendChild(b1); g.appendChild(b2); c.appendChild(g);
    const lbl = document.createElement('div'); lbl.className = 'chart-lbl'; lbl.textContent = d;
    x.appendChild(lbl);
  });
}

const ACTS = [
  { color:'y', msg:'New email from <strong>Google</strong> on ghost.wolf2847@dropit.io', time:'2 min ago' },
  { color:'g', msg:'Generated new address <strong>ghost.wolf2847@dropit.io</strong>',   time:'5 min ago' },
  { color:'y', msg:'OTP received from <strong>Shopify</strong> — code: 847291',          time:'12 min ago' },
  { color:'r', msg:'Address <strong>silent.fox9341@dropit.io</strong> expired',          time:'18 min ago' },
  { color:'b', msg:'Verification confirmed from <strong>Notion</strong>',                time:'35 min ago' },
  { color:'g', msg:'Generated <strong>turbo.tide5512@burnbox.dev</strong>',              time:'1 hr ago' },
];

function renderActivity() {
  const c = document.getElementById('activity');
  ACTS.forEach(a => {
    const item = document.createElement('div'); item.className = 'activity-item';
    item.innerHTML = `<div class="act-dot ${a.color}"></div><div class="act-body"><div class="act-msg">${a.msg}</div><div class="act-time">${a.time}</div></div>`;
    c.appendChild(item);
  });
}

function refreshPage() {
  const ic = document.getElementById('refresh-ic');
  ic.style.transition = 'transform .5s';
  ic.style.transform = 'rotate(360deg)';
  setTimeout(() => { ic.style.transition = 'none'; ic.style.transform = ''; }, 520);
  toast('Dashboard refreshed!');
}

renderDoms();
generateNew();
startTimer();
renderAddrs();
renderChart();
renderActivity();
</script>
@endpush
