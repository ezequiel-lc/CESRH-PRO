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
        Schema::create('perfiles_puestos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('empresa_id');
            $table->foreign('empresa_id')
                ->references('id')
                ->on( 'empresas')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->unsignedBigInteger('sucursal_id');
            $table->foreign('sucursal_id')
                ->references('id')
                ->on( 'sucursales')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('nombre_puesto', 45);
            $table->string('area', 45);
            $table->string('proceso', 45);
            $table->string('mision', 2000);
            $table->string('puesto_reporta', 45);
            $table->string('puestos_que_le_reportan', 45);
            $table->string('suplencia', 45);
            $table->string('rango_toma_desicones', 45);
            $table->string('desiciones_directas', 2000);
            $table->string('rango_edad_desable', 45);
            $table->string('sexo_preferente', 45);
            $table->string('estado_civil_deseable', 45);
            $table->string('escolaridad');
            $table->string('idioma_requerido');
            $table->string('experiencia_requerida');
            $table->string('nivel_riesgo_fisico', 45);
            $table->string('elaboro_nombre');
            $table->string('elaboro_puesto');
            $table->string('reviso_nombre');
            $table->string('reviso_puesto');
            $table->string('autorizo_nombre');
            $table->string('autorizo_puesto');
            $table->string('status', 45);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('empresa', function (Blueprint $table){
            $table->dropForeign(['empresa_id']);
        });
        Schema::table('sucursal', function (Blueprint $table){
            $table->dropForeign(['sucursal_id']);
        });
        Schema::dropIfExists('perfiles_puestos');
    }
};
