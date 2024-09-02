<?php

namespace App\Models\Contabilidad;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContaGrupoCuentaResultadoRpt extends Model
{
    use HasFactory;

    protected $table = "conta_grupo_cuenta_resultado_rpt";

    protected $fillable = [
        'cuenta_id',
        'codigo',
        'grupo_id',
        'empresa_id',
        'utilidad_id',
        'sub_grupo_id',
    ];

    public function grupo(){
        return $this->belongsTo(ContaGrupoResultadoRpt::class, 'grupo_id')->withDefault();
    }

    public function subGrupo(){
        return $this->belongsTo(ContaGrupoSubResultadoRpt::class, 'sub_grupo_id')->withDefault();
    }
    public function utilidad(){
        return $this->belongsTo(ContaUtilidadRpt::class, 'utilidad_id')->withDefault();
    }
    public function cuenta(){
        return $this->belongsTo(ContaCuentaContable::class, 'cuenta_id')->withDefault();
    }
}
