<?php

namespace App\Http\Controllers;

use App\Serie;
use App\Temporada;
use App\Episodio;
use App\Services\CriadorDeSeries;
use App\Services\ExcluirSerie;
use Illuminate\Http\Request;
use App\Http\Requests\SeriesFormRequest;

class SeriesController extends Controller
{   
    public function index(Request $request)
    {
        $series = Serie::query()
                ->orderBy('nome')
                ->get();
        
        $mensagem = $request->session()->get('mensagem');
        $request->session()->remove('mensagem');

        return view('series.index', compact('series', 'mensagem'));
    }

    public function create()
    {
        return view('series.create');
    }

    public function store(SeriesFormRequest $request, CriadorDeSeries $criadosDeSeries)
    {   
        $serie = $criadosDeSeries->criarSeries(
                $request->nome,     
                $request->n_temporadas, 
                $request->n_episodios
        );
        
        $request->session()
                ->flash(
                'mensagem', 
                "ID {$serie->id} - Série {$serie->nome} com suas temporadas e episódios criada com sucesso."
            );

        return redirect()->route('series_index');
    }

    public function destroy(Request $request, ExcluirSerie $excluirSerie)
    {
        $nomeSerie = $excluirSerie->deletarSerie($request->id);
        $request->session()
                ->flash(
                'mensagem', 
                "Série $nomeSerie removida com sucesso."
            );

            return redirect()->route('series_index');
    }

    public function editarNome($id, Request $request)
    {
        $novoNome = $request->nome;
        $serie = Serie::find($id);
        $serie->nome = $novoNome;
        $serie->save();
    }
}
