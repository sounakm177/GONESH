<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- ✅ SEO Title -->
    <title>Contact InboxOro – Temporary Email Support & Help</title>

    <!-- ✅ Meta Description -->
    <meta name="description" content="Contact InboxOro for support, questions about temporary email, or privacy tools. Get help with disposable inbox usage, OTP issues, and general enquiries.">

    <!-- ✅ Canonical -->
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- ✅ Robots -->
    <meta name="robots" content="index, follow">

    <!-- ✅ Open Graph -->
    <meta property="og:title" content="Contact InboxOro – Temporary Email Support">
    <meta property="og:description" content="Need help with InboxOro temporary email service? Contact our support team for assistance and enquiries.">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">

    <!-- Optional (add when you have image) -->
    <!-- <meta property="og:image" content="{{ asset('images/og-image.png') }}"> -->

    <!-- ✅ Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Contact InboxOro – Support">
    <meta name="twitter:description" content="Get support for InboxOro disposable email service and privacy tools.">

    <!-- Optional -->
    <!-- <meta name="twitter:image" content="{{ asset('images/og-image.png') }}"> -->

    <!-- ✅ Favicons -->
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon-32.png') }}">
    <link rel="icon" type="image/png" sizes="64x64" href="{{ asset('images/favicon-64.png') }}">

    <!-- ✅ Fonts (optimized loading) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preload" as="style" 
          href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Outfit:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;500;700&display=swap" 
          onload="this.onload=null;this.rel='stylesheet'">
    <noscript>
        <link rel="stylesheet" 
              href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Outfit:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;500;700&display=swap">
    </noscript>
    <link rel="stylesheet" href="{{ asset('css/inboxoro.css') }}">
    <link rel="stylesheet" href="{{ asset('css/contact.css') }}">

  
    <script type="application/ld+json">
        {!! isset($schema) ? json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) : '{}' !!}
    </script>

</head>
<body>

<!-- NAV -->
<header>
  {{-- NAV --}}
  @include('inboxoro.partials.nav')
</header>



<!-- HERO -->
<section class="contact-hero" aria-labelledby="contact-heading">
  <div class="hero-inner">
    <div class="hero-tag">Get in Touch</div>
    <h1 id="contact-heading">
      <span style="-webkit-text-stroke:2px rgba(255,255,255,.2);color:transparent;">SAY</span><br>
      <span class="gold">HELLO</span>
    </h1>
    <p class="hero-sub">
      Have a question about our <strong style="color:#fff;">temporary email service</strong> or <strong style="color:#fff;">privacy email tool</strong>?
      We're happy to help. Fill out the form or email us directly.
    </p>
  </div>
</section>

