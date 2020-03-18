<?php

namespace App\Http\Controllers;

use App\Titulo;
use App\Services\CriadorDeTitulo;
use App\Services\RemovedorDeTitulo;
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
            if (empty($request->desconto)) {
                $request->desconto = 0;
            }
            if (empty($request->multa)) {
                $request->multa = 0;
            }
            if (empty($request->juros)) {
                $request->juros = 0;
            }
            if (empty($request->valor_pago)) {
                $request->valor_pago = 0;
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
                $request->historico,
                $request->desconto,
                $request->multa,
                $request->juros,
                $request->valor_pago
                );
          
            $request->session()
            ->flash(
                'mensagem',
                "Titulo {$titulo->titulo} criado com sucesso {$titulo->cliente}"
            );
            
            
            return redirect()->route('listar_titulos');
    }
    
    public function destroy(Request $request, RemovedorDeTitulo $removedorDeTitulo)
    {
        $nomeTitulo = $removedorDeTitulo->removerTitulo($request->id);
        $request->session()
        ->flash(
            'mensagem',
            "Titulo $nomeTitulo removido com sucesso"
            );
        return redirect()->route('listar_titulos');
    }
    
    public function update(int $id, Request $request)
    {
        return view('titulos.update'
            , [
                "titulo" => Titulo::find($id)
            ]
            );
    }
    
    public function storeup(int $id, Request $request) {
        $titulo = Titulo::find($id);
        
        // Realiza o Cancelamento do Titulo
         if (!empty($titulo->pagamento)) {
            $request->pagamento = null;
            $request->desconto = 0;
            $request->multa = 0;
            $request->juros = 0;
            $request->valor_pago = 0;
         }



         $titulo->prefixo = $request->prefixo;
         $titulo->parcela = $request->parcela;
         $titulo->emissao  = $request->emissao;
         $titulo->vencimento = $request->vencimento;
         $titulo->pagamento  = $request->pagamento;
         $titulo->cliente   = $request->cliente;
         $titulo->valor    = $request->valor;
         $titulo->numerobancario = $request->numerobancario;
         $titulo->historico = $request->historico;                
         $titulo->desconto    = $request->desconto;
         $titulo->multa    = $request->multa;
         $titulo->juros    = $request->juros;
         $titulo->valor_pago    = $request->valor_pago;

        $titulo->save();
        
        $request->session()
        ->flash(
            'mensagem',
            "Titulo {$titulo->id} alterado com sucesso {$titulo->titulo}"
        );
        
        return redirect()->route('listar_titulos');
    }
    
//     public function editaNome(int $id, Request $request)
//     {
//         $cliente = Cliente::find($id);
//         $novoNome = $request->nome;
//         $cliente->nome = $novoNome;
//         $cliente->save();
//     }
    
}