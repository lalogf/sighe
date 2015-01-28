<?php
   require_once('conexion.php');
   
   class HistorialFichas{
	   
     function ListarXPaciente($paciente,$idsucursal){
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
	 function ListarFichasXPac($idpaciente){
	  $ocado=new cado();
	  $sql="select id,fecha_ate,estado from he_ficha_atencion where id_paciente='$idpaciente' order by estado desc";
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
	 }
	 function InhabilitarHF($idficha,$fecha,$user){
	  $ocado=new cado();
	  $sql="update he_ficha_atencion set estado=0,fec_anul='$fecha',anul_user='$user' where id='$idficha'";
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
	 }
	 function VerPacXIdFicha($idficha){
	  $ocado=new cado();
	  $sql="select id_paciente from he_ficha_atencion where id='$idficha'";
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
	 }
	 
	 function VerFichaPaciente($idficha){
	  $ocado=new cado();
	  $sql="select pa.id,concat(pa.apellidos,', ',pa.nombres) paciente,pa.fecha_nac,pa.gruposanguineo,pa.factorsanguineo,pa.sexo,
	         fi.id_turno,fi.nro_ficha,fi.fecha_ate,fi.edad,fi.edad_tipo,fi.di_actual,fi.telef,fi.contac_emerg,fi.telef_emerg,
	         fi.fecha_inicio_dialisis,fi.fecha_inicio_dialisis_rinon,fi.diagnostico_inicio,fi.cie10,fi.peso_seco,fi.lunes,fi.martes,
	         fi.miercoles,fi.jueves,fi.viernes,fi.sabado,fi.domingo,fi.alergico_a,fi.restante,fi.obs,fi.fec_crea,fi.crea_user,
	         fi.fec_crea,fi.crea_user,fi.estado,
			 se.s_hiv,se.s_hvc,se.s_ag_hbs,se.con_n,se.con_p,se.con_pp,se.inmunizacion_fecha_1,se.inmunizacion_responsable_1,
			 se.inmunizacion_fecha_2,se.inmunizacion_responsable_2,se.inmunizacion_fecha_3,se.inmunizacion_responsable_3,
			 se.inmunizacion_fecha_1ref,se.inmunizacion_responsable_1ref,se.inmunizacion_fecha_2ref,se.inmunizacion_responsable_2ref
	         
	       from he_paciente pa inner join he_ficha_atencion fi on pa.id=fi.id_paciente
	                           inner join he_serologia se on fi.id=se.id_ficha_atencion
	         where fi.id='$idficha'";
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
	 }
	 function VerCie10($codigo){
	  $ocado=new cado();
	  $sql="select dx_codigo,dx_des from he_cie10 where dx_codigo='$codigo'";
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
	 }
      
	 function VerTurno($idturno){
	  $ocado=new cado();
	  $sql="select id,turno from ut_turno where id='$idturno'";
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
	 }
   }
?>