<!-- PAGE BODY -->
<main class="page-body">

  <!-- CONTACT FORM + INFO -->
  <section aria-labelledby="form-heading" class="rv">
    <div class="contact-grid">

      <!-- FORM -->
      <div>
        <div class="sec-label">Send a Message</div>
        <h2 class="sec-title" id="form-heading">Contact <span class="gold">Form</span></h2>

        <div class="form-card">
          <div class="form-card-title">We'll respond within 1–2 business days</div>

          <!-- Success message (shown by JS on submit) -->
          <div class="form-success" id="form-success" role="status" aria-live="polite">
            <div class="success-icon">
              <svg width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" aria-hidden="true">
                <path stroke-linecap="round" d="M5 13l4 4L19 7"/>
              </svg>
            </div>
            <div class="success-title">Message Sent!</div>
            <p class="success-sub">Thank you for reaching out. We'll get back to you within 1–2 business days.</p>
          </div>

          <!-- Form -->
          <form id="contact-form" novalidate aria-label="Contact form">
            <div class="field-group">

              <div class="field-row">
                <div class="field">
                  <label for="name">Name <span class="req" aria-label="required">*</span></label>
                  <input
                    type="text"
                    id="name"
                    name="name"
                    autocomplete="name"
                    placeholder="Your name"
                    aria-required="true"
                    aria-describedby="name-error"
                  />
                  <span class="field-error" id="name-error" role="alert">Please enter your name.</span>
                </div>
                <div class="field">
                  <label for="email">Email <span class="req" aria-label="required">*</span></label>
                  <input
                    type="email"
                    id="email"
                    name="email"
                    autocomplete="email"
                    placeholder="your@email.com"
                    aria-required="true"
                    aria-describedby="email-error"
                  />
                  <span class="field-error" id="email-error" role="alert">Please enter a valid email address.</span>
                </div>
              </div>

              <div class="field">
                <label for="subject">Subject <span class="req" aria-label="required">*</span></label>
                <select id="subject" name="subject" aria-required="true" aria-describedby="subject-error">
                  <option value="" disabled selected>Select a topic…</option>
                  <option value="general">General Enquiry</option>
                  <option value="support">Temporary Email Support</option>
                  <option value="privacy">Privacy / Data Question</option>
                  <option value="api">Developer API Interest</option>
                  <option value="abuse">Report Abuse</option>
                  <option value="other">Other</option>
                </select>
                <span class="field-error" id="subject-error" role="alert">Please select a subject.</span>
              </div>

              <div class="field">
                <label for="message">Message <span class="req" aria-label="required">*</span></label>
                <textarea
                  id="message"
                  name="message"
                  placeholder="Describe your question or issue in detail…"
                  aria-required="true"
                  aria-describedby="message-error"
                ></textarea>
                <span class="field-error" id="message-error" role="alert">Please enter a message (min. 10 characters).</span>
              </div>

              <button type="submit" class="form-submit" id="form-submit">
                Send Message →
              </button>

            </div>
          </form>
        </div>
      </div>

      <!-- CONTACT INFO -->
      <div class="info-card">

        <div>
          <div class="sec-label">Direct Email</div>
          <div class="email-box">
            <div class="email-box-label">Support Address</div>
            <div class="email-box-addr">
              <a href="mailto:support@inboxoro.com" style="color:#fff;text-decoration:none;">support@inboxoro.com</a>
            </div>
            <p class="email-box-note">For temporary email support and privacy email tool questions.</p>
          </div>
        </div>

        <div class="response-card">
          <div class="response-card-title">Response Times</div>
          <p>General enquiries: <strong>1–2 business days</strong></p>
          <p style="margin-top:6px;">Abuse reports: prioritised and reviewed promptly.</p>
          <p style="margin-top:6px;">We do not offer phone support at this time.</p>
        </div>

        <div class="response-card">
          <div class="response-card-title">Before You Write</div>
          <p>
            Many common questions are answered in our
            <a href="/blog" style="color:var(--B);">blog guides</a> and the FAQ below.
            Check there first — you may find an instant answer.
          </p>
        </div>

      </div>
    </div>
  </section>

  <hr class="divider"/>

  <!-- FAQ -->
  <section aria-labelledby="faq-heading" class="rv">
    <div class="sec-label">Common Questions</div>
    <h2 class="sec-title" id="faq-heading">FAQ</h2>

    <div class="faq-list" role="list">

      <details class="faq-item" itemscope itemtype="https://schema.org/Question">
        <summary class="faq-q" itemprop="name">
          What is a temporary email address?
          <span class="faq-icon" aria-hidden="true">+</span>
        </summary>
        <div class="faq-a" itemscope itemtype="https://schema.org/Answer" itemprop="acceptedAnswer">
          <p itemprop="text">
            A <strong>temporary email address</strong> is a short-lived, disposable email that you can use for
            sign-ups, verifications, or any situation where you don't want to share your real address.
            It works like a regular email — you can receive messages — but it expires automatically after
            a set time period. InboxOro provides a <strong>disposable email generator</strong> that creates
            these addresses instantly, with no account required.
          </p>
        </div>
      </details>

      <details class="faq-item" itemscope itemtype="https://schema.org/Question">
        <summary class="faq-q" itemprop="name">
          How long are emails stored?
          <span class="faq-icon" aria-hidden="true">+</span>
        </summary>
        <div class="faq-a" itemscope itemtype="https://schema.org/Answer" itemprop="acceptedAnswer">
          <p itemprop="text">
            The <strong>temporary inbox</strong> and all its messages are automatically deleted after the
            address expires — typically within 10 minutes, though the timer can be extended up to a maximum
            of 30 minutes per session. Once deleted, the emails are permanently gone and cannot be recovered.
            This is by design: short retention is a core part of our <strong>email privacy tool</strong> approach.
          </p>
        </div>
      </details>

      <details class="faq-item" itemscope itemtype="https://schema.org/Question">
        <summary class="faq-q" itemprop="name">
          Is InboxOro free to use?
          <span class="faq-icon" aria-hidden="true">+</span>
        </summary>
        <div class="faq-a" itemscope itemtype="https://schema.org/Answer" itemprop="acceptedAnswer">
          <p itemprop="text">
            Yes. The core <strong>temporary email service</strong> — generating addresses and reading emails
            in the inbox — is free with no account required. We may introduce optional Pro features in the future,
            but basic disposable email generation will remain available at no cost.
          </p>
        </div>
      </details>

      <details class="faq-item" itemscope itemtype="https://schema.org/Question">
        <summary class="faq-q" itemprop="name">
          Is my data private when I use this service?
          <span class="faq-icon" aria-hidden="true">+</span>
        </summary>
        <div class="faq-a" itemscope itemtype="https://schema.org/Answer" itemprop="acceptedAnswer">
          <p itemprop="text">
            We do not require any personal information to use the service — no name, no real email, no account.
            Temporary inboxes and their messages are deleted automatically after expiry.
            However, temporary inboxes are accessible to anyone who knows the address, so
            <strong>do not use them to receive sensitive, financial, or personally identifiable information.</strong>
            Review our <a href="/privacy-policy">Privacy Policy</a> for full details on data handling.
          </p>
        </div>
      </details>

      <details class="faq-item" itemscope itemtype="https://schema.org/Question">
        <summary class="faq-q" itemprop="name">
          Can I use a temporary email for important accounts?
          <span class="faq-icon" aria-hidden="true">+</span>
        </summary>
        <div class="faq-a" itemscope itemtype="https://schema.org/Answer" itemprop="acceptedAnswer">
          <p itemprop="text">
            No. Temporary email addresses are not suitable for accounts you need long-term access to
            (banking, healthcare, government services, primary social accounts). Because the inbox
            expires and the address becomes inactive, you will lose the ability to recover passwords
            or receive important account updates. Use a permanent, secure email for anything you value.
          </p>
        </div>
      </details>

      <details class="faq-item" itemscope itemtype="https://schema.org/Question">
        <summary class="faq-q" itemprop="name">
          Is a developer API available?
          <span class="faq-icon" aria-hidden="true">+</span>
        </summary>
        <div class="faq-a" itemscope itemtype="https://schema.org/Answer" itemprop="acceptedAnswer">
          <p itemprop="text">
            A developer API for programmatic <strong>temporary email</strong> generation is currently under
            development. No release date is confirmed. If you have specific integration requirements or
            would like to be notified when it's available, please use the contact form above.
          </p>
        </div>
      </details>

    </div>
  </section>

  <hr class="divider"/>

  <!-- LEGAL DISCLAIMER -->
  <section aria-labelledby="legal-heading" class="rv">
    <div class="sec-label">Legal</div>
    <h2 class="sec-title" id="legal-heading">Disclaimer</h2>
    <div class="legal-block">
      <div class="legal-block-title">Important Notice</div>
      <p>
        InboxOro provides a temporary email and disposable inbox service intended for lawful purposes only —
        such as spam protection, email privacy management, and short-term email verification tasks.
      </p>
      <p>
        This service must not be used for illegal activities, fraud, harassment, phishing, or any activity
        that violates applicable laws or third-party terms of service. Users are solely responsible for
        how they use the service.
      </p>
      <p>
        Emails received in temporary inboxes are automatically and permanently deleted after the address expires.
        We do not accept responsibility for loss of access to services where a temporary email address was
        used as a primary contact.
      </p>
      <p>
        This is a privacy and testing utility. It does not guarantee anonymity and should not be relied
        upon as a security measure for sensitive communications. See our
        <a href="/privacy-policy" style="color:var(--Y);">Privacy Policy</a> and
        <a href="/terms" style="color:var(--Y);">Terms of Service</a> for the full legal framework.
      </p>
    </div>
  </section>

