@extends('layouts.base')

@section('head')
<style>
.background-image-container {
    position: relative;
    display: flex;
    justify-content: center;
    align-items: center;
    width: 110px;
    height: 110px;
    background-size: cover;
    background-position: center;
    text-align: center;
}

.overlay-text {
    position: absolute;
    top: 10px;
    left: 50%;
    transform: translateX(-50%);
}

</style>
@endsection

@section('content')

@if (!request()->has('category_id') && !request()->has('brand'))
<section class="bg-secondary py-4 pt-md-5">
    <div class="container py-xl-2">
        <div class="row">
            <!-- Slider -->
            <div class="col-xl-9 pt-xl-4 order-xl-2">
                <div class="tns-carousel">
                    <div class="tns-carousel-hero">
                        <div>
                            <div class="row align-items-center">
                                <div class="col-md-6 order-md-2">
                                    <img class="d-block mx-auto img-fluid" src="{{asset('images/test3.png')}}" alt="VR Collection">
                                </div>
                                <div class="col-lg-5 col-md-6 offset-lg-1 order-md-1 pt-4 pb-md-4 text-center text-md-start">
                                    <h2 class="fw-light pb-1 from-bottom">Transformar a México a Través de la </h2>
                                    <h1 class="display-4 from-bottom delay-1">Energía Solar</h1>
                                    <h5 class="fw-light pb-3 from-bottom delay-2">
                                        Elige Entre las Mejores Marcas
                                    </h5>
                                    <div class="d-table scale-up delay-4 mx-auto mx-md-0">
                                        <a class="btn btn-primary btn-shadow" href="{{route('product-filter')}}">Comprar Ahora<i class="bi bi-chevron-right ms-2 me-n1"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="row align-items-center">
                                <div class="col-md-6 order-md-2">
                                    <img class="d-block mx-auto" src="{{asset('images/banner/Categoria.png')}}" alt="Descargar Catalogo">
                                </div>
                                <div class="col-lg-5 col-md-6 offset-lg-1 order-md-1 pt-4 pb-md-4 text-center text-md-start">
                                    <h2 class="fw-light pb-1 from-start">Catálogo 2024</h2>
                                    <h1 class="display-4 from-start delay-1">Conoce nuestros</h1>
                                    <h5 class="fw-light pb-3 from-start delay-2">Productos y Servicios</h5>
                                    <div class="d-table scale-up delay-4 mx-auto mx-md-0">
                                        <a class="btn btn-primary btn-shadow" href="{{asset('catalogo/solar-center-24.pdf')}}" download>
                                            Descargalo aquí!<i class="bi ci-chevron-right ms-2 me-n1"></i>
                                        </a>
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
                                    <h2 class="fw-light pb-1 from-start">Somos el Centro de</h2>
                                    <h1 class="display-4 from-start delay-1">Distribución Solar</h1>
                                    <h5 class="fw-light pb-3 from-start delay-2">Más Completo del País</h5>
                                    <div class="d-table scale-up delay-4 mx-auto mx-md-0">
                                        <a class="btn btn-primary btn-shadow" href="{{route('product-filter')}}">
                                            Comprar Ahora<i class="bi ci-chevron-right ms-2 me-n1"></i>
                                        </a>
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
                        <a class="d-flex align-items-center rounded-3 pt-2 ps-2 mb-4 me-4 me-xl-0 banner-group-item" href="#">
                            <img src="{{asset('images/is_new_1.png')}}" alt="Banner">
                            <div class="py-4 px-2">
                                <h5 class="mb-2 "><span class="fw-light">Panel LonGi</span><br>Hi-MO <span class="fw-light">X6</span><br>Explorer</h5>
                                <div class="text-white fs-sm">Ver<i class="bi bi-plus fs-xs ms-1"></i></div>
                            </div>
                        </a>
                        <a class="d-flex align-items-center rounded-3 pt-2 ps-2 mb-4 me-4 me-xl-0 banner-group-item" href="#">
                            <img src="{{asset('images/is_new_2.png')}}" alt="Banner">
                            <div class="py-4 px-2">
                                <h5 class="mb-2"><span class="fw-light">Inversor</span><br>Residencial <span class="fw-light">MIC</span> 1000</h5>
                                <div class="text-white fs-sm">Ver<i class="bi bi-plus fs-xs ms-1"></i></div>
                            </div>
                        </a>
                        <a class="d-flex align-items-center rounded-3 pt-2 ps-2 mb-4 banner-group-item" href="#">
                            <img src="{{asset('images/is_new_3.png')}}" alt="Banner">
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
@endif

