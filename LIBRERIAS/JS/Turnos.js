// JavaScript Document
 $(document).ready(function() {  	

				$('#IdTablaTurno').fixheadertable({ 
							//caption : "", 
							colratio : [70, 250], 
							height : 180, 
							width :350, 
							zebra : true, 
							sortable : false, 
							sortedColId : 3, 
							dateFormat : 'm/d/Y',
							pager : false,
							rowsPerPage	 : 10,
							resizeCol : true
						});
			   });
			   
  	   
 function NuevoTurno(){
   $("select").css({"background-color":"#FFFFFF"});
   $("#IdTurEstado").attr("disabled",false);	 
   $("#IdCodigo").attr("disabled",false);
   $("#IdTurno").attr("disabled",false);
   $("#IdTurNuevo").attr("disabled",true);
   $("#IdTurGrabar").attr("disabled",false);
   $("#IdTurCancelar").attr("disabled",false);
   $("#IdTurBuscar").attr("disabled",true);	
   $("#IdTurEliminar").attr("disabled",true);	
   $("#IdCodigo").css({"background-color":"#FFF"});
   $("#IdTurno").css({"background-color":"#FFF"});
   $("#IdTurNuevo").removeClass("btnNuevo").addClass("btnDeshabilitarNuevo");
   $("#IdTurGrabar").removeClass("btnDeshabilitarGrabar").addClass("btnGrabar");
   $("#IdTurCancelar").removeClass("btnDeshabilitarCancelar").addClass("btnCancelar");
   $("#IdTurBuscar").removeClass("btnBuscar").addClass("btnDeshabilitarBuscar");
   $("#IdOpcion").val(1);
   $.post('CONTROLADOR/Cturno.php',{accion:'GENERARID'},function(data){
		$("#IdCodigo").val(data);
		})
   LimpiarTurno();
 }
 function GrabarTurno(){
	 $("#IdTitulo").text("");
    var $codigo=$("#IdCodigo").val(); 
	var $turno=$("#IdTurno").val();
	var $estado=$("#IdTurEstado").val();
	var $opcion=$("#IdOpcion").val();
	var $fec_crea=$("#IdTurFecCrea").text();
	var $user_crea=$("#IdTurUserCrea").text();
	 if($turno==""){
		 $("#IdTitulo").text("Ingrese Turno ..");
		 $("#MensajeTurno").fadeIn();$("#IdTurno").focus(); exit;
		 }
	$.post('CONTROLADOR/Cturno.php',{accion:'GRABAR',codigo:$codigo,turno:$turno,estado:$estado,opcion:$opcion,fec_crea:$fec_crea,user_crea:$user_crea},function(data){//alert(data);exit;
		if(data==1){
			if($opcion==1){
		      $("#IdTitulo").text("Datos Insertados Correctamente ..");
			  }
			if($opcion==2){
		      $("#IdTitulo").text("Datos Modificados Correctamente ..");
			  }  
		      $("#MensajeTurno").fadeIn();
		      LimpiarTurno(); 
		      $("#IdTurEstado").attr("disabled",true);	 
              $("#IdCodigo").attr("disabled",true);
		      CancelarTurno();
			
		}else{
		 if($opcion==1){
		      $("#IdTitulo").text("No se pudo Insertar Correctamente ..");
			  }
		 if($opcion==2){
		      $("#IdTitulo").text("No se pudo Modificar Correctamente ..");
			  }	
		      $("#MensajeTurno").fadeIn();	
		 
			}
		
	 })
   
   
   }
 function CancelarTurno(){
   $("input[type='text']").css({"background-color":"#E6FFF2"});
   $("select").css({"background-color":"#E6FFF2"});
   $("#IdTurEstado").attr("disabled",true);	 	 
   $("#IdCodigo").attr("disabled",true);
   $("#IdTurno").attr("disabled",true);	 
   $("#IdTurNuevo").attr("disabled",false);
   $("#IdTurGrabar").attr("disabled",true);
   $("#IdTurCancelar").attr("disabled",true);
   $("#IdTurBuscar").attr("disabled",false);	
   $("#IdTurEliminar").attr("disabled",true);
   $("#IdTurNuevo").removeClass("btnDeshabilitarNuevo").addClass("btnNuevo");
   $("#IdTurGrabar").removeClass("btnGrabar").addClass("btnDeshabilitarGrabar");
   $("#IdTurCancelar").removeClass("btnCancelar").addClass("btnDeshabilitarCancelar");
   $("#IdTurBuscar").removeClass("btnDeshabilitarBuscar").addClass("btnBuscar");
   $("#IdTurEliminar").removeClass("btnEliminar").addClass("btnDeshabilitarEliminar");
   LimpiarTurno();
   }
 function BuscarTurno(){		   
	$("#DivBuscarTurnos").show(); 
	$("#IdBusquedaTur").val("");
	$("#IdBusquedaTur").focus(); 
	$("#IdCuerpoBusTur").html("");
   }
   
 function EliminarTurno(){
	$("#IdTitulo").text(""); 
   var $id=$("#IdCodigo").val();
   $.post('CONTROLADOR/Cturno.php',{accion:'ELIMINAR',id:$id},function(data){
		if(data==1){
		 $("#IdTitulo").text("Datos Eliminados Correctamente ..");
		 $("#MensajeTurno").fadeIn();
		 CancelarTurno();
		}else{
		$("#IdTitulo").text("No se pudo Eliminar Correctamente ..");
		 $("#MensajeTurno").fadeIn();	
			}
		
	 })
   LimpiarTurno();
   }
 function SalirTurno(){
	//delete $verificar; 
   //$("#DivTurno").html("");lo comentado para que funcioneel efecto de desaparecer igual que los demas		 		 	
   $("#DivTurno").hide("slow");	    
   LimpiarTurno();
 } 
  function CancelarBuscarTurno(){
	//delete $verificar;   
   $("#DivBuscarTurnos").hide();
   LimpiarTurno();	
 }         
 function LimpiarTurno(){
   $("#IdCodigo").val("");	
   $("#IdTurno").val("");
   $("#IdTurEstado option[value='1']").attr("selected",true);
 }  
 
 function RealizaBusqueda(){
	var $turno=$("#IdBusquedaTur").val(); 
	$("#IdCuerpoBusTur").html("<tr><td colspan='2'><img src='LIBRERIAS/IMAGENES/cargando.gif' /> Cargando ..</td></tr>");
	$.post('CONTROLADOR/Cturno.php',{accion:'LISTAR',turno:$turno},function(data){//alert(data);exit;
		 var $data=data.split("///");
		 if($data[0]==0){
			 $("#IdCuerpoBusTur").html("<tr><td colspan='2'>No hay resultados ..</td></tr>");exit;
			 }
		 $("#CanBusTur").val($data[0]);
		 $("#IdCuerpoBusTur").html($data[1]);
		 $("#IdNumFilaTur").val(1)
		 })
	exit;	 
  }
  
  
 // var $contador=0;	
	   
  
	 
	 /*$("#IdBusquedaTur").focusin(function(e) {
	    $("#IdCuerpoBusTur").html("");
		$verificar=0;
      });
	 
	  $i=0;
	$(document).keypress(function(e){
		
		$i=$i+1;
		alert($i);
		//alert($verificar);
	  if($i==1){
		if($verificar>0){
		  if(e.keyCode==13){
			 alert("hola");
		  // RealizaBusqueda();exit;
		   }
	     }
		 if($verificar==0){
			 $verificar=$("#IdTablaTurno tbody tr").length;   
		  }
	   }	  
	  });  */
