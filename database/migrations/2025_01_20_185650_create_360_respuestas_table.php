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
        Schema::create('360_respuestas', function (Blueprint $table) {
            $table->id();
            $table->text('texto');
            $table->tinyInteger('puntuacion');
            $table->unsignedBigInteger('preguntas_id');
            $table->foreign('preguntas_id')->references('id')->on('preguntas')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('empresa_id');
            $table->foreign('empresa_id')
                ->references('id')
                ->on('empresas')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->unsignedBigInteger('sucursal_id');
            $table->foreign('sucursal_id')
                ->references('id')
                ->on('sucursales')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->timestamps();
        });

        //
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('360_respuestas', function (Blueprint $table) {
            $table->dropForeign(['preguntas_id']);
            $table->dropForeign(['empresa_id']);
            $table->dropForeign(['sucursal_id']);
        });
        Schema::dropIfExists('360_respuestas');
    }
};
