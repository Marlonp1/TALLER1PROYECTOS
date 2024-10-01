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
        Schema::create('interacciones', function (Blueprint $table) {
            $table->id('id_interaccion');
            $table->unsignedBigInteger('id_chat');
            $table->text('mensaje');
            $table->timestamp('fecha_envio')->useCurrent();
            $table->enum('remitente', ['usuario', 'chatbot', 'profesor']);
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
        Schema::dropIfExists('interacciones');
    }
};
