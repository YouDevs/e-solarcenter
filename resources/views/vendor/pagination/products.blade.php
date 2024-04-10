@if ($paginator->hasPages())
<div class="d-flex">
    @if ($paginator->onFirstPage())
        <a class="nav-link-style me-3 disabled" href="#">
            <i class="bi bi-chevron-left"></i>
        </a>
    @else
        <a class="nav-link-style me-3" href="#">
            <i class="bi bi-chevron-left"></i>
        </a>
    @endif

    <!-- Pagination Elements -->
    <!-- Muestra la cadena "página actual / total de páginas" -->
    <span class="fs-md">{{ $paginator->currentPage() }} / {{ $paginator->lastPage() }}</span>

    <!-- Next Page Link -->
    @if ($paginator->hasMorePages())
        <a class="nav-link-style ms-3" href="{{ $paginator->nextPageUrl() }}" rel="next">
            <i class="bi bi-chevron-right"></i>
        </a>
    @else
        <span class="nav-link-style ms-3 disabled">
            <i class="bi bi-chevron-right"></i>
        </span>
    @endif
</div>
@endif
