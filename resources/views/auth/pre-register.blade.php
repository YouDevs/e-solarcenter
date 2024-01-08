@extends('layouts.base')

@section('content')
<div class="container pb-5 mb-2 mb-md-4">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card py-3 mt-sm-3">
                <div class="card-body text-center">
                    <h3 class="fs-3 mb-2">
                        {{-- <i class="bi bi-list-check"></i> --}}
                        ¡Gracias por tu solicitud de registro!
                    </h3>
                    <p class="text-center fs-5">Próximos pasos:</p>
                    <ul class="mx-auto text-start fs-5" style="max-width: 80%;">
                        <li>Revisaremos tu solicitud en Solar Center.</li>
                        <li>Si es aprobada, activaremos tu cuenta y un representante te contactará para confirmarlo.</li>
                        <li>Una vez activada, podrás empezar a hacer pedidos en nuestra plataforma e-commerce.</li>
                    </ul>
                </div>
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