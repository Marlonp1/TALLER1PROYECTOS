<!-- resources/views/profesor/usuarios/create.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Crear Usuario</h1>
    <form action="{{ route('profesor.usuarios.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Nombre</label>
            <input type="text" class="form-control" name="name" required>
        </div>
        <div class="form-group">
            <label for="correo">Correo</label>
            <input type="email" class="form-control" name="correo" required>
        </div>
        <div class="form-group">
            <label for="contraseña">Contraseña</label>
            <input type="password" class="form-control" name="contraseña" required>
        </div>
        <button type="submit" class="btn btn-success">Guardar</button>
    </form>
</div>
@endsection
