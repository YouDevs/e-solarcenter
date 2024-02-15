@extends('layouts.base')

@section('content')

<section class="bg-secondary py-4 pt-md-5">
<div class="container py-xl-2">
    <div class="row">
        <!-- Slider     -->
        <div class="col-xl-9 pt-xl-4 order-xl-2">
            <div class="tns-carousel">
                <div class="tns-carousel-hero">
                    <div>
                        <div class="row align-items-center">
                            <div class="col-md-6 order-md-2">
                                <img class="d-block mx-auto" src="{{asset('images/test3.png')}}" alt="VR Collection">
                            </div>
                            <div class="col-lg-5 col-md-6 offset-lg-1 order-md-1 pt-4 pb-md-4 text-center text-md-start">
                                <h2 class="fw-light pb-1 from-bottom">Transforma México con</h2>
                                <h1 class="display-4 from-bottom delay-1">Energía Solar</h1>
                                <h5 class="fw-light pb-3 from-bottom delay-2">Elige entre las mejores marcas</h5>
                                <div class="d-table scale-up delay-4 mx-auto mx-md-0">
                                    <a class="btn btn-primary btn-shadow" href="shop-grid-ls.html">Comprar Ahora<i class="bi bi-chevron-right ms-2 me-n1"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="row align-items-center">
                            <div class="col-md-6 order-md-2">
                                <img class="d-block mx-auto" src="{{asset('images/inverter_test.png')}}" alt="VR Collection">
                            </div>
                            <div class="col-lg-5 col-md-6 offset-lg-1 order-md-1 pt-4 pb-md-4 text-center text-md-start">
                                <h2 class="fw-light pb-1 from-start">Las mejores</h2>
                                <h1 class="display-4 from-start delay-1">Soluciones Fotovoltaicas</h1>
                                <h5 class="fw-light pb-3 from-start delay-2">del mercado</h5>
                                <div class="d-table scale-up delay-4 mx-auto mx-md-0">
                                    <a class="btn btn-primary btn-shadow" href="shop-grid-ls.html">Comprar Ahora<i class="bi ci-chevron-right ms-2 me-n1"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Banner group-->
        <div class="col-xl-3 order-xl-1 pt-4 mt-3 mt-xl-0 pt-xl-0">
            <div class="table-responsive" data-simplebar>
                <div class="d-flex d-xl-block">
                    <a class="d-flex align-items-center bg-info rounded-3 pt-2 ps-2 mb-4 me-4 me-xl-0" href="#" style="min-width: 16rem;">
                        <img src="{{asset('images/is_new_1.png')}}" width="125" alt="Banner">
                        <div class="py-4 px-2">
                            {{-- <h5 class="mb-2"><span class="fw-light">Panel</span><br>LonGi</h5> --}}
                            <h5 class="mb-2"><span class="fw-light">Panel LonGi</span><br>Hi-MO <span class="fw-light">X6</span><br>Explorer</h5>
                            <div class="text-white fs-sm">Ver<i class="bi bi-plus fs-xs ms-1"></i></div>
                        </div>
                    </a>
                    <a class="d-flex align-items-center bg-warning rounded-3 pt-2 ps-2 mb-4 me-4 me-xl-0" href="#" style="min-width: 16rem;">
                        <img src="{{asset('images/is_new_2.png')}}" width="125" alt="Banner">
                        <div class="py-4 px-2">
                            <h5 class="mb-2"><span class="fw-light">Inversor</span><br>Residencial <span class="fw-light">MIC</span> 1000</h5>
                            <div class="text-white fs-sm">Ver<i class="bi bi-plus fs-xs ms-1"></i></div>
                        </div>
                    </a>
                    <a class="d-flex align-items-center bg-success rounded-3 pt-2 ps-2 mb-4" href="#" style="min-width: 16rem;">
                        <img src="{{asset('images/is_new_3.png')}}" width="125" alt="Banner">
                        <div class="py-4 px-2">
                            <h5 class="mb-2"><span class="fw-light">Hoymiles</span><br>Microinversor <span class="fw-light">HTM</span> 2000-4T</h5>
                            <div class="text-white fs-sm">Ver<i class="bi bi-plus fs-xs ms-1"></i></div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
