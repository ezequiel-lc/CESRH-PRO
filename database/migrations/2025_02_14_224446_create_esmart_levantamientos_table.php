<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('esmart_levantamientos', function (Blueprint $table) {

            $table->id(); // Clave primaria
            $table->date('fecha');
            $table->time('hora');
            $table->decimal('numero_pedido');
            $table->foreignId('leads_clientes_id')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('users_id')
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
            // Leads -----------------------------------
            $table->string('numero_lead');
            $table->string('nombre_cliente');
            $table->string('medios_cesrh');
            $table->string('puesto');
            $table->string('correo');
            $table->string('correo_2')->nullable();
            $table->string('telefono');
            $table->string('telefono_2')->nullable();
            $table->string('nombre_contacto_2')->nullable();
            $table->string('puesto_contacto_2')->nullable();
            $table->string('tipo');
            // ------------------------------------------
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::table('esmart_levantamientos', function (Blueprint $table) {
            $table->dropColumn('users_id');
            $table->dropForeign(['empresa_id']);
            $table->dropColumn('leads_clientes_id');
            $table->dropForeign(['sucursales_id']);
        });
        Schema::dropIfExists('esmart_levantamientos');
    }
};
