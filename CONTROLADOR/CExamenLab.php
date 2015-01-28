<?php
session_start();
     if(!isset($_SESSION['S_user'])){
		header("location:index.php");
		}
require_once("../CADO/ClaseExamenLaboratorio.php");
controlador($_POST['accion']);

function controlador($accion)
{
    $oExLab = new ExLab();
	 
	 if($accion=='IMPORTAR'){
		    $id_examen_laboratorio=$_POST[id_examen_laboratorio];
			//$id_examen_laboratorio=1;
			require_once("../EXCEL/PHPExcel.php");
        	require_once("../EXCEL/PHPExcel/Reader/Excel2007.php");
			//$inputFileName = $_POST[archivo];
		 	$inputFileName ="../EXCEL/PlantillaExcel/Temp.xlsx";
		  	$listar     = $oExLab->excel($id_examen_laboratorio);
        	while ($dato = $listar->fetch()) {
            $excelfinal = $dato[0];
            }
		   	$inputFileType = PHPExcel_IOFactory::identify($inputFileName);
		 	$objReader = PHPExcel_IOFactory::createReader($inputFileType);
			$objPHPExcel = $objReader->load($inputFileName);
			$objReader = PHPExcel_IOFactory::createReader($inputFileType);
			$objReader->setReadDataOnly(true);
			$objPHPExcel = $objReader->load($inputFileName);
			$objWorksheet = $objPHPExcel->getActiveSheet();
	  		if(  
 ($objWorksheet->getCell("A4")->getCalculatedValue()=="Nro")  and 
 ($objWorksheet->getCell("B4")->getCalculatedValue()=="Autogenerado")  and 
 ($objWorksheet->getCell("C4")->getCalculatedValue()=="Nombres y Apellidos")  and 
 ($objWorksheet->getCell("D4")->getCalculatedValue()=="HTO")  and 
 ($objWorksheet->getCell("E4")->getCalculatedValue()=="HB")  and 
 ($objWorksheet->getCell("F4")->getCalculatedValue()=="FERRITINA")  and 
 ($objWorksheet->getCell("G4")->getCalculatedValue()=="HEMO")  and 
 ($objWorksheet->getCell("H4")->getCalculatedValue()=="TRANSFE  RRINA") and 
 ($objWorksheet->getCell("I4")->getCalculatedValue()=="PST")  and 
  ($objWorksheet->getCell("L4")->getCalculatedValue()=="CREAT.PRE")and 
 ($objWorksheet->getCell("M4")->getCalculatedValue()=="CREAT.POS")and 
  ($objWorksheet->getCell("P4")->getCalculatedValue()=="URR")and 
 ($objWorksheet->getCell("Q4")->getCalculatedValue()=="KTV")and 
 ($objWorksheet->getCell("R4")->getCalculatedValue()=="PROT. TOT") and 
 ($objWorksheet->getCell("S4")->getCalculatedValue()=="ALB") and 
 ($objWorksheet->getCell("V4")->getCalculatedValue()=="FAL") and 
 ($objWorksheet->getCell("W4")->getCalculatedValue()=="CA") and 
 ($objWorksheet->getCell("X4")->getCalculatedValue()=="CALCIO CORREGIDO") and 
 ($objWorksheet->getCell("Y4")->getCalculatedValue()=="P") and
  ($objWorksheet->getCell("Z4")->getCalculatedValue()=="PTH") and
   ($objWorksheet->getCell("AA4")->getCalculatedValue()=="PCR") and
  ($objWorksheet->getCell("AB4")->getCalculatedValue()=="HBsAg") and
  ($objWorksheet->getCell("AC4")->getCalculatedValue()=="Abs HBs") and
   ($objWorksheet->getCell("AD4")->getCalculatedValue()=="HVC") and
  ($objWorksheet->getCell("AE4")->getCalculatedValue()=="HVI") and
 ($objWorksheet->getCell("AF4")->getCalculatedValue()=="VDRL")  
  ){ 
 
 }else {
	 echo 2;
	 exit();
	 }
/*-------------*/
	 $cadena= $objWorksheet->getCell('B7')->getCalculatedValue();
	 $j=7;
	  while($cadena){
		  			$listarn     = $oExLab->idpaciente($cadena);
		 			while ($dato = $listarn->fetch()) {
            		$id_paciente = $dato[0];
            		 }
		//echo $objWorksheet->getCell("A$j")->getCalculatedValue();	 
		$oExLab->modificar(
		$objWorksheet->getCell("D$j")->getCalculatedValue(),
		$objWorksheet->getCell("E$j")->getCalculatedValue(),
		$objWorksheet->getCell("F$j")->getCalculatedValue(),
		$objWorksheet->getCell("G$j")->getCalculatedValue(),
		$objWorksheet->getCell("H$j")->getCalculatedValue(),
		$objWorksheet->getCell("I$j")->getCalculatedValue(),
		$objWorksheet->getCell("J$j")->getCalculatedValue(),
		$objWorksheet->getCell("K$j")->getCalculatedValue(),
		$objWorksheet->getCell("L$j")->getCalculatedValue(),
		$objWorksheet->getCell("M$j")->getCalculatedValue(),
		$objWorksheet->getCell("N$j")->getCalculatedValue(),
		$objWorksheet->getCell("O$j")->getCalculatedValue(),
		$objWorksheet->getCell("P$j")->getCalculatedValue(),
		$objWorksheet->getCell("Q$j")->getCalculatedValue(),
		$objWorksheet->getCell("R$j")->getCalculatedValue(),
		$objWorksheet->getCell("S$j")->getCalculatedValue(),
		$objWorksheet->getCell("T$j")->getCalculatedValue(),
		$objWorksheet->getCell("U$j")->getCalculatedValue(),
		$objWorksheet->getCell("V$j")->getCalculatedValue(),
		$objWorksheet->getCell("W$j")->getCalculatedValue(),
		$objWorksheet->getCell("X$j")->getCalculatedValue(),
		$objWorksheet->getCell("Y$j")->getCalculatedValue(),
		$objWorksheet->getCell("Z$j")->getCalculatedValue(),
		$objWorksheet->getCell("AA$j")->getCalculatedValue(),
		$objWorksheet->getCell("AB$j")->getCalculatedValue(),
		$objWorksheet->getCell("AC$j")->getCalculatedValue(),
		$objWorksheet->getCell("AD$j")->getCalculatedValue(),
		$objWorksheet->getCell("AE$j")->getCalculatedValue(),
		$objWorksheet->getCell("AF$j")->getCalculatedValue(),
		$id_paciente,$id_examen_laboratorio);			 
					 
		 
		 $j=$j+1;
		 $cadena= $objWorksheet->getCell("B".$j)->getCalculatedValue(); 
		 } 
	if(file_exists("../".$excelfinal))	 unlink("../".$excelfinal);
	 copy($inputFileName, "../".$excelfinal);
	 /*-------------*/
 echo "../".$excelfinal;
exit();
	 }
	 if($accion=='LISTAR'){
		  $tbl=""; 
		   $idsucursal = $_SESSION['S_idsucursal'];
		  echo $_SESSION['S_idsucursal'];
		  $listar=$oExLab->Listar($idsucursal);$i=0;
		  while($fila=$listar->fetch()){
			$i++; 
			 
			if($i==1){
		       $color="#c5dbec";
		     }else{$color="#FFFFFF";}  
			 $fila[2]=nombremes($fila[2]);
		    $tbl.="<tr align='center' bgcolor='$color' id='$i' idusuario='$fila[0]' style='cursor:pointer' onclick=\"javascript:PintarFila('$i')\"  >
			         <td>$fila[1]</td>
					  <td><a href='$fila[4]'> Examen  Laboratorio :$fila[2] - $fila[3]  </a></td> 
					   <td><a onclick='subir($fila[0])'> Importar </a></td>
					  </tr>";
		   }  
			echo $i.'///'.$tbl;  
		  }  
	
	
	
    if ($accion == 'EXPORTAR') {
        $idsucursal = $_SESSION['S_idsucursal'];
        $tbl        = "";
        $fecha      = $_POST[fecha];
        $listar     = $oExLab->Validar($idsucursal, $fecha);
        while ($dato = $listar->fetch()) {
            $validacion = $dato[0];
        }
	 
        if ($validacion > 0) {
            echo 2;
            exit();
        }
        require_once("../EXCEL/PHPExcel.php");
        require_once("../EXCEL/PHPExcel/Reader/Excel2007.php");
        $inputFileName = '../EXCEL/PlantillaExcel/Lab.xlsx';
        $objPHPexcel   = PHPExcel_IOFactory::load($inputFileName);
        $objWorksheet  = $objPHPexcel->getActiveSheet();
        $styleArray    = array(
            'font' => array(
                'name' => 'Arial',
                'size' => '8'
            ),
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array(
                        'argb' => 'FF000000'
                    )
                )
            )
        );
        $objWorksheet->getCell('A1')->setValue("INSTITUTO    DEL    RIÑON  \r\n  " . strtoupper(nombremes(substr($_POST[fecha], 5, 3))) . " - " . substr($_POST[fecha], 0, 4));
        $listar = $oExLab->Pacientes($idsucursal);
        $i      = 7;
        while ($dato = $listar->fetch()) {
            $objWorksheet->getCell('A' . $i)->setValue(($dato[0]));
            $objWorksheet->getCell('B' . $i)->setValue(($dato[1]));
            $objWorksheet->getCell('C' . $i)->setValue(($dato[2] . " " . $dato[3]));
            $objWorksheet->getCell('E' . $i)->setValue('=D' . $i . '/3');
            $objWorksheet->getCell('P' . $i)->setValue('=100-(M' . $i . '*100/L' . $i . ')');
            $objWorksheet->getCell('Q' . $i)->setValue('=-LN((K' . $i . '/J' . $i . ')-0.008*3.25)+(4 - 3.5*(K' . $i . '/J' . $i . '))*(N' . $i . '-O' . $i . ')/O' . $i . '');
            $objWorksheet->getCell('X' . $i)->setValue('=0.8*(4-S' . $i . ')+W' . $i . '');
            /*MAS FORMULAS*/
            $objWorksheet->getCell('I' . $i)->setValue('=G' . $i . '*100/' . "H" . $i);
            $objWorksheet->getStyle('A' . $i)->applyFromArray($styleArray);
            $objWorksheet->getStyle('B' . $i)->applyFromArray($styleArray);
            $objWorksheet->getStyle('C' . $i)->applyFromArray($styleArray);
            $objWorksheet->getStyle('D' . $i)->applyFromArray($styleArray);
            $objWorksheet->getStyle('E' . $i)->applyFromArray($styleArray);
            $objWorksheet->getStyle('F' . $i)->applyFromArray($styleArray);
            $objWorksheet->getStyle('G' . $i)->applyFromArray($styleArray);
            $objWorksheet->getStyle('H' . $i)->applyFromArray($styleArray);
            $objWorksheet->getStyle('I' . $i)->applyFromArray($styleArray);
            $objWorksheet->getStyle('J' . $i)->applyFromArray($styleArray);
            $objWorksheet->getStyle('K' . $i)->applyFromArray($styleArray);
            $objWorksheet->getStyle('L' . $i)->applyFromArray($styleArray);
            $objWorksheet->getStyle('M' . $i)->applyFromArray($styleArray);
            $objWorksheet->getStyle('N' . $i)->applyFromArray($styleArray);
            $objWorksheet->getStyle('O' . $i)->applyFromArray($styleArray);
            $objWorksheet->getStyle('P' . $i)->applyFromArray($styleArray);
            $objWorksheet->getStyle('Q' . $i)->applyFromArray($styleArray);
            $objWorksheet->getStyle('R' . $i)->applyFromArray($styleArray);
            $objWorksheet->getStyle('S' . $i)->applyFromArray($styleArray);
            $objWorksheet->getStyle('T' . $i)->applyFromArray($styleArray);
            $objWorksheet->getStyle('U' . $i)->applyFromArray($styleArray);
            $objWorksheet->getStyle('V' . $i)->applyFromArray($styleArray);
            $objWorksheet->getStyle('W' . $i)->applyFromArray($styleArray);
            $objWorksheet->getStyle('X' . $i)->applyFromArray($styleArray);
            $objWorksheet->getStyle('Y' . $i)->applyFromArray($styleArray);
            $objWorksheet->getStyle('Z' . $i)->applyFromArray($styleArray);
            $objWorksheet->getStyle('AA' . $i)->applyFromArray($styleArray);
            $objWorksheet->getStyle('AB' . $i)->applyFromArray($styleArray);
            $objWorksheet->getStyle('AC' . $i)->applyFromArray($styleArray);
            $objWorksheet->getStyle('AD' . $i)->applyFromArray($styleArray);
            $objWorksheet->getStyle('AE' . $i)->applyFromArray($styleArray);
            $objWorksheet->getStyle('AF' . $i)->applyFromArray($styleArray);
            $i = $i + 1;
          }
        /*no se pueda editar*/
         /**/
        $objWriter = new PHPExcel_Writer_Excel2007($objPHPexcel);
        $cadena = '../EXCEL/Laboratorio/Laboratorio ' . $_POST[fecha] . '.xlsx';
        if (file_exists($string))
            unlink($cadena);
        $objWriter->save($cadena); //cambios
        $cadena2 = 'EXCEL/Laboratorio/Laboratorio ' . $_POST[fecha] . '.xlsx';
        ;
        $oExLab->Pacientes2($_POST[fecha], substr($_POST[fecha], 5, 3), substr($_POST[fecha], 0, 4), $cadena2, $idsucursal);
        $listar = $oExLab->Pacientes4($idsucursal);
        while ($dato = $listar->fetch()) {
            $id_examen_laboratorio = $dato[0];
        }
        $listar = $oExLab->Pacientes($idsucursal);
        $i      = 7;
        while ($dato = $listar->fetch()) {
            $oExLab->Pacientes3($dato[0], $id_examen_laboratorio);
            $i = 7;
        }
        echo 1;
        /*Todo Ok*/
    }
    
}

function nombremes($mes)
{
    setlocale(LC_TIME, 'spanish');
    $nombre = strftime("%B", mktime(0, 0, 0, $mes, 1, 2000));
    return $nombre;
}
?>