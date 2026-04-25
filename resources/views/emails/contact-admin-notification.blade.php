<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <title>New contact message — inboxOro</title>
  <style>
    body  { margin:0; padding:0; background:#F8FAFC; font-family:Arial,sans-serif; color:#1F2937; }
    .wrap { max-width:560px; margin:40px auto; background:#fff; border:2px solid #1F2937; }
    .hdr  { background:#1F2937; padding:20px 24px; border-bottom:3px solid #FACC15; }
    .logo { font-family:Georgia,serif; font-size:1.2rem; color:#FACC15; }
    .logo span { color:#fff; }
    .badge { display:inline-block; background:#FACC15; color:#1F2937; font-size:.65rem; font-weight:700; letter-spacing:.08em; text-transform:uppercase; padding:2px 8px; margin-left:10px; vertical-align:middle; }
    .body  { padding:24px; }
    h1    { font-size:1.1rem; margin-bottom:14px; }
    .row  { display:flex; gap:12px; padding:10px 0; border-bottom:1px solid #F3F4F6; font-size:.88rem; }
    .row:last-child { border-bottom:none; }
    .lbl  { font-family:monospace; font-size:.68rem; font-weight:700; letter-spacing:.08em; text-transform:uppercase; color:#9CA3AF; min-width:90px; flex-shrink:0; padding-top:2px; }
    .val  { color:#1F2937; word-break:break-word; line-height:1.6; }
    .msg  { background:#F8FAFC; border-left:3px solid #FACC15; padding:12px 16px; margin:4px 0; white-space:pre-wrap; font-size:.88rem; color:#374151; line-height:1.65; }
    .ftr  { padding:14px 24px; background:#F8FAFC; border-top:1px solid #E5E7EB; font-size:.76rem; color:#9CA3AF; }
  </style>
</head>
<body>
<div class="wrap">
  <div class="hdr">
    <div class="logo">inbox<span>Oro</span> <span class="badge">New Message</span></div>
  </div>
  <div class="body">
    <h1>New contact form submission</h1>
    <div class="row"><span class="lbl">ID</span>      <span class="val">#{{ $contact->id }}</span></div>
    <div class="row"><span class="lbl">Name</span>    <span class="val">{{ $contact->name }}</span></div>
    <div class="row"><span class="lbl">Email</span>   <span class="val">{{ $contact->email }}</span></div>
    <div class="row"><span class="lbl">Subject</span> <span class="val">{{ $contact->subject_label }}</span></div>
    <div class="row"><span class="lbl">IP</span>      <span class="val">{{ $contact->ip_address ?? '—' }}</span></div>
    <div class="row"><span class="lbl">Received</span><span class="val">{{ $contact->created_at->format('d M Y H:i') }} UTC</span></div>
    <div class="row">
      <span class="lbl">Message</span>
      <span class="val"><div class="msg">{{ $contact->message }}</div></span>
    </div>
  </div>
  <div class="ftr">Submitted via inboxoro.com/contact</div>
</div>
</body>
</html>