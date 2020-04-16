<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CriarTabelaPedido extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pedido')->nullable();    
            $table->date('data')->nullable();    
            $table->integer('cliente_id')->nullable();    
            $table->integer('vendedor_id')->nullable();    
            $table->integer('codicao_pagamento')->nullable();    
            $table->float('valor')->nullable();    
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
