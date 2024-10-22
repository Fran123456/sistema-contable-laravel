<?php 

namespace App\Help\Facturacion;
use App\Help\Help;
use App\Help\Facturacion\Operaciones;
use App\Models\Producto\Servicio;
use App\Models\Producto\ProProducto;
use App\Models\Facturacion\FactDocumentoDetalle;
use App\Models\Facturacion\FactDocumento;
use App\Models\SociosdeNegocio\SociosCliente;

class CCF
{
    public static function monto($cantidad, $unidad)
    {
        return $cantidad*$unidad;
    }

    public static function iva($montoConDescuento, $iva, $sujeto)
    {
        if($sujeto==1){

        }else{
            if($iva){
                return $montoConDescuento*0.13;
            }
            
        }
       
        return 0;
    }

    public static function excenta($montoConDescuento, $iva, $sujeto )
    {
        if($sujeto==1){

        }else{
            if($iva==false){
                return $montoConDescuento;
            }
            
        }
        return 0;
    }

    //$iva = bool 
    public static function gravada($montoConDescuento, $iva, $sujeto )
    {
        if($sujeto==1){

        }else{
            if($iva){
                return $montoConDescuento;
            }
        }
        return 0;
    }

    public static function sujeto($montoConDescuento, $sujeto)
    {
        if($sujeto==1){
            return $montoConDescuento;
        }
        return 0;
    }


    //$iva = decimal 
    public static function subTotal($montoConDescuento, $iva){
        return $montoConDescuento+$iva;
    }

    //$iva = decimal 
    public static function total($montoConDescuento, $iva, $ivaRetenido){
        return $montoConDescuento+$iva-$ivaRetenido;
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

        
        $iva  = self::iva($montoConDescuento, $request->iva,$request->sujeto);
        $ivaRetenido = self::ivaRetenido($montoConDescuento,$documento->cliente_id, $request->sujeto);
        $excenta = self::excenta($montoConDescuento, $request->iva,$request->sujeto );
        $gravada  = self::gravada($montoConDescuento, $request->iva,$request->sujeto );
        $sujeto = self::sujeto($montoConDescuento , $request->sujeto);

        $dt = FactDocumentoDetalle::create([
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
            'iva_retenido'=>$ivaRetenido,
            'nosujeta'=>$sujeto ,
            'exenta'=> $excenta,
            'gravada'=>$gravada ,
            'sub_total'=>self::subTotal($montoConDescuento, $iva),
            'total'=>self::total($montoConDescuento, $iva, $ivaRetenido),
            'creador_id'=>Help::usuario()->id,
            'empresa_id'=>Help::empresa(),
        ]);
        return array("error"=> false, 'mensaje'=> "Se ha agregado el item correctamente" , "data"=> $dt);

    }

    public static function ivaRetenido($montoConDescuento, $clienteId, $sujeto){
        $cliente = SociosCliente::find($clienteId);
        if($cliente->magnitud_cliente =='Contribuyente grande' && $montoConDescuento>= 100 &&$sujeto ==null ){
            return $montoConDescuento*0.01;
        }
        return 0;
    }

    
}