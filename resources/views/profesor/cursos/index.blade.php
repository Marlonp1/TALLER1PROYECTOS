@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Cursos</h1>
    <a href="{{ route('profesor.cursos.create') }}" class="btn btn-primary mb-3">Crear Curso</a>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cursos as $curso)
            <tr>
                <td>{{ $curso->id_curso }}</td> <!-- Cambiar id a id_curso -->
                <td>{{ $curso->nombre_curso }}</td> <!-- Cambiar nombre a nombre_curso -->
                <td>
                    <a href="{{ route('profesor.cursos.edit', $curso->id_curso) }}" class="btn btn-warning">Editar</a> <!-- Cambiar id a id_curso -->
                    <form action="{{ route('profesor.cursos.destroy', $curso->id_curso) }}" method="POST" style="display:inline;">
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
