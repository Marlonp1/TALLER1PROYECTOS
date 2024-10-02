<!-- resources/views/profesor/chats/edit.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Chat</h1>
    <form action="{{ route('profesor.chats.update', $chat->id_chat) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="curso_id">Curso</label>
            <select name="id_curso" class="form-control" required>
                @foreach($cursos as $curso)
                    <option value="{{ $curso->id_curso }}" {{ $curso->id_curso == $chat->id_curso ? 'selected' : '' }}>
                        {{ $curso->nombre_curso }}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-warning">Actualizar</button>
    </form>
</div>
@endsection
