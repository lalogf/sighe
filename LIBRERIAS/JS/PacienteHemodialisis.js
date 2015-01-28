// JavaScript Document
$(document).ready(function() {  	

				$('#IdTablaPhI').fixheadertable({ 
							//caption : "", 
							colratio : [50, 100,350,100], 
							height : 140, 
							width :665, 
							zebra : true, 
							sortable : false, 
							sortedColId : 3, 
							dateFormat : 'm/d/Y',
							pager : false,
							rowsPerPage	 : 10,
							resizeCol : true
						});
			   $('#IdTablaMonitoreo').fixheadertable({ 
							//caption : "", 
							colratio : [40,40,40,40,70,40,40,40,40,40,150,60], 
							height : 140, 
							width :680, 
							zebra : true, 
							sortable : false, 
							sortedColId : 3, 
							dateFormat : 'm/d/Y',
							pager : false,
							rowsPerPage	 : 10,
							resizeCol : true
						});			
	 }); 
 
 function CargarPacientesHemo(){
	var $idturno=$("#IdTurnosHemo").val();
	 $("#CuerpoPhI").html("<tr><td colspan='4'>  Cargando ..</td></tr>");
	$.post('CONTROLADOR/Chemodialisis.php',{accion:'LISTAR',idturno:$idturno},function(data){
		var $data=data.split("///");
		//alert(data);
		if($data[0]>0){
		  $("#IdNumFilaHemodialisis").val(1);
		}else{$("#IdNumFilaHemodialisis").val(0);$("#IdProgramacionHemo").val(0);}
		 $("#CuerpoPhI").html($data[1]);
		 $("#IdFrecuencia").val($("#1").attr('frecuencia_hemo'));
		 $("#IdFichaHemodialisis").val($data[2]);
		 $("#IdProgramacionHemo").val($("#1").attr('IdProgramacion'));
		 $("#IdPacHemodialisis").val($("#1").attr('IdPaciente'));
		 var $id_programacion=$("#IdProgramacionHemo").val();
		 LlenarDatosProtocolo($id_programacion);
		  buscaroel($("#IdFichaHemodialisis").val());
		   buscarmedicamentos($id_programacion);
		  // $("#IdFrecuencia").val("");
		})
  
	}
 
 function VentanaHistorialProtocolosAnexado(){
	  
	   if($("#IdNumFilaHemodialisis").val()==0){
		alert("seleccione Paciente ..");return false;
	 }else{
		var $num_fila=$("#IdNumFilaHemodialisis").val(); 
        
		var $paciente=$("#"+$num_fila).attr("pacien"); 		
	 $.post("VerHistorialProtocolos.php",{},function(data){
		 $("#IdNumFilaHPro").val(1);
		 $("#DivVerHistorialProtocolos").html(data);
		 $("#DivVerHistorialProtocolos").show();
		 $("#IdBtnHPro").hide();
		 $("#IdProPaciente").val($("#"+$num_fila).attr("IdPaciente")); 
		 $("#IdPacienteHPro").val($paciente);
		 })
	} 	 
 }	
  	
 function PintarFila($num_fila){
	   $("#IdFrecuencia").val($("#"+$num_fila).attr('frecuencia_hemo'));
	   $("#IdFichaHemodialisis").val($("#"+$num_fila).attr('IdFichaHemo'));
	    $("#IdPacHemodialisis").val($("#"+$num_fila).attr('IdPaciente'));
	   $("#IdTablaPhI tbody tr").css({background:"#FFFFFF"});
	   $("#"+$num_fila).css({background:"#c5dbec", cursor:"pointer"});
	   $("#IdNumFilaHemodialisis").val($num_fila);
	    $("#IdProgramacionHemo").val($("#"+$num_fila).attr('IdProgramacion'));
		 var $id_programacion=$("#IdProgramacionHemo").val();
	   LlenarDatosProtocolo($id_programacion);
	    buscaroel($("#IdFichaHemodialisis").val());
		   buscarmedicamentos($id_programacion);
	 }
	
	 	
	 
 function LlenarDatosProtocolo($id_programacion){
	 //alert($id_programacion);exit;
	$.post('CONTROLADOR/Chemodialisis.php',{accion:'LLENAR_PROTOCOLO',id_programacion:$id_programacion},function(data){
		if(data==""){
		$("input[type='text']").val("");	
		$("#med_cond_sero").val(0);	
		$("textarea").val("");	
		$("#IdCuerpoMonitoreo").html("");
		}
		$.each(data,function(index,columna){
			//alert('hola');
		  var $id_hemo=columna.id;
          $("#med_procli").val(columna.med_procli);
		  $("#med_evolucion").val(columna.med_evolucion);
		  $("#med_hras_hd").val(columna.med_hras_hd);
		  $("#med_heparina").val(columna.med_heparina);
		  $("#med_pesoseco").val(columna.med_pesoseco);
		  $("#med_extraccion").val(columna.med_extraccion);
		  $("#med_areafiltro").val(columna.med_areafiltro);
		  $("#med_membrana").val(columna.med_membrana);
		  $("#med_cond_sero option[value="+columna.med_cond_sero+"]").attr("selected",true);
		  $("#med_qb").val(columna.med_qb);
		  $("#med_qd").val(columna.med_qd);
		  $("#med_hco3").val(columna.med_hco3);
		  $("#med_temp_maq").val(columna.med_temp_maq);
		  $("#med_conduc").val(columna.med_conduc);
		  $("#med_na_inicial").val(columna.med_na_inicial);
		  $("#med_na_final").val(columna.med_na_final);
		  
		  $("#enf_inicia").val(columna.enf_inicia);
		  $("#cep_inicia").val(columna.cep_inicia);
		  $("#enf_finaliza").val(columna.enf_finaliza);
		  $("#cep_finaliza").val(columna.cep_finaliza);
		  $("#enfe_pa_inicial").val(columna.enfe_pa_inicial);
		  $("#enfe_pa_final").val(columna.enfe_pa_final);
		  
		  $("#enfe_fc_inicial").val(columna.enfe_fc_inicial);
		  $("#enfe_fc_final").val(columna.enfe_fc_final);
		  
		  $("#enfe_peso_inicial").val(columna.enfe_peso_inicial);
		  $("#enfe_peso_final").val(columna.enfe_peso_final);
		  
		  $("#enfe_uf_inicial").val(columna.enfe_uf_inicial);
		  $("#enfe_uf_final").val(columna.enfe_uf_final);
		    
		  $("#enfe_art_fav").val(columna.enfe_art_fav);
		  $("#enfe_art_inj").val(columna.enfe_art_inj);
		  $("#enfe_art_cvc").val(columna.enfe_art_cvc);
		  $("#enfe_art_cvlp").val(columna.enfe_art_cvlp);
		  
		  $("#enfe_ven_fav").val(columna.enfe_ven_fav);
		  $("#enfe_ven_inj").val(columna.enfe_ven_inj);
		  $("#enfe_ven_cvc").val(columna.enfe_ven_cvc);
		  $("#enfe_ven_cvlp").val(columna.enfe_ven_cvlp);
		  $("#enfe_ven_vp").val(columna.enfe_ven_vp);
		  
		  $("#enfe_num_maq").val(columna.enfe_num_maq);
		  $("#enfe_marca_mod").val(columna.enfe_marca_mod);
		  $("#enfe_reuso_filtro").val(columna.enfe_reuso_filtro);
		  $("#enfe_heparina").val(columna.enfe_heparina);
		  $("#enfe_vol_filtro").val(columna.enfe_vol_filtro);
		  $("#enfe_val_inicial").val(columna.enfe_val_inicial);
		  
		  $("#enfe_val_final").val(columna.enfe_val_final);
		  $("#enfe_asp_filtro").val(columna.enfe_asp_filtro);
		  ListarMonitoreo($id_hemo);	  
		  })
	 },'JSON')
   }	 
	
  function ListarMonitoreo($id_hemo){
	   $.post('CONTROLADOR/Chemodialisis.php',{accion:'LLENAR_MONITOREO',id_hemo:$id_hemo},function(datos){
			   $("#IdCuerpoMonitoreo").html(datos);
			  })
	  }	
  function EliminarMonitoreo($id_monitoreo,$idfila){  
	 $.post('CONTROLADOR/Chemodialisis.php',{accion:'ELIMINAR_MONITOREO',id_monitoreo:$id_monitoreo},function(data){
		 $("#"+$idfila).remove();
	   }) 
	}	

 function InsertarProtocolo(){
	// alert("ok");
	if($("#IdNumFilaHemodialisis").val()==0){
		alert("seleccione Paciente ..");return false;
		} else{
	var $id_progra=$("#IdProgramacionHemo").val();
	var $id_ficha_atencion=$("#IdFichaHemodialisis").val();
	var $id_paciente=$("#IdPacHemodialisis").val();
	
	var $med_procli=$("#med_procli").val();
    var $med_evolucion=$("#med_evolucion").val();
    var $med_hras_hd=$("#med_hras_hd").val();
    var $med_heparina=$("#med_heparina").val();
    var $med_pesoseco=$("#med_pesoseco").val();
    var $med_extraccion=$("#med_extraccion").val();
    var $med_areafiltro=$("#med_areafiltro").val();
    var $med_membrana=$("#med_membrana").val();
    var $med_cond_sero=$("#med_cond_sero").val();
    var $med_qb=$("#med_qb").val();
    var $med_qd=$("#med_qd").val();
    var $med_hco3=$("#med_hco3").val();
    var $med_temp_maq=$("#med_temp_maq").val();
    var $med_conduc=$("#med_conduc").val();
    var $med_na_inicial=$("#med_na_inicial").val();
    var $med_na_final=$("#med_na_final").val();
    var $enf_inicia=$("#enf_inicia").val();
    var $cep_inicia=$("#cep_inicia").val();
    var $enf_finaliza=$("#enf_finaliza").val();
    var $cep_finaliza=$("#cep_finaliza").val();
    var $enfe_pa_inicial=$("#enfe_pa_inicial").val();
    var $enfe_fc_inicial=$("#enfe_fc_inicial").val();
    var $enfe_peso_inicial=$("#enfe_peso_inicial").val();
    var $enfe_uf_inicial=$("#enfe_uf_inicial").val();
    var $enfe_pa_final=$("#enfe_pa_final").val();
    var $enfe_fc_final=$("#enfe_fc_final").val();
    var $enfe_peso_final=$("#enfe_peso_final").val();
    var $enfe_uf_final=$("#enfe_uf_final").val();
    var $enfe_art_fav=$("#enfe_art_fav").val();
    var $enfe_art_inj=$("#enfe_art_inj").val();
    var $enfe_art_cvc=$("#enfe_art_cvc").val();
    var $enfe_art_cvlp=$("#enfe_art_cvlp").val();
    var $enfe_ven_fav=$("#enfe_ven_fav").val();
    var $enfe_ven_inj=$("#enfe_ven_inj").val();
    var $enfe_ven_cvc=$("#enfe_ven_cvc").val();
    var $enfe_ven_cvlp=$("#enfe_ven_cvlp").val();
    var $enfe_ven_vp=$("#enfe_ven_vp").val();
    var $enfe_num_maq=$("#enfe_num_maq").val();
    var $enfe_marca_mod=$("#enfe_marca_mod").val();
    var $enfe_vol_filtro=$("#enfe_vol_filtro").val();
    var $enfe_reuso_filtro=$("#enfe_reuso_filtro").val();
    var $enfe_heparina=$("#enfe_heparina").val();
    var $enfe_val_inicial=$("#enfe_val_inicial").val();
    var $enfe_val_final=$("#enfe_val_final").val();
    var $enfe_asp_filtro=$("#enfe_asp_filtro").val();
	
	
	$.post('CONTROLADOR/Chemodialisis.php',{accion:'INSERTAR_PROTOCOLO',id_progra:$id_progra,id_ficha_atencion:$id_ficha_atencion,id_paciente:$id_paciente,med_procli:$med_procli,med_evolucion:$med_evolucion,med_hras_hd:$med_hras_hd,med_heparina:$med_heparina,med_pesoseco:$med_pesoseco,med_extraccion:$med_extraccion,med_areafiltro:$med_areafiltro,med_membrana:$med_membrana,med_cond_sero:$med_cond_sero,med_qb:$med_qb,med_qd:$med_qd,med_hco3:$med_hco3,med_temp_maq:$med_temp_maq,med_conduc:$med_conduc,med_na_inicial:$med_na_inicial,med_na_final:$med_na_final,enf_inicia:$enf_inicia,cep_inicia:$cep_inicia,enf_finaliza:$enf_finaliza,cep_finaliza:$cep_finaliza,enfe_pa_inicial:$enfe_pa_inicial,enfe_fc_inicial:$enfe_fc_inicial,enfe_peso_inicial:$enfe_peso_inicial,enfe_uf_inicial:$enfe_uf_inicial,enfe_pa_final:$enfe_pa_final,enfe_fc_final:$enfe_fc_final,enfe_peso_final:$enfe_peso_final,enfe_uf_final:$enfe_uf_final,enfe_art_fav:$enfe_art_fav,enfe_art_inj:$enfe_art_inj,enfe_art_cvc:$enfe_art_cvc,enfe_art_cvlp:$enfe_art_cvlp,enfe_ven_fav:$enfe_ven_fav,enfe_ven_inj:$enfe_ven_inj,enfe_ven_cv:$enfe_ven_cvc,enfe_ven_cvlp:$enfe_ven_cvlp,enfe_ven_vp:$enfe_ven_vp,enfe_num_maq:$enfe_num_maq,enfe_marca_mod:$enfe_marca_mod,enfe_vol_filtro:$enfe_vol_filtro,enfe_reuso_filtro:$enfe_reuso_filtro,enfe_heparina:$enfe_heparina,enfe_val_inicial:$enfe_val_inicial,enfe_val_final:$enfe_val_final,enfe_asp_filtro:$enfe_asp_filtro},function(data){
		//alert(data);exit;
		if(data==0){
			alert("No Actualizaron datos ..");return false;
		  }else{
			alert("Datos Actualizados correctamente ..");return false;  
			 } 
	 }) 
   }
 }
  
 function ActualizarAlta(){
	  
	  if(confirm("Esta seguro de Dar de Alta al Paciente ???")){
			  var $id_progra=$("#IdProgramacionHemo").val();
			  var $obs=$("#IdObs").val();
		       $.post('CONTROLADOR/Chemodialisis.php',{accion:'ALTA',id_progra:$id_progra,obs:$obs},function(datos){
			   $("#IdDivAlta").hide(1000);	
			   CargarPacientesHemo();
			   })   
			 }else{
				return false; 
				 }
	 }
	 	
 function Alta(){
	if($("#IdNumFilaHemodialisis").val()==0){
		alert("seleccione Paciente ..");return false;
	 }else{
		$("#IdDivAlta").show(1000);	
		} 	
	}
 function VerHF(){
    if($("#IdNumFilaHemodialisis").val()==0){
		alert("seleccione Paciente ..");return false;
		} else{
	 var $idficha=$("#IdFichaHemodialisis").val();
	 //alert($idficha);
  window.open('PdfFichaAtencion.php?id='+$idficha,"VerFicha", "top=150,left=200,menubar=no,location=no,status=no,resizable=no,scrollbars=no,width=600,height=400,toolbar=no"); 
 }
 
   }	 
 /*function NuevoRegistrarPaciente(){
   $("#IdCodigo").attr("disabled",false);
   $("#IdTurno").attr("disabled",false);
   $("#IdUsuNuevo").attr("disabled",true);
   $("#IdUsuGrabar").attr("disabled",false);
   $("#IdUsuCancelar").attr("disabled",false);
   $("#IdUsuBuscar").attr("disabled",true);	
   $("#IdUsuEliminar").attr("disabled",true);	
 }
 function GrabarRegistrarPaciente(){
	 
   }
 function CancelarRegistrarPaciente(){
   $("#IdCodigo").attr("disabled",true);
   $("#IdTurno").attr("disabled",true);	 
   $("#IdUsuNuevo").attr("disabled",false);
   $("#IdUsuGrabar").attr("disabled",true);
   $("#IdUsuCancelar").attr("disabled",true);
   $("#IdUsuBuscar").attr("disabled",false);	
   $("#IdUsuEliminar").attr("disabled",true); 
   }
 function BuscarRegistrarPaciente(){
	$("#DivBuscarRegistrarPacientes").show("slow"); 
   }
 function EliminarRegistrarPaciente(){
	 
   }*/
 
 function NuevoMonitoreo(){
	  $("#IdAgregarMo").show();
	 $("#IdActualizarMo").hide();
	 var $id_programacion=$("#IdProgramacionHemo").val();
	  //$("input[type='text']").val("");
	 //alert($id_programacion);
	 if($("#IdNumFilaHemodialisis").val()==0){
		alert("seleccione Paciente ..");return false;
		} else{
	 $("#hr,#pa,#fc,#qb,#condc,#p_a,#pv,#ptm,#uf_p,#uf_t,#obs").val("");
	$.post('CONTROLADOR/Chemodialisis.php',{accion:'VER_PROGRA_HEMO',id_programacion:$id_programacion},function(data){
		if(data==0){
			alert("Seleccione Paciente ..");return false;
			}
		if(data==1){
			$("#IdNuevoMoni").show(1000);   
			}	
		
	  })
	}
  }
 
 function AgregarMonitoreo(){
	
	 var $id_programacion=$("#IdProgramacionHemo").val();
	 //alert($id_programacion);
	      var  $hr=$("#hr").val();
          var  $pa=$("#pa").val();
          var  $fc=$("#fc").val();
          var  $qb=$("#qb").val();
          var  $condc=$("#condc").val();
          var  $p_a=$("#p_a").val();
          var  $pv=$("#pv").val();
          var  $ptm=$("#ptm").val();
          var  $uf_p=$("#uf_p").val();
          var  $uf_t=$("#uf_t").val();
          var  $obs=$("#obs").val();
	 $.post('CONTROLADOR/Chemodialisis.php',{accion:'AGREGAR_MONITOREO',id_programacion:$id_programacion,hr:$hr,pa:$pa,fc:$fc,qb:$qb,condc:$condc,p_a:$p_a,pv:$pv,ptm:$ptm,uf_p:$uf_p,uf_t:$uf_t,obs:$obs},function(data){
		 //var $id_hemo=data;
		 ListarMonitoreo(data);
		 $("#IdNuevoMoni").hide(1000);   
		 })	 
  }
  
   function ModificarMonitoreo($id_moni){
	  $("#IdAgregarMo").hide();
	  $("#IdActualizarMo").show(); 
	  $("#IdNuevoMoni").show(1000); 
	  $("#IdMoni").val($id_moni);
	 $.post('CONTROLADOR/Chemodialisis.php',{accion:'LLENAR_MONI',id_moni:$id_moni},function(data){
          // alert(data); 
		  $.each(data,function(index,columna){
			   $("#hr").val(columna.hr);
               $("#pa").val(columna.pa);
               $("#fc").val(columna.fc);
               $("#qb").val(columna.qb);
               $("#condc").val(columna.condc);
               $("#p_a").val(columna.p_a);
               $("#pv").val(columna.pv);
               $("#ptm").val(columna.ptm);
               $("#uf_p").val(columna.uf_p);
               $("#uf_t").val(columna.uf_t);
               $("#obs").val(columna.obs);  
			})
			   
	   },'json') 
	 }	
  
  function ActualizarMonitoreo(){
	      var  $id_programacion=$("#IdProgramacionHemo").val();
	      var  $id_moni=$("#IdMoni").val();
		  var  $hr=$("#hr").val();
          var  $pa=$("#pa").val();
          var  $fc=$("#fc").val();
          var  $qb=$("#qb").val();
          var  $condc=$("#condc").val();
          var  $p_a=$("#p_a").val();
          var  $pv=$("#pv").val();
          var  $ptm=$("#ptm").val();
          var  $uf_p=$("#uf_p").val();
          var  $uf_t=$("#uf_t").val();
          var  $obs=$("#obs").val();
	 $.post('CONTROLADOR/Chemodialisis.php',{accion:'ACTUALIZAR_MONI',id_programacion:$id_programacion,id_moni:$id_moni,hr:$hr,pa:$pa,fc:$fc,qb:$qb,condc:$condc,p_a:$p_a,pv:$pv,ptm:$ptm,uf_p:$uf_p,uf_t:$uf_t,obs:$obs},function(data){
		 var $id_hemo=data;
		 ListarMonitoreo($id_hemo);
		 $("#IdNuevoMoni").hide(1000); 	   
	   }) 
	 }  
	 
 function CerrarPH(){
   $("#DivPacienteHemodialisis").hide("slow");	
 } 
  function CancelarBuscarRegistrarPaciente(){
   $("#DivBuscarRegistrarPacientes").hide("slow");	
 }         
 
 function VerProtocolo(){
	 if($("#IdNumFilaHemodialisis").val()==0){
		alert("seleccione Paciente ..");return false;
		} else{
			//alert();exit;
	 var $fila=	$("#IdNumFilaHemodialisis").val();	
	 var $idprogramacion=$("#"+$fila).attr("IdProgramacion");
  window.open('PdfProtocoloHemodialisis.php?id='+$idprogramacion,"VerProtocolo", "top=150,left=200,menubar=no,location=no,status=no,resizable=no,scrollbars=no,width=600,height=400,toolbar=no"); 
 }
	 }