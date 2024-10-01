<!-- resources/views/profesor/cursos/create.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Crear Curso</h1>
    <form action="{{ route('profesor.cursos.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nombre">Nombre del Curso</label>
            <input type="text" class="form-control" name="nombre" required>
        </div>
        <button type="submit" class="btn btn-success">Guardar</button>
    </form>
</div>
@endsection
