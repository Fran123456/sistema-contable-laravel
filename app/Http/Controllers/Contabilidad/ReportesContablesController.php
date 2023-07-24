<?php

namespace App\Http\Controllers\Contabilidad;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Help\Help;
use App\Help\Log;


class ReportesContablesController extends Controller
{

    public function reportes(){
        
        return view('contabilidad.reportes.home');
    }


    //BALANCE DE SALDOS
    //vista
    public function reporteBalanceSaldos(){

    }

}
