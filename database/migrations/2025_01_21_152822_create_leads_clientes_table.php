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
        Schema::create('leads_clientes', function (Blueprint $table) {
            $table->id();
            $table->string('numero_lead');
            $table->string('nombre_cliente');
            $table->unsignedBigInteger('users_id');
            $table->foreign('users_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('medios_cesrh');
            $table->datetime('fecha_y_hora');
            $table->unsignedBigInteger('crm_empresas_id');
            $table->foreign('crm_empresas_id')
                ->references('id')
                ->on('crm_empresas')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('puesto');
            $table->string('correo');
            $table->string('correo_2')->nullable();
            $table->string('telefono');
            $table->string('telefono_2')->nullable();
            $table->string('nombre_contacto_2')->nullable();
            $table->string('puesto_contacto_2')->nullable();
            $table->string('tipo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('leads_clientes', function (Blueprint $table) {
            $table->dropForeign(['users_id']);
        });
        Schema::dropIfExists('leads_clientes');
    }
};
