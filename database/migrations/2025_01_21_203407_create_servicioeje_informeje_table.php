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
        Schema::create('servicioeje_informeje', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('servicejec_id');
            $table->foreign('servicejec_id')
                ->references('id')
                ->on('servicios_ejecutivos')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->unsignedBigInteger('infmejec_id');
            $table->foreign('infmejec_id')
                    ->references('id')
                    ->on('informaciones_ejecutivos')
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
        Schema::table('servicioeje_informeje', function (Blueprint $table) {
            $table->dropForeign('servicejec_id');
            $table->dropForeign('infmejec_id');
        });

        Schema::dropIfExists('servicioeje_informeje');
    }
};
