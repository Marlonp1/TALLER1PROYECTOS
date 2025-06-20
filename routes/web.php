<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\InteraccionController;
use App\Http\Controllers\PreguntaFrecuenteController;
use App\Http\Controllers\RespuestaAutomatizadaController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ProfesorController;
use App\Http\Controllers\QuizzController;
use App\Http\Controllers\ResultadoController;
use App\Http\Controllers\EvaluacionUsuarioController;
// Ruta principal (opcional)
Route::get('/', function () {
    return view('welcome'); // Puedes redirigir a una vista específica
});

// Autenticación
Auth::routes();

// Rutas de resultados
Route::get('/resultados', [ResultadoController::class, 'index'])->name('resultados');

// Ruta de inicio de sesión
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/guardar-resultado', [QuizzController::class, 'guardarResultado'])->name('guardarResultado');

// Rutas de roles
Route::middleware(['auth'])->group(function () {
    Route::resource('roles', RolController::class);
    Route::resource('cursos', CursoController::class);

    // Rutas de resultados
    Route::post('/guardar-resultado', [ResultadoController::class, 'guardarResultado'])->name('guardarResultado');
    Route::get('/resultados', [ResultadoController::class, 'index'])->name('resultados.index');  // Solo esta línea

    // Rutas de chats
    Route::get('/chats', [ChatController::class, 'index'])->name('chats.index');
    Route::get('chats/{id}', [ChatController::class, 'show'])->name('chats.show');
    Route::post('/chats', [ChatController::class, 'store'])->name('chats.store');
    
    // Rutas para el Quizz dentro de un chat específico
    Route::get('/chats/{id}/quizz', [ChatController::class, 'showQuizz'])->name('chats.quizz.show');
    Route::post('/chats/{id}/quizz/start', [ChatController::class, 'startQuizz'])->name('chats.quizz.start');
    Route::post('/chats/{id}/quizz/submit', [ChatController::class, 'submitQuizz'])->name('chats.quizz.submit');
    Route::post('/chats/{chat}/quizz/evaluate', [ChatController::class, 'evaluateQuizz'])->name('chats.quizz.evaluate');

    Route::resource('interacciones', InteraccionController::class);
    Route::resource('preguntas-frecuentes', PreguntaFrecuenteController::class);
    Route::resource('respuestas', RespuestaAutomatizadaController::class);
});

// Rutas para el profesor (middleware con rol de profesor)
Route::middleware(['auth', 'role:2'])->group(function () {
    Route::get('/profesor', [ProfesorController::class, 'index'])->name('profesor.index');

    // Rutas de usuarios
    Route::get('/profesor/usuarios', [ProfesorController::class, 'usuariosIndex'])->name('profesor.usuarios.index');
    Route::get('/profesor/usuarios/create', [ProfesorController::class, 'usuariosCreate'])->name('profesor.usuarios.create');
    Route::post('/profesor/usuarios', [ProfesorController::class, 'usuariosStore'])->name('profesor.usuarios.store');
    Route::get('/profesor/usuarios/{usuario}/edit', [ProfesorController::class, 'usuariosEdit'])->name('profesor.usuarios.edit');
    Route::put('/profesor/usuarios/{usuario}', [ProfesorController::class, 'usuariosUpdate'])->name('profesor.usuarios.update');
    Route::delete('/profesor/usuarios/{usuario}', [ProfesorController::class, 'usuariosDestroy'])->name('profesor.usuarios.destroy');

    // Rutas de cursos
    Route::get('/profesor/cursos', [ProfesorController::class, 'cursosIndex'])->name('profesor.cursos.index');
    Route::get('/profesor/cursos/create', [ProfesorController::class, 'cursosCreate'])->name('profesor.cursos.create');
    Route::post('/profesor/cursos', [ProfesorController::class, 'cursosStore'])->name('profesor.cursos.store');
    Route::get('/profesor/cursos/{curso}/edit', [ProfesorController::class, 'cursosEdit'])->name('profesor.cursos.edit');
    Route::put('/profesor/cursos/{curso}', [ProfesorController::class, 'cursosUpdate'])->name('profesor.cursos.update');
    Route::delete('/profesor/cursos/{curso}', [ProfesorController::class, 'cursosDestroy'])->name('profesor.cursos.destroy');

    // Rutas de chats
    Route::get('/profesor/chats', [ProfesorController::class, 'chatsIndex'])->name('profesor.chats.index');
    Route::get('/profesor/chats/create', [ProfesorController::class, 'chatsCreate'])->name('profesor.chats.create');
    Route::post('/profesor/chats', [ProfesorController::class, 'chatsStore'])->name('profesor.chats.store');
    Route::get('/profesor/chats/{chat}/edit', [ProfesorController::class, 'chatsEdit'])->name('profesor.chats.edit');
    Route::put('/profesor/chats/{chat}', [ProfesorController::class, 'chatsUpdate'])->name('profesor.chats.update');
    Route::delete('/profesor/chats/{chat}', [ProfesorController::class, 'chatsDestroy'])->name('profesor.chats.destroy');

    // Opción de desloguearse
    Route::post('/profesor/logout', [ProfesorController::class, 'logout'])->name('profesor.logout');
Route::post('/evaluacion/guardar', [EvaluacionUsuarioController::class, 'guardar'])->name('evaluacion.guardar');

});
