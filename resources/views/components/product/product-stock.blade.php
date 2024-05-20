@props(['product'])

@auth
    @if ($product->localStock)
        <span class="d-block text-muted fs-xs text-capitalize">Stock {{$product->localStock['name']}}: {{ $product->localStock['quantity'] }} </span>
    @endif
    @if ($product->nationalStock)
        <span class="d-block text-muted fs-xs text-capitalize">Stock {{$product->nationalStock['name']}}: {{ $product->nationalStock['quantity'] }}</span>
    @endif
    @if (!$product->localStock && !$product->nationalStock)
        <span class="d-block text-muted fs-xs text-capitalize">Sin Stock</span>
    @endif
@endauth