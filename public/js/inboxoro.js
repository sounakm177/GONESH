/**
 * inboxOro — Main Frontend JS
 * public/js/inboxoro.js
 *
 * Depends on: INBOX_ORO (inlined by js-bootstrap.blade.php)
 *             window.Echo (Laravel Reverb, loaded via resources/js/echo.js)
 */

'use strict';

/* ══════════════════════════════════════════════════════════════
   STATE
══════════════════════════════════════════════════════════════ */
let currentEmail   = INBOX_ORO.email;
let currentDomain  = currentEmail.split('@')[1];
let selectedId     = null;
let searchTimer    = null;
let secsRemaining  = INBOX_ORO.expiresIn;
let timerInterval  = null;


/* ══════════════════════════════════════════════════════════════
   UTILITIES
══════════════════════════════════════════════════════════════ */

/** Shorthand for getElementById */
const $ = id => document.getElementById(id);

/** Authenticated fetch wrapper — always sends CSRF + JSON headers */
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
    .replace(/&/g, '&amp;')
    .replace(/</g, '&lt;')
    .replace(/>/g, '&gt;')
    .replace(/"/g, '&quot;');
}

/** Zero-pad a number to 2 digits */
const pad = n => String(n).padStart(2, '0');


/* ══════════════════════════════════════════════════════════════
   TOAST
══════════════════════════════════════════════════════════════ */
function showToast(msg = 'COPIED') {
  const t = $('toast');
  const span = t.querySelector('span');
  if (span) span.textContent = msg;
  t.classList.add('show');
  setTimeout(() => t.classList.remove('show'), 2500);
}


/* ══════════════════════════════════════════════════════════════
   HERO EXPAND / COLLAPSE
══════════════════════════════════════════════════════════════ */
function toggleHero() {
  $('hero-detail').classList.toggle('open');
  $('more-btn').classList.toggle('open');
}


/* ══════════════════════════════════════════════════════════════
   DOMAIN SELECTION
══════════════════════════════════════════════════════════════ */
function selectDomain(btn, domain) {
  document.querySelectorAll('.dtab').forEach(b => b.classList.remove('active'));
  btn.classList.add('active');
  currentDomain = domain;
  generateNew(domain);
}


/* ══════════════════════════════════════════════════════════════
   GENERATE NEW ADDRESS
══════════════════════════════════════════════════════════════ */
async function generateNew(domain = null) {
  gtag('event', 'generate_email');
  const btn = $('btn-new-addr');
  btn.disabled = true;

  const el = $('edisplay');
  el.classList.add('fading');

  try {
    const res  = await api(INBOX_ORO.routes.generate, {
      method: 'POST',
      body:   JSON.stringify({ domain: domain || currentDomain }),
    });
    const data = await res.json();

    currentEmail  = data.email;
    currentDomain = currentEmail.split('@')[1];

    setTimeout(() => {
      el.textContent = currentEmail;
      el.classList.remove('fading');
    }, 260);

    secsRemaining = data.expires_in;
    updateTimerDisplay();
    resetTimerBar(data.expires_in);

    reconnectReverb(data.mailbox_id);
    resetInboxUI();

    // Spin the refresh icon
    const ic = $('ric');
    ic.style.transform  = 'rotate(360deg)';
    ic.style.transition = 'transform .45s ease';
    setTimeout(() => { ic.style.transition = 'none'; ic.style.transform = 'rotate(0)'; }, 460);

  } catch (err) {
    console.error('[inboxOro] Generate failed:', err);
  } finally {
    btn.disabled = false;
  }
}

/** Clears inbox panel after generating a new address */
function resetInboxUI() {
  $('email-list').innerHTML         = '<div class="no-mail"><p>No messages yet</p></div>';
  $('detail-empty').style.display   = 'flex';
  $('detail-content').style.display = 'none';
  selectedId                        = null;
  $('ucnt').textContent             = '';
  $('list-count').textContent       = '0 messages';
}


