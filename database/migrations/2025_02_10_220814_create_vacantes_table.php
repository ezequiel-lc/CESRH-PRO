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
        Schema::create('vacantes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_vacante');
            $table->string('tipo');
            $table->string('ubicacion');
            $table->decimal('salario');
            $table->string('cuando_requiere');
            $table->string('perfil_puesto');
            $table->unsignedBigInteger('head_levantamiento_pedidos_id');
            $table->foreign('head_levantamiento_pedidos_id')
                ->references('id')
                ->on('head_levantamiento_pedidos') 
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
        Schema::table('vacantes', function (Blueprint $table) {
            $table->dropColumn(['head_levantamiento_pedidos_id']);
        });
        Schema::dropIfExists('vacantes');
    }
};
