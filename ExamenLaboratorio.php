<!--<script src="LIBRERIAS/JS/Validar.js"></script>-->
<script src="LIBRERIAS/JS/ExamenLaboratorio.js"></script>

<div class="cerrar"><img src="LIBRERIAS/IMAGENES/close.png" onClick="javascript:$('#DivRegistrarOrdenLaboratorio').hide(1000)" alt="Salir"/></div>
<div id="cadena"></div>
<input type="date"  name="fecha" id="fecha"    
  value="<?=date('Y-m-d')?>" onchange="dias()" onkeyup="dias()"  />
<a  href="#" onclick="exportar()" style="cursor:pointer">
<button value="limpiar">CREAR EXCEL</button>
</a>
<table width="581" border="1" bordercolor='#c5dbec' id="tabla" >
  <thead>
    <tr>
      <th width="111">Fecha</th>
      <th width="335">Examen de Laboratorio</th>
      <th width="88">IMPORTAR</th>
    </tr>
  </thead>
  <tbody id="tabla2">
  </tbody>
</table>
<form enctype="multipart/form-data" name="frmupfoto" id="frmupfoto" target="iframecargar"   method ="post">
  <input onchange="procesar()" id="subir" type="file" name = "subir"  style="display:none" />
</form>
<iframe name="iframecargar" id="iframecargar"   style="display:none"  ></iframe>
