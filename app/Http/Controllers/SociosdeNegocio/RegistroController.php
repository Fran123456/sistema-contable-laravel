<?php

namespace App\Http\Controllers\SociosdeNegocio;

use App\Http\Controllers\Controller;
use App\Models\SociosdeNegocio\SociosCargo;
use App\Models\SociosdeNegocio\SociosContacto;
use App\Models\SociosdeNegocio\SociosRegistro;
use Illuminate\Http\Request;
use App\Help\Help;
use App\Help\Log;

class RegistroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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
                'observacion'=> 'required',
            ]);

            $registro = SociosRegistro::create([
                'observacion' => $request->observacion,
                'contacto_id' => $request->contacto_id,
            ]);

            $registro->save();
            return back()->with('success', 'Observacion creado correctamente ');

        } catch (Exception $e) {
            Log::log('SociosdeNegocio', 'registro error al crear la observacion', $e);
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
       $contactoId = $id;
       $cargos = SociosCargo::all();
       $contacto = SociosContacto::find($id);
        $registro = SociosRegistro::where('contacto_id', $id)->get();
        return view('sociosdeNegocio.Registro.show', compact('registro', 'contactoId','contacto','cargos'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $contactoId = $id;
        $registro = SociosRegistro::find($id);
        return view('sociosdeNegocio.Registro.edit', compact('registro', 'contactoId'));
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
            'observacion'=> 'required',
        ]);
        $registro = SociosRegistro::find($id);
        $registro->observacion = $request->observacion;
        try {
            $registro->save();
            return to_route('socios.registro.show', $registro->contacto->id)->with('success', 'Observacion actualizada correctamente ');

        } catch (Exception $e) {
            Log::log('SociosdeNegocio', 'registro error al actualizar la observacion', $e);
            return back()->with('danger', 'Error, no se puede procesar la petición');
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
        $registro = SociosRegistro::find($id);

        Log::log('SociosdeNegocio', 'eliminar observacion', 'El usuario '. Help::usuario()->name.' ha eliminado la observacion ');
        $registro->delete();
        return back()->with('success','Se ha eliminado la observación correctamente');
    }
}
