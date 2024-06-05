<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagoTable extends Migration
{
    public function up(): void
    {
        Schema::create('Pago', function (Blueprint $table) {
            $table->bigIncrements('ID_pago'); // Cambiado a bigIncrements
            $table->unsignedBigInteger('ID_pedido');
            $table->integer('monto'); 
            $table->dateTime('fecha');
            $table->string('tipo_pago', 50);
            $table->integer('cuotas')->nullable();
            $table->string('numero_tarjeta', 16)->nullable();
            $table->foreign('ID_pedido')->references('ID_pedido')->on('Pedido')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('Pago');
    }
}
