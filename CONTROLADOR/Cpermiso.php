<?php session_start();
     if(!isset($_SESSION['S_user'])){
		header("location:index.php");
		}
  require_once("../CADO/ClasePermiso.php");
  controlador($_POST['accion']);
  function controlador($accion){
	 $opermisos=new Permisos();
	 if($accion=='GUARDAR'){
		  $idgrupo=$_POST[idgrupo];
		  $idmodulo=$_POST[idmodulo];
		  //echo $idgrupo;
		  $listar=$opermisos->listaropciones($idmodulo);
		  //echo "a-$idmodulo";
		    while($fila=$listar->fetch()){ 
			//echo $_POST["OPCION".$fila[0]];
			  $opermisos->insertaropcionxgrupo($idgrupo,$fila[0],$_POST["OPCION".$fila[0]]);
			 }
			 $cant= $listar->rowCount();
			  if($cant>0){echo 1;}
			 exit();
		 }
	 
	 
	 
	 if($accion=='LISTAROPCION'){
		  $tbl=""; 
		  $idgrupo=(int)$_POST[idgrupo];
		  $idmodulo=(int)$_POST[idmodulo];
		  $listar=$opermisos->Veropciones($idmodulo,$idgrupo);
		  $i=0;
		  $codigoinicio=0;
		  $idtabla="TablaOpciones";
		  while($fila=$listar->fetch()){
			  $i++;
			  if($i==1){
				 $codigoinicio=$fila[0];
		   $color="#c5dbec";
		 }else{$color="#FFFFFF";}
		 if($fila[5]==1){
				$check='<input   onclick=\'javascript:cambio(this.checked,"'.$fila[0].'")\' checked="checked" id="OPCION'.$fila[0].'" name="OPCION'.$fila[0].'"   type="checkbox" value="1" />';
				}
				else {
				$check='<input   onclick=\'javascript:cambio(this.checked,"'.$fila[0].'")\' id="OPCION'.$fila[0].'" name="OPCION'.$fila[0].'"   type="checkbox" value="1" />
					<script language="javascript">
				cambio(false,"'.$fila[0].'")
				</script>
				';	
					}
			
		    $tbl.='<tr alt="'.$fila[0].'"  id="LO'.$fila[0].'" style="cursor:pointer"  onclick=\'javascript:PintarFila("LO'.$fila[0].'","'.$idtabla.'")\'    bgcolor="'.$color.'" ><td>'.$fila[1] .'</td><td>Menu: '.utf8_encode($fila[2]).'</td><td align="center">  '.$check.'</td>  </tr> ';
			
			  $listar2=$opermisos->Veropciones2($idmodulo,$idgrupo,$fila[0]);
			  while($fila2=$listar2->fetch()){
			 
		 	
			if($fila2[5]==1){
				 if($i==1){
				 $codigoinicio=$fila2[0];
		   $color="#c5dbec";
		 }else{$color="#FFFFFF";}
				$check='<input title="'.$fila[0].'" checked="checked" id="OPCION'.$fila2[0].'" name="OPCION'.$fila2[0].'"   type="checkbox" value="1" />';
				}
				else {
				$check='<input  title="'.$fila[0].'" id="OPCION'.$fila2[0].'" name="OPCION'.$fila2[0].'"   type="checkbox" value="1" />';	
					}
			
		    $tbl.='<tr   alt="'.$fila2[0].'"  id="La'.$fila2[0].'" style="cursor:pointer"  onclick=\'javascript:PintarFila("La'.$fila2[0].'","'.$idtabla.'")\'    bgcolor="'.$color2.'" ><td>'.$fila2[1] .'</td><td>Menu: '.utf8_encode($fila[2]).' Submenu: '.utf8_encode($fila2[2]).'</td><td align="center">  '.$check.'</td>  </tr> ';
			  }  
			   }	
			  
			echo $tbl;  
			 exit();
		  }	    
		  
		  
		  
	  if($accion=='ASIGNAR'){
		   $idgrupo=(int)$_POST[idgrupo];
		   $idmodulo=(int)$_POST[idmodulo];
		   $res=$opermisos->asignar($idmodulo,$idgrupo);
		// if( $res)  echo 1 ;
		    exit();
		  }
		  if($accion=='DESASIGNAR'){
		   $idgrupo=(int)$_POST[idgrupo];
		   $idmodulo=(int)$_POST[idmodulo];
		   $res=$opermisos->desasignar($idmodulo,$idgrupo);
		// if( $res)  echo 1 ;
		    exit();
		  }
	  if($accion=='LISTARMODULOSASIGNADOS'){
		  $tbl=""; 
		  $idgrupo=(int)$_POST[idgrupo];
		  $listar=$opermisos->ListarModulosxGrupoA($idgrupo);
		  $i=0;
		  $codigoinicio=0;
		  $idtabla="ModulosAsignados";
		  while($fila=$listar->fetch()){
			 $i++;
			  if($i==1){
				 $codigoinicio=$fila[0];
		   $color="#c5dbec";
		 }else{$color="#FFFFFF";}
		 
		    $tbl.='<tr  id="N'.$fila[0].'" style="cursor:pointer"  onclick=\'javascript:PintarFila("N'.$fila[0].'","'.$idtabla.'")\'  alt="'.$fila[0].'"   bgcolor="'.$color.'" ><td>'.$fila[0] .'</td><td>'.$fila[1] .'</td> </tr> ';
			  } 
			$tbl.="
			<script language='javascript'>
	//Primer Codigo Seleccionado!!!
		 CodigoModuloAsignado='$codigoinicio'
		</script>   
			   ";
			echo $tbl;  exit();
		  }	 
	 if($accion=='LISTARMODULOSNOASIGNADOS'){
		  $tbl=""; 
		  $idgrupo=(int)$_POST[idgrupo];
		  $listar=$opermisos->ListarModulosxGrupoNA($idgrupo);
		  $i=0;
		  $codigoinicio=0;
		  $idtabla="ModulosAsignados2";
		  while($fila=$listar->fetch()){
			 $i++;
			  if($i==1){
				 $codigoinicio=$fila[0];
		   $color="#c5dbec";
		 }else{$color="#FFFFFF";}
		 
		    $tbl.='<tr  id="N'.$fila[0].'" style="cursor:pointer"  onclick=\'javascript:PintarFila("N'.$fila[0].'","'.$idtabla.'")\'  alt="'.$fila[0].'"   bgcolor="'.$color.'" ><td>'.$fila[0] .'</td><td>'.$fila[1] .'</td> </tr> ';
			  } 
			$tbl.="
			<script language='javascript'>
	//Primer Codigo Seleccionado!!!
		CodigoModuloNoAsignado='$codigoinicio'
		</script>   
			   ";
			echo $tbl;  exit(); 
		  }	 
		  
		  
	 if($accion=='LISTARUSUARIOSXGRUPO'){
		  $tbl=""; 
		  $idgrupo=(int)$_POST[idgrupo];
		  $listar=$opermisos->ListarUsuariosxGrupo($idgrupo);
		  $i=0;
		  $codigoinicio=0;
		  $idtabla="TablaUsuarios";
		  while($fila=$listar->fetch()){
			 $i++;
			  if($i==1){
				 $codigoinicio=$fila[0];
		   $color="#c5dbec";
		 }else{$color="#FFFFFF";}
		 
		    $tbl.='<tr  id="U'.$fila[0].'" style="cursor:pointer"  onclick=\'javascript:PintarFila("U'.$fila[0].'","'.$idtabla.'")\'    bgcolor="'.$color.'" ><td>'.$fila[0] .'</td><td>'.utf8_encode($fila[1]).'</td><td>'.utf8_encode($fila[2]).'</td><td>'.utf8_encode($fila[3]).'</td> </tr> ';
			  } 
			  
			   $tbl.="";
			echo $tbl;  
		  }	    
		   if($accion=='LISTARGRUPO'){
		  $tbl=""; 
		  $listar=$opermisos->ListarGrupo();
		  $i=0;
		  $codigoinicio=0;
		  $idtabla="TablaGrupoUsuarios";
		  while($fila=$listar->fetch()){
			 $i++;
			  if($i==1){
				 $codigoinicio=$fila[0];
		   $color="#c5dbec";
		 }else{$color="#FFFFFF";}
		 
		    $tbl.='<tr  id="'.$fila[0].'" style="cursor:pointer"  onclick=\'javascript:PintarFila("'.$fila[0].'","'.$idtabla.'")\'    bgcolor="'.$color.'" ><td>'.$fila[0] .'</td><td>'.utf8_encode($fila[1]).'</td> </tr> ';
			  } 
			  
			   $tbl.="
	<script language='javascript'>
	//Primer Codigo Seleccionado!!!
		CodigoGrupoUsuarios='$codigoinicio'
		</script>	";
			echo $tbl;   exit();
		  }	    
   } 	  
?>