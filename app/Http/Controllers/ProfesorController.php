<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Curso;
use App\Models\Chat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfesorController extends Controller
{
    public function index()
    {
        return view('profesor.index');
    }

    // CRUD para Usuarios
    public function usuariosIndex()
    {
        $usuarios = User::all();
        return view('profesor.usuarios.index', compact('usuarios'));
    }

    public function usuariosCreate()
    {
        return view('profesor.usuarios.create');
    }

    public function usuariosStore(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'correo' => 'required|string|email|max:100|unique:usuarios,correo',
            'contraseña' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'nombre' => $request->nombre,
            'correo' => $request->correo,
            'contraseña' => bcrypt($request->contraseña),
            'id_rol' => 2, // Asignar rol de profesor
            'estado' => 1, // Activar usuario por defecto
        ]);

        return redirect()->route('profesor.usuarios.index')->with('success', 'Usuario creado exitosamente.');
    }

    public function usuariosEdit(User $usuario)
    {
        return view('profesor.usuarios.edit', compact('usuario'));
    }

    public function usuariosUpdate(Request $request, User $usuario)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'correo' => 'required|string|email|max:100|unique:usuarios,correo,' . $usuario->id_usuario,
            'contraseña' => 'nullable|string|min:8|confirmed',
        ]);

        $usuario->update($request->all());

        return redirect()->route('profesor.usuarios.index')->with('success', 'Usuario actualizado exitosamente.');
    }

    public function usuariosDestroy(User $usuario)
    {
        $usuario->delete();
        return redirect()->route('profesor.usuarios.index')->with('success', 'Usuario eliminado exitosamente.');
    }

    // CRUD para Cursos
    public function cursosIndex()
    {
        $cursos = Curso::all();
        return view('profesor.cursos.index', compact('cursos'));
    }

    public function cursosCreate()
    {
        return view('profesor.cursos.create');
    }

    public function cursosStore(Request $request)
    {
        $request->validate([
            'nombre_curso' => 'required|string|max:100',
        ]);

        Curso::create($request->all());
        return redirect()->route('profesor.cursos.index')->with('success', 'Curso creado exitosamente.');
    }

    public function cursosEdit(Curso $curso)
    {
        return view('profesor.cursos.edit', compact('curso'));
    }

    public function cursosUpdate(Request $request, Curso $curso)
    {
        $request->validate([
            'nombre_curso' => 'required|string|max:100',
        ]);

        $curso->update($request->all());
        return redirect()->route('profesor.cursos.index')->with('success', 'Curso actualizado exitosamente.');
    }

    public function cursosDestroy(Curso $curso)
    {
        $curso->delete();
        return redirect()->route('profesor.cursos.index')->with('success', 'Curso eliminado exitosamente.');
    }

    // CRUD para Chats
    public function chatsIndex()
    {
        $chats = Chat::all();
        return view('profesor.chats.index', compact('chats'));
    }

    public function chatsCreate()
    {
        return view('profesor.chats.create');
    }

    public function chatsStore(Request $request)
    {
        $request->validate([
            'tipo_pregunta' => 'required|string|max:100',
        ]);

        Chat::create($request->all());
        return redirect()->route('profesor.chats.index')->with('success', 'Chat creado exitosamente.');
    }

    public function chatsEdit(Chat $chat)
    {
        return view('profesor.chats.edit', compact('chat'));
    }

    public function chatsUpdate(Request $request, Chat $chat)
    {
        $request->validate([
            'tipo_pregunta' => 'required|string|max:100',
        ]);

        $chat->update($request->all());
        return redirect()->route('profesor.chats.index')->with('success', 'Chat actualizado exitosamente.');
    }

    public function chatsDestroy(Chat $chat)
    {
        $chat->delete();
        return redirect()->route('profesor.chats.index')->with('success', 'Chat eliminado exitosamente.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/login')->with('success', 'Sesión cerrada exitosamente.');
    }
}
