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
        Schema::create('training_informaciones', function (Blueprint $table) {
            $table->id();
            $table->string('id_servicio');
            $table->string('nombre');
            $table->string('modalidad');
            $table->string('ubicacion');
            $table->string('curso');
            $table->integer('duracionTotalHoras');
            $table->integer('numSesiones');
            $table->integer('cupoMaxPerson');
            $table->integer('grupos');
            $table->decimal('precioPorGrupo');
            $table->decimal('descuentoEspecial');
            $table->decimal('precioConDescuento');
            $table->decimal('precioSinIVa');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('training_informaciones');
    }
};
