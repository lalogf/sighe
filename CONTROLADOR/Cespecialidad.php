<?php session_start();
     if(!isset($_SESSION['S_user'])){
		header("location:index.php");
		}
  require_once("../CADO/ClaseEspecialidad.php");
  controlador($_POST['accion']);
  
  function controlador($accion){
	  
	  $oespecialidad=new Especialidades();
	   
	   	   if($accion=='LISTAR'){
		  $tbl=""; 
		  $especialidad=$_POST[especilidad];
		  $listar=$oespecialidad->ListarXEspecialidad($especialidad);$i=0;
		  while($fila=$listar->fetch()){
			$i++; 
			//$id=$i;
			
			if($fila[2]==1){ $checked="checked='checked'"; }else{$checked="";}
			
			if($i==1){
		       $color="#E9FFE9";
		     }else{$color="#FFFFFF";}  
		    $tbl.="<tr align='center' bgcolor='$color' id='$i' idespecialidad='$fila[0]' style='cursor:pointer' onclick=\"javascript:PintarFila('$i')\" ondblclick=\"javascript:SeleccionarBusquedaEspecialidad()\">
			         <td>$i</td><td>$fila[1]</td><td><input type='checkbox' $checked disabled /></td></tr>";
		   }  
			echo $i.'///'.$tbl;  
		  }
	   	 
	   
	   if($accion=='GRABAR'){
         $opcion=$_POST[opcion];
		 $codigo=$_POST[codigo];
		 $especialidad=$_POST[especialidad];
		 $estado=$_POST[estado];
		 $fec_crea=implode('-',array_reverse(explode('/',trim($_POST[fec_crea]))));
		 //echo $opcion ;exit;
		 $user_crea=$_POST[user_crea];
		   if($opcion==1){
		    $insertar=$oespecialidad->Insertar($codigo,$especialidad,$fec_crea,$user_crea,$estado);
			$can=$insertar->rowCount();
		   }
			if($opcion==2){
		    $modificar=$oespecialidad->Modificar($codigo,$especialidad,$estado);
			$can=$modificar->rowCount();
		    }
			echo $can;
		 }	  
	   if($accion=='ELIMINAR'){
		 $id=$_POST[id];
         $eliminar=$oespecialidad->Eliminar($id);
		 $can=$eliminar->rowCount();
		 echo $can;
		  }
	   	  
		if($accion=="GENERARID"){
		   $generar=$oespecialidad->MaxId();
		   while($fila=$generar->fetch()){
			   $id=$fila[0]+1;
			   }
			 echo $id;  
		   }   
	     if($accion=="LLENAR_FORM"){
			$idespecialidad=$_POST[idespecialidad]; 
			$listar=$oespecialidad->ListarXId($idespecialidad);
			$respuesta=$listar->fetchAll();
			echo json_encode($respuesta);
		   }
		  
	   	  
   }
?>