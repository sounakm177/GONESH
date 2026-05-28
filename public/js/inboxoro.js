/**
 * InboxOro — Master Frontend JS  (single file)
 * public/js/inboxoro.js
 *
 * Merges: inboxoro.js + inbox-mobile.js + timer-controls.js
 * Depends on: INBOX_ORO (inlined by js-bootstrap.blade.php)
 *             window.Echo (Laravel Reverb, optional)
 *
 * INBOX_ORO bootstrap shape expected:
 * {
 *   email, csrfToken, mailboxId, expiresIn, expiresAt,
 *   isPaused, pausedAt, maxSeconds,
 *   routes: {
 *     generate, inbox, emailBase, markAllRead, destroyAll,
 *     extend, pause, resume
 *   }
 * }
 */

'use strict';

/* ══════════════════════════════════════════════════════════════
   1. STATE
══════════════════════════════════════════════════════════════ */
let currentEmail  = INBOX_ORO.email;
let currentDomain = currentEmail.split('@')[1];
let selectedId    = null;
let searchTimer   = null;

// Timer state — single source of truth
let timerInterval = null;
let isPaused      = INBOX_ORO.isPaused  ?? false;
let pausedAt      = INBOX_ORO.pausedAt  ? new Date(INBOX_ORO.pausedAt) : null;
let maxSeconds    = INBOX_ORO.maxSeconds ?? 1800; // 30 min default

// expiresAt as a Date — the only clock reference used everywhere
window.expiresAt  = INBOX_ORO.expiresAt ? new Date(INBOX_ORO.expiresAt) : null;

// Mobile inbox state
const MOB_BP      = 768;
let _shell        = null;
let _listPanel    = null;
let _detailPanel  = null;
let _mobReading   = false;

/* ══════════════════════════════════════════════════════════════
   2. UTILITIES
══════════════════════════════════════════════════════════════ */

/** getElementById shorthand */
const $ = id => document.getElementById(id);

/** Zero-pad to 2 digits */
const pad = n => String(n).padStart(2, '0');

/** Current viewport is mobile */
const isMobile = () => window.innerWidth <= MOB_BP;

/** Authenticated fetch — always sends CSRF + JSON headers */
function api(url, opts = {}) {
  return fetch(url, {
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN':  INBOX_ORO.csrfToken,
      'Accept':        'application/json',
      ...opts.headers,
    },
    ...opts,
  });
}

