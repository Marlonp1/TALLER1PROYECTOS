<!-- resources/views/profesor/chats/create.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Crear Chat</h1>
    <form action="{{ route('profesor.chats.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="curso_id">Curso</label>
            <select name="curso_id" class="form-control" required>
                @foreach($cursos as $curso)
                    <option value="{{ $curso->id }}">{{ $curso->nombre }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="tipo_pregunta">Tipo de Pregunta</label>
            <input type="text" class="form-control" name="tipo_pregunta" required>
        </div>
        <button type="submit" class="btn btn-success">Guardar</button>
    </form>
</div>
@endsection
