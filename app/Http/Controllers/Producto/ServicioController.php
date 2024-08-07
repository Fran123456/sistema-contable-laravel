<?php

namespace App\Http\Controllers\Producto;

use App\Help\Help;
use App\Http\Controllers\Controller;
use App\Models\Contabilidad\ContaCuentaContable;
use App\Models\Producto\Servicio;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ServicioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $servicios = Servicio::orderBy('id','desc')->get();

        return view('producto.servicio.index', compact('servicios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $empresa = Help::empresa();
        $cuentas  = ContaCuentaContable::cuentasDetalle($empresa);

        return view('producto.servicio.create', compact('cuentas','empresa'));
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
            'codigo' => 'required|string|unique:pro_servicios',
            'nombre' => 'required|string',
            'cuenta_contable_ingreso' => 'nullable|string',
            'cuenta_contable_costo' => 'nullable|string',
            'cuenta_contable_ingreso_exterior' => 'nullable|string',
            'cuenta_contable_costo_exterior' => 'nullable|string',

        ]);

        $servicio = (new Servicio())->fill($request->all());

        try {
            $servicio->save();

            return redirect()->route('producto.servicio.index')->with('success', 'Servicio creado correctamente ');
        } catch (Exception $e) {
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
        $servicio = Servicio::find($id);
        $empresa = Help::empresa();
        $cuentas  = ContaCuentaContable::cuentasDetalle($empresa);

        return view('producto.servicio.show', compact('servicio', 'cuentas'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $servicio = Servicio::find($id);
        $empresa = Help::empresa();
        $cuentas  = ContaCuentaContable::cuentasDetalle($empresa);

        return view('producto.servicio.edit', compact('servicio', 'cuentas'));
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
        $servicio = Servicio::find($id);

        $request->validate([
            'codigo' => [
            'required',
            'string',
            Rule::unique('servicios')->ignore($servicio->id),
            ],
            'nombre' => 'required|string',
            'cuenta_contable_ingreso' => 'nullable|string',
            'cuenta_contable_costo' => 'nullable|string',
            'cuenta_contable_ingreso_exterior' => 'nullable|string',
            'cuenta_contable_costo_exterior' => 'nullable|string',
        ]);

        $servicio->codigo = $request->codigo;
        $servicio->nombre = $servicio->nombre;
        $servicio->cuenta_contable_ingreso = $request->cuenta_contable_ingreso;
        $servicio->cuenta_contable_costo = $request->cuenta_contable_costo;
        $servicio->cuenta_contable_ingreso_exterior = $request->cuenta_contable_ingreso_exterior;
        $servicio->cuenta_contable_costo_exterior = $request->cuenta_contable_costo_exterior;

        try {
            $servicio->save();

            return redirect()->route('producto.servicio.index')->with('success', 'Servicio actualizado correctamente');
        } catch (Exception $e) {
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
        try {
            $servicio = Servicio::findOrFail($id);
            $servicio->delete();
            return redirect()->route('producto.servicio.index')->with('success','Se ha eliminado el servicio correctamente');
        } catch (Exception $e) {
            return back()->with('danger', 'Error, no se puede procesar la petición');
        }
    }
     
}
