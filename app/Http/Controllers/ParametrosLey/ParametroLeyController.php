<?php

namespace App\Http\Controllers\ParametrosLey;

use App\Http\Controllers\Controller;
use App\Models\ParametrosLey\ParametroLey;
use App\Models\Configuracion\GestionEmpresas;
use Illuminate\Http\Request;

class ParametroLeyController extends Controller
{
    
    public function index()
    {
        $parametros = ParametroLey::with('empresa')->get();
        return view('ParametrosLey.Ley.index', compact('empresas'));
    }

    public function create()
    {
        $empresas = GestionEmpresas::all();
        return view('ParametrosLey.Ley.create', compact('empresas'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tipo'=>'required|string',
            'valor'=>'required|numeric',
            'empresa_id'=>'required|integer',
            'fecha_inicio'=>'required|date',
            'fecha_fin'=>'required|date',
            'estado'=>'required|vencido',
            'creado_por'=>'required|integer'
        ]);

        $validated['creado_por'] = auth()->id() ?? 1;
        ParametroLey::create($validated);
        return redirect()->route('ParametrosLey.Ley.index')->with('success', 'Parametro creado correctamente');
    }

    public function edit($id)
    {
        $parametro = ParametroLey::findOrFail($id);
        $empresas = GestionEmpresas::all();
        return view('ParametrosLey.Ley.edit', compact('parametro', 'empresas'));
    }


    public function update(Request $request, $id)
    {
        $parametro = ParametroLey::findOrFail($id);

        $validated = $request->validate([
            'valor' => 'nullable|numeric|min:0',
            'fecha_inicio' => 'nullable|date',
            'fecha_fin' => 'nullable|date|after:fecha_inicio',
            'estado' => 'nullable|in:vigente,vencido'
        ]);

        $parametro->update($validated);

        return redirect()->route('ParametrosLey.Ley.index')->with('success', 'Parametro actualizado correctamente');
    }

    public function destroy($id)
    {
        $parametro = ParametroLey::findOrFail($id);
        $parametro->delete();

        return redirect()->route('ParametrosLey.Ley.index')->with('success', 'Parametro eliminado correctamente');
    }
}
