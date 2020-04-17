<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Services\ExcluirSerie;
use App\Services\CriadorDeSeries;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RemovedorDeSerieTest extends TestCase
{    
    /** @var Serie */
    private $serie;
    use RefreshDatabase;

    //Método responsável por criar a série
    public function setUp(): void
    {
        parent::setUp();
        $criadorDeSerie = new CriadorDeSeries();
        $this->serie = $criadorDeSerie->criarSeries('Nome da série', 2, 3);

    }
    public function testRemoverSerie()
    {
        //Verifica se a série criada foi add no BD antes de excluir
        $this->assertDatabaseHas('series', ['id' => $this->serie->id]);

        $removedorDeSerie = new ExcluirSerie();
        $nomeSerie = $removedorDeSerie->deletarSerie($this->serie->id);
        //Verifica se o tipo retornado no banco é uma string
        $this->assertIsString($nomeSerie);
        $this->assertEquals('Nome da série', $this->serie->nome);
        //Garante que esta série não existe mais no banco de dados
        $this->assertDatabaseMissing('series', ['id' => $this->serie->id]);
    }
}
