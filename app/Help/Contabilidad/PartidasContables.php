<?php

namespace App\Help\Contabilidad;

use App\Help\Help;
use App\Models\Contabilidad\ContaDetallePartida;
use App\Models\Contabilidad\ContaPartidaContable;
use App\Models\Contabilidad\ContaPeriodoContable;
use App\Models\Contabilidad\ContaCuentaContable;
use Illuminate\Support\Facades\DB;

class PartidasContables
{

    public static function correlativo($periodoId, $tipoPartidaId)
    {
        $empresa = Help::empresa();
        $periodo = ContaPeriodoContable::find($periodoId);
        return $periodo->tiposPartidaByEmpresa()->where('tipo_partida_id', $tipoPartidaId)
            ->first()->pivot->correlativo + 1;
    }

    public static function updateCorrelativo($periodoId, $tipoPartidaId)
    {
        $empresa = Help::empresa();
        $periodo = ContaPeriodoContable::find($periodoId);
        $periodo->tiposPartidaByEmpresa()
            ->updateExistingPivot($tipoPartidaId, ['correlativo' => self::correlativo($periodoId, $tipoPartidaId)]);
    }

    public static function updateHaberDebe($partidaId, $debe, $haber)
    {
        $partida = ContaPartidaContable::find($partidaId);
        $partida->debe = $partida->debe + $debe;
        $partida->haber = $partida->haber + $haber;
        $partida->save();
    }

    public static function anular($id){
        $partida = ContaPartidaContable::find($id);
        $partida->debe = 0;
        $partida->haber = 0;
        $partida->anulada = true;
        $actualizador_id=Help::usuario()->id;
        $partida->save();
        ContaDetallePartida::where('partida_id', $id)->update(['debe'=>0, 'haber'=>0,'actualizador_id'=>Help::usuario()->id]);
        return $partida;
    }

    public static function detalle($data)
    {
        try {
            DB::beginTransaction();
            $empresa = Help::empresa();
            $dt =ContaDetallePartida::create([
                'partida_id' => $data['partida_id'],
                'periodo_id' => $data['periodo_id'],
                'tipo_partida_id' => $data['tipo_partida_id'],
                'empresa_id' => $empresa,
                'creador_id' => Help::usuario()->id,
                //'actualizador_id'=>Help::usuario()->id,
                'cuenta_contable_id' => $data['cuenta_contable_id'],
                'debe' => $data['debe'],
                'haber' => $data['haber'],
                'fecha_contable' => $data['fecha_contable'],
                'concepto' => $data['concepto'],
            ]);

            self::updateHaberDebe($data['partida_id'], $data['debe'], $data['haber']);
             self::updateSaldoPorCuenta($data['debe'], $data['haber'],$data['cuenta_contable_id'] );
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return back()->with('danger', 'Error, no se puede procesar la petición');
        }
    }

    public static function cabecera($data)
    {

        try {
            DB::beginTransaction();
            $empresa = Help::empresa();
            $cabecera = ContaPartidaContable::create([
                'concepto' => $data['concepto'],
                'periodo_id' => $data['periodo_id'],
                'tipo_partida_id' => $data['tipo_partida_id'],
                'correlativo' => self::correlativo($data['periodo_id'], $data['tipo_partida_id']),
                'debe' => 0,
                'haber' => 0,
                'fecha_contable' => $data['fecha_contable'],
                'cerrada' => 0,
                'anulada' => 0,
                'fecha_cierre' => null,
                'empresa_id' => $empresa,
                'actualizador_id' => null,
                'creador_id' => Help::usuario()->id,
            ]);

            self::updateCorrelativo($data['periodo_id'], $data['tipo_partida_id']);
            DB::commit();
            return $cabecera;
        } catch (Exception $e) {
            DB::rollBack();
            return back()->with('danger', 'Error, no se puede procesar la petición');
        }

    }


    public static function updateCabecera($data)
    {
        try {
            DB::beginTransaction();

            $cabecera = ContaPartidaContable::find($data['id']);
            $fechaAntigua = $cabecera->fecha_contable;

            $cabecera->concepto = $data['concepto'];
            $cabecera->fecha_contable = $data['fecha_contable'];
            $cabecera->actualizador_id = Help::usuario()->id;
            $cabecera->save();

            if ($fechaAntigua != $data['fecha_contable']) {
                $dt = ContaDetallePartida::where('partida_id', $data['id'])->where('fecha_contable', $fechaAntigua)->get();
                foreach ($dt as $key => $d) {
                    $d->fecha_contable = $data['fecha_contable'];
                    $d->actualizador_id = Help::usuario()->id;
                    $d->save();
                }
            }
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return back()->with('danger', 'Error, no se puede procesar la petición');
        }

    }

    public static function updateSaldoPorCuenta( $debe, $haber, $cuentaId){
       $cuenta= ContaCuentaContable::find($cuentaId);
       $cuenta->saldo = $cuenta->saldo + self::operacion($debe, $haber, $cuenta->tipo_cuenta);
       $cuenta->save();
       $recursivo = $cuenta->padreRecursivo;
   
       while ($recursivo!= null) {
            $recursivo->saldo = $recursivo->saldo + self::operacion($debe, $haber, $recursivo->tipo_cuenta);
            $recursivo->save();
            $recursivo = $recursivo->padreRecursivo;
       }
    }

    public static function operacion($debe, $haber, $tipo){
        $valor = 0;
        if($tipo == "acreedora"){
            $valor = $debe - $haber;
        }else{ //deudora
            $valor = $haber - $debe;
        }
        return $valor;
    }
}
