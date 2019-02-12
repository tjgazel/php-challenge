<?php

namespace Tests\Feature;

use App\Models\Cliente;
use App\Models\Contato;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class InscricaoTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCreate()
    {
        $data = [
            'nome' => 'User',
            'cpf' => '21470542080',
            'email' => 'teste@teste.com',
            'contatos' => ['(33) 99999-9999'],
            'cep' => '39800-000',
            'logradouro' => 'Rua teste',
            'numero' => '200',
            'complemento' => 'B',
            'bairro' => 'teste',
            'cidade' => 'teste',
            'uf' => 'MG',
            'plano_id' => '1',
            'titular' => 'User',
            'numero_cartao' => '1010 1010 1010 1010',
            'ccv' => '123',
            'mes' => '10',
            'ano' => '2019'
        ];

        $cliente = Cliente::updateOrCreate(['cpf' => $data['cpf']], $data);

        if ($cliente->endereco) {
            $cliente->endereco->cep = $data['cep'];
            $cliente->endereco->logradouro = $data['logradouro'];
            $cliente->endereco->numero = $data['numero'];
            $cliente->endereco->complemento = $data['complemento'];
            $cliente->endereco->cidade = $data['cidade'];
            $cliente->endereco->bairro = $data['bairro'];
            $cliente->endereco->uf = $data['uf'];
            $cliente->endereco->save();
        } else {
            $cliente->endereco()->create($data);
        }

        if ($cliente->contatos->count()) {
            $cliente->contatos->each(function ($contato) {
                $contato->delete();
            });
        }

        foreach($data['contatos'] as $contato){
            Contato::create(['cliente_id' => $cliente->id, 'telefone' => $contato]);
        }

        $this->assertDatabaseHas('clientes', [
            'cpf' => '21470542080'
        ]);
        $this->assertDatabaseHas('enderecos', [
            'cep' => '39800-000',
            'logradouro' => 'Rua teste',
            'numero' => '200'
        ]);
        $this->assertDatabaseHas('contatos', [
            'cliente_id' => $cliente->id,
            'telefone' => '(33) 99999-9999'
        ]);
    }
}
