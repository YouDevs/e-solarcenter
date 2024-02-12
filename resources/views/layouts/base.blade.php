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
    {{-- <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet"> --}}

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    {{-- <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@300;400;500;900&display=swap" rel="stylesheet"> --}}
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.4/tiny-slider.css">

    <!-- Scripts -->
    @vite([
        'resources/sass/base.scss',
        'resources/js/app.js',
        'resources/js/theme.js',
    ])
    <style>
        .filter-products {
            position: relative; /* Hace que el posicionamiento absoluto del hijo se base en este contenedor */
        }
        #autocomplete-list {
            position: absolute;
            top: 100%; /* Sitúa el div justo debajo del input */
            left: 0;
            width: 100%; /* Iguala el ancho del input */
            z-index: 1000; /* Asegura que se muestre sobre otros elementos */
            background-color: white; /* O cualquier color de fondo que prefieras */
            border: 1px solid #ccc; /* Opcional: añade un borde */
            border-top: none; /* Elimina el borde superior para una transición suave desde el input */
        }

        .list-group-item {
            padding: 10px; /* Ajusta el padding según sea necesario */
            cursor: pointer; /* Indica que los elementos son clicable */
        }
        .list-group-item:hover {
            background-color: #f8f9fa; /* Cambia el color de fondo al pasar el ratón por encima para mejorar la interactividad */
        }
    </style>
</head>
<body class="bg-white">
    <div id="app" style="flex: 1 0 auto;">
        <header class="shadow-sm">
            @php
                $route_name = Route::currentRouteName();
            @endphp
            <!-- Topbar-->
            @if ($route_name != 'login')
            <!-- Remove "navbar-sticky" class to make navigation bar scrollable with the page.-->
            <div class="navbar-sticky bg-light">
                <div class="navbar navbar-expand-lg navbar-light">
                    <div class="container">
                        <a class="navbar-brand d-none d-sm-block me-3 flex-shrink-0" href="/">
                            <img src="{{asset('images/logo.webp')}}" width="142" alt="Solar Center">
                        </a>
                        <a class="navbar-brand d-sm-none me-2" href="/">
                            <img src="{{asset('images/logo.webp')}}" width="74" alt="Solar Center">
                        </a>
                        <!-- Search-->
                        <div class="input-group d-none d-lg-flex flex-nowrap mx-4" class="filter-products">
                            <i class="ci-search position-absolute top-50 start-0 translate-middle-y ms-3"></i>
                            <input class="form-control rounded-start w-100" type="text" id="search-products" placeholder="Buscar productos">
                            <div class="position-absolute" id="autocomplete-list" style="z-index: 1000; width: 100%;"></div>
                            <select class="form-select flex-shrink-0" id="category-id" name="category_id" style="width: 10.5rem;">
                                <option>Categorías</option>
                                @foreach ($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <!-- Toolbar-->
                        <div class="navbar-toolbar d-flex flex-shrink-0 align-items-center">
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <a class="navbar-tool navbar-stuck-toggler" href="#">
                                <span class="navbar-tool-tooltip">Toggle menu</span>
                                <div class="navbar-tool-icon-box">
                                    <i class="navbar-tool-icon ci-menu"></i>
                                </div>
                            </a>
                            <a class="navbar-tool ms-1 ms-lg-0 me-n1 me-lg-2" href="#signin-modal" data-bs-toggle="modal">
                                <div class="navbar-tool-icon-box">
                                    <i class="navbar-tool-icon ci-user"></i>
                                </div>
                                <div class="navbar-tool-text ms-n3">
                                    @if (Auth::check())
                                        <small>Hola</small>
                                        {{auth()->user()->name}}
                                    @endif
                                </div>
                            </a>
                            <div class="navbar-tool dropdown ms-3">
                                <a class="navbar-tool-icon-box bg-secondary dropdown-toggle" href="{{route('cart.list')}}">
                                    @if (Cart::getTotalQuantity() > 0)
                                        <span class="navbar-tool-label">{{ Cart::getTotalQuantity() }}</span>
                                    @endif
                                    <i class="navbar-tool-icon bi bi-cart3"></i>
                                </a>
                                <a class="navbar-tool-text" href="{{route('cart.list')}}">
                                    <small>Carrito</small>${{ Cart::getTotal() }}
                                </a>
                                <!-- Cart dropdown-->
                                @if (count( Cart::getContent() ))
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <div class="widget widget-cart px-3 pt-2 pb-3" style="width: 20rem;">
                                            <div style="height: 15rem;" data-simplebar data-simplebar-auto-hide="false">
                                                @foreach (Cart::getContent() as $item)
                                                    <div class="widget-cart-item pb-2 border-bottom">
                                                        <form action="{{route('cart.remove')}}" method="post">
                                                            @csrf
                                                            <input type="hidden" name="item_id" value="{{$item->id}}">
                                                            <button class="btn-close text-danger" type="submit" aria-label="Remove">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </form>
                                                        <div class="d-flex align-items-center">
                                                            <a class="d-block flex-shrink-0" href="shop-single-v2.html">
                                                                <img src="{{Storage::url($item->attributes->featured)}}" width="64" alt="Product">
                                                            </a>
                                                            <div class="ps-2">
                                                                <h6 class="widget-product-title">
                                                                    <a href="shop-single-v2.html">{{$item->name}}</a>
                                                                </h6>
                                                                <div class="widget-product-meta">
                                                                    <x-amount-formatter :amount="$item->price" />
                                                                    <span class="text-muted">x {{$item->quantity}}</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                            <div class="d-flex flex-wrap justify-content-between align-items-center py-3">
                                                <div class="fs-sm me-2 py-2">
                                                    <span class="text-muted">Subtotal:</span>
                                                    <span class="text-accent fs-base ms-1">
                                                        <x-amount-formatter :amount="Cart::getTotal()" />
                                                    </span>
                                                </div>
                                                <a class="btn btn-outline-secondary btn-sm" href="{{route('cart.list')}}">
                                                    Expandir carrito<i class="ci-arrow-right ms-1 me-n1"></i>
                                                </a>
                                            </div>
                                            <a class="btn btn-primary btn-sm d-block w-100" href="{{route('checkout.details')}}">
                                                <i class="ci-card me-2 fs-base align-middle"></i>
                                                Proceso de Compra
                                            </a>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="navbar navbar-expand-lg navbar-light navbar-stuck-menu mt-n2 pt-0 pb-2">
                    <div class="container">
                        <div class="collapse navbar-collapse" id="navbarCollapse">
                            <!-- Search-->
                            <div class="input-group d-lg-none my-3">
                                <i class="ci-search position-absolute top-50 start-0 translate-middle-y ms-3"></i>
                                <input class="form-control rounded-start" type="text" placeholder="Search for products">
                            </div>
                            <!-- Departments menu-->
                            @role('operator')
                                <ul class="navbar-nav navbar-mega-nav pe-lg-2 me-lg-2">
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle ps-lg-0" href="#" data-bs-toggle="dropdown" data-bs-auto-close="outside">
                                            <i class="ci-menu align-middle mt-n1 me-2"></i>
                                            Admin
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li class="dropdown mega-dropdown">
                                                {{-- <a class="dropdown-item dropdown-toggle" href="#" data-bs-toggle="dropdown"> --}}
                                                <a class="dropdown-item" href="{{route('admin.orders.index')}}">
                                                    <i class="ci-laptop opacity-60 fs-lg mt-n1 me-2"></i>
                                                    Ordenes
                                                </a>
                                                {{-- <div class="dropdown-menu p-0">
                                                    <div class="d-flex flex-wrap flex-sm-nowrap px-2">
                                                        <div class="mega-dropdown-column pt-4 pb-0 py-sm-4 px-3">
                                                            <div class="widget widget-links">
                                                                <h6 class="fs-base mb-3">Computers</h6>
                                                                <ul class="widget-list">
                                                                    <li class="widget-list-item pb-1">
                                                                        <a class="widget-list-link" href="#">Laptops &amp;Tablets</a>
                                                                    </li>
                                                                    <li class="widget-list-item pb-1">
                                                                        <a class="widget-list-link" href="#">Desktop Computers</a>
                                                                    </li>
                                                                    <li class="widget-list-item pb-1">
                                                                        <a class="widget-list-link" href="#">Computer External Components</a>
                                                                    </li>
                                                                    <li class="widget-list-item pb-1">
                                                                        <a class="widget-list-link" href="#">Computer Internal Components</a>
                                                                    </li>
                                                                    <li class="widget-list-item pb-1">
                                                                        <a class="widget-list-link" href="#">Networking Products (NAS)</a>
                                                                    </li>
                                                                    <li class="widget-list-item pb-1">
                                                                        <a class="widget-list-link" href="#">Single Board Computers</a>
                                                                    </li>
                                                                    <li class="widget-list-item pb-1">
                                                                        <a class="widget-list-link" href="#">Desktop Barebones</a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <div class="mega-dropdown-column py-4 px-3">
                                                            <div class="widget widget-links">
                                                                <h6 class="fs-base mb-3">Accessories</h6>
                                                                <ul class="widget-list">
                                                                    <li class="widget-list-item pb-1">
                                                                        <a class="widget-list-link" href="#">Monitors</a>
                                                                    </li>
                                                                    <li class="widget-list-item pb-1">
                                                                        <a class="widget-list-link" href="#">Bags, Cases &amp;Sleeves</a>
                                                                    </li>
                                                                    <li class="widget-list-item pb-1">
                                                                        <a class="widget-list-link" href="#">Batteries</a>
                                                                    </li>
                                                                    <li class="widget-list-item pb-1">
                                                                        <a class="widget-list-link" href="#">Charges &amp;Adapters</a>
                                                                    </li>
                                                                    <li class="widget-list-item pb-1">
                                                                        <a class="widget-list-link" href="#">Cooling Pads</a>
                                                                    </li>
                                                                    <li class="widget-list-item pb-1">
                                                                        <a class="widget-list-link" href="#">Mounts</a>
                                                                    </li>
                                                                    <li class="widget-list-item pb-1">
                                                                        <a class="widget-list-link" href="#">Replacement Screens</a>
                                                                    </li>
                                                                    <li class="widget-list-item pb-1">
                                                                        <a class="widget-list-link" href="#">Security Locks</a>
                                                                    </li>
                                                                    <li class="widget-list-item pb-1">
                                                                        <a class="widget-list-link" href="#">Stands</a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <div class="mega-dropdown-column d-none d-lg-block py-4 text-center">
                                                            <a class="d-block mb-2" href="#">
                                                                <img src="img/shop/departments/07.jpg" alt="Computers &amp; Accessories">
                                                            </a>
                                                            <div class="fs-sm mb-3">
                                                                Starting from 
                                                                <span class='fw-medium'>
                                                                    $149.<small>80</small>
                                                                </span>
                                                            </div>
                                                            <a class="btn btn-primary btn-shadow btn-sm" href="#">
                                                                See offers<i class="ci-arrow-right fs-xs ms-1"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div> --}}
                                            </li>
                                            <li class="dropdown mega-dropdown">
                                                <a class="dropdown-item" href="{{route('admin.customers.index')}}">
                                                    <i class="ci-laptop opacity-60 fs-lg mt-n1 me-2"></i>
                                                    Clientes
                                                </a>
                                            </li>
                                            <li class="dropdown mega-dropdown">
                                                <a class="dropdown-item" href="{{route('admin.products.index')}}">
                                                    <i class="ci-monitor opacity-60 fs-lg mt-n1 me-2"></i>
                                                    Productos
                                                </a>
                                            </li>
                                            <li class="dropdown mega-dropdown">
                                                <a class="dropdown-item" href="">
                                                    <i class="ci-monitor opacity-60 fs-lg mt-n1 me-2"></i>
                                                    Usuarios
                                                </a>
                                            </li>
                                            <li class="dropdown mega-dropdown">
                                                <a class="dropdown-item" href="">
                                                    <i class="ci-monitor opacity-60 fs-lg mt-n1 me-2"></i>
                                                    Dashboard
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            @endrole

                            @if(Auth::check() && Auth::user()->hasRole('customer') )
                                <ul class="navbar-nav navbar-mega-nav pe-lg-2 me-lg-2">
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle ps-lg-0" href="#" data-bs-toggle="dropdown" data-bs-auto-close="outside">
                                            <i class="ci-menu align-middle mt-n1 me-2"></i>
                                            Mi cuenta
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li class="dropdown mega-dropdown">
                                                {{-- <a class="dropdown-item dropdown-toggle" href="#" data-bs-toggle="dropdown"> --}}
                                                <a class="dropdown-item" href="{{route('account.profile')}}">
                                                    <div class="d-flex">
                                                        <div class="lead text-muted pt-1"><i class="ci-book"></i></div>
                                                        <div class="ms-2">
                                                            <span class="d-block text-heading">Perfil de usuario</span>
                                                            <small class="d-block text-muted">Mis datos y preferencias</small>
                                                        </div>
                                                    </div>
                                                </a>
                                                {{-- <div class="dropdown-menu p-0">
                                                    <div class="d-flex flex-wrap flex-sm-nowrap px-2">
                                                        <div class="mega-dropdown-column pt-4 pb-0 py-sm-4 px-3">
                                                            <div class="widget widget-links">
                                                                <h6 class="fs-base mb-3">Computers</h6>
                                                                <ul class="widget-list">
                                                                    <li class="widget-list-item pb-1">
                                                                        <a class="widget-list-link" href="#">Laptops &amp;Tablets</a>
                                                                    </li>
                                                                    <li class="widget-list-item pb-1">
                                                                        <a class="widget-list-link" href="#">Desktop Computers</a>
                                                                    </li>
                                                                    <li class="widget-list-item pb-1">
                                                                        <a class="widget-list-link" href="#">Computer External Components</a>
                                                                    </li>
                                                                    <li class="widget-list-item pb-1">
                                                                        <a class="widget-list-link" href="#">Computer Internal Components</a>
                                                                    </li>
                                                                    <li class="widget-list-item pb-1">
                                                                        <a class="widget-list-link" href="#">Networking Products (NAS)</a>
                                                                    </li>
                                                                    <li class="widget-list-item pb-1">
                                                                        <a class="widget-list-link" href="#">Single Board Computers</a>
                                                                    </li>
                                                                    <li class="widget-list-item pb-1">
                                                                        <a class="widget-list-link" href="#">Desktop Barebones</a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <div class="mega-dropdown-column py-4 px-3">
                                                            <div class="widget widget-links">
                                                                <h6 class="fs-base mb-3">Accessories</h6>
                                                                <ul class="widget-list">
                                                                    <li class="widget-list-item pb-1">
                                                                        <a class="widget-list-link" href="#">Monitors</a>
                                                                    </li>
                                                                    <li class="widget-list-item pb-1">
                                                                        <a class="widget-list-link" href="#">Bags, Cases &amp;Sleeves</a>
                                                                    </li>
                                                                    <li class="widget-list-item pb-1">
                                                                        <a class="widget-list-link" href="#">Batteries</a>
                                                                    </li>
                                                                    <li class="widget-list-item pb-1">
                                                                        <a class="widget-list-link" href="#">Charges &amp;Adapters</a>
                                                                    </li>
                                                                    <li class="widget-list-item pb-1">
                                                                        <a class="widget-list-link" href="#">Cooling Pads</a>
                                                                    </li>
                                                                    <li class="widget-list-item pb-1">
                                                                        <a class="widget-list-link" href="#">Mounts</a>
                                                                    </li>
                                                                    <li class="widget-list-item pb-1">
                                                                        <a class="widget-list-link" href="#">Replacement Screens</a>
                                                                    </li>
                                                                    <li class="widget-list-item pb-1">
                                                                        <a class="widget-list-link" href="#">Security Locks</a>
                                                                    </li>
                                                                    <li class="widget-list-item pb-1">
                                                                        <a class="widget-list-link" href="#">Stands</a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <div class="mega-dropdown-column d-none d-lg-block py-4 text-center">
                                                            <a class="d-block mb-2" href="#">
                                                                <img src="img/shop/departments/07.jpg" alt="Computers &amp; Accessories">
                                                            </a>
                                                            <div class="fs-sm mb-3">
                                                                Starting from 
                                                                <span class='fw-medium'>
                                                                    $149.<small>80</small>
                                                                </span>
                                                            </div>
                                                            <a class="btn btn-primary btn-shadow btn-sm" href="#">
                                                                See offers<i class="ci-arrow-right fs-xs ms-1"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div> --}}
                                            </li>
                                            <li class="dropdown mega-dropdown">
                                                <a class="dropdown-item" href="{{route('account.orders')}}">
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
                                            <li class="dropdown mega-dropdown">
                                                <a class="dropdown-item" href="{{route('admin.products.index')}}">
                                                    <div class="d-flex">
                                                        <div class="lead text-muted pt-1"><i class="ci-help"></i></div>
                                                        <div class="ms-2">
                                                            <span class="d-block text-heading">Contacto</span>
                                                            <small class="d-block text-muted">Formulario de contacto</small>
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            @endif
                            <!-- Primary menu-->
                            <ul class="navbar-nav">
                                <li class="nav-item dropdown active">
                                    {{-- <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Home</a> --}}
                                    <a   class="nav-link" href="/">Inicio</a>
                                    {{-- <ul class="dropdown-menu">
                                        <li class="dropdown position-static mb-0">
                                            <a class="dropdown-item border-bottom py-2" href="home-nft.html">
                                                <span class="d-block text-heading">
                                                    NFT Marketplace<span class="badge bg-danger ms-1">NEW</span>
                                                </span>
                                                <small class="d-block text-muted">NFTs, Multi-vendor, Auctions</small>
                                            </a>
                                            <div class="dropdown-menu h-100 animation-none mt-0 p-3">
                                                <a class="d-block" href="home-nft.html" style="width: 250px;">
                                                    <img src="img/home/preview/th08.jpg" alt="NFT Marketplace">
                                                </a>
                                            </div>
                                        </li>
                                        <li class="dropdown position-static mb-0">
                                            <a class="dropdown-item py-2 border-bottom" href="home-fashion-store-v1.html">
                                                <span class="d-block text-heading">Fashion Store v.1</span>
                                                <small class="d-block text-muted">Classic shop layout</small>
                                            </a>
                                            <div class="dropdown-menu h-100 animation-none mt-0 p-3">
                                                <a class="d-block" href="home-fashion-store-v1.html" style="width: 250px;">
                                                    <img src="img/home/preview/th01.jpg" alt="Fashion Store v.1">
                                                </a>
                                            </div>
                                        </li>
                                        <li class="dropdown position-static mb-0">
                                            <a class="dropdown-item py-2 border-bottom" href="home-electronics-store.html">
                                                <span class="d-block text-heading">Electronics Store</span>
                                                <small class="d-block text-muted">Slider + Promo banners</small>
                                            </a>
                                            <div class="dropdown-menu h-100 animation-none mt-0 p-3">
                                                <a class="d-block" href="home-electronics-store.html" style="width: 250px;">
                                                    <img src="img/home/preview/th03.jpg" alt="Electronics Store">
                                                </a>
                                            </div>
                                        </li>
                                        <li class="dropdown position-static mb-0">
                                            <a class="dropdown-item py-2 border-bottom" href="home-marketplace.html">
                                                <span class="d-block text-heading">Marketplace</span>
                                                <small class="d-block text-muted">Multi-vendor, digital goods</small>
                                            </a>
                                            <div class="dropdown-menu h-100 animation-none mt-0 p-3">
                                                <a class="d-block" href="home-marketplace.html" style="width: 250px;">
                                                    <img src="img/home/preview/th04.jpg" alt="Marketplace">
                                                </a>
                                            </div>
                                        </li>
                                        <li class="dropdown position-static mb-0">
                                            <a class="dropdown-item py-2 border-bottom" href="home-grocery-store.html">
                                                <span class="d-block text-heading">Grocery Store</span>
                                                <small class="d-block text-muted">Full width + Side menu</small>
                                            </a>
                                            <div class="dropdown-menu h-100 animation-none mt-0 p-3">
                                                <a class="d-block" href="home-grocery-store.html" style="width: 250px;">
                                                    <img src="img/home/preview/th06.jpg" alt="Grocery Store">
                                                </a>
                                            </div>
                                        </li>
                                        <li class="dropdown position-static mb-0">
                                            <a class="dropdown-item py-2 border-bottom" href="home-food-delivery.html">
                                                <span class="d-block text-heading">Food Delivery Service</span>
                                                <small class="d-block text-muted">Food &amp;Beverages delivery</small>
                                            </a>
                                            <div class="dropdown-menu h-100 animation-none mt-0 p-3">
                                                <a class="d-block" href="home-food-delivery.html" style="width: 250px;">
                                                    <img src="img/home/preview/th07.jpg" alt="Food Delivery Service">
                                                </a>
                                            </div>
                                        </li>
                                        <li class="dropdown position-static mb-0">
                                            <a class="dropdown-item py-2 border-bottom" href="home-fashion-store-v2.html">
                                                <span class="d-block text-heading">Fashion Store v.2</span>
                                                <small class="d-block text-muted">Slider + Featured categories</small>
                                            </a>
                                            <div class="dropdown-menu h-100 animation-none mt-0 p-3">
                                                <a class="d-block" href="home-fashion-store-v2.html" style="width: 250px;">
                                                    <img src="img/home/preview/th02.jpg" alt="Fashion Store v.2">
                                                </a>
                                            </div>
                                        </li>
                                        <li class="dropdown position-static mb-0">
                                            <a class="dropdown-item py-2" href="home-single-store.html">
                                                <span class="d-block text-heading">Single Product Store</span>
                                                <small class="d-block text-muted">Single product / mono brand</small>
                                            </a>
                                            <div class="dropdown-menu h-100 animation-none mt-0 p-3">
                                                <a class="d-block" href="home-single-store.html" style="width: 250px;">
                                                    <img src="img/home/preview/th05.jpg" alt="Single Product / Brand Store">
                                                </a>
                                            </div>
                                        </li>
                                    </ul> --}}
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Conócenos</a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a class="dropdown-item" href="docs/dev-setup.html">
                                                <div class="d-flex">
                                                    <div class="lead text-muted pt-1">
                                                        <i class="ci-book"></i>
                                                    </div>
                                                    <div class="ms-2">
                                                        <span class="d-block text-heading">Nosotros</span>
                                                        <small class="d-block text-muted">Nuestra cultura</small>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <li class="dropdown-divider"></li>
                                        <li>
                                            <a class="dropdown-item" href="components/typography.html">
                                                <div class="d-flex">
                                                    <div class="lead text-muted pt-1">
                                                        <i class="ci-server"></i>
                                                    </div>
                                                    <div class="ms-2">
                                                        <span class="d-block text-heading">
                                                            Sucursales
                                                        </span>
                                                        <small class="d-block text-muted">Centros de distribución</small>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <li class="dropdown-divider"></li>
                                        <li>
                                            <a class="dropdown-item" href="docs/changelog.html">
                                                <div class="d-flex">
                                                    <div class="lead text-muted pt-1">
                                                        <i class="ci-edit"></i>
                                                    </div>
                                                    <div class="ms-2">
                                                        <span class="d-block text-heading">
                                                            Contacto
                                                        </span>
                                                        <small class="d-block text-muted">Atención a clientes</small>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <li class="dropdown-divider"></li>
                                        <li>
                                            <a class="dropdown-item" href="mailto:support@createx.studio">
                                                <div class="d-flex">
                                                    <div class="lead text-muted pt-1">
                                                        <i class="ci-help"></i>
                                                    </div>
                                                    <div class="ms-2">
                                                        <span class="d-block text-heading">Bolsa de trabajo</span>
                                                        <small class="d-block text-muted">Transforma a México</small>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Servicios</a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a class="dropdown-item" href="docs/dev-setup.html">
                                                <div class="d-flex">
                                                    <div class="lead text-muted pt-1">
                                                        <i class="ci-book"></i>
                                                    </div>
                                                    <div class="ms-2">
                                                        <span class="d-block text-heading">Servicios Fundamentales</span>
                                                        <small class="d-block text-muted">Crecemos juntos</small>
                                                        {{-- <small class="d-block text-muted">Transformemos Juntos</small> --}}
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <li class="dropdown-divider"></li>
                                        <li>
                                            <a class="dropdown-item" href="components/typography.html">
                                                <div class="d-flex">
                                                    <div class="lead text-muted pt-1">
                                                        <i class="ci-server"></i>
                                                    </div>
                                                    <div class="ms-2">
                                                        <span class="d-block text-heading">
                                                            Oferta especializada
                                                        </span>
                                                        <small class="d-block text-muted">Programas y Herramientas</small>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#">Blog</a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#">Integradores</a>
                                </li>
                                {{-- <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Solar Center</a>
                                    <div class="dropdown-menu p-0">
                                        <div class="d-flex flex-wrap flex-sm-nowrap px-2">
                                            <div class="mega-dropdown-column pt-1 pt-lg-4 pb-4 px-2 px-lg-3">
                                                <div class="widget widget-links mb-4">
                                                    <h6 class="fs-base mb-3">Conócenos</h6>
                                                    <ul class="widget-list">
                                                        <li class="widget-list-item">
                                                            <a class="widget-list-link" href="shop-grid-ls.html">Shop Grid - Left Sidebar</a>
                                                        </li>
                                                        <li class="widget-list-item">
                                                            <a class="widget-list-link" href="shop-grid-rs.html">Shop Grid - Right Sidebar</a>
                                                        </li>
                                                        <li class="widget-list-item">
                                                            <a class="widget-list-link" href="shop-grid-ft.html">Shop Grid - Filters on Top</a>
                                                        </li>
                                                        <li class="widget-list-item">
                                                            <a class="widget-list-link" href="shop-list-ls.html">Shop List - Left Sidebar</a>
                                                        </li>
                                                        <li class="widget-list-item">
                                                            <a class="widget-list-link" href="shop-list-rs.html">Shop List - Right Sidebar</a>
                                                        </li>
                                                        <li class="widget-list-item">
                                                            <a class="widget-list-link" href="shop-list-ft.html">Shop List - Filters on Top</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="widget widget-links mb-4">
                                                    <h6 class="fs-base mb-3">Marketplace</h6>
                                                    <ul class="widget-list">
                                                        <li class="widget-list-item">
                                                            <a class="widget-list-link" href="marketplace-category.html">Category Page</a>
                                                        </li>
                                                        <li class="widget-list-item">
                                                            <a class="widget-list-link" href="marketplace-single.html">Single Item Page</a>
                                                        </li>
                                                        <li class="widget-list-item">
                                                            <a class="widget-list-link" href="marketplace-vendor.html">Vendor Page</a>
                                                        </li>
                                                        <li class="widget-list-item">
                                                            <a class="widget-list-link" href="marketplace-cart.html">Cart</a>
                                                        </li>
                                                        <li class="widget-list-item">
                                                            <a class="widget-list-link" href="marketplace-checkout.html">Checkout</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="widget widget-links">
                                                    <h6 class="fs-base mb-3">Grocery store</h6>
                                                    <ul class="widget-list">
                                                        <li class="widget-list-item">
                                                            <a class="widget-list-link" href="grocery-catalog.html">Product Catalog</a>
                                                        </li>
                                                        <li class="widget-list-item">
                                                            <a class="widget-list-link" href="grocery-single.html">Single Product Page</a>
                                                        </li>
                                                        <li class="widget-list-item">
                                                            <a class="widget-list-link" href="grocery-checkout.html">Checkout</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="mega-dropdown-column pt-1 pt-lg-4 pb-4 px-2 px-lg-3">
                                                <div class="widget widget-links mb-4">
                                                    <h6 class="fs-base mb-3">Food Delivery</h6>
                                                    <ul class="widget-list">
                                                        <li class="widget-list-item">
                                                            <a class="widget-list-link" href="food-delivery-category.html">Category Page</a>
                                                        </li>
                                                        <li class="widget-list-item">
                                                            <a class="widget-list-link" href="food-delivery-single.html">Single Item (Restaurant)</a>
                                                        </li>
                                                        <li class="widget-list-item">
                                                            <a class="widget-list-link" href="food-delivery-cart.html">Cart (Your Order)</a>
                                                        </li>
                                                        <li class="widget-list-item">
                                                            <a class="widget-list-link" href="food-delivery-checkout.html">Checkout (Address &amp;Payment)</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="widget widget-links">
                                                    <h6 class="fs-base mb-3">
                                                        NFT Marketplace<span class="badge bg-danger ms-1">NEW</span>
                                                    </h6>
                                                    <ul class="widget-list">
                                                        <li class="widget-list-item">
                                                            <a class="widget-list-link" href="nft-catalog-v1.html">Catalog v.1</a>
                                                        </li>
                                                        <li class="widget-list-item">
                                                            <a class="widget-list-link" href="nft-catalog-v2.html">Catalog v.2</a>
                                                        </li>
                                                        <li class="widget-list-item">
                                                            <a class="widget-list-link" href="nft-single-auction-live.html">Single Item - Auction Live</a>
                                                        </li>
                                                        <li class="widget-list-item">
                                                            <a class="widget-list-link" href="nft-single-auction-ended.html">Single Item - Auction Ended</a>
                                                        </li>
                                                        <li class="widget-list-item">
                                                            <a class="widget-list-link" href="nft-single-buy.html">Single Item - Buy Now</a>
                                                        </li>
                                                        <li class="widget-list-item">
                                                            <a class="widget-list-link" href="nft-vendor.html">Vendor Page</a>
                                                        </li>
                                                        <li class="widget-list-item">
                                                            <a class="widget-list-link" href="nft-connect-wallet.html">Connect Wallet</a>
                                                        </li>
                                                        <li class="widget-list-item">
                                                            <a class="widget-list-link" href="nft-create-item.html">Create New Item</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="mega-dropdown-column pt-1 pt-lg-4 px-2 px-lg-3">
                                                <div class="widget widget-links mb-4">
                                                    <h6 class="fs-base mb-3">Shop pages</h6>
                                                    <ul class="widget-list">
                                                        <li class="widget-list-item">
                                                            <a class="widget-list-link" href="shop-categories.html">Shop Categories</a>
                                                        </li>
                                                        <li class="widget-list-item">
                                                            <a class="widget-list-link" href="shop-single-v1.html">Product Page v.1</a>
                                                        </li>
                                                        <li class="widget-list-item">
                                                            <a class="widget-list-link" href="shop-single-v2.html">Product Page v.2</a>
                                                        </li>
                                                        <li class="widget-list-item">
                                                            <a class="widget-list-link" href="shop-cart.html">Cart</a>
                                                        </li>
                                                        <li class="widget-list-item">
                                                            <a class="widget-list-link" href="checkout-details.html">Checkout - Details</a>
                                                        </li>
                                                        <li class="widget-list-item">
                                                            <a class="widget-list-link" href="checkout-shipping.html">Checkout - Shipping</a>
                                                        </li>
                                                        <li class="widget-list-item">
                                                            <a class="widget-list-link" href="checkout-payment.html">Checkout - Payment</a>
                                                        </li>
                                                        <li class="widget-list-item">
                                                            <a class="widget-list-link" href="checkout-review.html">Checkout - Review</a>
                                                        </li>
                                                        <li class="widget-list-item">
                                                            <a class="widget-list-link" href="checkout-complete.html">Checkout - Complete</a>
                                                        </li>
                                                        <li class="widget-list-item">
                                                            <a class="widget-list-link" href="order-tracking.html">Order Tracking</a>
                                                        </li>
                                                        <li class="widget-list-item">
                                                            <a class="widget-list-link" href="comparison.html">Product Comparison</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" data-bs-auto-close="outside">Account</a>
                                    <ul class="dropdown-menu">
                                        <li class="dropdown">
                                            <a class="dropdown-item dropdown-toggle" href="#" data-bs-toggle="dropdown">Shop User Account</a>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a class="dropdown-item" href="account-orders.html">Orders History</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="account-profile.html">Profile Settings</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="account-address.html">Account Addresses</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="account-payment.html">Payment Methods</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="account-wishlist.html">Wishlist</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="account-tickets.html">My Tickets</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="account-single-ticket.html">Single Ticket</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="dropdown">
                                            <a class="dropdown-item dropdown-toggle" href="#" data-bs-toggle="dropdown">Vendor Dashboard</a>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a class="dropdown-item" href="dashboard-settings.html">Settings</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="dashboard-purchases.html">Purchases</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="dashboard-favorites.html">Favorites</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="dashboard-sales.html">Sales</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="dashboard-products.html">Products</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="dashboard-add-new-product.html">Add New Product</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="dashboard-payouts.html">Payouts</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="dropdown">
                                            <a class="dropdown-item dropdown-toggle" href="#" data-bs-toggle="dropdown">
                                                NFT Marketplace<span class="badge bg-danger ms-1">NEW</span>
                                            </a>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a class="dropdown-item" href="nft-account-settings.html">Profile Settings</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="nft-account-payouts.html">Wallet &amp;Payouts</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="nft-account-my-items.html">My Items</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="nft-account-my-collections.html">My Collections</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="nft-account-favorites.html">Favorites</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="nft-account-notifications.html">Notifications</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="account-signin.html">Sign In / Sign Up</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="account-password-recovery.html">Password Recovery</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" data-bs-auto-close="outside">Pages</a>
                                    <ul class="dropdown-menu">
                                        <li class="dropdown">
                                            <a class="dropdown-item dropdown-toggle" href="#" data-bs-toggle="dropdown">Navbar Variants</a>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a class="dropdown-item" href="navbar-1-level-light.html">1 Level Light</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="navbar-1-level-dark.html">1 Level Dark</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="navbar-2-level-light.html">2 Level Light</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="navbar-2-level-dark.html">2 Level Dark</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="navbar-3-level-light.html">3 Level Light</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="navbar-3-level-dark.html">3 Level Dark</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="home-electronics-store.html">Electronics Store</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="home-marketplace.html">Marketplace</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="home-grocery-store.html">Side Menu (Grocery)</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="dropdown-divider"></li>
                                        <li>
                                            <a class="dropdown-item" href="about.html">About Us</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="contacts.html">Contacts</a>
                                        </li>
                                        <li class="dropdown">
                                            <a class="dropdown-item dropdown-toggle" href="#" data-bs-toggle="dropdown">Help Center</a>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a class="dropdown-item" href="help-topics.html">Help Topics</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="help-single-topic.html">Single Topic</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="help-submit-request.html">Submit a Request</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="dropdown">
                                            <a class="dropdown-item dropdown-toggle" href="#" data-bs-toggle="dropdown">404 Not Found</a>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a class="dropdown-item" href="404-simple.html">404 - Simple Text</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="404-illustration.html">404 - Illustration</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="dropdown-divider"></li>
                                        <li>
                                            <a class="dropdown-item" href="sticky-footer.html">Sticky Footer Demo</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" data-bs-auto-close="outside">Blog</a>
                                    <ul class="dropdown-menu">
                                        <li class="dropdown">
                                            <a class="dropdown-item dropdown-toggle" href="#" data-bs-toggle="dropdown">Blog List Layouts</a>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a class="dropdown-item" href="blog-list-sidebar.html">List with Sidebar</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="blog-list.html">List no Sidebar</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="dropdown">
                                            <a class="dropdown-item dropdown-toggle" href="#" data-bs-toggle="dropdown">Blog Grid Layouts</a>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a class="dropdown-item" href="blog-grid-sidebar.html">Grid with Sidebar</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="blog-grid.html">Grid no Sidebar</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="dropdown">
                                            <a class="dropdown-item dropdown-toggle" href="#" data-bs-toggle="dropdown">Single Post Layouts</a>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a class="dropdown-item" href="blog-single-sidebar.html">Article with Sidebar</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="blog-single.html">Article no Sidebar</a>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li> --}}
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </header>

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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.2/min/tiny-slider.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Filter by Product:
            document.getElementById('search-products').addEventListener('input', (e) => {
                const searchTerm = e.target.value

                if (searchTerm.length) {
                    fetch(`/buscar-productos?search_term=${searchTerm}`)
                    .then(response => response.json())
                    .then(data => {
                        const autocompleteList = document.getElementById('autocomplete-list');
                        // Asegura que la lista esté vacía antes de agregar nuevos resultados
                        autocompleteList.innerHTML = '';
                        autocompleteList.classList.remove('invisible');

                        // Asegúrate de que data.products exista y tenga elementos
                        if (data.products && data.products.length > 0) {
                            const list = document.createElement('ul');
                            list.classList.add('list-group');
                            data.products.forEach(product => {
                                const item = document.createElement('li');
                                item.classList.add('list-group-item');
                                item.textContent = `${product.name} - ${product.brand}`;
                                item.style.cursor = 'pointer';

                                // Evento click para cada ítem
                                item.addEventListener('click', () => {
                                    // Redirigir al usuario. Modifica según la lógica de tu aplicación.
                                    window.location.href = `/producto/${product.id}`;
                                });

                                list.appendChild(item);
                            });

                            autocompleteList.appendChild(list);
                        } else {
                            autocompleteList.classList.add('invisible');
                        }
                    })
                    .catch(error => console.error('Error:', error));
                } else {
                    document.getElementById('autocomplete-list').classList.add('invisible');
                }
            })

            // Selecciona el elemento <select> por su ID
            const categorySelect = document.getElementById('category-id');
            // Escucha el evento 'change'
            categorySelect.addEventListener('change', function() {
                // Obtiene el valor del <option> seleccionado
                const categoryId = this.value;

                // Verifica si el valor es válido (por ejemplo, que no sea el placeholder de "Categorías")
                if(categoryId) {
                    // Construye la URL y redirige al usuario
                    window.location.href = `/productos/${categoryId}`;
                }
            });

            // Tiny Slider:
            var slider = tns({
                container: '.tns-carousel-inner',
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

        })
    </script>
    @yield('scripts')
</body>
</html>
