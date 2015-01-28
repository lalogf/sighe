<?php
  session_start();
  session_destroy();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SIGHE</title>
<link href="LIBRERIAS/ESTILOS/Estilos.css" rel="stylesheet" type="text/css" />
<script src="LIBRERIAS/JS/jquery-1.7.1.min.js"></script>
<!--<script language="Javascript">
  function disableselect(e){
    return false
   }
  function reEnable(){
   return true
   }
document.onselectstart=new Function ("return false")
if (window.sidebar){
document.onmousedown=disableselect
document.onclick=reEnable
}
// End
</script>-->
<script>
   function ApuntarFoco(){
	 $user=$("#IdUsuario").focus();  
	   }
  function Loguearse(){
	  //alert("hola");exit;
	var $user=$("#IdUsuario").val();
	var $pass=$("#IdContrasenia").val();
	if($user==""){
		$("#DivMensaje").show(500);
		$("#TituloMensaje").text("Ingrese Usuario ..");$("#IdUsuario").focus();exit;
		}
	if($pass==""){
		$("#DivMensaje").show(500);
		$("#TituloMensaje").text("Ingrese Contraseña ..");$("#IdContrasenia").focus();exit;
		}
	//alert($user);exit;	
	$.post('CONTROLADOR/Cusuario.php',{accion:'LOGUEARSE',user:$user,pass:$pass},function(data){
		//alert(data);exit;
		if(data==0){
			$("#DivMensaje").show(500);
			$("#TituloMensaje").text("Usuario o Contraseña Incorrectos ..");$("#IdUsuario").focus();exit;
		 }
		 if(data==1){
			location.href='Panel.php';
		 }
	  })
  }
  
   function CerrarMensaje(){
	  $("#DivMensaje").hide("slow"); 
	  
	 }
</script>
</head>

<body onload="javascript:ApuntarFoco()">
<!-- <img src="LIBRERIAS/IMAGENES/login.png" class="fondo"/> -->
<div style="background-image:url(LIBRERIAS/IMAGENES/index.png);width:895px;height:500px;margin:5% auto; padding:0px; border-radius:10px; box-shadow:5px 5px 20px #000;">
	<div style="height:180px;">&nbsp;</div>
    <div style="float:right;width:260px;margin-right:20px;"><p><span style="font-weight:bold;color:#00F; text-align:center">ACCESO AL SISTEMA</span></p>
    </div>
    <div class="clear"></div>
    <div style="float:right;width:350px;margin-right:20px;text-align:left;">
    	<p style="color:#060; font-weight:bold">Usuario:<br />
        <input type="text" id="IdUsuario" placeholder=" Ingrese Usuario .."  class="cajaTexto" size="40"/><br /><br />
        Contrase&ntilde;a<br />
        <input type="password" id="IdContrasenia" placeholder=" Ingrese su contraseña" class="cajaTexto" size="40"/><br /><br />
        <button onclick="javascript:Loguearse()" class="entrar">Ingresar</button></p>
    </div>
</div>
<!--<table class="tablafija">
	<tr>
	<td colspan="2"><div class="titulo"><img src="LIBRERIAS/IMAGENES/logo_sg.jpg" width="39" height="39" align="middle"/> &nbsp;&nbsp;&nbsp;ACCESO AL SISTEMA</div>
    <hr /></td>
	</tr>
	<tr><td width="40">&nbsp;</td><td><b>Usuario:</b></td></tr>
    <tr><td width="40">&nbsp;</td><td><input type="text" id="IdUsuario" placeholder="Introduzca su nombre de usuario."  class="cajaTexto" size="40"/></td></tr>
    <tr><td width="40">&nbsp;</td><td><b>Contrase&ntilde;a:</b></td></tr>
    <tr><td width="40"></td><td><input type="password" id="IdContrasenia" placeholder="Ingrese su contraseña de la cuenta."class="cajaTexto" size="40"/></td></tr>
    <tr><td colspan="2"><hr /></td></tr>
    <tr><td colspan="2" align="center"><button onclick="javascript:Loguearse()" class="entrar">Ingresar</button></td>    
</table>-->

<div id="DivMensaje" style="display:none; width:20%; height:30%" class="mensajeError" >
<div class="cerrar"><img src="LIBRERIAS/IMAGENES/close.png" onClick="javascript:$('#DivMensaje').hide(500);" alt="Salir"/></div>
 <p><strong style="color:#FFF; font-size:20px"> &nbsp;&nbsp;&nbsp;&nbsp; Mensaje de error</strong></p><hr />
 <table  border="0" align="center" height="60%" width="90%" bgcolor="#FFFFFF" class="redon">
    <tr>
       <td><p>&nbsp;&nbsp;&nbsp;<span id="TituloMensaje" style="color:#006A00; font-size:20px"></span></p></td>
    </tr>
    
    <tr>
       <td align="center"><button onclick="javascript:CerrarMensaje()" class="entrar">Entrar</button></td>
    </tr>
 </table>
</div>
</body>
</html>