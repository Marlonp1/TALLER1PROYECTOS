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
    Schema::create('cursos', function (Blueprint $table) {
        $table->id('id_curso');
        $table->string('nombre_curso', 100);
        $table->unsignedBigInteger('id_profesor');
        $table->timestamps();

        // Foreign key
        $table->foreign('id_profesor')->references('id_usuario')->on('usuarios')->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cursos');
    }
};
