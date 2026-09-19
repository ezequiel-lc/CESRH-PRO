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
        Schema::create('empresas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 45);
            $table->string('razon_social', 255);
            $table->string('rfc', 14);
            $table->string('nombre_comercial', 45);
            $table->string('pais_origen', 45);
            $table->string('representante_legal', 255);
            $table->string('url_constancia_situacion_fiscal', 255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empresas');
    }
};
