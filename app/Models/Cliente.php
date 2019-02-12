<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'clientes';

    protected $fillable = ['nome', 'email', 'cpf', 'updated_at', 'created_at'];

    public function endereco()
    {
        return $this->hasOne(Endereco::class, 'cliente_id');
    }

    public function contatos()
    {
        return $this->hasMany(Contato::class, 'cliente_id');
    }
}
