<?php

namespace App\Http\Controllers\RRHH;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RRHH\RRHHEmpleado;
use App\Models\RRHH\RRHHTipoEmpleado;
use App\Models\RRHH\RRHHArea;
use App\Models\RRHH\RRHHDepartamento;
use App\Models\RRHH\RRHHPuesto;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
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
        $empleados = RRHHEmpleado::where("empresa_id", Help::empresa())->get();
        return view('RRHH.empleado.index', compact('empleados'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $empresa_id = Help::empresa();
        $areas = RRHHArea::where('empresa_id', $empresa_id)->get();
        $departamentos = RRHHDepartamento::where('empresa_id', $empresa_id)->get();
        $tipoEmpleado = RRHHTipoEmpleado::all();
        return view('RRHH.empleado.create', compact('tipoEmpleado', 'areas', 'empresa_id', 'departamentos'));
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
            'foto' => 'image|mimes:jpg,png,jpeg|nullable',
            'tipo_empleado' => 'required|integer',
            'nombres' => 'required|string|max:300',
            'apellidos' => 'required|string|max:200',
            'edad' => 'required|integer|min:18|max:120',
            'estado' => 'required|integer|max:1|min:0',
            'correo' => 'string|max:200|nullable',
            'telefono' => 'required|string|max:100',
            'correo_empresarial' => 'string|max:200|nullable',
            'direccion' => 'string|max:1000',
            'sexo' => 'required|string|in:Masculino,Femenino',
            'codigo' => 'required|string|max:255',
            'salario' => 'required|numeric|min:0',
            'salario_diario' => 'required|numeric|min:0',
            'fecha_nacimiento' => 'required|date',
            'fecha_ingreso' => 'required|date',
            'area_id' => 'required|integer',
            'departamento_id' => 'required|integer',
            'cargo_id' => 'required|integer',
        ]);

        $validate->validate();

        $carpeta = 'foto_empleados';
        $fotoSubida = $request->hasFile('foto');

        if ($fotoSubida) {

            $imagen = $request->file('foto');

            $nombreImagen = time() . '_' . $imagen->getClientOriginalName();
            $url_foto = $carpeta . '\\' . $nombreImagen;

            $imagen->storeAs($carpeta, $nombreImagen);

        }

        $empresa_id = Help::empresa();

        $empleado = RRHHEmpleado::create([
            'empresa_id' => $empresa_id,
            'tipo_empleado_id' => $request->tipo_empleado,
            'nombres' => $request->nombres,
            'apellidos' => $request->apellidos,
            'nombre_completo' => $request->nombres . ' ' . $request->apellidos,
            'edad' => $request->edad,
            'activo' => $request->estado,
            'correo' => $request->correo,
            'telefono' => $request->telefono,
            'correo_empresarial' => $request->correo_empresarial,
            'direccion' => $request->direccion,
            'sexo' => $request->sexo,
            'codigo' => $request->codigo,
            'foto' => $fotoSubida ? $url_foto : null,
            'salario' => $request->salario,
            'salario_diario' => $request->salario_diario,
            'fecha_nacimiento' => $request->fecha_nacimiento,
            'fecha_ingreso' => $request->fecha_ingreso,
            'area_id' => $request->area_id,
            'departamento_id' => $request->departamento_id,
            'cargo_id' => $request->cargo_id,
        ]);

        try {

            $empleado->save();
            $log = 'empleado creado para la empresa con id ' . $empleado->id . ' Para la empresa con id ' . Help::empresa();
            Log::log('RRHH', 'empleado creado', $log);

            return redirect()->route('rrhh.empleado.index')->with('success', 'Empleado creado correctamente ' . Help::empresa());

        } catch (Exception $e) {
            Log::log('RRHH', 'empleado error al crear empleado', $e);
            return back()->with('danger', 'Ocurrio un error al crear el empleado');
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
        $empleado = RRHHEmpleado::find($id);
        $tipoEmpleado = RRHHTipoEmpleado::all();

        $foto = null;
        $urlFotoEmpleado = $empleado->foto;

        if ($urlFotoEmpleado) {
            if (Storage::exists($urlFotoEmpleado)) {
                $url_foto = storage_path('app\\' . $urlFotoEmpleado);
                $foto = base64_encode(file_get_contents($url_foto));
            }
        }

        return view('rrhh.empleado.show', compact('empleado', 'tipoEmpleado', 'foto'));
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
        $tipoEmpleado = RRHHTipoEmpleado::all();
        $foto = null;
        $urlFotoEmpleado = $empleado->foto;

        if ($urlFotoEmpleado) {
            if (Storage::exists($urlFotoEmpleado)) {
                $url_foto = storage_path('app\\' . $urlFotoEmpleado);
                $foto = base64_encode(file_get_contents($url_foto));
            }
        }

        return view('rrhh.empleado.edit', compact('empleado', 'tipoEmpleado', 'foto'));
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
            'foto' => 'image|mimes:jpg,png,jpeg|nullable',
            'nombres' => 'required|string|max:300',
            'apellidos' => 'required|string|max:200',
            'edad' => 'required|integer|min:18|max:120',
            'estado' => 'required|integer|max:1|min:0',
            'correo' => 'string|max:200|nullable',
            'telefono' => 'required|string|max:100',
            'correo_empresarial' => 'string|max:200|nullable',
            'direccion' => 'string|max:1000',
            'sexo' => 'required|string|in:Masculino,Femenino',
            'codigo' => 'required|string|max:255',
            'salario' => 'required|numeric|min:0',
            'salario_diario' => 'required|numeric|min:0',
            'fecha_nacimiento' => 'required|date',
            'fecha_ingreso' => 'required|date',

        ]);

        $validate->validate();

        $empleado = RRHHEmpleado::find($id);

        $carpeta = 'foto_empleados';
        $fotoSubida = $request->hasFile('foto');

        if ($fotoSubida) {
            $imagen = $request->file('foto');

            $nombreImagen = time() . '_' . $imagen->getClientOriginalName();
            $url_foto = $carpeta . '\\' . $nombreImagen;

            if ($empleado->foto) {
                $urlFotoEliminar = $empleado->foto;

                if (Storage::exists($urlFotoEliminar)) {

                    Storage::delete($urlFotoEliminar);

                }
            }

            $imagen->storeAs($carpeta, $nombreImagen);
        }


        $empleado->tipo_empleado_id = $request->tipo_empleado;
        $empleado->nombres = $request->nombres;
        $empleado->apellidos = $request->apellidos;
        $empleado->nombre_completo = $request->nombres . ' ' . $request->apellidos;
        $empleado->edad = $request->edad;
        $empleado->activo = $request->estado;
        $empleado->correo = $request->correo;
        $empleado->telefono = $request->telefono;
        $empleado->correo_empresarial = $request->correo_empresarial;
        $empleado->direccion = $request->direccion;
        $empleado->sexo = $request->sexo;
        $empleado->codigo = $request->codigo;
        $empleado->salario = $request->salario;
        $empleado->salario_diario = $request->salario_diario;
        $empleado->fecha_nacimiento = $request->fecha_nacimiento;
        $empleado->fecha_ingreso = $request->fecha_ingreso;

        if ( $fotoSubida )
            $empleado->foto = $url_foto;

        try {
            $log = 'Empleado actualizado para la empresa con id ' . $empleado->id . ' Para la empresa con id ' . Help::empresa();
            Log::log('RRHH', 'empleado creado', $log);
            $empleado->save();
            return redirect()->route('rrhh.empleado.index')->with('success', 'Empleado creado correctamente');

        } catch (Exception $e) {
            Log::log('RRHH', 'empleado error al crear empleado', $e);
            return back()->with('danger', 'Ocurrio un error al actualizar el empleado');
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
        $empleado = RRHHEmpleado::find($id);

        if (!$empleado)
            return back()->with('error', 'Ocurrio un error al eliminar el empleado');


        $urlFotoEmpleado = $empleado->foto == null ? ' ' : $empleado->foto;

        if (Storage::exists($urlFotoEmpleado)) {
            Storage::delete($urlFotoEmpleado);
        }

        $empleado->delete();

        $log = 'Empleado eliminado con id ' . $empleado->id . ' en la empresa con id ' . Help::empresa() . ' Por el usuario ' . Help::usuario()->name ;
        Log::log('RRHH', 'empleado creado', $log);

        return back()->with('success', 'Se ha eliminado el empleado correctamente');
    }

    public function obtenerDepartamentos($areaId)
    {
        $departamentos = RRHHDepartamento::where('area_id', $areaId)->get();
        return response()->json($departamentos);
    }

    
    public function obtenerCargos($departamentoId)
    {
        $cargos = RRHHPuesto::where('departamento_id', $departamentoId)->get();
        return response()->json($cargos);
    }
}
