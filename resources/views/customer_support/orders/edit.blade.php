@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 mb-3 mb-md-0">
            <div class="card bg-white">
                <div class="d-flex flex-row p-2">
                    <div class="mt-2 text-end">
                        <span class="fw-bold me-2">Status</span>
                        @if ($order->status == 'pending')
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
                    </div>
                </div>
                <hr>
                <div class="table-responsive p-2">
                    <table class="table table-borderless">
                        <tbody>
                            <tr class="add">
                                <td clas>Cliente</td>
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
                                <td class="text-end fw-bold">Total</td>
                            </tr>
                            <tr class="content">
                                <td></td>
                                <td></td>
                                <td></td>
                                <td class="text-end fw-bold">
                                    <x-amount-formatter :amount="$order->total" />
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                {{-- <hr> --}}
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
            <div class="row">
                {{-- Status --}}
                <div class="col-md-12 mb-3">
                    <div class="card border border-0 shadow-sm">
                        <div class="card-header border-0 bg-white">
                            <h5>Actualizar Status</h5>
                        </div>
                        <div class="card-body bg-white">
                            <form action="{{route('admin.orders.update.status', $order)}}" method="POST">
                                @csrf
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <div class="form-floating @error('status') is-invalid @enderror">
                                                    <select
                                                        class="form-select @error('status') is-invalid @enderror"
                                                        id="status"
                                                        name="status"
                                                    >
                                                        <option value="">Selecciona una opción</option>
                                                        <option
                                                            value="pending_payment"
                                                            @selected($order->status == 'pending_payment')
                                                        >
                                                            Pendiente de Pago
                                                        </option>
                                                        <option
                                                            value="pending"
                                                            @selected($order->status == 'pending')
                                                        >
                                                            Pendiente de Aproación
                                                        </option>
                                                        <option
                                                            value="approved"
                                                            @selected($order->status == 'approved')
                                                        >
                                                            Pago Aprobado
                                                        </option>
                                                    </select>
                                                    <label for="company-name">Status de la orden</label>
                                                </div>
                                                <div class="invalid-feedback">
                                                    @error('status')
                                                        <strong>{{$message}}</strong>
                                                    @enderror
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary text-center">Actualizar</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                {{-- Número de guía  --}}
                <div class="col-md-12 mb-3">
                    <div class="card border border-0 shadow-sm">
                        <div class="card-header border-0 bg-white">
                            <h5>Actualizar Número de Guía</h5>
                        </div>
                        <div class="card-body bg-white">
                            <form action="{{route('admin.orders.update.guide-number', $order)}}" method="POST">
                                @csrf
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <div class="form-floating @error('courier_code') is-invalid @enderror">
                                                    <select
                                                        class="form-select @error('courier_code') is-invalid @enderror"
                                                        id="courier_code"
                                                        name="courier_code"
                                                    >
                                                        <option value="">Selecciona una opción</option>

                                                        @foreach ($courier_codes as $key => $service)
                                                            <option
                                                                value="{{$key}}"
                                                                @selected($key == $order->courier_code)>
                                                                {{$service}}
                                                            </option>
                                                        @endforeach
                                                        </option>
                                                    </select>
                                                    <label for="company-name">Servicio de paquetería</label>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <div class="form-floating @error('tracking_number') is-invalid @enderror">
                                                    <input
                                                        class="form-control @error('tracking_number') is-invalid @enderror"
                                                        type="text"
                                                        id="tracking_number"
                                                        placeholder=""
                                                        name="tracking_number"
                                                        value="{{old('tracking_number', $order->tracking_number)}}"
                                                    >
                                                    <label for="name">Número de guía</label>
                                                </div>
                                                <div class="invalid-feedback">
                                                    @error('tracking_number')
                                                        <strong>{{$message}}</strong>
                                                    @enderror
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary text-center">Actualizar</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                {{-- Factura --}}
                <div class="col-md-12 mb-3">
                    <div class="card border border-0 shadow-sm">
                        <div class="card-header border-0 bg-white">
                            <h5>Actualizar Factura</h5>
                        </div>
                        <div class="card-body bg-white">
                            <form action="{{route('admin.orders.update.invoice', $order)}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <div class="form-floating @error('invoice') is-invalid @enderror">
                                                    <input
                                                        class="form-control @error('invoice') is-invalid @enderror"
                                                        type="file"
                                                        id="invoice"
                                                        name="invoice"
                                                    >
                                                    <label for="name">Ficha técnica</label>
                                                </div>
                                                <div class="invalid-feedback">
                                                    @error('invoice')
                                                        <strong>{{$message}}</strong>
                                                    @enderror
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary text-center">Actualizar</button>
                                            @if ($order->invoice)
                                                <a
                                                    href="{{Storage::url($order->invoice)}}"
                                                    class="btn btn-outline-accent float-end"
                                                    target="_blank">
                                                    Ver factura
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
