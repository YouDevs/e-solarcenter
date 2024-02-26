
@extends('layouts.app')

@section('content')
<div class="container vh-100">
    <div class="row h-75 justify-content-center align-items-md-center">
        <div class="col-md-6">
            <div class="card border border-0 shadow-sm">
                <div class="card-body bg-white">

                    <div class="row mb-3">
                        <div class="col text-center">
                            <img src="{{asset('images/logo.webp')}}" class="img-fluid text-center" alt="Solar Center" width="180">
                        </div>
                    </div>

                    <form action="{{ route('forget.password.post') }}" method="POST">
                        @csrf
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-md-8">
                                    <div class="mb-3">
                                        <div class="form-floating @error ('email') @enderror">
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

                                    <div class="d-flex justify-content-center">
                                        <button type="submit" class="btn btn-solar text-white">Inciar Sesión</button>
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