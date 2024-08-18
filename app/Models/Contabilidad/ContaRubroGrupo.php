<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContaRubroGrupo extends Model
{
    use HasFactory;

    protected $fillable = [
        'grupo',
        'rubro_id',
        'signo',
        'saldo',
        'empresa_id'
    ];
}
