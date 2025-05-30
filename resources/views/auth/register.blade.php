@extends('layouts.app')

@section('content')
<div class="container" style="background: url('{{ asset('images/register-background.jpg') }}') no-repeat center center; background-size: cover; min-height: 100vh;">
    <div class="row justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="col-md-6">
            <div class="card shadow-lg rounded-4 border-0" style="background: #f5f5f5;">
                <div class="card-header text-center rounded-top-4" style="background-color: #003366;">
                    <h3 class="mb-0 text-white" style="font-weight: bold;">{{ __('Registro') }}</h3>
                </div>

                <div class="card-body px-5 py-4">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <!-- Nombre -->
                        <div class="form-group mb-4">
                            <label for="nombre" class="form-label" style="font-size: 1.1rem;">{{ __('Nombre') }}</label>
                            <input id="nombre" type="text" class="form-control @error('nombre') is-invalid @enderror rounded-pill px-4 py-2" name="nombre" value="{{ old('nombre') }}" required autofocus>

                            @error('nombre')
                                <span class="invalid-feedback d-block mt-1" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Correo Electrónico -->
                        <div class="form-group mb-4">
                            <label for="correo" class="form-label" style="font-size: 1.1rem;">{{ __('Correo Electrónico') }}</label>
                            <input id="correo" type="email" class="form-control @error('correo') is-invalid @enderror rounded-pill px-4 py-2" name="correo" value="{{ old('correo') }}" required>

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

                        <!-- Confirmar Contraseña -->
                        <div class="form-group mb-4">
                            <label for="contraseña-confirm" class="form-label" style="font-size: 1.1rem;">{{ __('Confirmar Contraseña') }}</label>
                            <input id="contraseña-confirm" type="password" class="form-control rounded-pill px-4 py-2" name="contraseña_confirmation" required>
                        </div>

                        <!-- Botón de Registro -->
                        <div class="mb-3">
                            <button type="submit" class="btn w-100 rounded-pill py-2" style="background-color: #f4b400; color: #000000; font-weight: bold; font-size: 1.1rem;">
                                {{ __('Registrar') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
