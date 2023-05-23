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
use App\Models\Contabilidad\ContaDetallePartida;
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

    public static function updateHaberDebe($partidaId, $debe, $haber){
        $partida = ContaPartidaContable::find($partidaId);
        $partida->debe = $partida->debe +$debe;
        $partida->haber = $partida->haber +$haber;
        $partida->save();
    }

    public static function detalle($data){					
        try {
            DB::beginTransaction();
            $empresa = Help::empresa();
            ContaDetallePartida::create([
                'partida_id'=>$data['partida_id'],
                'periodo_id'=>$data['periodo_id'],
                'tipo_partida_id'=>$data['tipo_partida_id'],
                'empresa_id'=>$empresa,
                'creador_id'=>Help::usuario()->id,
                //'actualizador_id'=>Help::usuario()->id,
                'cuenta_contable_id'=>$data['cuenta_contable_id'],
                'debe'=>$data['debe'],
                'haber'=>$data['haber'],
                'fecha_contable'=>$data['fecha_contable'],
                'concepto'=>$data['concepto'],
            ]);

            self::updateHaberDebe($data['partida_id'], $data['debe'], $data['haber']);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return back()->with('danger', 'Error, no se puede procesar la petición');
        }
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
                'debe'=> 0, 
                'haber'=> 0,
                'fecha_contable'=>$data['fecha_contable'], 
                'cerrada'=> 0,
                'anulada'=>0,
                'fecha_cierre'=> null,
                'empresa_id'=>  $empresa,
                'actualizador_id'=>null,
                'creador_id'=>Help::usuario()->id,
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
