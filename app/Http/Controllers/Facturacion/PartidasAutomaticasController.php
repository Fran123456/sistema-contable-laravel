<?php

namespace App\Http\Controllers\Facturacion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Facturacion\ConfPartidasAutomaticas;
use App\Models\Contabilidad\ContaCuentaContable;
use Illuminate\Support\Facades\Auth;


class PartidasAutomaticasController extends Controller
{
    public function index()
    {
        $empresaId = Auth::user()->empresa_id;
        $partidas = ConfPartidasAutomaticas::where('tipo', 'partida_venta')
            ->where('empresa_id', $empresaId)
            ->get();
        

        $cuentas = ContaCuentaContable::where('empresa_id', $empresaId)->get();

        return view('Facturacion.PartidasAutomaticas.index', compact('partidas', 'cuentas'));
    }

    public function update(Request $request, $id)
    {
        $partida = ConfPartidasAutomaticas::findOrFail($id);
        $partida->cuenta_id = $request->cuenta_id;
        if(!$partida->save()){
            return redirect()->back()->with('danger', 'Problemas al actualizar'); 
        }

        return redirect()->back()->with('success', 'Cuenta actualizada exitosamente');
    }
}
