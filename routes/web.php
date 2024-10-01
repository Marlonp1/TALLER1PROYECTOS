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

// Rutas de roles
Route::middleware(['auth'])->group(function () {
    Route::resource('roles', RolController::class);
    Route::resource('cursos', CursoController::class);

    Route::get('/chats', [ChatController::class, 'index'])->name('chats.index');
    Route::get('chats/{id}', [ChatController::class, 'show'])->name('chats.show');
    Route::post('/chats', [ChatController::class, 'store'])->name('chats.store');

    Route::resource('interacciones', InteraccionController::class);

    // Rutas de preguntas frecuentes
    Route::resource('preguntas-frecuentes', PreguntaFrecuenteController::class);

    // Rutas de respuestas automatizadas
    Route::resource('respuestas', RespuestaAutomatizadaController::class);
});

// Ruta principal (opcional)
Route::get('/', function () {
    return view('welcome'); // Puedes redirigir a una vista específica
});

// Autenticación
Auth::routes();

// Ruta de inicio de sesión
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
