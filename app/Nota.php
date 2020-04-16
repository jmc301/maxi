<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nota extends Model
{
    public $timestamps = false;
    protected $fillable = [
    	 'nota', 
         'data_emissao',
         'cliente_id',
         'pedido_id',
         'valor'
     ];

    public static function indexLetra($letra) {
        return static::where('id', 'LIKE', $letra . '%')->get()  ;
    }
    
}



