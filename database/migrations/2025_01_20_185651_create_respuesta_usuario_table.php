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
        Schema::create('respuestas_usuarios', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('respuesta360_id');
            $table->foreign('respuesta360_id')->references('id')->on('360_respuestas')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('asignaciones_id');
            $table->foreign('asignaciones_id')->references('id')->on('asignaciones')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
        

        //
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('respuestas_usuarios', function (Blueprint $table) {
            $table->dropForeign(['respuestas360_id']);
            $table->dropForeign(['asignaciones_id']);
        });
        Schema::dropIfExists('respuestas_usuarios');


    }
};
