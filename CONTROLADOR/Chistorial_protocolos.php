<?php    session_start();
     if(!isset($_SESSION['S_user'])){
		header("location:index.php");
		}
  require_once("../CADO/ClaseHisProtocolos.php");
  controlador($_POST['accion']);
  
  function controlador($accion){
	  
	  $oprotocolos=new HistorialProtocolos();
	   
	   if($accion=='BUSCAR'){
		  $tbl=""; 
		  $paciente=$_POST[paciente];
		  $listar=$oprotocolos->ListarXPacientePro($paciente, $_SESSION['S_idsucursal']);$i=0;
		  while($fila=$listar->fetch()){
			$i++; 
			if($i==1){
		       $color="#E9FFE9";
		     }else{$color="#FFFFFF";}  
		    $tbl.="<tr bgcolor='$color' id='$i' idHPro='$fila[0]' style='cursor:pointer' onclick=\"javascript:PintarFilaHisPro('$i')\" ondblclick=\"javascript:SeleccionarBusquedaHPro()\">
			         <td align='center'>$i</td><td align='left'>&nbsp;&nbsp; $fila[1]</td><td align='center'>$fila[2]</td></tr>";
		   }  
			echo $i.'///'.$tbl;  
	   }
	  if($accion=='GENERAR_PAC'){
		 $idHPro=$_POST[idHPro];
		 $listar=$oprotocolos->ListarXIdPaciente($idHPro); 
		 while($fila=$listar->fetch()){
			$id=$fila[0];
			$paciente=$fila[1]; 
			}
		  echo $id.'///'.$paciente;
		 }
	  if($accion=='LLENAR_PROTOCOLOS'){
		  $idpaciente=$_POST[idpaciente];
		  //echo $idpaciente;exit;
		  $mes=$_POST[mes];
		  $anio=$_POST[anio];
		  $tbl="";
		  $listar=$oprotocolos->ListarProtocolos($idpaciente,$mes,$anio);$i=0;
		  //echo "hola";exit;
		  while($fila=$listar->fetch()){
			  $i++;
			  $tbl.="<tr><td>$i</td><td>$fila[1]</td>  
			     <td align='center'><a href='#'onclick=\"javascript:VerHPro('$fila[2]','$fila[3]','$fila[4]','$fila[5]')\">VER PROTOCOLO</a></td></tr>";
			  }
			if($tbl==""){
				echo "<tr><td colspan='3'>No Hay resultados ..</td></tr>";exit;
				} 
			echo $tbl;	 
		}   
	   
}
?>