@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="d-flex flex-row p-2">
                    <div class="mt-2 text-end">
                        <span class="fw-bold me-2">Status</span>
                        @if ($order->status->name == 'pending')
                            <span class="badge rounded-pill text-bg-warning">
                                {{ ucfirst("Pendiente de Aprobación") }}
                            </span>
                        @elseif($order->status->name == 'pending_payment')
                            <span class="badge rounded-pill text-bg-info">
                                {{ ucfirst("Pendiente de Pago") }}
                            </span>
                        @elseif($order->status->name == 'approved')
                            <span class="badge rounded-pill text-bg-success">
                                {{ ucfirst("Pago sAprobado") }}
                            </span>
                        @else
                            <span class="badge rounded-pill text-bg-success">
                                {{ ucfirst("Cancelada") }}
                            </span>
                        @endif
                    </div>
                </div>
                <hr>
                <div class="table-responsive p-2">
                    <table class="table table-borderless">
                        <tbody>
                            <tr class="add">
                                <td>Cliente</td>
                                <td>Fecha de Orden</td>
                            </tr>
                            <tr class="content">
                                <td>
                                    <span class="fw-bold">Razón Social: </span>{{$order->customer->company_name}} <br>
                                    <span class="fw-bold">Contacto: </span> {{$order->customer->user->name}}<br>
                                    <span class="fw-bold">Correo: </span> {{$order->customer->user->email}}<br>
                                </td>
                                <td>
                                    <span class="fw-bold">{{$order->created_at}}</span> <br>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <hr>
                <div class="table-responsive p-2">
                    <table class="table table-borderless">
                        <tbody>
                            <tr class="add">
                                <td class="fw-bold">Imagen</td>
                                <td class="fw-bold">Producto</td>
                                <td class="fw-bold">Cantidad</td>
                                <td class="fw-bold">Precio</td>
                                <td class="fw-bold text-center">Total</td>
                            </tr>
                            @foreach ($order->items as $item)
                                <tr class="content">
                                    <td>
                                        <img src="{{ Storage::url($item->product->featured) }}" class="rounded" alt="Imagen Destacada" width="100">
                                    </td>
                                    <td>{{$item->product->name}}</td>
                                    <td>{{$item->quantity}}</td>
                                    <td>${{$item->price}}</td>
                                    <td class="text-center">
                                        ${{$item->price * $item->quantity}}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <hr>
                <div class="table-responsive p-2">
                    <table class="table table-borderless">
                        <tbody>
                            <tr class="add">
                                <td></td>
                                <td></td>
                                <td></td>
                                <td class="text-end">Total</td>
                            </tr>
                            <tr class="content">
                                <td></td>
                                <td></td>
                                <td></td>
                                <td class="text-end">${{$order->total}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <hr>
                {{-- <div class="address p-2">
                    <table class="table table-borderless">
                        <tbody>
                            <tr class="add">
                                <td>Bank Details</td>
                            </tr>
                            <tr class="content">
                                <td> Bank Name : ADS BANK <br> Swift Code : ADS1234Q <br> Account Holder : Jelly Pepper <br> Account Number : 5454542WQR <br> </td>
                            </tr>
                        </tbody>
                    </table>
                </div> --}}
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border border-0 shadow-sm">
                <div class="card-header border-0 bg-white">
                    <h5>Actualizar Status</h5>
                </div>
                <div class="card-body bg-white">
                    <form action="{{route('admin.customers.update', $order)}}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="company-name" class="form-label">Status de la orden</label>
                                        <select class="form-select" name="status" id="stats">
                                            <option value="">Selecciona una opción</option>
                                            <option
                                                value="pending_payment"
                                                @selected($order->status->name == 'pending_payment')
                                            >
                                                Pendiente de Pago
                                            </option>
                                            <option
                                                value="pending"
                                                @selected($order->status->name == 'pending')
                                            >
                                                Pendiente de Aproación
                                            </option>
                                            <option
                                                value="approved"
                                                @selected($order->status->name == 'approved')
                                            >
                                                Pago Aprobado
                                            </option>
                                            {{-- <option value="cancelled">Selecciona una opción</option> --}}
                                        </select>
                                        {{-- <input
                                            type="text"
                                            class="form-control"
                                            id="company-name"
                                            name="company_name"
                                            value="{{$customer->company_name}}"
                                            disabled readonly
                                        > --}}
                                    </div>
                                    {{-- <div class="mb-3">
                                        <label for="name" class="form-label">Nombre de Contacto</label>
                                        <input
                                            type="text"
                                            class="form-control"
                                            id="name"
                                            name="name"
                                            value="{{$customer->user->name}}"
                                            disabled readonly
                                        >
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Correo Electrónico</label>
                                        <input
                                            type="email"
                                            class="form-control"
                                            id="email"
                                            name="email"
                                            value="{{$customer->user->email}}"
                                            disabled readonly
                                        >
                                    </div>
                                    <div class="mb-3">
                                        <label for="rfc" class="form-label">RFC</label>
                                        <input
                                            type="text"
                                            class="form-control"
                                            id="rfc"
                                            name="rfc"
                                            value="{{$customer->rfc}}"
                                            disabled readonly
                                        >
                                    </div>
                                    <div class="mb-3">
                                        <label for="delivery-address" class="form-label">Dirección de Envío</label>
                                        <input
                                            type="text"
                                            class="form-control"
                                            id="delivery-address"
                                            name="delivery_address"
                                            value="{{$customer->delivery_address}}"
                                            disabled readonly
                                        >
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="netsuite-key" class="form-label">Clave de NetSuite</label>
                                        <input
                                            type="text"
                                            class="form-control"
                                            id="netsuite-key"
                                            name="netsuite_key"
                                            value="{{$customer->netsuite_key}}"
                                        >
                                    </div>
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Asignar Contraseña</label>
                                        <input
                                            type="password"
                                            class="form-control"
                                            id="password"
                                            name="password"
                                            value="{{$customer->password}}"
                                        >
                                    </div> --}}
                                    <button type="submit" class="btn btn-primary text-center">Actualizar</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
