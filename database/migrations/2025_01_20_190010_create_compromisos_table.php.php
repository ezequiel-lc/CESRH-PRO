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
        Schema::create('compromisos', function (Blueprint $table) {
            $table->id();
            $table->date('alta');
            $table->date('vencimiento');
            $table->text('compromiso');
            $table->string('verificado', 2);
            $table->unsignedBigInteger('users_id');
            $table->unsignedBigInteger('preguntas_id');
            $table->foreign('users_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('preguntas_id')->references('id')->on('preguntas')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('compromisos', function (Blueprint $table) {
            $table->dropForeign(['users_id']);
            $table->dropForeign(['preguntas_id']);
        });

        Schema::dropIfExists('compromisos');
    }
};
