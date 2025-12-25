<?php

namespace App\Help\PDF;
use Codedge\Fpdf\Fpdf\Fpdf;
use App\Help\Help;

class PDF extends  Fpdf
{
    public $subtittle;
    private $orientation;
    public $subtitle_font_size=11;
    public $title;

    public function __construct($title=null,$subtittle=null,$orientation = 'P', $unit = 'mm', $size = 'letter')
    {
        parent::__construct($orientation, $unit, $size);
        $this->subtittle = $subtittle;
        $this->orientation = $orientation;
        $this->title = $title;
    }


    function Header()
    {
        // Logo
        // dd(public_path('images\logo.png'));
        // if($this->orientation=='P') {

        //    // $this->Image(public_path(  Help::getConfigByKey('general','logo')->value   ), 185, 12, 18, 0, 'PNG');
        //     $this->SetFont('Arial', 'B', 13);
        //     $this->Cell(80);        // Move to the right
        //     $this->Cell(30, 10, Help::usuario()->empresa->empresa, 0, 0, 'C');// Title
        //     $this->Ln(7);
        //     $this->Cell(80);  
        //     $this->Cell(30, 10, $this->title, 0, 0, 'C');// Title

        //     //TODO validar para vacio
        //     $this->Ln(7);
        //     $this->SetFont('Arial', 'B', $this->subtitle_font_size);
        //     $this->Cell(190, 10, $this->subtittle, 0, 0, 'C');
        // }
        // else{
        //   //  $this->Image(public_path( Help::getConfigByKey('general','logo')->value ),240,5,18,0,'PNG');
        //     $this->SetFont('Arial','B',13);
        //     $this->Cell(80);// Move to the right
        //     $this->Cell(100,10,$this->title??Help::usuario()->empresa->empresa,0,0,'C');// Title
        //     //TODO validar para vacio
        //     $this->Ln(7);
        //     $this->SetFont('Arial','B',$this->subtitle_font_size);
        //     $this->Cell(250,10,$this->subtittle,0,0,'C');
        // }

        // $this->Ln(12);// Line break
        $pageWidth = $this->GetPageWidth();
        $usableWidth = $pageWidth - $this->lMargin - $this->rMargin;

        // Empresa
        $this->SetFont('Arial', 'B', 13);
        $this->SetX($this->lMargin);
        $this->Cell($usableWidth, 8, Help::usuario()->empresa->empresa, 0, 1, 'C');

        // Título
        if ($this->title) {
            $this->SetFont('Arial', 'B', 12);
            $this->Cell($usableWidth, 7, $this->title, 0, 1, 'C');
        }

        // Subtítulo
        if ($this->subtittle) {
            $this->SetFont('Arial', 'B', $this->subtitle_font_size);
            $this->Cell($usableWidth, 7, $this->subtittle, 0, 1, 'C');
        }

        $this->Ln(5);
    }

// Page footer
    function Footer()
    {
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial','I',8);
        // Page number
        $this->Cell(0,10,utf8_decode(__('Página ')).$this->PageNo().'/{nb}',0,0,'C');
    }

    public function CheckPageBreak($h)
    {
        $result=false;
        //If the height h would cause an overflow, add a new page immediately
        if($this->GetY()+$h>$this->PageBreakTrigger) {
            $this->AddPage($this->CurOrientation);
            $result=true;
        }
        return $result;
    }

}
