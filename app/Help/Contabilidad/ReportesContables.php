<?php

namespace App\Help\Contabilidad;

use App\Models\Contabilidad\ContaCuentaContable;
use Illuminate\Support\Facades\DB;
use App\Help\Help;
class ReportesContables
{

    public static function saldoAcreedorDeudor($debe, $haber, $saldo, $tipo){

        $aux = 0;
        if ($tipo == "deudora") {
            $aux = $debe - $haber;
        } else {
            $aux = $haber - $debe;
        }
        $saldo = $aux + $saldo;
        return $saldo;

    }



    //OBIENE EL SALDO DE UNA CUENTA A LA FECHA
    public static function obtenerSaldoMayorNuevo($cuenta, $fechaInicial, $fechaFinal)
    {
        $saldo = 0;
        $resp = array();
        $detalle = false;
        if ($fechaFinal == null) {
            $fechaFinal = date('Y-m-d');
        }
        if (isset($cuenta?->hijosRecursivos) && count($cuenta?->hijosRecursivos) > 0) {
            foreach ($cuenta->hijosRecursivos as $cuenta_hija) {

                if ($detalle) {
                    $aux = self::obtenerSaldoMayorNuevo($cuenta_hija, $fechaInicial, $fechaFinal);
                    if (count($aux) > 0) {
                        array_push($resp, $aux);
                    }
                } else {
                    $monto = self::obtenerSaldoMayorNuevo($cuenta_hija, $fechaInicial, $fechaFinal);
                    if ($cuenta_hija->naturaleza == 'deudora') {
                        $saldo = $saldo + $monto;
                    } else {
                        $saldo = $saldo - $monto;
                    }
                }
            }
        } else {

            //CUANDO HAY FECHA INICIO Y FIN
            if ($fechaInicial && $fechaFinal) {
                $debea = DB::select("SELECT SUM(debe) as monto FROM conta_detalle_partida_contable
                WHERE cuenta_contable_id=?  and fecha_contable  BETWEEN ? AND ?", [$cuenta->id, $fechaInicial, $fechaFinal]);

                $habera = DB::select("SELECT SUM(haber) as monto FROM conta_detalle_partida_contable
                WHERE cuenta_contable_id=?  and fecha_contable  BETWEEN ? AND ?", [$cuenta->id, $fechaInicial, $fechaFinal]);

            }

            //CUANDO HAY FECHA FINAL ES DECIR CALCULAR EL SALDO DESDE LOS INICIOS
            if ($fechaFinal && $fechaInicial == null) {
                $debea = DB::select("SELECT SUM(debe) as monto FROM conta_detalle_partida_contable
                WHERE cuenta_contable_id=?  and fecha_contable  <?", [$cuenta->id, $fechaFinal]);

                $habera = DB::select("SELECT SUM(haber) as monto FROM conta_detalle_partida_contable
                WHERE cuenta_contable_id=?  and fecha_contable  < ?", [$cuenta->id, $fechaFinal]);
            }

            if ($debea[0]->monto > 0 || $habera[0]->monto > 0) {
                array_push($resp, array('debe' => $habera, 'haber' => $debea,
                    'cuenta' => $cuenta->codigo, 'cuenta_id' => $cuenta->id, 'nombre' => $cuenta->nombre_cuenta, "natu" => $cuenta->tipo_cuenta));
            }
            $debe = $debea[0]->monto;
            $haber = $habera[0]->monto;
            //(deudora y abono) o (acreedora y cargos) restaran
            if ($cuenta->naturaleza == "deudora") {
                $total = $debe - $haber;
            } else {
                $total = $haber - $debe;
            }
            $saldo = $total + $saldo;
        }
        if ($detalle) {
            return $resp;
        }
        $pr = substr($cuenta->codigo, 0, 1);
        if ($pr == 2) {
            if ($saldo < 0) {
                $saldo = $saldo * -1;
            }
        }
        return $saldo;
    }

    public static function getSaldo($cuentaId, $fechaInicial, $fechaFinal = null)
    {
        $debe = 0;
        $haber = 0;
        $cuenta = ContaCuentaContable::find($cuentaId);
        return self::obtenerSaldoMayorNuevo($cuenta, $fechaInicial, $fechaFinal);
    }

}
