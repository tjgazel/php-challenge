<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StatusTransacao extends Model
{
    protected $table = 'status_transacao';

    public $timestamps = false;

    protected $fillable = ['descricao', 'codigo'];
}
