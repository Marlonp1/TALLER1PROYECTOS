@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="text-center text-primary mb-4">{{ __('Chats Disponibles') }}</h2>
    
    <!-- Campo de búsqueda -->
    <div class="mb-4">
        <input 
            type="text" 
            id="searchInput" 
            class="form-control" 
            placeholder="{{ __('Buscar curso...') }}" 
            onkeyup="filterCourses()"
        >
    </div>

    <div class="row" id="chatList">
        @foreach($chats as $chat)
            <div class="col-md-4 mb-4 chat-item">
                <div class="card shadow-lg border-primary">
                    <div class="card-body text-center">
                        <h5 class="card-title text-success">{{ $chat->curso->nombre_curso }}</h5>
                        <p class="card-text text-muted">{{ __('Profesor: ') }} <strong>{{ $chat->curso->profesor->nombre }}</strong></p>
                        <button 
                            class="btn btn-primary mt-3 btn-lg" 
                            style="transition: background-color 0.3s, transform 0.3s;"
                            onclick="location.href='{{ route('chats.show', $chat->id_chat) }}'" 
                            onmouseover="this.style.backgroundColor='#0d6efd'; this.style.transform='scale(1.05';"
                            onmouseout="this.style.backgroundColor='#0d6efd'; this.style.transform='scale(1)';"
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
// Función para filtrar los cursos
function filterCourses() {
    const input = document.getElementById('searchInput');
    const filter = input.value.toLowerCase();
    const chatList = document.getElementById('chatList');
    const chats = chatList.getElementsByClassName('chat-item');

    for (let i = 0; i < chats.length; i++) {
        const title = chats[i].getElementsByClassName('card-title')[0];
        if (title) {
            const txtValue = title.textContent || title.innerText;
            if (txtValue.toLowerCase().indexOf(filter) > -1) {
                chats[i].style.display = ""; // Mostrar el chat
            } else {
                chats[i].style.display = "none"; // Ocultar el chat
            }
        }
    }
}
</script>

@endsection
