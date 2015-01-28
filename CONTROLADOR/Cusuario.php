<?php session_start();
  require_once("../CADO/ClaseUsuario.php");
  controlador($_POST['accion']);
  
  function controlador($accion){
	  
	  $ousuario=new Usuarios();
	  
	  
	   if($accion=='VALIDAR'){
		  $usuario=$_SESSION['S_user'];
		  $contraactual=$_POST[ca];
		  $verificar=$ousuario->Loguearse($usuario,$contraactual);
		 $cantidad=$verificar->rowCount();
		  if($cantidad>0){
			  
			  }else{
				  echo 2;
				    exit();
			   }	  
		  }
	  
	  
	  
	  if($accion=='CAMBIAR'){
		  $usuario=$_SESSION['S_user'];
		  $contraactual=$_POST[ca];
		  $contradespues=$_POST[c1];
		  $verificar=$ousuario->CambiarContra($usuario,$contraactual,$contradespues);
		 $cantidad=$verificar->rowCount();
		  if($cantidad>0){
			  echo 1;
			  }else{
				  echo 2;
				    exit();
				  }
		  
		  
		  }
	   
	   if($accion=='LOGUEARSE'){
		  $rpt=0; 
		 // echo "hola a todos";
          $user=$_POST[user];
		  $pass=$_POST[pass];
		  $verificar=$ousuario->Loguearse($user,$pass);
		  $cantidad=$verificar->rowCount();
		 // $cantidad=0;
		 
		   if($cantidad==0){
			 echo  $rpt=0; exit;
			 }
		   if($cantidad==1){
			   while($fila=$verificar->fetch()){
				  $usuario=$fila[1];
				  $sucursal=$fila[2];
				  $idsucursal=$fila[3];
				 // $cantidad++;
				 } 
			  $_SESSION['S_user']=$usuario;
			  $_SESSION['S_sucursal']=$sucursal;
			  $_SESSION['S_idsucursal']=$idsucursal;
			   echo $rpt=1; exit;
			 }	 
		 }
	    
	   if($accion=='ELIMINAR'){
		 $id=$_POST[id];
         $eliminar=$ousuario->Eliminar($id);
		 $can=$eliminar->rowCount();
		 echo $can;
		  }
		  
		  
	   if($accion=='LISTAR'){
		  $tbl=""; 
		  $usuario=$_POST[usuario];
		  //echo $turno;
		  $listar=$ousuario->ListarXUsuario($_SESSION['S_idsucursal'],$usuario);$i=0;
		  while($fila=$listar->fetch()){
			$i++; 
			//$id=$i;
			
			if($fila[4]==1){ $checked="checked='checked'"; }else{$checked="";}
			
			if($i==1){
		       $color="#E9FFE9";
		     }else{$color="#FFFFFF";}  
		    $tbl.="<tr align='center' bgcolor='$color' id='$i' idusuario='$fila[0]' style='cursor:pointer' onclick=\"javascript:PintarFila('$i')\" ondblclick=\"javascript:SeleccionarBusquedaUsuario()\">
			         <td>$i</td><td>$fila[1]</td><td>$fila[2]</td><td>$fila[3]</td>
					 <td><input type='checkbox' $checked disabled ></td></tr>";
		   }  
			echo $i.'///'.$tbl;  
		  }  
		
		if($accion=="GENERARID"){
		   $generar=$ousuario->MaxId();
		   while($fila=$generar->fetch()){
			   $id=$fila[0]+1;
			   }
			 echo $id;  
		   }
		  
	   if($accion=='GRABAR'){
         $opcion=$_POST[opcion];
		 $id=$_POST[codigo];
		 $dni=$_POST[dni];
		 $nombres=$_POST[nombres];
		 $apellidos=$_POST[apellidos];
		 $user=$_POST[login];
		 $pass=$_POST[pass];
		 $estado=$_POST[estado];
		 $fec_crea=implode('-',array_reverse(explode('/',trim($_POST[fec_crea]))));
		 $user_crea=$_POST[user_crea];
		 $id_grupo_usuario=$_POST[grupo_usuario];
		   if($opcion==1){
			$insertar=$ousuario->Insertar($id,$dni,$nombres,$apellidos,$user,$pass,$fec_crea,$user_crea,$estado,
			                       $id_grupo_usuario,$_SESSION['S_idsucursal']);  
			$can=$insertar->rowCount();
		   }
			if($opcion==2){
		    $modificar=$ousuario->Modificar($id,$dni,$nombres,$apellidos,$user,$pass,$fec_crea,$user_crea,$estado);
			$can=$modificar->rowCount();
		    }
			echo $can;
		 }	
		  
		 if($accion=="LLENAR_FORM"){
			$idusuario=$_POST[idusuario]; 
			$listar=$ousuario->ListarXId($idusuario);
			$respuesta=$listar->fetchAll();
			echo json_encode($respuesta);
		   }	  
		  
	  }
?>
