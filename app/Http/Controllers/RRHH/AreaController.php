<?php

namespace App\Http\Controllers\RRHH;

use App\Http\Controllers\Controller;
use App\Models\RRHH\RRHHArea;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         // Obtenemos la lista de areas
         $areas = RRHHArea::all();
         //Devuelve una vista
         return view('RRHH.area.index', compact('areas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Se busca el Usuario registrado para enviar el empresa_id al formulario 
        $user = auth()->user();
        $empresa_id = $user->empresa_id;
        //Devuelve la vista
        return view('RRHH.area.create', compact('empresa_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validar el nombre del area
        $request->validate([
            'area'=>['required']
        ]);
        //Instancia
        $area = new RRHHArea;
        //Insertar los datos a la BBDD
        $area->area = $request->input('area');
        $area->empresa_id = $request->input('empresa_id');
        $area->activo = $request->input('activo');
        //Guardar en la BBDD
        $area->save();
        //Redirecciona al area index
        return redirect()->route('rrhh.area.index')->with('success','Area creada correctamente');
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
        $area = RRHHArea::find($id);
        return view('RRHH.area.edit', compact('area'));
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
