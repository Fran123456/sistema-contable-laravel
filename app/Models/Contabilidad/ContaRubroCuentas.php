<?php

namespace App\Models\Contabilidad;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContaRubroCuentas extends Model
{
    use HasFactory;

    protected $fillable = [
        'rubro',
        'signo',
        'saldo',
        'empresa_id'
    ];
}
