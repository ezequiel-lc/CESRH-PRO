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
        Schema::create('user_incapacidad', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id') //Declara que id es una clave foránea.
                    ->references('id') //Indica que esta columna hace referencia a la columna id
                    ->on( 'users')  // Define que la relación es con la tabla xxx
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            //donde almacenara el id de la relacion
            $table->unsignedBigInteger('incapacidad_id');
            $table->foreign('incapacidad_id') //Declara que id es una clave foránea.
                    ->references('id') //Indica que esta columna hace referencia a la columna id
                    ->on( 'incapacidades')  // Define que la03 relación es con la tabla xxx
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
        Schema::table('user_incapacidad', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['incapacidades_id']);
        });

        Schema::dropIfExists('user_incapacidad');
    }
};
