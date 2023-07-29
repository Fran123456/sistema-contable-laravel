<?php

namespace App\Help\PDF;
use Codedge\Fpdf\Fpdf\Fpdf;

class PDF extends  Fpdf
{
    public $subtittle;
    private $orientation;
    public $subtitle_font_size=11;
    public $title;

    public function __construct($subtittle=null,$orientation = 'P', $unit = 'mm', $size = 'letter',$title='')
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
        if($this->orientation=='P') {
            $this->Image(public_path('img/logo.png'), 185, 5, 18, 0, 'PNG');
            $this->SetFont('Arial', 'B', 13);
            $this->Cell(80);        // Move to the right
            $this->Cell(30, 10, $this->title??'APOPSA EL SALVADOR', 0, 0, 'C');// Title
            //TODO validar para vacio
            $this->Ln(7);
            $this->SetFont('Arial', 'B', $this->subtitle_font_size);
            $this->Cell(190, 10, $this->subtittle, 0, 0, 'C');
        }
        else{
           // $this->Image(public_path('img/logo.png'),240,5,18,0,'PNG');
            $this->SetFont('Arial','B',13);
            $this->Cell(80);// Move to the right
            $this->Cell(100,10,$this->title??'APOPSA EL SALVADOR',0,0,'C');// Title
            //TODO validar para vacio
            $this->Ln(7);
            $this->SetFont('Arial','B',$this->subtitle_font_size);
            $this->Cell(250,10,$this->subtittle,0,0,'C');
        }

        $this->Ln(12);// Line break
    }

// Page footer
    function Footer()
    {
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial','I',8);
        // Page number
        $this->Cell(0,10,utf8_decode(__('Page ')).$this->PageNo().'/{nb}',0,0,'C');
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
