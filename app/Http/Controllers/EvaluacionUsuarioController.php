<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EvaluacionUsuario;
use Illuminate\Support\Facades\Auth;

class EvaluacionUsuarioController extends Controller
{
    public function guardar(Request $request)
    {
        $request->validate([
            'id_chat' => 'required|integer',
            'seleccionado' => 'required|boolean',
        ]);

        $usuarioId = Auth::user()->id_usuario;

        // Guardar o actualizar registro
        $evaluacion = EvaluacionUsuario::updateOrCreate(
            [
                'id_usuario' => $usuarioId,
                'id_chat' => $request->id_chat,
            ],
            [
                'seleccionado' => $request->seleccionado,
                'marcado_en' => now(),
            ]
        );

        return response()->json(['success' => true, 'seleccionado' => $evaluacion->seleccionado]);
    }
}
