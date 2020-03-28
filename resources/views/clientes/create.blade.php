@extends('layout')

@section('cabecalho')
    Adicionar Cliente
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
            <label for="nome">Nome <font color="red">*</font></label>
            <input type="text" class="form-control" name="nome" id="nome">
        </div>

        <div class="col col-2">
          <div class="input-group-prepend">
            <label for="consumidorfina">Cons. Final</label>
          </div>
          <select class="custom-select" name="consumidorfina" id="consumidorfina">
            <option selected>Escolha...</option>
            <option value="1">Sim</option>
            <option value="2">N&atilde;o</option>
          </select>
        </div>

        <div class="col col-3">
            <label for="vendedor">Vendedor<font color="red">*</font></label>
               <select class="custom-select" name="vendedor" id="vendedor">
                   <option value="0" selected>Selecione...</option>
                   @<?php foreach ($representantes as $representante): ?>
                      <option value="{{ $representante->id }}" > {{ $representante->nome }} </option>
                   <?php endforeach ?>
               </select>
        </div>
               
       <div class="col col-2 ">
            <label for="cep" title="Busca CEP no site do Correio">CEP <font color="red">*</font></label>
            <input type="text" class="form-control" name="cep" id="cep" maxlength="10" title="Busca CEP no site do Correio">
        </div>

       <div class="col col-8">
            <label for="endereco">Endere&ccedil;o <font color="red">*</font></label>
            <input type="text" class="form-control" name="endereco" id="endereco" maxlength="40">
        </div>

       <div class="col col-2 ">
            <label for="numero">Número <font color="red">*</font></label>
            <input type="text" class="form-control" name="numero" id="numero" maxlength="5">
        </div>

       <div class="col col-6">
            <label for="bairro">Bairro<font color="red">*</font></label>
            <input type="text" class="form-control" name="bairro" id="bairro" maxlength="40">
        </div>

      <div class="col col-5">
            <label for="cidade">Cidade<font color="red">*</font></label>
            <input type="text" class="form-control" name="cidade" id="cidade">
        </div>

      <div class="col col-1">
            <label for="uf">UF<font color="red">*</font></label>
            <input type="text" class="form-control" name="uf" id="uf" maxlength="2">
        </div>

     <div class="col col-7">
            <label for="email">E-mail</label>
            <input type="email" class="form-control" name="email" id="email" maxlength="50">
        </div>


     <div class="col col-7">
            <label for="emailnfe">E-mail NF-e</label>
            <input type="email" class="form-control" name="emailnfe" id="emailnfe" maxlength="50">
        </div>

        <div class="col col-3">
          <div class="input-group-prepend">
            <label for="fiscaljuridico">F&iacute;sica/Jur&iacute;d.</label>
          </div>
          <select class="custom-select" name="fiscaljuridico" id="fiscaljuridico">
            <option selected>Escolha...</option>
            <option value="1">F&iacute;sica</option>
            <option value="2">Jur&iacute;dica</option>
          </select>
        </div>

        <div class="col col-3">
             <label for="cnpjcpf">CNPJ <font color="red">*</font></label>
             <input type="text" class="form-control" name="cnpjcpf" id="cnpjcpf" maxlength="20">
        </div>

    </div>

    <button class="btn btn-primary mt-2">Adicionar</button>  
</form>
@endsection
