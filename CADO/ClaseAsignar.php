<?php
   require_once('conexion.php');
   
   class Asignar{
	    function IdHemodialisis(){
	  $ocado=new cado();
	  $sql="select correlativo+1 from ut_correlativo_tabla where tabla='he_hemodialisis'";
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
	 }
	 
	   
	    function ax($id_turno,$fecha ){
		    $sql="delete FROM he_programacion WHERE  
(fecha='$fecha' ) and (id_turno='$id_turno'  )  ";
		 $ocado=new cado();		  
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
		   }
	   
	   function res1($id_turno,$fecha,$id_ficha_atencion){
		    $sql="SELECT count(*) FROM he_programacion WHERE  
  (fecha_reprogramacion is not null  and id_turno_reprogramado is not  null)  and   id_ficha_atencion='$id_ficha_atencion'";
		 $ocado=new cado();		  
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
		   }
	   
	   function unico2($id_turno,$fecha,$id_ficha_atencion){
		   $sql="SELECT count(*) FROM he_programacion WHERE  
( (fecha_reprogramacion='$fecha' and id_turno_reprogramado='$id_turno')) and   id_ficha_atencion='$id_ficha_atencion'";
		 $ocado=new cado();		  
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
		   }
	   
	   function unico($id_turno,$fecha,$id_ficha_atencion){
		   $sql="SELECT count(*) FROM he_programacion WHERE  
(fecha='$fecha' or fecha_reprogramacion='$fecha') and (id_turno='$id_turno' or id_turno_reprogramado='$id_turno') and id_ficha_atencion='$id_ficha_atencion'";
		 $ocado=new cado();		  
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
		   }
		
		function cualmodulo($id_turno,$fecha,$id_ficha_atencion){
			$sql="SELECT id_modulo FROM he_programacion WHERE  
(fecha='$fecha' or fecha_reprogramacion='$fecha') and (id_turno='$id_turno' or id_turno_reprogramado='$id_turno') and id_ficha_atencion='$id_ficha_atencion' ";
			$ocado=new cado();		  
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
			}  
			
			function cualre($id_turno,$fecha,$id_ficha_atencion){
			$sql="SELECT dia_reprog,id_turno_reprogramado,fecha_reprogramacion,dia_prog
			 FROM he_programacion WHERE  
(fecha='$fecha' or fecha_reprogramacion='$fecha') and (id_turno='$id_turno' or id_turno_reprogramado='$id_turno') and id_ficha_atencion='$id_ficha_atencion'   ";
			$ocado=new cado();		  
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
			}  
			
			
			function cualestado3($id_turno,$fecha,$id_ficha_atencion,$dia){
			$sql="SELECT count(*) from  he_ficha_atencion where id='$id_ficha_atencion' and 
			$dia=1 and	 id_turno='$id_turno'  and estado= 1 
			and (not (SELECT count(*) FROM he_programacion WHERE  
			( fecha='$fecha' and id_turno='$id_turno'  )and 
(  fecha_reprogramacion is not null) and ( id_turno_reprogramado is not null) and id_ficha_atencion='$id_ficha_atencion')>0)
			
						";
			$ocado=new cado();		  
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
			} 
			
			
			
			function cualestado($id_turno,$fecha,$id_ficha_atencion){
			$sql="SELECT if(estado>0,1,0) FROM he_programacion WHERE  
(fecha='$fecha' or fecha_reprogramacion='$fecha') and (id_turno='$id_turno' or id_turno_reprogramado='$id_turno') and id_ficha_atencion='$id_ficha_atencion'";
			$ocado=new cado();		  
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
			} 
			
			
			function cualestado2($id_turno,$fecha,$id_ficha_atencion){
			$sql="SELECT count(*) FROM  he_hemodialisis WHERE
		verificacion='1' and id_programacion=(SELECT id FROM  he_programacion WHERE  
(fecha='$fecha' or fecha_reprogramacion='$fecha') and (id_turno='$id_turno' or id_turno_reprogramado='$id_turno') and id_ficha_atencion='$id_ficha_atencion'
limit 0,1) ";
			$ocado=new cado();		  
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
			} 
 
 
 		   	 function  EliminarProtocolo($id_programacion){
	  $ocado=new cado();
	  $sql="delete from he_hemodialisis where id_programacion='$id_programacion'";   
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
              estado,verificacion
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
              '$enfe_reuso_filtro','$enfe_heparina','$enfe_val_inicial','$enfe_val_final','$enfe_asp_filtro',0,0)";
            
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;	 
	 } 
		   
		  
		   
		    function eliminarreprogramacion($id_turno,$fecha,$id_ficha_atencion){
			  $sql="UPDATE  `he_programacion` 
			  SET  fecha_reprogramacion=null,id_turno_reprogramado=null,dia_reprog=''
			 WHERE  (fecha='$fecha' or fecha_reprogramacion='$fecha') and (id_turno='$id_turno' or id_turno_reprogramado='$id_turno') and id_ficha_atencion='$id_ficha_atencion'    
			  LIMIT 1 ;";
			  $ocado=new cado();		  
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
			  
			  }
			   function generaridprogramacion($id_turno,$fecha,$id_ficha_atencion){
			  $sql="select id from he_programacion
			 WHERE  
(fecha='$fecha' or fecha_reprogramacion='$fecha') and (id_turno='$id_turno' or id_turno_reprogramado='$id_turno') and id_ficha_atencion='$id_ficha_atencion'   
			  LIMIT 1 ;";
			  $ocado=new cado();		  
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
			  
			  }
			    function generaridpaciente($id_ficha_atencion){
			  $sql="select id_paciente from he_ficha_atencion where id ='$id_ficha_atencion' ;";
			  $ocado=new cado();		  
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
			  
			  }
			   function ActualizarCorrelativoTabla($id_hemo){
	  $ocado=new cado();
	  $sql="update ut_correlativo_tabla set correlativo='$id_hemo' where tabla='he_hemodialisis'";	
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
	 }
			  
			  
		   function modificarestado($id_turno,$fecha,$id_ficha_atencion,$estado){
			  $sql="UPDATE  `he_programacion` 
			  SET  `estado` =  '$estado' 
			 WHERE  
(fecha='$fecha' or fecha_reprogramacion='$fecha') and (id_turno='$id_turno' or id_turno_reprogramado='$id_turno') and id_ficha_atencion='$id_ficha_atencion'   
			  LIMIT 1 ;";
			  $ocado=new cado();		  
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
			  
			  }
			 function modificarre($id_turno,$fecha,$id_ficha_atencion,$fechareg,$turnoreg,$diareg){
			  $sql="UPDATE  `he_programacion` 
		 SET	  `dia_reprog` =  '$diareg',
`id_turno_reprogramado` =  '$turnoreg',
`fecha_reprogramacion` =  '$fechareg'
			 WHERE  
(fecha='$fecha' or fecha_reprogramacion='$fecha') and (id_turno='$id_turno' or id_turno_reprogramado='$id_turno') and id_ficha_atencion='$id_ficha_atencion'  
			  LIMIT 1 ;";
			  $ocado=new cado();		  
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
			  
			  } 
			  
			    
		  function modificarmodulo($id_turno,$fecha,$id_ficha_atencion,$id_modulo){
			  $sql="UPDATE  `he_programacion` 
			  SET  `id_modulo` =  '$id_modulo' 
	WHERE  
(fecha='$fecha' or fecha_reprogramacion='$fecha') and (id_turno='$id_turno' or id_turno_reprogramado='$id_turno') and id_ficha_atencion='$id_ficha_atencion'  
			  LIMIT 1 ;";
			  $ocado=new cado();		  
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
			  
			  } 
	     function insertar2($frecuencia,$dia_programado,$obs,$estado,$id_modulo,$id_ficha_atencion,$id_turno,$fecha,$fechareg,$turnoreg,$diareg){
		   $sql="INSERT INTO  `he_programacion` (
`id` ,`Frecuencia` ,`dia_prog` ,`dia_reprog` ,`obs` ,`estado` ,`id_modulo` ,`id_ficha_atencion` ,`id_turno` ,`id_turno_reprogramado` ,`fecha` ,`fecha_reprogramacion`)VALUES
 (NULL,  '$frecuencia',  '$dia_programado',  '$diareg',  '$obs',  '$estado',  '$id_modulo',  '$id_ficha_atencion',  '$id_turno', '$turnoreg' ,  '$fecha', '$fechareg');";
		   $ocado=new cado();		  
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
		   }
		   
		   
	   function insertar($frecuencia,$dia_programado,$obs,$estado,$id_modulo,$id_ficha_atencion,$id_turno,$fecha){
		   $sql="INSERT INTO  `he_programacion` (
`id` ,`Frecuencia` ,`dia_prog` ,`dia_reprog` ,`obs` ,`estado` ,`id_modulo` ,`id_ficha_atencion` ,`id_turno` ,`id_turno_reprogramado` ,`fecha` ,`fecha_reprogramacion`
)VALUES (NULL,  '$frecuencia',  '$dia_programado',  NULL,  '$obs',  '$estado',  '$id_modulo',  '$id_ficha_atencion',  '$id_turno', NULL ,  '$fecha', NULL);;";
		   $ocado=new cado();		  
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
		   }
		   
		   
		   
		   function modificar($frecuencia,$dia_programado,$dia_repogramado,$obs,$estado,$id_modulo,$id_ficha_atencion,$id_turno,$id_paciente,$fecha,$id,$fechacambio){
		   $sql="UPDATE   he_programacion SET   

dia_reprog =  '$dia_repogramado',
obs =  '$obs',
id_modulo =  '$id_modulo',
 id_turno =  '$id_turno',
 fecha =  '$fecha' WHERE  he_programacion.id =1 LIMIT 1 ;";
		   $ocado=new cado();		  
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
		   }
	   
	   function modulos($idsucursal){
		   $sql="SELECT * FROM  he_modulo where id_sucursal='$idsucursal' ";
	  $ocado=new cado();		  
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
		   
		   }
	 
	 function Listarturno($idsucursal){
	 $sql="select id,turno from ut_turno where id_sucursal='$idsucursal'";
	  $ocado=new cado();		  
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
	 } 
	 
	 function ListarAsignar($turno,$dia,$fecha,$id_sucursal){
	 $sql="select f.id,p.id,apellidos,	 nombres, concat(if(lunes=1,'LU-',''),if(martes=1,'MA-',''),if(miercoles=1,'MI-',''),if(jueves=1,'JU-',''),if(viernes=1,'VI-',''),if(sabado=1,'SA-',''),if(domingo=1,'DO','')),(
SELECT count(*) FROM he_programacion WHERE  
fecha_reprogramacion='$fecha' and id_turno_reprogramado='$turno' and id_ficha_atencion=f.id)

	  from he_paciente  p
