<?php

namespace App\Http\Controllers\RRHH;

use App\Http\Controllers\Controller;
use App\Models\RRHH\RRHHDepartamento;
use App\Models\RRHH\RRHHArea;
use Illuminate\Http\Request;

class DepartamentoController extends Controller
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
        $departamentos = RRHHDepartamento::where('empresa_id', $empresa_id)->get();
        
        return view('RRHH.departamento.index' , compact('departamentos'));
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
        
        return view('RRHH.departamento.create' , compact('empresa_id', 'areas'));    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validar que el nombre del departamento no este vacio
        $request->validate([
            'departamento'=>['required']
        ]);

        $departamento = new RRHHDepartamento;
        $departamento->departamento = $request->input('departamento');
        $departamento->area_id = $request->input('area_id');
        $departamento->empresa_id = $request->input('empresa_id');
        $departamento->activo = $request->input('activo');
        $departamento->save();
        return to_route('rrhh.departamento.index')->with('success', 'Departamento creado correctamente');


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
        $departamento_id = RRHHDepartamento::find($id);

        return view('RRHH.departamento.edit', compact('areas', 'departamento_id'));
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
            'departamento'=>['required']
        ]);
        $departamento = RRHHDepartamento::find($id);
        $departamento->departamento = $request->input('departamento');
        $departamento->area_id = $request->input('area_id');
        $departamento->empresa_id = $request->input('empresa_id');
        $departamento->activo = $request->input('activo');
        $departamento->save();
        return to_route('rrhh.departamento.index')->with('sucess', 'Departamento actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $departamento = RRHHDepartamento::find($id);
        $departamento->delete();
        return back()->with('success','Se ha eliminado el departamento correctamente');
    }
}
