<?php
    require_once('LIBRERIAS/pdf/fpdf.php');
    require_once('LIBRERIAS/pdf/pdftable.php');
    require_once('CADO/ClaseHemodialisis.php');
	
    $ohemodialisis =new Hemodialisis();
    $idprogramacion=$_GET['id'];
    $frecuencia=$_GET['frecuencia'];
	$turno=$_GET['turno'];
	$fec=implode('/',array_reverse(explode('-',$_GET['fec'])));
	$listar=$ohemodialisis->HemodialisisProgramacion($idprogramacion);
 	
	while($fila=$listar->fetch()){	 
	      $id_hemodialisis=$fila[id];
	      $id_ficha_atencion=$fila[id_ficha_atencion];
          $id_paciente=$fila[id_paciente];
          $med_procli=$fila[med_procli];
          $med_evolucion=$fila[med_evolucion];
          $med_hras_hd=$fila[med_hras_hd];
          $med_heparina=$fila[med_heparina];
          $med_pesoseco=$fila[med_pesoseco];
          $med_extraccion=$fila[med_extraccion];
          $med_areafiltro=$fila[med_areafiltro];
          $med_membrana=$fila[med_membrana];
          $med_cond_sero=$fila[med_cond_sero];
          $med_qb=$fila[med_qb];
          $med_qd=$fila[med_qd];
          $med_hco3=$fila[med_hco3];
          $med_temp_maq=$fila[med_temp_maq];
          $med_conduc=$fila[med_conduc];
          $med_na_inicial=$fila[med_na_inicial];
          $med_na_final=$fila[med_na_final];
          $enf_inicia=$fila[enf_inicia];
          $cep_inicia=$fila[cep_inicia];
          $enf_finaliza=$fila[enf_finaliza];
          $cep_finaliza=$fila[cep_finaliza];
          $enfe_pa_inicial=$fila[enfe_pa_inicial];
          $enfe_fc_inicial=$fila[enfe_fc_inicial];
          $enfe_peso_inicial=$fila[enfe_peso_inicial];
          $enfe_uf_inicial=$fila[enfe_uf_inicial];
          $enfe_pa_final=$fila[enfe_pa_final];
          $enfe_fc_final=$fila[enfe_fc_final];
          $enfe_peso_final=$fila[enfe_peso_final];
          $enfe_uf_final=$fila[enfe_uf_final];
          $enfe_art_fav=$fila[enfe_art_fav];
          $enfe_art_inj=$fila[enfe_art_inj];
          $enfe_art_cvc=$fila[enfe_art_cvc];
          $enfe_art_cvlp=$fila[enfe_art_cvlp];
          $enfe_ven_fav=$fila[enfe_ven_fav];
          $enfe_ven_inj=$fila[enfe_ven_inj];
          $enfe_ven_cvc=$fila[enfe_ven_cvc];
          $enfe_ven_cvlp=$fila[enfe_ven_cvlp];
          $enfe_ven_vp=$fila[enfe_ven_vp];
          $enfe_num_maq=$fila[enfe_num_maq];
          $enfe_marca_mod=$fila[enfe_marca_mod];
          $enfe_vol_filtro=$fila[enfe_vol_filtro];
          $enfe_reuso_filtro=$fila[enfe_reuso_filtro];
          $enfe_heparina=$fila[enfe_heparina];
          $enfe_val_inicial=$fila[enfe_val_inicial];
          $enfe_val_final=$fila[enfe_val_final];
          $enfe_asp_filtro=$fila[enfe_asp_filtro];
	}
	 

$ver_nom=$ohemodialisis->VerNombrePaciente($id_paciente);
  while($row=$ver_nom->fetch()){
	  $nom_pac=$row[0];
	  }


$pdf=new FPDF('P','mm');
$pdf=new Pdf_Table('P','mm','Letter');
$pdf->Open();
$pdf->AliasNbPages();

$sintomas=utf8_decode('síntomas');
$extraccion=utf8_decode('Extracción: ');
$area=utf8_decode('Área de Filtro: ');
$Cond=utf8_decode('Cond. Serológica: ');
$Tmaq=utf8_decode('T° Maq.: ');
$Nmaq=utf8_decode('N° Maq.: ');

