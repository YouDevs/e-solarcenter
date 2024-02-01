<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('favicon/solar-center-favicon_32x32.webp')}}">
    <link rel="icon" type="image/webp" sizes="32x32" href="{{asset('favicon/solar-center-favicon_32x32.webp')}}">
    <link rel="icon" type="image/webp" sizes="16x16" href="{{asset('favicon/solar-center-favicon_32x32.webp')}}">
    <link rel="manifest" href="{{asset('favicon/site.webmanifest')}}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Solar Center</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Scripts -->
    @vite([
        'resources/sass/base.scss',
        // 'resources/sass/product-card.scss',
        'resources/js/app.js'
    ])
</head>
<body class="bg-white">
    <div id="app">
        @php
            $route_name = Route::currentRouteName(); // string
        @endphp
        @if ($route_name != 'login')
        <div class="navbar-sticky bg-light">
            <div class="navbar navbar-expand-lg navbar-light">
                <div class="container">
                    <a class="navbar-brand d-none d-sm-block flex-shrink-0" href="/" previewlistener="true">
                        <img src="{{asset('images/logo.webp')}}" width="142" alt="Solar Center">
                    </a>
                    <a class="navbar-brand d-sm-none flex-shrink-0 me-2" href="/" previewlistener="true">
                        <img src="{{asset('images/logo.webp')}}" width="74" alt="Solar Center">
                    </a>
                    @if (Auth::check())
                    <div class="input-group d-none d-lg-flex mx-4">
                        <input
                            class="form-control rounded-end pe-5"
                            type="text"
                            placeholder="Buscar productos por nombre, marca, categoría (panel, inversor, estructura...)"
                            id="search-product"
                        >
                        <i class="bi bi-search position-absolute top-50 end-0 translate-middle-y text-muted fs-base me-3"></i>
                    </div>
                    @endif
                    <div class="navbar-toolbar d-flex flex-shrink-0 align-items-center">
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <a class="navbar-tool navbar-stuck-toggler" href="#">
                            <span class="navbar-tool-tooltip">Expandir menú</span>
                            <div class="navbar-tool-icon-box">
                                <i class="navbar-tool-icon ci-menu"></i>
                            </div>
                        </a>
                        <a class="navbar-tool d-none d-lg-flex" href="account-wishlist.html" previewlistener="true">
                            <span class="navbar-tool-tooltip">Wishlist</span>
                            <div class="navbar-tool-icon-box">
                                <i class="navbar-tool-icon ci-heart"></i>
                            </div>
                        </a>
                        @if (Auth::check())
                        <a class="navbar-tool ms-1 ms-lg-0 me-n1 me-lg-2" href="#signin-modal" data-bs-toggle="modal">
                            <div class="navbar-tool-icon-box">
                                <i class="navbar-tool-icon bi bi-person-circle fs-1"></i>
                            </div>
                            <div class="navbar-tool-text ms-n3">
                                <small>Hola, </small>{{auth()->user()->name}}
                            </div>
                        </a>
                        <div class="navbar-tool ms-3">
                            <a class="navbar-tool-icon-box bg-secondary" href="{{route('cart.list')}}" previewlistener="true">
                                <span class="navbar-tool-label">{{ Cart::getTotalQuantity() }}</span>
                                <i class="navbar-tool-icon bi bi-cart3"></i>
                            </a>
                            <a class="navbar-tool-text" href="{{route('cart.list')}}" previewlistener="true">
                                <small>Carrito</small>${{ Cart::getTotal() }}
                            </a>
                        </div>
                        @endif
                        <!-- Menú Carrito de compras con dropdown -->
                        {{-- <div class="navbar-tool dropdown ms-3">
                            <a class="navbar-tool-icon-box bg-secondary dropdown-toggle" href="{{route('cart.list')}}" previewlistener="true">
                                <span class="navbar-tool-label">{{ Cart::getTotalQuantity() }}</span>
                                <i class="navbar-tool-icon bi bi-cart3"></i>
                            </a>
                            <a class="navbar-tool-text" href="{{route('cart.list')}}" previewlistener="true">
                                <small>Carrito</small>${{ Cart::getTotal() }}
                            </a>
                            <!-- Cart dropdown-->
                            <div class="dropdown-menu dropdown-menu-end">
                                <div class="widget widget-cart px-3 pt-2 pb-3" style="width: 20rem;">
                                    <div style="height: 15rem;" data-simplebar="init" data-simplebar-auto-hide="false">
                                        <div class="simplebar-wrapper" style="margin: 0px -16px 0px 0px;">
                                            <div class="simplebar-height-auto-observer-wrapper">
                                                <div class="simplebar-height-auto-observer"></div>
                                            </div>
                                            <div class="simplebar-mask">
                                                <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                                                    <div class="simplebar-content-wrapper" tabindex="0" role="region" aria-label="scrollable content" style="height: auto; overflow: hidden;">
                                                        <div class="simplebar-content" style="padding: 0px 16px 0px 0px;">
                                                            <div class="widget-cart-item pb-2 border-bottom">
                                                                <button class="btn-close text-danger" type="button" aria-label="Remove"><span aria-hidden="true">×</span></button>
                                                                <div class="d-flex align-items-center"><a class="flex-shrink-0" href="shop-single-v1.html" previewlistener="true"><img src="img/shop/cart/widget/01.jpg" width="64" alt="Product"></a>
                                                                <div class="ps-2">
                                                                    <h6 class="widget-product-title"><a href="shop-single-v1.html" previewlistener="true">Women Colorblock Sneakers</a></h6>
                                                                    <div class="widget-product-meta"><span class="text-accent me-2">$150.<small>00</small></span><span class="text-muted">x 1</span></div>
                                                                </div>
                                                                </div>
                                                            </div>
                                                            <div class="widget-cart-item py-2 border-bottom">
                                                                <button class="btn-close text-danger" type="button" aria-label="Remove"><span aria-hidden="true">×</span></button>
                                                                <div class="d-flex align-items-center"><a class="flex-shrink-0" href="shop-single-v1.html" previewlistener="true"><img src="img/shop/cart/widget/02.jpg" width="64" alt="Product"></a>
                                                                <div class="ps-2">
                                                                    <h6 class="widget-product-title"><a href="shop-single-v1.html" previewlistener="true">TH Jeans City Backpack</a></h6>
                                                                    <div class="widget-product-meta"><span class="text-accent me-2">$79.<small>50</small></span><span class="text-muted">x 1</span></div>
                                                                </div>
                                                                </div>
                                                            </div>
                                                            <div class="widget-cart-item py-2 border-bottom">
                                                                <button class="btn-close text-danger" type="button" aria-label="Remove"><span aria-hidden="true">×</span></button>
                                                                <div class="d-flex align-items-center"><a class="flex-shrink-0" href="shop-single-v1.html" previewlistener="true"><img src="img/shop/cart/widget/03.jpg" width="64" alt="Product"></a>
                                                                <div class="ps-2">
                                                                    <h6 class="widget-product-title"><a href="shop-single-v1.html" previewlistener="true">3-Color Sun Stash Hat</a></h6>
                                                                    <div class="widget-product-meta"><span class="text-accent me-2">$22.<small>50</small></span><span class="text-muted">x 1</span></div>
                                                                </div>
                                                                </div>
                                                            </div>
                                                            <div class="widget-cart-item py-2 border-bottom">
                                                                <button class="btn-close text-danger" type="button" aria-label="Remove"><span aria-hidden="true">×</span></button>
                                                                <div class="d-flex align-items-center"><a class="flex-shrink-0" href="shop-single-v1.html" previewlistener="true"><img src="img/shop/cart/widget/04.jpg" width="64" alt="Product"></a>
                                                                <div class="ps-2">
                                                                    <h6 class="widget-product-title"><a href="shop-single-v1.html" previewlistener="true">Cotton Polo Regular Fit</a></h6>
                                                                    <div class="widget-product-meta"><span class="text-accent me-2">$9.<small>00</small></span><span class="text-muted">x 1</span></div>
                                                                </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="simplebar-placeholder" style="width: 0px; height: 0px;">
                                            </div>
                                        </div>
                                        <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
                                            <div class="simplebar-scrollbar simplebar-visible" style="width: 0px; display: none;"></div>
                                        </div>
                                        <div class="simplebar-track simplebar-vertical" style="visibility: hidden;">
                                            <div class="simplebar-scrollbar simplebar-visible" style="height: 0px; display: none; transform: translate3d(0px, 0px, 0px);"></div>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-wrap justify-content-between align-items-center py-3">
                                        <div class="fs-sm me-2 py-2">
                                            <span class="text-muted">Subtotal:</span>
                                            <span class="text-accent fs-base ms-1">$265.<small>00</small></span>
                                        </div>
                                        <a class="btn btn-outline-secondary btn-sm" href="shop-cart.html" previewlistener="true">
                                            Expandir Carrito<i class="ci-arrow-right ms-1 me-n1"></i>
                                        </a>
                                    </div>
                                    <a class="btn btn-primary btn-sm d-block w-100" href="checkout-details.html" previewlistener="true">
                                        <i class="ci-card me-2 fs-base align-middle"></i>Checkout
                                    </a>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
            <div class="navbar navbar-expand-lg navbar-light navbar-stuck-menu mt-n2 pt-0 pb-2">
                <div class="container">
                    <div class="collapse navbar-collapse" id="navbarCollapse">
                        @if (Auth::check())
                        <!-- Search-->
                        <div class="input-group d-lg-none my-3">
                            <i class="ci-search position-absolute top-50 start-0 translate-middle-y text-muted fs-base ms-3"></i>
                            <input class="form-control rounded-start" type="text" placeholder="Buscar productos">
                        </div>
                        @endif

                        <!-- Departments menu-->
                        {{-- <ul class="navbar-nav navbar-mega-nav pe-lg-2 me-lg-2">
                            <li class="nav-item dropdown"><a class="nav-link dropdown-toggle ps-lg-0" href="#" data-bs-toggle="dropdown"><i class="ci-view-grid me-2"></i>Departments</a>
                                <div class="dropdown-menu px-2 pb-4">
                                    <div class="d-flex flex-wrap flex-sm-nowrap">
                                    <div class="mega-dropdown-column pt-3 pt-sm-4 px-2 px-lg-3">
                                        <div class="widget widget-links"><a class="d-block overflow-hidden rounded-3 mb-3" href="#"><img src="img/shop/departments/01.jpg" alt="Clothing"></a>
                                        <h6 class="fs-base mb-2">Clothing</h6>
                                        <ul class="widget-list">
                                            <li class="widget-list-item mb-1"><a class="widget-list-link" href="#">Women's clothing</a></li>
                                            <li class="widget-list-item mb-1"><a class="widget-list-link" href="#">Men's clothing</a></li>
                                            <li class="widget-list-item mb-1"><a class="widget-list-link" href="#">Kid's clothing</a></li>
                                        </ul>
                                        </div>
                                    </div>
                                    <div class="mega-dropdown-column pt-4 px-2 px-lg-3">
                                        <div class="widget widget-links"><a class="d-block overflow-hidden rounded-3 mb-3" href="#"><img src="img/shop/departments/02.jpg" alt="Shoes"></a>
                                        <h6 class="fs-base mb-2">Shoes</h6>
                                        <ul class="widget-list">
                                            <li class="widget-list-item mb-1"><a class="widget-list-link" href="#">Women's shoes</a></li>
                                            <li class="widget-list-item mb-1"><a class="widget-list-link" href="#">Men's shoes</a></li>
                                            <li class="widget-list-item mb-1"><a class="widget-list-link" href="#">Kid's shoes</a></li>
                                        </ul>
                                        </div>
                                    </div>
                                    <div class="mega-dropdown-column pt-4 px-2 px-lg-3">
                                        <div class="widget widget-links"><a class="d-block overflow-hidden rounded-3 mb-3" href="#"><img src="img/shop/departments/03.jpg" alt="Gadgets"></a>
                                        <h6 class="fs-base mb-2">Gadgets</h6>
                                        <ul class="widget-list">
                                            <li class="widget-list-item mb-1"><a class="widget-list-link" href="#">Smartphones &amp; Tablets</a></li>
                                            <li class="widget-list-item mb-1"><a class="widget-list-link" href="#">Wearable gadgets</a></li>
                                            <li class="widget-list-item mb-1"><a class="widget-list-link" href="#">E-book readers</a></li>
                                        </ul>
                                        </div>
                                    </div>
                                    </div>
                                    <div class="d-flex flex-wrap flex-sm-nowrap">
                                    <div class="mega-dropdown-column pt-4 px-2 px-lg-3">
                                        <div class="widget widget-links"><a class="d-block overflow-hidden rounded-3 mb-3" href="#"><img src="img/shop/departments/04.jpg" alt="Furniture"></a>
                                        <h6 class="fs-base mb-2">Furniture &amp; Decor</h6>
                                        <ul class="widget-list">
                                            <li class="widget-list-item mb-1"><a class="widget-list-link" href="#">Home furniture</a></li>
                                            <li class="widget-list-item mb-1"><a class="widget-list-link" href="#">Office furniture</a></li>
                                            <li class="widget-list-item mb-1"><a class="widget-list-link" href="#">Lighting and decoration</a></li>
                                        </ul>
                                        </div>
                                    </div>
                                    <div class="mega-dropdown-column pt-4 px-2 px-lg-3">
                                        <div class="widget widget-links"><a class="d-block overflow-hidden rounded-3 mb-3" href="#"><img src="img/shop/departments/05.jpg" alt="Accessories"></a>
                                        <h6 class="fs-base mb-2">Accessories</h6>
                                        <ul class="widget-list">
                                            <li class="widget-list-item mb-1"><a class="widget-list-link" href="#">Hats</a></li>
                                            <li class="widget-list-item mb-1"><a class="widget-list-link" href="#">Sunglasses</a></li>
                                            <li class="widget-list-item mb-1"><a class="widget-list-link" href="#">Bags</a></li>
                                        </ul>
                                        </div>
                                    </div>
                                    <div class="mega-dropdown-column pt-4 px-2 px-lg-3">
                                        <div class="widget widget-links"><a class="d-block overflow-hidden rounded-3 mb-3" href="#"><img src="img/shop/departments/06.jpg" alt="Entertainment"></a>
                                        <h6 class="fs-base mb-2">Entertainment</h6>
                                        <ul class="widget-list">
                                            <li class="widget-list-item mb-1"><a class="widget-list-link" href="#">Kid's toys</a></li>
                                            <li class="widget-list-item mb-1"><a class="widget-list-link" href="#">Video games</a></li>
                                            <li class="widget-list-item mb-1"><a class="widget-list-link" href="#">Outdoor / Camping</a></li>
                                        </ul>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </li>
                        </ul> --}}

                        <!-- Admin menu -->
                        @role('operator')
                        <ul class="navbar-nav navbar-mega-nav pe-lg-2 me-lg-2">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Admin</a>
                                <ul class="dropdown-menu">
                                    <li class="dropdown position-static mb-0">
                                        <a class="dropdown-item py-2 border-bottom" href="{{route('admin.customers.index')}}" previewlistener="true">
                                            <span class="d-block text-heading">Clientes</span>
                                            {{-- <small class="d-block text-muted">Crea, Edita, Actualiza</small> --}}
                                        </a>
                                        {{-- <div class="dropdown-menu h-100 animation-none mt-0 p-3">
                                            <a class="d-block" href="home-fashion-store-v1.html" style="width: 250px;" previewlistener="true">
                                                <img src="img/home/preview/th01.jpg" alt="Fashion Store v.1">
                                            </a>
                                        </div> --}}
                                    </li>
                                    <li class="dropdown position-static mb-0">
                                        <a class="dropdown-item py-2 border-bottom" href="{{route('admin.products.index')}}" previewlistener="true">
                                            <span class="d-block text-heading">Productos</span>
                                            {{-- <small class="d-block text-muted">Slider + Promo banners</small> --}}
                                        </a>
                                        {{-- <div class="dropdown-menu h-100 animation-none mt-0 p-3">
                                            <a class="d-block" href="home-electronics-store.html" style="width: 250px;" previewlistener="true">
                                                <img src="img/home/preview/th03.jpg" alt="Electronics Store">
                                            </a>
                                        </div> --}}
                                    </li>
                                    <li class="dropdown position-static mb-0">
                                        <a class="dropdown-item py-2" href="{{route('admin.orders.index')}}" previewlistener="true">
                                            <span class="d-block text-heading">Ordenes</span>
                                            {{-- <small class="d-block text-muted">Full width + Side menu</small> --}}
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                        @endrole

                        <!-- Primary menu-->
                        <ul class="navbar-nav">
                            @if (Auth::check())
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Mi Cuenta</a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a class="dropdown-item" href="{{route('account.profile')}}" previewlistener="true">
                                            <div class="d-flex">
                                                <div class="lead text-muted pt-1"><i class="ci-book"></i></div>
                                                <div class="ms-2">
                                                    <span class="d-block text-heading">Mi Perfil</span>
                                                    <small class="d-block text-muted">Perfil y configuraciones</small>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="dropdown-divider"></li>

                                    <li>
                                        <a class="dropdown-item" href="{{route('account.orders')}}" previewlistener="true">
                                        <div class="d-flex">
                                            <div class="lead text-muted pt-1"><i class="ci-edit"></i></div>
                                                <div class="ms-2">
                                                    <span class="d-block text-heading">Mis Ordenes
                                                        {{-- <span class="badge bg-success ms-2">v2.5.1</span> --}}
                                                    </span>
                                                    <small class="d-block text-muted">Historial de ordenes</small>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="dropdown-divider"></li>
                                    {{-- <li>
                                        <a class="dropdown-item" href="components/typography.html" previewlistener="true">
                                            <div class="d-flex">
                                                <div class="lead text-muted pt-1"><i class="ci-server"></i></div>
                                                <div class="ms-2">
                                                    <span class="d-block text-heading">Pedidos En Tránsito<span class="badge bg-info ms-2">1+</span></span>
                                                    <small class="d-block text-muted">Seguimiento de Ordenes</small>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="dropdown-divider"></li> --}}
                                    <li>
                                        <a class="dropdown-item" href="{{route('account.contact')}}">
                                            <div class="d-flex">
                                                <div class="lead text-muted pt-1"><i class="ci-help"></i></div>
                                                <div class="ms-2">
                                                    <span class="d-block text-heading">Contacto</span>
                                                    <small class="d-block text-muted">Formulario de contacto</small>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="dropdown-divider"></li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();"
                                        >
                                            Cerrar Sesión
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            @endif

                            {{-- <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Shop</a>
                                <div class="dropdown-menu p-0">
                                    <div class="d-flex flex-wrap flex-sm-nowrap px-2">
                                    <div class="mega-dropdown-column pt-1 pt-lg-4 pb-4 px-2 px-lg-3">
                                        <div class="widget widget-links mb-4">
                                        <h6 class="fs-base mb-3">Shop layouts</h6>
                                        <ul class="widget-list">
                                            <li class="widget-list-item"><a class="widget-list-link" href="shop-grid-ls.html" previewlistener="true">Shop Grid - Left Sidebar</a></li>
                                            <li class="widget-list-item"><a class="widget-list-link" href="shop-grid-rs.html" previewlistener="true">Shop Grid - Right Sidebar</a></li>
                                            <li class="widget-list-item"><a class="widget-list-link" href="shop-grid-ft.html" previewlistener="true">Shop Grid - Filters on Top</a></li>
                                            <li class="widget-list-item"><a class="widget-list-link" href="shop-list-ls.html" previewlistener="true">Shop List - Left Sidebar</a></li>
                                            <li class="widget-list-item"><a class="widget-list-link" href="shop-list-rs.html" previewlistener="true">Shop List - Right Sidebar</a></li>
                                            <li class="widget-list-item"><a class="widget-list-link" href="shop-list-ft.html" previewlistener="true">Shop List - Filters on Top</a></li>
                                        </ul>
                                        </div>
                                        <div class="widget widget-links mb-4">
                                        <h6 class="fs-base mb-3">Marketplace</h6>
                                        <ul class="widget-list">
                                            <li class="widget-list-item"><a class="widget-list-link" href="marketplace-category.html" previewlistener="true">Category Page</a></li>
                                            <li class="widget-list-item"><a class="widget-list-link" href="marketplace-single.html" previewlistener="true">Single Item Page</a></li>
                                            <li class="widget-list-item"><a class="widget-list-link" href="marketplace-vendor.html" previewlistener="true">Vendor Page</a></li>
                                            <li class="widget-list-item"><a class="widget-list-link" href="marketplace-cart.html" previewlistener="true">Cart</a></li>
                                            <li class="widget-list-item"><a class="widget-list-link" href="marketplace-checkout.html" previewlistener="true">Checkout</a></li>
                                        </ul>
                                        </div>
                                        <div class="widget widget-links">
                                        <h6 class="fs-base mb-3">Grocery store</h6>
                                        <ul class="widget-list">
                                            <li class="widget-list-item"><a class="widget-list-link" href="grocery-catalog.html" previewlistener="true">Product Catalog</a></li>
                                            <li class="widget-list-item"><a class="widget-list-link" href="grocery-single.html" previewlistener="true">Single Product Page</a></li>
                                            <li class="widget-list-item"><a class="widget-list-link" href="grocery-checkout.html" previewlistener="true">Checkout</a></li>
                                        </ul>
                                        </div>
                                    </div>
                                    <div class="mega-dropdown-column pt-1 pt-lg-4 pb-4 px-2 px-lg-3">
                                        <div class="widget widget-links mb-4">
                                        <h6 class="fs-base mb-3">Food Delivery</h6>
                                        <ul class="widget-list">
                                            <li class="widget-list-item"><a class="widget-list-link" href="food-delivery-category.html" previewlistener="true">Category Page</a></li>
                                            <li class="widget-list-item"><a class="widget-list-link" href="food-delivery-single.html" previewlistener="true">Single Item (Restaurant)</a></li>
                                            <li class="widget-list-item"><a class="widget-list-link" href="food-delivery-cart.html" previewlistener="true">Cart (Your Order)</a></li>
                                            <li class="widget-list-item"><a class="widget-list-link" href="food-delivery-checkout.html" previewlistener="true">Checkout (Address &amp; Payment)</a></li>
                                        </ul>
                                        </div>
                                        <div class="widget widget-links">
                                        <h6 class="fs-base mb-3">NFT Marketplace<span class="badge bg-danger ms-1">NEW</span></h6>
                                        <ul class="widget-list">
                                            <li class="widget-list-item"><a class="widget-list-link" href="nft-catalog-v1.html" previewlistener="true">Catalog v.1</a></li>
                                            <li class="widget-list-item"><a class="widget-list-link" href="nft-catalog-v2.html" previewlistener="true">Catalog v.2</a></li>
                                            <li class="widget-list-item"><a class="widget-list-link" href="nft-single-auction-live.html" previewlistener="true">Single Item - Auction Live</a></li>
                                            <li class="widget-list-item"><a class="widget-list-link" href="nft-single-auction-ended.html" previewlistener="true">Single Item - Auction Ended</a></li>
                                            <li class="widget-list-item"><a class="widget-list-link" href="nft-single-buy.html" previewlistener="true">Single Item - Buy Now</a></li>
                                            <li class="widget-list-item"><a class="widget-list-link" href="nft-vendor.html" previewlistener="true">Vendor Page</a></li>
                                            <li class="widget-list-item"><a class="widget-list-link" href="nft-connect-wallet.html" previewlistener="true">Connect Wallet</a></li>
                                            <li class="widget-list-item"><a class="widget-list-link" href="nft-create-item.html" previewlistener="true">Create New Item</a></li>
                                        </ul>
                                        </div>
                                    </div>
                                    <div class="mega-dropdown-column pt-1 pt-lg-4 px-2 px-lg-3">
                                        <div class="widget widget-links mb-4">
                                        <h6 class="fs-base mb-3">Shop pages</h6>
                                        <ul class="widget-list">
                                            <li class="widget-list-item"><a class="widget-list-link" href="shop-categories.html" previewlistener="true">Shop Categories</a></li>
                                            <li class="widget-list-item"><a class="widget-list-link" href="shop-single-v1.html" previewlistener="true">Product Page v.1</a></li>
                                            <li class="widget-list-item"><a class="widget-list-link" href="shop-single-v2.html" previewlistener="true">Product Page v.2</a></li>
                                            <li class="widget-list-item"><a class="widget-list-link" href="shop-cart.html" previewlistener="true">Cart</a></li>
                                            <li class="widget-list-item"><a class="widget-list-link" href="checkout-details.html" previewlistener="true">Checkout - Details</a></li>
                                            <li class="widget-list-item"><a class="widget-list-link" href="checkout-shipping.html" previewlistener="true">Checkout - Shipping</a></li>
                                            <li class="widget-list-item"><a class="widget-list-link" href="checkout-payment.html" previewlistener="true">Checkout - Payment</a></li>
                                            <li class="widget-list-item"><a class="widget-list-link" href="checkout-review.html" previewlistener="true">Checkout - Review</a></li>
                                            <li class="widget-list-item"><a class="widget-list-link" href="checkout-complete.html" previewlistener="true">Checkout - Complete</a></li>
                                            <li class="widget-list-item"><a class="widget-list-link" href="order-tracking.html" previewlistener="true">Order Tracking</a></li>
                                            <li class="widget-list-item"><a class="widget-list-link" href="comparison.html" previewlistener="true">Product Comparison</a></li>
                                        </ul>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" data-bs-auto-close="outside">Account</a>
                                <ul class="dropdown-menu">
                                    <li class="dropdown"><a class="dropdown-item dropdown-toggle" href="#" data-bs-toggle="dropdown">Shop User Account</a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="account-orders.html" previewlistener="true">Orders History</a></li>
                                        <li><a class="dropdown-item" href="account-profile.html" previewlistener="true">Profile Settings</a></li>
                                        <li><a class="dropdown-item" href="account-address.html" previewlistener="true">Account Addresses</a></li>
                                        <li><a class="dropdown-item" href="account-payment.html" previewlistener="true">Payment Methods</a></li>
                                        <li><a class="dropdown-item" href="account-wishlist.html" previewlistener="true">Wishlist</a></li>
                                        <li><a class="dropdown-item" href="account-tickets.html" previewlistener="true">My Tickets</a></li>
                                        <li><a class="dropdown-item" href="account-single-ticket.html" previewlistener="true">Single Ticket</a></li>
                                    </ul>
                                    </li>
                                    <li class="dropdown"><a class="dropdown-item dropdown-toggle" href="#" data-bs-toggle="dropdown">Vendor Dashboard</a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="dashboard-settings.html" previewlistener="true">Settings</a></li>
                                        <li><a class="dropdown-item" href="dashboard-purchases.html" previewlistener="true">Purchases</a></li>
                                        <li><a class="dropdown-item" href="dashboard-favorites.html" previewlistener="true">Favorites</a></li>
                                        <li><a class="dropdown-item" href="dashboard-sales.html" previewlistener="true">Sales</a></li>
                                        <li><a class="dropdown-item" href="dashboard-products.html" previewlistener="true">Products</a></li>
                                        <li><a class="dropdown-item" href="dashboard-add-new-product.html" previewlistener="true">Add New Product</a></li>
                                        <li><a class="dropdown-item" href="dashboard-payouts.html" previewlistener="true">Payouts</a></li>
                                    </ul>
                                    </li>
                                    <li class="dropdown"><a class="dropdown-item dropdown-toggle" href="#" data-bs-toggle="dropdown">NFT Marketplace<span class="badge bg-danger ms-1">NEW</span></a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="nft-account-settings.html" previewlistener="true">Profile Settings</a></li>
                                        <li><a class="dropdown-item" href="nft-account-payouts.html" previewlistener="true">Wallet &amp; Payouts</a></li>
                                        <li><a class="dropdown-item" href="nft-account-my-items.html" previewlistener="true">My Items</a></li>
                                        <li><a class="dropdown-item" href="nft-account-my-collections.html" previewlistener="true">My Collections</a></li>
                                        <li><a class="dropdown-item" href="nft-account-favorites.html" previewlistener="true">Favorites</a></li>
                                        <li><a class="dropdown-item" href="nft-account-notifications.html" previewlistener="true">Notifications</a></li>
                                    </ul>
                                    </li>
                                    <li><a class="dropdown-item" href="account-signin.html" previewlistener="true">Sign In / Sign Up</a></li>
                                    <li><a class="dropdown-item" href="account-password-recovery.html" previewlistener="true">Password Recovery</a></li>
                                </ul>
                            </li>
                            <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" data-bs-auto-close="outside">Pages</a>
                                <ul class="dropdown-menu">
                                    <li class="dropdown"><a class="dropdown-item dropdown-toggle" href="#" data-bs-toggle="dropdown">Navbar Variants</a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="navbar-1-level-light.html" previewlistener="true">1 Level Light</a></li>
                                        <li><a class="dropdown-item" href="navbar-1-level-dark.html" previewlistener="true">1 Level Dark</a></li>
                                        <li><a class="dropdown-item" href="navbar-2-level-light.html" previewlistener="true">2 Level Light</a></li>
                                        <li><a class="dropdown-item" href="navbar-2-level-dark.html" previewlistener="true">2 Level Dark</a></li>
                                        <li><a class="dropdown-item" href="navbar-3-level-light.html" previewlistener="true">3 Level Light</a></li>
                                        <li><a class="dropdown-item" href="navbar-3-level-dark.html" previewlistener="true">3 Level Dark</a></li>
                                        <li><a class="dropdown-item" href="home-electronics-store.html" previewlistener="true">Electronics Store</a></li>
                                        <li><a class="dropdown-item" href="home-marketplace.html" previewlistener="true">Marketplace</a></li>
                                        <li><a class="dropdown-item" href="home-grocery-store.html" previewlistener="true">Side Menu (Grocery)</a></li>
                                    </ul>
                                    </li>
                                    <li class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="about.html" previewlistener="true">About Us</a></li>
                                    <li><a class="dropdown-item" href="contacts.html" previewlistener="true">Contacts</a></li>
                                    <li class="dropdown"><a class="dropdown-item dropdown-toggle" href="#" data-bs-toggle="dropdown">Help Center</a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="help-topics.html" previewlistener="true">Help Topics</a></li>
                                        <li><a class="dropdown-item" href="help-single-topic.html" previewlistener="true">Single Topic</a></li>
                                        <li><a class="dropdown-item" href="help-submit-request.html" previewlistener="true">Submit a Request</a></li>
                                    </ul>
                                    </li>
                                    <li class="dropdown"><a class="dropdown-item dropdown-toggle" href="#" data-bs-toggle="dropdown">404 Not Found</a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="404-simple.html" previewlistener="true">404 - Simple Text</a></li>
                                        <li><a class="dropdown-item" href="404-illustration.html" previewlistener="true">404 - Illustration</a></li>
                                    </ul>
                                    </li>
                                    <li class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="sticky-footer.html" previewlistener="true">Sticky Footer Demo</a></li>
                                </ul>
                            </li>
                            <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" data-bs-auto-close="outside">Blog</a>
                                <ul class="dropdown-menu">
                                    <li class="dropdown"><a class="dropdown-item dropdown-toggle" href="#" data-bs-toggle="dropdown">Blog List Layouts</a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="blog-list-sidebar.html" previewlistener="true">List with Sidebar</a></li>
                                        <li><a class="dropdown-item" href="blog-list.html" previewlistener="true">List no Sidebar</a></li>
                                    </ul>
                                    </li>
                                    <li class="dropdown"><a class="dropdown-item dropdown-toggle" href="#" data-bs-toggle="dropdown">Blog Grid Layouts</a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="blog-grid-sidebar.html" previewlistener="true">Grid with Sidebar</a></li>
                                        <li><a class="dropdown-item" href="blog-grid.html" previewlistener="true">Grid no Sidebar</a></li>
                                    </ul>
                                    </li>
                                    <li class="dropdown"><a class="dropdown-item dropdown-toggle" href="#" data-bs-toggle="dropdown">Single Post Layouts</a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="blog-single-sidebar.html" previewlistener="true">Article with Sidebar</a></li>
                                        <li><a class="dropdown-item" href="blog-single.html" previewlistener="true">Article no Sidebar</a></li>
                                    </ul>
                                    </li>
                                </ul>
                            </li> --}}
                        </ul>
                    </div>
                </div>
            </div>

            {{-- <div class="navbar navbar-expand-lg navbar-light navbar-stuck-menu mt-n2 pt-0 pb-2">
                <div class="container">
                    <div class="collapse navbar-collapse" id="navbarCollapse">
                    <!-- Search-->
                    <div class="input-group d-lg-none my-3"><i class="ci-search position-absolute top-50 start-0 translate-middle-y text-muted fs-base ms-3"></i>
                        <input class="form-control rounded-start" type="text" placeholder="Search for products">
                    </div>
                    <!-- Departments menu-->
                    <ul class="navbar-nav navbar-mega-nav pe-lg-2 me-lg-2">
                        <li class="nav-item dropdown"><a class="nav-link dropdown-toggle ps-lg-0" href="#" data-bs-toggle="dropdown"><i class="ci-view-grid me-2"></i>Departments</a>
                        <div class="dropdown-menu px-2 pb-4">
                            <div class="d-flex flex-wrap flex-sm-nowrap">
                            <div class="mega-dropdown-column pt-3 pt-sm-4 px-2 px-lg-3">
                                <div class="widget widget-links"><a class="d-block overflow-hidden rounded-3 mb-3" href="#"><img src="img/shop/departments/01.jpg" alt="Clothing"></a>
                                <h6 class="fs-base mb-2">Clothing</h6>
                                <ul class="widget-list">
                                    <li class="widget-list-item mb-1"><a class="widget-list-link" href="#">Women's clothing</a></li>
                                    <li class="widget-list-item mb-1"><a class="widget-list-link" href="#">Men's clothing</a></li>
                                    <li class="widget-list-item mb-1"><a class="widget-list-link" href="#">Kid's clothing</a></li>
                                </ul>
                                </div>
                            </div>
                            <div class="mega-dropdown-column pt-4 px-2 px-lg-3">
                                <div class="widget widget-links"><a class="d-block overflow-hidden rounded-3 mb-3" href="#"><img src="img/shop/departments/02.jpg" alt="Shoes"></a>
                                <h6 class="fs-base mb-2">Shoes</h6>
                                <ul class="widget-list">
                                    <li class="widget-list-item mb-1"><a class="widget-list-link" href="#">Women's shoes</a></li>
                                    <li class="widget-list-item mb-1"><a class="widget-list-link" href="#">Men's shoes</a></li>
                                    <li class="widget-list-item mb-1"><a class="widget-list-link" href="#">Kid's shoes</a></li>
                                </ul>
                                </div>
                            </div>
                            <div class="mega-dropdown-column pt-4 px-2 px-lg-3">
                                <div class="widget widget-links"><a class="d-block overflow-hidden rounded-3 mb-3" href="#"><img src="img/shop/departments/03.jpg" alt="Gadgets"></a>
                                <h6 class="fs-base mb-2">Gadgets</h6>
                                <ul class="widget-list">
                                    <li class="widget-list-item mb-1"><a class="widget-list-link" href="#">Smartphones &amp; Tablets</a></li>
                                    <li class="widget-list-item mb-1"><a class="widget-list-link" href="#">Wearable gadgets</a></li>
                                    <li class="widget-list-item mb-1"><a class="widget-list-link" href="#">E-book readers</a></li>
                                </ul>
                                </div>
                            </div>
                            </div>
                            <div class="d-flex flex-wrap flex-sm-nowrap">
                            <div class="mega-dropdown-column pt-4 px-2 px-lg-3">
                                <div class="widget widget-links"><a class="d-block overflow-hidden rounded-3 mb-3" href="#"><img src="img/shop/departments/04.jpg" alt="Furniture"></a>
                                <h6 class="fs-base mb-2">Furniture &amp; Decor</h6>
                                <ul class="widget-list">
                                    <li class="widget-list-item mb-1"><a class="widget-list-link" href="#">Home furniture</a></li>
                                    <li class="widget-list-item mb-1"><a class="widget-list-link" href="#">Office furniture</a></li>
                                    <li class="widget-list-item mb-1"><a class="widget-list-link" href="#">Lighting and decoration</a></li>
                                </ul>
                                </div>
                            </div>
                            <div class="mega-dropdown-column pt-4 px-2 px-lg-3">
                                <div class="widget widget-links"><a class="d-block overflow-hidden rounded-3 mb-3" href="#"><img src="img/shop/departments/05.jpg" alt="Accessories"></a>
                                <h6 class="fs-base mb-2">Accessories</h6>
                                <ul class="widget-list">
                                    <li class="widget-list-item mb-1"><a class="widget-list-link" href="#">Hats</a></li>
                                    <li class="widget-list-item mb-1"><a class="widget-list-link" href="#">Sunglasses</a></li>
                                    <li class="widget-list-item mb-1"><a class="widget-list-link" href="#">Bags</a></li>
                                </ul>
                                </div>
                            </div>
                            <div class="mega-dropdown-column pt-4 px-2 px-lg-3">
                                <div class="widget widget-links"><a class="d-block overflow-hidden rounded-3 mb-3" href="#"><img src="img/shop/departments/06.jpg" alt="Entertainment"></a>
                                <h6 class="fs-base mb-2">Entertainment</h6>
                                <ul class="widget-list">
                                    <li class="widget-list-item mb-1"><a class="widget-list-link" href="#">Kid's toys</a></li>
                                    <li class="widget-list-item mb-1"><a class="widget-list-link" href="#">Video games</a></li>
                                    <li class="widget-list-item mb-1"><a class="widget-list-link" href="#">Outdoor / Camping</a></li>
                                </ul>
                                </div>
                            </div>
                            </div>
                        </div>
                        </li>
                    </ul>
                    <!-- Primary menu-->
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown active"><a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Home</a>
                        <ul class="dropdown-menu">
                            <li class="dropdown position-static mb-0"><a class="dropdown-item border-bottom py-2" href="home-nft.html" previewlistener="true"><span class="d-block text-heading">NFT Marketplace<span class="badge bg-danger ms-1">NEW</span></span><small class="d-block text-muted">NFTs, Multi-vendor, Auctions</small></a>
                            <div class="dropdown-menu h-100 animation-none mt-0 p-3"><a class="d-block" href="home-nft.html" style="width: 250px;" previewlistener="true"><img src="img/home/preview/th08.jpg" alt="NFT Marketplace"></a></div>
                            </li>
                            <li class="dropdown position-static mb-0"><a class="dropdown-item py-2 border-bottom" href="home-fashion-store-v1.html" previewlistener="true"><span class="d-block text-heading">Fashion Store v.1</span><small class="d-block text-muted">Classic shop layout</small></a>
                            <div class="dropdown-menu h-100 animation-none mt-0 p-3"><a class="d-block" href="home-fashion-store-v1.html" style="width: 250px;" previewlistener="true"><img src="img/home/preview/th01.jpg" alt="Fashion Store v.1"></a></div>
                            </li>
                            <li class="dropdown position-static mb-0"><a class="dropdown-item py-2 border-bottom" href="home-electronics-store.html" previewlistener="true"><span class="d-block text-heading">Electronics Store</span><small class="d-block text-muted">Slider + Promo banners</small></a>
                            <div class="dropdown-menu h-100 animation-none mt-0 p-3"><a class="d-block" href="home-electronics-store.html" style="width: 250px;" previewlistener="true"><img src="img/home/preview/th03.jpg" alt="Electronics Store"></a></div>
                            </li>
                            <li class="dropdown position-static mb-0"><a class="dropdown-item py-2 border-bottom" href="home-marketplace.html" previewlistener="true"><span class="d-block text-heading">Marketplace</span><small class="d-block text-muted">Multi-vendor, digital goods</small></a>
                            <div class="dropdown-menu h-100 animation-none mt-0 p-3"><a class="d-block" href="home-marketplace.html" style="width: 250px;" previewlistener="true"><img src="img/home/preview/th04.jpg" alt="Marketplace"></a></div>
                            </li>
                            <li class="dropdown position-static mb-0"><a class="dropdown-item py-2 border-bottom" href="home-grocery-store.html" previewlistener="true"><span class="d-block text-heading">Grocery Store</span><small class="d-block text-muted">Full width + Side menu</small></a>
                            <div class="dropdown-menu h-100 animation-none mt-0 p-3"><a class="d-block" href="home-grocery-store.html" style="width: 250px;" previewlistener="true"><img src="img/home/preview/th06.jpg" alt="Grocery Store"></a></div>
                            </li>
                            <li class="dropdown position-static mb-0"><a class="dropdown-item py-2 border-bottom" href="home-food-delivery.html" previewlistener="true"><span class="d-block text-heading">Food Delivery Service</span><small class="d-block text-muted">Food &amp; Beverages delivery</small></a>
                            <div class="dropdown-menu h-100 animation-none mt-0 p-3"><a class="d-block" href="home-food-delivery.html" style="width: 250px;" previewlistener="true"><img src="img/home/preview/th07.jpg" alt="Food Delivery Service"></a></div>
                            </li>
                            <li class="dropdown position-static mb-0"><a class="dropdown-item py-2 border-bottom" href="home-fashion-store-v2.html" previewlistener="true"><span class="d-block text-heading">Fashion Store v.2</span><small class="d-block text-muted">Slider + Featured categories</small></a>
                            <div class="dropdown-menu h-100 animation-none mt-0 p-3"><a class="d-block" href="home-fashion-store-v2.html" style="width: 250px;" previewlistener="true"><img src="img/home/preview/th02.jpg" alt="Fashion Store v.2"></a></div>
                            </li>
                            <li class="dropdown position-static mb-0"><a class="dropdown-item py-2" href="home-single-store.html" previewlistener="true"><span class="d-block text-heading">Single Product Store</span><small class="d-block text-muted">Single product / mono brand</small></a>
                            <div class="dropdown-menu h-100 animation-none mt-0 p-3"><a class="d-block" href="home-single-store.html" style="width: 250px;" previewlistener="true"><img src="img/home/preview/th05.jpg" alt="Single Product / Brand Store"></a></div>
                            </li>
                        </ul>
                        </li>
                        <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Shop</a>
                        <div class="dropdown-menu p-0">
                            <div class="d-flex flex-wrap flex-sm-nowrap px-2">
                            <div class="mega-dropdown-column pt-1 pt-lg-4 pb-4 px-2 px-lg-3">
                                <div class="widget widget-links mb-4">
                                <h6 class="fs-base mb-3">Shop layouts</h6>
                                <ul class="widget-list">
                                    <li class="widget-list-item"><a class="widget-list-link" href="shop-grid-ls.html" previewlistener="true">Shop Grid - Left Sidebar</a></li>
                                    <li class="widget-list-item"><a class="widget-list-link" href="shop-grid-rs.html" previewlistener="true">Shop Grid - Right Sidebar</a></li>
                                    <li class="widget-list-item"><a class="widget-list-link" href="shop-grid-ft.html" previewlistener="true">Shop Grid - Filters on Top</a></li>
                                    <li class="widget-list-item"><a class="widget-list-link" href="shop-list-ls.html" previewlistener="true">Shop List - Left Sidebar</a></li>
                                    <li class="widget-list-item"><a class="widget-list-link" href="shop-list-rs.html" previewlistener="true">Shop List - Right Sidebar</a></li>
                                    <li class="widget-list-item"><a class="widget-list-link" href="shop-list-ft.html" previewlistener="true">Shop List - Filters on Top</a></li>
                                </ul>
                                </div>
                                <div class="widget widget-links mb-4">
                                <h6 class="fs-base mb-3">Marketplace</h6>
                                <ul class="widget-list">
                                    <li class="widget-list-item"><a class="widget-list-link" href="marketplace-category.html" previewlistener="true">Category Page</a></li>
                                    <li class="widget-list-item"><a class="widget-list-link" href="marketplace-single.html" previewlistener="true">Single Item Page</a></li>
                                    <li class="widget-list-item"><a class="widget-list-link" href="marketplace-vendor.html" previewlistener="true">Vendor Page</a></li>
                                    <li class="widget-list-item"><a class="widget-list-link" href="marketplace-cart.html" previewlistener="true">Cart</a></li>
                                    <li class="widget-list-item"><a class="widget-list-link" href="marketplace-checkout.html" previewlistener="true">Checkout</a></li>
                                </ul>
                                </div>
                                <div class="widget widget-links">
                                <h6 class="fs-base mb-3">Grocery store</h6>
                                <ul class="widget-list">
                                    <li class="widget-list-item"><a class="widget-list-link" href="grocery-catalog.html" previewlistener="true">Product Catalog</a></li>
                                    <li class="widget-list-item"><a class="widget-list-link" href="grocery-single.html" previewlistener="true">Single Product Page</a></li>
                                    <li class="widget-list-item"><a class="widget-list-link" href="grocery-checkout.html" previewlistener="true">Checkout</a></li>
                                </ul>
                                </div>
                            </div>
                            <div class="mega-dropdown-column pt-1 pt-lg-4 pb-4 px-2 px-lg-3">
                                <div class="widget widget-links mb-4">
                                <h6 class="fs-base mb-3">Food Delivery</h6>
                                <ul class="widget-list">
                                    <li class="widget-list-item"><a class="widget-list-link" href="food-delivery-category.html" previewlistener="true">Category Page</a></li>
                                    <li class="widget-list-item"><a class="widget-list-link" href="food-delivery-single.html" previewlistener="true">Single Item (Restaurant)</a></li>
                                    <li class="widget-list-item"><a class="widget-list-link" href="food-delivery-cart.html" previewlistener="true">Cart (Your Order)</a></li>
                                    <li class="widget-list-item"><a class="widget-list-link" href="food-delivery-checkout.html" previewlistener="true">Checkout (Address &amp; Payment)</a></li>
                                </ul>
                                </div>
                                <div class="widget widget-links">
                                <h6 class="fs-base mb-3">NFT Marketplace<span class="badge bg-danger ms-1">NEW</span></h6>
                                <ul class="widget-list">
                                    <li class="widget-list-item"><a class="widget-list-link" href="nft-catalog-v1.html" previewlistener="true">Catalog v.1</a></li>
                                    <li class="widget-list-item"><a class="widget-list-link" href="nft-catalog-v2.html" previewlistener="true">Catalog v.2</a></li>
                                    <li class="widget-list-item"><a class="widget-list-link" href="nft-single-auction-live.html" previewlistener="true">Single Item - Auction Live</a></li>
                                    <li class="widget-list-item"><a class="widget-list-link" href="nft-single-auction-ended.html" previewlistener="true">Single Item - Auction Ended</a></li>
                                    <li class="widget-list-item"><a class="widget-list-link" href="nft-single-buy.html" previewlistener="true">Single Item - Buy Now</a></li>
                                    <li class="widget-list-item"><a class="widget-list-link" href="nft-vendor.html" previewlistener="true">Vendor Page</a></li>
                                    <li class="widget-list-item"><a class="widget-list-link" href="nft-connect-wallet.html" previewlistener="true">Connect Wallet</a></li>
                                    <li class="widget-list-item"><a class="widget-list-link" href="nft-create-item.html" previewlistener="true">Create New Item</a></li>
                                </ul>
                                </div>
                            </div>
                            <div class="mega-dropdown-column pt-1 pt-lg-4 px-2 px-lg-3">
                                <div class="widget widget-links mb-4">
                                <h6 class="fs-base mb-3">Shop pages</h6>
                                <ul class="widget-list">
                                    <li class="widget-list-item"><a class="widget-list-link" href="shop-categories.html" previewlistener="true">Shop Categories</a></li>
                                    <li class="widget-list-item"><a class="widget-list-link" href="shop-single-v1.html" previewlistener="true">Product Page v.1</a></li>
                                    <li class="widget-list-item"><a class="widget-list-link" href="shop-single-v2.html" previewlistener="true">Product Page v.2</a></li>
                                    <li class="widget-list-item"><a class="widget-list-link" href="shop-cart.html" previewlistener="true">Cart</a></li>
                                    <li class="widget-list-item"><a class="widget-list-link" href="checkout-details.html" previewlistener="true">Checkout - Details</a></li>
                                    <li class="widget-list-item"><a class="widget-list-link" href="checkout-shipping.html" previewlistener="true">Checkout - Shipping</a></li>
                                    <li class="widget-list-item"><a class="widget-list-link" href="checkout-payment.html" previewlistener="true">Checkout - Payment</a></li>
                                    <li class="widget-list-item"><a class="widget-list-link" href="checkout-review.html" previewlistener="true">Checkout - Review</a></li>
                                    <li class="widget-list-item"><a class="widget-list-link" href="checkout-complete.html" previewlistener="true">Checkout - Complete</a></li>
                                    <li class="widget-list-item"><a class="widget-list-link" href="order-tracking.html" previewlistener="true">Order Tracking</a></li>
                                    <li class="widget-list-item"><a class="widget-list-link" href="comparison.html" previewlistener="true">Product Comparison</a></li>
                                </ul>
                                </div>
                            </div>
                            </div>
                        </div>
                        </li>
                        <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" data-bs-auto-close="outside">Account</a>
                        <ul class="dropdown-menu">
                            <li class="dropdown"><a class="dropdown-item dropdown-toggle" href="#" data-bs-toggle="dropdown">Shop User Account</a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="account-orders.html" previewlistener="true">Orders History</a></li>
                                <li><a class="dropdown-item" href="account-profile.html" previewlistener="true">Profile Settings</a></li>
                                <li><a class="dropdown-item" href="account-address.html" previewlistener="true">Account Addresses</a></li>
                                <li><a class="dropdown-item" href="account-payment.html" previewlistener="true">Payment Methods</a></li>
                                <li><a class="dropdown-item" href="account-wishlist.html" previewlistener="true">Wishlist</a></li>
                                <li><a class="dropdown-item" href="account-tickets.html" previewlistener="true">My Tickets</a></li>
                                <li><a class="dropdown-item" href="account-single-ticket.html" previewlistener="true">Single Ticket</a></li>
                            </ul>
                            </li>
                            <li class="dropdown"><a class="dropdown-item dropdown-toggle" href="#" data-bs-toggle="dropdown">Vendor Dashboard</a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="dashboard-settings.html" previewlistener="true">Settings</a></li>
                                <li><a class="dropdown-item" href="dashboard-purchases.html" previewlistener="true">Purchases</a></li>
                                <li><a class="dropdown-item" href="dashboard-favorites.html" previewlistener="true">Favorites</a></li>
                                <li><a class="dropdown-item" href="dashboard-sales.html" previewlistener="true">Sales</a></li>
                                <li><a class="dropdown-item" href="dashboard-products.html" previewlistener="true">Products</a></li>
                                <li><a class="dropdown-item" href="dashboard-add-new-product.html" previewlistener="true">Add New Product</a></li>
                                <li><a class="dropdown-item" href="dashboard-payouts.html" previewlistener="true">Payouts</a></li>
                            </ul>
                            </li>
                            <li class="dropdown"><a class="dropdown-item dropdown-toggle" href="#" data-bs-toggle="dropdown">NFT Marketplace<span class="badge bg-danger ms-1">NEW</span></a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="nft-account-settings.html" previewlistener="true">Profile Settings</a></li>
                                <li><a class="dropdown-item" href="nft-account-payouts.html" previewlistener="true">Wallet &amp; Payouts</a></li>
                                <li><a class="dropdown-item" href="nft-account-my-items.html" previewlistener="true">My Items</a></li>
                                <li><a class="dropdown-item" href="nft-account-my-collections.html" previewlistener="true">My Collections</a></li>
                                <li><a class="dropdown-item" href="nft-account-favorites.html" previewlistener="true">Favorites</a></li>
                                <li><a class="dropdown-item" href="nft-account-notifications.html" previewlistener="true">Notifications</a></li>
                            </ul>
                            </li>
                            <li><a class="dropdown-item" href="account-signin.html" previewlistener="true">Sign In / Sign Up</a></li>
                            <li><a class="dropdown-item" href="account-password-recovery.html" previewlistener="true">Password Recovery</a></li>
                        </ul>
                        </li>
                        <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" data-bs-auto-close="outside">Pages</a>
                        <ul class="dropdown-menu">
                            <li class="dropdown"><a class="dropdown-item dropdown-toggle" href="#" data-bs-toggle="dropdown">Navbar Variants</a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="navbar-1-level-light.html" previewlistener="true">1 Level Light</a></li>
                                <li><a class="dropdown-item" href="navbar-1-level-dark.html" previewlistener="true">1 Level Dark</a></li>
                                <li><a class="dropdown-item" href="navbar-2-level-light.html" previewlistener="true">2 Level Light</a></li>
                                <li><a class="dropdown-item" href="navbar-2-level-dark.html" previewlistener="true">2 Level Dark</a></li>
                                <li><a class="dropdown-item" href="navbar-3-level-light.html" previewlistener="true">3 Level Light</a></li>
                                <li><a class="dropdown-item" href="navbar-3-level-dark.html" previewlistener="true">3 Level Dark</a></li>
                                <li><a class="dropdown-item" href="home-electronics-store.html" previewlistener="true">Electronics Store</a></li>
                                <li><a class="dropdown-item" href="home-marketplace.html" previewlistener="true">Marketplace</a></li>
                                <li><a class="dropdown-item" href="home-grocery-store.html" previewlistener="true">Side Menu (Grocery)</a></li>
                            </ul>
                            </li>
                            <li class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="about.html" previewlistener="true">About Us</a></li>
                            <li><a class="dropdown-item" href="contacts.html" previewlistener="true">Contacts</a></li>
                            <li class="dropdown"><a class="dropdown-item dropdown-toggle" href="#" data-bs-toggle="dropdown">Help Center</a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="help-topics.html" previewlistener="true">Help Topics</a></li>
                                <li><a class="dropdown-item" href="help-single-topic.html" previewlistener="true">Single Topic</a></li>
                                <li><a class="dropdown-item" href="help-submit-request.html" previewlistener="true">Submit a Request</a></li>
                            </ul>
                            </li>
                            <li class="dropdown"><a class="dropdown-item dropdown-toggle" href="#" data-bs-toggle="dropdown">404 Not Found</a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="404-simple.html" previewlistener="true">404 - Simple Text</a></li>
                                <li><a class="dropdown-item" href="404-illustration.html" previewlistener="true">404 - Illustration</a></li>
                            </ul>
                            </li>
                            <li class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="sticky-footer.html" previewlistener="true">Sticky Footer Demo</a></li>
                        </ul>
                        </li>
                        <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" data-bs-auto-close="outside">Blog</a>
                        <ul class="dropdown-menu">
                            <li class="dropdown"><a class="dropdown-item dropdown-toggle" href="#" data-bs-toggle="dropdown">Blog List Layouts</a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="blog-list-sidebar.html" previewlistener="true">List with Sidebar</a></li>
                                <li><a class="dropdown-item" href="blog-list.html" previewlistener="true">List no Sidebar</a></li>
                            </ul>
                            </li>
                            <li class="dropdown"><a class="dropdown-item dropdown-toggle" href="#" data-bs-toggle="dropdown">Blog Grid Layouts</a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="blog-grid-sidebar.html" previewlistener="true">Grid with Sidebar</a></li>
                                <li><a class="dropdown-item" href="blog-grid.html" previewlistener="true">Grid no Sidebar</a></li>
                            </ul>
                            </li>
                            <li class="dropdown"><a class="dropdown-item dropdown-toggle" href="#" data-bs-toggle="dropdown">Single Post Layouts</a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="blog-single-sidebar.html" previewlistener="true">Article with Sidebar</a></li>
                                <li><a class="dropdown-item" href="blog-single.html" previewlistener="true">Article no Sidebar</a></li>
                            </ul>
                            </li>
                        </ul>
                        </li>
                        <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Docs / Components</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="docs/dev-setup.html" previewlistener="true">
                                <div class="d-flex">
                                <div class="lead text-muted pt-1"><i class="ci-book"></i></div>
                                <div class="ms-2"><span class="d-block text-heading">Documentation</span><small class="d-block text-muted">Kick-start customization</small></div>
                                </div></a></li>
                            <li class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="components/typography.html" previewlistener="true">
                                <div class="d-flex">
                                <div class="lead text-muted pt-1"><i class="ci-server"></i></div>
                                <div class="ms-2"><span class="d-block text-heading">Components<span class="badge bg-info ms-2">40+</span></span><small class="d-block text-muted">Faster page building</small></div>
                                </div></a></li>
                            <li class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="docs/changelog.html" previewlistener="true">
                                <div class="d-flex">
                                <div class="lead text-muted pt-1"><i class="ci-edit"></i></div>
                                <div class="ms-2"><span class="d-block text-heading">Changelog<span class="badge bg-success ms-2">v2.5.1</span></span><small class="d-block text-muted">Regular updates</small></div>
                                </div></a></li>
                            <li class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="mailto:support@createx.studio">
                                <div class="d-flex">
                                <div class="lead text-muted pt-1"><i class="ci-help"></i></div>
                                <div class="ms-2"><span class="d-block text-heading">Support</span><small class="d-block text-muted">support@createx.studio</small></div>
                                </div></a></li>
                        </ul>
                        </li>
                    </ul>
                    </div>
                </div>
            </div> --}}
        </div>
        @endif

        <main class="py-4">
            @yield('content')
        </main>

        <footer class="footer bg-dark pt-5">
            <div class="container">
                <div class="row pb-2">
                    <div class="col-md-4 col-sm-6">
                        <div class="widget widget-links widget-light pb-2 mb-4">
                        <h3 class="widget-title text-light">Familias de productos</h3>
                        <ul class="widget-list">
                            <li class="widget-list-item"><a class="widget-list-link" href="#">Paneles</a></li>
                            <li class="widget-list-item"><a class="widget-list-link" href="#">Inversores</a></li>
                            <li class="widget-list-item"><a class="widget-list-link" href="#">Microinversores</a></li>
                            <li class="widget-list-item"><a class="widget-list-link" href="#">Estructuras</a></li>
                            <li class="widget-list-item"><a class="widget-list-link" href="#">Monitores</a></li>
                        </ul>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="widget widget-links widget-light pb-2 mb-4">
                        <h3 class="widget-title text-light">Cuenta y Información de Envío</h3>
                        <ul class="widget-list">
                            <li class="widget-list-item"><a class="widget-list-link" href="#">Tu cuenta</a></li>
                            <li class="widget-list-item"><a class="widget-list-link" href="#">Tárifas de envío y Políticas</a></li>
                            <li class="widget-list-item"><a class="widget-list-link" href="#">Reembolsos y reemplazos</a></li>
                            <li class="widget-list-item"><a class="widget-list-link" href="#">Seguimiento de orden</a></li>
                            <li class="widget-list-item"><a class="widget-list-link" href="#">Información de envío</a></li>
                            <li class="widget-list-item"><a class="widget-list-link" href="#">Impuestos y pagos</a></li>
                        </ul>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="widget widget-links widget-light pb-2 mb-4">
                            <h3 class="widget-title text-light">Sobre nosotros</h3>
                            <ul class="widget-list">
                                <li class="widget-list-item"><a class="widget-list-link" href="#">Sobre Solar Center</a></li>
                                <li class="widget-list-item"><a class="widget-list-link" href="#">Nuestro equipo</a></li>
                                {{-- <li class="widget-list-item"><a class="widget-list-link" href="#">Careers</a></li> --}}
                                <li class="widget-list-item"><a class="widget-list-link" href="#">Blog</a></li>
                            </ul>
                        </div>
                    </div>
                    {{-- <div class="col-md-4 col-sm-6">
                        <div class="widget widget-links widget-light pb-2 mb-4">
                        <h3 class="widget-title text-light">Shop departments</h3>
                        <ul class="widget-list">
                            <li class="widget-list-item"><a class="widget-list-link" href="#">Sneakers &amp; Athletic</a></li>
                            <li class="widget-list-item"><a class="widget-list-link" href="#">Athletic Apparel</a></li>
                            <li class="widget-list-item"><a class="widget-list-link" href="#">Sandals</a></li>
                            <li class="widget-list-item"><a class="widget-list-link" href="#">Jeans</a></li>
                            <li class="widget-list-item"><a class="widget-list-link" href="#">Shirts &amp; Tops</a></li>
                            <li class="widget-list-item"><a class="widget-list-link" href="#">Shorts</a></li>
                            <li class="widget-list-item"><a class="widget-list-link" href="#">T-Shirts</a></li>
                            <li class="widget-list-item"><a class="widget-list-link" href="#">Swimwear</a></li>
                            <li class="widget-list-item"><a class="widget-list-link" href="#">Clogs &amp; Mules</a></li>
                            <li class="widget-list-item"><a class="widget-list-link" href="#">Bags &amp; Wallets</a></li>
                            <li class="widget-list-item"><a class="widget-list-link" href="#">Accessories</a></li>
                            <li class="widget-list-item"><a class="widget-list-link" href="#">Sunglasses &amp; Eyewear</a></li>
                            <li class="widget-list-item"><a class="widget-list-link" href="#">Watches</a></li>
                        </ul>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="widget widget-links widget-light pb-2 mb-4">
                        <h3 class="widget-title text-light">Account &amp; shipping info</h3>
                        <ul class="widget-list">
                            <li class="widget-list-item"><a class="widget-list-link" href="#">Your account</a></li>
                            <li class="widget-list-item"><a class="widget-list-link" href="#">Shipping rates &amp; policies</a></li>
                            <li class="widget-list-item"><a class="widget-list-link" href="#">Refunds &amp; replacements</a></li>
                            <li class="widget-list-item"><a class="widget-list-link" href="#">Order tracking</a></li>
                            <li class="widget-list-item"><a class="widget-list-link" href="#">Delivery info</a></li>
                            <li class="widget-list-item"><a class="widget-list-link" href="#">Taxes &amp; fees</a></li>
                        </ul>
                        </div>
                        <div class="widget widget-links widget-light pb-2 mb-4">
                        <h3 class="widget-title text-light">About us</h3>
                        <ul class="widget-list">
                            <li class="widget-list-item"><a class="widget-list-link" href="#">About company</a></li>
                            <li class="widget-list-item"><a class="widget-list-link" href="#">Our team</a></li>
                            <li class="widget-list-item"><a class="widget-list-link" href="#">Careers</a></li>
                            <li class="widget-list-item"><a class="widget-list-link" href="#">News</a></li>
                        </ul>
                        </div>
                    </div> --}}
                    {{-- <div class="col-md-4">
                        <div class="widget pb-2 mb-4">
                            <h3 class="widget-title text-light pb-1">Stay informed</h3>
                            <form class="subscription-form validate" action="https://studio.us12.list-manage.com/subscribe/post?u=c7103e2c981361a6639545bd5&amp;amp;id=29ca296126" method="post" name="mc-embedded-subscribe-form" target="_blank" novalidate="">
                                <div class="input-group flex-nowrap"><i class="ci-mail position-absolute top-50 translate-middle-y text-muted fs-base ms-3"></i>
                                <input class="form-control rounded-start" type="email" name="EMAIL" placeholder="Your email" required="">
                                <button class="btn btn-primary" type="submit" name="subscribe">Subscribe*</button>
                                </div>
                                <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
                                <div style="position: absolute; left: -5000px;" aria-hidden="true">
                                <input class="subscription-form-antispam" type="text" name="b_c7103e2c981361a6639545bd5_29ca296126" tabindex="-1">
                                </div>
                                <div class="form-text text-light opacity-50">*Subscribe to our newsletter to receive early discount offers, updates and new products info.</div>
                                <div class="subscription-status"></div>
                            </form>
                        </div>
                        <div class="widget pb-2 mb-4">
                            <h3 class="widget-title text-light pb-1">Download our app</h3>
                            <div class="d-flex flex-wrap">
                                <div class="me-2 mb-2"><a class="btn-market btn-apple" href="#" role="button"><span class="btn-market-subtitle">Download on the</span><span class="btn-market-title">App Store</span></a></div>
                                <div class="mb-2"><a class="btn-market btn-google" href="#" role="button"><span class="btn-market-subtitle">Download on the</span><span class="btn-market-title">Google Play</span></a></div>
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>
            <div class="pt-5 bg-darker">
                <div class="container">
                {{-- <div class="row pb-3">
                    <div class="col-md-3 col-sm-6 mb-4">
                        <div class="d-flex"><i class="ci-rocket text-primary" style="font-size: 2.25rem;"></i>
                            <div class="ps-3">
                                <h6 class="fs-base text-light mb-1">Fast and free delivery</h6>
                                <p class="mb-0 fs-ms text-light opacity-50">Free delivery for all orders over $200</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 mb-4">
                        <div class="d-flex"><i class="ci-currency-exchange text-primary" style="font-size: 2.25rem;"></i>
                            <div class="ps-3">
                                <h6 class="fs-base text-light mb-1">Money back guarantee</h6>
                                <p class="mb-0 fs-ms text-light opacity-50">We return money within 30 days</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 mb-4">
                        <div class="d-flex"><i class="ci-support text-primary" style="font-size: 2.25rem;"></i>
                            <div class="ps-3">
                                <h6 class="fs-base text-light mb-1">24/7 customer support</h6>
                                <p class="mb-0 fs-ms text-light opacity-50">Friendly 24/7 customer support</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 mb-4">
                        <div class="d-flex"><i class="ci-card text-primary" style="font-size: 2.25rem;"></i>
                            <div class="ps-3">
                                <h6 class="fs-base text-light mb-1">Secure online payment</h6>
                                <p class="mb-0 fs-ms text-light opacity-50">We possess SSL / Secure сertificate</p>
                            </div>
                        </div>
                    </div>
                </div> --}}
                {{-- <hr class="hr-light mb-5"> --}}
                {{-- <div class="row pb-2">
                    <div class="col-md-6 text-center text-md-start mb-4">
                        <div class="text-nowrap mb-4"><a class="d-inline-block align-middle mt-n1 me-3" href="#"><img class="d-block" src="img/footer-logo-light.png" width="117" alt="Cartzilla"></a>
                            <div class="btn-group dropdown disable-autohide">
                            <button class="btn btn-outline-light border-light btn-sm dropdown-toggle px-2" type="button" data-bs-toggle="dropdown"><img class="me-2" src="img/flags/en.png" width="20" alt="English">Eng / $</button>
                            <ul class="dropdown-menu my-1">
                                <li class="dropdown-item">
                                <select class="form-select form-select-sm">
                                    <option value="usd">$ USD</option>
                                    <option value="eur">€ EUR</option>
                                    <option value="ukp">£ UKP</option>
                                    <option value="jpy">¥ JPY</option>
                                </select>
                                </li>
                                <li><a class="dropdown-item pb-1" href="#"><img class="me-2" src="img/flags/fr.png" width="20" alt="Français">Français</a></li>
                                <li><a class="dropdown-item pb-1" href="#"><img class="me-2" src="img/flags/de.png" width="20" alt="Deutsch">Deutsch</a></li>
                                <li><a class="dropdown-item" href="#"><img class="me-2" src="img/flags/it.png" width="20" alt="Italiano">Italiano</a></li>
                            </ul>
                            </div>
                        </div>
                        <div class="widget widget-links widget-light">
                            <ul class="widget-list d-flex flex-wrap justify-content-center justify-content-md-start">
                            <li class="widget-list-item me-4"><a class="widget-list-link" href="#">Outlets</a></li>
                            <li class="widget-list-item me-4"><a class="widget-list-link" href="#">Affiliates</a></li>
                            <li class="widget-list-item me-4"><a class="widget-list-link" href="#">Support</a></li>
                            <li class="widget-list-item me-4"><a class="widget-list-link" href="#">Privacy</a></li>
                            <li class="widget-list-item me-4"><a class="widget-list-link" href="#">Terms of use</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-6 text-center text-md-end mb-4">
                        <div class="mb-3">
                            <a class="btn-social bs-light bs-twitter ms-2 mb-2" href="#"><i class="ci-twitter"></i></a>
                            <a class="btn-social bs-light bs-facebook ms-2 mb-2" href="#"><i class="ci-facebook"></i></a>
                            <a class="btn-social bs-light bs-instagram ms-2 mb-2" href="#"><i class="ci-instagram"></i></a>
                            <a class="btn-social bs-light bs-pinterest ms-2 mb-2" href="#"><i class="ci-pinterest"></i></a>
                            <a class="btn-social bs-light bs-youtube ms-2 mb-2" href="#"><i class="ci-youtube"></i></a>
                        </div>
                        <img class="d-inline-block" src="img/cards-alt.png" width="187" alt="Payment methods">
                    </div>
                </div> --}}
                <div class="pb-4 fs-xs text-light opacity-50 text-center text-md-start">
                    © Todos los derechos reservados.
                    {{-- Made by
                    <a class="text-light" href="https://createx.studio/" target="_blank" rel="noopener" previewlistener="true">Createx Studio</a> --}}
                </div>
                </div>
            </div>
        </footer>
    </div>

    @yield('scripts')
</body>
</html>
