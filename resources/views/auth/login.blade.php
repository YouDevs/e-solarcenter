@extends('layouts.base')

@section('content')
<div class="container vh-100">
    <div class="row h-100 justify-content-center align-items-md-center">
        <div class="col-md-6">
            <div class="card border border-0 shadow-sm">

                <div class="card-body bg-white">
                    <div class="row mb-3">
                        <div class="col text-center">
                            <img src="{{asset('images/logo.webp')}}" class="img-fluid text-center" alt="Solar Center" width="180">
                        </div>
                    </div>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">Correo Electrónico</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control bg-white @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">Contraseña</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control bg-white @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div> --}}

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-3">
                                <button type="submit" class="btn btn-primary-solar">
                                    Iniciar Sesión
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link text-decoration-none" href="{{ route('password.request') }}">
                                        {{ __('¿Olvidaste tu contraseña?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            {{-- TODO: definir bien cómo sería este flujo --}}
            {{-- <a href="" class="text-decoration-none mt-2">¿Eres cliente de Solar Center y no tienes acceso al e-commerce?</a><br>
            <a href="" class="text-decoration-none mt-2">¿Aun no eres cliente de Solar Center y quieres acceso al e-commerce?</a> --}}
        </div>
    </div>
</div>
@endsection
