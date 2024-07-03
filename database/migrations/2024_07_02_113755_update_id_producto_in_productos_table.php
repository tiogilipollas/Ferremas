<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateIdProductoInProductosTable extends Migration
{
    public function up()
    {
        Schema::table('productos', function (Blueprint $table) {
            // Cambia el tipo de 'ID_producto' a unsignedInteger o unsignedBigInteger según sea necesario.
            // Asegúrate de que no haya conflictos con datos existentes.
            $table->unsignedBigInteger('ID_producto')->change();
        });
    }

    public function down()
    {
        Schema::table('productos', function (Blueprint $table) {
            // Revierte el cambio si necesitas revertir la migración.
            $table->integer('ID_producto')->change();
        });
    }
}