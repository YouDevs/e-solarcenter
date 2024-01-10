@extends('layouts.base')

@section('content')
<div class="bg-secondary py-4">
    <div class="container d-lg-flex justify-content-between py-2 py-lg-3">
        <div class="order-lg-2 mb-3 mb-lg-0 pt-lg-2">
            <nav aria-label="breadcrumb">
                {{-- <ol class="breadcrumb flex-lg-nowrap justify-content-center justify-content-lg-start">
                    <li class="breadcrumb-item"><a class="text-nowrap" href="index.html"><i class="ci-home"></i>Inicio</a></li>
                    <li class="breadcrumb-item text-nowrap active" aria-current="page">Contacto</li>
                </ol>
            </nav> --}}
        </div>
        <div class="order-lg-1 pe-lg-4 text-center text-lg-start">
            <h1 class="h3 mb-0">Contacto</h1>
        </div>
    </div>
</div>

{{-- <section class="container-fluid pt-grid-gutter">
    <div class="row">
        <div class="col-xl-3 col-sm-6 mb-grid-gutter">
            <a class="card h-100" href="https://maps.app.goo.gl/VBfv11xqZogGCSZ28" data-scroll="" target="_blank">
                <div class="card-body text-center"><i class="ci-location h3 mt-2 mb-4 text-primary"></i>
                    <h3 class="h6 mb-2">Matriz</h3>
                    <p class="fs-sm text-muted">
                        Av. Industria Eléctrica 43-A Parque Industrial Bugambilias, Tlajomulco de Zúñiga.
                    </p>
                    <div class="fs-sm text-primary">
                        Clic para ver el mapa<i class="ci-arrow-right align-middle ms-1"></i>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-xl-3 col-sm-6 mb-grid-gutter">
            <div class="card h-100">
                <div class="card-body text-center"><i class="ci-time h3 mt-2 mb-4 text-primary"></i>
                <h3 class="h6 mb-3">Horas laborales</h3>
                <ul class="list-unstyled fs-sm text-muted mb-0">
                    <li>Lunes-Viernes 09:00 am - 06:00 pm</li>
                </ul>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-grid-gutter">
            <div class="card h-100">
                <div class="card-body text-center"><i class="ci-phone h3 mt-2 mb-4 text-primary"></i>
                    <h3 class="h6 mb-3">Números de teléfono</h3>
                    <ul class="list-unstyled fs-sm mb-0">
                        <li>
                            <span class="text-muted me-1">Para clientes:</span>
                            <a class="nav-link-style" href="tel:+523338042122">+52 33 38 04 2122</a>
                        </li>
                        <li class="mb-0">
                            <span class="text-muted me-1">Apoyo técnico:</span>
                            <a class="nav-link-style" href="tel:+523338042122">+52 33 38 04 2122</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-grid-gutter">
            <div class="card h-100">
                <div class="card-body text-center"><i class="ci-mail h3 mt-2 mb-4 text-primary"></i>
                    <h3 class="h6 mb-3">Correo electrónico</h3>
                    <ul class="list-unstyled fs-sm mb-0">
                        <li>
                            <span class="text-muted me-1">Para clientes:</span>
                            <a class="nav-link-style" href="mailto:+108044357260">customer@example.com</a></li>
                        <li class="mb-0">
                            <span class="text-muted me-1">Apoyo ténico:</span>
                            <a class="nav-link-style" href="mailto:contacto@solar-center.mx">contacto@solar-center.mx</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section> --}}

<div class="container-fluid px-0" id="map">
    <div class="row g-0">
        {{-- <div class="col-lg-6 iframe-full-height-wrap">
            <iframe class="iframe-full-height" width="600" height="250" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d53357.14257194912!2d-73.07268695801845!3d40.78017062807504!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89e8483b8bffed93%3A0x53467ceb834b7397!2s396+Lillian+Blvd%2C+Holbrook%2C+NY+11741%2C+USA!5e0!3m2!1sen!2sua!4v1558703206875!5m2!1sen!2sua"></iframe>
        </div> --}}
        <div class="col-lg-6 px-4 px-xl-5 py-5 border-top">
            <h2 class="h4 mb-4">Escríbanos</h2>
            <form method="POST" action="{{ route('account.send-contact') }}" >
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