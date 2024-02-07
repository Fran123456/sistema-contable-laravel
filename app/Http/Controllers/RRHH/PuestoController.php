<?php

namespace App\Http\Controllers\RRHH;

use App\Http\Controllers\Controller;
use App\Models\RRHH\RRHHPuesto;
use App\Models\RRHH\RRHHArea;
use App\Models\RRHH\RRHHDepartamento;
use Illuminate\Http\Request;

class PuestoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        $empresa_id = $user->empresa_id;
        $puestos = RRHHPuesto::where('empresa_id', $empresa_id)->get();

        return view('rrhh.puesto.index', compact('puestos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = auth()->user();
        $empresa_id = $user->empresa_id;
        $areas = RRHHArea::where('empresa_id', $empresa_id)->get();
        $departamentos = RRHHDepartamento::where('empresa_id', $empresa_id)->get();

        return view('rrhh.puesto.create', compact('empresa_id', 'areas', 'departamentos'));
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'cargo'=>['required'],
        ]);

        $puesto = new RRHHPuesto;
        $puesto->cargo = $request->input('cargo');
        $puesto->empresa_id = $request->input('empresa_id');
        $puesto->area_id = $request->input('area_id');
        $puesto->departamento_id = $request->input('departamento_id');
        $puesto->activo = $request->input('activo');
        $puesto->save();
        
        return to_route('rrhh.puesto.index')->with('success','Cargo creado correctamente');
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
        $user = auth()->user();
        $empresa_id = $user->empresa_id;
        $areas = RRHHArea::where('empresa_id', $empresa_id)->get();
        $puesto = RRHHPuesto::find($id);

        return view('rrhh.puesto.edit', compact('empresa_id','areas', 'puesto'));
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
        $request->validate([
            'cargo'=>['required'],
        ]);

        $puesto = RRHHPuesto::find($id);
        $puesto->cargo = $request->input('cargo');
        $puesto->empresa_id = $request->input('empresa_id');
        $puesto->area_id = $request->input('area_id');
        $puesto->departamento_id = $request->input('departamento_id');
        $puesto->activo = $request->input('activo');
        $puesto->save();
        
        return to_route('rrhh.puesto.index')->with('success','Cargo actualizado correctamente');
 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $puesto = RRHHPuesto::find($id);
        $puesto->delete();
        return back()->with('success', 'Cargo eliminado correctamente');
    }

    public function obtenerDepartamentos($areaId)
    {
        $departamentos = RRHHDepartamento::where('area_id', $areaId)->get();
        return response()->json($departamentos);
    }
}
