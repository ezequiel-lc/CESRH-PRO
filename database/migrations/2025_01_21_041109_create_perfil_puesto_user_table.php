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
        Schema::create('perfil_puesto_user', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('perfiles_puestos_id');
            $table->foreign('perfiles_puestos_id')
                ->references('id')
                ->on( 'perfiles_puestos')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->unsignedBigInteger('users_id');
            $table->foreign('users_id')
                ->references('id')
                ->on( 'users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('status', 45);
            $table->date('fecha_inicio');
            $table->date('fecha_final');
            $table->string('motivo_cambio');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('perfiles_puestos', function (Blueprint $table){
            $table->dropForeign(['perfiles_puestos_id']);
        });
        Schema::table('users', function (Blueprint $table){
            $table->dropForeign(['users_id']);
        });
        Schema::dropIfExists('perfil_puesto_user');
    }

};
