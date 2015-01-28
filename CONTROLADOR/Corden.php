<?php session_start();
     if(!isset($_SESSION['S_user'])){
		header("location:index.php");
		}
  require_once("../CADO/ClaseOrden.php");
  controlador($_POST['accion']);
  
  function controlador($accion){
	  
	  $oexamen=new  Orden();
	 
	    
	   if($accion=='ELIMINAR'){
		 $id=$_POST[id];
         $eliminar=$oexamen->Eliminar($id);
		 $can=$eliminar->rowCount();
		 echo $can;
		  }
		  
		  
		  if($accion=='GRABARMEDICAMENTOS'){
		   $idprogramacion=$_POST[idprogramacion];
		  $listar2=$oexamen->HemodialisisProgramacion($idprogramacion) ;
		   while($fila2=$listar2->fetch()){
			   $idhemodialisis=$fila2[0];
		   }
		   $oexamen->EliminarMedicamentos($idhemodialisis);
		    $listar=$oexamen->ListaTodoMedicamentos() ;
		  while($fila=$listar->fetch()){
			  $input="MED".(string)$fila[0];
			if($_POST[$input]){
				$oexamen->InsertarMedicamentos($fila[0],$idhemodialisis,$_POST[$input]);
				} 
			  
		  }
		   exit();
		  
		  }
		  
		   if($accion=='LISTARMEDICAMENTOS2'){
	 
		  $tbl=""; 
		 $idprogramacion=$_POST[buscar];
	 
		   
		  //echo $turno;
		  $listar=$oexamen->ListaMedicamentos2($idprogramacion);$i=0;
		  while($fila=$listar->fetch()){
			$i++; 
			//$id=$i;
		 
			if($i==1){
		       $color="#c5dbec";
		     }else{$color="#FFFFFF";}  
		    $tbl.="<tr idmedicamento='$fila[0]' codigo='$fila[1]' medicamento='$fila[2]' unidad='$fila[4]' align='center' bgcolor='$color' id='E$fila[0]'   style='cursor:pointer'  ondblclick='seleccionar()'  onclick=\"javascript:PintarFila4('E$fila[0]','IdTablaMedicamento2')\"  >
			         <td>$fila[1]</td>
					 <td>$fila[2]</td>
					 <td>$fila[3]</td>
					  <td>$fila[4]</td>
				  <td>$fila[7]</td>
					 
					 </tr>";
		   }  
			echo $i.'///'.$tbl;  
		  }  
		  
		  
		    	  
		   if($accion=='LISTARMEDICAMENTOS'){
	 
		  $tbl=""; 
		 $idprogramacion=$_POST[buscar];
		  $listar2=$oexamen->HemodialisisProgramacion($idprogramacion);$i=0;
		   while($fila2=$listar2->fetch()){
			   $idhemodialisis=$fila2[0];
		   }
		   
		  //echo $turno;
		  $listar=$oexamen->ListaMedicamentos($idhemodialisis);$i=0;
		  while($fila=$listar->fetch()){
			$i++; 
			//$id=$i;
		 
			if($i==1){
		       $color="#c5dbec";
		     }else{$color="#FFFFFF";}  
		    $tbl.="<tr  idexamen='$fila[0]' align='center' bgcolor='$color' id='D$fila[0]'   style='cursor:pointer'   onclick=\"javascript:PintarFila3('D$fila[0]','IdTablaMedicamento')\"  >
			         <td>$fila[1]</td>
					 <td>$fila[2]</td>
					<td><input type='text' name='MED$fila[0]' id='MED$fila[0]' value='$fila[11]' onkeypress='return validar2(event,2)' ></td>
					  <td>$fila[4]</td>
				 
					 
					 </tr>";
		   }  
			echo $i.'///'.$tbl;  
		  }  
		  
		  
		  
		  
		   if($accion=='LISTARORDEN2'){
		   $id_sucursal=$_SESSION['S_idsucursal'];
		  $tbl=""; 
		 $buscar=$_POST[buscar];
		  //echo $turno;
		  $listar=$oexamen->ListarXOrden2($buscar);$i=0;
		  while($fila=$listar->fetch()){
			$i++; 
			//$id=$i;
		 
			if($i==1){
		       $color="#c5dbec";
		     }else{$color="#FFFFFF";}  
		    $tbl.="<tr idexamen='$fila[0]' estado='$fila[3]'  align='center' bgcolor='$color' id='C$i'   style='cursor:pointer'   onclick=\"javascript:PintarFila2('C$i','IdTablaOel')\"  >
			         <td>$i</td>
					 <td>$fila[1]</td>
					 <td>$fila[2]</td>
					  <td>$fila[3]</td>
				   </tr>";
		   }  
			echo $i.'///'.$tbl;  
		  }  
		  
		  
		  
		 if($accion=='LISTARORDEN'){
		   $id_sucursal=$_SESSION['S_idsucursal'];
		  $tbl=""; 
		 $buscar=$_POST[buscar];
		  //echo $turno;
		  $listar=$oexamen->ListarXOrden($id_sucursal,$buscar);$i=0;
		  while($fila=$listar->fetch()){
			$i++; 
			//$id=$i;
		 
			if($i==1){
		       $color="#c5dbec";
		     }else{$color="#FFFFFF";}  
		    $tbl.="<tr idexamen='$fila[0]' align='center' bgcolor='$color' id='$i'  estado='$fila[5]'  style='cursor:pointer' ondblclick='asignar2()' onclick=\"javascript:PintarFila('$i','CuerpoOel')\"  >
			         <td>$fila[0]</td>
					 <td>$fila[1]</td>
					 <td>$fila[2]</td>
					  <td>$fila[3]</td>
					   <td>$fila[4]</td>
					 
					 </tr>";
		   }  
			echo $i.'///'.$tbl;  
		  }  
		  
		  
		   
	   if($accion=='LISTAR1'){
		   $id_sucursal=$_SESSION['S_idsucursal'];
		  $tbl=""; 
		 
		  //echo $turno;
		  $listar=$oexamen->ListarXExamen($id_sucursal);$i=0;
		  while($fila=$listar->fetch()){
			$i++; 
			//$id=$i;
		 
			if($i==1){
		       $color="#c5dbec";
		     }else{$color="#FFFFFF";}  
		    $tbl.="<tr idexamen='$fila[0]' align='center' bgcolor='$color' id='C$i'   style='cursor:pointer' onclick=\"javascript:PintarFila2('C$i','IdTablaOel2')\"  >
			         <td>$fila[0]</td>
					 <td>$fila[1]</td>
					 <td>$fila[2]</td>
					 <td> <input name='ex$fila[0]' id='ex$fila[0]' type='text' onkeypress='return validar2(event,2)' /></td>
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
		 $id_sucursal=$_SESSION['S_idsucursal'];
		 $id=$_POST[codigo];
		 $paciente=$_POST[paciente];
	 	 $fecha=$_POST[fecha];
		 $estado=$_POST[estado];
	 	 $observacion=$_POST[observacion];
		 $usuario=$_SESSION['S_user'];
	  	 $id_sucursal=$_SESSION['S_idsucursal'];
		   if($opcion==1){
			   
			$insertar=$oexamen->Insertar($id,$paciente,$estado,$observacion,$fecha,$usuario,$id_sucursal);  
			if($insertar){$can=1;} 
		  $listar=$oexamen->ListarXExamen($id_sucursal);$i=0;
		  while($fila=$listar->fetch()){
				if($_POST["ex".$fila[0]]){
			$insertar=$oexamen->Insertar2($id,$fila[0],$_POST["ex".$fila[0]]);  		
			 }
			  }
			
			
		   }
			if($opcion==2){
		    $modificar=$oexamen->Modificar($id,$paciente,$estado,$observacion,$fecha,$usuario,$id_sucursal);
			if($modificar){$can=1;} 
			$oexamen->borrar($id);
			 $listar=$oexamen->ListarXExamen($id_sucursal);$i=0;
			 
		  while($fila=$listar->fetch()){
				if($_POST["ex".$fila[0]]){
			$insertar=$oexamen->Insertar2($id,$fila[0],$_POST["ex".$fila[0]]);  		
			 }
			  }
			  
		    }
			echo $can;exit();
		 }	
		  
		 if($accion=="LLENAR_FORM"){
		  $id_sucursal=$_SESSION['S_idsucursal'];
		  $tbl=""; 
		 $idusuario=$_POST[idusuario]; 
		  //echo $turno;
		  $listar=$oexamen->ListarXExamen($id_sucursal);$i=0;
		  while($fila=$listar->fetch()){
		    $lista=$oexamen->listardetalle($idusuario,$fila[0]);
			 $detalle="";
			  while($filaz=$lista->fetch()){
				$detalle=$filaz[0];  
			  }
			$i++; 
			//$id=$i;
		 	
			if($i==1){
		       $color="#c5dbec";
		     }else{$color="#FFFFFF";}  
		    $tbl.="<tr idexamen='$fila[0]' align='center' bgcolor='$color' id='C$i'   style='cursor:pointer' onclick=\"javascript:PintarFila2('C$i','IdTablaOel2')\"  >
			         <td>$fila[0]</td>
					 <td>$fila[1]</td>
					 <td>$fila[2]</td>
					 <td> <input name='ex$fila[0]' id='ex$fila[0]' type='text' value='$detalle' /></td>
					 </tr>";
		   }  
			$idusuario=$_POST[idusuario]; 
			$listar=$oexamen->ListarXId($idusuario);
			$respuesta=$listar->fetchAll();
			echo json_encode($respuesta)."╚╚╚".$tbl;
		   }	  
		  
	  }
?>
