<?php

namespace App\Http\Controllers;

use App\Models\Interaccion;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller; 
class InteraccionController extends Controller
{
    // Muestra todas las interacciones
    public function index() {
        $interacciones = Interaccion::all();
        return view('interacciones.index', compact('interacciones'));
    }

    // Guarda una nueva interacción
    public function store(Request $request) {
        $interaccion = new Interaccion();
        $interaccion->id_chat = $request->id_chat;
        $interaccion->id_respuesta_automatizada = $request->id_respuesta_automatizada;
        $interaccion->mensaje = $request->mensaje;
        $interaccion->save();

        return redirect()->route('interacciones.index')->with('success', 'Interacción guardada.');
    }
}
