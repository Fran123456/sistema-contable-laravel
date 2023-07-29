<?php

namespace App\Help\PDF;

class PDF_MC_Table extends PDF
{
    public $widths;
    public $aligns;
    public $headers;
    public $tableTitle;
    public $tableTitleValue;

    public function SetWidths($w)
    {
        //Set the array of column widths
        $this->widths=$w;
    }

    public function SetAligns($a)
    {
        //Set the array of column alignments
        $this->aligns=$a;
    }

    public function Row($data)
    {
        //Calculate the height of the row
        $nb=0;
        for($i=0;$i<count($data);$i++)
            $nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
        $h=5*$nb;
        //Issue a page break first if needed
        $this->CheckPageBreak($h);
        //Draw the cells of the row
        for($i=0;$i<count($data);$i++)
        {
            $w=$this->widths[$i];
            $a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
            //Save the current position
            $x=$this->GetX();
            $y=$this->GetY();
            //Draw the border
            $this->Rect($x,$y,$w,$h);
            //Print the text
            $this->MultiCell($w,5,$data[$i],0,$a);
            //Put the position to the right of the cell
            $this->SetXY($x+$w,$y);
        }
        //Go to the next line
        $this->Ln($h);
    }

    public function printTableTitle(){
        $h=5;
        $total_width=array_sum($this->widths);
        $this->Cell($total_width,$h,$this->tableTitleValue,1,0,'L');
        $this->Ln();
    }

    public function printTableHeader($data){
        $h=5;
        $nb=0;
        for($i=0;$i<count($data);$i++)
            $nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
        $h=5*$nb;
        for($i=0;$i<count($this->widths);$i++)
        {
            $w=$this->widths[$i];
            $a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
            //Save the current position
            $x=$this->GetX();
            $y=$this->GetY();
            //Draw the border
            $this->Rect($x,$y,$w,$h);
            //Print the text
            $this->MultiCell($w,$h,$this->headers[$i],0,$a);
            //Put the position to the right of the cell
            $this->SetXY($x+$w,$y);
        }
        $this->Ln();
    }

    public function printTableFooter($data,$align=array()){//Actualmente $data solo soporta celdas consecutivas y se agregan celdas en blanco antes y después de ellas.
        //Cada celda en $data debe llevar su alineado correspondiente para la misma clave en $align
        $h=5;
        $keys=array_keys($data);
        $total_keys=sizeof($keys);
        $first_key=$keys[0];
        $last_key=$keys[$total_keys-1];
        $width_ini=0;
        $total_widths=count($this->widths);
        for($i=0;$i<$first_key;$i++){//Celdas en blanco antes de $data
            $width_ini+=$this->widths[$i];
        }
        //$this->Cell($width_ini,$h,'',1,0,'L');
        foreach($keys AS $key){
            $width_temp=$this->widths[$key];
            if($key==$first_key){//A la primera Key se le agrega el ancho de todas las celdas anteriores para que quede en blanco
                $width_temp+=$width_ini;
            }
            $this->Cell($width_temp,$h,$data[$key],1,0,$align[$key]);
        }
        $next_key=$last_key+1;
        for($i=$next_key;$i<$total_widths;$i++){//Celdas en blanco después del contenido del footer
            $this->Cell($this->widths[$i],$h,'',1,0,'L');
        }
        $this->Ln();
    }

    public function addPageTitle(){
        $this->SetFont(null, 'B');
        if ($this->tableTitle) {//Imprime linea de título que va encima del header
            $this->printTableTitle();
        }
        $this->printTableHeader();
        $this->SetFont(null, '');
    }
    private function NbLines($w,$txt)
    {
        //Computes the number of lines a MultiCell of width w will take
        $cw=&$this->CurrentFont['cw'];
        if($w==0)
            $w=$this->w-$this->rMargin-$this->x;
        $wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
        $s=str_replace("\r",'',$txt);
        $nb=strlen($s);
        if($nb>0 and $s[$nb-1]=="\n")
            $nb--;
        $sep=-1;
        $i=0;
        $j=0;
        $l=0;
        $nl=1;
        while($i<$nb)
        {
            $c=$s[$i];
            if($c=="\n")
            {
                $i++;
                $sep=-1;
                $j=$i;
                $l=0;
                $nl++;
                continue;
            }
            if($c==' ')
                $sep=$i;
            $l+=$cw[$c];
            if($l>$wmax)
            {
                if($sep==-1)
                {
                    if($i==$j)
                        $i++;
                }
                else
                    $i=$sep+1;
                $sep=-1;
                $j=$i;
                $l=0;
                $nl++;
            }
            else
                $i++;
        }
        return $nl;
    }
}
