<?php session_start();
	require_once('CADO/ClaseEspecialidad.php');
	$oespecialidad=new Especialidades();
 ?>


<script src="LIBRERIAS/JS/Trabajadores.js"></script>

<div class="cerrar"><img src="LIBRERIAS/IMAGENES/close.png" onClick="javascript:SalirTrabajador()"/></div>
<table class="cTabla">
	<tr><td colspan="4"><div class="titulo">&nbsp;&nbsp;&nbsp;TRABAJADOR DE LA EMPRESA</div>
    <hr /></td>
	</tr>
	<tr><td width="2%">&nbsp;</td>
    	<td width="30%" style="text-align:right">C&oacute;digo : </td>
    	<td colspan="2"><input type="text" id="IdCodigoTrabajador" disabled="disabled" readonly="readonly"  class="cajaTexto1"/></td>    
    </tr>
    <tr><td width="2%">&nbsp;</td>
    	<td style="text-align:right">Nombres : </td>
    	<td colspan="2"><input type="text" disabled="disabled" id="IdNombresTrabajador"  class="cajaTexto2" /></td>
    </tr>
    <tr><td width="2%">&nbsp;</td>
    	<td style="text-align:right">Apellidos : </td>
    	<td colspan="2"><input type="text" disabled="disabled" id="IdApellidosTrabajador"  class="cajaTexto2" /></td>
    </tr>
    <tr><td width="2%">&nbsp;</td>
    	<td style="text-align:right">Especialidad : </td>
    	<td colspan="2"><select id="IdEspecialidadTrabajador" disabled="disabled" class="combo">
        	<option value="0">.: SELECCIONE :.</option>
        <?php 
		$listar=$oespecialidad->ListarEspecialidad();
		while($fila=$listar->fetch()){?>
             <option value="<?=$fila[0]?>"><?=$fila[1]?></option>
         <?php }?>    
        </select></td>              
    </tr>
    <tr><td width="2%">&nbsp;</td>
    	<td style="text-align:right">D.n.i. : </td>
    	<td colspan="2"><input type="text" id="IdDniTrabajador" disabled="disabled" maxlength="8"  class="cajaTexto2"/></td>
    <tr><td width="2%">&nbsp;</td>
        <td align="right">Sexo(*) : </td>
        <td colspan="2"><select id="IdSexoTrabajador" disabled="disabled" class="combo">
        	<option value="M">M</option>
            <option value="F">F</option></select> </td>
    </tr>
    <tr><td width="2%">&nbsp;</td>
    	<td style="text-align:right">Direcci&oacute;n : </td>
    	<td colspan="2"><input type="text" disabled="disabled" id="IdDireccionTrabajador" class="cajaTexto2"/></td>
    </tr>
    <tr><td width="2%">&nbsp;</td>
    	<td style="text-align:right">Telefono : </td>
    	<td colspan="2"><input type="text" disabled="disabled" id="IdTelefonoTrabajador" class="cajaTexto2"/></td>
    </tr>
    <tr><td width="2%">&nbsp;</td>
    	<td style="text-align:right">Correo : </td>
    	<td colspan="2"><input type="text" disabled="disabled" id="IdCorreoTrabajador" size="60" class="cajaTexto2"/></td>
    </tr>
    <tr><td width="2%">&nbsp;</td>
    	<td style="text-align:right">Estado : </td>
    	<td colspan="2">
        	<select disabled="disabled" id="IdEstadoTrabajador" class="combo">            
            	<option value="1">HABILITADO</option>
            	<option value="2">DEHABILITADO</option>
            </select>
        </td>
    </tr>
    <tr><td colspan="4"><hr /></td></tr>
    <tr><td colspan="4" style="text-align:center">Fec. Crea. :<span id="IdTraUsuFecCrea"> <?php echo date("d/m/Y")?> </span>
    &nbsp;&nbsp;&nbsp;&nbsp; Crea. User : <span id="IdTraUserCrea"><?php echo $_SESSION['S_user']?></span></td></tr>
	<tr><td colspan="4"><hr /></td>
    <tr><td colspan="4">
    <div class="BotonesMantenimiento">
		<button id="IdTrabNuevo" onClick="javascript:NuevoTrabajador()" class="btnNuevo"></button>
		<button disabled id="IdTrabGrabar" class="btnDeshabilitarGrabar" onclick="javascript:GrabarTrabajador()"></button>
   <button id="IdTrabCancelar" onClick="javascript:CancelarTrabajador()" class="btnDeshabilitarCancelar"></button>
		<button id="IdTrabBuscar" onClick="javascript:BuscarTrabajador()" class="btnBuscar"></button>
		<button disabled id="IdTrabEliminar" class="btnDeshabilitarEliminar" onclick="javascript:EliminarTrabajador()"></button>
		<button id="IdTrabSalir" onClick="javascript:SalirTrabajador()" class="btnSalir"></button>
	</div></td></tr>
