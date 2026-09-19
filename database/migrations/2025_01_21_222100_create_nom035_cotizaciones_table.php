<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('nom035_cotizaciones', function (Blueprint $table) {
            $table->id();
            $table->string('n_cotizaciones');
            $table->date('fecha_validacion');
            $table->date('fecha_cotizacion');
            $table->string('nombre_servicio');
            $table->string('estatus');
            $table->string('servicio');
            $table->string('descripcion');
            $table->decimal('cantidad_trabajadores');
            $table->decimal('precio_unitario');
            $table->decimal('precio_total');
            $table->foreignId('nom035_levpedidos_id')
             ->constrained()
             ->onUpdate('cascade')
             ->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    { 
        Schema::table('nom035_cotizaciones', function (Blueprint $table) {
            $table->dropForeign(['nom035_levpedidos_id']);
        });
       
        Schema::dropIfExists('nom035_cotizaciones');
    }
};
