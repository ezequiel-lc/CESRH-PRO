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
        Schema::create('servicios_operativos', function (Blueprint $table) {
            $table->id();
            $table->string('head_asesor');
            $table->string('correo');
            $table->string('telefono');
            $table->string('num_cotizacion');
            $table->date('cotizacion_emitida');
            $table->date('cotizacion_valida_hasta');
            $table->foreignId('head_levantamiento_pedidos_id')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('informaciones_operativos_id')
                ->constrained()
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
        Schema::table('servicioss_operativos', function (Blueprint $table) {
            $table->dropForeign(['head_levantamiento_pedidos_id']);
            $table->dropForeign(['informaciones_operativos_id']);
        });
        Schema::dropIfExists('servicios_operativos');
    }
};
