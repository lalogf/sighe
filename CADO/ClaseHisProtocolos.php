<?php
   require_once('conexion.php');
   
   class HistorialProtocolos{
	   
     function ListarXPacientePro($paciente,$idsucursal){
	  $ocado=new cado();
	  $sql="select id,concat(apellidos,', ',nombres),dni from he_paciente where concat(apellidos,', ',nombres) like '%".$paciente."%'
	          and id_sucursal='$idsucursal'";
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
	 } 
	 function ListarXIdPaciente($idpaciente){
	  $ocado=new cado();
	  $sql="select id,concat(apellidos,', ',nombres) from he_paciente where id='$idpaciente'";
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
	 }
	 function ListarProtocolos($idpaciente,$mes,$anio){
	  $ocado=new cado();
	  $sql="select he.id,he.fec_alta,he.id_programacion,pro.frecuencia,
	         (case when pro.fecha_reprogramacion is null then (select turno from ut_turno tu where tu.id=pro.id_turno)
			  else  (select turno from ut_turno tu where tu.id=pro.id_turno_reprogramado) end) as turno,
			  (case when fecha_reprogramacion is null then pro.fecha else pro.fecha_reprogramacion end) as fec 
	        from he_hemodialisis he inner join he_programacion pro on he.id_programacion=pro.id
			where he.id_paciente='$idpaciente' and MONTH(he.fec_alta)='$mes' and YEAR(he.fec_alta)='$anio'";
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
	 }
	 /*function ListarFichasXPac($idpaciente){
	  $ocado=new cado();
	  $sql="select id,fecha_ate,estado from he_ficha_atencion where id_paciente='$idpaciente' order by estado desc";
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
	 }*/
   }
?>