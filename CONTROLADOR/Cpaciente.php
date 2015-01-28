<?php
       session_start();
     if(!isset($_SESSION['S_user'])){
		header("location:index.php");
		}
require_once("../CADO/ClasePaciente.php");
controlador($_POST['accion']);
function controlador($accion)
{
    $ousuario = new Paciente();
	 if ($accion == 'ELIMINAR') {
        $idpaciente = $_POST[idpaciente];
		 $idficha = $_POST[idficha];
        /**/
        $listar     = $ousuario->eliminarpaciente($idpaciente,$idficha);
       
        exit;
	  }
	  
	  
	  if ($accion == 'PACIENTE2') {
        $idpaciente = $_POST[paciente];
        /**/
        $listar     = $ousuario->datosPaciente($idpaciente);
        while ($fila  = $listar ->fetch()) {
		  	$i   = 0;
            $str = "";
            while ($i < 13) {
                $str = $str . $fila[$i] . "¶";
                $i++;
             
        }
			}
			 echo $str . "";
        exit;
	  }
		
    if ($accion == 'PACIENTEX') {
        $idpaciente = $_POST[paciente];
		$idficha= $_POST[idficha];
        /**/
       $listar = $ousuario->Pacientex($idpaciente,$idficha);
         
        /**/
        
        while ($fila = $listar->fetch()) {
            $i   = 0;
            $str = "";
            while ($i < 70) {
                $str = $str . $fila[$i] . "¶";
                $i++;
            }
        }
        echo $str . "";
        exit;
    }
 
	
	
    if ($accion == 'MODIFICAR') {
        $idsucursal = $_SESSION['S_idsucursal'];
        $id_usuario = $_SESSION['S_user'];
        
        $gruposang    = explode("////", $_POST[gruposang]);
        $fechanac     = $_POST[fecnac];
        $apellidos    = explode(" ", $_POST[apellidos]);
        $sexo         = $_POST[sexo];
        $autogenerado =  $_POST[auto] ;
        
        $listar = $ousuario->modificar(utf8_decode($_POST[apellidos]), utf8_decode($_POST[nombres]), implode('-',array_reverse(explode('/',$_POST[fecing]))), implode('-',array_reverse(explode('/',$_POST[fecnac]))), $_POST[edad], $_POST[tipo_edad], $_POST[sexo], $gruposang[0], $gruposang[1], $autogenerado, $_POST[direccion], $_POST[telefono], $_POST[contaceme], $_POST[teleme], implode('-',array_reverse(explode('/',$_POST[fecinidia]))), implode('-',array_reverse(explode('/',$_POST[fecinidia2]))), $_POST[diagnostico], $_POST[cie10], $_POST[pesoseco], $_POST[d1], $_POST[d2], $_POST[d3], $_POST[d4], $_POST[d5], $_POST[d6], $_POST[d7], $_POST[cboturno], $_POST[alergia], $id_usuario, $idsucursal, $_POST[h1], $_POST[h3], $_POST[h5], $_POST[h2], $_POST[h4], $_POST[h6],implode('-',array_reverse(explode('/',$_POST[fd1]))) , $_POST[rd1],implode('-',array_reverse(explode('/',$_POST[fd2]))) , $_POST[rd2], implode('-',array_reverse(explode('/',$_POST[fd3]))), $_POST[rd3], $_POST[dni], $_POST[idpaciente], $_POST[idficha]);
        if ($listar) {
            echo "Modifico Correctamente";
        }
        exit;
    }
    
    
    
    if ($accion == 'INSERTAR') {
        $idsucursal = $_SESSION['S_idsucursal'];
        $id_usuario = $_SESSION['S_user'];
        
        $gruposang    = explode("////", $_POST[gruposang]);
        $fechanac     = $_POST[fecnac];
        $apellidos    = explode(" ", $_POST[apellidos]);
        $sexo         = $_POST[sexo];
       $autogenerado =  $_POST[auto] ;
     	
		if($_POST[idpaciente]){
			  $listar = $ousuario->insertar2($_POST[idpaciente],utf8_decode($_POST[apellidos]), utf8_decode($_POST[nombres]),implode('-',array_reverse(explode('/',$_POST[fecing]))) ,implode('-',array_reverse(explode('/',$_POST[fecnac]))) , $_POST[edad], $_POST[tipo_edad], $_POST[sexo], $gruposang[0], $gruposang[1], $_POST[auto], $_POST[direccion], $_POST[telefono], $_POST[contaceme], $_POST[teleme],implode('-',array_reverse(explode('/',$_POST[fecinidia]))) ,implode('-',array_reverse(explode('/',$_POST[fecinidia2]))) , $_POST[diagnostico], $_POST[cie10], $_POST[pesoseco], $_POST[d1], $_POST[d2], $_POST[d3], $_POST[d4], $_POST[d5], $_POST[d6], $_POST[d7], $_POST[cboturno], $_POST[alergia], $id_usuario, $idsucursal, $_POST[h1], $_POST[h3], $_POST[h5], $_POST[h2], $_POST[h4], $_POST[h6], implode('-',array_reverse(explode('/',$_POST[fd1]))), $_POST[rd1], implode('-',array_reverse(explode('/',$_POST[fd2]))), $_POST[rd2], implode('-',array_reverse(explode('/',$_POST[fd3]))), $_POST[rd3], $_POST[dni]);
			
			}else {
        $listar = $ousuario->insertar(utf8_decode($_POST[apellidos]), utf8_decode($_POST[nombres]), implode('-',array_reverse(explode('/',$_POST[fecing]))),implode('-',array_reverse(explode('/',$_POST[fecnac]))), $_POST[edad], $_POST[tipo_edad], $_POST[sexo], $gruposang[0], $gruposang[1], $_POST[auto], $_POST[direccion], $_POST[telefono], $_POST[contaceme], $_POST[teleme], implode('-',array_reverse(explode('/',$_POST[fecinidia]))), implode('-',array_reverse(explode('/',$_POST[fecinidia2]))), $_POST[diagnostico], $_POST[cie10], $_POST[pesoseco], $_POST[d1], $_POST[d2], $_POST[d3], $_POST[d4], $_POST[d5], $_POST[d6], $_POST[d7], $_POST[cboturno], $_POST[alergia], $id_usuario, $idsucursal, $_POST[h1], $_POST[h3], $_POST[h5], $_POST[h2], $_POST[h4], $_POST[h6], implode('-',array_reverse(explode('/',$_POST[fd1]))), $_POST[rd1], implode('-',array_reverse(explode('/',$_POST[fd2]))), $_POST[rd2], implode('-',array_reverse(explode('/',$_POST[fd3]))), $_POST[rd3], $_POST[dni]);
		}
		
		
        if ($listar) {
            echo "Inserto Correctamente";
        }
        exit;
    }
    
    if ($accion == 'LISTARTURNOS') {
        $tbl        = "";
        $idsucursal = $_SESSION['S_idsucursal'];
        /*---Sucursal---*/
        $listar     = $ousuario->Listarturno($idsucursal);
        
        while ($fila = $listar->fetch()) {
            $i++;
            
            
            $tbl .= '<option value="' . $fila[0] . '"> ' . $fila[1] . '</option>';
        }
        
        echo $tbl;
        exit();
    }
	 
    if ($accion == 'LISTARPACIENTE2') {
        $tbl          = "";
        $idsucursal   = $_SESSION['S_idsucursal'];
        /*---Sucursal---*/
        $cie10text    = $_POST[cie10text];
        $listar       = $ousuario->Listarpaciente2($idsucursal, $cie10text);
        $i            = 0;
        $codigoinicio = 0;
        $idtabla      = "IdTablaPaciente3";
        while ($fila = $listar->fetch()) {
            $fila[0] = trim($fila[0]);
            $fila[1] = trim($fila[1]);
            $i++;
            if ($i == 1) {
                $codigoinicio = $fila[0];
                $color        = "#c5dbec";
            } else {
                $color = "#FFFFFF";
            }
            
            $tbl .= '<tr  ondblclick="asignar2()" id="' . $i . '" style="cursor:pointer"  onclick=\'javascript:PintarFila("' . $i . '","' . $idtabla . '")\'  alt="' . $fila[3] . '"  title="' . $fila[1] . '" title="'.$fila[0].$fila[1].'"  bgcolor="' . $color . '" ><td>' . $fila[0] . '</td><td>' . $fila[1] . '</td><td>' . $fila[2] . '</td> </tr> ';
        }
        $tbl .= "
  <script language='javascript'>
  		 codigo_fila=1;
		 CodigoPaciente='$codigoinicio';
		  can='" . $i . "';
	 $('#IdBusquedaDIA3').blur();
		</script>   
			   ";
        echo $tbl;
        exit();
    }
    
    if ($accion == 'LISTARPACIENTE') {
        $tbl          = "";
        $idsucursal   =$_SESSION['S_idsucursal'];
        /*---Sucursal---*/
        $cie10text    = $_POST[cie10text];
		if($_POST[k]){
			$listar       = $ousuario->Listarpaciente($idsucursal, $cie10text);
			}
			else {
			$listar       = $ousuario->Listarpacienteto($idsucursal, $cie10text);
				}
        $i            = 0;
        $codigoinicio = 0;
        $idtabla      = "IdTablaPaciente2";
        while ($fila = $listar->fetch()) {
            $fila[0] = trim($fila[0]);
            $fila[1] = trim($fila[1]);
            $i++;
            if ($i == 1) {
                $codigoinicio = $fila[0];
                $color        = "#c5dbec";
            } else {
                $color = "#FFFFFF";
            }
            
            $tbl .= '<tr  title="'.$fila[0]." ".$fila[1].'"  ondblclick="asignar()" id="' . $i . '" style="cursor:pointer"  onclick=\'javascript:PintarFila("' . $i . '","' . $idtabla . '")\'    idpaciente="' . $fila[3] . '" 
			 idficha="' . $fila[4] . '"  bgcolor="' . $color . '" ><td>' . $fila[0] . ', ' . $fila[1] . '</td><td>' . $fila[2] . '</td> </tr> ';
        }
        $tbl .= "
  <script language='javascript'>
  		 codigo_fila=1;
		 CodigoPaciente='$codigoinicio';
		  can='" . $i . "';
	 $('#IdBusquedaDIA2').blur();
		</script>   
			   ";
        echo $tbl;
        exit();
    }
    
    
    
    
    if ($accion == 'LISTARCIE10') {
        $tbl          = "";
        $cie10text    = $_POST[cie10text];
        $listar       = $ousuario->Listarcie10($cie10text);
        $i            = 0;
        $codigoinicio = 0;
        $idtabla      = "IdTablaPaciente";
        while ($fila = $listar->fetch()) {
            $fila[0] = trim($fila[0]);
            $fila[1] = trim($fila[1]);
            $i++;
            if ($i == 1) {
                $codigoinicio = $fila[0];
                $color        = "#c5dbec";
            } else {
                $color = "#FFFFFF";
            }
            
            $tbl .= '<tr  ondblclick="eleccion()" id="' . $i . '" style="cursor:pointer"  onclick=\'javascript:PintarFila("' . $i . '","' . $idtabla . '")\'  alt="' . $fila[0] . '"  title="' . $fila[1] . '"  bgcolor="' . $color . '" ><td>' . $fila[0] . '</td><td>' . $fila[1] . '</td> </tr> ';
        }
        $tbl .= "
  <script language='javascript'>
  		 codigo_fila=1;
		 CodigoCie10='$codigoinicio';
		  can='" . $i . "';
	 $('#IdBusquedaDIA').blur();
		</script>   
			   ";
        echo $tbl;
        exit();
    }
	
	if($accion=='VALIDAR_FEC'){
		$ini=implode('/',array_reverse(explode('/',$_POST[ini])));
		$fin=implode('/',array_reverse(explode('/',$_POST[fin])));
		if($ini>=$fin){
			echo 0;exit;
			}
		echo 1;	
	}
    
}
?>
