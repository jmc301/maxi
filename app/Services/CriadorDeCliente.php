<?php

namespace App\Services;

use App\Cliente;
use Illuminate\Http\Request;
use App\Http\Requests\ClientesFormRequest;
use Illuminate\Support\Facades\DB;

class CriadorDeCliente
{
    public function criarCliente(
        ClientesFormRequest $request
        ): Cliente {
        DB::beginTransaction();
        $cliente = Cliente::create([
            'nome' => $request->nome,
            'endereco' => $request->endereco,
            'bairro' => $request->bairro,
            'cidade' => $request->cidade,
            'uf' => $request->uf,
            'numero' => $request->numero,
            'cep' => $request->cep,
            'emailnfe' => $request->emailnfe,
            'email' => $request->email,
            'consumidorfina' => $request->consumidorfina,
            'fiscaljuridico' => $request->fiscaljuridico,
            'cnpjcpf' => $request->cnpjcpf,
            'vendedor' => $request->vendedor,
            'vendedor_id' => $request->vendedor     
        ]);
        DB::commit();

        return $cliente;
                    
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
