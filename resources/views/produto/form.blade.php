<div class="form-group {{ $errors->has('descricao') ? 'has-error' : ''}}">
    <label for="descricao" class="control-label">{{ 'Descricao' }}</label>
    <input class="form-control" name="descricao" type="text" id="descricao" value="{{ isset($produto->descricao) ? $produto->descricao : ''}}" required>
    {!! $errors->first('descricao', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('foto') ? 'has-error' : ''}}">
    <label for="foto" class="control-label">{{ 'Foto' }}</label>
    <input class="form-control" name="foto" type="file" id="foto" value="{{ isset($produto->foto) ? $produto->foto : ''}}" >
    {!! $errors->first('foto', '<p class="help-block">:message</p>') !!}
    <div align="center">
        @isset($produto->foto)
            <img src="http://localhost:8000/storage/{{$produto->foto}}" class="img-thumbnail" height="100px" width="100px">
        @endisset
        @empty($produto->foto)
            <img src="http://localhost:8000/storage/produto/sem-imagem.jpg" class="img-thumbnail" height="100px" width="100px">
        @endempty
    </div>
</div>
<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Alterar' : 'Adicionar' }}">
</div>
