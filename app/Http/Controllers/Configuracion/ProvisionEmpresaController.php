<?php

namespace App\Http\Controllers\Configuracion;

use Exception;
use App\Http\Controllers\Controller;
use App\Models\Configuracion\ConProvisionEmpresa;
use App\Models\RRHH\RRHHEmpresa;
use App\Models\Configuracion\BitacoraPolicy;
use App\Models\RRHH\RRHHTipoEmpleado;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Help\Help;
use App\Help\Log;

class ProvisionEmpresaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $provisiones = ConProvisionEmpresa::all();
        return view('Configuracion.provisiones.index', compact('provisiones'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $empresas = RRHHEmpresa::all();
        $tipos_empleado = RRHHTipoEmpleado::all();
        return view('Configuracion.provisiones.create', compact('empresas','tipos_empleado'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'empresa'        => 'required|exists:rrhh_empresa,id',
            'tipo_provision' => [
                'required',
                Rule::in(['aguinaldo', 'vacaciones', 'indemnización']),
                Rule::unique('tbl_provisiones_empresa')->where(function ($query) use ($request) {
                    return $query->where('empresa_id', $request->empresa)
                                ->where('estado', 1);
                }),
            ],
            'porcentaje'     => 'required|numeric|min:0|max:20',
            'fecha_inicio'   => 'required|date',
            'fecha_fin'      => 'required|date|after_or_equal:fecha_inicio',
            'descripcion'    => 'nullable|string|max:255',
            'estado'         => 'required|boolean'
        ], [
            'tipo_provision.unique' => 'Ya existe una provisión activa de este tipo para esta empresa.',
            'porcentaje.numeric'    => 'El porcentaje debe ser un número válido.',
            'porcentaje.min'        => 'El porcentaje no puede ser negativo.',
            'porcentaje.max'        => 'El porcentaje no puede superar el 20%.',
        ]);

        $validate->validate();

        // Validaciones adicionales de límites razonables
        $limites = [
            'aguinaldo'     => 8.33,
            'vacaciones'    => 4.17,
            'indemnización' => 1.0, // Ejemplo, cámbialo según tus reglas
        ];

        if (isset($limites[$request->tipo_provision]) && $request->porcentaje > $limites[$request->tipo_provision]) {
            return back()->withErrors([
                'porcentaje' => "El porcentaje máximo permitido para {$request->tipo_provision} es {$limites[$request->tipo_provision]}%."
            ])->withInput();
        }

        // Crear provisión
        $provisiones = ConProvisionEmpresa::create([
            'empresa_id'     => $request->empresa,
            'tipo_provision' => $request->tipo_provision,
            'porcentaje'     => $request->porcentaje,
            'fecha_inicio'   => $request->fecha_inicio,
            'fecha_fin'      => $request->fecha_fin,
            'descripcion'    => $request->descripcion,
            'creado_por'     => Help::usuario()->id,
            'fecha_creacion' => now(),
            'estado'         => $request->estado,
            'tipo_empleado'  => $request->tipo_empleado
        ]);

        // Registrar en bitácora
        $bitacora = BitacoraPolicy::create([
            'empresa_id'   => $request->empresa,
            'user_id'      => Help::usuario()->id,
            'accion'       => 'Creacion',
            'descripcion'  => 'Se creó una nueva provisión para la empresa con id ' . $request->empresa,
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_fin'    => $request->fecha_fin,
            'estado'       => $request->estado
        ]);

        try {
            $bitacora->save();
            $provisiones->save();
            Log::log('Configuracion', 'Provision creada', 'provisión creada para la empresa con id ' . $provisiones->empresa_id);
            return redirect()->route('configuracion.provisiones.index')->with('success', 'Provisión creada correctamente.');
        } catch (Exception $e) {
            Log::log('Configuracion', 'Error al crear provisión', $e);
            return back()->with('danger', 'Error al crear la provisión.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Configuracion\ConProvisionEmpresa  $conProvisionEmpresa
     * @return \Illuminate\Http\Response
     */
    public function show(ConProvisionEmpresa $conProvisionEmpresa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Configuracion\ConProvisionEmpresa  $conProvisionEmpresa
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $provision = ConProvisionEmpresa::find($id);
        $empresas = RRHHEmpresa::all();
        $tipos_empleado = RRHHTipoEmpleado::all();


        if (!$provision) {
            return back()->with('danger', 'Provision no encontrada');
        }

        return view('Configuracion.provisiones.edit', compact('provision', 'empresas', 'tipos_empleado'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Configuracion\ConProvisionEmpresa  $conProvisionEmpresa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $provision = ConProvisionEmpresa::find($id);

        if (!$provision) {
            return back()->with('danger', 'Provisión no encontrada');
        }

        $validate = Validator::make($request->all(), [
            'empresa'        => 'required|exists:rrhh_empresa,id',
            'tipo_provision' => [
                'required',
                Rule::in(['aguinaldo', 'vacaciones', 'indemnización']),
                Rule::unique('tbl_provisiones_empresa')->where(function ($query) use ($request, $id) {
                    return $query->where('empresa_id', $request->empresa)
                                ->where('estado', 1)
                                ->where('id', '!=', $id); // ❌ excluir el registro actual
                }),
            ],
            'porcentaje'     => 'required|numeric|min:0|max:20',
            'fecha_inicio'   => 'required|date',
            'fecha_fin'      => 'required|date|after_or_equal:fecha_inicio',
            'descripcion'    => 'nullable|string|max:255',
            'estado'         => 'required|boolean'
        ], [
            'tipo_provision.unique' => 'Ya existe una provisión activa de este tipo para esta empresa.',
            'porcentaje.numeric'    => 'El porcentaje debe ser un número válido.',
            'porcentaje.min'        => 'El porcentaje no puede ser negativo.',
            'porcentaje.max'        => 'El porcentaje no puede superar el 20%.',
        ]);

        $validate->validate();

        // Validaciones adicionales de límites razonables
        $limites = [
            'aguinaldo'     => 8.33,
            'vacaciones'    => 4.17,
            'indemnización' => 1.0, // ajusta según reglas
        ];

        if (isset($limites[$request->tipo_provision]) && $request->porcentaje > $limites[$request->tipo_provision]) {
            return back()->withErrors([
                'porcentaje' => "El porcentaje máximo permitido para {$request->tipo_provision} es {$limites[$request->tipo_provision]}%."
            ])->withInput();
        }

        // Actualizar provisión
        $provision->empresa_id    = $request->empresa;
        $provision->tipo_provision = $request->tipo_provision;
        $provision->porcentaje     = $request->porcentaje;
        $provision->fecha_inicio   = $request->fecha_inicio;
        $provision->fecha_fin      = $request->fecha_fin;
        $provision->descripcion    = $request->descripcion;
        $provision->estado         = $request->estado;
        $provision->tipo_empleado  = $request->tipo_empleado;

        // Bitácora
        $bitacora = BitacoraPolicy::create([
            'empresa_id'   => $request->empresa,
            'user_id'      => Help::usuario()->id,
            'accion'       => 'Actualizacion',
            'descripcion'  => 'Se actualizó la provisión con id ' . $id . ' para la empresa con id ' . $request->empresa,
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_fin'    => $request->fecha_fin,
            'estado'       => $request->estado
        ]);

        try {
            $bitacora->save();
            $provision->save();
            Log::log('Configuracion', 'Provisión actualizada', 'Provisión actualizada con id ' . $id);
            return redirect()->route('configuracion.provisiones.index')->with('success', 'Provisión actualizada correctamente');
        } catch (Exception $e) {
            Log::log('Configuracion', 'Error al actualizar provisión', $e);
            return back()->with('danger','Error al actualizar la provisión');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Configuracion\ConProvisionEmpresa  $conProvisionEmpresa
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $provision = ConProvisionEmpresa::find($id);

        if (!$provision) {
            return back()->with('danger', 'Provision no encontrada');
        }

        $bitacora = BitacoraPolicy::create([
            'empresa_id' => $provision->empresa_id,
            'user_id' => Help::usuario()->id,
            'accion' => 'Eliminacion',
            'descripcion' => 'Se elimino la provision con id ' . $id . ' para la empresa con id ' . $provision->empresa_id,
            'fecha_inicio' => $provision->fecha_inicio,
            'fecha_fin' => $provision->fecha_fin,
            'estado' => $provision->estado
        ]);

        $bitacora->save();
        $provision->delete();
        Log::log('Configuracion', 'Provision eliminada', 'Provision eliminada con id ' . $id);
        return back()->with('success', 'Provision eliminada correctamente');
    }
}
