<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosTable extends Migration
{
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id('ID_producto');
            $table->integer('precio');
            $table->integer('stock');
            $table->string('nombre');
            $table->foreignId('ID_tipo')->constrained('tipo_producto');
            $table->string('imagen');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('productos');
    }
}
