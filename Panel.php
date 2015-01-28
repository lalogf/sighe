<?php session_start();
     if(!isset($_SESSION['S_user'])){
		header("location:index.php");
		}
require_once("CONTROLADOR/Cpermisos.php");
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SIGHE</title>
<link href="LIBRERIAS/ESTILOS/Estilos.css" rel="stylesheet" type="text/css" />
<link href="LIBRERIAS/PLUGINS/TABLA/base.css" rel="stylesheet" type="text/css" />
<link href="LIBRERIAS/PLUGINS/TABLA/redmond/jquery-ui-1.8.4.custom.css" rel="stylesheet" type="text/css" />
<!--<link href="LIBRERIAS/menu/menu.css" rel="stylesheet" type="text/css" />
-->
<!--<script src="LIBRERIAS/JS/MoverDiv.js"></script>-->
<script src="LIBRERIAS/jquery/js/jquery-1.7.1.min.js" type="text/javascript"></script>
<script src="LIBRERIAS/PLUGINS/TABLA/jquery-ui-1.8.18.custom.min.js" type="text/javascript"></script>
<script src="LIBRERIAS/PLUGINS/TABLA/jquery.fixheadertable.js" type="text/javascript"></script>

<script src="LIBRERIAS/jquery/development-bundle/ui/jquery.ui.core.js"></script>
<script src="LIBRERIAS/jquery/development-bundle/ui/jquery.ui.widget.js"></script>
<script src="LIBRERIAS/jquery/development-bundle/ui/jquery.ui.button.js"></script>
<script src="LIBRERIAS/jquery/development-bundle/ui/jquery.ui.position.js"></script>
<script src="LIBRERIAS/jquery/development-bundle/ui/jquery.ui.draggable.js"></script>
<script src="LIBRERIAS/jquery/development-bundle/ui/jquery.ui.datepicker.js"></script>


<!--<script src="LIBRERIAS/menu/menu.js"></script>
-->

