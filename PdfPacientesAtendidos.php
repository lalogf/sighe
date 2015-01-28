<?php  
 session_start();
    require_once('LIBRERIAS/pdf/fpdf.php');
    require_once('LIBRERIAS/pdf/pdftable.php');
    require_once('CADO/ClaseHemodialisis.php');
$ohemodialisis=new Hemodialisis();
$inicio=implode('/',array_reverse(explode('-',$_GET[inicio])));
$fin=implode('/',array_reverse(explode('-',$_GET[fin])));   


   
  
 /*$ver=$ohemodialisis->RestaFechas($_GET[inicio],$_GET[fin]);
    while($fila=$ver->fetch()){
	$resta=$fila[0]; 
   }*/
$pdf=new FPDF('P','mm');
$pdf=new Pdf_Table('P','mm','Letter'); // vertical, milimetros y tamaño
$pdf->Open(); 
$pdf->AliasNbPages();
// mandamos el pdf a la pantalla
$pdf->SetFont('Arial','BIU',12);
$pdf->AddPage();    
$pdf->SetY(15);
$pdf->Text(65,15,"RELACION DE  PACIENTES ATENDIDOS ");
$pdf->SetFont('Arial','I',10); 
$pdf->Text(76,20,"Desde: ".$inicio."  Hasta: ".$fin);
$pdf->setY(30);
$pdf->SetFont('Arial','BIU',9);
$pdf->Text(12,30,"No"); $pdf->Text(22,30,"Paciente"); $pdf->Text(66,30,"N");	

 $dia=$ohemodialisis->DiasSemana($_GET[inicio]);
 $numero_dia=$ohemodialisis->NumDia($dia);$x=76;
 for($i=1;$i<=7;$i++){
	if($numero_dia==6){
		$nombre_dia=$ohemodialisis->DiasSemana_Num($numero_dia);
		$pdf->Text($x,30,$nombre_dia);
		$numero_dia=0;
		}else{
		 $x=$x+9;	
		 $nombre_dia=$ohemodialisis->DiasSemana_Num($numero_dia);
		 $pdf->Text($x,30,$nombre_dia);
		 $numero_dia++;	
			} 
	 	
   }
$pdf->Text(137,30,"Total Ate.");$pdf->Text(154,30,"Autogenerado");$pdf->Text(180,30,"DNI");   
$pdf->setY(33);
$y=33;
 $pdf->SetWidths(array(10,45,9,9,9,9,9,9,9,9,15,25,15));$i=0;
 $listar=$ohemodialisis->ReporteAtencionPacientes($_GET[inicio],$_GET[fin],$_SESSION['S_idsucursal']);
 $pdf->SetFont('Arial','I',7);
 while($fila=$listar->fetch()){
	  if($y>=252){
			 $pdf->AddPage();   
             $pdf->SetY(15);
             $pdf->Text(65,15,"RELACION DE  PACIENTES ATENDIDOS ");
             $pdf->SetFont('Arial','I',10); 
             $pdf->Text(76,20,"Desde: ".$inicio."  Hasta: ".$fin);
             $pdf->setY(30);
             $pdf->SetFont('Arial','BIU',9);
             $pdf->Text(12,30,"No"); $pdf->Text(22,30,"Paciente"); $pdf->Text(66,30,"N"); 
			 $dia=$ohemodialisis->DiasSemana($_GET[inicio]);
             $numero_dia=$ohemodialisis->NumDia($dia);$x=76;
          for($i=1;$i<=7;$i++){
	        if($numero_dia==6){
		      $nombre_dia=$ohemodialisis->DiasSemana_Num($numero_dia);
		      $pdf->Text($x,30,$nombre_dia);
		      $numero_dia=0;
		    }else{
		      $x=$x+9;	
		      $nombre_dia=$ohemodialisis->DiasSemana_Num($numero_dia);
		      $pdf->Text($x,30,$nombre_dia);
		      $numero_dia++;	
			 }  	
          }
         $pdf->Text(137,30,"Total Ate.");$pdf->Text(154,30,"Autogenerado");$pdf->Text(180,30,"DNI");   
         $pdf->setY(33);
         $y=33;
         $pdf->SetWidths(array(10,45,9,9,9,9,9,9,9,9,15,25,15));$i=0;
         $pdf->SetFont('Arial','I',7);
	     }
	 $i++;
     $pdf->Row(array($i,substr($fila[0],0,30),$fila[1],$fila[2],$fila[3],$fila[4],$fila[5],$fila[6],$fila[7],$fila[8],$fila[9],$fila[10],$fila[11]));
	 $y=$y+5.2;
  }

     $pdf->SetFont('Arial','B',10);
     $pdf->Ln();  
     $pdf->Output();    
?>