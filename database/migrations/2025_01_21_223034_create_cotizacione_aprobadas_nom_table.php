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
        Schema::create('cotizaciones_aprobadas_nom', function (Blueprint $table) {
            $table->id();
            $table->date('fecha_aprobacion');
            $table->string('email_enviado');
            $table->foreignId('nom035_cotizaciones_id')
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
        Schema::table('cotizacione_aprobadas_nom', function (Blueprint $table) {
            $table->dropForeign(['nom035_cotizaciones_id ']);
        });
        Schema::dropIfExists('cotizaciones_aprobadas_nom');
    }
};
