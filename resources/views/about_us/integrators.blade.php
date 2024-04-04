@extends('layouts.base')

@section('content')
<div class="bg-secondary py-4">
    <div class="container d-lg-flex justify-content-between py-2 py-lg-3">
        <div class="order-lg-1 pe-lg-4 text-center text-lg-start">
        <h1 class="h3 mb-0">Contacto</h1>
        </div>
    </div>
</div>

<section class="container pt-grid-gutter">
    <div class="row">
        <div class="col-xl-3 col-sm-6 mb-grid-gutter">
            <a class="card h-100" href="https://maps.app.goo.gl/RYdnJYeqhqWpZxaq8" target="_blank">
                <div class="card-body text-center">
                    <i class="bi bi-geo-alt h3 mt-2 text-primary"></i>
                    <h3 class="h6 mb-2 mt-2">Matriz</h3>
                    <p class="fs-sm text-muted">
                        Av. Industria Eléctrica 43-A
                        Parque Industrial Bugambilias,
                        Tlajomulco de Zúñiga.
                    </p>
                    {{-- <div class="fs-sm text-blue-gray">
                        Ver en el mapa <i class="bi bi-chevron-right align-middle ms-1"></i>
                    </div> --}}
                </div>
            </a>
        </div>
        <div class="col-xl-3 col-sm-6 mb-grid-gutter">
            <div class="card h-100">
                <div class="card-body text-center">
                    <i class="bi bi-clock h3 mt-2 text-primary"></i>
                    <h3 class="h6 mb-3 mt-2">Horario de Atención</h3>
                    <p class="fs-sm text-muted">
                        Lunes - Viernes: 9AM - 6PM
                    </p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-grid-gutter">
            <div class="card h-100">
                <div class="card-body text-center">
                    <i class="bi bi-telephone h3 mt-2 text-primary"></i>
                    <h3 class="h6 mb-3 mt-2">Teléfono</h3>
                    <ul class="list-unstyled fs-sm mb-0">
                        <li>
                            {{-- <span class="text-muted me-1">For customers:</span> --}}
                            <a class="nav-link-style" href="tel:+523338042122">+52 33 3804 2122</a>
                        </li>
                        {{-- <li class="mb-0">
                            <span class="text-muted me-1">Tech support:</span>
                            <a class="nav-link-style" href="tel:+100331697720">+1 00 33 169 7720</a>
                        </li> --}}
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-grid-gutter">
            <div class="card h-100">
                <div class="card-body text-center">
                    <i class="bi bi-envelope h3 mt-2 text-primary"></i>
                    <h3 class="h6 mb-3 mt-2">Email</h3>
                    <ul class="list-unstyled fs-sm mb-0">
                        <li>
                            {{-- <span class="text-muted me-1">For customers:</span> --}}
                            <a class="nav-link-style" href="mailto:+108044357260">contacto@solar-center.mx</a></li>
                        {{-- <li class="mb-0"><span class="text-muted me-1">Tech support:</span><a class="nav-link-style" href="mailto:support@example.com">support@example.com</a></li> --}}
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="container px-0" id="map">
    <div class="row g-0 mb-5">
        <div class="col-lg-12 px-4 px-xl-5 py-5">
            <h2 class="h4 mb-4">Escríbanos</h2>
            <form method="POST" action="{{ route('about-us.send-contact') }}" >
                @csrf
                <div class="row g-3">
                    <div class="col-sm-6">
                        <label class="form-label" for="name">
                            Tu nombre:&nbsp;<span class="text-danger">*</span>
                        </label>
                        <input
                            class="form-control bg-white @error('name') is-invalid @enderror"
                            type="text"
                            name="name"
                            id="name"
                            placeholder="John Doe"
                            value="{{ old('name') }}">

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-sm-6">
                        <label class="form-label" for="email">
                            Correo electrónico:&nbsp;<span class="text-danger">*</span>
                        </label>
                        <input
                            class="form-control @error('email') is-invalid @enderror"
                            type="email"
                            name="email"
                            id="email"
                            placeholder="johndoe@email.com"
                            value="{{ old('email')}} ">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-sm-6">
                        <label class="form-label" for="phone">
                            Tu teléfono:&nbsp;<span class="text-danger">*</span>
                        </label>
                        <input
                            class="form-control @error('phone') is-invalid @enderror"
                            type="text"
                            name="phone"
                            id="phone"
                            placeholder="+52 (33) 00 000 000"
                            value="{{old('phone')}}">
                            @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                    </div>
                    <div class="col-sm-6">
                        <label class="form-label" for="subject">
                            Asunto:&nbsp;<span class="text-danger">*</span>
                        </label>
                        <input
                            class="form-control @error('subject') is-invalid @enderror"
                            type="text"
                            name="subject"
                            id="subject"
                            placeholder="Proporciona un título corto para tu mensaje"
                            value="{{old('subject')}}">
                            @error('subject')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                    </div>
                    <div class="col-12">
                        <label class="form-label" for="message">
                            Mensaje:&nbsp;<span class="text-danger">*</span>
                        </label>
                        <textarea
                            class="form-control @error('message') is-invalid @enderror"
                            name="message"
                            id="message"
                            rows="6"
                            placeholder="Por favor describe a detalle tu petición"></textarea>
                            @error('message')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        <button class="btn btn-primary mt-4" type="submit">Enviar mensaje</button>
                    </div>
                </div>
            </form>
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
        timer: 3000,
    });
</script>
@endif

@endsection