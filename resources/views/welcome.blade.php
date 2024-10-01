@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">{{ __('Panel de Control') }}</h4>
                    <span class="badge bg-success">{{ __('En línea') }}</span>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>{{ session('status') }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="text-center my-4">
                        <h5>{{ __('¡Bienvenido de nuevo!') }}</h5>
                        <p class="lead">{{ __('Has iniciado sesión con éxito.') }}</p>
                    </div>

                    <div class="row text-center">
                        <!-- Card para Chats -->
                        <div class="col-md-12 mb-4">
                            <div class="card shadow-sm border-success">
                                <div class="card-body">
                                    <h5 class="card-title">{{ __('Chats') }}</h5>
                                    <p class="card-text">{{ __('Inicia o revisa tus chats.') }}</p>
                                    <a href="{{ route('chats.index') }}" class="btn btn-outline-success">{{ __('Ir a Chats') }}</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end mt-4">
                        <a href="{{ route('logout') }}" class="btn btn-secondary">{{ __('Cerrar sesión') }}</a>
                    </div>
                </div>

                <div class="card-footer text-muted text-center">
                    {{ __('Último inicio de sesión: ') }} {{ \Carbon\Carbon::now()->subDays(1)->format('d M, Y h:i A') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