</section>

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

    <div class="d-flex flex-wrap justify-content-between align-items-center pt-1 border-bottom pb-4 mb-4">
        <h2 class="h3 mb-0 pt-3 me-2">{{$categoryId ? 'Productos': 'Productos en Tendencia'}}</h2>
        <div class="pt-3">
            <a class="btn btn-outline-accent btn-sm" href="shop-grid-ls.html">
                Más Productos <i class="bi bi-chevron-right ms-1 me-n1"></i>
            </a>
        </div>
    </div>

    <div class="row justify-content-center align-items-md-center" id="grid-products">
        <!-- 2do PRODUCT ORIGINAL DEL TEMPLATE (para referencia) -->
        @foreach ($products as $product)
        <div class="col-lg-3 col-md-4 col-sm-6 px-2 mb-4 pt-3">
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

    <div class="row justify-content-center mb-3">
        <div class="tns-carousel pt-3">
            <div class="tns-carousel-brands">
                <!-- Carousel slides here -->
                <div>
                    <a href="#" class="d-block bg-white border py-4 py-sm-5 px-2">
                        <img src="{{asset('brands/solar-center-fronius_large.webp')}}" class="d-block mx-auto" style="width: 165px;" alt="Alt text">
                    </a>
                </div>
                <div>
                    <a href="#" class="d-block bg-white border py-4 py-sm-5 px-2">
                        <img src="{{asset('brands/solar-center-growatt_large.webp')}}" class="d-block mx-auto" style="width: 165px;" alt="Alt text">
                    </a>
                </div>
                <div>
                    <a href="#" class="d-block bg-white border py-4 py-sm-5 px-2">
                        <img src="{{asset('brands/solar-center-hoymiles_large.webp')}}" class="d-block mx-auto" style="width: 165px;" alt="Alt text">
                    </a>
                </div>
                <div>
                    <a href="#" class="d-block bg-white border py-4 py-sm-5 px-2">
                        <img src="{{asset('brands/solar-center-risen_large.webp')}}" class="d-block mx-auto" style="width: 165px;" alt="Alt text">
                    </a>
                </div>
                <div>
                    <a href="#" class="d-block bg-white border py-4 py-sm-5 px-2">
                        <img src="{{asset('brands/solar-center-longi_large.webp')}}" class="d-block mx-auto" style="width: 165px;" alt="Alt text">
                    </a>
                </div>
                <div>
                    <a href="" class="d-block bg-white border py-4 py-sm-5 px-2">
                        <img src="{{asset('brands/solar-center-seraphim_large.webp')}}" class="d-block mx-auto" style="width: 165px;" alt="Alt text">
                    </a>
                </div>
                <div>
                    <a href="" class="d-block bg-white border py-4 py-sm-5 px-2">
                        <img src="{{asset('brands/solar-center-solis_large.webp')}}" class="d-block mx-auto" style="width: 165px;" alt="Alt text">
                    </a>
                </div>
                <div>
                    <a href="" class="d-block bg-white border py-4 py-sm-5 px-2">
                        <img src="{{asset('brands/solar-center-srne_large.webp')}}" class="d-block mx-auto" style="width: 165px;" alt="Alt text">
                    </a>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection

@section('scripts')

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Tiny Slider:
    var sliderHero = tns({
        container: '.tns-carousel-hero',
        nav: true, // Desactiva los puntos de navegación inferiores
        controls: false, // Desactiva los botones de anterior/siguiente
        mouseDrag: true,
        autoplay: true, // Activa el autoplay
        autoplayButtonOutput: false,
        autoplayTimeout: 3000, // Establece el intervalo de autoplay a 4000ms (4 segundos)
        loop: true, // Permite que el slider se repita infinitamente
        // responsive: {
        //     "0": {"items": 1},
        //     "360": {"items": 2},
        //     "600": {"items": 3},
        //     "991": {"items": 4},
        //     "1200": {"items": 4} // A partir de 1200px, muestra 4 elementos
        // }
    });

    var sliderBrands = tns({
        container: '.tns-carousel-brands',
        nav: false, // Desactiva los puntos de navegación inferiores
        controls: false, // Desactiva los botones de anterior/siguiente
        mouseDrag: true,
        autoplay: true, // Activa el autoplay
        autoplayButtonOutput: false,
        autoplayTimeout: 3000, // Establece el intervalo de autoplay a 4000ms (4 segundos)
        loop: true, // Permite que el slider se repita infinitamente
        responsive: {
            "0": {"items": 1},
            "360": {"items": 2},
            "600": {"items": 3},
            "991": {"items": 4},
            "1200": {"items": 4} // A partir de 1200px, muestra 4 elementos
        }
    });

    window.ResizeObserver = ResizeObserver;
})
</script>


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
