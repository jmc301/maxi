<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    public $timestamps = false;
    protected $fillable = [
    	 'pedido', 
         'data',
         'cliente_id',
         'vendedor_id',
         'condicao_pagamento',
         'valor',
         'status',
         'nota'
     ];

    public static function indexLetra($letra) {
        return static::where('nome', 'LIKE', $letra . '%')->get()  ;
    }
    
}



