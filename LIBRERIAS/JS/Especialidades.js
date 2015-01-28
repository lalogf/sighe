// JavaScript Document
$(document).ready(function() {  	

				$('#IdTablaEspecialidad').fixheadertable({ 
							//caption : "", 
							colratio : [30, 330,60], 
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
 function NuevoEspecialidad(){
   $("input[type='text']").css({"background-color":"#FFFFFF"});
   $("select").css({"background-color":"#FFFFFF"});
   $("#IdCodigoEspecialidad").attr("disabled",false);
   $("#IdEspecialidad").attr("disabled",false);
   $("#IdEstadoEspecialidad").attr("disabled",false);
   $("#IdEspecNuevo").attr("disabled",true);
   $("#IdEspecGrabar").attr("disabled",false);
   $("#IdEspecCancelar").attr("disabled",false);
   $("#IdEspecBuscar").attr("disabled",true);	
   $("#IdEspecEliminar").attr("disabled",true);	
   $("#IdEspecNuevo").removeClass("btnNuevo").addClass("btnDeshabilitarNuevo");
   $("#IdEspecGrabar").removeClass("btnDeshabilitarGrabar").addClass("btnGrabar");
   $("#IdEspecCancelar").removeClass("btnDeshabilitarCancelar").addClass("btnCancelar");
   $("#IdEspecBuscar").removeClass("btnBuscar").addClass("btnDeshabilitarBuscar");   
    $("#IdOpcionEspecialidad").val(1);
    $.post('CONTROLADOR/Cespecialidad.php',{accion:'GENERARID'},function(data){
	    //alert(data);
		$("#IdCodigoEspecialidad").val(data);
	 })
   //LimpiarEspecialidad();
 }
  function GrabarEspecialidad(){
	 $("#IdTituloEspecialidad").text("");
    var $codigo=$("#IdCodigoEspecialidad").val(); 
	var $especialidad=$("#IdEspecialidad").val();
	var $estado=$("#IdEstadoEspecialidad").val();
	var $opcion=$("#IdOpcionEspecialidad").val();
	var $fec_crea=$("#IdEspecFecCrea").text();
	var $user_crea=$("#IdEspecUserCrea").text();
	//alert($especialidad);exit;
	 if($especialidad==""){
		 $("#IdTituloEspecialidad").text("Ingrese Especialidad ..");
		 $("#MensajeEspecialidad").fadeIn();$("#IdEspecialidad").focus(); exit;
		 }
	$.post('CONTROLADOR/Cespecialidad.php',{accion:'GRABAR',codigo:$codigo,especialidad:$especialidad,estado:$estado,opcion:$opcion,fec_crea:$fec_crea,user_crea:$user_crea},function(data){    
		if(data==1){
			if($opcion==1){
		      $("#IdTituloEspecialidad").text("Datos Insertados Correctamente ..");
			  CancelarEspecialidad();
			  }
			if($opcion==2){
		      $("#IdTituloEspecialidad").text("Datos Modificados Correctamente ..");
			  CancelarEspecialidad();
			  }  
		      $("#MensajeEspecialidad").fadeIn();
		      LimpiarTurno(); 
		      $("#IdEstadoEspecialidad").attr("disabled",true);	 
              $("#IdCodigoEspecialidad").attr("disabled",true);
		      CancelarEspecialidad();
			
		}else{
		 if($opcion==1){
		      $("#IdTituloEspecialidad").text("No se pudo Insertar Correctamente ..");
			  }
		 if($opcion==2){
		      $("#IdTituloEspecialidad").text("No se pudo Modificar Correctamente ..");
			  }	
		      $("#MensajeEspecialidad").fadeIn();	
		 
			}
		
	   })
   }
 function CancelarEspecialidad(){
   $("input[type='text']").css({"background-color":"#E6FFF2"});
   $("select").css({"background-color":"#E6FFF2"});
   $("#IdCodigoEspecialidad").attr("disabled",true);
   $("#IdEspecialidad").attr("disabled",true);	 
   $("#IdEstadoEspecialidad").attr("disabled",true);	 
   $("#IdEspecNuevo").attr("disabled",false);
   $("#IdEspecGrabar").attr("disabled",true);
   $("#IdEspecCancelar").attr("disabled",true);
   $("#IdEspecBuscar").attr("disabled",false);	
   $("#IdEspecEliminar").attr("disabled",true); 
   $("#IdEspecNuevo").removeClass("btnDeshabilitarNuevo").addClass("btnNuevo");
   $("#IdEspecGrabar").removeClass("btnGrabar").addClass("btnDeshabilitarGrabar");
   $("#IdEspecCancelar").removeClass("btnCancelar").addClass("btnDeshabilitarCancelar");
   $("#IdEspecBuscar").removeClass("btnDeshabilitarBuscar").addClass("btnBuscar");
   $("#IdEspecEliminar").removeClass("btnEliminar").addClass("btnDeshabilitarEliminar");
   $("#IdCodigoEspecialidad").val("");
   LimpiarEspecialidad();
   }
 function BuscarEspecialidad(){
	$("#DivBuscarEspecialidades").show("slow");
	$("#IdBusquedaEspec").css({"background-color":"#FFFFFF"});	
	$("#IdBusquedaEspec").val("");
	$("#IdBusquedaEspec").focus(); 
	$("#CuerpoEspecialidad").html("");
   }
 function EliminarEspecialidad(){
	 $("#IdTituloEspecialidad").text(""); 
   var $id=$("#IdCodigoEspecialidad").val();
   $.post('CONTROLADOR/Cespecialidad.php',{accion:'ELIMINAR',id:$id},function(data){
		if(data==1){
		 $("#IdTituloEspecialidad").text("Datos Eliminados Correctamente ..");
		 $("#MensajeEspecialidad").fadeIn();
		 CancelarEspecialidad();
		}else{
		$("#IdTituloEspecialidad").text("No se pudo Eliminar Correctamente ..");
		 $("#MensajeEspecialidad").fadeIn();	
			}
		
	 })
   LimpiarEspecialidad();
   }
   
 function SalirEspecialidad(){
   $("#DivEspecialidad").hide("slow");	
   LimpiarEspecialidad();
 } 
 
  function CancelarBuscarEspecialidad(){    
   $("#DivBuscarEspecialidades").hide("slow");	
   LimpiarEspecialidad();
 }
  function LimpiarEspecialidad(){
   $("#IdCodigo").val("");	
   $("#IdEspecialidad").val("");
 }
 
 
 function RealizaBusquedaEspecialidad(){
	var $especialidad=$("#IdBusquedaEspec").val(); 
	$("#CuerpoGrupoUsuario").html("<tr><td colspan='2'><img src='LIBRERIAS/IMAGENES/cargando.gif' /> Cargando ..</td></tr>");
	$.post('CONTROLADOR/Cespecialidad.php',{accion:'LISTAR',especialidad:$especialidad},function(data){//alert(data);exit;
		 var $data=data.split("///");
		 if($data[0]==0){
			 $("#CuerpoGrupoUsuario").html("<tr><td colspan='2'>No hay resultados ..</td></tr>");exit;
			 }
		 $("#CanBusEspecialidad").val($data[0]);
		 $("#CuerpoEspecialidad").html($data[1]);
		 $("#IdNumFilaEspecialidad").val(1)
		 })
	exit;	 
  }
  
/*  $(document).keydown(function(e){
           if (e.keyCode==40) {
			      var $num_fila=parseInt($("#IdNumFilaEspecialidad").val());
				  var $tr=$num_fila+1;
				  $can=parseInt($("#CanBusEspecialidad").val());
				  if($num_fila<$can){
					$("#"+$num_fila).css({background:"#FFFFFF"});  
			        $("#"+$tr).css({background:"#c5dbec"});
				    $("#IdNumFilaEspecialidad").val($tr);
			       }
			}
			if (e.keyCode==38) {
			      var $num_fila=parseInt($("#IdNumFilaEspecialidad").val());
				  var $tr=$num_fila-1;
				  if($num_fila>1){
					$("#"+$num_fila).css({background:"#FFFFFF"});  
			        $("#"+$tr).css({background:"#c5dbec"});
				    $("#IdNumFilaEspecialidad").val($tr);
			       }
			}exit;
   })*/
  
   $("#IdBusquedaEspec").keypress(function(e){
	  if(e.keyCode==13){
		  $("#IdBusquedaEspec").blur();
		  RealizaBusquedaEspecialidad();
		  }   
	  })
	 
  function PintarFila($num_fila){
	   $("table tbody tr").css({background:"#FFFFFF"});
	   $("#"+$num_fila).css({background:"#E9FFE9", cursor:"pointer"});
	   $("#IdNumFilaEspecialidad").val($num_fila);
	 }	
	 
  function SeleccionarBusquedaEspecialidad(){
		  $("#IdOpcionEspecialidad").val(2);
		 var $fila=$("#IdNumFilaEspecialidad").val();
		 var $idespecialidad=$("#"+$fila).attr("idespecialidad");//alert($idgrupo);exit;
		 $("#DivBuscarEspecialidades").hide("slow");
		 $("#IdCodigoEspecialidad").attr("disabled",false);	
         $("#IdEspecialidad").attr("disabled",false);	
         $("#IdEstadoEspecialidad").attr("disabled",false);
		 $("#IdCodigoEspecialidad").css({"background-color":"#FFFFFF"});
         $("#IdEspecialidad").css({"background-color":"#FFFFFF"});
         $("#IdEstadoEspecialidad").css({"background-color":"#FFFFFF"});
		 $.post('CONTROLADOR/Cespecialidad.php',{accion:'LLENAR_FORM',idespecialidad:$idespecialidad},function(data){
			// alert(data);exit;
			 var datos=eval(data);
			 $.each(datos,function(index,columna){
				  $("#IdCodigoEspecialidad").val(columna.id);
				  $("#IdEspecialidad").val(columna.nombre);
				  $("#IdEstadoEspecialidad option[value="+columna.estado+"]").attr("selected",true);
			   });
		  })
		  
		  $("#IdEspecNuevo").attr("disabled",true);
          $("#IdEspecGrabar").attr("disabled",false);
          $("#IdEspecCancelar").attr("disabled",false);
          $("#IdEspecBuscar").attr("disabled",true);	
          $("#IdEspecEliminar").attr("disabled",false);
		  $("#IdEspecNuevo").removeClass("btnNuevo").addClass("btnDeshabilitarNuevo");
          $("#IdEspecGrabar").removeClass("btnDeshabilitarGrabar").addClass("btnGrabar");
          $("#IdEspecCancelar").removeClass("btnDeshabilitarCancelar").addClass("btnCancelar");
          $("#IdEspecBuscar").removeClass("btnBuscar").addClass("btnDeshabilitarBuscar");
          $("#IdEspecEliminar").removeClass("btnDeshabilitarEliminar").addClass("btnEliminar");
	  }  
	  	   