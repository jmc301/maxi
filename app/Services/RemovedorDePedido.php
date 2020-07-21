<?php
namespace App\Services;

use App\Pedido;
use App\Nota;
use Illuminate\Support\Facades\DB;

class RemovedorDePedido
{
    public function removerPedido(int $pedidoId): int
    {
        $idPedido = '';

        DB::transaction(function () use ($pedidoId, &$idPedido) {
            $pedido = Pedido::find($pedidoId);
            $idPedido = $pedido->id;

            //$pedidos = Pedido::query()->orderBy('pedido')->get();
            //$clientes = Cliente::query('clientes')->where('id', '=', $letra)
            //$notas = Nota::query()->where('pedido_id', '=', $pedido->id);
            //$notas = Nota::query()->get(); 
            //$notax = Nota::query()->where('pedido_id', '=', $pedidoId);
            //$notas = Nota::query()->where('pedido_id', '=', $pedidoId);

            $nota = Nota::find($pedido->nota);

            if (!empty($nota)) {
                $nota->delete();
            }

            $pedido->delete();
        });

        return $idPedido;
    }
}
