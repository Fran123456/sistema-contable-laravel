<?php

namespace App\Http\Controllers\SociosdeNegocio;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SociosdeNegocio\SociosCargo;
use App\Help\Help;
use App\Help\Log;


class CargoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cargos = SociosCargo::all();
        return view('sociosdeNegocio.Cargo.index', compact('cargos'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sociosdeNegocio.Cargo.create');
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
                'cargo'=> 'required',
                'descripcion'=> 'max:200',
            ]);

            $cargo = SociosCargo::create([
                'cargo' => $request->cargo,
                'descripcion' => $request->descripcion,
            ]);

            $cargo->save();
            return to_route('socios.cargo.index')->with('success', 'Cargo creado correctamente ');

        } catch (Exception $e) {
            Log::log('SociosdeNegocio', 'cargo error al crear el cargo', $e);
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
        $cargo = SociosCargo::find($id);
        return view('sociosdeNegocio.Cargo.edit', compact('cargo'));
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
        $cargo = SociosCargo::find($id);
        $cargo->cargo = $request->cargo;
        $cargo->descripcion = $request->descripcion;

        try {
            $cargo->save();
            return to_route('socios.cargo.index')->with('success', 'Cargo actualizado correctamente');

        } catch (Exception $e) {
            Log::log('SociosdeNegocio', 'cargo error al actualizar cargo', $e);
            return back()->with('danger', 'Ocurrio un error al actualizar el cargo');
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
        $cargo = SociosCargo::find($id);

        Log::log('SociosdeNegocio', 'eliminar cargo', 'El usuario '. Help::usuario()->name.' ha eliminado el cargo ');
        $cargo->delete();
        return back()->with('success','Se ha eliminado el cargo correctamente');
    }
}
