@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>{{ __('Chats Disponibles') }}</h2>
    
    <div class="row">
        @foreach($chats as $chat)
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm border-primary">
                    <div class="card-body">
                        <h5 class="card-title">{{ $chat->curso->nombre_curso }}</h5>
                        <p class="card-text">{{ __('Tipo de Pregunta: ') }} {{ $chat->tipo_pregunta }}</p>
                        <button 
                            class="btn btn-outline-danger" 
                            onclick="cerrarChat({{ $chat->id }})"
                        >
                            {{ __('Cerrar Chat') }}
                        </button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <h2 class="mt-5">{{ __('Cursos Disponibles') }}</h2>
    
    <div class="row">
        @foreach($cursos as $curso)
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm border-primary">
                    <div class="card-body">
                        <h5 class="card-title">{{ $curso->nombre_curso }}</h5>
                        <button 
    class="btn btn-outline-primary" 
    onclick="location.href='{{ route('chats.show', $curso->id_curso) }}'" 
    id="btn-chat-{{ $curso->id_curso }}"
>
    {{ __('Iniciar Chat') }}
</button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<script>
function crearChat(cursoId) {
    console.log('Crear chat para curso ID:', cursoId); // Debugging line
    // Aquí va el código para crear el chat usando AJAX
}

function cerrarChat(chatId) {
    // Aquí va la lógica para cerrar el chat usando AJAX
}
</script>

@endsection
