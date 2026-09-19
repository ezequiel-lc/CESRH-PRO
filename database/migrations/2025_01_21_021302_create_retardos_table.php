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
        Schema::create('retardos', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->string('hora_entrada_programada', 45);
            $table->string('hora_entrada_real', 45);
            $table->string('minutos_retardo', 45);
            $table->string('motivo', 255);
            $table->string('status', 45);

            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('retardos');
    }
};
