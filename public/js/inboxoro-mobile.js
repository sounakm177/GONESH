'use strict';

/* ── Breakpoint must match the CSS media query ── */
const MOB_BP = 768;

/* ── Helper ── */
const isMobile = () => window.innerWidth <= MOB_BP;

/* ── DOM refs (resolved after DOMContentLoaded) ── */
let _shell      = null;
let _listPanel  = null;
let _detailPanel= null;

/* ── State ── */
let _mobReading = false;   // true when detail is shown on mobile

/* ─────────────────────────────────────────────────────────────
   INIT
───────────────────────────────────────────────────────────── */
document.addEventListener('DOMContentLoaded', () => {
  _shell       = document.getElementById('inbox-shell');
  _listPanel   = _shell?.querySelector('.inbox-list-panel');
  _detailPanel = _shell?.querySelector('.inbox-detail-panel');

  if (!_shell) return; // inbox not on this page

  /* Patch the existing openEmail so it also triggers mobile nav */
  patchOpenEmail();

  /* Patch deleteEmail so going back works after delete */
  patchDeleteEmail();

  /* Handle browser back gesture on mobile */
  window.addEventListener('popstate', onPopState);

  /* Reset on orientation change / window resize */
  window.addEventListener('resize', onResize, { passive: true });
});

/* ─────────────────────────────────────────────────────────────
   PATCH openEmail
   The original openEmail() is defined in inboxoro.js.
   We wrap it here without modifying the original file.
───────────────────────────────────────────────────────────── */
function patchOpenEmail() {
  const _origOpenEmail = window.openEmail;
  if (typeof _origOpenEmail !== 'function') return;

  window.openEmail = function(id) {
    /* Call the original logic first */
    _origOpenEmail(id);

    /* Then, on mobile, trigger the slide-in */
    if (isMobile()) {
      mobShowDetail();
    }
  };
}

/* ─────────────────────────────────────────────────────────────
   PATCH deleteEmail
   After deleting on mobile while reading, go back to list.
───────────────────────────────────────────────────────────── */
function patchDeleteEmail() {
  const _origDeleteEmail = window.deleteEmail;
  if (typeof _origDeleteEmail !== 'function') return;

  window.deleteEmail = function(id) {
    _origDeleteEmail(id);
    if (isMobile() && _mobReading) {
      mobBackToList(/* skipHistory */ true);
    }
  };
}

/* ─────────────────────────────────────────────────────────────
   SHOW DETAIL  (mobile only)
   Adds .mob-reading → CSS transitions handle the slide.
───────────────────────────────────────────────────────────── */
function mobShowDetail() {
  if (!_shell || _mobReading) return;
  _mobReading = true;
  _shell.classList.add('mob-reading');

  /* Push a history state so the back button works */
  history.pushState({ mobReading: true }, '', '');

  /* Scroll the detail panel to the very top */
  if (_detailPanel) _detailPanel.scrollTop = 0;
}

/* ─────────────────────────────────────────────────────────────
   BACK TO LIST  (called by the yellow back bar + popstate)
───────────────────────────────────────────────────────────── */
function mobBackToList(skipHistory = false) {
  if (!_shell) return;
  _mobReading = false;
  _shell.classList.remove('mob-reading');

  /* Pop the history entry we pushed (unless already popped) */
  if (!skipHistory) {
    history.back();
  }

  /* After the slide-out animation completes, scroll the list
     to the selected row so users can see which email they read */
  setTimeout(() => {
    const selected = _listPanel?.querySelector('.erow.selected');
    if (selected) {
      selected.scrollIntoView({ block: 'nearest', behavior: 'smooth' });
    }
  }, 300);
}

/* ─────────────────────────────────────────────────────────────
   BROWSER BACK BUTTON / GESTURE
───────────────────────────────────────────────────────────── */
function onPopState(e) {
  if (_mobReading && isMobile()) {
    mobBackToList(/* skipHistory */ true);
  }
}

/* ─────────────────────────────────────────────────────────────
   RESIZE / ORIENTATION CHANGE
   If the user rotates to landscape (desktop width) while the
   mobile detail is open, reset cleanly.
───────────────────────────────────────────────────────────── */
function onResize() {
  if (!_mobReading) return;
  if (!isMobile()) {
    /* Back on desktop — remove mobile class, restore normal layout */
    _shell.classList.remove('mob-reading');
    _mobReading = false;
  }
}

/* ─────────────────────────────────────────────────────────────
   EXPORT for Blade onclick handlers
───────────────────────────────────────────────────────────── */
window.mobBackToList = mobBackToList;