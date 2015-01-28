<?php
   require_once('conexion.php');
   
   class Sucursales{
	   
     function MaxId(){
	  $ocado=new cado();
	  $sql="select max(id) from ut_sucursal";
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
	 } 
     function ListarXSucursal($razon_social){
	  $ocado=new cado();
	  $sql="select * from ut_sucursal where  razon_social like '%".$razon_social."%'  ";
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
	 }
	  function ListarXId($id){
	  $ocado=new cado();
	  $sql="select * from ut_sucursal where id='$id' ";
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
	 }
	function Insertar($id,$ruc,$razon,$direccion,$fec_crea,$user_crea,$responsable,$sobrenombre,$estado){
	  $ocado=new cado();
	  $sql="insert into ut_sucursal values('$id','$ruc','$razon','$direccion','$fec_crea','$user_crea','$responsable','$sobrenombre','$estado')";
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
	 }
	 function Modificar($id,$ruc,$razon,$direccion,$responsable,$sobrenombre,$estado){
	  $ocado=new cado();
	  $sql="update ut_sucursal set ruc='$ruc',razon_social='$razon',direccion='$direccion',responsable='$responsable',sobrenombre='$sobrenombre',
	        estado='$estado' where id='$id'";
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
	 }
	 function Eliminar($id){
	  $ocado=new cado();
	  $sql="delete from ut_sucursal where id='$id'";
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
	 }
	 
   }
?>