<script type="text/javascript">
	$(document).ready(function(e) {
		$("#ui-datepicker-div").hide();
		$("#Reporte1_FecIni,#Reporte1_FecFin").datepicker(
			        {
					 changeMonth: true,
			         changeYear: true
					   }
				);
		
        $('#DivUsuario,#DivGrupoUsuario,#DivTurno,#DivEspecialidad,#DivTrabajador,#DivSucursal,#DivCambiarcontrasenia,#DivMedicamento,#DivTipoExamen,#DivPermiso,#DivRegistrarPaciente,#DivRegistrarIngresoPaciente,#DivRegistrarOrdenLaboratorio,#DivPacienteHemodialisis,#DivVerHistorialFichas,#DivAsignar,#VentanaReporte1').draggable();
    });
 function LimpiarDivs(){	 
	 $("#DivTurno").html(""); $("#DivUsuario").html(""); $("#DivEspecialidad").html(""); $("#DivSucursal").html("");
	 $("#DivTrabajador").html("");$("#DivMedicamento").html("");$("#DivTipoExamen").html("");$("#DivGrupoUsuario").html(""); $("#DivPermiso").html("");$("#DivRegistrarPaciente").html("");$("#DivRegistrarIngresoPaciente").html("");$("#DivRegistrarOrdenLaboratorio").html("");$("#DivPacienteHemodialisis").html("");$("#DivVerHistorialFichas").html("");$("#DivAsignar").html("");$("#VentanaReporte1").html("");$("#DivCambiarcontrasenia").html("");	 
	 
	 $("#DivTurno").hide(); $("#DivUsuario").hide(); $("#DivEspecialidad").hide(); $("#DivSucursal").hide();
	 $("#DivTrabajador").hide(); $("#DivMedicamento").hide();$("#DivTipoExamen").hide(); $("#DivGrupoUsuario").hide();
	 $("#DivPermiso").hide();$("#DivRegistrarPaciente").hide();$("#DivRegistrarIngresoPaciente").hide();$("#DivRegistrarOrdenLaboratorio").hide();
	 $("#DivPacienteHemodialisis").hide();$("#DivVerHistorialFichas").hide();$("#DivAsignar").hide();$("#VentanaReporte1").hide();$("#DivCambiarcontrasenia").hide();
	 $("#DivVerHistorialProtocolos").hide();
	 }

 function VentanaUsuario(){
	// LimpiarDivs();
	 
	 $.post('Usuarios.php',{},function(data){
		 $("#DivUsuario").html(data);
		 $("#DivUsuario").show(); 
	   })
	 }
 function VentanaGrupoUsuario(){
	 //LimpiarDivs();
	 $.post("GrupoUsuarios.php",{},function(data){
		 $("#DivGrupoUsuario").html(data);
		 $("#DivGrupoUsuario").show();
		 })
	 }
 
 function VentanaTurno(){
	 //LimpiarDivs();
	 $.post('Turnos.php',{},function(data){
		 $("#DivTurno").html(data);
		 $("#DivTurno").show();
		 })
	 }
 function VentanaEspecialidad(){
	 //LimpiarDivs();
	 
	 $.post('Especialidades.php',{},function(data){
		 $("#DivEspecialidad").html(data);
		 $("#DivEspecialidad").show();
		 })
	 }
 function VentanaSucursal(){
	// LimpiarDivs();
	 $.post('Sucursales.php',{},function(data){
		 $("#DivSucursal").html(data);
		 $("#DivSucursal").show();
		 })
	 }
 function VentanaTrabajador(){
	// LimpiarDivs();
	 $.post('Trabajadores.php',{},function(data){
		 $("#DivTrabajador").html(data);
		 $("#DivTrabajador").show();
		 })
	 }
 function VentanaMedicamento(){
	 //LimpiarDivs();
	 
	 $.post("Medicamentos.php",{},function(data){
		 $("#DivMedicamento").html(data);
		 $("#DivMedicamento").show();
		 })
	 }
	 
 function VentanaTipoExamen(){
	 LimpiarDivs();
	 $("#DivTipoExamen").show();
	 $.post("TipoExamenes.php",{},function(data){
		 $("#DivTipoExamen").html(data);
		 })
	 }
 function MostrarAsignar(){
	 //LimpiarDivs();
	
	 $.post("Asignacion.php",{},function(data){
		 $("#DivAsignar").html(data);
		  $("#DivAsignar").show();
		 })
	 }
	 
 function VentanaPermiso(){
	 //LimpiarDivs();
	 $.post("Permisos.php",{},function(data){
		 $("#DivPermiso").html(data);
		 $("#DivPermiso").show();
		 })
	 }
 function VentanaRegistrarPaciente(){
	 //LimpiarDivs();
	 $.post("RegistrarPacientes.php",{},function(data){
		 $("#DivRegistrarPaciente").html(data);
		 $("#DivRegistrarPaciente").show();
		 //
	   })
	   
	 }
 function VentanaRegistrarOrdenLaboratorio(){
	 //LimpiarDivs();
	 
	 $.post("RegistrarOrdenLaboratorios.php",{},function(data){
		 $("#DivRegistrarOrdenLaboratorio").html(data);
		 $("#DivRegistrarOrdenLaboratorio").show();
		 })
	 }
 function VentanaPacienteHemodialisis(){
	 //LimpiarDivs();
	
	 $.post("PacienteHemodialisis.php",{},function(data){
		 $("#DivPacienteHemodialisis").html(data);
		  $("#DivPacienteHemodialisis").show();
		 })	 
	 } 	 

 function VentanaHistorialFichas(){
	 //LimpiarDivs();
	 $.post("VerHistorialFichas.php",{},function(data){
		 $("#DivVerHistorialFichas").html(data);
		 $("#DivVerHistorialFichas").show();
		 })
	 }
 function VentanaHistorialProtocolos(){
	// LimpiarDivs();
	  $("#IdBtnHPro").show();
	  $("#IdPacienteHPro").val("");
	 $.post("VerHistorialProtocolos.php",{},function(data){
		 $("#IdNumFilaHPro").val(1);
		 $("#DivVerHistorialProtocolos").html(data);
		 $("#DivVerHistorialProtocolos").show();
		 })
	 }	 
 
 function VentanaOrdenLab(){
	 //LimpiarDivs();
	 $.post("ExamenLaboratorio.php",{},function(data){
		 $("#DivRegistrarOrdenLaboratorio").html(data);
		 $("#DivRegistrarOrdenLaboratorio").show();
		})
	 }
 function VentanaCambiarContrasena(){
	 $.post("Cambiarcontrasenia.php",{},function(data){
		 $("#DivCambiarcontrasenia").html(data);
		 $("#DivCambiarcontrasenia").show();
		 })
	 }

  /*function cargar(){
	  $.post('CONTROLADOR/Cusuario.php',{accion:'LISTAR'},function(data){
		 $("#CuerpoUser").html(data);
		 })
	  }	*/ 	 
	 
	function VerFichaAtencion(){
    window.open('PdfFichaAtencion.php?id=dormi',"VerFicha", "top=150,left=200,menubar=no,location=no,status=no,resizable=no,scrollbars=no,width=600,height=400,toolbar=no"); 
	  }
	function VerFichaProtocoloHemodialisis(){
    window.open('PdfProtocoloHemodialisis.php?id=dormi',"VerFicha", "top=150,left=200,menubar=no,location=no,status=no,resizable=no,scrollbars=no,width=600,height=400,toolbar=no"); 
	  } 
	function PdfReporte1(){
	 var $inicio=$("#Reporte1_FecIni").val();
	 var $fin=$("#Reporte1_FecFin").val();
 window.open('PdfPacientesAtendidos.php?inicio='+$inicio+'&fin='+$fin,"PacientesAtendidos", "top=150,left=200,menubar=no,location=no,status=no,resizable=no,scrollbars=no,width=600,height=400,toolbar=no"); 
	}	
	function DesaperecerDivsGen(){
		 $("#IdGen").hide(1000); 
		 $("#IdAtencion").hide(1000); 
		 $("#IdConfiguracion").hide(1000); 
		 $("#IdLaboratorio").hide(1000); 
		 $("#IdReportes").hide(1000); 
		}
	function AparecerDivGen(){
		DesaperecerDivsGen();
		$("#IdGen").show(1000);
		//$("#IdCuerpoPa").removeClass("CuerpoPanel_1").addClass("CuerpoPanel");
		}
	function AparecerConfiguracion(){
		  DesaperecerDivsGen();
		 $("#IdConfiguracion").show(1000); 
		 //$("#IdCuerpoPa").removeClass("CuerpoPanel").addClass("CuerpoPanel_1");
		}		
	function AparecerAtencion(){
		  DesaperecerDivsGen();
		 $("#IdAtencion").show(1000); 
		} 	 	 
	function AparecerLaboratorio(){
		  DesaperecerDivsGen();
		 $("#IdLaboratorio").show(1000); 
		}
	function AparecerReportes(){
		  DesaperecerDivsGen();
		 $("#IdReportes").show(1000); 
		}
    function CerrarSesion(){
		location.href="CerrarSesion.php";
	   }		
