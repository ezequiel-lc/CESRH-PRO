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
        Schema::create('cambio_salarios', function (Blueprint $table) {
            $table->id();
            $table->date('fecha_cambio');
            $table->string('salario_anterior', 45);
            $table->string('salario_nuevo', 45);
            $table->string('motivo', 255);
            $table->string('documento', 255);
            $table->string('observaciones', 255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cambio_salarios');
    }
};
