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
        Schema::create('respuestas', function (Blueprint $table) {
            $table->id(); // Columna id (autoincremental)
            $table->string('ValorRespuesta'); // Valor de la respuesta
            $table->unsignedBigInteger('preguntasbases_id'); // Relación con preguntas_bases
            $table->unsignedBigInteger('dato_trabajadores_id'); // Relación con dato_trabajadores
            $table->timestamps(); // created_at y updated_at

            // Claves foráneas
            $table->foreign('preguntasbases_id')
                  ->references('id')
                  ->on('preguntas_bases')
                  ->onDelete('cascade');

            $table->foreign('dato_trabajadores_id')
                  ->references('id')
                  ->on('dato_trabajadores')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('respuestas', function (Blueprint $table) {
            // Eliminar las claves foráneas
            $table->dropForeign(['preguntasbases_id']);
            $table->dropForeign(['dato_trabajadores_id']);
        });

        // Eliminar la tabla respuestas
        Schema::dropIfExists('respuestas');
    }
};
