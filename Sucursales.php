<?php session_start();?>

<script src="LIBRERIAS/JS/Sucursales.js"></script>

<div class="cerrar"><img src="LIBRERIAS/IMAGENES/close.png" onClick="javascript:SalirSucursal()" alt="Salir"/></div>
<table class="cTabla">
	<tr>
	<td colspan="4"><div class="titulo">&nbsp;&nbsp;&nbsp;SUCURSAL DE LA EMPRESA</div>
    <hr /></td>
	</tr>
	<tr><td width="2%">&nbsp;</td>
    	<td width="30%" style="text-align:right">C&oacute;digo :</td>
    	<td colspan="2"><input type="text" id="IdCodigoSucursal" disabled="disabled" readonly="readonly"  class="cajaTexto1"/></td>        
    </tr>
    <tr><td width="2%">&nbsp;</td>
    	<td style="text-align:right">Ruc. : </td>
    	<td colspan="2"><input type="text" id="IdRucSucursal" disabled="disabled" maxlength="11"  class="cajaTexto2"/></td>
    </tr>
    <tr><td width="2%">&nbsp;</td>
    	<td style="text-align:right">Razon Social : </td>
    	<td colspan="2"><input type="text" id="IdRazonSocialSucursal" disabled="disabled"  class="cajaTexto2" /></td>
    </tr>
    <tr><td width="2%">&nbsp;</td>
    	<td style="text-align:right">Direccion : </td>
    	<td colspan="2"><input type="text" id="IdDireccionSucursal" disabled="disabled"  class="cajaTexto2" /></td>
    </tr>    
    <tr><td width="2%">&nbsp;</td>
    	<td style="text-align:right">Responsable : </td>
    	<td colspan="2"><input type="text" id="IdResponsableSucursal" disabled="disabled"  class="cajaTexto2" /></td>    
    </tr>
    <tr><td width="2%">&nbsp;</td>
    	<td style="text-align:right">Sobrenombre : </td>
    	<td colspan="2"><input type="text" id="IdSobrenombreSucursal" disabled="disabled"  class="cajaTexto2" /></td>
    </tr>
    <tr><td width="2%">&nbsp;</td>
    	<td style="text-align:right">Estado : </td>
    	<td colspan="2">
        	<select id="IdEstadoSucursal" disabled="disabled" class="combo">
            	<option value="1">HABILITADO</option>
                <option value="0">DESHABILITADO</option>
            </select>
        </td>
    </tr>                
    <tr><td colspan="4"><hr /></td></tr>
    <tr><td colspan="4" style="text-align:center">Fec. Crea. : <span id="IdSucuFecCrea"> <?=date("d/m/Y")?> </span>
    &nbsp;&nbsp;&nbsp;&nbsp; Crea. User. : <span id="IdSucuUserCrea"><?=$_SESSION['S_user']?></span></td></tr>
	<tr><td colspan="4"><hr /></td>
    <tr><td colspan="4">
    <div class="BotonesMantenimiento">
		<button id="IdSucNuevo" onClick="javascript:NuevoSucursal()" class="btnNuevo"></button>
		<button disabled id="IdSucGrabar" class="btnDeshabilitarGrabar" onclick="javascript:GrabarSucursal()"></button>
		<button id="IdSucCancelar" onClick="javascript:CancelarSucursal()" class="btnDeshabilitarCancelar"></button>
		<button id="IdSucBuscar" onClick="javascript:BuscarSucursal()" class="btnBuscar"></button>
		<button disabled id="IdSucEliminar" class="btnDeshabilitarEliminar" onclick="javascript:EliminarSucursal()"></button>
		<button id="IdSucSalir" onClick="javascript:SalirSucursal()" class="btnSalir"></button>
	</div></td></tr>
</table>
<input type="hidden" id="IdOpcionSucursal" />
<div id="DivBuscarSucursales" class="Buscar">	
 <input type="hidden" id="IdNumFilaSucursal"  />
    <input type="hidden" id="CanBusSucursal"  />
	<div class="cerrar"><img src="LIBRERIAS/IMAGENES/close.png" onclick="javascript:$('#DivBuscarSucursales').hide('slow')"/></div><div class="clear"></div>
	<table class="cTabla">
	    <tr><td colspan="3"><div class="titulo"><img src="LIBRERIAS/IMAGENES/logo_sg.jpg" width="39" height="39" align="middle" alt="Buscar Sucursal"/> &nbsp;&nbsp;&nbsp;BUSCAR SUCURSAL DEL SISTEMA</div></td></tr>
    	<tr><td width="20%">&nbsp;&nbsp; Sucursal:</td>
        	<td><input type="text" placeholder=" Sucursal .." size="30" id="IdBusquedaSucursal"  class="cajaTexto"></td>
        	<td><button class="btnGeneral" onclick="javascript:RealizaBusquedaSucursal()" title="Realizar Busqueda">Buscar</button></td>
        </tr>
        <tr><td colspan="3">
        		 <table id="IdTablaSucursal" border="1" bordercolor='#006A00'>
	 				<thead>
       				 	<th width="60">N&deg;</th>
                        <th>Ruc</th>
                        <th>Raz&oacute;n Social</th> 
                        <th>Estado</th>                       
    				</thead>
    				<tbody id="CuerpoSucursal"> </tbody> 	
   				 </table>
        	</td>
        </tr>
        <tr>
        	<td width="10">&nbsp;</td>
            <td align="right"><button class="btnGeneral" onclick="javascript:SeleccionarSucursal();" title="Aceptar">Aceptar</button></td>
            <td><button class="btnGeneral" onclick="javascript:$('#DivBuscarSucursales').hide('slow')" title="Cancelar">Cancelar</button></td>
        </tr>
    </table>       
</div>


<div id="MensajeSucursal" class="Ventana" style="width:60%; height:60%"  >
   <div class="cerrar"><img src="LIBRERIAS/IMAGENES/close.png" onClick="javascript:$('#MensajeSucursal').hide(500);" alt="Salir"/></div>
 <p><strong style="color:#FFF; font-size:20px"> &nbsp;&nbsp;&nbsp;&nbsp; Mensaje </strong></p><hr />
 <table  border="0" align="center" height="60%" width="90%" bgcolor="#FFFFFF" class="redon">
    <tr>
       <td><p>&nbsp;&nbsp;&nbsp;<span id="IdTituloSucursal" style="color:#006A00; font-size:16px"></span></p></td>
    </tr>
    
    <tr>
       <td align="center"><button onclick="javascript:$('#MensajeSucursal').hide('slow')" class="btnGeneral">Aceptar</button></td>
    </tr>
 </table>
   
</div>

<!--<div id="MensajeSucursal" class="Ventana">
 <span id="IdTituloSucursal"></span><br />
   <input type="image" src="LIBRERIAS/IMAGENES/aceptar2.png" onclick="javascript:$('#MensajeSucursal').hide('slow')" >
</div>-->
