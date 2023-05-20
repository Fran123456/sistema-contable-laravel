<?php

namespace App\Http\Controllers\Contabilidad;
use App\Help\Help;
use App\Models\Contabilidad\ContaCuentaContable;
use App\Models\Contabilidad\ContaPartidaContable;
use App\Models\Contabilidad\ContaPeriodoContable;
use App\Models\Contabilidad\ContaTipoPartida;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Contracts\Database\Eloquent\Builder;

class PartidasContablesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $empresa = Help::empresa();
        $periodos = ContaPeriodoContable::where('empresa_id',$empresa)->where('activo', true)->get();
        $partidas = [];
        if(count($periodos)>0){
            $partidas = ContaPartidaContable::where('periodo_id', $periodos[0]->id)
            ->where('empresa_id', $empresa)
            ->orderBy('fecha_contable','desc')->get();
        }
        
        return view('contabilidad.partidas_contables.index',compact('periodos','partidas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $empresa = Help::empresa();
        $periodos = ContaPeriodoContable::where('empresa_id',$empresa)->where('activo', true)->get();
        $tipos = ContaTipoPartida::where('empresa_id',Help::empresa())->get();
        
        $cuentas  = ContaCuentaContable::where('empresa_id',Help::empresa())->with(['clasificacion' => function (Builder $query) {
            $query->where('clasificacion','detalle');
        }])->get();

        return view('contabilidad.partidas_contables.create',compact('periodos','tipos','cuentas'));
    }

    public function obtenerCorrelativoAjax(Request $request){
        $empresa = Help::empresa();
        $periodo = ContaPeriodoContable::find($request->periodo);
        return $periodo->tiposPartida()->first();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
    }
}
