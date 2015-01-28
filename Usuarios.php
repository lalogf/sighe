<?php session_start();
   require_once('CADO/ClaseUsuario.php'); 
   $ousuario=new Usuarios();
?>

<!--<script src="LIBRERIAS/JS/Validar.js" type="text/javascript"></script>-->
<script src="LIBRERIAS/JS/Usuarios.js" type="text/javascript"></script>

<div class="cerrar"><img src="LIBRERIAS/IMAGENES/close.png" onClick="javascript:SalirUsuario()" alt="Salir"/></div>
<table class="cTabla">
	<tr>
	<td colspan="4"><div class="titulo">&nbsp;&nbsp;&nbsp;USUARIO DE LA EMPRESA</div>
    <hr /></td>
	</tr>
	<tr><td width="2%">&nbsp;</td>
    	<td width="20%" style="text-align:right">C&oacute;digo :</td>
    	<td colspan="2">
        <input type="text" disabled="disabled" readonly="readonly" id="IdCodigoUsuario" class="cajaTexto1"/></td>
    </tr>
    <tr><td width="2%">&nbsp;</td>
    	<td style="text-align:right">DNI : </td>
    	<td colspan="2"><input type="text" disabled="disabled" id="IdDniUsuario" maxlength="8"  class="cajaTexto2"/></td>
    </tr>
    <tr><td width="2%">&nbsp;</td>
    	<td style="text-align:right">Apellidos : </td>
    	<td colspan="2"><input type="text" disabled="disabled" id="IdApellidosUsuario" class="cajaTexto2" /></td>
    </tr>
    <tr><td width="2%">&nbsp;</td>
    	<td style="text-align:right">Nombres : </td>
    	<td colspan="2"><input type="text" disabled="disabled" id="IdNombresUsuario"  class="cajaTexto2" /></td>
    </tr>    
    <tr><td width="2%">&nbsp;</td>
    	<td style="text-align:right">Grupo : </td>
    	<td colspan="2">
        	<select id="IdGrupoUsuario" disabled="disabled" class="combo">
        		<?php $listar=$ousuario->ListarGrupos();
				   while($fila=$listar->fetch()){?>
				     <option value="<?php echo $fila[0]?>"><?php echo $fila[1]?></option>	   
			  <?php }
				?>
            </select></td>
    </tr>    
    <tr><td width="2%">&nbsp;</td>
    	<td style="text-align:right">Login : </td>
    	<td colspan="2" width="57%"><input type="text" disabled="disabled" id="IdLoginUsuario" class="cajaTexto2"/></td>
    </tr>
    <tr><td width="2%">&nbsp;</td>
    	<td style="text-align:right">Clave de usuario : </td>
    	<td colspan="2"><input type="password" disabled="disabled" id="IdpassUsuario" class="cajaTexto2"/></td>
    </tr>
    <tr><td width="2%">&nbsp;</td>
    	<td style="text-align:right">Estado : </td>
    	<td colspan="2">
        	<select id="IdEstadoUsuario" disabled="disabled" class="combo">
        		<option value="1">HABILITADO</option>
                <option value="0">DESHABILITADO</option>
            </select>
        </td>      
    </tr>
    <tr><td colspan="4"><hr /></td></tr>
    <tr>
      <td colspan="4" style="text-align:center">Fec. Crea.: <span id="IdUsuFecCrea"> <?php echo date("d/m/Y")?> </span>
    &nbsp;&nbsp;&nbsp;&nbsp; Crea. User : <span id="IdUsuUserCrea"><?php echo $_SESSION['S_user']?></span></td></tr>
	<tr><td colspan="4"><hr /></td></tr>
    <tr><td colspan="4">
    <div class="BotonesMantenimiento">
		<button id="IdUsuNuevo" onClick="javascript:NuevoUsuario()" class="btnNuevo"></button>
		<button disabled id="IdUsuGrabar" class="btnDeshabilitarGrabar" onclick="javascript:GrabarUsuario()"></button>
		<button id="IdUsuCancelar" onClick="javascript:CancelarUsuario()" class="btnDeshabilitarCancelar"></button>
		<button id="IdUsuBuscar" onClick="javascript:BuscarUsuario()" class="btnBuscar"></button>
		<button disabled id="IdUsuEliminar" class="btnDeshabilitarEliminar" onClick="javascript:EliminarUsuario()"></button>
		<button id="IdUsuSalir" onClick="javascript:SalirUsuario()" class="btnSalir"></button>        
	</div></td></tr>
</table>
<input type="hidden" id="IdOpcionUsuario" />
<div id="DivBuscarUsuarios" class="Buscar">	
	<div class="cerrar"><img src="LIBRERIAS/IMAGENES/close.png" onClick="javascript:CancelarBuscarUsuario()" alt=""/></div><div class="clear"></div>
    <input type="hidden" id="IdNumFilaUsu"  />
    <input type="hidden" id="CanBusUsu"  />
	<table class="cTabla">
	    <tr><td colspan="3"><div class="titulo"><img src="LIBRERIAS/IMAGENES/logo_sg.jpg" width="39" height="39" align="middle"/> &nbsp;&nbsp;&nbsp;BUSCAR USUARIO DEL SISTEMA</div></td>
        </tr>
    	<tr><td>Usuario:</td>
        	<td><input type="text" placeholder=" Usuario .." size="30" id="IdBusquedaUsu"  class="cajaTexto"></td>
        	<td><button class="btnGeneral" onclick="javascript:RealizaBusquedaUsuario()">Buscar</button></td>
        </tr>
        <tr><td colspan="3">
        		 <table id="IdTablaUsuario" border="1" bordercolor='#006A00'>
	 				<thead>
       				 	<tr><th width="70">N&deg;</th>
                        <th>Apellidos</th>
                        <th>Nombres</th>
                        <th>DNI</th>
                        <th>Activo</th></tr>
    				</thead>
    				<tbody id="CuerpoUsuario">
     				</tbody>
   				 </table>
        	</td>
        </tr>
        <tr>
        	<td width="10">&nbsp;</td>
            <td align="right"><button class="btnGeneral" onclick="javascript:SeleccionarBusquedaUsuario()">Aceptar</button></td>
            <td><button class="btnGeneral" onClick="javascript:CancelarBuscarUsuario()">Cancelar</button></td>
        </tr>
    </table>       
</div>
<div id="MensajeUsuario" class="Ventana" style="width:58%; height:50%"  >
   <div class="cerrar"><img src="LIBRERIAS/IMAGENES/close.png" onClick="javascript:$('#MensajeUsuario').hide(500);" alt="Salir"/></div>
 <p><strong style="color:#FFF; font-size:20px"> &nbsp;&nbsp;&nbsp;&nbsp; Mensaje </strong></p><hr />
 <table  border="0" align="center" height="60%" width="90%" bgcolor="#FFFFFF" class="redon">
    <tr>
       <td><p>&nbsp;&nbsp;&nbsp;<span id="IdTituloUsuario" style="color:#006A00; font-size:16px"></span></p></td>
    </tr>
    
    <tr>
       <td align="center"><button onclick="javascript:$('#MensajeUsuario').hide('slow')" class="btnGeneral">Aceptar</button></td>
    </tr>
 </table>
   
</div>