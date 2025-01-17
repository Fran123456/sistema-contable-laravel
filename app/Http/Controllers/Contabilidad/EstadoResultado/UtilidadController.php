<?php

namespace App\Http\Controllers\Contabilidad\EstadoResultado;

use App\Help\Help;
use App\Http\Controllers\Controller;
use App\Models\Contabilidad\ContaUtilidadRpt;
use Illuminate\Http\Request;

class UtilidadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $utilidades = ContaUtilidadRpt::orderBy('id', 'desc')->get();

        return view('contabilidad.estado_resultado.utilidad.index', compact('utilidades'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return redirect()->route('contabilidad.utilidades.index')->with('success', 'utilidad modificado correctamente ');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'utilidad'=> 'required|string|max:200',
        ]);

        if(Help::empresa()){
            $request->merge(["empresa_id" => Help::empresa()]);
        }else{
            return back()->with('danger', 'Error, no se puede procesar la petición');
        }

        $utilidad = (new ContaUtilidadRpt())->fill($request->all());
        try {
            $utilidad->save();

            return redirect()->route('contabilidad.utilidades.index')->with('success', 'utilidad creado correctamente ');

        } catch (Exception $e) {
            // Log::log('SociosdeNegocio', 'contacto error al crear el contacto', $e);
            return back()->with('danger', 'Error, no se puede procesar la petición');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $utilidad = ContaUtilidadRpt::findOrFail($id);
            return response()->json($utilidad);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $utilidad = ContaUtilidadRpt::find($id);

        return response()->json($utilidad);
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
        $request->validate([
            'utilidad'=> 'required|string|max:200',
        ]);
        try {
            $utilidad = ContaUtilidadRpt::findOrFail($id);
            $utilidad->update($request->all());
            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Utilidad actualizada correctamente.'
                ]);
            }
    
            return redirect()->route('contabilidad.utilidades.index')->with('success', 'Utilidad actualizada correctamente.');
        } catch (\Throwable $e) {
            return back()->with('danger', 'no se puede procesar la petición');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $utilidad = ContaUtilidadRpt::findOrFail($id);
            $utilidad->delete();
            return redirect()->route('contabilidad.utilidades.index')->with('success','Se ha eliminado utilidad correctamente');
        } catch (\Throwable $th) {
            return back()->with('danger', 'no se puede procesar la petición');
        }
    }

    public static function getUtilidadesByEmpresa() {
        return ContaUtilidadRpt::Where('empresa_id','=', Help::empresa())->get();
    }

    public static function getUtilidadById($id) {
        return ContaUtilidadRpt::find($id);
    }
}
