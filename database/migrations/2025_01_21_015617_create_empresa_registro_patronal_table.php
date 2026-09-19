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
        Schema::create('empresa_registro_patronal', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('empresa_id');
            $table->foreign('empresa_id') //Declara que id es una clave foránea.
                    ->references('id') //Indica que esta columna hace referencia a la columna id
                    ->on( 'empresas')  // Define que la relación es con la tabla xxx
                    ->onUpdate('cascade')
                    ->onDelete('cascade');

            // Relación con la tabla registros_patronales
            $table->unsignedBigInteger('registro_patronal_id');
            $table->foreign('registro_patronal_id') // Nombre más corto 'empresa_registro_patronal_registros_patronales_foreign'
                    ->references('id')
                    ->on('registros_patronales')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Eliminar las claves foráneas explícitamente
        Schema::table('empresa_registro_patronal', function (Blueprint $table) {
            $table->dropForeign(['empresa_id']);
            $table->dropForeign(['registro_patronal_id']);
        });

        Schema::dropIfExists('empresa_registro_patronal');
    }
};