$pdf->SetFont('Arial','I','7');
$pdf->AddPage();
$pdf->SetY(7);
$pdf->Cell(150,5," RAZON SOCIAL: MARIA AUXILIADORA");$pdf->Cell(45,5,"FECHA IMPRESION:  ".date('d/m/Y'));$pdf->Ln(5);
$pdf->Cell(150,5," RUC:  ");$pdf->Cell(45,5,"HORA IMPRESION:  ".date('h:i:s'));$pdf->Ln(5);
$pdf->SetFont('Arial','I','8');
$pdf->Cell(150,5," ");$pdf->Cell(45,5,'Nro de HD: 2');$pdf->Ln(5);
$pdf->Cell(150,5,"PACIENTE: ".$nom_pac);$pdf->Cell(45,5,"FECHA:     ".$fec);$pdf->Ln(5);
$pdf->Cell(150,5,"TURNO:  ".$turno);$pdf->Cell(45,5,'FRECUENCIA:  '.$frecuencia);$pdf->Ln(10);

$pdf->SetFont('Arial','B',9);
$pdf->Cell(0,5,'I.- PARTE MEDICO');$pdf->Ln(5);
$pdf->SetFont("Arial","B",8);

$pdf->Rect(10,42,196,75);//Rec(x,y,ancho,altura)

$pdf->Text(12,46,'PROBLEMAS CLINICOS');
$pdf->SetXY(14,48);
$pdf->SetFont("Arial","",8);
$pdf->MultiCell(0,5,$med_procli,0,'L');$pdf->Ln(0);
$pdf->Line(10,60,206,60);

$pdf->SetFont("Arial","B",8);
$pdf->Text(12,64,'EVOLUCION: signos y '.$sintomas);
$pdf->SetXY(14,65);
$pdf->SetFont("Arial","",8);
$pdf->MultiCell(0,5,$med_evolucion,0,'L');$pdf->Ln(0);
$pdf->Line(10,74,206,74);$pdf->Ln(5);

$pdf->SetFont("Arial","B",8);
$pdf->Cell(150,5," INDICACIONES MEDICAS:");$pdf->Ln(5);
$pdf->SetFont("Arial","",8);
$pdf->Cell(80,5,"     Hras. HD: ".$med_hras_hd);$pdf->Cell(45,5,"QB:  ".$med_qb);$pdf->Ln(5);
$pdf->Cell(80,5,"     Heparina: ".$med_hras_hd);$pdf->Cell(45,5,"QD:  ".$med_qd);$pdf->Ln(5);
$pdf->Cell(80,5,"     Peso Seco: ".$med_hras_hd);$pdf->Cell(45,5,"HCO3:  ".$med_hco3);$pdf->Ln(5);
$pdf->Cell(80,5,"     ".$extraccion.$med_hras_hd);$pdf->Cell(45,5,$Tmaq.$med_temp_maq);$pdf->Ln(5);
$pdf->Cell(80,5,"     ".$area.$med_hras_hd);$pdf->Cell(45,5,"Conduc.:  ".$med_conduc);$pdf->Ln(5);
$pdf->Cell(80,5,"     Membrana: ".$med_hras_hd);$pdf->Cell(45,5,"Na inicial:  ".$med_na_inicial);$pdf->Ln(5);
$pdf->Cell(80,5,"     ".$Cond.$med_hras_hd);$pdf->Cell(45,5,"Na final:  ".$med_na_final);$pdf->Ln(5);

$pdf->SetFont('Arial','B',9);
$pdf->SetY(120);
$pdf->Cell(0,5,'II.- PARTE DE ENFERMERIA');$pdf->Ln(7);
$pdf->Rect(10,125,196,120);
$pdf->SetFont("Arial","",8);
$pdf->Cell(80,5,"     PA Inicial: ".$enfe_pa_inicial);$pdf->Cell(50,5,"Pa final:  ".$enfe_pa_final);
$pdf->Cell(66,5,"		".$Nmaq.$enfe_num_maq);$pdf->Ln(5);

