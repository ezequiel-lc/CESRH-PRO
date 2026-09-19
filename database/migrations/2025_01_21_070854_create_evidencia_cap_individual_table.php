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
        Schema::create('evidencia_cap_individual', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('evidencias_id');
            $table->foreign('evidencias_id')
                ->references('id')
                ->on( 'evidencias')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->unsignedBigInteger('caps_individuales_id');
            $table->foreign('caps_individuales_id')
                ->references('id')
                ->on( 'caps_individuales')
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
        Schema::table('evidencia_cap_individual', function (Blueprint $table){
            $table->dropForeign(['caps_individuales_id']);
            $table->dropIfExists(['evidencias_id']);
        });
        Schema::dropIfExists('evidencia_cap_individual');
    }
};