</main>

<!-- FOOTER -->
@include('inboxoro.partials.footer')

<script src="{{ asset('js/nav.js') }}" defer></script>
<script>
  /* ── Scroll reveal ── */
  const io = new IntersectionObserver(entries => {
    entries.forEach(e => { if (e.isIntersecting) { e.target.classList.add('in'); io.unobserve(e.target); } });
  }, { threshold: .06, rootMargin: '0px 0px -30px 0px' });
  document.querySelectorAll('.rv').forEach(el => io.observe(el));

  /* ── FAQ icon toggle ── */
  document.querySelectorAll('.faq-item').forEach(d => {
    d.addEventListener('toggle', () => {
      const icon = d.querySelector('.faq-icon');
      if (icon) icon.textContent = d.open ? '−' : '+';
    });
  });

  /* ── Contact form validation ── */
  const form    = document.getElementById('contact-form');
  const success = document.getElementById('form-success');
  const submit  = document.getElementById('form-submit');

  function getEl(id)   { return document.getElementById(id); }
  function getErr(id)  { return document.getElementById(id + '-error'); }

  function validate(id, rule) {
    const el  = getEl(id);
    const err = getErr(id);
    const ok  = rule(el.value.trim());
    el.classList.toggle('invalid', !ok);
    err.classList.toggle('show',   !ok);
    return ok;
  }

  /* Live validation — clear error once user fixes the field */
  ['name','email','subject','message'].forEach(id => {
    const el = getEl(id);
    if (! el) return;
    el.addEventListener('input',  () => { el.classList.remove('invalid'); getErr(id).classList.remove('show'); });
    el.addEventListener('change', () => { el.classList.remove('invalid'); getErr(id).classList.remove('show'); });
  });

  


  // ============================================================
