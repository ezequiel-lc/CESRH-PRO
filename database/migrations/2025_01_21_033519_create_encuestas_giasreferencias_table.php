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
        Schema::create('encuestas_giasreferencias', function (Blueprint $table) {
            $table->string('encuestas_Clave');
            $table->unsignedBigInteger('giasreferencias_id');
            $table->foreign('giasreferencias_id')
                ->references('id')
                ->on('gias_referencias')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('encuestas_giasreferencias', function (Blueprint $table) {
            $table->dropForeign(['giasreferencias_id']);
        });
        Schema::dropIfExists('encuestas_giasreferencias');
    }
};
