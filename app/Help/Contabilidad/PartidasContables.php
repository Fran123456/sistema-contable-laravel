<?php

namespace App\Help\Contabilidad;

use Illuminate\Support\Facades\Storage;
use App\Help\HttpClient;
use Carbon\Carbon;
use Illuminate\Support\Facades\Route;
use \Illuminate\Support\Str;
use App\Help\Help;
use Illuminate\Support\Facades\DB;
use App\Models\Contabilidad\ContaPartidaContable;
use App\Models\Contabilidad\ContaPeriodoContable;
class PartidasContables
{

    public static function correlativo($periodoId, $tipoPartidaId){
        $empresa = Help::empresa();
        $periodo = ContaPeriodoContable::find($periodoId);
        return $periodo->tiposPartidaByEmpresa()->where('tipo_partida_id',$tipoPartidaId)
        ->first()->pivot->correlativo+1;
    }

    public static function updateCorrelativo($periodoId, $tipoPartidaId){
        $empresa = Help::empresa();
        $periodo = ContaPeriodoContable::find($periodoId);
        $periodo->tiposPartidaByEmpresa()
        ->updateExistingPivot($tipoPartidaId, ['correlativo'=> self::correlativo($periodoId, $tipoPartidaId)]);
    }

    public static function cabecera($data){

        try {
            DB::beginTransaction();
            $empresa = Help::empresa();
            $cabecera = ContaPartidaContable::create([
                'concepto'=>$data['concepto'],
                'periodo_id'=>$data['periodo_id'],
                'tipo_partida_id'=> $data['tipo_partida_id'],
                'correlativo'=>self::correlativo($data['periodo_id'], $data['tipo_partida_id']),
                'debe'=> $data['debe'], 
                'haber'=> $data['haber'],
                'fecha_contable'=>$data['fecha_contable'], 
                'cerrada'=> 0,
                'anulada'=>0,
                'fecha_cierre'=> null,
                'empresa_id'=>  $empresa,
            ]);

            self::updateCorrelativo($data['periodo_id'], $data['tipo_partida_id']);
            DB::commit();
            return $cabecera;
        } catch (Exception $e) {
            DB::rollBack();
            return back()->with('danger', 'Error, no se puede procesar la petición');
        }

    }
}
