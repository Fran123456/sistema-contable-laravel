<?php

namespace App\Http\Controllers\SociosdeNegocio;

use App\Http\Controllers\Controller;
use App\Models\SociosdeNegocio\SociosClasificacionCliente;
use Illuminate\Http\Request;
use App\Help\Log;

class ClasificacionClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipos = SociosClasificacionCliente::all();
        return view('SociosdeNegocio.ClasificacionCliente.index', compact('tipos'));
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
        try {
            $request->validate([
                'tipo'=> 'required',
            ]);

            $tipo = SociosClasificacionCliente::create($request->all());
            $tipo->save();
            return to_route('socios.clasificacion.index')->with('success', 'Tipo de cliente creado correctamente ');

        } catch (Exception $e) {
            Log::log('SociosdeNegocio', 'clasificacion cliente error al crear el tipo', $e);
            return back()->with('danger', 'Error, no se puede procesar la petición');
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
        $tipo = SociosClasificacionCliente::find($id);
        return view('SociosdeNegocio.ClasificacionCliente.edit', compact('tipo'));
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
        $tipo = SociosClasificacionCliente::find($id);
        $tipo->tipo = $request->tipo;
        $tipo->descripcion = $request->descripcion;
        try {
            $tipo->save();
            return to_route('socios.clasificacion.index')->with('success', 'Tipo de cliente actualizado correctamente');

        } catch (Exception $e) {
            Log::log('SociosdeNegocio', 'Clasificacion de cliente error al actualizar el tipo', $e);
            return back()->with('danger', 'Ocurrio un error al actualizar el tipo de cliente');
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
        $tipo = SociosClasificacionCliente::find($id);
        Log::log('SociosdeNegocio', 'eliminar tipo de cliente', 'El usuario '. Help::usuario()->name.' ha eliminado el tipo de cliente ');
        $tipo->delete();
        return back()->with('success','El tipo de cliente se ha eliminado correctamente');
    }
}
