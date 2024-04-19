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
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-md-8">
                                    <div class="mb-3">
                                        <div class="form-floating @error('email') is-invalid @enderror"">
                                            <input
                                                id="email"
                                                type="email"
                                                class="form-control bg-white @error('email') is-invalid @enderror"
                                                name="email"
                                                value="{{ old('email') }}"
                                                required
                                                autocomplete="email"
                                                placeholder=""
                                                autofocus
                                            >
                                            <label for="email">Email</label>
                                        </div>
                                        <div class="invalid-feedback">
                                            @error('email')
                                                <strong>{{$message}}</strong>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <div class="form-floating">
                                            <input
                                                id="password"
                                                type="password"
                                                class="form-control bg-white @error('password') is-invalid @enderror"
                                                name="password"
                                                required
                                                placeholder=""
                                                autocomplete="current-password"
                                            >
                                            <label for="password">Contraseña</label>
                                        </div>
                                        <div class="invalid-feedback">
                                            @error('password')
                                                <strong>{{$message}}</strong>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-center">
                                        <button type="submit" class="btn btn-solar">Inciar Sesión</button>
                                    </div>
                                    <div class="d-flex justify-content-center mt-2">
                                        <a class="btn btn-link sc-gray text-decoration-none" href="{{route('register')}}">Solicita una cuenta</a>
                                        @if (Route::has('reset.password.get'))
                                            <a class="btn btn-link sc-gray text-decoration-none" href="{{ route('forget.password.get') }}">
                                                {{ __('¿Olvidaste tu contraseña?') }}
                                            </a>
                                        @endif
                                    </div>
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