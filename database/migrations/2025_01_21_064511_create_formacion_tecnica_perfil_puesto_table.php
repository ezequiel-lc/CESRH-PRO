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
        Schema::create('formacion_tecnica_perfil_puesto', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('formaciones_tecnicas_id');
            $table->foreign('formaciones_tecnicas_id')
                ->references('id')
                ->on( 'formaciones_tecnicas')
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
        Schema::table('formacion_tecnica_perfil_puesto', function (Blueprint $table){
            $table->dropForeign(['formaciones_tecnicas_id']);
            $table->dropForeign(['perfiles_puestos_id']);
        });
        Schema::dropIfExists('formacion_tecnica_perfil_puesto');
    }
};
