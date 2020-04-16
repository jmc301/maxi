@extends('layout')

@section('cabecalho')
    Alterar Condição de Pagamento
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

<form method="post" action="/condpagamentos/{{ $condpagamento->id }}/gravar">
    @csrf
    <div class="row">
        <div class="col col-1">
            <label for="id">Código</label>
            <input type="text" class="form-control" name="id" id="id" disabled ="true" value="{{ $condpagamento->id}}">
        </div>

         <div class="col col-5">
            <label for="nome">Descrição<font color="red">*</font></label>
            <input type="text" class="form-control" name="descricao" id="descricao" maxlength="30" value="{{ $condpagamento->descricao}}">
        </div>
        <div class="col col-6">
        </div>

        <div class="col col-1 ">
            <label for="dias1">Dias</label>
            <input type="text" class="form-control" name="dias1" id="dias1" maxlength="2" value="{{ $condpagamento->dias1}}">
        </div>
        <div class="col col-1 ">
            <label for="dias2">Dias </label>
            <input type="text" class="form-control" name="dias2" id="dias2" maxlength="2" value="{{ $condpagamento->dias2}}">
        </div>
        <div class="col col-1 ">
            <label for="dias3">Dias </label>
            <input type="text" class="form-control" name="dias3" id="dias3" maxlength="2" value="{{ $condpagamento->dias3}}">
        </div>
        <div class="col col-1 ">
            <label for="dias4">Dias </label>
            <input type="text" class="form-control" name="dias4" id="dias4" maxlength="2" value="{{ $condpagamento->dias4}}">
        </div>
        <div class="col col-1 ">
            <label for="dias5">Dias </label>
            <input type="text" class="form-control" name="dias5" id="dias5" maxlength="2" value="{{ $condpagamento->dias5}}">
        </div>
        <div class="col col-1 ">
            <label for="dias6">Dias </label>
            <input type="text" class="form-control" name="dias6" id="dias6" maxlength="2" value="{{ $condpagamento->dias6}}">
        </div>
        <div class="col col-1 ">
            <label for="dias7">Dias </label>
            <input type="text" class="form-control" name="dias7" id="dias7" maxlength="2" value="{{ $condpagamento->dias7}}">
        </div>
        <div class="col col-1 ">
            <label for="dias8">Dias </label>
            <input type="text" class="form-control" name="dias8" id="dias8" maxlength="2" value="{{ $condpagamento->dias8}}">
        </div>
        <div class="col col-1 ">
            <label for="dias9">Dias </label>
            <input type="text" class="form-control" name="dias9" id="dias9" maxlength="2" value="{{ $condpagamento->dias9}}">
        </div>
        <div class="col col-1 ">
            <label for="dias10">Dias </label>
            <input type="text" class="form-control" name="dias10" id="dias10" maxlength="2" value="{{ $condpagamento->dias10}}">
        </div>        
    </div>

      <button class="btn btn-primary mt-2" id="alterar-baixar">Alterar</button>

</form>
@endsection
