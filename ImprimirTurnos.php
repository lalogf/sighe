<script language="javascript" src="LIBRERIAS/JS/jquery-1.7.1.min.js"></script>
<script language="javascript" src="LIBRERIAS/JS/Asignar2.js"></script>
<body  >
<div class="page">
  <DIV align="center"> <strong>TURNOS DE PACIENTES DE HEMODIALISIS</strong> </DIV>
  <br />
  <strong>
  <div style="display:inline">MODULO:&nbsp;
    <div id="nombremodulo" style="display:inline"> </div>
  </div>
  <br />
  <br />
  <div style="display:inline">FECHA:&nbsp;
    <div id="nombrefecha" style="display:inline"><?=date("d/m/Y")?></div>
  </div>
  </strong>
  <table  border="1" bordercolor="#000000" style="size:90%;">
    <thead>
      <tr>
        <td  width="4">&nbsp;</td>
        <td width="180"><div align="center"><strong>LUNES</strong></div></td>
        <td width="180"><div align="center"><strong>MARTES </strong></div></td>
        <td width="180"><div align="center"><strong>MIERCOLES</strong></div></td>
        <td width="180"><div align="center"><strong>JUEVES</strong></div></td>
        <td width="180"><div align="center"><strong>VIERNES</strong></div></td>
        <td width="180"><div align="center"><strong>SÁBADO</strong></div></td>
      </tr>
    </thead>
    <tbody id="Cuerpo">
    </tbody>
  </table>
  <br />
  <div id="nombresturnos">  </div>
</div>
<p>&nbsp;</p>
<p><a href="#" onClick="imprimir()"> Imprimir</a> <a onClick="window.close()" href="#"> Salir</a></p>
</body>
