@extends('layouts.app')

@section('content')
<div class="container" style="background: url('{{ asset('images/login.jpg') }}') no-repeat center center; background-size: cover; min-height: 100vh;">
<div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg rounded" style="background: rgba(255, 255, 255, 0.85);">
                <div class="card-header text-center text-white" style="background-color: #4e73df;">
                    <h4 class="mb-0">{{ __('Iniciar Sesión') }}</h4>
                </div>

                <div class="card-body py-4 px-5">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <!-- Correo Electrónico -->
                        <div class="form-group row mb-4">
                            <label for="correo" class="col-md-4 col-form-label text-md-end">{{ __('Correo Electrónico') }}</label>

                            <div class="col-md-7">
                                <input id="correo" type="email" class="form-control @error('correo') is-invalid @enderror" name="correo" value="{{ old('correo') }}" required autocomplete="correo" autofocus>

                                @error('correo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Contraseña -->
                        <div class="form-group row mb-4">
                            <label for="contraseña" class="col-md-4 col-form-label text-md-end">{{ __('Contraseña') }}</label>

                            <div class="col-md-7">
                                <input id="contraseña" type="password" class="form-control @error('contraseña') is-invalid @enderror" name="contraseña" required autocomplete="current-password">

                                @error('contraseña')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Recordarme -->
                        <div class="form-group row mb-4">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="remember">
                                        {{ __('Recordarme') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Botones de acción -->
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary btn-block" style="background-color: #1cc88a; border: none;">
                                    {{ __('Iniciar Sesión') }}
                                </button>
                            </div>
                        </div>

                        <!-- Enlace de "¿Olvidaste tu contraseña?" centrado -->
                        <div class="form-group row mt-3">
                            <div class="col-md-8 offset-md-4 text-right">
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link p-0" href="{{ route('password.request') }}" style="font-size: 0.9rem;">
                                        {{ __('¿Olvidaste tu contraseña?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
