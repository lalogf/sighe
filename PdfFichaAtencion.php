<?php  
    require_once('LIBRERIAS/pdf/fpdf.php');
    require_once('LIBRERIAS/pdf/pdftable.php');
    require_once('CADO/ClaseHisFichas.php');
     $oficha =new HistorialFichas();
	 $idficha=$_GET['id'];
	 $listar=$oficha->VerFichaPaciente($idficha);
      while($fila=$listar->fetch()){
		$paciente=$fila['paciente']; 
		$fecha_nac=implode('/',array_reverse(explode('-',$fila['fecha_nac']))); 
        $fecha_ate=explode(' ',$fila['fecha_ate']);
	    $fecha_ate=implode('/',array_reverse(explode('-',$fecha_ate[0]))).' '.$fecha_ate[1];
	     if($fila['sexo']=='M'){
			 $sexo='MASCULINO';
			 }else{$sexo='FEMENINO';}
		 $lunes=$fila['lunes'];
		 $martes=$fila['martes'];
		 $miercoles=$fila['miercoles'];
		 $jueves=$fila['jueves'];
		 $viernes=$fila['viernes'];
		 $sabado=$fila['sabado'];
		 $domingo=$fila['domingo'];
		 $edad=$fila['edad'];
		 $edad_tipo=$fila['edad_tipo'];
		 $gruposanguineo=$fila['gruposanguineo'];
		 $factor_sanguineo=$fila['factorsanguineo'];
		 $dire_actual=$fila['di_actual'];
		 $telefono=$fila['telef'];  
 		 $cont_emergencia=$fila['contac_emerg'];  
 		 $telef_emergencia=$fila['telef_emerg'];  
 		 $fech_id=$fila['fecha_inicio_dialisis'];  
 		 $fech_ids=$fila['fecha_inicio_dialisis_rinon'];  
		 $cie10=$fila['cie10'];  
 		 $diagnostico=$fila['diagnostico_inicio'];
		 $peso_seco=$fila['peso_seco'];
		 $alergico_a=$fila['alergico_a'];
		 $s_hiv=$fila['s_hiv'];
		 $s_hvc=$fila['s_hvc'];
		 $s_ag_hbs=$fila['s_ag_hbs'];
		 $con_n=$fila['con_n'];
		 $con_p=$fila['con_p'];  
		 $con_pp=$fila['con_pp'];
		 $inmunizacion_fecha_1=$fila['inmunizacion_fecha_1'];
		 $inmunizacion_fecha_2=$fila['inmunizacion_fecha_2'];		 
		 $inmunizacion_fecha_3=$fila['inmunizacion_fecha_3'];
		 $inmunizacion_fecha_1ref=$fila['inmunizacion_fecha_1ref'];
		 $inmunizacion_fecha_2ref=$fila['inmunizacion_fecha_2ref'];
		 $inmunizacion_responsable_1=$fila['inmunizacion_responsable_1'];
		 $inmunizacion_responsable_2=$fila['inmunizacion_responsable_2'];
		 $inmunizacion_responsable_3=$fila['inmunizacion_responsable_3'];
		 $inmunizacion_responsable_1ref=$fila['inmunizacion_responsable_1ref'];
		 $inmunizacion_responsable_2ref=$fila['inmunizacion_responsable_2ref'];		 
	  }	 
	  
	  $listar_cie10=$oficha->VerCie10($cie10);  
	  while($fila=$listar_cie10->fetch()){		  
		  $dx_cie10=$fila['dx_des'];
		  }
		  
	 /*$Datos=$ousuario->buscarId($idpaciente);
	  while($row=$datos->fetch()){
		  $pac=$row[0];
		  $historia=$row[1];
		  $nac=implode('/',array_reverse(explode('-',$row[3])));
		  $registro=implode('/',array_reverse(explode('-',$row[4])));
	
		}*/
	  // Creación del objeto de la clase heredad

