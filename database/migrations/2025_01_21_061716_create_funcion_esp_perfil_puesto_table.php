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
        Schema::create('funcion_esp_perfil_puesto', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('funciones_esp_id');
            $table->foreign('funciones_esp_id')
                ->references('id')
                ->on( 'funciones_esp')
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
        // Eliminar claves foráneas de la tabla pivote
        Schema::table('funcion_esp_perfil_puesto', function (Blueprint $table) {
            $table->dropForeign('fk_funciones_esp');
            $table->dropForeign('fk_perfiles_puestos');
        });
        Schema::dropIfExists('funcion_esp_perfil_puesto');
    }
};
