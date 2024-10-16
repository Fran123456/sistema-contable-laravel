<?php

namespace App\Http\Controllers\Contabilidad;

use App\Help\Contabilidad\PartidasContables;
use App\Help\Help;
use App\Http\Controllers\Controller;
use App\Models\Contabilidad\contaPartidaContableTemp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PartidaContableTempController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    static public function agregarPartidaTemp($documento_id)
    {
        $partida = contaPartidaContableTemp::where('documento_id', $documento_id)->first();
        if(is_null($partida)){
            $partida = new contaPartidaContableTemp();
            $partida->concepto = "Partida de venta";
            $partida->periodo_id = 10;
            $partida->tipo_partida_id = 1;
            $partida->correlativo = PartidasContables::correlativo(10, 1);
            $partida->debe = 0;
            $partida->haber = 0;
            $partida->fecha_contable = date('Y-m-d');
            $partida->cerrada = 0;
            $partida->anulada = 0;
            $partida->empresa_id = Help::empresa();
            $partida->creador_id = Auth::user()->id;
            $partida->documento_id = $documento_id;

            $partida->save();
        }



    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    static public function PartidasContables($id)
    {
        $partida = contaPartidaContableTemp::where('documento_id', "=", $id)->get();

        return $partida;
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
