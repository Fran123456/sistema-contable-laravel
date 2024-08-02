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
        // dd(request()->all());
        $validate = $request->validate([
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

        // $data = $request->all();
        // $data['empresa_id'] = Auth::user()->empresa_id;
        // LibroCompra::create($validate);
        // return redirect()->route('iva.libro_compras.index')->with('success', 'Libro de compra creado exitosamente.');
        $libroCompra = (new LibroCompra)->fill($request->all());
        $libroCompra->save();
        return to_route('iva.libro_compras.index')->with('success', 'Libro de compra creado exitosamente ');
        try {
        } catch (Exception $e) {
            Log::log('LibroCompra', 'contacto error al crear el libro compra', $e);
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
        //
        $libroCompra = LibroCompra::find($id);
        return view('libro_compras.show', compact('libroCompra'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //dd($id);
        $libroCompra = LibroCompra::find($id);
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
    public function update(Request $request, $id)
    {
        // dd($request->all());

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


        $libroCompra = LibroCompra::find($id);

        $libroCompra->fecha_emision = $request->fecha_emision;
        $libroCompra->fecha_emision_en_pdf = $request->fecha_emision_en_pdf;
        $libroCompra->documento = $request->documento;
        $libroCompra->proveedor_id = $request->proveedor_id;
        $libroCompra->excentas_internas = $request->excentas_internas;
        $libroCompra->excentas_importaciones = $request->excentas_importaciones;
        $libroCompra->gravadas_internas = $request->gravadas_internas;
        $libroCompra->gravadas_importaciones = $request->gravadas_importaciones;
        $libroCompra->gravada_iva = $request->gravada_iva;
        $libroCompra->contribucion_especial = $request->contribucion_especial;
        $libroCompra->anticipo_iva_retenido = $request->anticipo_iva_retenido;
        $libroCompra->anticipo_iva_recibido = $request->anticipo_iva_recibido;
        $libroCompra->total_compra = $request->total_compra;
        $libroCompra->compras_excluidas = $request->compras_excluidas;
        $libroCompra->mostrar = $request->mostrar;

        try {
            $libroCompra->save();
            return to_route('iva.libro_compras.index')->with('success', 'Libro de compra actualizado exitosamente.');
        } catch (Exception $e) {
            Log::log('librocompra', 'contacto error al actualizar el contacto', $e);
            return back()->with('danger', 'Error, no se puede procesar la petición');
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
        //parametro: LibroCompra $libroCompra
        $libroCompra = LibroCompra::find($id);
        
        $libroCompra->delete();
        LibroCompra::destroy($id);
        return to_route('iva.libro_compras.index')->with('success', 'Libro de compra eliminado exitosamente.');
    }
}
