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
        Schema::create('encuestas', function (Blueprint $table) {
            $table->id();
            $table->string('Clave'); // Clave primaria generada automáticamente
            $table->string('Empresa'); // Empresa siempre requerida
            $table->string('RutaLogo')->nullable(); // El logo es opcional
            $table->date('FechaInicio'); // Fecha de inicio obligatoria
            $table->date('FechaFinal')->nullable(); // Fecha de finalización puede ser opcional
            $table->date('Caducidad')->nullable(); // Si la encuesta puede caducar, puede ser opcional
            $table->tinyInteger('Estado')->default(0); // Estado por defecto en 0 (abierta/cerrada)
            $table->integer('NumeroEncuestas'); // Número de encuestados es obligatorio
            $table->json('Formato')->nullable(); // Cambiado a JSON para almacenar múltiples cuestionarios
            $table->integer('EncuestasContestadas')->default(0); // Inicialmente 0
            $table->text('Actividades')->nullable(); // Actividades opcionales
            $table->integer('Numero')->nullable(); // Número de encuesta puede generarse
            $table->string('Dep')->nullable(); // Departamento opcional (siempre que pueda no seleccionarse)
            $table->tinyInteger('Cerrable')->default(1); // Si se puede cerrar la encuesta
            $table->string('usuariosdx035_CorreoElectronico')->nullable(); // Usuario creador opcional
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('encuestas');
    }
};
