@extends('layout')

@section('cabecalho')
    Temporadas de {{ $serie->nome }}
@endsection

@section('conteudo')
    <ul class="list-group">
        @foreach($temporadas as $temporada)
            <a href="/temporadas/{{ $temporada->id }}/episodios">            
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    {{ $temporada->numero }}
                    <span class="badge badge-secundary">
                        {{ $temporada->getEpisodiosAssistidos()->count() }} / {{ $temporada->episodios->count()}}
                    </span>
                </li>
            </a>
        @endforeach
    </ul>

@endsection
