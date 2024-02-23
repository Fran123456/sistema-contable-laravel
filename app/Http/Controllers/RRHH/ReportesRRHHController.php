<?php

namespace App\Http\Controllers\RRHH;

use App\Http\Controllers\Controller;
use App\Models\RRHH\RRHHPermiso;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\RRHH\IncapacidadesRpt;
use App\Exports\RRHH\PermisosRpt;
use App\Help\Help;
use App\Models\RRHH\RRHHIncapacidad;
use App\Models\RRHH\RRHHPeriodosPlanilla;
use App\ReportsPDF\RRHH\IncapacidadRpt;
use App\ReportsPDF\RRHH\PermisosRpt as RRHHPermisosRpt;

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


        return IncapacidadRpt::report($planilla, $incapacidades);
    }

    public function reportePermisos(Request $request)
    {

        $planilla = RRHHPeriodosPlanilla::where("id", $request->id_incapacidad)->first();
        $permisos = RRHHPermiso::where("empresa_id", Help::empresa())->where("periodo_planilla_id", $request->id_incapacidad)->with("empresa")->with("empleado")->with("periodo_planilla")->get();

        $f = date("d-m-Y h:i:s");

        if ( !$planilla )
            return redirect()->route('rrhh.obtenerPermisos')->with('danger', 'Error ' . $request->id_incapacidad);

        if ( $request->excel )
            return Excel::download(new PermisosRpt($planilla, $permisos), "permisos-${f}.xlsx");


        return RRHHPermisosRpt::report($planilla, $permisos);
    }


}
