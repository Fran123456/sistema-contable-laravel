<?php

namespace App\Models\Contabilidad;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Contabilidad\ContaGrupoResultadoRpt;
use App\Models\Contabilidad\ContaGrupoSubResultadoRpt;
use App\Models\Contabilidad\ContaUtilidadOperacionRpt;

class ContaUtilidadRpt extends Model
{
    use HasFactory;

    protected $table = "conta_utilidad_rpt";

    protected $fillable = [
        'utilidad',
        'saldo',
        'empresa_id'
    ];

    public function grupos(){
        return $this->hasMany(ContaGrupoResultadoRpt::class,'utilidad_id');
    }


    public static function calcularSaldos($fechaI, $fechaF, $utilidadId, $empresaId)
    {
        self::query()->where('id',$utilidadId)->where('empresa_id',$empresaId)->update(['saldo' => 0]);
        $grupos = ContaGrupoResultadoRpt::query()->where('utilidad_id',$utilidadId)->where('empresa_id',$empresaId)->get();
        $utilidadAcumulada = 0;
        foreach ($grupos  as $key => $grupo){
            $grupo->saldo = 0;
            $grupo->save();
            $subGrupos = ContaGrupoSubResultadoRpt::where('grupo_id', $grupo->id)->where('empresa_id',$empresaId)->get();
            foreach ($subGrupos as $key => $subGrupo) {
                $subGrupo->saldo = 0;
                $subGrupo->save();
            }
        }

        foreach ($grupos  as $key => $grupo) {

           $subGrupos = ContaGrupoSubResultadoRpt::where('grupo_id', $grupo->id)->where('empresa_id',$empresaId)->get();
           $grupo->saldo = 0;
           $grupo->save();
           $saldoAcumuladoGrupo = 0;
           foreach ($subGrupos as $key => $subGrupo) {
                $saldo = $subGrupo->sumaCuentasResultado($subGrupo->id, $fechaI, $fechaF, $empresaId);
                $saldoAcumuladoGrupo = $saldoAcumuladoGrupo+$saldo;
           }
           $grupo->saldo = $saldoAcumuladoGrupo+ $grupo->saldo;
           $grupo->save();
           if($grupo->signo =='+'){
            $utilidadAcumulada = $utilidadAcumulada+$saldoAcumuladoGrupo;
           }else{
            $utilidadAcumulada = $utilidadAcumulada-$saldoAcumuladoGrupo;
           }
           
        }


        $util = self::find($utilidadId);
        $util->saldo = $utilidadAcumulada;
        $util->save();

        return true;
    }


    public static function calcularSaldoUtilidad($utilidadId)
    {
        $utilidad = self::find($utilidadId);
        $operacionUtilidad = ContaUtilidadOperacionRpt::where('utilidad_id',$utilidadId)->get();

        foreach ($operacionUtilidad as $key => $value) {
            if($value->utilidad_operar_id != $utilidad->id){

                if($value->signo == '+'){
                    $utilidad->saldo = $utilidad->saldo + $value->utilidadOperacion->saldo;
                }else{
                    $utilidad->saldo = $value->utilidadOperacion->saldo - $utilidad->saldo;
                }
                $utilidad->save();                
            }
        }

        return $utilidad->saldo;
    }
    
}
