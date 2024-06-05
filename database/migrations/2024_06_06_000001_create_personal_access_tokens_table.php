<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonalAccessTokensTable extends Migration
{
    public function up(): void
    {
        Schema::create('compras', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('ID_pedido')->nullable();
            $table->string('session_id');
            $table->integer('total'); 
            $table->tinyInteger('status')->comment('1: pendiente. 2: Aprobada.')->default(1);
            $table->string('token')->nullable();
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('ID_pedido')->references('ID_pedido')->on('pedido')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('compras');
    }
}

