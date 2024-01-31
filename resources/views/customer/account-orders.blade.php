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
        <aside class="col-lg-3 pt-4 pt-lg-0 pe-xl-5">
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
                </div><a class="btn btn-primary d-lg-none mb-2 mt-3 mt-md-0" href="#account-menu" data-bs-toggle="collapse" aria-expanded="false"><i class="ci-menu me-2"></i>Menú</a>
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
        <section class="col-lg-9">
            <!-- Toolbar-->
            <div class="d-flex flex-wrap justify-content-between align-items-center pt-lg-2 pb-4 pb-lg-5 mb-lg-3">
                <form action="{{route('account.orders')}}" method="get" class="w-100">
                    <div class="row">
                        <div class="col-12 col-md-4 mb-3">
                            <label class="fs-sm text-light text-nowrap opacity-75 me-2" for="status">Status de pago:</label>
                            <select class="form-select" name="status" id="status">
                                <option value=""> Elige una opción </option>
                                <option value="payment_submitted" @selected($status == 'payment_submitted')>Pendiente de aprobación</option>
                                <option value="pending_payment" @selected($status == 'pending_payment')>Pago pendiente</option>
                                <option value="approved" @selected($status == 'approved')>Aprobado</option>
                                <option value="cancelled" @selected($status == 'cancelled')>Cancelado</option>
                            </select>
                        </div>
                        <div class="col-12 col-md-4 mb-3">
                            <label class="fs-sm text-light text-nowrap opacity-75 me-2" for="delivery-status">Status de envío:</label>
                            <select class="form-select" name="delivery_status" id="delivery-status">
                                <option value=""> Elige una opción </option>
                                <option value="InTransit" @selected($delivery_status == 'InTransit')>En tránsito</option>
                                <option value="Delivered" @selected($delivery_status == 'Delivered')>Entregado</option>
                            </select>
                        </div>
                        <div class="col-12 col-md-4 mb-3">
                            <label class="fs-sm text-light text-nowrap opacity-75 me-2" for="delivery-status">Fecha:</label>
                            <input type="date" class="form-control" name="created_at" id="created-at" value="{{$created_at}}">
                        </div>
                    </div>
                </form>

                {{-- <a class="btn btn-primary btn-sm d-none d-lg-inline-block" href="account-signin.html">
                    <i class="ci-sign-out me-2"></i>Cerrar sesión
                </a> --}}
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
                            @if ($order->status == 'payment_submitted')
                                <span class="badge rounded-pill text-bg-warning">
                                    {{ ucfirst("Pendiente de Aprobación") }}
                                </span>
                            @elseif($order->status == 'pending_payment')
                                <span class="badge rounded-pill text-bg-info">
                                    {{ ucfirst("Pendiente de Pago") }}
                                </span>
                            @elseif($order->status == 'approved')
                                <span class="badge rounded-pill text-bg-success">
                                    {{ ucfirst("Pago Aprobado") }}
                                </span>
                            @else
                                <span class="badge rounded-pill text-bg-success">
                                    {{ ucfirst("Cancelada") }}
                                </span>
                            @endif
                        </td>
                        <td class="py-3">
                            <x-order-delivery-status :status="$order->translated_delivery_status" />
                        </td>
                        <td class="py-3">
                            <x-amount-formatter :amount="$order->total" />
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <a class="btn btn-info btn-sm me-2" href="#order-details-{{$order->id}}" data-bs-toggle="modal">
                                    <i class="bi bi-eye"></i>
                                </a>
                                @if ($order->status == 'pending_payment' || $order->delivery_status == 'delivered' )
                                    <form
                                        action="{{route('account.orders.delete', $order)}}"
                                        method="POST"
                                        class="inline"
                                    >
                                        @method('DELETE')
                                        @csrf
                                        <button type="button" onclick="confirmDelete(this)" class="btn btn-danger btn-sm me-2">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                @endif

                                @if ($order->status == 'pending_payment')
                                    <form action="{{ route('checkout.update', $order->id) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="payment_submitted" value="1" >
                                        <input type="hidden" name="payment_concept" value="{{$order->payment_concept}}" >
                                        <button type="button" onclick="confirmPaymentSubmitted(this, '{{$order->payment_concept}}')" class="btn btn-primary btn-sm">
                                            <span class="d-none d-sm-inline">Ya Realicé Mi Pago</span>
                                            <span class="d-inline d-sm-none">Pago realizado</span>
                                            <i class="ci-arrow-right mt-sm-0 ms-1"></i>
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>

                    <x-modal-order-detail :order="$order" />
                    @endforeach
                </tbody>
                </table>
            </div>
            <!-- Pagination-->
            {{-- {{ $orders->links('vendor.pagination.bootstrap-5') }} --}}
            {{ $orders->appends(request()->query())->links('vendor.pagination.bootstrap-5') }}
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

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Obtén los elementos select por su ID
    var statusPaymentSelect = document.getElementById('status');
    var statusDeliverySelect = document.getElementById('delivery-status');
    var createdAtInput = document.getElementById('created-at');

    // Función para enviar el formulario
    function submitForm() {
        this.form.submit();
    }

    // Añade el evento change a los elementos select
    statusPaymentSelect.addEventListener('change', submitForm);
    statusDeliverySelect.addEventListener('change', submitForm);
    createdAtInput.addEventListener('change', submitForm);
});

function confirmDelete(button) {
    Swal.fire({
        title: '¿Estás seguro?',
        text: "Esta acción no se puede deshacer.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            // Si el usuario confirma, envía el formulario
            button.closest('form').submit();
        }
    });
}

function confirmPaymentSubmitted(button, paymentConcept) {
    Swal.fire({
        title: 'Antes de continuar:',
        html: `<ul class='mx-auto text-start fs-5' style='max-width: 80%;'>
                    <li>Abre <b>aplicación bancaria</b></li>
                    <li>Ingresa el concepto de pago <b>${paymentConcept}</b></li>
                    <li>Debes ingresar el <b>monto exacto</b> de la operación</li>
                    <li>Una vez realizado el pago presiona el botón <b>"Ya Realicé Mi Pago"</b></li>
                </ul>`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya Realicé Mi Pago',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            button.closest('form').submit();
        }
    });
}
</script>

@endsection
