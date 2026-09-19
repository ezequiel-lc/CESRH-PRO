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
        Schema::create('informaciones_especializados', function (Blueprint $table) {
            $table->id();
            $table->string('numero_cotizacion');
            $table->string('servicio');
            $table->string('ubicacion');
            $table->string('puesto');
            $table->decimal('cantidad');
            $table->string('sueldomensual');
            $table->string('comision');
            $table->string('pu_por_vacante');
            $table->string('precio_sin_iva');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('informaciones_especializados');
    }
};
