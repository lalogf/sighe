// JavaScript Document
$(document).ready(function() {  	

				$('#IdTablaSucursal').fixheadertable({ 
							//caption : "", 
							colratio : [28,100,260,60], 
							height : 200, 
							width :500, 
							zebra : true, 
							sortable : false, 
							sortedColId : 3, 
							dateFormat : 'm/d/Y',
							pager : false,
							rowsPerPage	 : 10,
							resizeCol : true
						});
			   }); 
			   
 function LimpiarSucursal(){
   $("input").val("");	
   $("#IdEstadoSucursal option[value='1']").attr("selected",true);
 }			  
			   
 function NuevoSucursal(){
   $("input").attr("disabled",false);
   $("select").attr("disabled",false);
   $("input").css({"background-color":"#FFFFFF"});
   $("select").css({"background-color":"#FFFFFF"});
   $("#IdSucNuevo").attr("disabled",true);
   $("#IdSucGrabar").attr("disabled",false);
   $("#IdSucCancelar").attr("disabled",false);
   $("#IdSucBuscar").attr("disabled",true);	
   $("#IdSucEliminar").attr("disabled",true);
   $("#IdSucNuevo").removeClass("btnNuevo").addClass("btnDeshabilitarNuevo");
   $("#IdSucGrabar").removeClass("btnDeshabilitarGrabar").addClass("btnGrabar");
   $("#IdSucCancelar").removeClass("btnDeshabilitarCancelar").addClass("btnCancelar");
   $("#IdSucBuscar").removeClass("btnBuscar").addClass("btnDeshabilitarBuscar");
   $("#IdSucEliminar").removeClass("btnEliminar").addClass("btnDeshabilitarEliminar");
   $("#IdOpcionSucursal").val(1);
   $.post('CONTROLADOR/Csucursal.php',{accion:'GENERARID'},function(data){
	    //alert(data);
		$("#IdCodigoSucursal").val(data);
		})
	 //LimpiarGrupoUsuario();	
 }
 
 function CancelarSucursal(){
   $("input").attr("disabled",true);
   $("select").attr("disabled",true);
   $("input").css({"background-color":"#E6FFF2"});
   $("select").css({"background-color":"#E6FFF2"});	
   $("#IdSucNuevo").attr("disabled",false);
   $("#IdSucGrabar").attr("disabled",true);
   $("#IdSucCancelar").attr("disabled",true);
   $("#IdSucBuscar").attr("disabled",false);	
   $("#IdSucEliminar").attr("disabled",true); 
   $("#IdSucNuevo").removeClass("btnDeshabilitarNuevo").addClass("btnNuevo");
   $("#IdSucGrabar").removeClass("btnGrabar").addClass("btnDeshabilitarGrabar");
   $("#IdSucCancelar").removeClass("btnCancelar").addClass("btnDeshabilitarCancelar");
   $("#IdSucBuscar").removeClass("btnDeshabilitarBuscar").addClass("btnBuscar");
   $("#IdSucEliminar").removeClass("btnEliminar").addClass("btnDeshabilitarEliminar");
   LimpiarSucursal();
   }
   
 function BuscarSucursal(){
	$("#DivBuscarSucursales").show(); 
	$("#IdBusquedaSucursal").attr("disabled",false);
	$("#IdBusquedaSucursal").css({"background-color":"#FFFFFF"});	
	$("#IdBusquedaSucursal").val("");
	$("#IdBusquedaSucursal").focus(); 
	$("#CuerpoSucursal").html("");
   }
   
   function RealizaBusquedaSucursal(){
	var $sucursal=$("#IdBusquedaSucursal").val(); 
	$("#CuerpoSucursal").html("<tr><td colspan='2'><img src='LIBRERIAS/IMAGENES/cargando.gif' /> Cargando ..</td></tr>");
	$.post('CONTROLADOR/Csucursal.php',{accion:'LISTAR',sucursal:$sucursal},function(data){//alert(data);exit;
		 var $data=data.split("///");
		 if($data[0]==0){
			 $("#CuerpoSucursal").html("<tr><td colspan='4'>No hay resultados ..</td></tr>");exit;
			 }
		 $("#CanBusSucursal").val($data[0]);
		 $("#CuerpoSucursal").html($data[1]);
		 $("#IdNumFilaSucursal").val(1)
		 })
	exit;	 
  }
   
