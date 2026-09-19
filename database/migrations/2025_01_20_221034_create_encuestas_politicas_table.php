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
        Schema::create('encuestas_politicas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('politicas_id');
            $table->foreign('politicas_id')
                ->references('id')
                ->on('politicas')
                ->onDelete('cascade');
            $table->string('encuestas_Clave');
            $table->unsignedBigInteger('planes_capacitaciones_escaneados_id');
            $table->foreign('planes_capacitaciones_escaneados_id')
                ->references('id')
                ->on('planes_capacitaciones_escaneados')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('encuestas_politicas', function (Blueprint $table) {
            $table->dropForeign(['politicas_id']);
            $table->dropForeign(['planes_capacitaciones_escaneados_id']);
        });
        Schema::dropIfExists('encuestas_politicas');
    }
};
