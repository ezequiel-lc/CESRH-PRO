<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create("aprobada_especializados", function (Blueprint $table) {
            $table->id();
            $table->date('fecha_aprobacion');
            $table->string('email_enviado');
            $table->foreignId('servicios_especializados_id')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::table('aprobada_especializados', function (Blueprint $table) {
            $table->dropColumn('servicios_especializados_id');
        });
        Schema::dropIfExists('aprobada_especializados');
    }
};
