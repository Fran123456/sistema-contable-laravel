<?php

namespace App\Http\Controllers\Iva;
use App\Http\Controllers\Controller;
use App\Help\Help;

use Illuminate\Http\Request;

class ReporteIvaContribuyenteController extends Controller
{
    public function index()
    {
        return view('iva.reporteIvaContribuyente.index');
    }
}
