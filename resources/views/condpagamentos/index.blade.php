@extends('layout')

@section('cabecalho')
Cadastro de Condição de Pagamento
@endsection

@section('conteudo')

@include('mensagem', ['mensagem' => $mensagem])

     <div class="btn btn-group d-flex justify-content-between mb-2 align-items-center">
            <a href="{{ route('form_criar_condpagamento') }}" class=" btn-dark btn-group-item btn-ml">Adicionar</a>
     	  	<form action="{{ url('/condpagamentos')}}"  method="get">
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
  <div class="col"><strong>Descrição</strong></div>
  <div class="col"><strong>Dias</strong></div>
  <div class="col" align="right"><strong>Status</strong></div>
</div>

    @foreach($condpagamentos as $condpagamento)

     <div class="row">
        <div  class="col" id="nome-condpagamento-{{ $condpagamento->id }}"> {{ $condpagamento->id }} </div>
        <div class="col" id="nome-condpagamento-{{ $condpagamento->nome }}"> {{ $condpagamento->descricao }} </div>
        <div class="col" id="nome-condpagamento-{{ $condpagamento->nome }}"> 
              {{ $condpagamento->dias1 }} 
              @isset($condpagamento->dias2) / {{ $condpagamento->dias2 }} @endisset
              @isset($condpagamento->dias3) / {{ $condpagamento->dias3 }} @endisset
              @isset($condpagamento->dias4) / {{ $condpagamento->dias4 }} @endisset
              @isset($condpagamento->dias5) / {{ $condpagamento->dias5 }} @endisset
              @isset($condpagamento->dias6) / {{ $condpagamento->dias6 }} @endisset
              @isset($condpagamento->dias7) / {{ $condpagamento->dias7 }} @endisset
              @isset($condpagamento->dias8) / {{ $condpagamento->dias8 }} @endisset
              @isset($condpagamento->dias9) / {{ $condpagamento->dias9 }} @endisset
              @isset($condpagamento->dias10) / {{ $condpagamento->dias10 }} @endisset

         </div>
       
        <div class="col d-flex flex-row-reverse">
          <span class="d-flex">
            <form method="post" action="/condpagamentos/{{ $condpagamento->id }}"
                  onsubmit="return confirm('Tem certeza que deseja remover o cond.pagamento {{ addslashes($condpagamento->descricao) }} ?')">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger btn-sm" title="Excluir">
                    <i class="far fa-trash-alt"></i>
                </button>
            </form>
            <form method="post" action="/condpagamentos/{{ $condpagamento->id}}/alterar">
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
