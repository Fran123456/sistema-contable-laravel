<?php

namespace App\ReportsPDF\Contabilidad;

use App\Help\PDF\EasyTable\easyTable;
use App\Help\PDF\EasyTable\exfpdf;
use App\Help\Help;
use App\Help\PDF\EasyTable\Styles;
use App\Help\Contabilidad\ReportesContables;

class SaldoCuentaRpt
{
    
    public static function report($fechai, $fechaf, $data, $saldo, $cuenta){
        $n=0;
        $pdf = new exFPDF('REPORTE DE SALDO DE CUENTAS', "DEL " . Help::date($fechai) . " AL " .  Help::date($fechaf)   , 'P', 'mm', 'legal');
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetFont('Arial','',7);

        $c=new easyTable($pdf, '%{100}','width:300; font-size:10;');
        $c->easyCell($cuenta->nombre_cuenta." - " . $cuenta->codigo);
        $c->printRow();
        $c->endTable(3);

        //ESTILOS POR DEFECTO PARA CELDAS DEL HEADER Y TABLA EN GENERAL
        $style= Styles::alignPaddingY('1.07', 'C');
        $generalStyle= Styles::alignPaddingY('1.13','C');
        $alternativeStyle=Styles::paddingY('1.13');
        $numberStyle= Styles::alignPaddingY('1.13','R');

        //el % de la tabla debe ser 100 en su total si no no funciona.
        $table = new easyTable($pdf, '%{5,10,10,38,12,12,13}','width:550; border-color:#3C4048;border-width:0.2; font-size:8; border:0; paddingY:1.3;');
        $table->rowStyle('font-style:B;font-color:#3F3F3F;valign:M;');
        $table->easyCell("No", $style.'border:B;');//rowspan es para combinar columnas
        $table->easyCell('Fecha',$style.'border:B;');
        $table->easyCell("Partida",$style.'border:B;');
        $table->easyCell("Concepto",$style.'border:B;');
        $table->easyCell("Debe",$style.'border:B;');
        $table->easyCell("Haber",$style.'border:B;');
        $table->easyCell("Saldo",$style.'border:B;');
        $table->printRow(true);//parametro true para indicar que es un header y replicar en las paginas
        $count =0;

        $table->easyCell("",$alternativeStyle);
        $table->easyCell(""  ,$alternativeStyle);
        $table->easyCell(""  ,$alternativeStyle);
        $table->easyCell( "",$alternativeStyle);
        $table->easyCell( "",$numberStyle);
        $table->easyCell("",$numberStyle);
        $table->easyCell(number_format($saldo,2 ),$numberStyle);
        $table->printRow();

        $debe = 0;
        $haber = 0;
        $saldoAc = 0;
        $saldoIns =$saldo;
        foreach ($data as $key => $dt) {
            $count = $key;
            $table->easyCell($key+1,$alternativeStyle);
            $table->easyCell(  Help::date($dt->fecha_contable)  ,$alternativeStyle);
            $table->easyCell( $dt->partida->tipoPartida->tipo.$dt->cuentaContable->codigo  ,$alternativeStyle);
            $table->easyCell( utf8_decode($dt->concepto) ,$alternativeStyle);
            $table->easyCell( number_format($dt->debe,2 ),$numberStyle);
            $table->easyCell(number_format($dt->haber,2 ),$numberStyle);
            $saldoIns = ReportesContables::saldoAcreedorDeudor($dt->debe,$dt->haber, $saldoIns, $cuenta->tipo_cuenta);
            $table->easyCell( number_format($saldoIns,2) ,$numberStyle);
            $table->printRow();
            $debe = $dt->debe+$debe;
            $haber = $haber + $dt->haber;
            $saldoAc =$saldoIns;
        }

       
            $table->easyCell("",$alternativeStyle.'border:T;');
            $table->easyCell( "" ,$alternativeStyle.'border:T;');
            $table->easyCell( ""  ,$alternativeStyle.'border:T;');
            $table->easyCell( "",$alternativeStyle.'border:T;');
            $table->easyCell( number_format($debe,2 ),$numberStyle.'border:T;');
            $table->easyCell(number_format($haber,2 ),$numberStyle.'border:T;');
            

            $table->easyCell("",$numberStyle.'border:T;');
            $table->printRow();

        $table->endTable(15);
        //salto de tabla dinamico
       /* $decimal = $count / 27;
        if($decimal ==null){
        }else{
            $decimal = explode(".", $decimal);
            $decimal = $decimal[1];
            if($decimal >814814815){
                $space=new easyTable($pdf, 1,'width:260; font-size:10;');
                $space->endTable(20);
            }//salto de tabla dinamico
        }*/

       

        $pdf->Output('I', __("Delivery Receipt") . ' - No.' . 'reporte' . '.pdf');
        exit;


    }
}
