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
    Schema::create('chats', function (Blueprint $table) {
        $table->id('id_chat');
        $table->unsignedBigInteger('id_usuario');
        $table->unsignedBigInteger('id_curso');
        $table->enum('estado_chat', ['activo', 'cerrado'])->default('activo');
        $table->timestamp('fecha_inicio')->useCurrent();
        $table->timestamp('fecha_cierre')->nullable();
        $table->enum('tipo_pregunta', ['frecuente', 'no frecuente']);
        $table->timestamps();

        // Foreign key
        $table->foreign('id_usuario')->references('id_usuario')->on('usuarios')->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chats');
    }
};
