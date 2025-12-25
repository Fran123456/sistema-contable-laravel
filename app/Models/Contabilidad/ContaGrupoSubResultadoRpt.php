<?php

namespace App\Models\Contabilidad;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Contabilidad\ContaGrupoCuentaResultadoRpt;
use App\Help\Contabilidad\ReportesContables;

class ContaGrupoSubResultadoRpt extends Model
{
    use HasFactory;

    protected $table = "conta_grupo_sub_resultado_rpt";

    protected $fillable = [
        'sub_grupo',
        'grupo_id',
        'utilidad_id',
        'empresa_id'
    ];

    public function utilidad(){
        return $this->belongsTo(ContaUtilidadRpt::class, 'utilidad_id')->withDefault();
    }

    public function grupo(){
        return $this->belongsTo(ContaGrupoResultadoRpt::class, 'grupo_id');
    }

    public function cuentas(){
        return $this->hasMany(ContaGrupoCuentaResultadoRpt::class, 'sub_grupo_id');
    }

    public function sumaCuentasResultado($subGrupoId, $fechaInicio, $fechaFin, $empresaId)
    {
        $cuentas = ContaGrupoCuentaResultadoRpt::where('sub_grupo_id', $subGrupoId)->where('empresa_id', $empresaId)->get();
        $saldo = 0;
        foreach ($cuentas as $key => $cuenta) {
            $auxiliar = ReportesContables::getSaldoCuenta($cuenta->cuenta_id, $fechaInicio, $fechaFin);
            $cuenta->saldo = $auxiliar;
            $cuenta->save();
            $saldo = $saldo + $auxiliar;
        }

        $g = self::find($subGrupoId);
        $g->saldo = $saldo;
        $g->save();

        return $saldo;
    }
}
