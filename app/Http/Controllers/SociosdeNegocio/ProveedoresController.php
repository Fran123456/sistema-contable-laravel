<?php

namespace App\Http\Controllers\SociosdeNegocio;

use App\Http\Controllers\Controller;
use App\Models\SociosdeNegocio\SociosProveedores;
use App\Help\Catalogo\TipoPersonalidad;
use App\Help\Catalogo\TipoProveedor;
use App\Models\EntidadTerritorial\EntPais;
use Illuminate\Http\Request;
use App\Help\Log;
use App\Help\Help;
use App\Models\Producto\ProProducto;
use App\Models\Producto\ProProductoProveedor;

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
        return view('SociosdeNegocio.Proveedores.index', compact('proveedores'));
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
        $pais = EntPais::all();
        return view('SociosdeNegocio.Proveedores.create', compact('tipoProveedor', 'tipoPersonalidad', 'pais'));
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
            'nombre' => 'required|string|max:200',
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
        $pais = EntPais::all();
        return view('SociosdeNegocio.Proveedores.show', compact('tipoProveedor', 'tipoPersonalidad', 'proveedor', 'pais'));
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
        $pais = EntPais::all();
        return view('SociosdeNegocio.Proveedores.edit', compact('proveedor', 'tipoPersonalidad', 'tipoProveedor', 'pais'));
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
            'nombre' => 'required|string|max:200',
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
        $proveedor->pais_id = $request->pais_id;

        try {
            $proveedor->save();
            Log::log('SociosdeNegocio', "Editar proveedor", 'El proveedor ' . $proveedor->nombre . " " . ' ha sido actualizado por el usuario ' . Help::usuario()->name);
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
        Log::log('SociosdeNegocio', "Eliminar proveedor", 'El proveedor ' . $proveedor->nombre . " " . ' ha sido eliminado por el usuario ' . Help::usuario()->name);
        $proveedor->delete();
        return to_route('socios.proveedores.index')->with('success', 'Se ha eliminado el proveedor correctamente');

    }

    public function deshabilitarProveedor($id)
    {
        $proveedor = SociosProveedores::find($id);
        $proveedor->activo = false;

        Log::log('SociosdeNegocio', "Deshabilitar proveedor", 'El proveedor ' . $proveedor->nombre . ' ha sido deshabilitado por el usuario ' . Help::usuario()->name);
        $proveedor->save();
        return to_route('socios.proveedores.index')->with('success', 'Se ha deshabilitado el proveedor correctamente');
    }

    public function habilitarProveedor($id)
    {
        $proveedor = SociosProveedores::find($id);
        $proveedor->activo = true;

        Log::log('SociosdeNegocio', "Habilitar proveedor", 'El proveedor ' . $proveedor->nombre . ' ha sido habilitado por el usuario ' . Help::usuario()->name);
        $proveedor->save();
        return to_route('socios.proveedores.index')->with('success', 'Se ha habilitado el proveedor correctamente');
    }

    public function listarProductos($id)
    {
        $productoProveedor = ProProductoProveedor::where('proveedor_id', $id)->get();
        $productos = ProProducto::all();
        $idProveedor = $id;
        return view('sociosdenegocio.proveedores.producto', compact('productoProveedor', 'productos', 'idProveedor'));
    }

    public function viewFormProveedor($id)
    {
        $productoProveedor = ProProductoProveedor::where('proveedor_id', $id)->get();
        $productos = ProProducto::all();
        $idProveedor = $id;
        return view('sociosdenegocio.proveedores.formProveedor', compact('productoProveedor', 'productos', 'idProveedor'));
    }

    public function updateFormProveedor(Request $request, $id)
    {

        $request->validate([
            'precio_unitario' => 'required|numeric',
            'stock' => 'required'
        ]);

        $proveedor = ProProductoProveedor::find($id);
        $proveedor->update($request->all());

        try {
            $proveedor->save();
            Log::log('ProductoProveedor', "Editar proveedor", 'El proveedor ' . $proveedor->nombre . " " . ' ha sido actualizado por el usuario ' . Help::usuario()->name);
            return back()->with('success', 'Datos guardados exitosamente');


        } catch (Exception $e) {
            Log::log('ProductoProveedor', 'Proveedor error al actualizar el proveedor', $e);
            return back()->with('danger', 'Error, no se puede procesar la petición');
        }

    }
}