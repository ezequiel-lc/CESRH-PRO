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
        Schema::create('training_levantamientos', function (Blueprint $table) {
            $table->id();
             // Leads -----------------------------------
             $table->string('numero_lead');
             $table->string('nombre_cliente');
             $table->string('medios_cesrh');
             $table->datetime('fecha_y_hora');
             $table->string('puesto');
             $table->string('correo');
             $table->string('correo_2')->nullable();
             $table->string('telefono');
             $table->string('telefono_2')->nullable();
             $table->string('nombre_contacto_2')->nullable();
             $table->string('puesto_contacto_2')->nullable();
             $table->string('tipo');
             // ------------------------------------------
            $table->date('fecha');
            $table->time('hora');
            $table->string('numero_pedido');
            $table->foreignId('users_id')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('leads_clientes_id')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('sucursales_id')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');            
            $table->foreignId('empresa_id')
                ->constrained()
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
        Schema::table('esmart_levantamientos', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['leads_clientes_id']);
            $table->dropForeign(['empresa_id']);
            $table->dropForeign(['sucursales_id']);
        });
        Schema::dropIfExists('training_levantamietos');
    }
};
