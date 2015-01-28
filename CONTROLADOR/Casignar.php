<?php session_start();
     if(!isset($_SESSION['S_user'])){
		header("location:index.php");
		}
require_once("../CADO/ClaseAsignar.php");
controlador($_POST['accion']);
if(!isset($_SESSION['S_user'])){
		header("location:../index.php");
	}

function controlador($accion)
{
	
 	$oasignar = new Asignar();
	date_default_timezone_set('America/Lima');
	
	if ($accion == 'IMPRIMIR') {
		 $idsucursal = $_SESSION['S_idsucursal'];
       $fecha1   = $_POST[fecha]; 
	   
	    $listar = $oasignar->turnos($idsucursal);
		$listarmodulos=   $oasignar->modulo($_POST[idmodulo],$idsucursal);
		while ($fila = $listarmodulos->fetch()) {
		$modulo=$fila[1];
		}
		$i=0;
		
		 while ($fila = $listar->fetch()) {
			 $j=0;
			 while($j<6){
			    $listar2=   $oasignar->ListarAsignar2($fila[0],$fecha1,$idsucursal);
			 	$cadena[$j]="";
			     
			    $fecha1= date("Y-m-d", strtotime("$fecha1 + 1 days"));
				while ($fila2 = $listar2->fetch()) {
				$cadena[$j].="*".substr($fila2[0],0,35)."<br>";
				 
				}
			    $j++;
			 }
			 $i++;
	   $tabla.="  <tr>
      <td align='center'><strong> ".to_roman($i)."<br />T<br />U<br />R<br />N<br />O</strong><br /></td>
      <td>$cadena[0]</td>
      <td>$cadena[1]</td>
      <td>$cadena[2]</td>
      <td>$cadena[3]</td>
      <td>$cadena[4]</td>
      <td>$cadena[5]</td>
    </tr> ";
	      $fecha1=$_POST[fecha];
		}
		$listar = $oasignar->turnos($idsucursal);
		$i=0;
		 while ($fila = $listar->fetch()) {
			 $i++;
	   $tabla2.= to_roman($i)." TURNO: ".$fila[1]."<br>";
	    
		}
		echo $modulo."///".$tabla."///".$tabla2;
		exit();
		
	}
	
	
	if ($accion == 'LIMPIAR') {
        $turno   = $_POST[turno];
        $fecha   = $_POST[fecha];
  		 $listar = $oasignar->ax($turno, $_POST[fecha]);
	  	exit();
	}
	
	
    $oasignar = new Asignar();
	if ($accion == 'ELIMINAR') {
        $turno   = $_POST[turno];
        $fecha   = $_POST[fecha];
        $idficha = $_POST[id_ficha_atencion];
		 $listar = $oasignar->eliminarreprogramacion($turno, $_POST[fecha],  $idficha);
	 
		exit();
	}
    if ($accion == 'INSERTARC') {
        $turno   = $_POST[turno];
        $fecha   = $_POST[fecha];
        $idficha = $_POST[id_ficha_atencion];
		$dia2= $_POST[diare2];
	 	$listar4  = $oasignar->cualestado3($_POST[turnore], $_POST[fechare], $idficha,$dia2);
			  while ($fila4 = $listar4->fetch()) {
				  $conas=$fila4[0];
			  }
			  if($conas>0){ echo 5;exit();}
	 	
        if ($_POST[fecha] == $_POST[fechare] && $_POST[turno] == $_POST[turnore]) {
            echo 2;
            exit();
        }
        $listar = $oasignar->unico2($turno, $_POST[fechare], $_POST[turnore]);
        while ($fila = $listar->fetch()) {
            $cant2 = $fila[0];
        }
        if ($cant2 > 0) {
            echo 3;
            exit;
        }
        $listar = $oasignar->unico($turno, $fecha, $idficha);
        while ($fila = $listar->fetch()) {
            $cant = $fila[0];
        }
       
	    if ($cant == 0) {
            $res = $oasignar->insertar2($_POST[frecuencia], $_POST[diaprogramado], $_POST[obs], $_POST[estado], $_POST[idmodulo], $_POST[id_ficha_atencion], $_POST[turno], $_POST[fecha], $_POST[fechare], $_POST[turnore], strtoupper(substr($_POST[diare], 0, 3)) . " - " . $_POST[turnotext2]);
            echo 1;
            /*Todo Ok*/
            exit();
        } else {
			 $listar  = $oasignar->cualestado2($turno, $fecha, $idficha);
			  while ($fila = $listar->fetch()) {
				  $con=$fila[0];
			  }
			  if($con>0){ echo 4;exit();}
			  
			  
             $oasignar->modificarre($_POST[turno], $_POST[fecha], $_POST[id_ficha_atencion], $_POST[fechare], $_POST[turnore], strtoupper(substr($_POST[diare], 0, 3)) . " - " . $_POST[turnotext2]);
            echo 1;
            /*Todo Ok*/
            exit();
        }
        exit();
    }
    
    if ($accion == 'INSERTARB') {
        $turno   = $_POST[turno];
        $fecha   = $_POST[fecha];
        $idficha = $_POST[id_ficha_atencion];
		if(!($_POST[id_ficha_atencion])){exit();}
        $listar  = $oasignar->unico($turno, $fecha, $idficha);
        while ($fila = $listar->fetch()) {
            $cant = $fila[0];
        }
        if ($cant == 0) {
            $res = $oasignar->insertar($_POST[frecuencia], $_POST[diaprogramado], $_POST[obs], $_POST[estado], $_POST[idmodulo], $_POST[id_ficha_atencion], $_POST[turno], $_POST[fecha]);
            	if($_POST[estado]==1){
				$generar_id=$oasignar->IdHemodialisis();
		         while($fila=$generar_id->fetch()){
			      $idhemodialisis=$fila[0];  
			       } 
			 $listar  = $oasignar->generaridprogramacion($turno, $fecha, $idficha);
			  while ($fila = $listar->fetch()) {
				  $idprogramacion=$fila[0];
			  }
			  $listar  = $oasignar->generaridpaciente($idficha);
			  while ($fila = $listar->fetch()) {
				  $idpaciente=$fila[0];
			  }			  
				$x= $oasignar->InsertarProtocolo($idhemodialisis,$_POST[id_ficha_atencion],$idprogramacion,$idpaciente,$med_procli,$med_evolucion,$med_hras_hd,$med_heparina,$med_pesoseco,$med_extraccion,$med_areafiltro,$med_membrana,$med_cond_sero,$med_qb,$med_qd,$med_hco3,$med_temp_maq,$med_conduc,$med_na_inicial,$med_na_final,$enf_inicia,$cep_inicia,$enf_finaliza,          $cep_finaliza,$enfe_pa_inicial,$enfe_fc_inicial,$enfe_peso_inicial,$enfe_uf_inicial,$enfe_pa_final,$enfe_fc_final,$enfe_peso_final,$enfe_uf_final,$enfe_art_fav,$enfe_art_inj,$enfe_art_cvc,$enfe_art_cvlp,$enfe_ven_fav,$enfe_ven_inj,$enfe_ven_cvc,$enfe_ven_cvlp,$enfe_ven_vp,$enfe_num_maq,$enfe_marca_mod,$enfe_vol_filtro,$enfe_reuso_filtro,$enfe_heparina,$enfe_val_inicial,$enfe_val_final,$enfe_asp_filtro);
				$cantidad_hemo= $x->rowCount();
				if($cantidad_hemo==1){
			    $oasignar->ActualizarCorrelativoTabla($idhemodialisis);
			    }
				}else{
					 $listar  = $oasignar->generaridprogramacion($turno, $fecha, $idficha);
			  while ($fila = $listar->fetch()) {
				  $idprogramacion=$fila[0];
			  }  $oasignar->EliminarProtocolo($idprogramacion);
					}
        } else {
			 $listar  = $oasignar->cualestado2($turno, $fecha, $idficha);
			  while ($fila = $listar->fetch()) {
				  $con=$fila[0];
			  }
			  if($con>0){ echo 2;exit();}
			  
            $listar = $oasignar->modificarestado($turno, $fecha, $idficha, $_POST[estado]);
            	if($_POST[estado]==1){
				$generar_id=$oasignar->IdHemodialisis();
		         while($fila=$generar_id->fetch()){
			      $idhemodialisis=$fila[0];  
			       } 
			 $listar  = $oasignar->generaridprogramacion($turno, $fecha, $idficha);
			  while ($fila = $listar->fetch()) {
				  $idprogramacion=$fila[0];
			  }
			  $listar  = $oasignar->generaridpaciente($idficha);
			  while ($fila = $listar->fetch()) {
				  $idpaciente=$fila[0];
			  }			  
				$x= $oasignar->InsertarProtocolo($idhemodialisis,$_POST[id_ficha_atencion],$idprogramacion,$idpaciente,$med_procli,$med_evolucion,$med_hras_hd,$med_heparina,$med_pesoseco,$med_extraccion,$med_areafiltro,$med_membrana,$med_cond_sero,$med_qb,$med_qd,$med_hco3,$med_temp_maq,$med_conduc,$med_na_inicial,$med_na_final,$enf_inicia,$cep_inicia,$enf_finaliza,          $cep_finaliza,$enfe_pa_inicial,$enfe_fc_inicial,$enfe_peso_inicial,$enfe_uf_inicial,$enfe_pa_final,$enfe_fc_final,$enfe_peso_final,$enfe_uf_final,$enfe_art_fav,$enfe_art_inj,$enfe_art_cvc,$enfe_art_cvlp,$enfe_ven_fav,$enfe_ven_inj,$enfe_ven_cvc,$enfe_ven_cvlp,$enfe_ven_vp,$enfe_num_maq,$enfe_marca_mod,$enfe_vol_filtro,$enfe_reuso_filtro,$enfe_heparina,$enfe_val_inicial,$enfe_val_final,$enfe_asp_filtro);
				$cantidad_hemo= $x->rowCount();
				if($cantidad_hemo==1){
			    $oasignar->ActualizarCorrelativoTabla($idhemodialisis);
			    }
				}else{
					 $listar  = $oasignar->generaridprogramacion($turno, $fecha, $idficha);
			  while ($fila = $listar->fetch()) {
				  $idprogramacion=$fila[0];
			  }  $oasignar->EliminarProtocolo($idprogramacion);
					}
        }
        exit();
    }
    /**/
    if ($accion == 'INSERTARA') {
        $turno   = $_POST[turno];
        $fecha   = $_POST[fecha];
        $idficha = $_POST[id_ficha_atencion];
        $listar  = $oasignar->unico($turno, $fecha, $idficha);
        while ($fila = $listar->fetch()) {
            $cant = $fila[0];
        }
        if ($cant == 0) {
            $res = $oasignar->insertar($_POST[frecuencia], $_POST[diaprogramado], $_POST[obs], $_POST[estado], $_POST[idmodulo], $_POST[id_ficha_atencion], $_POST[turno], $_POST[fecha]);
            
        } else {
			
			 $listar  = $oasignar->cualestado2($turno, $fecha, $idficha);
			  while ($fila = $listar->fetch()) {
				  $con=$fila[0];
			  }
			  if($con>0){ echo 2;exit();}
             $oasignar->modificarmodulo($turno, $fecha, $idficha, $_POST[idmodulo]);
            
        }
        exit();
    }
    /**/
    if ($accion == 'LISTAR') {
        $tbl          = "";
        $idsucursal   = $_SESSION['S_idsucursal'];
        /*---Sucursal---*/
        $dia          = $_POST[dia];
        $turno        = $_POST[turno];
        $fecha        = $_POST[fecha];
        $listar       = $oasignar->ListarAsignar($turno, $dia, $fecha, $idsucursal);
        $i            = 0;
        $codigoinicio = 0;
        $idtabla      = "tabla";
        $reestablecer .= "<script > function res() {";
        while ($fila = $listar->fetch()) {
            $i++;
            if ($i == 1) {
                $codigoinicio = $fila[0];
                $color        = "#c5dbec";
            } else {
                $color = "#FFFFFF";
            }
            
            if ($fila[5]) {
                $a = "A";
                 $reestablecer .= '$("#' . $i . '").css("background-color","#FFFFFF");';
            } else {
                $listartt = $oasignar->res1($turno, $fecha, $fila[0]);
                
                while ($filatt = $listartt->fetch()) {
                    $restt = $filatt[0];
                }
                if ($restt) {
                    $reestablecer .= '$("#' . $i . '").css("background-color","#FFFFFF");';
                } else {
                     $reestablecer .= '$("#' . $i . '").css("background-color","#FFFFFF");';
                }
            }
            
            $str = $fila[4];
            if ($str[strlen($str) - 1] == "-")
                $fila[4] = substr($str, 0, strlen($str) - 1);
            /*combito*/
            
            $reprod        = "";
            $turnod        = "";
            $fechand       = "";
            $diaprogramado = strtoupper(substr($dia, 0, 3)) . " - " . $_POST[turnotext];
            $listarn       = $oasignar->cualre($turno, $fecha, $fila[0]);
            while ($filan = $listarn->fetch()) {
                
                if ($filan[0]) {
                    $diaprogramado = $filan[3];
                    $reprod        = $filan[0].'<a onclick=\'Eliminar('.$fila[0].',"'.$fecha. '","' . $turno   . '")\' href="#"> <img src="LIBRERIAS/IMAGENES/btn3.jpg" height="15" width="15" border="0"> </a>';
                    $turnod        = $filan[1];
                    $fechad        = $filan[2];
                }
            }
            $listar2 = $oasignar->modulos($idsucursal);
            //\'javascript:PintarFila("' . $i . '","' . $idtabla . '")\
            $combo .= '<select onchange=\'InsertarA(this.value,' . $fila[0] . ',"' . $fila[4] . '","' . $diaprogramado . '")\' id="modulo' . $i . '" name="modulo' . $i . '" > <option value="0">Elejir</option>			 ';
            while ($fila2 = $listar2->fetch()) {
                $combo .= "<option value='" . $fila2[0] . "'>" . $fila2[1] . "</option>";
            }
            $combo .= "</select>";
            /*combito :3 */
            
            if ($fila[5]) {
                
                
                $reenvio = ' <a onclick=\'Reprogramar(' . $fila[0] . ',"' . $fila[4] . '","' . $diaprogramado . '","' . $turnod . '","' . $fechad . '")\' >  ' . 'Reprogramar</a> ';
            } else {
                
                $reenvio = ' <a onclick=\'Reprogramar(' . $fila[0] . ',"' . $fila[4] . '","' . $diaprogramado . '","' . $turnod . '","' . $fechad . '")\' >  ' . 'Reprogramar</a> ';
            }
            
            $tbl .= '<tr     ondblclick="" id="' . $i . '" style="cursor:pointer"  
			onclick=\'javascript:PintarFila("' . $i . '","' . $idtabla . '")\'  alt="' . $fila[3] . '"  title="' . $fila[2] . " " . $fila[3] . '"    >
			<td  align="center">' . $i . '</td>
			<td >' . strtoupper($fila[2] . " " . $fila[3]) . '</td>
			<td align="center">' . $fila[4] . '</td>
			<td align="center">' . $diaprogramado . '</td> 
			<td align="center">' . $reprod . '</td> 
			<td align="center">' . $combo . '</td> 
			<td align="center">' . '<input type="checkbox"  id="check' . $i . '"  diaprogramado="' . $diaprogramado . '" frecuencia="' . $fila[4] . '"  idficha="' . $fila[0] . '" alt="xd1" />' . '</td> 
			<td align="center">' . $reenvio . '</td> 
			</tr> ';
            $combo   = '';
            $listar3 = $oasignar->cualmodulo($turno, $fecha, $fila[0]);
            while ($fila3 = $listar3->fetch()) {
                $tbl .= "
  <script language='javascript'>
 
  		  $('#modulo" . $i . "').val('" . $fila3[0] . "')
 </script>   
			   ";
            }
            $listar4 = $oasignar->cualestado($turno, $fecha, $fila[0]);
            while ($fila4 = $listar4->fetch()) {
                if ($fila4[0] == 1) {
                    $tbl .= "
  <script language='javascript'>
    function a(){
		alert()
		}
  		  $('#check" . $i . "').attr('checked',true)
 </script>   
			   ";
                }
            }
        }
        $tbl .= "
  <script language='javascript'>
  		 codigo_fila=1;
		 PintarFila(1,'tabla')
		 CodigoAsignacion='$codigoinicio';
		 can='" . $i . "';
		 
		 $('input[type=checkbox]').change(function(){	
		if($(this).is(':checked')){estado=1}else {estado=0}
 
	if($(this).attr('alt')=='xd1'){
		InsertarB(estado,$(this).attr('idficha'),$(this).attr('frecuencia'),$(this).attr('diaprogramado')) 
		} 
	 	if($('input[alt=xd1]:checked').length == $('input[alt=xd1]').length){
			 $('input[name=checktodos]').attr('checked',true)
			 
			 
		}else {
			$('input[name=checktodos]').attr('checked',false)
			}
			 
	});
	if($('input[alt=xd1]:checked').length>0){
	if($('input[alt=xd1]:checked').length == $('input[alt=xd1]').length){
			 $('input[name=checktodos]').attr('checked',true)
		}else {
			$('input[name=checktodos]').attr('checked',false)
			}}else {
				$('input[name=checktodos]').attr('checked',false)
				} 
 </script>   
			   ";
        $reestablecer .= " } </script>";
        echo $tbl . "‗‗‗" . $reestablecer;
        exit();
    }
    
    if ($accion == "fecha") {
        $fecha = $_POST[fecha];
        $dias  = $_POST[dias];
        echo date("Y-m-d", strtotime("$fecha +$dias day"));
        exit();
    }
    if ($accion == 'LISTARTURNOS') {
        $tbl        = "";
        $idsucursal = $_SESSION['S_idsucursal'];
        /*---Sucursal---*/
        $listar     = $oasignar->Listarturno($idsucursal);
        
        while ($fila = $listar->fetch()) {
            $i++;
            
            
            $tbl .= '<option value="' . $fila[0] . '"> ' . $fila[1] . '</option>';
        }
        
        echo $tbl;
        exit();
    }
    
    
}

