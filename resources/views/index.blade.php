@extends('layouts.base')

@section('content')
<div class="container">
    <div class="row justify-content-center mb-4">
        {{-- <h2 class="text-center mb-4">Familias de productos</h2>
        <div class="col-md-2 text-center">
            <a href="/paneles">
                <img src="{{asset('images/panel.png')}}" width="40" alt="Panel">
                <p>Paneles</p>
            </a>
        </div>
        <div class="col-md-2 text-center">
            <a href="/inversores">
                <img src="{{asset('images/inverter.png')}}" width="40" alt="Panel">
                <p>Inversores</p>
            </a>
        </div>
        <div class="col-md-2 text-center">
            <a href="/microinversores">
                <img src="{{asset('images/microinversor.png')}}" width="40" alt="Panel">
                <p>Microinversores</p>
            </a>
        </div>
        <div class="col-md-2 text-center">
            <a href="/monitor">
                <img src="{{asset('images/monitor.png')}}" width="40" alt="Panel">
                <p>Monitor</p>
            </a>
        </div>
        <div class="col-md-2 text-center">
            <a href="/estructuras">
                <img src="{{asset('images/structures.png')}}" width="40" alt="Panel">
                <p>Estructuras</p>
            </a>
        </div> --}}
        <!-- 1er PRODUCT ORIGINAL DEL TEMPLATE (para referencia)
        <div class="col-lg-3 col-md-4 col-sm-6 px-2 mb-4">
            <div class="card product-card">
                {{-- <button class="btn-wishlist btn-sm" type="button" data-bs-toggle="tooltip" data-bs-placement="left" aria-label="Add to wishlist" data-bs-original-title="Add to wishlist">
                    <i class="ci-heart"></i>
                </button> --}}
                <a class="card-img-top d-block overflow-hidden" href="#" previewlistener="true">
                    <img src="{ {asset('images/panel.webp')}}" alt="Product">
                </a>
                <div class="card-body py-2">
                    <a class="product-meta d-block fs-xs pb-1" href="#">Paneles</a>
                    <h3 class="product-title fs-sm fw-bold">
                        <a href="#" previewlistener="true">RISEN MONO PERC HALF CELL 450W</a>
                    </h3>
                    <div class="d-flex justify-content-between">
                        <div class="product-price">
                            <span class="text-accent">$154.<small>00</small></span>
                        </div>
                        {{-- TODO: Sistema de calificación --}}
                        {{-- <div class="star-rating">
                            <i class="star-rating-icon bi bi-star-fill active"></i>
                            <i class="star-rating-icon bi bi-star-fill active"></i>
                            <i class="star-rating-icon bi bi-star-fill active"></i>
                            <i class="star-rating-icon bi-star-half active"></i>
                            <i class="star-rating-icon bi bi-star"></i>
                        </div> --}}
                    </div>
                </div>
                <div class="card-body card-body-hidden">
                    <div class="text-center pb-2">
                        {{-- <div class="form-check form-option form-check-inline mb-2">
                            <input class="form-check-input" type="radio" name="size1" id="s-75">
                            <label class="form-option-label" for="s-75">7.5</label>
                        </div>
                        <div class="form-check form-option form-check-inline mb-2">
                            <input class="form-check-input" type="radio" name="size1" id="s-80" checked="">
                            <label class="form-option-label" for="s-80">8</label>
                        </div>
                        <div class="form-check form-option form-check-inline mb-2">
                            <input class="form-check-input" type="radio" name="size1" id="s-85">
                            <label class="form-option-label" for="s-85">8.5</label>
                        </div>
                        <div class="form-check form-option form-check-inline mb-2">
                            <input class="form-check-input" type="radio" name="size1" id="s-90">
                            <label class="form-option-label" for="s-90">9</label>
                        </div> --}}
                    </div>
                    <button class="btn btn-solar btn-sm d-block w-100 mb-2" type="button"><i class="ci-cart fs-sm me-1"></i>Agregar al Carrito</button>
                    <div class="text-center"><a class="nav-link-style fs-ms" href="#quick-view" data-bs-toggle="modal"><i class="ci-eye align-middle me-1"></i>Quick view</a></div>
                </div>
            </div>
            <hr class="d-sm-none">
        </div>
        -->
    </div>
    <div class="row justify-content-center align-items-md-center" id="grid-products">
        <!-- 2do PRODUCT ORIGINAL DEL TEMPLATE (para referencia) -->
        @foreach ($products as $product)
        <div class="col-lg-3 col-md-4 col-sm-6 px-2 mb-4">
            <div class="card product-card">
                {{-- <span class="badge badge-danger badge-shadow">Sale</span> --}}
                {{-- <button class="btn-wishlist btn-sm" type="button" data-bs-toggle="tooltip" data-bs-placement="left" aria-label="Add to wishlist" data-bs-original-title="Add to wishlist">
                    <i class="bi bi-heart"></i>
                </button> --}}
                <a class="card-img-top d-block overflow-hidden" href="#" previewlistener="true">
                    <img src="{{Storage::url($product->featured)}}" alt="Product">
                </a>
                <div class="card-body py-2">
                    <a class="product-meta d-block fs-xs pb-1" href="#">stock: {{ $product->netsuite_stock }}</a>
                    <h3 class="product-title fs-sm">
                        <a href="#" previewlistener="true">
                            {{$product->name}}
                        </a>
                    </h3>
                    <div class="d-flex justify-content-between">
                        <div class="product-price">
                            <x-amount-formatter :amount="$product->price" />
                            {{-- TODO: sistema de descuentos. --}}
                            {{-- <del class="fs-sm text-muted">$38.<small>50</small></del> --}}
                        </div>
                    {{-- <div class="star-rating">
                            <i class="star-rating-icon bi bi-star-fill active"></i>
                            <i class="star-rating-icon bi bi-star-fill active"></i>
                            <i class="star-rating-icon bi bi-star-fill active"></i>
                            <i class="star-rating-icon bi-star-half active"></i>
                            <i class="star-rating-icon bi bi-star"></i>
                        </div> --}}
                    </div>
                </div>
                <div class="card-body card-body-hidden">
                    {{-- <div class="text-center pb-2">
                        <div class="form-check form-option form-check-inline mb-2">
                            <input class="form-check-input" type="radio" name="color1" id="white" checked="">
                            <label class="form-option-label rounded-circle" for="white"><span class="form-option-color rounded-circle" style="background-color: #eaeaeb;"></span></label>
                        </div>
                        <div class="form-check form-option form-check-inline mb-2">
                            <input class="form-check-input" type="radio" name="color1" id="blue">
                            <label class="form-option-label rounded-circle" for="blue"><span class="form-option-color rounded-circle" style="background-color: #d1dceb;"></span></label>
                        </div>
                        <div class="form-check form-option form-check-inline mb-2">
                            <input class="form-check-input" type="radio" name="color1" id="yellow">
                            <label class="form-option-label rounded-circle" for="yellow"><span class="form-option-color rounded-circle" style="background-color: #f4e6a2;"></span></label>
                        </div>
                        <div class="form-check form-option form-check-inline mb-2">
                            <input class="form-check-input" type="radio" name="color1" id="pink">
                            <label class="form-option-label rounded-circle" for="pink"><span class="form-option-color rounded-circle" style="background-color: #f3dcff;"></span></label>
                        </div>
                    </div>--}}
                    {{-- <div class="d-flex mb-2"> --}}
                        {{-- <select class="form-select form-select-sm me-2">
                            <option>XS</option>
                            <option>S</option>
                            <option>M</option>
                            <option>L</option>
                            <option>XL</option>
                        </select> --}}
                        <form action="{{ route('cart.store') }}" class="d-flex mb-2" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="number" class="form-control me-2" placeholder="cantidad" name="quantity" min="1" value="1">
                            <input type="hidden" value="{{ $product->id }}" name="id">
                            <input type="hidden" value="{{ $product->name }}" name="name">
                            <input type="hidden" value="{{ $product->brand }}" name="brand">
                            <input type="hidden" value="{{ $product->price }}" name="price">
                            <input type="hidden" value="{{ $product->sku }}" name="sku">
                            <input type="hidden" value="{{ $product->featured }}"  name="featured">
                            {{-- <button class="px-4 py-1.5 text-white text-sm bg-blue-800 rounded">Add To Cart</button> --}}
                            <button class="btn btn-solar btn-sm" type="submit"><i class="ci-cart fs-sm me-1"></i>Agregar al Carrito</button>
                        </form>
                        {{-- TODO: botón comprar ahora para ahorrar el proceso de agregar al carrito. --}}
                        {{-- <a class="btn btn-solar btn-sm" type="button"><i class="ci-cart fs-sm me-1"></i>Comprar Ahora</a> --}}
                    {{-- </div> --}}
                    <div class="text-center">
                        <a class="nav-link-style fs-ms" data-bs-toggle="modal" data-bs-target="#quick-view-{{$product->id}}">
                            <i class="bi bi-eye"></i> Vista rápida
                        </a>
                    </div>
                </div>
            </div>
            <hr class="d-sm-none">
        </div>

        <div class="modal fade modal-quick-view" id="quick-view-{{$product->id}}" tabindex="-1" aria-labelledby="quickViewLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title product-title" id="quickViewLabel">
                            <a href="shop-single-v1.html" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Go to product page">
                                {{$product->name}}
                            </a>
                        </h4>
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <!-- Product gallery-->
                            <div class="col-lg-7 pe-lg-0">
                                <div class="product-gallery">
                                    <div class="product-gallery-preview order-sm-2">
                                        <div class="product-gallery-preview-item active">
                                            <img src="{{$product->featured_url}}" alt="Product">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Product details-->
                            <div class="col-lg-5 pt-4 pt-lg-0 image-zoom-pane">
                                <div class="product-details ms-auto pb-3">
                                    <div class="mb-3">
                                        <x-amount-formatter :amount="$product->price" />
                                    </div>
                                    <div class="fs-sm mb-4">
                                        <span class="text-heading fw-medium me-1">Stock:</span>
                                        <span class="text-muted" id="colorOptionText">1</span>
                                    </div>
                                    <form action="{{ route('cart.store') }}" class="mb-grid-gutter" method="POST" enctype="multipart/form-data">
                                        <div class="mb-3 d-flex align-items-center">
                                            @csrf
                                            <input type="number" class="form-control me-3" placeholder="cantidad" name="quantity" min="1" value="1">
                                            <input type="hidden" value="{{ $product->id }}" name="id">
                                            <input type="hidden" value="{{ $product->name }}" name="name">
                                            <input type="hidden" value="{{ $product->brand }}" name="brand">
                                            <input type="hidden" value="{{ $product->price }}" name="price">
                                            <input type="hidden" value="{{ $product->sku }}" name="sku">
                                            <input type="hidden" value="{{ $product->featured }}"  name="featured">
                                            <button class="btn btn-solar btn-shadow d-block w-100" type="submit">
                                                <i class="ci-cart fs-sm me-1"></i>Agregar al Carrito
                                            </button>
                                        </div>
                                    </form>
                                    @if (!is_null($product->data_sheet_url))
                                        <a
                                            href="{{$product->data_sheet_url}}"
                                            class="btn btn-outline-accent float-end"
                                            target="_blank">
                                            Ficha Técnica
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @endforeach
    </div>
