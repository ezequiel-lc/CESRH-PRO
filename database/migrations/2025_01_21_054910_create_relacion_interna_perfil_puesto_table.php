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
        Schema::create('relacion_interna_perfil_puesto', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('relaciones_internas_id');
            $table->foreign('relaciones_internas_id')
                ->references('id')
                ->on( 'relaciones_internas')
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
        Schema::table('perfiles_puestos', function (Blueprint $table){
            $table->dropForeign(['perfiles_puestos_id']);
        });
        Schema::table('relaciones_internas', function (Blueprint $table){
            $table->dropForeign(['relaciones_internas_id']);
        });
        Schema::dropIfExists('relacion_interna_perfil_puesto');
    }
};
