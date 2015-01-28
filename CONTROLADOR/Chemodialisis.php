<?php session_start();
     if(!isset($_SESSION['S_user'])){
		header("location:index.php");
		}
  require_once("../CADO/ClaseHemodialisis.php");
  controlador($_POST['accion']);
  
  function controlador($accion){
	  
	  $ohemodialisis=new Hemodialisis();
	   
	   if($accion=='LISTAR'){
		  $tbl=""; 
		  $id_turno=$_POST[idturno];
		  $listar=$ohemodialisis->ListaProgramados($_SESSION['S_idsucursal'],$id_turno);$i=0;
		  $can=$listar->rowCount();
		  //echo $can;
		  while($fila=$listar->fetch()){$i++;$fecha=implode('/',array_reverse(explode('-',$fila[4])));
		  if($i==1){
		       $color="#c5dbec";
			   $frecuencia=$fila[7];
		     }else{$color="#FFFFFF";}
		    $tbl.="<tr  bgcolor='$color' id='$i' IdFichaHemo='$fila[0]' IdProgramacion='$fila[1]' IdPaciente='$fila[2]'  
			          frecuencia_hemo='$fila[7]' turno_hemo='$fila[8]' fec_hemo='$fila[4]' pacien='$fila[3]'  style='cursor:pointer' 
			             onclick=\"javascript:PintarFila('$i')\" >
						 <td align='center'>$i</td><td align='center'>$fecha</td>
						 <td align='left'>&nbsp;&nbsp;&nbsp;&nbsp; $fila[3]</td><td align='center'>$fila[5]</td></tr>";			 
		   } 
		   
		   if($tbl==""){
			 echo $tbl="<tr><td colspan='4'><b>No Hay Ninguna Hemodialisis pendiente en este Turno</b></td></tr>";  
			   } 
		  echo $can.'///'.$tbl.'///'.$frecuencia;  
		}  
	  if($accion=="LLENAR_PROTOCOLO"){
		  $id_programacion=$_POST[id_programacion];
		  $listar=$ohemodialisis->ListarProtocolo($id_programacion);
		  $array=$listar->fetchAll();
		  echo json_encode($array);
		  }	
	  if($accion=='VER_PROGRA_HEMO'){
		  $id_programacion=$_POST[id_programacion];
		  $veri=$ohemodialisis->VerificarHemodialisis($id_programacion);
		  $can=$veri->rowCount();
		  echo $can;
		  }	  
	  if($accion=="LLENAR_MONITOREO"){
		  $tbl="";
		  $id_hemo=$_POST[id_hemo];
		  $listar=$ohemodialisis->ListarMonitoreo($id_hemo);$i=0;
		  while($fila=$listar->fetch()){
			  $i++;
			  $id='Moni_'.$i;
			 $tbl.="<tr id='$id'><td>$fila[2]</td><td>$fila[3]</td><td>$fila[4]</td><td>$fila[5]</td><td>$fila[6]</td><td>$fila[7]</td>
			        <td>$fila[8]</td><td>$fila[9]</td><td>$fila[10]</td><td>$fila[11]</td><td>$fila[12]</td>
				<td align='center'><a href='#' onclick=\"javascript:EliminarMonitoreo('$fila[0]','$id');\">
	<img src='LIBRERIAS/IMAGENES/btn3.jpg' height='15' width='15' border='0'></a>&nbsp;&nbsp;&nbsp;<a href='#' onclick=\"javascript:ModificarMonitoreo('$fila[0]');\">
				<img src='LIBRERIAS/IMAGENES/inventarios.jpg' height='15' width='15' border='0'></a></td></tr>";
			  
			 }
		  echo $tbl;
		  }	
		  
	   if($accion=='AGREGAR_MONITOREO'){ 
		  $generar_id=$ohemodialisis->GenerarIdMonitoreo();
		  while($fila=$generar_id->fetch()){
			  $id=$fila[0]+1;
			  }
		    $id_programacion=$_POST[id_programacion];
				  
		    $veri=$ohemodialisis->VerificarHemodialisis($id_programacion);	
			while($fila=$veri->fetch()){
				$id_hemodialisis=$fila[0];
				}   
			 //echo $id_hemodialisis.'->'.$id;exit; 
            $hr=$_POST[hr];
            $pa=$_POST[pa];
            $fc=$_POST[fc];
            $qb=$_POST[qb];
            $condc=$_POST[condc];
            $p_a=$_POST[p_a];
            $pv=$_POST[pv];
            $ptm=$_POST[ptm];
            $uf_p=$_POST[uf_p];
            $uf_t=$_POST[uf_t];
            $obs=$_POST[obs];  
			$insertar_moni=$ohemodialisis->InsertarMonitoreo($id,$id_hemodialisis,$hr,$pa,$fc,$qb,$condc,$p_a,$pv,$ptm,$uf_p,$uf_t,$obs);
			//$cantidad=$insertar_moni->rowCount(); 
			echo $id_hemodialisis; 
		  }
	  if($accion=='LLENAR_MONI'){
		  $id_moni=$_POST[id_moni];
		  $listar=$ohemodialisis->ListarMonitoreoXId($id_moni);
		  $array=$listar->fetchAll();
		  echo json_encode($array);
		  }	
	  if($accion=='ACTUALIZAR_MONI'){
		  $id_programacion=$_POST[id_programacion];
		  $veri=$ohemodialisis->VerificarHemodialisis($id_programacion);	
			while($fila=$veri->fetch()){
				$id_hemodialisis=$fila[0];
				} 
		  $id_moni=$_POST[id_moni];
		  $hr=$_POST[hr];
          $pa=$_POST[pa];
          $fc=$_POST[fc];
          $qb=$_POST[qb];
          $condc=$_POST[condc];
          $p_a=$_POST[p_a];
          $pv=$_POST[pv];
          $ptm=$_POST[ptm];
          $uf_p=$_POST[uf_p];
          $uf_t=$_POST[uf_t];
          $obs=$_POST[obs]; 
		  $ohemodialisis->ActualizarMonitoreo($id_moni,$hr,$pa,$fc,$qb,$condc,$p_a,$pv,$ptm,$uf_p,$uf_t,$obs);
		  echo $id_hemodialisis;
		  }	  
	  if($accion=='ALTA'){
		  date_default_timezone_set('America/Lima');	 
		  $id_progra=$_POST[id_progra];
		  $veri=$ohemodialisis->VerificarHemodialisis($id_progra);	
			while($fila=$veri->fetch()){
				$id_hemodialisis=$fila[0];
				}
		     $obs=$_POST[obs];		
			$actualizacion=$ohemodialisis->AltaPaciente($id_hemodialisis,$_SESSION['S_user'],date("Y-m-d"),$obs);	
			$canti=$actualizacion->rowCount();
			 if($canti==1){
				$ohemodialisis->AltaPacienteProgramado($id_progra);  
			  }
		  } 	 	  
	  if($accion=='ELIMINAR_MONITOREO'){
		  $id_monitoreo=$_POST[id_monitoreo];
		  $ohemodialisis->EliminarMonitoreo($id_monitoreo);
		  }	    
	  if($accion=='INSERTAR_PROTOCOLO'){
		  $id_progra=$_POST[id_progra];
		  // echo $id_progra;exit;
		  //$can=0;
		  
		  $verificar=$ohemodialisis->VerificarHemodialisis($id_progra);
		  while($fila=$verificar->fetch()){
			 // $can++;
			  $id_he=$fila[0];
			  }
		  //$can=$verificar->rowCount();
		 // echo $can;exit;
		
          $id_ficha_atencion=$_POST[id_ficha_atencion];
          $id_paciente=$_POST[id_paciente];
          $med_procli=$_POST[med_procli];
          $med_evolucion=$_POST[med_evolucion];
          $med_hras_hd=$_POST[med_hras_hd];
          $med_heparina=$_POST[med_heparina];
          $med_pesoseco=$_POST[med_pesoseco];
          $med_extraccion=$_POST[med_extraccion];
          $med_areafiltro=$_POST[med_areafiltro];
          $med_membrana=$_POST[med_membrana];
          $med_cond_sero=$_POST[med_cond_sero];
          $med_qb=$_POST[med_qb];
          $med_qd=$_POST[med_qd];
          $med_hco3=$_POST[med_hco3];
          $med_temp_maq=$_POST[med_temp_maq];
          $med_conduc=$_POST[med_conduc];
          $med_na_inicial=$_POST[med_na_inicial];
          $med_na_final=$_POST[med_na_final];
          $enf_inicia=$_POST[enf_inicia];
          $cep_inicia=$_POST[cep_inicia];
          $enf_finaliza=$_POST[enf_finaliza];
          $cep_finaliza=$_POST[cep_finaliza];
          $enfe_pa_inicial=$_POST[enfe_pa_inicial];
          $enfe_fc_inicial=$_POST[enfe_fc_inicial];
          $enfe_peso_inicial=$_POST[enfe_peso_inicial];
          $enfe_uf_inicial=$_POST[enfe_uf_inicial];
          $enfe_pa_final=$_POST[enfe_pa_final];
          $enfe_fc_final=$_POST[enfe_fc_final];
          $enfe_peso_final=$_POST[enfe_peso_final];
          $enfe_uf_final=$_POST[enfe_uf_final];
          $enfe_art_fav=$_POST[enfe_art_fav];
          $enfe_art_inj=$_POST[enfe_art_inj];
          $enfe_art_cvc=$_POST[enfe_art_cvc];
          $enfe_art_cvlp=$_POST[enfe_art_cvlp];
          $enfe_ven_fav=$_POST[enfe_ven_fav];
          $enfe_ven_inj=$_POST[enfe_ven_inj];
          $enfe_ven_cvc=$_POST[enfe_ven_cvc];
          $enfe_ven_cvlp=$_POST[enfe_ven_cvlp];
          $enfe_ven_vp=$_POST[enfe_ven_vp];
          $enfe_num_maq=$_POST[enfe_num_maq];
          $enfe_marca_mod=$_POST[enfe_marca_mod];
          $enfe_vol_filtro=$_POST[enfe_vol_filtro];
          $enfe_reuso_filtro=$_POST[enfe_reuso_filtro];
          $enfe_heparina=$_POST[enfe_heparina];
          $enfe_val_inicial=$_POST[enfe_val_inicial];
          $enfe_val_final=$_POST[enfe_val_final];
          $enfe_asp_filtro=$_POST[enfe_asp_filtro];
          
		  //echo $enfe_ven_cvc;exit;
		  //if($can==1){
			  /*$generar_id=$ohemodialisis->IdHemodialisis();
		         while($fila=$generar_id->fetch()){
			      $id=$fila[0];  
			       } */
			  $actualizar_hemo=$ohemodialisis->ActualizarProtocolo($id_he,$med_procli,$med_evolucion,
              $med_hras_hd,$med_heparina,$med_pesoseco,$med_extraccion,$med_areafiltro,
              $med_membrana,$med_cond_sero,$med_qb,$med_qd,$med_hco3,$med_temp_maq,
              $med_conduc,$med_na_inicial,$med_na_final,$enf_inicia,$cep_inicia,$enf_finaliza,
              $cep_finaliza,$enfe_pa_inicial,$enfe_fc_inicial,$enfe_peso_inicial,$enfe_uf_inicial,
              $enfe_pa_final,$enfe_fc_final,$enfe_peso_final,$enfe_uf_final,$enfe_art_fav,
              $enfe_art_inj,$enfe_art_cvc,$enfe_art_cvlp,$enfe_ven_fav,$enfe_ven_inj,$enfe_ven_cvc,
              $enfe_ven_cvlp,$enfe_ven_vp,$enfe_num_maq,$enfe_marca_mod,$enfe_vol_filtro,
              $enfe_reuso_filtro,$enfe_heparina,$enfe_val_inicial,$enfe_val_final,$enfe_asp_filtro);
              
			  $cantidad_hemo=$actualizar_hemo->rowCount(); 
		  // }
		  /*if($can==0){
			  // echo "hola";exit;
			  $generar_id=$ohemodialisis->IdHemodialisis();
		         while($fila=$generar_id->fetch()){
			      $id=$fila[0];  
			       } 
			  // echo 'hola';exit;
			  $insertar_hemo=$ohemodialisis->InsertarProtocolo($id,$id_ficha_atencion,$id_progra,$id_paciente,$med_procli,$med_evolucion,
              $med_hras_hd,$med_heparina,$med_pesoseco,$med_extraccion,$med_areafiltro,
              $med_membrana,$med_cond_sero,$med_qb,$med_qd,$med_hco3,$med_temp_maq,
              $med_conduc,$med_na_inicial,$med_na_final,$enf_inicia,$cep_inicia,$enf_finaliza,
              $cep_finaliza,$enfe_pa_inicial,$enfe_fc_inicial,$enfe_peso_inicial,$enfe_uf_inicial,
              $enfe_pa_final,$enfe_fc_final,$enfe_peso_final,$enfe_uf_final,$enfe_art_fav,
              $enfe_art_inj,$enfe_art_cvc,$enfe_art_cvlp,$enfe_ven_fav,$enfe_ven_inj,$enfe_ven_cvc,
              $enfe_ven_cvlp,$enfe_ven_vp,$enfe_num_maq,$enfe_marca_mod,$enfe_vol_filtro,
              $enfe_reuso_filtro,$enfe_heparina,$enfe_val_inicial,$enfe_val_final,$enfe_asp_filtro);  
			  $cantidad_hemo=$insertar_hemo->rowCount();
			   if($cantidad_hemo==1){
			    $ohemodialisis->ActualizarCorrelativoTabla($id);
			    }
			   }*/
			  echo $cantidad_hemo; 
		 
	  }	 
	  
	    
  }
?> 