@extends('layouts.base')

@section('content')
<div class="container pb-5 mb-2 mb-md-4">
    <div class="pt-5">
        <div class="card py-3 mt-sm-3">
            <div class="card-body text-center">
                <h2 class="h4 pb-3">Gracias por su Orden!</h2>
                <p class="fs-sm mb-2">Su pedido ha sido realizado y será procesado lo antes posible.</p>
                {{-- <p class="fs-sm mb-2">El estado </p> --}}
                <p class="fs-sm">Recibirá un correo con la confirmación de su orden <u>: la cual puede consultar desde su historial de ordenes.</u></p>
                <a class="btn btn-secondary mt-3 me-3" href="/">Volver a Comprar</a>
                <a class="btn btn-primary mt-3" href="{{route('account.orders')}}">
                    <i class="bi bi-geo-alt"></i>
                    &nbsp;Seguimiento de Orden
                </a>
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
