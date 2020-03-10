<?php

namespace App\Http\Controllers;

use App\Titulo;
use App\Services\CriadorDeTitulo;
use App\Services\RemovedorDeCliente;
use Illuminate\Http\Request;
use App\Http\Requests\TitulosFormRequest;

// $letra = $_GET['criterio'];

class TitulosController extends Controller
{
    public function index(Request $request) {
        
        $letra = "";
        if(isset($_GET['criterio'])) {
            $letra = $_GET['criterio'];
        }
        
         $titulos = Titulo::query()->orWhere('titulo', 'LIKE', '%' . $letra . '%')
         ->orderBy('titulo')
         ->get();
        
         $contador = 0;
         foreach ($titulos as $titulo) {
             $contador++;
         }
        
//         if ($contador==0) {
//             $titulos = Titulo::query('titulos')->where('titulo', '=', $letra)
//             ->orderBy('titulo')
//             ->get();
//         }
        
//         $contador = 0;
//         foreach ($titulos as $titulos) {
//             $contador++;
//         }
//         if ($contador==0) {
//             $clientes = Titulo::query('titulos')->where('titulo', '=', $letra)
//             ->orderBy('titulo')
//             ->get();
//         }
        
//         $contador = 0;
//         foreach ($titulos as $titulo) {
//             $contador++;
//         }
//         if ($contador==0) {
//             $titulos = Titulo::query()->orWhere('titulo', 'LIKE', '%' . $letra . '%')
//             ->orderBy('titulo')
//             ->get();
//         }
        if ($contador==0) {
            $titulos = Titulo::query()
            ->orderBy('titulo')
            ->get();
        }
        
//         var_dump($titulos);
//         exit;
        
        $mensagem = $request->session()->get('mensagem');
        
        return view('titulos.index', compact('titulos', 'mensagem'));
    }
    
    public function create()
    {
        return view('titulos.create');
    }
    
    public function store(
        TitulosFormRequest $request,
        CriadorDeTitulo $criadorDeTitulo
        ) { 
            if (empty($request->pagamento)) {
               $request->pagamento = " "; 
            }
            if (empty($request->numerobancario)) {
               $request->numerobancario = 0; 
            }
            if (empty($request->historico)) {
               $request->historico = " "; 
            }

            $titulo = $criadorDeTitulo->criarTitulo(
                $request->titulo,
                $request->prefixo,
                $request->parcela,
                $request->emissao,
                $request->vencimento,
                $request->pagamento,
                $request->cliente,
                $request->valor,
                $request->numerobancario,
                $request->historico                
                );
          
            $request->session()
            ->flash(
                'mensagem',
                "Titulo {$titulo->titulo} criado com sucesso {$titulo->cliente}"
            );
            
            
            return redirect()->route('listar_titulos');
    }
    
    public function destroy(Request $request, RemovedorDeCliente $removedorDeCliente)
    {
        $nomeCliente = $removedorDeCliente->removerCliente($request->id);
        $request->session()
        ->flash(
            'mensagem',
            "Cliente $nomeCliente removido com sucesso"
            );
        return redirect()->route('listar_clientes');
    }
    
    public function update(int $id, Request $request)
    {
        //         $cliente = Cliente::find($id);
        
        return view('titulos.update'
            , [
                "titulo" => Titulo::find($id)
            ]
            );
    }
    
    public function storeup(int $id, Request $request) {
        $titulo = Titulo::find($id);
        
        $titulo->nome = $request->nome;
        $titulo->endereco= $request->endereco;
        $titulo->bairro= $request->bairro;
        $titulo->cidade= $request->cidade;
        $titulo->cep= $request->cep;
        $titulo->emailnfe= $request->emailnfe;
        $titulo->email= $request->email;
        $titulo->consumidorfina= $request->consumidorfina;
        $titulo->fiscaljuridico= $request->fiscaljuridico;
        $titulo->cnpjcpf= $request->cnpjcpf;
        $titulo->vendedor= $request->vendedor;
        
        $titulo->save();
        
        $request->session()
        ->flash(
            'mensagem',
            "Cliente {$titulo->id} alterado com sucesso {$titulo->nome}"
        );
        
        return redirect()->route('listar_clientes');
    }
    
//     public function editaNome(int $id, Request $request)
//     {
//         $cliente = Cliente::find($id);
//         $novoNome = $request->nome;
//         $cliente->nome = $novoNome;
//         $cliente->save();
//     }
    
}
