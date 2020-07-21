@extends('layout')

@section('cabecalho')
    Adicionar Pedido
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
        <div class="col col-6">
            <label for="id">Pedido <font color="red">*</font></label>
            <input type="text" class="form-control" name="id" id="id" disabled>
        </div>

        <div class="col col-4">
            <label for="data">Data do Pedido<font color="red">*</font></label>
            <input type="date" class="form-control" name="data" id="data" maxlength="10" disabled>
        </div>

        <div class="col col-2">
          <div class="input-group-prepend">
            <label for="condicao_pagamento">Condição de Pagamento</label>
          </div>
          <select class="custom-select" name="condicao_pagamento" id="condicao_pagamento">
                   <option selected value="0" ></option>
                   @<?php foreach ($condpagamentos as $condpagamento): { ?>
                      $descricaoCondpagamento = "";
                         <option value="{{ $condpagamento->id }}" > {{ $condpagamento->descricao }} </option>
                      <?php } ?>
                   <?php endforeach ?>                        
          </select>
        </div>

        <div class="col col-3">
            <label for="cliente_id">Cliente<font color="red">*</font></label>
               <select class="custom-select" name="cliente_id" id="cliente_id">
                   <option value="0" selected>Selecione...</option>
                   @<?php foreach ($clientes as $cliente): ?>
                      <option value="{{ $cliente->id }}" > {{ $cliente->nome }} </option>
                   <?php endforeach ?>
               </select>
        </div>

        <div class="col col-4">
            <label for="valor">Valor</label>
            <input type="text" class="form-control" name="valor" id="valor" maxlength="8">
        </div>

    </div>

    <button class="btn btn-primary mt-2">Adicionar</button>  
</form>
@endsection
