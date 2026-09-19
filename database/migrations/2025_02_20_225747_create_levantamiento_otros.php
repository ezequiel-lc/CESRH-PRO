<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {   
        Schema::create('levantamiento_otros', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('cantidad');
            $table->string('tipo_necesidades');
            $table->date('fecha_tentativa');
            $table->decimal('presupuesto');
            $table->foreignId('tipo_servicios_id')
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
            $table->foreignId('leads_clientes_id')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('users_id')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::table('levantamiento_otros', function (Blueprint $table) {
            $table->dropColumn(['tipo_servicios_id']);
            $table->dropForeign(['empresa_id']);
            $table->dropColumn('leads_clientes_id');
            $table->dropForeign(['users_id']);
            $table->dropForeign(['sucursales_id']);
        });
        Schema::dropIfExists('levantamiento_otros');
    }
};
