<!-- resources/views/profesor/cursos/index.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Cursos</h1>
    <a href="{{ route('profesor.cursos.create') }}" class="btn btn-primary">Crear Curso</a>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre del Curso</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cursos as $curso)
            <tr>
                <td>{{ $curso->id }}</td>
                <td>{{ $curso->nombre }}</td>
                <td>
                    <a href="{{ route('profesor.cursos.edit', $curso->id) }}" class="btn btn-warning">Editar</a>
                    <form action="{{ route('profesor.cursos.destroy', $curso->id) }}" method="POST" style="display:inline;">
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
