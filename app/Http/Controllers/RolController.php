<?php

namespace App\Http\Controllers;

use App\Models\Rol; // Asegúrate de que el nombre del modelo sea correcto
use Illuminate\Http\Request;
use Illuminate\Routing\Controller; 
class RolController extends Controller
{
    // Muestra todos los roles
    public function index() {
        $roles = Rol::all();
        return view('roles.index', compact('roles'));
    }

    // Muestra el formulario para crear un nuevo rol
    public function create() {
        return view('roles.create');
    }

    // Guarda un nuevo rol
    public function store(Request $request) {
        $request->validate([
            'nombre_rol' => 'required|string|max:50', // Validación básica
        ]);

        $rol = new Rol();
        $rol->nombre_rol = $request->nombre_rol;
        $rol->save();

        return redirect()->route('roles.index')->with('success', 'Rol creado exitosamente.');
    }

    // Muestra el formulario para editar un rol
    public function edit($id) {
        $rol = Rol::findOrFail($id);
        return view('roles.edit', compact('rol'));
    }

    // Actualiza un rol existente
    public function update(Request $request, $id) {
        $request->validate([
            'nombre_rol' => 'required|string|max:50',
        ]);

        $rol = Rol::findOrFail($id);
        $rol->nombre_rol = $request->nombre_rol;
        $rol->save();

        return redirect()->route('roles.index')->with('success', 'Rol actualizado exitosamente.');
    }

    // Elimina un rol
    public function destroy($id) {
        Rol::destroy($id);
        return redirect()->route('roles.index')->with('success', 'Rol eliminado exitosamente.');
    }
}
