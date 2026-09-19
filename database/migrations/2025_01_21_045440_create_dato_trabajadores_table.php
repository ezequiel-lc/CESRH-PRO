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
        Schema::create('dato_trabajadores', function (Blueprint $table) {
            $table->id(); // Columna id (autoincremental)
            $table->string('Nombre', 45)->nullable();
            $table->string('ApellidoPaterno', 45)->nullable();
            $table->string('ApellidoMaterno', 45)->nullable();
            $table->string('Sexo', 45)->nullable();
            $table->string('Edad', 45)->nullable();
            $table->string('EstadoCivil', 45)->nullable();
            $table->string('Estudios', 45)->nullable();
            $table->string('Ocupacion', 45)->nullable();
            $table->string('Departamento', 45)->nullable();
            $table->string('TipoPuesto', 45)->nullable();
            $table->string('Contratacion', 45)->nullable();
            $table->string('TipoPersonal', 45)->nullable();
            $table->string('JornadaTrabajo', 45)->nullable();
            $table->string('RotacionTurnos', 45)->nullable();
            $table->string('Experiencia', 45)->nullable();
            $table->string('TiempoPuesto', 45)->nullable();
            $table->string('Avance', 45)->nullable();
            $table->unsignedBigInteger('encuestas_id'); // Relación con encuestas (usando id)
            $table->unsignedBigInteger('users_id')->nullable(); // Relación con users
            $table->timestamps(); // created_at y updated_at

            // Claves foráneas
            $table->foreign('encuestas_id')
                  ->references('id') // Ahora referencia la columna id de encuestas
                  ->on('encuestas')
                  ->onDelete('cascade');

            $table->foreign('users_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('dato_trabajadores');
    }
};