</script>
</head>
<body>
<img class="fondo" src="LIBRERIAS/IMAGENES/login.png" alt=""/>
<div id="DivTurno" class="Ventana"></div>
<div id="DivUsuario" class="Ventana"></div>
<div id="DivEspecialidad" class="Ventana"></div>
<div id="DivSucursal" class="Ventana"></div>
<div id="DivTrabajador" class="Ventana"></div>
<div id="DivMedicamento" class="Ventana"></div>
<div id="DivTipoExamen" class="Ventana"></div>
<div id="DivGrupoUsuario" class="Ventana"></div>
<div id="DivPermiso" class="VentanaPermiso"></div>
<div id="DivRegistrarPaciente" class="VentanaTabs"></div>
<div id="DivRegistrarIngresoPaciente" class="Ventana"></div>
<div id="DivRegistrarOrdenLaboratorio" class="VentanaExamenLaboratorio"></div>
<div id="DivPacienteHemodialisis" class="VentanaTabs"></div>
<div id="DivVerHistorialFichas" class="VentanaAtencion"></div>
<div id="DivVerHistorialProtocolos" class="VentanaProtocolo"></div>
<div id="DivAsignar" class="VentanaAsignar"></div>
<div id="DivCambiarcontrasenia" class="Ventana"></div>

<div id="VentanaReporte1" class="Ventana"><span style="color:#FFF; font-weight:bold; font-size:14px;">&nbsp;&nbsp;&nbsp;Reporte - Atenci&oacute;n al Paciente</span>
<div class="cerrar"><img src="LIBRERIAS/IMAGENES/close.png" onClick="javascript:$('#VentanaReporte1').hide(1000)"/></div> <br />
 <table class="cTabla">
    <tr>
    <td align="right">Inicio&nbsp;&nbsp;<input type="text" id="Reporte1_FecIni" class="cajaTexto"/></td>
    <td width="20">&nbsp;&nbsp;&nbsp;</td>
    <td>Fin &nbsp;&nbsp;<input type="text" id="Reporte1_FecFin" class="cajaTexto" /></td>
    <td>&nbsp;&nbsp;&nbsp;</td>
    <td><button class="btnGeneral" id="Reporte1_Calcular" onclick="javascript:PdfReporte1();" >Generar</button></td>
    </tr>
    <tr height="40"> <td colspan="5">&nbsp;&nbsp;&nbsp;</td></tr>
 </table>
 <br />
</div>

