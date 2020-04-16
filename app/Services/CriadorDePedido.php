<?php

namespace App\Services;

use App\Pedido;
use Illuminate\Http\Request;
use App\Http\Requests\PedidosFormRequest;
use Illuminate\Support\Facades\DB;

class CriadorDePedido
{
    public function criarPedido(
        PedidosFormRequest $request
        ): Pedido {
        DB::beginTransaction();

        $request->data = date('Y-m-d');

        $pedido = Pedido::create([
            'pedido' => $request->id,
            'data' => $request->data,
            'cliente_id' => $request->cliente_id,
            'vendedor_id' => $request->cliente_id,
            'condicao_pagamento' => $request->condicao_pagamento,
            'valor' => $request->valor
        ]);
        DB::commit();

        return $pedido;
                    
    }

    /**
     * @param int $qtdTemporadas
     * @param int $epPorTemporada
     * @param $cliente
     */
    private function criaTemporadas(int $qtdTemporadas, int $epPorTemporada, Cliente $cliente): void
    {
        for ($i = 1; $i <= $qtdTemporadas; $i++) {
            $temporada = $cliente->temporadas()->create(['numero' => $i]);

            $this->criaEpisodios($epPorTemporada, $temporada);
        }
    }

    /**
     * @param int $epPorTemporada
     * @param \Illuminate\Database\Eloquent\Model $temporada
     */
    private function criaEpisodios(int $epPorTemporada, \Illuminate\Database\Eloquent\Model $temporada): void
    {
        for ($j = 1; $j <= $epPorTemporada; $j++) {
            $temporada->episodios()->create(['numero' => $j]);
        }
    }
}
