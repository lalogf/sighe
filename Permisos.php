<!--<script src="LIBRERIAS/JS/Validar.js"></script>-->
<script src="LIBRERIAS/JS/Permisos.js"></script>

<div class="cerrar">
<img src="LIBRERIAS/IMAGENES/close.png" onClick="javascript:SalirPermiso()"/></div>
<table width="1000" class="cTabla">
	<tr>
	<td colspan="2">
    	<div class="titulo"><img src="LIBRERIAS/IMAGENES/logo_sg.jpg" width="39" height="39" align="middle"/> &nbsp;&nbsp;&nbsp;PERMISOS DEL SISTEMA</div><hr /></td>
	</tr>
    <tr><td width="200" valign="top">
    		<div class="contorno">
            	GRUPO DE USUARIOS:<br />
        		<table border="1" bordercolor='#c5dbec' id="TablaGrupoUsuarios">
        			<thead>
          				<tr>
            				<th width="67">Cod</th>
            				<th width="232">Grupo</th>
          				</tr>
        			</thead>
        			<tbody id="CuerpoGrupoUsuarios">
        			</tbody>
      			</table>
                <br />
                M&Oacute;DULOS ASIGNADOS:<br />
                <table border="1" bordercolor='#c5dbec' id="ModulosAsignados" >
        			<thead>
          				<tr>
            				<th width="67">Cod</th>
            				<th width="232">Modulo</th>
          				</tr>
        			</thead>
        			<tbody id="CuerpoModulosAsignados">
        			</tbody>
      			</table>
                <button class="btnGeneral" id="button" onclick="javascript:asignar()" >Asignar</button>
      			<button class="btnGeneral" id="button2" onclick="javascript:desasignar()" >Quitar</button>
                <br />
                M&Oacute;DULOS NO ASIGNADOS:<br />
                <table border="1" id="ModulosAsignados2">
        			<thead>
          				<tr>
            				<th width="67">Cod</th>
            				<th width="232">Modulo</th>
          				</tr>
        			</thead>
        			<tbody id="CuerpoModulosAsignados2">
        			</tbody>
      			</table>
      
        	</div>        
        </td>
    	<td width="560" valign="top">
    		<div class="contorno">
            	USUARIOS:<br />
       			<table width="560" border="1" bordercolor='#c5dbec' id="TablaUsuarios">
              		<thead>
                		<tr>
                  			<th width="57">Cod</th>
                  			<th width="124">Acceso</th>
                  			<th width="173">Apellidos </th>
                  			<th width="186">Nombres</th>
                		</tr>
              		</thead>
              		<tbody id="CuerpoUsuarios">
              		</tbody>
          		</table>
                <br />
                <form action="#"   id="formopcion" name="formopcion" > 
          			<table width="560" border="1" bordercolor='#c5dbec' id="TablaOpciones">
            			<thead>
              				<tr>
                				<th width="62">Código</th>
                				<th width="410">Opción</th>
                				<th width="58">Ver</th>
              				</tr>
            			</thead>
            			<tbody id="CuerpoOpciones"></tbody>
          			</table>
          		</form>
                
            </div>                       
        </td>
    </tr>  
    <tr><td colspan="2" align="right"><button id="button" onclick="javascript:guardar()" class="btnGeneral">Guardar</button>
      			   <button id="button2" onclick="javascript:SalirPermiso()" class="btnGeneral">Cancelar</button></td></tr>                   
</table>