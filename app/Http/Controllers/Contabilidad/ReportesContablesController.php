<?php

namespace App\Http\Controllers\Contabilidad;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Help\Help;
use App\Help\Contabilidad\ReportesContables;
use App\Help\Log;
use App\Models\Contabilidad\ContaCuentaContable;
use App\Models\Contabilidad\ContaDetallePartida;
use App\ReportsPDF\Contabilidad\SaldoCuentaRpt;
use App\Exports\Contabilidad\SaldoCuentaRpt as SaldoCuentaRptExcel;
use App\ReportsPDF\Contabilidad\LibroDiarioRpt;
use App\Exports\Contabilidad\LibroDiarioRpt as LibroDiarioRptExcel;
use PDF;
use App\Exports\Contabilidad\LibroDiarioMayorRpt as LibroDiarioMayorRptExcel;
use App\ReportsPDF\Contabilidad\LibroDiarioMayorRpt;
use App\ReportsPDF\Contabilidad\BalanceComprobacionRpt;
use App\Exports\Contabilidad\BalanceComprobacionRpt as BalanceComprobacionRptExcel;
use App\Models\Contabilidad\ContaPartidaContable;
use App\ReportsPDF\Contabilidad\BalanceComprobacionRptNew;



use Maatwebsite\Excel\Facades\Excel;

class ReportesContablesController extends Controller
{

    public function reportes(){
        $cuentas = ContaCuentaContable::where('clasificacion_id', 2)->get();
        return view('contabilidad.reportes.home', compact('cuentas'));
    }

    public function reporteBalanceComprobacion(Request $request){

        /*$cuentas =ContaDetallePartida::
        whereBetween('fecha_contable', [$request->fechai, $request->fechaf])
        ->orderBy('codigo_cuenta', 'asc')->with(['cuentaContable'=>function($query){
            $query->select('nombre_cuenta','nombre_cuenta','id','tipo_cuenta');
        }])
        ->get()->toArray();*/

        /*$f = date("d-m-Y h:i:s");
        if($request->excel){
            return Excel::download(new BalanceComprobacionRptExcel($request->fechai, $request->fechaf, $cuentas), "balance-comprobacion-${f}.xlsx");
        }*/
        $data = ReportesContables::debeHaberPorCuentaByFechaGroupByCuenta($request->fechai, $request->fechaf);
        return BalanceComprobacionRptNew::report($request->fechai, $request->fechaf, $data);
        //return BalanceComprobacionRpt::report($request->fechai, $request->fechaf, $cuentas);
    }

    public function reporteSaldoCuenta(Request $request){

        $fechaFinSaldo = $request->fechai;
       // $fechaFinSaldo= date("Y-m-d",strtotime($fechaFinSaldo."- 1 day"));
        $saldo = ReportesContables::getSaldo($request->cuenta, null , $fechaFinSaldo);
        $data = ContaDetallePartida::where('cuenta_contable_id', $request->cuenta)
        ->whereBetween('fecha_contable', [$request->fechai, $request->fechaf])->get();
        $cuenta = ContaCuentaContable::find($request->cuenta);
        $f = date("d-m-Y h:i:s");
        if($request->excel){
            return Excel::download(new SaldoCuentaRptExcel($request->fechai, $request->fechaf, $data, $saldo, $cuenta), "saldoCuenta-${f}.xlsx");
        }
        return SaldoCuentaRpt::report($request->fechai, $request->fechaf, $data, $saldo, $cuenta);
    }

    public function reporteLibroDiario(Request $request){

        $data = ContaDetallePartida::whereBetween('fecha_contable',[$request->fechai, $request->fechaf])
        ->orderBy('fecha_contable','DESC')->with('cuentaContable','partida')->get();
        $f = date("d-m-Y h:i:s");
        if($request->excel){
            return Excel::download(new LibroDiarioRptExcel($request->fechai, $request->fechaf, $data), "libro-diario-${f}.xlsx");
        }
        return LibroDiarioRpt::report($request->fechai, $request->fechaf, $data->toArray());
    }

    public function listadoDePartidas(Request $request){

        $data = [
            'partida' => ContaPartidaContable::whereBetween('fecha_contable',[$request->fechai, $request->fechaf])
            ->orderBy('fecha_contable','DESC')->get(),
            'fechai'=> $request->fechai,
            'fechaf'=> $request->fechaf
        ];

        return PDF::loadView('contabilidad.reportes.ListadoPartidasPDF', $data)
        ->stream('listado_partidas_contables.pdf');

    }

    public function libroDiarioMayor(Request $request){
        $cuentas =ContaDetallePartida::select('codigo_cuenta','cuenta_contable_id')
        ->whereBetween('fecha_contable', [$request->fechai, $request->fechaf])
        ->groupBy('cuenta_contable_id')->get();
        $cuentasMayores = array();
        $cuentasMayoresObj = array();
        foreach ($cuentas as $key => $value) {
            $cuenta =$value->cuentaContable->buscarPadre($value->cuenta_contable_id,4);
          //  $detalle = ReportesContables::getSaldoDetalle($value->cuenta_contable_id, $request->fechai,$request->fechaf, true);
          //  $detalleArreglado = array();
            array_push($cuentasMayores,$cuenta->id);
            array_push($cuentasMayoresObj,array("id"=>$cuenta->id, "codigo"=> $cuenta->codigo, "nombre"=>
            $cuenta->nombre_cuenta, "saldo"=>$cuenta->saldo));
        }
        $cuentasMayoresFiltrado = array_unique($cuentasMayores);

        $data = array();
        $c = 0;
        foreach ( $cuentasMayoresFiltrado as $key => $value) {
            $detalle = ReportesContables::getSaldoDetalle($value, $request->fechai,$request->fechaf, true);
            if ( isset($detalle[0]['debe']) ) {
                //return $data[0]['detalle'];
             }else{
                $detalle = $detalle[0];
                 //return $data[1]['detalle'];
             }
             $c++;
            array_push($data, array("cuenta"=> $cuentasMayoresObj[$key], "detalle"=> $detalle)   );
        }
        $f = date("d-m-Y h:i:s");
        if($request->excel){
            return Excel::download(new LibroDiarioMayorRptExcel($request->fechai, $request->fechaf, $data), "libro-diario-mayor-${f}.xlsx");
        }
        return LibroDiarioMayorRpt::report($request->fechai, $request->fechaf, $data);


    }

}
