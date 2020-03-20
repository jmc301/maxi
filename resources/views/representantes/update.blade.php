@extends('layout')

@section('cabecalho')
    Alterar Representante
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

<form method="post" action="/representantes/{{ $representante->id }}/gravar">
    @csrf
    <div class="row">
        <div class="col col-1">
            <label for="id">Código<font color="red">*</font></label>
            <input type="text" class="form-control" name="id" id="id" disabled="" ="true" value="{{ $representante->id}}">
        </div>

         <div class="col col-6">
            <label for="nome">Nome<font color="red">*</font></label>
            <input type="text" class="form-control" name="nome" id="nome" maxlength="40" 
            value="{{ $representante->nome}}">
        </div>
    </div>

      <button class="btn btn-primary mt-2" id="alterar-baixar">Alterar</button>

    <!--
    <div class="col col-2">
         <input type="text" class="form-control" name="id" id="id" hidden="true" value="{{ $representante->id}}">
    </div>
     -->

</form>
@endsection
