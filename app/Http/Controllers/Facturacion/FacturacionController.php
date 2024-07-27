<?php

namespace App\Http\Controllers\Facturacion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Facturacion\FactFacturacion;


class FacturacionController extends Controller
{
    public function index()
    {
        $empresaId = Auth::user()->empresa_id;
        $facturaciones = FactFacturacion::where('empresa_id', $empresaId)->get();

        return view('facturacion.index', compact('facturaciones'));
    }
}
