{{-- Used both by SSR (Blade loop) and JS renderEmailRow() helper --}}
<div class="erow {{ !$em->is_read ? 'unread' : '' }}"
     data-id="{{ $em->id }}"
     onclick="openEmail({{ $em->id }})">

  <div class="erow-left">
    <div class="erow-avatar" style="background:{{ $em->avatar_color ?? '#4B5563' }};">
      {{ $em->avatar_letter ?? '?' }}
    </div>
    <div class="{{ !$em->is_read ? 'udot-sm' : 'rdot-sm' }}"></div>
  </div>

  <div class="erow-body">
    <div class="erow-top-row">
      <span class="e-sender">{{ $em->sender }}</span>
      <span class="e-time">{{ $em->time_ago ?? $em->received_at }}</span>
    </div>
    <div class="e-subject">{{ $em->subject }}</div>
    <div class="e-preview">{{ $em->preview ?? '' }}</div>

    @if($em->attachments_count > 0)
      <div class="e-attach-badge">
        <svg width="11" height="11" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
          <path stroke-linecap="round" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"/>
        </svg>
        {{ $em->attachments_count }} attachment{{ $em->attachments_count > 1 ? 's' : '' }}
      </div>
    @endif
  </div>

</div>