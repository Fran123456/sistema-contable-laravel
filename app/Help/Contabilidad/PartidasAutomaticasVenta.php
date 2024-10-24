<?php

namespace App\Help\Contabilidad;

use App\Help\Help;
use App\Models\Contabilidad\ContaDetallePartida;
use App\Models\Contabilidad\ContaPartidaContable;
use App\Models\Contabilidad\ContaPeriodoContable;
use App\Models\Contabilidad\ContaCuentaContable;
use App\Models\Contabilidad\ContaPartidaContableTemp;
use App\Models\Contabilidad\ContaPartidaDetalleContableTemp;

use App\Models\Facturacion\FactDocumento;

use Illuminate\Support\Facades\DB;

class PartidasAutomaticasVenta
{

    //PARTIDAS PARA TEMPORAL.
    public static function partidaTemp($documento_id){
        $partida = ContaPartidaContableTemp::where('documento_id', $documento_id)->first();
        $doc = FactDocumento::where('id', $documento_id)->first();
        if($partida==null){
            DB::beginTransaction();
            $partida = new ContaPartidaContableTemp();
            $partida->concepto = "Partida de venta";
            $partida->periodo_id = null;
            $partida->tipo_partida_id = null;
            $partida->correlativo = null;
            $partida->debe = 0;
            $partida->haber = 0;
            $partida->fecha_contable = date('Y-m-d');
            $partida->cerrada = 0;
            $partida->anulada = 0;
            $partida->empresa_id = Help::empresa();
            $partida->creador_id = Help::usuario()->id;
            $partida->documento_id = $documento_id;
            $partida->save();
            DB::commit();
        }
        return $partida;
    }
    

    public static function detalleTemp($partidaTemp, $cuentaId, $cuentaCodigo, $debe, $haber, $concepto = null ){
        ContaPartidaDetalleContableTemp::create([
            'partida_id'=> $partidaTemp->id,
            'empresa_id'=> $partidaTemp->empresa_id,
            'cuenta_contable_id'=> $cuentaId,
            'codigo_cuenta'=> $cuentaCodigo,
            'debe'=> $debe,
            'haber'=> $haber,
            'fecha_contable'=> $partidaTemp->fecha_contable ,
            'concepto'=> $concepto?? $partidaTemp->concepto

        ]);

    }

    public static function detallesTemp(
        $documento_id, /*id del documento*/
        $partida, /*objeto de instancia PartidaContable*/
        $detalleVenta /*detalle de venta*/ ){
        
        $ventaSinIva = 0;

        //************************************IVA*******************************************************
        $doc = FactDocumento::where('id', $documento_id)->first();
        if($doc->tipo_documento_id == 1){ //Comprobante de Credito Fiscal
            //IVA DEBITO FISCAL VENTAS A CONTRIBUYENTES CCF
            $cuentaIva =  Help::partidaAutomaticaConf('iva_debito_fiscal_contribuyente');
            self::detalleTemp($partida, $cuentaIva->cuenta_id, $cuentaIva->codigo_id, 0, $detalleVenta['data']['iva'], null );
            //IVA DEBITO FISCAL VENTAS A CONTRIBUYENTES CCF
            $ventaSinIva = $detalleVenta['data']['gravada'];
        }
        if($doc->tipo_documento_id == 3){ //factura
            //IVA-DEBITO FISCAL CONSUMIDOR FINAL POR VENTAS DEL DIA 
            $cuentaIva =  Help::partidaAutomaticaConf('iva_debito_fiscal_consumidor');
            self::detalleTemp($partida, $cuentaIva->cuenta_id, $cuentaIva->codigo_id,0 , $detalleVenta['data']['iva'], null );
            //IVA-DEBITO FISCAL CONSUMIDOR FINAL POR VENTAS DEL DIA
            $ventaSinIva = $detalleVenta['data']['gravada'];
        }
        //************************************IVA*******************************************************

        //*************************************abono en el caso sea efectivo***************************
        if($doc->tipo_pago_id == 13){
            $ingresoVentaDia =  Help::partidaAutomaticaConf('cxc_local');
            self::detalleTemp($partida, $ingresoVentaDia->cuenta_id, $ingresoVentaDia->codigo_id,  0,$ventaSinIva, null );
        }else{
            $ingresoVentaDia =  Help::partidaAutomaticaConf('ingreso_venta');
            self::detalleTemp($partida, $ingresoVentaDia->cuenta_id, $ingresoVentaDia->codigo_id, 0, $ventaSinIva, null );
        }


    }





