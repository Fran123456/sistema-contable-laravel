<?php

namespace App\Http\Controllers\SociosdeNegocio;

use App\Http\Controllers\Controller;
use App\Models\SociosdeNegocio\SociosProveedores;
use App\TipoPersonalidad\TipoPersonalidad;
use App\TipoProveedor\TipoProveedor;
use Illuminate\Http\Request;
use App\Help\Log;
use App\Help\Help;


class ProveedoresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $proveedores = SociosProveedores::all();
        return view('sociosdenegocio.proveedores.index', compact('proveedores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Usa el helper que envía un array con el tipo de proveedor y tipo de personalidad
        $tipoProveedor = TipoProveedor::proveedor(); 
        $tipoPersonalidad = TipoPersonalidad::personalidad();
        return view('sociosdenegocio.proveedores.create', compact('tipoProveedor', 'tipoPersonalidad'));
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
            'nombre'=> 'required|string|max:200',
            'tipo_proveedor' => 'required|string',
            'tipo_personalidad' => 'required|string',
            'giro' => 'required|string|max:200',
            'forma_pago' => 'required|string',
            'numero_registro' => 'required|string',
            'nit' => 'required',
            'telefono' => 'required|string|max:8',
            'direccion' => 'required|string|max:200',
        ]);

        $proveedor = SociosProveedores::create($request->all());
        try {
            $proveedor->save();
            return to_route('socios.proveedores.index')->with('success', 'Proveedor creado correctamente ');

        } catch (Exception $e) {
            Log::log('SociosdeNegocio', 'proveedor error al crear el proveedor', $e);
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
        $tipoProveedor = TipoProveedor::proveedor(); 
        $tipoPersonalidad = TipoPersonalidad::personalidad();
        $proveedor = SociosProveedores::find($id);
        return view('sociosdenegocio.proveedores.show', compact('tipoProveedor', 'tipoPersonalidad', 'proveedor'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $proveedor = SociosProveedores::find($id);
        $tipoProveedor = TipoProveedor::proveedor(); 
        $tipoPersonalidad = TipoPersonalidad::personalidad();
        return view('sociosdenegocio.proveedores.edit', compact('proveedor', 'tipoPersonalidad', 'tipoProveedor'));
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
            'nombre'=> 'required|string|max:200',
            'tipo_proveedor' => 'required|string',
            'tipo_personalidad' => 'required|string',
            'giro' => 'required|string|max:200',
            'forma_pago' => 'required|string',
            'numero_registro' => 'required|string',
            'nit' => 'required',
            'telefono' => 'required|string|max:8',
            'direccion' => 'required|string|max:200',
        ]);

        $proveedor = SociosProveedores::find($id);
        $proveedor->nombre = $request->nombre;
        $proveedor->tipo_proveedor = $request->tipo_proveedor;
        $proveedor->tipo_personalidad = $request->tipo_personalidad;
        $proveedor->giro = $request->giro;
        $proveedor->forma_pago = $request->forma_pago;
        $proveedor->numero_registro = $request->numero_registro;
        $proveedor->nit = $request->nit;
        $proveedor->telefono = $request->telefono;
        $proveedor->direccion = $request->direccion;
        $proveedor->celular = $request->celular;
        $proveedor->correo = $request->correo;
        $proveedor->pais = $request->pais;

        try {
            $proveedor->save();
            Log::log('SociosdeNegocio', "Editar proveedor",'El proveedor ' .  $proveedor->nombre . " ".' ha sido actualizado por el usuario '. Help::usuario()->name);
            return to_route('socios.proveedores.index')->with('success', 'Proveedor actualizado correctamente');

        } catch (Exception $e) {
            Log::log('SociosdeNegocio', 'Proveedor error al actualizar el proveedor', $e);
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
        $proveedor = SociosProveedores::find($id);
        Log::log('SociosdeNegocio', "Eliminar proveedor",'El proveedor ' .  $proveedor->nombre . " ".' ha sido eliminado por el usuario '. Help::usuario()->name);
        $proveedor->delete();
        return to_route('socios.proveedores.index')->with('success','Se ha eliminado el proveedor correctamente');

    }
}
