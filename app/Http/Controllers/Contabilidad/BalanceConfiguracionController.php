<?php

namespace App\Http\Controllers\Contabilidad;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Help\Help;
use App\Models\Contabilidad\ContaBalanceConf;
use App\Models\Contabilidad\ContaCuentaContable;
use App\Help\Log;

class BalanceConfiguracionController extends Controller
{
    public function index()
    {
        $empresa = Help::empresa();
        $data = ContaBalanceConf::where('empresa_id', $empresa)->where('editar', 1)->get();

        return view('contabilidad.configuracion.contabilidad_config_index', compact('data'));
    }

    public function edit($id)
    { 
        $empresa = Help::empresa();
        $data = ContaBalanceConf::find($id);
      
        $cuentas  = ContaCuentaContable::cuentas($empresa);
    
        return view('contabilidad.configuracion.contabilidad_config_edit',compact('data', 'cuentas'));
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

        $configuracion = ContaBalanceConf::find($id);
        $cuenta = ContaCuentaContable::find($request->cuenta);
        $configuracion->codigo = $cuenta->codigo;
        $configuracion->nombre_cuenta = $cuenta->nombre_cuenta;
        $configuracion->cuenta_id = $cuenta->id;
        try {
            $configuracion->save();
            Log::log('Contabilidad', 'Editar configuracion contable','La configuracion ha sido actualizada por el usuario '. Help::usuario()->name);
            return to_route('contabilidad.configuracion')->with('success', 'Configuracion actualizada correctamente');

        } catch (Exception $e) {
            Log::log('Contabilidad', 'Configuracion contable error al actualizar la configuracion', $e);
            return back()->with('danger', 'Error, no se puede procesar la petición');
        }
    }
}

