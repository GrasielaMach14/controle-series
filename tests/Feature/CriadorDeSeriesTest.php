<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Serie;
use App\Services\CriadorDeSeries;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CriadorDeSeriesTest extends TestCase
{
    use RefreshDatabase;
    
    public function testCriarSerie()
    {
        $criadorDeSerie = new CriadorDeSeries();
        $nomeSerie = 'Nome de teste';
        $serieCriada = $criadorDeSerie->criarSeries($nomeSerie, 3, 5);
        //Verifica se a $serieCriada é do tipo serie
        $this->assertInstanceOf(Serie::class, $serieCriada);
        //Verifica se existe uma série no banco de dados
        $this->assertDatabaseHas('series', ['nome' => $nomeSerie]);
        $this->assertDatabaseHas('temporadas', ['serie_id' => $serieCriada->id, 'numero'=> 3]);
        $this->assertDatabaseHas('episodios', ['numero'=> 1]);
    }
}
