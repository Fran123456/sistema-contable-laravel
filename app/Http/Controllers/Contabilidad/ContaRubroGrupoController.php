<?php

namespace App\Http\Controllers\Contabilidad;

use Illuminate\Http\Request;
use App\Models\Contabilidad\ContaRubroGrupo;
use App\Http\Controllers\Controller;

class ContaRubroGrupoController extends Controller
{
    
    public function index()
    {
        $rubros = ContaRubroGrupo::all();
        return view('contabilidad.rubro-grupo.index', compact('rubros'));
    }

    public function create()
    {
        return view('contabilidad.rubro-grupo.create');
    }

    public function store(Request $request){
        $data = $request->validate([
            'grupo' => 'required|string|max:255',
            'rubro_id' => 'required|exists:conta_rubro_general_rpt,id',
            'signo' => 'required|string|max:1',
            'saldo' => 'required|numeric',
            'empresa_id' => 'required|exists:empresas,id'
        ]);

        ContaRubroGrupo::create($data);
        return redirect()->route('contabilidad.rubro-grupo.index')->with('success', 'Rubro creado exitosamente.');
    }

    public function show(ContaRubroGrupo $grupo)
    {
        return view('contabilidad.rubro-grupo.show', compact('grupo'));
    }

    public function edit(ContaRubroGrupo $grupo)
    {
        return view('contabilidad.rubro-grupo.edit', compact('grupo'));
    }

    public function update(Request $request, ContaRubroGrupo $grupo)
    {
        $data = $request->validate([
            'grupo' => 'required|string|max:255',
            'rubro_id' => 'required|exists:conta_rubro_general_rpt,id',
            'signo' => 'required|string|max:1',
            'saldo' => 'required|numeric',
            'empresa_id' => 'required|exists:empresas,id'
        ]);

        $grupo->update($data);
        return redirect()->route('contabilidad.rubro-grupo.index')->with('success', 'Rubro actualizado exitosamente.');
    }

    public function destroy(ContaRubroGrupo $grupo)
    {
        $grupo->delete();
        return redirect()->route('contabilidad.rubro-grupo.index')->with('success', 'Rubro eliminado exitosamente.');
    }
    
}
