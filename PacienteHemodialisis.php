<?php require_once('CADO/ClaseTurno.php');
      $oturno=new Turnos();
?>
<!--<script src="LIBRERIAS/JS/Validar.js"></script>-->

<script language="javascript" src="LIBRERIAS/JS/OrdenLab2.js"></script>
<script src="LIBRERIAS/JS/PacienteHemodialisis.js"></script>

<!-- Para Tabs -->
    <!--<link rel="stylesheet" href="LIBRERIAS/PLUGINS/JQUERY/base/jquery.ui.all.css">-->
	<!--<script src="LIBRERIAS/PLUGINS/JQUERY/ui/jquery.ui.core.js"></script>
	<script src="LIBRERIAS/PLUGINS/JQUERY/ui/jquery.ui.widget.js"></script>-->
	<script src="LIBRERIAS/PLUGINS/JQUERY/ui/jquery.ui.tabs.js"></script>
<!--	<link rel="stylesheet" href="LIBRERIAS/PLUGINS/JQUERY/demos.css">
--><!-- FIn Tabs -->

<script>
	$(function() {
		$( "#TabsProtocolo" ).tabs({
			collapsible: false
		});
		
	});
</script>
<div class="cerrar"><img src="LIBRERIAS/IMAGENES/close.png" onClick="javascript:CerrarPH();"/></div><br /><br />
<div class="titulo" style="background-image:url(LIBRERIAS/IMAGENES/fondo1.png);">&nbsp;&nbsp;&nbsp;PROTOCOLO HEMODIALISIS</div>

<div class="demo">

