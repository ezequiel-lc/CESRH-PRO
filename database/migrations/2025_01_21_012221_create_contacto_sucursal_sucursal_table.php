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
        Schema::create('contacto_sucursal_sucursal', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('contacto_sucursal_id');
            $table->unsignedBigInteger('sucursal_id');

            // Definir clave foránea con nombre corto
            $table->foreign('contacto_sucursal_id')
                ->references('id')
                ->on('contactos_sucursales')
                ->onDelete('cascade')
                ->onUpdate('cascade')
                ->name('contacto_sucursal_sucursal_contactos_sucursales_foreign');  // Nombre personalizado

            $table->foreign('sucursal_id')
                ->references('id')->on('sucursales')
                ->onDelete('cascade')
                ->onUpdate('cascade')
                ->name('contacto_sucursal_sucursal_sucursales_foreign');  // Nombre personalizado

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
        Schema::table('contacto_sucursal_sucursal', function (Blueprint $table) {
            $table->dropForeign(['contacto_sucursal_id']);
            $table->dropForeign(['sucursal_id']);
        });

        Schema::dropIfExists('contacto_sucursal_sucursal');
    }
};
