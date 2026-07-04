<!-- <div class="domain-tabs" id="dtabs">
  @foreach($domains as $i => $d)
    <button
      class="dtab {{ $i === 0 ? 'active' : '' }}"
      data-domain="{{ $d->name }}"
      onclick="selectDomain(this, '{{ $d->name }}')">
      {{ $d->name }}{{ $d->type === 'pro' ? ' ★' : '' }}
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