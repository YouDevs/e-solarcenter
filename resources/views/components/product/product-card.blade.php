<div class="col-lg-3 col-md-4 col-sm-6 px-2 mb-4 pt-3">
    <div class="card product-card">
        <a class="card-img-top d-block overflow-hidden" href="#" previewlistener="true">
            <img src="{{Storage::url($product->featured)}}" alt="Product">
        </a>
        <div class="card-body py-2">
            {{-- Componente stock --}}
            <x-product.product-stock :product="$product" />

            <h3 class="product-title fs-sm pt-1">
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
                <x-product.product-form :product="$product" />
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
                                        {{-- <input type="number" class="form-control me-3" placeholder="cantidad" name="quantity" min="1" value="1"> --}}
                                        <input type="hidden" value="{{ $product->id }}" name="id">
                                        <input type="hidden" value="{{ $product->name }}" name="name">
                                        <input type="hidden" value="{{ $product->brand }}" name="brand">
                                        <input type="hidden" value="{{ $product->price }}" name="price">
                                        <input type="hidden" value="{{ $product->featured }}" name="featured">
                                        <input type="hidden" value="{{ $product->weight }}" name="weight">
                                        <input type="hidden" value="{{ $product->length }}" name="length">
                                        <input type="hidden" value="{{ $product->width }}" name="width">
                                        <input type="hidden" value="{{ $product->height }}" name="height">
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

<div class="modal fade" id="assistanceModal" tabindex="-1" aria-labelledby="assistanceModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="assistanceModalLabel">Solicitar Asistencia de un Asesor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="text-muted fs-sm">
                    En este momento no hay stock del producto que seleccionaste.
                    Puedes solicitar asistencia personalizada de un asesor Enviando este formulario
                </p>
                <form id="assistanceForm">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <label class="form-label">Cantidad</label>
                    <input type="number" class="form-control" name="quantity" value="1" min="1">
                    <label class="form-label">Producto</label>
                    <input type="text" class="form-control" name="name" value="{{$product->name}}" disabled>
                    <div class="mb-3">
                        <label for="message" class="form-label">Mensaje</label>
                        <textarea class="form-control" id="message" name="message" rows="3" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Enviar</button>
                </form>
            </div>
        </div>
    </div>
</div>