<div id="TabsProtocolo">
	<ul>
		<li><a href="#tabs-1" >Pacientes Ingresados</a></li>
        <li><a href="#tabs-2" >Parte M&eacute;dico</a></li>
        <li><a href="#tabs-3">Parte de Enfermera</a></li>      
        <li><a href="#tabs-4">Monitoreo</a></li>  
        <!--<li><a href="#tabs-5">Laboratorio</a></li>  -->
        <li><a href="#tabs-6">Medicamentos</a></li>  
	</ul>
    
	<div id="tabs-1" style="height:300px">
    <input type="hidden" id="IdNumFilaHemodialisis" value="0"  />
    <input type="hidden" id="IdPacHemodialisis" />
    <input type="hidden" id="IdFichaHemodialisis" />
    <input type="hidden" id="IdProgramacionHemo" />
    <table>
    <tr><td width="20%">
    <select id="IdTurnosHemo" onchange="javascript:CargarPacientesHemo()">
        <option value="0">.: Seleccione Turno :.</option>
        <?php $listar=$oturno->ListarTurno();$i=0;
		  while($fila=$listar->fetch()){
			  $i++;
			  if($i==1){$turno="TURNO I -->";}
			  if($i==2){$turno="TURNO II -->";}
			  if($i==3){$turno="TURNO III -->";}
			  if($i==4){$turno="TURNO IV -->";}
			  if($i==5){$turno="TURNO V -->";}
			  if($i==6){$turno="TURNO VI -->";}	
			  ?>
           <option value="<?=$fila[0]?>"><? echo $turno.' '.$fila[1]?></option>
        <?php }?>   
        </select></td>
        <td width="55%">&nbsp;</td>
        <td><button class="btnGeneral" onclick="javascript:VentanaHistorialProtocolosAnexado()">Historial Protocolos </button></td></tr>
        </table>
		<table cellspacing="0" cellpadding="0" >
        <tr><td colspan="3" height="10">&nbsp;</td></tr>
        <tr><td colspan="3">
        		<table id="IdTablaPhI" border="1" bordercolor='#c5dbec'>
	 				<thead>
       				 	<th >N&deg;</th>
                        <th>Fecha</th>                       
                        <th>Paciente</th>
                        <th>Atenci&oacute;n</th>
    				</thead>
    				<tbody id="CuerpoPhI">
     				</tbody>
   				</table>
             </td>
        </tr>
        <tr height="15"><td colspan="2" >&nbsp;&nbsp;</td></tr>
        <tr><td >&nbsp;&nbsp; Enf. Inicia <br /> &nbsp;&nbsp;<input type="text" size="40" id="enf_inicia" class="cajaTexto" /></td>
            <td > Enf. Finaliza <br /><input type="text" size="40" id="enf_finaliza" class="cajaTexto"/></td>
        </tr>       
        <tr>
             <td >&nbsp;&nbsp; CEP Inicio <br /> &nbsp;&nbsp;
                 <input type="text" size="40" id="cep_inicia" class="cajaTexto" /></td>
             <td >CEP Fin <br /><input type="text" size="40" id="cep_finaliza"  class="cajaTexto"/></td>
          </tr>
	</table>
	</div>
    
	<div id="tabs-2" style="height:300px">
       <table cellspacing="0" cellpadding="10" class="cajaTexto" align="left">
          <tr>           
            <td>
               <table cellpadding="5">
                   <tr>
    					<td align="left">Hras. HD<br />
                           <input type="text" id="med_hras_hd"  size="10" class="cajaTexto"/></td>
    					<td align="left">QB<br /><input type="text" id="med_qb"  size="10" class="cajaTexto"/></td>
                        <td align="left">Conduc.<br />
                           <input type="text" id="med_conduc"  size="10" class="cajaTexto"/></td>
   					</tr>
  					<tr>
    					<td align="left">Heparina<br />
                           <input type="text" id="med_heparina" size="10" class="cajaTexto"/></td>
    					<td align="left">QD<br /><input type="text"  size="10" id="med_qd" class="cajaTexto"/></td>
                        <td align="left">Na inicial<br />
                           <input type="text" id="med_na_inicial"  size="10" class="cajaTexto"/></td>
   					</tr>
  					<tr>
    					<td align="left">Peso Seco<br />
                           <input type="text" id="med_pesoseco" size="10" class="cajaTexto"/></td>
    					<td align="left">HCO3<br /><input type="text"  size="10" id="med_hco3" class="cajaTexto"/></td>
                        <td align="left">Na final<br />
                           <input type="text"  size="10" id="med_na_final" class="cajaTexto"/></td>
   					</tr>
                    <tr>
    					<td align="left">Extraccion<br />
                           <input type="text" id="med_extraccion"  size="10" class="cajaTexto"/></td>
    					<td align="left">Area de filtro<br />
                           <input type="text" id="med_areafiltro"  size="10" class="cajaTexto"/></td>
                        <td align="left">Membrana<br />
                           <input type="text" size="10"  id="med_membrana" class="cajaTexto"/></td>
   					</tr>
                    <tr>
                        <td align="left">T&deg; Maq.<br />
                           <input type="text" size="10"  id="med_temp_maq" class="cajaTexto"/></td>
                        <td colspan="2" >Cond. Serolog&iacute;a<br />
                           <SELECT id="med_cond_sero">
                              <option value="0" >NEGATIVO</option>
                              <option value="1">POSITIVO</option>
                            </SELECT></td>
                    </tr>
               </table>
            </td>
            <td>
               <table cellpadding="5">
                   <tr><td>FRECUENCIA <br />
                           <input type="text" id="IdFrecuencia"  class="cajaTexto" readonly="readonly"/></td></tr>
                   <tr><td>PROBLEMAS CLINICOS <br />
                           <textarea rows="4" id="med_procli" cols="50" class="cajaTexto"></textarea></td></tr>
                   <tr><td>EVALUACI&Oacute;N Signos y sintomas <br />
                           <textarea rows="4" id="med_evolucion" cols="50" class="cajaTexto" ></textarea></td></tr>
               </table>
            </td>
          </tr>          
       </table>
	</div>
    
	<div id="tabs-3" style="height:300px">
    <table cellspacing="0" cellpadding="10" class="cajaTexto" align="left">
    	<tr><td><table>
        			<tr><td>Pa inicial<br /><input type="text" id="enfe_pa_inicial" value="<?=$enfe_pa_inicial?>" size="10" class="cajaTexto"/></td>
                    	<td>Pa final<br /><input type="text" size="10" id="enfe_pa_final" value="<?=$enfe_pa_final?>" class="cajaTexto"/></td>
                    </tr>
                    <tr><td>FC inicial<br /><input type="text" size="10" id="enfe_fc_inicial" value="<?=$enfe_fc_inicial?>" class="cajaTexto"/></td>
                    <td>FC final<br /><input type="text" size="10" id="enfe_fc_final" value="<?=$enfe_fc_final?>" class="cajaTexto"/></td>          			</tr>
                    <tr><td>Peso inicial<br /><input type="text" id="enfe_peso_inicial" value="<?=$enfe_peso_inicial?>" size="10" class="cajaTexto"/></td>
                    	<td>Peso final<br /><input type="text" size="10" id="enfe_peso_final" value="<?=$enfe_peso_final?>" class="cajaTexto"/></td>                    </tr>
                    <tr><td>UF inicial<br /><input type="text" size="10" id="enfe_uf_inicial" value="<?=$enfe_uf_inicial?>" class="cajaTexto"/></td>
    					<td>UF final<br /><input type="text" size="10" id="enfe_uf_final" value="<?=$enfe_uf_final?>" class="cajaTexto"/></td>    
                    </tr>
                </table>
            </td>
        	<td><table>
            	<tr><td>Nro. de Maq.<br /> <input type="text" id="enfe_num_maq" value="<?=$enfe_num_maq?>" size="10" class="cajaTexto"/></td>
                	<td>Heparina<br /><input type="text" size="10" id="enfe_heparina" value="<?=$enfe_heparina?>" class="cajaTexto"/></td>
                </tr>
                <tr><td>Marca/Modelo<br /><input type="text" size="10" id="enfe_marca_mod" value="<?=$enfe_marca_mod?>" class="cajaTexto"/></td>
                	<td>&nbsp;</td>
                </tr>
                <tr><td> Vol. filtro<br /><input type="text" id="enfe_vol_filtro" value="<?=$enfe_vol_filtro?>" size="10" class="cajaTexto"/>ml</td>
                	<td>&nbsp;</td>
                </tr>
                <tr><td>Reuso de filtro:<br /><input type="text" size="10" id="enfe_reuso_filtro" value="<?=$enfe_reuso_filtro?>" class="cajaTexto"/></td>
                	<td>&nbsp;</td>
                </tr>
                </table>
            </td>
            <td valign="top">VALORACI&Oacute;N INICIAL<br /><textarea cols="40" id="enfe_val_inicial" rows="9" class="cajaTexto"><?=$enfe_val_inicial?></textarea></td>
        </tr>
        <tr><td align="center">ACCESO ART.</td>
        	<td colspan="2"><table>
            		<tr><td>FAV <input type="text" id="enfe_art_fav"  size="5" class="cajaTexto"/></td>
                    	<td>Inj <input type="text" id="enfe_art_inj"  size="5" class="cajaTexto"/></td>
                        <td>CVC <input type="text" id="enfe_art_cvc"  size="5" class="cajaTexto"/></td>
                        <td>CVLP <input type="text" id="enfe_art_cvlp"  size="5" class="cajaTexto"/></td>
                    </tr>
            	</table>
            </td>
        </tr>
        <tr><td align="center">ACCESO VEN.</td>
        	<td colspan="2"><table>
            		<tr><td>FAV <input type="text" id="enfe_ven_fav" size="5" class="cajaTexto"/></td>
                    	<td>Inj <input type="text" id="enfe_ven_inj" size="5" class="cajaTexto"/></td>
                        <td>CVC <input type="text" id="enfe_ven_cvc" size="5" class="cajaTexto"/></td>
                        <td>CVLP <input type="text" id="enfe_ven_cvlp" size="5" class="cajaTexto"/></td>
                        <td>VP <input type="text" id="enfe_ven_vp" size="5" class="cajaTexto"/></td>                        
                    </tr>
            	</table>
            </td>
        </tr>
    </table>		
	</div>
    
    <div id="tabs-4" style="height:300px">
	<table id="IdTablaMonitoreo" border="1" bordercolor='#c5dbec'>
      <thead>
        <tr>
          <th>HR</th>
          <th>PA</th>
          <th>FC</th>
          <th>QB</th>
          <th>Condc.</th>
          <th>Pa</th>
          <th>Pv</th>
          <th>PTM</th>
          <th>UF.P</th>
          <th>UF.T</th>
          <th>OBSERVACIONES</th>
          <th>Accion</th>
        </tr>
      </thead>
      <tbody id="IdCuerpoMonitoreo"></tbody>
    </table><br />
    <table>
       <tr>
          <td>Valoraci&oacute;n Final<br />
           <textarea cols="70" rows="3" class="cajaTexto"  id="enfe_val_final" ><?=$enfe_val_final?></textarea></td>
          <td><button class="btnNuevo" onclick="javascript:NuevoMonitoreo();"></button></td>           
       </tr>
       <tr>
         <td >Aspecto Filtro<br />
            <input type="text" size="70" class="cajaTexto" id="enfe_asp_filtro" value="<?=$enfe_asp_filtro?>" /></td>
       </tr>
    </table>	
	</div>
       
      <!--<div id="tabs-5" style="height:300px">