function to_roman($num) {
if ($num <0 || $num >9999) {return -1;}
$r_ones = array(1=>"I", 2=>"II", 3=>"III", 4=>"IV", 5=>"V", 6=>"VI", 7=>"VII", 8=>"VIII", 
9=>"IX");
$r_tens = array(1=>"X", 2=>"XX", 3=>"XXX", 4=>"XL", 5=>"L", 6=>"LX", 7=>"LXX", 
8=>"LXXX", 9=>"XC");
$r_hund = array(1=>"C", 2=>"CC", 3=>"CCC", 4=>"CD", 5=>"D", 6=>"DC", 7=>"DCC", 
8=>"DCCC", 9=>"CM");
$r_thou = array(1=>"M", 2=>"MM", 3=>"MMM", 4=>"MMMM", 5=>"MMMMM", 6=>"MMMMMM", 
7=>"MMMMMMM", 8=>"MMMMMMMM", 9=>"MMMMMMMMM");
$ones = $num % 10;
$tens = ($num - $ones) % 100;
$hundreds = ($num - $tens - $ones) % 1000;
$thou = ($num - $hundreds - $tens - $ones) % 10000;
$tens = $tens / 10;
$hundreds = $hundreds / 100;
$thou = $thou / 1000;
if ($thou) {$rnum .= $r_thou[$thou];} 
if ($hundreds) {$rnum .= $r_hund[$hundreds];} 
if ($tens) {$rnum .= $r_tens[$tens];} 
if ($ones) {$rnum .= $r_ones[$ones];} 
return $rnum;
}
?>