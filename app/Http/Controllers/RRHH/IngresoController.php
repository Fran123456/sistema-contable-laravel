<?php

namespace App\Http\Controllers\RRHH;

use App\Help\Help;
use App\Help\Log;
use App\Http\Controllers\Controller;
use App\Models\RRHH\RRHHEmpleado;
use App\Models\RRHH\RRHHIngreso;
use App\Models\RRHH\RRHHPeriodosPlanilla;
use App\Models\RRHH\RRHHTipoIngreso;
use Exception;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class IngresoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ingresos = RRHHIngreso::where("id_empresa", Help::empresa())->with("empleado")->with('empleado')->with('planilla')->with('tipoIngreso')->get();

        return view('RRHH.ingreso.index', compact('ingresos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $empleados = RRHHEmpleado::where("empresa_id", Help::empresa())->where('activo', 1)->get();
        $planillas = RRHHPeriodosPlanilla::where("empresa_id", Help::empresa())->where('activo', 1)->get();
        $tiposIngreso = RRHHTipoIngreso::all();

        return view('RRHH.ingreso.create', compact('empleados', 'planillas', 'tiposIngreso'));
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

        $validator = Validator::make($request->all(), [
            'empleado' => 'required|integer',
            'planilla' => 'required|integer',
            'tipo_ingreso' => 'required|integer',
            'cantidad' => 'required|numeric|min:0',
            'descripcion' => 'string',
            'fecha' => 'required|date'
        ]);

        $validator->validate();

        $ingreso = RRHHIngreso::where('id_empleado', $request->empleado)->where('id_tipo_ingreso', $request->tipo_ingreso)->where('id_periodo_planilla', $request->planilla)->first();

        if($ingreso)
            return back()->with('danger', 'Ya existe una resgistro con el mismo ingreso para el periodo planilla seleccionado');

        $ingreso = RRHHIngreso::create([
            'id_empresa' => Help::empresa(),
            'id_empleado' => $request->empleado,
            'id_periodo_planilla' => $request->planilla,
            'id_tipo_ingreso' => $request->tipo_ingreso,
            'cantidad' => $request->cantidad,
            'descripcion' => $request->descripcion,
            'fecha' => $request->fecha,
        ]);

        try {
            $ingreso->save();
            Log::log('RRHH', 'Agregar ingreso', 'El usuario ' . Help::usuario()->name . ' ha agregado el ingreso con el id' . $ingreso->id . 'con fecha ' . date('Y-m-d h:i:s'));
            return redirect()->route('rrhh.ingreso.index')->with('success', 'El registro del ingreso, se guardo correctamente');
        } catch (Exception $e) {
            Log::log('RRHH', 'error al agregar ingreso', 'El usuario ' . Help::usuario()->name . ' ha tratado de agregar un ingreso ' . 'en la fecha ' . date('Y-m-d h:i:s'));
            return back()->with('danger', 'Ocurrio un error al tratar de agregar el registro del ingreso');
        }
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
        $ingreso = RRHHIngreso::where('id', $id)->first();

        if (!$ingreso)
            return back()->with('danger', 'No se encontro el registro de ingreso que se desea actualizar.');

        $empleados = RRHHEmpleado::where("empresa_id", Help::empresa())->where('activo', 1)->get();
        $planillas = RRHHPeriodosPlanilla::where("empresa_id", Help::empresa())->where('activo', 1)->orWhere('id', $ingreso->id_periodo_planilla)->get();
        $tiposIngreso = RRHHTipoIngreso::all();

        return view('RRHH.ingreso.edit', compact('ingreso', 'empleados', 'planillas', 'tiposIngreso'));
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

        $validator = Validator::make($request->all(), [
            'empleado' => 'required|integer',
            'planilla' => 'required|integer',
            'tipo_ingreso' => 'required|integer',
            'cantidad' => 'required|numeric|min:0',
            'descripcion' => 'string',
            'fecha' => 'required|date'
        ]);

        $validator->validate();

        $ingreso = RRHHIngreso::where('id_empleado', $request->empleado)->where('id_tipo_ingreso', $request->tipo_ingreso)->where('id_periodo_planilla', $request->planilla)->first();

        if($ingreso)
            return back()->with('danger', 'Ya existe una resgistro con el mismo ingreso para el periodo planilla seleccionado');

        $ingreso = RRHHIngreso::where('id', $id)->first();

        $ingreso->id_empleado = $request->empleado;
        $ingreso->id_periodo_planilla = $request->planilla;
        $ingreso->id_tipo_ingreso = $request->tipo_ingreso;
        $ingreso->cantidad = $request->cantidad;
        $ingreso->descripcion = $request->descripcion;
        $ingreso->fecha = $request->fecha;


        try {
            $ingreso->save();
            Log::log('RRHH', 'Editar ingreso', 'El usuario ' . Help::usuario()->name . ' ha editado el ingreso con el id' . $ingreso->id . 'con fecha ' . date('Y-m-d h:i:s'));
            return redirect()->route('rrhh.ingreso.index')->with('success', 'El registro del ingreso, se actualizo correctamente');
        } catch (Exception $e) {
            Log::log('RRHH', 'error al editar ingreso', 'El usuario ' . Help::usuario()->name . ' ha tratado de editar el ingreso ' . 'en la fecha ' . date('Y-m-d h:i:s'));
            return back()->with('danger', 'Ocurrio un error al tratar de actualizar el registro del ingreso');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ingreso = RRHHIngreso::where('id', $id)->first();

        if (!$ingreso)
            return back()->with('danger', 'No se encontro el registro de ingreso que se desea eliminar');

        try {
            $ingreso->delete();
            Log::log('RRHH', 'eliminar ingreso', 'El usuario ' . Help::usuario()->name . ' ha eliminado el ingreso con el id' . $id . 'con fecha ' . date('Y-m-d h:i:s'));
            return back()->with('success', 'El registro del ingreso, se elimino correctamente');
        } catch (Exception $e) {
            Log::log('RRHH', 'error al eliminar ingreso', 'El usuario ' . Help::usuario()->name . ' ha eliminado el ingreso con el id' . $id . 'con fecha ' . date('Y-m-d h:i:s'));
            return back()->with('danger', 'Ocurrio un error al tratar de eliminar el registro del ingreso');
        }
    }
}
