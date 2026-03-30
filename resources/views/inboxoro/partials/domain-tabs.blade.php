<div class="domain-tabs" id="dtabs">
  @foreach($domains as $i => $d)
    <button
      class="dtab {{ $i === 0 ? 'active' : '' }}"
      data-domain="{{ $d->domain }}"
      onclick="selectDomain(this, '{{ $d->domain }}')">
      {{ $d->domain }}{{ $d->is_premium ? ' ★' : '' }}
    </button>
  @endforeach
</div>