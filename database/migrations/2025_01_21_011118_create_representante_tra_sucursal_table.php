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
        Schema::create('representante_tra_sucursal', function (Blueprint $table) {
            $table->id();
            $table->string('RTnombre', 45);
            $table->string('RTapePaterno', 60);
            $table->string('RTapeMaterno', 60);

            //donde almacenara el id de la relacion
            $table->unsignedBigInteger('sucursal_id');
            $table->foreign('sucursal_id') //Declara que id es una clave foránea.
                    ->references('id') //Indica que esta columna hace referencia a la columna id
                    ->on( 'sucursales')  // Define que la relación es con la tabla xxx
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
        Schema::table('representante_tra_sucursal', function (Blueprint $table) {
            $table->dropForeign(['sucursales_idsucursales']);
        });

        Schema::dropIfExists('representante_tra_sucursal');
    }
};
