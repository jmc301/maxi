@extends('layout')

@section('cabecalho')
Posição Financeira:  {{ $cliente->nome }}
@endsection

@section('conteudo')

@include('mensagem', ['mensagem' => $mensagem])

<!--
     <div class="btn btn-group mb-2">
            <a href="#" class=" btn-dark btn-group-item btn-ml"></a>
     	  	<form action="{{ url('/posicao')}}"  method="get">
               
               <div class="row">
                      <div class="col form-check">
                        <label class="form-check-label">
                          <!-
                          <input type="checkbox" class="form-check-input" onclick="if(this.checked){this.form.submit()}"value="S" name="avencer">A Vencer  ->
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
-->

          <form action="/posicao/{id}">
              <div class="row ">
                      <div class="col form-check pb-2">
                        <label class="form-check-label">
                          <button name="avencer" class="btn btn-primary mt-2" onclick="javascript: popavencer();">
                          A Vencer</button>
                        </label>
                      </div>
                      <div class="col form-check">
                        <label class="form-check-label">
                          <button name="pago" class="btn btn-primary mt-2" onclick="javascript: poppagos();">Pagos</button>
                        </label>
                      </div>
                      <div class="col form-check">
                        <label class="form-check-label">
                          <button name="vencidos" class="btn btn-primary mt-2" onclick="javascript: popvencidos();">Vencidos</button>
                        </label>
                      </div>
                      <div class="col form-check">
                        <label class="form-check-label">
                          <button class="btn btn-primary mt-2" onclick="javascript: popfatura();" disabled>Faturamento</button>
                        </label>
                      </div>               
                      <div class="col form-check">
                        <label class="form-check-label">
                          <button class="btn btn-primary mt-2" onclick="javascript: poppedidos();" disabled>Pedidos</button>
                        </label>
                      </div>               
                      <div class="col form-check">
                        <label class="form-check-label">
                          <button class="btn btn-primary mt-2">Todos</button>
                        </label>
                      </div>     
                      <div class="col">
                      <input type="text" name="id" id="id" value="{{ $id }}" hidden>    
                      </div>      
          </form>     

<table class="table">
    <thead>
       <tr>
          <th><strong>Sinal</strong></th>
          <th><strong>Prefixo</strong></th>
          <th><strong>T&iacute;tulo</strong></th>
          <th><strong>Parcela</strong></th>
          <th><strong>Cliente</strong></th>
          <th><strong>Emiss&atilde;o</strong></th>
          <th><strong>Vencimento</strong></th>
          <th><strong>Valor</strong></th>
          <th><strong>N&uacute;m.Banc&aacute;rio</strong></th>
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
            <?php  if (($titulo->numerobancario==0) && (is_null($titulo->pagamento))) {?>
                     <td><span class="btn btn-success btn-sm ml-1"></span></td> 
            <?php } ?>
             <?php  if (($titulo->numerobancario>0) && ($titulo->pagamento == null)) {?>
                     <td><span class="btn btn-dark btn-sm ml-1"></td> 
            <?php } ?>
             <?php  if ($titulo->pagamento != null) {?>
                     <td><span class="btn btn-danger btn-sm ml-1"></span></td> 
            <?php } ?>     

            <td id="nome-titulo-{{ $titulo->prefixo }}"> {{ $titulo->prefixo }} </td>
            <td id="nome-titulo-{{ $titulo->titulo }}"> {{ $titulo->titulo }} </td>
            <td id="nome-titulo-{{ $titulo->parcela }}"> {{ $titulo->parcela }} </td>
            <td id="nome-titulo-{{ $titulo->cliente }}"> {{ $titulo->cliente }} </td>
            <td id="nome-titulo-{{ $titulo->emissao }}"> {{ $dataEmissao }} </td>
            <td id="nome-titulo-{{ $titulo->vencimento }}"> {{ $dataVencimento }} </td>
            <td id="nome-titulo-{{ $titulo->valor }}"> {{ $titulo->valor }} </td>
            <td id="nome-titulo-{{ $titulo->numerobancario }}"> {{ $titulo->numerobancario }} </td>
            <td id="nome-titulo-{{ $titulo->historico }}"> {{ $titulo->historico }} </td>
            <td id="nome-titulo-{{ $titulo->pedido }}"> {{ $titulo->pedido_id }} </td>
            <td id="nome-titulo-{{ $titulo->nota }}"> {{ $titulo->pedido_id }} </td>
             @isset($titulo->pagamento)
                <td id="nome-titulo-status" name="pago"><font size=2 color="blue">Pagos</font></td>
             @endisset

             @empty($titulo->pagamento)          
                <?php 
                  $hoje = date('Y-m-d');
                  if ($titulo->vencimento<$hoje) {
                ?>
                    @empty($titulo->pagamento)
                      <td id="nome-titulo-status" name="vencido1"><font size=2 color="red">Vencido</font></td>
                    @endempty
                <?php } else { ?>
                      <td id="nome-titulo-status" name="avencer1"><font size=2 color="gray">Vencer</font></td>
                <?php } ?>
                  <td id="nome-titulo-status" name="pedido1"><font size=2 color="gray"></font></td>
                  <td id="nome-titulo-status" name="faturamento1"><font size=2 color="gray"></font></td>
             @endempty

         </tr>        
    </tbody>

    @endforeach

 </table>

@endsection

<script>
   function popavencerx(url) 
   {
    url = "{{ url('/posicao')}}";
    newwindow=window.open(url,'name','height=550,width=800,screenX=0,screenY=0');
   }

   function poppagosx(url) 
   {
    url = "{{ url('/posicao')}}";
    newwindow=window.open(url,'name2','height=550,width=800,screenX=50,screenY=50');
   }

   function popvencidosx(url) 
   {
    url = "{{ url('/posicao')}}";
    newwindow=window.open(url,'name3','height=550,width=800,screenX=100,screenY=100');
   }

   function popfaturax(url) 
   {
    url = "{{ url('/posicao')}}";
    newwindow=window.open(url,'name4','height=550,width=800,screenX=150,screenY=150');
   }

   function poppedidosx(url) 
   {
    url = "{{ url('/posicao')}}";
    newwindow=window.open(url,'name5','height=550,width=800,screenX=200,screenY=200s');
   }   

   </script>
