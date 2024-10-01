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
    Schema::create('preguntas_frecuentes', function (Blueprint $table) {
        $table->id('id_pregunta');
        $table->text('pregunta');
        $table->text('respuesta');
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('preguntas_frecuentes');
    }
};
