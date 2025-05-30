@extends('layouts.app')

@section('content')
<div class="container" style="background: url('{{ asset('images/login.jpg') }}') no-repeat center center; background-size: cover; min-height: 100vh;">
    <div class="row justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="col-md-6">
            <div class="card shadow-lg rounded-4 border-0" style="background: #f5f5f5;">
                <div class="card-header text-center rounded-top-4" style="background-color: #003366;">
                    <h3 class="mb-0 text-white" style="font-weight: bold;">{{ __('Iniciar Sesión') }}</h3>
                </div>

                <div class="card-body px-5 py-4">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <!-- Correo -->
                        <div class="form-group mb-4">
                            <label for="correo" class="form-label" style="font-size: 1.1rem;">{{ __('Correo Electrónico') }}</label>
                            <input id="correo" type="email" class="form-control @error('correo') is-invalid @enderror rounded-pill px-4 py-2" name="correo" value="{{ old('correo') }}" required autofocus>

                            @error('correo')
                                <span class="invalid-feedback d-block mt-1" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Contraseña -->
                        <div class="form-group mb-4">
                            <label for="contraseña" class="form-label" style="font-size: 1.1rem;">{{ __('Contraseña') }}</label>
                            <input id="contraseña" type="password" class="form-control @error('contraseña') is-invalid @enderror rounded-pill px-4 py-2" name="contraseña" required>

                            @error('contraseña')
                                <span class="invalid-feedback d-block mt-1" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Recordarme -->
                        <div class="form-check mb-4">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label ms-2" for="remember">
                                {{ __('Recordarme') }}
                            </label>
                        </div>

                        <!-- Botón Iniciar -->
                        <div class="mb-3">
                            <button type="submit" class="btn w-100 rounded-pill py-2" style="background-color: #f4b400; color: #000000; font-weight: bold; font-size: 1.1rem;">
                                {{ __('Iniciar Sesión') }}
                            </button>
                        </div>

                        <!-- ¿Olvidaste tu contraseña? -->
                        @if (Route::has('password.request'))
                            <div class="text-end">
                                <a class="btn btn-link p-0" href="{{ route('password.request') }}" style="font-size: 0.9rem; color: #003366;">
                                    {{ __('¿Olvidaste tu contraseña?') }}
                                </a>
                            </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
