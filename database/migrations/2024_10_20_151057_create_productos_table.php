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
    Schema::create('productos', function (Blueprint $table) {
        $table->id();
        $table->string('nombre');
        $table->text('descripcion')->nullable();
        $table->decimal('precio', 8, 2);
        $table->string('estado')->default('disponible');
        $table->string('imagen_url')->nullable();
        $table->foreignId('id_categoria')->constrained('categorias')->onDelete('cascade');
        $table->foreignId('id_usuario')->constrained('users')->onDelete('cascade');
        $table->timestamp('fecha_publicacion')->useCurrent();
        $table->timestamps();
    });
}

public function down()
{
    Schema::dropIfExists('productos');
}

};
