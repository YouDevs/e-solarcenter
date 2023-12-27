@extends('layouts.base')

@section('content')
{{-- <div class="container">
    <div class="row justify-content-center align-items-md-center"> --}}
        <div class="page-title-overlap bg-dark pt-4">
            <div class="container d-lg-flex justify-content-between py-2 py-lg-3">
                <div class="order-lg-2 mb-3 mb-lg-0 pt-lg-2">
                    <nav aria-label="breadcrumb">
                    {{-- <ol class="breadcrumb breadcrumb-light flex-lg-nowrap justify-content-center justify-content-lg-start">
                        <li class="breadcrumb-item"><a class="text-nowrap" href="index.html" previewlistener="true"><i class="ci-home"></i>Home</a></li>
                        <li class="breadcrumb-item text-nowrap"><a href="shop-grid-ls.html" previewlistener="true">Shop</a>
                        </li>
                        <li class="breadcrumb-item text-nowrap active" aria-current="page">Cart</li>
                    </ol> --}}
                    </nav>
                </div>
                <div class="order-lg-1 pe-lg-4 text-center text-lg-start">
                    <h1 class="h3 text-light mb-0">Carrito</h1>
                </div>
            </div>
        </div>
        <div class="container pb-5 mb-2 mb-md-4">
            <div class="row">
                <!-- List of items-->
                <section class="col-lg-8">
                    <div class="d-flex justify-content-between align-items-center pt-3 pb-4 pb-sm-5 mt-1">
                        <h2 class="h6 text-light mb-0">Productos</h2>
                        <a class="btn btn-outline-warning btn-sm ps-2" href="/" previewlistener="true">
                            <i class="ci-arrow-left me-2"></i>
                            Continuar comprando
                        </a>
                    </div>
                    <!-- Item-->
                    @foreach ($cart_items as $item)
                        <div class="d-sm-flex justify-content-between align-items-center my-2 pb-3 border-bottom">
                            <div class="d-block d-sm-flex align-items-center text-center text-sm-start">
                                <a class="d-inline-block flex-shrink-0 mx-auto me-sm-4" href="#" previewlistener="true">
                                    <img src="{{Storage::url($item->attributes->featured)}}" width="160" alt="Product">
                                </a>
                                <div class="pt-2">
                                    <h3 class="product-title fs-base mb-2"><a href="shop-single-v1.html" previewlistener="true">{{$item->name}}</a></h3>
                                    <div class="fs-sm"><span class="text-muted me-2">Marca:</span>{{$item->attributes->brand}}</div>
                                    <div class="fs-sm"><span class="text-muted me-2">SKU:</span> {{$item->attributes->sku}}</div>

                                    <div class="fs-lg text-accent pt-2">
                                        <x-amount-formatter :amount="$item->price" />
                                    </div>
                                </div>
                            </div>
                            <div class="pt-2 pt-sm-0 ps-sm-3 mx-auto mx-sm-0 text-center text-sm-start" style="max-width: 9rem;">
                                <form action="">
                                    <label class="form-label" for="quantity1">Cantidad</label>
                                    <input class="form-control" type="number" id="Cantidad1" min="1" value="{{ $item->quantity }}">
                                </form>
                                <form action="{{route('cart.remove')}}" method="post">
                                    @csrf
                                    <input type="hidden" name="item_id" value="{{$item->id}}">
                                    <button class="btn btn-link px-0 text-danger" type="submit">
                                        <i class="bi bi-x-circle me-2"></i>
                                        <span class="fs-sm">Eliminar</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach

                    <button class="btn btn-outline-accent d-block w-100 mt-4" type="button">
                        <i class="bi bi-arrow-clockwise"></i>
                        Actualizar Carrito
                    </button>

                </section>
                <!-- Sidebar-->
                <aside class="col-lg-4 pt-4 pt-lg-0 ps-xl-5">
                    <div class="bg-white rounded-3 shadow-lg p-4">
                        <div class="py-2 px-xl-2">
                            <div class="text-center mb-4 pb-3 border-bottom">
                                <h2 class="h6 mb-3 pb-1">Subtotal</h2>
                                <h3 class="fw-normal">
                                    <x-amount-formatter :amount="Cart::getTotal()" />
                                </h3>
                            </div>
                            {{-- <ul class="list-unstyled fs-sm pb-2 border-bottom">
                                <li class="d-flex justify-content-between align-items-center">
                                    <span class="me-2 h6">Cuenta Bancaria:</span>
                                    <span class="text-end h6">4242 4242 4242 4242</span>
                                </li>
                                <li class="d-flex justify-content-between align-items-center">
                                    <span class="me-2 h6">Banco: </span>
                                    <span class="text-end h6">Santander</span>
                                </li>
                                <li class="d-flex justify-content-between align-items-center">
                                    <span class="me-2 h6">Nombre:</span>
                                    <span class="text-end h6">SOLAR CENTER</span>
                                </li>
                                <li class="d-flex justify-content-between align-items-center">
                                    <span class="me-2 h6 fw-bold mb-0">Concepto:</span>
                                    <input type="text" class="form-control text-end fw-bold" value="{{$payment_concept}}">
                                </li>
                            </ul> --}}

                            {{-- <div class="mb-3 mb-4">
                                <label class="form-label mb-3" for="order-comments">
                                    <span class="badge bg-info fs-xs me-2">Nota</span>
                                    <span class="fw-medium">Concepto de pago</span>
                                </label>
                                <input type="text" class="form-control" readonly value="Introduzca este concepto en su aplicación de banco.">
                                <textarea class="form-control" rows="6" id="order-comments"></textarea>
                                <textarea class="form-control" rows="6" id="order-comments"></textarea>
                            </div> --}}

                            {{-- <div class="accordion" id="order-options">
                                <div class="accordion-item">
                                    <h3 class="accordion-header">
                                        <a class="accordion-button" href="#promo-code" role="button" data-bs-toggle="collapse" aria-expanded="true" aria-controls="promo-code">
                                            Apply promo code
                                        </a>
                                    </h3>
                                    <div class="accordion-collapse collapse show" id="promo-code" data-bs-parent="#order-options">
                                        <form class="accordion-body needs-validation" method="post" novalidate="">
                                        <div class="mb-3">
                                            <input class="form-control" type="text" placeholder="Promo code" required="">
                                            <div class="invalid-feedback">Please provide promo code.</div>
                                        </div>
                                        <button class="btn btn-outline-primary d-block w-100" type="submit">Apply promo code</button>
                                        </form>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h3 class="accordion-header"><a class="accordion-button collapsed" href="#shipping-estimates" role="button" data-bs-toggle="collapse" aria-expanded="true" aria-controls="shipping-estimates">Shipping estimates</a></h3>
                                    <div class="accordion-collapse collapse" id="shipping-estimates" data-bs-parent="#order-options">
                                        <div class="accordion-body">
                                        <form class="needs-validation" novalidate="">
                                            <div class="mb-3">
                                            <select class="form-select" required="">
                                                <option value="">Choose your country</option>
                                                <option value="Australia">Australia</option>
                                                <option value="Belgium">Belgium</option>
                                                <option value="Canada">Canada</option>
                                                <option value="Finland">Finland</option>
                                                <option value="Mexico">Mexico</option>
                                                <option value="New Zealand">New Zealand</option>
                                                <option value="Switzerland">Switzerland</option>
                                                <option value="United States">United States</option>
                                            </select>
                                            <div class="invalid-feedback">Please choose your country!</div>
                                            </div>
                                            <div class="mb-3">
                                            <select class="form-select" required="">
                                                <option value="">Choose your city</option>
                                                <option value="Bern">Bern</option>
                                                <option value="Brussels">Brussels</option>
                                                <option value="Canberra">Canberra</option>
                                                <option value="Helsinki">Helsinki</option>
                                                <option value="Mexico City">Mexico City</option>
                                                <option value="Ottawa">Ottawa</option>
                                                <option value="Washington D.C.">Washington D.C.</option>
                                                <option value="Wellington">Wellington</option>
                                            </select>
                                            <div class="invalid-feedback">Please choose your city!</div>
                                            </div>
                                            <div class="mb-3">
                                            <input class="form-control" type="text" placeholder="ZIP / Postal code" required="">
                                            <div class="invalid-feedback">Please provide a valid zip!</div>
                                            </div>
                                            <button class="btn btn-outline-primary d-block w-100" type="submit">Calculate shipping</button>
                                        </form>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}

                            <a class="btn btn-primary btn-shadow d-block w-100 mt-4" href="{{route('checkout.details')}}" previewlistener="true">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gear girando" viewBox="0 0 16 16">
                                    <path d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492zM5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0z"/>
                                    <path d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52l-.094-.319zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.184 1.185l-.159.292a1.873 1.873 0 0 0 1.116 2.692l.318.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.184l-.291-.159a1.873 1.873 0 0 0-2.693 1.116l-.094.318c-.246.835-1.428.835-1.674 0l-.094-.319a1.873 1.873 0 0 0-2.692-1.115l-.292.16c-.764.415-1.6-.42-1.184-1.185l.159-.291A1.873 1.873 0 0 0 1.945 8.93l-.319-.094c-.835-.246-.835-1.428 0-1.674l.319-.094A1.873 1.873 0 0 0 3.06 4.377l-.16-.292c-.415-.764.42-1.6 1.185-1.184l.292.159a1.873 1.873 0 0 0 2.692-1.115l.094-.319z"/>
                                  </svg>
                                Proceso de pago
                            </a>
                            {{-- <a class="btn btn-success btn-shadow d-block w-100 mt-4" href="checkout-details.html" previewlistener="true">
                                <i class="bi bi-check-circle"></i>
                                Ya realicé mi pago
                            </a>
                            <a class="btn btn-warning btn-shadow d-block w-100 mt-4" href="checkout-details.html" previewlistener="true">
                                <i class="bi bi-clock"></i>
                                Pagaré Después
                            </a> --}}
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    {{-- </div>
</div> --}}
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
