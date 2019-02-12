<?php

namespace App\Services;


use App\Models\Cliente;
use App\Models\Contato;

class InscricaoService
{
    public function registrar(array $data)
    {
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

        return $cliente;
    }
}
