<?php
   require_once('conexion.php');
   
   class TExamen{
	   
	   
	   
	   
     function MaxId(){
	  $ocado=new cado();
	  $sql="select max(id) from `he_tipo_examen` ";
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
	 } 
     function ListarXExamen($id_sucursal,$examen){
	  $ocado=new cado();
	  $sql="select * from he_tipo_examen
	   where id_sucursal='$id_sucursal' and examen  like '%$examen%'  ";
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
	 }
	 
	  function ListarXId($id){
	  $ocado=new cado();
	  $sql="select * from he_tipo_examen where id='$id' ";
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
	 }
	function Insertar($id,$examen,$valornormal,$estado,$idsucursal){
	  $ocado=new cado();
	  $sql="INSERT INTO  `he_tipo_examen` (
	  `id` ,
`examen` ,
`valornormal` ,
`estado` ,
`fechacreacion` ,
`id_sucursal`
)
VALUES (
'$id',  '$examen',  '$valornormal',  '$estado',  now(),  '$idsucursal'
);";
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
	 }
	 function Modificar($id,$examen,$valornormal,$estado,$idsucursal){
	  $ocado=new cado();
	  $sql="UPDATE   `he_tipo_examen` set
`examen` =  '$examen',
`valornormal` =  '$valornormal',
`estado` =  '$estado' 
WHERE  `he_tipo_examen`.`id` ='$id' LIMIT 1 ;";
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
	 }
	 function Eliminar($id){
	  $ocado=new cado();
	  $sql="delete from `he_tipo_examen` where id='$id'";
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
	 }
	 
	 	 
	
   }
?>