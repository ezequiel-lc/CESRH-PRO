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
        Schema::create('disponibilidad_perfil_puesto', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('disponibilidades_id');
            $table->foreign('disponibilidades_id')
                ->references('id')
                ->on( 'disponibilidades')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->unsignedBigInteger('perfiles_puestos_id');
            $table->foreign('perfiles_puestos_id')
                ->references('id')
                ->on( 'perfiles_puestos')
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
        Schema::table('disponibilidad_perfil_puesto', function (Blueprint $table){
            $table->dropForeign(['disponibilidades_id']);
            $table->dropForeign(['perfiles_puestos_id']);
        });
        Schema::dropIfExists('disponibilidad_perfil_puesto');
    }
};
