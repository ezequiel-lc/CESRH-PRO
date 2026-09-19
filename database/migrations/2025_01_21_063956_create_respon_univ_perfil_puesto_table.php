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
        Schema::create('respon_univ_perfil_puesto', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('respons_univ_id');
            $table->foreign('respons_univ_id')
                ->references('id')
                ->on( 'respons_univ')
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
        Schema::table('respon_univ_perfil_puesto', function (Blueprint $table){
            $table->dropForeign(['respons_univ']);
            $table->dropForeign(['perfiles_puestos']);
        });
        Schema::dropIfExists('respon_univ_perfil_puesto');
    }
};
