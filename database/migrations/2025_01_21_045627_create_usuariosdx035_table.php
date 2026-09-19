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
        Schema::create('usuariosdx035', function (Blueprint $table) {
            $table->string('CorreoElectronico', 40);
            $table->string('NombreUsuario', 45);
            $table->string('Password', 45);
            $table->string('Autoridad', 255);
            $table->date('FechaInicio');
            $table->date('FechaFinal');
            $table->date('Expiracion');
            $table->string('Estado', 255);
            $table->string('Telefono', 10);
            $table->string('CodigoRecuperacion', 45);
            $table->string('Cargo', 255);
            $table->unsignedBigInteger('users_id');
            $table->foreign('users_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('usuariosdx035', function (Blueprint $table) {
            $table->dropForeign(['users_id']);
        });
        Schema::dropIfExists('usuariosdx035');
    }
};
