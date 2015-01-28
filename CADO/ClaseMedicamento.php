<?php
   require_once('conexion.php');
   
   class Medicamentos{
	   
     function MaxId(){
	  $ocado=new cado();
	  $sql="select max(id) from he_medicamento";
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
	 } 
     function ListarXMedicamento($medicamento){
	  $ocado=new cado();
	  $sql="select id,medicamento,presentacion,unidad,estado from he_medicamento 
	      where  medicamento like '%".$medicamento."%' or presentacion like '%".$medicamento."%' ";
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
	 }
	  function ListarXId($id){
	  $ocado=new cado();
	  $sql="select * from he_medicamento where id='$id' ";
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
	 }
	function Insertar($id,$codigo,$medicamento,$presentacion,$unidad,$fec_crea,$user_crea,$estado){
	  $ocado=new cado();
	  $sql="insert into he_medicamento 
	            values('$id','$codigo','$medicamento','$presentacion','$unidad','$fec_crea','$user_crea','$estado')";
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
	 }
	 function Modificar($id,$codigo,$medicamento,$presentacion,$unidad,$estado){
	  $ocado=new cado();
	  $sql="update he_medicamento set 
	        codigo='$codigo',medicamento='$medicamento',presentacion='$presentacion',unidad='$unidad',estado='$estado'
			 where id='$id'";
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
	 }
	 function Eliminar($id){
	  $ocado=new cado();
	  $sql="delete from he_medicamento where id='$id'";
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
	 }
   }
?>