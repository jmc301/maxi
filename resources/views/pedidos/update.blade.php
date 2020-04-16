@extends('layout')

@section('cabecalho')
    Alterar Pedido
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

<form method="post" action="/pedidos/{{ $pedido->id }}/gravar">
    {{csrf_field()}}
    <div class="row">
        <div class="col col-1">
            <label for="id">Pedido</label>
            <input type="text" class="form-control" name="id" id="id"value="{{ $pedido->id }}" disabled>
        </div>
            
        <div class="col col-3">
            <label for="data">Data</label>
            <input type="date" class="form-control" name="data" id="data" value="{{ $pedido->data }}" maxlength="10" disabled>
        </div>

        <div class="col col-8">
        </div>

        <div class="col col-2">
          <div class="input-group-prepend">
            <label for="condicao_pagamento">Condição de Pagamento</label>
          </div>
          <select class="custom-select" name="condicao_pagamento" id="condicao_pagamento">
            <?php if ($pedido->condicao_pagamento=="") { ?>
                    <option selected>Escolha...</option>
                    <option value="1">A Vista</option>
                    <option value="2">28D</option>
                    <option value="3">28/56/84</option>
                    <option value="4">07/14/21</option>
                    <option value="5">28/35/42/49</option>
            <?php } ?>            
            <?php if ($pedido->condicao_pagamento=="1") { ?>
	            <option selected value="1">A Vista</option>
                    <option value="2">28D</option>
                    <option value="3">28/56/84</option>
                    <option value="4">07/14/21</option>
                    <option value="5">28/35/42/49</option>     
            <?php } ?>            
            <?php if ($pedido->condicao_pagamento=="2") { ?>
                    <option value="1">A Vista</option>
                    <option selected value="2">28D</option>
                    <option value="3">28/56/84</option>
                    <option value="4">07/14/21</option>
                    <option value="5">28/35/42/49</option>     
            <?php } ?>                        
            <?php if ($pedido->condicao_pagamento=="3") { ?>
                    <option value="1">A Vista</option>
                    <option value="2">28D</option>
                    <option selected value="3">28/56/84</option>
                    <option value="4">07/14/21</option>
                    <option value="5">28/35/42/49</option>     
            <?php } ?>                        
            <?php if ($pedido->condicao_pagamento=="4") { ?>
                    <option value="1">A Vista</option>
                    <option value="2">28D</option>
                    <option value="3">28/56/84</option>
                    <option selected value="4">07/14/21</option>
                    <option value="5">28/35/42/49</option>     
            <?php } ?>                        
            <?php if ($pedido->condicao_pagamento=="5") { ?>
                    <option value="1">A Vista</option>
                    <option value="2">28D</option>
                    <option value="3">28/56/84</option>
                    <option value="4">07/14/21</option>
                    <option selected value="5">28/35/42/49</option>     
            <?php } ?>                        
          </select>
        </div>

        <div class="col col-3">
            <label for="cliente_id">Cliente</label>
               <select class="custom-select" name="cliente_id" id="cliente_id">
                   <option selected value="0" ></option>
                   @<?php foreach ($clientes as $cliente): ?>
                      $nomeCliente = "";
                      <?php  if ($cliente->id === $pedido->cliente_id)  { ?>
                               <option selected value="{{ $cliente->id }}" > {{ $cliente->nome }} </option>
                      <?php    } else { ?>
                         <option value="{{ $cliente->id }}" > {{ $cliente->nome }} </option>
                      <?php } ?>
                   <?php endforeach ?>
               </select>
        </div>

        <div class="col col-3">
             <label for="valor">Valor</label>
             <input type="text" class="form-control" name="valor" id="valor" value="{{ $pedido->valor }}"  maxlength="10">
        </div>

    </div>

    <button class="btn btn-primary mt-2">Alterar</button>
</form>
@endsection
