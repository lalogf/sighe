// JavaScript Document
$(document).ready(function() {  	

				$('#IdTablaGrupoUsuario').fixheadertable({ 
							//caption : "", 
							colratio : [40,200,100], 
							height : 200, 
							width :370, 
							zebra : true, 
							sortable : false, 
							sortedColId : 3, 
							dateFormat : 'm/d/Y',
							pager : false,
							rowsPerPage	 : 10,
							resizeCol : true
						});
	 }); 
 function LimpiarGrupoUsuario(){
   $("input").val("");	
   $("#IdEstadoGrupoUsuario option[value='1']").attr("selected",true);
 } 
	 
 function NuevoGrupoUsuario(){
   $("input[type='text']").attr("disabled",false);
   $("select").attr("disabled",false);
   $("input[type='text']").css({"background-color":"#FFFFFF"});
   $("select").css({"background-color":"#FFFFFF"});
   $("#IdGrupoNuevo").attr("disabled",true);
   $("#IdGrupoGrabar").attr("disabled",false);
   $("#IdGrupoCancelar").attr("disabled",false);
   $("#IdGrupoBuscar").attr("disabled",true);	
   $("#IdGrupoEliminar").attr("disabled",true);
   $("#IdGrupoNuevo").removeClass("btnNuevo").addClass("btnDeshabilitarNuevo");
   $("#IdGrupoGrabar").removeClass("btnDeshabilitarGrabar").addClass("btnGrabar");
   $("#IdGrupoCancelar").removeClass("btnDeshabilitarCancelar").addClass("btnCancelar");
   $("#IdGrupoBuscar").removeClass("btnBuscar").addClass("btnDeshabilitarBuscar");
   $("#IdGrupoEliminar").removeClass("btnEliminar").addClass("btnDeshabilitarEliminar");
   $("#IdOpcionGrupoUsuario").val(1);
   $.post('CONTROLADOR/Cgrupo_usuario.php',{accion:'GENERARID'},function(data){
	    //alert(data);
		$("#IdCodigoGrupoUsuario").val(data);
		})
	 //LimpiarGrupoUsuario();	
 }
 function GrabarGrupoUsuario(){
	 $("#IdTituloGrupoUsuario").text("");
    var $codigo=$("#IdCodigoGrupoUsuario").val(); 
	var $grupo=$("#IdNombreGrupo").val();
	var $estado=$("#IdEstadoGrupoUsuario").val();
	var $opcion=$("#IdOpcionGrupoUsuario").val();
	var $fec_crea=$("#IdGrupFecCrea").text();
	var $user_crea=$("#IdGrupUserCrea").text();
	//alert($codigo+' '+$grupo+' '+$estado+' '+$opcion);exit;
	 if($grupo==""){
		 $("#IdTituloGrupoUsuario").text("Ingrese Grupo ..");
		 $("#MensajeGrupoUsuario").fadeIn();$("#IdNombreGrupo").focus(); exit;
		 }
	$.post('CONTROLADOR/Cgrupo_usuario.php',{accion:'GRABAR',codigo:$codigo,grupo:$grupo,estado:$estado,opcion:$opcion,fec_crea:$fec_crea,user_crea:$user_crea},function(data){    
		if(data==1){
			if($opcion==1){
		      $("#IdTituloGrupoUsuario").text("Datos Insertados Correctamente ..");
			  CancelarGrupoUsuario();
			  }
			if($opcion==2){
		      $("#IdTituloGrupoUsuario").text("Datos Modificados Correctamente ..");
			  CancelarGrupoUsuario();
			  }  
		      $("#MensajeGrupoUsuario").fadeIn();
		      LimpiarGrupoUsuario(); 
		      $("#IdEstadoGrupoUsuario").attr("disabled",true);	 
              $("#IdCodigoGrupoUsuario").attr("disabled",true);
		      CancelarGrupoUsuario();
			
		}else{
		 if($opcion==1){
		      $("#IdTituloGrupoUsuario").text("No se pudo Insertar Correctamente ..");
			  }
		 if($opcion==2){
		      $("#IdTituloGrupoUsuario").text("No se pudo Modificar Correctamente ..");
			  }	
		      $("#MensajeGrupoUsuario").fadeIn();	
		 
			}
		
	   })
   }
   
 function CancelarGrupoUsuario(){
   $("input[type='text']").attr("disabled",true);
   $("select").attr("disabled",true);
   $("input[type='text']").css({"background-color":"#E6FFF2"});	
   $("select").css({"background-color":"#E6FFF2"});
   $("#IdGrupoNuevo").attr("disabled",false);
   $("#IdGrupoGrabar").attr("disabled",true);
   $("#IdGrupoCancelar").attr("disabled",true);
   $("#IdGrupoBuscar").attr("disabled",false);	
   $("#IdGrupoEliminar").attr("disabled",true); 
   $("#IdGrupoNuevo").removeClass("btnDeshabilitarNuevo").addClass("btnNuevo");
   $("#IdGrupoGrabar").removeClass("btnGrabar").addClass("btnDeshabilitarGrabar");
   $("#IdGrupoCancelar").removeClass("btnCancelar").addClass("btnDeshabilitarCancelar");
   $("#IdGrupoBuscar").removeClass("btnDeshabilitarBuscar").addClass("btnBuscar");
   $("#IdGrupoEliminar").removeClass("btnEliminar").addClass("btnDeshabilitarEliminar");
   LimpiarGrupoUsuario();
   }
 function BuscarGrupoUsuario(){
	$("#DivBuscarGrupoUsuarios").show(); 
	$("#IdBusquedaGrupoUsuario").attr("disabled",false);
	$("#IdBusquedaGrupoUsuario").css({"background-color":"#FFFFFF"});	
	$("#IdBusquedaGrupoUsuario").val("");
	$("#IdBusquedaGrupoUsuario").focus(); 
	$("#CuerpoGrupoUsuario").html("");
   }
 function EliminarGrupoUsuario(){
	 $("#IdTituloGrupoUsuario").text(""); 
   var $id=$("#IdCodigoGrupoUsuario").val();
   $.post('CONTROLADOR/Cgrupo_usuario.php',{accion:'ELIMINAR',id:$id},function(data){
		if(data==1){
		 $("#IdTituloGrupoUsuario").text("Datos Eliminados Correctamente ..");
		 $("#MensajeGrupoUsuario").fadeIn();
		 CancelarGrupoUsuario();
		}else{
		$("#IdTituloGrupoUsuario").text("No se pudo Eliminar Correctamente ..");
		 $("#MensajeGrupoUsuario").fadeIn();	
			}
		
	 })
   LimpiarGrupoUsuario();
   }
 function SalirGrupoUsuario(){
   $("#DivGrupoUsuario").hide("slow");	
   LimpiarGrupoUsuario();
 } 
  function CancelarBuscarGrupoUsuario(){
   $("#DivBuscarGrupoUsuarios").hide("slow");	
   LimpiarGrupoUsuario();
 }    
 function RealizaBusquedaGrupoUsuario(){
	var $grupo=$("#IdBusquedaGrupoUsuario").val(); 
	$("#CuerpoGrupoUsuario").html("<tr><td colspan='2'><img src='LIBRERIAS/IMAGENES/cargando.gif' /> Cargando ..</td></tr>");
	$.post('CONTROLADOR/Cgrupo_usuario.php',{accion:'LISTAR',grupo:$grupo},function(data){//alert(data);exit;
		 var $data=data.split("///");
		 if($data[0]==0){
			 $("#CuerpoGrupoUsuario").html("<tr><td colspan='2'>No hay resultados ..</td></tr>");exit;
			 }
		 $("#CanBusGrupoUsuario").val($data[0]);
		 $("#CuerpoGrupoUsuario").html($data[1]);
		 $("#IdNumFilaGrupoUsuario").val(1)
		 })
	exit;	 
  }
  
