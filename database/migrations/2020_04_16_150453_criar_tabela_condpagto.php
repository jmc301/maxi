<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CriarTabelaCondpagto extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('condpagamentos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('descricao',30)->nullable();
            $table->integer('dias1')->nullable();
            $table->integer('dias2')->nullable();
            $table->integer('dias3')->nullable();
            $table->integer('dias4')->nullable();
            $table->integer('dias5')->nullable();
            $table->integer('dias6')->nullable();
            $table->integer('dias7')->nullable();
            $table->integer('dias8')->nullable();
            $table->integer('dias9')->nullable();
            $table->integer('dias10')->nullable();
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
