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
use App\Models\Contabilidad\ContaPartidaContable;


use Maatwebsite\Excel\Facades\Excel;

class ReportesContablesController extends Controller
{

    public function reportes(){
        $cuentas = ContaCuentaContable::where('clasificacion_id', 2)->get();
        return view('contabilidad.reportes.home', compact('cuentas'));
    }

    public function reporteBalanceComprobacion(Request $request){
        $cuentas =ContaDetallePartida::select('cuenta_contable_id')
        ->whereBetween('fecha_contable', [$request->fechai, $request->fechaf])
        ->groupBy('cuenta_contable_id')->get();
        return $cuentas;
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

}