<div class="container">

    <div class="d-flex flex-wrap justify-content-between align-items-center pt-1 mb-2">
        <h2 class="h3 mb-0 pt-3 me-2">Productos</h2>
        <div class="pt-3">
            <a class="btn btn-outline-blue-gray btn-sm" href="{{route('product-filter')}}">
                Más Productos <i class="bi bi-chevron-right ms-1 me-n1"></i>
            </a>
        </div>
    </div>
    <div class="d-none d-lg-flex align-items-center flex-wrap">
        <a href="productos/?category_id=1">
            <div class="background-image-container border border-1 rounded me-2" style="background-image: url('{{asset('images/categories/1.png')}}');">
                <div class="overlay-text fs-sm sc-gray">Paneles</div>
            </div>
        </a>
        <a href="productos/?category_id=2">
            <div class="background-image-container border border-1 rounded me-2" style="background-image: url('{{asset('images/categories/2.png')}}');">
                <div class="overlay-text fs-sm sc-gray">Inversores</div>
            </div>
        </a>
        <a href="productos/?category_id=3">
            <div class="background-image-container border border-1 rounded me-2" style="background-image: url('{{asset('images/categories/3.png')}}');">
                <div class="overlay-text fs-sm sc-gray">Microinversores</div>
            </div>
        </a>
        <a href="productos/?category_id=4">
            <div class="background-image-container border border-1 rounded me-2" style="background-image: url('{{asset('images/categories/5.png')}}');">
                <div class="overlay-text fs-sm sc-gray">Monitoreo</div>
            </div>
        </a>
        <a href="productos/?category_id=5">
            <div class="background-image-container border border-1 rounded" style="background-image: url('{{asset('images/categories/4.png')}}');">
                <div class="overlay-text fs-sm sc-gray">Estructuras</div>
            </div>
        </a>
    </div>

    <div class="row justify-content-center align-items-md-center" id="grid-products">
        @foreach ($products as $product)
            <div class="col-lg-3 col-md-4 col-sm-6 px-2 mb-4 pt-3">
                <div class="card product-card">
                    <a class="card-img-top d-block overflow-hidden" href="#" previewlistener="true">
                        <img src="{{Storage::url($product->featured)}}" alt="Product">
                    </a>
                    <div class="card-body py-2">
                        @auth
                            <a class="product-meta d-block fs-xs pb-1" href="#">Stock: {{ $product->totalAvailableQuantity }}</a>
                        @endauth
                        <h3 class="product-title fs-sm">
                            <a href="#" previewlistener="true">
                                {{$product->name}}
                            </a>
                        </h3>
                        @auth
                            <div class="d-flex justify-content-between">
                                <div class="product-price">
                                    <x-amount-formatter :amount="$product->defaultPrice" />
                                </div>
                            </div>
                        @endauth
                    </div>
                    <div class="card-body {{Auth::check()? 'card-body-hidden': ''}}">
                        @auth
                            <form action="{{ route('cart.store') }}" class="d-flex mb-2" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="number" class="form-control me-2" placeholder="cantidad" name="quantity" min="1" value="1">
                                <input type="hidden" value="{{ $product->id }}" name="id">
                                <input type="hidden" value="{{ $product->name }}" name="name">
                                <input type="hidden" value="{{ $product->brand }}" name="brand">
                                <input type="hidden" value="{{ $product->defaultPrice }}" name="price">
                                <input type="hidden" value="{{ $product->location }}"  name="location">
                                <button class="btn btn-primary btn-sm add-to-cart-btn" data-product-id="{{ $product->id }}" type="submit">
                                    <i class="ci-cart fs-sm me-1"></i>Agregar al Carrito
                                </button>
                            </form>
                        @endauth
                            {{-- TODO: botón comprar ahora para ahorrar el proceso de agregar al carrito. --}}
                            {{-- <a class="btn btn-solar btn-sm" type="button"><i class="ci-cart fs-sm me-1"></i>Comprar Ahora</a> --}}
                        <div class="text-center">
                            <a class="nav-link-style fs-ms" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#quick-view-{{$product->id}}">
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
                            <button class="btn-close" type="button" data-bs-dismiss="mod    al" aria-label="Close"></button>
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
                                        @auth
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
                                                    <input type="hidden" value="{{ $product->featured }}"  name="featured">
                                                    <button class="btn btn-solar btn-shadow d-block w-100" type="submit">
                                                        <i class="ci-cart fs-sm me-1"></i>Agregar al Carrito
                                                    </button>
                                                </div>
                                            </form>
                                        @endauth
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
            {{-- Brands Carousel --}}
            <div class="tns-carousel-brands">
                <div>
                    <a href="#" class="d-block bg-white border py-4 py-sm-5 px-2">
                        <img src="{{asset('brands/longi.webp')}}" class="d-block img-fluid mx-auto" style="width: 165px;" alt="Alt text">
                    </a>
                </div>
                <div>
                    <a href="#" class="d-block bg-white border py-4 py-sm-5 px-2">
                        <img src="{{asset('brands/solis.webp')}}" class="d-block img-fluid mx-auto" style="width: 165px;" alt="Alt text">
                    </a>
                </div>
                <div>
                    <a href="#" class="d-block bg-white border py-4 py-sm-5 px-2">
                        <img src="{{asset('brands/risen.webp')}}" class="d-block img-fluid mx-auto" style="width: 165px;" alt="Alt text">
                    </a>
                </div>
                <div>
                    <a href="#" class="d-block bg-white border py-4 py-sm-5 px-2">
                        <img src="{{asset('brands/s5.webp')}}" class="d-block img-fluid mx-auto" style="width: 165px;" alt="Alt text">
                    </a>
                </div>
                <div>
                    <a href="#" class="d-block bg-white border py-4 py-sm-5 px-2">
                        <img src="{{asset('brands/huawei.webp')}}" class="d-block img-fluid mx-auto" style="width: 165px;" alt="Alt text">
                    </a>
                </div>
                <div>
                    <a href="" class="d-block bg-white border py-4 py-sm-5 px-2">
                        <img src="{{asset('brands/victron.webp')}}" class="d-block img-fluid mx-auto" style="width: 165px;" alt="Alt text">
                    </a>
                </div>
                <div>
                    <a href="" class="d-block bg-white border py-4 py-sm-5 px-2">
                        <img src="{{asset('brands/trina.webp')}}" class="d-block img-fluid mx-auto" style="width: 165px;" alt="Alt text">
                    </a>
                </div>
                <div>
                    <a href="" class="d-block bg-white border py-4 py-sm-5 px-2">
                        <img src="{{asset('brands/growatt.webp')}}" class="d-block img-fluid mx-auto" style="width: 165px;" alt="Alt text">
                    </a>
                </div>
                <div>
                    <a href="" class="d-block bg-white border py-4 py-sm-5 px-2">
                        <img src="{{asset('brands/znshine.webp')}}" class="d-block img-fluid mx-auto" style="width: 165px;" alt="Alt text">
                    </a>
                </div>
                <div>
                    <a href="" class="d-block bg-white border py-4 py-sm-5 px-2">
                        <img src="{{asset('brands/unirac.webp')}}" class="d-block img-fluid mx-auto" style="width: 165px;" alt="Alt text">
                    </a>
                </div>
                <div>
                    <a href="" class="d-block bg-white border py-4 py-sm-5 px-2">
                        <img src="{{asset('brands/tw-solar.webp')}}" class="d-block img-fluid mx-auto" style="width: 165px;" alt="Alt text">
                    </a>
                </div>
                <div>
                    <a href="" class="d-block bg-white border py-4 py-sm-5 px-2">
                        <img src="{{asset('brands/fronius.webp')}}" class="d-block img-fluid mx-auto" style="width: 165px;" alt="Alt text">
                    </a>
                </div>
                <div>
                    <a href="" class="d-block bg-white border py-4 py-sm-5 px-2">
                        <img src="{{asset('brands/soluna.webp')}}" class="d-block img-fluid mx-auto" style="width: 165px;" alt="Alt text">
                    </a>
                </div>
                <div>
                    <a href="" class="d-block bg-white border py-4 py-sm-5 px-2">
                        <img src="{{asset('brands/gosolar.webp')}}" class="d-block img-fluid mx-auto" style="width: 165px;" alt="Alt text">
                    </a>
                </div>
                <div>
                    <a href="" class="d-block bg-white border py-4 py-sm-5 px-2">
                        <img src="{{asset('brands/pylontech.webp')}}" class="d-block img-fluid mx-auto" style="width: 165px;" alt="Alt text">
                    </a>
                </div>
                <div>
                    <a href="" class="d-block bg-white border py-4 py-sm-5 px-2">
                        <img src="{{asset('brands/srne.webp')}}" class="d-block mx-auto" style="max-width: 165px;" alt="Alt text">
                    </a>
                </div>
                <div>
                    <a href="" class="d-block bg-white border py-4 py-sm-5 px-2">
                        <img src="{{asset('brands/yassion.webp')}}" class="d-block img-fluid mx-auto" style="width: 165px;" alt="Alt text">
                    </a>
                </div>
                <div>
                    <a href="" class="d-block bg-white border py-4 py-sm-5 px-2">
                        <img src="{{asset('brands/zbeny.webp')}}" class="d-block img-fluid mx-auto" style="width: 165px;" alt="Alt text">
                    </a>
                </div>
                <div>
                    <a href="" class="d-block bg-white border py-4 py-sm-5 px-2">
                        <img src="{{asset('brands/parts-master.webp')}}" class="d-block img-fluid mx-auto" style="width: 165px;" alt="Alt text">
                    </a>
                </div>
                <div>
                    <a href="" class="d-block bg-white border py-4 py-sm-5 px-2">
                        <img src="{{asset('brands/xpower.webp')}}" class="d-block img-fluid mx-auto" style="width: 165px;" alt="Alt text">
                    </a>
                </div>
                <div>
                    <a href="" class="d-block bg-white border py-4 py-sm-5 px-2">
                        <img src="{{asset('brands/ultrastart.webp')}}" class="d-block img-fluid mx-auto" style="width: 165px;" alt="Alt text">
                    </a>
                </div>
                <div>
                    <a href="" class="d-block bg-white border py-4 py-sm-5 px-2">
                        <img src="{{asset('brands/yassion.webp')}}" class="d-block img-fluid mx-auto" style="width: 165px;" alt="Alt text">
                    </a>
                </div>
                <div>
                    <a href="" class="d-block bg-white border py-4 py-sm-5 px-2">
                        <img src="{{asset('brands/zbeny.webp')}}" class="d-block img-fluid mx-auto" style="width: 165px;" alt="Alt text">
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal de Selección de Sucursal -->
<div class="modal fade" tabindex="-1" role="dialog" id="selectQuantityModal" aria-labelledby="selectQuantityModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="selectQuantityModalLabel">Selecciona una Sucursal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="quantitySelectionForm">
                <div class="modal-body">
                    <!-- El formulario se generará dinámicamente aquí -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-md" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary btn-md">Agregar al Carrito</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')

