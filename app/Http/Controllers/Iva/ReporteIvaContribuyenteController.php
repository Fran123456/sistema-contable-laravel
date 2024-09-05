<?php

namespace App\Http\Controllers\Iva;
use App\Http\Controllers\Controller;
use App\Help\Help;
use Illuminate\Http\Request;
use App\Models\Facturacion\LibroVenta;
use App\Models\RRHH\RRHHEmpresa;
use Barryvdh\DomPDF\Facade\Pdf;

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
            ->where('empresa_id', $empresa_id)
            ->where('mostrar', true)
            ->get();
        
        if ($data->isEmpty()) {
            return back()->with('error', 'No hay datos para generar');
        }

        if ($request->type == 'excel') {

            return Excel::download(new LibroIvaContribuyenteExcel($data, $mes, $anio), 'libro_iva_contribuyente.xlsx');
        }

         // Generar reporte en PDF
        if ($request->type == 'pdf') {
            // Obtener la empresa
            $empresa = RRHHEmpresa::find($empresa_id);

            // Generar PDF utilizando la vista
            $pdf = Pdf::loadView('iva.reporteIvaContribuyente.pdf_libro_ventas', compact('data', 'mes', 'anio', 'empresa'))
                ->setPaper('a4', 'landscape');

            return $pdf->download('Libro_Ventas_Contribuyentes_'.$mes.'_'.$anio.'.pdf');
        }

        // return LibroCompraRpt::report($data, $mes, $anio);
    }
}
