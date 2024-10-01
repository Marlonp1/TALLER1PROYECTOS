<?php

namespace App\Http\Controllers;

use App\Models\RespuestasAutomatizadas; // Asegúrate de que este nombre sea correcto
use Illuminate\Http\Request;
use Illuminate\Routing\Controller; 
class RespuestaAutomatizadaController extends Controller
{
    // Muestra las respuestas automatizadas
    public function index() {
        $respuestas = RespuestasAutomatizadas::all(); // Cambia aquí el nombre del modelo
        return view('respuestas.index', compact('respuestas'));
    }

    // Crea una nueva respuesta automatizada
    public function create() {
        return view('respuestas.create');
    }

    // Guarda una nueva respuesta automatizada
    public function store(Request $request) {
        $request->validate([
            'respuesta' => 'required|string', // Validación básica
        ]);

        $respuesta = new RespuestasAutomatizadas(); // Cambia aquí el nombre del modelo
        $respuesta->respuesta = $request->respuesta;
        $respuesta->id_chat = $request->id_chat; // Asegúrate de agregar el id_chat si es necesario
        $respuesta->save();

        return redirect()->route('respuestas.index')->with('success', 'Respuesta automatizada creada.');
    }

    // Elimina una respuesta automatizada
    public function destroy($id) {
        RespuestasAutomatizadas::destroy($id); // Cambia aquí el nombre del modelo
        return redirect()->route('respuestas.index')->with('success', 'Respuesta eliminada.');
    }
}
