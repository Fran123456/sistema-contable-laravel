<?php

namespace App\Http\Controllers\RRHH;

use App\Http\Controllers\Controller;
use App\Models\RRHH\RRHHPeriodosPlanilla;
use Illuminate\Http\Request;
use App\Help\Help;
use Illuminate\Support\Facades\Validator;

class PeriodoPlanillaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $periodos = RRHHPeriodosPlanilla::where("empresa_id", Help::empresa())->get();

        return view("rrhh.periodoPlanilla.index", compact("periodos"));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("RRHH.periodoPlanilla.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->flash();

        $validate = Validator::make($request->all(), [
            'year'=>'required|integer|min:2024',
            'mes' => 'required|integer|in:1,2,3,4,5,6,7,8,9,10,11,12',
            'tipo_periodo' => 'required|string|in:quincenal,mensual',
            'periodo_dias' => 'required|string|in:01-30,01-15,16-30',
            'activo' => 'required|string|in:true,false',
        ]);

        $validate->validate();

        $id_empresa = Help::empresa();

        $validarPeriodo = RRHHPeriodosPlanilla::where('year', $request->year)->where('mes', $request->mes)
        ->where('empresa_id', $id_empresa)->where('tipo_periodo', $request->tipo_periodo)->where('periodo_dias', $request->periodo_dias)->get();

        if( $validarPeriodo->count() > 0 )
            return back()->with('danger','Ya existe un periodo de planilla con la información ingresada para esta empresa');

        $meses = [
            '1' => 'Enero',
            '2' => 'Febrero',
            '3' => 'Marzo',
            '4' => 'Abril',
            '5' => 'Mayo',
            '6' => 'Junio',
            '7' => 'Julio',
            '8' => 'Agosto',
            '9' => 'Septiembre',
            '10' => 'Octubre',
            '11' => 'Noviembre',
            '12' => 'Diciembre',
        ];

        $mes_string = $meses[$request->mes];

        $periodo = RRHHPeriodosPlanilla::create([
            'empresa_id' => $id_empresa,
            'year' => $request->year,
            'mes' => $request->mes,
            'periodo_dias' => $request->periodo_dias,
            'tipo_periodo' => $request->tipo_periodo,
            'mes_string' => $mes_string,
            'activo' => $request->activo == 'true' ? true : false,
        ]);

        $periodo->save();

        return redirect()->route("rrhh.periodoPlanilla.index")->with('success', 'Periodo planilla creado correctamente');
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
        $periodo = RRHHPeriodosPlanilla::find($id);

        if( !$periodo )
            return redirect()->route("rrhh.periodoPlanilla.index")->with('success', 'Periodo planilla eliminado correctamente');

        $periodo->delete();

        return redirect()->route("rrhh.periodoPlanilla.index")->with('success', 'Periodo planilla eliminado correctamente');
    }
}
