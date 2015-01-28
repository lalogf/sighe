$(document).ready(function() {  	

				$('#TablaHisFichas').fixheadertable({ 
							caption : "HISTORIAL FICHAS DE ATENCION", 
							colratio : [50,80,80,100,100], 
							height : 200, 
							width :425, 
							zebra : true, 
							sortable : false, 
							sortedColId : 3, 
							dateFormat : 'm/d/Y',
							pager : false,
							rowsPerPage	 : 10,
							resizeCol : true
				});
				
				$('#TablaBusHFPac').fixheadertable({ 
							//caption : "HISTORIAL FICHAS DE ATENCION", 
							colratio : [50,250,100], 
							height : 200, 
							width :425, 
							zebra : true, 
							sortable : false, 
							sortedColId : 3, 
							dateFormat : 'm/d/Y',
							pager : false,
							rowsPerPage	 : 10,
							resizeCol : true
				});
				
});


function RealizaBusquedaHFPac(){
	var $paciente=$("#IdBusHFPac").val(); 
	$("#CuerpoBusHFPac").html("<tr><td colspan='2'><img src='LIBRERIAS/IMAGENES/cargando.gif' /> Cargando ..</td></tr>");
	$.post('CONTROLADOR/Chistorial_fichas.php',{accion:'BUSCAR',paciente:$paciente},function(data){
		 var $data=data.split("///");
		 if($data[0]==0){
			 $("#CuerpoBusHFPac").html("<tr><td colspan='3'>No hay resultados ..</td></tr>");exit;
			 }
		 $("#CanBusHF").val($data[0]);
		 $("#CuerpoBusHFPac").html($data[1]);
		 $("#IdNumFilaHF").val(1)
		 })
	exit;	 
  }
  
  
  $("#IdBusHFPac").keypress(function(e){
	    if(e.keyCode==13){
			$("#IdBusHFPac").blur();
			RealizaBusquedaHFPac();
		  }
	  })
	
	
	
		 
	  
	$(document).keydown(function(e){
           if (e.keyCode==40) {
			      var $num_fila=parseInt($("#IdNumFilaHF").val());
				  var $tr=$num_fila+1;
				  $can=parseInt($("#CanBusHF").val());
				  if($num_fila<$can){
					$("#"+$num_fila).css({background:"#FFFFFF"});  
			        $("#"+$tr).css({background:"#c5dbec"});
				    $("#IdNumFilaHF").val($tr);
			       }
			}
			if (e.keyCode==38) {
			      var $num_fila=parseInt($("#IdNumFilaHF").val());
				  var $tr=$num_fila-1;
				  if($num_fila>1){
					$("#"+$num_fila).css({background:"#FFFFFF"});  
			        $("#"+$tr).css({background:"#c5dbec"});
				    $("#IdNumFilaHF").val($tr);
			       }
			}exit; 
   }); 
   
   function PintarFila($num_fila){
	   $("#CuerpoBusHFPac tr").css({background:"#FFFFFF"});
	   $("#"+$num_fila).css({background:"#c5dbec", cursor:"pointer"});
	   $("#IdNumFilaHF").val($num_fila);
	 } 
	 
  function SeleccionarBusquedaHF(){
		  $("#DivBuscarHFPac").hide(1000);
		 var $fila=$("#IdNumFilaHF").val();
		 var $idHF=$("#"+$fila).attr("idHF");//alert($idgrupo);exit;
		 //$("#IdHidenPac").val($idHF);
		 //alert($idHF);exit;
		 $.post('CONTROLADOR/Chistorial_fichas.php',{accion:'LLENAR_PAC',idHF:$idHF},function(data){
			 var $data=data.split("///");
			 $("#IdPacienteHF").val($data[0]);
			 if($data[1]==""){
				$("#CuerpoHF").html("<tr><td colspan='5'>No tiene Fichas ..</td></tr>"); exit;
				 }
			 $("#CuerpoHF").html($data[1]);
		  })
	  } 	 
	 
  function AbrirMensajeHF($idficha){
	  $("#IdHidenFicha").val($idficha);
	  $('#IdMensajeHF').show(1000);
   }  
	  
  function InhabilitarHF(){
	  $("#IdMensajeHF").hide(1000);
	  var $idficha=$("#IdHidenFicha").val();
	   $.post('CONTROLADOR/Chistorial_fichas.php',{accion:'INHABILITAR',idficha:$idficha},function(data){
		   //alert(data);exit;
		   var $idHF=data;
		   $.post('CONTROLADOR/Chistorial_fichas.php',{accion:'LLENAR_PAC',idHF:$idHF},function(data){
			 var $data=data.split("///");
			 $("#IdPacienteHF").val($data[0]);
			 if($data[1]==""){
				$("#CuerpoHF").html("<tr><td colspan='5'>No tiene Fichas ..</td></tr>"); exit;
				 }
			 $("#CuerpoHF").html($data[1]);
		  })
		   })
	}	  

  function VerHF($idficha){
	  window.open('PdfFichaAtencion.php?id='+$idficha,"VerFicha", "top=150,left=200,menubar=no,location=no,status=no,resizable=no,scrollbars=no,width=600,height=400,toolbar=no"); 
   }	