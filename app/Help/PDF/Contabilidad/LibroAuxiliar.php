<?php

namespace App\Help\PDF\Contabilidad;

use App\Help\Contabilidad\ReportesContables;
use App\Help\Help;
use App\Help\PDF\EasyTable\exfpdf;
use App\Models\Contabilidad\ContaClasificacionCuenta;
use App\Help\PDF\EasyTable\easyTable;
use App\Models\Contabilidad\ContaCuentaContable;
use App\Help\PDF\EasyTable\Styles;
use App\Models\Contabilidad\ContaPartidaContable;

class LibroAuxiliar
{
    public static function report($fechaInicial, $fechaFinal, $cuentaInicial, $cuentaFinal)
    {
        $c  = ContaClasificacionCuenta::where('clasificacion', 'detalle')
        ->where('empresa_id', Help::empresa())->first();
        $total = ReportesContables::getTotalDeCuentasRango($cuentaInicial, $cuentaFinal, $fechaInicial, $fechaFinal, $c->id);
        
        $pdf = new exFPDF('LIBRO AUXILIAR DE CUENTAS', " DEL " . Help::date($fechaInicial) . " AL " . Help::date($fechaFinal), 'P', 'mm', 'legal');
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetFont('Arial', '', 7);

        $table = new easyTable($pdf, '%{10,60,10,10,10}','width:550; border-color:#3C4048;border-width:0.2; font-size:7.5; border:0; paddingY:1.3;');
        foreach ($total as $key => $value) {
            
            $cuenta = ContaCuentaContable::find($value->id);
            $item = ReportesContables::getTransactiosDetails($cuenta->id,$fechaInicial,$fechaFinal);
            $saldo = ReportesContables::getSaldo($cuenta->id,null,$fechaInicial);

            if(!empty($item) && isset($item[0])){
                $table->easyCell("", "colspan:6;" );
                $table->printRow();
                $table->easyCell($item[0]->codCuenta .' '.$item[0]->nombre_cuenta, 'colspan:3;font-style:B; font-size:8');
                $table->easyCell("Saldo: ".number_format($saldo,2), 'colspan:3;font-style:B; align:R; font-size:8');
                $table->printRow();
            }

            $totalDebe = 0;
            $totalHaber = 0;
            $cuenta = "";
            $cuentaModel = ContaCuentaContable::find($value->id);
            $style= Styles::alignPaddingY('1.07', 'C');


            foreach ($item as $key => $transaccion) {
                $totalDebe += $transaccion->debe;
                $totalHaber += $transaccion->haber;

                $codigo = substr($transaccion->codCuenta, 0, 1);
                if( $codigo== "1" || $codigo== "4"){
                    if($transaccion->debe != 0)
                        $saldo = $saldo + $transaccion->debe ;
                    if($transaccion->haber != 0)
                        $saldo = $saldo - $transaccion->haber;
                }else{
                    if($transaccion->debe != 0)
                        $saldo = $saldo - $transaccion->debe ;
                    if($transaccion->haber != 0)
                        $saldo = $saldo + $transaccion->haber;
                }

                if($cuenta != $cuentaModel->codigo){

                    $table->rowStyle('font-style:B;font-color:#3F3F3F;valign:M;');
                    $table->easyCell("Fecha", $style);
                    $table->easyCell("Concepto",$style . 'align:C;');
                    $table->easyCell("Debe",$style . 'align:R;');
                    $table->easyCell("Haber",$style . 'align:R;');
                    $table->easyCell("Saldo",$style . 'align:R;');
                    $table->printRow();
                    $cuenta = $cuentaModel->codigo;
                    
                }
                $partida = ContaPartidaContable::find($transaccion->partidaId);
                $concepto  = Help::codigoPartida($partida) ." - ".utf8_decode($transaccion->concepto);


                $table->easyCell(date('d/m/Y', strtotime($transaccion->fecha_contable)));
                $table->easyCell($concepto);
                $table->easyCell(number_format($transaccion->debe,2), 'align:R;');
                $table->easyCell(number_format($transaccion->haber,2), 'align:R;');
                $table->easyCell(number_format($saldo,2), 'align:R;');
                $table->printRow();


              
            }
            $table->easyCell("","colspan:2;border:T;" );
            $table->easyCell(number_format($totalDebe,2) ,"align:R; font-style:B;border:T;");
            $table->easyCell(number_format($totalHaber,2)  ,"align:R; font-style:B;border:T;" );
            $table->easyCell(number_format($saldo,2),"align:R; font-style:B;border:T;" );
            $table->printRow();

        }

        $table->endTable(15);

        $pdf->Output('I', 'libro-auxiliar-del' . Help::date($fechaInicial) . "-al-" . Help::date($fechaFinal) . '.pdf');
        exit;
        

    }
}
