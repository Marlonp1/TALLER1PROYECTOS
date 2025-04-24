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
    Schema::table('quizz_results', function (Blueprint $table) {
        $table->string('difficulty')->nullable();
        $table->integer('duration')->nullable(); // duración en segundos
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('quizz_results', function (Blueprint $table) {
            //
        });
    }
};
