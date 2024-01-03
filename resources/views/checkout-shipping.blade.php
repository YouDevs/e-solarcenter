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
        </div>
        <div class="order-lg-1 pe-lg-4 text-center text-lg-start">
            <h1 class="h3 text-light mb-0">Checkout</h1>
        </div> --}}
    </div>
</div>

<div class="container pb-5 mb-2 mb-md-4">
    <div class="row">
        <section class="col-lg-8">
            <!-- Steps-->
            <x-payment-steps step="3" />

            <!-- Shipping address-->
            <h2 class="h6 pb-3 mb-2">Elige una dirección de envío</h2>
            <div class="table-responsive">
                <table class="table table-hover fs-sm border-top">
                    <thead>
                        <tr>
                            <th class="align-middle"></th>
                            <th class="align-middle">Dirección de envío</th>
                            {{-- <th class="align-middle">Tiempo de envío</th>
                            <th class="align-middle">Costo de envío</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <div class="form-check mb-4">
                                <input class="form-check-input" type="radio" id="courier" name="shipping-method" checked="">
                                <label class="form-check-label" for="courier"></label>
                                </div>
                            </td>
                            <td class="align-middle"><span class="text-dark fw-medium">Courier</span><br><span class="text-muted">All addresses (default zone), United States &amp; Canada</span></td>
                            {{-- <td class="align-middle">2 - 4 days</td>
                            <td class="align-middle">$26.50</td> --}}
                        </tr>
                        <tr>
                            <td>
                                <div class="form-check mb-4">
                                <input class="form-check-input" type="radio" id="local" name="shipping-method">
                                <label class="form-check-label" for="local"></label>
                                </div>
                            </td>
                            <td class="align-middle">
                                <span class="text-dark fw-medium">Local Shipping</span><br>
                                <span class="text-muted">All addresses (default zone), United States &amp; Canada</span>
                            </td>
                            {{-- <td class="align-middle">up to one week</td>
                            <td class="align-middle">$10.00</td> --}}
                        </tr>
                        <tr>
                            <td>
                                <div class="form-check mb-4">
                                <input class="form-check-input" type="radio" id="flat" name="shipping-method">
                                <label class="form-check-label" for="flat"></label>
                                </div>
                            </td>
                            <td class="align-middle"><span class="text-dark fw-medium">Flat Rate</span><br><span class="text-muted">All addresses (default zone)</span></td>
                            {{-- <td class="align-middle">5 - 7 days</td>
                            <td class="align-middle">$33.85</td> --}}
                        </tr>
                    </tbody>
                </table>
                {{-- <p>
                    <span>botón editar dirección.</span> //
                    <span>botón agregar dirección.</span>
                </p> --}}
              </div>
            <!-- Navigation (desktop)-->
            <div class="d-none d-lg-flex pt-4 mt-3">
                <div class="w-50 pe-3">
                    <a class="btn btn-secondary d-block w-100" href="{{route('checkout.details')}}">
                        <i class="ci-arrow-left mt-sm-0 me-1"></i>
                        <span class="d-none d-sm-inline">Volver</span>
                        <span class="d-inline d-sm-none">Volver</span>
                    </a>
                </div>
                <div class="w-50 ps-2">
                    <a class="btn btn-primary d-block w-100" href="{{route('checkout.payment')}}">
                        <span class="d-none d-sm-inline">Proceder al pago</span>
                        <span class="d-inline d-sm-none">Siguiente</span>
                        <i class="ci-arrow-right mt-sm-0 ms-1"></i>
                    </a>
                </div>
            </div>
        </section>
        <!-- Sidebar-->
        <aside class="col-lg-4 pt-4 pt-lg-0 ps-xl-5">
            <div class="bg-white rounded-3 shadow-lg p-4 ms-lg-auto">
                <div class="py-2 px-xl-2">
                    <div class="widget mb-3">
                        <h2 class="widget-title text-center">Resumen de orden</h2>
                        @foreach ($cart_items as $item)
                            <div class="d-flex align-items-center pb-2 border-bottom">
                                <a class="d-block flex-shrink-0" href="#">
                                    <img src="{{Storage::url($item->attributes->featured)}}" width="64" alt="Product">
                                </a>
                                <div class="ps-2">
                                    <h6 class="widget-product-title">
                                        <a href="shop-single-v1.html">{{$item->name}}</a>
                                    </h6>
                                    <div class="widget-product-meta">
                                        <x-amount-formatter :amount="$item->price" />
                                        <span class="text-muted">x {{$item->quantity}}</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    {{-- <ul class="list-unstyled fs-sm pb-2 border-bottom">
                        <li class="d-flex justify-content-between align-items-center">
                            <span class="me-2">Subtotal:</span><span class="text-end">$265.<small>00</small></span>
                        </li>
                        <li class="d-flex justify-content-between align-items-center">
                            <span class="me-2">Shipping:</span><span class="text-end">—</span></li>
                        <li class="d-flex justify-content-between align-items-center">
                            <span class="me-2">Taxes:</span><span class="text-end">$9.<small>50</small></span>
                        </li>
                        <li class="d-flex justify-content-between align-items-center">
                            <span class="me-2">Discount:</span><span class="text-end">—</span>
                        </li>
                    </ul> --}}
                    <h3 class="fw-normal text-center my-4">
                        <x-amount-formatter :amount="Cart::getTotal()" />
                    </h3>
                </div>
            </div>
        </aside>
    </div>
    <!-- Navigation (mobile)-->
    <div class="row d-lg-none">
        <div class="col-lg-8">
            <div class="d-flex pt-4 mt-3">
                <div class="w-50 pe-3"><a class="btn btn-secondary d-block w-100" href="shop-cart.html"><i class="ci-arrow-left mt-sm-0 me-1"></i><span class="d-none d-sm-inline">Back to Cart</span><span class="d-inline d-sm-none">Back</span></a></div>
                <div class="w-50 ps-2"><a class="btn btn-primary d-block w-100" href="checkout-shipping.html"><span class="d-none d-sm-inline">Proceed to Shipping</span><span class="d-inline d-sm-none">Next</span><i class="ci-arrow-right mt-sm-0 ms-1"></i></a></div>
            </div>
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

@endsection
