<?php

namespace App\Services;

use App\Serie;
use App\Temporada;
use App\Episodio;
use Illuminate\Support\Facades\DB;

class CriadorDeSeries
{
    public function criarSeries(string $nomeSerie, int $nTemporadas, int $nEpisodios): Serie
    {
        $serie = null;
        
        DB::beginTransaction();
        $serie = Serie::create(['nome' => $nomeSerie]);
        $this->criarTemporada($nTemporadas, $nEpisodios, $serie);
        DB::commit();

        return $serie;

    }

    private function criarTemporada(int $nTemporadas, int $nEpisodios, Serie $serie)
    {
        for($i = 1; $i<= $nTemporadas; $i++)
        {
            $temporada = $serie->temporadas()->create(['numero' => $i]);
            $this->criarEpisodio($nEpisodios, $temporada);            
        }
 
    }

    private function criarEpisodio(int $nEpisodios, Temporada $temporada): void 
    {
        for($j = 1; $j <= $nEpisodios; $j++)
            {
                 $temporada->episodios()->create(['numero' => $j]);
            }
    }
}