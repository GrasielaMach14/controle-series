@extends('layout')

@section('cabecalho')
Adicionar série
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
            <div class="col col-8">
                <label for="nome">Nome</label>
                <input type="text" class="form-control" name="nome" id="nome">
            </div>
            <div class="col col-2">
                <label for="n_temporadas">Nº de temporadas</label>
                <input type="number" class="form-control" name="n_temporadas" id="n_temporadas">
            </div>
            <div class="col col-2">
                <label for="n_episodios">Episódios</label>
                <input type="number" class="form-control" name="n_episodios" id="n_episodios">
            </div>
        </div>
            <button class="btn btn-primary mt-2">Adicionar</button>
    </form>
@endsection