<?php

namespace App\Http\Controllers\Iva;

use App\Help\Help;
use Illuminate\Http\Request;
use App\Models\Iva\LibroCompra;
use App\Models\RRHH\RRHHEmpresa;
use App\Http\Controllers\Controller;


use Maatwebsite\Excel\Facades\Excel;
use App\ReportsPDF\Iva\LibroCompraRpt;
use App\Exports\IVA\LibroCompraRpt as LibroCompraRptExcel;

class ReporteCompraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('iva.reporteLibroCompra.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function getReporteLibroCompra(Request $request)
    {
        $empresa_id = Help::empresa();
        $mes = $request->month;
        $anio = $request->year;

        $data = LibroCompra::whereYear('fecha_emision', $anio)
            ->whereMonth('fecha_emision', $mes)
            ->where('empresa_id', $empresa_id)
            ->get();

        if ($request->type == 'excel') {
            return Excel::download(new LibroCompraRptExcel($data, $mes, $anio), 'libro_compra.xlsx');
        }

        if ($data->isEmpty()) {
            return back()->with('error', 'No hay datos para generar');
        }

        return LibroCompraRpt::report($data, $mes, $anio);
    }
}