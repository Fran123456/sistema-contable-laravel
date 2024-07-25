<?php

namespace App\Http\Controllers\Producto;

use App\Http\Controllers\Controller;
use App\Models\Producto\ProProducto;
use App\Models\Producto\ProProductoProveedor;
use App\Models\SociosdeNegocio\SociosProveedores;
use Illuminate\Http\Request;
use App\Help\log;
use App\Help\Help;


class ProductoProveedorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productoProveedor = ProProducto::with('proveedores')->get();
        return view('producto.producto_proveedor.index', compact('productoProveedor'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $productos = ProProducto::all();
        $proveedores = SociosProveedores::where('activo', true)->get();
        return view('producto.producto_proveedor.create', compact('productos', 'proveedores'));
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
            'producto_id' => 'required',
            'proveedor_id' => 'required',
            'precio_unitario' => 'required',
            'stock' => 'required'
        ]);

        $data = ProProducto::find($request->producto_id);
        if ($request->codigo == null || $request->producto == null) {
            $proveedor = ProProductoProveedor::create([
                'codigo' => $request->codigo ?? $data->codigo,
                'producto_id' => $request->producto_id,
                'proveedor_id' => $request->proveedor_id,
                'precio_unitario' => $request->precio_unitario,
                'stock' => $request->stock,
                'producto' => $request->producto ?? $data->producto,
                'proveedor' => $request->proveedor,
            ]);
        } else {
            $proveedor = ProProductoProveedor::create($request->all());
        }

        try {
            $proveedor->save();
            return back()->with('success', 'Producto asociado correctamente');

        } catch (Exception $e) {
            Log::log('Producto', 'producto error al asociar el producto a proveedor', $e);
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
        $productoProveedor = ProProductoProveedor::find($id);
        $productos = ProProducto::all();
        $proveedores = SociosProveedores::where('activo', true)->get();

        return view('producto.producto_proveedor.edit', compact('productoProveedor', 'productos', 'proveedores'));
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
            'producto_id' => 'required',
            'proveedor_id' => 'required',
            'precio_unitario' => 'required|numeric',
            'stock' => 'required'
        ]);
        $proveedor = ProProductoProveedor::find($id);
        $proveedor->update($request->all());

        try {
            $proveedor->save();
            Log::log('ProductoProveedor', "Editar proveedor", 'El proveedor ' . $proveedor->nombre . " " . ' ha sido actualizado por el usuario ' . Help::usuario()->name);
            return to_route('producto.producto_proveedor.index')->with('success', 'Proveedor actualizado correctamente');

        } catch (Exception $e) {
            Log::log('ProductoProveedor', 'Proveedor error al actualizar el proveedor', $e);
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
        $proveedor = ProProductoProveedor::find($id);

        Log::log('Producto', "Eliminar proveedor", 'El proveedor' . $proveedor->nombre . " " . ' ha sido eliminado por el usuario ' . Help::usuario()->name);
        $proveedor->delete();
        return to_route('producto.producto_proveedor.index')->with('success', 'Se ha eliminado el proveedor correctamente');
    }
}