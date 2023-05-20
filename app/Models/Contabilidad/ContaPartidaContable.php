<?php

namespace App\Models\Contabilidad;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContaPartidaContable extends Model
{
    use HasFactory;
    protected $table = 'conta_partida_contable';
    protected $fillable = [
        'concepto','created_at','updated_at','periodo_id','tipo_partida_id','correlativo',
        'debe','haber','fecha_contable','cerrada','anulada','fecha_cierre','empresa_id'
    ];

}


