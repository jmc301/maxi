@extends('layout')

@section('cabecalho')
    Alterar Cliente
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

<form method="post" action="/clientes/{{ $cliente->id }}/gravar">
    {{csrf_field()}}
    <div class="row">
        <div class="col col-1">
            <label for="id">Codigo<font color="red">*</font></label>
            <input type="text" class="form-control" name="id" id="id"value="{{ $cliente->id }}" disabled>
        </div>
            
        <div class="col col-8">
            <label for="nome">Nome <font color="red">*</font></label>
            <input type="text" class="form-control" name="nome" id="nome" value="{{ $cliente->nome }}">
        </div>

        <div class="col col-2">
          <div class="input-group-prepend">
            <label for="consumidorfina">Cons. Final</label>
          </div>
          <select class="custom-select" name="consumidorfina" id="consumidorfina">
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

        <div class="col col-1">
            <label for="vendedor">Vendedor<font color="red">*</font></label>
            <input type="text" class="form-control" name="vendedor" id="vendedor"value="{{ $cliente->vendedor }}" maxlength="4">
        </div>

       <div class="col col-2">
            <label for="cep">CEP</label>
            <input type="text" class="form-control" name="cep" id="cep" value="{{ $cliente->cep }}">
       </div>
               
       <div class="col col-8">
            <label for="endereco">Endere&ccedil;o <font color="red">*</font></label>
            <input type="text" class="form-control" name="endereco" id="endereco" value="{{ $cliente->endereco }}">
        </div>

      <div class="col col-6">
            <label for="bairro">Bairro<font color="red">*</font></label>
            <input type="text" class="form-control" name="bairro" id="bairro" value="{{ $cliente->bairro }}">
        </div>

      <div class="col col-6">
            <label for="cidade">Cidade<font color="red">*</font></label>
            <input type="text" class="form-control" name="cidade" id="cidade" value="{{ $cliente->cidade }}">
        </div>

     <div class="col col-8">
            <label for="email">E-mail</label>
            <input type="email" class="form-control" name="email" id="email" value="{{ $cliente->email }}">
        </div>


     <div class="col col-8">
            <label for="emailnfe">E-mail NF-e</label>
            <input type="email" class="form-control" name="emailnfe" id="emailnfe" value="{{ $cliente->emailnfe }}">
        </div>

        <div class="col col-2">
          <div class="input-group-prepend">
            <label for="fiscaljuridico">F&iacute;sica/Jur&iacute;d.</label>
          </div>
          <select class="custom-select" name="fiscaljuridico" id="fiscaljuridico">
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
             <input type="text" class="form-control" name="cnpjcpf" id="cnpjcpf" value="{{ $cliente->cnpjcpf }}">
        </div>

    </div>

    <button class="btn btn-primary mt-2">Alterar</button>
</form>
@endsection
