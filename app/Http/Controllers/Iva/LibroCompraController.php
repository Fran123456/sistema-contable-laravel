<?php

namespace App\Http\Controllers\Iva;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Iva\LibroCompra;
use App\Models\SociosdeNegocio\SociosProveedores;
use Illuminate\Http\Request;

class LibroCompraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        // $proveedores = SociosProveedores::all();

        $libro_compras = LibroCompra::with('proveedor')->orderBy('id', 'desc')->get();
        return view('iva.libroCompra.index', compact('libro_compras'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $proveedores = SociosProveedores::all();
        return view('iva.libroCompra.create', compact('proveedores'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'fecha_emision' => 'required|date',
            'fecha_emision_en_pdf' => 'required|date',
            'documento' => 'required|string|max:255',
            'proveedor_id' => 'nullable|exists:socios_proveedores,id',
            'excentas_internas' => 'nullable|numeric',
            'excentas_importaciones' => 'nullable|numeric',
            'gravadas_internas' => 'nullable|numeric',
            'gravadas_importaciones' => 'nullable|numeric',
            'gravada_iva' => 'nullable|numeric',
            'contribucion_especial' => 'nullable|numeric',
            'anticipo_iva_retenido' => 'nullable|numeric',
            'anticipo_iva_recibido' => 'nullable|numeric',
            'total_compra' => 'nullable|numeric',
            'compras_excluidas' => 'nullable|numeric',
            'mostrar' => 'required|boolean',
        ]);

        $data = $request->all();
        $data['empresa_id'] = Auth::user()->empresa_id;

        LibroCompra::create($data);

        return redirect()->route('iva.libro_compras.index')->with('success', 'Libro de compra creado exitosamente.');
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
        // return view('libro_compras.show', compact('libroCompra'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(LibroCompra $libroCompra)
    {
        //
        $proveedores = SociosProveedores::all();
        return view('iva.libroCompra.edit', compact('libroCompra', 'proveedores'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LibroCompra $libroCompra)
    {
        $request->validate([
            'fecha_emision' => 'required|date',
            'fecha_emision_en_pdf' => 'required|date',
            'documento' => 'required|string|max:255',
            'proveedor_id' => 'nullable|exists:socios_proveedores,id',
            'excentas_internas' => 'nullable|numeric',
            'excentas_importaciones' => 'nullable|numeric',
            'gravadas_internas' => 'nullable|numeric',
            'gravadas_importaciones' => 'nullable|numeric',
            'gravada_iva' => 'nullable|numeric',
            'contribucion_especial' => 'nullable|numeric',
            'anticipo_iva_retenido' => 'nullable|numeric',
            'anticipo_iva_recibido' => 'nullable|numeric',
            'total_compra' => 'nullable|numeric',
            'compras_excluidas' => 'nullable|numeric',
            'mostrar' => 'required|boolean',
        ]);

        $libroCompra->update($request->all());

        return redirect()->route('iva.libro_compras.index')->with('success', 'Libro de compra actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(LibroCompra $libroCompra)
    {
        //parametro: LibroCompra $libroCompra
        $libroCompra->delete();

        return redirect()->route('iva.libro_compras.index')->with('success', 'Libro de compra eliminado exitosamente.');
    }
}
