<script src="LIBRERIAS/JS/Validar.js"></script>
<script src="LIBRERIAS/JS/RegistrarPacientes.js"></script>

<!--<script src="LIBRERIAS/JS/Validar.js"></script>-->
<!-- Para Tabs -->
    <!--<link rel="stylesheet" href="LIBRERIAS/PLUGINS/JQUERY/base/jquery.ui.all.css">-->
	
	<script src="LIBRERIAS/PLUGINS/JQUERY/ui/jquery.ui.tabs.js"></script>
<!--	<link rel="stylesheet" href="LIBRERIAS/PLUGINS/JQUERY/demos.css">
--><!-- FIn Tabs -->

<script>
 $(document).ready(function(){      
			var f =new Date(); 
            $fecha_actual=f.getDate() + "/" + (f.getMonth() +1) + "/" + f.getFullYear();			
			$("#fecnac,#fecing,#fecinidia2,#fecinidia,#fd1,#fd2,#fd3").datepicker(
			        {
					 maxDate:$fecha_actual,	
					 changeMonth: true,
			         changeYear: true
					   }
				);
						 
		$( "#TabsRegistrarPaciente" ).tabs({
			collapsible: false
		});				 
	  });
	
</script>
<div class="cerrar"><img src="LIBRERIAS/IMAGENES/close.png" onClick="javascript:SalirRegistrarPaciente()"/></div><br /><br />
<div class="titulo" style="background-image:url(LIBRERIAS/IMAGENES/fondo1.png);">&nbsp;&nbsp;&nbsp;REGISTRO DE PACIENTE [FICHA DE INGRESO]: &nbsp;&nbsp;&nbsp;<input type="text" id="auto" name="auto" size="20"   readonly="readonly" class="cajaTexto"/></div>
<div class="demo">
<div id="TabsRegistrarPaciente">
	<ul>
    	<li><a href="#tab1">Datos Generales</a></li>
    	<li><a href="#tab2">Inmunizaciones</a></li>
  	</ul>
	<div id="tab1" style="height:310px;">
  	<form id="formtab1"  action="#" onsubmit="return false">
    <input  type="hidden" size="40" id="idpaciente" name="idpaciente"    />
    <input  type="hidden" size="40" id="idficha" name="idficha"    />
    <table cellspacing="0" class="cajaTexto" align="left" border="0" width="90%">
    	<tr><td>&nbsp;</td></tr>
    	<tr>
        	<td width="18%"> &nbsp;&nbsp;Apellidos &nbsp;&nbsp;&nbsp; <button title="Buscar" id="buscarpac" onclick="buscarpac()" class="btnGeneral">Buscar</button><br /> &nbsp;&nbsp;<input type="text" id="apellidos" name="apellidos"  onkeyup="auto()" class="cajaTexto2"/></td>
        	<td width="15%">Nombres<br /><input type="text"  id="nombres" name="nombres"  onkeydown="auto()" /></td>
            <td width="8%">Dni<br /><input type="text" id="dni" name="dni" maxlength="8" size="10" /></td>            
          	<td width="8%">Fecha Nac.<br /><input type="text" id="fecnac" size="12" name="fecnac" max="<?php echo date('Y-m-d'); ?>" 
            onchange="restarfechas();auto()"   onkeypress="restarfechas();auto()" /></td>
            <td width="18%" align="left">Sexo:<br />
            <input type="radio" id="sexo1" name="sexo" onchange="auto()" onkeypress="auto()" onclick="auto()" value="1" />M
            &nbsp;<input type="radio" id="sexo2" name="sexo" onkeypress="auto()" onclick="auto()" value="0" />F</td>            
            <td width="11%">Edad<br /><input type="text" readonly="readonly"  size="12" id="edad" name="edad"/></td>            
        </tr>
        <tr>
        	<td width="20%"> &nbsp;&nbsp;Grupo Sanguineo<br />
             <select id="gruposang" name="gruposang">
            	<option value="O////(+)">Grupo 'O' --- Factor Rh:(+)</option>
            	<option value="O////(-)">Grupo 'O' --- Factor Rh:(-)</option>
            	<option value="A////(+)" >Grupo 'A' --- Factor Rh:(+)</option>
            	<option  value="A////(-)">Grupo 'A' --- Factor Rh:(-)</option>
            	<option value="B////(+)">Grupo 'B' --- Factor Rh:(+)</option>
            	<option value="B////(-)">Grupo 'B' --- Factor Rh:(-)</option>
            	<option value="AB////(+)" >Grupo 'AB' -- Factor Rh:(+)</option>
            	<option value="AB////(-)">Grupo 'AB' -- Factor Rh:(-)</option>
          		</select></td>
            <td>Fecha Ingreso<br />
            <input type="text"  id="fecing" name="fecing" value="<?php echo date('d/m/Y'); ?>" onchange="restarfechas()" onkeypress="restarfechas()" size="20" /></td>
        	<td colspan="2">Direcci&oacute;n Actual<br /><input type="text" size="40" id="direccion" name="direccion"/></td>
       		<td>Telefono<br /><input type="text" id="telefono" size="12" name="telefono"/></td>
            <td>&nbsp;</td>
        </tr>        
      <tr>
      	<td> &nbsp;&nbsp;Contac. Emerg.<br /> &nbsp;&nbsp;<input type="text" size="15" id="contaceme" name="contaceme"/></td>
        <td>Tel. Emerg.<br /><input type="text" id="teleme" name="teleme" /></td>
        <td nowrap="nowrap">Fecha Inicio Dialisis<br /><input type="text" id="fecinidia" name="fecinidia" /></td>
        <td colspan="3">Fecha Ini. Dialisis del Inst. Ri&ntilde;on<br /><input type="text" id="fecinidia2" name="fecinidia2" /></td>
      </tr>      
      <tr>
        <td colspan="3"> &nbsp;&nbsp;CIE 10(*)<br />
         &nbsp;&nbsp;<input type="text" size="10"   id="cie10" name="cie10"  />
       <button id="buscarcie" onclick="buscadorcie()" class="btnGeneral">Buscar</button>
        <input readonly="readonly" type="text" size="50" id="cie10text" name="cie10text"   /></td>
        <td colspan="3" rowspan="2">Diagnostico Inicio(*)<br /><textarea  name="diagnostico" id="diagnostico" cols="35" rows="3"></textarea></td>
        </tr>  
      <tr><td height="22"> &nbsp;&nbsp;Peso Seco<br />
           &nbsp;&nbsp;<input type="text" size="5" name="pesoseco" id="pesoseco" />
          Kg</td><td colspan="2">Turno<br /><select id="cboturno" name="cboturno">
            <option value="0">Elija un Turno</option>
          </select></td></tr>      
      <tr>       
        <td colspan="3" rowspan="2"> &nbsp;&nbsp;Frecuencia Hemodialisis<br /> &nbsp;&nbsp;
          <table>
            <tr>
              <td width="45">Lun:<br />
                <input type="checkbox" id="d1" name="d1" value="1" /></td>
              <td width="45">Mar:<br />
                <input type="checkbox" id="d2" name="d2" value="1" /></td>
              <td width="45">Mie:<br />
                <input type="checkbox" id="d3" name="d3" value="1" /></td>
              <td width="45">Jue:<br />
                <input type="checkbox" id="d4" name="d4" value="1" /></td>
              <td width="45">Vie:<br />
                <input type="checkbox" id="d5" name="d5" value="1" /></td>
              <td width="45">Sab:<br />
                <input type="checkbox" id="d6" name="d6" value="1" /></td>
              <td width="45">Dom:<br />
                <input type="checkbox" id="d7" name="d7" value="1" /></td>
            </tr>
          </table></td>        
        </tr>
        <tr><td colspan="3">Alergico a<br />
             <textarea name="alergia" cols="35" rows="3" id="alergia"></textarea>                    
            </td>
        <td>&nbsp;</td></tr>             
      <tr><td colspan="6"><hr /></td></tr>
      <tr>
        <td colspan="6" align="center">Fec. Crea.: <span id="IdUsuFecCrea"><?=date("d/m/Y")?></span>&nbsp;&nbsp;&nbsp;&nbsp; Crea. User :<span id="IdUsuUserCrea"><?=$_SESSION['S_user']?></span></td>
      </tr>
    </table>
  </form>
