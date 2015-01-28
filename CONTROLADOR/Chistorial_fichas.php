<?php    session_start();
     if(!isset($_SESSION['S_user'])){
		header("location:index.php");
		}
  require_once("../CADO/ClaseHisFichas.php");
  controlador($_POST['accion']);
  
  function controlador($accion){
	  
	  $ofichas=new HistorialFichas();
	   
	   if($accion=='BUSCAR'){
		  $tbl=""; 
		  $paciente=$_POST[paciente];
		  $listar=$ofichas->ListarXPaciente($paciente, $_SESSION['S_idsucursal']);$i=0;
		  while($fila=$listar->fetch()){
			$i++; 
			if($i==1){
		       $color="#c5dbec";
		     }else{$color="#FFFFFF";}  
		    $tbl.="<tr align='center' onkeydown=\"javscript:BajarFilas()\" bgcolor='$color' id='$i' idHF='$fila[0]' style='cursor:pointer' onclick=\"javascript:PintarFila('$i')\" ondblclick=\"javascript:SeleccionarBusquedaHF()\">
			         <td>$i</td><td>$fila[1]</td><td>$fila[2]</td></tr>";
		   }  
			echo $i.'///'.$tbl;  
	   }
	   
	   if($accion=='LLENAR_PAC'){
		   $tbl="";
		   $idHF=$_POST[idHF];
		   $lis_pac=$ofichas->ListarXIdPaciente($idHF);
		   while($fila=$lis_pac->fetch()){
			   $pac=$fila[1];
			   }
		 $lis_fichas=$ofichas->ListarFichasXPac($idHF);	$i=0;
		 while($fila=$lis_fichas->fetch()){
			 $i++;
			  if($fila[2]==1){
				  $estado="ACTIVO";
				  $color='#97FF97';
				  $link="<a href='#' onclick=\"javascript:AbrirMensajeHF('$fila[0]');\">Inabilitar</a>";
			   }
			  if($fila[2]==0){
				  $estado="INACTIVO";
				  $color='#FFFFFF';
				  $link="Inhabilitado";
			   } 
			   $tbl.="<tr bgcolor='$color'><td align='center'>$i</td><td>$fila[1]</td><td>$estado</td>
			   <td align='center'>$link</td><td align='center'><a href='#' onclick=\"javascript:VerHF('$fila[0]')\">Ver</a></td></tr>";
		 }
		 echo $pac."///".$tbl;   
	}
	
	if($accion=='INHABILITAR'){
		$idficha=$_POST[idficha];
		
		$fecha=date('Y-m-d').' '.date('h:i:s');
		$user=$_SESSION['S_user'];
		//echo $idficha;exit;
		$verid=$ofichas->VerPacXIdFicha($idficha);
		while($fila=$verid->fetch()){
			$idpac=$fila[0];
			}
		$ofichas->InhabilitarHF($idficha,$fecha,$user);	
		echo $idpac;
		
		}
}
?>
