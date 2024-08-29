<?php

namespace App\Http\Controllers\Iva;
use App\Http\Controllers\Controller;
use App\Help\Help;
use Illuminate\Http\Request;
use App\Models\Facturacion\LibroVenta;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\IVA\LibroIvaContribuyenteRpt as LibroIvaContribuyenteExcel;


class ReporteIvaContribuyenteController extends Controller
{
    public function index()
    {
        return view('iva.reporteIvaContribuyente.index');
    }

    public function getReporteLibroIvaContribuyente(Request $request)
    {
        $empresa_id = Help::empresa();
        $mes = $request->month;
        $anio = $request->year;

        $data = LibroVenta::whereYear('fecha_emision', $anio)
            ->whereMonth('fecha_emision', $mes)
            ->get();

        if ($request->type == 'excel') {

            return Excel::download(new LibroIvaContribuyenteExcel($data, $mes, $anio), 'libro_iva_contribuyente.xlsx');
        }

        if ($data->isEmpty()) {
            // dd($data);
            return back()->with('error', 'No hay datos para generar');
        }

        // return LibroCompraRpt::report($data, $mes, $anio);
    }
}
