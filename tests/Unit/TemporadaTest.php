<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Temporada;
use App\Episodio;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TemporadaTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */

    public function setUp(): void
    {
        parent::setUp();
        //Cenário a ser testado
        $temporada = new Temporada();
        $episodio1 = new Episodio();
        $episodio1->assistido = true;
        $episodio2 = new Episodio();
        $episodio2->assistido = false;
        $episodio3 = new Episodio();
        $episodio3->assistido = true;
        //Adicionar os episódios as temporadas
        $temporada->episodios->add($episodio1);
        $temporada->episodios->add($episodio2);
        $temporada->episodios->add($episodio3);
        //Este objeto temporada recebe $temporada
        $this->temporada = $temporada;
    }

    public function testEpisodioAssistido()
    {                        //Execução do método a ser testado
        $episodiosAssistidos = $this->temporada->getEpisodiosAssistidos();
        //Fazer a verificação
        $this->assertCount(2, $episodiosAssistidos);

        foreach($episodiosAssistidos as $episodio)
        {
            $this->assertTrue($episodio->assistido);
        }
    }

    public function testBuscarTodosEpisodios()
    {
        $episodios = $this->temporada->episodios;
        $this->assertCount(3, $episodios);
    }
}
