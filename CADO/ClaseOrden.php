<?php
   require_once('conexion.php');
   
   class Orden{
	   
	    function Eliminar($id){
	  $ocado=new cado();
	  $sql="delete from `he_orden_examen` where id='$id';
	  delete from `he_detalle_orden_examen`  where id_orden_examen='$id'
	  ";
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
	 }
	  function ListaMedicamentos2($id){
	  $ocado=new cado();
	 $sql="SELECT id,codigo,medicamento,presentacion,unidad,fec_crea,user_crea,if(estado=1,'activo','inactivo') FROM `he_medicamento` where medicamento like '$id%' ";
	 $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
	 }
	 
     function MaxId(){
	  $ocado=new cado();
	  $sql="select max(id) from `he_orden_examen` ";
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
	 } 
	 
	  function ListarXOrden2($id){
	  $ocado=new cado();
	  $sql="SELECT oe.id, DATE_FORMAT(oe.fecha, '%d/%m/%Y'),oe.observacion,if(oe.estado=1,'Ingresada','No Ingresada'),oe.estado
	   FROM  he_orden_examen  oe
inner join he_ficha_atencion f  on  f.id =  oe.id_ficha_atencion and f.estado=1
inner join he_paciente p on f.id_paciente=p.id 
where  f.id='$id' order by fecha asc
 
   ";
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
	 }
	 
	    function ListaTodoMedicamentos(){
	  $ocado=new cado();
	  $sql="SELECT * FROM `he_medicamento`  
 
   ";
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
	 }
	 
	    function EliminarMedicamentos($idhemo){
	  $ocado=new cado();
	  $sql="delete FROM  he_detalle_medicamento where id_hemodialisis='$idhemo'
 
   ";
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
	 }
	 
	 
	   function InsertarMedicamentos($idmedicamento,$id_hemo,$cantidad){
	  $ocado=new cado();
	  $sql="INSERT INTO   `he_detalle_medicamento` (
`id` ,`id_medicamento` ,`id_hemodialisis` ,`cantidad`)
VALUES (NULL ,  '$idmedicamento',  '$id_hemo',  '$cantidad');";
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
	 }
	 
	 
	   function ListaMedicamentos($id_hemo){
	  $ocado=new cado();
	  $sql="SELECT * FROM `he_medicamento`  m
inner join he_detalle_medicamento d
on  m.id=d.id_medicamento where  `id_hemodialisis`='$id_hemo'
 
   ";
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
	 }
	 
	  function ListarXOrden($id_sucursal,$string){
	  $ocado=new cado();
	  $sql="SELECT oe.id, oe.fecha,apellidos,nombres,if(oe.estado=1,'Ingresada','No Ingresada'),oe.estado FROM  he_orden_examen  oe
inner join he_ficha_atencion f  on  f.id =  oe.id_ficha_atencion and f.estado=1
inner join he_paciente p on f.id_paciente=p.id 
where oe.id_sucursal='$id_sucursal' and  concat(apellidos,nombres) like '%$string%'
limit 0,10
   ";
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
	 }
	 
	 
	   function HemodialisisProgramacion($id){
	  $ocado=new cado();
	  $sql="SELECT id from  he_hemodialisis where id_programacion='$id'
   ";
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
	 }
	 
	 
	 
     function ListarXExamen($id_sucursal){
	  $ocado=new cado();
	  $sql="select * from he_tipo_examen
	   where id_sucursal='$id_sucursal'  and estado=1    ";
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
	 }
	 
	  function ListarXId($id){
	  $ocado=new cado();
	  $sql="select * from he_orden_examen oe
	  inner join he_ficha_atencion f  on  f.id =  oe.id_ficha_atencion and f.estado=1
inner join he_paciente p on f.id_paciente=p.id 
	   where oe.id='$id' ";
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
	 }
	function Insertar($id,$idpac,$estado,$obs,$fecha,$usuario,$isu){
	  $ocado=new cado();
	  $sql="INSERT INTO   `he_orden_examen` (
`id` ,
`id_ficha_atencion` ,
`estado` ,
`observacion` ,
`fecha` ,
`crea_user` ,
`fecha_crea`,id_sucursal
)
VALUES (
'$id',  '$idpac',  '$estado',  '$obs',  '$fecha',  '$usuario',  now(),'$isu');";
 $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
	 }
	 
	 
	 function listardetalle($idorden,$idexamen){
		  $ocado=new cado();
		 $sql="select valor from `he_detalle_orden_examen` where id_orden_examen='$idorden' and 
		id_tipo_examen='$idexamen'  ";
		 $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
		 }
	 
	 function Insertar2($idorden,$idexamen,$valor){
	  $ocado=new cado();
	  $sql="INSERT INTO   `he_detalle_orden_examen` (
`id` ,
`id_orden_examen` ,
`id_tipo_examen` ,
`valor`
)
VALUES (
NULL ,  '$idorden',  '$idexamen',  '$valor'
);";
 $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
	 }
	 
	 
	 function borrar($id){
		   $ocado=new cado();
		   $sql="delete from `he_detalle_orden_examen` where `id_orden_examen`='$id' ";
		  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
		 }
	 
	 function Modificar($id,$idpac,$estado,$obs,$fecha,$usuario,$isu){
	  $ocado=new cado();
	  $sql="UPDATE  
	  `he_orden_examen` SET  `id_ficha_atencion` =  '$idpac',
`estado` =  '$estado',
`observacion` =  '$obs',
`fecha` =  '$fecha' WHERE  `he_orden_examen`.`id` ='$id' LIMIT 1 ;";
 $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
	 }
	 
	 	 
	
   }
?>