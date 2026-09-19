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
        Schema::create('sucursales', function (Blueprint $table) {
            $table->id();
            $table->string('clave_sucursal', 45);
            $table->string('nombre_sucursal', 45);
            $table->string('zona_economica', 255);
            $table->string('estado', 255);
            $table->string('cuenta_contable', 255);
            $table->string('rfc', 20);
            $table->string('correo', 50);
            $table->string('telefono', 15);
            $table->string('status', 45);

            //donde almacenara el id de la relacion
            $table->unsignedBigInteger('registro_patronal_id');
            $table->foreign('registro_patronal_id') //Declara que id es una clave foránea.
                    ->references('id') //Indica que esta columna hace referencia a la columna id
                    ->on( 'registros_patronales')  // Define que la relación es con la tabla xxx
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
        // Eliminar las claves foráneas explícitamente
        Schema::table('sucursales', function (Blueprint $table) {
            $table->dropForeign(['registro_patronal_id']);
        });

        Schema::dropIfExists('sucursales');
    }
};
