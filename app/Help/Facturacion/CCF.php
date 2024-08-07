<?php 

namespace App\Help\Facturacion;
use App\Help\Help;
use App\Help\Facturacion\Operaciones;
use App\Models\Producto\Servicio;
use App\Models\Producto\ProProducto;
use App\Models\Facturacion\FactDocumentoDetalle;
use App\Models\Facturacion\FactDocumento;
class CCF
{
    public static function monto($cantidad, $unidad)
    {
        return $cantidad*$unidad;
    }

    public static function iva($montoConDescuento, $iva)
    {
        if($iva){
            return $montoConDescuento*0.13;
        }
        return 0;
    }

    public static function excenta($montoConDescuento, $iva )
    {
        if($iva==false){
            return $montoConDescuento;
        }
        return 0;
    }

    //$iva = bool 
    public static function gravada($montoConDescuento, $iva )
    {
        if($iva){
            return $montoConDescuento;
        }
        return 0;
    }
    //$iva = decimal 
    public static function subTotal($montoConDescuento, $iva){
        return $montoConDescuento+$iva;
    }

    //$iva = decimal 
    public static function total($montoConDescuento, $iva){
        return $montoConDescuento+$iva;
    }

    public static function operacion($request){

        $montoSinDescuento =  Operaciones::monto($request->cantidad,$request->precio);
        $descuento = Operaciones::descuento($request->cantidad, $request->precio, $request->tipo_descuento, 
        $request->descuento,  1);
        $montoConDescuento = $montoSinDescuento-$descuento ;

        $itemP = null;
        $itemS = null;
        $documento = FactDocumento::find($request->doc_id);
        if($request->tipo =="P"){
            $itemP = $request->itemId;
        }
        if($request->tipo =="S"){
            $itemS = $request->itemId;
        }

        if($montoConDescuento<0){
            return array("error"=> true,'mensaje'=> "El descuento es mayor al monto de la venta");
        }


        $iva  = self::iva($montoConDescuento, $request->iva);
        FactDocumentoDetalle::create([
            'documento_id'=>$request->doc_id,
            'facturacion_id'=>$request->facturacion_id,
            'cliente_id'=>$request->cliente_id,
            'producto_id'=>$itemP,
            'servicio_id'=>$itemS,
            'tipo_precio_id'=> $request->precios,
            'tipo_descuento'=> $request->tipo_descuento,
            'descuento'=> $descuento,
            'precio_sugerido'=> $request->sugerido,
            'precio_unitario'=>$request->precio,
            'cantidad'=> $request->cantidad,
            'iva'=> $iva,
            'iva_percibido'=>0,
            'iva_retenido'=>0,
            'nosujeta'=>0,
            'exenta'=>self::excenta($montoConDescuento, $request->iva ),
            'gravada'=>self::gravada($montoConDescuento, $request->iva ),
            'sub_total'=>self::subTotal($montoConDescuento, $iva),
            'total'=>self::total($montoConDescuento, $iva),
            'creador_id'=>Help::usuario()->id,
            'empresa_id'=>Help::empresa(),
        ]);
        return array("error"=> false, 'mensaje'=> "Se ha agregado el item correctamente");

    }

    
}