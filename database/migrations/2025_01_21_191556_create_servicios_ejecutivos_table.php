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
        Schema::create('servicios_ejecutivos', function (Blueprint $table) {
            $table->id();
            $table->string('head_asesor');
            $table->string('correo');
            $table->string('telefono');
            $table->string('num_cotizacion');
            $table->date('cotizacion_emitida');
            $table->date('cotizacion_valida_hasta');
            $table->foreignId('informaciones_ejecutivos_id')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::table('servicios_ejecutivos', function (Blueprint $table) {
            $table->dropForeign(['informaciones_ejecutivos_id']);
        });
        Schema::dropIfExists('servicio_ejecutivos');
    }
};

