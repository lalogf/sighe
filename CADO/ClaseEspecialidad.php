<?php
   require_once('conexion.php');
   
   class Especialidades{
	 
	 function MaxId(){
	  $ocado=new cado();
	  $sql="select max(id) from ut_especialidad";
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
	 } 
     function ListarXEspecialidad($especialidad){
	  $ocado=new cado();
	  $sql="select id,nombre,estado from ut_especialidad where  nombre like '%".$especialidad."%'  ";
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
	 }
	 function ListarEspecialidad(){
	  $ocado=new cado();
	  $sql="select id,nombre from ut_especialidad";
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
	 }
	  function ListarXId($id){
	  $ocado=new cado();
	  $sql="select id,nombre,estado from ut_especialidad where id='$id' ";
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
	 }
	function Insertar($id,$especialidad,$fec_crea,$user_crea,$estado){
	  $ocado=new cado();
	  $sql="insert into ut_especialidad values('$id','$especialidad','$fec_crea','$user_crea','$estado')";
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
	 }
	 function Modificar($id,$especialidad,$estado){
	  $ocado=new cado();
	  $sql="update ut_especialidad set nombre='$especialidad',estado='$estado' where id='$id'";
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
	 }
	 function Eliminar($id){
	  $ocado=new cado();
	  $sql="delete from ut_especialidad where id='$id'";
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
	 }
	 
	 
   }
?>