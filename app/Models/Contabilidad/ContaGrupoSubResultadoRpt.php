<?php

namespace App\Models\Contabilidad;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContaGrupoSubResultadoRpt extends Model
{
    use HasFactory;

    protected $table = "conta_grupo_sub_resultado_rpt";

    protected $fillable = [
        'sub_grupo',
        'grupo_id',
        'utilidad_id'
    ];

    public function utilidad(){
        return $this->belongsTo(ContaUtilidadRpt::class, 'utilidad_id')->withDefault();
    }

    public function grupo(){
        return $this->belongsTo(ContaGrupoSubResultadoRpt::class, 'grupo_id')->withDefault();
    }
}