/* ══════════════════════════════════════════════════════════════
   COPY EMAIL
══════════════════════════════════════════════════════════════ */
function copyEmail() {
  navigator.clipboard.writeText(currentEmail).catch(() => {});

  const btn = $('cbtn');
  btn.classList.add('ok');
  btn.innerHTML = `
    <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"
         style="display:inline;margin-right:5px;vertical-align:middle;">
      <path stroke-linecap="round" d="M5 13l4 4L19 7"/>
    </svg>Done`;

  showToast('COPIED');

  setTimeout(() => {
    btn.classList.remove('ok');
    btn.innerHTML = `
      <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"
           style="display:inline;margin-right:5px;vertical-align:middle;">
        <rect x="9" y="9" width="13" height="13" rx="2"/>
        <path stroke-linecap="round" d="M5 15H4a2 2 0 01-2-2V4a2 2 0 012-2h9a2 2 0 012 2v1"/>
      </svg>Copy`;
  }, 2200);
}


/* ══════════════════════════════════════════════════════════════
   EXPIRY TIMER
══════════════════════════════════════════════════════════════ */
function updateTimerDisplay() {
  const str = `${pad(Math.floor(secsRemaining / 60))}:${pad(secsRemaining % 60)}`;
  $('tnum').textContent   = str;
  $('itimer').textContent = str;
}

function resetTimerBar(totalSecs) {
  const bar = $('tbar');
  bar.style.transition = 'none';
  bar.style.width      = '100%';
  // Force reflow then animate to 0
  setTimeout(() => {
    bar.style.transition = `width ${totalSecs}s linear`;
    bar.style.width      = '0%';
  }, 50);
}

function startTimer() {
  clearInterval(timerInterval);
  timerInterval = setInterval(() => {
    if (secsRemaining > 0) {
      secsRemaining--;
      updateTimerDisplay();
    } else {
      clearInterval(timerInterval);
      handleExpiry();
    }
  }, 1000);
}

function handleExpiry() {
  const el      = $('edisplay');
  el.textContent  = 'Address expired';
  el.style.opacity = '.4';
  showToast('ADDRESS EXPIRED');
}


/* ══════════════════════════════════════════════════════════════
   INBOX — RENDERING
══════════════════════════════════════════════════════════════ */

/** Build an email-row HTML string from a JSON email object (JS counterpart of email-row.blade.php) */
function renderEmailRow(em) {
  const isUnread = !em.is_read;
  const hasAttach = em.attachments_count > 0;

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
  $('ucnt').textContent = count > 0 ? `(${count})` : '';
}

/** Full inbox list re-render from API response */
function renderInboxList(data) {
  const list = $('email-list');
  list.innerHTML = data.emails?.length
    ? data.emails.map(renderEmailRow).join('')
    : '<div class="no-mail"><p>No messages yet</p></div>';

  updateUnreadBadge(data.unread);
  $('list-count').textContent = `${data.total} message${data.total !== 1 ? 's' : ''}`
    + (data.unread > 0 ? ` · ${data.unread} unread` : '');
}


/* ══════════════════════════════════════════════════════════════
   OPEN EMAIL (detail panel)
══════════════════════════════════════════════════════════════ */
async function openEmail(id) {
  selectedId = id;

  // Update list selection state
  document.querySelectorAll('.erow').forEach(r => {
    const isThis = parseInt(r.dataset.id) === id;
    r.classList.toggle('selected', isThis);
    if (isThis) {
      r.classList.remove('unread');
      const dot = r.querySelector('.udot-sm');
      if (dot) dot.className = 'rdot-sm';
    }
  });

  $('detail-empty').style.setProperty('display', 'none', 'important');
  $('detail-content').style.display = 'flex';
  $('detail-content').innerHTML     = loadingPlaceholder();

  try {
    const res = await api(`${INBOX_ORO.routes.emailBase}/${id}`);
    const em  = await res.json();
    updateUnreadBadge(em.unread_count);

    /* Inject the wrapper HTML (toolbar + header + iframe shell) */
    $('detail-content').innerHTML = buildDetailHTML(em);

    /* Now mount the email body into the sandboxed iframe.
       Must happen AFTER innerHTML is set so the iframe element exists in the DOM. */
    mountEmailIframe(em.body ?? '', `email-frame-${em.id}`);

  } catch (err) {
    console.error('[inboxOro] Open email failed:', err);
    $('detail-content').innerHTML = errorPlaceholder();
  }
}