$pdf=new FPDF('P','mm');
$pdf=new Pdf_Table('P','mm','Letter'); // vertical, milimetros y tamaño
$pdf->Open(); 
$pdf->AliasNbPages();
// mandamos el pdf a la pantalla
$pdf->SetFont('Arial','I',7);
$pdf->AddPage();    
$pdf->SetY(7);
$pdf->Text(15,8,"RAZON SOCIAL : MARIA AUXIALIADORA"/*.$pac*/);$pdf->Text(170,8,"FECHA IMPRESION : ".date('d/m/Y'));$pdf->Ln(8);
$pdf->Text(15,12,"RUC                    : 12345678901");          $pdf->Text(170,12,"HORA IMPRESION  : ".date('h:i:s'));$pdf->Ln(8);
$pdf->SetFont('Arial','BU',12);
$pdf->Text(85,25,"FICHA DE INGRESO ");$pdf->Ln(8);
$pdf->SetFont('Arial','I',8);
$pdf->Text(15,35,"PACIENTE                    : ".$paciente);$pdf->Text(110,35,"FEC. ATE.    : ".$fecha_ate);$pdf->Ln(8);
$pdf->Text(15,43,"SEXO                            :  ".$sexo);$pdf->Text(110,43,"FEC. NAC.    : ".$fecha_nac);
$pdf->Text(170,43,"EDAD ATE.   : ".$edad);$pdf->Ln(8);
$pdf->Text(15,51,"GRUPO SANGUINEO  :  ".$gruposanguineo);$pdf->Text(110,51,"FACTOR RH :  (".$factor_sanguineo.")");$pdf->Ln(8);
$pdf->MultiCell(0,5,"     DIRECCION ACTUAL  :  ".$dire_actual);$pdf->Ln(5);
$pdf->Text(15,67,"TELEFONO                  :  ".$telefono);$pdf->Ln(8);
$pdf->Text(15,75,"CONT. EMERGENCIA :  ".$cont_emergencia);$pdf->Text(110,75,"TELEF. EMERG. :  ".$telef_emergencia);$pdf->Ln(8);
$pdf->Text(15,83,"FECHA INICIO DIALISIS :  ".$fech_id);$pdf->Text(110,83,"FECHA INICIO DIALISIS SUCU1 :  ".$fech_ids);$pdf->Ln(8);
$pdf->Text(15,92,"CIE 10                           :  ".$cie10.'    '.$dx_cie10);$pdf->Ln(8);
$pdf->Cell(40,5,"   DIAGNOSTICO             : ");$pdf->MultiCell(0,5,$diagnostico);$pdf->Ln(5);
$pdf->SetFont('Arial','BU',10);
$pdf->Cell(75,5,"SEROLOGIA",0,0,'R');$pdf->Cell(0,5,"CONCLUSION",0,0,'C');$pdf->Ln(5);
$pdf->SetFont('Arial','I',8);
  if($con_n==1){
	  $valor_n="true";
  }else{$valor_n="";}
  if($con_p==1){
	  $valor_p="true";
  }else{$valor_p='';}
  if($con_pp==1){
	  $valor_pp="true";
  }else{$valor_pp='';}
  
  if($s_hiv==1){
	  $valor_hiv="POSITIVO";
  }else{$valor_hiv="NEGATIVO";}
  if($s_hvc==1){
	  $valor_hvc="POSITIVO";
  }else{$valor_hvc="NEGATIVO";}
  if($s_ag_hbs==1){
	  $valor_hbs="POSITIVO";
  }else{$valor_hbs="NEGATIVO";}
$pdf->SetFillColor(0,10,30);
$pdf->Cell(100,5,"   HIV          : ".$valor_hiv,0,0,'C');$pdf->Cell(30,5,"NEGATIVO        :",0,0,'L');$pdf->Cell(3,3,'',1,0,'C',$valor_n);$pdf->Ln(5);
$pdf->Cell(100,5,"   HVC        : ".$valor_hvc,0,0,'C');$pdf->Cell(30,5,"POSITIVO (+)    :",0,0,'L');$pdf->Cell(3,3,'',1,0,C,$valor_p);$pdf->Ln(5);
$pdf->Cell(100,5,"   Ag HBS    : ".$valor_hbs,0,0,'C');$pdf->Cell(30,5,"POSITIVO (++)  :",0,0,'L');$pdf->Cell(3,3,'',1,0,C,$valor_pp);$pdf->Ln(10);
$pdf->SetFont('Arial','BU',10);
$pdf->Cell(0,5," INMUNIZACION PARA HEPATIITS B ",0,0,'C');$pdf->Ln(7);
$pdf->SetFont("Arial","B","10");
$pdf->Cell("40","5","DOSIS",1,0,C);$pdf->Cell("50","5","FECHA",1,0,C);$pdf->Cell("0","5","RESPONSABLE",1,0,C);$pdf->Ln(5);
$pdf->SetFont("Arial","I","8");
$pdf->Cell("40","5","I",1,0,C);$pdf->Cell("50","5",$inmunizacion_fecha_1,1,0,C);$pdf->Cell("0","5",$inmunizacion_responsable_1,1,0,C);$pdf->Ln(5);
$pdf->Cell("40","5","II",1,0,C);$pdf->Cell("50","5",$inmunizacion_fecha_2,1,0,C);$pdf->Cell("0","5",$inmunizacion_responsable_2,1,0,C);$pdf->Ln(5);
$pdf->Cell("40","5","III",1,0,C);$pdf->Cell("50","5",$inmunizacion_fecha_3,1,0,C);$pdf->Cell("0","5",$inmunizacion_responsable_3,1,0,C);$pdf->Ln(5);
/*$pdf->Cell("40","5","1er REFUERZO",1,0,C);$pdf->Cell("50","5",$inmunizacion_fecha_1ref,1,0,C);$pdf->Cell("0","5",$inmunizacion_responsable_1ref,1,0,C);$pdf->Ln(5);
$pdf->Cell("40","5","2do REFUERZO",1,0,C);$pdf->Cell("50","5",$inmunizacion_fecha_2ref,1,0,C);$pdf->Cell("0","5",$inmunizacion_responsable_2ref,1,0,C);*/$pdf->Ln(10);

