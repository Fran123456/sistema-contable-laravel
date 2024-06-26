<?php

namespace App\Http\Controllers\RRHH;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Help\Help;
use App\Models\RRHH\RRHHEmpleado;
use App\Models\RRHH\RRHHIncapacidad;
use App\Models\RRHH\RRHHPeriodosPlanilla;
use App\Models\RRHH\RRHHTipoIncapacidad;


class IncapacidadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $incapacidades = RRHHIncapacidad::where("empresa_id", Help::empresa())->with("empleado")->with("tipoIncapacidad")->with("periodoPlanilla")->get();
        $periodos = RRHHPeriodosPlanilla::where("empresa_id", Help::empresa())->where("activo", 1)->get();
        return view("RRHH.incapacidad.index", compact("incapacidades", "periodos"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $empleados = RRHHEmpleado::where("empresa_id", Help::empresa())->get();
        $periodosPlanillas = RRHHPeriodosPlanilla::where("activo", 1)->where("empresa_id", Help::empresa())->get();
        $tipoIncapacidades = RRHHTipoIncapacidad::all();
        return view("RRHH.incapacidad.create", compact("empleados", "periodosPlanillas", "tipoIncapacidades"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->flash();

        $validate = Validator::make($request->all(), [
            'empleado_id' => 'required|integer',
            'periodo_planilla_id' => 'required|integer',
            'fecha_inicio' => 'required|date',
            'tipo_incapacidad_id' => 'required|string|max:300',
            'cantidad' => 'required|int|min:1',
        ]);

        $validate->validate();

        $incapacidadValidate = RRHHIncapacidad::where('empleado_id', $request->empleado_id)->where('periodo_planilla_id', $request->periodo_planilla_id)->where('tipo_incapacidad_id', $request->tipo_incapacidad_id)->first();

        $incapacidadValidateDate = RRHHIncapacidad::where('fecha_inicio', $request->fecha_inicio)->first();


        if ($incapacidadValidate !== null) {
            return redirect()->back()->with('danger', 'Ya existe una incapacidad para este empleado con los datos ingresados.');
        }

        if ($incapacidadValidateDate !== null) {
            return redirect()->back()->with('danger', 'Ya existe una incapacidad para este empleado para la fecha ingresada.');
        }


        $periodoPlanilla = RRHHPeriodosPlanilla::find($request->periodo_planilla_id);

        $incapacidad = RRHHIncapacidad::create([
            'empleado_id' => $request->empleado_id,
            'empresa_id' => Help::empresa(),
            'periodo_planilla_id' => $request->periodo_planilla_id,
            'tipo_incapacidad_id' => $request->tipo_incapacidad_id,
            'fecha_inicio' => $request->fecha_inicio,
            'periodo' => $periodoPlanilla->periodo_dias,
            'mes' => $periodoPlanilla->mes,
            'year' => $periodoPlanilla->year,
            'cantidad' => $request->cantidad,

        ]);

        $incapacidad->save();

        return redirect()->route('rrhh.obtenerIncapacidades')->with('success', 'Incapacidad Creada con éxito');
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $incapacidad = RRHHIncapacidad::find($id);
        $empleados = RRHHEmpleado::where("empresa_id", Help::empresa())->get();
        $periodosPlanillas = RRHHPeriodosPlanilla::where("activo", 1)->where("empresa_id", Help::empresa())->get();
        $tipoIncapacidades = RRHHTipoIncapacidad::all();
        return view('RRHH.incapacidad.edit', compact('incapacidad', "empleados", "periodosPlanillas", "tipoIncapacidades"));
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
        $request->flash();

        $validate = Validator::make($request->all(), [
            'empleado_id' => 'required|integer',
            'periodo_planilla_id' => 'required|integer',
            'fecha_inicio' => 'required|date',
            'tipo_incapacidad_id' => 'required|string|max:300',
            'cantidad' => 'required|int|min:1',
        ]);

        $validate->validate();

        $incapacidadValidate = RRHHIncapacidad::where('empleado_id', $request->empleado_id)->where('periodo_planilla_id', $request->periodo_planilla_id)->where('tipo_incapacidad_id', $request->tipo_incapacidad_id)->first();

        $incapacidadValidateDate = RRHHIncapacidad::where('fecha_inicio', $request->fecha_inicio)->first();


        if ($incapacidadValidate !== null) {
            return redirect()->back()->with('danger', 'Ya existe una incapacidad para este empleado con los datos ingresados.');
        }

        if ($incapacidadValidateDate !== null) {
            return redirect()->back()->with('danger', 'Ya existe una incapacidad para este empleado para la fecha ingresada.');
        }

        $periodoPlanilla = RRHHPeriodosPlanilla::find($request->periodo_planilla_id);

        $incapacidad = RRHHIncapacidad::find($id);

        $incapacidad->empleado_id = $request->empleado_id;
        $incapacidad->periodo_planilla_id = $request->periodo_planilla_id;
        $incapacidad->tipo_incapacidad_id = $request->tipo_incapacidad_id;
        $incapacidad->fecha_inicio = $request->fecha_inicio;
        $incapacidad->periodo = $periodoPlanilla->periodo_dias;
        $incapacidad->mes = $periodoPlanilla->mes;
        $incapacidad->year = $periodoPlanilla->year;
        $incapacidad->cantidad = $request->cantidad;

        $incapacidad->save();

        return redirect()->route('rrhh.obtenerIncapacidades')->with('success', 'Incapacidad Actualizada con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $incapacidad = RRHHIncapacidad::find($id);

        if ($incapacidad->count() == 0)
            return redirect()->route('rrhh.obtenerIncapacidades')->with('danger', 'No se pudo eliminar la incapacidad.');

        $incapacidad->delete();


        return redirect()->route('rrhh.obtenerIncapacidades')->with('success', 'La incapacidad se elimino con éxito.');
    }

    public function reporte(){

    }
}
