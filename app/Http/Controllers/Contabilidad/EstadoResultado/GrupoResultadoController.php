<?php

namespace App\Http\Controllers\Contabilidad\EstadoResultado;

use App\Help\Help;
use App\Http\Controllers\Controller;
use App\Models\Contabilidad\ContaGrupoResultadoRpt;
use Illuminate\Http\Request;

class GrupoResultadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($utilidad_id)
    {
        $utilidadSeleccionada = UtilidadController::getUtilidadById($utilidad_id);
        $grupos = ContaGrupoResultadoRpt::OrderBy('id', 'desc')->where('utilidad_id','=',$utilidad_id)->with('utilidad')->get();

        return view('contabilidad.estado_resultado.grupoResultado.index', compact('grupos', 'utilidad_id', 'utilidadSeleccionada'));
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
    public function store(Request $request, $utilidad_id)
    {
        $request->validate([
            'grupo'=> 'required|string|max:200',
            'signo' => 'required|string|in:+,-',
        ]);

        if(Help::empresa()){
            $request->merge(["empresa_id" => Help::empresa()]);
            $request->merge(["utilidad_id" => $utilidad_id]);
        }else{
            return back()->with('danger', 'Error, no se puede procesar la petición');
        }

        $utilidad = (new ContaGrupoResultadoRpt())->fill($request->all());
        try {
            $utilidad->save();

            return redirect()->route('contabilidad.grupoResultado.index', ['utilidad_id' => $utilidad_id])->with('success', 'Grupo creado correctamente ');

        } catch (Exception $e) {
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
    public function update(Request $request, $utilidad_id ,$id)
    {
        $request->validate([
            'grupo'=> 'required|string|max:200',
            'signo' => 'required|string|in:+,-',
        ]);

        $grupo = ContaGrupoResultadoRpt::findOrFail($id);

        $grupo->grupo = $request->grupo;
        $grupo->signo = $request->signo;

        try {
            $grupo->save();

            return redirect()->route('contabilidad.grupoResultado.index', ['utilidad_id' => $utilidad_id])->with('success', 'Grupo actualizado correctamente');
        } catch (Exception $e) {
            return back()->with('danger', 'Error, no se puede procesar la petición');
        }
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
            $grupo = ContaGrupoResultadoRpt::findOrFail($id);
            $grupo->delete();
            return redirect()->route('contabilidad.grupoResultado.index', ['utilidad_id'=>$utilidad_id])->with('success','Se ha eliminado el grupo correctamente');
        } catch (\Throwable $th) {
            return back()->with('danger', 'no se puede procesar la petición');
        }
    }

    public static function getGrupoById($id){
        return ContaGrupoResultadoRpt::find($id);
    }
}
