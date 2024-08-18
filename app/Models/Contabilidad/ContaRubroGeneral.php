<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContaRubroGeneral extends Model
{
    use HasFactory;

    protected $table = 'conta_rubro_general_rpt';

    protected $fillable = [
        'rubro',
        'signo',
        'saldo',
        'empresa_id'
    ];
}