<div id="ContornoPanel" class="ContornoPanel">
	<div class="Superior-Inferior">
    <div class="SuperiorIzquierda"><p>BIENVENIDO : &nbsp;&nbsp;<img src="LIBRERIAS/IMAGENES/usuario.jpg" width="20" height="15" alt="Usuario"/> <?php echo $_SESSION['S_user'];?></p></div>
    <div class="SuperiorDerecha"><p>SUCURSAL : &nbsp;&nbsp;<?php echo $_SESSION['S_sucursal'];?></p></div><div class="clear"></div>
    </div>
    <div class="CuerpoPanel">
    	<div id="IdGen">
         <fieldset><legend><b>&nbsp;&nbsp; Panel &nbsp;&nbsp;</b></legend>
         
       <? if(permiso(1)){ ?><div class="imagenTotal" onclick="javascript:AparecerConfiguracion();">
            	<img src="LIBRERIAS/IMAGENES/configuraciones.png" width="100%" height="25%" alt="Configuración" /></div><?  } ?>
                
            <? if(permiso(2)){ ?> <div class="imagenTotal" onclick="javascript:AparecerAtencion();">
            	<img src="LIBRERIAS/IMAGENES/atencion.png" width="100%" height="25%" alt="Atención" /></div><?  } ?>
                
            <? if(permiso(3)){ ?> <div class="imagenTotal" onclick="javascript:AparecerLaboratorio();">
            	<img src="LIBRERIAS/IMAGENES/laboratorio.png" width="100%" height="25%" alt="Laboratorio" /></div> <?  } ?>           
           <? if(permiso(4)){ ?>  <div class="imagenTotal" onclick="javascript:VentanaPermiso();">
            	<img src="LIBRERIAS/IMAGENES/permisos.png" width="100%" height="25%" alt="Permisos" /></div>
                 <div class="clear"></div><?  } ?>
          <? if(permiso(5)){ ?>  <div class="imagenTotal" onclick="javascript:AparecerReportes();">
            	<img src="LIBRERIAS/IMAGENES/reportes.png" width="100%" height="25%" alt="Reportes" /></div><?  } ?>
            <div class="imagenTotal" onclick="javascript:CerrarSesion()">
            	<img src="LIBRERIAS/IMAGENES/cerrar.png" width="100%" height="25%" alt="Cerrar Sesión" /></div>
         </fieldset>
    	</div>        
        <div id="IdConfiguracion" style="display:none">
         <fieldset><legend><b>&nbsp;&nbsp; Configuraci&oacute;n: &nbsp;&nbsp;</b></legend>
          <? if(permiso(6)){ ?> 	<div class="imagenTotal" onclick="javascript:VentanaUsuario();">
            	<img src="LIBRERIAS/IMAGENES/usu.png" width="100%" height="25%" alt="Usuario"/></div><?  } ?>
           <? if(permiso(7)){ ?>   <div class="imagenTotal" onclick="javascript:VentanaGrupoUsuario();">
            	<img src="LIBRERIAS/IMAGENES/grupo_usuario.png" width="100%" height="25%" alt="Grupo Usuario"/></div><?  } ?>
          <? if(permiso(8)){ ?>    <div class="imagenTotal" onclick="javascript:VentanaTurno();">
            	<img src="LIBRERIAS/IMAGENES/turnos.png" width="100%" height="25%" alt="Turnos"/></div><?  } ?>
           <? if(permiso(9)){ ?>   <div class="imagenTotal" onclick="javascript:VentanaEspecialidad();">
            	<img src="LIBRERIAS/IMAGENES/especialidad.png" width="100%" height="25%" alt="Especialidades"/></div><div class="clear"></div><?  } ?>
           <? if(permiso(10)){ ?>   <div class="imagenTotal" onclick="javascript:VentanaTrabajador();">
            	<img src="LIBRERIAS/IMAGENES/trabajador.png" width="100%" height="25%" alt="Trabajador"/></div><?  } ?>
          <? if(permiso(11)){ ?>    <div class="imagenTotal" onclick="javascript:VentanaSucursal();">
            	<img src="LIBRERIAS/IMAGENES/sucursal.png" width="100%" height="25%" alt="Sucursal"/></div><?  } ?>
             <div class="imagenTotal" onclick="javascript:VentanaCambiarContrasena();">
            	<img src="LIBRERIAS/IMAGENES/contrasenia.png" width="100%" height="25%" alt="Sucursal"/></div>
             <div class="imagenTotal" onclick="javascript:AparecerDivGen();">
            	<img src="LIBRERIAS/IMAGENES/regresar.png" width="100%" height="25%" alt="Ir al panel"/></div>
            <div class="clear"></div>
          </fieldset>
         </div>         
        <div id="IdAtencion" style="display:none">
         <fieldset><legend><b>&nbsp;&nbsp; Atenci&oacute;n: &nbsp;&nbsp;</b></legend>            
        	<? if(permiso(12)){ ?><div class="imagenTotal" onclick="javascript:VentanaRegistrarPaciente();">
            	<img src="LIBRERIAS/IMAGENES/registrar.png" width="100%" height="25%" alt="Registar Paciente"/></div><?  } ?>
          <? if(permiso(13)){ ?>  <div class="imagenTotal" onclick="javascript:MostrarAsignar();">
            	<img src="LIBRERIAS/IMAGENES/asignar-turno.png" width="100%" height="25%" alt="Asignar Turno"/></div><?  } ?>
          <? if(permiso(14)){ ?>  <div class="imagenTotal" onclick="javascript:VentanaPacienteHemodialisis();">
            	<img src="LIBRERIAS/IMAGENES/protocolo.png" width="100%" height="25%" alt="Protocolo"/></div><?  } ?>
          <? if(permiso(15)){ ?>  <div class="imagenTotal" onclick="javascript:VentanaHistorialProtocolos();">
            	<img src="LIBRERIAS/IMAGENES/historial-protocolo.png" width="100%" height="25%" alt="Historial Protocolo"/></div><div class="clear"></div><?  } ?>
           <? if(permiso(16)){ ?> <div class="imagenTotal" onclick="javascript:VentanaHistorialFichas();">
            	<img src="LIBRERIAS/IMAGENES/historial-fichas.png" width="100%" height="25%" alt="Historial Fichas"/></div><?  } ?>
            <div class="imagenTotal" onclick="javascript:AparecerDivGen();">
            	<img src="LIBRERIAS/IMAGENES/regresar.png" width="100%" height="25%" alt="Ir a Panel"/></div>
            <div class="clear"></div>
         </fieldset>
        </div>
        <div id="IdLaboratorio" style="display:none">
         <fieldset><legend><b>&nbsp;&nbsp; Laboratorio &nbsp;&nbsp;</b></legend>
        <? if(permiso(17)){ ?>	<div class="imagenTotal" onclick="javascript:VentanaMedicamento();">
            	<img src="LIBRERIAS/IMAGENES/medicamentos.png" width="100%" height="25%" alt="Medicamentos"/></div><? } ?>
       <? if(permiso(18)){ ?>     <div class="imagenTotal" onclick="javascript:VentanaTipoExamen();">
            	<img src="LIBRERIAS/IMAGENES/examen.png" width="100%" height="25%" alt="Tipo de Examén"/></div><? } ?>
        <? if(permiso(19)){ ?>    <div class="imagenTotal" onclick="javascript:VentanaOrdenLab();">
            	<img src="LIBRERIAS/IMAGENES/laboratorio.png" width="100%" height="25%" alt="Laboratorio"/></div><? } ?>
            <div class="imagenTotal" onclick="javascript:AparecerDivGen();">
            	<img src="LIBRERIAS/IMAGENES/regresar.png" width="100%" height="25%" alt="Ir al Panel"/></div>
            <div class="clear"></div>
         </fieldset>
        </div>
        <div id="IdReportes" style="display:none">
         <fieldset><legend><b>&nbsp;&nbsp; Reportes &nbsp;&nbsp;</b></legend>
            <div class="imagenTotal"><a href="#" onclick="javascript:$('#VentanaReporte1').show(1000);">
            	<img src="LIBRERIAS/IMAGENES/reporte1.png" width="100%" height="25%" alt="Reporte 1"/></a></div>
            <div class="imagenTotal"><a href="#">
            	<img src="LIBRERIAS/IMAGENES/reporte2.png" width="100%" height="25%" alt="Reporte 2"/></a></div>
            <div class="imagenTotal"><a href="#">
            	<img src="LIBRERIAS/IMAGENES/reporte3.png" width="100%" height="25%" alt="Reporte 3"/></a></div>
            
            <div class="imagenTotal" onclick="javascript:AparecerDivGen();">
            	<img src="LIBRERIAS/IMAGENES/regresar.png" width="100%" height="25%" alt="Ir al Panel"/></div>
            <div class="clear"></div>
         </fieldset> 
        </div>
    </div>
    <div class="clear"></div>
    <div class="Superior-Inferior">
    <div class="InferiorIzquierda"><p>Empresa de Desarrollo " SOFTMASTER "<br />CEL: #978120430</p></div>
    <div class="InferiorDerecha"><p>SIGHE V.1.0<br />Sistema de Gesti&oacute;n de Hemodialisis.</p></div>
    <div class="clear"></div>
    </div>
</div>
</body>
</html>