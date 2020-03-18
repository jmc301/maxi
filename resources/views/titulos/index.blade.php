@extends('layout')

@section('cabecalho')
Cadastro de T&iacute;tulos
@endsection

@section('conteudo')

@include('mensagem', ['mensagem' => $mensagem])

     <div class="btn btn-group d-flex justify-content-between mb-2 align-items-center">
            <a href="{{ route('form_criar_titulo') }}" class=" btn-dark btn-group-item btn-ml">Adicionar</a>
     	  	<form action="{{ url('/titulos')}}"  method="get">
     	  	     <div>
     	  	      @csrf
         	  	  <input type="text" name="criterio" id="criterio" placeholder="Buscar..." class="btn-group-item">
                  <div >
                    <button type="submit">Ok!</button>
                  </div>
                  </div>
     	  	</form>
     </div>

<div class="row">
  <div class="col"><strong>Sinal</strong></div>
  <div class="col"><strong>Prefixo</strong></div>
  <div class="col"><strong>T&iacute;tulo</strong></div>
  <div class="col"><strong>Parcela</strong></div>
  <div class="col"><strong>Cliente</strong></div>
  <div class="col"><strong>Dt Emiss&atilde;o</strong></div>
  <div class="col"><strong>Vencimento</strong></div>
  <div class="col"><strong>Valor</strong></div>
  <div class="col"><strong>N&uacute;mero Banc&aacute;rio</strong></div>
  <div class="col"><strong>Hist&oacute;rico</strong></div>
  <div class="col"><strong>Status</strong></div>  
</div>

    @foreach($titulos as $titulo)
     <?php 
       $dataEmissao = " ";
       if ($titulo->emissao != null) {
           $dataEmissao = date_format(date_create($titulo->emissao ),"d/m/Y");
       }     

       $dataVencimento = " ";
       if ($titulo->vencimento != null) {
           $dataVencimento = date_format(date_create($titulo->vencimento ),"d/m/Y");
       }                   
     ?> 

     <div class="row">
       <?php  if (($titulo->numerobancario==0) && (is_null($titulo->pagamento))) {?>
               <div class="col"><span class="btn btn-success btn-sm ml-1"></span></div> 
      <?php } ?>
       <?php  if (($titulo->numerobancario>0) && ($titulo->pagamento == null)) {?>
               <div class="col"><span class="btn btn-dark btn-sm ml-1"></div> 
      <?php } ?>
       <?php  if ($titulo->pagamento != null) {?>
               <div class="col"><span class="btn btn-danger btn-sm ml-1"></span></div> 
      <?php } ?>      
        <div  class="col" id="nome-titulo-{{ $titulo->prefixo }}"> {{ $titulo->prefixo }} </div>
        <div class="col" id="nome-titulo-{{ $titulo->titulo }}"> {{ $titulo->titulo }} </div>
        <div class="col"  id="nome-titulo-{{ $titulo->parcela }}"> {{ $titulo->parcela }} </div>
        <div  class="col" id="nome-titulo-{{ $titulo->cliente }}"> {{ $titulo->cliente }} </div>
        <div  class="col" id="nome-titulo-{{ $titulo->emissao }}"> {{ $dataEmissao }} </div>
        <div  class="col" id="nome-titulo-{{ $titulo->vencimento }}"> {{ $dataVencimento }} </div>
        <div  class="col" id="nome-titulo-{{ $titulo->valor }}"> {{ $titulo->valor }} </div>
        <div  class="col" id="nome-titulo-{{ $titulo->numerobancario }}"> {{ $titulo->numerobancario }} </div>
       <div  class="col" id="nome-titulo-{{ $titulo->historico }}"> {{ $titulo->historico }} </div>
        
        <div class="col input-group w-50" hidden id="input-nome-titulo-{{ $titulo->id }}">
            <input type="text" class="form-control" value="{{ $titulo->nome }}">
            <div class="col input-group-append">
                <button class="btn btn-primary" onclick="editarTitulo({{ $titulo->id }})">
                    <i class="fas fa-check"></i>
                </button>
                @csrf
            </div>
        </div>
        
        
        <div class="col d-flex">

            <form method="post" action="/titulos/{{ $titulo->id }}"
                  onsubmit="return confirm('Tem certeza que deseja remover o T&iacute;tulo {{ addslashes($titulo->titulo) }} ?')">
                @csrf
                <button class="btn btn-danger btn-sm" title="Excluir">
                    <i class="far fa-trash-alt"></i>
                </button>
            </form>
            <form method="post" action="/titulos/{{ $titulo->id}}/alterar">
                @csrf
                <button class="btn btn-danger btn-sm ml-1" title="Alterar">
                    <i class="fab fa-adn"></i>
                </button>                
            </form>
        </div>        
    </div>    
    @endforeach
@endsection
