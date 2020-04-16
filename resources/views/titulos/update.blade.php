@extends('layout')

@section('cabecalho')
    Alterar T&iacute;tulo
@endsection

@section('conteudo')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<style type="text/css">
  .desabilita{
    disabled;
  }
</style>

<form method="post" action="/titulos/{{ $titulo->id }}/gravar">
    @csrf
    <div class="row">
        <div class="col col-2">
            <label for="titulo">T&iacute;tulo<font color="red">*</font></label>
            <input type="text" class="form-control" name="titulo" id="titulo" disabled="" ="true" value="{{ $titulo->titulo}}">
        </div>

         <div class="col col-1">
            <label for="prefixo">Prefixo<font color="red">*</font></label>
            <input type="text" class="form-control" name="prefixo" id="prefixo" maxlength="3" 
            value="{{ $titulo->prefixo}}">
        </div>
               
        <div class="col col-2 ">
            <label for="parcela">Parcela</label>
            <input type="text" class="form-control desabilita" name="parcela" id="parcela" maxlength="1" 
            value="{{ $titulo->parcela}}">
        </div>

        <div class="col col-4">
            <label for="cliente">Cliente<font color="red">*</font></label>
            <input type="text" class="form-control" name="cliente" id="cliente" maxlength="5" 
            value="{{ $titulo->cliente}}">
        </div>

        <div class="col col-4">
            <label for="emissao">Data Emissao<font color="red">*</font></label>
            <input type="date" class="form-control" name="emissao" id="emissao" maxlength="10" 
            value="{{ $titulo->emissao}}" disabled>
        </div>

        <div class="col col-4">
            <label for="vencimento">Vencimento<font color="red">*</font></label>
            <input type="date" class="form-control" name="vencimento" id="vencimento" maxlength="10" 
            value="{{ $titulo->vencimento}}">
        </div>

        <div class="col col-4">
            <label for="valor">Valor</label>
            <input type="text" class="form-control" name="valor" id="valor" maxlength="8" 
            value="{{ $titulo->valor}}">
        </div>

        <div class="col col-4">
            <label for="numerobancario">N&uacute;mero Banc&aacute;rio</label>
            <input type="text" class="form-control" name="numerobancario" id="numerobancario" maxlength="12" 
            value="{{ $titulo->numerobancario}}">
        </div>

        <div class="col col-8">
             <label for="historico">Hist&oacute;rico</label>
             <input type="text" class="form-control" name="historico" id="historico" maxlength="40" 
             value="{{ $titulo->historico}}">
        </div>
        
        <div class="col col-3">
             <label for="pagamento">Data de Pagamento</label>
             <input type="date" class="form-control" name="pagamento" id="pagamento" maxlength="10" 
             value="{{ $titulo->pagamento}}">
        </div>

        <div class="col col-2" style="visibility:hidden"  id="baixa">
             <label for="desconto">Desconto</label>
             <input type="text" class="form-control" name="desconto" id="desconto" maxlength="8"
             value="{{ $titulo->desconto}}">
        </div>

        <div class="col col-2" style="visibility:hidden" id="baixa1">
             <label for="multa">Multa</label>
             <input type="text" class="form-control" name="multa" id="multa" maxlength="8"
             value="{{ $titulo->multa}}"> 
        </div>

       <div class="col col-2" style="visibility:hidden" id="baixa2">
             <label for="juros">Juros</label>
             <input type="text" class="form-control" name="juros" id="juros" maxlength="8"
             value="{{ $titulo->juros}}"> 
        </div>

       <div class="col col-2" style="visibility:hidden" id="baixa3">
             <label for="valor_pago">Valor Pago</label>
             <input type="text" class="form-control-pago" name="valor_pago" id="valor_pago" maxlength="8"
             value="{{ $titulo->valor_pago}}">
        </div>

    </div>

    @empty($titulo->pagamento)
      <button class="btn btn-primary mt-2" id="alterar-baixar">Alterar</button>
    @endempty

    @isset($titulo->pagamento)
        <button class="btn btn-primary mt-2" onsubmit="return confirm('Deseja relamente Cancelar a Baixa ?')">
          Cancelar Baixa
        </button>
    @endisset

    <div class="col col-2">
         <input type="text" class="form-control" name="id" id="id" hidden="true" value="{{ $titulo->id}}">
    </div>
