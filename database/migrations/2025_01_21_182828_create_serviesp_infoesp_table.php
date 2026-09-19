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
        Schema::create('serviesp_infoesp', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('servEsp_id');
            $table->foreign('servEsp_id')
                ->references('id')
                ->on('servicios_especializados')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->unsignedBigInteger('infoEsp_id');
            $table->foreign('infoEsp_id')
                ->references('id')
                ->on('informaciones_especializados')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('identificador');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('serviesp_infoesp', function (Blueprint $table) {
                $table->dropForeign(['servEsp_id']);
                $table->dropForeign(['infoEsp_id']);
        });
        Schema::dropIfExists('serviesp_infoesp');
    }
};