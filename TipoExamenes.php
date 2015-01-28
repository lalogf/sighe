<? session_start();?>

<script src="LIBRERIAS/JS/TipoExamenes.js"></script>

<div class="cerrar"><img src="LIBRERIAS/IMAGENES/close.png" onClick="javascript:SalirTipoExamen()"/></div>
<table class="cTabla">
  <tr>
    <td colspan="4"><div class="titulo">&nbsp;&nbsp;&nbsp;TIPO DE EX&Aacute;MEN REALIZADO</div>
      <hr /></td>
  </tr>
  <tr>
    <td width="20">&nbsp;</td>
    <td>C&oacute;digo :</td>
    <td colspan="2"><input  disabled="disabled"  type="text" id="IdCodigoTipoExamen" size="5"  class="cajaTexto1"/></td>
  </tr>
  <tr>
    <td width="20">&nbsp;</td>
    <td>Ex&aacute;men(*):</td>
    <td colspan="2"><input disabled="disabled" type="text" id="IdExamen" size="30"  class="cajaTexto2"/></td>
  </tr>
  <tr>
    <td width="20">&nbsp;</td>
    <td>Valor Normal:</td>
    <td colspan="2"><textarea disabled="disabled" id="IdValorNormalTipoExamen" name="ValorNormal" cols="auto" rows="5" class="cajaTexto2"></textarea></td>
  </tr>
  <tr>
    <td width="20">&nbsp;</td>
    <td>Estado:</td>
    <td colspan="2"><select disabled="disabled" id="estado" name="estado" class="combo">
        <option value="1">HABILITADO</option>
        <option value="0">DESHABILITADO</option>
      </select></td>
  </tr>
  <tr>
    <td colspan="4"><hr /></td>
  </tr>
  <tr>
    <td colspan="2" align="right">Fec. Crea. :<span id="IdUsuFecCrea">
      <?=date("d/m/Y")?>
      </span></td>
    <td colspan="2">&nbsp;Crea. User. :<?=$_SESSION['S_user']?></td>
  </tr>
  <tr>
    <td colspan="4" height="2"><hr /></td>
  <tr>
    <td colspan="4"><div class="BotonesMantenimiento">
        <button id="IdGrupoNuevo" onClick="javascript:NuevoTipoExamen()" class="btnNuevo">&nbsp;</button>
        <button disabled id="IdUsuGrabar" class="btnDeshabilitarGrabar" onclick="javascript:GrabarRegistrarPaciente()">&nbsp;</button>
        <button id="IdGrupoCancelar" onClick="javascript:CancelarTipoExamen()" class="btnDeshabilitarCancelar">&nbsp;</button>
        <button id="IdGrupoBuscar" onClick="javascript:BuscarTipoExamen()" class="btnBuscar">&nbsp;</button>
        <button disabled id="IdGrupoEliminar" onclick="eliminar()" class="btnDeshabilitarEliminar">&nbsp;</button>
        <button id="IdGrupoSalir" onClick="javascript:SalirTipoExamen()" class="btnSalir">&nbsp;</button>
      </div></td>
  </tr>
</table>
<div id="DivBuscarTipoExamenes" class="Buscar">
  <div class="cerrar"><img src="LIBRERIAS/IMAGENES/close.png" onClick="javascript:CancelarBuscarTipoExamen()"/></div>
  <div class="clear"></div>
  <table class="cTabla">
    <tr>
      <td colspan="3"><div class="titulo"><img src="LIBRERIAS/IMAGENES/logo_sg.jpg" width="39" height="39" align="middle"/> &nbsp;&nbsp;&nbsp;BUSCAR EXAMEN DE LABORATORIO</div></td>
    </tr>
    <tr>
      <td>Ex&aacute;men:</td>
      <td><input type="text" placeholder=" Busqueda de examenes de laboratorio .." size="30" id="IdBusquedaTipoE" onkeypress="return validar1(event,'letra');" class="cajaTexto"></td>
      <td><button class="btnGeneral" onclick=" RealizaBusquedaUsuario();">Buscar</button></td>
    </tr>
    <tr>
      <td colspan="3"><table width="319" border="1" bordercolor='#006A00' id="IdTablaTipoExamen">
          <thead>
          <th width="74">N&deg;</th>
            <th width="222">Ex&aacute;men</th>
              </thead>
          <tbody id="CuerpoTipoExamen">
          </tbody>
        </table></td>
    </tr>
    <tr>
      <td width="10">&nbsp;</td>
      <td align="right"><button class="btnGeneral" onclick="SeleccionarBusquedaUsuario()">Aceptar</button></td>
      <td><button class="btnGeneral" onClick="javascript:CancelarBuscarTipoExamen()">Cancelar</button></td>
    </tr>
  </table>
</div>
