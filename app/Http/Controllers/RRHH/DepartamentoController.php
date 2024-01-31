<?php

namespace App\Http\Controllers\RRHH;

use App\Http\Controllers\Controller;
use App\Models\RRHH\RRHHDepartamento;
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
        $departamentos = RRHHDepartamento::where('empresa_id', $empresa_id)->get();
        
        return view('RRHH.departamento.create' , compact('departamentos'));    
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
