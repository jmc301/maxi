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
        string $historicoTitulo        
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
            'historico' => $historicoTitulo                        
        ]);
        DB::commit();

        return $titulo;
                    
    }
}
