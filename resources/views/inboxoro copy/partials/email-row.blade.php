{{-- resources/views/inboxoro/partials/email-row.blade.php --}}
{{-- SSR email row — used for initial server-rendered inbox batch --}}
@php
  // $em is a plain object/array from MailboxService::getInbox()
  // We use object notation for Eloquent models, array for raw queries
  $id          = is_array($em) ? $em['id']          : $em->id;
  $isUnread    = is_array($em) ? !$em['is_read']     : !$em->is_read;
  $sender      = is_array($em) ? $em['sender']       : $em->senderName();
  $subject     = is_array($em) ? $em['subject']      : $em->subject;
  $preview     = is_array($em) ? ($em['preview'] ?? '') : substr(strip_tags($em->preview ?? ''), 0, 120);
  $timeAgo     = is_array($em) ? ($em['time_ago'] ?? '') : $em->timeAgo();
  $avatarLetter = is_array($em) ? ($em['avatar_letter'] ?? strtoupper(substr($sender, 0, 1))) : $em->avatarLetter();
  $avatarColor  = is_array($em) ? ($em['avatar_color'] ?? '#4B5563') : $em->avatarColor();
  $attachCount  = is_array($em) ? ($em['attachments_count'] ?? 0) : ($em->attachments_count ?? 0);
@endphp

<div class="erow {{ $isUnread ? 'unread' : '' }}"
     data-id="{{ $id }}"
     onclick="openEmail({{ $id }})">
  <div class="erow-left">
    <div class="erow-avatar" style="background:{{ $avatarColor }};">{{ $avatarLetter }}</div>
    <div class="{{ $isUnread ? 'udot-sm' : 'rdot-sm' }}"></div>
  </div>
  <div class="erow-body">
    <div class="erow-top-row">
      <span class="e-sender">{{ Str::limit($sender, 30) }}</span>
      <span class="e-time">{{ $timeAgo }}</span>
    </div>
    <div class="e-subject">{{ Str::limit($subject, 60) }}</div>
    <div class="e-preview">{{ Str::limit(strip_tags($preview), 80) }}</div>
    @if($attachCount > 0)
      <div class="e-attach-badge">
        <svg width="11" height="11" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
          <path stroke-linecap="round" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"/>
        </svg>
        {{ $attachCount }} attachment{{ $attachCount > 1 ? 's' : '' }}
      </div>
    @endif
  </div>
</div>