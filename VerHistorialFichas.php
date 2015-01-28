<script src="LIBRERIAS/JS/VerHistorialFichas.js"></script>
<div class="cerrar"><img src="LIBRERIAS/IMAGENES/close.png" onClick="javascript:$('#DivVerHistorialFichas').hide(1000)"/></div>
<table class="cTabla">
	<tr><td colspan="3"><div class="titulo">&nbsp;&nbsp;&nbsp;HISTORIAL FICHAS</div></td></tr>
	<tr><td style="width:20%; text-align:right">Paciente : </td>
		<td width="30%"><input type="text"  id="IdPacienteHF" size="45" placeholder=" Paciente" readonly  class="cajaTexto"/></td>
		<td style="text-align:left"><button class="btnGeneral" onClick="javascript:$('#DivBuscarHFPac').show(1000);$('#IdBusHFPac').focus();$('#CuerpoBusHFPac').html('')">Buscar</button></td>
	</tr>
	<tr><td colspan="3"><table id="TablaHisFichas" border="1" bordercolor='#006A00'>
			<thead>
  			<tr><th>N&deg;</th>
    			<th>FECHA</th>
    			<th>ESTADO</th>
    			<th>INHABILITAR</th>
    			<th>VER FICHA</th>
  			</tr>    
			</thead>
			<tbody id="CuerpoHF"></tbody>
			</table></td>
    </tr>
</table>
<!--<input type="hidden" id="IdOpcionHF" />-->

<div id="DivBuscarHFPac" class="Buscar">
<input type="hidden" id="IdNumFilaHF"  />
    <input type="hidden" id="CanBusHF"  />
    <!--<input type="hidden" id='IdHidenPac'/>-->
<div class="cerrar"><img src="LIBRERIAS/IMAGENES/close.png" onClick="javascript:$('#DivBuscarHFPac').hide(1000)"/></div>
<table class="cTabla">
	<tr><td colspan="3"><div class="titulo"><img src="LIBRERIAS/IMAGENES/logo_sg.jpg" width="39" height="39" align="middle"/> &nbsp;&nbsp;&nbsp;BUSCAR PACIENTE</div></td>
    	</tr>
	<tr><td>Paciente</td>
		<td><input type="text" placeholder=" Paciente .." Id='IdBusHFPac' size="40" class="cajaTexto"></td>
        <td>&nbsp;</td></tr>
    <tr><td colspan="3"><table id="TablaBusHFPac" border="1" bordercolor='#c5dbec'>
			<thead>
  				<tr>
    			<th>N&deg;</th>
    			<th>PACIENTE</th>
    			<th>DNI</th>
  				</tr>
			</thead>
			<tbody id="CuerpoBusHFPac"></tbody>
		</table></td></tr>
	<tr><td width="10">&nbsp;</td>
    	<td align="right"><button class="btnGeneral" onclick="javascript:SeleccionarBusquedaHF()">Aceptar</button></td>
        <td><button class="btnGeneral" onclick="javascript:$('#DivBuscarHFPac').hide(1000)">Cancelar</button></td></tr>
        </table>
</div>

<div id="IdMensajeHF" class="Ventana">
<input type="hidden" id="IdHidenFicha" />
<br /><br />
Esta Seguro de Inhabilitar Ficha .. ?<br /><br />
<center><input type="button" value="SI" onclick="javascript:InhabilitarHF();" />&nbsp;&nbsp;&nbsp;
<input type="button" value="NO" onclick="javascript:$('#IdMensajeHF').hide(1000)" /></center><br />
</div>