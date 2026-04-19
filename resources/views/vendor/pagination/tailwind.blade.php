@if ($paginator->hasPages())
<nav class="pagination" aria-label="Blog pages">

    {{-- Previous Button --}}
    @if ($paginator->onFirstPage())
        <button class="pg-btn arrow" disabled>← Prev</button>
    @else
        <a href="{{ $paginator->previousPageUrl() }}" class="pg-btn arrow">← Prev</a>
    @endif

    {{-- Page Numbers --}}
    @foreach ($elements as $element)

        {{-- "..." Separator --}}
        @if (is_string($element))
            <span style="font-family:var(--MONO);font-size:.66rem;color:var(--MU);padding:0 4px;">
                {{ $element }}
            </span>
        @endif

        {{-- Page Links --}}
        @if (is_array($element))
            @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                    <button class="pg-btn active" aria-current="page">{{ $page }}</button>
                @else
                    <a href="{{ $url }}" class="pg-btn">{{ $page }}</a>
                @endif
            @endforeach
        @endif

    @endforeach

    {{-- Next Button --}}
    @if ($paginator->hasMorePages())
        <a href="{{ $paginator->nextPageUrl() }}" class="pg-btn arrow">Next →</a>
    @else
        <button class="pg-btn arrow" disabled>Next →</button>
    @endif

</nav>
@endif