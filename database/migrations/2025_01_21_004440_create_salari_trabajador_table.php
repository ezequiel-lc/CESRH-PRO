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
        Schema::create('salari_trabajador', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('salario_id');
            $table->foreign('salario_id') //Declara que id es una clave foránea.
                    ->references('id') //Indica que esta columna hace referencia a la columna id
                    ->on( 'salarios')  // Define que la relación es con la tabla xxx
                    ->onUpdate('cascade')
                    ->onDelete('cascade');

            
            //donde almacenara el id de la relacion
            $table->unsignedBigInteger('trabajador_id');
            $table->foreign('trabajador_id') //Declara que id es una clave foránea.
                    ->references('id') //Indica que esta columna hace referencia a la columna id
                    ->on( 'trabajadores')  // Define que la relación es con la tabla xxx
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            
            $table->string('status', 45);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Eliminar las claves foráneas explícitamente
        Schema::table('salari_trabajador', function (Blueprint $table) {
            $table->dropForeign(['salario_id']);
            $table->dropForeign(['trabajador_id']);
        });

        Schema::dropIfExists('salari_trabajador');
    }
};
