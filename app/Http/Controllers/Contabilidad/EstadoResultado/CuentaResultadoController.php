<?php

namespace App\Http\Controllers\Contabilidad\EstadoResultado;

use App\Help\Help;
use App\Http\Controllers\Controller;
use App\Models\Contabilidad\ContaCuentaContable;
use App\Models\Contabilidad\ContaGrupoCuentaResultadoRpt;
use Illuminate\Http\Request;

class CuentaResultadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($utilidad_id, $grupo_id, $sub_grupo_id)
    {
        $utilidadSeleccionada = UtilidadController::getUtilidadById($utilidad_id);
        $grupo = GrupoResultadoController::getGrupoById($grupo_id);
        $subGrupo = SubGrupoResultadoController::subGrupoById($sub_grupo_id);
        $cuentasContables = ContaCuentaContable::where('empresa_id',Help::empresa())->get();
        $cuentas = ContaGrupoCuentaResultadoRpt::where('sub_grupo_id','=',$sub_grupo_id)->with(['utilidad','grupo','subGrupo','cuenta'])->orderBy("id", 'desc')->get();
        return view('contabilidad.estado_resultado.cuentaResultado.index',
        compact('utilidadSeleccionada', 'grupo','subGrupo','cuentas','cuentasContables'));
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
    public function store(Request $request, $utilidad_id, $grupo_id, $sub_grupo_id)
    {
        $request->validate([
            'cuenta_id'=> 'required|integer',
            // 'codigo'=> 'required|string|max:200',
        ]);

        if(Help::empresa()){
            $request->merge(["empresa_id" => Help::empresa()]);
            $request->merge(["utilidad_id" => $utilidad_id]);
            $request->merge(["grupo_id" => $grupo_id]);
            $request->merge(["sub_grupo_id" => $sub_grupo_id]);
        }else{
            return back()->with('danger', 'Error, no se puede procesar la petición');
        }
        $subGrupo = (new ContaGrupoCuentaResultadoRpt())->fill($request->all());
        try {
            $subGrupo->save();

            return redirect()->route('contabilidad.cuentaResultado.index', ['utilidad_id'=>$utilidad_id, 'grupo_id'=>$grupo_id, 'sub_grupo_id'=>$sub_grupo_id,])->with('success','Se ha creado la cuenta correctamente');

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
    public function update(Request $request, $utilidad_id, $grupo_id, $sub_grupo_id, $id)
    {
        $request->validate([
            'cuenta_id'=> 'required|integer',
            // 'codigo'=> 'required|string|max:200',
        ]);
        // return redirect()->route('contabilidad.utilidades.index')->with('success', 'utilidad creado correctamente ');


        $cuenta = ContaGrupoCuentaResultadoRpt::findOrFail($id);

        $cuenta->cuenta_id = $request->cuenta_id;

        try {
            $cuenta->save();
            return redirect()->route('contabilidad.cuentaResultado.index', ['utilidad_id'=>$utilidad_id, 'grupo_id'=>$grupo_id, 'sub_grupo_id'=>$sub_grupo_id,])->with('success','Se ha actualizado la cuenta correctamente');
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
    public function destroy($utilidad_id, $grupo_id, $sub_grupo_id, $id)
    {
        try {
            $cuenta = ContaGrupoCuentaResultadoRpt::findOrFail($id);
            
            $cuenta->delete();

            return redirect()->route('contabilidad.cuentaResultado.index', ['utilidad_id'=>$utilidad_id, 'grupo_id'=>$grupo_id, 'sub_grupo_id' => $sub_grupo_id])->with('success','Se ha eliminado la cuenta correctamente');
        } catch (\Throwable $th) {
            return back()->with('danger', 'no se puede procesar la petición');
        }
    }
}
