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
            <option selected>Escolha...</option>
            <option value="1">A Vista</option>
            <option value="2">28D</option>
            <option value="3">28/56/84</option>
            <option value="4">07/14/21</option>
            <option value="5">28/35/42/49</option>
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
