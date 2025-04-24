<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('resultados', function (Blueprint $table) {
            $table->id('id_resultado');
            $table->unsignedBigInteger('id_usuario');
            $table->integer('puntaje');
            $table->string('dificultad'); // Dificultad: fácil, intermedio, difícil
            $table->integer('duracion'); // Duración en segundos
            $table->timestamps();
    
            // Definir la clave foránea para la relación con la tabla 'usuarios'
            $table->foreign('id_usuario')->references('id_usuario')->on('usuarios')->onDelete('cascade');
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resultados');
    }
};
