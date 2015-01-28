<?php session_start();
     if(!isset($_SESSION['S_user'])){
		header("location:index.php");
		}
  require_once("../CADO/ClaseSucursal.php");
  controlador($_POST['accion']);
  
  function controlador($accion){
	  
	  $osucursal=new Sucursales();
	   
	   	   if($accion=='LISTAR'){
		  $tbl=""; 
		  $sucursal=$_POST[sucursal];
		  $listar=$osucursal->ListarXSucursal($sucursal);$i=0;
		  while($fila=$listar->fetch()){
			$i++; 
			//$id=$i;
			if($fila[8]==1){ $checked="checked='checked'"; }else{$checked="";}
			
			if($i==1){
		       $color="#E9FFE9";
		     }else{$color="#FFFFFF";}  
		    $tbl.="<tr align='center' bgcolor='$color' id='$i' idsucursal='$fila[0]' style='cursor:pointer' onclick=\"javascript:PintarFila('$i')\" ondblclick=\"javascript:SeleccionarSucursal()\">
			         <td>$i</td><td>$fila[1]</td><td>$fila[2]</td><td><input type='checkbox' $checked disabled /></td></tr>";
		   }  
			echo $i.'///'.$tbl;  
		  }
	   	 
	   
	   if($accion=='GRABAR'){
         $opcion=$_POST[opcion];
		 $codigo=$_POST[codigo];
		 $ruc=$_POST[ruc];
		 $razon=$_POST[razon];
		 $direccion=$_POST[direccion];
		 $responsable=$_POST[responsable];
		 $sobrenombre=$_POST[sobrenombre];
		 $estado=$_POST[estado];
		 $fec_crea=implode('-',array_reverse(explode('/',trim($_POST[fec_crea]))));
		 //echo $opcion ;exit;
		 $user_crea=$_POST[user_crea];
		   if($opcion==1){
$insertar=$osucursal->Insertar($codigo,$ruc,$razon,$direccion,$fec_crea,$user_crea,$responsable,$sobrenombre,$estado);
			$can=$insertar->rowCount();
		   }
			if($opcion==2){
		    $modificar=$osucursal->Modificar($codigo,$ruc,$razon,$direccion,$responsable,$sobrenombre,$estado);
			$can=$modificar->rowCount();
		    }
			echo $can;
		 }	  
	   if($accion=='ELIMINAR'){
		 $id=$_POST[id];
         $eliminar=$osucursal->Eliminar($id);
		 $can=$eliminar->rowCount();
		 echo $can;
		  }
	   	  
		if($accion=="GENERARID"){
		   $generar=$osucursal->MaxId();
		   while($fila=$generar->fetch()){
			   $id=$fila[0]+1;
			   }
			 echo $id;  
		   }   
	     if($accion=="LLENAR_FORM"){
			$idsucursal=$_POST[idsucursal]; 
			$listar=$osucursal->ListarXId($idsucursal);
			$respuesta=$listar->fetchAll();
			echo json_encode($respuesta);
		   }
		  
	   
		  
		 	  
		  
	  }
?>