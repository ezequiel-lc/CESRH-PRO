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
        Schema::create('bajas', function (Blueprint $table) {
            $table->id();
            $table->date('fecha_baja');
            $table->text('motivo_baja');
            $table->string('tipo_baja', 45);
            $table->string('documento', 255);
            $table->text('observaciones')->nullable();

            //donde almacenara el id de la relacion
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id') //Declara que id es una clave foránea.
                    ->references('id') //Indica que esta columna hace referencia a la columna id
                    ->on( 'users')  // Define que la relación es con la tabla xxx
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
        Schema::table('bajas', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });

        Schema::dropIfExists('bajas');
    }
};
