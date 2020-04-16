<?php

namespace App\Http\Controllers;

use App\CondPagamento;
use App\Services\CriadorDeCondpagamento;
use App\Services\RemovedorDeCondpagamento;
use Illuminate\Http\Request;
use App\Http\Requests\CondpagamentosFormRequest;

class CondPagamentosController extends Controller
{
    public function index(Request $request) {
        
        $letra = "";
        if(isset($_GET['criterio'])) {
            $letra = $_GET['criterio'];
        }
        
         $condpagamentos = CondPagamento::query()->orWhere('descricao', 'LIKE', '%' . $letra . '%')
         ->orderBy('descricao')
         ->get();
  
        $mensagem = $request->session()->get('mensagem');
        
        return view('condpagamentos.index', compact('condpagamentos', 'mensagem'));
    }
    
    public function create()
    {
        return view('condpagamentos.create');
    }
    
    public function store(
        CondpagamentosFormRequest $request,
        CriadorDeCondPagamento $criadorDeCondPagamento
        ) { 
            $condpagamento = $criadorDeCondPagamento->criarCondpagamento($request);
          
            $request->session()
            ->flash(
                'mensagem',
                "Cond.Pagamento {$condpagamento->descricao} criado com sucesso "
            );
                        
            return redirect()->route('listar_condpagamentos');
    }
    
    public function destroy(Request $request, RemovedorDeCondPagamento $removedorDeCondPagamento)
    {
        $nomeCondPagamento = $removedorDeCondPagamento->removerCondPagamento($request->id);
        $request->session()
        ->flash(
            'mensagem',
            "Cond.Pagamento $nomeCondPagamento removido com sucesso"
            );
        return redirect()->route('listar_condpagamentos');
    }
    
    public function update(int $id, Request $request)
    {
        return view('condpagamentos.update'
            , [
                "condpagamento" => CondPagamento::find($id)
            ]
            );
    }
    
    public function storeup(int $id, Request $request) {
        $condpagamento = CondPagamento::find($id);
        
        $condpagamento->descricao = $request->descricao;
        $condpagamento->dias1     = $request->dias1;
        $condpagamento->dias2     = $request->dias2;
        $condpagamento->dias3     = $request->dias3;
        $condpagamento->dias4     = $request->dias4;
        $condpagamento->dias5     = $request->dias5;
        $condpagamento->dias6     = $request->dias6;
        $condpagamento->dias7     = $request->dias7;
        $condpagamento->dias8     = $request->dias8;
        $condpagamento->dias9     = $request->dias9;
        $condpagamento->dias10    = $request->dias10;
        $condpagamento->save();
        
        $request->session()
        ->flash(
            'mensagem',
            "Cond.Pagamento {$condpagamento->id} alterada com sucesso"
        );
        
        return redirect()->route('listar_condpagamentos');
    }
}
