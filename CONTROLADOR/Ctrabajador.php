<?php session_start();
     if(!isset($_SESSION['S_user'])){
		header("location:index.php");
		}
  require_once("../CADO/ClaseTrabajador.php");
  controlador($_POST['accion']);
  
  function controlador($accion){
	  
	  $otrabajador=new Trabajadores();
	   
	   if($accion=='LISTAR'){
		  $tbl=""; 
		  $trabajador=$_POST[trabajador];
		  $listar=$otrabajador->ListarXTrabajador($trabajador);$i=0;
		  while($fila=$listar->fetch()){
			$i++; 
			
			if($fila[4]==1){ $checked="checked='checked'"; }else{$checked="";}
			
			if($i==1){
		       $color="#E9FFE9";
		     }else{$color="#FFFFFF";}  
		    $tbl.="<tr align='center' bgcolor='$color' id='$i' idtrabajador='$fila[0]' style='cursor:pointer' 
			onclick=\"javascript:PintarFila('$i')\" ondblclick=\"javascript:SeleccionarTrabajador()\">
			         <td>$i</td>
					 <td>$fila[1]</td>
					 <td>$fila[2]</td>
					 <td>$fila[3]</td>
					 <td> <input type='checkbox' $checked disabled='disabled' /></td> </tr>";
					 
		   }  
			echo $i.'///'.$tbl;  
		  }
	   	 
	   
	   if($accion=='GRABAR'){
         $opcion=$_POST[opcion];
		 $codigo=$_POST[codigo];
		 $nombres=$_POST[nombres];
		 $apellidos=$_POST[apellidos];
		 $dni=$_POST[dni];
		 $sexo=$_POST[sexo];
		 $direccion=$_POST[direccion];
		 $telefono=$_POST[telefono];
		 $correo=$_POST[correo];
		 $estado=$_POST[estado];
		 $fec_crea=implode('-',array_reverse(explode('/',trim($_POST[fec_crea]))));
		 //echo $opcion ;exit;
		 $user_crea=$_POST[user_crea];
		 $id_especialidad=$_POST[id_especialidad];
		   if($opcion==1){
$insertar=$otrabajador->Insertar($codigo,$nombres,$apellidos,$dni,$sexo,$direccion,$telefono,$correo,$fec_crea,$user_crea,$estado,$id_especialidad,$_SESSION['S_idsucursal']);
			$can=$insertar->rowCount();
		   }
			if($opcion==2){
		    $modificar=$otrabajador->Modificar($codigo,$nombres,$apellidos,$dni,$sexo,$direccion,$telefono,$correo,$estado,$id_especialidad);
			$can=$modificar->rowCount();
		    }
			echo $can;
		 }	  
	   if($accion=='ELIMINAR'){
		 $id=$_POST[id];
         $eliminar=$otrabajador->Eliminar($id);
		 $can=$eliminar->rowCount();
		 echo $can;
		  }
	   	  
		if($accion=="GENERARID"){
		   $generar=$otrabajador->MaxId();
		   while($fila=$generar->fetch()){
			   $id=$fila[0]+1;
			   }
			 echo $id;  
		   }   
	     if($accion=="LLENAR_FORM"){
			$idtrabajador=$_POST[idtrabajador]; 
			$listar=$otrabajador->ListarXId($idtrabajador);
			$respuesta=$listar->fetchAll();
			echo json_encode($respuesta);
		   }
		  
	   
		  
		 	  
		  
	  }
?>