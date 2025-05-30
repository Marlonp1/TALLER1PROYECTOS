@extends('layouts.app')

@section('content')
<div class="container mt-5" style="background-color: #F5F8FA; border-radius: 12px; padding: 20px;">
    <h2 class="text-center mb-4" style="color:#005A9C; font-weight: bold;">{{ __('Evaluaciones Disponibles') }}</h2>

    <!-- Barra de progreso -->
    <div class="mb-4">
        <label for="progressBar" class="form-label" style="font-weight: bold; color: #1A1A1A;">{{ __('Progreso de Evaluaciones Seleccionadas') }}</label>
        <div class="progress" style="height: 30px;">
            <div id="progressBar" class="progress-bar progress-bar-striped bg-success" role="progressbar" 
                 style="width: 0%; font-size: 16px;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                0%
            </div>
        </div>
    </div>

    <!-- Campo de búsqueda -->
    <div class="mb-4">
        <input 
            type="text" 
            id="searchInput" 
            class="form-control" 
            placeholder="{{ __('Buscar Evaluaciones...') }}" 
            onkeyup="filterCourses()"
            style="font-size: 16px; border: 2px solid #005A9C;"
        >
    </div>

    <!-- Recomendaciones -->
    <div class="mb-5">
        <h4 style="color: #2E8540;">{{ __('Recomendaciones para ti') }}</h4>
        <ul class="list-group" id="recommendedList">
            @foreach($recomendaciones as $recomendacion)
                <li class="list-group-item list-group-item-action" style="cursor:pointer; font-size: 16px;"
                    onclick="verRecurso('{{ $recomendacion->url }}')">
                    📘 {{ $recomendacion->titulo }}
                </li>
            @endforeach
        </ul>
    </div>

    <!-- Lista de evaluaciones (chats) -->
    <div class="row" id="chatList">
        @foreach($chats as $chat)
            <div class="col-md-4 mb-4 chat-item">
                <div class="card shadow-sm border-3" style="border-color:#005A9C; border-radius: 16px;">
                    <div class="card-body text-center" style="background-color: #FFFFFF;">
                        <!-- Checkbox -->
                        <div class="form-check text-start mb-3">
                            <input class="form-check-input course-check" type="checkbox" onchange="updateProgress()" aria-label="Seleccionar evaluación">
                            <label class="form-check-label" style="font-size: 16px; color:#1A1A1A;">
                                {{ __('Marcar Evaluación') }}
                            </label>
                        </div>

                        <h5 class="card-title" style="color: #005A9C; font-weight: bold;">{{ $chat->curso->nombre_curso }}</h5>
                        <p class="card-text" style="color:#333333;">{{ __('Responsable: ') }} <strong>{{ $chat->curso->profesor->nombre }}</strong></p>
                        <button 
                            class="btn mt-3 btn-lg" 
                            style="background-color: #F9DC5C; color: #1A1A1A; border: none; font-weight: bold;"
                            onclick="location.href='{{ route('chats.show', $chat->id_chat) }}'" 
                            onmouseover="this.style.backgroundColor='#ffe066'; this.style.transform='scale(1.05)';"
                            onmouseout="this.style.backgroundColor='#F9DC5C'; this.style.transform='scale(1)';"
                        >
                            {{ __('Iniciar Quizz') }}
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

    updateProgress(); // Actualizar barra al filtrar
}

// Función para abrir recursos recomendados
function verRecurso(url) {
    window.open(url, '_blank');
}

// Función para actualizar la barra de progreso
function updateProgress() {
    const checkboxes = document.querySelectorAll('.course-check');
    const visibleCheckboxes = Array.from(checkboxes).filter(c => c.closest('.chat-item').style.display !== 'none');
    const checkedCount = visibleCheckboxes.filter(cb => cb.checked).length;
    const total = visibleCheckboxes.length;
    const percent = total === 0 ? 0 : Math.round((checkedCount / total) * 100);

    const progressBar = document.getElementById('progressBar');
    progressBar.style.width = percent + '%';
    progressBar.setAttribute('aria-valuenow', percent);
    progressBar.textContent = percent + '%';
}
</script>
@endsection
