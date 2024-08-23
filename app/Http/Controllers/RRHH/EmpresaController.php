<?php

namespace App\Http\Controllers\RRHH;

use App\Help\Help;
use App\Help\Log;
use App\Http\Controllers\Controller;
use App\Models\RRHH\RRHHEmpresa;
use App\Models\Config;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmpresaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $empresas = RRHHEmpresa::all();
        return view('RRHH.empresa.index', compact('empresas'));
    }

    public function cambioEmpresa(Request $request, $id)
    {
        $user = User::find($id);
        $user->empresa_id = $request->empresa;

        Log::log('RRHH', 'cambio de empresa', 'El usuario ' . Help::usuario()->name . ' ha cambiado a la empresa ' . $user->empresa->empresa);

        $user->save();
        return back()->with('success', 'Se ha cambiado la empresa correctamente');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('RRHH.empresa.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $empresa = RRHHEmpresa::create(
                [
                    'empresa' => $request->empresa,
                    'actualizada' => true,
                    'abreviatura' => $request->abreviatura,
                    'nrc' => $request->nrc,
                    'nit' => $request->nit,
                    'razon_social' => $request->razon_social
                ]
            );

            $data = [
                ['cuenta_id' => 893, 'codigo' => '51', 'nombre_cuenta' => 'INGRESOS POR ACTIVIDADES ORDINARIAS', 'balance' => 'balance', 'grupo' => 'Ingresos por actividades ordinarias', 'mayor' => 1, 'orden' => 1, 'anexo' => null, 'cantidad' => null, 'underline' => 0, 'created_at' => '2024-04-10 17:28:36', 'updated_at' => '2023-03-24 21:03:19', 'espacio' => 1, 'bold' => 1, 'editar' => 1, 'empresa_id' => $empresa->id],
                ['cuenta_id' => 894, 'codigo' => '5101', 'nombre_cuenta' => 'INGRESOS POR SERVICIOS', 'balance' => 'balance', 'grupo' => 'Ingresos por actividades ordinarias', 'mayor' => 0, 'orden' => 1, 'anexo' => null, 'cantidad' => null, 'underline' => 0, 'created_at' => '2024-04-10 17:28:38', 'updated_at' => '2023-03-24 21:03:19', 'espacio' => 1, 'bold' => 0, 'editar' => 1, 'empresa_id' => $empresa->id],
                ['cuenta_id' => 651, 'codigo' => '5102', 'nombre_cuenta' => 'INGRESOS POR VENTA DE PRODUCTOS', 'balance' => 'balance', 'grupo' => 'Ingresos por actividades ordinarias', 'mayor' => 0, 'orden' => 1, 'anexo' => null, 'cantidad' => null, 'underline' => 0, 'created_at' => '2024-04-10 17:28:40', 'updated_at' => '2023-03-24 21:03:19', 'espacio' => 1, 'bold' => 0, 'editar' => 1, 'empresa_id' => $empresa->id],
                ['cuenta_id' => 651, 'codigo' => null, 'nombre_cuenta' => null, 'balance' => 'balance', 'grupo' => 'Ingresos por actividades ordinarias', 'mayor' => 0, 'orden' => 1, 'anexo' => null, 'cantidad' => null, 'underline' => 0, 'created_at' => '2024-04-10 17:29:02', 'updated_at' => '2023-03-24 21:03:19', 'espacio' => 1, 'bold' => 0, 'editar' => 0, 'empresa_id' => $empresa->id],
                ['cuenta_id' => 651, 'codigo' => null, 'nombre_cuenta' => null, 'balance' => 'balance', 'grupo' => 'Ingresos por actividades ordinarias', 'mayor' => 0, 'orden' => 1, 'anexo' => null, 'cantidad' => null, 'underline' => 0, 'created_at' => '2024-04-10 17:29:04', 'updated_at' => '2023-03-24 21:03:19', 'espacio' => 1, 'bold' => 0, 'editar' => 0, 'empresa_id' => $empresa->id],
                ['cuenta_id' => 896, 'codigo' => '52', 'nombre_cuenta' => 'INGRESOS NO ORDINARIOS', 'balance' => 'balance', 'grupo' => 'Otros Ingresos', 'mayor' => 1, 'orden' => 2, 'anexo' => null, 'cantidad' => null, 'underline' => 0, 'created_at' => '2024-04-10 17:28:45', 'updated_at' => '2023-03-24 21:03:19', 'espacio' => 1, 'bold' => 1, 'editar' => 1, 'empresa_id' => $empresa->id],
                ['cuenta_id' => 697, 'codigo' => '5201', 'nombre_cuenta' => 'OTROS INGRESOS', 'balance' => 'balance', 'grupo' => 'Otros Ingresos', 'mayor' => 0, 'orden' => 2, 'anexo' => null, 'cantidad' => null, 'underline' => 0, 'created_at' => '2024-04-10 17:28:46', 'updated_at' => '2023-03-24 21:03:19', 'espacio' => 1, 'bold' => 0, 'editar' => 1, 'empresa_id' => $empresa->id],
                ['cuenta_id' => null, 'codigo' => null, 'nombre_cuenta' => null, 'balance' => 'balance', 'grupo' => 'VENTAS NETAS', 'mayor' => 2, 'orden' => 3, 'anexo' => '1+2', 'cantidad' => null, 'underline' => 0, 'created_at' => '2024-04-10 17:29:08', 'updated_at' => '2023-03-24 21:03:19', 'espacio' => 1, 'bold' => 0, 'editar' => 0, 'empresa_id' => $empresa->id],
                ['cuenta_id' => 691, 'codigo' => '41', 'nombre_cuenta' => 'COSTOS Y GASTOS POR ACTIVIDADES ORDINARIAS', 'balance' => 'balance', 'grupo' => 'Costos de lo Vendidos por Servicios', 'mayor' => 1, 'orden' => 4, 'anexo' => null, 'cantidad' => null, 'underline' => 0, 'created_at' => '2024-04-10 17:28:49', 'updated_at' => '2023-03-24 21:03:19', 'espacio' => 1, 'bold' => 1, 'editar' => 1, 'empresa_id' => $empresa->id],
                ['cuenta_id' => 691, 'codigo' => '4101', 'nombre_cuenta' => 'COSTOS', 'balance' => 'balance', 'grupo' => 'Costos de lo Vendidos por Servicios', 'mayor' => 0, 'orden' => 4, 'anexo' => null, 'cantidad' => null, 'underline' => 0, 'created_at' => '2024-04-10 17:29:13', 'updated_at' => '2023-03-24 21:03:19', 'espacio' => 1, 'bold' => 0, 'editar' => 1, 'empresa_id' => $empresa->id],
                ['cuenta_id' => 786, 'codigo' => '4102', 'nombre_cuenta' => 'GASTOS DE OPERACIÓN', 'balance' => 'balance', 'grupo' => 'Costos de lo Vendidos por Servicios', 'mayor' => 0, 'orden' => 4, 'anexo' => null, 'cantidad' => null, 'underline' => 0, 'created_at' => '2024-04-10 17:29:15', 'updated_at' => '2023-03-24 21:03:19', 'espacio' => 1, 'bold' => 0, 'editar' => 1, 'empresa_id' => $empresa->id],
                ['cuenta_id' => 416, 'codigo' => null, 'nombre_cuenta' => null, 'balance' => 'balance', 'grupo' => 'UTILIDAD BRUTA', 'mayor' => 2, 'orden' => 5, 'anexo' => '1+2-4', 'cantidad' => null, 'underline' => 0, 'created_at' => '2024-04-10 17:29:18', 'updated_at' => '2023-03-24 21:03:19', 'espacio' => 1, 'bold' => 0, 'editar' => 0, 'empresa_id' => $empresa->id],
                ['cuenta_id' => 885, 'codigo' => '42', 'nombre_cuenta' => 'GASTOS NO ORDINARIOS', 'balance' => 'balance', 'grupo' => 'Gastos de operación', 'mayor' => 1, 'orden' => 6, 'anexo' => null, 'cantidad' => null, 'underline' => 0, 'created_at' => '2024-04-10 17:29:23', 'updated_at' => '2023-03-24 21:03:19', 'espacio' => 1, 'bold' => 1, 'editar' => 1, 'empresa_id' => $empresa->id],
                ['cuenta_id' => 886, 'codigo' => '4201', 'nombre_cuenta' => 'OTROS GASTOS', 'balance' => 'balance', 'grupo' => 'Gastos de operación', 'mayor' => 0, 'orden' => 6, 'anexo' => null, 'cantidad' => null, 'underline' => 0, 'created_at' => '2024-04-10 17:29:27', 'updated_at' => '2023-03-24 21:03:19', 'espacio' => 1, 'bold' => 0, 'editar' => 1, 'empresa_id' => $empresa->id],
                ['cuenta_id' => 886, 'codigo' => null, 'nombre_cuenta' => null, 'balance' => 'balance', 'grupo' => 'Gastos de operación', 'mayor' => 0, 'orden' => 6, 'anexo' => null, 'cantidad' => null, 'underline' => 0, 'created_at' => '2024-04-10 17:29:34', 'updated_at' => '2023-03-24 21:03:19', 'espacio' => 1, 'bold' => 0, 'editar' => 0, 'empresa_id' => $empresa->id],
                ['cuenta_id' => 886, 'codigo' => null, 'nombre_cuenta' => null, 'balance' => 'balance', 'grupo' => 'Gastos de operación', 'mayor' => 0, 'orden' => 6, 'anexo' => null, 'cantidad' => null, 'underline' => 0, 'created_at' => '2024-04-10 17:29:36', 'updated_at' => '2023-03-24 21:03:19', 'espacio' => 1, 'bold' => 0, 'editar' => 0, 'empresa_id' => $empresa->id],
                ['cuenta_id' => null, 'codigo' => null, 'nombre_cuenta' => null, 'balance' => 'balance', 'grupo' => 'UTILIDAD DE OPERACIÓN', 'mayor' => 2, 'orden' => 7, 'anexo' => '1+2-4-6', 'cantidad' => null, 'underline' => 0, 'created_at' => '2024-04-10 17:29:42', 'updated_at' => '2023-03-24 21:03:19', 'espacio' => 1, 'bold' => 0, 'editar' => 0, 'empresa_id' => $empresa->id],
                ['cuenta_id' => 886, 'codigo' => null, 'nombre_cuenta' => null, 'balance' => 'balance', 'grupo' => 'Gastos No de Operación', 'mayor' => 1, 'orden' => 8, 'anexo' => null, 'cantidad' => null, 'underline' => 0, 'created_at' => '2024-04-10 17:30:06', 'updated_at' => '2023-03-24 21:03:19', 'espacio' => 1, 'bold' => 1, 'editar' => 0, 'empresa_id' => $empresa->id],
                ['cuenta_id' => 886, 'codigo' => null, 'nombre_cuenta' => null, 'balance' => 'balance', 'grupo' => 'Gastos No de Operación', 'mayor' => 0, 'orden' => 8, 'anexo' => null, 'cantidad' => null, 'underline' => 0, 'created_at' => '2024-04-10 17:30:08', 'updated_at' => '2023-03-24 21:03:19', 'espacio' => 1, 'bold' => 0, 'editar' => 0, 'empresa_id' => $empresa->id],
                ['cuenta_id' => null, 'codigo' => null, 'nombre_cuenta' => null, 'balance' => 'balance', 'grupo' => 'UTILIDAD ANTES DE IMPUESTOS', 'mayor' => 2, 'orden' => 9, 'anexo' => '1+2-4-6-8', 'cantidad' => null, 'underline' => 0, 'created_at' => '2024-04-10 17:30:09', 'updated_at' => '2023-03-24 21:03:19', 'espacio' => 1, 'bold' => 0, 'editar' => 0, 'empresa_id' => $empresa->id],
                ['cuenta_id' => 682, 'codigo' => '310201', 'nombre_cuenta' => 'RESERVA LEGAL', 'balance' => 'balance', 'grupo' => 'Reserva Legal', 'mayor' => 1, 'orden' => 10, 'anexo' => null, 'cantidad' => null, 'underline' => 1, 'created_at' => '2024-04-10 17:30:17', 'updated_at' => '2023-03-24 21:03:19', 'espacio' => 0, 'bold' => 0, 'editar' => 1, 'empresa_id' => $empresa->id],
                ['cuenta_id' => null, 'codigo' => null, 'nombre_cuenta' => null, 'balance' => 'balance', 'grupo' => 'Utilidad menos reserva', 'mayor' => 2, 'orden' => 11, 'anexo' => '1+2-4-6-8-10', 'cantidad' => null, 'underline' => 0, 'created_at' => '2024-04-10 17:30:15', 'updated_at' => '2023-03-24 21:03:19', 'espacio' => 0, 'bold' => 1, 'editar' => 0, 'empresa_id' => $empresa->id],
                ['cuenta_id' => 617, 'codigo' => '210503', 'nombre_cuenta' => 'RETENCION DE IMPUESTO SOBRE LA RENTA', 'balance' => 'balance', 'grupo' => 'Impuesto Sobre la Renta', 'mayor' => 3, 'orden' => 12, 'anexo' => null, 'cantidad' => null, 'underline' => 1, 'created_at' => '2024-04-10 17:30:24', 'updated_at' => '2023-03-24 21:03:19', 'espacio' => 0, 'bold' => 0, 'editar' => 1, 'empresa_id' => $empresa->id],
                ['cuenta_id' => null, 'codigo' => null, 'nombre_cuenta' => null, 'balance' => 'balance', 'grupo' => 'Utilitad del Ejercicio', 'mayor' => 2, 'orden' => 13, 'anexo' => '1+2-4-6-8-10-12', 'cantidad' => 19613.92, 'underline' => 1, 'created_at' => '2024-04-10 17:30:28', 'updated_at' => '2023-10-23 22:38:28', 'espacio' => 0, 'bold' => 1, 'editar' => 0, 'empresa_id' => $empresa->id],
            ];

            DB::table('conta_balance_conf')->insert($data);

            $data = [
                ['empresa_id' => $empresa->id, 'cuenta_id' => 2, 'codigo' => null, 'nombre_cuenta' => null, 'balance' => 'general', 'grupo' => 'ACTIVOS', 'mayor' => 1, 'orden' => 1, 'anexo' => null, 'cantidad' => null, 'underline' => 0, 'created_at' => '2024-01-20 16:46:44', 'updated_at' => '2023-03-24 21:03:19', 'espacio' => 0, 'bold' => 1, 'editar' => 1],
                ['empresa_id' => $empresa->id, 'cuenta_id' => 3, 'codigo' => null, 'nombre_cuenta' => null, 'balance' => 'general', 'grupo' => 'ACTIVOS', 'mayor' => 0, 'orden' => 1, 'anexo' => null, 'cantidad' => null, 'underline' => 0, 'created_at' => '2024-01-20 16:46:44', 'updated_at' => '2023-03-24 21:03:19', 'espacio' => 0, 'bold' => 0, 'editar' => 1],
                ['empresa_id' => $empresa->id, 'cuenta_id' => 27, 'codigo' => null, 'nombre_cuenta' => null, 'balance' => 'general', 'grupo' => 'ACTIVOS', 'mayor' => 0, 'orden' => 1, 'anexo' => null, 'cantidad' => null, 'underline' => 0, 'created_at' => '2024-01-20 16:46:44', 'updated_at' => '2023-03-24 21:03:19', 'espacio' => 0, 'bold' => 0, 'editar' => 1],
                ['empresa_id' => $empresa->id, 'cuenta_id' => 51, 'codigo' => null, 'nombre_cuenta' => null, 'balance' => 'general', 'grupo' => 'ACTIVOS', 'mayor' => 0, 'orden' => 1, 'anexo' => null, 'cantidad' => null, 'underline' => 0, 'created_at' => '2024-01-20 16:46:44', 'updated_at' => '2023-03-24 21:03:19', 'espacio' => 0, 'bold' => 0, 'editar' => 1],
                ['empresa_id' => $empresa->id, 'cuenta_id' => 78, 'codigo' => null, 'nombre_cuenta' => null, 'balance' => 'general', 'grupo' => 'ACTIVOS', 'mayor' => 0, 'orden' => 1, 'anexo' => null, 'cantidad' => null, 'underline' => 0, 'created_at' => '2024-01-20 16:46:44', 'updated_at' => '2023-03-24 21:03:19', 'espacio' => 0, 'bold' => 0, 'editar' => 1],
                ['empresa_id' => $empresa->id, 'cuenta_id' => 91, 'codigo' => null, 'nombre_cuenta' => null, 'balance' => 'general', 'grupo' => 'ACTIVOS', 'mayor' => 0, 'orden' => 1, 'anexo' => null, 'cantidad' => null, 'underline' => 0, 'created_at' => '2024-01-20 16:46:44', 'updated_at' => '2023-03-24 21:03:19', 'espacio' => 0, 'bold' => 0, 'editar' => 1],
                ['empresa_id' => $empresa->id, 'cuenta_id' => 102, 'codigo' => null, 'nombre_cuenta' => null, 'balance' => 'general', 'grupo' => 'ACTIVOS', 'mayor' => 0, 'orden' => 1, 'anexo' => null, 'cantidad' => null, 'underline' => 0, 'created_at' => '2024-01-20 16:46:44', 'updated_at' => '2023-03-24 21:03:19', 'espacio' => 0, 'bold' => 0, 'editar' => 1],
                ['empresa_id' => $empresa->id, 'cuenta_id' => 114, 'codigo' => null, 'nombre_cuenta' => null, 'balance' => 'general', 'grupo' => 'ACTIVOS', 'mayor' => 0, 'orden' => 1, 'anexo' => null, 'cantidad' => null, 'underline' => 1, 'created_at' => '2024-01-20 16:46:44', 'updated_at' => '2023-03-24 21:03:19', 'espacio' => 0, 'bold' => 0, 'editar' => 1],
                ['empresa_id' => $empresa->id, 'cuenta_id' => 224, 'codigo' => null, 'nombre_cuenta' => null, 'balance' => 'general', 'grupo' => 'PASIVO CORRIENTE', 'mayor' => 1, 'orden' => 2, 'anexo' => null, 'cantidad' => null, 'underline' => 0, 'created_at' => '2024-01-20 16:46:44', 'updated_at' => '2023-03-24 21:03:19', 'espacio' => 0, 'bold' => 1, 'editar' => 1],
                ['empresa_id' => $empresa->id, 'cuenta_id' => 225, 'codigo' => null, 'nombre_cuenta' => null, 'balance' => 'general', 'grupo' => 'PASIVO CORRIENTE', 'mayor' => 0, 'orden' => 2, 'anexo' => null, 'cantidad' => null, 'underline' => 0, 'created_at' => '2024-01-20 16:46:44', 'updated_at' => '2023-03-24 21:03:19', 'espacio' => 0, 'bold' => 0, 'editar' => 1],
                ['empresa_id' => $empresa->id, 'cuenta_id' => 232, 'codigo' => null, 'nombre_cuenta' => null, 'balance' => 'general', 'grupo' => 'PASIVO CORRIENTE', 'mayor' => 0, 'orden' => 2, 'anexo' => null, 'cantidad' => null, 'underline' => 0, 'created_at' => '2024-01-20 16:46:44', 'updated_at' => '2023-03-24 21:03:19', 'espacio' => 0, 'bold' => 0, 'editar' => 1],
                ['empresa_id' => $empresa->id, 'cuenta_id' => 241, 'codigo' => null, 'nombre_cuenta' => null, 'balance' => 'general', 'grupo' => 'PASIVO CORRIENTE', 'mayor' => 0, 'orden' => 2, 'anexo' => null, 'cantidad' => null, 'underline' => 0, 'created_at' => '2024-01-20 16:46:44', 'updated_at' => '2023-03-24 21:03:19', 'espacio' => 0, 'bold' => 0, 'editar' => 1],
                ['empresa_id' => $empresa->id, 'cuenta_id' => 266, 'codigo' => null, 'nombre_cuenta' => null, 'balance' => 'general', 'grupo' => 'PASIVO CORRIENTE', 'mayor' => 0, 'orden' => 2, 'anexo' => null, 'cantidad' => null, 'underline' => 0, 'created_at' => '2024-01-20 16:46:44', 'updated_at' => '2023-03-24 21:03:19', 'espacio' => 0, 'bold' => 0, 'editar' => 1],
                ['empresa_id' => $empresa->id, 'cuenta_id' => 269, 'codigo' => null, 'nombre_cuenta' => null, 'balance' => 'general', 'grupo' => 'PASIVO CORRIENTE', 'mayor' => 0, 'orden' => 2, 'anexo' => null, 'cantidad' => null, 'underline' => 0, 'created_at' => '2024-01-20 16:46:44', 'updated_at' => '2023-03-24 21:03:19', 'espacio' => 0, 'bold' => 0, 'editar' => 1],
                ['empresa_id' => $empresa->id, 'cuenta_id' => 280, 'codigo' => null, 'nombre_cuenta' => null, 'balance' => 'general', 'grupo' => 'PASIVO CORRIENTE', 'mayor' => 0, 'orden' => 2, 'anexo' => null, 'cantidad' => null, 'underline' => 0, 'created_at' => '2024-01-20 16:46:44', 'updated_at' => '2023-03-24 21:03:19', 'espacio' => 0, 'bold' => 0, 'editar' => 1],
                ['empresa_id' => $empresa->id, 'cuenta_id' => 287, 'codigo' => null, 'nombre_cuenta' => null, 'balance' => 'general', 'grupo' => 'PASIVO CORRIENTE', 'mayor' => 0, 'orden' => 2, 'anexo' => null, 'cantidad' => null, 'underline' => 0, 'created_at' => '2024-01-20 16:46:44', 'updated_at' => '2023-03-24 21:03:19', 'espacio' => 0, 'bold' => 0, 'editar' => 1],
                ['empresa_id' => $empresa->id, 'cuenta_id' => 307, 'codigo' => null, 'nombre_cuenta' => null, 'balance' => 'general', 'grupo' => 'PASIVO CORRIENTE', 'mayor' => 0, 'orden' => 2, 'anexo' => null, 'cantidad' => null, 'underline' => 0, 'created_at' => '2024-01-20 16:46:44', 'updated_at' => '2023-03-24 21:03:19', 'espacio' => 0, 'bold' => 0, 'editar' => 1],
                ['empresa_id' => $empresa->id, 'cuenta_id' => 310, 'codigo' => null, 'nombre_cuenta' => null, 'balance' => 'general', 'grupo' => 'PASIVO CORRIENTE', 'mayor' => 0, 'orden' => 2, 'anexo' => null, 'cantidad' => null, 'underline' => 1, 'created_at' => '2024-01-20 16:46:44', 'updated_at' => '2023-03-24 21:03:19', 'espacio' => 0, 'bold' => 0, 'editar' => 1],
                ['empresa_id' => $empresa->id, 'cuenta_id' => 125, 'codigo' => null, 'nombre_cuenta' => null, 'balance' => 'general', 'grupo' => 'ACTIVO NO CORRIENTE', 'mayor' => 1, 'orden' => 3, 'anexo' => null, 'cantidad' => null, 'underline' => 0, 'created_at' => '2024-01-20 16:46:44', 'updated_at' => '2023-03-24 21:03:19', 'espacio' => 0, 'bold' => 1, 'editar' => 1],
                ['empresa_id' => $empresa->id, 'cuenta_id' => 126, 'codigo' => null, 'nombre_cuenta' => null, 'balance' => 'general', 'grupo' => 'ACTIVO NO CORRIENTE', 'mayor' => 0, 'orden' => 3, 'anexo' => null, 'cantidad' => null, 'underline' => 0, 'created_at' => '2024-01-20 16:46:44', 'updated_at' => '2023-03-24 21:03:19', 'espacio' => 0, 'bold' => 0, 'editar' => 1],
                ['empresa_id' => $empresa->id, 'cuenta_id' => 155, 'codigo' => null, 'nombre_cuenta' => null, 'balance' => 'general', 'grupo' => 'ACTIVO NO CORRIENTE', 'mayor' => 0, 'orden' => 3, 'anexo' => null, 'cantidad' => null, 'underline' => 0, 'created_at' => '2024-01-20 16:46:44', 'updated_at' => '2023-03-24 21:03:19', 'espacio' => 0, 'bold' => 0, 'editar' => 1],
                ['empresa_id' => $empresa->id, 'cuenta_id' => 177, 'codigo' => null, 'nombre_cuenta' => null, 'balance' => 'general', 'grupo' => 'ACTIVO NO CORRIENTE', 'mayor' => 0, 'orden' => 3, 'anexo' => null, 'cantidad' => null, 'underline' => 0, 'created_at' => '2024-01-20 16:46:44', 'updated_at' => '2023-03-24 21:03:19', 'espacio' => 0, 'bold' => 0, 'editar' => 1],
                ['empresa_id' => $empresa->id, 'cuenta_id' => 184, 'codigo' => null, 'nombre_cuenta' => null, 'balance' => 'general', 'grupo' => 'ACTIVO NO CORRIENTE', 'mayor' => 0, 'orden' => 3, 'anexo' => null, 'cantidad' => null, 'underline' => 0, 'created_at' => '2024-01-20 16:46:44', 'updated_at' => '2023-03-24 21:03:19', 'espacio' => 0, 'bold' => 0, 'editar' => 1],
                ['empresa_id' => $empresa->id, 'cuenta_id' => 190, 'codigo' => null, 'nombre_cuenta' => null, 'balance' => 'general', 'grupo' => 'ACTIVO NO CORRIENTE', 'mayor' => 0, 'orden' => 3, 'anexo' => null, 'cantidad' => null, 'underline' => 0, 'created_at' => '2024-01-20 16:46:44', 'updated_at' => '2023-03-24 21:03:19', 'espacio' => 0, 'bold' => 0, 'editar' => 1],
                ['empresa_id' => $empresa->id, 'cuenta_id' => 193, 'codigo' => null, 'nombre_cuenta' => null, 'balance' => 'general', 'grupo' => 'ACTIVO NO CORRIENTE', 'mayor' => 0, 'orden' => 3, 'anexo' => null, 'cantidad' => null, 'underline' => 0, 'created_at' => '2024-01-20 16:46:44', 'updated_at' => '2023-03-24 21:03:19', 'espacio' => 0, 'bold' => 0, 'editar' => 1],
                ['empresa_id' => $empresa->id, 'cuenta_id' => 195, 'codigo' => null, 'nombre_cuenta' => null, 'balance' => 'general', 'grupo' => 'ACTIVO NO CORRIENTE', 'mayor' => 0, 'orden' => 3, 'anexo' => null, 'cantidad' => null, 'underline' => 0, 'created_at' => '2024-01-20 16:46:44', 'updated_at' => '2023-03-24 21:03:19', 'espacio' => 0, 'bold' => 0, 'editar' => 1],
                ['empresa_id' => $empresa->id, 'cuenta_id' => 216, 'codigo' => null, 'nombre_cuenta' => null, 'balance' => 'general', 'grupo' => 'ACTIVO NO CORRIENTE', 'mayor' => 0, 'orden' => 3, 'anexo' => null, 'cantidad' => null, 'underline' => 0, 'created_at' => '2024-01-20 16:46:44', 'updated_at' => '2023-03-24 21:03:19', 'espacio' => 0, 'bold' => 0, 'editar' => 1],
                ['empresa_id' => $empresa->id, 'cuenta_id' => 221, 'codigo' => null, 'nombre_cuenta' => null, 'balance' => 'general', 'grupo' => 'ACTIVO NO CORRIENTE', 'mayor' => 0, 'orden' => 3, 'anexo' => null, 'cantidad' => null, 'underline' => 1, 'created_at' => '2024-01-20 16:46:44', 'updated_at' => '2023-03-24 21:03:19', 'espacio' => 0, 'bold' => 0, 'editar' => 1],
                ['empresa_id' => $empresa->id, 'cuenta_id' => 330, 'codigo' => null, 'nombre_cuenta' => null, 'balance' => 'general', 'grupo' => 'PASIVO NO CORRIENTE', 'mayor' => 1, 'orden' => 4, 'anexo' => null, 'cantidad' => null, 'underline' => 0, 'created_at' => '2024-01-20 16:46:44', 'updated_at' => '2023-03-24 21:03:19', 'espacio' => 0, 'bold' => 1, 'editar' => 1],
                ['empresa_id' => $empresa->id, 'cuenta_id' => 331, 'codigo' => null, 'nombre_cuenta' => null, 'balance' => 'general', 'grupo' => 'PASIVO NO CORRIENTE', 'mayor' => 0, 'orden' => 4, 'anexo' => null, 'cantidad' => null, 'underline' => 0, 'created_at' => '2024-01-20 16:46:44', 'updated_at' => '2023-03-24 21:03:19', 'espacio' => 0, 'bold' => 0, 'editar' => 1],
                ['empresa_id' => $empresa->id, 'cuenta_id' => 336, 'codigo' => null, 'nombre_cuenta' => null, 'balance' => 'general', 'grupo' => 'PASIVO NO CORRIENTE', 'mayor' => 0, 'orden' => 4, 'anexo' => null, 'cantidad' => null, 'underline' => 0, 'created_at' => '2024-01-20 16:46:44', 'updated_at' => '2023-03-24 21:03:19', 'espacio' => 0, 'bold' => 0, 'editar' => 1],
                ['empresa_id' => $empresa->id, 'cuenta_id' => 362, 'codigo' => null, 'nombre_cuenta' => null, 'balance' => 'general', 'grupo' => 'PATRIMONIO', 'mayor' => 1, 'orden' => 5, 'anexo' => null, 'cantidad' => null, 'underline' => 0, 'created_at' => '2024-01-20 16:46:44', 'updated_at' => '2023-03-24 21:03:19', 'espacio' => 0, 'bold' => 1, 'editar' => 1],
                ['empresa_id' => $empresa->id, 'cuenta_id' => 363, 'codigo' => null, 'nombre_cuenta' => null, 'balance' => 'general', 'grupo' => 'PATRIMONIO', 'mayor' => 0, 'orden' => 5, 'anexo' => null, 'cantidad' => null, 'underline' => 0, 'created_at' => '2024-01-20 16:46:44', 'updated_at' => '2023-03-24 21:03:19', 'espacio' => 0, 'bold' => 0, 'editar' => 1],
                ['empresa_id' => $empresa->id, 'cuenta_id' => 370, 'codigo' => null, 'nombre_cuenta' => null, 'balance' => 'general', 'grupo' => 'PATRIMONIO', 'mayor' => 0, 'orden' => 5, 'anexo' => null, 'cantidad' => null, 'underline' => 0, 'created_at' => '2024-01-20 16:46:44', 'updated_at' => '2023-03-24 21:03:19', 'espacio' => 0, 'bold' => 0, 'editar' => 1],
                ['empresa_id' => $empresa->id, 'cuenta_id' => 373, 'codigo' => null, 'nombre_cuenta' => null, 'balance' => 'general', 'grupo' => 'PATRIMONIO', 'mayor' => 0, 'orden' => 5, 'anexo' => null, 'cantidad' => null, 'underline' => 1, 'created_at' => '2024-01-20 16:46:44', 'updated_at' => '2023-03-24 21:03:19', 'espacio' => 0, 'bold' => 0, 'editar' => 1],
                ['empresa_id' => $empresa->id, 'cuenta_id' => 380, 'codigo' => null, 'nombre_cuenta' => null, 'balance' => 'general', 'grupo' => 'EFECTOS POR ADOPCION A NIIF PARA PYMES', 'mayor' => 1, 'orden' => 6, 'anexo' => null, 'cantidad' => null, 'underline' => 0, 'created_at' => '2024-01-20 16:46:44', 'updated_at' => '2023-03-24 21:03:19', 'espacio' => 0, 'bold' => 1, 'editar' => 1],
                ['empresa_id' => $empresa->id, 'cuenta_id' => 381, 'codigo' => null, 'nombre_cuenta' => null, 'balance' => 'general', 'grupo' => 'EFECTOS POR ADOPCION A NIIF PARA PYMES', 'mayor' => 0, 'orden' => 6, 'anexo' => null, 'cantidad' => null, 'underline' => 0, 'created_at' => '2024-01-20 16:46:44', 'updated_at' => '2023-03-24 21:03:19', 'espacio' => 0, 'bold' => 0, 'editar' => 1],
                ['empresa_id' => $empresa->id, 'cuenta_id' => 339, 'codigo' => null, 'nombre_cuenta' => null, 'balance' => 'general', 'grupo' => 'PASIVO NO CORRIENTE', 'mayor' => 0, 'orden' => 4, 'anexo' => null, 'cantidad' => null, 'underline' => 0, 'created_at' => '2024-01-20 16:46:44', 'updated_at' => '2023-03-27 15:26:20', 'espacio' => 0, 'bold' => 0, 'editar' => 1],
                ['empresa_id' => $empresa->id, 'cuenta_id' => 375, 'codigo' => null, 'nombre_cuenta' => null, 'balance' => 'general', 'grupo' => 'SUB CUENTAS', 'mayor' => 0, 'orden' => 7, 'anexo' => null, 'cantidad' => null, 'underline' => 0, 'created_at' => '2024-01-20 16:46:44', 'updated_at' => '2023-03-27 15:51:47', 'espacio' => 0, 'bold' => 0, 'editar' => 1],
                ['empresa_id' => $empresa->id, 'cuenta_id' => 376, 'codigo' => null, 'nombre_cuenta' => null, 'balance' => 'general', 'grupo' => 'SUB CUENTAS', 'mayor' => 0, 'orden' => 7, 'anexo' => null, 'cantidad' => null, 'underline' => 0, 'created_at' => '2024-01-20 16:46:44', 'updated_at' => '2023-03-27 16:06:44', 'espacio' => 0, 'bold' => 0, 'editar' => 1],
                ['empresa_id' => $empresa->id, 'cuenta_id' => 378, 'codigo' => null, 'nombre_cuenta' => null, 'balance' => 'general', 'grupo' => 'SUB CUENTAS', 'mayor' => 0, 'orden' => 7, 'anexo' => null, 'cantidad' => null, 'underline' => 0, 'created_at' => '2024-01-20 16:46:44', 'updated_at' => '2023-03-27 16:07:16', 'espacio' => 0, 'bold' => 0, 'editar' => 1],
                ['empresa_id' => $empresa->id, 'cuenta_id' => 379, 'codigo' => null, 'nombre_cuenta' => null, 'balance' => 'general', 'grupo' => 'SUB CUENTAS', 'mayor' => 0, 'orden' => 7, 'anexo' => null, 'cantidad' => null, 'underline' => 0, 'created_at' => '2024-01-20 16:46:44', 'updated_at' => '2023-03-27 16:07:42', 'espacio' => 0, 'bold' => 0, 'editar' => 1],
            ];

            DB::table('conta_balance_conf')->insert($data);

            // Se crean las configuraciones para la empresa creada.
            Config::insert([
                ['category' => 'datatable', 'title' => 'Boton de copiar (Mostrar/No mostrar)', 'description' => 'Boton que nos ayuda a copiar las filas de la tabla, podra modificarse el estado, si se desea mostrar o no mostrarse', 'field' => 'copyTitleShow', 'value' => '1', 'empresa_id' => $empresa->id, 'created_at' => now(), 'updated_at' => now()],
                ['category' => 'datatable', 'title' => 'Boton de copiar (Mensaje de confirmación)', 'description' => 'Boton que nos ayuda a copiar las filas de la tabla, podra modificarse el mensaje de confirmación', 'field' => 'copyTitle', 'value' => 'Se ha copiado los registros correctamente', 'empresa_id' => $empresa->id, 'created_at' => now(), 'updated_at' => now()],
                ['category' => 'datatable', 'title' => 'Boton de CSV (Mostrar/No mostrar)', 'description' => 'Boton de CSV nos ayuda exportar en un archivo CSV, podra modificarse el estado, si se desea mostrar o no mostrarse', 'field' => 'csvShow', 'value' => '1', 'empresa_id' => $empresa->id, 'created_at' => now(), 'updated_at' => now()],
                ['category' => 'datatable', 'title' => 'Boton de Excel (Mostrar/No mostrar)', 'description' => 'Boton de Excel nos ayuda exportar en un archivo Excel, podra modificarse el estado, si se desea mostrar o no mostrarse', 'field' => 'excelShow', 'value' => '1', 'empresa_id' => $empresa->id, 'created_at' => now(), 'updated_at' => now()],
                ['category' => 'datatable', 'title' => 'Boton de PDF (Mostrar/No mostrar)', 'description' => 'Boton de PDF nos ayuda exportar en un archivo PDF, podra modificarse el estado, si se desea mostrar o no mostrarse', 'field' => 'pdfShow', 'value' => '1', 'empresa_id' => $empresa->id, 'created_at' => now(), 'updated_at' => now()],
                ['category' => 'datatable', 'title' => 'Boton de imprimir (Mostrar/No mostrar)', 'description' => 'Boton de imprimir nos ayuda imprimir la tabla, podra modificarse el estado, si se desea mostrar o no mostrarse', 'field' => 'printShow', 'value' => '1', 'empresa_id' => $empresa->id, 'created_at' => now(), 'updated_at' => now()],
                ['category' => 'datatable', 'title' => 'Boton para visibilidad de columnas (Mostrar/No mostrar)', 'description' => 'Boton que nos ayuda seleccionar que columnas queremos ver, podra modificarse el estado, si se desea mostrar o no mostrarse', 'field' => 'visibilityShow', 'value' => '1', 'empresa_id' => $empresa->id, 'created_at' => now(), 'updated_at' => now()],
                ['category' => 'datatable', 'title' => 'Habilidad para seleccionar filas o no (Mostrar/No mostrar)', 'description' => 'Acción que nos permite poder seleccionar una fila o varias, el estado, si se desea mostrar o no mostrarse', 'field' => 'select', 'value' => '1', 'empresa_id' => $empresa->id, 'created_at' => now(), 'updated_at' => now()],
                ['category' => 'general', 'title' => 'Logo de la aplicación', 'description' => 'Acción que nos permite poder modificar el logo de la aplicación', 'field' => 'logo', 'value' => 'assets/images/logo/logo.png', 'empresa_id' => $empresa->id, 'created_at' => now(), 'updated_at' => now()],
                ['category' => 'producto', 'title' => 'Identificador de producto', 'description' => 'Acción que nos permite asignarle un identificador a cada producto, puede ser automatico o manual', 'field' => 'identificadorProducto', 'value' => '0', 'empresa_id' => $empresa->id, 'created_at' => now(), 'updated_at' => now()],
                ['category' => 'contabilidad', 'title' => 'Partida de venta/costo para facturación', 'description' => 'Crear una partida de venta/costo por documento facturado.', 'field' => 'partidaVentaCosto', 'value' => '1', 'empresa_id' => $empresa->id, 'created_at' => now(), 'updated_at' => now()],
                ['category' => 'contabilidad', 'title' => 'Cantidad de digitos del correlativo de partidas contables', 'description' => 'Acción que nos permite poder modificar la cantidad de digitos que tendra el correlativo al crear partidads contables', 'field' => 'correlativo', 'value' => '5', 'empresa_id' => $empresa->id, 'created_at' => now(), 'updated_at' => now()],
                ['category' => 'contabilidad', 'title' => 'Partida de venta/costo se realizara via cuenta bolson?', 'description' => 'Determina si la partida de venta/costo se hara para cuentas diferentes por cliente o una solo cuenta bozon por ejemplo: “cuentas por cobrar a clientes” donde SI = si ocuparemos cuenta bolson, NO = ocuparemos cuentas por cliente', 'field' => 'partidaVentaCostoCuentaClientes', 'value' => '1', 'empresa_id' => $empresa->id, 'created_at' => now(), 'updated_at' => now()],
                ['category' => 'facturacion_electronica', 'title' => 'Habilitar facturación electronica', 'description' => 'Indica si se generara DTE para factura electronica', 'field' => 'fe_habilitar', 'value' => '0', 'empresa_id' => $empresa->id, 'created_at' => now(), 'updated_at' => now()],
            ]);



            Log::log('RRHH', 'crear empresa', 'El usuario ' . Help::usuario()->name . ' ha creado la empresa ' . $request->empresa);
            DB::commit(); // <= Commit the changes
            return redirect()->route('rrhh.empresa.index')->with('success', 'Se ha creado la empresa correctamente');

        } catch (\Exception $e) {
            report($e);

            DB::rollBack(); // <= Rollback in case of an exception
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
        $empresa = RRHHEmpresa::find($id);

        return view('RRHH.empresa.edit', compact('empresa'));
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
        $empresa = RRHHEmpresa::find($id);
        $empresa->empresa = $request->empresa;
        $empresa->actualizada = true;
        $empresa->abreviatura = $request->abreviatura;
        $empresa->nrc = $request->nrc;
        $empresa->nit = $request->nit;
        $empresa->razon_social = $request->razon_social;
        Log::log('RRHH', 'editar empresa', 'El usuario ' . Help::usuario()->name . ' ha editado la empresa ' . $request->empresa);
        $empresa->save();
        return redirect()->route('rrhh.empresa.index')->with('success', 'Se ha editado la empresa correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $empresa = RRHHEmpresa::find($id);
        if (count($empresa->usuarios) > 0) {
            Log::log('RRHH', 'eliminar empresa', 'El usuario ' . Help::usuario()->name . ' intento eliminar la empresa ' . $empresa->empresa . ' , pero no pudo eliminarla porque la empresa ya fue asiganda a usuarios.');
            return back()->with('danger', 'No se puede eliminar la empresa, ya que esta siendo utilizada por modulos');
        }

        Log::log('RRHH', 'eliminar empresa', 'El usuario ' . Help::usuario()->name . ' ha eliminado la empresa ' . $empresa->empresa);
        $empresa->delete();
        return back()->with('success', 'Se ha eliminado la empresa correctamente');
    }
}