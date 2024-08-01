<?php

namespace App\Http\Controllers\Facturacion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Facturacion\FactFacturacion;
use App\Models\Facturacion\FactTipoDocumento;
use App\Models\SociosdeNegocio\SociosCliente;


class FacturacionController extends Controller
{
    public function index()
    {
        $empresaId = Auth::user()->empresa_id;
        $facturaciones = FactFacturacion::where('empresa_id', $empresaId)->get();
        $clientes = SociosCliente::orderBy('id', 'desc')->get();
        $tiposDocumento = FactTipoDocumento::whereIn('id', [1, 2, 3, 5])->get();

        return view('facturacion.index', compact('facturaciones', 'clientes', 'tiposDocumento'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'cliente_id' => 'required|exists:socios_cliente,id',
            'tipo_documento_id' => 'required|exists:fact_tipo_documento,id',
        ]);

        $empresaId = Auth::user()->empresa_id;
        $creadoPor = Auth::id();

        $numFacturas = FactFacturacion::where('empresa_id', $empresaId)->count() + 1;
        $codigo = 'OV' . str_pad($numFacturas, 6, '0', STR_PAD_LEFT);

        $facturacion = FactFacturacion::create([
            'estado_id' => 1,
            'creado_por' => $creadoPor,
            'codigo' => $codigo,
            'monto_facturar' => 0,
            'monto_facturado' => 0,
            'fecha_facturacion' => null,
            'empresa_id' => $empresaId,
        ]);

        return redirect()->route('facturacion.index')->with('success', 'Factura creada exitosamente.');
    }
}