<table  >
  <tr>
    <td width="673" height="2"><hr /></td>
  </tr>
  
    <td><p><strong>Examenes de Laboratorio</strong></p></td>
  </tr>
  <tr>
    <td><form id="form" name="form">
        <table id="IdTablaOel" border="1" bordercolor='#c5dbec'>
          <thead>
            <th width="56">N. Orden</th>
            <th width="173">Fecha</th>
            <th width="96">Observación</th>
            <th width="96">Estado</th>
            <td width="9"></td>
              </thead>
          <tbody id="CuerpoOel">
          </tbody>
        </table>
      </form></td>
  </tr>
  <tr>
    <td><div class="BotonesMantenimiento">
        <button onclick="javascript:BuscarTipoExamenxd()">Ver Resultados</button>
      </div></td>
  </tr>
</table>
<input type="hidden" id="IdOpcionOel" />


<div id="Mostrar" class="Buscar"> 
<div class="cerrar"><img src="LIBRERIAS/IMAGENES/close.png" onClick="javascript:SalirTipoExamen()"/></div>
<table class="cTabla" id="tablitaex">
  <tr>
    <td colspan="5"><div class="titulo"><img src="LIBRERIAS/IMAGENES/logo_sg.jpg" width="39" height="39" align="middle"/> &nbsp;&nbsp;&nbsp;ORDEN DE EXAMEN DE LABORATORIO</div>
      <hr /></td>
  </tr>
  <tr>
    <td width="37">&nbsp;</td>
    <td width="80">C&oacute;digo:</td>
    <td width="144"><input type="text" disabled="disabled" readonly="readonly" id="IdOelCodigo" onkeypress="return validar1(event,'numeros');" class="cajaTexto1"/></td>
    <td colspan="2">Fecha (*):
      <input id="fecha" name="fecha" type="date" value="<?php echo date('Y-m-d'); ?>" disabled="disabled" /></td>
  </tr>
  <tr>
    <td width="37" height="26">&nbsp;</td>
    <td>Paciente (*):</td>
    <td><input type="text" disabled="disabled" id="IdOelPaciente"   onkeypress="return validar1(event,'numeros');" class="cajaTexto2"/></td>
    
    <td width="145"><input readonly="readonly" type="text" id="IdOelMostarPaciente" onkeypress="return validar1(event,'letra');" class="cajaTexto2" disabled="disabled"/></td><td width="60"> </td>
  </tr>
  <tr>
    <td width="37">&nbsp;</td>
    <td>Estado:</td>
    <td colspan="3"><input type="text" disabled="disabled" id="estadoooo"     class="cajaTexto2"/></td>
  </tr>
  <tr>
    <td width="37">&nbsp;</td>
    <td>Observaci&oacute;n:</td>
    <td colspan="3"><textarea id="IdOelObservacion" name="observacion" cols="50" rows="5" disabled="disabled" class="cajaTexto2"></textarea></td>
  </tr>
  <tr>
    <td colspan="5"><hr /></td>
  </tr>
  <tr>
    <td width="37">&nbsp;</td>
    <td colspan="2">Fec. Crea.: <span id="IdOelFecCrea">
      <? //date("d/m/Y")?>
      </span></td>
    <td colspan="2">Crea. User :<span id="IdOelUserCrea">
      <? //$_SESSION['S_user']?>
      </span></td>
  </tr>
  <tr>
    <td width="37">&nbsp;</td>
    <td colspan="2">Fec. Anula.: <span id="IdOelFecCrea">
      <? //date("d/m/Y")?>
      </span></td>
    <td colspan="2">Anul. User :<span id="IdOelUserCrea">
      <? //$_SESSION['S_user']?>
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
    <td colspan="5"> </td>
  </tr>
