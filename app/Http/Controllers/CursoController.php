<?php
namespace App\Http\Controllers;

use App\Models\Curso;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller; 
class CursoController extends Controller
{
    // Muestra la lista de cursos
    public function index() {
        $cursos = Curso::with('profesor')->get(); // Cargar la relación
        return view('cursos.index', compact('cursos'));
    }
    

    // Crea un nuevo curso
    public function create() {
        return view('cursos.create');
    }

    // Guarda un nuevo curso
    public function store(Request $request) {
        $curso = new Curso();
        $curso->nombre_curso = $request->nombre_curso;
        $curso->id_profesor = $request->id_profesor;
        $curso->save();

        return redirect()->route('cursos.index')->with('success', 'Curso creado.');
    }

    // Elimina un curso
    public function destroy($id) {
        Curso::destroy($id);
        return redirect()->route('cursos.index')->with('success', 'Curso eliminado.');
    }
    public function show($id) {
        $curso = Curso::findOrFail($id);
        return view('cursos.show', compact('curso'));
    }
    
}