<script>
document.addEventListener('DOMContentLoaded', (e) => {
    // Tiny Slider:
    let sliderHero = tns({
        container: '.tns-carousel-hero',
        nav: true, // Desactiva los puntos de navegación inferiores
        controls: false, // Desactiva los botones de anterior/siguiente
        mouseDrag: true,
        autoplay: true,
        autoplayButtonOutput: false,
        autoplayTimeout: 4000, // Establece el intervalo de autoplay a 4000ms (4 segundos)
        loop: true, // Permite que el slider se repita infinitamente
    });

    let sliderBrands = tns({
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

    // let carouselCategories = tns({
    //     container: '.tns-carousel-categories',
    //     items: 4,
    //     nav: false,
    //     controls: true,
    //     controlsText: ['<i class="bi bi-chevron-left"></i>', '<i class="bi bi-chevron-right"></i>'],
    //     responsive: {
    //         "0": {"items": 1},
    //         "500":{"items":2, "gutter": 18},
    //         "768":{"items":3, "gutter": 20},
    //         "1100":{"gutter": 24}
    //     }
    // });

    window.ResizeObserver = ResizeObserver;

    //
    document.querySelectorAll('.add-to-cart-btn').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const productId = this.getAttribute('data-product-id');

            fetch(`/cart/product/${productId}/stock`)
                .then( response => response.json() )
                .then( data => {
                    // Llenar el modal:
                    const modalBody = document.querySelector('#selectQuantityModal .modal-body');
                    modalBody.innerHTML = '';

                    // Generar campos del formulario para cada sucursal
                    data.stocks.forEach(location => {
                        const label = document.createElement('label');
                        label.textContent = `${location.name} (cantidad ${location.quantity} )`;
                        label.className = `mt-2`;
                        label.htmlFor = `quantity-${location.id}`;

                        const input = document.createElement('input');
                        input.type = 'number';
                        input.id = `quantity-${location.id}`;
                        input.name = `quantity[${location.name}]`;
                        input.min = 0;
                        input.max = location.quantity;
                        input.value = 1;
                        input.className = 'form-control';

                        modalBody.appendChild(label);
                        modalBody.appendChild(input);
                    });
                })

            let modalElement = document.getElementById('selectQuantityModal');
            let modalInstance = new bootstrap.Modal(modalElement);
            modalInstance.show();
        });
    });

    document.getElementById('quantitySelectionForm').addEventListener('submit', function(e) {
        e.preventDefault();

        const selectedQuantities = {};
        document.querySelectorAll('#selectQuantityModal input[type="number"]').forEach(input => {
            const locationName = input.name.replace('quantity[', '').replace(']', '');
            selectedQuantities[locationName] = input.value;
        });

        // Agrega el objeto de cantidades seleccionadas al formulario como antes
        const quantitiesInput = document.querySelector('input[name="quantities"]') || document.createElement('input');
        quantitiesInput.type = 'hidden';
        quantitiesInput.name = 'quantities';
        quantitiesInput.value = JSON.stringify(selectedQuantities);
        const form = document.querySelector('form[action="{{ route('cart.store') }}"]');
        form.appendChild(quantitiesInput);

        new bootstrap.Modal(document.getElementById('selectQuantityModal')).hide();

        form.submit();
    });
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
