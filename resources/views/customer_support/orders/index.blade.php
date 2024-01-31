@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card border border-0 shadow-sm">
                <div class="card-header bg-white border-0">
                    <!-- Contenedor Flex -->
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center">
                        <!-- Texto a la izquierda -->
                        <h4 class="fw-bold mt-2">Listado de Ordenes</h4>
                        <!-- Botones a la derecha -->
                        {{-- TODO: exportar Ordenes --}}
                        {{-- <div>
                            <a href="{{route('admin.products.create')}}" class="btn btn-outline-accent">Exportar</a>
                        </div> --}}
                    </div>
                </div>
                <div class="card-body bg-white">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr class="text-center">
                                    <th scope="col">Folio</th>
                                    <th scope="col">Cliente</th>
                                    {{-- <th scope="col">Contacto</th> --}}
                                    {{-- <th scope="col">Correo</th> --}}
                                    <th scope="col">Total</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Status de envío</th>
                                    <th scope="col">Fecha</th>
                                    <th scope="col">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                <tr class="text-center">
                                    <th scope="row" class="fw-bold">{{$order->folio()}}</th>
                                    <th scope="row" class="fw-bold">{{$order->customer->company_name}}</th>
                                    {{-- <th scope="row">{{$order->customer->user->name}}</th> --}}
                                    {{-- <th scope="row">{{$order->customer->user->email}}</th> --}}
                                    <th scope="row">
                                        <x-amount-formatter :amount="$order->total" />
                                    </th>
                                    <th scope="row" class="text-accent">
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
                                    </th>
                                    <td>
                                        <x-order-delivery-status :status="$order->translated_delivery_status" />
                                    </td>
                                    <td>
                                        {{ $order->created_at->format('m/d/y H:i') }}
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center justify-content-center">
                                            <a href="{{ route('admin.orders.edit', $order) }}" class="btn btn-info me-2">Detalle</a>
                                            <form
                                                action="#"
                                                method="POST"
                                                class="inline ml-2"
                                            >
                                                @csrf
                                                <button type="button" onclick="confirmDelete(this)" class="btn btn-danger">
                                                    Cancelar
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                  </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
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
