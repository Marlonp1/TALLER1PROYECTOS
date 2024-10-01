@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">{{ __('Perfil de Usuario') }}</h4>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>{{ session('status') }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form action="{{ route('profile.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group mb-3">
                            <label for="nombre">{{ __('Nombre') }}</label>
                            <input type="text" id="nombre" name="nombre" class="form-control" value="{{ old('nombre', $user->nombre) }}" required>
                            @error('nombre')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="correo">{{ __('Correo Electrónico') }}</label>
                            <input type="email" id="correo" name="correo" class="form-control" value="{{ old('correo', $user->correo) }}" required>
                            @error('correo')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">{{ __('Actualizar Perfil') }}</button>
                    </form>
                </div>

                <div class="card-footer text-muted text-center">
                    {{ __('Último inicio de sesión: ') }} {{ \Carbon\Carbon::now()->subDays(1)->format('d M, Y h:i A') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
