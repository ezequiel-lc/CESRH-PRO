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
        Schema::create('datos_fiscales', function (Blueprint $table) {
            $table->id();
            $table->string('razon_social');
            $table->string('rfc');
            $table->string('calle');
            $table->string('numero_exterior');
            $table->string('numero_interior')->nullable();
            $table->string('colonia');
            $table->string('municipio');
            $table->string('localidad');
            $table->string('estado');
            $table->string('pais');
            $table->string('codigo_postal');
            $table->unsignedBigInteger('crm_empresas_id');
            $table->foreign('crm_empresas_id')
                ->references('id')
                ->on('crm_empresas')
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
        Schema::table('datos_fiscales', function (Blueprint $table) {
            $table->dropForeign(['crm_empresasid']);
        });
        Schema::dropIfExists('datos_fiscales');
    }
};