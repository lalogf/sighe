<?php session_start();
   require_once('CADO/ClaseEspecialidad.php'); 
   $oespecialidad=new Especialidades();
?>
<!--<script src="LIBRERIAS/JS/Validar.js"></script>-->
<script src="LIBRERIAS/JS/Especialidades.js"></script>

<div class="cerrar"><img src="LIBRERIAS/IMAGENES/close.png" onClick="javascript:SalirEspecialidad()" alt="Salir"/></div>
<table class="cTabla">
	<tr>
	<td colspan="4"><div class="titulo">&nbsp;&nbsp;&nbsp;ESPECIALIDAD DE PERSONAL</div>
    <hr /></td>
	</tr>
	<tr><td width="2%">&nbsp;</td>
    	<td width="30%" style="text-align:right">C&oacute;digo(*) : </td>
        <td colspan="2"><input type="text" id="IdCodigoEspecialidad" readonly="readonly" disabled="disabled" size="5" class="cajaTexto1"/></td>
    </tr>
    <tr><td width="2%">&nbsp;</td>
    	<td style="text-align:right">Especialidad(*) : </td>
        <td colspan="2"><input type="text" id="IdEspecialidad" disabled="disabled" class="cajaTexto2"/></td></tr>
    <tr><td width="2%">&nbsp;</td>
    	<td style="text-align:right">Estado : </td>
    	<td colspan="2">
        	<select disabled="disabled" id="IdEstadoEspecialidad" class="combo">
            	<option value="1">HABILITADO</option>
                <option value="0">DESHABILITADO</option>
            </select>
        </td>
    </tr>     
    <tr><td colspan="4"><hr /></td></tr>    
    <tr><td colspan="4" style="text-align:center">Fec. Crea. : <span id="IdEspecFecCrea"> <?=date("d/m/Y")?> </span>
   	&nbsp;&nbsp;&nbsp;&nbsp; Crea. User : <span id="IdEspecUserCrea"><?=$_SESSION['S_user']?></span></td></tr>
	<tr><td colspan="4"><hr /></td></tr>     
    <tr><td colspan="4">
    <div class="BotonesMantenimiento">
		<button id="IdEspecNuevo" onClick="javascript:NuevoEspecialidad()" class="btnNuevo"></button>
		<button disabled id="IdEspecGrabar" class="btnDeshabilitarGrabar" onclick="javascript:GrabarEspecialidad()"></button>
		<button id="IdEspecCancelar" onClick="javascript:CancelarEspecialidad()" class="btnDeshabilitarCancelar"></button>
		<button id="IdEspecBuscar" onClick="javascript:BuscarEspecialidad()" class="btnBuscar"></button>
		<button disabled id="IdEspecEliminar" class="btnDeshabilitarEliminar" onclick="javascript:EliminarEspecialidad()"></button>
		<button id="IdEspecSalir" onClick="javascript:SalirEspecialidad()" class="btnSalir"></button>
	</div></td></tr>
</table>
<input type="hidden" id="IdOpcionEspecialidad" />
<div id="DivBuscarEspecialidades" class="Buscar">	
	<div class="cerrar"><img src="LIBRERIAS/IMAGENES/close.png" onClick="javascript:CancelarBuscarEspecialidad()" alt="Cancelar Buscar Especialidad"/></div><div class="clear"></div>
    <input type="hidden" id="IdNumFilaEspecialidad"  />
    <input type="hidden" id="CanBusEspecialidad"  />
	<table class="cTabla">
	    <tr><td colspan="3"><div class="titulo"><img src="LIBRERIAS/IMAGENES/logo_sg.jpg" width="39" height="39" align="middle" alt="Buscar Especialidad"/> &nbsp;&nbsp;&nbsp;BUSCAR ESPECIALIDAD DE TRABAJADOR</div></td></tr>
    	<tr><td width="20%"> &nbsp;&nbsp;Especialidad:</td>
        	<td><input type="text" placeholder=" Especialidad .." size="30" id="IdBusquedaEspec" class="cajaTexto"></td>
        	<td><button class="btnGeneral" onclick="javascript:RealizaBusquedaEspecialidad()">Buscar</button></td>
        </tr>
        <tr><td colspan="3">
        		 <table id="IdTablaEspecialidad" border="1" bordercolor='#006A00' >
	 				<thead>
       				 	<th width="70">N&deg;</th>
        				<th>Especialidad</th>
                        <th>Estado</th>
    				</thead>
    				<tbody id="CuerpoEspecialidad">
       					
     				</tbody>
   				 </table>
        	</td>
        </tr>
        <tr>
        	<td width="10">&nbsp;</td>
            <td align="right"><button class="btnGeneral" onclick="javascript:SeleccionarBusquedaEspecialidad()">Aceptar</button></td>
            <td><button class="btnGeneral" onClick="javascript:CancelarBuscarEspecialidad()">Cancelar</button></td>
        </tr>
    </table>       
</div>


<div id="MensajeEspecialidad" class="Ventana" style="width:60%; height:60%"  >
   <div class="cerrar"><img src="LIBRERIAS/IMAGENES/close.png" onClick="javascript:$('#MensajeEspecialidad').hide(500);" alt="Salir"/></div>
 <p><strong style="color:#FFF; font-size:20px"> &nbsp;&nbsp;&nbsp;&nbsp; Mensaje </strong></p><hr />
 <table  border="0" align="center" height="60%" width="90%" bgcolor="#FFFFFF" class="redon">
    <tr>
       <td><p>&nbsp;&nbsp;&nbsp;<span id="IdTituloEspecialidad" style="color:#006A00; font-size:16px"></span></p></td>
    </tr>
    
    <tr>
       <td align="center"><button onclick="javascript:$('#MensajeEspecialidad').hide('slow')" class="btnGeneral">Aceptar</button></td>
    </tr>
 </table>
   
</div>

<!--<div id="MensajeEspecialidad" class="Ventana">
 <span id="IdTituloEspecialidad"></span><br />
   <input type="image" src="LIBRERIAS/IMAGENES/aceptar2.png" onclick="javascript:$('#MensajeEspecialidad').hide('slow')" >
</div>-->