</div>
<div id="tab2" style="height:310px;">
  <form id="formtab2"  action="#" onsubmit="return false"><br />
    <table cellspacing="5" class="cajaTexto" align="center" width="600">
      <tr style="text-align:center">
        <td colspan="2">SEROLOGIA</td>
        <td colspan="2">CONCLUSI&Oacute;N</td>
      </tr>
      <tr align="center">        
        <td>HIV: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <select  id="h1" name="h1">
            <option value="1">POSITIVO</option>
            <option selected="selected" value="0">NEGATIVO</option>
          </select></td>
        <td width="20">&nbsp;</td>
        <td width="20">&nbsp;</td>
        <td>NEGATIVO:<input type="checkbox"   id="h2" name="h2"  value="1" /></td>
      </tr>
      <tr align="center">
        <td>HVC: &nbsp;&nbsp;&nbsp;&nbsp; <select  id="h3" name="h3">
            <option  value="1">POSITIVO</option>
            <option  selected="selected" value="0">NEGATIVO</option>
          </select></td>
        <td width="20">&nbsp;</td>
        <td width="20">&nbsp;</td>
        <td>POSITIVO(+):
          <input type="checkbox"  id="h4" name="h4"  value="1" /></td>
      </tr>
      <tr align="center">
        <td>Ag. HBS:
          <select  id="h5" name="h5">
            <option  value="1">POSITIVO</option>
            <option selected="selected"  value="0">NEGATIVO</option>
          </select></td>
        <td width="20">&nbsp;</td>
        <td width="20">&nbsp;</td>
        <td>POSITIVO(++):
          <input type="checkbox"  id="h6" name="h6"  value="1" /></td>
      </tr>
      <tr>
        <th colspan="4">INMUNIZACI&Oacute;N PARA HEPATITIS "B"</th>
      </tr>
      <tr>
        <td colspan="4"><table cellpadding="0" cellspacing="5" align="center">
            <tr>
              <th>DOSIS</th>
              <th>FECHA</th>
              <th>RESPONSABLE</th>
            </tr>
            <tr align="center">
              <td>I</td>
              <td><input type="text"   id="fd1" name="fd1"/></td>
              <td><input type="text" size="70" id="rd1" name="rd1" /></td>
            </tr>
            <tr align="center">
              <td>II</td>
              <td><input type="text"  id="fd2" name="fd2"/></td>
              <td><input type="text"  id="rd2" name="rd2" size="70"/></td>
            </tr>
            <tr align="center">
              <td>III</td>
              <td><input type="text"   id="fd3" name="fd3"/></td>
              <td><input type="text" id="rd3" name="rd3" size="70"/></td>
            </tr>
          </table></td>
      </tr>
      
    </table>
  </form>