// REPLACE the "Simulate submission" block at the bottom of
// contact.blade.php's <script> with this real fetch call.
// Everything above (validation logic) stays the same.
// ============================================================

form.addEventListener('submit', async e => {
  e.preventDefault();

  const isEmail = v => /^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/.test(v);

  const ok = [
    validate('name',    v => v.length >= 2),
    validate('email',   v => isEmail(v)),
    validate('subject', v => v !== ''),
    validate('message', v => v.length >= 10),
  ].every(Boolean);

  if (! ok) {
    const first = form.querySelector('.invalid');
    if (first) first.scrollIntoView({ behavior: 'smooth', block: 'center' });
    return;
  }

  // ── Disable submit while in-flight ───────────────────────
  submit.disabled    = true;
  submit.textContent = 'Sending…';

  try {
    const res = await fetch('{{ route("contact.store") }}', {
      method:  'POST',
      headers: {
        'Content-Type':  'application/json',
        'Accept':        'application/json',
        'X-CSRF-TOKEN':  document.querySelector('meta[name="csrf-token"]')?.content ?? '',
      },
      body: JSON.stringify({
        name:    getEl('name').value.trim(),
        email:   getEl('email').value.trim(),
        subject: getEl('subject').value,
        message: getEl('message').value.trim(),
      }),
    });

    const data = await res.json();

    if (res.ok) {
      // ── Success ──────────────────────────────────────────
      form.style.display = 'none';
      success.classList.add('show');

    } else if (res.status === 422) {
      // ── Laravel validation errors ─────────────────────────
      const errors = data.errors ?? {};
      Object.entries(errors).forEach(([field, msgs]) => {
        const el  = getEl(field);
        const err = getErr(field);
        if (el)  el.classList.add('invalid');
        if (err) { err.textContent = msgs[0]; err.classList.add('show'); }
      });
      const first = form.querySelector('.invalid');
      if (first) first.scrollIntoView({ behavior: 'smooth', block: 'center' });

    } else if (res.status === 429) {
      // ── Rate limited ──────────────────────────────────────
      showFormError('Too many submissions. Please wait a minute and try again.');

    } else {
      showFormError(data.message ?? 'Something went wrong. Please email us directly.');
    }

  } catch (err) {
    console.error('[Contact] Submit failed:', err);
    showFormError('Could not send message. Please email support@inboxoro.com directly.');

  } finally {
    if (! success.classList.contains('show')) {
      submit.disabled    = false;
      submit.textContent = 'Send Message →';
    }
  }
});

// ── Inline form-level error (non-field errors) ───────────────
function showFormError(msg) {
  let box = document.getElementById('form-level-error');
  if (! box) {
    box = document.createElement('p');
    box.id = 'form-level-error';
    box.style.cssText = `
      font-family: 'JetBrains Mono', monospace;
      font-size: .72rem;
      color: #DC2626;
      background: rgba(220,38,38,.06);
      border: 1.5px solid #DC2626;
      padding: 10px 14px;
      margin-top: 12px;
    `;
    submit.insertAdjacentElement('afterend', box);
  }
  box.textContent = msg;
}

</script>

</body>
</html>