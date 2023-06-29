<?php

namespace App\Http\Controllers\Contabilidad;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Help\Help;
use App\Help\Log;
use App\Models\Config\ConfigReporte;

class ReportesContablesController extends Controller
{

    public function reportes(){
        $reportes = ConfigReporte::where('modulo','contabilidad')->get();
        return view('contabilidad.reportes.home',compact('reportes'));
    }


    //BALANCE DE SALDOS
    //vista
    public function reporteBalanceSaldos(){

    }

}