$pdf->SetFont("Arial","I",9);
$pdf->Cell(40,5,"    Peso seco: ".$peso_seco." kg");$pdf->Ln(5);
$pdf->Cell(55,5,"    Frecuencia de Hemodialisis:");
 if($lunes==1){
	$pdf->SetFillColor(0,10,30);
    $pdf->Cell(9,5,"Lun:");$pdf->Cell(4,4,"",1,0,'C',"true"); 
  }else{
    $pdf->Cell(9,5,"Lun:");$pdf->Cell(4,4,"",1);   
	 }

 if($martes==1){
	$pdf->SetFillColor(0,10,30);
    $pdf->Cell(9,5,"Mar:");$pdf->Cell(4,4,"",1,0,'C',"true"); 
  }else{
    $pdf->Cell(9,5,"Mar:");$pdf->Cell(4,4,"",1);   
	 }	 
 if($miercoles==1){
	$pdf->SetFillColor(0,10,30);
    $pdf->Cell(9,5,"Mie:");$pdf->Cell(4,4,"",1,0,'C',"true"); 
  }else{
    $pdf->Cell(9,5,"Mie:");$pdf->Cell(4,4,"",1);   
	 }	 
 if($jueves==1){
	$pdf->SetFillColor(0,10,30);
    $pdf->Cell(9,5,"Jue:");$pdf->Cell(4,4,"",1,0,'C',"true"); 
  }else{
    $pdf->Cell(9,5,"Jue:");$pdf->Cell(4,4,"",1);   
	 }	 
 if($viernes==1){
	$pdf->SetFillColor(0,10,30);
    $pdf->Cell(9,5,"Vie:");$pdf->Cell(4,4,"",1,0,'C',"true"); 
  }else{
    $pdf->Cell(9,5,"Vie:");$pdf->Cell(4,4,"",1);   
	 }	 
 if($sabado==1){
	$pdf->SetFillColor(0,10,30);
    $pdf->Cell(9,5,"Sab:");$pdf->Cell(4,4,"",1,0,'C',"true"); 
  }else{
    $pdf->Cell(9,5,"Sab:");$pdf->Cell(4,4,"",1);   
	 }	 
 if($domingo==1){
	$pdf->SetFillColor(0,10,30);
    $pdf->Cell(9,5,"Dom:");$pdf->Cell(4,4,"",1,0,'C',"true"); 
  }else{
    $pdf->Cell(9,5,"Dom:");$pdf->Cell(4,4,"",1);   
	 }	 
$pdf->Ln(5);

$pdf->Cell(20,5,"    Alergico a: ".$alergico_a);$pdf->Ln(5);
$pdf->Cell(20,5,"");$pdf->MultiCell(165,5," ");
$pdf->Text(120,250,"...............................................................");
$pdf->Text(135,255,"Firma y Post. Firma");$pdf->Ln(10);
$pdf->Line(120,0,140,0);

//$pdf->SetWidths(array(15,80,40,40));//creamos el tamaño de cada celda
//los titulos de la consulta
//$pdf->Row(array('N','Examen','Fecha','Estado'));
 
 //llenamos las celdas con las consultas
 /*$pdf->SetFont('Arial','',8); 
 $pdf->SetTextColor(10);  
 $y=53;
 $listar=$opaciente->ReporteFecha($idpaciente,$inicio,$fin);
 $i=1;
 while($fila=mysql_fetch_array($listar)){
	 $nuevamostrar2=implode('/',array_reverse(explode('-',$fila[2])));
     $pdf->Row(array($i,$fila[1],$nuevamostrar2,$fila[3] ));
	 $y=$y+5.2;
	 $i++;
  }*/
     $pdf->SetFont('Arial','B',10);
     $pdf->Ln();  
     $pdf->Output();    
?>