@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Curso</h1>
    <form action="{{ route('profesor.cursos.update', $curso->id_curso) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="nombre">Nombre del Curso</label>
            <input type="text" class="form-control" name="nombre" value="{{ $curso->nombre_curso }}" required> <!-- Cambiar a nombre_curso -->
        </div>
        <button type="submit" class="btn btn-warning">Actualizar</button>
    </form>
</div>
@endsection
