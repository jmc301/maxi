<?php

namespace App\Services;

use App\Titulo;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\TitulosFormRequest;


class CriadorDeTitulo
{
    public function criarTitulo(
        TitulosFormRequest $request
        ): Titulo {
        DB::beginTransaction();

        $request->emissao = date('Y-m-d');
          
        $titulo = Titulo::create([
            'titulo' => $request->titulo,
            'prefixo' => $request->prefixo,
            'parcela' => $request->parcela,
            'emissao' => $request->emissao,
            'vencimento' => $request->vencimento,
            'pagamento' => $request->pagamento,
            'cliente' => $request->cliente,
            'valor' => $request->valor,
            'numerobancario' => $request->numerobacanrio,
            'historico' => $request->historico,
            'desconto' => $request->desconto,
            'multa' => $request->multa,
            'juros' => $request->juros,
            'valor_pago' => $request->valor_pago,
        ]);
        DB::commit();

        return $titulo;
                    
    }
}
