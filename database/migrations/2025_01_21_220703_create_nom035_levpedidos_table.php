<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('nom035_levpedidos', function (Blueprint $table) {
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
            $table->string('tipo_servicio');
            $table->date('fecha');
            $table->time('hora');
            $table->foreignId('nom035_informaciones_id')
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
    public function down(): void
    {
        Schema::table('nom035_levpedidos', function (Blueprint $table) {
            $table->dropColumn('nom035_informaciones_id');
            $table->dropColumn('sucursales_id');
            $table->dropColumn('empresa_id');
            $table->dropColumn('leads_clientes_id');
        });
        Schema::dropIfExists('nom035_levpedidos');
    }
};
