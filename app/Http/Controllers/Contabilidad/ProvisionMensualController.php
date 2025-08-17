<?php

namespace App\Http\Controllers\Contabilidad;

use Barryvdh\DomPDF\Facade\Pdf; // se requiere correr: composer require barryvdh/laravel-dompdf
use App\Http\Controllers\Controller;
use App\Models\Contabilidad\ProvisionMensual;
use App\Models\RRHH\RRHHEmpresa;
use App\Models\Configuracion\ConProvisionEmpresa;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ProvisionMensualController extends Controller
{
    // Acumula provisión para un mes dado
    public function acumular(Request $request)
    {
        $empresa_id = $request->empresa_id;
        $empleado_id = $request->empleado_id;
        $tipo_provision = $request->tipo_provision;
        $monto = $request->monto;
        $mes = $request->mes ?? Carbon::now()->startOfMonth();

        $provision = ProvisionMensual::updateOrCreate(
            [
                'empresa_id' => $empresa_id,
                'empleado_id' => $empleado_id,
                'tipo_provision' => $tipo_provision,
                'mes' => $mes,
            ],
            [
                'monto' => $monto,
            ]
        );

        return response()->json(['success' => true, 'provision' => $provision]);
    }

    // Reporte de pasivo laboral acumulado
    public function reporte(Request $request)
    {
        $empresa_id = $request->empresa_id;
        $tipo_provision = $request->tipo_provision;
        $hasta = $request->hasta ?? \Carbon\Carbon::now()->endOfMonth();

        $query = ProvisionMensual::query();
        if ($empresa_id) $query->where('empresa_id', $empresa_id);
        if ($tipo_provision) $query->where('tipo_provision', $tipo_provision);
        $query->where('mes', '<=', $hasta);

        $provisiones = $query->get();
        $total = $provisiones->sum('monto');

        // Obtener empresas y tipos de provisión para el modal
        $empresas = RRHHEmpresa::all();
        $tipos_provision = ConProvisionEmpresa::distinct()->pluck('tipo_provision');

        // Si el usuario solicita PDF
        if ($request->has('pdf')) {
            $pdf = Pdf::loadView('contabilidad.provisiones.reporte_pdf', [
                'provisiones' => $provisiones,
                'total' => $total,
                'empresas' => $empresas,
                'tipos_provision' => $tipos_provision,
            ]);
            return $pdf->download('reporte_provisiones.pdf');
        }

        return view('contabilidad.provisiones.reporte', compact('provisiones', 'total', 'empresas', 'tipos_provision'));
    }
}
