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
    Schema::create('respuestas_automatizadas', function (Blueprint $table) {
        $table->id('id_respuesta');
        $table->unsignedBigInteger('id_chat');
        $table->text('respuesta');
        $table->timestamp('fecha_respuesta')->useCurrent();
        $table->timestamps();

        // Foreign key
        $table->foreign('id_chat')->references('id_chat')->on('chats')->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('respuestas_automatizadas');
    }
};