</table>
</div>
 </div>-->
 
 <div id="tabs-6" style="height:300px">
<table  >
  <tr>
    <td width="673" height="2"></td>
  </tr>
  <tr>
    <td><form id="formmedicamentos" name="formmedicamentos">
        <table id="IdTablaMedicamento" border="1" bordercolor='#006A00'>
          <thead>
            <th width="90">Código</th>
            <th width="480">Medicamento</th>
            <th width="90">Cantidad</th>
            <th width="100">Unidad</th>            
          </thead>
          <tbody id="CuerpoMedicamento">
          </tbody>
        </table>
      </form>
      
      </td>
  </tr>
  <tr>
    <td><div class="BotonesMantenimiento">
        <button class="btnGeneral" onclick="javascript:mostrarbusmed()"> Agregar </button>
         
          
           <button class="btnGeneral" onclick="javascript:quitamed()">Quitar</button>
            <button class="btnGeneral" onclick="javascript:grabarmedicamentos()">Grabar</button>
      </div></td>
  </tr>
</table>
<input type="hidden" id="IdOpcionOel" />

<div id="DivBuscarPacientes2" class="Buscar">
  <div class="cerrar"><img src="LIBRERIAS/IMAGENES/close.png" onClick="javascript:CancelarBuscarTurno2()"/></div>
  <div class="clear"></div>
 
  <table width="749" class="cTabla">
    <tr>
      <td colspan="3"><div class="titulo"><img src="LIBRERIAS/IMAGENES/logo_sg.jpg" width="39" height="39" align="middle"/> &nbsp;&nbsp;&nbsp;BUSCAR MEDICAMENTOS</div></td>
    </tr>
    <tr>
      <td width="78">Medicamento: </td>
      <td width="540"><input type="text" placeholder=" Medicamento .." size="90" id="IdBusquedaDIA2" class="cajaTexto"></td>
      <td width="115"><button class="btnGeneral" onclick="javascript:buscarcie102()" title="Buscar Medicamentos">Buscar</button></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td colspan="3"><table id="IdTablaMedicamento2" border="1" bordercolor='#006A00'>
          <thead>
            <th width="40">Código</th>
            <th>Medicamento</th>
            <th>Presentación</th>
            <th>Unidad</th>
            <th>Estado</th>
          </thead>
          <tbody id="CuerpoMedicamento2">
          </tbody>
        </table></td>
    </tr>
    <tr>
      <td colspan="3" align="center"><button class="btnGeneral" onclick="javascript:seleccionar()">Aceptar</button>
        <button class="btnGeneral" onclick="javascript:CancelarBuscarTurno2()">Cancelar</button></td>
    </tr>
  </table>
