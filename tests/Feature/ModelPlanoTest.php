<?php

namespace Tests\Unit;

use App\Models\Plano;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ModelPlanoTest extends TestCase
{
    use RefreshDatabase;


    public function testCreate()
    {
        Plano::create([
            'descricao' => 'plano de teste',
            'valor' => 9.99
        ]);

        $this->assertDatabaseHas('planos', [
            'descricao' => 'plano de teste',
            'valor' => 9.99
        ]);
    }
}
