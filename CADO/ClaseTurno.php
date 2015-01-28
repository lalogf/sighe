<?php
   require_once('conexion.php');
   
   class Turnos{
	 
	 function MaxId(){
	  $ocado=new cado();
	  $sql="select max(id) from ut_turno";
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
	 } 
     function ListarXTurno($id_sucursal,$turno){
	  $ocado=new cado();
	  $sql="select id,turno from ut_turno where id_sucursal='$id_sucursal' and turno like '%".$turno."%'  ";
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
	 }
	  function ListarXId($id){
	  $ocado=new cado();
	  $sql="select id,turno,estado from ut_turno where id='$id' ";
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
	 }
	function Insertar($id,$turno,$fec_crea,$user_crea,$estado,$idsucursal){
	  $ocado=new cado();
	  $sql="insert into ut_turno values('$id','$turno','$fec_crea','$user_crea','$estado','$idsucursal')";
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
	 }
	 function Modificar($id,$turno,$estado){
	  $ocado=new cado();
	  $sql="update ut_turno set turno='$turno',estado='$estado' where id='$id'";
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
	 }
	 function Eliminar($id){
	  $ocado=new cado();
	  $sql="delete from ut_turno where id='$id'";
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
	 }
	 function ListarTurno(){
	  $ocado=new cado();
	  $sql="select * from ut_turno where estado=1 order by id asc";
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
	 }
	  /*function Modificar(){
	  $ocado=new cado();
	  $sql="select * from turno";
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
	 }
	 function Eliminar(){
	  $ocado=new cado();
	  $sql="select * from turno";
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
	 }*/
	 
   }
?>