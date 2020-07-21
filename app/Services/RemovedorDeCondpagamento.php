<?php
namespace App\Services;

use App\{Condpagamento};
use Illuminate\Support\Facades\DB;

class RemovedorDeCondpagamento
{    
    public function removeCondpagamento(int $condpagamentoId): string
    {
        $nomeCondpagamento = '';
        DB::transaction(function () use ($condpagamentoId, &$nomeCondpagamento) {
            $condpagamento = Condpagamento::find($condpagamentoId);
            $nomeCondpagamento = $condpagamento->descricao;

            $condpagamento->delete();
        });

        return $nomeCondpagamento;
    }
}
