@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Chats</h1>
    <a href="{{ route('profesor.chats.create') }}" class="btn btn-primary">Crear Chat</a>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Curso</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($chats as $chat)
            <tr>
                <td>{{ $chat->id_chat }}</td>
                <td>{{ $chat->curso ? $chat->curso->nombre_curso : 'Sin Curso' }}</td> <!-- Mostrar el nombre del curso -->
                <td>{{ $chat->estado_chat }}</td>
                <td>
                    <a href="{{ route('profesor.chats.edit', $chat->id_chat) }}" class="btn btn-warning">Editar</a>
                    <form action="{{ route('profesor.chats.destroy', $chat->id_chat) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
