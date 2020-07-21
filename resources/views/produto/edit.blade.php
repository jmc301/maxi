@extends('layout')

@section('conteudo')
    <div class="container">
        <div class="row">       

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header"><h2>Alterar Produto #{{ $produto->id }}</h2></div>
                    <div class="card-body">
                        <a href="{{ url('/produto') }}" title="Voltar"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Voltar</button></a>
                        <br />
                        <br />

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        <form method="POST" action="{{ url('/produto/' . $produto->id . '/update') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ method_field('POST') }}
                            {{ csrf_field() }}

                            @include ('produto.form', ['formMode' => 'edit'])

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
