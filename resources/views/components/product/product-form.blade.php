@props(['product'])

<form action="{{ route('cart.store') }}" class="d-flex mb-2" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="hidden" value="{{ $product->id }}" name="id">
    <input type="hidden" value="{{ $product->name }}" name="name">
    <input type="hidden" value="{{ $product->brand }}" name="brand">
    <input type="hidden" value="{{ $product->defaultPrice }}" name="price">
    <input type="hidden" value="{{ $product->featured }}" name="featured">
    <input type="hidden" value="{{ $product->weight }}" name="weight">
    <input type="hidden" value="{{ $product->length }}" name="length">
    <input type="hidden" value="{{ $product->width }}" name="width">
    <input type="hidden" value="{{ $product->height }}" name="height">
    <input
        type="number" class="form-control me-2 {{ !$product->localStock && $product->nationalStock ? 'd-none' : '' }}"
        placeholder="cantidad" name="quantity"
        min="1" value="1"
        data-national-quantity="{{$product->nationalStock ? $product->nationalStock['quantity']: null}}"
        data-local-quantity="{{$product->localStock ? $product->localStock['quantity']: null}}"
        max="{{ $product->localStock ? $product->localStock['quantity'] + ($product->nationalStock ? $product->nationalStock['quantity'] : 0) : 0 }}"
        {{ $product->localStock || $product->nationalStock ? '' : 'disabled' }}
    >

    <button
        class="btn btn-primary btn-sm add-to-cart-btn {{ $product->localStock || $product->nationalStock ? '' : 'btn-request-assistance' }}"
        data-product-id="{{ $product->id }}"
        data-location-id="{{ auth()->user()->customer->location_id ?? null }}"
        type="submit"
        {{ $product->localStock || $product->nationalStock ? '' : 'data-bs-toggle=modal data-bs-target=#assistanceModal' }}
    >
        <i class="ci-cart fs-sm me-1"></i>
        @if ($product->localStock)
            Agregar al Carrito
        @elseif ($product->nationalStock)
            Agregar de Stock Nacional
        @else
            Solicitar Asesoría
        @endif
    </button>
</form>
