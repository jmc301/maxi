<?php

namespace App\Http\Controllers;

use App\Http\Requests\PedidosFormRequest;
use App\Pedido;
use App\Cliente;
use App\Nota;
use App\Condpagamento;
use App\Services\CriadorDePedido; 
use App\Services\CriadorDeTituloPedido;
use App\Services\RemovedorDePedido;
use App\Temporada;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\LeitorDeCliente;
use App\Representante;
use Illuminate\Support\Facades\DB;

class PedidosController extends Controller
{
     public function __construct()
     {
         $this->middleware('auth');
     }
    
    public function index(Request $request) {

         if(!Auth::check()) {
             echo "Não Autenticado";
             exit();
         }
        
        $letra = "";
        if(isset($_GET['criterio'])) {
            $letra = $_GET['criterio'];            
        }
        
        if ($letra != "") {

            $pedidos = Pedido::query()->orWhere('nome', 'LIKE', '%' . $letra . '%')
            ->orderBy('pedido')
                ->get();

            $contador = 0;
            foreach ($clientes as $cliente) {
                    $contador++;
            }
                
            if ($contador==0) {
                $clientes = Cliente::query('clientes')->where('id', '=', $letra)
                ->orderBy('nome')
                ->get();
            }            

            $contador = 0;
            foreach ($clientes as $cliente) {
                $contador++;
            }
            if ($contador==0) {
                $clientes = Cliente::query('clientes')->where('vendedor', '=', $letra)
                ->orderBy('nome')
                ->get();
            }            

            $contador = 0;
            foreach ($clientes as $cliente) {
                $contador++;
            }
            if ($contador==0) {
                $clientes = Cliente::query()->orWhere('cnpjcpf', 'LIKE', '%' . $letra . '%')
                ->orderBy('nome')
                ->get();
            }    
        }        

        if($letra == "") {
            $pedidos = Pedido::query()->orderBy('pedido')->get();            
        }

        $mensagem = $request->session()->get('mensagem');

        return view('pedidos.index', compact('pedidos', 'mensagem'),
               [
                "clientes" => Cliente::query()->orderBy('nome')->get()
               ]
           );
    }

    public function create()
    {
        return view('pedidos.create',
              [
                "representantes" => Representante::query()->orderBy('nome')->get()
              ],
               [
                "clientes" => Cliente::query()->orderBy('nome')->get(),
                "condpagamentos" => CondPagamento::query()->orderBy('descricao')->get()
               ]              
          );
    }

    public function store(
        PedidosFormRequest $request,
        CriadorDePedido $criadorDePedido
    ) {
       
        $pedido = $criadorDePedido->criarPedido($request);

        $request->session()
            ->flash(
                'mensagem',
                "Pedido {$pedido->id} criado com sucesso {$pedido->id}"
            );

        return redirect()->route('listar_pedidos',
            [
                "clientes" => Cliente::query()->orderBy('nome')->get()
            ]
        );
    }

    public function destroy(Request $request, RemovedorDePedido $removedorDePedido)
    {
        $nomePedido = $removedorDePedido->removerPedido($request->id);
        $request->session()
            ->flash(
                'mensagem',
                "Pedido removido com sucesso"
            );
        return redirect()->route('listar_pedidos');
    }

    public function update(int $id, Request $request)
    {
        
        return view('pedidos.update'
            , [
                "pedido" => Pedido::find($id),
                "clientes" => Cliente::query()->orderBy('nome')->get(),
                "condpagamentos" => CondPagamento::query()->orderBy('descricao')->get()
              ]
            );
    }
    
    public function storeup(int $id, Request $request) {
        $pedido = Pedido::find($id);

        DB::beginTransaction();             
        $pedido->condicao_pagamento = $request->condicao_pagamento;
        $pedido->cliente_id = $request->cliente_id;       
        $pedido->valor = $request->valor;       
        $pedido->save();
        DB::commit();

        $request->session()
            ->flash(
                'mensagem',
                "Pedido {$pedido->id} alterado com sucesso"
             );
            
        return redirect()->route('listar_pedidos');
    }

    public function faturar(int $id, Request $request, CriadorDeTituloPedido $criadorDeTituloPedido) {
        $pedido = Pedido::find($id);
        $condpagamento = CondPagamento::find($pedido->condicao_pagamento);

        DB::beginTransaction();             

        // Gerar Nota Fiscal
        $nota = new Nota();
        $nota->nota = $pedido->id;
        $nota->data_emissao = date('Y-m-d');
        $nota->cliente_id = $pedido->cliente_id;
        $nota->pedido_id = $pedido->id;
        $nota->valor = $pedido->valor;
        $nota->save();

        $pedido->status = 'F';       
        $pedido->nota = $nota->id;
        $pedido->save();        

        $quantidadeParcelas = 0;
        if (isset($condpagamento->dias1))  $quantidadeParcelas++;
        if (isset($condpagamento->dias2))  $quantidadeParcelas++;
        if (isset($condpagamento->dias3))  $quantidadeParcelas++;
        if (isset($condpagamento->dias4))  $quantidadeParcelas++;
        if (isset($condpagamento->dias5))  $quantidadeParcelas++;
        if (isset($condpagamento->dias6))  $quantidadeParcelas++;
        if (isset($condpagamento->dias7))  $quantidadeParcelas++;
        if (isset($condpagamento->dias8))  $quantidadeParcelas++;
        if (isset($condpagamento->dias9))  $quantidadeParcelas++;
        if (isset($condpagamento->dias10)) $quantidadeParcelas++;

        $valorTitulo = ($pedido->valor / $quantidadeParcelas);

        if (isset($condpagamento->dias1)) {
          $tituloCriado = $criadorDeTituloPedido->criarTitulo($pedido, $quantidadeParcelas, $valorTitulo,  $condpagamento->dias1, 1);
        }
        if (isset($condpagamento->dias2)) {
          $tituloCriado = $criadorDeTituloPedido->criarTitulo($pedido, $quantidadeParcelas, $valorTitulo,  $condpagamento->dias2, 2);
        }
        if (isset($condpagamento->dias3)) {
          $tituloCriado = $criadorDeTituloPedido->criarTitulo($pedido, $quantidadeParcelas, $valorTitulo,  $condpagamento->dias3, 3);
        }
        if (isset($condpagamento->dias4)) {
          $tituloCriado = $criadorDeTituloPedido->criarTitulo($pedido, $quantidadeParcelas, $valorTitulo,  $condpagamento->dias4, 4);
        }
        if (isset($condpagamento->dias5)) {
          $tituloCriado = $criadorDeTituloPedido->criarTitulo($pedido, $quantidadeParcelas, $valorTitulo,  $condpagamento->dias5, 5);
        }

        DB::commit();

        $request->session()
            ->flash(
                'mensagem',
                "Pedido {$pedido->id} Faturado com sucesso"
             );
            
        return redirect()->route('listar_pedidos');
    }

    public function search(int $id, Request $request)
    {
        
        return view('clientes.search'
            , [
                "cliente" => Cliente::find($id),
                "representantes" => Representante::query()->orderBy('nome')->get()
              ]
            );
    }
        
    public function editaNome(int $id, Request $request)
    {
        $cliente = Cliente::find($id);
        $novoNome = $request->nome;
        $cliente->nome = $novoNome;
        $cliente->save();
    }
    
}