</form>
<script type="text/javascript">
  var pagamento = (document.querySelector("#pagamento"));
  @isset($titulo->numerobancario)
     document.getElementById('prefixo').readOnly  = true;
     document.getElementById('parcela').readOnly  = true;
     document.getElementById('cliente').readOnly  = true;
     document.getElementById('emissao').readOnly  = true;
     document.getElementById('vencimento').readOnly = true;
     document.getElementById('valor').readOnly = true;
     document.getElementById('numerobancario').readOnly = true;

     var dataPagamento = document.querySelector("#pagamento");
     var alterarbaixar = document.querySelector("#alterar-baixar");

     dataPagamento.addEventListener("input", function() {

       if (dataPagamento.value.length > 0) {
            document.getElementById('baixa').setAttribute('style', 'visibility:visible');
            document.getElementById('baixa1').setAttribute('style', 'visibility:visible');
            document.getElementById('baixa2').setAttribute('style', 'visibility:visible');
            document.getElementById('baixa3').setAttribute('style', 'visibility:visible');

            alterarbaixar.textContent = "Baixar";

            @empty($titulo->pagamento)
              var valorPagos = document.querySelector('#valor_pago');
              valorPagos.value = document.getElementById('valor').value;
            @endempty
       } else {
            document.getElementById('baixa').setAttribute('style', 'visibility:hidden');
            document.getElementById('baixa1').setAttribute('style', 'visibility:hidden');
            document.getElementById('baixa2').setAttribute('style', 'visibility:hidden');
            document.getElementById('baixa3').setAttribute('style', 'visibility:hidden');      
            alterarbaixar.textContent = "Alterar";
       }
     });     
     if (dataPagamento.value.length > 0) {
         document.getElementById('baixa').setAttribute('style', 'visibility:visible');
         document.getElementById('baixa1').setAttribute('style', 'visibility:visible');
         document.getElementById('baixa2').setAttribute('style', 'visibility:visible');
         document.getElementById('baixa3').setAttribute('style', 'visibility:visible');
         document.getElementById('desconto').readOnly  = true;
         document.getElementById('multa').readOnly  = true;
         document.getElementById('juros').readOnly  = true;
         document.getElementById('valor_pago').readOnly  = true;

         //alterarbaixar.textContent = "Baixar";

         @empty($titulo->pagamento)
           var valorPagos = document.querySelector('#valor_pago');
           valorPagos.value = document.getElementById('valor').value;
         @endempty
     }
  @endisset

  @empty($titulo->numerobancario)
     var dataPagamento = document.querySelector("#pagamento");
     var alterarbaixar = document.querySelector("#alterar-baixar");

       dataPagamento.addEventListener("input", function() {

       if (dataPagamento.value.length > 0) {
           document.getElementById('baixa').setAttribute('style', 'visibility:visible');
           document.getElementById('baixa1').setAttribute('style', 'visibility:visible');
           document.getElementById('baixa2').setAttribute('style', 'visibility:visible');
           document.getElementById('baixa3').setAttribute('style', 'visibility:visible');

           alterarbaixar.textContent = "Baixar";

           @empty($titulo->pagamento)
             var valorPagos = document.querySelector('#valor_pago');
             valorPagos.value = document.getElementById('valor').value;
           @endempty
         } else {
            document.getElementById('baixa').setAttribute('style', 'visibility:hidden');
            document.getElementById('baixa1').setAttribute('style', 'visibility:hidden');
            document.getElementById('baixa2').setAttribute('style', 'visibility:hidden')
            document.getElementById('baixa3').setAttribute('style', 'visibility:hidden')
            document.getElementById('baixa3').setAttribute('style', 'visibility:hidden');
            alterarbaixar.textContent = "Alterar";
         }
       });      

       if (dataPagamento.value.length > 0) {
         document.getElementById('baixa').setAttribute('style', 'visibility:visible');
         document.getElementById('baixa1').setAttribute('style', 'visibility:visible');
         document.getElementById('baixa2').setAttribute('style', 'visibility:visible');
         document.getElementById('baixa3').setAttribute('style', 'visibility:visible');
         document.getElementById('desconto').readOnly  = true;
         document.getElementById('multa').readOnly  = true;
         document.getElementById('juros').readOnly  = true;
         document.getElementById('valor_pago').readOnly  = true;

         @empty($titulo->pagamento)
           var valorPagos = document.querySelector('#valor_pago');
           valorPagos.value = document.getElementById('valor').value;
        @endempty
       }        
  @endempty

  @isset($titulo->pagamento)
     document.getElementById('prefixo').readOnly = true;
     document.getElementById('parcela').readOnly = true;
     document.getElementById('cliente').readOnly = true;
     document.getElementById('emissao').readOnly = true;
     document.getElementById('vencimento').readOnly = true;
     document.getElementById('valor').readOnly = true;
     document.getElementById('numerobancario').readOnly = true;
     document.getElementById('historico').readOnly = true;
     document.getElementById('pagamento').readOnly = true;
  @endisset

  // Calcula Desconto
  var valorDesconto = document.querySelector("#desconto");
  valorDesconto.addEventListener("input", function() {
      var valorPagoComDesconto = document.querySelector('#valor_pago');
      valorPagoComDesconto.value = 
      (document.getElementById('valor').value - document.getElementById('desconto').value);
   }); 

  // Calcula Multa
  var valorMulta = document.querySelector("#multa");
  valorMulta.addEventListener("input", function() {
      var valorPagoComMulta = document.querySelector('#valor_pago');
      valor = document.getElementById('valor').value;
      multa = document.getElementById('multa').value;
      juros = document.getElementById('juros').value;      
      valorPagoComMulta.value = (parseInt(valor) + parseInt(multa) + parseInt(juros));
   }); 

  // Calcula Juros
  var valorJuros = document.querySelector("#juros");
  valorJuros.addEventListener("input", function() {
      var valorPagoComJuros = document.querySelector('#valor_pago');
      valor = document.getElementById('valor').value;
      multa = document.getElementById('multa').value;
      juros = document.getElementById('juros').value;
      valorPagoComJuros.value = (parseInt(valor) + parseInt(multa) + parseInt(juros));
   }); 

</script>
@endsection
