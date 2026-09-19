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
        Schema::create('participantes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('grupocursos_capacitaciones_id');
            $table->foreign('grupocursos_capacitaciones_id')
                ->references('id')
                ->on( 'grupocursos_capacitaciones')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('status', 45);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('participantes', function (Blueprint $table) {
            $table->dropForeign(['grupocursos_capacitaciones_id']);
        });
        Schema::dropIfExists('participantes');
    }
};
