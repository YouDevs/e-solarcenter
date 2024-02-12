@extends('layouts.base')

@section('content')
<!-- Page Title-->
<div class="page-title-overlap bg-dark pt-4">
    <div class="container d-lg-flex justify-content-between py-2 py-lg-3">
        {{-- <div class="order-lg-2 mb-3 mb-lg-0 pt-lg-2">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-light flex-lg-nowrap justify-content-center justify-content-lg-start">
                    <li class="breadcrumb-item"><a class="text-nowrap" href="index.html"><i class="ci-home"></i>Home</a></li>
                    <li class="breadcrumb-item text-nowrap"><a href="shop-grid-ls.html">Shop</a>
                    </li>
                    <li class="breadcrumb-item text-nowrap active" aria-current="page">Checkout</li>
                </ol>
            </nav>
        </div> --}}
        <div class="order-lg-1 pe-lg-4 text-center text-lg-start">
            <h1 class="h3 text-light mb-0">{{$product->name}}</h1>
        </div>
    </div>
</div>

<div class="container">
    <!-- Gallery + details-->
    <div class="bg-light shadow-lg rounded-3 px-4 py-3 mb-5">
        <div class="px-lg-3">
            <div class="row">
                <!-- Product gallery-->
                <div class="col-lg-7 pe-lg-0 pt-lg-4">
                    <img src="{{Storage::url($product->featured)}}" alt="Product" class="img-fluid w-100">
                </div>
                <!-- Product details-->
                <div class="col-lg-5 pt-4 pt-lg-0">
                    <div class="product-details ms-auto pb-3">
                        <div class="mb-3">
                            <span class="h3 fw-normal text-accent me-1">
                                <x-amount-formatter :amount="$product->price" />
                            </span>
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
                                <button class="btn btn-solar btn-shadow d-block w-100" type="submit"><i class="bi bi-cart fs-lg me-2"></i>Agregar al Carrito</button>
                            </div>
                        </form>
                        <!-- Product panels-->
                        <div class="accordion mb-4" id="productPanels">
                            <div class="accordion-item">
                                <h3 class="accordion-header">
                                    <a class="accordion-button" href="#productInfo" role="button" data-bs-toggle="collapse" aria-expanded="true" aria-controls="productInfo">
                                    <i class="ci-announcement text-muted fs-lg align-middle mt-n1 me-2"></i>Información del Producto</a>
                                </h3>
                                <div class="accordion-collapse collapse show" id="productInfo" data-bs-parent="#productPanels">
                                    <div class="accordion-body">
                                        <h6 class="fs-sm mb-2">{{$product->name}}</h6>
                                        <p>{{$product->description}}</p>
                                        <ul class="fs-sm ps-4">
                                            <li>Elastic rib: Cotton 95%, Elastane 5%</li>
                                            <li>Lining: Cotton 100%</li>
                                            <li>Cotton 80%, Polyester 20%</li>
                                        </ul>
                                        <h6 class="fs-sm mb-2">Stock</h6>
                                        <ul class="fs-sm ps-4 mb-0">
                                            <li>{{$product->netsuite_stock? $product->netsuite_stock: ''}}</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="accordion-item">
                                <h3 class="accordion-header"><a class="accordion-button collapsed" href="#shippingOptions" role="button" data-bs-toggle="collapse" aria-expanded="true" aria-controls="shippingOptions"><i class="ci-delivery text-muted lead align-middle mt-n1 me-2"></i>Shipping options</a></h3>
                                <div class="accordion-collapse collapse" id="shippingOptions" data-bs-parent="#productPanels">
                                <div class="accordion-body fs-sm">
                                    <div class="d-flex justify-content-between border-bottom pb-2">
                                    <div>
                                        <div class="fw-semibold text-dark">Courier</div>
                                        <div class="fs-sm text-muted">2 - 4 days</div>
                                    </div>
                                    <div>$26.50</div>
                                    </div>
                                    <div class="d-flex justify-content-between border-bottom py-2">
                                    <div>
                                        <div class="fw-semibold text-dark">Local shipping</div>
                                        <div class="fs-sm text-muted">up to one week</div>
                                    </div>
                                    <div>$10.00</div>
                                    </div>
                                    <div class="d-flex justify-content-between border-bottom py-2">
                                    <div>
                                        <div class="fw-semibold text-dark">Flat rate</div>
                                        <div class="fs-sm text-muted">5 - 7 days</div>
                                    </div>
                                    <div>$33.85</div>
                                    </div>
                                    <div class="d-flex justify-content-between border-bottom py-2">
                                    <div>
                                        <div class="fw-semibold text-dark">UPS ground shipping</div>
                                        <div class="fs-sm text-muted">4 - 6 days</div>
                                    </div>
                                    <div>$18.00</div>
                                    </div>
                                    <div class="d-flex justify-content-between pt-2">
                                    <div>
                                        <div class="fw-semibold text-dark">Local pickup from store</div>
                                        <div class="fs-sm text-muted">—</div>
                                    </div>
                                    <div>$0.00</div>
                                    </div>
                                </div>
                                </div>
                            </div> --}}
                        </div>
                        <!-- Sharing-->
                        {{-- <label class="form-label d-inline-block align-middle my-2 me-3">Share:</label><a class="btn-share btn-twitter me-2 my-2" href="#"><i class="ci-twitter"></i>Twitter</a><a class="btn-share btn-instagram me-2 my-2" href="#"><i class="ci-instagram"></i>Instagram</a><a class="btn-share btn-facebook my-2" href="#"><i class="ci-facebook"></i>Facebook</a> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Product description section 1-->
    {{-- <div class="row align-items-center py-md-3">
        <div class="col-lg-5 col-md-6 offset-lg-1 order-md-2"><img class="d-block rounded-3" src="img/shop/single/prod-img.jpg" alt="Image"></div>
        <div class="col-lg-4 col-md-6 offset-lg-1 py-4 order-md-1">
            <h2 class="h3 mb-4 pb-2">High quality materials</h2>
            <h6 class="fs-base mb-3">Soft cotton blend</h6>
            <p class="fs-sm text-muted pb-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Duis aute irure dolor in reprehenderit.</p>
            <h6 class="fs-base mb-3">Washing instructions</h6>
            <ul class="nav nav-tabs mb-3" role="tablist">
                <li class="nav-item" role="presentation"><a class="nav-link active" href="#wash" data-bs-toggle="tab" role="tab" aria-selected="true"><i class="ci-wash fs-xl"></i></a></li>
                <li class="nav-item" role="presentation"><a class="nav-link" href="#bleach" data-bs-toggle="tab" role="tab" aria-selected="false" tabindex="-1"><i class="ci-bleach fs-xl"></i></a></li>
                <li class="nav-item" role="presentation"><a class="nav-link" href="#hand-wash" data-bs-toggle="tab" role="tab" aria-selected="false" tabindex="-1"><i class="ci-hand-wash fs-xl"></i></a></li>
                <li class="nav-item" role="presentation"><a class="nav-link" href="#ironing" data-bs-toggle="tab" role="tab" aria-selected="false" tabindex="-1"><i class="ci-ironing fs-xl"></i></a></li>
                <li class="nav-item" role="presentation"><a class="nav-link" href="#dry-clean" data-bs-toggle="tab" role="tab" aria-selected="false" tabindex="-1"><i class="ci-dry-clean fs-xl"></i></a></li>
            </ul>
            <div class="tab-content text-muted fs-sm">
                <div class="tab-pane fade show active" id="wash" role="tabpanel">30° mild machine washing</div>
                <div class="tab-pane fade" id="bleach" role="tabpanel">Do not use any bleach</div>
                <div class="tab-pane fade" id="hand-wash" role="tabpanel">Hand wash normal (30°)</div>
                <div class="tab-pane fade" id="ironing" role="tabpanel">Low temperature ironing</div>
                <div class="tab-pane fade" id="dry-clean" role="tabpanel">Do not dry clean</div>
            </div>
        </div>
    </div> --}}
    <!-- Product description section 2-->
    {{-- <div class="row align-items-center py-4 py-lg-5">
        <div class="col-lg-5 col-md-6 offset-lg-1"><img class="d-block rounded-3" src="img/shop/single/prod-map.png" alt="Map"></div>
        <div class="col-lg-4 col-md-6 offset-lg-1 py-4">
            <h2 class="h3 mb-4 pb-2">Where is it made?</h2>
            <h6 class="fs-base mb-3">Apparel Manufacturer, Ltd.</h6>
            <p class="fs-sm text-muted pb-2">​Sam Tower, 6 Road No 32, Dhaka 1875, Bangladesh</p>
            <div class="d-flex mb-2">
            <div class="me-4 pe-2 text-center">
            <h4 class="h2 text-accent mb-1">3258</h4>
            <p>Workers</p>
            </div>
            <div class="me-4 pe-2 text-center">
            <h4 class="h2 text-accent mb-1">43%</h4>
            <p>Female</p>
            </div>
            <div class="text-center">
            <h4 class="h2 text-accent mb-1">57%</h4>
            <p>Male</p>
            </div>
            </div>
            <h6 class="fs-base mb-3">Factory information</h6>
            <p class="fs-sm text-muted pb-md-2">​Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore.</p>
        </div>
    </div> --}}
</div>

<!-- Product carousel (You may also like)-->
<div class="container py-5 my-md-3">
    <h2 class="h3 text-center pb-4">Productos Relacionados</h2>
    <div class="tns-carousel pt-3">
        <div class="tns-carousel-inner">
        @foreach ($relatedProducts as $product)
            <div class="card product-card card-static">
                <a href="/producto/{{$product->id}}" class="d-block bg-white py-4 py-sm-5 px-2">
                    <img src="{{Storage::url($product->featured)}}" class="d-block mx-auto" style="width: 165px;" alt="Alt text">
                </a>
                <div class="card-body py-2">
                    <a class="product-meta d-block fs-xs pb-1" href="#">stock: {{$product->netsuite_stock}}</a>
                    <h3 class="product-title fs-sm">
                        <a href="#">{{$product->name}}</a>
                    </h3>
                    <div class="d-flex justify-content-between">
                        <div class="product-price text-accent">
                            <x-amount-formatter :amount="$product->price" />
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        </div>
    </div>
</div>

@endsection

@section('scripts')

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Tiny Slider:
    var slider = tns({
        container: '.tns-carousel-inner',
        nav: false, // Desactiva los puntos de navegación inferiores
        controls: true, // Desactiva los botones de anterior/siguiente
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
        },
        controlsText: ['Anterior', 'Siguiente'] // Textos personalizados para los botones de control
    });

    document.querySelector('[data-controls="prev"]').innerHTML = '<i class="bi bi-chevron-left"></i>'
    document.querySelector('[data-controls="next"]').innerHTML = '<i class="bi bi-chevron-right"></i>'
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

@endsection
