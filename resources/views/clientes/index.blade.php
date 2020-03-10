@extends('layout')

@section('cabecalho')
Cadastro de Clientes
@endsection

@section('conteudo')

@include('mensagem', ['mensagem' => $mensagem])

     <div class="btn btn-group d-flex justify-content-between mb-2 align-items-center">
            <a href="{{ route('form_criar_cliente') }}" class=" btn-dark btn-group-item btn-ml">Adicionar</a>
     	  	<form action="{{ url('/clientes')}}"  method="get">
     	  	     <div>
     	  	      @csrf
         	  	  <input type="text" name="criterio" id="criterio" placeholder="Buscar..." class="btn-group-item">
                  <span >
                    <button type="submit">Ok!</button>
                  </span>
                  </div>
     	  	</form>
     </div>


      
<ul class="list-group">
	<li class="list-group-item d-flex justify-content-between align-items-baseline">
		<span><strong>Codigo</strong></span>
		<span><strong>Nome</strong></span> 
		<span><strong>Vendedor</strong></span> 
		<span><strong>CNPJ</strong></span> 
		<span><strong>Status</strong></span> 
	</li>
	
    @foreach($clientes as $cliente)
    <li class="list-group-item d-flex justify-content-between align-items-baseline">
        <span id="nome-cliente-{{ $cliente->id }}"> {{ $cliente->id }} </span>
        <span id="nome-cliente-{{ $cliente->nome }}"> {{ $cliente->nome }} </span>
        <span id="nome-cliente-{{ $cliente->vendedor }}"> {{ $cliente->vendedor }} </span>
        <span id="nome-cliente-{{ $cliente->cnpjcpf }}"> {{ $cliente->cnpjcpf }} </span>

        <div class="input-group w-50" hidden id="input-nome-cliente-{{ $cliente->id }}">
            <input type="text" class="form-control" value="{{ $cliente->nome }}">
            <div class="input-group-append">
                <button class="btn btn-primary" onclick="editarCliente({{ $cliente->id }})">
                    <i class="fas fa-check"></i>
                </button>
                @csrf
            </div>
        </div>

        <span class="d-flex">
            <button class="btn btn-info btn-sm mr-1" onclick="toggleInput({{ $cliente->id }})">
                <i class="fas fa-edit"></i>
            </button>
            <form method="post" action="/clientes/{{ $cliente->id }}"
                  onsubmit="return confirm('Tem certeza que deseja remover {{ addslashes($cliente->nome) }}?')">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger btn-sm">
                    <i class="far fa-trash-alt"></i>
                </button>
            </form>
            <form method="post" action="/clientes/{{ $cliente->id }}/alterar">
                @csrf
                <button class="btn btn-danger btn-sm ml-1">
                    <i class="fab fa-adn"></i>
                </button>                
            </form>
        </span>
        
    </li>
    @endforeach
</ul>

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
