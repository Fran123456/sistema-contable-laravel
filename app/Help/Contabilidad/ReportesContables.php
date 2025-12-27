<?php

namespace App\Help\Contabilidad;

use App\Models\Contabilidad\ContaCuentaContable;
use App\Models\Contabilidad\ContaClasificacionCuenta;
use Illuminate\Support\Facades\DB;
use App\Help\Help;
class ReportesContables
{

    public static function saldoAcreedorDeudor($debe, $haber, $saldo, $tipo){

        $aux = 0;

        if ($tipo == "DEUDORA") {
            $aux = $debe - $haber;
        } else {
            $aux = $haber - $debe;
        }
        $saldo = $aux + $saldo;
        return $saldo;

    }


    public static function debeHaberPorCuentaByFechaGroupByCuenta($fechai, $fechaf){
        $empresaId = Help::empresa();
        $clasificacion =ContaClasificacionCuenta::where('clasificacion', 'detalle')->where('empresa_id', $empresaId)->first();

         return    DB::select("SELECT c.id, c.codigo,c.nombre_cuenta from conta_detalle_partida_contable tc
                             JOIN conta_partida_contable pc on tc.partida_id = pc.id
                             JOIN conta_cuenta_contable c on tc.cuenta_contable_id = c.id
                             WHERE c.clasificacion_id=$clasificacion->id 
                             and c.empresa_id = $empresaId AND
                                   (tc.fecha_contable  BETWEEN ? AND ?)
                               GROUP BY c.id
                               ORDER BY codigo desc",[$fechai,$fechaf]);

     }


     public static function totalDebeHaberPorCuentaByFechaById($fechai, $fechaf, $cuentaId){
         return    DB::select("SELECT c.id , c.codigo,c.nombre_cuenta, tc.fecha_contable,
                             tc.debe, tc.haber ,pc.concepto from conta_detalle_partida_contable tc
                             JOIN conta_partida_contable pc on tc.partida_id = pc.id
                             JOIN conta_cuenta_contable c on tc.cuenta_contable_id = c.id
                             WHERE c.clasificacion_id=2 AND
                                   (tc.fecha_contable  BETWEEN ? AND ?)
                            AND c.id = ?
                               ORDER BY codigo desc",[$fechai,$fechaf, $cuentaId]);

     }





    public static function obtenerSaldoMayorNuevoDebe($cuenta, $fechaInicial, $fechaFinal) {
        $saldo = 0;
        $resp = array();
        $detalle =false;
        $debeHaber = true;
        if (  isset($cuenta?->hijosRecursivos) &&count($cuenta?->hijosRecursivos  )>0 ) {
            foreach ($cuenta->hijosRecursivos as $cuenta_hija) {
              if($detalle){
                $aux  =self::obtenerSaldoMayorNuevoDebe($cuenta_hija,$fechaInicial, $fechaFinal);
                 if(count($aux)>0){
                    if(count($aux)>1){
                        array_push($resp, $aux);
                    }else{
                        array_push($resp, $aux[0]);
                    }
                 }
              }else{
                $monto = self::obtenerSaldoMayorNuevoDebe($cuenta_hija, $fechaInicial, $fechaFinal);

                if ($cuenta_hija->tipo_cuenta == 'DEUDORA') {
                    $saldo = $saldo + $monto;
                } else {
                    $saldo = $saldo - $monto;
                }

                if ($saldo <= 0 && strpos($cuenta_hija->codigo, '2') === 0) {
                    $saldo = $saldo * -1;
                }
                if ($saldo <= 0 && strpos($cuenta_hija->codigo, '5') === 0) {
                    $saldo = $saldo * -1;
                }
                if ($saldo <= 0 && strpos($cuenta_hija->codigo, '3') === 0) {
                    $saldo = $saldo * -1;
                }
              }
            }
        }else{
            $debea = null;
            if($fechaFinal==null){
                $fechaOriginal = $fechaInicial;
                $nuevaFecha = date('Y-m-d', strtotime($fechaOriginal . ' -1 day'));
                $debea = DB::select("SELECT SUM(debe) as monto FROM conta_detalle_partida_contable
                WHERE cuenta_contable_id=?  and fecha_contable  <= ?" ,[$cuenta->id ,$nuevaFecha]);

            }else{
                $debea = DB::select("SELECT SUM(debe) as monto FROM conta_detalle_partida_contable
                WHERE cuenta_contable_id=?  and fecha_contable  BETWEEN ? AND ?" ,[$cuenta->id ,$fechaInicial, $fechaFinal]);
            }


            if($debea[0]->monto >0){
                array_push($resp, array('debe'=>$debea[0]->monto,
             'cuenta'=>$cuenta->codigo,'cuenta_id'=>$cuenta->id,'nombre'=> $cuenta->nombre_cuenta,"natu"=>$cuenta->tipo_cuenta));
            }

            $debe = $debea[0]->monto;
            $haber = 0;


            // if($cuenta->tipo_cuenta =="DEUDORA"){//cuentta 1, 4,6
            // }else{
            //     $debe = $debe*(-1);
            // }


            $saldo= $debe+$saldo;
        }

        if($detalle){
            return $resp;
        }
        return $saldo;
    }



    public static function obtenerSaldoMayorNuevoHeber($cuenta, $fechaInicial, $fechaFinal) {
        $saldo = 0;
        $resp = array();
        $detalle =false;
        $debeHaber = true;
        if (  isset($cuenta?->hijosRecursivos) &&count($cuenta?->hijosRecursivos  )>0 ) {
            foreach ($cuenta->hijosRecursivos as $cuenta_hija) {
            if($detalle){
                $aux  =self::obtenerSaldoMayorNuevoHeber($cuenta_hija,$fechaInicial, $fechaFinal);
                if(count($aux)>0){
                    if(count($aux)>1){
                        array_push($resp, $aux);
                    }else{
                        array_push($resp, $aux[0]);
                    }
                }
            }else{
                $monto = self::obtenerSaldoMayorNuevoHeber($cuenta_hija, $fechaInicial, $fechaFinal);
                if ($cuenta_hija->tipo_cuenta == 'DEUDORA') {
                    $saldo = $saldo + $monto;
                } else {
                    $saldo = $saldo + $monto; // se debe sumar
                }

                if ($saldo <= 0 && strpos($cuenta_hija->codigo, '2') === 0) {
                    $saldo = $saldo * -1;
                }
                if ($saldo <= 0 && strpos($cuenta_hija->codigo, '5') === 0) {
                    $saldo = $saldo * -1;
                }
                if ($saldo <= 0 && strpos($cuenta_hija->codigo, '3') === 0) {
                    $saldo = $saldo * -1;
                }
                if ($saldo <= 0 && strpos($cuenta_hija->codigo, '4') === 0) {
                    $saldo = $saldo * -1;
                }

                if ($saldo <= 0 && strpos($cuenta_hija->codigo, '1') === 0) {
                    $saldo = $saldo * -1;
                }
            }
            }
        }else{

            $habera= null;
            if( $fechaFinal == null){
                $fechaOriginal = $fechaInicial;
                $nuevaFecha = date('Y-m-d', strtotime($fechaOriginal . ' -1 day'));

                $habera = DB::select("SELECT SUM(haber) as monto FROM conta_detalle_partida_contable
                WHERE cuenta_contable_id=?  and fecha_contable  <= ?",[$cuenta->id,$nuevaFecha]);
            }else{
                $habera = DB::select("SELECT SUM(haber) as monto FROM conta_detalle_partida_contable
                WHERE cuenta_contable_id=?  and fecha_contable  BETWEEN ? AND ?",[$cuenta->id,$fechaInicial, $fechaFinal]);
            }



            if( $habera[0]->monto>0){
                array_push($resp, array('haber'=>$habera[0]->monto,
            'cuenta'=>$cuenta->codigo,'cuenta_id'=>$cuenta->id,'nombre'=> $cuenta->nombre_cuenta,"natu"=>$cuenta->tipo_cuenta));
            }

            $debe = 0;
            $haber = $habera[0]->monto;

            // if($cuenta->tipo_cuenta =="DEUDORA"){//cuentta 1, 4,6
            // }else{
            //     $haber = $haber*(-1);
            // }


            $saldo= $haber+$saldo;

        }

        if($detalle){
            return $resp;
        }

        return $saldo;
    }












    public static function obtenerSaldoMayorInicial($cuenta, $fechaInicial, $fechaFinal) {
        $saldo = 0;
        $resp = array();
        $detalle =false;
        $debeHaber = true;
        if (  isset($cuenta?->hijosRecursivos) &&count($cuenta?->hijosRecursivos  )>0 ) {
            foreach ($cuenta->hijosRecursivos as $cuenta_hija) {
              if($detalle){
                $aux  =self::obtenerSaldoMayorInicial($cuenta_hija,$fechaInicial, $fechaFinal);
                 if(count($aux)>0){
                    if(count($aux)>1){
                        array_push($resp, $aux);
                    }else{
                        array_push($resp, $aux[0]);
                    }
                 }
              }else{
                $monto = self::obtenerSaldoMayorInicial($cuenta_hija, $fechaInicial, $fechaFinal);
                if ($cuenta_hija->tipo_cuenta == 'deudora') {
                    $saldo = $saldo + $monto;
                } else {
                    $saldo = $saldo - $monto;
                }


              }
            }
        }else{
            $debea = null;
            $habera = null;
            if($fechaFinal==null){
                $fechaOriginal = $fechaInicial;
                $nuevaFecha = date('Y-m-d', strtotime($fechaOriginal . ' -1 day'));

                $debea = DB::select("SELECT SUM(debe) as monto FROM conta_detalle_partida_contable
                WHERE cuenta_contable_id=?  and fecha_contable  <= ?" ,[$cuenta->id ,$nuevaFecha]);

               $habera = DB::select("SELECT SUM(haber) as monto FROM conta_detalle_partida_contable
                WHERE cuenta_contable_id=?  and fecha_contable  <= ?",[$cuenta->id,$nuevaFecha]);


            }else{
                $debea = DB::select("SELECT SUM(debe) as monto FROM conta_detalle_partida_contable
                WHERE cuenta_contable_id=? AND  and fecha_contable  BETWEEN ? AND ?" ,[$cuenta->id ,$fechaInicial, $fechaFinal]);

                $habera = DB::select("SELECT SUM(haber) as monto FROM conta_detalle_partida_contable
                WHERE cuenta_contable_id=?  and fecha_contable  BETWEEN ? AND ?",[$cuenta->id,$fechaInicial, $fechaFinal]);
            }



            if($debea[0]->monto >0 || $habera[0]->monto>0){
                array_push($resp, array('debe'=>$habera[0]->monto,'haber'=>$debea[0]->monto,
             'cuenta'=>$cuenta->codigo,'cuenta_id'=>$cuenta->id,'nombre'=> $cuenta->nombre_cuenta,"natu"=>$cuenta->tipo_cuenta));
            }

            $debe = $debea[0]->monto;
            $haber = $habera[0]->monto;

            if($cuenta->tipo_cuenta =="deudora" ){//cuentta 1, 4,6
            }else{
                $debe = $debe* (-1);
                $haber= $haber* (-1);
            }

            if($cuenta->tipo_cuenta =="deudora"){
                $total = $debe-$haber;
            }else{
                $total = $haber-$debe;
            }
            $saldo= $total+$saldo;


        }

        if($detalle){
            return $resp;
        }
       /* $pr = substr($cuenta->codigo, 0,1);
            if($pr == 2){
                if($saldo <0){
                    $saldo = $saldo*-1;
            }
        }*/
        return $saldo;
    }




    //OBIENE EL SALDO DE UNA CUENTA A LA FECHA
    public static function obtenerSaldoMayorNuevo($cuenta, $fechaInicial, $fechaFinal, $detalle)
    {


        $saldo = 0;
        $resp = array();
        if ($fechaFinal == null) {
            $fechaFinal = date('Y-m-d');
        }
        if (isset($cuenta?->hijosRecursivos) && count($cuenta?->hijosRecursivos) > 0) {
            foreach ($cuenta->hijosRecursivos as $cuenta_hija) {

                if ($detalle) {
                    $aux = self::obtenerSaldoMayorNuevo($cuenta_hija, $fechaInicial, $fechaFinal,$detalle);
                    if (count($aux) > 0) {

                        if(count($aux)>1){
                            array_push($resp, $aux);
                        }else{
                            array_push($resp, $aux[0]);
                        }
                    }
                } else {
                    $monto = self::obtenerSaldoMayorNuevo($cuenta_hija, $fechaInicial, $fechaFinal,$detalle);
                    if ($cuenta_hija->tipo_cuenta == 'DEUDORA') {
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
                array_push($resp, array('haber' => $habera[0]->monto, 'debe' => $debea[0]->monto,
                    'cuenta' => $cuenta->codigo, 'cuenta_id' => $cuenta->id,
                    'nombre' => $cuenta->nombre_cuenta, "natu" => $cuenta->tipo_cuenta));

                //    array_push($resp, "XXXX");
            }
            $debe = $debea[0]->monto;
            $haber = $habera[0]->monto;
            //(deudora y abono) o (acreedora y cargos) restaran
            if ($cuenta->tipo_cuenta == "DEUDORA") {
                $total = $debe - $haber;
            } else {
                $total = $haber - $debe;
            }
            $saldo = $total + $saldo;
        }
        if ($detalle) {
            return  $resp;
        }
        $pr = substr($cuenta->codigo, 0, 1);
        if ($pr == 2) {
            if ($saldo < 0) {
                $saldo = $saldo * -1;
            }
        }
         if ($pr == 3) {
            if ($saldo < 0) {
                $saldo = $saldo * -1;
            }
        }
        return $saldo;
    }

    public static function getSaldo($cuentaId, $fechaInicial, $fechaFinal = null)
    {
        $cuenta = ContaCuentaContable::find($cuentaId);
        return self::obtenerSaldoMayorNuevo($cuenta, $fechaInicial, $fechaFinal, false);
    }

    public static function getSaldoDetalle($cuentaId, $fechaInicial, $fechaFinal = null)
    {
        $cuenta = ContaCuentaContable::find($cuentaId);
        return self::obtenerSaldoMayorNuevo($cuenta, $fechaInicial, $fechaFinal = null, true);
    }

    public static function getSaldoCuenta($cuentaId, $fechaInicial, $fechaFinal = null)
    {
        $debe = 0;
        $haber = 0;
        $cuenta = ContaCuentaContable::find($cuentaId);


        $debe = self::obtenerSaldoMayorNuevoDebe($cuenta, $fechaInicial, $fechaFinal);
        $haber = self::obtenerSaldoMayorNuevoHeber($cuenta, $fechaInicial, $fechaFinal);
        $pr = substr($cuenta->codigo, 0, 1);
        //dd('debe - haber ' . $debe - $haber . ' haber - debe ' . $haber - $debe);
        $total = 0;

        //comparamoos si es acreedora sin importar si es mayuscula o minuscula
        if (strtolower($cuenta->tipo_cuenta) == "deudora") { // deudora 1 acreedora 0
            $total = $debe - $haber;
        } else {
            $total = $haber - $debe;
        }


      
        return  $total;
    }

    public static function getTotalDeCuentasRango($cuentaInicio, $cuentaFinal, $fechaInicial, $fechaFinal, $clasificacionCuentaId)
    {

        return DB::select("SELECT cc.id FROM conta_detalle_partida_contable dt
                            LEFT JOIN conta_cuenta_contable cc ON cc.id = dt.cuenta_contable_id
                            WHERE cc.clasificacion_id = ?
                            AND (dt.fecha_contable BETWEEN ? AND ?)
                            AND (cc.id BETWEEN ? AND ?)
                            GROUP BY cc.id
                            ORDER BY cc.codigo ASC", [$clasificacionCuentaId, $fechaInicial, $fechaFinal, $cuentaInicio, $cuentaFinal]);

    }

    public static function getTransactiosDetails($cuentaId, $fechaInicial, $fechaFinal)
    {
        return DB::table('conta_detalle_partida_contable as td')
                ->leftJoin('conta_partida_contable as pt', 'pt.id', '=', 'td.partida_id')
                ->leftJoin('conta_cuenta_contable as cc', 'cc.id', '=', 'td.cuenta_contable_id')
                ->select('cc.id','td.id', 'td.fecha_contable', 'cc.nombre_cuenta', 'cc.codigo as codCuenta', 'pt.id as partidaId', 'td.debe', 'td.haber',
                'pt.concepto')
                ->where('cc.id', $cuentaId)
                ->whereBetween('td.fecha_contable', [$fechaInicial, $fechaFinal])
                ->orderBy('td.fecha_contable', 'asc')
                ->get();

    }

}
