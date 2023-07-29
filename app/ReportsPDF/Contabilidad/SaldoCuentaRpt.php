<?php

namespace App\ReportsPDF\Contabilidad;

use App\Help\PDF\EasyTable\easyTable;
use App\Help\PDF\EasyTable\exfpdf;
class SaldoCuentaRpt
{
    
    public static function report($fechai, $fechaf, $data){
        $n=0;
        $pdf = new exFPDF('LIBRO O REGISTRO DE COMPRAS', 'L', 'mm', 'legal');
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetFont('Arial','',7);

        $c=new easyTable($pdf, '%{100}','width:300; font-size:6;');
        $c->easyCell("");
        $c->printRow();
        $c->endTable(10);

        //TITULO INICIAL (NO SE REPITE)
        $write=new easyTable($pdf, '%{40,15,15,15,15}','width:300; font-size:6;');
        $write->easyCell("NOMBRE DEL CONTRIBUYENTE: AGENTES PORTUARIOS DEL PACIFICO S.A DE C.V");
        $write->easyCell("NRC: 216296-4");
        $write->easyCell("NIT :0614-190412-103-1 ");
        $write->easyCell('MES: ');
        $write->easyCell(utf8_decode('AÑO: '));
        $write->printRow();
        $write->endTable();

        //ESTILOS POR DEFECTO PARA CELDAS DEL HEADER Y TABLA EN GENERAL
        $style= 'align:C;paddingY:0.07;';//alinear al centro, con padding en y //
        $generalStyle= 'align:R;paddingY:1.3;';//alinear a la derecha con padding en y //
        $alternativeStyle='paddingY:1.3;';//padding en y  //

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


        $table->printRow(true);//parametro true para indicar que es un header y replicar en las paginas
        $count =0;
        foreach ($data as $key => $compra) {
            $count = $key;
           
            $table->easyCell($key+1,$alternativeStyle);
            $table->easyCell( ""   ,$alternativeStyle);
            $table->easyCell("",$alternativeStyle);
            $table->easyCell("",$alternativeStyle);
            $table->easyCell("",$alternativeStyle);
            $table->easyCell("",$alternativeStyle);
            $table->easyCell("",$alternativeStyle);
            $table->easyCell("",$alternativeStyle);
            $table->easyCell("",$alternativeStyle);
            $table->easyCell("",$alternativeStyle);
            $table->easyCell("",$alternativeStyle);
            $table->easyCell("",$alternativeStyle);
            $table->easyCell("",$alternativeStyle);
            $table->easyCell("",$alternativeStyle);
            $table->easyCell("",$alternativeStyle);
            $table->easyCell("",$alternativeStyle);
            $table->printRow();
        }
        $table->endTable(15);
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

        $pdf->Output('I', __("Delivery Receipt") . ' - No.' . 'reporte' . '.pdf');
        exit;


    }
}
