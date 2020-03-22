<?php

namespace App\Services;

use App\Cliente;
use Illuminate\Support\Facades\DB;

class CriadorDeCliente
{
    public function criarCliente(
        string $nomeCliente,
        string $enderecoCliente,
        string $bairroCliente,
        string $cidadeCliente,
        string $ufCliente,
        string $numeroCliente,
        string $cepCliente,
        string $emailnfeCliente,
        string $emailCliente,
        string $consumidorfinaCliente,
        string $fiscaljuridicoCliente,
        string $cnpjcpfCliente,
        string $vendedorCliente,
        string $vendedor_idCliente
        ): Cliente {
        DB::beginTransaction();
        $cliente = Cliente::create([
            'nome' => $nomeCliente,
            'endereco' => $enderecoCliente,
            'bairro' => $bairroCliente,
            'cidade' => $cidadeCliente,
            'uf' => $ufCliente,
            'numero' => $numeroCliente,
            'cep' => $cepCliente,
            'emailnfe' => $emailnfeCliente,
            'email' => $emailCliente,
            'consumidorfina' => $consumidorfinaCliente,
            'fiscaljuridico' => $fiscaljuridicoCliente,
            'cnpjcpf' => $cnpjcpfCliente,
            'vendedor' => $vendedorCliente,
            'vendedor_id' => $vendedorCliente            
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
