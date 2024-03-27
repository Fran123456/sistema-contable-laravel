<?php

namespace App\Http\Controllers\Producto;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Producto\ProCategoria;
use App\Models\Producto\ProductoCategoria;
use Maatwebsite\Excel\Facades\Excel;
use App\Help\Help;
class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = ProCategoria::where('empresa_id', Help::usuario()->empresa_i)->get();


        /*GENERAL PARA TITULO DE VISTA*/

        return view('producto.categoria.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        ProCategoria::create([
            'categoria' => $request->categoria,
            'empresa_id'=>Help::usuario()->empresa_id 
        ]);
        return back()->with('success', 'Se ha agregado la categoria correctamente');
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
        $productoCategoria = ProductoCategoria::where('categoria_id', $id)->get('id');

        //dd(count($productoCategoria));
       if (count($productoCategoria) > 0) {
            return back()->with('danger', 'Esta categoría tiene ' . count($productoCategoria) . ' productos asociados, y no se puede eliminar');
        }
        ProCategoria::destroy($id);
        return back()->with('danger', 'Se ha eliminado la categoria correctamente');
    }






}
