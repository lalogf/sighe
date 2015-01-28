<?php
require('fpdf.php'); 

class Pdf_Table extends FPDF 
{ 
var $widths; 
var $aligns; 

function SetWidths($w) 
{   
    //Set the array of column widths 
    $this->widths=$w; 
} 

function SetAligns($a) 
{ 
    //Set the array of column alignments 
    $this->aligns=$a; 
} 

function Row($data) 
{ 
    //Calculate the height of the row
	
    $nb=0; 
    for($i=0;$i<count($data);$i++) 
        $nb=max($nb,$this->NbLines($this->widths[$i],$data[$i])); 
    $h=4*$nb; 
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
		$this->SetLineWidth(0.2); 
		//$this->SetFillColor(5,5,5);
        $this->Rect($x,$y,$w,$h); 
        //Print the text 
		
        $this->MultiCell($w,5,$data[$i],0,$a); 
        //Put the position to the right of the cell 
        $this->SetXY($x+$w,$y); 
    } 
    //Go to the next line 
    $this->Ln($h); 
} 

function RowSinBorder($data) 
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
        $this->Rect(0,0,0,0); 
        //Print the text 
		
        $this->MultiCell($w,5,$data[$i],0,$a); 
        //Put the position to the right of the cell 
        $this->SetXY($x+$w,$y); 
    } 
    //Go to the next line 
    $this->Ln($h); 
} 

function CheckPageBreak($h) 
{ 
    //If the height h would cause an overflow, add a new page immediately 
    if($this->GetY()+$h>$this->PageBreakTrigger) 
        $this->AddPage($this->CurOrientation); 
} 



function NbLines($w,$txt) 
{ 
    //Computes the number of lines a MultiCell of width w will take 
    $cw=&$this->CurrentFont['cw']; 
    $this->SetDrawColor(0, 0,0);  
    $this->SetLineWidth(.5);   
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




	function LoadData($file)
	{
	//Leer las líneas del fichero
		$lines=file($file);
		$data=array();
		foreach($lines as $line)
			$data[]=explode(';',chop($line));
			return $data;
	}

	//Tabla simple
	function BasicTable($header,$data)
	{
		//Cabecera
		foreach($header as $col)
			$this->Cell(40,7,$col,1);
			$this->Ln();
		//Datos
		foreach($data as $row)
		{
			foreach($row as $col)
				$this->Cell(40,6,$col,1);
			$this->Ln();
		}
	}
	//Una tabla más completa
	function ImprovedTable($header,$data)
	{
		//Anchuras de las columnas
		$w=array(40,35,40,45);
		//Cabeceras
		for($i=0;$i<count($header);$i++)
		$this->Cell($w[$i],7,$header[$i],1,0,'C');
		$this->Ln();
		//Datos
		foreach($data as $row)
		{
			$this->Cell($w[0],6,$row[0],'LR');
			$this->Cell($w[1],6,$row[1],'LR');
			$this->Cell($w[2],6,number_format($row[2]),'LR',0,'R');
			$this->Cell($w[3],6,number_format($row[3]),'LR',0,'R');
			$this->Ln();
		}
		//Línea de cierre
		$this->Cell(array_sum($w),0,'','T');
	}

	//Tabla coloreada
	function FancyTable($header,$data)
	{
		//Colores, ancho de línea y fuente en negrita
		$this->SetFillColor(0,0,0);  //color de fondo de la celda
		$this->SetTextColor(255);    //color usado por el texto
		$this->SetDrawColor(0,0,0);  //color usado para las operaciones de graficación (lineas, rectangulos, y bordes de celdas )
		$this->SetLineWidth(0.3);     //Define el ancho de la línea. Por defecto, el valor es igual a 0.2 mm.
		$this->SetFont('Arial','B',10);
		//Cabecera
		$w=array(40,35,120);
		for($i=0;$i<count($header);$i++)
			$this->Cell($w[$i],7,$header[$i],1,0,'C',1);
		$this->Ln();
		//Restauración de colores y fuentes
		$this->SetFillColor(224,235,255);
		$this->SetTextColor(0);
		$this->SetFont('');
		//Datos
		$fill=false;
		foreach($data as $row)
		{
			$this->Cell($w[0],6,$row[0],'LR','','L',$fill);
			$this->Cell($w[1],6,$row[1],'LR','','L',$fill);
			$this->Cell($w[2],6,number_format($row[2]),'LR','','R',$fill);
			$this->Ln();
			$fill=!$fill;
		}
		$this->Cell(array_sum($w),0,'','T');
	}

//------------------------------------------------

 /* function Header()
 {
//logo
//$this->Image('Imatges/logoescola.jpg',10,10,40);
   $this->SetFont('Arial','I',8);
   $this->Text(15,20,'REPORTE NORLAB');
   $this->Text(170,20,'Pagina : '.$this->PageNo()."/{nb}",0,0,'C');
 //$this->SetFont('Arial','I',12);
   $this->Text(15,21,'_______________________________________________________________________________________________________________________');
  
 }*/ 
/* function Footer()
{
$this->SetY(-15);
$this->SetFont('Arial','I',8);
$this->Cell(0,10,'REPORTE',0,0,'C',0,1);
//$this->SetY(-10);
//$this->SetFont('Arial','',8);
//número de pàgina
//$this->PageNo();
 }*/
 
}  
?>