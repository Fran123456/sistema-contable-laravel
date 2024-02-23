<?php

namespace App\Http\Controllers\RRHH;

use App\Http\Controllers\Controller;
use App\Models\RRHH\RRHHPermiso;
use App\Models\RRHH\RRHHTipoPermiso;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Help\Help;
use App\Models\RRHH\RRHHEmpleado;
use App\Models\RRHH\RRHHIncapacidad;
use App\Models\RRHH\RRHHPeriodosPlanilla;
use App\Models\RRHH\RRHHTipoIncapacidad;

class PermisoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permisos = RRHHPermiso::where("empresa_id", Help::empresa())->with('empleado')->with('empresa')->with('periodo_planilla')->with('tipoPermiso')->get();
        $periodos = RRHHPeriodosPlanilla::where("empresa_id", Help::empresa())->where("activo", 1)->get();
        return view("RRHH.permiso.index", compact("permisos", "periodos"));
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
        $tipoPermisos = RRHHTipoPermiso::all();
        return view("RRHH.permiso.create", compact("empleados", "periodosPlanillas", "tipoPermisos"));
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
            'tipo_permiso_id' => 'required|string|max:300',
            'cantidad' => 'required|int|min:1',
            'descripcion' => 'string|nullable',
        ]);

        $validate->validate();

        $permisoValidate = RRHHPermiso::where('empleado_id', $request->empleado_id)->where('periodo_planilla_id', $request->periodo_planilla_id)->where('tipo_permiso_id', $request->tipo_incapacidad_id)->first();

        $permisoValidateDate = RRHHPermiso::where('fecha_inicio', $request->fecha_inicio)->first();


        if ($permisoValidate !== null) {
            return redirect()->back()->with('danger', 'Ya existe una permiso para este empleado con los datos ingresados.');
        }

        if ($permisoValidateDate !== null) {
            return redirect()->back()->with('danger', 'Ya existe una permiso para este empleado para la fecha ingresada.');
        }


        $periodoPlanilla = RRHHPeriodosPlanilla::find($request->periodo_planilla_id);
        $tipoPermiso = RRHHTipoPermiso::find($request->tipo_permiso_id);

        $permiso = RRHHPermiso::create([
            'empleado_id' => $request->empleado_id,
            'empresa_id' => Help::empresa(),
            'periodo_planilla_id' => $request->periodo_planilla_id,
            'tipo_permiso_id' => $request->tipo_permiso_id,
            'fecha_inicio' => $request->fecha_inicio,
            'periodo' => $periodoPlanilla->periodo_dias,
            'mes' => $periodoPlanilla->mes,
            'year' => $periodoPlanilla->year,
            'cantidad' => $request->cantidad,
            'descripcion' => $request->descripcion,
            'tipo_permiso' => $tipoPermiso->tipo,
        ]);

        $permiso->save();

        return redirect()->route('rrhh.permisos.index')->with('success', 'Permiso creada con éxito');
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
        $permiso = RRHHPermiso::find($id);
        $empleados = RRHHEmpleado::where("empresa_id", Help::empresa())->get();
        $periodosPlanillas = RRHHPeriodosPlanilla::where("activo", 1)->where("empresa_id", Help::empresa())->get();
        $tipoPermisos = RRHHTipoPermiso::all();
        return view("RRHH.permiso.edit", compact("permiso","empleados", "periodosPlanillas", "tipoPermisos"));

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
            'tipo_permiso_id' => 'required|string|max:300',
            'cantidad' => 'required|int|min:1',
            'descripcion' => 'string|nullable',
        ]);

        $validate->validate();

        $permisoValidate = RRHHPermiso::where('empleado_id', $request->empleado_id)->where('periodo_planilla_id', $request->periodo_planilla_id)->where('tipo_permiso_id', $request->tipo_incapacidad_id)->first();

        $permisoValidateDate = RRHHPermiso::where('fecha_inicio', $request->fecha_inicio)->first();


        if ($permisoValidate !== null) {
            return redirect()->back()->with('danger', 'Ya existe una permiso para este empleado con los datos ingresados.');
        }

        if ($permisoValidateDate !== null) {
            return redirect()->back()->with('danger', 'Ya existe una permiso para este empleado para la fecha ingresada.');
        }


        $periodoPlanilla = RRHHPeriodosPlanilla::find($request->periodo_planilla_id);
        $tipoPermiso = RRHHTipoPermiso::find($request->tipo_permiso_id);

        $permiso = RRHHPermiso::find($id);

        if( $permiso == null )
            return redirect()->route('rrhh.permisos.index')->with('danger', 'No se encontro el registro que desea actualizar');

        $permiso->empleado_id = $request->empleado_id;
        $permiso->empresa_id = Help::empresa();
        $permiso->periodo_planilla_id = $request->periodo_planilla_id;
        $permiso->tipo_permiso_id = $request->tipo_permiso_id;
        $permiso->fecha_inicio = $request->fecha_inicio;
        $permiso->periodo = $periodoPlanilla->periodo_dias;
        $permiso->mes = $periodoPlanilla->mes;
        $permiso->year = $periodoPlanilla->year;
        $permiso->cantidad = $request->cantidad;
        $permiso->descripcion = $request->descripcion;
        $permiso->tipo_permiso = $tipoPermiso->tipo;


        $permiso->save();

        return redirect()->route('rrhh.permisos.index')->with('success', 'Permiso actualizado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $permiso = RRHHPermiso::findOrFail($id);

        $permiso->delete();

        return redirect()->route('rrhh.permisos.index')->with('success', 'El permiso, se elimino con éxito.');
    }
}
