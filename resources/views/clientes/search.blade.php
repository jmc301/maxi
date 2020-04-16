@extends('layout')

@section('cabecalho')
    Pesquisa Cliente
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

<form action="/posicao/{id}">
    {{csrf_field()}}

    <div class="row">
        <div class="col col-1">
            <label for="id">Codigo<font color="red">*</font></label>
            <input type="text" class="form-control" name="id" id="id" value="{{ $cliente->id }}" readonly="true">
        </div>
            
        <div class="col col-6">
            <label for="nome">Nome <font color="red">*</font></label>
            <input type="text" class="form-control" name="nome" id="nome" value="{{ $cliente->nome }}" disabled>
        </div>

        <div class="col col-2">
          <div class="input-group-prepend">
            <label for="consumidorfina">Cons. Final</label>
          </div>
          <select class="custom-select" name="consumidorfina" id="consumidorfina" disabled>
            <?php if ($cliente->consumidorfina=="") { ?>
                <option selected>Escolha...</option>
                <option value="1">Sim</option>
                <option value="2">N&atilde;o</option>
            <?php } ?>            
            <?php if ($cliente->consumidorfina=="1") { ?>
	            <option selected value="1">Sim</option>
	            <option value="2">N&atilde;o</option>
            <?php } ?>            
            <?php if ($cliente->consumidorfina=="2") { ?>
    	        <option selected value="2">N&atilde;o</option>
    	        <option value="1">Sim</option>
            <?php } ?>                        
          </select>
        </div>

        <div class="col col-3">
            <label for="vendedor">Vendedor<font color="red">*</font></label>
               <select class="ls-select" name="vendedor" id="vendedor" disabled>
                   <option selected value="0" ></option>
                   @<?php foreach ($representantes as $representante): ?>
                      $nomeRepresentante = "";
                      <?php  if ($representante->id === $cliente->vendedor_id)  { ?>
                               <option selected value="{{ $representante->id }}" > {{ $representante->nome }} </option>
                      <?php    break; } else { ?>
                         <option value="{{ $representante->id }}" > {{ $representante->nome }} </option>
                      <?php } ?>
                   <?php endforeach ?>
               </select>
        </div>

       <div class="col col-2">
            <label for="cep">CEP</label>
            <input type="text" class="form-control" name="cep" id="cep" value="{{ $cliente->cep }}"  disabled>
       </div>
               
       <div class="col col-8">
            <label for="endereco">Endere&ccedil;o <font color="red">*</font></label>
            <input type="text" class="form-control" name="endereco" id="endereco" value="{{ $cliente->endereco }}"  disabled>
        </div>

       <div class="col col-2 ">
            <label for="numero">Número</label>
            <input type="text" class="form-control" name="numero" id="numero" maxlength="5" value="{{ $cliente->numero }}" disabled>
        </div>

      <div class="col col-6">
            <label for="bairro">Bairro<font color="red">*</font></label>
            <input type="text" class="form-control" name="bairro" id="bairro" value="{{ $cliente->bairro }}" disabled>
        </div>

      <div class="col col-5">
            <label for="cidade">Cidade<font color="red">*</font></label>
            <input type="text" class="form-control" name="cidade" id="cidade" value="{{ $cliente->cidade }}" disabled>
        </div>

      <div class="col col-1">
            <label for="uf">UF<font color="red">*</font></label>
            <input type="text" class="form-control" name="uf" id="uf" maxlength="2" value="{{ $cliente->uf }}" disabled>
      </div>

     <div class="col col-8">
            <label for="email">E-mail</label>
            <input type="email" class="form-control" name="email" id="email" value="{{ $cliente->email }}"  disabled>
        </div>

     <div class="col col-8">
            <label for="emailnfe">E-mail NF-e</label>
            <input type="email" class="form-control" name="emailnfe" id="emailnfe" value="{{ $cliente->emailnfe }}"  disabled>
        </div>

        <div class="col col-2">
          <div class="input-group-prepend">
            <label for="fiscaljuridico">F&iacute;sica/Jur&iacute;d.</label>
          </div>
          <select class="custom-select" name="fiscaljuridico" id="fiscaljuridico" disabled>
            <?php if ($cliente->fiscaljuridico=="") { ?>
 	           	<option selected>Escolha...</option>
            	<option value="1">F&iacute;sica</option>
            	<option value="2">Jur&iacute;dica</option>
            <?php } ?>
            <?php if ($cliente->fiscaljuridico=="1") { ?>
            	<option selected value="1">F&iacute;sica</option>
            	<option value="2">Jur&iacute;dica</option>
            <?php } ?>
             <?php if ($cliente->fiscaljuridico=="2") { ?>
            	<option selected value="2">Jur&iacute;dica</option>
            	<option value="1">F&iacute;sica</option>
            <?php } ?>
          </select>
        </div>
        <div class="col col-2">
             <label for="cnpjcpf">CNPJ</label>
             <input type="text" class="form-control" name="cnpjcpf" id="cnpjcpf" value="{{ $cliente->cnpjcpf }}"  disabled>
        </div>
    </div>
    <button class="btn btn-primary mt-1 mb-3">Posição Financeira</button>
    <button class="btn btn-primary mt-1 mb-3">Voltar</button>

</form>

@endsection
