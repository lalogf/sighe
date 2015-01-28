<script src="LIBRERIAS/JS/VerHistorialProtocolos.js"></script>
<div class="cerrar"><img src="LIBRERIAS/IMAGENES/close.png" onClick="javascript:$('#DivVerHistorialProtocolos').hide(1000)"/></div>
<input type="hidden" id="IdProPaciente" />
<table class="cTabla">
	<tr><td colspan="5"><div class="titulo">&nbsp;&nbsp;&nbsp;HISTORIAL PROTOCOLOS</div></td></tr>
	<tr><td style="text-align:right">&nbsp;&nbsp;<b>Paciente : </b></td>
		<td ><input type="text" size="60"  id="IdPacienteHPro" class="cajaTexto" style="font-size:10px" placeholder=" Paciente" readonly  />
        <button id="IdBtnHPro" class="btnGeneral" onClick="javascript:$('#DivBuscarHProPac').show(500);$('#IdBusHProPac').focus();$('#CuerpoBusHProPac').html('')">Buscar</button>
        &nbsp;&nbsp;&nbsp;
         <select id="IdMes">
            <option value="1" <?php if(date('m')==1){?> selected="selected"<? }?>>ENERO</option>
            <option value="2" <?php if(date('m')==2){?> selected="selected"<? }?>>FEBRERO</option>
            <option value="3" <?php if(date('m')==3){?> selected="selected"<? }?> >MARZO</option>
            <option value="4" <?php if(date('m')==4){?> selected="selected"<? }?>>ABRIL</option>
            <option value="5" <?php if(date('m')==5){?> selected="selected"<? }?>>MAYO</option>
            <option value="6" <?php if(date('m')==6){?> selected="selected"<? }?>>JUNIO</option>
            <option value="7" <?php if(date('m')==7){?> selected="selected"<? }?>>JULIO</option>
            <option value="8" <?php if(date('m')==8){?> selected="selected"<? }?>>AGOSTO</option>
            <option value="9" <?php if(date('m')==9){?> selected="selected"<? }?>>SEPTIEMBRE</option>
            <option value="10" <?php if(date('m')==10){?> selected="selected"<? }?>>OCTUBRE</option>
            <option value="11" <?php if(date('m')==11){?> selected="selected"<? }?>>NOVIEMBRE</option>
            <option value="12" <?php if(date('m')==12){?> selected="selected"<? }?>>DICIEMBRE</option>
         </select>
       &nbsp;&nbsp;&nbsp;
        <?php 
		  $inicio=2013;
		  $final=date('Y');
		  $resta=$final-$inicio+1;
		?>
         <select id="IdAnio">
          <?php for($i=1;$i<=$resta;$i++){?>
           <option value="<?=$final?>"><?=$final?></option>
           <?php $final--;}?>
         </select>
       &nbsp;&nbsp;&nbsp;<b>
       <button class="btnGeneral" onclick="javascript:ConsultarProtocolo();" title="Consultar">Consultar</button></b></td>
	</tr>
	<tr><td colspan="5">
      <table id="TablaHisProtocolos" border="1" bordercolor='#006A00'>
			<thead>
  			<tr><th>N&deg;</th>
    			<th>FECHA</th>
    			<th>VER PROTOCOLO</th>
  			</tr>    
			</thead>
			<tbody id="CuerpoHProtocolo"></tbody>
			</table></td>
    </tr>
</table>
<!--<input type="hidden" id="IdOpcionHF" />-->

<div id="DivBuscarHProPac" class="Buscar">
<div class="cerrar"><img src="LIBRERIAS/IMAGENES/close.png" onClick="javascript:$('#DivBuscarHProPac').hide(1000)"/></div>
	<input type="hidden" id="IdNumFilaHPro" value="1"/>
    <input type="hidden" id="CanBusHPro"  />
    <!--<input type="hidden" id='IdHidenPac'/>-->
    <table class="cTabla">
    	<tr><td colspan="3"><div class="titulo"><img src="LIBRERIAS/IMAGENES/logo_sg.jpg" width="39" height="39" align="middle"/> &nbsp;&nbsp;&nbsp;BUSCAR PACIENTE</div></td>
    	</tr>
		<tr><td>Paciente:</td>
        	<td><input type="text" placeholder=" Paciente .." size="30" Id='IdBusHProPac' class="cajaTexto" ></td>
            <td><button class="btnGeneral" onclick="javascript:BusPac();">.: Buscar :.</button></td>
        </tr>
		<tr><td colspan="3">
        	<table id="TablaBusHProPac" border="1" bordercolor='#006A00'>
            	<thead>
				    <tr><th width="60">N&deg;</th>
				    <th>PACIENTE</th>
				    <th>DNI</th>
                    </tr>
                </thead>
				<tbody id="CuerpoBusHProPac"></tbody>
			</table>
            </td>
        </tr>
        <tr><td width="10">&nbsp;</td>
        	<td align="right"><button class="btnGeneral" onclick="javascript:SeleccionarBusquedaHPro()">Aceptar</button></td>
            <td><button class="btnGeneral" onclick="javascript:$('#DivBuscarHProPac').hide(1000)">Cancelar</button></td>
        </tr>
      </table>
</div>