<?php

namespace App\Http\Controllers\Facturacion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Facturacion\FactFacturacion;
use App\Models\Facturacion\FactTipoDocumento;
use App\Models\Facturacion\FactEstadoFacturacion;
use App\Models\SociosdeNegocio\SociosCliente;
use App\Models\Facturacion\FactDocumento;
use App\Models\Facturacion\FeFormaPago;
use App\Help\Help;
use App\Help\Facturacion\CCF;
use App\Help\Facturacion\Factura;
use App\Models\Producto\Servicio;
use App\Models\Producto\ProProducto;
use App\Models\Facturacion\FactDocumentoDetalle;
use App\Models\Facturacion\FactSerialDocumento;
use App\Models\Facturacion\LibroVenta;
use App\Help\HttpClient;
use Illuminate\Support\Facades\DB;
use App\Help\Contabilidad\PartidasAutomaticasVenta;


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
            ->where(function ($query) use ($fechaInicio, $fechaFin) {
                $query->whereBetween('fecha_facturacion', [$fechaInicio, \Carbon\Carbon::parse($fechaFin)->endOfDay()])
                    ->orWhereNull('fecha_facturacion');
            })
            ->get();


        $clientes = SociosCliente::orderBy('id', 'desc')->get();
        $tiposDocumento = FactTipoDocumento::whereIn('id', [1, 2, 3, 5])->get();
        $formaPago = FeFormaPago::where('activo', true)->get();

        return view('facturacion.index', compact('facturaciones', 'clientes', 'tiposDocumento', 'formaPago'));
    }

    // Método para validar el formato de una fecha
    private function isValidDate($date)
    {
        return \DateTime::createFromFormat('Y-m-d', $date) !== false;
    }


    public function facturar(Request $request)
    {

        DB::beginTransaction();
        $ov = FactFacturacion::find($request->facturacion);
        $doc = FactDocumento::where('facturacion_id', $request->doc)->first();

        $ov->estado_id = 2;
        $ov->monto_facturar = 0;
        $ov->monto_facturado = $doc->total();
        $ov->fecha_facturacion = $request->fecha_facturar;
        $ov->save();
        $detalles = $doc->detalles;
        foreach ($detalles as $key => $value) {
            $value->fecha_facturacion = $request->fecha_facturar;
            if ($value->precio_sugerido == null) {
                $value->precio_sugerido = $value->precio_unitario;
            }
            $value->save();
        }

        // Obtener el serial y correlativo actual desde fact_serial_documento
        $serialDocumento = FactSerialDocumento::where('tipo_documento_id', $doc->tipo_documento_id)
            ->where('empresa_id', auth()->user()->empresa_id)
            ->where('activo', true)
            ->first();

        // Verificar que el serial exista y esté dentro del rango
        if (!$serialDocumento) {
            DB::rollBack();
            return back()->with('danger', 'No existe serial configurado para este tipo de documento.');
        }

        if ($serialDocumento->correlativo_actual > $serialDocumento->ultimo_correlativo) {
            DB::rollBack();
            return back()->with('danger', 'El correlativo actual ha excedido el límite permitido.');
        }

        // $doc->documento = rand(1000, 9999);
        // $doc->serial = rand(100000, 999999);
        $doc->documento = $serialDocumento->correlativo_actual;
        $doc->serial = $serialDocumento->serial;
        $doc->estado_facturacion_id = 2;
        $doc->monto = $ov->monto_facturado;
        $doc->posteado = $request->agregar;
        $doc->fecha_emision = $request->fecha_facturar;
        $doc->save();

       // PartidaContableTempController::agregarPartidaTemp($doc->id);

        
        //Incorporación de CCF a libro ventas.
        if ($doc->tipo_documento_id == 1) { 
            //Sumar todos los items (detalles) y asociarlos a un solo documento en el libro de ventas
            $libroVenta = new LibroVenta();
            $libroVenta->fecha_emision = $request->fecha_facturar;
            $libroVenta->documento = $doc->documento;
            $libroVenta->cliente = $ov->cliente->nombre . " " . $ov->cliente->apellido;
            $libroVenta->nit = $ov->cliente->nit;
            $libroVenta->nrc = $ov->cliente->nrc;
            $libroVenta->dui = $ov->cliente->dui;
            $libroVenta->empresa_id = $ov->empresa_id;
            $libroVenta->cliente_id = $doc->cliente_id;
            $libroVenta->documento_id = $doc->id;
            $libroVenta->empresa_id = $ov->empresa_id;
        
            // Sumamos los valores de los detalles
            $libroVenta->gravadas_locales = $doc->detalles->sum('gravada');
            $libroVenta->debito_fiscal = $doc->detalles->sum('iva');
            $libroVenta->excenta = $doc->detalles->sum('exenta');
            $libroVenta->no_sujeta = $doc->detalles->sum('nosujeta');
            
            // Guardar el registro en libro de ventas
            $libroVenta->save();
        }
        // Incrementar el correlativo actual para el siguiente uso
        $serialDocumento->increment('correlativo_actual');

        //facturacion electronica.*/
        $body = [
            'email' => 'correo2@example.com',
            'password' => 'password'
        ];
        
        $response = HttpClient::post("/api/login", config('app.path_api_hacienda'), $body);
       
        
           //peticion hacia el metodo post para mandar el ccf

           $data = [
               "codigo_pago" => "01",
               "pagoTributos" => [
                   [
                       "20" => "13"
                   ]
               ],
               "periodo_pago" => "CONTADO",
               "plazo_pago" => "CONTADO",
               "dteJson" => [
                   "receptor" => [
                       "nit" => "012345678901234",
                       "dui" => "012345678-9",
                       "nombre" => "Carlos Alfaro",
                       "descActividad" => "Otros",
                       "nombreComercial" => "Carlos Alfaro",
                       "nrc"=> "0123456789",
                       "codActividad"=>  "10005", 
                       "direccion" =>[
                        "departamento"=> "San Salvador",
                        "municipio"=> "San Salvador",
                        "complemento"=> null
                       ],
                       "telefono"=> "0123-4567",
                       "correo"=> "Correo@gmail.com"
                   
                
                   ],
                   "documentoRelacionado"=> null,
                   "otrosDocumentos" => null,
                   "ventaTercero" => null,
                   "cuerpoDocumento" => [
                       [
                           "psv" => 0.0,
                           "codigo" => "SR001",
                           "cantidad" => 1,
                           "tipoItem" => "4",
                           "tributos" => [
                               "20"
                           ],
                           "noGravado" => 0.00,
                           "precioUni" => 0.00,
                           "uniMedida" => "99",
                           "codTributo" => "código del tributo según catalogo MH / null",
                           "montoDescu" => 0.00,
                           "ventaNoSuj" => 0.00,
                           "descripcion" => "Programación",
                           "ventaExenta" => 0.00,
                           "ventaGravada" => 100,
                           "numeroDocumento" => null
                        ]
                        
                   ],
                   "extension" => [
                       "nombEntrega" => "nombre del responsable generador del DTE",
                       "docuEntrega" => "identificación del generador del DTE",
                       "nombRecibe" => "nombre del responsable receptor",
                       "docuRecibe" => "identificación del receptor",
                       "observaciones" => "observaciones",
                       "placaVehiculo" => "placa vehiculo"
                   ],
                   "apendice" => [
                       [
                           "campo" => "Datos del Vendedor",
                           "etiqueta" => "Nombre del Vendedor",
                           "valor" => "000000000 - Administrador"
                       ]
                   ]
               ]
           ];
        
       // $response = HttpClient::post("/api/services/mh/enviar/dte/unitario/ccf", config('app.path_api_hacienda'), $data, $response['access_token']);
       // return $response;
        DB::commit();
        return redirect()->route('facturacion.index')->with('success', 'Se ha facturado correctamente');

    }

    public function agregarItemsFactura(Request $request, $id)
    {
        $ov = FactFacturacion::find($id);
        $doc = FactDocumento::where('facturacion_id', $id)->first();
        $servicios = Servicio::where('empresa_id', Help::empresa())->get();
        $productos = ProProducto::where('empresa_id', Help::empresa())->get();
        $tipo = null;
        $item = null;
        $itemObj = null;
        if ($request->items) {
            list($tipo, $item) = explode('-', $request->items);

            if ($tipo == "S") {
                $itemObj = Servicio::find($item);
            }
            if ($tipo == "P") {
                $itemObj = ProProducto::find($item);
            }
        }
        $partidas =PartidasAutomaticasVenta::partidaTemp($doc->id);
        
      
        return view('facturacion.facturar.facturarIndividual', compact('ov', 'servicios', 'tipo', 'item', 'itemObj', 'productos', 'doc','partidas'));


    }

    public function facturarItems(Request $request)
    {
        $documento = FactDocumento::find($request->doc_id);
        $partida =PartidasAutomaticasVenta::partidaTemp($documento->id);

        $facturacion = FactFacturacion::find($request->facturacion_id);
        $facturacion->estado_id = 3;
        $facturacion->save();
        $data = null;
        if ($documento->tipo_documento_id == 1) {
            $data = CCF::operacion($request);
        }
        if ($documento->tipo_documento_id == 3) {
            $data = Factura::operacion($request);
        }
        

        PartidasAutomaticasVenta::detallesTemp(
            $documento->id, /*id del documento*/
            $partida, /*objeto de instancia PartidaContable*/
        $data /*detalle de venta*/ );


        if ($data['error']) {
            return redirect()->route('facturacion.agregarItemsFactura', $request->facturacion_id)->with('danger', $data['mensaje']);

        }

        return redirect()->route('facturacion.agregarItemsFactura', $request->facturacion_id)->with('success', $data['mensaje']);

    }

    public function store(Request $request)
    {

        $request->validate([
            'cliente_id' => 'required|exists:socios_cliente,id',
            'tipo_documento_id' => 'required|exists:fact_tipo_documento,id',
            'tipo_pago_id' => 'required|exists:fe_forma_pago,id',
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
            'cliente_id' => $request->cliente_id,
            'tipo_factura_id' => 1
        ]);
        $documento = FactDocumento::create([
            'documento' => null,
            'facturacion_id' => $facturacion->id,
            'serial' => null,
            'tipo_documento_id' => $request->tipo_documento_id,
            'cliente_id' => $request->cliente_id,
            'tipo_pago_id' => $request->tipo_pago_id,
            'monto' => 0,
            'estado_facturacion_id' => 1,
            'posteado' => false,
            'empresa_id' => Help::empresa(),
            'creado_por' => Help::usuario()->id
        ]);


        return redirect()->route('facturacion.agregarItemsFactura', $facturacion->id);

    }

    public function anularFacturacion(Request $request)
    {
        $idFacturacion = $request->idFacturacion;
        $facturacion = FactFacturacion::find($idFacturacion);
        $documento = FactDocumento::where('facturacion_id',$idFacturacion)->first();

        if ($facturacion && $documento) {
            $facturacion->anulado = true;
            $documento->anulado = true;
    
            $facturacion->save();
            $documento->save();
    
            return redirect()->back()->with('success', 'Documento anulados exitosamente.');
        } else {
            return redirect()->back()->with('danger', 'No se pudo anular el documento.');
        }

    }
}