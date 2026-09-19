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
        Schema::create('empresa_sucursal', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('empresa_id');
            $table->foreign('empresa_id') //Declara que id es una clave foránea.
                    ->references('id') //Indica que esta columna hace referencia a la columna id
                    ->on( 'empresas')  // Define que la relación es con la tabla xxx
                    ->onUpdate('cascade')
                    ->onDelete('cascade');

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
        Schema::table('empresa_sucursal', function (Blueprint $table) {
            $table->dropForeign(['empresa_id']);
            $table->dropForeign(['sucursal_id']);
        });

        Schema::dropIfExists('empresa_sucursal');
    }
};