function loadingPlaceholder() {
  return '<div style="flex:1;display:flex;align-items:center;justify-content:center;color:#D1D5DB;">Loading…</div>';
}
function errorPlaceholder() {
  return '<div style="flex:1;display:flex;align-items:center;justify-content:center;color:#dc2626;">Failed to load email</div>';
}

/**
 * Writes email HTML into a sandboxed iframe and auto-sizes it.
 * Called after buildDetailHTML() injects the iframe into the DOM.
 *
 * @param {string} html  - Raw email HTML (may contain <style>, <head>, full <html>)
 * @param {string} iframeId - id of the target <iframe>
 */
function mountEmailIframe(html, iframeId) {
  const iframe = document.getElementById(iframeId);
  if (!iframe) return;

  /* Wrap bare snippets in a full document so email <style> blocks
     are correctly scoped inside the frame and never leak out.       */
  const isFullDoc = /<!doctype|<html/i.test(html);
  const doc = isFullDoc ? html : `<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width,initial-scale=1"/>
<style>
  /* Gmail-style email reset — keeps email body readable */
  html, body {
    margin: 0; padding: 0;
    font-family: Arial, sans-serif;
    font-size: 14px;
    line-height: 1.6;
    color: #202124;
    background: #fff;
    word-break: break-word;
    overflow-wrap: break-word;
  }
  img { max-width: 100%; height: auto; }
  a   { color: #1a73e8; }
  table { border-collapse: collapse; }
  /* Prevent huge fixed-width email tables from overflowing */
  table, td, th { max-width: 100% !important; }
</style>
</head>
<body>${html}</body>
</html>`;

console.log('html',html);
  /* Write into the frame */
  const iDoc = iframe.contentDocument || iframe.contentWindow.document;
  iDoc.open();
  iDoc.write(doc);
  iDoc.close();

  /* Auto-resize: set iframe height = scrollHeight of its body.
     Run once immediately, then again after images may have loaded. */
  function resize() {
    try {
      const h = iDoc.body ? iDoc.body.scrollHeight : 0;
      if (h > 0) iframe.style.height = h + 'px';
    } catch (_) {}
  }

  resize();
  /* Second pass after fonts / images settle */
  setTimeout(resize, 300);
  setTimeout(resize, 1000);

  /* Re-size when images inside the email load */
  try {
    iDoc.querySelectorAll('img').forEach(img => {
      img.addEventListener('load', resize);
    });
  } catch (_) {}

  /* Open links in parent tab, not inside the tiny iframe */
  try {
    iDoc.querySelectorAll('a').forEach(a => {
      if (!a.target) a.target = '_blank';
      a.rel = 'noopener noreferrer';
    });
  } catch (_) {}
}