$pdf->Cell(80,5,"     FC: ".$enfe_fc_inicial);$pdf->Cell(50,5,"FC: ".$enfe_fc_final);
$pdf->Cell(66,5,"		Marca/Mod.: ".$enfe_marca_mod);$pdf->Ln(5);

$pdf->Cell(80,5,"     Peso Inicial: ".$enfe_peso_inicial);$pdf->Cell(50,5,"Peso final:  ".$enfe_peso_final);
$pdf->Cell(66,5,"		Vol. Filtro: ".$enfe_vol_filtro);$pdf->Ln(5);

$pdf->Cell(80,5,"     UF: ".$enfe_uf_inicial);$pdf->Cell(50,5,"UF:  ".$enfe_peso_final);
$pdf->Cell(66,5,"		Reuso de Filtro: ".$enfe_reuso_filtro);$pdf->Ln(5);
$pdf->Line(10,147,140,147);$pdf->Line(140,125,140,157);
$pdf->Text(14,150.5,'	ACCESO ART.:			FAV: '.$enfe_art_fav);
$pdf->Text(60,150.5,'Inj: '.$enfe_art_inj);$pdf->Text(75,150.5,'CVC: '.$enfe_art_cvc);
$pdf->Text(90,150.5,'CVLP: '.$enfe_art_cvlp);
$pdf->Text(143,150.5,'Heparina: '.$enfe_art_cvlp);$pdf->Ln(5);

$pdf->Text(14,155.5,'	VASC.     VEN.:			FAV: '.$enfe_ven_fav);
$pdf->Text(60,155.5,'Inj: '.$enfe_ven_inj);$pdf->Text(75,155.5,'CVC: '.$enfe_ven_cvc);
$pdf->Text(90,155.5,'CVLP: '.$enfe_ven_cvlp);
$pdf->Text(110,155.5,'VP: '.$enfe_ven_vp);$pdf->Ln(5);
$pdf->Line(10,157,206,157);

$pdf->SetFont("Arial","B",8);
$pdf->Text(12,161,'VALORACION INICIAL: ');$pdf->Ln(5);
$pdf->SetXY(14,162);
$pdf->SetFont("Arial","",8);
$pdf->MultiCell(0,5,$enfe_val_inicial,0,'L');$pdf->Ln(0);
$pdf->Line(10,172,206,172);

$pdf->SetFont("Arial","B",8);
$pdf->Text(12,176,'MONITOREO DEL TRATAMIENTO');
$pdf->Line(10,178,206,178);
$pdf->SetY(178);
//$pdf->SetFont('Arial','I',9);
$pdf->SetWidths(array(14,14,14,16,16,14,14,14,14,14,52));
$pdf->Row(array('    HR','    PA','    FC','     QB','   Condc.','    Pa','    Pv',' PTM',' UF.P',' UF.T','       OBSERVACIONES'));
$pdf->Ln(4);
$y=182;

$lis_monitoreo=$ohemodialisis->HemodialisisMonitoreo($id_hemodialisis);
 while($fila=$lis_monitoreo->fetch()){
	 $pdf->SetY($y);
	 $pdf->SetFont('Arial','I',7);
	 $pdf->Row(array($fila[0],$fila[1],$fila[2],$fila[3],$fila[4],$fila[5],$fila[6],$fila[7],$fila[8],$fila[9],$fila[10]));
	 $y=$y+4;
  }
$pdf->Line(10,222,206,222);	
$pdf->SetFont("Arial","B",8);
$pdf->Text(12,226,'VALORACION FINAL: ') ;
$pdf->Line(10,233,206,233);	
$pdf->Text(165,228,'MEDICAMENTOS ') ;
$pdf->Line(154,222,154,245);
$pdf->Line(10,239,206,239);
$pdf->Text(110,243,'Aspecto Filtro : ') ;
$pdf->Text(10,255,'Enf. Inicia  ') ;
$pdf->Text(10,261,'CEP ') ;
$pdf->Text(10,267,'Firma/Sello ') ;
$pdf->Text(130,255,'Enf. Finaliza  ') ;
$pdf->Text(130,261,'CEP ') ;
$pdf->Text(130,267,'Firma/Sello ') ;
//$pdf->MultiCell(0,5,"EVOLUCION: signos y ".$sintomas."\n".$med_evolucion,1,'L');$pdf->Ln(0);

