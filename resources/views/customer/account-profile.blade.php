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
