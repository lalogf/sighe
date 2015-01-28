<?php
   require_once('conexion.php');
   
   class Permisos{
	   
	   function insertaropcionxgrupo($grupousuario,$opcion,$ver){
		   $sql="
		   INSERT INTO  `ut_grupo_usuario_modulo` (`id` ,`id_grupo_usuario` ,`id_opcion` , `ver`
)VALUES (NULL ,  '$grupousuario',  '$opcion',  '$ver');";
		   $ocado=new cado();		  
	  	   $ejecutar=$ocado->ejecutar($sql);
	       return $ejecutar;
		   }
	   
	   function listaropciones($modulo){
	  $sql="select  id from    `ut_opcion`   where id_modulo='$modulo' ";
  		$ocado=new cado();		  
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
		 }
	 
	 function Veropciones($modulo,$grupousuario){
	  $sql="select id,codigo,opcion,menu,submenu,
(select  ver  from ut_grupo_usuario_modulo  where  id_grupo_usuario='$grupousuario'
and ut_grupo_usuario_modulo.id_opcion=ut_opcion.id
 limit 0,1 ) as ver
 from    `ut_opcion`   where id_modulo='$modulo' and (isnull(submenu) or submenu=0) order by menu";
  $ocado=new cado();		  
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
		 }
		 
		 function Veropciones2($modulo,$grupousuario,$menu){
	  $sql="select id,codigo,opcion,menu,submenu,
(select  ver  from ut_grupo_usuario_modulo  where  id_grupo_usuario='$grupousuario'
and ut_grupo_usuario_modulo.id_opcion=ut_opcion.id
 limit 0,1 ) as ver
 from    `ut_opcion`   where id_modulo='$modulo' and  menu='$menu' and  (not (isnull(submenu) or submenu=0)) order by menu";
  $ocado=new cado();		  
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
		 }
		 
	  function ListarGrupo(){
	  $sql="SELECT 	id ,nombre FROM  `ut_grupo_usuario` WHERE ESTADO=1 ";
	  $ocado=new cado();		  
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
	 }
	 function ListarUsuariosxGrupo($idgrupo){
	  $sql="SELECT `id`, `user`, `apellidos`,`nombres` 
FROM `ut_usuario` WHERE `id_sucursal`='$idgrupo'";
	  $ocado=new cado();		  
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
	  
    }
	 function ListarModulosxGrupoNA($idgrupo){
	  $sql="SELECT  `id` ,  `modulo` FROM  `ut_modulo` WHERE  `estado` =1
			AND (SELECT COUNT( * ) FROM ut_grupo_usuario_modulo INNER JOIN ut_opcion ON 			  ut_grupo_usuario_modulo.id_opcion = ut_opcion.id WHERE  `id_grupo_usuario` =  '$idgrupo' AND  `ut_modulo`.id = ut_opcion.id_modulo) =0 LIMIT 0 , 30 ";
	  $ocado=new cado();		  
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
	  
    }
	
	 function ListarModulosxGrupoA($idgrupo){
	  $sql="SELECT  `id` ,  `modulo` FROM  `ut_modulo` WHERE  `estado` =1
			AND (SELECT COUNT( * ) FROM ut_grupo_usuario_modulo INNER JOIN ut_opcion ON 			  ut_grupo_usuario_modulo.id_opcion = ut_opcion.id WHERE  `id_grupo_usuario` =  '$idgrupo' AND  `ut_modulo`.id = ut_opcion.id_modulo) >0 LIMIT 0 , 30 ";
	  $ocado=new cado();		  
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
	  
    }
	 
	 function asignar($modulo,$grupousuario){
		$sql="INSERT INTO  `ut_grupo_usuario_modulo` (
`id_grupo_usuario` ,`id_opcion` ,`ver`) SELECT '$grupousuario',id,0 FROM `ut_opcion` WHERE `id_modulo`='$modulo'"; 
		 $ocado=new cado();		  
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
		 }
		 
		  function desasignar($modulo,$grupousuario){
		 $sql="DELETE FROM  `ut_grupo_usuario_modulo` WHERE  `id_grupo_usuario` =  '$grupousuario' AND  `id_opcion` IN (SELECT id FROM ut_opcion WHERE id_modulo =  '$modulo' )";
	$ocado=new cado();		  
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
		 }
   }
?>