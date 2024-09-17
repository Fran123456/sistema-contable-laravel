<?php

namespace App\Http\Controllers\Contabilidad;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Contabilidad\ContaRubroGrupo;
use App\Models\Contabilidad\ContaRubroGeneral;

class ContaRubroGrupoController extends Controller
{
   
    public function index($rubroId){
        $empresaId = Auth::user()->empresa_id;
        $grupos = ContaRubroGrupo::where('rubro_id', $rubroId)
            ->where('empresa_id', $empresaId)
            ->get();
        $rubro = ContaRubroGeneral::findOrfail($rubroId);
        return view('contabilidad.rubro_grupo.index', compact('grupos', 'rubro'));
    }

    public function store(Request $request, $rubroId){
        $request->validate([
            'grupo' => 'required',
            'signo' => 'required',
        ]);

        ContaRubroGrupo::create([
            'grupo' => $request->grupo,
            'rubro_id' => $rubroId,
            'signo' => $request->signo,
            'saldo' => 0,
            'empresa_id' => Auth::user()->empresa_id
        ]);
        return redirect()->route('contabilidad.grupos.index', $rubroId)->with('success', 'Grupo creado correctamente');
    }

    public function update(Request $request, $id){
        $request->validate([
            'grupo' => 'required|string',
            'signo' => 'required|string',
        ]);

        $grupo = ContaRubroGrupo::findOrfail($id);
        $grupo->update([
            'grupo' => $request->grupo,
            'signo' => $request->signo,
            'saldo' => 0,
        ]);
        return redirect()->route('contabilidad.grupos.index', $grupo->rubro_id)->with('success', 'Grupo actualizado correctamente');
    }

    public function destroy($id){
        $grupo = ContaRubroGrupo::findOrfail($id);
        $rubroId = $grupo->rubro_id;
        $grupo->delete();

        return redirect()->route('contabilidad.grupos.index', $rubroId)->with('success', 'Grupo eliminado correctamente');
    }

}