/*  $(document).keydown(function(e){
           if (e.keyCode==40) {
			      var $num_fila=parseInt($("#IdNumFilaGrupoUsuario").val());
				  var $tr=$num_fila+1;
				  $can=parseInt($("#CanBusGrupoUsuario").val());
				  if($num_fila<$can){
					$("#"+$num_fila).css({background:"#FFFFFF"});  
			        $("#"+$tr).css({background:"#c5dbec"});
				    $("#IdNumFilaGrupoUsuario").val($tr);
			       }
			}
			if (e.keyCode==38) {
			      var $num_fila=parseInt($("#IdNumFilaGrupoUsuario").val());
				  var $tr=$num_fila-1;
				  if($num_fila>1){
					$("#"+$num_fila).css({background:"#FFFFFF"});  
			        $("#"+$tr).css({background:"#c5dbec"});
				    $("#IdNumFilaGrupoUsuario").val($tr);
			       }
			}exit;
   })*/
  
  $("#IdBusquedaGrupoUsuario").keypress(function(e){
	  if(e.keyCode==13){
		  
		  $("#IdBusquedaGrupoUsuario").blur();
		  RealizaBusquedaGrupoUsuario();
		  
		  }   
	  })
	 
	 function PintarFila($num_fila){
	   $("table tbody tr").css({background:"#FFFFFF"});
	   $("#"+$num_fila).css({background:"#E9FFE9", cursor:"pointer"});
	   $("#IdNumFilaGrupoUsuario").val($num_fila);
	 } 
	  
	  
	function SeleccionarBusquedaGrupoUsuario(){
		  $("#IdOpcionGrupoUsuario").val(2);
		 var $fila=$("#IdNumFilaGrupoUsuario").val();
		 var $idgrupo=$("#"+$fila).attr("idgrupo");//alert($idgrupo);exit;
		 $("#DivBuscarGrupoUsuarios").hide("slow");
		 $("#IdCodigoGrupoUsuario").attr("disabled",false);	
         $("#IdNombreGrupo").attr("disabled",false);	
         $("#IdEstadoGrupoUsuario").attr("disabled",false);
		 $("#IdCodigoGrupoUsuario").css({"background-color":"#FFFFFF"});
         $("#IdNombreGrupo").css({"background-color":"#FFFFFF"});
         $("#IdEstadoGrupoUsuario").css({"background-color":"#FFFFFF"});
		 $.post('CONTROLADOR/Cgrupo_usuario.php',{accion:'LLENAR_FORM',idgrupo:$idgrupo},function(data){
			 var datos=eval(data);
			 $.each(datos,function(index,columna){
				  $("#IdCodigoGrupoUsuario").val(columna.id);
				  $("#IdNombreGrupo").val(columna.nombre);
				  $("#IdEstadoGrupoUsuario option[value="+columna.estado+"]").attr("selected",true);
			   });
		  })
		  
		  $("#IdGrupoNuevo").attr("disabled",true);
          $("#IdGrupoGrabar").attr("disabled",false);
          $("#IdGrupoCancelar").attr("disabled",false);
          $("#IdGrupoBuscar").attr("disabled",true);	
          $("#IdGrupoEliminar").attr("disabled",false);
		  $("#IdGrupoNuevo").removeClass("btnNuevo").addClass("btnDeshabilitarNuevo");
          $("#IdGrupoGrabar").removeClass("btnDeshabilitarGrabar").addClass("btnGrabar");
          $("#IdGrupoCancelar").removeClass("btnDeshabilitarCancelar").addClass("btnCancelar");
          $("#IdGrupoBuscar").removeClass("btnBuscar").addClass("btnDeshabilitarBuscar");
          $("#IdGrupoEliminar").removeClass("btnDeshabilitarEliminar").addClass("btnEliminar");
	  }  
	  
	  
  
  
  
      