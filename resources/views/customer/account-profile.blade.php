@extends('layouts.base')

@section('content')
<!-- Page Title-->
<div class="page-title-overlap bg-dark pt-4">
    <div class="container d-lg-flex justify-content-between py-2 py-lg-3">
        <div class="order-lg-1 pe-lg-4 text-center text-lg-start">
            <h1 class="h3 text-light mb-0">Información de Perfil</h1>
        </div>
    </div>
</div>

<div class="container pb-5 mb-2 mb-md-4">
    <div class="row">
        <!-- Sidebar-->
        <x-customer-sidebar :customer="$customer" :orders="$orders"></x-customer-sidebar>

        <!-- Content  -->
        <section class="col-lg-9">
            <!-- Toolbar-->
            <div class="d-none d-lg-flex justify-content-between align-items-center pt-lg-3 pb-4 pb-lg-5 mb-lg-3">
                <h6 class="fs-base text-light mb-0">Actualiza datos de perfil:</h6>
                {{-- <a class="btn btn-primary btn-sm" href="account-signin.html"><i class="ci-sign-out me-2"></i>Sign out</a> --}}
            </div>
            <!-- Profile form-->
            <form action="{{route('account.profile-update', $customer)}}" method="POST">
                @method('PUT')
                @csrf
                <div class="row gx-4 gy-3">
                    <div class="col-sm-6">
                        <div class="form-floating @error('name') is-invalid @enderror">
                            <input
                                class="form-control @error('name') is-invalid @enderror"
                                type="text"
                                name="name"
                                id="name"
                                placeholder=""
                                value="{{old('name', Auth::user()->name)}}">
                            <label for="name">Nombre</label>
                            <div class="invalid-feedback" role="alert">
                                @error('name')
                                    <strong>{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-floating @error('email') is-invalid @enderror">
                            <input
                                class="form-control @error('email') is-invalid @enderror"
                                type="email"
                                name="email"
                                id="email"
                                placeholder=""
                                value="{{old('email', Auth::user()->email)}}">
                            <label for="account-email">Correo Electrónico</label>
                            <div class="invalid-feedback">
                                @error('email')
                                    <strong>{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <hr>
                    <p class="mb-0">Actualizar contraseña</p>
                    <div class="col-sm-6">
                        <div class="form-floating @error('password') is-invalid @enderror">
                            <input class="form-control @error('password') is-invalid @enderror" id="password" type="password" name="password" placeholder="">
                            <label class="form-label" for="account-pass">Nueva Contraseña</label>
                            <div class="invalid-feedback">
                                @error('password')
                                    <strong>{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-floating @error('password_confirmation') is-invalid @enderror"">
                            <input class="form-control @error('password_confirmation') is-invalid @enderror" type="password" id="password-confirmation" name="password_confirmation" placeholder="">
                            <label class="form-label" for="account-confirm-pass">Confirmar Contraseña</label>
                            <div class="invalid-feedback">
                                @error('password_confirmation')
                                    <strong>{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <hr>
                    <p class="mb-0">Direcciones de entrega</p>
                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="table table-hover fs-sm border-top">
                                <thead>
                                    <tr>
                                        <th class="align-middle"></th>
                                        <th class="align-middle">Dirección de envío</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($delivery_addresses as $index => $address)
                                        <tr>
                                            <td>
                                                <div class="form-check mb-4">
                                                    <input
                                                        class="form-check-input @error('default_address') is-invalid @enderror"
                                                        type="radio"
                                                        id="default-address-{{$index}}"
                                                        name="default_address"
                                                        value="{{$index}}"
                                                        @checked($customer->default_address == $index + 1)
                                                        >
                                                    <label class="form-check-label" for="default-address-{{$index}}"></label>
                                                    @error('default_address')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </td>
                                            <td class="align-middle">
                                                <span class="text-muted">{{$address}}</span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-12">
                        <hr class="mt-2 mb-3">
                        <div class="d-flex flex-wrap justify-content-between align-items-center">
                            {{-- <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="subscribe_me" checked="">
                                <label class="form-check-label" for="subscribe_me">Subscribe me to Newsletter</label>
                            </div> --}}
                            <button type="submit" class="btn btn-primary mt-3 mt-sm-0">Actualizar Perfil</button>
                        </div>
                    </div>
                </div>
            </form>
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

<script>
document.querySelectorAll('[data-toggle="password"]').forEach(function (el) {
  el.addEventListener("click", function (e) {
    e.preventDefault();

    var target = el.dataset.target;
    document.querySelector(target).focus();

    if (document.querySelector(target).getAttribute('type') == 'password') {
      document.querySelector(target).setAttribute('type', 'text');
    } else {
      document.querySelector(target).setAttribute('type', 'password');
    }

    if (el.dataset.classActive) el.classList.toggle(el.dataset.classActive);
  });
});
</script>
@endif

@endsection
