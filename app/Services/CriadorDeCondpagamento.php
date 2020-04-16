<?php

namespace App\Services;

use App\Condpagamento;
use App\Http\Requests\CondpagamentosFormRequest;
use Illuminate\Support\Facades\DB;

class CriadorDeCondpagamento
{
    public function criarCondpagamento(
        CondpagamentosFormRequest $request
        ): Condpagamento {
        DB::beginTransaction();
         
        $condpagamento = Condpagamento::create([
            'descricao' => $request->descricao,
            'dias1' => $request->dias1,
            'dias2' => $request->dias2,
            'dias3' => $request->dias3,
            'dias4' => $request->dias4,
            'dias5' => $request->dias5,
            'dias6' => $request->dias6,
            'dias7' => $request->dias7,
            'dias8' => $request->dias8,
            'dias9' => $request->dias9,
            'dias10' => $request->dias10
        ]);
        DB::commit();

        return $condpagamento;
                    
    }
}
