<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tipo_servicios', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->unsignedBigInteger('crm_empresas_id');
            $table->foreign('crm_empresas_id')
                ->references('id')
                ->on('crm_empresas')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            
            $table->timestamps();
        });

    }

    public function down(): void
    {
        Schema::table('tipo_servicios', function (Blueprint $table) {
            $table->dropColumn(['crm_empresas_id']);
        });
        Schema::dropIfExists('tipo_servicios');
    }
};
