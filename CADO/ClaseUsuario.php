<?php
   require_once('conexion.php');
   
   class Usuarios{
	   
	    function permiso($user,$permiso){
		  $sql="select * from ut_usuario u
inner join ut_grupo_usuario g on u.`id_grupo_usuario`=g.id
inner join ut_grupo_usuario_modulo g2 on  g2.`id_grupo_usuario`=g.id
where user='$user' and id_opcion ='$permiso' and ver=1";
		  $ocado=new cado();		  
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
		  } 
		  
	   function CambiarContra($user,$pass,$passdesp){
	  $sql="update ut_usuario set pass='$passdesp'
	          where user='$user' and pass='$pass' and  estado=1";
	  $ocado=new cado();		  
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
	 }
	 	  
	   
     function Loguearse($user,$pass){
	  $sql="select u.id,u.user,s.sobrenombre,s.id from ut_usuario u inner join ut_sucursal  s on u.id_sucursal=s.id
	          where user='$user' and pass='$pass' and u.estado=1";
	  $ocado=new cado();		  
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
	 }
	 function ListarGrupos(){
	  $sql="select id,nombre from ut_grupo_usuario";
	  $ocado=new cado();		  
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
	  }
	 function MaxId(){
	  $ocado=new cado();
	  $sql="select max(id) from ut_usuario";
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
	 } 
     function ListarXUsuario($id_sucursal,$usuario){
	  $ocado=new cado();
	  $sql="select id,apellidos,nombres,dni,estado from ut_usuario where id_sucursal='$id_sucursal' 
	        and concat(apellidos,' ',nombres) like '%".$usuario."%'  ";
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
	 }
	  function ListarXId($id){
	  $ocado=new cado();
	  $sql="select * from ut_usuario where id='$id' ";
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
	 }
	function Insertar($id,$dni,$nombres,$apellidos,$user,$pass,$fec_crea,$user_crea,$estado,$id_grupo_usuario,$idsucursal){
	  $ocado=new cado();
	  $sql="insert into ut_usuario 
	   values('$id','$dni','$nombres','$apellidos','$user','$pass','$fec_crea','$user_crea','$estado','$id_grupo_usuario',
	          '$idsucursal')";
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
	 }
	 function Modificar($id,$dni,$nombres,$apellidos,$user,$pass,$fec_crea,$user_crea,$estado){
	  $ocado=new cado();
	  $sql="update ut_usuario set dni='$dni',nombres='$nombres',apellidos='$apellidos',user='$user',pass='$pass',estado='$estado'
	        where id='$id'";
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
	 }
	 function Eliminar($id){
	  $ocado=new cado();
	  $sql="delete from ut_usuario where id='$id'";
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
	 }
	 
	 	 
	
   }
?>