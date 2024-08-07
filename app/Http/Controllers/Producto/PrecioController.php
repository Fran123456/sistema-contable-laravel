<?php

namespace App\Http\Controllers\Producto;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Producto\ProTipoPrecio;


class PrecioController extends Controller{

    public function index()
    {
        $tiposPrecios = ProTipoPrecio::all();
        return view('producto.precio.index', compact('tiposPrecios'));
    }

    // Metodo para agregar un tipo de precio
    public function store(Request $request)
    {
        $request->validate([
            'tipo' => 'required|string|max:50',
        ]);

        ProTipoPrecio::create($request->all());

        return redirect()->route('producto.precio.index')->with('success', 'Tipo de precio creado exitosamente.');

    }

    // Metodo para Eliminar un tipo de precio
    public function destroy($id)
    {
        ProTipoPrecio::destroy($id);

        return redirect()->route('producto.precio.index')->with('success', 'Tipo de precio eliminado con éxito.');
    }
}


