@extends('layout')

@section('cabecalho')
    Adicionar T&iacute;tulo
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

<form method="post">
    @csrf
    <div class="row">
        <div class="col col-2">
            <label for="titulo">T&iacute;tulo<font color="red">*</font></label>
            <input type="text" class="form-control" name="titulo" id="titulo">
        </div>

         <div class="col col-1">
            <label for="prefixo">Prefixo<font color="red">*</font></label>
            <input type="text" class="form-control" name="prefixo" id="prefixo" maxlength="3">
        </div>
               
       <div class="col col-2 ">
            <label for="parcela">Parcela</label>
            <input type="text" class="form-control" name="parcela" id="parcela" maxlength="1">
        </div>

       <div class="col col-4">
            <label for="cliente">Cliente<font color="red">*</font></label>
            <input type="text" class="form-control" name="cliente" id="cliente" maxlength="5">
        </div>

      <div class="col col-4">
            <label for="emissao">Data Emissao<font color="red">*</font></label>
            <input type="date" class="form-control" name="emissao" id="emissao" maxlength="10">
        </div>

      <div class="col col-4">
            <label for="vencimento">Vencimento<font color="red">*</font></label>
            <input type="date" class="form-control" name="vencimento" id="vencimento" maxlength="10">
        </div>

     <div class="col col-4">
            <label for="valor">Valor</label>
            <input type="text" class="form-control" name="valor" id="valor" maxlength="8">
        </div>


     <div class="col col-4">
            <label for="numerobancario">N&uacute;mero Banc&aacute;rio</label>
            <input type="text" class="form-control" name="numerobancario" id="numerobancario" maxlength="12">
        </div>

          <div class="col col-8">
             <label for="historico">Hist&oacute;rico</label>
             <input type="text" class="form-control" name="historico" id="historico" maxlength="40">
        </div>
        
         <div class="col col-2">
             <label for="pagamento">Data de Pagamento</label>
             <input type="text" class="form-control" name="pagamento" id="pagamento" maxlength="10">
        </div>

    </div>

    <button class="btn btn-primary mt-2">Adicionar</button>
</form>
@endsection
