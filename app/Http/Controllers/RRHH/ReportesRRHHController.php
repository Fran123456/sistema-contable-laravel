<?php

namespace App\Http\Controllers\RRHH;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\RRHH\IncapacidadesRpt;
use App\Help\Help;
use App\Models\RRHH\RRHHIncapacidad;
use App\Models\RRHH\RRHHPeriodosPlanilla;
use App\ReportsPDF\RRHH\IncapacidadRpt;

class ReportesRRHHController extends Controller
{

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function reporteIncapacidades(Request $request)
    {

        $planilla = RRHHPeriodosPlanilla::where("id", $request->id_incapacidad)->first();
        $incapacidades = RRHHIncapacidad::where("empresa_id", Help::empresa())->where("periodo_planilla_id", $request->id_incapacidad)->with("empresa")->with("empleado")->with("tipoIncapacidad")->with("periodoPlanilla")->get();

        $f = date("d-m-Y h:i:s");

        if ( !$planilla )
            return redirect()->route('rrhh.obtenerIncapacidades')->with('danger', 'Error ' . $request->id_incapacidad);

        if ( $request->excel )
            return Excel::download(new IncapacidadesRpt($planilla, $incapacidades), "incapacidades-${f}.xlsx");


        return redirect()->route('rrhh.obtenerIncapacidades')->with('success', 'Formulario PDF');
    }
}
