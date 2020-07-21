<?php

namespace App\Services;

use App\Titulo;
use App\Pedido;
use Illuminate\Support\Facades\DB;
//use App\Http\Requests\TitulosFormRequest;


class CriadorDeTituloPedido
{
    public function criarTitulo(
           Pedido $pedido, int $Parcelas, float $valorParcela, int $dias, int $parc
        ): Titulo {
        DB::beginTransaction();

        $hoje = date('Y-m-d');
          
        $titulo = Titulo::create([
            'titulo' =>  $pedido->id,
            'prefixo' =>  "005",
            'parcela' => $parc,
            'emissao' => date('Y-m-d'),
            'vencimento' => date('Y-m-d', strtotime("+ $dias days")),
            'cliente' => $pedido->cliente_id,
            'valor' => $valorParcela,
            'numerobancario' => " ",
            'historico' => " ",
            'pedido_id' => $pedido->id,
            'nota_id' => $pedido->nota
        ]);
        DB::commit();

        return $titulo;
                    
    }
}
