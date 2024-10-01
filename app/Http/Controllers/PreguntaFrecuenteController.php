<?php

namespace App\Http\Controllers;

use App\Models\PreguntaFrecuente;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller; 
class PreguntaFrecuenteController extends Controller
{
    // Muestra todas las preguntas frecuentes
    public function index() {
        $preguntas = PreguntaFrecuente::all();
        return view('preguntasfrecuentes.index', compact('preguntas'));
    }

    // Crea una nueva pregunta frecuente
    public function create() {
        return view('preguntasfrecuentes.create');
    }

    // Guarda una nueva pregunta frecuente
    public function store(Request $request) {
        $pregunta = new PreguntaFrecuente();
        $pregunta->pregunta = $request->pregunta;
        $pregunta->respuesta = $request->respuesta;
        $pregunta->save();

        return redirect()->route('preguntasfrecuentes.index')->with('success', 'Pregunta frecuente creada.');
    }

    // Elimina una pregunta frecuente
    public function destroy($id) {
        PreguntaFrecuente::destroy($id);
        return redirect()->route('preguntasfrecuentes.index')->with('success', 'Pregunta frecuente eliminada.');
    }
}
