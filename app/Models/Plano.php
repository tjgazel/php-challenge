<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plano extends Model
{
    protected $table = 'planos';

    public $timestamps = false;

    protected $fillable = ['descricao', 'valor'];
}
