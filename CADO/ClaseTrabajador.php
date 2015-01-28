<?php
   require_once('conexion.php');
   
   class Trabajadores{
	   
     function MaxId(){
	  $ocado=new cado();
	  $sql="select max(id) from ut_trabajador";
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
	 } 
     function ListarXTrabajador($trabajador){
	  $ocado=new cado();
	  $sql="select id,concat(nombres,' ',apellidos),dni,sexo,estado from ut_trabajador 
	      where  concat(nombres,' ',apellidos) like '%".$trabajador."%'  ";
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
	 }
	  function ListarXId($id){
	  $ocado=new cado();
	  $sql="select * from ut_trabajador where id='$id' ";
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
	 }
	function Insertar($id,$nombres,$apellidos,$dni,$sexo,$direccion,$telefono,$correo,$fec_crea,$user_crea,$estado,
	                    $id_especialidad,$id_sucursal){
	  $ocado=new cado();
	  $sql="insert into ut_trabajador 
	            values('$id','$nombres','$apellidos','$dni','$sexo','$direccion','$telefono','$correo','$fec_crea',
				'$user_crea','$estado','$id_especialidad','$id_sucursal')";
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
	 }
	 function Modificar($id,$nombres,$apellidos,$dni,$sexo,$direccion,$telefono,$correo,$estado,
	                    $id_especialidad){
	  $ocado=new cado();
	  $sql="update ut_trabajador set 
	        nombres='$nombres',apellidos='$apellidos',dni='$dni',sexo='$sexo',direccion='$direccion',
	 telefono='$telefono',correo='$correo',estado='$estado',id_especialidad='$id_especialidad'
			 where id='$id'";
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
	 }
	 function Eliminar($id){
	  $ocado=new cado();
	  $sql="delete from ut_trabajador where id='$id'";
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
	 }
   }
?>