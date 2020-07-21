@extends('layout')

@section('cabecalho')
Cadastro de Pedidos
@endsection

@section('conteudo')

@include('mensagem', ['mensagem' => $mensagem])

 <div class="btn btn-group d-flex justify-content-between mb-2 align-items-center">
      <a href="{{ route('form_criar_pedido') }}" class=" btn-dark btn-group-item btn-ml">Adicionar</a>
      <form action="{{ url('/pedidos')}}"  method="get">
        <div>
            @csrf
            <input type="text" name="criterio" id="criterio" placeholder="Buscar..." class="btn-group-item">
            <span>
                <button type="submit">Ok!</button>
            </span>
        </div>
    </form>
</div>

<table class="table">
    <thead>
       <tr>
    		<th><strong>Pedido</strong></th>
    		<th><strong>Data</strong></th>
    		<th><strong>Cliente</strong></th>
            <th><strong>Situação</strong></th>
    		<th><strong>Status</strong> </th>
       </tr>
    </thead>
	
    @foreach($pedidos as $pedido)
        <?php  
        $nomeCliente = "";
        foreach ($clientes as $cliente) {
            if ($cliente->id === $pedido->cliente_id) {
                $nomeCliente = $cliente->nome;
            }
        }
        $data_pedido = date_format(date_create($pedido->data ),"d/m/Y");
        ?>

        <tbody>
            <tr>    
                <td id="nome-cliente-{{ $cliente->id }}"> {{ $pedido->id }} </td>
                <td id="nome-cliente-{{ $cliente->id }}"> {{ $data_pedido }} </td>
                <td id="nome-cliente-{{ $cliente->nome }}"> {{ $nomeCliente }} </td>
                @empty($pedido->status)
                 <td id="nome-cliente-situacao">Em Aberto</td>
                @endempty

                @isset($pedido->status)
                 <td id="nome-cliente-situacao">Faturado - NF {{ $pedido->id }}</td>
                @endisset

                <td>
                    <span class="d-flex">
                        <form method="post" action="/pedidos/{{ $pedido->id }}"
                              onsubmit="return confirm('Tem certeza que deseja remover pedido {{ addslashes($pedido->id) }}?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">
                                <i class="far fa-trash-alt" title="Excluir"></i>
                            </button>
                        </form>
                        <form method="post" action="/pedidos/{{ $pedido->id }}/alterar">
                            @csrf                            
                            <button class="btn btn-primary btn-sm ml-1">                               
                                Alterar
                            </button>
                           
                        </form>
                        <form method="post" action="/pedidos/{{ $pedido->id }}/faturar">
                            @csrf
                            @empty($pedido->status)
                            <button class="btn btn-primary btn-sm ml-1">Faturar</button>
                            @endempty
                            @isset($pedido->status)
                            <button class="btn btn-primary btn-sm ml-1" disabled>Faturar</button>
                            @endisset
                        </form>                        
                    </span>       
                </td>
            </tr>
        </tbody>
    @endforeach
</table>

@endsection
