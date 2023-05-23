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
use App\Help\Contabilidad\PartidasContables;

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
        $cuentas  = ContaCuentaContable::join("conta_clasificacion_cuenta_contable", "conta_cuenta_contable.clasificacion_id", "=", "conta_clasificacion_cuenta_contable.id")
        ->select("conta_cuenta_contable.*", "conta_clasificacion_cuenta_contable.clasificacion")
        ->where("conta_clasificacion_cuenta_contable.clasificacion", "=", 'detalle')->get();
        return view('contabilidad.partidas_contables.create',compact('periodos','tipos','cuentas'));
    }

    public function obtenerCorrelativoAjax(Request $request){
        $empresa = Help::empresa();
        return PartidasContables::correlativo($request->periodo, $request->tipo);
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
            $data=array('concepto'=>$request['concepto_cabecera'],
            'periodo_id'=>$request['periodo'],
            'tipo_partida_id'=> $request['tipo'],
            'fecha_contable'=>$request['fecha']);

            $partida = PartidasContables::cabecera($data);

            $detalle= array('partida_id'=>$partida->id,
            'periodo_id'=>$request['periodo'],
            'tipo_partida_id'=>$request['tipo'],
            'cuenta_contable_id'=>$request['cuenta'],
            'debe'=>$request['debe'],
            'haber'=>$request['haber'],
            'fecha_contable'=>$request['fecha'],
            'concepto'=>$request['concepto_detalle']);
            PartidasContables::detalle($detalle);

            
           
        } catch (Exception $e) {
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
