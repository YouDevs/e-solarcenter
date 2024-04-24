@extends('layouts.base')

@section('content')

<div class="bg-dark pt-4 pb-5">
    <div class="container pt-2 pb-3 pt-lg-3 pb-lg-4">
        <div class="d-lg-flex justify-content-between pb-3">
            <div class="order-lg-1 pe-lg-4 text-center text-lg-start">
                <h1 class="h3 text-light mb-0">Productos</h1>
            </div>
        </div>
    </div>
</div>


<div class="container pb-5 mb-2 mb-md-4">
    <!-- Toolbar -->
    <div class="bg-light shadow-lg rounded-3 p-4 mt-n5 mb-4">
        <div class="d-flex justify-content-between align-items-center">
            <div class="dropdown me-2">
                <a class="btn btn-outline-secondary dropdown-toggle collapsed" href="#shop-filters" data-bs-toggle="collapse" aria-expanded="false">
                <i class="ci-filter me-2"></i>Filtros</a>
            </div>
            {{ $products->appends(request()->query())->links('vendor.pagination.products') }}
        </div>
        <!-- Toolbar with expandable filters-->
        <div class="collapse" id="shop-filters" style="">
            <div class="row pt-4">
                <div class="col-lg-4 col-sm-6">
                    <!-- Categories-->
                    <div class="card mb-grid-gutter">
                        <div class="card-body px-4">
                        <div class="widget widget-categories">
                            <h3 class="widget-title">Categoría</h3>
                            <div class="accordion mt-n1">
                                <div class="accordion-item">
                                    <div class="accordion-collapse collapse show" id="clothing" data-bs-parent="#shop-categories">
                                        <div class="accordion-body">
                                            <div class="widget widget-links widget-filter">
                                                <div class="input-group input-group-sm mb-2">
                                                    <select class="form-select flex-shrink-0" id="product-category-id" name="category_id" style="width: 10.5rem;">
                                                        <option value="">Elige una opción</option>
                                                        @foreach ($categories as $category)
                                                            <option
                                                                value="{{$category->id}}"
                                                                @selected(request('category_id') == $category->id)
                                                            >
                                                                {{$category->name}}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <!-- Filter by Brand-->
                    <div class="card mb-grid-gutter">
                        <div class="card-body px-4">
                            <div class="widget widget-categories">
                                <h3 class="widget-title">Marca</h3>
                                <div class="accordion mt-n1">
                                    <div class="accordion-item">
                                        <div class="accordion-collapse collapse show" id="category" data-bs-parent="#shop-brands">
                                            <div class="accordion-body">
                                                <div class="widget widget-links widget-filter">
                                                    <div class="input-group input-group-sm mb-2">
                                                        <select class="form-select flex-shrink-0" id="prodyct-brand" name="brand" style="width: 10.5rem;">
                                                            <option value="">Elige una opción</option>
                                                            @foreach ($brands as $brand)
                                                                <option
                                                                    value="{{$brand->value}}"
                                                                    @selected(request('brand') == $brand->value)
                                                                >
                                                                    {{$brand->value}}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center align-items-md-center mx-n2" id="grid-products">
        <!-- 2do PRODUCT ORIGINAL DEL TEMPLATE (para referencia) -->
        @foreach ($products as $product)
        <div class="col-lg-3 col-md-4 col-sm-6 px-2 mb-4 pt-3">
            <div class="card product-card">
                <a class="card-img-top d-block overflow-hidden" href="#" previewlistener="true">
                    <img src="{{Storage::url($product->featured)}}" alt="Product">
                </a>
                <div class="card-body py-2">
                    @auth
                        <a class="product-meta d-block fs-xs pb-1" href="#">stock: {{ $product->totalAvailableQuantity }}</a>
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
                            {{-- <input type="number" class="form-control me-2" placeholder="cantidad" name="quantity" min="1" value="1"> --}}
                            <input type="hidden" value="{{ $product->id }}" name="id">
                            <input type="hidden" value="{{ $product->name }}" name="name">
                            <input type="hidden" value="{{ $product->brand }}" name="brand">
                            <input type="hidden" value="{{ $product->defaultPrice }}" name="price">
                            <input type="hidden" value="{{ $product->location }}"  name="location">
                            {{-- <button class="px-4 py-1.5 text-white text-sm bg-blue-800 rounded">Add To Cart</button> --}}
                            <button class="btn btn-primary btn-sm add-to-cart-btn" data-product-id="{{ $product->id }}" type="submit">
                                <i class="ci-cart fs-sm me-1"></i>Agregar al Carrito
                            </button>
                        </form>
                    @endauth
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
                                                {{-- <input type="number" class="form-control me-3" placeholder="cantidad" name="quantity" min="1" value="1"> --}}
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
            <div class="tns-carousel-brands">
                <!-- Carousel slides here -->
                <div>
                    <a href="#" class="d-block bg-white border py-4 py-sm-5 px-2">
                        <img src="{{asset('brands/longi.webp')}}" class="d-block mx-auto" style="width: 165px;" alt="Alt text">
                    </a>
                </div>
                <div>
                    <a href="#" class="d-block bg-white border py-4 py-sm-5 px-2">
                        <img src="{{asset('brands/solis.webp')}}" class="d-block mx-auto" style="width: 165px;" alt="Alt text">
                    </a>
                </div>
                <div>
                    <a href="#" class="d-block bg-white border py-4 py-sm-5 px-2">
                        <img src="{{asset('brands/risen.webp')}}" class="d-block mx-auto" style="width: 165px;" alt="Alt text">
                    </a>
                </div>
                <div>
                    <a href="#" class="d-block bg-white border py-4 py-sm-5 px-2">
                        <img src="{{asset('brands/s5.webp')}}" class="d-block mx-auto" style="width: 165px;" alt="Alt text">
                    </a>
                </div>
                <div>
                    <a href="#" class="d-block bg-white border py-4 py-sm-5 px-2">
                        <img src="{{asset('brands/huawei.webp')}}" class="d-block mx-auto" style="width: 165px;" alt="Alt text">
                    </a>
                </div>
                <div>
                    <a href="" class="d-block bg-white border py-4 py-sm-5 px-2">
                        <img src="{{asset('brands/victron.webp')}}" class="d-block mx-auto" style="width: 165px;" alt="Alt text">
                    </a>
                </div>
                <div>
                    <a href="" class="d-block bg-white border py-4 py-sm-5 px-2">
                        <img src="{{asset('brands/trina.webp')}}" class="d-block mx-auto" style="width: 165px;" alt="Alt text">
                    </a>
                </div>
                <div>
                    <a href="" class="d-block bg-white border py-4 py-sm-5 px-2">
                        <img src="{{asset('brands/growatt.webp')}}" class="d-block mx-auto" style="width: 165px;" alt="Alt text">
                    </a>
                </div>
                <div>
                    <a href="" class="d-block bg-white border py-4 py-sm-5 px-2">
                        <img src="{{asset('brands/znshine.webp')}}" class="d-block mx-auto" style="width: 165px;" alt="Alt text">
                    </a>
                </div>
                <div>
                    <a href="" class="d-block bg-white border py-4 py-sm-5 px-2">
                        <img src="{{asset('brands/unirac.webp')}}" class="d-block mx-auto" style="width: 165px;" alt="Alt text">
                    </a>
                </div>
                <div>
                    <a href="" class="d-block bg-white border py-4 py-sm-5 px-2">
                        <img src="{{asset('brands/tw-solar.webp')}}" class="d-block mx-auto" style="width: 165px;" alt="Alt text">
                    </a>
                </div>
                <div>
                    <a href="" class="d-block bg-white border py-4 py-sm-5 px-2">
                        <img src="{{asset('brands/fronius.webp')}}" class="d-block mx-auto" style="width: 165px;" alt="Alt text">
                    </a>
                </div>
                <div>
                    <a href="" class="d-block bg-white border py-4 py-sm-5 px-2">
                        <img src="{{asset('brands/soluna.webp')}}" class="d-block mx-auto" style="width: 165px;" alt="Alt text">
                    </a>
                </div>
                <div>
                    <a href="" class="d-block bg-white border py-4 py-sm-5 px-2">
                        <img src="{{asset('brands/gosolar.webp')}}" class="d-block mx-auto" style="width: 165px;" alt="Alt text">
                    </a>
                </div>
                <div>
                    <a href="" class="d-block bg-white border py-4 py-sm-5 px-2">
                        <img src="{{asset('brands/pylontech.webp')}}" class="d-block mx-auto" style="width: 165px;" alt="Alt text">
                    </a>
                </div>
                <div>
                    <a href="" class="d-block bg-white border py-4 py-sm-5 px-2">
                        <img src="{{asset('brands/srne.webp')}}" class="d-block mx-auto" style="width: 165px;" alt="Alt text">
                    </a>
                </div>
                <div>
                    <a href="" class="d-block bg-white border py-4 py-sm-5 px-2">
                        <img src="{{asset('brands/yassion.webp')}}" class="d-block mx-auto" style="width: 165px;" alt="Alt text">
                    </a>
                </div>
                <div>
                    <a href="" class="d-block bg-white border py-4 py-sm-5 px-2">
                        <img src="{{asset('brands/zbeny.webp')}}" class="d-block mx-auto" style="width: 165px;" alt="Alt text">
                    </a>
                </div>
                <div>
                    <a href="" class="d-block bg-white border py-4 py-sm-5 px-2">
                        <img src="{{asset('brands/parts-master.webp')}}" class="d-block mx-auto" style="width: 165px;" alt="Alt text">
                    </a>
                </div>
                <div>
                    <a href="" class="d-block bg-white border py-4 py-sm-5 px-2">
                        <img src="{{asset('brands/xpower.webp')}}" class="d-block mx-auto" style="width: 165px;" alt="Alt text">
                    </a>
                </div>
                <div>
                    <a href="" class="d-block bg-white border py-4 py-sm-5 px-2">
                        <img src="{{asset('brands/ultrastart.webp')}}" class="d-block mx-auto" style="width: 165px;" alt="Alt text">
                    </a>
                </div>
                <div>
                    <a href="" class="d-block bg-white border py-4 py-sm-5 px-2">
                        <img src="{{asset('brands/yassion.webp')}}" class="d-block mx-auto" style="width: 165px;" alt="Alt text">
                    </a>
                </div>
                <div>
                    <a href="" class="d-block bg-white border py-4 py-sm-5 px-2">
                        <img src="{{asset('brands/zbeny.webp')}}" class="d-block mx-auto" style="width: 165px;" alt="Alt text">
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
    document.addEventListener('DOMContentLoaded', function () {
        // Filter By Category
        const categorySelect = document.getElementById('product-category-id');
        categorySelect.addEventListener('change', function() {
            const categoryId = this.value;
            const searchParams = new URLSearchParams(window.location.search);

            // Actualiza o añade category_id a los parámetros de búsqueda
            searchParams.set('category_id', categoryId);

            // Redirige manteniendo el parámetro de marca si ya estaba establecido
            window.location.href = `${window.location.origin}/productos/?${searchParams.toString()}`;
        });

        // Filter By Brand (Asegúrate de corregir esto para que funcione con la lógica de filtro actualizada)
        const brandSelect = document.getElementById('prodyct-brand');
        brandSelect.addEventListener('change', function() {
            const brand = this.value;
            const searchParams = new URLSearchParams(window.location.search);

            // Actualiza o añade brand a los parámetros de búsqueda
            if(brand) {
                searchParams.set('brand', brand);
            } else {
                searchParams.delete('brand'); // Remueve el parámetro si "Todos" es seleccionado
            }

            // Redirige manteniendo los parámetros existentes
            window.location.href = `${window.location.origin}/productos/?${searchParams.toString()}`;
        });

    })
</script>

@endsection
