<?php

namespace App\Http\Controllers\Facturacion;

use App\Help\Log;
use App\Http\Controllers\Controller;
use App\Models\Facturacion\FactSerialDocumento;
use App\Models\Facturacion\FactTipoDocumento;
use Exception;
use Illuminate\Http\Request;

class SerialDocumentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $seriales = FactSerialDocumento::with('tipoDocumento')->get();
        $tiposDocumento = FactTipoDocumento::all(); // Asegúrate de tener el modelo TipoDocumento
        return view('Facturacion.SerialDocumento.index', compact('seriales', 'tiposDocumento'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validación
        $request->validate([
            'tipo_documento_id' => 'required',
            'serial' => 'required|string|max:255',
            'correlativo_inicial' => 'required|integer',
            'ultimo_correlativo' => 'required|integer',
            'activo' => 'required|boolean',
            'empresa_id' => 'required|integer',
        ]);

        // Crear el registro
        try {
            $serial = (new FactSerialDocumento)->fill($request->all());
            $serial->save();
            return redirect()->route('serial-facturacion.index')->with('success', 'Serial creado exitosamente.');
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
        $serial = FactSerialDocumento::findOrFail($id);
        $request->validate([
            'tipo_documento_id' => 'required',
            'serial' => 'required|string|max:255',
            'correlativo_inicial' => 'required|integer',
            'ultimo_correlativo' => 'required|integer',
            'activo' => 'required|boolean',
        ]);

        $serial->update($request->all());
        return redirect()->route('serial-facturacion.index')->with('success', 'Serial actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $serial = FactSerialDocumento::find($id);
        $serial->delete();
        FactSerialDocumento::destroy($id);
        return to_route('serial-facturacion.index')->with('success', 'Serial eliminado exitosamente.');
    }
}
