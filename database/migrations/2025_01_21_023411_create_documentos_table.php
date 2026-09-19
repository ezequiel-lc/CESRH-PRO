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
        Schema::create('documentos', function (Blueprint $table) {
            $table->id();
            $table->string('archivo', 255);
            $table->date('fecha_subida');
            $table->string('status', 45);
            $table->string('numero', 1000);
            $table->string('original', 45);
            $table->string('comentarios', 1000);

            //donde almacenara el id de la relacion
            $table->unsignedBigInteger('tipodocumento_id');
            $table->foreign('tipodocumento_id') //Declara que id es una clave foránea.
                    ->references('id') //Indica que esta columna hace referencia a la columna id
                    ->on( 'tiposdocumentos')  // Define que la relación es con la tabla xxx
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
        Schema::table('documentos', function (Blueprint $table) {
            $table->dropForeign(['tipodocumento_id']);
        });


        Schema::dropIfExists('documentos');
    }
};
