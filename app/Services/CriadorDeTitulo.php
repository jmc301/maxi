<?php

namespace App\Services;

use App\Titulo;
use Illuminate\Support\Facades\DB;

class CriadorDeTitulo
{
    public function criarTitulo(
        string $tituloTitulo,
        string $prefixoTitulo,
        string $parcelaTitulo,
        string $emissaoTitulo,
        string $vencimentoTitulo,
        string $pagamentoTitulo,
        string $clienteTitulo,
        string $valorTitulo,
        string $numerobacanrioTitulo,
        string $historicoTitulo,        
        string $descontoTitulo,        
        string $multaTitulo,        
        string $jurosTitulo,
        string $valor_pagoTitulo
        ): Titulo {
        DB::beginTransaction();
          
        $titulo = Titulo::create([
            'titulo' => $tituloTitulo,
            'prefixo' => $prefixoTitulo,
            'parcela' => $parcelaTitulo,
            'emissao' => $emissaoTitulo,
            'vencimento' => $vencimentoTitulo,
            'pagamento' => $pagamentoTitulo,
            'cliente' => $clienteTitulo,
            'valor' => $valorTitulo,
            'numerobancario' => $numerobacanrioTitulo,
            'historico' => $historicoTitulo,
            'desconto' => $descontoTitulo,
            'multa' => $multaTitulo,
            'juros' => $jurosTitulo,
            'valor_pago' => $valor_pagoTitulo,
        ]);
        DB::commit();

        return $titulo;
                    
    }
}
