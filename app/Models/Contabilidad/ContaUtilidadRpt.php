<?php

namespace App\Models\Contabilidad;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContaUtilidadRpt extends Model
{
    use HasFactory;

    protected $table = "conta_utilidad_rpt";

    protected $fillable = [
        'utilidad',
        'saldo',
        'empresa_id'
    ];
    
}
