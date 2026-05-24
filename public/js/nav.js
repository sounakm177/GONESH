(function () {
  const btn      = document.getElementById('nav-ham');
  const links    = document.getElementById('nav-links');
  const backdrop = document.getElementById('nav-backdrop');
  if (!btn || !links) return;

  const hamIcon   = btn.querySelector('.ham-icon');
  const closeIcon = btn.querySelector('.close-icon');

  function openMenu() {
    links.classList.add('open');
    backdrop.classList.add('show');
    hamIcon.style.display   = 'none';
    closeIcon.style.display = 'block';
    btn.setAttribute('aria-expanded', 'true');
    document.body.style.overflow = 'hidden'; // prevent scroll when open
  }

  function closeMenu() {
    links.classList.remove('open');
    backdrop.classList.remove('show');
    hamIcon.style.display   = 'block';
    closeIcon.style.display = 'none';
    btn.setAttribute('aria-expanded', 'false');
    document.body.style.overflow = '';
  }

  btn.addEventListener('click', () => {
    links.classList.contains('open') ? closeMenu() : openMenu();
  });

  // Close on backdrop click
  backdrop.addEventListener('click', closeMenu);

  // Close when a nav link is clicked (SPA or same-page anchors)
  links.querySelectorAll('a').forEach(a => {
    a.addEventListener('click', closeMenu);
  });

  // Close on Escape key
  document.addEventListener('keydown', e => {
    if (e.key === 'Escape') closeMenu();
  });

  // Close if window resizes to desktop width
  window.addEventListener('resize', () => {
    if (window.innerWidth >= 900) closeMenu();
  });
})();