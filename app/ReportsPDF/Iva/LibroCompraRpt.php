<?php

namespace App\ReportsPDF\Iva;

use App\Help\PDF\EasyTable\easyTable;
use App\Help\PDF\EasyTable\exfpdf;
use App\Help\Help;
use App\Models\RRHH\RRHHEmpresa;
use App\Help\PDF\EasyTable\Styles;
use App\Help\Contabilidad\ReportesContables;

class LibroCompraRpt
{
    public static function getNameMothByNumber($mothNumber){
        $month = [
            1=>'Enero',
            2=>'Febrero',
            3=>'Marzo',
            4=>'Abril',
            5=>'Mayo',
            6=>'Junio',
            7=>'Julio',
            8=>'Agosto',
            9=>'Septiembre',
            10=>'Octubre',
            11=>'Noviembre',
            12=>'Diciembre'
        ];
        return $month[$mothNumber];
    }


    public static function report($data, $mes, $anio)
    {   $titulo = "MES: " . $mes . " AÑO: " . $anio;

        $pdf = new exFPDF('REPORTE DE LIBRO DE COMPRA',utf8_decode($titulo), 'L', 'mm', 'legal','',false);
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetFont('Arial', '', 7);

        // Define estilos
        //ESTILOS POR DEFECTO PARA CELDAS DEL HEADER Y TABLA EN GENERAL
        $style= 'align:C;paddingY:0.07;';//alinear al centro, con padding en y //
        $generalStyle= 'align:R;paddingY:1.3;';//alinear a la derecha con padding en y //
        $alternativeStyle='paddingY:1.3;';//padding en y  //
        $empresa = RRHHEmpresa::find(Help::empresa());

        $write=new easyTable($pdf, '%{40,15,15,15,15}','width:300; font-size:6;');
        $write->easyCell("NOMBRE DEL CONTRIBUYENTE: ".$empresa->empresa);
        $write->easyCell("NRC: ". $empresa?->nrc);
        $write->easyCell("NIT :".$empresa?->nit);
        $write->easyCell('MES: '.self::getNameMothByNumber(  (int)$mes ));
        $write->easyCell(utf8_decode('AÑO: ' . $anio));
        $write->printRow();
        $write->endTable();

        // Crea la tabla
        //el % de la tabla debe ser 100 en su total si no no funciona.
        $table = new easyTable($pdf, '%{2,5,5,6,9,21,5,5,5,5,5,5,5,5,6,6}','width:350; border-color:#3C4048;border-width:0.4; font-size:6; border:1; paddingY:2.3;');
        $table->rowStyle('font-style:B;font-color:#3F3F3F;valign:M;font-size:6;');
        $table->easyCell("No", $style.'rowspan:2;');//rowspan es para combinar columnas
        $table->easyCell(utf8_decode('Fecha de emisión'),$style.'rowspan:2;');
        $table->easyCell("Numero del documento",$style.'rowspan:2;');
        $table->easyCell("NRC",$style.'rowspan:2;');
        $table->easyCell("NIT , DUI, sujeto",$style.'rowspan:2;');
        $table->easyCell("Nombre del Proveedor",$style.'rowspan:2;');
        $table->easyCell("Compras Exentas",'colspan:2;align:C;paddingY:1;');//colspan es para combinar celdas
        $table->easyCell("Compras Gravadas",'colspan:2;align:C;paddingY:1;');//colspan es para combinar celdas
        $p = 'paddingY:1.5;';//
        $table->easyCell("Credito Fiscal",$style.$p.'rowspan:2;');
        $table->easyCell( utf8_decode('Contribución especial'),$style.$p.'rowspan:2;');
        $table->easyCell("Anticipo IVA/retenido",$style.$p.'rowspan:2;');
        $table->easyCell("Anticipo IVA/recibido",$style.$p.'rowspan:2;');
        $table->easyCell("Total compras",$style.$p.'rowspan:2;');
        $table->easyCell("Compras excluidas" ,$style.$p.'rowspan:2;');
        $table->printRow();

        $table->easyCell("Internas",$style.$p,'');
        $table->easyCell("Import/Inter",$style.$p);
        $table->easyCell("Internas",$style.$p);
        $table->easyCell("Import/Inter",$style.$p);

        $table->printRow(true);

        // Llena la tabla con datos
        $count =0;
        $totales=[
            'excentas_internas'=>0,
            'excentas_importaciones'=>0,
            'gravadas_internas'=>0,
            'gravadas_importaciones'=>0,
            'gravadas_iva'=>0,
            'contribucionEspecial'=>0,
            'anticipo_iva_retenido'=>0,
            'anticipo_iva_recibido'=>0,
            'total'=>0,
            'compras_excluidos'=>0
        ];
        foreach ($data as $key => $compra) {
            $count = $key;
            $totales['excentas_internas']+=$compra->excentas_internas;
            $totales['excentas_importaciones']+=$compra->excentas_importaciones;
            $totales['gravadas_internas']+=$compra->gravadas_internas;
            $totales['gravadas_importaciones']+=$compra->gravadas_importaciones;
            $totales['gravadas_iva']+=$compra->gravada_iva;
            $totales['contribucionEspecial']+=$compra->contribucion_especial;
            $totales['anticipo_iva_retenido']+=$compra->anticipo_iva_retenido;
            $totales['anticipo_iva_recibido']+=$compra->anticipo_iva_recibido;
            $totales['compras_excluidos']+=$compra->compras_excluidas;
            $totales['total']+=$compra->total_compra;

            $table->easyCell($key+1,$alternativeStyle);
            $table->easyCell( date('d/m/Y',strtotime($compra->fecha_emision_en_pdf))   ,$alternativeStyle);
            $table->easyCell($compra->documento,$alternativeStyle);
            $table->easyCell($compra->nrc,$alternativeStyle);
            $table->easyCell($compra->nit??$compra->dui,$alternativeStyle);
            $table->easyCell($compra->proveedor->nombre,$alternativeStyle);
            $table->easyCell($compra->excentas_internas,$generalStyle);
            $table->easyCell($compra->excentas_importaciones,$generalStyle);
            $table->easyCell($compra->gravadas_internas,$generalStyle);
            $table->easyCell($compra->gravadas_importaciones,$generalStyle);
            $table->easyCell($compra->gravada_iva,$generalStyle);
            $table->easyCell($compra->contribucion_especial,$generalStyle);
            $table->easyCell($compra->anticipo_iva_retenido,$generalStyle);
            $table->easyCell($compra->anticipo_iva_recibido,$generalStyle);
            $table->easyCell(number_format($compra->total_compra,2),$generalStyle);
            $table->easyCell($compra->compras_excluidas,$generalStyle);
            
            $table->printRow();
        }

        $table->easyCell('TOTAL DEL MES',$generalStyle.'colspan:6;');
        $table->easyCell(number_format($totales['excentas_internas'],2),$generalStyle);
        $table->easyCell(number_format($totales['excentas_importaciones'],2),$generalStyle);
        $table->easyCell(number_format($totales['gravadas_internas'],2),$generalStyle);
        $table->easyCell(number_format($totales['gravadas_importaciones'],2),$generalStyle);
        $table->easyCell(number_format($totales['gravadas_iva'],2),$generalStyle);
        $table->easyCell(number_format($totales['contribucionEspecial'],2),$generalStyle);
        $table->easyCell(number_format($totales['anticipo_iva_retenido'],2),$generalStyle);
        $table->easyCell(number_format($totales['anticipo_iva_recibido'],2),$generalStyle);
        $table->easyCell(number_format($totales['total'],2),$generalStyle);
        $table->easyCell(number_format($totales['compras_excluidos'],2),$generalStyle);
        $table->printRow();

        $table->endTable(10);

        //salto de tabla dinamico
        $decimal = $count / 27;
        if($decimal ==null){

        }else{
            $decimal = explode(".", $decimal);
            $decimal = $decimal[1];

            if($decimal >814814815){

                $space=new easyTable($pdf, 1,'width:260; font-size:10;');
                $space->endTable(20);


            }//salto de tabla dinamico
        }

        $final=new easyTable($pdf, '%{100}','width:100;align:L{LCC};border-width:0.4; border-color:#3C4048; font-size:7; border:1; paddingY:4;');
        $final->easyCell('CONTADOR O CONTRIBUYENTE','align:C');
        $final->printRow();
        $final->easyCell('Nombre:');
        $final->printRow();
        $final->easyCell('Firma:');
        $final->printRow();

        $pdf->Output('I', 'Reporte_Libro_Compra_' . $mes . '_' . $anio . '.pdf');
        exit;
    }
}