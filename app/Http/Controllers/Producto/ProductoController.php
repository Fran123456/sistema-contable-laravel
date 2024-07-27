<?php

namespace App\Http\Controllers\Producto;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Producto\ProProducto;
use App\Models\Producto\ProTipoProducto;
use App\Help\Producto\Identificador;
use App\Help\Help;
use App\Help\log;
use Illuminate\Support\Facades\DB;
use App\Models\Producto\ProCategoria;
use App\Models\Producto\ProductoCategoria;


class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productos = ProProducto::with('categorias')->orderBy('id', 'desc')->get();
        //$productos = ProProducto::orderBy('id', 'desc')->get();
        return view('producto.producto.index', compact('productos'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $codigoProducto = Identificador::identificador();
        $tipoProductos = ProTipoProducto::all();
        $categorias = ProCategoria::all();
        return view('producto.producto.create', compact('tipoProductos', 'codigoProducto', 'categorias'));
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
            'producto' => 'required|string|max:200',
            'codigo' => 'required|string|max:9|unique:pro_producto,codigo',
        ]);
        
      
        try {
            DB::beginTransaction();
            $producto = ProProducto::create([
                'producto' => $request->producto,
                'descripcion' => $request->descripcion,
                'codigo' => $request->codigo,
                'imagen' => $request->imagen,
                'tipo_producto_id' => $request->tipo_producto_id,
                'requiere_lote' => $request->requiere_lote,
                'requiere_vencimiento' => $request->requiere_vencimiento,
                'alerta_stock' => $request->alerta_stock,
                'activo' => $request->activo, 
            ]);
    
            if($request->hasFile('imagen')){
                $producto->imagen = Help::uploadFile($request, 'productos', '', 'imagen', $ramdonName = true);
            }

            $producto->save();
            Identificador::actualizarIdentificador();
            DB::commit();
            return to_route('producto.producto.index')->with('success', 'Producto creado correctamente ');

        } catch (Exception $e) {
            DB::rollback();
            Log::log('Producto', 'producto error al crear el producto', $e);
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
        $producto = ProProducto::find($id);
        $tipoProductos = ProTipoProducto::all();

        return view('producto.producto.show', compact('producto','tipoProductos'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $producto = ProProducto::find($id);
        
        //Categorias asociadas al producto
        $categoriaProducto = $producto->categorias;
        $tipoProductos = ProTipoProducto::all();

        //Todas las categorias 
        $categorias = ProCategoria::all();

        return view('producto.producto.edit', compact('producto','tipoProductos', 'categorias', 'categoriaProducto'));
        
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
            'producto' => 'required|string|max:200',
            'foto' => 'image|mimes:jpg,png,jpeg',
        ]);

        $producto = ProProducto::findOrFail($id);
        $url_imagen = $producto->imagen;

        if($request->hasFile('imagen')){
            $imagen = $request->file('imagen');
            $eliminar = 'productos/'.$producto->imagen;
            if (Storage::exists($eliminar)) {
                Storage::delete($eliminar);
            }
            $producto->imagen = Help::uploadFile($request, 'productos', '','imagen', $ramdonName = true);
        }
        
        $producto->update($request->all());
        
        //Verifica si la categoria no es duplicada
        if ($producto->categorias->contains($request->categoria)) {
            return redirect()->route('producto.producto.edit', $id)->with('danger', 'Categoria duplicada');
        }
        // Agrega las nuevas categorías asociadas al producto
        $producto->categorias()->syncWithoutDetaching($request->categoria);
        
        try {
            DB::beginTransaction();
            $producto = ProProducto::find($id);
            $url_imagen = $producto->imagen;
    
            if($request->hasFile('imagen')){
                $imagen = $request->file('imagen');
                $eliminar = 'cv/'.$producto->imagen;
                if (Storage::exists($eliminar)) {
                    Storage::delete($eliminar);
                }
                $producto->imagen = Help::uploadFile($request, 'productos', '','imagen', $ramdonName = true);
            }
    
            $producto->update($request->all());

            $producto->save();
            Log::log('Producto', "Editar producto",'El producto ' .  $producto->producto . " ".' ha sido actualizado por el usuario '. Help::usuario()->name);
            return to_route('producto.producto.edit', $id)->with('success', 'Producto actualizado correctamente');

        } catch (Exception $e) {
            DB::rollback();
            Log::log('Producto', 'Producto error al actualizar el producto', $e);
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
        $producto = ProProducto::find($id);
        $url = $producto->imagen == null ? ' ' : $producto->imagen;


        if(Storage::exists($url)){
            Storage::delete($url);
        }

        $producto->categorias()->detach();
        
        Log::log('Producto', "Eliminar prodcuto",'El producto' .  $producto->producto . " ". ' ha sido eliminado por el usuario '. Help::usuario()->name);
        $producto->delete();
        return to_route('producto.producto.index')->with('success','Se ha eliminado el producto correctamente');

    }

    // Elimina la categoria asociada a un producto
    public function eliminarCategoria($id, $categoriaId){
        $producto = ProProducto::find($id);
        $producto->categorias()->detach($categoriaId);
        return to_route('producto.producto.edit', $id)->with('success','Se ha eliminado la categoria correctamente');
    }
}
