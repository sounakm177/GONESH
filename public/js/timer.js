/* =============================================================
   TIMER CONTROLS — add to inboxoro.js
   Depends on: api(), showToast(), pad(), $() already defined.
   =============================================================

   ALSO ADD TO INBOX_ORO bootstrap object (js-bootstrap.blade.php):
   ─────────────────────────────────────────────────────────────
   const INBOX_ORO = Object.freeze({
     ...existing fields...,

     isPaused:   {{ json_encode($mailbox->is_paused) }},
     pausedAt:   {{ json_encode($mailbox->paused_at?->toIso8601String()) }},
     maxSeconds: {{ $mailbox->created_at->diffInSeconds($mailbox->maxExpiry()) }},

     routes: {
       ...existing routes...,
       extend: "{{ route('mailbox.extend', $mailbox) }}",
       pause:  "{{ route('mailbox.pause',  $mailbox) }}",
       resume: "{{ route('mailbox.resume', $mailbox) }}",
     },
   });
   ============================================================= */

'use strict';

/* ── State additions (add alongside existing state vars) ─────── */
let isPaused   = INBOX_ORO.isPaused  ?? false;
let pausedAt   = INBOX_ORO.pausedAt  ? new Date(INBOX_ORO.pausedAt) : null;
let maxSeconds = INBOX_ORO.maxSeconds ?? 1800; // 30 min


/* ─────────────────────────────────────────────────────────────
   REPLACE your existing updateTimerDisplay() with this version.
   It now also handles the paused badge and progress bar.
───────────────────────────────────────────────────────────── */
function updateTimerDisplay() {
  const remaining = getSecondsRemaining();
  const str = `${pad(Math.floor(remaining / 60))}:${pad(remaining % 60)}`;

  $('tnum').textContent   = str;
  $('itimer').textContent = str;   // footer timer (if exists)

  // Progress bar width = remaining / max * 100%
  const pct = Math.min(100, (remaining / maxSeconds) * 100);
  const bar = $('tbar');
  if (bar) bar.style.width = pct + '%';

  // Paused badge
  const badge = $('paused-badge');
  if (badge) badge.style.display = isPaused ? 'inline' : 'none';

  // Pause/play icons
  const iconPause = $('icon-pause');
  const iconPlay  = $('icon-play');
  const btnPause  = $('btn-pause');
  if (iconPause) iconPause.style.display = isPaused ? 'none'   : 'inline';
  if (iconPlay)  iconPlay.style.display  = isPaused ? 'inline' : 'none';
  if (btnPause)  btnPause.setAttribute('aria-label', isPaused ? 'Resume timer' : 'Pause timer');
}


/* ─────────────────────────────────────────────────────────────
   REPLACE your existing startTimer() with this version.
   When paused the interval is cleared and no decrement happens.
───────────────────────────────────────────────────────────── */
function startTimer() {
  clearInterval(timerInterval);

  // Sync UI immediately before first tick
  updateTimerDisplay();

  timerInterval = setInterval(() => {
    // When paused: keep interval alive but don't decrement — server
    // holds the frozen time; we just keep UI synced.
    if (isPaused) {
      updateTimerDisplay();
      return;
    }

    const remaining = getSecondsRemaining();

    if (remaining <= 0) {
      clearInterval(timerInterval);
      handleExpiry();
      return;
    }

    updateTimerDisplay();
  }, 1000);
}


/* ─────────────────────────────────────────────────────────────
   Compute remaining seconds from live wall clock.
   When paused: remaining = expires_at − paused_at  (frozen).
   When running: remaining = expires_at − now.
───────────────────────────────────────────────────────────── */
function getSecondsRemaining() {
  // expiresAt is a JS Date, set when page loads or when extend runs.
  // If it doesn't exist yet fall back to secsRemaining (legacy compat).
  if (! window.expiresAt) {
    return Math.max(0, secsRemaining);
  }

  const reference = (isPaused && pausedAt) ? pausedAt : new Date();
  const diff = Math.floor((window.expiresAt - reference) / 1000);
  return Math.max(0, diff);
}


/* ─────────────────────────────────────────────────────────────
   BOOT — call after INBOX_ORO is defined (add to your init())
───────────────────────────────────────────────────────────── */
(function initTimerControls() {
  // Seed expiresAt from server-rendered ISO string in INBOX_ORO
  if (INBOX_ORO.expiresAt) {
    window.expiresAt = new Date(INBOX_ORO.expiresAt);
  }
  syncExtendButton();
})();


/* ─────────────────────────────────────────────────────────────
   +10 MINUTES
───────────────────────────────────────────────────────────── */
async function extendTimer() {
  const btn = $('btn-extend');
  btn.disabled = true;

  try {
    const res  = await api(INBOX_ORO.routes.extend, { method: 'POST' });
    const data = await res.json();

    if (! res.ok) {
      // 422 = already at max
      showToast(data.message ?? 'Maximum time reached');
      btn.disabled = true;   // keep disabled — ceiling hit
      return;
    }

    // Update local state
    window.expiresAt = new Date(data.expires_at);

    // Re-sync paused reference so remaining seconds are correct
    if (isPaused && pausedAt) {
      // The frozen point stays the same; the ceiling just moved up.
      // Nothing to change on pausedAt.
    }

    showToast(data.message ?? '+10 minutes added');
    flashBar();
    syncExtendButton(data.at_max);

  } catch (err) {
    console.error('[inboxOro] Extend failed:', err);
    showToast('Could not extend timer');
  } finally {
    // Re-enable only if not at max (syncExtendButton handles this)
    if (! btn.disabled) btn.disabled = false;
  }
}


/* ─────────────────────────────────────────────────────────────
   PAUSE / RESUME TOGGLE
───────────────────────────────────────────────────────────── */
async function togglePause() {
  const btn      = $('btn-pause');
  btn.disabled   = true;

  const route    = isPaused ? INBOX_ORO.routes.resume : INBOX_ORO.routes.pause;

  try {
    const res  = await api(route, { method: 'POST' });
    const data = await res.json();

    if (! res.ok) {
      showToast(data.message ?? 'Action failed');
      return;
    }

    // Sync local state from server response
    isPaused = data.is_paused;
    pausedAt = data.paused_at ? new Date(data.paused_at) : null;

    if (data.expires_at) {
      window.expiresAt = new Date(data.expires_at);
    }

    showToast(data.message ?? (isPaused ? 'Timer paused' : 'Timer resumed'));
    syncExtendButton(data.at_max ?? false);
    updateTimerDisplay();

  } catch (err) {
    console.error('[inboxOro] Pause/Resume failed:', err);
    showToast('Could not update timer');
  } finally {
    btn.disabled = false;
  }
}


/* ─────────────────────────────────────────────────────────────
   HELPERS
───────────────────────────────────────────────────────────── */

/** Enable/disable +10m button based on whether ceiling is hit */
function syncExtendButton(atMax = false) {
  const btn = $('btn-extend');
  if (! btn) return;

  // Also check locally: if expiresAt ≥ now + maxSeconds → at max
  const localAtMax = atMax || (
    window.expiresAt &&
    (window.expiresAt - new Date()) / 1000 >= maxSeconds - 1
  );

  btn.disabled = localAtMax;
  btn.title    = localAtMax
    ? 'Maximum 30 minutes reached'
    : 'Add 10 minutes (max 30 min total)';
}

/** Brief yellow pulse on the progress bar after extension */
function flashBar() {
  const bar = $('tbar');
  if (! bar) return;
  bar.classList.add('extended');
  setTimeout(() => bar.classList.remove('extended'), 600);
}