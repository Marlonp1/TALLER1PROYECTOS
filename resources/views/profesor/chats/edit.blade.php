<!-- resources/views/profesor/chats/edit.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Chat</h1>
    <form action="{{ route('profesor.chats.update', $Aquí te muestro cómo continuar con la vista de **Editar Chat** y cómo organizar el sistema de archivos.

### c. **Edit (editar)**
```blade
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
            <select name="curso_id" class="form-control" required>
                @foreach($cursos as $curso)
                    <option value="{{ $curso->id }}" {{ $curso->id == $chat->curso_id ? 'selected' : '' }}>
                        {{ $curso->nombre }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="tipo_pregunta">Tipo de Pregunta</label>
            <input type="text" class="form-control" name="tipo_pregunta" value="{{ $chat->tipo_pregunta }}" required>
        </div>
        <button type="submit" class="btn btn-warning">Actualizar</button>
    </form>
</div>
@endsection
