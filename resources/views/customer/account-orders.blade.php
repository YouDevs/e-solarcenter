@extends('layouts.base')

@section('content')
<!-- Page Title-->
<div class="page-title-overlap bg-dark pt-4">
    <div class="container d-lg-flex justify-content-between py-2 py-lg-3">
        {{-- <div class="order-lg-2 mb-3 mb-lg-0 pt-lg-2">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-light flex-lg-nowrap justify-content-center justify-content-lg-start">
                    <li class="breadcrumb-item">
                        <a class="text-nowrap" href="index.html">
                            <i class="bi bi-chevron-right"></i>
                            Inicio
                        </a>
                    </li>
                    <li class="breadcrumb-item text-nowrap">
                        <i class="bi bi-chevron-right"></i>
                        <a href="#">Cuenta</a>
                    </li>
                    <li class="breadcrumb-item text-nowrap active" aria-current="page">
                        <i class="bi bi-chevron-right"></i>
                        Historial de Ordenes
                    </li>
                </ol>
            </nav>
        </div> --}}
        <div class="order-lg-1 pe-lg-4 text-center text-lg-start">
            <h1 class="h3 text-light mb-0">Mis Ordenes</h1>
        </div>
    </div>
</div>

<div class="container pb-5 mb-2 mb-md-4">
    <div class="row">
        <!-- Sidebar-->
        <aside class="col-lg-4 pt-4 pt-lg-0 pe-xl-5">
            <div class="bg-white rounded-3 shadow-lg pt-1 mb-5 mb-lg-0">
                <div class="d-md-flex justify-content-between align-items-center text-center text-md-start p-4">
                <div class="d-md-flex align-items-center">
                    {{-- <div class="img-thumbnail rounded-circle position-relative flex-shrink-0 mx-auto mb-2 mx-md-0 mb-md-0" style="width: 6.375rem;">
                        <span class="badge bg-warning position-absolute end-0 mt-n2" data-bs-toggle="tooltip" data-bs-original-title="Reward points">384</span>
                        <img class="rounded-circle" src="img/shop/account/avatar.jpg" alt="Susan Gardner">
                    </div> --}}
                    <div class="ps-md-3">
                        <h3 class="fs-base mb-0">{{$customer->company_name}}</h3>
                        <span class="text-accent fs-sm">
                            {{$customer->user->name}}
                        </span>
                    </div>
                </div><a class="btn btn-primary d-lg-none mb-2 mt-3 mt-md-0" href="#account-menu" data-bs-toggle="collapse" aria-expanded="false"><i class="ci-menu me-2"></i>Account menu</a>
                </div>
                <div class="d-lg-block collapse" id="account-menu">
                <div class="bg-secondary px-4 py-3">
                    <h3 class="fs-sm mb-0 text-muted">Dashboard</h3>
                </div>
                <ul class="list-unstyled mb-0">
                    <li class="border-bottom mb-0">
                        <a class="nav-link-style d-flex align-items-center px-4 py-3" href="account-orders.html">
                            <i class="ci-bag opacity-60 me-2"></i> Mi Cuenta
                        </a>
                    </li>
                    <li class="border-bottom mb-0">
                        <a class="nav-link-style d-flex align-items-center px-4 py-3 active" href="account-orders.html">
                            <i class="ci-bag opacity-60 me-2"></i>Mis Ordenes
                            <span class="fs-sm text-muted ms-auto"> {{$orders->count()}} </span>
                        </a>
                    </li>
                    {{-- <li class="border-bottom mb-0">
                        <a class="nav-link-style d-flex align-items-center px-4 py-3" href="account-wishlist.html">
                            <i class="ci-heart opacity-60 me-2"></i>Wishlist<span class="fs-sm text-muted ms-auto">3</span>
                        </a>
                    </li> --}}
                    <li class="mb-0">
                        <a class="nav-link-style d-flex align-items-center px-4 py-3" href="{{route('account.contact')}}">
                            <i class="ci-help opacity-60 me-2"></i>Contacto
                            {{-- <span class="fs-sm text-muted ms-auto">1</span> --}}
                        </a>
                    </li>
                </ul>
                {{-- <div class="bg-secondary px-4 py-3">
                    <h3 class="fs-sm mb-0 text-muted">Configuración de Cuenta</h3>
                </div> --}}
                {{-- <ul class="list-unstyled mb-0"> --}}
                    {{-- <li class="border-bottom mb-0">
                        <a class="nav-link-style d-flex align-items-center px-4 py-3" href="account-profile.html">
                            <i class="ci-user opacity-60 me-2"></i>
                            Información de perfil
                        </a>
                    </li> --}}
                    {{-- <li class="border-bottom mb-0">
                        <a class="nav-link-style d-flex align-items-center px-4 py-3" href="account-address.html">
                            <i class="ci-location opacity-60 me-2"></i>
                            Direcciones
                        </a>
                    </li>
                    <li class="mb-0">
                        <a class="nav-link-style d-flex align-items-center px-4 py-3" href="account-payment.html">
                            <i class="ci-card opacity-60 me-2"></i>Métodos de pago
                        </a> --}}
                    </li>
                    {{-- <li class="d-lg-none border-top mb-0">
                        <a class="nav-link-style d-flex align-items-center px-4 py-3" href="account-signin.html">
                            <i class="ci-sign-out opacity-60 me-2"></i>
                            Cerrar Sesión
                        </a>
                    </li> --}}
                {{-- </ul> --}}
                </div>
            </div>
        </aside>
        <!-- Content  -->
        <section class="col-lg-8">
            <!-- Toolbar-->
            <div class="d-flex justify-content-between align-items-center pt-lg-2 pb-4 pb-lg-5 mb-lg-3">
                <div class="d-flex align-items-center">
                    <label class="d-none d-lg-block fs-sm text-light text-nowrap opacity-75 me-2" for="order-sort">Ordernar por:</label>
                    <label class="d-lg-none fs-sm text-nowrap opacity-75 me-2" for="order-sort">Ordenar por:</label>
                    <select class="form-select" id="order-sort">
                        <option>Todo</option>
                        <option>Enviado</option>
                        <option>En progreso</option>
                        <option>Demorado</option>
                        <option>Cancelado</option>
                    </select>
                </div>
                <a class="btn btn-primary btn-sm d-none d-lg-inline-block" href="account-signin.html">
                    <i class="ci-sign-out me-2"></i>Cerrar sesión
                </a>
            </div>
            <!-- Orders list-->
            <div class="table-responsive fs-md mb-4">
                <table class="table table-hover mb-0">
                <thead>
                    <tr>
                    <th>Folio #</th>
                    <th>Fecha de compra</th>
                    <th>Status Sistema</th>
                    <th>Status Envío</th>
                    <th>Total</th>
                    <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                    <tr>
                        <td class="py-3">
                            <a class="nav-link-style fw-medium fs-sm" href="#order-details" data-bs-toggle="modal">
                                {{$order->folio()}}
                            </a>
                        </td>
                        <td class="py-3">{{ $order->created_at->format('m/d/y H:i') }}</td>
                        <td class="py-3">
                            @if ($order->status == 'pending')
                                <span class="badge bg-info m-0">Pendiente</span>
                            @elseif($order->status == 'pending_payment')
                                <span class="badge bg-warning m-0">Pendiente de pago</span>
                            @elseif($order->status == 'approved')
                                <span class="badge bg-success m-0">Pago Aprobado</span>
                            @elseif($order->status == 'canceled')
                                <span class="badge bg-danger m-0">Cancelado</span>
                            @endif
                        </td>
                        <td class="py-3">
                            {{$order->translated_delivery_status}}
                        </td>
                        <td class="py-3">
                            <x-amount-formatter :amount="$order->total" />
                        </td>
                        <td>
                            <a href="/" class="btn btn-primary btn-sm">Ver orden</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                </table>
            </div>
            <!-- Pagination-->
            {{ $orders->links('vendor.pagination.bootstrap-5') }}

            {{-- <nav class="d-flex justify-content-between pt-2" aria-label="Page navigation">
                <ul class="pagination">
                    <li class="page-item">
                        <a class="page-link" href="#"><i class="ci-arrow-left me-2"></i>Atrás</a>
                    </li>
                </ul>
                <ul class="pagination">
                    <li class="page-item d-sm-none">
                        <span class="page-link page-link-static">1 / 5</span>
                    </li>
                    <li class="page-item active d-none d-sm-block" aria-current="page">
                        <span class="page-link">1<span class="visually-hidden">(current)</span></span>
                    </li>
                    <li class="page-item d-none d-sm-block">
                        <a class="page-link" href="#">2</a>
                    </li>
                    <li class="page-item d-none d-sm-block">
                        <a class="page-link" href="#">3</a>
                    </li>
                    <li class="page-item d-none d-sm-block">
                        <a class="page-link" href="#">4</a>
                    </li>
                    <li class="page-item d-none d-sm-block">
                        <a class="page-link" href="#">5</a>
                    </li>
                </ul>
                <ul class="pagination">
                    <li class="page-item"><a class="page-link" href="#" aria-label="Next">Siguiente<i class="ci-arrow-right ms-2"></i></a></li>
                </ul>
            </nav> --}}
        </section>
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
        timer: 3000,
    });
</script>
@endif

@endsection
