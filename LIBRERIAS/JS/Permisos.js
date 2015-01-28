$(document).ready(function() {  	

				$('#TablaGrupoUsuarios').fixheadertable({ 
							//caption : "", 
							colratio : [80,200], 
							height : 120, 
							width :305, 
							zebra : true, 
							sortable : false, 
							sortedColId : 3, 
							dateFormat : 'm/d/Y',
							pager : false,
							rowsPerPage	 : 10,
							resizeCol : true
				});
				$('#ModulosAsignados').fixheadertable({ 
							//caption : "", 
							colratio : [80,200], 
							height : 50, 
							width :305, 
							zebra : true, 
							sortable : false, 
							sortedColId : 3, 
							dateFormat : 'm/d/Y',
							pager : false,
							rowsPerPage	 : 10,
							resizeCol : true
				});
				$('#ModulosAsignados2').fixheadertable({ 
							//caption : "", 
							colratio : [80,200], 
							height : 50, 
							width :305, 
							zebra : true, 
							sortable : false, 
							sortedColId : 3, 
							dateFormat : 'm/d/Y',
							pager : false,
							rowsPerPage	 : 10,
							resizeCol : true
				});
				$('#TablaUsuarios').fixheadertable({ 
							//caption : "", 
							colratio : [80,180,180,180], 
							height : 50, 
							width :645, 
							zebra : true, 
							sortable : false, 
							sortedColId : 3, 
							dateFormat : 'm/d/Y',
							pager : false,
							rowsPerPage	 : 10,
							resizeCol : true
				});
				$('#TablaOpciones').fixheadertable({ 
							//caption : "", 
							colratio : [80,490,50], 
							height : 275, 
							width :645, 
							zebra : true, 
							sortable : false, 
							sortedColId : 3, 
							dateFormat : 'm/d/Y',
							pager : false,
							rowsPerPage	 : 10,
							resizeCol : true
				});
});


$(function () {
    var CodigoGrupoUsuarios = 0;
	var CodigoModuloNoAsignado=0;
	var CodigoModuloAsignado=0;
	cargarGrupoUsuarios()

});


function guardar(){
	
 	var str = $("#formopcion").serialize()+"&idgrupo="+CodigoGrupoUsuarios+"&idmodulo="+CodigoModuloAsignado+"&accion=GUARDAR" ;
	 
	 $.ajax({
        url: 'CONTROLADOR/Cpermiso.php',
        type: 'POST',
        data: str,
        success: function (data) {
             
				 alert("Modifico Correctamente")
			

        }
    });
	return false;
	}

function cambio(a,b){
	if(!(a)){
		 
		  $("input[title='"+b+"']").attr("checked",false )
	 $("input[title='"+b+"']").attr("disabled",true)
	}else {
		$("input[title='"+b+"']").attr("disabled",false)
		}
	}

function cargarModulosNoAsignados(idgrupo) {
  $.post('CONTROLADOR/Cpermiso.php', {
        accion: 'LISTARMODULOSNOASIGNADOS',idgrupo:idgrupo
    }, function (data) {
		$("#CuerpoModulosAsignados2").html(data);
 	})
}

function cargarModulosAsignados(idgrupo) {
  $.post('CONTROLADOR/Cpermiso.php', {
        accion: 'LISTARMODULOSASIGNADOS',idgrupo:idgrupo
    }, function (data) {
		$("#CuerpoModulosAsignados").html(data);
		cargarOpciones()
 	})
}


function cargarOpciones() {
	idgrupo =CodigoGrupoUsuarios
	idmodulo = CodigoModuloAsignado
	$.post('CONTROLADOR/Cpermiso.php', {
        accion: 'LISTAROPCION',idgrupo:idgrupo,idmodulo:idmodulo
    }, function (data) {
		$("#CuerpoOpciones").html(data);
 	})
}


function desasignar(){
	idgrupo =CodigoGrupoUsuarios
	idmodulo = CodigoModuloAsignado
	if(idgrupo==0) return false;
	if(idmodulo==0) return false;
	 $.post('CONTROLADOR/Cpermiso.php', {
        accion: 'DESASIGNAR',idgrupo:idgrupo,idmodulo:idmodulo
    }, function (data) {
		cargarModulosAsignados(CodigoGrupoUsuarios)
		 cargarModulosNoAsignados(CodigoGrupoUsuarios)
 	}) }
	
function asignar(){
	idgrupo =CodigoGrupoUsuarios
	idmodulo = CodigoModuloNoAsignado
	if(idgrupo==0) return false;
	if(idmodulo==0) return false;
	 $.post('CONTROLADOR/Cpermiso.php', {
        accion: 'ASIGNAR',idgrupo:idgrupo,idmodulo:idmodulo
    }, function (data) {
		cargarModulosAsignados(CodigoGrupoUsuarios)
		 cargarModulosNoAsignados(CodigoGrupoUsuarios)
 	}) }

function cargarUsuarios(idgrupo) {
	$.post('CONTROLADOR/Cpermiso.php', {
        accion: 'LISTARUSUARIOSXGRUPO',idgrupo:idgrupo
    }, function (data) {
		$("#CuerpoUsuarios").html(data);
 	})
}





function cargarGrupoUsuarios() {
    $.post('CONTROLADOR/Cpermiso.php', {
        accion: 'LISTARGRUPO'
    }, function (data) {
        $("#CuerpoGrupoUsuarios").html(data);
        cargarUsuarios(CodigoGrupoUsuarios)
		cargarModulosNoAsignados(CodigoGrupoUsuarios)
		cargarModulosAsignados(CodigoGrupoUsuarios)
    })


}

function PintarFila($codigo_fila, $tabla) {
    $("#" + $tabla + " tr").css({
        background: "#FFFFFF"
    });
    $("#" + $codigo_fila).css({
        background: "#c5dbec",
        cursor: "pointer"
    });
    $("#IdNumFila").val($codigo_fila);
     /*Asigno el codigo*/
    //alert($codigo_fila);
	if($tabla=="TablaGrupoUsuarios"){
		CodigoGrupoUsuarios = $codigo_fila
		cargarUsuarios(CodigoGrupoUsuarios)
		cargarModulosNoAsignados(CodigoGrupoUsuarios)
		cargarModulosAsignados(CodigoGrupoUsuarios)
	 }
	 if($tabla=="ModulosAsignados2"){
		 trCodigoModuloNoAsignado=$codigo_fila
		 CodigoModuloNoAsignado = $("#"+$codigo_fila).attr("alt")
		 //alert(CodigoModuloNoAsignado)
		 
	 }
	 if($tabla=="ModulosAsignados"){
		 trCodigoModuloAsignado=$codigo_fila
		 CodigoModuloAsignado = $("#"+$codigo_fila).attr("alt")
		 //alert(CodigoModuloNoAsignado)
		 cargarOpciones()
	 }
}
// [Vendett[a]


/*  Funciones no editar */
document.onselectstart = new Function("return false")
if (window.sidebar) {
    document.onmousedown = disableselect
    document.onclick = reEnable
}

function disableselect(e) {
    return false
}

function reEnable() {
    return true
}
function SalirPermiso(){
	$('#DivPermiso').hide('slow');
	}