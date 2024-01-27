<?php

namespace App\Http\Controllers\Contabilidad;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Contabilidad\ContaBalanceConf;
use App\Models\Contabilidad\ContaCuentaContable;
use App\Models\Contabilidad\ContaTipoPartida;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Help\Log;
use App\Help\Help;


class BalanceContableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $empresa = Help::empresa();
        /* $clasificacion = ContaClasificacionCuenta::where('empresa_id',Help::empresa())->get(); */
        $balance = ContaBalanceConf::where('empresa_id', $empresa)->where('categoria','contabilidad')->get();
        return view("Contabilidad.Balance.index", compact("balance"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $balance = ContaBalanceConf::find($id);

        $tipo = $balance->tipo;

        $opciones = null;

        if ( $tipo === 'cuenta_contable' ){
            $opciones = ContaCuentaContable::all();
            $tipo = 'cuenta';
        } else {
            $opciones = ContaTipoPartida::all();
            $tipo = 'partida';
        }

        return view("Contabilidad.Balance.edit", compact("balance", "opciones", "tipo"));
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
        $request->flash();

        $validate = Validator::make($request->all(), [
            'valor' => 'required|string|max:255',
        ]);

        $validate->validate();

        $balance = ContaBalanceConf::find($id);

        $balance->valor = $request->valor;

        $balance->save();

        return redirect()->route('contabilidad.obtenerBalance')->with('success', 'Balance editado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }
}