/** Builds the full detail panel HTML from an email API response */
function buildDetailHTML(em) {
  const attachHtml = em.attachments?.length
    ? `<div class="attach-section">
         <div class="attach-title">
           <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"
                style="display:inline;vertical-align:middle;margin-right:4px;">
             <path stroke-linecap="round" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"/>
           </svg>
           ${em.attachments.length} Attachment${em.attachments.length > 1 ? 's' : ''}
         </div>
         <div class="attach-grid">
           ${em.attachments.map(buildAttachCard).join('')}
         </div>
       </div>`
    : '';

  /* Unique iframe id so multiple openings don't clash */
  const iframeId = `email-frame-${em.id}`;

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
        class="email-iframe"
        sandbox="allow-same-origin allow-popups allow-popups-to-escape-sandbox"
        scrolling="no"
        frameborder="0"
        title="Email content"
        aria-label="Email message content"
        style="
          width: 100%;
          min-height: 120px;
          height: 0;
          border: none;
          display: block;
          background: #fff;
        "
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
   INBOX ACTIONS
══════════════════════════════════════════════════════════════ */
async function deleteEmail(id) {
  await api(`${INBOX_ORO.routes.emailBase}/${id}`, { method: 'DELETE' });
  removeEmailRow(id);
  $('detail-empty').style.display   = 'flex';
  $('detail-content').style.display = 'none';
  selectedId = null;
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
  $('email-list').innerHTML          = '<div class="no-mail"><p>No messages yet</p></div>';
  $('detail-empty').style.display   = 'flex';
  $('detail-content').style.display = 'none';
  selectedId                         = null;
  updateUnreadBadge(0);
  $('list-count').textContent        = '0 messages';
}

/** Remove a single row from the DOM and update the count footer */
function removeEmailRow(id) {
  const row = document.querySelector(`.erow[data-id="${id}"]`);
  if (row) row.remove();
  const remaining = document.querySelectorAll('.erow').length;
  if (remaining === 0) {
    $('email-list').innerHTML = '<div class="no-mail"><p>No messages yet</p></div>';
  }
  $('list-count').textContent = `${remaining} message${remaining !== 1 ? 's' : ''}`;
}


/* ══════════════════════════════════════════════════════════════
   INBOX — POLLING FALLBACK
══════════════════════════════════════════════════════════════ */
async function refreshInbox(search = '') {
  const list    = $('email-list');
  list.style.opacity = '.4';

  try {
    const url = new URL(INBOX_ORO.routes.inbox);
    if (search) url.searchParams.set('search', search);

    const res = await api(url.toString());
    if (res.status === 410) { handleExpiry(); return; }

    const data = await res.json();
    renderInboxList(data);
  } catch (err) {
    console.error('[inboxOro] Refresh failed:', err);
  } finally {
    list.style.opacity = '1';
  }
}

/** Debounced search — waits 400ms after last keystroke */
function debounceSearch(val) {
  clearTimeout(searchTimer);
  searchTimer = setTimeout(() => refreshInbox(val), 400);
}


/* ══════════════════════════════════════════════════════════════
   REVERB REALTIME (Laravel Echo + WebSocket)
══════════════════════════════════════════════════════════════ */
let currentChannel = null;

function subscribeToMailbox(mailboxId) {
  const channelName = `mailbox.${mailboxId}`;

  if (currentChannel) {
    window.Echo.leave(currentChannel);
    console.debug('[Reverb] Left channel:', currentChannel);
  }

  currentChannel = channelName;

  window.Echo.channel(channelName)
    .listen('.new.email',       onNewEmail)
    .listen('.mailbox.expired', handleExpiry);

  console.debug('[Reverb] Subscribed to:', channelName);
}

function reconnectReverb(newMailboxId) {
  if (!window.Echo) return;
  window.Echo.leaveAllChannels();
  subscribeToMailbox(newMailboxId);
}

/** Prepends a newly-arrived email to the list without a full reload */
function onNewEmail(data) {
  const list   = $('email-list');
  const noMail = list.querySelector('.no-mail');
  if (noMail) noMail.remove();

  const tmp = document.createElement('div');
  tmp.innerHTML = renderEmailRow({
    id:                data.id,
    sender:            data.sender,
    subject:           data.subject,
    preview:           data.preview,
    is_read:           false,
    time_ago:          data.time_ago,
    received_at:       data.received_at,
    avatar_letter:     data.avatar_letter,
    avatar_color:      data.avatar_color,
    attachments_count: data.has_attachments ? 1 : 0,
  });
  list.prepend(tmp.firstElementChild);
  updateUnreadBadge(data.unread_count);

  const countEl = $('list-count');
  const current = parseInt(countEl.textContent) || 0;
  countEl.textContent = `${current + 1} message${current + 1 !== 1 ? 's' : ''}`;
}


/* ══════════════════════════════════════════════════════════════
   SCROLL REVEAL
══════════════════════════════════════════════════════════════ */
function checkReveal() {
  document.querySelectorAll('.rv').forEach(el => {
    if (el.getBoundingClientRect().top < window.innerHeight - 50) {
      el.classList.add('in');
    }
  });
}


/* ══════════════════════════════════════════════════════════════
   BOOT
══════════════════════════════════════════════════════════════ */
(function init() {
  // Start countdown
  startTimer();
  resetTimerBar(INBOX_ORO.expiresIn);

  // Scroll-reveal
  window.addEventListener('scroll', checkReveal, { passive: true });
  setTimeout(checkReveal, 100);

  // Reverb subscription (requires Echo to be loaded first)
  document.addEventListener('DOMContentLoaded', () => {
    if (!window.Echo) {
      console.warn('[inboxOro] Echo not loaded — realtime disabled, polling only.');
      return;
    }
    subscribeToMailbox(INBOX_ORO.mailboxId);
  });
})();