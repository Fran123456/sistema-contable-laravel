<?php

namespace App\Http\Controllers\Contabilidad\EstadoResultado;

use App\Help\Help;
use App\Http\Controllers\Controller;
use App\Models\Contabilidad\ContaGrupoSubResultadoRpt;
use Illuminate\Http\Request;

class SubGrupoResultadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($utilidad_id, $grupo_id)
    {
        $grupo = GrupoResultadoController::getGrupoById($grupo_id);
        $utilidadSeleccionada = UtilidadController::getUtilidadById($utilidad_id);
        $subGrupos = ContaGrupoSubResultadoRpt::OrderBy('id', 'desc')->where('grupo_id','=',$grupo_id)->with(['utilidad',"grupo"])->get();

        return view('contabilidad.estado_resultado.subGrupoResultado.index', compact('utilidadSeleccionada','subGrupos','grupo','utilidad_id','grupo_id'));
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
    public function store(Request $request,$utilidad_id,$grupo_id)
    {
        $request->validate([
            'sub_grupo'=> 'required|string|max:200',
        ]);

        if(Help::empresa()){
            $request->merge(["empresa_id" => Help::empresa()]);
            $request->merge(["utilidad_id" => $utilidad_id]);
            $request->merge(["grupo_id" => $grupo_id]);
        }else{
            return back()->with('danger', 'Error, no se puede procesar la petición');
        }
        $subGrupo = (new ContaGrupoSubResultadoRpt())->fill($request->all());
        try {
            $subGrupo->save();

            return redirect()->route('contabilidad.subGrupoResultado.index', ['utilidad_id' => $utilidad_id, 'grupo_id'=>$grupo_id])->with('success', 'Sub grupo creado correctamente ');

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
    public function update(Request $request,$utilidad_id, $grupo_id, $id)
    {
        $request->validate([
            'sub_grupo'=> 'required|string|max:200',
        ]);

        $subGrupo = ContaGrupoSubResultadoRpt::findOrFail($id);

        $subGrupo->sub_grupo = $request->sub_grupo;

        try {
            $subGrupo->save();

            return redirect()->route('contabilidad.subGrupoResultado.index', ['utilidad_id' => $utilidad_id, 'grupo_id' => $grupo_id])->with('success', 'Sub Grupo actualizado correctamente');
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
    public function destroy($utilidad_id, $grupo_id, $id)
    {
        try {
            $subGrupo = ContaGrupoSubResultadoRpt::findOrFail($id);
            $subGrupo->delete();
            return redirect()->route('contabilidad.subGrupoResultado.index', ['utilidad_id'=>$utilidad_id, 'grupo_id'=>$grupo_id])->with('success','Se ha eliminado el sub grupo correctamente');
        } catch (\Throwable $th) {
            return back()->with('danger', 'no se puede procesar la petición');
        }
    }
}
