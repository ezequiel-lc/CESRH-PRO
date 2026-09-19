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
        Schema::create('encuestas_planes_capacitaciones_escaneados', function (Blueprint $table) {

            $table->string('encuestas_Clave');  // Clave de encuesta

            // Relación con la tabla planes_capacitaciones_escaneados
            $table->unsignedBigInteger('planes_capacitaciones_escaneados_id');  // Nombre del campo de la clave foránea
            $table->foreign('planes_capacitaciones_escaneados_id')  // Relación explícita sin 'constrained'
                ->references('id')  // Referencia al campo 'id' de la tabla 'planes_capacitaciones_escaneados'
                ->on('planes_capacitaciones_escaneados')  // Tabla relacionada
                ->onDelete('cascade')  // Acción al eliminar el registro
                ->onUpdate('cascade')  // Acción al actualizar el registro
                ->name('fk_encuestas_planes_capacitaciones_escaneados');  // Nombre corto para la clave foránea

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('encuestas_planes_capacitaciones_escaneados', function (Blueprint $table) {
            $table->dropForeign(['planes_capacitaciones_escaneados_id']);
        });
        Schema::dropIfExists('encuestas_planes_capacitaciones_escaneados');
    }
};
