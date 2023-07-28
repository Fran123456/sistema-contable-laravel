<?php

namespace App\Http\Controllers\Contabilidad;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Help\Help;
use App\Help\Log;
use App\Models\Contabilidad\ContaCuentaContable;


class ReportesContablesController extends Controller
{

    public function reportes(){
        $cuentas = ContaCuentaContable::where('clasificacion_id', 2)->get();
        return view('contabilidad.reportes.home', compact('cuentas'));
    }
  
    public function reporteBalanceSaldos(){

    }

    public function reporteSaldoCuenta(Request $request){

    }

}
