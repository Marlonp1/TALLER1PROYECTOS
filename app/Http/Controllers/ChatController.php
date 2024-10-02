<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\Curso;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ChatController extends Controller
{
    // Muestra todos los chats y los cursos disponibles
    public function index()
    {
        
        $cursos = Curso::all(); // Obtener todos los cursos disponibles
        $chats = Chat::with('curso')->get();

        return view('chats.index', compact('chats', 'cursos')); // Pasar ambos a la vista
    }

    // Crea un nuevo chat
    public function store(Request $request)
    {
        $request->validate([
            'id_curso' => 'required|integer',
            'tipo_pregunta' => 'required|string',
        ]);

        // Crear un nuevo chat
        try {
            $chat = new Chat();
            $chat->id_curso = $request->id_curso; // Asignar el id_curso recibido
            $chat->tipo_pregunta = $request->tipo_pregunta;
            $chat->estado_chat = 'activo'; // Estado inicial
            $chat->fecha_inicio = now(); // Asignar fecha actual
            $chat->save();

            return response()->json(['success' => true, 'chat' => $chat]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al crear el chat: ' . $e->getMessage()], 500);
        }
    }

    // Cierra un chat
    public function close($id)
    {
        $chat = Chat::findOrFail($id);
        $chat->estado_chat = 'cerrado';
        $chat->fecha_cierre = now();
        $chat->save();

        return redirect()->route('chats.index')->with('success', 'Chat cerrado.');
    }
    public function show($id)
{
    // Obtener el chat por ID
    $chat = Chat::with('curso')->findOrFail($id);
    return view('chats.show', compact('chat'));
}
}
