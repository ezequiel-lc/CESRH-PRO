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
        Schema::create('trabajadores', function (Blueprint $table) {
            $table->id();
            $table->string('clave_trabajador', 255);
            $table->string('numero_seguridad_social', 45);
            $table->date('fecha_nacimiento');
            $table->string('lugar_nacimiento', 100);
            $table->string('estado', 100);
            $table->string('codigo_postal', 10);
            $table->string('sexo', 15);
            $table->string('curp', 18);
            $table->string('rfc', 14);
            $table->string('numero_celular', 10);
            $table->date('fecha_ingreso');
            $table->string('edad', 20);
            $table->string('estado_civil', 20);
            $table->string('estudios', 45);
            $table->string('ocupacion', 100);
            $table->string('tipo_puest', 45);
            $table->string('contratacion', 45);
            $table->string('tipo_personal', 45);
            $table->string('jornada_trabajo', 45);
            $table->string('rotacion', 45);
            $table->string('experiencia', 45);
            $table->string('tiempo_puesto', 45);
            $table->string('calle', 45);
            $table->string('colonia', 45);
            $table->string('numero', 45);
            $table->string('status', 45);

            //donde almacenara el id de la relacion
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id') //Declara que id es una clave foránea.
                    ->references('id') //Indica que esta columna hace referencia a la columna id
                    ->on( 'users')  // Define que la relación es con la tabla xxx
                    ->onUpdate('cascade')
                    ->onDelete('cascade');

            //donde almacenara el id de la relacion
            $table->unsignedBigInteger('registro_patronal_id');
            $table->foreign('registro_patronal_id') //Declara que id es una clave foránea.
                    ->references('id') //Indica que esta columna hace referencia a la columna id
                    ->on( 'registros_patronales')  // Define que la relación es con la tabla xxx
                    ->onUpdate('cascade')
                    ->onDelete('cascade');

            $table->timestamps();

            /*
            //donde almacenara el id de la relacion
            $table->unsignedBigInteger('departamento_id');
            $table->foreign('departamento_id') //Declara que id es una clave foránea.
                    ->references('id') //Indica que esta columna hace referencia a la columna id
                    ->on( 'departamentos')  // Define que la relación es con la tabla xxx
                    ->onUpdate('cascade')
                    ->onDelete('cascade');

            //donde almacenara el id de la relacion
            $table->unsignedBigInteger('puesto_id');
            $table->foreign('puesto_id') //Declara que id es una clave foránea.
                    ->references('id') //Indica que esta columna hace referencia a la columna id
                    ->on( 'puestos')  // Define que la relación es con la tabla xxx
                    ->onUpdate('cascade')
                    ->onDelete('cascade'); */
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Eliminar las claves foráneas explícitamente
        Schema::table('trabajadores', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['registro_patronal_id']);
            //$table->dropForeign(['departamento_id']);
        });

        Schema::dropIfExists('trabajadores');
    }
};
