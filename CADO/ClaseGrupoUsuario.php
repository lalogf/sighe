<?php
   require_once('conexion.php');
   
   class GrupoUsuarios{
	 
	 function MaxId(){
	  $ocado=new cado();
	  $sql="select max(id) from ut_grupo_usuario";
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
	 } 
     function ListarXGrupo($grupo){
	  $ocado=new cado();
	  $sql="select id,nombre,estado from ut_grupo_usuario where  nombre like '%".$grupo."%'  ";
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
	 }
	  function ListarXId($id){
	  $ocado=new cado();
	  $sql="select id,nombre,estado from ut_grupo_usuario where id='$id' ";
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
	 }
	function Insertar($id,$grupo,$fec_crea,$user_crea,$estado){
	  $ocado=new cado();
	  $sql="insert into ut_grupo_usuario values('$id','$grupo','$fec_crea','$user_crea','$estado')";
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
	 }
	 function Modificar($id,$grupo,$estado){
	  $ocado=new cado();
	  $sql="update ut_grupo_usuario set nombre='$grupo',estado='$estado' where id='$id'";
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
	 }
	 function Eliminar($id){
	  $ocado=new cado();
	  $sql="delete from ut_grupo_usuario where id='$id'";
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
	 }
	 
	 
   }
?>