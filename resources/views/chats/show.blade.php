<!-- resources/views/chats/show.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>{{ __('Chat con el Chatbot') }}</h2>
    <div class="card shadow-sm border-primary">
        <div class="card-body">
            <h5 class="card-title">{{ $chat->curso->nombre_curso }}</h5>
            <div id="messages" style="height: 300px; overflow-y: scroll;">
                <!-- Aquí se mostrarán los mensajes -->
            </div>
            <form id="chat-form" onsubmit="return sendMessage(event);">
                <div class="input-group mt-3">
                    <input type="text" id="message" class="form-control" placeholder="{{ __('Escribe tu mensaje...') }}" required>
                    <button class="btn btn-primary" type="submit">{{ __('Enviar') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function sendMessage(event) {
    event.preventDefault();
    const message = document.getElementById('message').value;

    // Aquí se puede agregar la lógica para enviar el mensaje al backend
    console.log('Mensaje enviado:', message);

    // Actualizar la interfaz (puedes usar AJAX para enviar el mensaje al backend)
    const messagesDiv = document.getElementById('messages');
    messagesDiv.innerHTML += '<div>User: ' + message + '</div>';
    
    // Limpiar el campo de entrada
    document.getElementById('message').value = '';

    // Simular respuesta del chatbot
    setTimeout(() => {
        messagesDiv.innerHTML += '<div>Chatbot: ' + 'Esta es una respuesta simulada.' + '</div>';
        messagesDiv.scrollTop = messagesDiv.scrollHeight; // Desplazar hacia abajo
    }, 1000);
}
</script>

@endsection
