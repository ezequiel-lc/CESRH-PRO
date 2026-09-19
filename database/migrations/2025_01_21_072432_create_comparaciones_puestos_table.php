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
        Schema::create('comparaciones_puestos', function (Blueprint $table) {
            $table->id();
            $table->date('fecha_comparacion');
            $table->string('competencias_requeridas');
            $table->string('nivel_actual')->nullable();
            $table->string('nivel_nuevo')->nullable();
            $table->string('diferencia');
            $table->integer('puesto_nuevo');

            // Declarar la columna de la relación
            $table->unsignedBigInteger('perfiles_puestos_id');
            
            // Clave foránea correctamente definida
            $table->foreign('perfiles_puestos_id')
                ->references('id')
                ->on('perfiles_puestos')
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
        Schema::table('comparaciones_puestos', function (Blueprint $table) {
            $table->dropForeign(['perfiles_puestos_id']);
        });

        Schema::dropIfExists('comparaciones_puestos');
    }
};
