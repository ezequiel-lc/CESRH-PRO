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
        Schema::create('registros_patronales', function (Blueprint $table) {
            $table->id();
            $table->string('registro_patronal', 255);
            $table->string('rfc', 14);
            $table->string('nombre_o_razon_social', 255);
            $table->string('regimen_capital', 255);
            $table->string('regimen_fiscal', 255);
            $table->string('actividad_economica', 255);
            $table->string('imss_calle_manzana', 100);
            $table->string('imms_num_exterior', 45);
            $table->string('imms_num_int', 45);
            $table->string('imms_colonia', 255);
            $table->string('imms_codigo_postal', 45);
            $table->string('imms_estado', 200);
            $table->string('imms_municipio', 255);
            $table->string('imms_telefono', 10);
            $table->string('imms_convenio_rembolso_subsidios', 255);
            $table->string('imms_tipo_contribucion', 255);
            $table->string('area_geografica', 255);
            $table->string('delegacion_imms', 255);
            $table->string('subdelegacion_imms', 255);
            $table->string('prima_año', 30);
            $table->string('prima_mes', 30);
            $table->string('porcentaje_prima_rt', 45);
            $table->string('clase_riesgo_trabajo', 255);
            $table->string('acreditacion_stps', 255);
            $table->string('representante_legal', 255);
            $table->string('puesto_representante', 255);
            $table->string('cuenta_contable', 255);

            //Borrar relacion por que no es correcta,
            // $table->unsignedBigInteger('user_id');
            // $table->foreign('user_id') //Declara que id es una clave foránea.
            //         ->references('id') //Indica que esta columna hace referencia a la columna id
            //         ->on( 'users')  // Define que la relación es con la tabla xxx
            //         ->onUpdate('cascade')
            //         ->onDelete('cascade');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registros_patronales');
    }
};