</div>
</div>
</div>
<table>
  <tr>
    <td colspan="7"><div class="BotonesMantenimiento">
        <button id="IdUsuNuevo" onClick="javascript:NuevoRegistrarPaciente()" class="btnNuevo2">&nbsp;</button>
        <button disabled id="IdUsuGrabar" class="btnDeshabilitarGrabar2" onclick="javascript:GrabarRegistrarPaciente()">&nbsp;</button>
        <button id="IdUsuCancelar" onClick="javascript:CancelarRegistrarPaciente()" class="btnDeshabilitarCancelar2">&nbsp;</button>
        <button id="IdUsuBuscar" onClick="javascript:buscadorcie2()" class="btnBuscar2">&nbsp;</button>
        <button disabled id="IdUsuEliminar" class="btnDeshabilitarEliminar2" onClick="javascript:EliminarRegistrarPaciente()">&nbsp;</button>
        <button id="IdUsuSalir" onClick="javascript:SalirRegistrarPaciente()" class="btnSalir2">&nbsp;</button>
       
      </div></td>
  </tr>
</table>
<div id="DivBuscarPacientes" class="Buscar">
  <div class="cerrar"><img src="LIBRERIAS/IMAGENES/close.png" onClick="javascript:CancelarBuscarcie()"/></div>
  <div class="clear"></div>
  <table class="cTabla">
    <tr>
      <td colspan="3"><div class="titulo">&nbsp;&nbsp;&nbsp;BUSCAR CIE 10</div></td>
    </tr>
    <tr>
      <td align="right">Diagnostico: </td>
      <td><input type="text" placeholder=" Diagnostico .." size="45" id="IdBusquedaDIA" ></td>
      <td><button class="btnGeneral" onclick="javascript:buscarcie10();" title="Buscar CIE 10">Buscar</button></td>
    </tr>
    <tr>
      <td colspan="3">
      	<table   width="731" border="1" bordercolor='#006A00' id="IdTablaPaciente">
          <thead>
          <th width="139">Código</th>
            <th width="561">Diagnóstico </th>
            <td width="9"></thead>
          <tbody id="IdCuerpoPaciente">
          </tbody>
        </table></td>
    </tr>
    <tr>
      <td colspan="3" align="center"><button class="btnGeneral" onclick="javascript:eleccion()" title="Aceptar">Aceptar</button>
        <button class="btnGeneral" onclick="javascript:CancelarBuscarcie()" title="Cancelar">Cancelar</button></td>
    </tr>
  </table>
