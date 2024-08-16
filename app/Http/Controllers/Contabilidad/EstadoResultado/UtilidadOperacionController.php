<?php

namespace App\Http\Controllers\Contabilidad\EstadoResultado;

use App\Help\Help;
use App\Http\Controllers\Controller;
use App\Models\Contabilidad\ContaUtilidadOperacionRpt;
use App\Models\Contabilidad\ContaUtilidadRpt;
use Illuminate\Http\Request;

class UtilidadOperacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($utilidad_id)
    {
        $utilidadOperaciones = ContaUtilidadOperacionRpt::OrderBy('id', 'desc')->where('utilidad_id','=',$utilidad_id)->with('utilidad',"utilidadOperacion")->get();
        $utilidades = ContaUtilidadRpt::Where('empresa_id','=', Help::empresa())->get();

        return view('contabilidad.estado_resultado.utilidadOperaciones.index', compact('utilidadOperaciones','utilidades','utilidad_id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $utilidades = ContaUtilidadRpt::Where('empresa_id','=', Help::empresa())->get();

        return response()->json($utilidades);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $utilidad_id)
    {
        $request->validate([
            'utilidad_operar_id'=> 'required|integer',
            'signo' => 'required|string|in:+,-',
        ]);

        if(Help::empresa()){
            $request->merge(["empresa_id" => Help::empresa()]);
            $request->merge(["utilidad_id" => $utilidad_id]);
        }else{
            return back()->with('danger', 'Error, no se puede procesar la petición');
        }

        $utilidad = (new ContaUtilidadOperacionRpt())->fill($request->all());
        try {
            $utilidad->save();

            return redirect()->route('contabilidad.utilidadOperaciones.index',$utilidad_id)->with('success', 'operación creado correctamente ');

        } catch (Exception $e) {
            // Log::log('SociosdeNegocio', 'contacto error al crear el contacto', $e);
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
    public function destroy($utilidad_id, $id)
    {
        try {
            $utilidad = ContaUtilidadOperacionRpt::findOrFail($id);
            $utilidad->delete();
            return redirect()->route('contabilidad.utilidadOperaciones.index', $utilidad_id)->with('success','Se ha eliminado la operación correctamente');
        } catch (\Throwable $th) {
            return back()->with('danger', 'no se puede procesar la petición');
        }
    }
}
