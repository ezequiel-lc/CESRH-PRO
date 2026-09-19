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
        Schema::create('evaluacion_perfil_puesto', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('evaluaciones_id');
            $table->foreign('evaluaciones_id')
                ->references('id')
                ->on( 'evaluaciones')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->unsignedBigInteger('perfiles_puestos_id');
            $table->foreign('perfiles_puestos_id')
                ->references('id')
                ->on( 'perfiles_puestos')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('evaluacion_perfil_puesto', function (Blueprint $table){
            $table->dropForeign(['evaluaciones_id']);
            $table->dropForeign(['perfiles_puestos_id']);
        });
        Schema::dropIfExists('evaluacion_perfil_puesto');
    }
};
