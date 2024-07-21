<?php

namespace App\Http\Controllers\Contabilidad;
use App\Help\Help;
use App\Models\Contabilidad\ContaCuentaContable;
use App\Models\Contabilidad\ContaPartidaContable;
use App\Models\Contabilidad\ContaPeriodoContable;
use App\Models\Contabilidad\ContaTipoPartida;
use App\Models\Contabilidad\ContaDetallePartida;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Contracts\Database\Eloquent\Builder;
use App\Help\Contabilidad\PartidasContables;
use PDF;
use App\Help\Log;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ContaPartidasContableImport;

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

    public function reportePartidaContable(Request $request,$id)
    {
        $data = [
            'partida' => ContaPartidaContable::find($id),
        ];

        return PDF::loadView('contabilidad.partidas_contables.reportes.partida', $data)
        ->stream('partida_contable.pdf');

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

            Log::log('Contabilidad', 'Crear partida contable', 'El usuario '. Help::usuario()->name.' ha creado la partida ' .$partida->correlativo);

           return redirect()->route('contabilidad.partidas.edit', $partida->id)->with('success','Partida creada correctamente');
        } catch (Exception $e) {
            DB::rollBack();
            Log::log('Contabilidad', 'Crear partida contable', 'El usuario '. Help::usuario()->name.' intento crear la partida contable sin exito ');

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
       $tipos = ContaTipoPartida::where('empresa_id', Help::empresa())->get();
       return view('contabilidad.partidas_contables.importar_excel', compact('tipos'));
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

        $partida= ContaPartidaContable::find($id);
        if($request->detalle){

            $detalle= array('partida_id'=>$partida->id,
            'periodo_id'=>$partida->periodo_id,
            'tipo_partida_id'=>$partida->tipo_partida_id,
            'cuenta_contable_id'=>$request['cuenta'],
            'debe'=>$request['debe']??0,
            'haber'=>$request['haber']??0,
            'fecha_contable'=>$request['fecha_detalle'],
            'concepto'=>$request['concepto_detalle']??$partida->concepto);

            PartidasContables::detalle($detalle);

        }else{
            $data = array('concepto'=>$request->concepto_cabecera, 'fecha_contable'=>$request->fecha, 'id'=>$id);
            PartidasContables::updateCabecera($data);
        }
        Log::log('Contabilidad', 'Editar partida contable', 'El usuario '. Help::usuario()->name.' ha editado la partida ' .$partida->correlativo);

        return redirect("/contabilidad/partidas/$partida->id/edit#detalles")->with('success','Se ha editado correctamente la partida contable');
    }

    //editar detalle de partida
    public function actualizarDetallePartida(Request $request, $id) 
    {
        $detalle = ContaDetallePartida::find($id);

        if (!$detalle) {
            return redirect()->back()->with('danger', 'El detalle de la partida no se encontró.');
        }

        // Depuración: Verifica el valor del campo cuenta_contable_id
        $cuentaId = $request->cuenta;
        $cuentaContable = ContaCuentaContable::find($cuentaId);

        // Depuración del campo "cuenta"
        // dd($cuentaId);

        if (!$cuentaContable) {
            return redirect()->back()->with('danger', 'El ID de cuenta contable no existe.');
        }

        $detalle->cuenta_contable_id = $cuentaId;
        $detalle->concepto = $request->concepto_detalle;
        $detalle->debe = $request->debe ?? 0;
        $detalle->haber = $request->haber ?? 0;
        $detalle->fecha_contable = $request->fecha_detalle;

        $detalle->save();

        Log::log('Contabilidad', 'Editar detalle de partida contable', 'El usuario ' . Help::usuario()->name . ' ha editado el detalle de la partida ' . $detalle->id);

        return redirect("/contabilidad/partidas/{$detalle->partida_id}/edit#detalles")->with('success', 'Detalle de la partida actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) //ANULAR PARTIDA
    {
        $partida = PartidasContables::anular($id);
        Log::log('Contabilidad', 'Anular partida contable', 'El usuario '. Help::usuario()->name.' anulo la partida ' .$partida->correlativo);

        return back()->with('success','Se ha anulado la partida correctamente');
    }

    public function eliminarDetallePartida($id){
        $dt = PartidasContables::destroyDetalle($id);
        $partida= ContaPartidaContable::find($dt->partida_id);
        Log::log('Contabilidad', 'Eliminar detalle de partida', 'El usuario '. Help::usuario()->name.' elimino un detalle de la partida ' .$partida->correlativo);
        return redirect("/contabilidad/partidas/$partida->id/edit#detalles");
    }

    public function cerrarPartida($id){
        $partida= ContaPartidaContable::find($id);
        if($partida->debe != $partida->haber){
            return back()->with('danger','No se ha podido cerrar la partida porque no esta cuadrada');
        }
        $partida->cerrada = true;
        $partida->save();
        Log::log('Contabilidad', 'Cerrar partida contable', 'El usuario '. Help::usuario()->name.' cerro la partida ' .$partida->correlativo);
        return redirect()->route('contabilidad.partidas.index')->with('success','Se ha cerrado la partida correctamente');
    }


    public function importarPartidasExcel(Request $request){

        //$help = Help::uploadFile($request, 'import-excel-cuentas', '', 'excel', false);
       
           //  DB::table('conta_cuenta_contable')->where('empresa_id', Help::empresa())->delete();
             $import = new ContaPartidasContableImport(Help::empresa());
             Excel::import($import, request()->file('excel'));
             $rows        = $import->getNumeroFilas();
             $errores  = $import->getErrores();
             $ingresados = $import->getIngresados();
             Log::log('Contabilidad', 'Importar partida contable ', 'El usuario '. Help::usuario()->name.' ha importado una partida contable para la empresa ' .Help::usuario()->empresa->empresa );
             return view('contabilidad.partidas_contables.importar_excel_resumen', compact('rows','errores','ingresados'));
         
 
 
     }
 
}