/*   $(document).keydown(function(e){
           if (e.keyCode==40) {
			      var $num_fila=parseInt($("#IdNumFilaSucursal").val());
				  var $tr=$num_fila+1;
				  $can=parseInt($("#CanBusSucursal").val());
				  if($num_fila<$can){
					$("#"+$num_fila).css({background:"#FFFFFF"});  
			        $("#"+$tr).css({background:"#c5dbec"});
				    $("#IdNumFilaSucursal").val($tr);
			       }
			}
			if (e.keyCode==38) {
			      var $num_fila=parseInt($("#IdNumFilaSucursal").val());
				  var $tr=$num_fila-1;
				  if($num_fila>1){
					$("#"+$num_fila).css({background:"#FFFFFF"});  
			        $("#"+$tr).css({background:"#c5dbec"});
				    $("#IdNumFilaSucursal").val($tr);
			       }
			}exit;
   })*/
  
  $("#IdBusquedaSucursal").keypress(function(e){
	  if(e.keyCode==13){
		  $("#IdBusquedaSucursal").blur();
		  RealizaBusquedaSucursal();
		  
		  }   
	  })
  function PintarFila($num_fila){
	   $("table tbody tr").css({background:"#FFFFFF"});
	   $("#"+$num_fila).css({background:"#E9FFE9", cursor:"pointer"});
	   $("#IdNumFilaSucursal").val($num_fila);
	 }
  
   function SeleccionarSucursal(){
		  $("#IdOpcionSucursal").val(2);
		 var $fila=$("#IdNumFilaSucursal").val();
		 var $idsucursal=$("#"+$fila).attr("idsucursal");//alert($idgrupo);exit;
		 $("#DivBuscarSucursales").hide("slow");
		 $("input").attr("disabled",false);	
         $("select").attr("disabled",false);
		 $("input").css({"background-color":"#FFFFFF"});
         $("select").css({"background-color":"#FFFFFF"});
		 $.post('CONTROLADOR/Csucursal.php',{accion:'LLENAR_FORM',idsucursal:$idsucursal},function(data){
			 var datos=eval(data);
			 $.each(datos,function(index,columna){
				  $("#IdCodigoSucursal").val(columna.id);
				  $("#IdRucSucursal").val(columna.ruc);
				  $("#IdRazonSocialSucursal").val(columna.razon_social);
				  $("#IdDireccionSucursal").val(columna.direccion);
				  $("#IdResponsableSucursal").val(columna.responsable);
				  $("#IdSobrenombreSucursal").val(columna.sobrenombre);
				  
				  $("#IdEstadoSucursal option[value="+columna.estado+"]").attr("selected",true);
			   });
		  })
		  
		  $("#IdSucNuevo").attr("disabled",true);
          $("#IdSucGrabar").attr("disabled",false);
          $("#IdSucCancelar").attr("disabled",false);
          $("#IdSucBuscar").attr("disabled",true);	
          $("#IdSucEliminar").attr("disabled",false);
		  $("#IdSucNuevo").removeClass("btnNuevo").addClass("btnDeshabilitarNuevo");
          $("#IdSucGrabar").removeClass("btnDeshabilitarGrabar").addClass("btnGrabar");
          $("#IdSucCancelar").removeClass("btnDeshabilitarCancelar").addClass("btnCancelar");
          $("#IdSucBuscar").removeClass("btnBuscar").addClass("btnDeshabilitarBuscar");
          $("#IdSucEliminar").removeClass("btnDeshabilitarEliminar").addClass("btnEliminar");
	  }  
	  
 
   
   
 function EliminarSucursal(){
	 $("#IdTituloSucursal").text(""); 
   var $id=$("#IdCodigoSucursal").val();
   $.post('CONTROLADOR/Csucursal.php',{accion:'ELIMINAR',id:$id},function(data){
		if(data==1){
		 $("#IdTituloSucursal").text("Datos Eliminados Correctamente ..");
		 $("#MensajeSucursal").fadeIn();
		 CancelarSucursal();
		}else{
		$("#IdTituloSucursal").text("No se pudo Eliminar Correctamente ..");
		 $("#MensajeSucursal").fadeIn();	
			}
		
	 })
   LimpiarSucursal();
   }
   
   function GrabarSucursal(){
	 $("#IdTituloSucursal").text("");
    var $codigo=$("#IdCodigoSucursal").val(); 
	var $ruc=$("#IdRucSucursal").val();
	var $razon=$("#IdRazonSocialSucursal").val();
	var $direccion=$("#IdDireccionSucursal").val();
	var $responsable=$("#IdResponsableSucursal").val();
	var $sobrenombre=$("#IdSobrenombreSucursal").val();
	var $estado=$("#IdEstadoSucursal").val();
	var $opcion=$("#IdOpcionSucursal").val();
	var $fec_crea=$("#IdSucuFecCrea").text();
	var $user_crea=$("#IdSucuUserCrea").text();
	//alert($codigo+' '+$grupo+' '+$estado+' '+$opcion);exit;
	 if($ruc==""){
		 $("#IdTituloSucursal").text("Ingrese RUC ..");
		 $("#MensajeSucursal").fadeIn();$("#IdRucSucursal").focus(); exit;
		 }
	 if($razon==""){
		 $("#IdTituloSucursal").text("Ingrese Razon Social ..");
		 $("#MensajeSucursal").fadeIn();$("#IdRazonSocialSucursal").focus(); exit;
		 }
	 if($direccion==""){
		 $("#IdTituloSucursal").text("Ingrese Direccion ..");
		 $("#MensajeSucursal").fadeIn();$("#IdDireccionSucursal").focus(); exit;
		 }
	 if($responsable==""){
		 $("#IdTituloSucursal").text("Ingrese Responsable ..");
		 $("#MensajeSucursal").fadeIn();$("#IdResponsableSucursal").focus(); exit;
		 }
	 if($sobrenombre==""){
		 $("#IdTituloSucursal").text("Ingrese Sobrenombre ..");
		 $("#MensajeSucursal").fadeIn();$("#IdSobrenombreSucursal").focus(); exit;
		 }	 	 	 
		 	 
	$.post('CONTROLADOR/Csucursal.php',{accion:'GRABAR',codigo:$codigo,ruc:$ruc,razon:$razon,direccion:$direccion,responsable:$responsable,sobrenombre:$sobrenombre,estado:$estado,opcion:$opcion,fec_crea:$fec_crea,user_crea:$user_crea},function(data){    
		if(data==1){
			if($opcion==1){
		      $("#IdTituloSucursal").text("Datos Insertados Correctamente ..");
			  CancelarSucursal();
			  }
			if($opcion==2){
		      $("#IdTituloSucursal").text("Datos Modificados Correctamente ..");
			  CancelarSucursal();
			  }  
		      $("#MensajeSucursal").fadeIn();
		      LimpiarSucursal(); 
		      $("input").attr("disabled",true);	 
              $("select").attr("disabled",true);
		      CancelarSucursal();
			
		}else{
		 if($opcion==1){
		      $("#IdTituloSucursal").text("No se pudo Insertar Correctamente ..");
			  }
		 if($opcion==2){
		      $("#IdTituloSucursal").text("No se pudo Modificar Correctamente ..");
			  }	
		      $("#MensajeSucursal").fadeIn();	
		 
			}
		
	   })
   }
   
 function SalirSucursal(){
   $("#DivSucursal").hide("slow");	
 } 
  /*function CancelarBuscarSucursal(){
   $("#DivBuscarSucursales").hide("slow");	
 }*/