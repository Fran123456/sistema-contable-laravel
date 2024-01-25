<?php

namespace App\Http\Controllers\Contabilidad;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Contabilidad\ContaBalanceConf;
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
        $balance = ContaBalanceConf::where('empresa_id',$empresa)->get();
        return view("Contabilidad.Balance.index", compact("balance"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $empresa = Help::empresa();


        return view("Contabilidad.Balance.create", compact("empresa"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $empresa = Help::empresa();
        $balance = ContaBalanceConf::create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'campo' => $request->campo,
            'valor' => $request->valor,
            'empresa_id' => $empresa,
        ]);

        $balance->save();

        return redirect()->route('contabilidad.obtenerBalance')->with('success', 'Balance creado');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view("Contabilidad.Balance.show");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view("Contabilidad.Balance.edit");
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
