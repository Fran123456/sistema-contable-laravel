<?php

namespace App\Http\Controllers\Facturacion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Facturacion\FactFacturacion;
use App\Models\Facturacion\FactTipoDocumento;
use App\Models\SociosdeNegocio\SociosCliente;
use App\Models\Facturacion\FactDocumento;
use App\Help\Help;
use App\Help\Facturacion\CCF;
use App\Help\Facturacion\Factura;
use App\Models\Producto\Servicio;
use App\Models\Producto\ProProducto;
use App\Models\Facturacion\FactDocumentoDetalle;


class FacturacionController extends Controller
{
    public function index(Request $request)
    {
        $empresaId = Auth::user()->empresa_id;

        // Obtener las fechas de los inputs
        $fechaInicio = $request->input('fecha_inicio');
        $fechaFin = $request->input('fecha_fin');

        // Validar que fechaInicio no sea posterior a fechaFin
        if ($fechaInicio && $fechaFin && $fechaInicio > $fechaFin) {
            return redirect()->route('facturacion.index')
                            ->withErrors(['date' => 'La fecha de inicio no puede ser posterior a la fecha final.'])
                            ->withInput();
        }

        // Manejar fechas predeterminadas si no se ingresan
        if (!$fechaInicio || !$fechaFin) {
            $fechaFin = now()->endOfMonth()->format('Y-m-d');
            $fechaInicio = now()->startOfMonth()->format('Y-m-d');
        }


        // Validar el formato de las fechas
        if (!$this->isValidDate($fechaInicio) || !$this->isValidDate($fechaFin)) {
            return redirect()->route('facturacion.index')
                            ->withErrors(['date' => 'Las fechas ingresadas no son válidas.'])
                            ->withInput();
        }

        // Consultar las facturaciones filtradas
        $facturaciones = FactFacturacion::where('empresa_id', $empresaId)
                                        ->whereBetween('fecha_facturacion', [$fechaInicio, \Carbon\Carbon::parse($fechaFin)->endOfDay()])
                                        ->get();

        $clientes = SociosCliente::orderBy('id', 'desc')->get();
        $tiposDocumento = FactTipoDocumento::whereIn('id', [1, 2, 3, 5])->get();

        return view('facturacion.index', compact('facturaciones', 'clientes', 'tiposDocumento'));
    }

    // Método para validar el formato de una fecha
    private function isValidDate($date)
    {
        return \DateTime::createFromFormat('Y-m-d', $date) !== false;
    }


    public function facturar(Request $request){
        
        $ov = FactFacturacion::find($request->facturacion);
        $doc = FactDocumento::where('facturacion_id',$request->doc)->first();

        $ov->estado_id = 2;
        $ov->monto_facturar = 0;
        $ov->monto_facturado = $doc->total();
        $ov->fecha_facturacion = $request->fecha_facturar;
        $ov->save();
        $detalles = $doc->detalles;

        $doc->documento  = rand(1000,9999);
        $doc->serial = rand(100000,999999);
        $doc->estado_facturacion_id = 2;
        $doc->monto = $ov->monto_facturado;
        $doc->posteado = $request->agregar;
        $doc->fecha_emision = $request->fecha_facturar;
        $doc->save();

        return redirect()->route('facturacion.index')->with('success','Se ha facturado correctamente');

    }

    public function agregarItemsFactura(Request $request,$id){
        $ov = FactFacturacion::find($id);
        $doc = FactDocumento::where('facturacion_id',$id)->first();
        $servicios= Servicio::where('empresa_id', Help::empresa())->get();
        $productos= ProProducto::where('empresa_id', Help::empresa())->get();
        $tipo = null; 
        $item = null;
        $itemObj = null;
        if($request->items){
            list($tipo, $item) = explode('-', $request->items);

            if($tipo == "S"){
                $itemObj = Servicio::find($item);
            }
            if($tipo == "P"){
                $itemObj = ProProducto::find($item);
            }
        }

       return view('facturacion.facturar.facturarIndividual',compact('ov','servicios','tipo','item','itemObj','productos','doc'));


    }

    public function facturarItems(Request $request){
       
       
        $documento = FactDocumento::find($request->doc_id);
        $facturacion = FactFacturacion::find($request->facturacion_id);
        $facturacion->estado_id = 3;
        $facturacion->save();
        $data = null;
        if($documento->tipo_documento_id == 1){
           $data =  CCF::operacion($request);
        }
        if($documento->tipo_documento_id == 3){
            $data =  Factura::operacion($request);
        }

        if($data['error']){
            return redirect()->route('facturacion.agregarItemsFactura', $request->facturacion_id)->with('danger',$data['mensaje']);

        }

        return redirect()->route('facturacion.agregarItemsFactura', $request->facturacion_id)->with('success',$data['mensaje']);
       
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
            'cliente_id'=> $request->cliente_id,
            'tipo_factura_id'=>1
        ]);
        $documento = FactDocumento::create([
            'documento'=> null,
            'facturacion_id'=> $facturacion->id,
            'serial'=> null,
            'tipo_documento_id'=> $request->tipo_documento_id,
            'cliente_id'=> $request->cliente_id,
            'monto'=> 0,
            'estado_facturacion_id'=> 1,
            'posteado'=> false,
            'empresa_id'=> Help::empresa(),
            'creado_por'=> Help::usuario()->id
        ]);


        return redirect()->route('facturacion.agregarItemsFactura',$facturacion->id);
      
    }
}