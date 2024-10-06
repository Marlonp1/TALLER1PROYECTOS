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
                        <!-- Mostrar el primer nombre del usuario -->
                        <div class="col-md-12">
                            @if (Auth::check())
                                <h6 class="text-muted">Usuario Profesor: {{ explode(' ', Auth::user()->nombre)[0] }}</h6>
                            @endif
                        </div>

                        <!-- Botones de gestión -->
                        <div class="col-md-12 mb-4">
                            <div class="row">
                                <!-- Botón Gestionar Usuario -->
                                <div class="col-md-4">
                                    <a href="{{ route('profesor.usuarios.index') }}" class="btn btn-outline-primary btn-block" style="transition: background-color 0.3s, transform 0.3s;" onmouseover="this.style.backgroundColor='#007bff'; this.style.color='white'; this.style.transform='scale(1.05');" onmouseout="this.style.backgroundColor='transparent'; this.style.color=''; this.style.transform='scale(1)';">
                                        {{ __('Gestionar Usuario') }}
                                    </a>
                                </div>

                                <!-- Botón Gestionar Curso -->
                                <div class="col-md-4">
                                    <a href="{{ route('profesor.cursos.index') }}" class="btn btn-outline-success btn-block" style="transition: background-color 0.3s, transform 0.3s;" onmouseover="this.style.backgroundColor='#28a745'; this.style.color='white'; this.style.transform='scale(1.05');" onmouseout="this.style.backgroundColor='transparent'; this.style.color=''; this.style.transform='scale(1)';">
                                        {{ __('Gestionar Curso') }}
                                    </a>
                                </div>

                                <!-- Botón Gestionar Chats -->
                                <div class="col-md-4">
                                    <a href="{{ route('profesor.chats.index') }}" class="btn btn-outline-warning btn-block" style="transition: background-color 0.3s, transform 0.3s;" onmouseover="this.style.backgroundColor='#ffc107'; this.style.color='white'; this.style.transform='scale(1.05');" onmouseout="this.style.backgroundColor='transparent'; this.style.color=''; this.style.transform='scale(1)';">
                                        {{ __('Gestionar Chats') }}
                                    </a>
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
