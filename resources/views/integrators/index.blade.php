@extends('layouts.base')

@section('content')
<div class="bg-secondary py-4">
    <div class="container d-lg-flex justify-content-between py-2 py-lg-3">
        <div class="order-lg-1 pe-lg-4 text-center text-lg-start">
            <h1 class="h3 mb-0">Integradores</h1>
        </div>
    </div>
</div>

<div class="col-md-12 px-3 px-md-5">
    <div class="mx-auto pt-lg-5 pt-4 text-center" style="max-width: 35rem;">
        <h2 class="h4 mb-0 text-blue-gray">Bienvenido Integrador!</h2>
        <p class="">
            <span class="fw-bold">Estás cada vez más cerca de transformar a México a través de la energía solar.</span>
        </p>
        <p>
            Si ya eres parte de la red Solar Center y necesitas que te apoyemos con algo en específico
            escríbenos a nuestro WhatsApp y nos contactaremos contigo a la brevedad.
            <br><br>
            ¿Eres integrador y necesitas asesoría o información de productos?
            <span class="fw-bold text-blue-gray">Regístrate aquí</span> <br>
            <i class="bi bi-arrow-down-short h4 text-blue-gray"></i>
        </p>
    </div>
</div>

<div class="container px-0" id="map">
    <div class="row g-0 mb-5">
        <div class="col-lg-12 px-4 px-xl-5">
            <form method="POST" action="{{ route('integrators.send-contact') }}" >
                @csrf
                <div class="row g-3">
                    <div class="col-sm-6">
                        <label class="form-label" for="name">
                            Nombre completo&nbsp;<span class="text-danger">*</span>
                        </label>
                        <input
                            class="form-control @error('name') is-invalid @enderror"
                            type="text"
                            name="name"
                            id="name"
                            placeholder=""
                            value="{{ old('name') }}">

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-sm-6">
                        <label class="form-label" for="email">
                            Correo electrónico&nbsp;<span class="text-danger">*</span>
                        </label>
                        <input
                            class="form-control @error('email') is-invalid @enderror"
                            type="email"
                            name="email"
                            id="email"
                            placeholder=""
                            value="{{ old('email')}} ">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-sm-6">
                        <label class="form-label" for="phone">
                            Tu teléfono / WhatsApp&nbsp;<span class="text-danger">*</span>
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
                            Estado&nbsp;<span class="text-danger">*</span>
                        </label>
                        <input
                            class="form-control @error('state') is-invalid @enderror"
                            type="text"
                            name="state"
                            id="state"
                            placeholder=""
                            value="{{old('state')}}">
                            @error('state')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                    </div>

                    <div class="col-sm-6">
                        <label class="form-label" for="company">
                            Empresa&nbsp;<span class="text-danger">*</span>
                        </label>
                        <input
                            class="form-control @error('company') is-invalid @enderror"
                            type="text"
                            name="company"
                            id="company"
                            placeholder=""
                            value="{{old('company')}}">
                            @error('company')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                    </div>

                    <div class="col-sm-6">
                        <label class="form-label" for="subject">
                            RFC&nbsp;<span class="text-danger">*</span>
                        </label>
                        <input
                            class="form-control @error('rfc') is-invalid @enderror"
                            type="text"
                            name="rfc"
                            id="rfc"
                            placeholder=""
                            value="{{old('rfc')}}">
                            @error('rfc')
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