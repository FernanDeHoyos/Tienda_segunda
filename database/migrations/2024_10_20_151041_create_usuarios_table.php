<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('usuarios', function (Blueprint $table) {
        $table->id();
        $table->string('nombre');
        $table->string('email')->unique();
        $table->string('contraseña');
        $table->string('direccion')->nullable();
        $table->string('telefono')->nullable();
        $table->timestamp('fecha_registro')->useCurrent();
        $table->timestamps();
    });
}

public function down()
{
    Schema::dropIfExists('usuarios');
}

};
