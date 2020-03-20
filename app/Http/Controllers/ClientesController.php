<?php

namespace App\Http\Controllers;

use App\Episodio;
use App\Http\Requests\ClientesFormRequest;
use App\Cliente;
use App\Services\CriadorDeCliente;
use App\Services\RemovedorDeCliente;
use App\Temporada;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\LeitorDeCliente;
use App\Representante;

// $letra = $_GET['criterio'];

class ClientesController extends Controller
{
//     public function __construct()
//     {
//         $this->middleware('auth');
//     }
    
    public function index(Request $request) {

//         if(!Auth::check()) {
//             echo "Não Autenticado";
//             exit();
//         }
        
        $letra = "";
        if(isset($_GET['criterio'])) {
            $letra = $_GET['criterio'];            
        }
        
        $clientes = Cliente::query()->orWhere('nome', 'LIKE', '%' . $letra . '%')
        ->orderBy('nome')
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

        $mensagem = $request->session()->get('mensagem');

        return view('clientes.index', compact('clientes', 'mensagem'),
               [
                "representantes" => Representante::query()->orderBy('nome')->get()
               ]);
    }

    public function create()
    {
        return view('clientes.create',
              [
                "representantes" => Representante::query()->orderBy('nome')->get()
              ]);
    }

    public function store(
        ClientesFormRequest $request,
        CriadorDeCliente $criadorDeCliente
    ) {

        $cnpjcpf = $request->cnpjcpf;
        $vendedor = $request->vendedor;
        $nome = $request->nome;
        $cliente = $criadorDeCliente->criarCliente(
            $nome,
            $request->endereco,
            $request->bairro,
            $request->cidade,
            $request->cep,
            $request->emailnfe,
            $request->email,
            $request->consumidorfina,
            $request->fiscaljuridico,
            $cnpjcpf,
            $vendedor,
            $vendedor
        );

        $request->session()
            ->flash(
                'mensagem',
                "Cliente {$cliente->id} criado com sucesso {$cliente->nome}"
            );

        return redirect()->route('listar_clientes',
            [
                "representantes" => Representante::query()->orderBy('nome')->get()
            ]
        );
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
        
        return view('clientes.update'
            , [
                "cliente" => Cliente::find($id),
                "representantes" => Representante::query()->orderBy('nome')->get()
              ]
            );
    }
    
    public function storeup(int $id, Request $request) {
        $cliente = Cliente::find($id);
        
        $cliente->nome = $request->nome;
        $cliente->endereco= $request->endereco;
        $cliente->bairro= $request->bairro;
        $cliente->cidade= $request->cidade;
        $cliente->cep= $request->cep;
        $cliente->emailnfe= $request->emailnfe;
        $cliente->email= $request->email;
        $cliente->consumidorfina= $request->consumidorfina;
        $cliente->fiscaljuridico= $request->fiscaljuridico;
        $cliente->cnpjcpf= $request->cnpjcpf;
        $cliente->vendedor= $request->vendedor;
        $cliente->vendedor_id = $request->vendedor;
       
        $cliente->save();
 
        $request->session()
            ->flash(
                'mensagem',
                "Cliente {$cliente->id} alterado com sucesso {$cliente->nome}"
             );
            
        return redirect()->route('listar_clientes');
    }
    
    public function editaNome(int $id, Request $request)
    {
        $cliente = Cliente::find($id);
        $novoNome = $request->nome;
        $cliente->nome = $novoNome;
        $cliente->save();
    }
    
}
