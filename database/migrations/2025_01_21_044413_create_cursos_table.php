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
        Schema::create('cursos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('empresa_id');
            $table->foreign('empresa_id')
                ->references('id')
                ->on( 'empresas')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->unsignedBigInteger('sucursal_id');
            $table->foreign('sucursal_id')
                ->references('id')
                ->on( 'sucursales')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('nombre');
            $table->integer('horas');
            $table->string('precio');
            $table->string('tipoestatus', 45);
            $table->unsignedBigInteger('tematicas_id');
            $table->foreign('tematicas_id')
                ->references('id')
                ->on( 'tematicas')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('modalidad');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('empresa', function (Blueprint $table){
            $table->dropForeign(['empresa_id']);
        });
        Schema::table('sucursal', function (Blueprint $table){
            $table->dropForeign(['sucursal_id']);
        });
        Schema::table('cursos', function (Blueprint $table) {
            $table->dropForeign(['tematicas_id']);
        });
        Schema::dropIfExists('cursos');
    }
};
