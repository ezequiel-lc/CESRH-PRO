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
        Schema::create('departamento_puesto', function (Blueprint $table) {
            $table->id();
            
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
        Schema::table('departamento_puesto', function (Blueprint $table) {
            $table->dropForeign(['departamento_id']);
            $table->dropForeign(['puesto_id']);
        });

        Schema::dropIfExists('departamento_puesto');
    }
};
