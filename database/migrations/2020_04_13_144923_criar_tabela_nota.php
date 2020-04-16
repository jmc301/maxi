<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CriarTabelaNota extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('notas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('nota')->nullable();    
            $table->date('data_emissao')->nullable();    
            $table->integer('cliente_id')->nullable();    
            $table->integer('pedido_id')->nullable();    
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
