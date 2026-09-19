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
        Schema::create('relacion_externa_perfil_puesto', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('relaciones_externas_id');
            $table->foreign('relaciones_externas_id')
                ->references('id')
                ->on( 'relaciones_externas')
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
        Schema::table('relacion_externa_perfil_puesto', function (Blueprint $table){
            $table->dropForeign(['relaciones_externas_id']);
            $table->dropForeign(['perfiles_puestos_id']);
        });
        Schema::dropIfExists('relacion_externa_perfil_puesto');
    }
};
