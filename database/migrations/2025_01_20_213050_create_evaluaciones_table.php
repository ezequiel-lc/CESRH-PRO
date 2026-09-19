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
        Schema::create('evaluaciones', function (Blueprint $table) {
            $table->id();
            $table->date('fecha_evaluacion');
            $table->string('criterio');
            $table->string('calificacion_desempeno', 45);
            $table->string('comentarios', 2000);
            $table->string('recomendaciones', 2000);
            $table->string('tiempo_puesto_actual', 45);
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
     * 
     * @return void
     */
    public function down()
    {
        Schema::table('evaluciones', function (Blueprint $table){
            $table->dropForeign(['users_id']);
        });
        Schema::dropIfExists('evaluaciones');
    }
};
