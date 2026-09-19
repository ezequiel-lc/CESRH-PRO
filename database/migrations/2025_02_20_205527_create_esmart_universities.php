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
        Schema::create("esmart_universities", function (Blueprint $table) {

            $table->id();
            $table->string("nombre_curso");
            $table->string("participantes");
            $table->string("departamentos_participan");
            $table->string("puestos_participan");
            $table->date("fecha_habilitada");
            $table->unsignedBigInteger("esmart_levantamientos_id");
            $table->foreign("esmart_levantamientos_id")
                ->references("id")
                ->on("esmart_levantamientos")
                ->onUpdate("cascade")
                ->onDelete("cascade");
            $table->string("dc3_requieren");
            $table->string("nuevo_existente");
            $table->string("nuevo_curso")->nullable();
            $table->string("horas_nuevo")->nullable();
            $table->string("tipo_curso")->nullable();
                            
            $table->timestamps(); 

        });
    }

    public function down(): void
    {
        Schema::table("esmart_universities", function (Blueprint $table) {
            $table->dropColumn(["esmart_levantamientos_id"]);
        });
        Schema::dropIfExists("esmart_universities");
    }
};
