<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // Modelo Usuario
use App\Models\Curso; // Modelo Curso
use App\Models\Chat; // Modelo Chat

class ProfesorController extends Controller
{
    // Método para mostrar la página principal del profesor
    public function index()
    {
        return view('profesor.index'); // Asegúrate de que la vista exista
    }

    // Método para mostrar la lista de usuarios
    public function usuariosIndex()
    {
        $usuarios = User::all(); // Obtener todos los usuarios
        return view('profesor.usuarios.index', compact('usuarios'));
    }

    // Método para mostrar el formulario de creación de usuarios
    public function usuariosCreate()
    {
        return view('profesor.usuarios.create'); // Vista de creación de usuario
    }

    // Método para almacenar un nuevo usuario
    public function usuariosStore(Request $request)
    {
        // Validar la solicitud
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'correo' => 'required|string|email|max:255|unique:usuarios,correo',
            'contraseña' => 'required|string|min:8',
        ]);

        // Crear un nuevo usuario
        User::create([
            'nombre' => $validatedData['nombre'],
            'correo' => $validatedData['correo'],
            'contraseña' => bcrypt($validatedData['contraseña']),
            'id_rol' => 1, // Ajusta según tu lógica de roles
            'estado' => 1,  // 1 para activo, 0 para inactivo
        ]);

        // Redirigir a la lista de usuarios después de crear
        return redirect()->route('profesor.usuarios.index')->with('status', 'Usuario creado exitosamente.');
    }

    // Método para mostrar el formulario de edición de un usuario
    public function usuariosEdit($id)
    {
        $usuario = User::findOrFail($id); // Obtener el usuario por ID
        return view('profesor.usuarios.edit', compact('usuario')); // Pasar el usuario a la vista
    }

    // Método para actualizar un usuario
    public function usuariosUpdate(Request $request, $usuario)
    {
        // Validación de los datos
        $request->validate([
            'nombre' => 'required|string|max:100',
            'correo' => 'required|string|email|max:100|unique:usuarios,correo,'.$usuario.',id_usuario',
            'contraseña' => 'nullable|string|min:8|confirmed',
        ]);

        // Encontrar y actualizar el usuario
        $usuario = User::findOrFail($usuario);
        $usuario->nombre = $request->nombre;
        $usuario->correo = $request->correo;

        if ($request->filled('contraseña')) {
            $usuario->contraseña = bcrypt($request->contraseña); // Actualiza solo si se proporciona una nueva contraseña
        }

        $usuario->save();

        // Redirigir al índice de usuarios con un mensaje de éxito
        return redirect()->route('profesor.usuarios.index')->with('success', 'Usuario actualizado exitosamente.');
    }

    // Método para eliminar un usuario
    public function usuariosDestroy($usuario)
    {
        $usuario = User::findOrFail($usuario);
        $usuario->delete(); // Elimina el usuario

        // Redirigir al índice de usuarios con un mensaje de éxito
        return redirect()->route('profesor.usuarios.index')->with('success', 'Usuario eliminado exitosamente.');
    }

    // Métodos para gestionar cursos
    public function cursosIndex()
    {
        $cursos = Curso::all(); // Obtiene todos los cursos
        return view('profesor.cursos.index', compact('cursos'));
    }

    public function cursosCreate()
    {
        return view('profesor.cursos.create'); // Vista de creación de curso
    }

    public function cursosStore(Request $request)
    {
        // Validación de los datos
        $request->validate([
            'nombre_curso' => 'required|string|max:100', // Campo correcto
            'id_profesor' => 'required|integer|exists:usuarios,id_usuario', // Asegúrate de que este campo se envíe
            'descripcion' => 'nullable|string|max:255', // Si tienes una descripción
        ]);

        // Creación del curso
        Curso::create([
            'nombre_curso' => $request->nombre_curso, // Cambiado a nombre_curso
            'id_profesor' => $request->id_profesor, // Incluye este campo
            'descripcion' => $request->descripcion, // Agrega la descripción si es necesario
        ]);

        // Redirigir al índice de cursos con un mensaje de éxito
        return redirect()->route('profesor.cursos.index')->with('success', 'Curso creado exitosamente.');
    }

    public function cursosEdit($curso)
    {
        $curso = Curso::findOrFail($curso); // Busca el curso por ID
        return view('profesor.cursos.edit', compact('curso')); // Pasar el curso a la vista
    }

    public function cursosUpdate(Request $request, $curso)
    {
        // Validación de los datos
        $request->validate([
            'nombre' => 'required|string|max:100',
        ]);
    
        // Encontrar y actualizar el curso
        $curso = Curso::findOrFail($curso);
        $curso->update(['nombre_curso' => $request->nombre]); // Solo actualiza el nombre
    
        // Redirigir al índice de cursos con un mensaje de éxito
        return redirect()->route('profesor.cursos.index')->with('success', 'Curso actualizado exitosamente.');
    }
    


    public function cursosDestroy($curso)
    {
        $curso = Curso::findOrFail($curso);
        $curso->delete(); // Elimina el curso

        // Redirigir al índice de cursos con un mensaje de éxito
        return redirect()->route('profesor.cursos.index')->with('success', 'Curso eliminado exitosamente.');
    }

    // Métodos para gestionar chats
    public function chatsIndex()
    {
        $chats = Chat::with('curso')->get(); // Carga la relación curso
        return view('profesor.chats.index', compact('chats'));
    }
    


        public function chatsCreate()
    {
        $cursos = Curso::all(); // Obtener todos los cursos
        $usuarios = User::all(); // Obtener todos los usuarios
        return view('profesor.chats.create', compact('cursos', 'usuarios'));
    }


    public function chatsstore(Request $request)
    {
        // Validación de los datos de entrada
        $request->validate([
            'id_usuario' => 'required|exists:usuarios,id_usuario',
            'id_curso' => 'required|exists:cursos,id_curso',
        ]);
    
        // Crear el nuevo chat
        Chat::create([
            'id_usuario' => $request->id_usuario, // Asegúrate de que esto esté correcto
            'id_curso' => $request->id_curso, // Asegúrate de que esto esté correcto
            'estado_chat' => 'activo', // Valor por defecto para estado_chat
            'tipo_pregunta' => 'frecuente', // Valor por defecto para tipo_pregunta
        ]);
    
        return redirect()->route('profesor.chats.index')->with('success', 'Chat creado exitosamente.');
    }



    public function chatsEdit($chat)
    {
        $chat = Chat::findOrFail($chat); // Busca el chat por ID
        $cursos = Curso::all(); // Carga todos los cursos
        return view('profesor.chats.edit', compact('chat', 'cursos')); // Pasa el chat y los cursos a la vista
    }
    



    public function chatsUpdate(Request $request, $chat)
    {
        // Validación de los datos
        $request->validate([
            'id_curso' => 'required|exists:cursos,id_curso', // Cambia 'mensaje' por 'id_curso'
        ]);
    
        // Encontrar y actualizar el chat
        $chat = Chat::findOrFail($chat);
        $chat->update($request->only('id_curso')); // Cambia 'mensaje' por 'id_curso'
    
        // Redirigir al índice de chats con un mensaje de éxito
        return redirect()->route('profesor.chats.index')->with('success', 'Chat actualizado exitosamente.');
    }
    

    public function chatsDestroy($chat)
    {
        $chat = Chat::findOrFail($chat);
        $chat->delete(); // Elimina el chat

        // Redirigir al índice de chats con un mensaje de éxito
        return redirect()->route('profesor.chats.index')->with('success', 'Chat eliminado exitosamente.');
    }

    // Método para desloguearse
    public function logout()
    {
        auth()->logout();
        return redirect('/'); // Redirigir a la página principal
    }
}
