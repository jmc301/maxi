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
                  <span >
                    <button type="submit">Ok!</button>
                  </span>
                  </div>
     	  	</form>
     </div>


      
<ul class="list-group">
	<li class="list-group-item d-flex justify-content-between align-items-baseline">
    <tr>
		<td><span><strong>Prefixo</strong></span></td>
		<td><span><strong>T&iacute;tulo</strong></span> </td>
		<td><span><strong>Parcela</strong></span> </td>
		<td><span><strong>Cliente</strong></span> </td>
		<td><span><strong>Dt Emiss&atilde;o</strong></span> </td>
		<td><span><strong>Vencimento</strong></span> </td>
		<td><span><strong>Valor</strong></span> </td>
		<td><span><strong>N&uacute;mero Banc&aacute;rio</strong></span> </td>
    <td><span><strong>Hist&oacute;rico</strong></span> </td>
    <td><span><strong>Status</strong></span> </td>
    </tr>
	</li>
	
    @foreach($titulos as $titulo)
    <li class="list-group-item d-flex justify-content-between align-items-center">
       <tr>        
       <?php  if (($titulo->numerobancario==0) && (is_null($titulo->pagamento))) {?>
               <td><span class="btn btn-success btn-sm ml-1"></span></td> 
      <?php } ?>
       <?php  if (($titulo->numerobancario>0) && ($titulo->pagamento == null)) {?>
               <td><span class="btn btn-dark btn-sm ml-1"></span></td> 
      <?php } ?>
       <?php  if ($titulo->pagamento != null) {?>
               <td><span class="btn btn-danger btn-sm ml-1"></span></td> 
      <?php } ?>      
       <td><span id="nome-titulo-{{ $titulo->prefixo }}"> {{ $titulo->prefixo }} </span></td>
        <td><span id="nome-titulo-{{ $titulo->titulo }}"> {{ $titulo->titulo }} </span></td>
        <td><span id="nome-titulo-{{ $titulo->parcela }}"> {{ $titulo->parcela }} </span></td>
        <td><span id="nome-titulo-{{ $titulo->cliente }}"> {{ $titulo->cliente }} </span></td>
        <td><span id="nome-titulo-{{ $titulo->emissao }}"> {{ $titulo->emissao }} </span></td>
        <td><span id="nome-titulo-{{ $titulo->vencimento }}"> {{ $titulo->vencimento }} </span></td>
        <td><span id="nome-titulo-{{ $titulo->valor }}"> {{ $titulo->valor }} </span></td>
        <td><span id="nome-titulo-{{ $titulo->numerobancario }}"> {{ $titulo->numerobancario }} </span></td>
       <td><span id="nome-titulo-{{ $titulo->historico }}"> {{ $titulo->historico }} </span></td>
        <td>
        <div class="input-group w-50" hidden id="input-nome-titulo-{{ $titulo->id }}">
            <input type="text" class="form-control" value="{{ $titulo->nome }}">
            <div class="input-group-append">
                <button class="btn btn-primary" onclick="editarTitulo({{ $titulo->id }})">
                    <i class="fas fa-check"></i>
                </button>
                @csrf
            </div>
        </div>
        </td>
        <td>
        <span class="d-flex">

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
        </span>
        </td>

        </tr>
    </li>
    @endforeach
</ul>
@endsection
