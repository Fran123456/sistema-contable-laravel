<?php

namespace App\Http\Controllers\Cuentasporcobrar;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\cuentasporcobrar\CxcTransacciones;


class CuentasPorCobrarController extends Controller
{
    public function index(){

        $cuentas = CxcTransacciones::where('estado_id', 1)->where('anulada',false)->get();
        return view('CuentasPorcobrar.listar', compact('cuentas')); 
    }
}
