@extends('layout')

@section('cabecalho')
    Adicionar Vendedor
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
       <div class="col col-6 ">
            <label for="nome">Nome <font color="red">*</font></label>
            <input type="text" class="form-control" name="nome" id="nome" maxlength="40">
        </div>
  </div>

  <div class="row">
          <button class="btn btn-primary mt-3 ml-3">Adicionar</button>
  </div>

</form>
@endsection
