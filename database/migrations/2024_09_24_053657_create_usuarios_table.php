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
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id('id_usuario');
            $table->string('nombre', 100);
            $table->string('correo', 100)->unique();
            $table->string('contraseña', 100);
            $table->unsignedBigInteger('id_rol')->nullable();
            $table->boolean('estado')->default(1);
            $table->timestamps();

            // Foreign key
            $table->foreign('id_rol')->references('id_rol')->on('roles')->onDelete('set null');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
