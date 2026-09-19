<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('nom035_informaciones', function (Blueprint $table) {
            $table->id();
            $table->string('evaluacion'); 
            $table->string('capacitacion_nom');
            $table->decimal('cantida_capacitacion')->nullable();
            $table->string('informe_general');
            $table->decimal('cantidad_informe')->nullable();
            $table->string('plan_accion');
            $table->string('taller_prevencion');
            $table->decimal('cantidad_tallere')->nullable();
            $table->decimal('cantidad_grupos')->nullable();
            $table->string('asesoria_personalizada');
            $table->decimal('cantidad_asesoria')->nullable();
            $table->string('atencion_psicologica');
            $table->decimal('cantidad_atencion')->nullable();
            $table->string('participantes')->nullable();
            $table->string('centro_trabajo')->nullable();
            $table->string('primera_vez')->nullable();
            $table->string('integral_software')->nullable();
            $table->string('inspeccion')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('nom035_informaciones');
    }
};