</div>
 </div>
</div>
</div><!-- End demo -->

<div class="BotonesMantenimiento"><p>
	<input type="image" id="IdPhIGrabar"  src="LIBRERIAS/IMAGENES/grabar2.png" onclick="javascript:InsertarProtocolo()" class="opacidad" />
	<input type="image" src="LIBRERIAS/IMAGENES/altapaciente.png" onclick="javascript:Alta();" class="opacidad" />
    <input type="image" src="LIBRERIAS/IMAGENES/verFicha.png" onclick="javascript:VerHF()" class="opacidad" />
    <input type="image" src="LIBRERIAS/IMAGENES/verProtocolo.png" class="opacidad" onclick="javascript:VerProtocolo();" />
    <input type="image" id="IdPhSalir" src="LIBRERIAS/IMAGENES/btnSalir2.png" onClick="javascript:CerrarPH()" class="opacidad" /></p>
</div>

<div id="IdDivAlta" style="display:none" class="Ventana">
   <div class="cerrar"><img src="LIBRERIAS/IMAGENES/close.png" onClick="javascript:$('#IdDivAlta').hide(1000)"/></div>
   <table class="cTabla">
   <tr>
     <td>Observaci&oacute;n &nbsp;&nbsp;&nbsp;<textarea id="IdObs" cols="40" rows="5"></textarea></td>
   </tr>
   <tr align="center">
     <td><input type="button" value="Grabar" onclick="javascript:ActualizarAlta();" /></td>
   </tr>
   </table>
 </div> 
   
