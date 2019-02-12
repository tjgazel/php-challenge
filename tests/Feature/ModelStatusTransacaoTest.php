<?php

namespace Tests\Feature;

use App\Models\StatusTransacao;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ModelStatusTransacaoTest extends TestCase
{
    use RefreshDatabase;


    public function testCreate()
    {
        StatusTransacao::create([
            'descricao' => 'Teste de descricao',
            'codigo' => 100
        ]);

        $this->assertDatabaseHas('status_transacao', [
            'descricao' => 'Teste de descricao',
            'codigo' => 100
        ]);
    }
}
