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
            $notas = Nota::query('notas')->where('pedido_id', '=', $pedido-_id);

            if (!empty($notas)) {
                foreach ($notas as $nota) {
                    if ($idPedido == $nota->pedido_id) {
                        $nota->delete();
                    }
                }
            }

            $pedido->delete();
        });

        return $idPedido;
    }
}
