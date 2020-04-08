<?php
namespace App\Services;

use App\{Serie, Temporada, Episodio};
use Illuminate\Support\Facades\DB;

class ExcluirSerie
{
    public function deletarSerie(int $serieId): string
    {
        $nomeSerie = '';
        
        DB::transaction(function () use($serieId, &$nomeSerie)
        {
            $serie = Serie::find($serieId);
            $nomeSerie = $serie->nome;
            $this->deletarTemporada($serie);

            $serie->delete();
        });
        return $nomeSerie;    
    }

    private function deletarTemporada(Serie $serie): void
    {
        $serie->temporadas->each(function (Temporada $temporada)
            {               
                $this->deletarEpisodio($temporada);
                $temporada->delete();
            });
    }

    private function deletarEpisodio(Temporada $temporada): void
    {
        $temporada->episodios->each(function (Episodio $episodio)
        {
            $episodio->delete();
        });
    }
}