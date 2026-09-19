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
        Schema::create('esmart_aprobadas', function (Blueprint $table) {
            $table->id();
            $table->date('fecha_aprobacion');
            $table->string('email_enviado');
            $table->foreignId('esmart_levantamientos_id')
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
        Schema::table('esmart_aprobadas', function (Blueprint $table) {
            $table->dropForeign(['esmart_levantamientos_id']);
        });
        Schema::dropIfExists('esmart_aprobadas');
    }
};
