<?php

namespace App\Http\Controllers\RRHH;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RRHH\RRHHEmpresa;
use App\Models\User;
class EmpresaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $empresas =RRHHEmpresa::all();
        return view('RRHH.empresa.index', compact('empresas'));
    }

    public function cambioEmpresa(Request $request, $id){
        $user = User::find($id);
        $user->empresa_id = $request->empresa;
        $user->save();
        return back()->with('success','Se ha cambiado la empresa correctamente');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        RRHHEmpresa::create(['empresa'=> $request->empresa,'actualizada'=>true]);
        return back()->with('success','Se ha creado la empresa correctamente');
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
        $empresa = RRHHEmpresa::find($id);
        return view('RRHH.empresa.edit', compact('empresa'));
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
        $empresa = RRHHEmpresa::find($id);
        $empresa->empresa = $request->empresa;
        $empresa->actualizada= true;
        $empresa->save();
        return redirect()->route('rrhh.empresa.index')->with('success','Se ha editado la empresa correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        RRHHEmpresa::destroy($id);
        return back()->with('success','Se ha eliminado la empresa correctamente');
    }
}