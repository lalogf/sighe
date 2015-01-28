var codid=0

$(function() {
	
	$('#tabla').fixheadertable({ 
							//caption : "", 
			 				colratio : [188,335,88], 
							height : 220, 
							width :640, 
							zebra : true, 
							sortable : false, 
							sortedColId : 3, 
							dateFormat : 'm/d/Y',
							pager : false,
							rowsPerPage	 : 10,
							resizeCol : true
				});
				
		listar()		
})

function subir(id){
	codid=id
	subirimagen()
	
	}
	
 function subirimagen() {
    $("#subir").trigger('click')
   
}

function procesar(){
 
    document.getElementById('frmupfoto').action = "subeexcel.php";
    document.getElementById('frmupfoto').submit();
	}

function PintarFila($codigo_fila) {
    codigo_fila = $codigo_fila
       $("table tbody tr").css({background:"#FFFFFF"});
		
    $("#" + $codigo_fila).css({
            background: "#c5dbec",
            cursor: "pointer"
        });
}


function listar(){
	 $.post('CONTROLADOR/CExamenLab.php', {
        accion: 'LISTAR' 
    }, function (data) {
		 
		 datos=data.split("///")
		 
		 $("#tabla2").html(datos[1])
		//window.location=  data
// window.open("imprimirturnos.php?id_modulo=1&fecha="+data)
 return false;
 	})
	
	}

function importar(){
	document.getElementById('subir').value=""
	
	//alert(codid)
	 $.post('CONTROLADOR/CExamenLab.php', {
        accion: 'IMPORTAR',id_examen_laboratorio:codid
    }, function (data) {
		 if(data==2){alert("Error Formato Incorrecto")}
		 else {
			 alert(data)} 
		//window.location=  data
// window.open("imprimirturnos.php?id_modulo=1&fecha="+data)
 return false;
 	})
	
	}
	
	

function exportar(){
	 $.post('CONTROLADOR/CExamenLab.php', {
        accion: 'EXPORTAR',fecha:$("#fecha").val()
    }, function (data) {
		if(data==1){alert("Inserto Correctamente");listar();return false;
		
		
		} 
		
		
		if(data==2){alert("Ya existe Reporte para esta fecha");return false;}
		 alert("Error "+data);return false;  
		//window.location=  data
// window.open("imprimirturnos.php?id_modulo=1&fecha="+data)
 return false;
 	})
	
	}