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
        Schema::create('asignaciones', function(Blueprint $table) {
            $table->id();
            $table->integer('realizada');
            $table->date('fecha');
            $table->unsignedBigInteger('calificador_id');
            $table->foreign('calificador_id')
                  ->references('id')
                  ->on('users')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
            $table->unsignedBigInteger('calificado_id');
            $table->foreign('calificado_id')
                  ->references('id')
                  ->on('users')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
            $table->unsignedBigInteger('relaciones_id');
            $table->foreign('relaciones_id')
                  ->references('id')
                  ->on('relaciones')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
            $table->unsignedBigInteger('360_encuestas_id');
            $table->foreign('360_encuestas_id')
                  ->references('id')
                  ->on('360_encuestas')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
            // $table->unsignedBigInteger('empresa_sucursal_id')
            //         ->nullable()->after('360_encuestas_id'); // Agrega la columna
            // $table->foreign('empresa_sucursal_id')
            //         ->references('id')->on('empresa_sucursals')
            //         ->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('asignaciones', function (Blueprint $table) {
            $table->dropForeign(['calificador_id']);
            $table->dropForeign(['calificado_id']);
            $table->dropForeign(['relaciones_id']);
            $table->dropForeign(['360_encuestas_id']);
            $table->dropForeign(['empresa_sucursal_id']);
            $table->dropColumn('empresa_sucursal_id');
        });
        Schema::dropIfExists('asignaciones');
    }
};