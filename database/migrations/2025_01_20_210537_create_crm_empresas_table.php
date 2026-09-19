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
        Schema::create('crm_empresas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('giro_empresa');
            $table->string('calle');
            $table->string('numero_exterior');
            $table->string('numero_interior')->nullable();
            $table->string('colonia');
            $table->string('municipio');
            $table->string('localidad');
            $table->string('estado');
            $table->string('pais');
            $table->string('codigo_postal');
            $table->string('tamano_empresa');
            $table->string('pagina_web')->nullable();
            $table->string('logotipo', 255)->nullable();
            $table->string('clasificacion');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('crm_empresas');
    }
};