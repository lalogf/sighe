<?php session_start();
   require_once('CADO/ClaseTurno.php'); 
   $oturno=new Turnos();
?>
<script src="LIBRERIAS/JS/Validar.js"></script>
<script src="LIBRERIAS/JS/Turnos.js"></script>

<div class="cerrar"><img src="LIBRERIAS/IMAGENES/close.png" onClick="javascript:SalirTurno()" alt="Salir"/></div>
<table class="cTabla">
	<tr>
	<td colspan="4"><div class="titulo">&nbsp;&nbsp;&nbsp;TURNOS DE ATENCI&Oacute;N</div>
    <hr /></td>
	</tr>
	<tr><td width="2%">&nbsp;</td>
    	<td width="30%" style="text-align:right">C&oacute;digo : </td>
        <td colspan="2">
        	<input type="text" id="IdCodigo"  class="cajaTexto1" readonly="readonly" />
        </td>
    </tr>
    <tr><td width="2%">&nbsp;</td>
    	<td style="text-align:right">Turno : </td>
    	<td colspan="2"><input type="text" id="IdTurno" disabled="disabled" class="cajaTexto2"/></td>
    </tr>
    <tr><td width="2%">&nbsp;</td>
    	<td style="text-align:right">Estado : </td>
        <td colspan="2">
   			<select id="IdTurEstado" disabled="disabled" class="combo">
      			<option value="1">HABILITADO</option>
      			<option value="0">DESHABILITADO</option>
   			</select>
    <tr><td colspan="4"><hr /></td></tr>
    <tr><td colspan="4" style="text-align:center">Fec. Crea. : <span id="IdTurFecCrea"> <?php echo date("d/m/Y")?> </span>
	&nbsp;&nbsp;&nbsp;&nbsp; Crea. User : <span id="IdTurUserCrea"><?php echo $_SESSION['S_user']?></span></td></tr>
	<tr><td colspan="4"><hr /></td>
    <tr><td colspan="4">
    <div class="BotonesMantenimiento">
		<button id="IdTurNuevo" onClick="javascript:NuevoTurno()" class="btnNuevo"></button>
		<button disabled id="IdTurGrabar" class="btnDeshabilitarGrabar" onclick="javascript:GrabarTurno()"></button>
		<button id="IdTurCancelar" onClick="javascript:CancelarTurno()" class="btnDeshabilitarCancelar"></button>
		<button id="IdTurBuscar" onClick="javascript:BuscarTurno()" class="btnBuscar"></button>
		<button disabled id="IdTurEliminar" class="btnDeshabilitarEliminar" onclick="javascript:EliminarTurno()"></button>
		<button id="IdTurSalir" onClick="javascript:SalirTurno()" class="btnSalir"></button>
	</div></td></tr>
</table>
<input type="hidden" id="IdOpcion" />
<div id="DivBuscarTurnos" class="Buscar">	
	<div class="cerrar"><img src="LIBRERIAS/IMAGENES/close.png" onClick="javascript:CancelarBuscarTurno()" alt="Cancelar Buscar Turno"/></div><div class="clear"></div>
    <input type="hidden" id="IdNumFilaTur"  />
    <input type="hidden" id="CanBusTur"  />
    
	<table class="cTabla">
	    <tr><td colspan="3"><div class="titulo"><img src="LIBRERIAS/IMAGENES/logo_sg.jpg" width="39" height="39" align="middle"/> &nbsp;&nbsp;&nbsp;BUSCAR TURNO DE ATENCI&Oacute;N</div></td></tr>
    	<tr><td width="18%">&nbsp;&nbsp;Turno :</td>
        	<td><input type="text" placeholder=" Turno .." size="30" id="IdBusquedaTur"></td>
        	<td><button class="btnGeneral" onclick="javascript:RealizaBusqueda();">Buscar</button></td>
        </tr>
        <tr><td colspan="3">
        		 <table id="IdTablaTurno" border="1" bordercolor='#006A00'>
	 				<thead>
       				 	<th width="70">N&deg;</th>
        				<th>Turno</th>
    				</thead>
    				<tbody id="IdCuerpoBusTur"></tbody>
   				 </table>
        	</td>
        </tr>
        <tr>
        	<td width="10">&nbsp;</td>
            <td align="right"><button class="btnGeneral" onclick="javascript:SeleccionarBusqueda()">Aceptar</button></td>
            <td><button class="btnGeneral" onClick="javascript:CancelarBuscarTurno()">Cancelar</button></td>
        </tr>
    </table>       
</div>

<div id="MensajeTurno" class="Ventana" style="width:60%; height:60%"  >
   <div class="cerrar"><img src="LIBRERIAS/IMAGENES/close.png" onClick="javascript:$('#MensajeTurno').hide(500);" alt="Salir"/></div>
 <p><strong style="color:#FFF; font-size:20px"> &nbsp;&nbsp;&nbsp;&nbsp; Mensaje </strong></p><hr />
 <table  border="0" align="center" height="60%" width="90%" bgcolor="#FFFFFF" class="redon">
    <tr>
       <td><p>&nbsp;&nbsp;&nbsp;<span id="IdTitulo" style="color:#006A00; font-size:16px"></span></p></td>
    </tr>
    
    <tr>
       <td align="center"><button onclick="javascript:$('#MensajeTurno').hide('slow')" class="btnGeneral">Aceptar</button></td>
    </tr>
 </table>
   
</div>

<!--<div id="MensajeTurno" class="Ventana">
 <span id="IdTitulo"></span><br />
   <input type="image" src="LIBRERIAS/IMAGENES/aceptar2.png" onclick="javascript:$('#MensajeTurno').hide('slow')">
</div>-->