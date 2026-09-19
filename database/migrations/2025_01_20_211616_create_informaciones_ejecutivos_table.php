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
        Schema::create('informaciones_ejecutivos', function (Blueprint $table) {
            $table->id();
            $table->string('numeroCotizacion');
            $table->string('servicio');
            $table->string('ubicacion');
            $table->string('puesto');
            $table->string('cantidad');
            $table->string('sueldoMensual');
            $table->string('comision');
            $table->string('puPorVacante');
            $table->string('puSinIva');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('informaciones_head_ejecutivos');
    }
};
