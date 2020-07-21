@extends('relatorio')

@section('cabecalho')
Relação de Clientes
@endsection

@section('conteudo')

<table class="table">
    <thead>
       <tr>
    		<th><strong>Codigo</strong></th>
    		<th><strong>Nome</strong></th>
    		<th><strong>Vendedor</strong></th>
    		<th><strong>CNPJ</strong> </th>
       </tr>
    </thead>
	
    @foreach($clientes as $cliente)
        <?php  
        $nomeRepresentante = "";
        foreach ($representantes as $representante) {
            if ($representante->id === $cliente->vendedor_id) {
                $nomeRepresentante = $representante->nome;
            }
        }
        ?>

        <tbody>
            <tr>    
                <td id="nome-cliente-{{ $cliente->id }}"> {{ $cliente->id }} </td>
                <td id="nome-cliente-{{ $cliente->nome }}"> {{ $cliente->nome }} </td>
                <td id="nome-cliente-{{ $cliente->vendedor }}"> {{ $nomeRepresentante }} </td>
                <td id="nome-cliente-{{ $cliente->cnpjcpf }}"> {{ $cliente->cnpjcpf }} </td>

            </tr>
        </tbody>
    @endforeach
</table>

@endsection
