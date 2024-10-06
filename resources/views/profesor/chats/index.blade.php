@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4 text-primary">{{ __('Chats') }}</h1>
    <div class="text-end mb-3">
        <a href="{{ route('profesor.chats.create') }}" class="btn btn-primary">{{ __('Crear Chat') }}</a>
    </div>
    <table class="table table-striped table-bordered">
        <thead class="table-light">
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
                <td>{{ $chat->curso ? $chat->curso->nombre_curso : 'Sin Curso' }}</td>
                <td>
                    <span class="badge {{ $chat->estado_chat == 'Activo' ? 'bg-success' : 'bg-danger' }}">
                        {{ $chat->estado_chat }}
                    </span>
                </td>
                <td>
                    <a href="{{ route('profesor.chats.edit', $chat->id_chat) }}" class="btn btn-warning">{{ __('Editar') }}</a>
                    <form action="{{ route('profesor.chats.destroy', $chat->id_chat) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar este chat?');">{{ __('Eliminar') }}</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<style>
    .table-striped tbody tr:nth-of-type(odd) {
        background-color: #f8f9fa; /* Color de fondo alterno */
    }
    
    .table-striped tbody tr:hover {
        background-color: #e2e6ea; /* Color al pasar el mouse */
    }

    .btn {
        transition: background-color 0.3s, transform 0.3s;
    }

    .btn:hover {
        transform: scale(1.05);
    }
</style>
@endsection
