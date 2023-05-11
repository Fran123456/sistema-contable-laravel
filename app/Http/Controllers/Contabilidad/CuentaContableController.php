<?php

namespace App\Http\Controllers\Contabilidad;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contabilidad\ContaClasificacionCuenta;
use App\Help\Help;
use App\Models\Contabilidad\ContaNivelCuenta;
use App\Models\Contabilidad\ContaCuentaContable;


class CuentaContableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cuentas = ContaCuentaContable::all();
        return view('contabilidad.cuenta_contable.index',compact('cuentas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cuentas = ContaCuentaContable::where('activo',true)->get();
        $niveles = ContaNivelCuenta::all();
        $clasificacion = ContaClasificacionCuenta::all();
        return view('contabilidad.cuenta_contable.create',compact('cuentas','niveles','clasificacion'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        ContaCuentaContable::create([
            'codigo'=>$request->codigo,
            'nombre_cuenta'=>$request->nombre,
            'padre_id'=>$request->padre,
            'hijos'=>0,
            'nivel_id'=>$request->nivel,
            'clasificacion_id'=>$request->clasificacion,
            'saldo'=> 0,
            'activo'=>$request->activo
        ]);
        return back()->with('success','Cuenta creada correctamente');
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
        $cuenta = ContaCuentaContable::find($id);
        if($request->solo_activo){
            $cuenta->activo =$cuenta->activo?false:true;
        }
        $cuenta->save();
        return back()->with('success','Se ha modificado la cuenta contable correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ContaCuentaContable::destroy($id);
        return back()->with('success','Se ha eliminado la cuenta contable correctamente');
    }
}
