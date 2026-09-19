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
        Schema::create("crm_cursos", function (Blueprint $table) {
            $table->id();
            
            $table->string('nombre_curso');
            $table->string('modalidad');
            $table->string('participantes');
            $table->string('grupos');
            $table->string('puestos_participantes');
            $table->string('experiencia');
            $table->string('cual')->nullable();
            $table->string('objetivo_curso');
            $table->date('fecha_tentativa');
            $table->decimal('presupuesto');
            $table->unsignedBigInteger('training_levantamientos_id')
                ->references('id')
                ->on('training_levantamientos')
                ->onDelete('cascade')
                ->onDelete('cascade');
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::table('crm_cursos', function (Blueprint $table) {
            $table->dropColumn(['training_levantamientos_id']);
        });
        Schema::dropIfExists('crm_cursos');
    }
};
