<?php
   require_once('conexion.php');
   
   class Hemodialisis{
	 
	 function IdHemodialisis(){
	  $ocado=new cado();
	  $sql="select correlativo+1 from ut_correlativo_tabla where tabla='he_hemodialisis'";
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
	 }
	 function ListaProgramados($idsucursal,$idturno){
	   date_default_timezone_set('America/Lima');	 
	  $fecha=date("Y-m-d"); 
	  //echo $fecha;exit;	 
	  $ocado=new cado();
	  $sql="select m.* 
	       from ( select fi.id as id_ficha,pro.id as id_programacion,pa.id as id_paciente,concat(apellidos,', ',nombres) paciente,
                          (case when fecha_reprogramacion is null then pro.fecha else pro.fecha_reprogramacion end) as fec,
                          (case when fecha_reprogramacion is null then 'PROGRAMADO' else 'REPROGRAMADO' end) as tipo,
			              (case when fecha_reprogramacion is null then pro.id_turno else pro.id_turno_reprogramado end) as turno,
						   pro.Frecuencia,
						   (case when pro.fecha_reprogramacion is null then (select turno from ut_turno tu where tu.id=pro.id_turno)
			  else  (select turno from ut_turno tu where tu.id=pro.id_turno_reprogramado) end) as tur 
	               from he_programacion pro inner join he_ficha_atencion fi on pro.id_ficha_atencion=fi.id
	                                         inner join he_paciente pa on fi.id_paciente=pa.id
											 inner join he_hemodialisis he on  he.id_programacion=pro.id
	                    where id_sucursal='$idsucursal' and pro.estado=1 and fi.estado=1
			     ) m   where m.turno='$idturno' and m.fec='$fecha'";
			
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
	 }
	  function ListarProtocolo($idprogramacion){
	  $ocado=new cado();
	  $sql="select * from he_hemodialisis where id_programacion='$idprogramacion'";  
			 
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
	 }
      function ListarMonitoreo($idhemodialisis){
	  $ocado=new cado();
	  $sql="select * from he_monitoreo where id_hemodialisis='$idhemodialisis'";	
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
	 }
	 function ListarMonitoreoXId($id_moni){
	  $ocado=new cado();
	  $sql="select id,id_hemodialisis,hr,pa,fc,qb,condc,p_a,pv,ptm,uf_p,uf_t,obs from he_monitoreo where id='$id_moni'";	
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
	 }
	 function EliminarMonitoreo($id_moni){
	  $ocado=new cado();
	  $sql="delete from he_monitoreo where id='$id_moni'";	
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
	 }
	  function ActualizarMonitoreo($id_moni,$hr,$pa,$fc,$qb,$condc,$p_a,$pv,$ptm,$uf_p,$uf_t,$obs){
	  $ocado=new cado();
	  $sql="update he_monitoreo
            set hr='$hr',pa='$pa',fc='$fc',qb='$qb',condc='$condc',p_a='$p_a',pv='$pv',ptm='$ptm',uf_p='$uf_p',uf_t='$uf_t', obs='$obs'             
             where id='$id_moni'";	
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
	 }
	 function GenerarIdMonitoreo(){
	  $ocado=new cado();
	  $sql="select max(id) from he_monitoreo";	
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
	 }
	 function InsertarProtocolo($id,$id_ficha_atencion,$id_programacion,$id_paciente,$med_procli,$med_evolucion,
              $med_hras_hd,$med_heparina,$med_pesoseco,$med_extraccion,$med_areafiltro,
              $med_membrana,$med_cond_sero,$med_qb,$med_qd,$med_hco3,$med_temp_maq,
              $med_conduc,$med_na_inicial,$med_na_final,$enf_inicia,$cep_inicia,$enf_finaliza,
              $cep_finaliza,$enfe_pa_inicial,$enfe_fc_inicial,$enfe_peso_inicial,$enfe_uf_inicial,
              $enfe_pa_final,$enfe_fc_final,$enfe_peso_final,$enfe_uf_final,$enfe_art_fav,
              $enfe_art_inj,$enfe_art_cvc,$enfe_art_cvlp,$enfe_ven_fav,$enfe_ven_inj,$enfe_ven_cvc,
              $enfe_ven_cvlp,$enfe_ven_vp,$enfe_num_maq,$enfe_marca_mod,$enfe_vol_filtro,
              $enfe_reuso_filtro,$enfe_heparina,$enfe_val_inicial,$enfe_val_final,$enfe_asp_filtro){
	  $ocado=new cado();
	  $sql="insert into he_hemodialisis
            (id,id_ficha_atencion,id_programacion,id_paciente,med_procli,med_evolucion,med_hras_hd,med_heparina,
              med_pesoseco,med_extraccion,med_areafiltro,med_membrana,med_cond_sero,med_qb,med_qd,med_hco3,
              med_temp_maq,med_conduc,med_na_inicial,med_na_final,enf_inicia,cep_inicia,enf_finaliza,
              cep_finaliza,enfe_pa_inicial,enfe_fc_inicial,enfe_peso_inicial,enfe_uf_inicial,enfe_pa_final,
              enfe_fc_final,enfe_peso_final,enfe_uf_final,enfe_art_fav,enfe_art_inj,enfe_art_cvc,enfe_art_cvlp,
              enfe_ven_fav,enfe_ven_inj,enfe_ven_cvc,enfe_ven_cvlp,enfe_ven_vp,enfe_num_maq,enfe_marca_mod,
              enfe_vol_filtro,enfe_reuso_filtro,enfe_heparina,enfe_val_inicial,enfe_val_final,enfe_asp_filtro,
              estado
              )
           values
            ('$id','$id_ficha_atencion','$id_programacion','$id_paciente','$med_procli','$med_evolucion',
              '$med_hras_hd','$med_heparina','$med_pesoseco','$med_extraccion','$med_areafiltro',
              '$med_membrana','$med_cond_sero','$med_qb','$med_qd','$med_hco3','$med_temp_maq',
              '$med_conduc','$med_na_inicial','$med_na_final','$enf_inicia','$cep_inicia','$enf_finaliza',
              '$cep_finaliza','$enfe_pa_inicial','$enfe_fc_inicial','$enfe_peso_inicial','$enfe_uf_inicial',
              '$enfe_pa_final','$enfe_fc_final','$enfe_peso_final','$enfe_uf_final','$enfe_art_fav',
              '$enfe_art_inj','$enfe_art_cvc','$enfe_art_cvlp','$enfe_ven_fav','$enfe_ven_inj','$enfe_ven_cvc',
              '$enfe_ven_cvlp','$enfe_ven_vp','$enfe_num_maq','$enfe_marca_mod','$enfe_vol_filtro',
              '$enfe_reuso_filtro','$enfe_heparina','$enfe_val_inicial','$enfe_val_final','$enfe_asp_filtro',0 )";
            
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;	 
	 } 
	 function ActualizarProtocolo($id_hemodialisis,$med_procli,$med_evolucion,
              $med_hras_hd,$med_heparina,$med_pesoseco,$med_extraccion,$med_areafiltro,
              $med_membrana,$med_cond_sero,$med_qb,$med_qd,$med_hco3,$med_temp_maq,
              $med_conduc,$med_na_inicial,$med_na_final,$enf_inicia,$cep_inicia,$enf_finaliza,
              $cep_finaliza,$enfe_pa_inicial,$enfe_fc_inicial,$enfe_peso_inicial,$enfe_uf_inicial,
              $enfe_pa_final,$enfe_fc_final,$enfe_peso_final,$enfe_uf_final,$enfe_art_fav,
              $enfe_art_inj,$enfe_art_cvc,$enfe_art_cvlp,$enfe_ven_fav,$enfe_ven_inj,$enfe_ven_cvc,
              $enfe_ven_cvlp,$enfe_ven_vp,$enfe_num_maq,$enfe_marca_mod,$enfe_vol_filtro,
              $enfe_reuso_filtro,$enfe_heparina,$enfe_val_inicial,$enfe_val_final,$enfe_asp_filtro
              ){
	   $ocado=new cado();
	   $sql="update he_hemodialisis 
             set med_procli='$med_procli',med_evolucion='$med_evolucion',med_hras_hd='$med_hras_hd',
               med_heparina='$med_heparina',med_pesoseco='$med_pesoseco',med_extraccion='$med_extraccion',
               med_areafiltro='$med_areafiltro',med_membrana='$med_membrana',med_cond_sero='$med_cond_sero',
               med_qb='$med_qb',med_qd='$med_qd',med_hco3='$med_hco3',med_temp_maq='$med_temp_maq',
               med_conduc='$med_conduc',med_na_inicial='$med_na_inicial',med_na_final='$med_na_final',
               enf_inicia='$enf_inicia',cep_inicia='$cep_inicia',enf_finaliza='$enf_finaliza',
               cep_finaliza='$cep_finaliza',enfe_pa_inicial='$enfe_pa_inicial',enfe_fc_inicial='$enfe_fc_inicial',
               enfe_peso_inicial='$enfe_peso_inicial',enfe_uf_inicial='$enfe_uf_inicial',enfe_pa_final='$enfe_pa_final',
               enfe_fc_final='$enfe_fc_final',enfe_peso_final='$enfe_peso_final',enfe_uf_final='$enfe_uf_final',
               enfe_art_fav='$enfe_art_fav',enfe_art_inj='$enfe_art_inj',enfe_art_cvc='$enfe_art_cvc',
               enfe_art_cvlp='$enfe_art_cvlp',enfe_ven_fav='$enfe_ven_fav',enfe_ven_inj='$enfe_ven_inj',
               enfe_ven_cvc='$enfe_ven_cvc',enfe_ven_cvlp='$enfe_ven_cvlp',enfe_ven_vp='$enfe_ven_vp',
               enfe_num_maq='$enfe_num_maq',enfe_marca_mod='$enfe_marca_mod',enfe_vol_filtro='$enfe_vol_filtro',
               enfe_reuso_filtro='$enfe_reuso_filtro',enfe_heparina='$enfe_heparina',enfe_val_inicial='$enfe_val_inicial',
               enfe_val_final='$enfe_val_final',enfe_asp_filtro='$enfe_asp_filtro'
              where id='$id_hemodialisis'";
	   $ejecutar=$ocado->ejecutar($sql);
	   return $ejecutar;
	  }
	 function InsertarMonitoreo($id,$id_hemodialisis,$hr,$pa,$fc,$qb,$condc,$p_a,$pv,$ptm,$uf_p,$uf_t,$obs){
	  $ocado=new cado();
	  $sql="insert into he_monitoreo
              (id,id_hemodialisis,hr,pa,fc,qb,condc,p_a,pv,ptm,uf_p,uf_t,obs)
             values
              ('$id','$id_hemodialisis','$hr','$pa','$fc','$qb','$condc','$p_a','$pv','$ptm','$uf_p','$uf_t','$obs')";	
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
	 }
	 function VerificarHemodialisis($id_programacion){
	  $ocado=new cado();
	  $sql="select id from he_hemodialisis where id_programacion='$id_programacion'";	
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
	 }
	 function ActualizarCorrelativoTabla($id_hemo){
	  $ocado=new cado();
	  $sql="update ut_correlativo_tabla set correlativo='$id_hemo' where tabla='he_hemodialisis'";	
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
	 }
	 function AltaPaciente($id_hemo,$alta_user,$fec_alta,$obs_alta){
	  $ocado=new cado();
	  $sql="update he_hemodialisis
             set alta_user='$alta_user',fec_alta='$fec_alta',obs_alta='$obs_alta',estado=1
             where id='$id_hemo'";	
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
	 }
	 function AltaPacienteProgramado($id_programacion){
	  $ocado=new cado();
	  $sql="update he_programacion
             set estado=2
             where id='$id_programacion'";	
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
	 }
	 function RestaFechas($inicio,$fin){
	  $ocado=new cado();
	  $sql="select datediff('$fin','$inicio')";	
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
	 }
	 function ReporteAtencionPacientes($inicio,$fin,$id_sucursal){
	  $ocado=new cado();
	  $sql="select paciente,n,dia1,dia2,dia3,dia4,dia5,dia6,dia7,(dia1+dia2+dia3+dia4+dia5+dia6+dia7)total,autogenerado,dni from (
	      select concat(pa.nombres,', ',pa.apellidos)paciente,'N' as n,(case when '2013-06-20'=he.fec_alta then 1 else 0 end)dia1,
	        (case when DATE_ADD('$inicio',INTERVAL 1 DAY)=he.fec_alta then 1 else 0 end)dia2,
			(case when DATE_ADD('$inicio',INTERVAL 2 DAY)=he.fec_alta then 1 else 0 end)dia3,
			(case when DATE_ADD('$inicio',INTERVAL 3 DAY)=he.fec_alta then 1 else 0 end)dia4,
			(case when DATE_ADD('$inicio',INTERVAL 4 DAY)=he.fec_alta then 1 else 0 end)dia5,
			(case when DATE_ADD('$inicio',INTERVAL 5 DAY)=he.fec_alta then 1 else 0 end)dia6,
			(case when DATE_ADD('$inicio',INTERVAL 6 DAY)=he.fec_alta then 1 else 0 end)dia7,pa.autogenerado,pa.dni
	        from he_hemodialisis he inner join he_paciente pa on he.id_paciente=pa.id
			where he.estado=2 and pa.id_sucursal='$id_sucursal' and  he.fec_alta between '$inicio' and '$fin'
			)as t";	
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
	 }
	 function DiasSemana($fec){
	    $fe= strtotime($fec);	
        switch (date('w', $fe)){ 
          case 0: $dia="DO"; break; 
          case 1: $dia="LU"; break; 
          case 2: $dia="MA"; break; 
          case 3: $dia="MI"; break; 
          case 4: $dia="JU"; break; 
          case 5: $dia="VI"; break; 
          case 6: $dia="SA"; break; 
         } 
      return $dia; 
	 }
	 function NumDia($dia){
		if($dia=='DO'){$num_can=0;} 
	    if($dia=='LU'){$num_can=1;}
		if($dia=='MA'){$num_can=2;}
		if($dia=='MI'){$num_can=3;}
		if($dia=='JU'){$num_can=4;}
		if($dia=='VI'){$num_can=5;}
		if($dia=='SA'){$num_can=6;}
      return $num_can; 
	 }
	 function DiasSemana_Num($num){
        switch ($num){ 
          case 0: $dia="DO"; break; 
          case 1: $dia="LU"; break; 
          case 2: $dia="MA"; break; 
          case 3: $dia="MI"; break; 
          case 4: $dia="JU"; break; 
          case 5: $dia="VI"; break; 
          case 6: $dia="SA"; break; 
         } 
      return $dia; 
	 }
	 
	
	   function HemodialisisProgramacion($id){
	  $ocado=new cado();
	  $sql="SELECT * from  he_hemodialisis where id_programacion='$id'  ";
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
	 }
	 
	 
	 
	   /*function verfrec($id){
	  $ocado=new cado();
	  $sql="SELECT concat(if(lunes=1,'LU-',''),if(martes=1,'MA-',''),if(miercoles=1,'MI-',''),if(jueves=1,'JU-',''),if(viernes=1,'VI-',''),if(sabado=1,'SA-',''),if(domingo=1,'DO','')) from  he_ficha_atencion where id='$id'";
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
	 }*/
	 
	 function HemodialisisMonitoreo($id){
	  $ocado=new cado();
	  $sql="SELECT * from he_monitoreo where id_hemodialisis='$id'";
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
	 }
	 function VerNombrePaciente($id_paciente){
	  $ocado=new cado();
	  $sql="SELECT concat(apellidos,', ',nombres) from he_paciente where id='$id_paciente'";
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
	 }
	/* function ListarPacienteXid($id_moni){
	  $ocado=new cado();
	  $sql="select id,id_hemodialisis,hr,pa,fc,qb,condc,p_a,pv,ptm,uf_p,uf_t,obs from he_monitoreo where id='$id_moni'";	
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
	 }*/
   }
?>