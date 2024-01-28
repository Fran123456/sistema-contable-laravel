<?php

namespace App\Http\Controllers\RRHH;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RRHH\RRHHEmpleado;
use App\Models\RRHH\RRHHTipoEmpleado;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Help\Log;
use App\Help\Help;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $empleados = RRHHEmpleado::all();
        return view('RRHH.empleado.index', compact('empleados'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tipoEmpleado = RRHHEmpleado::all();
        return view('RRHH.empleado.create','tipoEmpleado');
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
            'tipo_empleado' => 'required|integer',
            'nombres' => 'required|string|max:300',
            'apellidos' => 'required|string|max:200',
            'edad' => 'required|integer|min:18|max:120',
            'estado'=> 'required|integer|max:1|min:0',
            'correo'=> 'string|max:200',
            'telefono'=> 'required|string|max:100',
            'correo_empresarial'=> 'string|max:200',
            'direccion'=> 'string|max:1000',
            'sexo'=> 'required|string|in:Masculino,Femenino',
            'codigo'=> 'required|string|max:255',
            'fecha_nacimiento'=> 'required|date',
            'fecha_ingreso'=> 'required|date',
        ]);

        $validate->validate();

        $empleado = RRHHEmpleado::create([
            'tipo_empleado_id'=> $request->tipo_empleado,
            'nombres' => $request->nombres,
            'apellidos' => $request->apellidos,
            'nombre_completo' => $request->nombres.' '.$request->apellidos,
            'edad' => $request->edad,
            'activo'=> $request->estado,
            'correo'=> $request->correo,
            'telefono'=> $request->telefono,
            'correo_empresarial'=> $request->correo_empresarial,
            'direccion'=> $request->direccion,
            'sexo'=> $request->sexo,
            'fecha_nacimiento'=> $request->fecha_nacimiento,
            'fecha_ingreso'=> $request->fecha_ingreso,
            'codigo'=> $request->codigo,
            'foto'=> $request->foto,
        ]);
        $empleado->save();

        return redirect()->route('rrhh.empleado.index')->with('success', 'Empleado creado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $empleado = RRHHEmpleado::find($id);
        $tipoEmpleado = RRHHEmpleado::all();
        return view('rrhh.empleado.show', compact('empleado'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $empleado = RRHHEmpleado::find($id);
        $tipoEmpleado = RRHHEmpleado::all();
        return view('rrhh.empleado.edit', compact('empleado','tipoEmpleado'));
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
            'tipo_empleado' => 'required|integer',
            'nombres' => 'required|string|max:300',
            'apellidos' => 'required|string|max:200',
            'edad' => 'required|integer|min:18|max:120',
            'estado'=> 'required|integer|max:1|min:0',
            'correo'=> 'string|max:200',
            'telefono'=> 'required|string|max:100',
            'correo_empresarial'=> 'string|max:200',
            'direccion'=> 'string|max:1000',
            'sexo'=> 'required|string|in:Masculino,Femenino',
            'codigo'=> 'required|string|max:255',
            'fecha_nacimiento'=> 'required|date',
            'fecha_ingreso'=> 'required|date',

        ]);

        $validate->validate();

        $empleado = RRHHEmpleado::find($id);

        $empleado->tipo_empleado_id = $request->tipo_empleado;
        $empleado->nombres = $request->nombres;
        $empleado->apellidos  = $request->apellidos;
        $empleado->nombre_completo  = $request->nombres.' '.$request->apellidos;
        $empleado->edad  = $request->edad;
        $empleado->activo = $request->estado;
        $empleado->correo = $request->correo;
        $empleado->telefono = $request->telefono;
        $empleado->correo_empresarial = $request->correo_empresarial;
        $empleado->direccion = $request->direccion;
        $empleado->sexo = $request->sexo;
        $empleado->fecha_nacimiento = $request->fecha_nacimiento;
        $empleado->fecha_ingreso = $request->fecha_ingreso;
        $empleado->codigo = $request->sexo;
        // $empleado->foto = $request->sexo;

        $empleado->save();

        return redirect()->route('rrhh.empleado.index')->with('success', 'Empleado Actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $empleado = RRHHEmpleado::find($id);

        if ( !$empleado )
            return back()->with('error','Ocurrio un error al eliminar el empleado');

        $empleado->delete();
        return back()->with('success','Se ha eliminado el empleado correctamente');
    }

}
