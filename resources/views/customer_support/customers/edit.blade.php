@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border border-0 shadow-sm">
                <div class="card-header border-0 bg-white">
                    <h5>Actualizar Cliente</h5>
                </div>
                <div class="card-body bg-white">
                    <form action="{{route('admin.customers.update', $customer)}}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="container">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="company-name" class="form-label">Nombre de la Empresa</label>
                                        <input
                                            type="text"
                                            class="form-control"
                                            id="company-name"
                                            name="company_name"
                                            value="{{$customer->company_name}}"
                                            disabled readonly
                                        >
                                    </div>
                                    <div class="mb-3">
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
                                    </div>
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
