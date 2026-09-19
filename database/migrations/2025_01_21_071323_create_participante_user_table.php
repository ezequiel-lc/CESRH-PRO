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
        Schema::create('participante_user', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('participantes_id');
            $table->foreign('participantes_id')
                ->references('id')
                ->on( 'participantes')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->unsignedBigInteger('grupocursos_capacitaciones_id');
            $table->foreign('grupocursos_capacitaciones_id')
                ->references('id')
                ->on( 'grupocursos_capacitaciones')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->unsignedBigInteger('users_id');
            $table->foreign('users_id')
                ->references('id')
                ->on( 'users')
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
        Schema::table('participante_user', function (Blueprint $table){
            $table->dropForeign(['participantes_id']);
            $table->dropForeign(['grupocursos_capacitaciones_id']);
            $table->dropForeign(['users_id']);
        });
        Schema::dropIfExists('participante_user');
    }
};
