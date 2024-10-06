@extends('layouts.app')

@section('content')
<div class="container" style="background: url('/images/dashboard-background.jpg') no-repeat center center; background-size: cover; min-height: 100vh;">
    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <div class="card shadow-lg rounded border-0" style="background: rgba(255, 255, 255, 0.85);">
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
                        <!-- Mostrar el primer nombre del usuario -->
                        <div class="col-md-12 mb-4">
                            @if (Auth::check())
                                <h6 class="text-muted">{{ __('Usuario: ') }}{{ explode(' ', Auth::user()->nombre)[0] }}</h6>
                            @endif
                        </div>

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
                </div>

                <div class="card-footer text-muted text-center">
                    {{ __('Último inicio de sesión: ') }} {{ \Carbon\Carbon::now()->subDays(1)->format('d M, Y h:i A') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