    public static function transaccionesVentaFacturacion(
        PartidaContable $partida,
        $documento,
        $condicionPago
    ){
        $tr = array();
        $detalle=  DetalleDocumento::where('documento_id', $documento->id)->first();

        $cuentaIva = null;

        if($documento->tipo_documento_id == 1){ //Comprobante de Credito Fiscal
            //IVA DEBITO FISCAL VENTAS A CONTRIBUYENTES CCF
            $cuentaIva =  Help::configuracion('conta-cuenta-iva-debito-fiscal-contribuyente')->valor;
            
            //IVA DEBITO FISCAL VENTAS A CONTRIBUYENTES CCF
        }

        if($documento->tipo_documento_id == 3){ //Factura
            // IVA DEBITO FISCAL VENTAS A CONSUMIDOR FINAL
            $cuentaIva =  Help::configuracion('conta-cuenta-iva-debito-fiscal-consumidor-final')->valor;
             // IVA DEBITO FISCAL VENTAS A CONSUMIDOR FINAL
        }

        //TRANSACCION DE IVA CREDITO FISCAL
        
        if($cuentaIva != null &&  $detalle?->iva >0){
          $d =  Partidas::transacciones($partida, $detalle->iva , 0, $cuentaIva);
          array_push($tr,  $d);
        }
         //TRANSACCION DE IVA CREDITO FISCAL

        //TRANSACCION DE INGRESO POR VENTA 510501
        $inc = Help::configuracion('conta-ingreso-cuenta-venta-facturacion')->valor;
        
        $d =Partidas::transacciones($partida, $detalle?->sub_total - $detalle?->iva , 0, $inc );
     
        array_push($tr,  $d);
        //TRANSACCION DE INGRESO POR VENTA 510501


        //TRANSACCION PARA IVA RETENIDO
        $retenido =Help::configuracion('conta-retencion-1')->valor;
        
        if($detalle->iva_retenido> 0){
            $d = Partidas::transacciones($partida, $detalle->iva_retenido , 1, $retenido );
            array_push($tr,  $d);
        }
        //TRANSACCION PARA IVA RETENIDO

        //TRANSACCION A CLIENTES LOCALES O EXTERIOR
        //12010101      CUENTAS POR COBRAR A CLIENTES LOCALES
        //12010102      CUENTAS POR COBRAR A CLIENTE DEL EXTERIOR
        if($condicionPago == "CREDITO"){
            $cuentaClientes = null;
        $conflcliente =Help::configuracion('conta-cuenta-clientes-al-detalle')->valor;
        if($conflcliente=="1"){
            $cuentaClientes= Cliente::find($documento->cliente_id)?->cuenta_contable;
            
        }else{
            if ( $documento->cliente->cliente == "L") {//locales
                $cuentaClientes =  Help::configuracion('conta-cliente-por-cobrar-local-venta-facturacion')->valor;
            }else{
                $cuentaClientes = Help::configuracion('conta-cliente-por-cobrar-exterior-venta-facturacion')->valor;
            }
        }
        $d =Partidas::transacciones($partida, $detalle?->total_cancelar , 1, $cuentaClientes );

        }elseif($condicionPago == "CONTADO"){
           // dd($condicionPago); 
            //aqui tiene que ir la logica para meter la partida de contado
            //Tiene que ser la cuenta de caja a la que se cargue por tanto hay que crear una configuracion de la cuenta de caja
            $cuentaPagoDeContado = Help::configuracion('conta-cuenta-pago-de-contado')->valor;
            $d =Partidas::transacciones($partida, $detalle?->total_cancelar , 1, $cuentaPagoDeContado );
        }
        $partida->documento_id = $documento->id;
        $partida->save();
       
        
     
        array_push($tr,  $d);
        return $tr;
        //TRANSACCION A CLIENTES LOCALES O EXTERIOR
    }
}




