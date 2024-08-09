<?php

namespace App\Http\Controllers\Producto;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Producto\ProCombo;
use App\Models\Producto\ProTipoPrecio;
use App\Models\Producto\ProComboTipoPrecio;
use App\Models\Producto\ProProducto;
use App\Models\Producto\ProComboProducto;
use App\Models\Producto\ProProductoTipoPrecio;



class ComboController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $combos = ProCombo::with('productos')->get();
        return view('producto.combo.index', compact('combos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        

        return view('producto.combo.add');
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
            'combo' => 'required|string|max:255',
            'precio' => 'required|numeric',
            'estado' => 'required|boolean',
            'codigo' => 'required|string|max:255',
        ]);

        // Normalizar el código del combo
        $codigoExistente = preg_replace('/\s+/', '', strtolower($request->codigo));

        // Verificar si el código normalizado ya existe
        $exists = ProCombo::whereRaw('LOWER(REPLACE(codigo, " ", "")) = ?', [$codigoExistente])->exists();

        if ($exists) {
            return redirect()->back()->with('danger', 'El código del combo ya existe.');
        }

        try {
            DB::beginTransaction();

            $combo = ProCombo::create([
                'combo' => $request->combo,
                'precio' => $request->precio,
                'estado' => $request->estado,
                'codigo' => $request->codigo,
            ]);

            DB::commit();

            return redirect()->route('producto.combo.edit', ['combo' => $combo->id])->with('success', 'Combo creado exitosamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('producto.combo.create')->with('danger', 'Error al crear el combo. Por favor, inténtalo de nuevo.');
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
        return 2;
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $combo = ProCombo::findOrFail($id);
        $tiposPrecios = ProTipoPrecio::all();
        $productos = ProProducto::all();
        $codigo_producto = '';
        $codigo_producto = '';
        $tiposPreciosAsociados = [];
        $precio_venta = null;

        if ($request->has('producto_id')) {
            $productoSeleccionado = ProProducto::find($request->input('producto_id'));
            if ($productoSeleccionado) {
                $codigo_producto = $productoSeleccionado->codigo;
                $tiposPreciosAsociados = ProProductoTipoPrecio::where('producto_id', $productoSeleccionado->id)->with('tipoPrecio')->get();
                
                if ($request->has('tipo_precio')) {
                    $tipoPrecioSeleccionado = $tiposPreciosAsociados->firstWhere('tipo_precio_id', $request->input('tipo_precio'));
                    if ($tipoPrecioSeleccionado) {
                        $precio_venta = $tipoPrecioSeleccionado->precio;
                    }
                }
            }
        }

        return view('producto.combo.edit', compact('combo', 'tiposPrecios', 'productos', 'codigo_producto', 'tiposPreciosAsociados', 'precio_venta'));
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
            'combo' => 'required|string|max:255',
            'precio' => 'required|numeric',
            'estado' => 'required|boolean',
            'codigo' => 'required|string|max:255|unique:pro_combo,codigo,' . $id,
        ]);
    
        try {
            DB::beginTransaction();
    
            $combo = ProCombo::findOrFail($id);
            $combo->update([
                'combo' => $request->combo,
                'precio' => $request->precio,
                'estado' => $request->estado,
                'codigo' => $request->codigo,
            ]);
    
            DB::commit();
    
            return redirect()->route('producto.combo.edit', ['combo' => $combo->id])->with('success', 'Combo actualizado exitosamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('producto.combo.edit', ['combo' => $combo->id])->with('danger', 'Error al actualizar el combo. Por favor, inténtalo de nuevo.');
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
            DB::beginTransaction();

            $combo = ProCombo::findOrFail($id);

            // Eliminar tipos de precio asociados
            ProComboTipoPrecio::where('combo_id', $combo->id)->delete();

            // Eliminar productos asociados
            ProComboProducto::where('combo_id', $combo->id)->delete();

            // Eliminar el combo
            $combo->delete();

            DB::commit();

            return redirect()->route('producto.combo.index')->with('success', 'Combo eliminado correctamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('producto.combo.index')->with('danger', 'Error al eliminar el combo: ' . $e->getMessage());
        }
    }



    public function storeComboTipoPrecio(Request $request, $id)
    {
        $request->validate([
            'tipo_precio_id' => 'required|exists:pro_tipo_precio,id',
            'precio' => 'required|numeric',
        ]);
    
        // Verificar si el tipo de precio ya está agregado
        $exists = ProComboTipoPrecio::where('combo_id', $id)
                    ->where('tipo_precio_id', $request->tipo_precio_id)
                    ->exists();
    
        if ($exists) {
            return redirect()->route('producto.combo.edit', $id)->with('danger', 'El tipo de precio ya está agregado.');
        }
    
        ProComboTipoPrecio::create([
            'combo_id' => $id,
            'tipo_precio_id' => $request->tipo_precio_id,
            'precio' => $request->precio,
            'precio_venta' => 0,
            'estado' => true,
        ]);
    
        return redirect()->route('producto.combo.edit', $id)->with('success', 'Tipo de precio añadido correctamente.');
    }

    public function updateEstadoComboTipoPrecio(Request $request, $id)
    {
        $comboTipoPrecio = ProComboTipoPrecio::findOrFail($id);
        $comboTipoPrecio->estado = $request->estado;
        $comboTipoPrecio->save();

        return redirect()->route('producto.combo.edit', $comboTipoPrecio->combo_id)->with('success', 'Estado actualizado correctamente.');
    }

    public function destroyComboTipoPrecio($id)
    {
        $comboTipoPrecio = ProComboTipoPrecio::findOrFail($id);
        $combo_id = $comboTipoPrecio->combo_id;
        $comboTipoPrecio->delete();

        return redirect()->route('producto.combo.edit', $combo_id)->with('success', 'Tipo de precio eliminado correctamente.');
    }

    public function storeComboProducto(Request $request, $id)
    {
        $request->validate([
            'producto_id' => 'required|exists:pro_producto,id',
            'precio_venta' => 'required|numeric',
            'cantidad' => 'required|integer|min:1',
        ]);
    
        // Verificar si el producto ya está agregado
        $exists = ProComboProducto::where('combo_id', $id)
                    ->where('producto_id', $request->producto_id)
                    ->exists();
    
        if ($exists) {
            return redirect()->route('producto.combo.edit', $id)->with('danger', 'El producto ya está agregado.');
        }
    
        ProComboProducto::create([
            'combo_id' => $id,
            'producto_id' => $request->producto_id,
            'precio' => 0,
            'precio_venta' => $request->precio_venta,
            'cantidad' => $request->cantidad,
        ]);
    
        return redirect()->route('producto.combo.edit', $id)->with('success', 'Producto añadido correctamente.');
    }

    public function destroyComboProducto($id)
    {
        $comboProducto = ProComboProducto::findOrFail($id);
        $combo_id = $comboProducto->combo_id;
        $comboProducto->delete();

        return redirect()->route('producto.combo.edit', $combo_id)->with('success', 'Producto eliminado correctamente.');
    }
    public function getTiposPrecios($productoId)
    {
        $tiposPrecios = ProProductoTipoPrecio::where('producto_id', $productoId)->with('tipoPrecio')->get();
        return response()->json($tiposPrecios);
    }

}
