<!-- <div class="domain-tabs" id="dtabs">
  @foreach($domains as $i => $d)
    <button
      class="dtab {{ $i === 0 ? 'active' : '' }}"
      data-domain="{{ $d->domain }}"
      onclick="selectDomain(this, '{{ $d->domain }}')">
      {{ $d->domain }}{{ $d->is_premium ? ' ★' : '' }}
    </button>
  @endforeach
</div> -->

<div class="domain-tabs" id="dtabs">

    <button class="dtab active" type="button">
       FREE TEMP EMAIL
    </button>

    <!-- <button class="dtab active" type="button">
        OTP ACCESS
    </button> -->

</div>