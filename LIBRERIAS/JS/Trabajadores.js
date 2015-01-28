// JavaScript Document
$(document).ready(function() {  	

				$('#IdTablaTrabajador').fixheadertable({ 
							//caption : "", 
							colratio : [40, 170, 100, 50,60], 
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
  
  			   
 function LimpiarTrabajador(){
   $("input").val("");	
   $("#IdEstadoTrabajador option[value='1']").attr("selected",true);
   $("#IdSexoTrabajador option[value='1']").attr("selected",true);
   $("#IdEspecialidadTrabajador option[value='0']").attr("selected",true);
 }			   
			   
 function NuevoTrabajador(){
   $("input").attr("disabled",false);
   $("select").attr("disabled",false);
   $("input").css({"background-color":"#FFFFFF"});
   $("select").css({"background-color":"#FFFFFF"});
   $("#IdTrabNuevo").attr("disabled",true);
   $("#IdTrabGrabar").attr("disabled",false);
   $("#IdTrabCancelar").attr("disabled",false);
   $("#IdTrabBuscar").attr("disabled",true);	
   $("#IdTrabEliminar").attr("disabled",true);
   $("#IdTrabNuevo").removeClass("btnNuevo").addClass("btnDeshabilitarNuevo");
   $("#IdTrabGrabar").removeClass("btnDeshabilitarGrabar").addClass("btnGrabar");
   $("#IdTrabCancelar").removeClass("btnDeshabilitarCancelar").addClass("btnCancelar");
   $("#IdTrabBuscar").removeClass("btnBuscar").addClass("btnDeshabilitarBuscar");
   $("#IdTrabEliminar").removeClass("btnEliminar").addClass("btnDeshabilitarEliminar");
   $("#IdOpcionTrabajador").val(1);
   $.post('CONTROLADOR/Ctrabajador.php',{accion:'GENERARID'},function(data){
		$("#IdCodigoTrabajador").val(data);
	})
 }
 
 function CancelarTrabajador(){
   $("input").val("");	 
   $("input").attr("disabled",true);
   $("select").attr("disabled",true);
   $("input").css({"background-color":"#E6FFF2"});
   $("select").css({"background-color":"#E6FFF2"});
   $("#IdTrabNuevo").attr("disabled",false);
   $("#IdTrabGrabar").attr("disabled",true);
   $("#IdTrabCancelar").attr("disabled",true);
   $("#IdTrabBuscar").attr("disabled",false);	
   $("#IdTrabEliminar").attr("disabled",true); 
   $("#IdTrabNuevo").removeClass("btnDeshabilitarNuevo").addClass("btnNuevo");
   $("#IdTrabGrabar").removeClass("btnGrabar").addClass("btnDeshabilitarGrabar");
   $("#IdTrabCancelar").removeClass("btnCancelar").addClass("btnDeshabilitarCancelar");
   $("#IdTrabBuscar").removeClass("btnDeshabilitarBuscar").addClass("btnBuscar");
   $("#IdTrabEliminar").removeClass("btnEliminar").addClass("btnDeshabilitarEliminar");
   LimpiarSucursal();
   }
   
  function BuscarTrabajador(){
	$("#DivBuscarTrabajadores").show(); 
	$("#IdBusquedaTrabajador").attr("disabled",false);
	$("#IdBusquedaTrabajador").css({"background-color":"#FFFFFF"});	
	$("#IdBusquedaTrabajador").val("");
	$("#IdBusquedaTrabajador").focus(); 
	$("#CuerpoTrabajador").html("");
   }
   
   function RealizaBusquedaTrabajador(){
	var $trabajador=$("#IdBusquedaTrabajador").val(); 
 $("#CuerpoTrabajador").html("<tr><td colspan='5'><img src='LIBRERIAS/IMAGENES/cargando.gif' /> Cargando ..</td></tr>");
	$.post('CONTROLADOR/Ctrabajador.php',{accion:'LISTAR',trabajador:$trabajador},function(data){//alert(data);exit;
		 var $data=data.split("///");
		 if($data[0]==0){
			 $("#CuerpoTrabajador").html("<tr><td colspan='5'>No hay resultados ..</td></tr>");exit;
			 }
		 $("#CanBusTrabajador").val($data[0]);
		 $("#CuerpoTrabajador").html($data[1]);
		 $("#IdNumFilaTrabajador").val(1)
		 })
	exit;	 
  }
  
  /* $(document).keydown(function(e){
           if (e.keyCode==40) {
			      var $num_fila=parseInt($("#IdNumFilaTrabajador").val());
				  var $tr=$num_fila+1;
				  $can=parseInt($("#CanBusTrabajador").val());
				  if($num_fila<$can){
					$("#"+$num_fila).css({background:"#FFFFFF"});  
			        $("#"+$tr).css({background:"#c5dbec"});
				    $("#IdNumFilaTrabajador").val($tr);
			       }
			}
			if (e.keyCode==38) {
			      var $num_fila=parseInt($("#IdNumFilaTrabajador").val());
				  var $tr=$num_fila-1;
				  if($num_fila>1){
					$("#"+$num_fila).css({background:"#FFFFFF"});  
			        $("#"+$tr).css({background:"#c5dbec"});
				    $("#IdNumFilaTrabajador").val($tr);
			       }
			}exit;
   })*/
  
  $("#IdBusquedaTrabajador").keypress(function(e){
	  if(e.keyCode==13){
		  $("#IdBusquedaTrabajador").blur();
		  RealizaBusquedaTrabajador();
		  
		  }   
	  })
  function PintarFila($num_fila){
	   $("table tbody tr").css({background:"#FFFFFF"});
	   $("#"+$num_fila).css({background:"#E9FFE9", cursor:"pointer"});
	   $("#IdNumFilaTrabajador").val($num_fila);
	 }
  
  function SeleccionarTrabajador(){
		  $("#IdOpcionTrabajador").val(2);
		 var $fila=$("#IdNumFilaTrabajador").val();
		 var $idtrabajador=$("#"+$fila).attr("idtrabajador");//alert($idgrupo);exit;
		 $("#DivBuscarTrabajadores").hide("slow");
		 $("input").attr("disabled",false);	
         $("select").attr("disabled",false);
		 $("input").css({"background-color":"#FFFFFF"});
         $("select").css({"background-color":"#FFFFFF"});
		 $.post('CONTROLADOR/Ctrabajador.php',{accion:'LLENAR_FORM',idtrabajador:$idtrabajador},function(data){
			 var datos=eval(data);
			 $.each(datos,function(index,columna){
				  $("#IdCodigoTrabajador").val(columna.id);
				  $("#IdNombresTrabajador").val(columna.nombres);
				  $("#IdApellidosTrabajador").val(columna.apellidos);
				  $("#IdDniTrabajador").val(columna.dni);
				  $("#IdEspecialidadTrabajador option[value="+columna.id_especialidad+"]").attr("selected",true);
				  $("#IdSexoTrabajador option[value="+columna.sexo+"]").attr("selected",true);
				  $("#IdDireccionTrabajador").val(columna.direccion);
				  $("#IdTelefonoTrabajador").val(columna.telefono);
				  $("#IdCorreoTrabajador").val(columna.correo);
				  $("#IdEstadoTrabajador option[value="+columna.estado+"]").attr("selected",true);
			   });
		  })
		  
		  $("#IdTrabNuevo").attr("disabled",true);
          $("#IdTrabGrabar").attr("disabled",false);
          $("#IdTrabCancelar").attr("disabled",false);
          $("#IdTrabBuscar").attr("disabled",true);	
          $("#IdTrabEliminar").attr("disabled",false);
		  $("#IdTrabNuevo").removeClass("btnNuevo").addClass("btnDeshabilitarNuevo");
          $("#IdTrabGrabar").removeClass("btnDeshabilitarGrabar").addClass("btnGrabar");
          $("#IdTrabCancelar").removeClass("btnDeshabilitarCancelar").addClass("btnCancelar");
          $("#IdTrabBuscar").removeClass("btnBuscar").addClass("btnDeshabilitarBuscar");
          $("#IdTrabEliminar").removeClass("btnDeshabilitarEliminar").addClass("btnEliminar");
	  }  
	  
   function EliminarTrabajador(){
	 $("#IdTituloTrabajador").text(""); 
   var $id=$("#IdCodigoTrabajador").val();
   $.post('CONTROLADOR/Ctrabajador.php',{accion:'ELIMINAR',id:$id},function(data){
		if(data==1){
		 $("#IdTituloTrabajador").text("Datos Eliminados Correctamente ..");
		 $("#MensajeTrabajador").fadeIn();
		 CancelarTrabajador();
		}else{
		$("#IdTituloTrabajador").text("No se pudo Eliminar Correctamente ..");
		 $("#MensajeTrabajador").fadeIn();	
			}
		
	 })
   LimpiarTrabajador();
   }
   
 function GrabarTrabajador(){
	 $("#IdTituloTrabajador").text("");
    var $codigo=$("#IdCodigoTrabajador").val(); 
	var $nombres=$("#IdNombresTrabajador").val();
	var $apellidos=$("#IdApellidosTrabajador").val();
	var $dni=$("#IdDniTrabajador").val();
	var $sexo=$("#IdSexoTrabajador").val();
	var $direccion=$("#IdDireccionTrabajador").val();
	var $telefono=$("#IdTelefonoTrabajador").val();
	var $correo=$("#IdCorreoTrabajador").val();	
	var $estado=$("#IdEstadoTrabajador").val();
	var $opcion=$("#IdOpcionTrabajador").val();
	var $fec_crea=$("#IdTraFecCrea").text();
	var $user_crea=$("#IdTraUserCrea").text();
	var $id_especialidad=$("#IdEspecialidadTrabajador").val();

	//alert($codigo+' '+$grupo+' '+$estado+' '+$opcion);exit;
	 if($nombres==""){
		 $("#IdTituloTrabajador").text("Ingrese Nombres ..");
		 $("#MensajeTrabajador").fadeIn();$("#IdNombresTrabajador").focus(); exit;
		 }
	 if($apellidos==""){
		 $("#IdTituloTrabajador").text("Ingrese Apellidos ..");
		 $("#MensajeTrabajador").fadeIn();$("#IdApellidosTrabajador").focus(); exit;
		 }
	 if($id_especialidad==""){
		 $("#IdTituloTrabajador").text("Seleccione Especialidad ..");
		 $("#MensajeTrabajador").fadeIn(); exit;
		 }	 
	 if($dni==""){
		 $("#IdTituloTrabajador").text("Ingrese DNI ..");
		 $("#MensajeTrabajador").fadeIn();$("#IdDireccionSucursal").focus(); exit;
		 }
	 if($sexo==0){
		 $("#IdTituloTrabajador").text("Ingrese Sexo ..");
		 $("#MensajeTrabajador").fadeIn();$("#IdSexoTrabajador").focus(); exit;
		 }
	 if($direccion==""){
		 $("#IdTituloTrabajador").text("Ingrese Direccion ..");
		 $("#MensajeTrabajador").fadeIn();$("#IdDireccionTrabajador").focus(); exit;
		 }	 	 	 
		 	 
	$.post('CONTROLADOR/Ctrabajador.php',{accion:'GRABAR',codigo:$codigo,nombres:$nombres,apellidos:$apellidos,id_especialidad:$id_especialidad,dni:$dni,sexo:$sexo,direccion:$direccion,telefono:$telefono,correo:$correo,estado:$estado,opcion:$opcion,fec_crea:$fec_crea,user_crea:$user_crea},function(data){    
		if(data==1){
			if($opcion==1){
		      $("#IdTituloTrabajador").text("Datos Insertados Correctamente ..");
			  $("#MensajeTrabajador").show("slow");
			  CancelarTrabajador();
			  }
			if($opcion==2){
		      $("#IdTituloTrabajador").text("Datos Modificados Correctamente ..");
			  $("#MensajeTrabajador").show("slow");
			  CancelarTrabajador();
			  }  
		      LimpiarTrabajador(); 
		      $("input").attr("disabled",true);	 
              $("select").attr("disabled",true);
			
		}else{
		 if($opcion==1){
		      $("#IdTituloTrabajador").text("No se pudo Insertar Correctamente ..");
			  }
		 if($opcion==2){
		      $("#IdTituloTrabajador").text("No se pudo Modificar Correctamente ..");
			  }	
		      $("#MensajeTrabajador").fadeIn();	
		 
			}
		
	   })
   }

 
 
 function SalirTrabajador(){
   $("#DivTrabajador").hide("slow");	
 } 
  /*function CancelarBuscarTrabajador(){
   $("#DivBuscarTrabajadores").hide("slow");	
 }         */