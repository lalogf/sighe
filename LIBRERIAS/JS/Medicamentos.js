// JavaScript Document
$(document).ready(function() {  	

				$('#IdTablaMedicamento').fixheadertable({ 
							//caption : "", 
							colratio : [40, 140, 140, 60,60], 
							height : 200, 
							width :450, 
							zebra : true, 
							sortable : false, 
							sortedColId : 3, 
							dateFormat : 'm/d/Y',
							pager : false,
							rowsPerPage	 : 10,
							resizeCol : true
						});
			   }); 
	
 function LimpiarMedicamento(){
   $("input").val("");	
   $("#IdEstadoTrabajador option[value='1']").attr("selected",true);
 }				   
			   
 function NuevoMedicamento(){
   $("input").attr("disabled",false);
   $("select").attr("disabled",false);
   $("input,select").css({"background-color":"#FFFFFF"});
   $("#IdMedNuevo").attr("disabled",true);
   $("#IdMedGrabar").attr("disabled",false);
   $("#IdMedCancelar").attr("disabled",false);
   $("#IdMedBuscar").attr("disabled",true);	
   $("#IdMedEliminar").attr("disabled",true);
   $("#IdMedNuevo").removeClass("btnNuevo").addClass("btnDeshabilitarNuevo");
   $("#IdMedGrabar").removeClass("btnDeshabilitarGrabar").addClass("btnGrabar");
   $("#IdMedCancelar").removeClass("btnDeshabilitarCancelar").addClass("btnCancelar");
   $("#IdMedBuscar").removeClass("btnBuscar").addClass("btnDeshabilitarBuscar");
   $("#IdMedEliminar").removeClass("btnEliminar").addClass("btnDeshabilitarEliminar");
   $("#IdOpcionMedicamento").val(1);
   $.post('CONTROLADOR/Cmedicamento.php',{accion:'GENERARID'},function(data){
		$("#IdUnicoMedicamento").val(data);
	})
 }
 
 function CancelarMedicamento(){
    $("input").val("");	 
   $("input").attr("disabled",true);
   $("select").attr("disabled",true);
   $("input,select").css({"background-color":"#E6FFF2"});	
   $("#IdMedNuevo").attr("disabled",false);
   $("#IdMedGrabar").attr("disabled",true);
   $("#IdMedCancelar").attr("disabled",true);
   $("#IdMedBuscar").attr("disabled",false);	
   $("#IdMedEliminar").attr("disabled",true); 
   $("#IdMedNuevo").removeClass("btnDeshabilitarNuevo").addClass("btnNuevo");
   $("#IdMedGrabar").removeClass("btnGrabar").addClass("btnDeshabilitarGrabar");
   $("#IdMedCancelar").removeClass("btnCancelar").addClass("btnDeshabilitarCancelar");
   $("#IdMedBuscar").removeClass("btnDeshabilitarBuscar").addClass("btnBuscar");
   $("#IdMedEliminar").removeClass("btnEliminar").addClass("btnDeshabilitarEliminar");
   LimpiarMedicamento();
   }
   
   function BuscarMedicamento(){
	$("#DivBuscarMedicamentos").show(); 
	$("#IdBusquedaMedicamento").attr("disabled",false);
	$("#IdBusquedaMedicamento").css({"background-color":"#FFFFFF"});	
	$("#IdBusquedaMedicamento").val("");
	$("#IdBusquedaMedicamento").focus(); 
	$("#CuerpoMedicamento").html("");
   }
   
    function RealizaBusquedaMedicamento(){
	var $medicamento=$("#IdBusquedaMedicamento").val(); 
 $("#CuerpoMedicamento").html("<tr><td colspan='5'><img src='LIBRERIAS/IMAGENES/cargando.gif' /> Cargando ..</td></tr>");
	$.post('CONTROLADOR/Cmedicamento.php',{accion:'LISTAR',medicamento:$medicamento},function(data){//alert(data);exit;
		 var $data=data.split("///");
		 if($data[0]==0){
			 $("#CuerpoMedicamento").html("<tr><td colspan='5'>No hay resultados ..</td></tr>");exit;
			 }
		 $("#CanBusMedicamento").val($data[0]);
		 $("#CuerpoMedicamento").html($data[1]);
		 $("#IdNumFilaMedicamento").val(1)
		 })
	exit;	 
  }
  
  $(document).keydown(function(e){
           if (e.keyCode==40) {
			      var $num_fila=parseInt($("#IdNumFilaMedicamento").val());
				  var $tr=$num_fila+1;
				  $can=parseInt($("#CanBusMedicamento").val());
				  if($num_fila<$can){
					$("#"+$num_fila).css({background:"#FFFFFF"});  
			        $("#"+$tr).css({background:"#c5dbec"});
				    $("#IdNumFilaMedicamento").val($tr);
			       }
			}
			if (e.keyCode==38) {
			      var $num_fila=parseInt($("#IdNumFilaMedicamento").val());
				  var $tr=$num_fila-1;
				  if($num_fila>1){
					$("#"+$num_fila).css({background:"#FFFFFF"});  
			        $("#"+$tr).css({background:"#c5dbec"});
				    $("#IdNumFilaMedicamento").val($tr);
			       }
			}
   })
  
  $("#IdBusquedaMedicamento").keypress(function(e){
	  if(e.keyCode==13){
		  $("#IdBusquedaMedicamento").blur();
		  RealizaBusquedaMedicamento();
		  
		  }   
	  })
  function PintarFila($num_fila){
	   $("table tbody tr").css({background:"#FFFFFF"});
	   $("#"+$num_fila).css({background:"#E6FFF2", cursor:"pointer"});
	   $("#IdNumFilaMedicamento").val($num_fila);
	 }
  
 
  function SeleccionarMedicamento(){
		  $("#IdOpcionMedicamento").val(2);
		 var $fila=$("#IdNumFilaMedicamento").val();
		 var $idmedicamento=$("#"+$fila).attr("idmedicamento");//alert($idgrupo);exit;
		 $("#DivBuscarMedicamentos").hide("slow");
		 $("input").attr("disabled",false);	
         $("select").attr("disabled",false);
		 $("input").css({"background-color":"#FFFFFF"});
         $("select").css({"background-color":"#FFFFFF"});
		 $.post('CONTROLADOR/Cmedicamento.php',{accion:'LLENAR_FORM',idmedicamento:$idmedicamento},function(data){
			 var datos=eval(data);
			 $.each(datos,function(index,columna){
				  $("#IdUnicoMedicamento").val(columna.id);
				  $("#IdCodigoMedicamento").val(columna.codigo);
				  $("#IdMedicamento").val(columna.medicamento);
				  $("#IdPresentacionMedicamento").val(columna.presentacion);
				  $("#IdUnidadMedicamento").val(columna.unidad);
				  $("#IdEstadoMedicamento option[value="+columna.estado+"]").attr("selected",true);
			   });
		  })
		  
		  $("#IdMedNuevo").attr("disabled",true);
          $("#IdMedGrabar").attr("disabled",false);
          $("#IdMedCancelar").attr("disabled",false);
          $("#IdMedBuscar").attr("disabled",true);	
          $("#IdMedEliminar").attr("disabled",false);
		  $("#IdMedNuevo").removeClass("btnNuevo").addClass("btnDeshabilitarNuevo");
          $("#IdMedGrabar").removeClass("btnDeshabilitarGrabar").addClass("btnGrabar");
          $("#IdMedCancelar").removeClass("btnDeshabilitarCancelar").addClass("btnCancelar");
          $("#IdMedBuscar").removeClass("btnBuscar").addClass("btnDeshabilitarBuscar");
          $("#IdMedEliminar").removeClass("btnDeshabilitarEliminar").addClass("btnEliminar");
	  }   
  
   function EliminarMedicamento(){
	 $("#IdTituloMedicamento").text(""); 
   var $id=$("#IdUnicoMedicamento").val();
   $.post('CONTROLADOR/Cmedicamento.php',{accion:'ELIMINAR',id:$id},function(data){
		if(data==1){
		 $("#IdTituloMedicamento").text("Datos Eliminados Correctamente ..");
		 $("#MensajeMedicamento").fadeIn();
		 CancelarMedicamento();
		}else{
		$("#IdTituloMedicamento").text("No se pudo Eliminar Correctamente ..");
		 $("#MensajeMedicamento").fadeIn();	
			}
		
	 })
   LimpiarMedicamento();
   }
   
  function GrabarMedicamento(){
	 $("#IdTituloMedicamento").text("");
	var $id=$("#IdUnicoMedicamento").val(); 
    var $codigo=$("#IdCodigoMedicamento").val(); 
	var $medicamento=$("#IdMedicamento").val();
	var $presentacion=$("#IdPresentacionMedicamento").val();
	var $unidad=$("#IdUnidadMedicamento").val();
	var $estado=$("#IdEstadoMedicamento").val();
	var $opcion=$("#IdOpcionMedicamento").val();
	var $fec_crea=$("#IdMedFecCrea").text();
	var $user_crea=$("#IdMedUserCrea").text();
	
	//alert($codigo+' '+$grupo+' '+$estado+' '+$opcion);exit;
	 if($codigo==""){
		 $("#IdTituloMedicamento").text("Ingrese Codigo Medicamento ..");
		 $("#MensajeMedicamento").fadeIn();$("#IdCodigoMedicamento").focus(); exit;
		 }
	 if($medicamento==""){
		 $("#IdTituloMedicamento").text("Ingrese Medicamento ..");
		 $("#MensajeMedicamento").fadeIn();$("#IdMedicamento").focus(); exit;
		 }
	 if($presentacion==""){
		 $("#IdTituloMedicamento").text("Seleccione Presentacion ..");
		 $("#MensajeMedicamento").fadeIn();$("#IdPresentacionMedicamento").focus(); exit;
		 }	 
	 if($unidad==""){
		 $("#IdTituloMedicamento").text("Ingrese Unidad ..");
		 $("#MensajeMedicamento").fadeIn();$("#IdUnidadMedicamento").focus(); exit;
		 } 	 	 	 
	$.post('CONTROLADOR/Cmedicamento.php',{accion:'GRABAR',id:$id,codigo:$codigo,medicamento:$medicamento,presentacion:$presentacion,unidad:$unidad,estado:$estado,opcion:$opcion,fec_crea:$fec_crea,user_crea:$user_crea},function(data){    
		if(data==1){
			if($opcion==1){
		      $("#IdTituloMedicamento").text("Datos Insertados Correctamente ..");
			  $("#MensajeMedicamento").show("slow");
			  CancelarMedicamento();
			  }
			if($opcion==2){
		      $("#IdTituloMedicamento").text("Datos Modificados Correctamente ..");
			  $("#MensajeMedicamento").show("slow");
			  CancelarMedicamento();
			  }  
		      LimpiarMedicamento(); 
		      $("input").attr("disabled",true);	 
              $("select").attr("disabled",true);
			
		}else{
		 if($opcion==1){
		      $("#IdTituloMedicamento").text("No se pudo Insertar Correctamente ..");
			  }
		 if($opcion==2){
		      $("#IdTituloMedicamento").text("No se pudo Modificar Correctamente ..");
			  }	
		      $("#MensajeMedicamento").fadeIn();	
		 
			}
		
	   })
   }
 
 
 function SalirMedicamento(){
   $("#DivMedicamento").hide("slow");	
 } 
 
 function CancelarBuscarMedicamento(){
   $("#DivBuscarMedicamentos").hide("slow");	
	 } 