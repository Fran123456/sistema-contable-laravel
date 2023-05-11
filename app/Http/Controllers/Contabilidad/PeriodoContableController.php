<?php

namespace App\Http\Controllers\Contabilidad;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contabilidad\ContaPeriodoContable;
use App\Help\Help;
class PeriodoContableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        $periodos = ContaPeriodoContable::all();
        $periodo = Help::year();
        if($request->periodo){
            $periodo = $request->periodo;
        }
        $periodos = ContaPeriodoContable::where('year', $periodo)->get();
        $years = ContaPeriodoContable::select('*')->groupBy('year')->get();
        
        return view('contabilidad.periodo.index', compact('periodos','years','periodo'));
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
        $validar = ContaPeriodoContable::where('year', $request->year)->get();
        if(count($validar) > 0 ){
            return back()->with('danger','Error, No se pueden crear los periodos porque ya existen para el año solicitado: '. $request->year);
        }else{
            for ($i=1; $i <=12 ; $i++) { 
                $mes = Help::complementCode($i, 2,'0');
                ContaPeriodoContable::create([
                    'year'=> $request->year,
                    'mes'=> $mes,
                    'codigo'=>$mes.$request->year,
                    'activo'=> false
                ]);
            }
        }
        return back()->with('success','Peridos creados para el año: '. $request->year);
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
        ContaPeriodoContable::where('activo', true)->update(['activo'=> false]);
     
 
        $periodo->activo = $periodo->activo?false:true;
        $periodo->save();
        return back()->with('success','Se ha modificado el estado del periodo correctamente');
    }
}
