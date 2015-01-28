// JavaScript Document
	var idexamen = 0  
	var opcion=0
	var can = 0
	var variable=0
$(document).ready(function() {
	
   $("input[type='text'],textarea").css({"background-color":"#E6FFF2"});
				$('#IdTablaTipoExamen').fixheadertable({ 
							//caption : "", 
							colratio : [40,240], 
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
			
			   
 function PintarFila($num_fila){
	   $("table tbody tr").css({background:"#FFFFFF"});
	   $("#"+$num_fila).css({background:"#E6FFF2", cursor:"pointer"});
	   idexamen=$("#"+$num_fila).attr("idexamen")
	  variable=$num_fila
  }  		   
		
 
			   
 function NuevoTipoExamen(){
	 opcion=1
	    $("select").css({"background-color":"#FFFFFF"});
	    $("input[type='text'],textarea").css({"background-color":"#FFFFFF"});
	  $("#IdCodigoTipoExamen").attr("disabled",true);	
   $("#IdExamen").attr("disabled",false);
  $("#estado").attr("disabled",false);
  $("#IdValorNormalTipoExamen").attr("disabled",false);
       $("#IdGrupoNuevo").removeClass("btnNuevo").addClass("btnDeshabilitarNuevo").attr("disabled",false);
   $("#IdUsuGrabar").removeClass("btnDeshabilitarGrabar").addClass("btnGrabar").attr("disabled",false);
   $("#IdGrupoCancelar").removeClass("btnDeshabilitarCancelar").addClass("btnCancelar").attr("disabled",false);
   $("#IdGrupoBuscar").removeClass("btnBuscar").addClass("btnDeshabilitarBuscar").attr("disabled",false);
   $("#IdGrupoEliminar").removeClass("btnDeshabilitarEliminar").addClass("btnEliminar").attr("disabled",false);
    $.post('CONTROLADOR/Ctipo_examen.php',{accion:'GENERARID'},function(data){
	  //   alert(data);
	  	idexamen=data
		$("#IdCodigoTipoExamen").val(data);
		})
    
 }
 function GrabarRegistrarPaciente(){
	   
	   
 	 codigo=$("#IdCodigoTipoExamen").val()
	 examen=$("#IdExamen").val()
	 valornormal=$("#IdValorNormalTipoExamen").val()
	 estado=$("#estado").val()
if(examen=="") {$("#IdExamen").focus();alert("Llene");return false;}
if(valornormal=="") {$("#IdValorNormalTipoExamen").focus();alert("Llene");return false} 
	 $.post('CONTROLADOR/Ctipo_examen.php',{
		 accion:'GRABAR',
		 codigo:codigo,
		 opcion:opcion,
		 examen:examen,
		 valornormal:valornormal,
		 estado:estado
 	 },function(data){
	 
	   if(data){
			
			if(opcion==1){alert("Guardo Ok")
			CancelarTipoExamen()
			}
		 if(opcion==2){alert("Modifico Ok")
		 CancelarTipoExamen()
		 }
		 }
		}) 
	 
   }
   
   function eliminar(){
	   	 
   var $id=$("#IdCodigoTipoExamen").val();
   $.post('CONTROLADOR/Ctipo_examen.php',{accion:'ELIMINAR',id:$id},function(data){
		if(data==1){
		 alert("Elimino")
		 
		 CancelarTipoExamen();
		}else{
		alert("No se Elimino")
	 	
			}
		
	 })
   LimpiarUsuario();
	   }
 function CancelarTipoExamen(){
	 $("input[type='text'],textarea,select").val("")
    $("input[type='text'],textarea,select").attr("disabled",true);
 
   $("input[type='text'],textarea,select").css({"background-color":"#E6FFF2"});	
   
 
     $("#IdGrupoNuevo").removeClass("btnDeshabilitarNuevo").addClass("btnNuevo").attr("disabled",false);
   $("#IdUsuGrabar").removeClass("btnGrabar").addClass("btnDeshabilitarGrabar");
   $("#IdGrupoCancelar").removeClass("btnCancelar").addClass("btnDeshabilitarCancelar");
   $("#IdGrupoBuscar").removeClass("btnDeshabilitarBuscar").addClass("btnBuscar").attr("disabled",false);
   $("#IdGrupoEliminar").removeClass("btnEliminar").addClass("btnDeshabilitarEliminar");
   }
   
   
    $("#IdBusquedaTipoE").keypress(function(e){
	  if(e.keyCode==13){
		  
		  $("#IdBusquedaTipoE").blur();
		  RealizaBusquedaUsuario();
		  
		  }   
	  })
   
   
   
   
    function RealizaBusquedaUsuario(){
	var $usuario=$("#IdBusquedaTipoE").val(); 
	
	$("#CuerpoTipoExamen").html("<tr><td colspan='4'><img src='LIBRERIAS/IMAGENES/cargando.gif' /> Cargando ..</td></tr>");
	$.post('CONTROLADOR/Ctipo_examen.php',{accion:'LISTAR',usuario:$usuario},function(data){//alert(data);exit;
		 var $data=data.split("///");
		 
		 if($data[0]==0){
			 can=0;
			 $("#CuerpoTipoExamen").html("<tr><td colspan='2'>No hay resultados ..</td></tr>"); 
		 
			 }else {
		can=$data[0] ;
		 $("#CuerpoTipoExamen").html($data[1]);
		 PintarFila(1)}
		 
		 })
 
  }
   
 function BuscarTipoExamen(){
	$("#IdBusquedaTipoE").css({"background-color":"#FFFFFF"});
	$("#DivBuscarTipoExamenes").show("slow"); 
	$("#IdBusquedaTipoE").attr("disabled",false);	
	$("#CuerpoTipoExamen").html()
	$("#IdBusquedaTipoE").focus()
	$("#IdBusquedaTipoE").val("")
	$("#CuerpoTipoExamen").html("")
	
   }
 function EliminarTipoExamen(){
	 
   }
 function SalirTipoExamen(){
	 $(document).off("keydown");
	 
   $("#DivTipoExamen").hide("slow");	
 } 
  function CancelarBuscarTipoExamen(){
   $("#DivBuscarTipoExamenes").hide("slow");	
 }         
 
 
 
 
 function SeleccionarBusquedaUsuario(){
	 opcion=2
	 idexamen=$("#"+variable).attr("idexamen")
	  $("#DivBuscarTipoExamenes").hide("slow");
		   
		 $("input,textarea").attr("disabled",false);	
		 $("#IdCodigoTipoExamen").attr("disabled",true);	
		 $("select").attr("disabled",false);		
		  $("input,textarea,select").css({"background-color":"#FFFFFF"});
		 $.post('CONTROLADOR/Ctipo_examen.php',{accion:'LLENAR_FORM',idusuario:idexamen},function(data){
			 var datos=eval(data);
			 $.each(datos,function(index,columna){
				  $("#IdCodigoTipoExamen").val(columna.id);
	              $("#IdExamen").val(columna.examen);
	     $("#IdValorNormalTipoExamen").val(columna.valornormal);
	              $("#estado").val(columna.estado);
	              
			   });
		  })
		   $("#IdGrupoNuevo").attr("disabled",true);
          $("#IdUsuGrabar").attr("disabled",false);
          $("#IdGrupoCancelar").attr("disabled",false);
          $("#IdGrupoBuscar").attr("disabled",true);	
          $("#IdGrupoEliminar").attr("disabled",false);
		  $("#IdGrupoNuevo").removeClass("btnNuevo").addClass("btnDeshabilitarNuevo");
          $("#IdUsuGrabar").removeClass("btnDeshabilitarGrabar").addClass("btnGrabar");
          $("#IdGrupoCancelar").removeClass("btnDeshabilitarCancelar").addClass("btnCancelar");
          $("#IdGrupoBuscar").removeClass("btnBuscar").addClass("btnDeshabilitarBuscar");
          $("#IdGrupoEliminar").removeClass("btnDeshabilitarEliminar").addClass("btnEliminar");
	 
	 }
 
 
 
 
 
  $(document).keydown(function(e){
	  
	  
	  
	 if (e.keyCode == 13) {
        
            if ($("#IdBusquedaTipoE").is(":focus")) {
                 
            } else {
				//alert(can)
                if (can == 0) {
                    $("#IdBusquedaTipoE").focus()
                } else {
                    SeleccionarBusquedaUsuario()
                    //CancelarBuscarTurno2()
                    return false
                }
            }
         
	   }
	  
	  
	  
	  
	  
	  
           if (e.keyCode==40) {
			      var $num_fila=variable;
				  var $tr=$num_fila+1;
				  $can = can;
				  if($num_fila<$can){
					$("#"+$num_fila).css({background:"#FFFFFF"});  
			        $("#"+$tr).css({background:"#E6FFF2"});
				     variable=$tr ;
			       }
			}
			if (e.keyCode==38) {
			       var $num_fila=variable;
				  var $tr=$num_fila-1;
				  if($num_fila>1){
					$("#"+$num_fila).css({background:"#FFFFFF"});  
			        $("#"+$tr).css({background:"#E6FFF2"});
				     variable=$tr ;
			       }
			}
   })