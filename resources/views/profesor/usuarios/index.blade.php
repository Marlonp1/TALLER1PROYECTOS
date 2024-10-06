@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4 text-primary">{{ __('Usuarios') }}</h1>
    <div class="text-end mb-3">
        <a href="{{ route('profesor.usuarios.create') }}" class="btn btn-primary">{{ __('Crear Usuario') }}</a>
    </div>
    <table class="table table-striped table-bordered">
        <thead class="table-light">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($usuarios as $usuario)
            <tr>
                <td>{{ $usuario->id_usuario }}</td>
                <td>{{ $usuario->nombre }}</td>
                <td>{{ $usuario->correo }}</td>
                <td>
                    <a href="{{ route('profesor.usuarios.edit', $usuario->id_usuario) }}" class="btn btn-warning">Editar</a>
                    <form action="{{ route('profesor.usuarios.destroy', $usuario->id_usuario) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar este usuario?');">{{ __('Eliminar') }}</button>
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