<div id="IdNuevoMoni" style="display:none" class="Ventana">
 <div class="tituloventana"><p>Nuevo Monitoreo</p></div>
 <div class="cerrar"><p><img src="LIBRERIAS/IMAGENES/close.png" onClick="javascript:$('#IdNuevoMoni').hide(1000)" /></p></div>
 <div class="clear"></div>
 <input type="hidden" id="IdMoni" />
 <table width="371" class="cTabla">
    <tr>
      <td width="123">HR &nbsp;<input type="text" id="hr" size="9" class="cajaTexto"/></td>
      <td width="123">PA &nbsp;<input type="text" id="pa" size="9" class="cajaTexto"/></td>
      <td width="123">FC &nbsp;<input type="text" id="fc" size="9" class="cajaTexto"/></td>
    </tr>
    <tr>
      <td width="123">QB &nbsp;<input type="text" id="qb" size="9" class="cajaTexto"/></td>
      <td width="123">Condc.<input type="text" id="condc" size="7" class="cajaTexto"/></td>
      <td width="123">Pa &nbsp;<input type="text" id="p_a" size="9" class="cajaTexto"/></td>
    </tr>
    <tr>
      <td width="123">Pv &nbsp;&nbsp;<input type="text" id="pv" size="9" class="cajaTexto"/></td>
      <td width="123">PTM <input type="text" id="ptm" size="8" class="cajaTexto"/></td>
      <td width="123">UF.P<input type="text" id="uf_p" size="8" class="cajaTexto"/></td>
    </tr>
    <tr>
      <td width="123">UF.T <input type="text" id="uf_t" size="8" class="cajaTexto"/></td>
      <td colspan="2">OBSERVACIONES&nbsp;<input type="text" size="17" id="obs" class="cajaTexto"/> </td>
    </tr>
    
 </table>
 <center>
 <input type="image" id="IdAgregarMo" src="LIBRERIAS/IMAGENES/grabar2.png" onclick="javascript:AgregarMonitoreo();" style="display:none" class="opacidad" />
  <input type="image" id="IdActualizarMo" src="LIBRERIAS/IMAGENES/grabar2.png" onclick="javascript:ActualizarMonitoreo();" style="display:none" class="opacidad" />
 </center>

</div>