<!--<script src="LIBRERIAS/JS/Validar.js"></script>-->

<script src="LIBRERIAS/JS/Asignar.js"></script>
<br />
<style type="text/css" media="print"> 
div.page {  
writing-mode: tb-rl; 
height: 80%; 
margin: 10% 0%; 
} 
</style> 
<div class="cerrar"><img src="LIBRERIAS/IMAGENES/close.png" onClick="javascript:$('#DivAsignar').hide(1000)" alt="Salir"/></div>
<div id="cadena"></div>
<div id="hab">
  <div> &nbsp;&nbsp;&nbsp;&nbsp;
    <label for="textfield"></label>
    <input type="date"  name="fecha" id="fecha"    
  value="<?=date('Y-m-d')?>" onchange="dias()" onkeyup="dias()"  />
    <label for="textfield2"></label>
    <select name="dia" id="dia"   onchange="fecDia()" >
      <option dia="0" value="0"> Elija Un Día </option>
      <option dia="1" value="lunes"> Lunes </option>
      <option dia="2" value="martes"> Martes </option>
      <option dia="3" value="miercoles"> Miércoles </option>
      <option dia="4" value="jueves"> Jueves </option>
      <option dia="5" value="viernes"> Viernes </option>
      <option dia="6" value="sabado"> Sabado </option>
      <option dia="7" value="domingo"> Domingo </option>
    </select>
    <select id="cboturno" name="cboturno"  onchange="cargarLista()"  >
      <option value="0">Elija un Turno</option>
    </select>
    <a  href="#" onclick="limpiar()" style="cursor:pointer"> <button value="limpiar" class="btnPlomo">Limpiar</button> </a>
     <a  id="impresion"  style="cursor:pointer"  onclick="imprimir()"  ><button value="imprimir" class="btnPlomo">Imprimir</button></a>
    
     </div>
  <br />
  <table border="1" bordercolor='#c5dbec' id="tabla" >
    <thead>
      <tr>
        <th>Número</th>
        <th>Paciente</th>
        <th>Frecuencia</th>
        <th>Día Programado</th>
        <th>Día Reprogramado</th>
        <th>Modulo</th>
        <th width="20"><input type="checkbox" name="checktodos" id="checkbox"   />
          <label for="checkbox"></label></th>
        <th width="116">Reprogramar</th>
      </tr>
    </thead>
    <tbody id="tabla2">
    </tbody>
  </table>
</div>
<div id="DivRep" class="Buscar">
  <div class="cerrar"><img src="LIBRERIAS/IMAGENES/close.png" onClick="javascript:salir()"/></div>
  <div class="clear"></div>
  <input type="hidden" id="IdNumFilaGrupoUsuario"  />
  <input type="hidden" id="CanBusGrupoUsuario"  />
  <table class="cTabla">
    <tr>
      <td colspan="3"><!--<div class="titulo"><img src="LIBRERIAS/IMAGENES/logo_sg.jpg" width="39" height="39" align="middle"/> &nbsp;&nbsp;&nbsp;BUSCAR GRUPO DE USUARIO</div>--></td>
    </tr>
    <tr>
      <td colspan="2">Fecha:</td>
      <td><input type="date"  name="fecha2" id="fecha2"   onchange="dias2()"  onkeyup="dias2()"
  value="<?=date('Y-m-d')?>"    /></td>
    </tr>
    <tr>
      <td colspan="2">Dia:</td>
      <td><select name="dia2" id="dia2"  onchange="fecDia2()"   >
          <option dia="0" value="0"> Elija Un Día </option>
          <option dia="1" value="lunes"> Lunes </option>
          <option dia="2" value="martes"> Martes </option>
          <option dia="3" value="miercoles"> Miércoles </option>
          <option dia="4" value="jueves"> Jueves </option>
          <option dia="5" value="viernes"> Viernes </option>
          <option dia="6" value="sabado"> Sabado </option>
          <option dia="7" value="domingo"> Domingo </option>
        </select></td>
    </tr>
    <tr>
      <td colspan="2">Turno:</td>
      <td><select id="cboturno2" name="cboturno2"     >
          <option value="0">Elija un Turno</option>
        </select></td>
    </tr>
    <tr>
      <td width="10">&nbsp;</td>
      <td width="98" align="right"><input type="image" src="LIBRERIAS/IMAGENES/reprogramar.png" onclick="javascript:repro()" class="opacidad"/></td>
      <td width="136"><input type="image" src="LIBRERIAS/IMAGENES/cancelar2.png" onclick="javascript:salir()" class="opacidad"/></td>
    </tr>
  </table>
 