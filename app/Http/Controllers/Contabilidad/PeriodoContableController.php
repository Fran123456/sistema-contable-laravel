<?php

namespace App\Http\Controllers\Contabilidad;

use App\Help\Help;
use App\Http\Controllers\Controller;
use App\Models\Contabilidad\ContaPeriodoContable;
use App\Models\Contabilidad\ContaTipoPartida;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PeriodoContableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $periodos = null;
        $periodo = Help::year();
        if ($request->periodo) {
            $periodo = $request->periodo;
        }
        $periodos = ContaPeriodoContable::where('year', $periodo)->where('empresa_id',Help::usuario()->empresa_id)->get();
        $years = ContaPeriodoContable::select('*')->where('empresa_id',Help::usuario()->empresa_id)->groupBy('year')->get();

        return view('contabilidad.periodo.index', compact('periodos', 'years', 'periodo'));
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
            DB::beginTransaction();
            $tipos = ContaTipoPartida::where('empresa_id',Help::usuario()->empresa_id)->get();
            if(count($tipos)==0){
                return back()->with('danger', 'Error, No se pueden crear los periodos porque aun no se han creado tipos de partida, validar haberlos creados todos: ' . $request->year);  
            }


            $validar = ContaPeriodoContable::where('year', $request->year)->where('empresa_id',Help::usuario()->empresa_id)->get();
            if (count($validar) > 0) {
                return back()->with('danger', 'Error, No se pueden crear los periodos porque ya existen para el año solicitado: ' . $request->year);
            } else {
                for ($i = 1; $i <= 12; $i++) {
                    $mes = Help::complementCode($i, 2, '0');
                    $periodo = ContaPeriodoContable::create([
                        'year' => $request->year,
                        'mes' => $mes,
                        'codigo' => $mes . $request->year,
                        'activo' => false,
                        'usuario_creador_id' => Help::usuario()->id,
                        'empresa_id'=>Help::usuario()->empresa_id
                    ]);

                    foreach ($tipos as $key => $t) {
                        $periodo->tiposPartida()->attach($t->id, ['correlativo' => 0, 'created_at' => date("Y-m-d h:i:s"), 'updated_at' => date("Y-m-d h:i:s"), 'empresa_id'=>Help::usuario()->empresa_id]);
                    }
                }
            }

            DB::commit();
            return back()->with('success', 'Peridos creados para el año: ' . $request->year);
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
        $periodo = ContaPeriodoContable::find($id);
        ContaPeriodoContable::where('activo', true)->update(['activo' => false]);

        $periodo->activo = $periodo->activo ? false : true;
        $periodo->save();
        return back()->with('success', 'Se ha modificado el estado del periodo correctamente');
    }
}
