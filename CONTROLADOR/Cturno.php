<?php  session_start();
     if(!isset($_SESSION['S_user'])){
		header("location:index.php");
		}
  require_once("../CADO/ClaseTurno.php");
  controlador($_POST['accion']);
  
  function controlador($accion){
	  
	  $oturno=new Turnos();
	   
	   if($accion=='LISTAR'){
		  $tbl=""; 
		  $turno=$_POST[turno];
		  //echo $turno;
		  $listar=$oturno->ListarXTurno($_SESSION['S_idsucursal'],$turno);$i=0;
		  while($fila=$listar->fetch()){
			$i++; 
			//$id=$i;
			if($i==1){
		       $color="#E9FFE9";
		     }else{$color="#FFFFFF";}  
		    $tbl.="<tr align='center' bgcolor='$color' id='$i' idturno='$fila[0]' style='cursor:pointer' onclick=\"javascript:PintarFila('$i')\" ondblclick=\"javascript:SeleccionarBusqueda()\">
			         <td>$i</td><td>$fila[1]</td></tr>";
		   }  
			echo $i.'///'.$tbl;  
		  }
	   	 
	   
	   if($accion=='GRABAR'){
         $opcion=$_POST[opcion];
		 $codigo=$_POST[codigo];
		 $turno=$_POST[turno];
		 $estado=$_POST[estado];
		 $fec_crea=implode('-',array_reverse(explode('/',trim($_POST[fec_crea]))));
		 //echo $fec_crea;exit;
		 $user_crea=$_POST[user_crea];
		   if($opcion==1){
		    $insertar=$oturno->Insertar($codigo,$turno,$fec_crea,$user_crea,$estado,$_SESSION['S_idsucursal']);
			$can=$insertar->rowCount();
		   }
			if($opcion==2){
		    $modificar=$oturno->Modificar($codigo,$turno,$estado);
			$can=$modificar->rowCount();
		    }
			echo $can;
		 }	  
	   if($accion=='ELIMINAR'){
		 $id=$_POST[id];
         $eliminar=$oturno->Eliminar($id);
		 $can=$eliminar->rowCount();
		 echo $can;
		  }
	   	  
		if($accion=="GENERARID"){
		   $generar=$oturno->MaxId();
		   while($fila=$generar->fetch()){
			   $id=$fila[0]+1;
			   }
			 echo $id;  
		   }   
	     if($accion=="LLENAR_FORM"){
			$idturno=$_POST[idturno]; 
			$listar=$oturno->ListarXId($idturno);
			$respuesta=$listar->fetchAll();
			echo json_encode($respuesta);
		   }
		  
		 	  
		  
	  }
?>