@extends('layout')

@section('cabecalho')
Cadastro de T&iacute;tulos
@endsection

@section('conteudo')

@include('mensagem', ['mensagem' => $mensagem])

<?php
    function Mask($mask,$str){
        
        $str = str_replace(" ","",$str);
        
        for($i=0;$i<strlen($str);$i++){
            $mask[strpos($mask,"#")] = $str[$i];
        }
        
        return $mask;
        
    }
?>

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

<table class="table">
    <thead>
       <tr>
    		<th><strong>Sinal</strong></th>
    		<th><strong>Prefixo</strong></th>
    		<th><strong><a href="{{ route('listar_titulos') }}">T&iacute;tulo</a></strong></th>
    		<th><strong>Parcela</strong></th>
    		<th><strong>Cliente</strong></th>
    		<th><strong>Dt Emiss&atilde;o</strong></th>
    		<th><strong><a href="{{ route('listar_titulos_vencimento') }}">Vencimento</a></strong></th>
    		<th><strong>Valor</strong></th>
    		<th><strong>N&uacute;mero Banc&aacute;rio</strong></th>
    		<th><strong>Hist&oacute;rico</strong></th>
    		<th><strong>Pedido</strong></th>
    		<th><strong>NF</strong></th>
    		<th><strong>Status</strong></th>
    	</tr>
    </thead>

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

        <tbody>
            <tr>    
                <td>
                  <?php  if (($titulo->numerobancario==0) && (is_null($titulo->pagamento))) {?>
                           <div ><span class="btn btn-success btn-sm ml-1"></span></div>
                  <?php } ?>
                  <?php  if (($titulo->numerobancario>0) && ($titulo->pagamento == null)) {?>
                           <div ><span class="btn btn-dark btn-sm ml-1"></div>
                  <?php } ?>
                  <?php  if ($titulo->pagamento != null) {?>
                           <div ><span class="btn btn-danger btn-sm ml-1"></span></div>
                  <?php } ?>      
                </td>
              
                <td><div id="nome-titulo-{{ $titulo->prefixo }}"> {{ $titulo->prefixo }} </div></td>
                <td><div id="nome-titulo-{{ $titulo->titulo }}"> {{ $titulo->titulo }} </div></td>
                <td><div id="nome-titulo-{{ $titulo->parcela }}"> {{ $titulo->parcela }} </div></td>
                <td><div id="nome-titulo-{{ $titulo->cliente }}"> {{ $titulo->cliente }} </div></td>
                <td><div id="nome-titulo-{{ $titulo->emissao }}"> {{ $dataEmissao }} </div></td>
                <td><div id="nome-titulo-{{ $titulo->vencimento }}"> {{ $dataVencimento }} </div></td>
                <td><div id="nome-titulo-{{ $titulo->valor }}"> {{ $titulo->valor }} </div></td>
                <td><div id="nome-titulo-{{ $titulo->numerobancario }}"> {{ $titulo->numerobancario }} </div></td>
                <td><div id="nome-titulo-{{ $titulo->historico }}"> {{ $titulo->historico }} </div></td>
                <td><div id="nome-titulo-{{ $titulo->pedido_id }}"> {{ $titulo->pedido_id }} </div></td>
                <td><div id="nome-titulo-{{ $titulo->nota_id }}"> {{ $titulo->pedido_id }} </div></td>
                
                <div class="input-group w-50" hidden id="input-nome-titulo-{{ $titulo->id }}">
                    <input type="text" class="form-control" value="{{ $titulo->nome }}">
                    <div class="col input-group-append">
                        <button class="btn btn-primary" onclick="editarTitulo({{ $titulo->id }})">
                            <i class="fas fa-check"></i>
                        </button>
                        @csrf
                    </div>
                </div>            
                
                <td>
                <div class="d-flex">
    
                    <form method="post" action="/titulos/{{ $titulo->id }}"
                          onsubmit="return confirm('Tem certeza que deseja remover o T&iacute;tulo {{ addslashes($titulo->titulo) }} ?')">
                          @csrf
                          <button class="btn btn-danger btn-sm" title="Excluir">
                             <i class="far fa-trash-alt"></i>
                          </button>
                    </form>
                    <form method="post" action="/titulos/{{ $titulo->id}}/alterar">
                          @csrf
                          <button class="btn btn-primary btn-sm ml-1"><i class="fa fa-pencil-square-o"></i> Alterar</button>                               
                    </form>
                    @empty($titulo->pagamento)
                    <form method="post" action="/titulos/{{ $titulo->id}}/baixar">
                          @csrf
                          <button class="btn btn-primary btn-sm ml-1"><i class="fa fa-pencil-square-o"></i>&nbspBaixar&nbsp</button>                               
                    </form>
                    @endempty
                    @isset($titulo->pagamento)
                    <form method="post" action="/titulos/{{ $titulo->id}}/baixar">
                          @csrf
                          <button class="btn btn-primary btn-sm ml-1"><i class="fa fa-pencil-square-o"></i>  
                            <strike>&nbspBaixar&nbsp</strike></button>                               
                    </form>
                    @endisset                 
                </div>    
                </td>    
            </tr>
      </tbody>      
    @endforeach
   </table>    		    
@endsection
