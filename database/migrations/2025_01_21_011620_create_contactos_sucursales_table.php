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
        Schema::create('contactos_sucursales', function (Blueprint $table) {
            $table->id();
            $table->string('nomCont', 45);
            $table->string('apePCont', 60);
            $table->string('apeMCont', 60);
            $table->string('telefonoCont', 20);
            $table->string('telefonoCont2', 20);
            $table->string('correoCont', 100);
            $table->string('correoCont2', 100);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contactos_sucursales');
    }
};
