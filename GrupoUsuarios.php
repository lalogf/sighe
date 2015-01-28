<?php session_start();
	require_once("CADO/ClaseGrupoUsuario.php");
	$ogrupousuario= new GrupoUsuarios();
?>
<!--<script src="LIBRERIAS/JS/Validar.js" type="text/javascript"></script>-->
<script src="LIBRERIAS/JS/GrupoUsuarios.js" type="text/javascript"></script>

<div class="cerrar"><img src="LIBRERIAS/IMAGENES/close.png" onClick="javascript:SalirGrupoUsuario()" alt="Cerrar"/></div>
<table class="cTabla">
	<tr>
	<td colspan="4"><div class="titulo">&nbsp;&nbsp;&nbsp;GRUPO DE USUARIO</div>
    <hr /></td>
	</tr>
	<tr><td width="2%">&nbsp;</td>
    	<td width="30%" style="text-align:right">C&oacute;digo :</td>
    	<td colspan="2">
        <input type="text" id="IdCodigoGrupoUsuario" disabled="disabled" readonly="readonly" onkeypress="return validar1(event,'numeros');" class="cajaTexto1"/></td>
    </tr>
    <tr><td width="2%">&nbsp;</td>
    	<td style="text-align:right">Nombre de grupo(*) : </td>
    	<td colspan="2">
        <input type="text" id="IdNombreGrupo" disabled="disabled" onkeypress="return validar1(event,'letra');" class="cajaTexto2"/></td>
    </tr>     
    <tr><td width="2%">&nbsp;</td>
    	<td style="text-align:right">Estado : </td>
    	<td colspan="2">
        	<select disabled="disabled" id="IdEstadoGrupoUsuario" class="combo">
            	<option value="1">HABILITADO</option>
                <option value="0">DESHABILITADO</option>
            </select>
        </td>
    </tr>                
    <tr><td colspan="4"><hr /></td></tr>
    <tr><td colspan="4" style="text-align:center">Fec. Crea. : <span id="IdGrupFecCrea"> <?php echo date("d/m/Y")?> </span>
    &nbsp;&nbsp;&nbsp;&nbsp; Crea. User : <span id="IdGrupUserCrea"><?php echo $_SESSION['S_user']?></span></td></tr>
	<tr><td colspan="4"><hr /></td></tr>
    <tr><td colspan="4">
    <div class="BotonesMantenimiento">
		<button id="IdGrupoNuevo" onClick="javascript:NuevoGrupoUsuario()" class="btnNuevo"></button>
		<button disabled id="IdGrupoGrabar" class="btnDeshabilitarGrabar" onclick="javascript:GrabarGrupoUsuario()"></button>
		<button id="IdGrupoCancelar" onClick="javascript:CancelarGrupoUsuario()" class="btnDeshabilitarCancelar"></button>
		<button id="IdGrupoBuscar" onClick="javascript:BuscarGrupoUsuario()" class="btnBuscar"></button>
		<button disabled id="IdGrupoEliminar" class="btnDeshabilitarEliminar" onclick="javascript:EliminarGrupoUsuario();"></button>
		<button id="IdGrupoSalir" onClick="javascript:SalirGrupoUsuario()" class="btnSalir"></button>
	</div></td></tr>
</table>
<input type="hidden" id="IdOpcionGrupoUsuario" />
<div id="DivBuscarGrupoUsuarios" class="Buscar">	
  <div class="cerrar"><img src="LIBRERIAS/IMAGENES/close.png" onClick="javascript:CancelarBuscarGrupoUsuario()" alt="Cancelar Buscar Usuario"/></div><div class="clear"></div>
  <input type="hidden" id="IdNumFilaGrupoUsuario"  />
    <input type="hidden" id="CanBusGrupoUsuario"  />
	<table class="cTabla">
	    <tr><td colspan="3"><!--<div class="titulo"><img src="LIBRERIAS/IMAGENES/logo_sg.jpg" width="39" height="39" align="middle"/> &nbsp;&nbsp;&nbsp;BUSCAR GRUPO DE USUARIO</div>--></td></tr>
    	<tr>
        	<td width="20%">&nbsp;&nbsp; Grupo :</td>
        	<td><input type="text" placeholder=" Grupo .." size="30" id="IdBusquedaGrupoUsuario" onkeypress="return validar1(event,'letra');" class="cajaTexto"></td>
        	<td>
          <button class="btnGeneral" onclick="javascript:RealizaBusquedaGrupoUsuario()">Buscar</button></td>
        </tr>
        <tr><td colspan="3">
        		 <table id="IdTablaGrupoUsuario" border="1" bordercolor='#006A00'>
	 				<thead>
       				 	<th>N&deg;</th>
                        <th>Nombre</th>
                        <th>Estado</th>                        
    				</thead>
    				<tbody id="CuerpoGrupoUsuario">
                          					       					
     				</tbody>
   				 </table>
        	</td>
        </tr>
        <tr>
        	<td width="10">&nbsp;</td>
            <td align="right"><button class="btnGeneral" onclick="javascript:SeleccionarBusquedaGrupoUsuario()">Aceptar</button></td>
            <td><button class="btnGeneral" onclick="javascript:$('#DivBuscarGrupoUsuarios').hide('slow')">Cancelar</button></td>
        </tr>
    </table>       
</div>
<div id="MensajeGrupoUsuario" class="Ventana"  style="width:60%; height:60%" >
 <div class="cerrar"><img src="LIBRERIAS/IMAGENES/close.png" onClick="javascript:$('#MensajeGrupoUsuario').hide(500);" alt="Salir"/></div>
 <p><strong style="color:#FFF; font-size:20px"> &nbsp;&nbsp;&nbsp;&nbsp; Mensaje </strong></p><hr />
 <table  border="0" align="center" height="60%" width="90%" bgcolor="#FFFFFF" class="redon">
    <tr>
       <td><p>&nbsp;&nbsp;&nbsp;<span id="IdTituloGrupoUsuario" style="color:#006A00; font-size:16px"></span></p></td>
    </tr>
    
    <tr>
       <td align="center"><button onclick="javascript:$('#MensajeGrupoUsuario').hide('slow')" class="btnGeneral">Aceptar</button></td>
    </tr>
 </table>
</div>