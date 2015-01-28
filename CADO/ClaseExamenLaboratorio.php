<?php
   require_once('conexion.php');
   
   class ExLab{
	   
	   
	      function idpaciente($codigo){
		    $sql=" SELECT id from he_paciente where autogenerado='$codigo'  ";
		 $ocado=new cado();		  
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
		   }
		   
		   
	      function listar($idsucursal){
		    $sql=" SELECT * from `he_examen_laboratorio` where idsucursal='$idsucursal'  ";
		 $ocado=new cado();		  
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
		   }
		   
	   
	      function excel($idexa){
		    $sql=" SELECT excel from `he_examen_laboratorio` where id='$idexa'  ";
		 $ocado=new cado();		  
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
		   }
		   
		   
		   
		   
		      function modificar($HTO,$HB,$FERRITINA,$HEMO,$TRANSFERRINA,$PST,$UREAPRE,$UREAPOST,  $CREATPRE,$CREATPOS,$PESOPRE,$PESOPOST,$URR,$KTV,$PROTTOT,$ALB,$TGP,$TGO,$FAL,$CA,$CALCIOCORREGIDO,$P	,$PTH	,$PCR	,$HBsAg	,$Abs  	,$HVC	,$HVI	,$VDRL ,$id_paciente,$id_examen_laboratorio){ 
			  
			  $sql=" UPDATE   `he_detalle_examen_laboratorio` SET 
`HTO` =  '$HTO',
`HB` =  '$HB',
`FERRITINA` =  '$FERRITINA',
`HEMO` =  '$HEMO',
`TRANSFERRINA` =  '$TRANSFERRINA',
`PST` =  '$PST',
`UREAPRE` =  '$UREAPRE',
`UREAPOST` =  '$UREAPOST',
`CREAT_PRE` =  '$CREATPRE',
`CREAT_POS` =  '$CREATPOS',
`PESO_PRE` =  '$PESOPRE',
`PESO_POST` =  '$PESOPOST',
`URR` =  '$URR',
`KTV` =  '$KTV',
`PROT_TOT` =  '$PROTTOT',
`ALB` =  '$ALB',
`TGP` =  '$TGP',
`TGO` =  '$TGO',
`FAL` =  '$FAL',
`CALCIO` =  '$CA',
`CALCIO_CORREGIDO` =  '$CALCIOCORREGIDO',
`P` =  '$P',
`PTH` =  '$PTH',
`HBsAg` =  '$HBsAg',
`Abs_HBs` =  '$Abs',
`HVC` =  '$HVC',
`HVI` =  '$HVI',
`VDRL` =  '$VDRL' WHERE id_paciente='$id_paciente' and id_examen_laboratorio	='$id_examen_laboratorio' ";
		 $ocado=new cado();		  
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
		   }
		   
		   
		   
		   
		   
	    function Pacientes($sucursal ){
		    $sql="  SELECT @rownum:=@rownum+1,autogenerado,UPPER(`apellidos`),UPPER(`nombres`)
	 FROM `he_paciente` p
	 INNER JOIN he_ficha_atencion f on f.id_paciente=p.id  , (SELECT @rownum:=0) R
	 
	  WHERE  id_sucursal ='1'   and estado=1
	  limit 0,10 ";
		 $ocado=new cado();		  
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
		   }
		   
		     function Validar($idsucursal,$fecha){
		    $sql="select  count(*) from `he_examen_laboratorio` where idsucursal='$idsucursal'
			and fecha='$fecha' ";
		 $ocado=new cado();		  
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
		   }
		   
		   
		       function Pacientes3($idpaciente,$iddetalle){
		    $sql="INSERT INTO `he_detalle_examen_laboratorio` VALUES (NULL, '$idpaciente', '$iddetalle', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, 0);";
		 $ocado=new cado();		  
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
		   }
		   
		      function Pacientes4($id_sucursal){
		    $sql=" SELECT max(id) from `he_examen_laboratorio` where idsucursal='$id_sucursal'  ";
		 $ocado=new cado();		  
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
		   }
		   
		   
		     function Pacientes2($fecha,$mes,$anio,$excel,$id_sucursal){
		    $sql="  INSERT INTO   `he_examen_laboratorio` (`id` ,`fecha` ,`mes` ,
`anio` ,`excel`,`idsucursal`) VALUES (
NULL ,  '$fecha',  '$mes',  '$anio',  '$excel',$id_sucursal
) 
;
   ";
		 $ocado=new cado();		  
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
		   }
	 
	 
   }
?>