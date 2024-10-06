<!-- resources/views/chats/show.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="text-center text-primary mb-4">{{ __('Chat con el Chatbot') }}</h2>
    <div class="card shadow-sm border-primary">
        <div class="card-body">
            <h5 class="card-title text-success">{{ $chat->curso->nombre_curso }}</h5>
            <div id="messages" style="height: 300px; overflow-y: auto; border: 1px solid #e0e0e0; border-radius: 5px; padding: 10px; background-color: #f9f9f9;">
                <!-- Aquí se mostrarán los mensajes -->
            </div>
            <form id="chat-form" onsubmit="return sendMessage(event);" class="mt-3">
                <div class="input-group">
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
    messagesDiv.innerHTML += '<div class="user-message"><strong>User:</strong> ' + message + '</div>';
    
    // Limpiar el campo de entrada
    document.getElementById('message').value = '';

    // Simular respuesta del chatbot
    setTimeout(() => {
        messagesDiv.innerHTML += '<div class="chatbot-message"><strong>Chatbot:</strong> ' + 'Esta es una respuesta simulada.' + '</div>';
        messagesDiv.scrollTop = messagesDiv.scrollHeight; // Desplazar hacia abajo
    }, 1000);
}

// Estilos para los mensajes
const style = document.createElement('style');
style.innerHTML = `
    .user-message {
        background-color: #d1e7dd;
        padding: 10px;
        border-radius: 5px;
        margin-bottom: 10px;
        text-align: left;
    }
    .chatbot-message {
        background-color: #f0f0f0;
        padding: 10px;
        border-radius: 5px;
        margin-bottom: 10px;
        text-align: left;
    }
`;
document.head.appendChild(style);
</script>

@endsection
