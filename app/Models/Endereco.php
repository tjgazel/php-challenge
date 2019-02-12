<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    protected $table = 'enderecos';

    public $timestamps = false;

    protected $fillable = ['cliente_id', 'cep', 'logradouro', 'numero', 'complemento', 'bairro', 'cidade', 'uf'];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }
}
