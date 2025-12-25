<?php
namespace App\Help\PDF\Contabilidad;

use App\Models\RRHH\RRHHEmpresa;
use App\Help\Help;
use App\Help\PDF\EasyTable\easyTable;
use App\Help\PDF\EasyTable\exfpdf;


class EstadoResultado
{
    public static function report($fechaInicial, $fechaFinal, $fechaReporte, $utilidades)
    {
        $nombreEmpresa = RRHHEmpresa::find(Help::empresa())->empresa;
        $pdf = new exfpdf('Estado de Resultados', null, 'P', 'mm', 'Letter');
        $pdf->setTitle('Estado de Resultados ' . $nombreEmpresa);
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetFont('Arial', '', 8);
        $styleTotal = "font-style:B; bgcolor:#F0F0F0; border-top:0.5; border-bottom:0.5; border-color:#333333;";

        $pdf->Cell(0, 5, utf8_decode($fechaReporte), 0, 1, 'C');
        $pdf->SetFont('Arial', '', 7);
        $pdf->Cell(0, 5, utf8_decode('(EXPRESADO EN DÓLARES DE LOS ESTADOS UNIDOS DE AMÉRICA)'), 0, 1, 'C');
        $pdf->Ln(5);

        $table = new easyTable($pdf, '%{40, 15, 15, 15, 15}', 'width:100%; border:0; font-size:8; paddingY:1.5;');

        foreach ($utilidades as $key => $utilidad) {
            $utilidad->calcularSaldos($fechaInicial, $fechaFinal, $utilidad->id, Help::empresa());
            $utilidad->refresh();

            foreach ($utilidad->grupos as $key => $grupo) {
                $saldoGrupo = $grupo->saldo >= 0 ? $grupo->saldo : ($grupo->saldo * -1);
                
                $table->easyCell($grupo->grupo, 'font-style:B;');
                $table->easyCell("");
                $table->easyCell("");
                $table->easyCell("");
                $table->easyCell("$ " . number_format($saldoGrupo, 2), 'align:R;');
                $table->printRow();

                foreach ($grupo->subgrupos as $key => $value) {
                    $saldoSubGrupo = $value->saldo >= 0 ? $value->saldo : ($value->saldo * -1);
                    $table->easyCell($value->sub_grupo);
                    $table->easyCell("");
                    $table->easyCell("");
                    $table->easyCell("$ " . number_format($saldoSubGrupo, 2), 'align:R;');
                    $table->printRow();

                    foreach ($value->cuentas as $key => $cuenta) {
                        $saldoCuenta = $cuenta->saldo >= 0 ? $cuenta->saldo : ($cuenta->saldo * -1);
                        $table->easyCell($cuenta->cuenta->codigo . ' - ' . $cuenta->cuenta->nombre_cuenta, 'align:R;');
                        $table->easyCell("");
                        $table->easyCell("$ " . number_format($saldoCuenta, 2), 'align:R;');
                        $table->printRow();
                    }


                }
            }

            $table->easyCell("", 'paddingY:2;');
            $table->printRow();

            $saldoUtilidad = $utilidad->calcularSaldoUtilidad($utilidad->id);

            $table->easyCell("", $styleTotal);
            $table->easyCell("", $styleTotal);
            $table->easyCell("", $styleTotal);
            

            $table->easyCell(utf8_decode($utilidad->utilidad), $styleTotal . 'align:R;');
            $table->easyCell(utf8_decode("$ " . number_format($saldoUtilidad, 2)), $styleTotal . 'align:R;');
            $table->printRow();

            $table->easyCell("");
            $table->printRow();



           

        }

        $table->endTable();
        foreach($utilidades as $key => $uti){
            $uti::where('saldo', '!=', null)->update(['saldo' => 0]);
        }
        $pdf->Output('Estado de Resultados ' . $nombreEmpresa . '.pdf', 'I');
        exit;
    }
}