/*$pdf->SetFont('Arial','B','8');
$pdf->Cell(130,5,"INDICACIONES MEDICAS",1);
$pdf->SetFont('Arial','I','8');
$pdf->MultiCell(0,5," ".$extraccion.$med_extraccion."\n ".$area.": ".$med_areafiltro." m2\n Membrana: ".$med_membrana." \n ".$Cond.$med_cond_sero,1);
$pdf->Ln(-15);
$pdf->MultiCell(130,5," Hras. HD: ".$med_hras_hd."                                    QB: ".$med_qb."                                                 Conduc.: ".$med_conduc."\n Heparina: ".$med_heparina."                                   QD: ".$med_qd."                                                Na Inicial: ".$med_na_inicial."\n Peso seco: ".$med_pesoseco."                            HCO3: ".$med_hco3."                                                  Na Final: ".$med_na_final,1);$pdf->Ln(0);
$pdf->MultiCell(0,5,"",1);$pdf->Ln(5);
$pdf->SetFont("Arial","B",9);
$pdf->Cell(0,5,"II.- PARTE ENFERMERIA");$pdf->Ln(5);
$pdf->Setfont("Arial","I",8);
$pdf->MultiCell(130,5," PA Inicial: ".$enfe_pa_inicial."                                                          PA Final: ".$enfe_pa_final." \n FC: ".$enfe_fc_inicial."                                                                    FC: ".$enfe_fc_final."\n Peso Inicial: ".$enfe_peso_final."                                                      Peso Final: ".$enfe_peso_final."\n UF: ".$enfe_uf_inicial."                                                                  UF: ".$enfe_uf_final,1);$pdf->Ln(0);
$pdf->MultiCell(130,5,"ACCESO ART.     FAV: ".$enfe_art_fav."                   Inj: ".$enfe_art_inj."                   CVC: ".$enfe_art_cvc."                   CVLP: ".$enfe_art_cvlp."\nVASC. VEN.         FAV: ".$enfe_ven_fav."                   Inj: ".$enfe_ven_inj."                   CVC: ".$enfe_ven_cvc."                   CVLP: ".$enfe_ven_cvlp."         VP: ".$enfe_ven_vp."\n",1);
$pdf->SetXY(140,102);
$pdf->MultiCell(0,5,"\n Nro de Maq.\n Marca/Mod \nVol. Filtro \nHeparina:                   Dosis Adm.\n\n",1);
$pdf->Ln(0);
$pdf->MultiCell(0,5,"VALORACION INICIAL:\n\n\n\n",1);$pdf->Ln(0);
$pdf->SetFont("Arial","B",8);
//$pdf->Cell(0,5,"MONITOREO DEL TRATAMIENTO",1);$pdf->Ln(5);
$pdf->SetFont("Arial","I",8);
//$pdf->MultiCell(0,50,"hol",1);$pdf->Ln(0);
$pdf->SetY(217);
$pdf->MultiCell(130,5,"VALORACION FINAL:\n\n\n\n",1);$pdf->Ln(0);
$pdf->SetXy(140,217);

$pdf->MultiCell(0,5,"MEDICAMENTOS:\n\n\n\n",1);$pdf->Ln(0);
$pdf->SetFont("Arial","B",8);
$pdf->Cell(130,5,"ASPECTO DE FILTRO",1, 0, C);$pdf->Cell(0,5,"",1,0,C);$pdf->Ln(7);
$pdf->SetFont("Arial","I",8);
$pdf->Cell(20,5,"Enf.Inicia:");$pdf->Cell(100,5,"");$pdf->Cell(20,5,"Enf.Finaliza:");$pdf->Ln(5);
$pdf->Cell(20,5,"CEP:");$pdf->Cell(100,5,"");$pdf->Cell(20,5,"CEP:");$pdf->Ln(5);
$pdf->Cell(20,5,"Firma/Sello:");$pdf->Cell(100,5,"");$pdf->Cell(20,5,"Firma/Sello:");*/

$pdf->Output();
?>