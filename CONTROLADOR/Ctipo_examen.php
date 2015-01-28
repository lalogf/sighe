<?php session_start();
     if(!isset($_SESSION['S_user'])){
		header("location:index.php");
		}
  require_once("../CADO/ClaseTipoExamen.php");
  controlador($_POST['accion']);
  
  function controlador($accion){
	  
	  $oexamen=new TExamen();
	 
	    
	   if($accion=='ELIMINAR'){
		 $id=$_POST[id];
         $eliminar=$oexamen->Eliminar($id);
		 $can=$eliminar->rowCount();
		 echo $can;
		  }
		  
		  
	   if($accion=='LISTAR'){
		   $id_sucursal=$_SESSION['S_idsucursal'];
		  $tbl=""; 
		  $usuario=$_POST[usuario];
		  //echo $turno;
		  $listar=$oexamen->ListarXExamen($id_sucursal,$usuario);$i=0;
		  while($fila=$listar->fetch()){
			$i++; 
			//$id=$i;
		 
			if($i==1){
		       $color="#c5dbec";
		     }else{$color="#FFFFFF";}  
		    $tbl.="<tr idexamen='$fila[0]' align='center' bgcolor='$color' id='$i'   style='cursor:pointer' onclick=\"javascript:PintarFila('$i')\" ondblclick=\"javascript:SeleccionarBusquedaUsuario()\">
			         <td>$i</td>
					 <td>$fila[1]</td>
					 
					 </tr>";
		   }  
			echo $i.'///'.$tbl;  
		  }  
		
		if($accion=="GENERARID"){
		   $generar=$oexamen->MaxId();
		   while($fila=$generar->fetch()){
			   $id=$fila[0]+1;
			   }
			 echo $id;  
		   }
		  
	   if($accion=='GRABAR'){
         $opcion=$_POST[opcion];
		 $id=$_POST[codigo];
	 	 $examen=$_POST[examen];
		 $valornormal=$_POST[valornormal];
	 	 $estado=$_POST[estado];
	  	 $id_sucursal=$_SESSION['S_idsucursal'];
		   if($opcion==1){
			$insertar=$oexamen->Insertar($id,$examen,$valornormal,$estado,$id_sucursal);  
			if($insertar){$can=1;} 
		   }
			if($opcion==2){
		    $modificar=$oexamen->Modificar($id,$examen,$valornormal,$estado,$id_sucursal);
			if($modificar){$can=1;} 
		    }
			echo $can;exit();
		 }	
		  
		 if($accion=="LLENAR_FORM"){
			$idusuario=$_POST[idusuario]; 
			$listar=$oexamen->ListarXId($idusuario);
			$respuesta=$listar->fetchAll();
			echo json_encode($respuesta);
		   }	  
		  
	  }
?>
