<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTipoProductoTable extends Migration
{
    public function up()
    {
        Schema::create('tipo_producto', function (Blueprint $table) {
            $table->id('ID_tipo');
            $table->string('descripcion');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tipo_producto');
    }
}