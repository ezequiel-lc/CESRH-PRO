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
        Schema::create('planes_capacitaciones_escaneados', function (Blueprint $table) {
            $table->id();  // Solo 'id' como campo de identificación
            $table->string('doc_scaneado');

            // Relación con la tabla 'planes_capacitaciones_idplanes_capacitaciones' (aunque no existe la tabla 'planes_capacitaciones')
            $table->unsignedBigInteger('planes_capacitaciones_idplanes_capacitaciones')
                ->nullable() // Si el campo puede ser nulo
                ->constrained() // Aquí puedes especificar la relación a una tabla específica si es necesario
                ->onDelete('cascade'); // Definir acción al eliminar el registro relacionado

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('planes_capacitaciones_escaneados');
    }
};
