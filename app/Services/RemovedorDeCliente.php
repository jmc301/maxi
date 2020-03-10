<?php
namespace App\Services;

use App\{Cliente};
use Illuminate\Support\Facades\DB;

class RemovedorDeCliente
{
    public function removerCliente(int $clienteId): string
    {
        $nomeCliente = '';
        DB::transaction(function () use ($clienteId, &$nomeCliente) {
            $cliente = Cliente::find($clienteId);
            $nomeCliente = $cliente->nome;

//          $this->removerTemporadas($cliente);
            $cliente->delete();
        });

        return $nomeCliente;
    }
}
