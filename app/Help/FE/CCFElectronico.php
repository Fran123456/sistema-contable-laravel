<?php 

namespace App\Help\FE;
use App\Help\Help;
use App\Help\Facturacion\Operaciones;
use App\Models\Producto\Servicio;
use App\Models\Producto\ProProducto;
use App\Models\Facturacion\FactDocumentoDetalle;
use App\Models\Facturacion\FactDocumento;
use App\Models\SociosdeNegocio\SociosCliente;
use App\Models\FacturacionElectronica\FeActividadEconomica;

class CCFElectronico
{

    public function build($cliente){

        $actividad = FeActividadEconomica::where('codigo',$cliente->actividad_economica )->first();
        $data = [
            "codigo_pago" => null,
            "pagoTributos" => [
                [
                    "20" => "13"
                ]
            ],
            "periodo_pago" => null,
            "plazo_pago" => null,
            "dteJson" => [
                "receptor" => [
                    "nit" => $cliente->nit,
                    "dui" => $cliente->dui,
                    "nombre" => $cliente->nombre,
                    "descActividad" => $actividad->valor,
                    "nombreComercial" => $cliente->nombre,
                    "nrc"=> $cliente->nrc,
                    "codActividad"=>  $cliente->actividad_economica, 
                    "direccion" =>[
                     "departamento"=> "01",
                     "municipio"=> "01",
                     "complemento"=> null
                    ],
                    "telefono"=> $cliente->telefono,
                    "correo"=> $cliente->correo
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

    }

}