</table>
<input type="hidden" id="IdOpcionTrabajador" />
<div id="DivBuscarTrabajadores" class="Buscar">	
<input type="hidden" id="IdNumFilaTrabajador"  />
    <input type="hidden" id="CanBusTrabajador"  />
	<div class="cerrar">
    <img src="LIBRERIAS/IMAGENES/close.png" onclick="javascript:$('#DivBuscarTrabajadores').hide('slow')" alt="Cerrar"/></div><div class="clear"></div>
	<table class="cTabla">
	    <tr><td colspan="3"><div class="titulo"><img src="LIBRERIAS/IMAGENES/logo_sg.jpg" width="39" height="39" align="middle" alt="Buscar Trabajador"/> &nbsp;&nbsp;&nbsp;BUSCAR TRABAJADOR</div></td></tr>
    	<tr><td width="20%">&nbsp;&nbsp; Trabajador :</td>
        	<td><input type="text" placeholder=" Trabajador .." size="30" id="IdBusquedaTrabajador" class="cajaTexto"></td>
        	<td><button class="btnGeneral" onclick="javascript:RealizaBusquedaTrabajador()" alt="Buscar" title="Buscar">Buscar</button></td>
        </tr>
        <tr><td colspan="3">
        		 <table id="IdTablaTrabajador" border="1" bordercolor='#006A00'>
	 				<thead>
       				 	<th width="70">N&deg;</th>
                        <th>Trabajador</th>
                        <th>D.n.i</th>
                        <th>Sexo</th>
                        <th>Estado</th>
    				</thead>
    				<tbody id="CuerpoTrabajador">
       					
     				</tbody>
   				 </table>
        	</td>
        </tr>
        <tr>
        	<td width="10">&nbsp;</td>
            <td align="right"><button class="btnGeneral" onclick="javascript:SeleccionarTrabajador()" title="Aceptar">Aceptar</button></td>
            <td><button class="btnGeneral" onclick="javascript:$('#DivBuscarTrabajadores').hide('slow')" title="Cancelar">Cancelar</button></td>
        </tr>
    </table>
    
</div>


<div id="MensajeTrabajador" class="Ventana" style="width:60%; height:50%"  >
   <div class="cerrar"><img src="LIBRERIAS/IMAGENES/close.png" onClick="javascript:$('#MensajeTrabajador').hide(500);" alt="Salir"/></div>
 <p><strong style="color:#FFF; font-size:20px"> &nbsp;&nbsp;&nbsp;&nbsp; Mensaje </strong></p><hr />
 <table  border="0" align="center" height="60%" width="90%" bgcolor="#FFFFFF" class="redon">
    <tr>
       <td><p>&nbsp;&nbsp;&nbsp;<span id="IdTituloTrabajador" style="color:#006A00; font-size:16px"></span></p></td>
    </tr>
    
    <tr>
       <td align="center"><button onclick="javascript:$('#MensajeTrabajador').hide('slow')" class="btnGeneral">Aceptar</button></td>
    </tr>
 </table>
   
</div>    
           
<!--</div><div id="MensajeTrabajador" class="Ventana">
 <span id="IdTituloTrabajador"></span><br />
   <input type="image" src="LIBRERIAS/IMAGENES/aceptar2.png" onclick="javascript:$('#MensajeTrabajador').hide('slow')" >
</div>-->