</div>

@endsection

@section('scripts')

@if (session('message'))
<script>
    Swal.fire({
        position: "center",
        icon: "{{ session('icon') }}",
        title: "{{ session('message') }}",
        showConfirmButton: false,
        timer: 2000,
    });
</script>
@endif

<script>
document.getElementById('search-product').addEventListener('input', function(e) {
    const searchTerm = e.target.value

    console.log(`busqueda ${searchTerm}`)

    // Verifica si el término de búsqueda no está vacío
    if (searchTerm.length) {
        fetch(`/buscar-productos?search_term=${searchTerm}`)
        .then(response => response.json())
        .then(data => {
            const gridProducts = document.getElementById('grid-products');
            gridProducts.innerHTML = ``; // Limpiar resultados anteriores
            data.products.forEach(product => {
                const price = formattedAmount(product.price);
                gridProducts.innerHTML += `<div class="col-lg-3 col-md-4 col-sm-6 px-2 mb-4" id="grid-products">
                                                <div class="card product-card">
                                                    <a class="card-img-top d-block overflow-hidden" href="#" previewlistener="true">
                                                        <img src="${product.featured_url}" alt="${product.name}">
                                                    </a>
                                                    <div class="card-body py-2"><a class="product-meta d-block fs-xs pb-1" href="#">stock: ${product.netsuite_stock}</a>
                                                        <h3 class="product-title fs-sm">
                                                            <a href="#" previewlistener="true">
                                                                ${product.name}
                                                            </a>
                                                        </h3>
                                                        <div class="d-flex justify-content-between">
                                                            <div class="product-price">
                                                                $${price.whole}.<small>${price.decimal}</small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-body card-body-hidden">
                                                            <form action="/cart" class="d-flex mb-2" method="POST" enctype="multipart/form-data">
                                                                @csrf
                                                                <input type="number" class="form-control me-2" placeholder="cantidad" name="quantity" min="1" value="1">
                                                                <input type="hidden" value="${product.id}" name="id">
                                                                <input type="hidden" value="${product.name}" name="name">
                                                                <input type="hidden" value="${product.brand}" name="brand">
                                                                <input type="hidden" value="${product.price }" name="price">
                                                                <input type="hidden" value="${product.sku }" name="sku">
                                                                <input type="hidden" value="${product.featured }"  name="featured">
                                                                <button class="btn btn-solar btn-sm" type="submit"><i class="ci-cart fs-sm me-1"></i>Agregar al Carrito</button>
                                                            </form>
                                                        <div class="text-center">
                                                            <a class="nav-link-style fs-ms" data-bs-toggle="modal" data-bs-target="#quick-view-${product.id}">
                                                                <i class="bi bi-eye"></i> Vista rápida
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr class="d-sm-none">
                                            </div>
                                            <div class="modal fade modal-quick-view" id="quick-view-${product.id}" tabindex="-1" aria-labelledby="quickViewLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-xl">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title product-title" id="quickViewLabel">
                                                                <a data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Go to product page">
                                                                    ${product.name}
                                                                </a>
                                                            </h4>
                                                            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-lg-7 pe-lg-0">
                                                                    <div class="product-gallery">
                                                                        <div class="product-gallery-preview order-sm-2">
                                                                            <div class="product-gallery-preview-item active">
                                                                                <img src="${product.featured_url}" alt="Product">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-5 pt-4 pt-lg-0 image-zoom-pane">
                                                                    <div class="product-details ms-auto pb-3">
                                                                        <div class="mb-3">
                                                                            <div class="product-price">
                                                                                $${price.whole}.<small>${price.decimal}</small>
                                                                            </div>
                                                                        </div>
                                                                        <div class="fs-sm mb-4">
                                                                            <span class="text-heading fw-medium me-1">Stock:</span>
                                                                            <span class="text-muted">1</span>
                                                                        </div>
                                                                        <form action="/cart" class="mb-grid-gutter" method="POST" enctype="multipart/form-data">
                                                                            <div class="mb-3 d-flex align-items-center">
                                                                                @csrf
                                                                                <input type="number" class="form-control me-3" placeholder="cantidad" name="quantity" min="1" value="1">
                                                                                <input type="hidden" value="${product.id}" name="id">
                                                                                <input type="hidden" value="${product.name}" name="name">
                                                                                <input type="hidden" value="${product.brand}" name="brand">
                                                                                <input type="hidden" value="${product.price}" name="price">
                                                                                <input type="hidden" value="${product.sku}" name="sku">
                                                                                <input type="hidden" value="${product.featured}"  name="featured">
                                                                                <button class="btn btn-solar btn-shadow d-block w-100" type="submit">
                                                                                    <i class="ci-cart fs-sm me-1"></i>Agregar al Carrito
                                                                                </button>
                                                                            </div>
                                                                        </form>
                                                                        <a
                                                                            href="{{$product->data_sheet_url}}"
                                                                            class="btn btn-outline-accent float-end"
                                                                            target="_blank">
                                                                            Ficha Técnica
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            `;
            });
        })
        .catch(error => console.error('Error:', error));
    }
});

function formattedAmount(amount) {
    const formatter = new Intl.NumberFormat('es-ES', {
        style: 'currency',
        currency: 'MXN', // Ajusta esto a tu moneda local
        minimumFractionDigits: 2
    });

    // Extraemos la parte entera y decimal del monto formateado
    const parts = formatter.formatToParts(amount);
    let whole = '';
    let decimal = '';

    parts.forEach(part => {
        if (part.type === 'integer' || part.type === 'group') {
            whole += part.value;
        } else if (part.type === 'decimal') {
            decimal = part.value;
        } else if (part.type === 'fraction') {
            decimal += part.value;
        }
    });

    // Devuelve un objeto con las partes entera y decimal
    return {
        whole: whole,
        decimal: decimal
    };
}
</script>

@endsection
