<?php

namespace App\Models\Contabilidad;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContaGrupoResultadoRpt extends Model
{
    use HasFactory;

    protected $table = "conta_grupo_resultado_rpt";

    protected $fillable = [
        'grupo',
        'utilidad_id',
        'signo',
        'empresa_id'
    ];

    public function utilidad(){
        return $this->belongsTo(ContaUtilidadRpt::class, 'utilidad_id')->withDefault();
    }
}
