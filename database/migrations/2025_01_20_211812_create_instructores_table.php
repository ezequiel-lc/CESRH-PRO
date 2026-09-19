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
        Schema::create('instructores', function (Blueprint $table) {
            $table->id();
            $table->string('telefono1', 10);
            $table->string('telefono2', 10);
            $table->string('registroStps', 45);
            $table->string('rfc', 14);
            $table->string('regimen', 45);
            $table->string('estado', 45);
            $table->string('municipio', 45);
            $table->string('codigopostal', 10);
            $table->string('colonia', 45);
            $table->string('calle', 45);
            $table->string('numero', 45);
            $table->string('honorarios', 45);
            $table->string('status', 45);
            $table->string('dc5', 255);
            $table->string('cuentabancaria', 255);
            $table->string('ine', 255);
            $table->string('curp', 18);
            $table->string('sat', 100);
            $table->string('domicilio', 150);
            $table->string('tipoinstructor', 45);
            $table->string('nombre_empresa', 255);
            $table->string('rfc_empre', 20);
            $table->string('calle_empre', 45);
            $table->string('numero_empre', 45);
            $table->string('colonia_empre', 100);
            $table->string('municipio_empre', 100);
            $table->string('estado_empre', 45);
            $table->string('postal_empre', 10);
            $table->string('regimen_empre', 100);

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
        Schema::table('instructores', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['registro_patronal_id']);
            //$table->dropForeign(['departamento_id']);
        });

        Schema::dropIfExists('instructores');
    }
};
