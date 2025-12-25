<?php
namespace App\Help\PDF\Contabilidad;
use App\Help\Help;
use App\Models\Contabilidad\ContaRubroGeneral;
use App\Help\PDF\EasyTable\exfpdf;
use App\Models\RRHH\RRHHEmpresa;
use App\Help\PDF\EasyTable\easyTable;

class BalanceGeneral
{
    public static function report($fechaInicial, $fechaFinal, $fechaReporte)
    {
        $nombreEmpresa = RRHHEmpresa::find(Help::empresa())->empresa;
        $rubrosActivo = ContaRubroGeneral::where('signo', '+')->where('empresa_id', Help::empresa())->get();
        $rubrosPasivo = ContaRubroGeneral::where('signo', '-')->where('empresa_id', Help::empresa())->get();

        $pdf = new exfpdf('BALANCE GENERAL', null, 'L', 'mm', 'legal'); //horizontal
        $pdf->setTitle('BALANCE GENERAL ' . $nombreEmpresa);
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetFont('Arial', '', 9);
        $styleTotal = "font-style:B; bgcolor:#F0F0F0; border-top:0.5; border-bottom:0.5; border-color:#333333;";

        $pdf->Cell(0, 5, utf8_decode($fechaReporte), 0, 1, 'C');
        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(0, 5, utf8_decode('(EXPRESADO EN DÓLARES DE LOS ESTADOS UNIDOS DE AMÉRICA)'), 0, 1, 'C');
        $pdf->Ln(5);
        $pdf->SetAutoPageBreak(false);


        //medidas
        $usableWidth = $pdf->GetPageWidth()
        - $pdf->get_margin('l')
        - $pdf->get_margin('r');

        $gap = 10; // Espacio entre tablas en mm
        $half = ($usableWidth - $gap) / 2;
        $yStart = $pdf->GetY();


        //activo izquierda

         $pdf->SetXY($pdf->get_margin('l'), $yStart);

        $tableActivo = new easyTable(
            $pdf,
            '%{70,30}',
            "width:$half; align:L; border:0; font-size:9; paddingY:1.2;"
        );

        $totalActivo = 0;

        foreach ($rubrosActivo as $rubroActivo) {

            $rubroActivo->calcular($rubroActivo->id, $fechaInicial, $fechaFinal);
            $rubroActivo->refresh();

            $tableActivo->easyCell(
                strtoupper($rubroActivo->rubro),
                'colspan:2; align:C; font-style:B; font-size:11;'
            );

            $tableActivo->printRow();

            foreach($rubroActivo->grupos as $grupo){
                $tableActivo->easyCell(
                    strtoupper($grupo->grupo),
                    'font-style:B;'
                );

                $tableActivo->easyCell(
                   '$ ' . number_format($grupo->saldo, 2),
                    'align:R;'
                );

                $tableActivo->printRow();

                foreach($grupo->cuentas as $cuenta){
                    $tableActivo->easyCell(
                        $cuenta->cuenta?->codigo.' - '.$cuenta->cuenta?->nombre_cuenta
                    );
                     $tableActivo->easyCell(
                       '$ ' . number_format($cuenta->saldo, 2),
                        'align:R;'
                    );
                    $tableActivo->printRow();
                }
            }

            $totalActivo += $rubroActivo->saldo;

            $tableActivo->easyCell('', 'colspan:2;');
            $tableActivo->printRow();

           
        }

        $tableActivo->easyCell('TOTAL ACTIVO', 'font-style:B;' . $styleTotal);
        $tableActivo->easyCell('$ ' . number_format($totalActivo, 2), 'font-style:B; align:R;' . $styleTotal);
        $tableActivo->printRow();
        $tableActivo->endTable();

        $yEndActivo = $pdf->GetY();


        //pasivo derecha

        $pdf->SetXY($pdf->get_margin('l') + $half + $gap, $yStart);

        $tablePasivo = new easyTable(
            $pdf,
            '%{70,30}',
            "width:$half; align:R; border:0; font-size:9; paddingY:1.2;"
        );

        $totalPasivo = 0;

        foreach ($rubrosPasivo as $rubroPasivo) {

            $rubroPasivo->calcular($rubroPasivo->id, $fechaInicial, $fechaFinal);
            $rubroPasivo->refresh();

            $tablePasivo->easyCell(
                strtoupper($rubroPasivo->rubro),
                'colspan:2; align:C; font-style:B; font-size:11;'
            );

            $tablePasivo->printRow();

            foreach($rubroPasivo->grupos as $grupo){
                $tablePasivo->easyCell(
                    strtoupper($grupo->grupo),
                    'font-style:B;'
                );

                $tablePasivo->easyCell(
                   '$ ' . number_format($grupo->saldo, 2),
                    'align:R;'
                );

                $tablePasivo->printRow();

                foreach($grupo->cuentas as $cuenta){
                    $tablePasivo->easyCell(
                        $cuenta->cuenta?->codigo.' - '.$cuenta->cuenta?->nombre_cuenta
                    );
                     $tablePasivo->easyCell(
                       '$ ' . number_format($cuenta->saldo, 2),
                        'align:R;'
                    );
                    $tablePasivo->printRow();
                }
            }

            $totalPasivo += $rubroPasivo->saldo;

            $tablePasivo->easyCell('', 'colspan:2;');
            $tablePasivo->printRow();

           
        }

        $tablePasivo->easyCell('TOTAL PASIVO', 'font-style:B;' . $styleTotal);
        $tablePasivo->easyCell('$ ' . number_format($totalPasivo, 2), 'font-style:B; align:R;' . $styleTotal);
        $tablePasivo->printRow();
        $tablePasivo->endTable();
        $yEndPasivo = $pdf->GetY();


        $pdf->SetY(max($yEndActivo, $yEndPasivo));

        $pdf->Ln(20); 

        $tableFirmas = new easyTable($pdf, 3, 'align:C; width:'.$usableWidth.'; border:0; font-size:8; font-style:I;');
        $tableFirmas->easyCell('ELABORADO POR', 'align:C');
        $tableFirmas->easyCell('REVISADO POR', 'align:C');
        $tableFirmas->easyCell('AUTORIZADO POR', 'align:C');
        $tableFirmas->printRow();
        $tableFirmas->endTable();






        $pdf->Output('Balance General ' . $nombreEmpresa . '.pdf', 'I');
        exit;
        
    }
}