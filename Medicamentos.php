<?php session_start();?>

<script src="LIBRERIAS/JS/Medicamentos.js"></script>

<div class="cerrar"><img src="LIBRERIAS/IMAGENES/close.png" onClick="javascript:SalirMedicamento()"/></div>
<table class="cTabla">
	<tr>
	<td colspan="4"><div class="titulo"><img src="LIBRERIAS/IMAGENES/logo_sg.jpg" width="39" height="39" align="middle"/> &nbsp;&nbsp;&nbsp;MEDICAMENTOS</div>
    <hr /></td>
	</tr>
	<tr><td width="20">&nbsp;</td>
    	<td>Id:</td>
    	<td colspan="2">
      <input type="text" id="IdUnicoMedicamento" size="5"  class="cajaTexto1" disabled="disabled" readonly="readonly"/>
      </td>
        
    </tr>
    <tr><td width="20">&nbsp;</td>
    	<td>C&oacute;digo :</td>
    	<td colspan="2"><input type="text" id="IdCodigoMedicamento" size="5"  class="cajaTexto1"/></td>
        
    </tr>
    <tr><td width="20">&nbsp;</td>
    	<td>Medicamento(*):</td>
    	<td colspan="2"><input type="text" id="IdMedicamento" size="50"  class="cajaTexto2"/></td>
    </tr>
    <tr><td width="20">&nbsp;</td>
    	<td>Presentaci&oacute;n:</td>
    	<td colspan="2"><input type="text" id="IdPresentacionMedicamento" size="50" class="cajaTexto2" /></td>
    </tr>
    <tr><td width="20">&nbsp;</td>
    	<td>Unidad(*):</td>
    	<td colspan="2"><input type="text" id="IdUnidadMedicamento" size="15" class="cajaTexto2" /></td>
    </tr>        
    <tr><td width="20">&nbsp;</td>
    	<td>Estado:</td>
    	<td colspan="2">
        	<select disabled="disabled" id="IdEstadoMedicamento" class="combo">
            	<option value="1">HABILITADO</option>
                <option value="0">DESHABILITADO</option>
            </select>
        </td>
    </tr>                
    <tr><td colspan="4"><hr /></td></tr>
    <tr><td colspan="2" align="right">Fec. Crea. :<span id="IdMedFecCrea"> <?=date("d/m/Y")?> </span></td>
    	<td colspan="2">&nbsp;Crea. User <span id="IdMedUserCrea"><?=$_SESSION['S_user']?></span></td></tr>
	<tr><td colspan="4" height="2"><hr /></td>
    <tr><td colspan="4">
    <div class="BotonesMantenimiento">
		<button id="IdMedNuevo" onClick="javascript:NuevoMedicamento()" class="btnNuevo">&nbsp;</button>
		<button disabled id="IdMedGrabar" class="btnDeshabilitarGrabar" onclick="javascript:GrabarMedicamento();">&nbsp;</button>
		<button id="IdMedCancelar" onClick="javascript:CancelarMedicamento()" class="btnDeshabilitarCancelar">&nbsp;</button>
		<button id="IdMedBuscar" onClick="javascript:BuscarMedicamento()" class="btnBuscar">&nbsp;</button>
		<button disabled id="IdMedEliminar" class="btnDeshabilitarEliminar" onclick="javasctript:EliminarMedicamento();">&nbsp;</button>
		<button id="IdMedSalir" onClick="javascript:SalirMedicamento()" class="btnSalir">&nbsp;</button>
	</div></td></tr>
</table>
<input type="hidden" id="IdOpcionMedicamento" />
<div id="DivBuscarMedicamentos" class="Buscar">	
<input type="hidden" id="IdNumFilaMedicamento"  />
<input type="hidden" id="CanBusMedicamento"  />
  <div class="cerrar"><img src="LIBRERIAS/IMAGENES/close.png" onclick="javascript:$('#DivBuscarMedicamentos').hide('slow')"/></div><div class="clear"></div>
	<table class="cTabla">
	    <tr><td colspan="3"><div class="titulo"><img src="LIBRERIAS/IMAGENES/logo_sg.jpg" width="39" height="39" align="middle"/> &nbsp;&nbsp;&nbsp;BUSCAR EXAMEN DE MEDICAMENTOS</div></td></tr>
    	<tr><td>Medicamento:</td>
        	<td><input type="text" placeholder=" Medicamento .." size="30" id="IdBusquedaMedicamento" class="cajaTexto"></td>
        	<td><button class="btnGeneral" onclick="javascript:RealizaBusquedaMedicamento();">Buscar</button></td>
        </tr>
        <tr><td colspan="3">
        		 <table id="IdTablaMedicamento" border="1" bordercolor='#006A00'>
	 				<thead>
       				 	<th>N&deg;</th>
                        <th>Medicamento</th>
                        <th>Presentaci&oacute;n</th> 
                        <th>Unidad</th>
                        <th>Estado</th>                       
    				</thead>
    				<tbody id="CuerpoMedicamento">    					       					
     				</tbody>
   				 </table>
        	</td>
        </tr>
        <tr>
        	<td width="10">&nbsp;</td>
            <td align="right"><button class="btnGeneral" onclick="javascript:SeleccionarMedicamento();">Aceptar</button></td>
            <td><button class="btnGeneral" onclick="javascript:$('#DivBuscarMedicamentos').hide('slow')">Cancelar</button></td>
        </tr>
    </table>       
</div>
<div id="MensajeMedicamento" class="Ventana">
 <span id="IdTituloMedicamento"></span><br />
   <button onclick="javascript:$('#MensajeMedicamento').hide('slow')" >Aceptar</button>
</div>