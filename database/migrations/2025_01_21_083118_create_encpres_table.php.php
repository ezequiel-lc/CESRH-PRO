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
        Schema::create('encpres', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('encuestas_id');
            $table->unsignedBigInteger('preguntas_id');
            $table->foreign('encuestas_id')->references('id')->on('360_encuestas')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('preguntas_id')->references('id')->on('preguntas')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
        //
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('encpres', function (Blueprint $table) {
            $table->dropForeign(['encuestas_id']);
            $table->dropForeign(['preguntas_id']);
        });
        Schema::dropIfExists('encpres');
        //
    }
};
