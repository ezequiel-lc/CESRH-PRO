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
        Schema::create('departamentos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_departamento', 45);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        /*
        Schema::table('departamentos', function (Blueprint $table) {
            $table->dropForeign(['sucursal_id']);
        });
        
        // Eliminar las claves foráneas explícitamente
        Schema::table('departamentos', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        }); */

        

        Schema::dropIfExists('departamentos');
    }
};
