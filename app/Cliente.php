<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    public $timestamps = false;
    protected $fillable = [
    	 'nome', 
         'endereco',
         'bairro',
         'cidade',
         'cep',
         'cnpjcpf',
         'emailnfe',
         'email',
         'consumidorfina',
         'fiscaljuridico',
         'vendedor',
         'vendedor_id'
     ];

    public static function indexLetra($letra) {
        return static::where('nome', 'LIKE', $letra . '%')->get()  ;
    }
    
}



