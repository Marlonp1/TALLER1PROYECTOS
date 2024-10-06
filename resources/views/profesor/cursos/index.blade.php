@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4 text-primary">{{ __('Cursos') }}</h1>
    <div class="text-end mb-3">
        <a href="{{ route('profesor.cursos.create') }}" class="btn btn-primary">{{ __('Crear Curso') }}</a>
    </div>
    <table class="table table-striped table-bordered">
        <thead class="table-light">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cursos as $curso)
            <tr>
                <td>{{ $curso->id_curso }}</td>
                <td>{{ $curso->nombre_curso }}</td>
                <td>
                    <a href="{{ route('profesor.cursos.edit', $curso->id_curso) }}" class="btn btn-warning">{{ __('Editar') }}</a>
                    <form action="{{ route('profesor.cursos.destroy', $curso->id_curso) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar este curso?');">{{ __('Eliminar') }}</button>
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
