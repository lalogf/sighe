<!--<script id="Lab01" src="LIBRERIAS/JS/Validar.js"></script>-->
<script id="Lab02" src="LIBRERIAS/JS/RegistrarOrdenLaboratorios.js"></script>
 

<div class="cerrar"><img src="LIBRERIAS/IMAGENES/close.png" onClick="javascript:SalirTipoExamen()"/></div>
<table class="cTabla">
  <tr>
    <td colspan="5"><div class="titulo"><img src="LIBRERIAS/IMAGENES/logo_sg.jpg" width="39" height="39" align="middle"/> &nbsp;&nbsp;&nbsp;ORDEN DE EXAMEN DE LABORATORIO</div>
      <hr /></td>
  </tr>
  <tr>
    <td width="50">&nbsp;</td>
    <td>C&oacute;digo:</td>
    <td><input type="text" disabled="disabled" readonly="readonly" id="IdOelCodigo"  class="cajaTexto1"/></td>
    <td colspan="2">Fecha (*):
      <input id="fecha" name="fecha" type="date" value="<?php echo date('Y-m-d'); ?>" disabled="disabled" /></td>
  </tr>
  <tr>
    <td width="50" height="26">&nbsp;</td>
    <td>Paciente (*):</td>
    <td><input type="text" disabled="disabled" id="IdOelPaciente"   class="cajaTexto2"/></td>
    <td><button id="buscarpaciente" onclick="pruebas()">Buscar</button></td>
    <td><input readonly="readonly" type="text" id="IdOelMostarPaciente"  class="cajaTexto2"/></td>
  </tr>
  <tr>
    <td width="50">&nbsp;</td>
    <td>Estado:</td>
    <td colspan="3"><select id="IdOelEstado" disabled="disabled">
        <option value="1">INGRESADA</option>
        <option value="0">NO INGRESADO</option>
      </select></td>
  </tr>
  <tr>
    <td width="50">&nbsp;</td>
    <td>Observaci&oacute;n:</td>
    <td colspan="3"><textarea id="IdOelObservacion" name="observacion" cols="50" rows="5" class="cajaTexto2"></textarea></td>
  </tr>
  <tr>
    <td colspan="5"><hr /></td>
  </tr>
  <tr>
    <td width="50">&nbsp;</td>
    <td colspan="2">Fec. Crea.: <span id="IdOelFecCrea">
      <?=date("d/m/Y")?>
      </span></td>
    <td colspan="2">Crea. User :<span id="IdOelUserCrea">
      <?=$_SESSION['S_user']?>
      </span></td>
  </tr>
  <tr>
    <td width="50">&nbsp;</td>
    <td colspan="2">Fec. Anula.: <span id="IdOelFecCrea">
      <?=date("d/m/Y")?>
      </span></td>
    <td colspan="2">Anul. User :<span id="IdOelUserCrea">
      <?=$_SESSION['S_user']?>
      </span></td>
  </tr>
  <tr>
  <tr>
    <td colspan="5" height="2"><hr /></td>
  </tr>
  
    <td colspan="5"><p><strong>Ingreso de Resultados</strong></p></td>
  </tr>
  <tr>
    <td colspan="5"><form id="form" name="form">
        <table id="IdTablaOel2" border="1" bordercolor='#c5dbec'>
          <thead>
          <th width="56">Código.</th>
            <th width="173">Examen</th>
            <th width="96">Valor Normal</th>
            <th width="96">Valor</th>
            <td width="9"></td>
              </thead>
          <tbody id="CuerpoOel2">
          </tbody>
        </table>
      </form></td>
  </tr>
  <tr>
    <td colspan="5"><div class="BotonesMantenimiento">
        <button id="IdGrupoNuevo" onClick="javascript:NuevoTipoExamen()" class="btnNuevo">&nbsp;</button>
        <button disabled id="IdUsuGrabar" class="btnDeshabilitarGrabar" onclick="javascript:GrabarRegistrarPacientexd()">&nbsp;</button>
        <button id="IdGrupoCancelar" onClick="javascript:CancelarTipoExamen()" class="btnDeshabilitarCancelar">&nbsp;</button>
        <button id="IdGrupoBuscar" onClick="javascript:BuscarTipoExamenxd()" class="btnBuscar">&nbsp;</button>
        <button disabled id="IdGrupoEliminar" onclick="eliminar()" class="btnDeshabilitarEliminar">&nbsp;</button>
        <button id="IdGrupoSalir" onClick="javascript:SalirTipoExamen()" class="btnSalir">&nbsp;</button>
      </div></td>
  </tr>
