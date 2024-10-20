<?php

namespace App\Http\Controllers\Contabilidad;

use Illuminate\Http\Request;
use App\Models\Contabilidad\ContaRubroGeneral;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Contabilidad\ContaRubroCuentas;
use App\Models\Contabilidad\ContaCuentaContable;


class ContaRubroCuentaController extends Controller
{
    public function index($grupo, $rubro)
    {

        $grupo_id = $grupo;
        $rubro_id = $rubro;
        $rubroCuentas = ContaRubroCuentas::where('grupo_id', $grupo)->get();
        $cuentasContables = ContaCuentaContable::all();

        return view('contabilidad.rubro_grupo_cuentas_contables.index', compact('rubroCuentas', 'cuentasContables', 'grupo_id', 'rubro_id'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'numero_cuenta' => 'required|string',
            'signo' => 'required|string',
            'saldo' => 'required|integer',
        ]);

        $rubroCuentas = new ContaRubroCuentas();
        $rubroCuentas->cuenta_id = $request->cuenta_id;
        $rubroCuentas->numero_cuenta = $request->numero_cuenta;
        $rubroCuentas->grupo_id = $request->grupo_id;
        $rubroCuentas->rubro_id = $request->rubro_id;
        $rubroCuentas->signo = $request->signo;
        $rubroCuentas->saldo = $request->saldo;
        $rubroCuentas->empresa_id = Auth::user()->empresa_id;

        if (!$rubroCuentas->save()) {
            return back()->with('danger', 'Ocurrio un error al crear la asociación');
        }


        return back()->with('success', 'Cuenta contable asociada con exito');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'numero_cuenta' => 'required|string',
            'signo' => 'required|string',
            'saldo' => 'required|numeric',
        ]);

        $rubroCuentas = ContaRubroCuentas::findOrFail($id);
        $rubroCuentas->fill($request->all());

        if (!$rubroCuentas->save()) {
            return back()->with('danger', 'Ocurrio un error al actualizar');
        }


        return back()->with('success', 'Se modifico la cuenta asociada');
    }

    public function destroy($id)
    {
        try {
            $rubroCuenta = ContaRubroCuentas::findOrFail($id);

            $rubroCuenta->delete();

            return back()->with('success', 'El registro fue eliminado correctamente.');

        } catch (\Exception $e) {
            return back()->with('danger', 'Ocurrió un error al eliminar el registro.');
        }
    }

}