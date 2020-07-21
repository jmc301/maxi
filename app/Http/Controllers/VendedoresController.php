<?php

namespace App\Http\Controllers;

use App\Representante;
use App\Services\CriadorDeRepresentante;
use App\Services\RemovedorDeRepresentante;
use Illuminate\Http\Request;
use App\Http\Requests\RepresentantesFormRequest;

class RepresentantesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(Request $request) {
        
        $letra = "";
        if(isset($_GET['criterio'])) {
            $letra = $_GET['criterio'];
        }
        
         $representantes = Representante::query()->orWhere('nome', 'LIKE', '%' . $letra . '%')
         ->orderBy('nome')
         ->get();
  
        $mensagem = $request->session()->get('mensagem');
        
        return view('representantes.index', compact('vendedores', 'mensagem'));
    }
    
    public function create()
    {
        return view('representantes.create');
    }
    
    public function store(
        RepresentantesFormRequest $request,
        CriadorDeRepresentante $criadorDeRepresentante
        ) { 
            $representante = $criadorDeRepresentante->criarRepresentante(
                $request->nome,
                );
          
            $request->session()
            ->flash(
                'mensagem',
                "Representante {$representante->nome} criado com sucesso "
            );
                        
            return redirect()->route('listar_representantes');
    }
    
    public function destroy(Request $request, RemovedorDeRepresentante $removedorDeRepresentante)
    {
        $nomeRepresentante = $removedorDeRepresentante->removerRepresentante($request->id);
        $request->session()
        ->flash(
            'mensagem',
            "Representante $nomeRepresentante removido com sucesso"
            );
        return redirect()->route('listar_representantes');
    }
    
    public function update(int $id, Request $request)
    {
        return view('representantes.update'
            , [
                "representante" => Representante::find($id)
            ]
            );
    }
    
    public function storeup(int $id, Request $request) {
        $representante = Representante::find($id);
        
        $representante->nome = $request->nome;
        $nome->save();
        
        $request->session()
        ->flash(
            'mensagem',
            "Representante {$representante->id} alterado com sucesso"
        );
        
        return redirect()->route('listar_representantes');
    }
}
