<?php
   require_once('conexion.php');
   
   class Paciente{
  	  function datosPaciente($id){
	  $sql=" SELECT * 	FROM  `he_paciente` p 
	   where p.id ='$id' 
limit 0,1";
	 $ocado=new cado();		  
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
		  }
		  
		  
		    function eliminarpaciente($idpaciente,$idficha){
	  $sql="delete	FROM  `he_ficha_atencion` 
	   where id ='$idficha'  ;
	  	
	   " ;
	 $ocado=new cado();		  
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
		  }
		  
		  function Pacientex($id,$id2){
	  $sql=" SELECT * 	FROM  `he_paciente` p
INNER JOIN he_ficha_atencion f on f.id_paciente=p.id
INNER JOIN he_serologia s ON   s.id_ficha_atencion=f.id
LEFT JOIN he_cie10 c ON f.cie10 = c.dx_codigo where p.id ='$id' and f.id='$id2'
 
limit 0,1";
	 $ocado=new cado();		  
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
		  }
		 
		  
		  
     function Listarcie10($string){
	  $sql="select dx_codigo,dx_des from  he_cie10 where dx_des like '$string%'  or dx_codigo='$string' limit 0,10";
	  $ocado=new cado();		  
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
	 }
	 
	 function Listarturno($idsucursal){
	 $sql="select id,turno from ut_turno where id_sucursal='$idsucursal'";
	  $ocado=new cado();		  
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
	 } 
	 
	   function Listarpacienteto($idsucursal,$string){
	 $sql="SELECT `apellidos`,`nombres`,CONCAT(DATE_FORMAT(`fecha_ing`, '%d/%m/%Y'),' ',if(estado=1,'activo','inactivo')) ,p.id ,f.id
	 FROM `he_paciente` p
	 INNER JOIN he_ficha_atencion f on f.id_paciente=p.id 
	  WHERE  id_sucursal ='$idsucursal' and   ( f.id='$string'  or  concat(apellidos,nombres) like '%$string%')   and estado=1
	  limit 0,10 
	  
	  ";
	  $ocado=new cado();		  
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
	 } 
	 
	 
	  function Listarpaciente($idsucursal,$string){
	 $sql="SELECT `apellidos`,`nombres`,CONCAT(DATE_FORMAT(`fecha_ing`, '%d/%m/%Y'),' ',if(estado=0,'activo','inactivo')) ,p.id ,f.id
	 FROM `he_paciente` p
	 INNER JOIN he_ficha_atencion f on f.id_paciente=p.id 
	  WHERE  id_sucursal ='$idsucursal' and ( f.id='$string'  or  concat(apellidos,nombres) like '%$string%') limit 0,10 ";
	  $ocado=new cado();		  
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
	 } 
	 
	 
	   function Listarpaciente2($idsucursal,$string){
	 $sql="SELECT `apellidos`,`nombres`,`fecha_nac`,id 
	 FROM `he_paciente` WHERE `id_sucursal`='$idsucursal' and   concat(apellidos,nombres) like '%$string%' limit 0,10 ";
	  $ocado=new cado();		  
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
	 } 
	 
	  function modificar(  $apellidos,  $nombres,  $fechaing,  $fechanacimiento,$edad,$edad_tipo,  $sexo,  $gruposanguineo,  $factor,  $autogenerado, $di_actual  , $telef , $contact_emerg ,  $telef_emerg,  $fecha_ini_dia,  $fecha_ini_dia_ri,  $diag_ini,  $cie10,  $pesoseco,  $lunes,  $martes,  $miercoles,  $jueves,  $viernes,  $sabado,  $domingo,  $id_turno,  $alergias,$id_usuario,  $id_sucursal,  $s1 , $s2 , $s3 , $c1 , $c2 ,$c3 , $i1 , $i2 ,$i3 , $ir1 , $ir2 ,$ir3,$dni,$idpaciente,$idfichaatencion){
	 $sql="UPDATE   `he_paciente` SET 
  `dni` =  '$dni',
`apellidos` =  '$apellidos',
`nombres` =  '$nombres',
`fecha_nac` =  '$fechanacimiento',
`gruposanguineo` =  '$gruposanguineo',
`factorsanguineo` =  '$factor',
`autogenerado` =  '$autogenerado',
`sexo` =  '$sexo' WHERE  `he_paciente`.`id` ='$idpaciente'  ;

UPDATE   `he_ficha_atencion` SET  
`id_turno` =  '$id_turno',
`fecha_ing` =  '$fechaing',
`edad` =  '$edad',
`edad_tipo` =  '$edad_tipo',
`di_actual` =  '$di_actual',
`telef` =  '$telef',
`contac_emerg` =  '$contact_emerg',
`telef_emerg` =  '$telef_emerg',
`fecha_inicio_dialisis` =  '$fecha_ini_dia',
`fecha_inicio_dialisis_rinon` =  '$fecha_ini_dia_ri',
`diagnostico_inicio` =  '$diag_ini',
`cie10` =  '$cie10',
`peso_seco` =  '$pesoseco',
`lunes` =  '$lunes',
`martes` =  '$martes',
`miercoles` =  '$miercoles',
`jueves` =  '$jueves',
`viernes` =  '$viernes',
`sabado` =  '$sabado',
`domingo` =  '$domingo',
`alergico_a` =  '$alergias'  
 WHERE   id  = '$idfichaatencion'   ;
 
 UPDATE  `he_serologia` SET
`s_hiv` =  '$s1',
`s_hvc` =  '$s2',
`s_ag_hbs` =  '$s3',
`con_n` =  '$c1',
`con_p` =  '$c2',
`con_pp` =  '$c3',
`inmunizacion_fecha_1` =  '$i1',
`inmunizacion_responsable_1` =  '$i2',
`inmunizacion_fecha_2` =  '$i3',
`inmunizacion_responsable_2` =  '$ir1',
`inmunizacion_fecha_3` =  '$ir2',
`inmunizacion_responsable_3` =  '$ir3' 
 WHERE  id_ficha_atencion ='$idfichaatencion';
";	
 $ocado=new cado();		  
	 $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar; 
 }

function insertar2	( $idpaciente, $apellidos,  $nombres,  $fechaing,  $fechanacimiento,$edad,$edad_tipo,  $sexo,  $gruposanguineo,  $factor,  $autogenerado, $di_actual  , $telef , $contact_emerg ,  $telef_emerg,  $fecha_ini_dia,  $fecha_ini_dia_ri,  $diag_ini,  $cie10,  $pesoseco,  $lunes,  $martes,  $miercoles,  $jueves,  $viernes,  $sabado,  $domingo,  $id_turno,  $alergias,$id_usuario,  $id_sucursal,  $s1 , $s2 , $s3 , $c1 , $c2 ,$c3 , $i1 , $i2 ,$i3 , $ir1 , $ir2 ,$ir3,$dni){
	 $sql="
	 UPDATE   `he_paciente` SET 
  `dni` =  '$dni',
`apellidos` =  '$apellidos',
`nombres` =  '$nombres',
`fecha_nac` =  '$fechaing',
`gruposanguineo` =  '$fechanacimiento',
`factorsanguineo` =  '$factor',
`autogenerado` =  '$autogenerado',
`sexo` =  '$sexo' WHERE  `he_paciente`.`id` ='$idpaciente'  ;

update `he_ficha_atencion` set estado=0 where id_paciente='$idpaciente';

 INSERT INTO  `he_ficha_atencion`  VALUES (NULL ,  '$id_turno',  '$idpaciente',  '', NULL ,'$fechaing',  '',  '$edad',  '$edad_tipo', '$di_actual' , '$telef' ,'$contact_emerg' , '$telef_emerg' ,  '$fecha_ini_dia',  '$fecha_ini_dia_ri', '$diag_ini' ,  '$cie10',  '$pesoseco',  '$lunes',  '$martes',  '$miercoles',  '$jueves',  '$viernes',  '$sabado',  '$domingo', '$alergias' , NULL , NULL ,  now(),  '$id_usuario', NULL , NULL ,  '1');
  
   INSERT INTO  `he_serologia`  VALUES (NULL ,  LAST_INSERT_ID(),'$s1' , '$s2' , '$s3', '$c1' , '$c2' , '$c3' , '$i1' ,'$i2' , '$i3' , '$ir1' , '$ir2' , '$ir3' , NULL , NULL , NULL , NULL); ";	
   
$ocado=new cado();		  
	  $ejecutar=$ocado->ejecutar($sql);
	 
	  return $ejecutar; 
		 
		 }

	 function insertar(  $apellidos,  $nombres,  $fechaing,  $fechanacimiento,$edad,$edad_tipo,  $sexo,  $gruposanguineo,  $factor,  $autogenerado, $di_actual  , $telef , $contact_emerg ,  $telef_emerg,  $fecha_ini_dia,  $fecha_ini_dia_ri,  $diag_ini,  $cie10,  $pesoseco,  $lunes,  $martes,  $miercoles,  $jueves,  $viernes,  $sabado,  $domingo,  $id_turno,  $alergias,$id_usuario,  $id_sucursal,  $s1 , $s2 , $s3 , $c1 , $c2 ,$c3 , $i1 , $i2 ,$i3 , $ir1 , $ir2 ,$ir3,$dni){
	 $sql="
	 INSERT INTO   `he_paciente`  VALUES ( NULL ,  '$id_sucursal',  '$dni',  '$apellidos',  '$nombres',  '$fechanacimiento',  '$gruposanguineo',  '$factor',  '$autogenerado',  now() ,  '$id_usuario',  '$sexo');

 INSERT INTO  `he_ficha_atencion`  VALUES (NULL ,  '$id_turno',  LAST_INSERT_ID(),  '', NULL ,'$fechaing',  '',  '$edad',  '$edad_tipo', '$di_actual' , '$telef' ,'$contact_emerg' , '$telef_emerg' ,  '$fecha_ini_dia',  '$fecha_ini_dia_ri', '$diag_ini' ,  '$cie10',  '$pesoseco',  '$lunes',  '$martes',  '$miercoles',  '$jueves',  '$viernes',  '$sabado',  '$domingo', '$alergias' , NULL , NULL ,  now(),  '$id_usuario', NULL , NULL ,  '1');
  
   INSERT INTO  `he_serologia`  VALUES (NULL ,  LAST_INSERT_ID(),'$s1' , '$s2' , '$s3', '$c1' , '$c2' , '$c3' , '$i1' ,'$i2' , '$i3' , '$ir1' , '$ir2' , '$ir3' , NULL , NULL , NULL , NULL); ";	
   
$ocado=new cado();		  
	  $ejecutar=$ocado->ejecutar($sql);
	 
	  return $ejecutar; 
		 
		 }
	
   }
?>