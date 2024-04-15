<?php

namespace App\Http\Controllers\Producto;

use App\Http\Controllers\Controller;
use App\Models\Producto\ProTipoPrecio;
use Illuminate\Http\Request;
use App\Help\Log;
use App\Help\Help;

class TipoPrecioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $precios = ProTipoPrecio::all();
        $empresa = Help::empresa();

        return view('producto.precio.index', compact('precios', 'empresa'));
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
        $request->validate([
            'tipo'=> 'required',
        ]);

        $precio = ProTipoPrecio::create($request->all());

        try {
            $precio->save();
            return back()->with('success', 'Tipo de precio creado correctamente ');

        } catch (Exception $e) {
            Log::log('Producto', 'tipo precio error al crear el tipo de precio', $e);
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
        $precio = ProTipoPrecio::find($id);
        
        Log::log('Producto', 'Eliminar tipo precio','El tipo de precio' .  $precio->tipo . " ". ' ha sido eliminado por el usuario '. Help::usuario()->name);
        $precio->delete();
        return back()->with('success','Se ha eliminado el precio correctamente');
    }
}
