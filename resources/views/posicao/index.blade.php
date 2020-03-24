@extends('layout')

@section('cabecalho')
Posição Financeira
@endsection

@section('conteudo')

@include('mensagem', ['mensagem' => $mensagem])

     <div class="btn btn-group mb-2">
            <a href="#" class=" btn-dark btn-group-item btn-ml"></a>
     	  	<form action="{{ url('/posicao')}}"  method="get">
               
               <div class="row">
                      <div class="col form-check">
                        <label class="form-check-label">
                          <!--
                          <input type="checkbox" class="form-check-input" onclick="if(this.checked){this.form.submit()}"value="S" name="avencer">A Vencer  -->
                          <input type="checkbox" class="form-check-input" value="S" name="avencer">A Vencer
                        </label>
                      </div>
                      <div class="col form-check">
                        <label class="form-check-label">
                          <input type="checkbox" class="form-check-input" value="S" name="pago">Pagos
                        </label>
                      </div>
                      <div class="col form-check">
                        <label class="form-check-label">
                          <input type="checkbox" class="form-check-input" value="S" name="vencido">Vencidos
                        </label>
                      </div>
                      <div class="col form-check">
                        <label class="form-check-label">
                          <input type="checkbox" class="form-check-input" value="" disabled>Faturamento
                        </label>
                      </div>               
                      <div class="col form-check">
                        <label class="form-check-label">
                          <input type="checkbox" class="form-check-input" value="" disabled>Pedidos
                        </label>
                      </div>               

                  @csrf
                  <div class="col">
                          <input type="text" name="criterio" id="criterio" placeholder="Buscar..." class="btn-group-item">
                      </div>
                      <div class="col">
                          <button type="submit">Ok!</button>
                      </div>
                </div>
     	  	</form>
     </div>

<div class="row" style="border-style: solid;">
  <div class="col"><strong>Sinal</strong></div>
  <div class="col"><strong>Prefixo</strong></div>
  <div class="col"><strong>T&iacute;tulo</strong></div>
  <div class="col"><strong>Parcela</strong></div>
  <div class="col"><strong>Cliente</strong></div>
  <div class="col"><strong>Emiss&atilde;o</strong></div>
  <div class="col"><strong>Vencimento</strong></div>
  <div class="col"><strong>Valor</strong></div>
  <div class="col"><strong>N&uacute;m.Banc&aacute;rio</strong></div>
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
        <div class="col" id="nome-titulo-{{ $titulo->prefixo }}"> {{ $titulo->prefixo }} </div>
        <div class="col" id="nome-titulo-{{ $titulo->titulo }}"> {{ $titulo->titulo }} </div>
        <div class="col" id="nome-titulo-{{ $titulo->parcela }}"> {{ $titulo->parcela }} </div>
        <div class="col" id="nome-titulo-{{ $titulo->cliente }}"> {{ $titulo->cliente }} </div>
        <div class="col" id="nome-titulo-{{ $titulo->emissao }}"> {{ $dataEmissao }} </div>
        <div class="col" id="nome-titulo-{{ $titulo->vencimento }}"> {{ $dataVencimento }} </div>
        <div class="col" id="nome-titulo-{{ $titulo->valor }}"> {{ $titulo->valor }} </div>
        <div class="col" id="nome-titulo-{{ $titulo->numerobancario }}"> {{ $titulo->numerobancario }} </div>
        <div class="col" id="nome-titulo-{{ $titulo->historico }}"> {{ $titulo->historico }} </div>
        <div class="col d-flex">
         @isset($titulo->pagamento)
            <div  class="col" id="nome-titulo-status" name="pago"><font size=2 color="blue">Pago</font></div>
         @endisset

         @empty($titulo->pagamento)          
            <?php 
              $hoje = date('Y-m-d');
              if ($titulo->vencimento<$hoje) {
            ?>
                @empty($titulo->pagamento)
                  <div  class="col" id="nome-titulo-status" name="vencido1"><font size=2 color="red">Vencido</font></div>
                @endempty
            <?php } else { ?>
                  <div  class="col" id="nome-titulo-status" name="avencer1"><font size=2 color="gray">Vencer</font></div>
            <?php } ?>
              <div  class="col" id="nome-titulo-status" name="pedido1"><font size=2 color="gray"></font></div
              <div  class="col" id="nome-titulo-status" name="faturamento1"><font size=2 color="gray"></font></div
         @endempty

         </div>        
    </div>    
    @endforeach
@endsection