/*   $(document).keydown(function(e){
           if (e.keyCode==40) {
			      var $num_fila=parseInt($("#IdNumFilaTur").val());
				  var $tr=$num_fila+1;
				  $can=parseInt($("#CanBusTur").val());
				  if($num_fila<$can){
					$("#"+$num_fila).css({background:"#FFFFFF"});  
			        $("#"+$tr).css({background:"#c5dbec"});
				    $("#IdNumFilaTur").val($tr);
			       }
			}
			if (e.keyCode==38) {
			      var $num_fila=parseInt($("#IdNumFilaTur").val());
				  var $tr=$num_fila-1;
				  if($num_fila>1){
					$("#"+$num_fila).css({background:"#FFFFFF"});  
			        $("#"+$tr).css({background:"#c5dbec"});
				    $("#IdNumFilaTur").val($tr);
			       }
			}exit;
   })*/
   
   $("#IdBusquedaTur").keypress(function(e){
	  if(e.keyCode==13){
		  
		  $("#IdBusquedaTur").blur();
		  RealizaBusqueda();
		  
		  }   
	  })
  // var $verificar=0;	
	//alert($verificar);		  
	
	function PintarFila($num_fila){
	   $("table tbody tr").css({background:"#FFFFFF"});
	   $("#"+$num_fila).css({background:"#E9FFE9", cursor:"pointer"});
	   $("#IdNumFilaTur").val($num_fila);
	 }
	 
	 
	 function SeleccionarBusqueda(){
		  $("#IdOpcion").val(2);
		 var $fila=$("#IdNumFilaTur").val();
		 var $idturno=$("#"+$fila).attr("idturno");//alert($idturno);exit;
		 $("#DivBuscarTurnos").hide("slow");
		 $("#IdCodigo").attr("disabled",false);	
         $("#IdTurno").attr("disabled",false);	
         $("#IdTurEstado").attr("disabled",false);
		 $("#IdCodigo").css({"background-color":"#FFFFFF"});
         $("#IdTurno").css({"background-color":"#FFFFFF"});
         $("#IdTurEstado").css({"background-color":"#FFFFFF"});
		 $.post('CONTROLADOR/Cturno.php',{accion:'LLENAR_FORM',idturno:$idturno},function(data){
			 var datos=eval(data);
			 $.each(datos,function(index,columna){
				  $("#IdCodigo").val(columna.id);
				  $("#IdTurno").val(columna.turno);
				  $("#IdTurEstado option[value="+columna.estado+"]").attr("selected",true);
			   });
		  })
		  
		  $("#IdTurNuevo").attr("disabled",true);
          $("#IdTurGrabar").attr("disabled",false);
          $("#IdTurCancelar").attr("disabled",false);
          $("#IdTurBuscar").attr("disabled",true);	
          $("#IdTurEliminar").attr("disabled",false);
		  $("#IdTurNuevo").removeClass("btnNuevo").addClass("btnDeshabilitarNuevo");
          $("#IdTurGrabar").removeClass("btnDeshabilitarGrabar").addClass("btnGrabar");
          $("#IdTurCancelar").removeClass("btnDeshabilitarCancelar").addClass("btnCancelar");
          $("#IdTurBuscar").removeClass("btnBuscar").addClass("btnDeshabilitarBuscar");
          $("#IdTurEliminar").removeClass("btnDeshabilitarEliminar").addClass("btnEliminar");
	  }
	  
	  
  
  