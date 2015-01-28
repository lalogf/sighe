$(document).ready(function() {  	
$("#ca").focus()



})

 function Salir(){
   $("#DivCambiarcontrasenia").hide("slow");	
 } 
 
 
function  registrar(){
var ca=$("#ca").val()
var c1=$("#c1").val()
var c2=$("#c2").val()
if(ca.length<1){
	$("#IdTituloCambiarContra").text("Ingrese Clave Anterior ..");
	$("#MensajeCambiarContra").fadeIn(); 
	$("#ca").focus();return false;exit;
	}
	$.post('CONTROLADOR/Cusuario.php', {
		    accion: 'VALIDAR',ca:ca,c1:c1 
        }, function (data) {
			 
			if(data==2){
				$("#IdTituloCambiarContra").text("Contraseña Actual Incorrecta ..");
	            $("#MensajeCambiarContra").fadeIn(); 
				return false;
				
				}
	
if(c1.length<4){
	$("#IdTituloCambiarContra").text("Contraseña muy corta ..");
	$("#MensajeCambiarContra").fadeIn();
	$("#c1").focus();return false;
	}

	if(c1==c2){}else {
		$("#IdTituloCambiarContra").text("Las contraseñas no son iguales ..");
	    $("#MensajeCambiarContra").fadeIn();
		return false;
		}		
			
		$.post('CONTROLADOR/Cusuario.php', {
		    accion: 'CAMBIAR',ca:ca,c1:c1 
        }, function (data) {
 			if(data==1){
				$("#IdTituloCambiarContra").text("Contraseña Cambio Correctamente ..");
	            $("#MensajeCambiarContra").fadeIn();exit;
				}else {
				$("#IdTituloCambiarContra").text("Error:no modifico correctamente ..");
	            $("#MensajeCambiarContra").fadeIn();exit;
					}
		})		
		})
	
	}
 
 
 function limpiar(){
	if (!(confirm("desea reestablecer"))) return false;
	 if($("#dia").val()==""||$("#fecha").val()==""||$("#cboturno").val()=="" ){; return false;}
	 $.post('CONTROLADOR/Casignar.php', {
		    accion: 'LIMPIAR',
			fecha : $("#fecha").val(),
			turno : $("#cboturno").val()
        }, function (data) {
			cargarLista()
		})
	 
	}