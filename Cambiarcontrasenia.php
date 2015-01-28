<!--<script src="LIBRERIAS/JS/Validar.js"></script>-->
<script src="LIBRERIAS/JS/CambiarContra.js"></script>

<div class="cerrar"><img src="LIBRERIAS/IMAGENES/close.png" onClick="javascript:Salir()"/></div>
<table class="cTabla">
	<tr>
	<td colspan="4"><div class="titulo">&nbsp;&nbsp;&nbsp;CAMBIAR CONTRASE&Ntilde;A</div>
    <hr /></td>
	</tr>
	<tr>
	  <td>&nbsp;</td>
	  <td width="161">Contrase&ntilde;a Actual:</td>
	  <td colspan="2"><input type="password" id="ca" size="30"   class="cajaTexto"/></td>
  </tr>
	<tr><td width="20">&nbsp;</td>
    	<td width="161">Cambiar Contrase&ntilde;a :</td>
    	<td width="268" colspan="2"><input type="password" id="c1" size="30"  class="cajaTexto"/></td>
        
    </tr>
    <tr><td width="20">&nbsp;</td>
    	<td>Repita Contraseña :</td>
    	<td colspan="2"><input type="password" id="c2" size="30"  class="cajaTexto"/></td>
    </tr>
    <tr></tr>
	<tr><td colspan="4" height="2"><hr /></td>
    <tr><td colspan="4">
    <div class="BotonesMantenimiento">
		<button id="IdMedNuevo" onClick="javascript:registrar()" class="btnNuevo">&nbsp;</button>
		 
		<button id="IdMedSalir" onClick="javascript:Salir()" class="btnSalir">&nbsp;</button>
	</div></td></tr>
</table>

<div id="MensajeCambiarContra" class="Ventana"  style="width:60%; height:72%" >
 <div class="cerrar"><img src="LIBRERIAS/IMAGENES/close.png" onClick="javascript:$('#MensajeCambiarContra').hide(500);" alt="Salir"/></div>
 <p><strong style="color:#FFF; font-size:20px"> &nbsp;&nbsp;&nbsp;&nbsp; Mensaje </strong></p><hr />
 <table  border="0" align="center" height="60%" width="90%" bgcolor="#FFFFFF" class="redon">
    <tr>
       <td><p>&nbsp;&nbsp;&nbsp;<span id="IdTituloCambiarContra" style="color:#006A00; font-size:16px"></span></p></td>
    </tr>
    
    <tr>
       <td align="center"><button onclick="javascript:$('#MensajeCambiarContra').hide('slow')" class="btnGeneral">Aceptar</button></td>
    </tr>
 </table>
</div>