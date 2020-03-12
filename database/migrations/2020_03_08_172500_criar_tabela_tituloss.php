<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CriarTabelaTituloss extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('titulos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('titulo');
            $table->string('prefixo',1)->nullable();
            $table->string('parcela',1)->nullable();
            $table->date('emissao',1)->nullable();
            $table->date('vencimento')->nullable();
            $table->date('pagamento')->nullable();
            $table->integer('cliente')->nullable();
            $table->float('valor');
            $table->string('numerobancario',20)->nullable();
            $table->string('historico',50)->nullable();
            
//             $table->foreign('cliente')
//                 ->references('id')
//                 ->on('clientes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('titulos');
    }
}
