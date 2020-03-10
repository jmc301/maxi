<?php
namespace App\Services;

use App\{Cliente};
use Illuminate\Support\Facades\DB;

class LeitorDeCliente
{
    public function LerCliente(int $clienteId): string
    {
        $cliente = new Cliente();
//         $nomeCliente = '';
        DB::transaction(function () use ($clienteId) {
            $cliente = Cliente::find($clienteId);
            echo " Nome do cliente =  " . $cliente->nome;
        });
            
            return $cliente;
    }
}
