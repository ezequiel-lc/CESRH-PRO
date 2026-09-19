<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('eject_cotizaciones_aprobadas', function (Blueprint $table) {
            $table->id();
            $table->date('fecha_aprobacion');
            $table->string('email_enviado');
            $table->foreignId('servicios_ejecutivos_id')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::table('eject_cotizaciones_aprobadas', function (Blueprint $table) {
            $table->dropForeign(['servicios_ejecutivos_id']);
        });
        Schema::dropIfExists('eject_cotizaciones_aprobadas');
    }
};
