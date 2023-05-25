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
        $tipos = ContaTipoPartida::where('empresa_id',$empresa )->get();
        $cuentas  = ContaCuentaContable::cuentasDetalle($empresa);
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


           return redirect()->route('contabilidad.partidas.edit', $partida->id)->with('success','Partida creada correctamente');
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
        $empresa = Help::empresa();
        $periodos = ContaPeriodoContable::where('empresa_id',$empresa)->where('activo', true)->get();
        $tipos = ContaTipoPartida::where('empresa_id', $empresa)->get();
        $cuentas  = ContaCuentaContable::cuentasDetalle($empresa );
        $partida= ContaPartidaContable::find($id);

        return view('contabilidad.partidas_contables.edit',compact('periodos','tipos','cuentas','partida'));
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
        if($request->detalle){
            $partida= ContaPartidaContable::find($id);
            $detalle= array('partida_id'=>$partida->id,
            'periodo_id'=>$partida->periodo_id,
            'tipo_partida_id'=>$partida->tipo_partida_id,
            'cuenta_contable_id'=>$request['cuenta'],
            'debe'=>$request['debe'],
            'haber'=>$request['haber'],
            'fecha_contable'=>$request['fecha'],
            'concepto'=>$request['concepto_detalle']);
            PartidasContables::detalle($detalle);

        }else{
            $data = array('concepto'=>$request->concepto_cabecera, 'fecha_contable'=>$request->fecha_detalle, 'id'=>$id);
            PartidasContables::updateCabecera($data);
        }
        return back()->with('success','Se ha editado correctamente la partida contable');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        PartidasContables::anular($id);
        return back()->with('success','Se ha anulado la partida correctamente');
    }

    public function cerrarPartida($id){
        $partida= ContaPartidaContable::find($id);
        $partida->cerrada = true;
        $partida->save();
        return back()->with('success','Se ha cerrado la partida correctamente');
    }
}
