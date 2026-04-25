<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width,initial-scale=1"/>
  <title>We received your message — InboxOro</title>
  <style>
    body  { margin:0; padding:0; background:#F8FAFC; font-family:'Outfit',Arial,sans-serif; color:#1F2937; }
    .wrap { max-width:560px; margin:40px auto; background:#fff; border:2px solid #1F2937; box-shadow:6px 6px 0 #FACC15; }
    .hdr  { background:#1F2937; padding:24px 28px; border-bottom:3px solid #FACC15; }
    .logo { font-family:Georgia,serif; font-size:1.4rem; color:#FACC15; letter-spacing:.04em; }
    .logo span { color:#fff; }
    .body { padding:28px; }
    h1   { font-size:1.3rem; margin-bottom:14px; color:#1F2937; }
    p    { font-size:.9rem; line-height:1.7; color:#6B7280; margin-bottom:12px; }
    .detail-box { background:#F8FAFC; border:1.5px solid #E5E7EB; padding:16px 18px; margin:18px 0; }
    .detail-row { display:flex; gap:12px; margin-bottom:8px; font-size:.85rem; }
    .detail-row:last-child { margin-bottom:0; }
    .detail-label { font-family:monospace; font-size:.72rem; font-weight:700; letter-spacing:.08em; text-transform:uppercase; color:#9CA3AF; min-width:80px; flex-shrink:0; padding-top:2px; }
    .detail-value { color:#1F2937; word-break:break-word; }
    .ftr  { padding:16px 28px; border-top:1px solid #E5E7EB; font-size:.78rem; color:#9CA3AF; line-height:1.6; }
    .ftr a { color:#2563EB; text-decoration:none; }
  </style>
</head>
<body>
<div class="wrap">
  <div class="hdr">
    <div class="logo">inbox<span>Oro</span></div>
  </div>
  <div class="body">
    <h1>We received your message</h1>
    <p>Hi {{ $contact->name }}, thanks for reaching out. We've received your message and will respond within 1–2 business days.</p>
    <p>Here's a copy of what you submitted:</p>
    <div class="detail-box">
      <div class="detail-row">
        <span class="detail-label">Name</span>
        <span class="detail-value">{{ $contact->name }}</span>
      </div>
      <div class="detail-row">
        <span class="detail-label">Email</span>
        <span class="detail-value">{{ $contact->email }}</span>
      </div>
      <div class="detail-row">
        <span class="detail-label">Subject</span>
        <span class="detail-value">{{ $contact->subject_label }}</span>
      </div>
      <div class="detail-row">
        <span class="detail-label">Message</span>
        <span class="detail-value">{{ $contact->message }}</span>
      </div>
    </div>
    <p>If you did not submit this message, you can safely ignore this email.</p>
  </div>
  <div class="ftr">
    This email was sent by <a href="https://inboxoro.com">InboxOro</a> in response to a contact form submission.
    Please do not reply to this email — use <a href="mailto:support@inboxoro.com">support@inboxoro.com</a> for follow-ups.
  </div>
</div>
</body>
</html>