@extends('layout')

@section('cabecalho')
<div class="row">
    <div class="col" style="hover:font-size: 5px;">Cadastro de Clientess</div>
    <div class="col" align="right"><a href="{{ route('gerar_pdf') }}">
         <img src="/storage/pdf/pdf.jpg" width="30px" height="40px" class="pdf"></a>  
     </div>
</div>      
@endsection

@section('conteudo')

@isset($mensagem)
@include('mensagem', ['mensagem' => $mensagem])
@endisset

 <div class="btn btn-group d-flex justify-content-between mb-2 align-items-center">
      <a href="{{ route('form_criar_cliente') }}" class=" btn-dark btn-group-item btn-ml">Adicionar</a>
      <form action="{{ url('/clientes')}}"  method="get">
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
    		<th><strong>Codigo</strong></th>
    		<th><strong>Nome</strong></th>
    		<th><strong>Vendedor</strong></th>
    		<th><strong>CNPJ</strong> </th>
    		<th><strong>Status</strong> </th>
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

                <div class="input-group w-50" hidden id="input-nome-cliente-{{ $cliente->id }}">
                    <input type="text" class="form-control" value="{{ $cliente->nome }}">
                    <div class="input-group-append">
                        <button class="btn btn-primary" onclick="editarCliente({{ $cliente->id }})">
                            <i class="fas fa-check"></i>
                        </button>
                        @csrf
                    </div>
                </div>

                <td>
                    <span class="d-flex">
                    <form method="post" action="/clientes/{{ $cliente->id }}"
                          onsubmit="return confirm('Tem certeza que deseja remover {{ addslashes($cliente->nome) }}?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">
                            <i class="far fa-trash-alt" title="Excluir"></i>
                        </button>
                    </form>
                    <form method="post" action="/clientes/{{ $cliente->id }}/alterar">
                        @csrf
                        <button class="btn btn-success btn-sm ml-1">
                            <i class="fab fa-adn" title="Alterar"></i>
                        </button>                
                    </form>
                    <form method="post" action="/clientes/{{ $cliente->id }}/pesquisar">
                        @csrf
                        <button class="btn btn-info btn-sm ml-1">
                            <i class="fas fa-binoculars" title="Pesquisar"></i>
                        </button>                                
                    </form>     
                    </span>       
                </td>
            </tr>
        </tbody>
    @endforeach
</table>

<script>
    function toggleInput(clienteId) {
        const nomeClienteEl = document.getElementById(`nome-cliente-${clienteId}`);
        const inputClienteEl = document.getElementById(`input-nome-cliente-${clienteId}`);
        if (nomeClienteEl.hasAttribute('hidden')) {
            nomeClienteEl.removeAttribute('hidden');
            inputClienteEl.hidden = true;
        } else {
            inputClienteEl.removeAttribute('hidden');
            nomeClienteEl.hidden = true;
        }
    }

    function editarCliente(clienteId) {
        let formData = new FormData();
        const nome = document
            .querySelector(`#input-nome-cliente-${clienteId} > input`)
            .value;
        const token = document
            .querySelector(`input[name="_token"]`)
            .value;
        formData.append('nome', nome);
        formData.append('_token', token);
        const url = `/clientes/${clienteId}/editaNome`;
        fetch(url, {
            method: 'POST',
            body: formData
        }).then(() => {
            toggleInput(clienteId);
            document.getElementById(`nome-cliente-${clienteId}`).textContent = nome;
        });
    }
</script>
@endsection
