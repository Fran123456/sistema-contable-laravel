<?php

namespace App\Models\RRHH;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RRHHPeriodosPlanilla extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'year',
        'mes',
        'periodo_dias',
        'mes_string',
        'tipo_periodo',
        'empresa_id',
        'activo',
        'created_at',
        'updated_at',
    ];

    protected $table = 'rrhh_periodo_planilla';

    public function empresa(){
        return $this->belongsTo(RRHHEmpresa::class, 'empresa_id')->withDefault(); //with default muestra los null
    }

    public function rrhhIncapacidad() {
        return $this->hasMany(RRHHIncapacidad::class, 'periodo_planilla', 'id');
    }
}
