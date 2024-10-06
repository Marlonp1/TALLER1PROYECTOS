@extends('layouts.app')

@section('content')
<div class="container" style="background: url('/images/register-background.jpg') no-repeat center center; background-size: cover; min-height: 100vh;">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg rounded" style="background: rgba(255, 255, 255, 0.85);">
                <div class="card-header text-center text-white" style="background-color: #4e73df;">
                    <h4 class="mb-0">{{ __('Registro') }}</h4>
                </div>

                <div class="card-body py-4 px-5">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <!-- Nombre -->
                        <div class="form-group row mb-4">
                            <label for="nombre" class="col-md-4 col-form-label text-md-end">{{ __('Nombre') }}</label>
                            <div class="col-md-7">
                                <input id="nombre" type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" value="{{ old('nombre') }}" required autocomplete="nombre" autofocus>
                                @error('nombre')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Correo Electrónico -->
                        <div class="form-group row mb-4">
                            <label for="correo" class="col-md-4 col-form-label text-md-end">{{ __('Correo Electrónico') }}</label>
                            <div class="col-md-7">
                                <input id="correo" type="email" class="form-control @error('correo') is-invalid @enderror" name="correo" value="{{ old('correo') }}" required autocomplete="correo">
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
                                <input id="contraseña" type="password" class="form-control @error('contraseña') is-invalid @enderror" name="contraseña" required autocomplete="new-password">
                                @error('contraseña')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Confirmar Contraseña -->
                        <div class="form-group row mb-4">
                            <label for="contraseña-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirmar Contraseña') }}</label>
                            <div class="col-md-7">
                                <input id="contraseña-confirm" type="password" class="form-control" name="contraseña_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <!-- Botón de Registro -->
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary btn-block" style="background-color: #1cc88a; border: none;">
                                    {{ __('Registrar') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
