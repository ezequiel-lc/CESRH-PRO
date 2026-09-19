<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('preguntas_bases', function (Blueprint $table) {
            $table->id();
            $table->string('Pregunta'); // Campo obligatorio
            $table->string('Seccion')->nullable(); // Campo agregado y nullable
            $table->string('Categoria')->nullable(); // Campo nullable
            $table->string('Dominio')->nullable(); // Campo nullable
            $table->string('Dimension')->nullable(); // Campo nullable
            $table->tinyInteger('Puntuacion');
            $table->unsignedBigInteger('cuestionarios_id');
            $table->foreign('cuestionarios_id')
                ->references('id')
                ->on('cuestionarios')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('preguntas_bases', function (Blueprint $table) {
            $table->dropForeign(['cuestionarios_id']);
        });
        Schema::dropIfExists('preguntas_bases');
    }
};