</table>
<input type="hidden" id="IdOpcionOel" />
<div id="DivBuscarOel" class="Buscar">
  <div class="cerrar"><img src="LIBRERIAS/IMAGENES/close.png" onClick="javascript:CancelarBuscarTipoExamen()"/></div>
  <div class="clear"></div>
  <table class="cTabla">
    <tr>
      <td colspan="3"><div class="titulo"><img src="LIBRERIAS/IMAGENES/logo_sg.jpg" width="39" height="39" align="middle"/> &nbsp;&nbsp;&nbsp;BUSCAR ORDEN DE LABORATORIO</div></td>
    </tr>
    <tr>
      <td>Paciente:</td>
      <td><input type="text" placeholder=" Paciente ... " size="30" id="IdBusquedaOel"  class="cajaTexto"></td>
      <td><input type="image" src="LIBRERIAS/IMAGENES/bot_buscar.gif" onclick="javascript:buscaroel()"></td>
    </tr>
    <tr>
      <td colspan="3"><table id="IdTablaOel" border="1" bordercolor='#c5dbec'>
          <thead>
          <th width="70">N&deg; Ord.</th>
            <th>Fecha</th>
            <th>Apellidos</th>
            <th>Nombres</th>
            <th>Estado</th>
              </thead>
          <tbody id="CuerpoOel">
          </tbody>
        </table></td>
    </tr>
    <tr>
      <td width="10">&nbsp;</td>
      <td align="right"><button  onclick="javascript:ordenasignar2()">Aceptar</button></td>
      <td><button onClick="javascript:CancelarBuscarTipoExamen()">Cancelar</button></td>
    </tr>
  </table>
</div>
<div id="DivBuscarPacientes2" class="Buscar">
  <div class="cerrar"><img src="LIBRERIAS/IMAGENES/close.png" onClick="javascript:CancelarBuscarTurno2()"/></div>
  <div class="clear"></div>
  <table width="749" class="cTabla">
    <tr>
      <td colspan="3"><div class="titulo"><img src="LIBRERIAS/IMAGENES/logo_sg.jpg" width="39" height="39" align="middle"/> &nbsp;&nbsp;&nbsp;BUSCAR FICHA PACIENTE</div></td>
    </tr>
    <tr>
      <td width="78">Paciente: </td>
      <td width="540"><input type="text" placeholder=" Paciente .." size="90" id="IdBusquedaDIA2xd" ></td>
      <td width="115"><input type="image" src="LIBRERIAS/IMAGENES/bot_buscar.gif" onclick="javascript:buscarcie102()"></td>
    </tr>
    <tr>
      <td colspan="3"><table   width="731" border="1" bordercolor='#c5dbec' id="IdTablaPaciente2">
          <thead>
          <th width="205">Apellidos</th>
            <th width="253">Nombres</th>
            <th width="238">Fecha de Registro</th>
            <td width="7"></thead>
          <tbody id="IdCuerpoPaciente2">
          </tbody>
        </table></td>
    </tr>
    <tr>
      <td colspan="3" align="center"><input type="button" value="Aceptar" onclick="javascript:asignar()" >
        <input type="button" value="Cancelar" onclick="javascript:CancelarBuscarTurno2()" /></td>
    </tr>
  </table>
</div>
<div id="MensajeUsuario" class="Ventana"> <span id="IdTituloUsuario"></span><br />
  <button onclick="javascript:$('#MensajeUsuario').hide('slow')">Aceptar</button>
</div>