inner join  he_ficha_atencion f on  p.id=f.id_paciente and f.estado=1
where ((id_turno='$turno'  and $dia=1 and id_turno<>'') or (
SELECT count(*) FROM he_programacion WHERE  
fecha_reprogramacion='$fecha' and id_turno_reprogramado='$turno' and id_ficha_atencion=f.id)>0) and id_sucursal='$id_sucursal'
";
 $ocado=new cado();		  
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
	 }  
	 
	 function ListarAsignar2($turno,$fecha,$id_sucursal){
	 $sql="select concat(apellidos,' ',nombres) 
from he_paciente  p
inner join  he_ficha_atencion f on  p.id=f.id_paciente and f.estado=1
where (SELECT count(*) FROM he_programacion he WHERE  
((fecha_reprogramacion='$fecha' and he.estado>0 and id_turno_reprogramado='$turno') or (fecha='$fecha' and he.estado>0 and id_turno='$turno' and id_turno_reprogramado is Null)) and id_ficha_atencion=f.id

)>0
and id_sucursal='$id_sucursal'
";
 $ocado=new cado();		  
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
	 }  
	

 	
	function turnos($id_sucursal){
		$sql="SELECT * FROM `ut_turno` WHERE  `id_sucursal`='$id_sucursal'"; $ocado=new cado();		  
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
		
		} 	 
		
		
		
	function modulo($id_modulo,$id_sucursal){
		$sql="SELECT * FROM  he_modulo WHERE  `id_sucursal`='$id_sucursal' and id='$id_modulo'"; $ocado=new cado();		  
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
		
		} 
	      
	 
   }
?>