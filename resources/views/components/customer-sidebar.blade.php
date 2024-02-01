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
                <a class="nav-link-style d-flex align-items-center px-4 py-3 {{request()->routeIs('account.profile')? 'active': ''}}" href="{{route('account.profile')}}">
                    <i class="ci-bag opacity-60 me-2"></i> Mi Cuenta
                </a>
            </li>
            <li class="border-bottom mb-0">
                <a class="nav-link-style d-flex align-items-center px-4 py-3 {{request()->routeIs('account.orders')? 'active': ''}}" href="{{route('account.orders')}}">
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
            <li class="mb-0">
                <a
                    class="nav-link-style d-flex align-items-center px-4 py-3"
                    href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                    <i class="ci-help opacity-60 me-2"></i> Cerrar Sesión
                </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
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
                </a>
            </li> --}}
        {{-- </ul> --}}
        </div>
    </div>
</aside>