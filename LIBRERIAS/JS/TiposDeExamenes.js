// JavaScript Document
$(document).ready(function() {  	

				$('#IdTablaUsuario').fixheadertable({ 
							//caption : "", 
							colratio : [40, 170, 100, 50,60], 
							height : 200, 
							width :425, 
							zebra : true, 
							sortable : false, 
							sortedColId : 3, 
							dateFormat : 'm/d/Y',
							pager : false,
							rowsPerPage	 : 10,
							resizeCol : true
						});
			   }); 
 function NuevoUsuario(){
   $("input[type='text']").attr("disabled",false);
   $("select").attr("disabled",false);
   $("#IdpassUsuario").attr("disabled",false);
   $("input[type='text']").css({"background-color":"#FFFFFF"});
   $("#IdpassUsuario").css({"background-color":"#FFFFFF"});
   $("#IdUsuNuevo").attr("disabled",true);
   $("#IdUsuGrabar").attr("disabled",false);
   $("#IdUsuCancelar").attr("disabled",false);
   $("#IdUsuBuscar").attr("disabled",true);	
   $("#IdTurEliminar").attr("disabled",true);
   $("#IdUsuNuevo").removeClass("btnNuevo").addClass("btnDeshabilitarNuevo");
   $("#IdUsuGrabar").removeClass("btnDeshabilitarGrabar").addClass("btnGrabar");
   $("#IdUsuCancelar").removeClass("btnDeshabilitarCancelar").addClass("btnCancelar");
   $("#IdUsuBuscar").removeClass("btnBuscar").addClass("btnDeshabilitarBuscar");
   $("#IdUsuEliminar").removeClass("btnEliminar").addClass("btnDeshabilitarEliminar");
   $("#IdOpcionUsuario").val(1);
   $.post('CONTROLADOR/Cusuario.php',{accion:'GENERARID'},function(data){
		$("#IdCodigoUsuario").val(data);
		})
   LimpiarUsuario();
 }
 function GrabarUsuario(){
	$("#IdTituloUsuario").text("");
    var $codigo=$("#IdCodigoUsuario").val(); 
	var $nombres=$("#IdNombresUsuario").val();
	var $apellidos=$("#IdApellidosUsuario").val();
	var $dni=$("#IdDniUsuario").val();
	var $login=$("#IdLoginUsuario").val();
	var $pass=$("#IdpassUsuario").val();
	var $estado=$("#IdEstadoUsuario").val();
	var $grupo_usuario=$("#IdGrupoUsuario").val();
	var $fec_crea=$("#IdUsuFecCrea").text();
	var $user_crea=$("#IdUsuUserCrea").text();
	var $opcion=$("#IdOpcionUsuario").val();
	 if($nombres==""){
		 $("#IdTituloUsuario").text("Ingrese Nombres ..");
		 $("#MensajeUsuario").fadeIn();$("#IdNombresUsuario").focus(); exit;
		 }
	$.post('CONTROLADOR/Cusuario.php',{accion:'GRABAR',codigo:$codigo,nombres:$nombres,apellidos:$apellidos,dni:$dni,login:$login,pass:$pass,estado:$estado,fec_crea:$fec_crea,user_crea:$user_crea,grupo_usuario:$grupo_usuario,opcion:$opcion},function(data){//alert(data);exit;
		if(data==1){
			if($opcion==1){
		      $("#IdTituloUsuario").text("Datos Insertados Correctamente ..");
			  }
			if($opcion==2){
		      $("#IdTituloUsuario").text("Datos Modificados Correctamente ..");
			  }  
		      $("#MensajeUsuario").fadeIn();
		      LimpiarUsuario(); 
		      $("#IdEstadoUsuario").attr("disabled",true);	 
              $("#IdCodigoUsuario").attr("disabled",true);
		      CancelarUsuario();
			
		}else{
		 if($opcion==1){
		      $("#IdTitulo").text("No se pudo Insertar Correctamente ..");
			  }
		 if($opcion==2){
		      $("#IdTitulo").text("No se pudo Modificar Correctamente ..");
			  }	
		      $("#MensajeUsuario").fadeIn();	
		 
			}
		
	 })
	
	
   }
   
  function RealizaBusquedaUsuario(){
	var $usuario=$("#IdBusquedaUsu").val(); 
	$("#CuerpoUsuario").html("<tr><td colspan='4'><img src='LIBRERIAS/IMAGENES/cargando.gif' /> Cargando ..</td></tr>");
	$.post('CONTROLADOR/Cusuario.php',{accion:'LISTAR',usuario:$usuario},function(data){//alert(data);exit;
		 var $data=data.split("///");
		 if($data[0]==0){
			 $("#CuerpoUsuario").html("<tr><td colspan='4'>No hay resultados ..</td></tr>");exit;
			 }
		 $("#CanBusUsu").val($data[0]);
		 $("#CuerpoUsuario").html($data[1]);
		 $("#IdNumFilaUsu").val(1)
		 })
	exit;	 
  }
   
 function CancelarUsuario(){
   $("input[type='text']").attr("disabled",true);
   $("select").attr("disabled",true);
   $("input[type='text']").css({"background-color":"#98CBCB"});	
   $("#IdpassUsuario").attr("disabled",false);
   $("input[type='text']").css({"background-color":"#FFFFFF"});
   $("#IdUsuNuevo").attr("disabled",false);
   $("#IdUsuGrabar").attr("disabled",true);
   $("#IdUsuCancelar").attr("disabled",true);
   $("#IdUsuBuscar").attr("disabled",false);	
   $("#IdUsuEliminar").attr("disabled",true); 
   $("#IdUsuNuevo").removeClass("btnDeshabilitarNuevo").addClass("btnNuevo");
   $("#IdUsuGrabar").removeClass("btnGrabar").addClass("btnDeshabilitarGrabar");
   $("#IdUsuCancelar").removeClass("btnCancelar").addClass("btnDeshabilitarCancelar");
   $("#IdUsuBuscar").removeClass("btnDeshabilitarBuscar").addClass("btnBuscar");
   $("#IdUsuEliminar").removeClass("btnEliminar").addClass("btnDeshabilitarEliminar");
   }
 function BuscarUsuario(){
	$("#IdBusquedaUsu").attr("disabled",false);
    $("#IdBusquedaUsu").css({"background-color":"#FFFFFF"});
    
	$("#DivBuscarUsuarios").show(); 
	$("#IdBusquedaUsu").val("");
	$("#IdBusquedaUsu").focus(); 
	$("#CuerpoUsuario").html(""); 
   }
 function EliminarUsuario(){
	 $("#IdTituloUsuario").text(""); 
   var $id=$("#IdCodigoUsuario").val();
   $.post('CONTROLADOR/Cusuario.php',{accion:'ELIMINAR',id:$id},function(data){
		if(data==1){
		 $("#IdTituloUsuario").text("Datos Eliminados Correctamente ..");
		 $("#MensajeUsuario").fadeIn();
		 CancelarUsuario();
		}else{
		$("#IdTituloUsuario").text("No se pudo Eliminar Correctamente ..");
		 $("#MensajeUsuario").fadeIn();	
			}
		
	 })
   LimpiarUsuario();
  }
 function LimpiarUsuario(){
   $("#IdCodigoUsuario").val("");	
   $("#IdDniUsuario").val("");
   $("#IdApellidosUsuario").val("");
   $("#IdNombresUsuario").val("");
   $("#IdLoginUsuario").val("");
   $("#IdpassUsuario").val("");
   $("#IdGrupoUsuario option[value='1']").attr("selected",true);
   $("#IdEstadoUsuario option[value='1']").attr("selected",true);
 }  
   
 function SalirUsuario(){
   $("#DivUsuario").html("");		 		 	
   $("#DivUsuario").hide("slow");	
   LimpiarUsuario();
 } 
  function CancelarBuscarUsuario(){
   $("#DivBuscarUsuarios").hide("slow");
   $("input").val("");
   LimpiarUsuario();	
 }         
 
 
 function SeleccionarBusquedaUsuario(){
		  $("#IdOpcionUsuario").val(2);
		 var $fila=$("#IdNumFilaUsu").val();
		 var $idusuario=$("#"+$fila).attr("idusuario");//alert($idturno);exit;
		 $("#DivBuscarUsuarios").hide("slow");
		 $("input").attr("disabled",false);	
		 $("select").attr("disabled",false);	
		 $("input").css({"background-color":"#FFFFFF"});
         
		 $.post('CONTROLADOR/Cusuario.php',{accion:'LLENAR_FORM',idusuario:$idusuario},function(data){
			 var datos=eval(data);
			 $.each(datos,function(index,columna){
				  $("#IdCodigoUsuario").val(columna.id);
	              $("#IdNombresUsuario").val(columna.nombres);
	              $("#IdApellidosUsuario").val(columna.apellidos);
	              $("#IdDniUsuario").val(columna.dni);
	              $("#IdLoginUsuario").val(columna.user);
                  $("#IdpassUsuario").val(columna.pass);
				  $("#IdGrupoUsuario option[value="+columna.id_grupo_usuario+"]").attr("selected",true);
				  $("#IdEstadoUsuario option[value="+columna.estado+"]").attr("selected",true);
			   });
		  })
		  
		  $("#IdUsuNuevo").attr("disabled",true);
          $("#IdUsuGrabar").attr("disabled",false);
          $("#IdUsuCancelar").attr("disabled",false);
          $("#IdUsuBuscar").attr("disabled",true);	
          $("#IdUsuEliminar").attr("disabled",false);
		  $("#IdUsuNuevo").removeClass("btnNuevo").addClass("btnDeshabilitarNuevo");
          $("#IdUsuGrabar").removeClass("btnDeshabilitarGrabar").addClass("btnGrabar");
          $("#IdUsuCancelar").removeClass("btnDeshabilitarCancelar").addClass("btnCancelar");
          $("#IdUsuBuscar").removeClass("btnBuscar").addClass("btnDeshabilitarBuscar");
          $("#IdUsuEliminar").removeClass("btnDeshabilitarEliminar").addClass("btnEliminar");
	  }
 
 
 $(document).keydown(function(e){
           if (e.keyCode==40) {
			      var $num_fila=parseInt($("#IdNumFilaUsu").val());
				  var $tr=$num_fila+1;
				  $can=parseInt($("#CanBusUsu").val());
				  if($num_fila<$can){
					$("#"+$num_fila).css({background:"#FFFFFF"});  
			        $("#"+$tr).css({background:"#c5dbec"});
				    $("#IdNumFilaUsu").val($tr);
			       }
			}
			if (e.keyCode==38) {
			      var $num_fila=parseInt($("#IdNumFilaUsu").val());
				  var $tr=$num_fila-1;
				  if($num_fila>1){
					$("#"+$num_fila).css({background:"#FFFFFF"});  
			        $("#"+$tr).css({background:"#c5dbec"});
				    $("#IdNumFilaUsu").val($tr);
			       }
			}
   })
   
   $("#IdBusquedaUsu").keypress(function(e){
	  if(e.keyCode==13){
		  
		  $("#IdBusquedaUsu").blur();
		  RealizaBusquedaUsuario();
		  
		  }   
	  })
	  
	function PintarFila($num_fila){
	   $("table tbody tr").css({background:"#FFFFFF"});
	   $("#"+$num_fila).css({background:"#c5dbec", cursor:"pointer"});
	   $("#IdNumFilaUsu").val($num_fila);
	 }  