@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Crear Chat</h1>

    <form action="{{ route('profesor.chats.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="id_usuario" class="form-label">Usuario</label>
            <select name="id_usuario" id="id_usuario" class="form-select" required>
                @foreach($usuarios as $usuario)
                    <option value="{{ $usuario->id_usuario }}">{{ $usuario->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="id_curso" class="form-label">Curso</label>
            <select name="id_curso" id="id_curso" class="form-select" required>
                @foreach($cursos as $curso)
                    <option value="{{ $curso->id_curso }}">{{ $curso->nombre_curso }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Crear Chat</button>
    </form>
</div>
@endsection
