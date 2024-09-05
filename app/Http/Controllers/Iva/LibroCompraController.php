<?php

namespace App\Http\Controllers\Iva;

use Illuminate\Http\Request;
use App\Models\Iva\LibroCompra;
use App\Models\RRHH\RRHHEmpresa;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Facturacion\FactFacturacion;
use App\Models\Contabilidad\ContaDetallePartida;
use App\Models\Contabilidad\ContaPartidaContable;
use App\Models\SociosdeNegocio\SociosProveedores;

class LibroCompraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
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
        $usuario = auth()->user();
        $proveedores = SociosProveedores::all();
        $empresas = RRHHEmpresa::all();
       
       
        return view('iva.libroCompra.create', compact('proveedores', 'empresas'));
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
            'fecha_emision' => 'required|date',
            'fecha_emision_en_pdf' => 'required|date',
            'documento' => 'required|string|max:255',
            'proveedor_id' => 'nullable|exists:socios_proveedores,id',
            'mostrar' => 'required|boolean'
        ]);
        

        try {
            $libroCompra = (new LibroCompra)->fill($request->all());
            $libroCompra->save();
            $p =  SociosProveedores::find($request->proveedor_id);
            $libroCompra->dui = $p->dui;
            $libroCompra->nit = $p->nit;
            $libroCompra->nrc = $p->nrc;
            $libroCompra->save();

            return to_route('iva.libro_compras.index')->with('success', 'Libro de compra creado exitosamente ');
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
        $libroCompra = LibroCompra::find($id);
        $proveedores = SociosProveedores::all();
        $facturas = FactFacturacion::all();
        $partidas = ContaPartidaContable::all();
        $detPartidas = ContaDetallePartida::all(); 
        return view('iva.libroCompra.edit', compact('libroCompra', 'proveedores', 'facturas', 'partidas', 'detPartidas'));
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
            'fecha_emision' => 'required|date',
            'fecha_emision_en_pdf' => 'required|date',
            'documento' => 'required|string|max:255',
            'proveedor_id' => 'nullable|exists:socios_proveedores,id',
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
        $libroCompra->documento_id = $request->documento_id;
        $libroCompra->partida_id = $request->partida_id;
        $libroCompra->detalle_partida_id = $request->detalle_partida_id;
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
        $libroCompra = LibroCompra::find($id);
        
        $libroCompra->delete();
        LibroCompra::destroy($id);
        return to_route('iva.libro_compras.index')->with('success', 'Libro de compra eliminado exitosamente.');
    }
}
