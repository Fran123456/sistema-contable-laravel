<?php

namespace App\Http\Controllers\Contabilidad;

use App\Http\Controllers\Controller;
use App\Models\Contabilidad\ContaPeriodoContable;
use App\Models\Contabilidad\ContaTipoPartida;
use Illuminate\Http\Request;
use App\Help\Help;
class TipoPartidaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipos = ContaTipoPartida::where('empresa_id',Help::usuario()->empresa_id)->get();
        return view('contabilidad.tipo_partida.index', compact('tipos'));
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
            $tipo = ContaTipoPartida::create(['tipo' => $request->tipo, 'activo' => true, 'descripcion' => $request->des, 'empresa_id'=> Help::usuario()->empresa_id]);
            $periodos = ContaPeriodoContable::where('empresa_id',Help::usuario()->empresa_id)->get();
            foreach ($periodos as $key => $p) {
                $tipo->periodos()->attach($p->id, ['correlativo' => 0, 'created_at' => date("Y-m-d h:i:s"), 'updated_at' => date("Y-m-d h:i:s"),'empresa_id'=> Help::usuario()->empresa_id]);
            }
            return back()->with('success', 'Tipo partida creado correctamente');
        } catch (\Throwable $th) {
            DB::rollBack();
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
        $tipo = ContaTipoPartida::find($id);
        $tipo->update(['activo' => ($tipo->activo ? false : true)]);
        return back()->with('success', 'Se ha modificado el estado del tipo de partida correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $tipo=ContaTipoPartida::find($id);
         $validar = $tipo->periodos()->where('correlativo',"!=","0")
         ->where('empresa_id',Help::usuario()->empresa_id)->get();
         if(count($validar)>0)
            return back()->with('danger','No se ha podido eliminar el tipo, ya que esta en uso');
        
        ContaTipoPartida::destroy($id);
        return back()->with('success', 'Se ha elimindado el tipo de partida correctamente');
    }
}
