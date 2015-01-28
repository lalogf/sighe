$(document).ready(function() {  	

				$('#TablaHisProtocolos').fixheadertable({ 
							//caption : "HISTORIAL FICHAS DE ATENCION", 
							colratio : [50,320,150], 
							height : 200, 
							width :730, 
							zebra : true, 
							sortable : false, 
							sortedColId : 3, 
							dateFormat : 'm/d/Y',
							pager : false,
							rowsPerPage	 : 10,
							resizeCol : true
				});
				
				$('#TablaBusHProPac').fixheadertable({ 
							//caption : "HISTORIAL FICHAS DE ATENCION", 
							colratio : [50,250,100], 
							height : 200, 
							width :415, 
							zebra : true, 
							sortable : false, 
							sortedColId : 3, 
							dateFormat : 'm/d/Y',
							pager : false,
							rowsPerPage	 : 10,
							resizeCol : true
				});
				
});


function RealizaBusquedaHProPac(){
	var $paciente=$("#IdBusHProPac").val(); 
	$("#CuerpoBusHProPac").html("<tr><td colspan='2'><img src='LIBRERIAS/IMAGENES/cargando.gif' /> Cargando ..</td></tr>");
	$.post('CONTROLADOR/Chistorial_protocolos.php',{accion:'BUSCAR',paciente:$paciente},function(data){
		 var $data=data.split("///");
		 if($data[0]==0){
			 $("#CuerpoBusHProPac").html("<tr><td colspan='3'>No hay resultados ..</td></tr>");exit;
			 }
		 $("#CanBusHPro").val($data[0]);
		 $("#CuerpoBusHProPac").html($data[1]);
		 $("#IdNumFilaHPro").val(1)
		 })
	exit;	 
  }
  
  function BusPac(){
 // $("#IdBusHProPac").keypress(function(e){
	    //if(e.keyCode==13){
			$("#IdBusHProPac").blur();
			RealizaBusquedaHProPac();
		 // }
	  //})
   }
	  
	$(document).keydown(function(e){
           if (e.keyCode==40) {
			      var $num_fila=parseInt($("#IdNumFilaHPro").val());
				  var $tr=$num_fila+1;
				  $can=parseInt($("#CanBusHPro").val());
				  if($num_fila<$can){
					$("#"+$num_fila).css({background:"#FFFFFF"});  
			        $("#"+$tr).css({background:"#c5dbec"});
				    $("#IdNumFilaHPro").val($tr);
			       }
			}
			if (e.keyCode==38) {
			      var $num_fila=parseInt($("#IdNumFilaHPro").val());
				  var $tr=$num_fila-1;
				  if($num_fila>1){
					$("#"+$num_fila).css({background:"#FFFFFF"});  
			        $("#"+$tr).css({background:"#c5dbec"});
				    $("#IdNumFilaHPro").val($tr);
			       }
			}exit;
   });  
   
   function PintarFilaHisPro($num_fila){
	   $("#CuerpoBusHProPac tr").css({background:"#FFFFFF"});
	   $("#"+$num_fila).css({background:"#E9FFE9", cursor:"pointer"});
	   $("#IdNumFilaHPro").val($num_fila);
	 } 
	 
  function SeleccionarBusquedaHPro(){
		  $("#DivBuscarHProPac").hide(50);
		 var $fila=$("#IdNumFilaHPro").val();
		 var $idHPro=$("#"+$fila).attr("idHPro");//alert($idgrupo);exit;
		 //$("#IdPacienteHPro").val($paciente);
		// var $mes=$("#IdMes").val();
		 //var $anio=$("#IdAnio").val();
		$.post('CONTROLADOR/Chistorial_protocolos.php',{accion:'GENERAR_PAC',idHPro:$idHPro},function(data){
			 var $data=data.split("///");
			 $("#IdPacienteHPro").val($data[1]);
			 $("#IdProPaciente").val($data[0]);
			// if($data[1]==""){
				//$("#CuerpoHPro").html("<tr><td colspan='5'>No tiene Protocolos ..</td></tr>"); exit;
				// }
			// $("#CuerpoHPro").html(data);
		 })
	  } 	 
	function ConsultarProtocolo(){
		//alert("ok");
		 var $id_pac=$("#IdProPaciente").val();
		 var $mes=$("#IdMes").val();
		 var $anio=$("#IdAnio").val();
		 //alert($id_pac);exit;
		 $.post('CONTROLADOR/Chistorial_protocolos.php',{accion:'LLENAR_PROTOCOLOS',idpaciente:$id_pac,mes:$mes,anio:$anio},function(data){
			// alert(data);
			 $("#CuerpoHProtocolo").html(data);
		   })
		} 
 /* function AbrirMensajeHF($idficha){
	  $("#IdHidenFicha").val($idficha);
	  $('#IdMensajeHF').show(1000);
   } */ 

  function VerHPro($idprogramacion,$frecuencia,$turno,$fec){
	  window.open('PdfProtocoloHemodialisis.php?id='+$idprogramacion+"&frecuencia="+$frecuencia+"&turno="+$turno+"&fec="+$fec,"VerProtocolo", "top=150,left=200,menubar=no,location=no,status=no,resizable=no,scrollbars=no,width=600,height=400,toolbar=no"); 
   }	