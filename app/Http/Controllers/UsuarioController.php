<?php
namespace App\Http\Controllers;

use App\Models\User; // Importa el modelo de Usuario
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller; 
class UsuarioController extends Controller
{
    // Muestra la lista de usuarios
    public function index() {
        $usuarios = User::all();
        return view('usuarios.index', compact('usuarios'));
    }

    // Crea un nuevo usuario
    public function create() {
        return view('usuarios.create');
    }

    // Guarda un nuevo usuario
    public function store(Request $request) {
        $usuario = new User();
        $usuario->nombre = $request->nombre;
        $usuario->correo = $request->correo;
        $usuario->contraseña = bcrypt($request->contraseña);
        $usuario->id_rol = $request->id_rol;
        $usuario->estado = $request->estado;
        $usuario->save();

        return redirect()->route('usuarios.index')->with('success', 'Usuario creado con éxito.');
    }

    // Edita un usuario
    public function edit($id) {
        $usuario = User::findOrFail($id);
        return view('usuarios.edit', compact('usuario'));
    }

    // Actualiza un usuario
    public function update(Request $request, $id) {
        $usuario = User::findOrFail($id);
        $usuario->nombre = $request->nombre;
        $usuario->correo = $request->correo;
        if ($request->contraseña) {
            $usuario->contraseña = bcrypt($request->contraseña);
        }
        $usuario->id_rol = $request->id_rol;
        $usuario->estado = $request->estado;
        $usuario->save();

        return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado con éxito.');
    }

    // Elimina un usuario
    public function destroy($id) {
        User::destroy($id);
        return redirect()->route('usuarios.index')->with('success', 'Usuario eliminado con éxito.');
    }
}
