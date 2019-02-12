<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transacao extends Model
{
    protected $table = 'transacoes';

    protected $fillable = [
        'cliente_id', 'plano_id', 'status_transacao_id', 'titular', 'numero_cartao', 'ccv', 'mes', 'ano',
        'created_at', 'updated_at'
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }

    public function plano()
    {
        return $this->belongsTo(Plano::class, 'plano_id');
    }

    public function status()
    {
        return $this->belongsTo(StatusTransacao::class, 'status_transacao_id');
    }
}
