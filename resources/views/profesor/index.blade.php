<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página del Profesor</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <h1>Bienvenido, Profesor</h1>
    <p>Esta es la página principal para los usuarios con rol de profesor.</p>

    <h2>Gestión de Usuarios</h2>
    <ul>
        <li><a href="{{ route('profesor.usuarios.index') }}">Ver Usuarios</a></li>
        <li><a href="{{ route('profesor.usuarios.create') }}">Agregar Usuario</a></li>
    </ul>

    <h2>Gestión de Cursos</h2>
    <ul>
        <li><a href="{{ route('profesor.cursos.index') }}">Ver Cursos</a></li>
        <li><a href="{{ route('profesor.cursos.create') }}">Agregar Curso</a></li>
    </ul>

    <h2>Gestión de Chats</h2>
    <ul>
        <li><a href="{{ route('profesor.chats.index') }}">Ver Chats</a></li>
        <li><a href="{{ route('profesor.chats.create') }}">Agregar Chat</a></li>
    </ul>

    <form action="{{ route('profesor.logout') }}" method="POST" style="margin-top: 20px;">
        @csrf
        <button type="submit">Cerrar Sesión</button>
    </form>
</body>
</html>