</div>
<div id="DivBuscarPacientes2" class="Buscar">
  <div class="cerrar"><img src="LIBRERIAS/IMAGENES/close.png" onClick="javascript:CancelarBuscarTurno2()"/></div>
  <div class="clear"></div>
 
  <table class="cTabla">
    <tr>
      <td colspan="3"><div class="titulo">&nbsp;&nbsp;&nbsp;BUSCAR FICHA PACIENTE</div></td>
    </tr>
    <tr>
      <td>Paciente: </td>
      <td><input type="text" placeholder=" Paciente .." size="50"id="IdBusquedaDIA2" ></td>
      <td><button class="btnGeneral"onclick="javascript:buscarcie102()" title="Buscar Ficha Paciente">Buscar</button></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <!--<td><input type="checkbox" name="k" id="k"  value="1" onclick="buscarcie102()" onchange="buscarcie102()"  />
      <label for="checkbox">Incluir Fichas Pasadas</label></td>-->
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td colspan="3">
      <table   width="731" border="1" bordercolor='#006A00' id="IdTablaPaciente2">
          <thead>
            <th >Paciente</th>
            <th >Fecha de Registro</th>
          </thead>
          <tbody id="IdCuerpoPaciente2">
          </tbody>
        </table></td>
    </tr>
    <tr>
      <td colspan="3" align="center"><button class="btnGeneral" onclick="javascript:asignar()">Aceptar</button>
        <button class="btnGeneral" onclick="javascript:CancelarBuscarTurno2()">Cancelar</button></td>
    </tr>
  </table>
</div>
<div id="DivBuscarPacientes3" class="Buscar">
  <div class="cerrar"><img src="LIBRERIAS/IMAGENES/close.png" onClick="javascript:CancelarBuscarTurno3()"/></div>
  <div class="clear"></div>
 
  <table class="cTabla">
    <tr>
      <td colspan="3"><div class="titulo">&nbsp;&nbsp;&nbsp;BUSCAR PACIENTE</div></td>
    </tr>
    <tr>
      <td align="right">Paciente: </td>
      <td><input type="text" placeholder=" Paciente .." size="45" id="IdBusquedaDIA3" ></td>
      <td><button class="btnGeneral" onclick="javascript:buscarcie3()" title="Buscar Paciente">Buscar</button></td>
    </tr>
    <tr>
      <td colspan="3"><table   width="731" border="1" bordercolor='#006A00' id="IdTablaPaciente3">
          <thead>
          <th width="205">Apellidos</th>
            <th width="253">Nombres</th>
            <th width="238">Fecha Nac</th>
            <td width="7"></thead>
          <tbody id="IdCuerpoPaciente3">
          </tbody>
        </table></td>
    </tr>
    <tr>
      <td colspan="3" align="center"><button class="btnGeneral" onclick="javascript:asignar2()">Aceptar</button>
        <button class="btnGeneral" onclick="javascript:CancelarBuscarTurno3()">Cancelar</button></td>
    </tr>
  </table>
</div>

<div id="MensajeRegistrarPac" class="Ventana"  style="width:60%; height:35%" >
 <div class="cerrar"><img src="LIBRERIAS/IMAGENES/close.png" onClick="javascript:$('#MensajeRegistrarPac').hide(500);" alt="Salir"/></div>
 <p><strong style="color:#FFF; font-size:20px"> &nbsp;&nbsp;&nbsp;&nbsp; Mensaje </strong></p><hr />
 <table  border="0" align="center" height="60%" width="90%" bgcolor="#FFFFFF" class="redon">
    <tr>
       <td><p>&nbsp;&nbsp;&nbsp;<span id="IdTituloRegistrarPac" style="color:#006A00; font-size:16px"></span></p></td>
    </tr>
    
    <tr>
       <td align="center"><button onclick="javascript:$('#MensajeRegistrarPac').hide('slow')" class="btnGeneral">Aceptar</button></td>
    </tr>
 </table>
</div>
