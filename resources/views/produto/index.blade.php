@extends('layout')

@section('conteudo')
    <div class="container">
        <div class="row">

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header"><h2>Produto</h2></div>
                    <div class="card-body">
                        <a href="{{ url('produto/create') }}" class="btn btn-success btn-sm" title="Adicionar Produto">
                            <i class="fa fa-plus" aria-hidden="true"></i> Adicionar
                        </a>

                        <form method="GET" action="{{ url('/produto') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
                            <div class="input-group">
                                <input type="text" class="form-control" name="search" placeholder="Procurar..." value="{{ request('search') }}">
                                <span class="input-group-append">
                                    <button class="btn btn-secondary" type="submit">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                        </form>

                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th><th>Descricao</th><th>Foto</th><th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($produto as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->descricao }}</td>
                                        <td><img src="{{$item->foto_url}}" class="img-thumbnail" height="100px" width="100px"></td>
                                        <td>
                                            <a href="{{ url('/produto/' . $item->id . '/show') }}" title="Visualizar Produto"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> Visualzar</button></a>
                                            <a href="{{ url('/produto/' . $item->id . '/edit') }}" title="Alterar Produto"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Alterar</button></a>

                                            <form method="POST" action="{{ url('/produto' . '/' . $item->id) . '/destroy' }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Excluir Produto" onclick="return confirm(&quot;Confirma exclusão do produto {{$item->descricao}}?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Excluir</button>
                                            </form>
                                        </td>
                                        <td>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $produto->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
