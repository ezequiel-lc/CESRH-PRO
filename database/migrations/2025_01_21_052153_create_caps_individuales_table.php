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
        Schema::create('caps_individuales', function (Blueprint $table) {
            $table->id();
            $table->date('fechaIni');
            $table->date('fechaFin');
            $table->string('nombreCapacitacion');
            $table->string('objetivoCapacitacion');
            $table->unsignedBigInteger('cursos_id');
            $table->foreign('cursos_id')
                ->references('id')
                ->on( 'cursos')
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
        Schema::table('caps_individuales', function (Blueprint $table) {
            $table->dropForeign(['cursos_id']);
        });
        Schema::dropIfExists('caps_individuales');
    }
};
