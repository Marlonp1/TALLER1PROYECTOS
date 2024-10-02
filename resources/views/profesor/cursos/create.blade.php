@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Crear Curso</h1>

    <form action="{{ route('profesor.cursos.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nombre_curso" class="form-label">Nombre del Curso</label>
            <input type="text" name="nombre_curso" id="nombre_curso" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea name="descripcion" id="descripcion" class="form-control"></textarea>
        </div>
        <input type="hidden" name="id_profesor" value="{{ auth()->user()->id_usuario }}"> <!-- O el ID correcto -->
        <button type="submit" class="btn btn-primary">Crear Curso</button>
    </form>
</div>
@endsection
