@extends('layout')

@section('conteudo')
    <div class="container">
        <div class="row">

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Produto {{ $produto->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/produto') }}" title="Voltar"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Voltar</button></a>
                        <a href="{{ url('/produto/' . $produto->id . '/edit') }}" title="Edit Produto"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Alterar</button></a>

                        <form method="POST" action="{{ url('produto' . '/' . $produto->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete Produto" onclick="return confirm(&quot;Confirma exclusão?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Excluir</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $produto->id }}</td>
                                    </tr>
                                    <tr><th> Descricao </th><td> {{ $produto->descricao }} </td></tr><tr><th> Foto </th><td> <img src="http://localhost:8000/storage/{{$produto->foto}}" class="img-thumbnail" height="100px" width="100px"> </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
