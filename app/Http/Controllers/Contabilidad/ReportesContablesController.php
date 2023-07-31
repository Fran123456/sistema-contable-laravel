<?php

namespace App\Http\Controllers\Contabilidad;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Help\Help;
use App\Help\Contabilidad\ReportesContables;
use App\Help\Log;
use App\Models\Contabilidad\ContaCuentaContable;
use App\ReportsPDF\Contabilidad\SaldoCuentaRpt;
use App\Models\Contabilidad\ContaDetallePartida;



class ReportesContablesController extends Controller
{

    public function reportes(){
        $cuentas = ContaCuentaContable::where('clasificacion_id', 2)->get();
        return view('contabilidad.reportes.home', compact('cuentas'));
    }
  
    public function reporteBalanceSaldos(){

    }

    public function reporteSaldoCuenta(Request $request){
        
        $fechaFinSaldo = $request->fechai;
       // $fechaFinSaldo= date("Y-m-d",strtotime($fechaFinSaldo."- 1 day")); 
        $saldo = ReportesContables::getSaldo($request->cuenta, null , $fechaFinSaldo);
        $data = ContaDetallePartida::where('cuenta_contable_id', $request->cuenta)
        ->whereBetween('fecha_contable', [$request->fechai, $request->fechaf])->get();
        $cuenta = ContaCuentaContable::find($request->cuenta);
        return SaldoCuentaRpt::report($request->fechai, $request->fechaf, $data, $saldo, $cuenta);
    }

}
