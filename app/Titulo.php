<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Titulo extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'titulo',
        'prefixo',
        'parcela',
        'emissao',
        'vencimento',
        'pagamento',
        'cliente',
        'valor',
        'numerobancario',
        'historico',
        'desconto',
        'multa',
        'juros',
        'jurosperc',
        'valor_pago',
        'pedido_id',
        'nota_id'
    ];
       
}