/** Escape HTML for safe innerHTML injection */
function escHtml(s) {
  return String(s ?? '')
    .replace(/&/g,  '&amp;')
    .replace(/</g,  '&lt;')
    .replace(/>/g,  '&gt;')
    .replace(/"/g,  '&quot;');
}

/* ══════════════════════════════════════════════════════════════
   3. TOAST
══════════════════════════════════════════════════════════════ */
function showToast(msg = 'COPIED') {
  const t    = $('toast');
  if (!t) return;
  const span = t.querySelector('span');
  if (span) span.textContent = msg;
  t.classList.add('show');
  setTimeout(() => t.classList.remove('show'), 3000);
}

/* ══════════════════════════════════════════════════════════════
   4. HERO EXPAND / COLLAPSE
══════════════════════════════════════════════════════════════ */
function toggleHero() {
  $('hero-detail')?.classList.toggle('open');
  $('more-btn')?.classList.toggle('open');
}

/* ══════════════════════════════════════════════════════════════
   5. DOMAIN SELECTION
══════════════════════════════════════════════════════════════ */
function selectDomain(btn, domain) {
  document.querySelectorAll('.dtab').forEach(b => b.classList.remove('active'));
  btn.classList.add('active');
  currentDomain = domain;
  generateNew(domain);
}

/* ══════════════════════════════════════════════════════════════
   6. GENERATE NEW ADDRESS
══════════════════════════════════════════════════════════════ */
async function generateNew(domain = null) {
  if (typeof gtag === 'function') gtag('event', 'generate_email');

  const btn = $('btn-new-addr');
  if (btn) btn.disabled = true;

  const el = $('edisplay');
  if (el) el.classList.add('fading');

  try {
    const res  = await api(INBOX_ORO.routes.generate, {
      method: 'POST',
      body:   JSON.stringify({ domain: domain || currentDomain }),
    });
    const data = await res.json();

    INBOX_ORO.mailboxId = data.mailbox_id;
    INBOX_ORO.email     = data.email;

    INBOX_ORO.routes.extend = `/mailbox/${data.mailbox_id}/extend`;
    INBOX_ORO.routes.pause  = `/mailbox/${data.mailbox_id}/pause`;
    INBOX_ORO.routes.resume = `/mailbox/${data.mailbox_id}/resume`;

    INBOX_ORO.reverb.channel = `mailbox.${data.mailbox_id}`;

    currentEmail  = data.email;
    currentDomain = currentEmail.split('@')[1];
    const el = $('edisplay');
    if (el) { el.textContent != 'Address expired'; el.style.opacity = '1'; }

    setTimeout(() => {
      if (el) { el.textContent = currentEmail; el.classList.remove('fading'); }
    }, 260);

    // Reset timer with new server values
    if (data.expires_at) window.expiresAt = new Date(data.expires_at);
    isPaused = false;
    pausedAt = null;
    stopTimer();
    startTimer();
    syncExtendButton(false);

    reconnectReverb(data.mailbox_id);
    resetInboxUI();

    showToast('Your temporary email has been created successfully.');


    // Spin the refresh icon
    const ic = $('ric');
    if (ic) {
      ic.style.transform  = 'rotate(360deg)';
      ic.style.transition = 'transform .45s ease';
      setTimeout(() => { ic.style.transition = 'none'; ic.style.transform = 'rotate(0)'; }, 460);
    }

  } catch (err) {
    console.error('[InboxOro] Generate failed:', err);
  } finally {
    if (btn) btn.disabled = false;
  }
}

/** Clears inbox panel after generating a new address */
function resetInboxUI() {
  const list = $('email-list');
  if (list) list.innerHTML = emptyInboxHTML();

  const empty   = $('detail-empty');
  const content = $('detail-content');
  if (empty)   empty.style.display   = 'flex';
  if (content) content.style.display = 'none';

  selectedId = null;
  const ucnt = $('ucnt'); if (ucnt) ucnt.textContent = '';
  const lc   = $('list-count'); if (lc) lc.textContent = '0 messages';
}

/* ══════════════════════════════════════════════════════════════
   7. COPY EMAIL
══════════════════════════════════════════════════════════════ */
function copyEmail() {
  navigator.clipboard.writeText(currentEmail).catch(() => {});

  const btn = $('cbtn');
  if (!btn) return;
  btn.classList.add('ok');
  btn.innerHTML = svgTick() + 'Done';
  showToast('COPIED');

  setTimeout(() => {
    btn.classList.remove('ok');
    btn.innerHTML = svgCopy() + 'Copy';
  }, 2200);
}

function svgTick() {
  return `<svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"
       style="display:inline;margin-right:5px;vertical-align:middle;">
    <path stroke-linecap="round" d="M5 13l4 4L19 7"/>
  </svg>`;
}
function svgCopy() {
  return `<svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"
       style="display:inline;margin-right:5px;vertical-align:middle;">
    <rect x="9" y="9" width="13" height="13" rx="2"/>
    <path stroke-linecap="round" d="M5 15H4a2 2 0 01-2-2V4a2 2 0 012-2h9a2 2 0 012 2v1"/>
  </svg>`;
}

/* ══════════════════════════════════════════════════════════════
   8. TIMER  (unified — replaces all three separate versions)

   Architecture:
   - window.expiresAt  → single Date object, updated on extend/resume
   - isPaused / pausedAt → frozen reference when paused
   - getSecondsRemaining() → derived from wall clock, never from
     a decrementing counter, so it survives tab switches / freezes
   - startTimer() / stopTimer() → manage the single setInterval
══════════════════════════════════════════════════════════════ */

/**
 * Returns seconds remaining.
 * When paused: remaining = expiresAt − pausedAt  (frozen).
 * When running: remaining = expiresAt − now.
 * Falls back to INBOX_ORO.expiresIn if expiresAt not set yet.
 */
function getSecondsRemaining() {
  if (!window.expiresAt) return Math.max(0, INBOX_ORO.expiresIn ?? 0);
  const reference = (isPaused && pausedAt) ? pausedAt : new Date();
  return Math.max(0, Math.floor((window.expiresAt - reference) / 1000));
}

/** Update all timer UI elements from current state */
function updateTimerDisplay() {
  const remaining = getSecondsRemaining();
  const str       = `${pad(Math.floor(remaining / 60))}:${pad(remaining % 60)}`;

  // Text counters
  const tnum   = $('tnum');   if (tnum)   tnum.textContent   = str;
  const itimer = $('itimer'); if (itimer) itimer.textContent = str;

  // Progress bar — width as % of maxSeconds
  const pct = maxSeconds > 0 ? Math.min(100, (remaining / maxSeconds) * 100) : 0;
  const bar = $('tbar');
  if (bar) {
    // Use direct style (not CSS animation) so pause/extend work correctly
    bar.style.transition = 'width .9s linear';
    bar.style.width      = pct + '%';
  }

  // Paused badge
  const badge = $('paused-badge');
  if (badge) badge.style.display = isPaused ? 'inline' : 'none';

  // Pause button icons
  const iconPause = $('icon-pause');
  const iconPlay  = $('icon-play');
  const btnPause  = $('btn-pause');
  if (iconPause) iconPause.style.display = isPaused ? 'none'   : 'inline';
  if (iconPlay)  iconPlay.style.display  = isPaused ? 'inline' : 'none';
  if (btnPause)  btnPause.setAttribute('aria-label', isPaused ? 'Resume timer' : 'Pause timer');
}

function stopTimer() {
  clearInterval(timerInterval);
  timerInterval = null;
}

function startTimer() {
  stopTimer();
  updateTimerDisplay(); // immediate sync before first tick

  timerInterval = setInterval(() => {
    if (isPaused) {
      // Keep UI in sync but don't do anything else
      updateTimerDisplay();
      return;
    }
    const remaining = getSecondsRemaining();
    if (remaining <= 0) {
      stopTimer();
      handleExpiry();
      return;
    }
    updateTimerDisplay();
  }, 1000);
}

function handleExpiry() {
  const el = $('edisplay');
  if (el) { el.textContent = 'Address expired'; el.style.opacity = '.4'; }
  showToast('ADDRESS EXPIRED');
}

/* ── +10 minutes ── */
async function extendTimer() {
  const btn = $('btn-extend');
  if (btn) btn.disabled = true;

  try {
    const res  = await api(INBOX_ORO.routes.extend, { method: 'POST' });
    const data = await res.json();

    if (!res.ok) {
      showToast(data.message ?? 'Maximum time reached');
      return; // leave button disabled — ceiling hit
    }

    // Update expires reference
    if (data.expires_at) window.expiresAt = new Date(data.expires_at);

    showToast(data.message ?? '+10 minutes added');
    flashBar();
    syncExtendButton(data.at_max ?? false);
    updateTimerDisplay();

  } catch (err) {
    console.error('[InboxOro] Extend failed:', err);
    showToast('Could not extend timer');
    if (btn) btn.disabled = false;
  }
}

/* ── Pause / Resume ── */
async function togglePause() {
  const btn = $('btn-pause');
  if (btn) btn.disabled = true;

  const route = isPaused ? INBOX_ORO.routes.resume : INBOX_ORO.routes.pause;

  try {
    const res  = await api(route, { method: 'POST' });
    const data = await res.json();

    if (!res.ok) { showToast(data.message ?? 'Action failed'); return; }

    // Sync from server
    isPaused = data.is_paused;
    pausedAt = data.paused_at ? new Date(data.paused_at) : null;
    if (data.expires_at) window.expiresAt = new Date(data.expires_at);

    showToast(data.message ?? (isPaused ? 'Timer paused' : 'Timer resumed'));
    syncExtendButton(data.at_max ?? false);
    updateTimerDisplay();

  } catch (err) {
    console.error('[InboxOro] Pause/Resume failed:', err);
    showToast('Could not update timer');
  } finally {
    if (btn) btn.disabled = false;
  }
}

/* ── Enable/disable +10m button ── */
function syncExtendButton(atMax = false) {
  const btn = $('btn-extend');
  if (!btn) return;

  const localAtMax = atMax || (
    window.expiresAt &&
    (window.expiresAt - new Date()) / 1000 >= maxSeconds - 1
  );

  btn.disabled = localAtMax;
  btn.title    = localAtMax
    ? 'Maximum 30 minutes reached'
    : 'Add 10 minutes (max 30 min total)';
}

/** Brief yellow pulse on the bar after extension */
function flashBar() {
  const bar = $('tbar');
  if (!bar) return;
  bar.classList.add('extended');
  setTimeout(() => bar.classList.remove('extended'), 600);
}

/* ══════════════════════════════════════════════════════════════
   9. INBOX — RENDERING
══════════════════════════════════════════════════════════════ */

function emptyInboxHTML() {
  return `<div class="no-mail">
    <svg width="48" height="48" fill="none" viewBox="0 0 24 24" stroke="#FACC15" stroke-width="1">
      <path stroke-linecap="round"
            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8
               M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5
               a2 2 0 00-2 2v10a2 2 0 002 2z"/>
    </svg>
    <p>No messages yet</p>
  </div>`;
}

/** Build one email row HTML from an email object */
function renderEmailRow(em) {
  const isUnread  = !em.is_read;
  const hasAttach = (em.attachments_count ?? 0) > 0;

  return `
    <div class="erow${isUnread ? ' unread' : ''}${em.id === selectedId ? ' selected' : ''}"
         data-id="${em.id}" onclick="openEmail(${em.id})">
      <div class="erow-left">
        <div class="erow-avatar" style="background:${em.avatar_color ?? '#4B5563'};">
          ${escHtml(em.avatar_letter ?? '?')}
        </div>
        <div class="${isUnread ? 'udot-sm' : 'rdot-sm'}"></div>
      </div>
      <div class="erow-body">
        <div class="erow-top-row">
          <span class="e-sender">${escHtml(em.sender)}</span>
          <span class="e-time">${escHtml(em.time_ago ?? em.received_at ?? '')}</span>
        </div>
        <div class="e-subject">${escHtml(em.subject)}</div>
        ${hasAttach ? `
          <div class="e-attach-badge">
            <svg width="11" height="11" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"/>
            </svg>
            ${em.attachments_count} attachment${em.attachments_count > 1 ? 's' : ''}
          </div>` : ''}
      </div>
    </div>`;
}

function updateUnreadBadge(count) {
  const el = $('ucnt');
  if (el) el.textContent = count > 0 ? `(${count})` : '';
}

/** Full inbox re-render from API response */
function renderInboxList(data) {
  const list = $('email-list');
  if (!list) return;

  list.innerHTML = data.emails?.length
    ? data.emails.map(renderEmailRow).join('')
    : emptyInboxHTML();

  updateUnreadBadge(data.unread);

  const lc = $('list-count');
  if (lc) {
    lc.textContent = `${data.total} message${data.total !== 1 ? 's' : ''}`
      + (data.unread > 0 ? ` · ${data.unread} unread` : '');
  }
}

/* ══════════════════════════════════════════════════════════════
   10. OPEN EMAIL (detail panel)
══════════════════════════════════════════════════════════════ */
async function openEmail(id) {
  selectedId = id;

  // Update list selection
  document.querySelectorAll('.erow').forEach(r => {
    const isThis = parseInt(r.dataset.id) === id;
    r.classList.toggle('selected', isThis);
    if (isThis) {
      r.classList.remove('unread');
      const dot = r.querySelector('.udot-sm');
      if (dot) dot.className = 'rdot-sm';
    }
  });

  const empty   = $('detail-empty');
  const content = $('detail-content');
  if (empty)   empty.style.setProperty('display', 'none', 'important');
  if (content) { content.style.display = 'flex'; content.innerHTML = loadingHTML(); }

  try {
    const res = await api(`${INBOX_ORO.routes.emailBase}/${id}`);
    const em  = await res.json();
    updateUnreadBadge(em.unread_count);
    if (content) content.innerHTML = buildDetailHTML(em);
    mountEmailIframe(em.body ?? '', `email-frame-${em.id}`);
  } catch (err) {
    console.error('[InboxOro] Open email failed:', err);
    if (content) content.innerHTML = errorHTML();
  }

  // On mobile, slide to detail panel
  if (isMobile()) mobShowDetail();
}

const loadingHTML = () =>
  '<div style="flex:1;display:flex;align-items:center;justify-content:center;color:#D1D5DB;">Loading…</div>';

const errorHTML = () =>
  '<div style="flex:1;display:flex;align-items:center;justify-content:center;color:#dc2626;">Failed to load email</div>';

/**
 * Write email HTML into a sandboxed iframe and auto-size it.
 * Called after buildDetailHTML() injects the <iframe> into the DOM.
 */
function mountEmailIframe(html, iframeId) {
  const iframe = document.getElementById(iframeId);
  if (!iframe) return;

  const isFullDoc = /<!doctype|<html/i.test(html);
  const doc = isFullDoc ? html : `<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width,initial-scale=1"/>
<style>
  html,body{margin:0;padding:0;font-family:Arial,sans-serif;font-size:14px;
            line-height:1.6;color:#202124;background:#fff;
            word-break:break-word;overflow-wrap:break-word;}
  img{max-width:100%;height:auto;}
  a{color:#1a73e8;}
  table{border-collapse:collapse;}
  table,td,th{max-width:100%!important;}
</style>
</head>
<body>${html}</body>
</html>`;

  const iDoc = iframe.contentDocument || iframe.contentWindow.document;
  iDoc.open(); iDoc.write(doc); iDoc.close();

  function resize() {
    try {
      const h = iDoc.body ? iDoc.body.scrollHeight : 0;
      if (h > 0) iframe.style.height = h + 'px';
    } catch (_) {}
  }

  resize();
  setTimeout(resize, 300);
  setTimeout(resize, 1000);

  try { iDoc.querySelectorAll('img').forEach(img => img.addEventListener('load', resize)); } catch (_) {}
  try { iDoc.querySelectorAll('a').forEach(a => { if (!a.target) a.target = '_blank'; a.rel = 'noopener noreferrer'; }); } catch (_) {}
}

/** Build detail panel HTML from email API response */
function buildDetailHTML(em) {
  const iframeId  = `email-frame-${em.id}`;
  const attachHtml = em.attachments?.length
    ? `<div class="attach-section">
         <div class="attach-title">
           <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"
                style="display:inline;vertical-align:middle;margin-right:4px;">
             <path stroke-linecap="round" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"/>
           </svg>
           ${em.attachments.length} Attachment${em.attachments.length > 1 ? 's' : ''}
         </div>
         <div class="attach-grid">${em.attachments.map(buildAttachCard).join('')}</div>
       </div>`
    : '';

  return `
    <div class="detail-toolbar">
      <div class="detail-toolbar-left">
        <button class="dtl-btn" onclick="markUnreadAction(${em.id})">
          <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
            <path stroke-linecap="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
          </svg>
          Mark Unread
        </button>
      </div>
      <button class="dtl-btn danger" onclick="deleteEmail(${em.id})">
        <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
          <polyline points="3 6 5 6 21 6"/>
          <path stroke-linecap="round" d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6m5 0V4a1 1 0 011-1h2a1 1 0 011 1v2"/>
        </svg>
        Delete
      </button>
    </div>

    <div class="detail-header">
      <div class="detail-subject">${escHtml(em.subject)}</div>
      <div class="detail-meta-row">
        <div class="detail-avatar" style="background:${em.avatar_color};">${escHtml(em.avatar_letter)}</div>
        <div class="detail-meta-info">
          <div class="detail-from-name">${escHtml(em.sender)}</div>
          <div class="detail-from-email">&lt;${escHtml(em.sender_email)}&gt;</div>
          <div class="detail-to-line">
            To: <span style="font-family:'JetBrains Mono',monospace;">${escHtml(currentEmail)}</span>
          </div>
        </div>
        <div class="detail-timestamp">${escHtml(em.time_ago)}</div>
      </div>
    </div>

    <div class="detail-body">
      <iframe
        id="${iframeId}"
        sandbox="allow-same-origin allow-popups allow-popups-to-escape-sandbox"
        scrolling="no"
        frameborder="0"
        title="Email content"
        style="width:100%;min-height:120px;height:0;border:none;display:block;background:#fff;"
      ></iframe>
    </div>
    ${attachHtml}`;
}

function buildAttachCard(a) {
  return `
    <a class="attach-card" href="${a.download_url}" download="${escHtml(a.file_name)}">
      <div class="attach-icon" style="background:${a.icon_style.bg};color:${a.icon_style.color};">
        ${escHtml(a.extension)}
      </div>
      <div class="attach-info">
        <div class="attach-name">${escHtml(a.file_name)}</div>
        <div class="attach-size">${escHtml(a.size)}</div>
      </div>
      <div class="attach-dl">
        <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2">
          <path stroke-linecap="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
        </svg>
      </div>
    </a>`;
}

/* ══════════════════════════════════════════════════════════════
   11. INBOX ACTIONS
══════════════════════════════════════════════════════════════ */
async function deleteEmail(id) {
  await api(`${INBOX_ORO.routes.emailBase}/${id}`, { method: 'DELETE' });
  removeEmailRow(id);

  const empty   = $('detail-empty');
  const content = $('detail-content');
  if (empty)   empty.style.display   = 'flex';
  if (content) content.style.display = 'none';
  selectedId = null;

  // On mobile: go back to list after delete
  if (isMobile() && _mobReading) mobBackToList(true);
}

async function markUnreadAction(id) {
  const res  = await api(`${INBOX_ORO.routes.emailBase}/${id}/unread`, { method: 'PATCH' });
  const data = await res.json();
  updateUnreadBadge(data.unread_count);

  const row = document.querySelector(`.erow[data-id="${id}"]`);
  if (row) {
    row.classList.add('unread');
    const dot = row.querySelector('.rdot-sm');
    if (dot) dot.className = 'udot-sm';
  }
}

async function markAllRead() {
  await api(INBOX_ORO.routes.markAllRead, { method: 'POST' });
  document.querySelectorAll('.erow.unread').forEach(r => {
    r.classList.remove('unread');
    const dot = r.querySelector('.udot-sm');
    if (dot) dot.className = 'rdot-sm';
  });
  updateUnreadBadge(0);
}

async function deleteAllMsgs() {
  if (!confirm('Delete all messages?')) return;
  await api(INBOX_ORO.routes.destroyAll, { method: 'DELETE' });

  const list = $('email-list');
  if (list) list.innerHTML = emptyInboxHTML();

  const empty   = $('detail-empty');
  const content = $('detail-content');
  if (empty)   empty.style.display   = 'flex';
  if (content) content.style.display = 'none';

  selectedId = null;
  updateUnreadBadge(0);
  const lc = $('list-count'); if (lc) lc.textContent = '0 messages';
}

/** Remove a row from the DOM and update the count footer */
function removeEmailRow(id) {
  const row = document.querySelector(`.erow[data-id="${id}"]`);
  if (row) row.remove();

  const remaining = document.querySelectorAll('.erow').length;
  if (remaining === 0) {
    const list = $('email-list');
    if (list) list.innerHTML = emptyInboxHTML();
  }
  const lc = $('list-count');
  if (lc) lc.textContent = `${remaining} message${remaining !== 1 ? 's' : ''}`;
}

/* ══════════════════════════════════════════════════════════════
   12. INBOX POLLING & SEARCH
══════════════════════════════════════════════════════════════ */
async function refreshInbox(search = '') {
  const list = $('email-list');
  if (list) list.style.opacity = '.4';

  try {
    const url = new URL(INBOX_ORO.routes.inbox, location.origin);
    if (search) url.searchParams.set('search', search);

    const res = await api(url.toString());
    if (res.status === 410) { handleExpiry(); return; }

    const data = await res.json();
    renderInboxList(data);
  } catch (err) {
    console.error('[InboxOro] Refresh failed:', err);
  } finally {
    if (list) list.style.opacity = '1';
  }
}

/** Debounced search — 400ms after last keystroke */
function debounceSearch(val) {
  clearTimeout(searchTimer);
  searchTimer = setTimeout(() => refreshInbox(val), 400);
}

/* ══════════════════════════════════════════════════════════════
   13. REVERB REALTIME  (Laravel Echo + WebSocket)
══════════════════════════════════════════════════════════════ */
let currentChannel = null;

function subscribeToMailbox(mailboxId) {
  if (!window.Echo) return;
  const channelName = `mailbox.${mailboxId}`;

  if (currentChannel) {
    window.Echo.leave(currentChannel);
  }
  currentChannel = channelName;

  window.Echo.channel(channelName)
    .listen('.new.email',       onNewEmail)
    .listen('.mailbox.expired', handleExpiry);
}

function reconnectReverb(newMailboxId) {
  if (!window.Echo) return;
  window.Echo.leaveAllChannels();
  subscribeToMailbox(newMailboxId);
}

/** Prepend a newly-arrived email without a full list reload */
function onNewEmail(data) {
  const list   = $('email-list');
  if (!list) return;

  const noMail = list.querySelector('.no-mail');
  if (noMail) noMail.remove();

  const tmp       = document.createElement('div');
  tmp.innerHTML   = renderEmailRow({
    id:                data.id,
    sender:            data.sender,
    subject:           data.subject,
    is_read:           false,
    time_ago:          data.time_ago,
    received_at:       data.received_at,
    avatar_letter:     data.avatar_letter,
    avatar_color:      data.avatar_color,
    attachments_count: data.has_attachments ? 1 : 0,
  });
  list.prepend(tmp.firstElementChild);
  updateUnreadBadge(data.unread_count);

  const lc = $('list-count');
  if (lc) {
    const cur = parseInt(lc.textContent) || 0;
    lc.textContent = `${cur + 1} message${cur + 1 !== 1 ? 's' : ''}`;
  }
}

/* ══════════════════════════════════════════════════════════════
   14. MOBILE INBOX NAV
   Slides detail panel in/out on screens ≤ 768px.
   Uses history.pushState so the browser back gesture works.
══════════════════════════════════════════════════════════════ */
function mobShowDetail() {
  if (!_shell || _mobReading) return;
  _mobReading = true;
  _shell.classList.add('mob-reading');
  history.pushState({ mobReading: true }, '');
  if (_detailPanel) _detailPanel.scrollTop = 0;
}

/**
 * Back to list.
 * @param {boolean} skipHistory - true when called from popstate (history already popped)
 */
function mobBackToList(skipHistory = false) {
  if (!_shell) return;
  _mobReading = false;
  _shell.classList.remove('mob-reading');
  if (!skipHistory) history.back();

  // Scroll selected row into view after animation
  setTimeout(() => {
    const sel = _listPanel?.querySelector('.erow.selected');
    if (sel) sel.scrollIntoView({ block: 'nearest', behavior: 'smooth' });
  }, 300);
}

// Exported for Blade onclick handlers
window.mobBackToList = mobBackToList;

/* ══════════════════════════════════════════════════════════════
   15. SCROLL REVEAL
══════════════════════════════════════════════════════════════ */
function checkReveal() {
  document.querySelectorAll('.rv:not(.in)').forEach(el => {
    if (el.getBoundingClientRect().top < window.innerHeight - 50) {
      el.classList.add('in');
    }
  });
}

/* ══════════════════════════════════════════════════════════════
   16. NAV HAMBURGER
══════════════════════════════════════════════════════════════ */
function initNav() {
  const btn      = $('nav-ham');
  const links    = $('nav-links');
  const backdrop = $('nav-backdrop');
  if (!btn || !links) return;

  const hamIcon   = btn.querySelector('.ham-icon');
  const closeIcon = btn.querySelector('.close-icon');

  function openMenu() {
    links.classList.add('open');
    backdrop?.classList.add('show');
    btn.classList.add('open');
    if (hamIcon)   hamIcon.style.display   = 'none';
    if (closeIcon) closeIcon.style.display = 'block';
    btn.setAttribute('aria-expanded', 'true');
    document.body.style.overflow = 'hidden';
  }

  function closeMenu() {
    links.classList.remove('open');
    backdrop?.classList.remove('show');
    btn.classList.remove('open');
    if (hamIcon)   hamIcon.style.display   = 'block';
    if (closeIcon) closeIcon.style.display = 'none';
    btn.setAttribute('aria-expanded', 'false');
    document.body.style.overflow = '';
  }

  btn.addEventListener('click', () =>
    links.classList.contains('open') ? closeMenu() : openMenu()
  );

  backdrop?.addEventListener('click', closeMenu);

  links.querySelectorAll('a').forEach(a => a.addEventListener('click', closeMenu));

  document.addEventListener('keydown', e => { if (e.key === 'Escape') closeMenu(); });

  window.addEventListener('resize', () => { if (window.innerWidth >= 900) closeMenu(); });

  // Mark active link based on current path
  const path = window.location.pathname;
  links.querySelectorAll('.nav-link').forEach(a => {
    const href = a.getAttribute('href') ?? '';
    if (href && (href === path || (path.startsWith(href) && href !== '/'))) {
      a.classList.add('active');
    }
  });
}

/* ══════════════════════════════════════════════════════════════
   17. READ PROGRESS BAR  (blog / article pages)
══════════════════════════════════════════════════════════════ */
function initReadProgress() {
  const bar = $('read-progress') || $('readBar');
  if (!bar) return;
  window.addEventListener('scroll', () => {
    const d   = document.documentElement;
    const pct = d.scrollHeight - d.clientHeight;
    if (pct > 0) bar.style.width = ((d.scrollTop / pct) * 100) + '%';
  }, { passive: true });
}

/* ══════════════════════════════════════════════════════════════
   18. TOC ACTIVE HIGHLIGHT  (blog post)
══════════════════════════════════════════════════════════════ */
function initTocHighlight() {
  const headings = document.querySelectorAll('.post-content h2[id], .post-content h3[id]');
  const tocLinks = document.querySelectorAll('.toc-list a, .stoc-list a');
  if (!headings.length || !tocLinks.length) return;

  const io = new IntersectionObserver(entries => {
    entries.forEach(e => {
      if (e.isIntersecting) {
        const id = '#' + e.target.id;
        tocLinks.forEach(link =>
          link.classList.toggle('active', link.getAttribute('href') === id)
        );
      }
    });
  }, { rootMargin: '-30% 0px -60% 0px' });

  headings.forEach(h => io.observe(h));
}

/* ══════════════════════════════════════════════════════════════
   19. COPY LINK  (blog post share bar)
══════════════════════════════════════════════════════════════ */
function copyLink(url = window.location.href) {
  const label = $('copy-label');
  const done  = () => { if (label) { label.textContent = 'Copied!'; setTimeout(() => label.textContent = 'Copy Link', 2000); } };

  if (navigator.clipboard) {
    navigator.clipboard.writeText(url).then(done).catch(() => fallbackCopy(url, done));
  } else {
    fallbackCopy(url, done);
  }

  function fallbackCopy(text, cb) {
    const ta = document.createElement('textarea');
    ta.value = text;
    document.body.appendChild(ta);
    ta.select();
    try { document.execCommand('copy'); } catch (_) {}
    document.body.removeChild(ta);
    cb();
  }
}

/* ══════════════════════════════════════════════════════════════
   20. BOOT
══════════════════════════════════════════════════════════════ */
(function init() {

  // ── Timer ──
  // Seed expiresAt from server (already set at top of file)
  syncExtendButton(false);
  startTimer();

  // ── Scroll reveal ──
  window.addEventListener('scroll', checkReveal, { passive: true });
  setTimeout(checkReveal, 100);

  // ── Read progress bar ──
  initReadProgress();

  document.addEventListener('DOMContentLoaded', () => {

    // ── Nav hamburger ──
    initNav();

    // ── Blog TOC highlight ──
    initTocHighlight();

    // ── Mobile inbox ──
    _shell       = $('inbox-shell');
    _listPanel   = _shell?.querySelector('.inbox-list-panel');
    _detailPanel = _shell?.querySelector('.inbox-detail-panel');

    // Browser back button on mobile inbox
    window.addEventListener('popstate', e => {
      if (_mobReading && isMobile()) mobBackToList(true);
    });

    // Reset mobile inbox state on resize to desktop
    window.addEventListener('resize', () => {
      if (_mobReading && !isMobile()) {
        _shell?.classList.remove('mob-reading');
        _mobReading = false;
      }
    }, { passive: true });

    // ── Reverb / WebSocket ──
    if (!window.Echo) {
      console.warn('[InboxOro] Echo not loaded — realtime disabled.');
      return;
    }
    subscribeToMailbox(INBOX_ORO.mailboxId);
    showToast(INBOX_ORO.popupMessage);
  });

})();