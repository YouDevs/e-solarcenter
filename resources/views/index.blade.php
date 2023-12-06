@extends('layouts.base')

@section('content')
<div class="container">
    <div class="row justify-content-center align-items-md-center">
        <div class="col-md-12">
            <h1>Familias de productos</h1>
            <h2>Filtros</h2>
        </div>
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
                <div class="card-body py-2"><a class="product-meta d-block fs-xs pb-1" href="#">Paneles</a>
                    <h3 class="product-title fs-sm fw-bold">
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
                        <a class="nav-link-style fs-ms" href="#quick-view" data-bs-toggle="modal">
                            {{-- <i class="ci-eye align-middle me-1"></i> --}}
                            {{-- <i class="bi bi-eye"></i> --}}
                            Vista rápida <i class="bi bi-eye"></i>
                        </a>
                    </div>
                </div>
            </div>
            <hr class="d-sm-none">
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

@endsection
