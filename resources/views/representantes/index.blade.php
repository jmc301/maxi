@extends('layout')

@section('cabecalho')
Cadastro de Vendedores
@endsection

@section('conteudo')

@include('mensagem', ['mensagem' => $mensagem])

     <div class="btn btn-group d-flex justify-content-between mb-2 align-items-center">
            <a href="{{ route('form_criar_representante') }}" class=" btn-dark btn-group-item btn-ml">Adicionar</a>
     	  	<form action="{{ url('/representantes')}}"  method="get">
     	  	     <div>
     	  	      @csrf
         	  	  <input type="text" name="criterio" id="criterio" placeholder="Buscar..." class="btn-group-item">
                  <div >
                    <button type="submit">Ok!</button>
                  </div>
                  </div>
     	  	</form>
     </div>

<div class="row" style="border-style: solid;">
  <div class="col"><strong>Código</strong></div>
  <div class="col"><strong>Nome</strong></div>
  <div class="col" align="right"><strong>Status</strong></div>
</div>

    @foreach($representantes as $representante)

     <div class="row">
        <div  class="col" id="nome-representante-{{ $representante->id }}"> {{ $representante->id }} </div>
        <div class="col" id="nome-representante-{{ $representante->nome }}"> {{ $representante->nome }} </div>
       
        <div class="col d-flex flex-row-reverse">
          <span class="d-flex">
            <form method="post" action="/representantes/{{ $representante->id }}"
                  onsubmit="return confirm('Tem certeza que deseja remover o Representante {{ addslashes($representante->nome) }} ?')">
                @csrf
                <button class="btn btn-danger btn-sm" title="Excluir">
                    <i class="far fa-trash-alt"></i>
                </button>
            </form>
            <form method="post" action="/representantes/{{ $representante->id}}/alterar">
                @csrf
                <button class="btn btn-success btn-sm ml-1" title="Alterar">
                    <i class="fab fa-adn"></i>
                </button>                
            </form>
          </span>
        </div>        
    </div>    
    @endforeach
@endsection
