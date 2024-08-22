<?php

namespace App\Http\Controllers\Contabilidad;

use Illuminate\Http\Request;
use App\Models\Contabilidad\ContaRubroGeneral;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ContaRubroGeneralController extends Controller
{
    public function index()
    {
        $empresaId = Auth::user()->empresa_id;
        $rubros = ContaRubroGeneral::where('empresa_id', $empresaId)->get();
        return view('contabilidad.rubro.index', compact('rubros'));
    }

    public function create()
    {
        return view('contabilidad.rubros.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'rubro' => 'required|string',
            'signo' => 'required|string',
        ]);

        $rubro = new ContaRubroGeneral();
        $rubro->rubro = $request->rubro;
        $rubro->signo = $request->signo;
        $rubro->saldo = 0;
        $rubro->empresa_id = Auth::user()->empresa_id;
        $rubro->save();

        return redirect()->route('contabilidad.rubros.index')->with('success', 'Rubro creado exitosamente.');
    }

    public function edit($id)
    {
        $rubro = ContaRubroGeneral::findOrFail($id);
        return view('contabilidad.rubro.edit', compact('rubros'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'rubro' => 'required|string',
            'signo' => 'required|string',
        ]);

        $rubro = ContaRubroGeneral::findOrFail($id);
        $rubro->rubro = $request->rubro;
        $rubro->signo = $request->signo;
        $rubro->saldo = 0;
        $rubro->save();

        return redirect()->route('contabilidad.rubros.index')->with('success', 'Rubro actualizado exitosamente.');
    }

    public function destroy($id)
    {
        $rubro = ContaRubroGeneral::findOrFail($id);
        $rubro->delete();

        return redirect()->route('contabilidad.rubros.index')->with('success', 'Rubro eliminado exitosamente.');
    }
}