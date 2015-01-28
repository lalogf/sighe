<?php session_start();
     if(!isset($_SESSION['S_user'])){
		header("location:index.php");
		}
  require_once("../CADO/ClaseMedicamento.php");
  controlador($_POST['accion']);
  
  function controlador($accion){
	  
	  $omedicamento=new Medicamentos();
	   
	   if($accion=='LISTAR'){
		  $tbl=""; 
		  $medicamento=$_POST[medicamento];
		  $listar=$omedicamento->ListarXMedicamento($medicamento);$i=0;
		  while($fila=$listar->fetch()){
			$i++; 
			if($i==1){
		       $color="#c5dbec";
		     }else{$color="#FFFFFF";}  
		    $tbl.="<tr align='center' bgcolor='$color' id='$i' idmedicamento='$fila[0]' style='cursor:pointer' onclick=\"javascript:PintarFila('$i')\" ondblclick=\"javascript:SeleccionarMedicamento()\">
			         <td>$i</td><td>$fila[1]</td><td>$fila[2]</td><td>$fila[3]</td><td>$fila[4]</td>
					 <td><input type='checkbox' disabled='disabled' if($fila[4]==1){ checked='checked'}  /></td></tr>";
		   }  
			echo $i.'///'.$tbl;  
		  }
	   	 
	   
	   if($accion=='GRABAR'){
         $opcion=$_POST[opcion];
		 $id=$_POST[id];
		 $codigo=$_POST[codigo];
		 $medicamento=$_POST[medicamento];
		 $presentacion=$_POST[presentacion];
		 $unidad=$_POST[unidad];
		 $estado=$_POST[estado];
		 $fec_crea=implode('-',array_reverse(explode('/',trim($_POST[fec_crea]))));
		 //echo $opcion ;exit;
		 $user_crea=$_POST[user_crea];
		   if($opcion==1){
             $insertar=$omedicamento->Insertar($id,$codigo,$medicamento,$presentacion,$unidad,$fec_crea,$user_crea,$estado);
			$can=$insertar->rowCount();
		   }
			if($opcion==2){
		    $modificar=$omedicamento->Modificar($id,$codigo,$medicamento,$presentacion,$unidad,$estado);
			$can=$modificar->rowCount();
		    }
			echo $can;
		 }	  
	   if($accion=='ELIMINAR'){
		 $id=$_POST[id];
         $eliminar=$omedicamento->Eliminar($id);
		 $can=$eliminar->rowCount();
		 echo $can;
		  }
	   	  
		if($accion=="GENERARID"){
		   $generar=$omedicamento->MaxId();
		   while($fila=$generar->fetch()){
			   $id=$fila[0]+1;
			   }
			 echo $id;  
		   }   
	     if($accion=="LLENAR_FORM"){
			$idmedicamento=$_POST[idmedicamento]; 
			$listar=$omedicamento->ListarXId($idmedicamento);
			$respuesta=$listar->fetchAll();
			echo json_encode($respuesta);
		   }
		  
	   
		  
		 	  
		  
	  }
?>